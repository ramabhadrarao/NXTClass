<?php
/**
 * Action handler for Multisite administration panels.
 *
 * @package NXTClass
 * @subpackage Multisite
 * @since 3.0.0
 */

/** Load NXTClass Administration Bootstrap */
require_once( './admin.php' );

if ( ! is_multisite() )
	nxt_die( __( 'Multisite support is not enabled.' ) );

if ( empty( $_GET['action'] ) ) {
	nxt_redirect( network_admin_url() );
	exit;
}

do_action( 'nxtmuadminedit' , '' );

// Let plugins use us as a post handler easily
do_action( 'network_admin_edit_' . $_GET['action'] );

nxt_redirect( network_admin_url() );
exit();

?>
