<?php
/** 
 * The base configurations of bbPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys and bbPress Language. You can get the MySQL settings from your
 * web host.
 *
 * This file is used by the installer during installation.
 *
 * @package bbPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for bbPress */
define( 'BBDB_NAME', 'nxtclass' );

/** MySQL database username */
define( 'BBDB_USER', 'username' );

/** MySQL database password */
define( 'BBDB_PASSWORD', 'password' );

/** MySQL hostname */
define( 'BBDB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'BBDB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'BBDB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.opensource.nxtclass.tk/secret-key/1.1/bbpress/ opensource.nxtclass.tk secret-key service}
 *
 * @since 1.0
 */
define( 'BB_AUTH_KEY', 'YDAf^H xRNs):=8~%J;Kfg {*Ba-csD:.,pm^zi*{ocq%yowcknnG5{4l}JU!t18' );
define( 'BB_SECURE_AUTH_KEY', 'kU7(L%-;p*s;+PrjPR RE%+BF{%1#e-w.]v6BHd^M0!! wXf~my>0|DH~F:h2}Tl' );
define( 'BB_LOGGED_IN_KEY', 'pqyO3Bty^RCD%oe{zsq}QzIB7RMB~E[WG+r;?3:=mq+{?!+@f9n3l,./DU K4N38' );
define( 'BB_NONCE_KEY', 'uq8@ovqECc<KCc8=_#R~gbqn*HiaKMURNHcx@9szE+3qmHnRc)7k!Qc7nyDU21Jr' );
/**#@-*/

/**
 * bbPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$bb_table_prefix = 'nxt_bb_';

/**
 * bbPress Localized Language, defaults to English.
 *
 * Change this to localize bbPress. A corresponding MO file for the chosen
 * language must be installed to a directory called "my-languages" in the root
 * directory of bbPress. For example, install de.mo to "my-languages" and set
 * BB_LANG to 'de' to enable German language support.
 */
define( 'BB_LANG', 'en' );
$bb->custom_user_table = 'nxt_users';
$bb->custom_user_meta_table = 'nxt_usermeta';

$bb->uri = 'http://localhost/nxt-content/plugins/buddypress/bp-forums/bbpress/';
$bb->name = 'test Forums';

define('BB_AUTH_SALT', 'Txx#v|Ri~d#7d(M2NV c_bLylu}i~kb4Z6]{^,wgYD$s31[5)uQadT`6VyNulofE');
define('BB_LOGGED_IN_SALT', ';(7Sp B}:=]Op2_mAe(D6pG6xQ8*sOu:_f269z,:2HF.cRk,UTN``Xwhj4t}u;68');
define('BB_SECURE_AUTH_SALT', 'rHz84#iwXhXM+e&wEL+up&wG~mHEUqmuaKz8TuD6er6vSPb{F)i; ^f`w<PJks!A');

define('nxt_AUTH_COOKIE_VERSION', 2);

?>