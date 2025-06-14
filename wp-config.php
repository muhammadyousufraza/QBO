<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          ':)?P!s&B$nJS]A~(l^jO=cqX89/!5C&bH>[jjekk= X]w;UojUYCz.->In#25WhJ' );
define( 'SECURE_AUTH_KEY',   '80SUz1#+yVTb*zeJZ.l%>fH!$7j~[oXNe0+Aoa9KMDMBk|gt`~bG}3`?~vxTP[*f' );
define( 'LOGGED_IN_KEY',     'Z_OJp[wW)ZL}.$)G{!l..OZLj^&PWX/@B=YyR?_{K6UZ=m L~Ib(><f5bQq6;G!H' );
define( 'NONCE_KEY',         'NysIN||`1y~]y,?x*`P0aWT,Nf?P FC[>FM,`CX,-,1r1mR5$+b?4)OzlEJatd1o' );
define( 'AUTH_SALT',         '%^S1nYv_E1;C;A6AONwkz](,%WOYH+yNrFdUlBj[DoFgJg5;,:ut[e3lWZPi%jEx' );
define( 'SECURE_AUTH_SALT',  'iLQ{S4C~;efmaC^9pTF]}@ZMb.*s+~wGv_b-HYOHeg4!4kTSz6<IlK|)1$r{#C!g' );
define( 'LOGGED_IN_SALT',    'tk}7Z0B|q$9b2xu|:G})a(SgIgoZnRHM &%e`(J3Ha.*j|t,Us$7Z&PP;#KNt(Q|' );
define( 'NONCE_SALT',        '9aPuL6i7(] rSU42!//}r[noIKVF-0Tm6/!j,_>f/;HYf1L&%Z7nS IzpIsgO9md' );
define( 'WP_CACHE_KEY_SALT', 'Lk13/1]Yjz|:K~;K[pZ3A]/Y!*3mv|<RmiJ(z-AMS;X<ZA#UTa=+?#&_Xa1E!7Y@' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
