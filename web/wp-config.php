<?php

/** Include Genesis to use with WordPress */
require_once(dirname(__FILE__) . '/../bower_components/genesis-wordpress/src/Genesis.php');

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
define('DB_NAME', 'renos_db');

/** MySQL database username */
define('DB_USER', 'renos_dbuser');

/** MySQL database password */
define('DB_PASSWORD', '3II2fkXKBQNwkiTV');

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
define('AUTH_KEY',         '|iB.|7](o&bGa|N=O*5Mk:H}pt7< mA, :~jngu!?]ngw-2qz$!DR]cxUS&83}w;');
define('SECURE_AUTH_KEY',  '^j!|EKj 5|kk-mW^hhHC}K?XX}agqVg{X5hmi]W~-}:CXr6^s$@}1+vC/a4+j30,');
define('LOGGED_IN_KEY',    'nu]-d_6o-r-l3=^(}ek9eW:Xp{-77{MCW.%]1ji<b_(pkZ3ADXyZx<J+u`@yMH]+');
define('NONCE_KEY',        '%s5pt*+2kB!|gugH1KG$lhn_c->BFdXW<+RUvP9K=VYitI2/l0>1X.>fzyQIzY[|');
define('AUTH_SALT',        ':I`(ma><D_^-A=zVhP 3MhUO}~u7YoCZPm|B7=&rd/|7/Hv}h?N.XF:/QD#dZ!Fh');
define('SECURE_AUTH_SALT', '_#FJWt8B,j73o$&8V(>ir7?SXiFba6Kx,;c6vepUIavC-G}r t:OJsfuIix/h(k(');
define('LOGGED_IN_SALT',   ';GRu]ZC|Z&qsb+Johp6MmK>PXZpc4I gWM+K)H(Twi@u4Kw$(e<Lf/*g1Ik.U0#l');
define('NONCE_SALT',       '5^!6+qSbO.@&D* Oo9BBav9sp-}mj4ct|bJ<EjGwX)i6,r0hAHP9.f1I$@YLjTAn');


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = '3nd1_';

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
define('WP_DEBUG', WP_ENV === 'local');

define('WP_POST_REVISIONS', 5);

define('WP_AUTO_UPDATE_CORE', false);

define('FS_METHOD', 'direct');

define('DISALLOW_FILE_EDIT', true);

/*That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

if (WP_ENV !== 'www') {
  Genesis::rewriteUrls();
}
