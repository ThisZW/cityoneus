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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'a00789123');

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
define('AUTH_KEY',         '1S:[xbcaK5_+aDXaxBwJgE1B=86=TjP<F`c~aq4aV-XoYL`9QUCk*;D)@Osoy%(3');
define('SECURE_AUTH_KEY',  '.[<-,_yU%f UO8htX@dA}!:B/niiyn8U-%;SLi4Ju=zt~-boSnm<vnn%-4W)g}sM');
define('LOGGED_IN_KEY',    '!2yS[DC/;(o0M%CcDFy6I/*Bs%po~}~ZjezF2G8JHn02{XyX:a4p:al=IoV*d)iD');
define('NONCE_KEY',        'QDe.-S2;[IzM=54Azut78%QdB!;Dzr/cll5#R5MLedP=&hY}]U(H),SKevR0Bi<,');
define('AUTH_SALT',        'L>q3[uEdLK~LFsxa::1#l@F*FSsdFVY/aT%VOifnVh#zeO7@T;7.)u&Q+`j*2T|d');
define('SECURE_AUTH_SALT', '4Lt`BGn9MmHb(8-eiA!~U= f2$3GOb:T9/:4X5<UcDNiR0>7DlO#zh<AR%MN7^un');
define('LOGGED_IN_SALT',   'OF.DG&nKl/:K[F15[~3E]Ce/r~8+~GnZ.L%G%([~ZP/Id7P.jC6Y|O?(a1hUARdx');
define('NONCE_SALT',       '#QX^RX+dbkgd!TW~HWK<&W8 QM!.1z^o`X9m&*m4>jDaId]s}8*WtR8J_o/SN?a0');

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

define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true);
define('WP_CACHE', false);