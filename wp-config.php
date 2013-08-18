<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'briannaslonim');

/** MySQL database username */
define('DB_USER', 'briannaslonim');

/** MySQL database password */
define('DB_PASSWORD', 'michiganstate');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '[RVL5+XE[Sr[&.0]BZ6@_)P|[P6i>d=@f/z~pfdedK4vl_nV9{NV]_Pb0u`PpTgf');
define('SECURE_AUTH_KEY',  'DOy_~d*AFNe=3J-Ipa/L2]30vTj~xtUXZ9,&X!zLP!F7tat,N5oelmts-o@=?1#/');
define('LOGGED_IN_KEY',    '8h*wb81@9HiE1VFdsGHdcx:7;6Uh`$yT-p}9*OiP]7$:SqwH8j++lL!)K@:fCX}v');
define('NONCE_KEY',        '7:=x!saU:|ru//;-usI)6v@|A4U`Uk.SN=nR|87nE v c~s_BJ+-KxO{%XD%w0k:');
define('AUTH_SALT',        'KN-~t7Q^R!t+L:Ht_<8!T3B)?0ZLm{PS,+^v5h0-|([3+.mgLV=:Rc^H`Ag5JGS^');
define('SECURE_AUTH_SALT', 'FIzt[=||4IE*>~qzx(B5#rKo}&<k+gL1{p+l|Z&-AOT;++DdiVu;eeO|&.botP(P');
define('LOGGED_IN_SALT',   'D&Aae:J*V.9izy?!3jc:b[1&A5VGefQ.*rYT?2I?B4UO}wUeH9RMM!o,J_LhjemR');
define('NONCE_SALT',       '4r:ppa/x(U:L9lQ06et;T{1ZDt?+/F>]RjT (L=!sQ^,-,b]j|a#S:|-zB+d%,5U');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
