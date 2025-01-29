<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'areadeprojetos06' );

/** Database username */
define( 'DB_USER', 'areadeprojetos06' );

/** Database password */
define( 'DB_PASSWORD', 'm1n1s9' );

/** Database hostname */
define( 'DB_HOST', 'mysql16-farm2.uni5.net' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define('WP_HOME', 'http://areadeprojetos.com.br/areadeprojetos06');
define('WP_SITEURL', 'http://areadeprojetos.com.br/areadeprojetos06');

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
define( 'AUTH_KEY',         '_pC NV!RNkEb.BP@:BP17sT!*Y(]7y]^T]_aWTT$!IM #6G):Ip/i)WE/sn24Vj3' );
define( 'SECURE_AUTH_KEY',  ' fw&i%mdfsvi$RW|K[+^qLJWRJ_xnDKMVk-z<ptz<yjm}IH[c!67aR&%k#VgOJI7' );
define( 'LOGGED_IN_KEY',    '`E-x&.sClR8W?U~fp6%hm51z.?K)l}dk`W)>h~l@K.V86w<`y&F{e]jfgd>StDG=' );
define( 'NONCE_KEY',        '!I*w2x(LNv*{<A.`!vn6ep8)55CBYa5CY/rq$2ph93&t,ycC4?)=7f#ib};HMp&>' );
define( 'AUTH_SALT',        'o*2n=;_;Xp ;O7lHwX(~%CMT#lK?o}/3?M -D*uC!;ckk?y&3RPkFgF6-dN[[l<H' );
define( 'SECURE_AUTH_SALT', 'BTV|-pOrJ*aG%$xX2B3iblD)<JF`JXNQ/mE,KP0(`%k$&p:j%I%s@yCAd=l9PU4H' );
define( 'LOGGED_IN_SALT',   '+%}/{YkFo Vb~]&F+tIgSXw|u)KGY1^MSn+$Y$+aALnb[<2nZfHa~RKyIhO=r2lh' );
define( 'NONCE_SALT',       'l;^ZQj=Rxz$<c=3E;GiY-e%4A{%J.C=MIL. BTSJh}WVSr7z!5Q^xXHW%`[:-/VV' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
