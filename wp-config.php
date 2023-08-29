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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'harnoor-foods' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'NPEcOAqwhb/A@Dk<[wYDa-q7,PN -=0Vn:k<<^vTdMOj4!9L@us2||%$Xe+7x_ a' );
define( 'SECURE_AUTH_KEY',  'pB}g%WwJb$wh|ww~2nipROyUEO&8hMqU%9<EKkh98DE*0OH82Q.nT7>PN-IAb]=S' );
define( 'LOGGED_IN_KEY',    'vU}3c_!?c$82PrRt&+}# |3cU;j0l@[A6{x+_/+`C%F,Kda6JMalw!/V-}`m{k`I' );
define( 'NONCE_KEY',        'NrlY{&ZEXOm)/VkP~&9xFjE#yB.!DcAE4/)r;:M6Pftv X=K44:N#pV.[ER)kk_6' );
define( 'AUTH_SALT',        '1a;,qfS;!%t!&Q/n2eD+#JZOqczyE^{W&nnaqVa;P}x~a!]C_oZ8jFG&zai)9vj[' );
define( 'SECURE_AUTH_SALT', 'V Ij8|i&J,t};+1~oKm-/Yxz1m5;rYV6af(EnUcY!a`4=kHB5X~Tmz]rmC<*LwHy' );
define( 'LOGGED_IN_SALT',   'qLfRaT}r<(7)[ND8_BE{ 0p6eoyTMJuck4-2dw-jY[(C`wQk5/Q>QtBlFXC,Q#lK' );
define( 'NONCE_SALT',       '|p5~-2JATmQ5t(g4yR>xD58|b!b08-e4YG7y|4GCf&PO5KaiV!cOv/Q$cjef< vx' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define( 'FS_METHOD', 'direct' );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
