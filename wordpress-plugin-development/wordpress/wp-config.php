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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wp');

/** MySQL database username */
define('DB_USER', 'wp');

/** MySQL database password */
define('DB_PASSWORD', 'secret');

/** MySQL hostname */
define('DB_HOST', 'mysql');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'vLyjN!5?:n4<>ZK:ktJJEv87l^c_l(n1)WP&[U@mJk55pg($sfkeV2X;y3kpiPkV');
define('SECURE_AUTH_KEY',  'uBjTp(8WDK8]We7$6<?sio$m_P~3z?#7xU,G>gxP +UP!Nsb,M!d@VuS`O?m.wNU');
define('LOGGED_IN_KEY',    'B]3Dc^w[2^7.zM-r3QBVpbcL%3H$r2]xEZ?ikgPD[Fu8FMN o_n__och5db.-B6&');
define('NONCE_KEY',        '^w8^a/O.)--qj@`~q/ga?5Rq/a)7h%I*3h0QU{0(JN9ztnR<1sX|lY6NNdFlq5O=');
define('AUTH_SALT',        'LKWt^)b)xqL(k]m`ftcW{fj|@iTwvDD_fs7yO1!tSJZt):LEVVdirX72YX?o~xRM');
define('SECURE_AUTH_SALT', 'F{KRy6>~Ee$4&`DC?ZB~6KQjqyN3SLOi?{b^{}O1?KK%uZ)l|xeFpUcDS@qDNH2-');
define('LOGGED_IN_SALT',   'L8m[6Onw TXj>i2h.vKZYrLxlDEAqyCZJU#R2n=][*~R]kU+%DM`-xJME_rcXqO,');
define('NONCE_SALT',       'RkN&/#oNKUpoREB6Dmy!Te@{)uI/zQhpI6}#!%HiCJ`Y9g^^T+(j8)_0Wc;-9wzG');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */

// Enable WP_DEBUG mode
define('WP_DEBUG', true);
// Enable Debug logging to the /wp-content/debug.log file
define('WP_DEBUG_LOG', true);
// Disable display of errors and warnings
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors', 0);
// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define('SCRIPT_DEBUG', true);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
