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
define('DB_NAME', 'pinki_sapienum');
define('DB_USER', 'pinki_sapienum');
define('DB_PASSWORD', 'sapienum@123');


// define('DB_NAME', 'sapienum');
// define('DB_USER', 'root');
// define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '(2O22D6q<6de+H`RF%Z*`%+2];)!8uH #]8D?E)+z1&$Q*SX`Gcg}TzZ+v9*Fe*Y');
define('SECURE_AUTH_KEY',  '|TW9)OR5}0<JzP,1&yRIVuEs%a1?tdg~LCZOj?htR]+0LS*9<^El (%)#]dnyw|$');
define('LOGGED_IN_KEY',    'M.m# GY6wC]>CkJl(LMfE,D7_r5/}K/%A&|[h`~j#F1j3%$LkphN#SK55.iPL+Bl');
define('NONCE_KEY',        'JY#1%2hRaPog)Z]-xdSk.x.@|kxyV>8b-1r2zu`|tSIIvAzv3+aLNwZ,ehKG>IdU');
define('AUTH_SALT',        '_ fI5qv@&NI2_;Qo~sZ12?jP;%pSLSGp6!0*Q$rZ.$upO4f=%)ve&o5#?]#W{]4 ');
define('SECURE_AUTH_SALT', '2? SyRq|ESD.k{[_J/LAm)<pvi;C- cOW?m0#$H:X9*P7;IR254`C1Ad6i]kaadC');
define('LOGGED_IN_SALT',   ':zxlZooy<CY*ZaI:;h2{.=6m-6dVd7[|ckOIgY5*sVt[o=}YVb`BcQIl[gtZJ)h5');
define('NONCE_SALT',       'c}XwhWB&1pI,%d}*IAhB)/bpu]jE$tg}gGkUVZpk&VSYn]^o@7D~_q&+{2+QH/(&');

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
