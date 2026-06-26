<?php
/**
 * Plugin Name: CMSS Session Fixation Fix
 * Description: Regenerates PHPSESSID after every successful login and destroys session on logout. Fixes Pre and Post Session ID vulnerability.
 * Version: 1.0.0
 */

if (!defined('ABSPATH')) exit;

/* =============================================================
   FIX 1: Regenerate Session ID after successful login
   Old PHPSESSID is destroyed, new one is issued
   ============================================================= */

add_action('wp_login', 'cmss_regenerate_session_after_login', 10, 2);

function cmss_regenerate_session_after_login($user_login, $user) {
    if (!session_id()) {
        session_start();
    }

    // Save existing session data
    $old_session_data = $_SESSION;

    // Destroy old session completely
    session_destroy();

    // Start a brand new session
    session_start();

    // Regenerate with new ID (delete old session file)
    session_regenerate_id(true);

    // Restore session data into new session
    $_SESSION = $old_session_data;

    // Store user info in new session
    $_SESSION['user_id']    = $user->ID;
    $_SESSION['user_login'] = $user_login;
    $_SESSION['login_time'] = time();
    $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
}

/* =============================================================
   FIX 2: Destroy session completely on logout
   ============================================================= */

add_action('wp_logout', 'cmss_destroy_session_on_logout');

function cmss_destroy_session_on_logout() {
    if (!session_id()) {
        session_start();
    }

    // Clear all session data
    $_SESSION = [];

    // Delete session cookie
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }

    // Destroy session
    session_destroy();

    // Also clear WordPress auth cookies
    wp_clear_auth_cookie();
}

/* =============================================================
   FIX 3: Secure session cookie settings
   - HttpOnly: JS cannot read the cookie
   - Secure: only sent over HTTPS
   - SameSite: blocks CSRF
   ============================================================= */

add_action('init', 'cmss_secure_session_settings', 1);

function cmss_secure_session_settings() {
    if (headers_sent()) return;

    // Set secure cookie parameters before session starts
    $is_https = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';

    session_set_cookie_params([
        'lifetime' => 0,           // Session cookie (expires when browser closes)
        'path'     => '/',
        'domain'   => '',
        'secure'   => $is_https,   // HTTPS only
        'httponly' => true,         // Not accessible via JavaScript
        'samesite' => 'Strict'     // Blocks cross-site requests
    ]);

    // Prevent session ID in URL (e.g. ?PHPSESSID=xxx)
    ini_set('session.use_only_cookies', 1);
    ini_set('session.use_trans_sid', 0);
}

/* =============================================================
   FIX 4: WordPress auth cookie — also regenerate on login
   This handles WordPress's own cookie system
   ============================================================= */

add_filter('auth_cookie_expiration', 'cmss_set_auth_cookie_expiration', 10, 3);

function cmss_set_auth_cookie_expiration($expiration, $user_id, $remember) {
    // If not remember me: expire in 8 hours (work session)
    // If remember me: expire in 7 days (not 1 year default)
    return $remember ? (7 * DAY_IN_SECONDS) : (8 * HOUR_IN_SECONDS);
}

/* =============================================================
   FIX 5: Validate session on every request
   Destroys session if IP or user agent changes mid-session
   (detects session hijacking attempts)
   ============================================================= */

add_action('init', 'cmss_validate_session_integrity', 5);

function cmss_validate_session_integrity() {
    if (!session_id()) {
        session_start();
    }

    // Only check for logged in users
    if (!is_user_logged_in()) return;

    // If session has stored IP/agent, verify they match
    if (isset($_SESSION['ip_address']) && isset($_SESSION['user_agent'])) {
        $ip_changed    = $_SESSION['ip_address'] !== $_SERVER['REMOTE_ADDR'];
        $agent_changed = $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT'];

        if ($ip_changed || $agent_changed) {
            // Possible session hijacking — destroy session and logout
            cmss_destroy_session_on_logout();
            wp_redirect(wp_login_url() . '?session_expired=1');
            exit;
        }
    }
}

/* =============================================================
   FIX 6: Show message when session expires due to hijacking
   ============================================================= */

add_filter('login_message', 'cmss_session_expired_message');

function cmss_session_expired_message($message) {
    if (isset($_GET['session_expired'])) {
        $message = '<div id="login_error">Your session was terminated for security reasons. Please log in again.</div>';
    }
    return $message;
}