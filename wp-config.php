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
define( 'DB_NAME', 'sosanhgia' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '{R@3cbM{~iADq3cK}5 fD/FWgvXdU*nAkIHg0nPL*o`+bbiF/~Ni_!f9)rK]ndQE' );
define( 'SECURE_AUTH_KEY',  'uOIB&x7(Xxm&?Z>-kX?VP:puAz[]7*8{<|`*NBI}>)6ePgCAXUU&9Y&PLd>DD^f(' );
define( 'LOGGED_IN_KEY',    'pT>J#iPAivPJXV#+RnW%:$,~+,X=u4m`73[@Ju_c|RAfi)r%Y&8G*5C)+ivYb=bL' );
define( 'NONCE_KEY',        '5Bk]18w%UC(TpS-m -%OKV9y?4iRuXM2x8T<ogJ}zTV>EN2WCJwr_Kf pzJ/4w3<' );
define( 'AUTH_SALT',        '94$dn3@ix~:VCLMQD2|!<7^Km[dXO2`<;ilk]p+$&hs{(jOLa(-Y|SAlcDOwF=Vk' );
define( 'SECURE_AUTH_SALT', 'ur7;Js^w2u|:q}mFw.qA%It>0d%X&B<vUX:8@mCgx>~4dp&XFeIXr*+{]3Pw{~A&' );
define( 'LOGGED_IN_SALT',   'Vt-SVR<.bDn&C?OCD.IF5YIKS8&~A^pf}e>gWMYGt58@`utVi6;=&nI/!1(,u9Go' );
define( 'NONCE_SALT',       '^%h[qZ7li$KIHn:Ceb^s`=,623wPHKh+.+lAl?c6}l$X)%MYh=^LY1JjtTmLI$.z' );

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
