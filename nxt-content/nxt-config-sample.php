<?php
/* Path to the NXTClass codebase you'd like to test. Add a backslash in the end. */
define( 'ABSPATH', 'path-to-nxt/' );

define( 'DB_NAME', 'nxt_travis' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

define( 'nxtLANG', '' );
define( 'nxt_DEBUG', true );
define( 'nxt_DEBUG_DISPLAY', true );

define( 'nxt_TESTS_DOMAIN', 'example.org' );
define( 'nxt_TESTS_EMAIL', 'admin@example.org' );
define( 'nxt_TESTS_TITLE', 'Test Blog' );
define( 'nxt_TESTS_NETWORK_TITLE', 'Test Network' );
define( 'nxt_TESTS_SUBDOMAIN_INSTALL', true );
$base = '/';

/* Cron tries to make an HTTP request to the blog, which always fails, because tests are run in CLI mode only */
define( 'DISABLE_nxt_CRON', true );

define( 'nxt_ALLOW_MULTISITE', false );
if ( nxt_ALLOW_MULTISITE ) {
define( 'nxt_TESTS_BLOGS', 'first,second,third,fourth' );
}
if ( nxt_ALLOW_MULTISITE && !defined('nxt_INSTALLING') ) {
define( 'SUBDOMAIN_INSTALL', nxt_TESTS_SUBDOMAIN_INSTALL );
define( 'MULTISITE', true );
define( 'DOMAIN_CURRENT_SITE', nxt_TESTS_DOMAIN );
define( 'PATH_CURRENT_SITE', '/' );
define( 'SITE_ID_CURRENT_SITE', 1);
define( 'BLOG_ID_CURRENT_SITE', 1);
//define( 'SUNRISE', TRUE );
}

$table_prefix = 'nxt_';

define( 'nxt_PHP_BINARY', 'php' );