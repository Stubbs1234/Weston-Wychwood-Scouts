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
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/homepages/27/d647694854/htdocs/westonscouts/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'db647951703');

/** MySQL database username */
define('DB_USER', 'dbo647951703');

/** MySQL database password */
define('DB_PASSWORD', 'MacBook1234');

/** MySQL hostname */
define('DB_HOST', 'db647951703.db.1and1.com');

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
define('AUTH_KEY',         'TLs[QU{&3wl<hEZTq^XBoU,[,qI5! 6G*4BRYL#M^O^S=!x>AHX3y%rEXSDsR}*b');
define('SECURE_AUTH_KEY',  '9@A#2CHkTsbe8-gA l1g6yh[i#/P1dm}JZR|n&>$q7:{&V9+[Z6BixG{n4,@I.,+');
define('LOGGED_IN_KEY',    '!X%q+Xq=*1|S)?T7MZv;pc?qI:D-k8hVv-vr>ZtvoqfCeCKnlm}UBa%BvU4t+4Aw');
define('NONCE_KEY',        ',R<`t-5rYT)*?@L<teU~NTNax3wVfCYn%u8fQzaLFrJA;%mEAH<+Z~7&=o12H-+o');
define('AUTH_SALT',        '!FPQIjXhv:B:,a^Rjf~gFj6z#/J_~A,Ibp}$ryGngCFlozH[BzASC<[.N:a/xXSU');
define('SECURE_AUTH_SALT', 'b){Qy3?+l@.@U}]TQ6LVpDP|En`{SyRI`am+e Hw7567fJ3A4t&z)6>iCq gr+PE');
define('LOGGED_IN_SALT',   'T$$Gf[yW6KTdxH-,a:XA{J7/s`}E1k>O))lyH&bs=|&R)x ]UzDgc.a:qg?Q90rm');
define('NONCE_SALT',       '_Bv49g@4t.hq*^Kcv,ZV=DIc%>^bcQVGC# jk+VShD>Mh=1B>$1bN~~cqVs!403J');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
