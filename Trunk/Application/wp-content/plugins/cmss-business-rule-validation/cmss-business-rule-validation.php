<?php
/**
 * Plugin Name: CMSS Business Rule Validation
 * Description: Fixes Business Rule Bypass - validates Blacklisted Firms dates and Achievements negative count.
 * Version: 3.0.0
 */

if (!defined('ABSPATH')) exit;

/* =============================================================
   STEP A: Find field value automatically from POST data
   (works with any ACF field key format)
   ============================================================= */

function cmss_get_field_by_keywords(array $keywords) {
    // Search inside ACF array
    if (!empty($_POST['acf']) && is_array($_POST['acf'])) {
        foreach ($_POST['acf'] as $key => $value) {

            $name = strtolower($key);

            // If key is like field_abc123, resolve real field name via ACF
            if (strpos($key, 'field_') === 0 && function_exists('acf_get_field')) {
                $field = acf_get_field($key);
                if ($field && !empty($field['name'])) {
                    $name = strtolower($field['name']);
                }
            }

            foreach ($keywords as $kw) {
                if (strpos($name, strtolower($kw)) !== false) {
                    return sanitize_text_field(wp_unslash($value));
                }
            }
        }
    }

    // Fallback: check plain POST keys
    foreach ($keywords as $kw) {
        if (isset($_POST[$kw])) {
            return sanitize_text_field(wp_unslash($_POST[$kw]));
        }
    }

    return null;
}

/* =============================================================
   STEP B: Parse date string in any common format
   ============================================================= */

function cmss_parse_date($str) {
    if (empty($str)) return null;

    $formats = ['d/m/Y', 'Y-m-d', 'm/d/Y', 'd-m-Y', 'Y/m/d', 'd.m.Y'];
    foreach ($formats as $fmt) {
        $d = DateTime::createFromFormat($fmt, trim($str));
        if ($d) {
            $d->setTime(0, 0, 0);
            return $d;
        }
    }

    $ts = strtotime($str);
    if ($ts) {
        $d = new DateTime();
        $d->setTimestamp($ts)->setTime(0, 0, 0);
        return $d;
    }

    return null;
}

/* =============================================================
   STEP C: Send error (works for AJAX, normal submit, REST)
   ============================================================= */

function cmss_block($message) {
    if (wp_doing_ajax()) {
        wp_send_json([
            'success' => false,
            'data'    => ['valid' => 0, 'errors' => 1, 'message' => $message]
        ], 400);
        exit;
    }

    if (defined('REST_REQUEST') && REST_REQUEST) {
        wp_die(
            json_encode(['code' => 'validation_error', 'message' => $message]),
            'Validation Error',
            ['response' => 400]
        );
    }

    wp_die(
        '<h2 style="color:red">&#10060; Validation Error</h2>
         <p style="font-size:16px">' . esc_html($message) . '</p>',
        'Validation Error',
        ['response' => 400, 'back_link' => true]
    );
}

/* =============================================================
   FIX #1 — BLACKLISTED FIRMS
   "Blacklisted Upto" must NOT be before "Blacklisted From"
   ============================================================= */

// Layer 1: ACF validation hook (fires on admin-ajax.php save)
add_action('acf/validate_save_post', function () {
    $post_type = isset($_POST['post_type']) ? sanitize_key($_POST['post_type']) : '';
    if ($post_type !== 'blacklisted') return;

    $from_str = cmss_get_field_by_keywords(['blacklisted_from', 'from', 'start', 'begin']);
    $upto_str = cmss_get_field_by_keywords(['blacklisted_upto', 'blacklisted_to', 'upto', 'end', 'to']);

    if (!$from_str || !$upto_str) return;

    $from = cmss_parse_date($from_str);
    $upto = cmss_parse_date($upto_str);

    if (!$from || !$upto) {
        acf_add_validation_error('', 'Invalid date format in Blacklisted From or Upto field.');
        return;
    }

    if ($upto < $from) {
        acf_add_validation_error(
            '',
            '"Blacklisted Upto" (' . $upto_str . ') cannot be before "Blacklisted From" (' . $from_str . ').'
        );
    }
}, 10);

// Layer 2: save_post hook (fires even if ACF hook is bypassed)
add_action('save_post', function ($post_id, $post) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (wp_is_post_revision($post_id)) return;
    if (!isset($post->post_type) || $post->post_type !== 'blacklisted') return;

    $from_str = cmss_get_field_by_keywords(['blacklisted_from', 'from', 'start', 'begin']);
    $upto_str = cmss_get_field_by_keywords(['blacklisted_upto', 'blacklisted_to', 'upto', 'end', 'to']);

    if (!$from_str || !$upto_str) return;

    $from = cmss_parse_date($from_str);
    $upto = cmss_parse_date($upto_str);

    if ($from && $upto && $upto < $from) {
        cmss_block('"Blacklisted Upto" date cannot be before "Blacklisted From" date.');
    }
}, 1, 2);

// Layer 3: Database level — block bad data even on direct DB writes
add_filter('update_post_metadata', function ($check, $post_id, $meta_key, $meta_value, $prev) {
    if (get_post_type($post_id) !== 'blacklisted') return $check;

    $key = strtolower($meta_key);
    $is_upto = strpos($key, 'upto') !== false
            || strpos($key, 'up_to') !== false
            || strpos($key, '_to') !== false;

    if (!$is_upto) return $check;

    // Find the "from" value already saved
    $from_str = '';
    foreach (['blacklisted_from', 'from_date', 'start_date', 'blacklisted_start'] as $try) {
        $from_str = get_post_meta($post_id, $try, true);
        if ($from_str) break;
    }

    // Also check incoming POST data
    if (!$from_str) {
        $from_str = cmss_get_field_by_keywords(['blacklisted_from', 'from', 'start']) ?? '';
    }

    if (!$from_str) return $check;

    $from = cmss_parse_date($from_str);
    $upto = cmss_parse_date($meta_value);

    if ($from && $upto && $upto < $from) {
        // Silently block — do not write to DB
        return false;
    }

    return $check;
}, 10, 5);

/* =============================================================
   FIX #2 — ACHIEVEMENTS
   Count must be >= 0 (no negative values)
   ============================================================= */

// Layer 1: ACF validation hook
add_action('acf/validate_save_post', function () {
    $post_type = isset($_POST['post_type']) ? sanitize_key($_POST['post_type']) : '';
    if ($post_type !== 'achievements') return;

    $count = cmss_get_field_by_keywords(['count', 'number', 'total', 'amount', 'qty']);
    if ($count === null) return;

    if (!is_numeric($count)) {
        acf_add_validation_error('', 'Achievements Count must be a valid number.');
        return;
    }

    if ((float)$count < 0) {
        acf_add_validation_error('', 'Achievements Count cannot be negative. You entered: ' . $count);
    }
}, 10);

// Layer 2: save_post hook
add_action('save_post', function ($post_id, $post) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (wp_is_post_revision($post_id)) return;
    if (!isset($post->post_type) || $post->post_type !== 'achievements') return;

    $count = cmss_get_field_by_keywords(['count', 'number', 'total', 'amount', 'qty']);
    if ($count === null) return;

    if (is_numeric($count) && (float)$count < 0) {
        cmss_block('Achievements Count cannot be negative. You entered: ' . $count);
    }
}, 1, 2);

// Layer 3: Database level — block negative count even on direct DB writes
add_filter('update_post_metadata', function ($check, $post_id, $meta_key, $meta_value, $prev) {
    if (get_post_type($post_id) !== 'achievements') return $check;

    $key = strtolower($meta_key);
    $is_count = strpos($key, 'count') !== false
             || strpos($key, 'number') !== false
             || strpos($key, 'total') !== false;

    if (!$is_count) return $check;

    if (is_numeric($meta_value) && (float)$meta_value < 0) {
        // Block negative value from reaching the database
        return false;
    }

    return $check;
}, 10, 5);

/* =============================================================
   FRONT-END: JavaScript validation in WP Admin editor
   Shows error BEFORE form even submits
   ============================================================= */

add_action('admin_footer', function () {
    $screen = get_current_screen();
    if (!$screen || !in_array($screen->post_type, ['blacklisted', 'achievements'])) return;
    $post_type = esc_js($screen->post_type);
    ?>
<script>
(function () {
    'use strict';

    // Parse dates in DD/MM/YYYY or YYYY-MM-DD or MM/DD/YYYY
    function parseDate(str) {
        if (!str) return null;
        var p;
        p = str.match(/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/);
        if (p) return new Date(+p[3], +p[2] - 1, +p[1]);
        p = str.match(/^(\d{4})-(\d{2})-(\d{2})$/);
        if (p) return new Date(+p[1], +p[2] - 1, +p[3]);
        p = str.match(/^(\d{1,2})-(\d{1,2})-(\d{4})$/);
        if (p) return new Date(+p[3], +p[2] - 1, +p[1]);
        return null;
    }

    // Find input by partial name/id match
    function findInput(keywords) {
        var all = document.querySelectorAll('input, select');
        for (var i = 0; i < all.length; i++) {
            var name = (all[i].name + ' ' + all[i].id).toLowerCase();
            for (var k = 0; k < keywords.length; k++) {
                if (name.indexOf(keywords[k]) !== -1) return all[i];
            }
        }
        return null;
    }

    function showError(msg) {
        var old = document.getElementById('cmss-val-err');
        if (old) old.remove();
        var div = document.createElement('div');
        div.id = 'cmss-val-err';
        div.style.cssText = [
            'background:#fff0f0',
            'border-left:5px solid #cc0000',
            'padding:14px 18px',
            'margin:12px 0',
            'font-size:14px',
            'font-weight:bold',
            'color:#cc0000',
            'border-radius:3px'
        ].join(';');
        div.innerHTML = '&#10060; ' + msg;
        var wrap = document.getElementById('wpbody-content');
        if (wrap) wrap.insertBefore(div, wrap.firstChild);
        window.scrollTo(0, 0);
    }

    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('post');
        if (!form) return;

        form.addEventListener('submit', function (e) {

            /* ---- Blacklisted Firms date check ---- */
            if ('<?php echo $post_type; ?>' === 'blacklisted') {
                var fromEl = findInput(['blacklisted_from', 'from_date', '_from', 'startdate', 'start']);
                var uptoEl = findInput(['blacklisted_upto', 'blacklisted_to', 'upto_date', '_upto', '_to', 'enddate', 'end']);

                if (fromEl && uptoEl && fromEl.value && uptoEl.value) {
                    var fromD = parseDate(fromEl.value);
                    var uptoD = parseDate(uptoEl.value);

                    if (fromD && uptoD) {
                        fromD.setHours(0, 0, 0, 0);
                        uptoD.setHours(0, 0, 0, 0);

                        if (uptoD < fromD) {
                            e.preventDefault();
                            e.stopImmediatePropagation();
                            showError(
                                '"Blacklisted Upto" (' + uptoEl.value + ') cannot be before ' +
                                '"Blacklisted From" (' + fromEl.value + ').'
                            );
                            return false;
                        }
                    }
                }
            }

            /* ---- Achievements count check ---- */
            if ('<?php echo $post_type; ?>' === 'achievements') {
                var countEl = findInput(['count', 'number', 'total', 'amount', 'qty']);

                if (countEl && countEl.value !== '') {
                    var num = parseFloat(countEl.value);
                    if (!isNaN(num) && num < 0) {
                        e.preventDefault();
                        e.stopImmediatePropagation();
                        showError('Achievements Count cannot be negative. You entered: ' + countEl.value);
                        return false;
                    }
                }
            }

        }, true); // useCapture ensures this fires before ACF handlers
    });
}());
</script>
    <?php
});