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
	if ( ! is_a( $nxt_scripts, 'nxt_Scripts' ) ) {
		if ( ! did_action( 'init' ) )
			_doing_it_wrong( __FUNCTION__, sprintf( __( 'Scripts and styles should not be registered or enqueued until the %1$s, %2$s, or %3$s hooks.' ),
				'<code>nxt_enqueue_scripts</code>', '<code>admin_enqueue_scripts</code>', '<code>init</code>' ), '3.3' );

		if ( !$handles )
			return array(); // No need to instantiate if nothing is there.
		else
			$nxt_scripts = new nxt_Scripts();
	}

	return $nxt_scripts->do_items( $handles );
}

/**
 * Register new Javascript file.
 *
 * @since r16
 * @param string $handle Script name
 * @param string $src Script url
 * @param array $deps (optional) Array of script names on which this script depends
 * @param string|bool $ver (optional) Script version (used for cache busting), set to NULL to disable
 * @param bool $in_footer (optional) Whether to enqueue the script before </head> or before </body>
 * @return null
 */
function nxt_register_script( $handle, $src, $deps = array(), $ver = false, $in_footer = false ) {
	global $nxt_scripts;
	if ( ! is_a( $nxt_scripts, 'nxt_Scripts' ) ) {
		if ( ! did_action( 'init' ) )
			_doing_it_wrong( __FUNCTION__, sprintf( __( 'Scripts and styles should not be registered or enqueued until the %1$s, %2$s, or %3$s hooks.' ),
				'<code>nxt_enqueue_scripts</code>', '<code>admin_enqueue_scripts</code>', '<code>init</code>' ), '3.3' );
		$nxt_scripts = new nxt_Scripts();
	}

	$nxt_scripts->add( $handle, $src, $deps, $ver );
	if ( $in_footer )
		$nxt_scripts->add_data( $handle, 'group', 1 );
}

/**
 * Wrapper for $nxt_scripts->localize().
 *
 * Used to localizes a script.
 * Works only if the script has already been added.
 * Accepts an associative array $l10n and creates JS object:
 * "$object_name" = {
 *   key: value,
 *   key: value,
 *   ...
 * }
 * See http://core.trac.nxtclass.org/ticket/11520 for more information.
 *
 * @since r16
 *
 * @param string $handle The script handle that was registered or used in script-loader
 * @param string $object_name Name for the created JS object. This is passed directly so it should be qualified JS variable /[a-zA-Z0-9_]+/
 * @param array $l10n Associative PHP array containing the translated strings. HTML entities will be converted and the array will be JSON encoded.
 * @return bool Whether the localization was added successfully.
 */
function nxt_localize_script( $handle, $object_name, $l10n ) {
	global $nxt_scripts;
	if ( ! is_a( $nxt_scripts, 'nxt_Scripts' ) ) {
		if ( ! did_action( 'init' ) )
			_doing_it_wrong( __FUNCTION__, sprintf( __( 'Scripts and styles should not be registered or enqueued until the %1$s, %2$s, or %3$s hooks.' ),
				'<code>nxt_enqueue_scripts</code>', '<code>admin_enqueue_scripts</code>', '<code>init</code>' ), '3.3' );

		return false;
	}

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
	if ( ! is_a( $nxt_scripts, 'nxt_Scripts' ) ) {
		if ( ! did_action( 'init' ) )
			_doing_it_wrong( __FUNCTION__, sprintf( __( 'Scripts and styles should not be registered or enqueued until the %1$s, %2$s, or %3$s hooks.' ),
				'<code>nxt_enqueue_scripts</code>', '<code>admin_enqueue_scripts</code>', '<code>init</code>' ), '3.3' );
		$nxt_scripts = new nxt_Scripts();
	}

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
	if ( ! is_a( $nxt_scripts, 'nxt_Scripts' ) ) {
		if ( ! did_action( 'init' ) )
			_doing_it_wrong( __FUNCTION__, sprintf( __( 'Scripts and styles should not be registered or enqueued until the %1$s, %2$s, or %3$s hooks.' ),
				'<code>nxt_enqueue_scripts</code>', '<code>admin_enqueue_scripts</code>', '<code>init</code>' ), '3.3' );
		$nxt_scripts = new nxt_Scripts();
	}

	if ( $src ) {
		$_handle = explode('?', $handle);
		$nxt_scripts->add( $_handle[0], $src, $deps, $ver );
		if ( $in_footer )
			$nxt_scripts->add_data( $_handle[0], 'group', 1 );
	}
	$nxt_scripts->enqueue( $handle );
}

/**
 * Remove an enqueued script.
 *
 * @since nxt 3.1
 * @see nxt_Scripts::dequeue() For parameter information.
 */
function nxt_dequeue_script( $handle ) {
	global $nxt_scripts;
	if ( ! is_a( $nxt_scripts, 'nxt_Scripts' ) ) {
		if ( ! did_action( 'init' ) )
			_doing_it_wrong( __FUNCTION__, sprintf( __( 'Scripts and styles should not be registered or enqueued until the %1$s, %2$s, or %3$s hooks.' ),
				'<code>nxt_enqueue_scripts</code>', '<code>admin_enqueue_scripts</code>', '<code>init</code>' ), '3.3' );
		$nxt_scripts = new nxt_Scripts();
	}

	$nxt_scripts->dequeue( $handle );
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
	if ( ! is_a( $nxt_scripts, 'nxt_Scripts' ) ) {
		if ( ! did_action( 'init' ) )
			_doing_it_wrong( __FUNCTION__, sprintf( __( 'Scripts and styles should not be registered or enqueued until the %1$s, %2$s, or %3$s hooks.' ),
				'<code>nxt_enqueue_scripts</code>', '<code>admin_enqueue_scripts</code>', '<code>init</code>' ), '3.3' );
		$nxt_scripts = new nxt_Scripts();
	}

	$query = $nxt_scripts->query( $handle, $list );

	if ( is_object( $query ) )
		return true;

	return $query;
}
