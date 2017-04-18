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
define( 'WPCACHEHOME', '/home/gnigatssmaj/public_html/pcid/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'gnigatss_pcid');

/** MySQL database username */
define('DB_USER', 'gnigatss_pcidusr');

/** MySQL database password */
define('DB_PASSWORD', '_M;l?01t$a%rUTcx7B');

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
define('AUTH_KEY',         '!J@?2rA4}B>Hl4)a2QCC]OLv&9 Tw?i43x[u^9c7j<_oDQeWlI2#7rc.D+g@H@DX');
define('SECURE_AUTH_KEY',  '~oleeG*6z&:;MMk}bV6uV}M^AUQ$xq#nj}l}^]p^f!:Z9$KJZ;>xTWT J%{O4J<?');
define('LOGGED_IN_KEY',    'jT(f5SFxsv&A{/KDP@;rSaM[$+-*d^iR}N=FV@D] >s2Vz^{B^SeCdI1u3RA<QFM');
define('NONCE_KEY',        'ov9XnsiSb/-.bM(N4p8&(MT>-ZefGfex*gDBG@}Jm.2D:NrN+fO[>&*DqzW`:B%N');
define('AUTH_SALT',        'VmE~EY|U!0p18;.JdL~A+`XlS djpv6)Y 2j/k0<>:hz]w V)o=!`@>B33$9.6l8');
define('SECURE_AUTH_SALT', 'u6=%@I{dF_Zw51yo&*[8rQ%yRG@vEpyX*Rj3X?}9)S)jh@.3Q}Y2xR~H;UYGgtHC');
define('LOGGED_IN_SALT',   'A?/ho6v)15PYNf*Kw%GY_{jCRi]:T4;rbxdoQzvAvJ^01}X RMS5la1IgxPKg~i&');
define('NONCE_SALT',       'B?1i8Gy,UHK1lxp^+/Uc$2K09g:p,a*V?{#GZ$jEDb5V.i!JER %el,#}6z(D)d{');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_pcid_';

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
/*define('DISALLOW_FILE_EDIT', TRUE);
define('DISALLOW_FILE_MODS', TRUE );*/
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
