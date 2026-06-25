<?php
/**
 * Plugin Name: CERT-IN Session Hardening
 * Description: Enforces secure session handling for compliance
 */

// 1. Secure Auth Cookies (WordPress-native)
function certin_secure_auth_cookie() {
    @ini_set('session.use_only_cookies', 1);
    @ini_set('session.cookie_httponly', 1);
    @ini_set('session.cookie_secure', is_ssl());
}
add_action('init', 'certin_secure_auth_cookie');


// 2. Idle Timeout Enforcement
function certin_idle_logout() {
    if (!is_user_logged_in()) return;

    $timeout = 900; // 15 minutes

    $last_activity = get_user_meta(get_current_user_id(), '_last_activity', true);

    if ($last_activity && (time() - $last_activity > $timeout)) {
        wp_logout();
        wp_redirect(wp_login_url());
        exit;
    }

    update_user_meta(get_current_user_id(), '_last_activity', time());
}
add_action('init', 'certin_idle_logout');


// 3. Session Regeneration (Prevent Fixation)
function certin_regenerate_session() {
    if (is_user_logged_in() && !isset($_SESSION['initiated'])) {
        if (!session_id()) session_start();

        session_regenerate_id(true);
        $_SESSION['initiated'] = true;
    }
}
add_action('init', 'certin_regenerate_session');


// 4. Enforce Logout URL Handling
function certin_force_logout() {
    if (isset($_GET['certin_logout'])) {
        wp_logout();
        exit;
    }
}
add_action('init', 'certin_force_logout');


// 5. Enqueue Tab Close Detection
function certin_enqueue_script() {
    if (is_user_logged_in()) {
        wp_enqueue_script(
            'certin-tab',
            plugin_dir_url(__FILE__) . 'certin-tab.js',
            [],
            null,
            true
        );

        wp_localize_script('certin-tab', 'certinData', [
            'ajaxUrl' => admin_url('admin-ajax.php')
        ]);
    }
}
add_action('wp_enqueue_scripts', 'certin_enqueue_script');

add_action('admin_enqueue_scripts', 'certin_enqueue_script');

function certin_ajax_logout() {
    if (is_user_logged_in()) {
        wp_logout();
    }
    wp_send_json_success();
}
add_action('wp_ajax_certin_logout', 'certin_ajax_logout');


// Add Old Password field in profile page
add_action('show_user_profile', 'certin_add_old_password_field');
add_action('edit_user_profile', 'certin_add_old_password_field');

function certin_add_old_password_field($user) {
?>
    <table class="form-table" role="presentation">
        <tr>
            <th><label for="old_password">Old Password</label></th>
            <td>
                <input type="password"
                       name="old_password"
                       id="old_password"
                       class="regular-text"
                       autocomplete="current-password"
                       required />
                <p class="description">Please enter your current password to confirm changes.</p>
            </td>
        </tr>
    </table>
<?php
}


// Validate old password before updating
add_action('personal_options_update', 'certin_validate_old_password');
add_action('edit_user_profile_update', 'certin_validate_old_password');

function certin_validate_old_password($user_id) {

    if (!current_user_can('edit_user', $user_id)) {
        return;
    }

    // Only check if password is being changed
    if (!empty($_POST['pass1'])) {

        if (empty($_POST['old_password'])) {
            wp_die('ERROR: Please enter your current password.');
        }

        $user = get_userdata($user_id);

        if (!wp_check_password($_POST['old_password'], $user->user_pass, $user_id)) {
            wp_die('ERROR: The current password you entered is incorrect.');
        }
    }
}

// Show errors in WordPress style instead of wp_die
add_filter('user_profile_update_errors', 'certin_password_error_handling', 10, 3);

function certin_password_error_handling($errors, $update, $user) {

    if (!empty($_POST['pass1'])) {

        if (empty($_POST['old_password'])) {
            $errors->add('old_password_error', __('Please enter your current password.'));
        } else {
            if (!wp_check_password($_POST['old_password'], $user->user_pass, $user->ID)) {
                $errors->add('old_password_error', __('The current password is incorrect.'));
            }
        }
    }

    return $errors;
}


add_filter('acf/validate_value/name=blacklisted_upto', 'validate_blacklist_dates', 10, 4);

function validate_blacklist_dates($valid, $value, $field, $input) {

    if (!$valid) {
        return $valid;
    }

    // Replace with YOUR actual field key
    $from_date = $_POST['acf']['blacklisted_from'] ?? '';

    $to_date = $value;

    if ($from_date && $to_date) {

        $from = strtotime($from_date);
        $to   = strtotime($to_date);

        if ($to <= $from) {
            return 'Blacklisted Upto date must be greater than Blacklisted From date.';
        }
    }

    return $valid;
}

add_action('acf/input/admin_enqueue_scripts', function() {
    wp_enqueue_script(
        'certin-acf',
        plugin_dir_url(__FILE__) . 'certin-acf.js',
        ['jquery'],
        null,
        true
    );
});