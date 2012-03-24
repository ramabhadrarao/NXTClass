<?php
/**
 * The base configurations of the NXTClass.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, NXTClass Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.nxtclass.org/Editing_nxt-config.php Editing
 * nxt-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the nxt-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "nxt-config.php" and fill in the values.
 *
 * @package NXTClass
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for NXTClass */
define('DB_NAME', 'nxtclass');

/** MySQL database username */
define('DB_USER', 'username');

/** MySQL database password */
define('DB_PASSWORD', 'password');

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
 * You can generate these using the {@link https://api.nxtclass.org/secret-key/1.1/salt/ NXTClass.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'YDAf^H xRNs):=8~%J;Kfg {*Ba-csD:.,pm^zi*{ocq%yowcknnG5{4l}JU!t18');
define('SECURE_AUTH_KEY',  'kU7(L%-;p*s;+PrjPR RE%+BF{%1#e-w.]v6BHd^M0!! wXf~my>0|DH~F:h2}Tl');
define('LOGGED_IN_KEY',    'pqyO3Bty^RCD%oe{zsq}QzIB7RMB~E[WG+r;?3:=mq+{?!+@f9n3l,./DU K4N38');
define('NONCE_KEY',        'uq8@ovqECc<KCc8=_#R~gbqn*HiaKMURNHcx@9szE+3qmHnRc)7k!Qc7nyDU21Jr');
define('AUTH_SALT',        'Txx#v|Ri~d#7d(M2NV c_bLylu}i~kb4Z6]{^,wgYD$s31[5)uQadT`6VyNulofE');
define('SECURE_AUTH_SALT', 'rHz84#iwXhXM+e&wEL+up&wG~mHEUqmuaKz8TuD6er6vSPb{F)i; ^f`w<PJks!A');
define('LOGGED_IN_SALT',   ';(7Sp B}:=]Op2_mAe(D6pG6xQ8*sOu:_f269z,:2HF.cRk,UTN``Xwhj4t}u;68');
define('NONCE_SALT',       'ma&#1x>}_rhgI]1T<EIQL0oPL$B[d{8`|?lizy?_ XDI^-Z~WXM:}sc5J;Y:/*Ih');

/**#@-*/

/**
 * NXTClass Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'nxt_';

/**
 * NXTClass Localized Language, defaults to English.
 *
 * Change this to localize NXTClass. A corresponding MO file for the chosen
 * language must be installed to nxt-content/languages. For example, install
 * de_DE.mo to nxt-content/languages and set nxtLANG to 'de_DE' to enable German
 * language support.
 */
define('nxtLANG', '');

/**
 * For developers: NXTClass debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use nxt_DEBUG
 * in their development environments.
 */
define('nxt_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the NXTClass directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up NXTClass vars and included files. */
require_once(ABSPATH . 'nxt-settings.php');
