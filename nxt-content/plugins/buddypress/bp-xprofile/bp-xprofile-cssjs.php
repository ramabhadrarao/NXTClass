<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function xprofile_add_admin_css() {
	if ( !empty( $_GET['page'] ) && strpos( $_GET['page'], 'bp-profile-setup' ) !== false ) {
		if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG )
			nxt_enqueue_style( 'xprofile-admin-css', BP_PLUGIN_URL . '/bp-xprofile/admin/css/admin.dev.css', array(), '20110723' );
		else
			nxt_enqueue_style( 'xprofile-admin-css', BP_PLUGIN_URL . '/bp-xprofile/admin/css/admin.css', array(), '20110723' );
	}
}
add_action( bp_core_admin_hook(), 'xprofile_add_admin_css' );

function xprofile_add_admin_js() {
	if ( !empty( $_GET['page'] ) && strpos( $_GET['page'], 'bp-profile-setup' ) !== false ) {
		nxt_enqueue_script( 'jquery-ui-core' );
		nxt_enqueue_script( 'jquery-ui-tabs' );
		nxt_enqueue_script( 'jquery-ui-mouse' );
		nxt_enqueue_script( 'jquery-ui-draggable' );
		nxt_enqueue_script( 'jquery-ui-droppable' );
		nxt_enqueue_script( 'jquery-ui-sortable' );

		if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG )
			nxt_enqueue_script( 'xprofile-admin-js', BP_PLUGIN_URL . '/bp-xprofile/admin/js/admin.dev.js', array( 'jquery', 'jquery-ui-sortable' ), '20110723' );
		else
			nxt_enqueue_script( 'xprofile-admin-js', BP_PLUGIN_URL . '/bp-xprofile/admin/js/admin.js', array( 'jquery', 'jquery-ui-sortable' ), '20110723' );
	}
}
add_action( bp_core_admin_hook(), 'xprofile_add_admin_js', 1 );
?>