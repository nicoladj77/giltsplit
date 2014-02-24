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
define('DB_NAME', 'giltsplit');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'xJq+U.:&3.,?QU-)_BW=.IVckUcg$t {OrGN195B,NPH2;94I{7p-VcnIaR@t9-M');
define('SECURE_AUTH_KEY',  'N|1aGWJ48gtzerYV%z-w`4}WPxoMrbdXfk( EB;b`7HGuCPL8W5Dz~PkP|7)PS/v');
define('LOGGED_IN_KEY',    '_pDq#sa+|11,4P89}f@N@2qO!K~=-9vvo3orG^Td@tnBN84fv+l9OpIV[KEy+bBU');
define('NONCE_KEY',        'G.vH04<_KLfA;x(/icjO-hJ`gGSL9N`M6/Zi)ZFf Wf,(i,=l5lqYpw6aCxMAS5L');
define('AUTH_SALT',        'j$ghs@rV?;ES0u|]#hNGW+}aD||FM@iiVGNTxw-. Ypml%HB*SgK4@6|0kof{8L(');
define('SECURE_AUTH_SALT', 'C+-O<p=pC|[!z~4lM#3D9?+?O)`,>Aq)8CBEKY-cuM*fl<.DngS!|Piuq[uLOcA+');
define('LOGGED_IN_SALT',   'P,>OhYokI.$tCQcc)xJcrP8WhR{yl`AkQ|_A,j|L7>Ea_D(,3&^`bO9Rm)o`@>N5');
define('NONCE_SALT',       '|$k$bqvLEOMbI:B$=-O=f(y&pV)?aoRE@wzaE*|0.M#0+9)z/$R]x5<k?gE&~T3F');

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
