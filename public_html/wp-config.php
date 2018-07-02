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
define('DB_NAME', 'we30dsa_useralumni');

/** MySQL database username */
define('DB_USER', 'we30dsa_user1');

/** MySQL database password */
define('DB_PASSWORD', 'webelevate');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');


define('WP_MEMORY_LIMIT', '64M');


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '~$Q49$HkfB?hzV.MyLrihyK3Og&d.y2gT/}l)lYSU` M$=A;+{?guqNR3.VyM%@B');
define('SECURE_AUTH_KEY',  'cF!LliutS1!:|KuR08{bwJ(p+&T7VHu]*}?$w(^/t#}Nq&Ll|&3}KOXvbD~O/Gt!');
define('LOGGED_IN_KEY',    '|D?-dp|`7Y@}+aW?FvI~u(Zd<_!a+vQ]pzzBf{tsS2_S2f+M:@rDxX;(8+3IC+BT');
define('NONCE_KEY',        'UGl_jaA%K?L!-bk,YAUxnP-JmJ^u5G|Gtfr;9xOOpx7WV70@F|mXWB;[d?mBRl%b');
define('AUTH_SALT',        'n*d+_1;y-dqk;_7<!!4CY@>D#i5;k.uo>WCt@Dt{*rC{uiN9N+eFX3{jYll/{a|+');
define('SECURE_AUTH_SALT', '+2N~z],T@FNsERbu)#;e+b+>_#%yr1TFu-3{U|h|Mxb:Dw8</l8M+Wr!p@0@tRm?');
define('LOGGED_IN_SALT',   'E`?]a(W+Nk+T02].1B!:A p8K!rjm%Znu8r]{X5ZYM6->>~?9WizpgzZJRW0 t>^');
define('NONCE_SALT',       '6JIXa/,TK|:qL~Jr[6sj{RHA#nc5xE_Wk7Z?$dD!4,}z[1L2jbOMo.~A)^CNk2zb');

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
