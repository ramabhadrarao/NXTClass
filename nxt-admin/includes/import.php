<?php
/**
 * NXTClass Administration Importer API.
 *
 * @package NXTClass
 * @subpackage Administration
 */

/**
 * Retrieve list of importers.
 *
 * @since 2.0.0
 *
 * @return array
 */
function get_importers() {
	global $nxt_importers;
	if ( is_array($nxt_importers) )
		uasort($nxt_importers, create_function('$a, $b', 'return strcmp($a[0], $b[0]);'));
	return $nxt_importers;
}

/**
 * Register importer for NXTClass.
 *
 * @since 2.0.0
 *
 * @param string $id Importer tag. Used to uniquely identify importer.
 * @param string $name Importer name and title.
 * @param string $description Importer description.
 * @param callback $callback Callback to run.
 * @return nxt_Error Returns nxt_Error when $callback is nxt_Error.
 */
function register_importer( $id, $name, $description, $callback ) {
	global $nxt_importers;
	if ( is_nxt_error( $callback ) )
		return $callback;
	$nxt_importers[$id] = array ( $name, $description, $callback );
}

/**
 * Cleanup importer.
 *
 * Removes attachment based on ID.
 *
 * @since 2.0.0
 *
 * @param string $id Importer ID.
 */
function nxt_import_cleanup( $id ) {
	nxt_delete_attachment( $id );
}

/**
 * Handle importer uploading and add attachment.
 *
 * @since 2.0.0
 *
 * @return array Uploaded file's details on success, error message on failure
 */
function nxt_import_handle_upload() {
	if ( !isset($_FILES['import']) ) {
		$file['error'] = __( 'File is empty. Please upload something more substantial. This error could also be caused by uploads being disabled in your php.ini or by post_max_size being defined as smaller than upload_max_filesize in php.ini.' );
		return $file;
	}

	$overrides = array( 'test_form' => false, 'test_type' => false );
	$_FILES['import']['name'] .= '.txt';
	$file = nxt_handle_upload( $_FILES['import'], $overrides );

	if ( isset( $file['error'] ) )
		return $file;

	$url = $file['url'];
	$type = $file['type'];
	$file = $file['file'];
	$filename = basename( $file );

	// Construct the object array
	$object = array( 'post_title' => $filename,
		'post_content' => $url,
		'post_mime_type' => $type,
		'guid' => $url,
		'context' => 'import',
		'post_status' => 'private'
	);

	// Save the data
	$id = nxt_insert_attachment( $object, $file );

	// schedule a cleanup for one day from now in case of failed import or missing nxt_import_cleanup() call
	nxt_schedule_single_event( time() + 86400, 'importer_scheduled_cleanup', array( $id ) );

	return array( 'file' => $file, 'id' => $id );
}

?>
