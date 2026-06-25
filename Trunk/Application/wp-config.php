<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */


$key = 'cmss_new-secret-key-026';

// Decrypt password at runtime
$password = openssl_decrypt(
    base64_decode('NUM1VEpVUUFhVkM4azJjcFJjZ1ZzZz09'),
    'AES-256-CBC',
    $key,
    0,
    substr($key, 0, 16)
);



define( 'DB_NAME', 'cmss' );

/** MySQL database username */
// define( 'DB_USER', 'root' );
define( 'DB_USER', 'cmss' );

/** MySQL database password */
define( 'DB_PASSWORD', $password );


/** MySQL hostname */
define( 'DB_HOST', '103.39.241.183' );
// define( 'DB_HOST', '10.247.85.229' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
//define( 'DB_COLLATE', '' );
//define('WP_ALLOW_REPAIR', false);
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'j;+yu.-#NRDF`1en&Y1~8[?x|hs9_fYo5f@|^V .4`7(&A`rE).sTdp%aF7exox/' );
define( 'SECURE_AUTH_KEY',  '``:g2yJkr7&o.{k`zt6>_jT54p1/wKc:~_yPsP7Ys3k]Hus5kN#^#YMc^A#<mr^ ' );
define( 'LOGGED_IN_KEY',    'Rz4-;2PMv/kf1h3MA}nImNwc=iyUnJ_mE}iEP`P<*6+i[8[O5c}LMte$ER[[r<PH' );
define( 'NONCE_KEY',        '17P)T&BiWaoxz+XJue|PdrNJ{)bPX0F1R5jcLR[L3i.@E$k!;Ywv_![BHcm55<.i' );
define( 'AUTH_SALT',        '&A cc&zU~ :Sb^Wy<{gr<C!yF#0e8CWhg.YTbV6$nzPU&~]14ILoh4Ww%vD]>(Q*' );
define( 'SECURE_AUTH_SALT', ' @zV?tR] ~:+-uGhmjywm=Moc6t8Il725zZ+jQG?6`eM&]Xjwpp/]~AXgOzSDAe*' );
define( 'LOGGED_IN_SALT',   'sFnZ!Vtxnfafj(nACk5i#hXTdCYmOU.~_G>HDDHm)/kDiNxF`. 0,}KsTAVg~Se[' );
define( 'NONCE_SALT',       'E`X2)(4q6K9cjFemrBy{1Fg]/pao?J3rfd9(8J-6EjERq}!TJ#L>]r0jvqP;|CT*' );


define('DISALLOW_UNFILTERED_HTML', true);

@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.cookie_samesite', 'Strict');
define('COOKIE_SECURE', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'ms_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false);
define( 'WP_DEBUG_DISPLAY', false);

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
