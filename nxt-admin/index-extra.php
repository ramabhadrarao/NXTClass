<?php
/**
 * Handle default dashboard widgets options AJAX.
 *
 * @package NXTClass
 * @subpackage Administration
 */

define('DOING_AJAX', true);

/** Load NXTClass Bootstrap */
require_once( './admin.php' );

/** Load NXTClass Administration Dashboard API */
require(ABSPATH . 'nxt-admin/includes/dashboard.php' );

@header( 'Content-Type: ' . get_option( 'html_type' ) . '; charset=' . get_option( 'blog_charset' ) );
send_nosniff_header();

switch ( $_GET['jax'] ) {

case 'dashboard_incoming_links' :
	nxt_dashboard_incoming_links();
	break;

case 'dashboard_primary' :
	nxt_dashboard_primary();
	break;

case 'dashboard_secondary' :
	nxt_dashboard_secondary();
	break;

case 'dashboard_plugins' :
	nxt_dashboard_plugins();
	break;

}

?>