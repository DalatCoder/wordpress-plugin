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
define('AUTH_KEY',         'eYM${{|QVd(yw/T:L}ge2:8Q(z%&DQZOGw|a>eLRP#IVQg&LSi#HFq`i+PG:FHTT');
define('SECURE_AUTH_KEY',  '0I/.`PE6]2:s.84L>(&bQ;Z1Nj=>X.Pq!5j:|>#0r3J(k9Wf@4#p(Pj+;SnzczCI');
define('LOGGED_IN_KEY',    '{Yf4z,~b7t;0buUSJ^Lz_dG swCv1`(,EVW7Red{6j&K86bYsu<`+V^i`,}ZPZ3u');
define('NONCE_KEY',        'sXI# Xay/o<F- 1@~)6 ic0cMR8MBBF9~,YD{|eq9J{S?v`$BNOmg_G)oj6Idq3a');
define('AUTH_SALT',        '9>BJ%yvE<-:l&0L}2v[;m|i@K:strO0r0,JNprIKb9;;8):8Fs)0&[XPE:Gtft4?');
define('SECURE_AUTH_SALT', '^{*}pH)4y;S^+2px-O8?{>}@w=Dl$n>B$)V?$pzr2u9%sh_u6gXc|#n6Az$^ya{(');
define('LOGGED_IN_SALT',   '#}=UDi1!+tys7vkE{G7@a&D#gJf]WRhBFxnM(#L$-;<Zh4U;6b/~s:YrVvMG|kI7');
define('NONCE_SALT',       'CB[y/~I>wcL2*?Mxm8y4yXeSs|.6;H5.>b3)Ex)nPk=|oQFU0{U yV46yb*{hA+U');

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
define('WP_DEBUG_LOG', '/var/www/html/wp-content/debug.log');

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
