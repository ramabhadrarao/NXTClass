<?php
/**
 * BackPress script procedural API.
 *
 * @package BackPress
 * @since r16
 */

/**
 * Prints script tags in document head.
 *
 * Called by admin-header.php and by nxt_head hook. Since it is called by nxt_head
 * on every page load, the function does not instantiate the nxt_Scripts object
 * unless script names are explicitly passed. Does make use of already
 * instantiated $nxt_scripts if present. Use provided nxt_print_scripts hook to
 * register/enqueue new scripts.
 *
 * @since r16
 * @see nxt_Dependencies::print_scripts()
 */
function nxt_print_scripts( $handles = false ) {
	do_action( 'nxt_print_scripts' );
	if ( '' === $handles ) // for nxt_head
		$handles = false;

	global $nxt_scripts;
	if ( !is_a($nxt_scripts, 'nxt_Scripts') ) {
		if ( !$handles )
			return array(); // No need to instantiate if nothing's there.
		else
			$nxt_scripts = new nxt_Scripts();
	}

	return $nxt_scripts->do_items( $handles );
}

/**
 * Register new JavaScript file.
 *
 * @since r16
 * @param string $handle Script name
 * @param string $src Script url
 * @param array $deps (optional) Array of script names on which this script depends
 * @param string|bool $ver (optional) Script version (used for cache busting), set to NULL to disable
 * @param bool (optional) Wether to enqueue the script before </head> or before </body>
 * @return null
 */
function nxt_register_script( $handle, $src, $deps = array(), $ver = false, $in_footer = false ) {
	global $nxt_scripts;
	if ( !is_a($nxt_scripts, 'nxt_Scripts') )
		$nxt_scripts = new nxt_Scripts();

	$nxt_scripts->add( $handle, $src, $deps, $ver );
	if ( $in_footer )
		$nxt_scripts->add_data( $handle, 'group', 1 );
}

/**
 * Localizes a script.
 *
 * Localizes only if script has already been added.
 *
 * @since r16
 * @see nxt_Scripts::localize()
 */
function nxt_localize_script( $handle, $object_name, $l10n ) {
	global $nxt_scripts;
	if ( !is_a($nxt_scripts, 'nxt_Scripts') )
		return false;

	return $nxt_scripts->localize( $handle, $object_name, $l10n );
}

/**
 * Remove a registered script.
 *
 * @since r16
 * @see nxt_Scripts::remove() For parameter information.
 */
function nxt_deregister_script( $handle ) {
	global $nxt_scripts;
	if ( !is_a($nxt_scripts, 'nxt_Scripts') )
		$nxt_scripts = new nxt_Scripts();

	$nxt_scripts->remove( $handle );
}

/**
 * Enqueues script.
 *
 * Registers the script if src provided (does NOT overwrite) and enqueues.
 *
 * @since r16
 * @see nxt_register_script() For parameter information.
 */
function nxt_enqueue_script( $handle, $src = false, $deps = array(), $ver = false, $in_footer = false ) {
	global $nxt_scripts;
	if ( !is_a($nxt_scripts, 'nxt_Scripts') )
		$nxt_scripts = new nxt_Scripts();

	if ( $src ) {
		$_handle = explode('?', $handle);
		$nxt_scripts->add( $_handle[0], $src, $deps, $ver );
		if ( $in_footer )
			$nxt_scripts->add_data( $_handle[0], 'group', 1 );
	}
	$nxt_scripts->enqueue( $handle );
}

/**
 * Check whether script has been added to NXTClass Scripts.
 *
 * The values for list defaults to 'queue', which is the same as enqueue for
 * scripts.
 *
 * @since nxt unknown; BP unknown
 *
 * @param string $handle Handle used to add script.
 * @param string $list Optional, defaults to 'queue'. Others values are 'registered', 'queue', 'done', 'to_do'
 * @return bool
 */
function nxt_script_is( $handle, $list = 'queue' ) {
	global $nxt_scripts;
	if ( !is_a($nxt_scripts, 'nxt_Scripts') )
		$nxt_scripts = new nxt_Scripts();

	$query = $nxt_scripts->query( $handle, $list );

	if ( is_object( $query ) )
		return true;

	return $query;
}
