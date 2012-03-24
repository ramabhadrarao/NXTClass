<?php
/**
 * Loads the NXTClass environment and template.
 *
 * @package NXTClass
 */

if ( !isset($nxt_did_header) ) {

	$nxt_did_header = true;

	require_once( dirname(__FILE__) . '/nxt-load.php' );

	nxt();

	require_once( ABSPATH . nxtINC . '/template-loader.php' );

}

?>