<?php
/**
 * Updates network administration panel.
 *
 * @package NXTClass
 * @subpackage Multisite
 * @since 3.1.0
 */

/** Load NXTClass Administration Bootstrap */
require_once( './admin.php' );

if ( ! is_multisite() )
	nxt_die( __( 'Multisite support is not enabled.' ) );

require( '../update-core.php' );