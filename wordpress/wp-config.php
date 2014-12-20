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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '111111');

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
define('AUTH_KEY',         'zx7)>[iiU$AmUa|9vH]^IwoOMb#Z)12yC|dW 0=nf+7/haJ2=cRwK-XHA4n?Q&Q_');
define('SECURE_AUTH_KEY',  '(T2q6g=Bi^W<;Bl&ac=3TB262PJ3CUJZ:FZnGpJ$^_]%Kun?s+[B|kpF)C:-AV|L');
define('LOGGED_IN_KEY',    'r8tGL56uM_l5,M{y.[VB[}-iAZ]{tGo0n0/L-xE]jyb`fgdJ:Kl&N/eDads[-EIy');
define('NONCE_KEY',        ']l^{;hg|Lb#>-X3JvmBK>^/|lfRfg4|)mJfASkQzJ;<V_8hsN*_.;eM=E! 5)RZ5');
define('AUTH_SALT',        '(#FYrvz)GK=7r$HF<0x(|LidS1O&4R3yl-WQ+*T@|;H1%=p? }<^#:F`5 JyjXFA');
define('SECURE_AUTH_SALT', ')=u|%g>or$hWgRzv`+v*k2{a8@IEq;sP-!Rg_2BHm)/U<U5yz8IN.r}gcdW]y_A;');
define('LOGGED_IN_SALT',   'C-};eb`&c|nc ->.]>aXucp>*`Pn/t0Oall~7r%CfPs+ |DV>6M/ij7ywO*1R|l9');
define('NONCE_SALT',       'J)+]-T|Co?`|97:Zvl!Yh||lKUSLB?L/Zgv1Iw?N_VZhU>h lJlztm& e`J={Xzx');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
