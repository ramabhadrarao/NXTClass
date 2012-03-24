<?php
/**
 * NXTClass scripts and styles default loader.
 *
 * Most of the functionality that existed here was moved to
 * {@link http://backpress.automattic.com/ BackPress}. NXTClass themes and
 * plugins will only be concerned about the filters and actions set in this
 * file.
 *
 * Several constants are used to manage the loading, concatenating and compression of scripts and CSS:
 * define('SCRIPT_DEBUG', true); loads the development (non-minified) versions of all scripts and CSS, and disables compression and concatenation,
 * define('CONCATENATE_SCRIPTS', false); disables compression and concatenation of scripts and CSS,
 * define('COMPRESS_SCRIPTS', false); disables compression of scripts,
 * define('COMPRESS_CSS', false); disables compression of CSS,
 * define('ENFORCE_GZIP', true); forces gzip for compression (default is deflate).
 *
 * The globals $concatenate_scripts, $compress_scripts and $compress_css can be set by plugins
 * to temporarily override the above settings. Also a compression test is run once and the result is saved
 * as option 'can_compress_scripts' (0/1). The test will run again if that option is deleted.
 *
 * @package NXTClass
 */

/** BackPress: NXTClass Dependencies Class */
require( ABSPATH . nxtINC . '/class.nxt-dependencies.php' );

/** BackPress: NXTClass Scripts Class */
require( ABSPATH . nxtINC . '/class.nxt-scripts.php' );

/** BackPress: NXTClass Scripts Functions */
require( ABSPATH . nxtINC . '/functions.nxt-scripts.php' );

/** BackPress: NXTClass Styles Class */
require( ABSPATH . nxtINC . '/class.nxt-styles.php' );

/** BackPress: NXTClass Styles Functions */
require( ABSPATH . nxtINC . '/functions.nxt-styles.php' );

/**
 * Register all NXTClass scripts.
 *
 * Localizes some of them.
 * args order: $scripts->add( 'handle', 'url', 'dependencies', 'query-string', 1 );
 * when last arg === 1 queues the script for the footer
 *
 * @since 2.6.0
 *
 * @param object $scripts nxt_Scripts object.
 */
function nxt_default_scripts( &$scripts ) {

	if ( !$guessurl = site_url() )
		$guessurl = nxt_guess_url();

	$scripts->base_url = $guessurl;
	$scripts->content_url = defined('nxt_CONTENT_URL')? nxt_CONTENT_URL : '';
	$scripts->default_version = get_bloginfo( 'version' );
	$scripts->default_dirs = array('/nxt-admin/js/', '/nxt-includes/js/');

	$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '.dev' : '';

	$scripts->add( 'utils', "/nxt-admin/js/utils$suffix.js", false, '20101110' );

	$scripts->add( 'common', "/nxt-admin/js/common$suffix.js", array('jquery', 'hoverIntent', 'utils'), '20120102', 1 );
	$scripts->localize( 'common', 'commonL10n', array(
		'warnDelete' => __("You are about to permanently delete the selected items.\n  'Cancel' to stop, 'OK' to delete.")
	) );

	$scripts->add( 'sack', "/nxt-includes/js/tw-sack$suffix.js", false, '1.6.1', 1 );

	$scripts->add( 'quicktags', "/nxt-includes/js/quicktags$suffix.js", false, '20111114', 1 );
	$scripts->localize( 'quicktags', 'quicktagsL10n', array(
		'wordLookup' => __('Enter a word to look up:'),
		'dictionaryLookup' => esc_attr(__('Dictionary lookup')),
		'lookup' => esc_attr(__('lookup')),
		'closeAllOpenTags' => esc_attr(__('Close all open tags')),
		'closeTags' => esc_attr(__('close tags')),
		'enterURL' => __('Enter the URL'),
		'enterImageURL' => __('Enter the URL of the image'),
		'enterImageDescription' => __('Enter a description of the image'),
		'fullscreen' => __('fullscreen'),
		'toggleFullscreen' => esc_attr( __('Toggle fullscreen mode') )
	) );

	$scripts->add( 'colorpicker', "/nxt-includes/js/colorpicker$suffix.js", array('prototype'), '3517m' );

	$scripts->add( 'editor', "/nxt-admin/js/editor$suffix.js", array('utils','jquery'), '20111117', 1 );

	$scripts->add( 'nxt-fullscreen', "/nxt-admin/js/nxt-fullscreen$suffix.js", array('jquery'), '20111116', 1 );

	$scripts->add( 'prototype', '/nxt-includes/js/prototype.js', false, '1.6.1');

	$scripts->add( 'nxt-ajax-response', "/nxt-includes/js/nxt-ajax-response$suffix.js", array('jquery'), '20091119', 1 );
	$scripts->localize( 'nxt-ajax-response', 'nxtAjax', array(
		'noPerm' => __('You do not have permission to do that.'),
		'broken' => __('An unidentified error has occurred.')
	) );

	$scripts->add( 'nxt-pointer', "/nxt-includes/js/nxt-pointer$suffix.js", array( 'jquery-ui-widget', 'jquery-ui-position' ), '20111129a', 1 );
	$scripts->localize( 'nxt-pointer', 'nxtPointerL10n', array(
		'dismiss' => __('Dismiss'),
	) );

	$scripts->add( 'autosave', "/nxt-includes/js/autosave$suffix.js", array('schedule', 'nxt-ajax-response'), '20111129', 1 );

	$scripts->add( 'nxt-lists', "/nxt-includes/js/nxt-lists$suffix.js", array('nxt-ajax-response'), '20110521', 1 );

	$scripts->add( 'scriptaculous-root', '/nxt-includes/js/scriptaculous/nxt-scriptaculous.js', array('prototype'), '1.8.3');
	$scripts->add( 'scriptaculous-builder', '/nxt-includes/js/scriptaculous/builder.js', array('scriptaculous-root'), '1.8.3');
	$scripts->add( 'scriptaculous-dragdrop', '/nxt-includes/js/scriptaculous/dragdrop.js', array('scriptaculous-builder', 'scriptaculous-effects'), '1.8.3');
	$scripts->add( 'scriptaculous-effects', '/nxt-includes/js/scriptaculous/effects.js', array('scriptaculous-root'), '1.8.3');
	$scripts->add( 'scriptaculous-slider', '/nxt-includes/js/scriptaculous/slider.js', array('scriptaculous-effects'), '1.8.3');
	$scripts->add( 'scriptaculous-sound', '/nxt-includes/js/scriptaculous/sound.js', array( 'scriptaculous-root' ), '1.8.3' );
	$scripts->add( 'scriptaculous-controls', '/nxt-includes/js/scriptaculous/controls.js', array('scriptaculous-root'), '1.8.3');
	$scripts->add( 'scriptaculous', '', array('scriptaculous-dragdrop', 'scriptaculous-slider', 'scriptaculous-controls'), '1.8.3');

	// not used in core, replaced by Jcrop.js
	$scripts->add( 'cropper', '/nxt-includes/js/crop/cropper.js', array('scriptaculous-dragdrop'), '20070118');

	$scripts->add( 'jquery', '/nxt-includes/js/jquery/jquery.js', false, '1.7.1' );

	// full jQuery UI
	$scripts->add( 'jquery-ui-core', '/nxt-includes/js/jquery/ui/jquery.ui.core.min.js', array('jquery'), '1.8.16', 1 );
	$scripts->add( 'jquery-effects-core', '/nxt-includes/js/jquery/ui/jquery.effects.core.min.js', array('jquery'), '1.8.16', 1 );

	$scripts->add( 'jquery-effects-blind', '/nxt-includes/js/jquery/ui/jquery.effects.blind.min.js', array('jquery-effects-core'), '1.8.16', 1 );
	$scripts->add( 'jquery-effects-bounce', '/nxt-includes/js/jquery/ui/jquery.effects.bounce.min.js', array('jquery-effects-core'), '1.8.16', 1 );
	$scripts->add( 'jquery-effects-clip', '/nxt-includes/js/jquery/ui/jquery.effects.clip.min.js', array('jquery-effects-core'), '1.8.16', 1 );
	$scripts->add( 'jquery-effects-drop', '/nxt-includes/js/jquery/ui/jquery.effects.drop.min.js', array('jquery-effects-core'), '1.8.16', 1 );
	$scripts->add( 'jquery-effects-explode', '/nxt-includes/js/jquery/ui/jquery.effects.explode.min.js', array('jquery-effects-core'), '1.8.16', 1 );
	$scripts->add( 'jquery-effects-fade', '/nxt-includes/js/jquery/ui/jquery.effects.fade.min.js', array('jquery-effects-core'), '1.8.16', 1 );
	$scripts->add( 'jquery-effects-fold', '/nxt-includes/js/jquery/ui/jquery.effects.fold.min.js', array('jquery-effects-core'), '1.8.16', 1 );
	$scripts->add( 'jquery-effects-highlight', '/nxt-includes/js/jquery/ui/jquery.effects.highlight.min.js', array('jquery-effects-core'), '1.8.16', 1 );
	$scripts->add( 'jquery-effects-pulsate', '/nxt-includes/js/jquery/ui/jquery.effects.pulsate.min.js', array('jquery-effects-core'), '1.8.16', 1 );
	$scripts->add( 'jquery-effects-scale', '/nxt-includes/js/jquery/ui/jquery.effects.scale.min.js', array('jquery-effects-core'), '1.8.16', 1 );
	$scripts->add( 'jquery-effects-shake', '/nxt-includes/js/jquery/ui/jquery.effects.shake.min.js', array('jquery-effects-core'), '1.8.16', 1 );
	$scripts->add( 'jquery-effects-slide', '/nxt-includes/js/jquery/ui/jquery.effects.slide.min.js', array('jquery-effects-core'), '1.8.16', 1 );
	$scripts->add( 'jquery-effects-transfer', '/nxt-includes/js/jquery/ui/jquery.effects.transfer.min.js', array('jquery-effects-core'), '1.8.16', 1 );

	$scripts->add( 'jquery-ui-accordion', '/nxt-includes/js/jquery/ui/jquery.ui.accordion.min.js', array('jquery-ui-core', 'jquery-ui-widget'), '1.8.16', 1 );
	$scripts->add( 'jquery-ui-autocomplete', '/nxt-includes/js/jquery/ui/jquery.ui.autocomplete.min.js', array('jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-position'), '1.8.16', 1 );
	$scripts->add( 'jquery-ui-button', '/nxt-includes/js/jquery/ui/jquery.ui.button.min.js', array('jquery-ui-core', 'jquery-ui-widget'), '1.8.16', 1 );
	$scripts->add( 'jquery-ui-datepicker', '/nxt-includes/js/jquery/ui/jquery.ui.datepicker.min.js', array('jquery-ui-core'), '1.8.16', 1 );
	$scripts->add( 'jquery-ui-dialog', '/nxt-includes/js/jquery/ui/jquery.ui.dialog.min.js', array('jquery-ui-resizable', 'jquery-ui-draggable', 'jquery-ui-button', 'jquery-ui-position'), '1.8.16', 1 );
	$scripts->add( 'jquery-ui-draggable', '/nxt-includes/js/jquery/ui/jquery.ui.draggable.min.js', array('jquery-ui-core', 'jquery-ui-mouse'), '1.8.16', 1 );
	$scripts->add( 'jquery-ui-droppable', '/nxt-includes/js/jquery/ui/jquery.ui.droppable.min.js', array('jquery-ui-draggable'), '1.8.16', 1 );
	$scripts->add( 'jquery-ui-mouse', '/nxt-includes/js/jquery/ui/jquery.ui.mouse.min.js', array('jquery-ui-widget'), '1.8.16', 1 );
	$scripts->add( 'jquery-ui-position', '/nxt-includes/js/jquery/ui/jquery.ui.position.min.js', array('jquery'), '1.8.16', 1 );
	$scripts->add( 'jquery-ui-progressbar', '/nxt-includes/js/jquery/ui/jquery.ui.progressbar.min.js', array('jquery-ui-widget'), '1.8.16', 1 );
	$scripts->add( 'jquery-ui-resizable', '/nxt-includes/js/jquery/ui/jquery.ui.resizable.min.js', array('jquery-ui-core', 'jquery-ui-mouse'), '1.8.16', 1 );
	$scripts->add( 'jquery-ui-selectable', '/nxt-includes/js/jquery/ui/jquery.ui.selectable.min.js', array('jquery-ui-core', 'jquery-ui-mouse'), '1.8.16', 1 );
	$scripts->add( 'jquery-ui-slider', '/nxt-includes/js/jquery/ui/jquery.ui.slider.min.js', array('jquery-ui-core', 'jquery-ui-mouse'), '1.8.16', 1 );
	$scripts->add( 'jquery-ui-sortable', '/nxt-includes/js/jquery/ui/jquery.ui.sortable.min.js', array('jquery-ui-core', 'jquery-ui-mouse'), '1.8.16', 1 );
	$scripts->add( 'jquery-ui-tabs', '/nxt-includes/js/jquery/ui/jquery.ui.tabs.min.js', array('jquery-ui-core', 'jquery-ui-widget'), '1.8.16', 1 );
	$scripts->add( 'jquery-ui-widget', '/nxt-includes/js/jquery/ui/jquery.ui.widget.min.js', array('jquery'), '1.8.16', 1 );

	// deprecated, not used in core, most functionality is included in jQuery 1.3
	$scripts->add( 'jquery-form', "/nxt-includes/js/jquery/jquery.form$suffix.js", array('jquery'), '2.73', 1 );

	$scripts->add( 'jquery-color', "/nxt-includes/js/jquery/jquery.color$suffix.js", array('jquery'), '2.0-4561m', 1 );
	$scripts->add( 'suggest', "/nxt-includes/js/jquery/suggest$suffix.js", array('jquery'), '1.1-20110113', 1 );
	$scripts->add( 'schedule', '/nxt-includes/js/jquery/jquery.schedule.js', array('jquery'), '20m', 1 );
	$scripts->add( 'jquery-query', "/nxt-includes/js/jquery/jquery.query.js", array('jquery'), '2.1.7', 1 );
	$scripts->add( 'jquery-serialize-object', "/nxt-includes/js/jquery/jquery.serialize-object.js", array('jquery'), '0.2', 1 );
	$scripts->add( 'jquery-hotkeys', "/nxt-includes/js/jquery/jquery.hotkeys$suffix.js", array('jquery'), '0.0.2m', 1 );
	$scripts->add( 'jquery-table-hotkeys', "/nxt-includes/js/jquery/jquery.table-hotkeys$suffix.js", array('jquery', 'jquery-hotkeys'), '20090102', 1 );

	$scripts->add( 'thickbox', "/nxt-includes/js/thickbox/thickbox.js", array('jquery'), '3.1-20111117', 1 );
	$scripts->localize( 'thickbox', 'thickboxL10n', array(
			'next' => __('Next &gt;'),
			'prev' => __('&lt; Prev'),
			'image' => __('Image'),
			'of' => __('of'),
			'close' => __('Close'),
			'noiframes' => __('This feature requires inline frames. You have iframes disabled or your browser does not support them.'),
			'loadingAnimation' => includes_url('js/thickbox/loadingAnimation.gif'),
			'closeImage' => includes_url('js/thickbox/tb-close.png')
	) );

	$scripts->add( 'jcrop', "/nxt-includes/js/jcrop/jquery.Jcrop$suffix.js", array('jquery'), '0.9.8-20110113');

	$scripts->add( 'swfobject', "/nxt-includes/js/swfobject.js", false, '2.2');

	// common bits for both uploaders
	$max_upload_size = ( (int) ( $max_up = @ini_get('upload_max_filesize') ) < (int) ( $max_post = @ini_get('post_max_size') ) ) ? $max_up : $max_post;

	if ( empty($max_upload_size) )
		$max_upload_size = __('not configured');

	// error message for both plupload and swfupload
	$uploader_l10n = array(
		'queue_limit_exceeded' => __('You have attempted to queue too many files.'),
		'file_exceeds_size_limit' => __('%s exceeds the maximum upload size for this site.'),
		'zero_byte_file' => __('This file is empty. Please try another.'),
		'invalid_filetype' => __('This file type is not allowed. Please try another.'),
		'not_an_image' => __('This file is not an image. Please try another.'),
		'image_memory_exceeded' => __('Memory exceeded. Please try another smaller file.'),
		'image_dimensions_exceeded' => __('This is larger than the maximum size. Please try another.'),
		'default_error' => __('An error occurred in the upload. Please try again later.'),
		'missing_upload_url' => __('There was a configuration error. Please contact the server administrator.'),
		'upload_limit_exceeded' => __('You may only upload 1 file.'),
		'http_error' => __('HTTP error.'),
		'upload_failed' => __('Upload failed.'),
		'big_upload_failed' => __('Please try uploading this file with the %1$sbrowser uploader%2$s.'),
		'big_upload_queued' => __('%s exceeds the maximum upload size for the multi-file uploader when used in your browser.'),
		'io_error' => __('IO error.'),
		'security_error' => __('Security error.'),
		'file_cancelled' => __('File canceled.'),
		'upload_stopped' => __('Upload stopped.'),
		'dismiss' => __('Dismiss'),
		'crunching' => __('Crunching&hellip;'),
		'deleted' => __('moved to the trash.'),
		'error_uploading' => __('&#8220;%s&#8221; has failed to upload.')
	);

	$scripts->add( 'plupload', '/nxt-includes/js/plupload/plupload.js', false, '1511-20111112');
	$scripts->add( 'plupload-html5', '/nxt-includes/js/plupload/plupload.html5.js', array('plupload'), '1511-20111112');
	$scripts->add( 'plupload-flash', '/nxt-includes/js/plupload/plupload.flash.js', array('plupload'), '1511-20111112');
	$scripts->add( 'plupload-silverlight', '/nxt-includes/js/plupload/plupload.silverlight.js', array('plupload'), '1511-20111112');
	$scripts->add( 'plupload-html4', '/nxt-includes/js/plupload/plupload.html4.js', array('plupload'), '1511-20111112');

	// cannot use the plupload.full.js, as it loads browserplus init JS from Yahoo
	$scripts->add( 'plupload-all', false, array('plupload', 'plupload-html5', 'plupload-flash', 'plupload-silverlight', 'plupload-html4'), '1511-20111112');

	$scripts->add( 'plupload-handlers', "/nxt-includes/js/plupload/handlers$suffix.js", array('plupload-all', 'jquery'), '20111120');
	$scripts->localize( 'plupload-handlers', 'pluploadL10n', $uploader_l10n );

	// keep 'swfupload' for back-compat.
	$scripts->add( 'swfupload', '/nxt-includes/js/swfupload/swfupload.js', false, '2201-20110113');
	$scripts->add( 'swfupload-swfobject', '/nxt-includes/js/swfupload/plugins/swfupload.swfobject.js', array('swfupload', 'swfobject'), '2201a');
	$scripts->add( 'swfupload-queue', '/nxt-includes/js/swfupload/plugins/swfupload.queue.js', array('swfupload'), '2201');
	$scripts->add( 'swfupload-speed', '/nxt-includes/js/swfupload/plugins/swfupload.speed.js', array('swfupload'), '2201');

	if ( defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ) {
		// queue all SWFUpload scripts that are used by default
		$scripts->add( 'swfupload-all', false, array('swfupload', 'swfupload-swfobject', 'swfupload-queue'), '2201');
	} else {
		$scripts->add( 'swfupload-all', '/nxt-includes/js/swfupload/swfupload-all.js', array(), '2201a');
	}

	$scripts->add( 'swfupload-handlers', "/nxt-includes/js/swfupload/handlers$suffix.js", array('swfupload-all', 'jquery'), '2201-20110524');
	$scripts->localize( 'swfupload-handlers', 'swfuploadL10n', $uploader_l10n );

	$scripts->add( 'comment-reply', "/nxt-includes/js/comment-reply$suffix.js", false, '20090102');

	$scripts->add( 'json2', "/nxt-includes/js/json2$suffix.js", false, '2011-02-23');

	$scripts->add( 'imgareaselect', "/nxt-includes/js/imgareaselect/jquery.imgareaselect$suffix.js", array('jquery'), '0.9.6-20110515', 1 );

	$scripts->add( 'password-strength-meter', "/nxt-admin/js/password-strength-meter$suffix.js", array('jquery'), '20101027', 1 );
	$scripts->localize( 'password-strength-meter', 'pwsL10n', array(
		'empty' => __('Strength indicator'),
		'short' => __('Very weak'),
		'bad' => __('Weak'),
		/* translators: password strength */
		'good' => _x('Medium', 'password strength'),
		'strong' => __('Strong'),
		'mismatch' => __('Mismatch')
	) );

	$scripts->add( 'user-profile', "/nxt-admin/js/user-profile$suffix.js", array( 'jquery', 'password-strength-meter' ), '20110628', 1 );

	$scripts->add( 'admin-bar', "/nxt-includes/js/admin-bar$suffix.js", false, '20111130', 1 );

	$scripts->add( 'nxtlink', "/nxt-includes/js/nxtlink$suffix.js", array( 'jquery', 'nxtdialogs' ), '20111128', 1 );
	$scripts->localize( 'nxtlink', 'nxtLinkL10n', array(
		'title' => __('Insert/edit link'),
		'update' => __('Update'),
		'save' => __('Add Link'),
		'noTitle' => __('(no title)'),
		'noMatchesFound' => __('No matches found.')
	) );

	$scripts->add( 'nxtdialogs', "/nxt-includes/js/tinymce/plugins/nxtdialogs/js/nxtdialog$suffix.js", array( 'jquery-ui-dialog' ), '20110528', 1 );

	$scripts->add( 'nxtdialogs-popup', "/nxt-includes/js/tinymce/plugins/nxtdialogs/js/popup$suffix.js", array( 'nxtdialogs' ), '20110421', 1 );

	$scripts->add( 'word-count', "/nxt-admin/js/word-count$suffix.js", array( 'jquery' ), '20110515', 1 );

	$scripts->add( 'media-upload', "/nxt-admin/js/media-upload$suffix.js", array( 'thickbox' ), '20110930', 1 );

	$scripts->add( 'hoverIntent', "/nxt-includes/js/hoverIntent$suffix.js", array('jquery'), '20090102', 1 );

	if ( is_admin() ) {
		$scripts->add( 'ajaxcat', "/nxt-admin/js/cat$suffix.js", array( 'nxt-lists' ), '20090102' );
		$scripts->add_data( 'ajaxcat', 'group', 1 );
		$scripts->localize( 'ajaxcat', 'catL10n', array(
			'add' => esc_attr(__('Add')),
			'how' => __('Separate multiple categories with commas.')
		) );

		$scripts->add( 'admin-categories', "/nxt-admin/js/categories$suffix.js", array('nxt-lists'), '20091201', 1 );

		$scripts->add( 'admin-tags', "/nxt-admin/js/tags$suffix.js", array('jquery', 'nxt-ajax-response'), '20110429', 1 );
		$scripts->localize( 'admin-tags', 'tagsl10n', array(
			'noPerm' => __('You do not have permission to do that.'),
			'broken' => __('An unidentified error has occurred.')
		));

		$scripts->add( 'admin-custom-fields', "/nxt-admin/js/custom-fields$suffix.js", array('nxt-lists'), '20110429', 1 );

		$scripts->add( 'admin-comments', "/nxt-admin/js/edit-comments$suffix.js", array('nxt-lists', 'quicktags', 'jquery-query'), '20111115', 1 );
		$scripts->localize( 'admin-comments', 'adminCommentsL10n', array(
			'hotkeys_highlight_first' => isset($_GET['hotkeys_highlight_first']),
			'hotkeys_highlight_last' => isset($_GET['hotkeys_highlight_last']),
			'replyApprove' => __( 'Approve and Reply' ),
			'reply' => __( 'Reply' )
		) );

		$scripts->add( 'xfn', "/nxt-admin/js/xfn$suffix.js", array('jquery'), '20110524', 1 );

		$scripts->add( 'postbox', "/nxt-admin/js/postbox$suffix.js", array('jquery-ui-sortable'), '20111009a', 1 );

		$scripts->add( 'post', "/nxt-admin/js/post$suffix.js", array('suggest', 'nxt-lists', 'postbox'), '20111124', 1 );
		$scripts->localize( 'post', 'postL10n', array(
			'ok' => __('OK'),
			'cancel' => __('Cancel'),
			'publishOn' => __('Publish on:'),
			'publishOnFuture' =>  __('Schedule for:'),
			'publishOnPast' => __('Published on:'),
			'showcomm' => __('Show more comments'),
			'endcomm' => __('No more comments found.'),
			'publish' => __('Publish'),
			'schedule' => __('Schedule'),
			'update' => __('Update'),
			'savePending' => __('Save as Pending'),
			'saveDraft' => __('Save Draft'),
			'private' => __('Private'),
			'public' => __('Public'),
			'publicSticky' => __('Public, Sticky'),
			'password' => __('Password Protected'),
			'privatelyPublished' => __('Privately Published'),
			'published' => __('Published')
		) );

		$scripts->add( 'link', "/nxt-admin/js/link$suffix.js", array('nxt-lists', 'postbox'), '20110524', 1 );

		$scripts->add( 'comment', "/nxt-admin/js/comment$suffix.js", array('jquery'), '20110429' );
		$scripts->add_data( 'comment', 'group', 1 );
		$scripts->localize( 'comment', 'commentL10n', array(
			'submittedOn' => __('Submitted on:')
		) );

		$scripts->add( 'admin-gallery', "/nxt-admin/js/gallery$suffix.js", array( 'jquery-ui-sortable' ), '20110930' );

		$scripts->add( 'admin-widgets', "/nxt-admin/js/widgets$suffix.js", array( 'jquery-ui-sortable', 'jquery-ui-draggable', 'jquery-ui-droppable' ), '20110925', 1 );

		$scripts->add( 'theme', "/nxt-admin/js/theme$suffix.js", array( 'thickbox' ), '20110118', 1 );

		$scripts->add( 'theme-preview', "/nxt-admin/js/theme-preview$suffix.js", array( 'thickbox', 'jquery' ), '20100407', 1 );

		$scripts->add( 'inline-edit-post', "/nxt-admin/js/inline-edit-post$suffix.js", array( 'jquery', 'suggest' ), '20111129', 1 );
		$scripts->localize( 'inline-edit-post', 'inlineEditL10n', array(
			'error' => __('Error while saving the changes.'),
			'ntdeltitle' => __('Remove From Bulk Edit'),
			'notitle' => __('(no title)')
		) );

		$scripts->add( 'inline-edit-tax', "/nxt-admin/js/inline-edit-tax$suffix.js", array( 'jquery' ), '20110609', 1 );
		$scripts->localize( 'inline-edit-tax', 'inlineEditL10n', array(
			'error' => __('Error while saving the changes.')
		) );

		$scripts->add( 'plugin-install', "/nxt-admin/js/plugin-install$suffix.js", array( 'jquery', 'thickbox' ), '20110113', 1 );
		$scripts->localize( 'plugin-install', 'plugininstallL10n', array(
			'plugin_information' => __('Plugin Information:'),
			'ays' => __('Are you sure you want to install this plugin?')
		) );

		$scripts->add( 'farbtastic', '/nxt-admin/js/farbtastic.js', array('jquery'), '1.2' );

		$scripts->add( 'dashboard', "/nxt-admin/js/dashboard$suffix.js", array( 'jquery', 'admin-comments', 'postbox' ), '20111123', 1 );

		$scripts->add( 'list-revisions', "/nxt-includes/js/nxt-list-revisions$suffix.js", null, '20091223' );

		$scripts->add( 'media', "/nxt-admin/js/media$suffix.js", array( 'jquery-ui-draggable' ), '20101022', 1 );

		$scripts->add( 'image-edit', "/nxt-admin/js/image-edit$suffix.js", array('jquery', 'json2', 'imgareaselect'), '20110927', 1 );
		$scripts->localize( 'image-edit', 'imageEditL10n', array(
			'error' => __( 'Could not load the preview image. Please reload the page and try again.' )
		));

		$scripts->add( 'set-post-thumbnail', "/nxt-admin/js/set-post-thumbnail$suffix.js", array( 'jquery' ), '20100518', 1 );
		$scripts->localize( 'set-post-thumbnail', 'setPostThumbnailL10n', array(
			'setThumbnail' => __( 'Use as featured image' ),
			'saving' => __( 'Saving...' ),
			'error' => __( 'Could not set that as the thumbnail image. Try a different attachment.' ),
			'done' => __( 'Done' )
		) );

		// Navigation Menus
		$scripts->add( 'nav-menu', "/nxt-admin/js/nav-menu$suffix.js", array('jquery-ui-sortable'), '20111115' );
		$scripts->localize( 'nav-menu', 'navMenuL10n', array(
			'noResultsFound' => _x('No results found.', 'search results'),
			'warnDeleteMenu' => __( "You are about to permanently delete this menu. \n 'Cancel' to stop, 'OK' to delete." ),
			'saveAlert' => __('The changes you made will be lost if you navigate away from this page.')
		) );

		$scripts->add( 'custom-background', "/nxt-admin/js/custom-background$suffix.js", array('farbtastic'), '20110511', 1 );
	}
}

/**
 * Assign default styles to $styles object.
 *
 * Nothing is returned, because the $styles parameter is passed by reference.
 * Meaning that whatever object is passed will be updated without having to
 * reassign the variable that was passed back to the same value. This saves
 * memory.
 *
 * Adding default styles is not the only task, it also assigns the base_url
 * property, the default version, and text direction for the object.
 *
 * @since 2.6.0
 *
 * @param object $styles
 */
function nxt_default_styles( &$styles ) {
	// This checks to see if site_url() returns something and if it does not
	// then it assigns $guess_url to nxt_guess_url(). Strange format, but it works.
	if ( ! $guessurl = site_url() )
		$guessurl = nxt_guess_url();

	$styles->base_url = $guessurl;
	$styles->content_url = defined('nxt_CONTENT_URL')? nxt_CONTENT_URL : '';
	$styles->default_version = get_bloginfo( 'version' );
	$styles->text_direction = function_exists( 'is_rtl' ) && is_rtl() ? 'rtl' : 'ltr';
	$styles->default_dirs = array('/nxt-admin/', '/nxt-includes/css/');

	$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '.dev' : '';

	$rtl_styles = array( 'nxt-admin', 'ie', 'media', 'admin-bar', 'nxtlink' );
	// Any rtl stylesheets that don't have a .dev version for ltr
	$no_suffix = array( 'farbtastic' );

	$styles->add( 'nxt-admin', "/nxt-admin/css/nxt-admin$suffix.css", array(), '20111208' );

	$styles->add( 'ie', "/nxt-admin/css/ie$suffix.css", array(), '20111130' );
	$styles->add_data( 'ie', 'conditional', 'lte IE 7' );

	// all colors stylesheets need to have the same query strings (cache manifest compat)
	$colors_version = '20111206';

	// Register "meta" stylesheet for admin colors. All colors-* style sheets should have the same version string.
	$styles->add( 'colors', true, array('nxt-admin'), $colors_version );

	// do not refer to these directly, the right one is queued by the above "meta" colors handle
	$styles->add( 'colors-fresh', "/nxt-admin/css/colors-fresh$suffix.css", array('nxt-admin'), $colors_version );
	$styles->add( 'colors-classic', "/nxt-admin/css/colors-classic$suffix.css", array('nxt-admin'), $colors_version );

	$styles->add( 'media', "/nxt-admin/css/media$suffix.css", array(), '20111119' );
	$styles->add( 'install', "/nxt-admin/css/install$suffix.css", array(), '20111117' ); // Readme as well
	$styles->add( 'thickbox', '/nxt-includes/js/thickbox/thickbox.css', array(), '20111117' );
	$styles->add( 'farbtastic', '/nxt-admin/css/farbtastic.css', array(), '1.3u1' );
	$styles->add( 'jcrop', '/nxt-includes/js/jcrop/jquery.Jcrop.css', array(), '0.9.8' );
	$styles->add( 'imgareaselect', '/nxt-includes/js/imgareaselect/imgareaselect.css', array(), '0.9.1' );
	$styles->add( 'admin-bar', "/nxt-includes/css/admin-bar$suffix.css", array(), '20111209' );
	$styles->add( 'nxt-jquery-ui-dialog', "/nxt-includes/css/jquery-ui-dialog$suffix.css", array(), '20111107' );
	$styles->add( 'editor-buttons', "/nxt-includes/css/editor-buttons$suffix.css", array(), '20111114' );
	$styles->add( 'nxt-pointer', "/nxt-includes/css/nxt-pointer$suffix.css", array(), '20111205' );

	foreach ( $rtl_styles as $rtl_style ) {
		$styles->add_data( $rtl_style, 'rtl', true );
		if ( $suffix && ! in_array( $rtl_style, $no_suffix ) )
			$styles->add_data( $rtl_style, 'suffix', $suffix );
	}
}

/**
 * Reorder JavaScript scripts array to place prototype before jQuery.
 *
 * @since 2.3.1
 *
 * @param array $js_array JavaScript scripts array
 * @return array Reordered array, if needed.
 */
function nxt_prototype_before_jquery( $js_array ) {
	if ( false === $jquery = array_search( 'jquery', $js_array, true ) )
		return $js_array;

	if ( false === $prototype = array_search( 'prototype', $js_array, true ) )
		return $js_array;

	if ( $prototype < $jquery )
		return $js_array;

	unset($js_array[$prototype]);

	array_splice( $js_array, $jquery, 0, 'prototype' );

	return $js_array;
}

/**
 * Load localized data on print rather than initialization.
 *
 * These localizations require information that may not be loaded even by init.
 *
 * @since 2.5.0
 */
function nxt_just_in_time_script_localization() {

	nxt_localize_script( 'autosave', 'autosaveL10n', array(
		'autosaveInterval' => AUTOSAVE_INTERVAL,
		'savingText' => __('Saving Draft&#8230;'),
		'saveAlert' => __('The changes you made will be lost if you navigate away from this page.')
	) );

}

/**
 * Administration Screen CSS for changing the styles.
 *
 * If installing the 'nxt-admin/' directory will be replaced with './'.
 *
 * The $_nxt_admin_css_colors global manages the Administration Screens CSS
 * stylesheet that is loaded. The option that is set is 'admin_color' and is the
 * color and key for the array. The value for the color key is an object with
 * a 'url' parameter that has the URL path to the CSS file.
 *
 * The query from $src parameter will be appended to the URL that is given from
 * the $_nxt_admin_css_colors array value URL.
 *
 * @since 2.6.0
 * @uses $_nxt_admin_css_colors
 *
 * @param string $src Source URL.
 * @param string $handle Either 'colors' or 'colors-rtl'.
 * @return string URL path to CSS stylesheet for Administration Screens.
 */
function nxt_style_loader_src( $src, $handle ) {
	if ( defined('nxt_INSTALLING') )
		return preg_replace( '#^nxt-admin/#', './', $src );

	if ( 'colors' == $handle || 'colors-rtl' == $handle ) {
		global $_nxt_admin_css_colors;
		$color = get_user_option('admin_color');

		if ( empty($color) || !isset($_nxt_admin_css_colors[$color]) )
			$color = 'fresh';

		$color = $_nxt_admin_css_colors[$color];
		$parsed = parse_url( $src );
		$url = $color->url;

		if ( defined('SCRIPT_DEBUG') && SCRIPT_DEBUG )
			$url = preg_replace('/.css$|.css(?=\?)/', '.dev.css', $url);

		if ( isset($parsed['query']) && $parsed['query'] ) {
			nxt_parse_str( $parsed['query'], $qv );
			$url = add_query_arg( $qv, $url );
		}

		return $url;
	}

	return $src;
}

/**
 * Prints the script queue in the HTML head on admin pages.
 *
 * Postpones the scripts that were queued for the footer.
 * print_footer_scripts() is called in the footer to print these scripts.
 *
 * @since 2.8
 * @see nxt_print_scripts()
 */
function print_head_scripts() {
	global $nxt_scripts, $concatenate_scripts;

	if ( ! did_action('nxt_print_scripts') )
		do_action('nxt_print_scripts');

	if ( !is_a($nxt_scripts, 'nxt_Scripts') )
		$nxt_scripts = new nxt_Scripts();

	script_concat_settings();
	$nxt_scripts->do_concat = $concatenate_scripts;
	$nxt_scripts->do_head_items();

	if ( apply_filters('print_head_scripts', true) )
		_print_scripts();

	$nxt_scripts->reset();
	return $nxt_scripts->done;
}

/**
 * Prints the scripts that were queued for the footer or too late for the HTML head.
 *
 * @since 2.8
 */
function print_footer_scripts() {
	global $nxt_scripts, $concatenate_scripts;

	if ( !is_a($nxt_scripts, 'nxt_Scripts') )
		return array(); // No need to run if not instantiated.

	script_concat_settings();
	$nxt_scripts->do_concat = $concatenate_scripts;
	$nxt_scripts->do_footer_items();

	if ( apply_filters('print_footer_scripts', true) )
		_print_scripts();

	$nxt_scripts->reset();
	return $nxt_scripts->done;
}

/**
 * @internal use
 */
function _print_scripts() {
	global $nxt_scripts, $compress_scripts;

	$zip = $compress_scripts ? 1 : 0;
	if ( $zip && defined('ENFORCE_GZIP') && ENFORCE_GZIP )
		$zip = 'gzip';

	if ( !empty($nxt_scripts->concat) ) {

		if ( !empty($nxt_scripts->print_code) ) {
			echo "\n<script type='text/javascript'>\n";
			echo "/* <![CDATA[ */\n"; // not needed in HTML 5
			echo $nxt_scripts->print_code;
			echo "/* ]]> */\n";
			echo "</script>\n";
		}

		$ver = md5("$nxt_scripts->concat_version");
		$src = $nxt_scripts->base_url . "/nxt-admin/load-scripts.php?c={$zip}&load=" . trim($nxt_scripts->concat, ', ') . "&ver=$ver";
		echo "<script type='text/javascript' src='" . esc_attr($src) . "'></script>\n";
	}

	if ( !empty($nxt_scripts->print_html) )
		echo $nxt_scripts->print_html;
}

/**
 * Prints the script queue in the HTML head on the front end.
 *
 * Postpones the scripts that were queued for the footer.
 * nxt_print_footer_scripts() is called in the footer to print these scripts.
 *
 * @since 2.8
 */
function nxt_print_head_scripts() {
	if ( ! did_action('nxt_print_scripts') )
		do_action('nxt_print_scripts');

	global $nxt_scripts;

	if ( !is_a($nxt_scripts, 'nxt_Scripts') )
		return array(); // no need to run if nothing is queued

	return print_head_scripts();
}

/**
 * Private, for use in *_footer_scripts hooks
 *
 * @since 3.3
 */
function _nxt_footer_scripts() {
	print_late_styles();
	print_footer_scripts();
}

/**
 * Hooks to print the scripts and styles in the footer.
 *
 * @since 2.8
 */
function nxt_print_footer_scripts() {
	do_action('nxt_print_footer_scripts');
}

/**
 * Wrapper for do_action('nxt_enqueue_scripts')
 *
 * Allows plugins to queue scripts for the front end using nxt_enqueue_script().
 * Runs first in nxt_head() where all is_home(), is_page(), etc. functions are available.
 *
 * @since 2.8
 */
function nxt_enqueue_scripts() {
	do_action('nxt_enqueue_scripts');
}

/**
 * Prints the styles queue in the HTML head on admin pages.
 *
 * @since 2.8
 */
function print_admin_styles() {
	global $nxt_styles, $concatenate_scripts, $compress_css;

	if ( !is_a($nxt_styles, 'nxt_Styles') )
		$nxt_styles = new nxt_Styles();

	script_concat_settings();
	$nxt_styles->do_concat = $concatenate_scripts;
	$zip = $compress_css ? 1 : 0;
	if ( $zip && defined('ENFORCE_GZIP') && ENFORCE_GZIP )
		$zip = 'gzip';

	$nxt_styles->do_items(false);

	if ( apply_filters('print_admin_styles', true) )
		_print_styles();

	$nxt_styles->reset();
	return $nxt_styles->done;
}

/**
 * Prints the styles that were queued too late for the HTML head.
 *
 * @since 3.3
 */
function print_late_styles() {
	global $nxt_styles, $concatenate_scripts;

	if ( !is_a($nxt_styles, 'nxt_Styles') )
		return;

	$nxt_styles->do_concat = $concatenate_scripts;
	$nxt_styles->do_footer_items();

	if ( apply_filters('print_late_styles', true) )
		_print_styles();

	$nxt_styles->reset();
	return $nxt_styles->done;
}

/**
 * @internal use
 */
function _print_styles() {
	global $nxt_styles, $compress_css;

	$zip = $compress_css ? 1 : 0;
	if ( $zip && defined('ENFORCE_GZIP') && ENFORCE_GZIP )
		$zip = 'gzip';

	if ( !empty($nxt_styles->concat) ) {
		$dir = $nxt_styles->text_direction;
		$ver = md5("$nxt_styles->concat_version{$dir}");
		$href = $nxt_styles->base_url . "/nxt-admin/load-styles.php?c={$zip}&dir={$dir}&load=" . trim($nxt_styles->concat, ', ') . "&ver=$ver";
		echo "<link rel='stylesheet' href='" . esc_attr($href) . "' type='text/css' media='all' />\n";

		if ( !empty($nxt_styles->print_code) ) {
			echo "<style type='text/css'>\n";
			echo $nxt_styles->print_code;
			echo "\n</style>\n";
		}
	}

	if ( !empty($nxt_styles->print_html) )
		echo $nxt_styles->print_html;
}

/**
 * Determine the concatenation and compression settings for scripts and styles.
 *
 * @since 2.8
 */
function script_concat_settings() {
	global $concatenate_scripts, $compress_scripts, $compress_css;

	$compressed_output = ( ini_get('zlib.output_compression') || 'ob_gzhandler' == ini_get('output_handler') );

	if ( ! isset($concatenate_scripts) ) {
		$concatenate_scripts = defined('CONCATENATE_SCRIPTS') ? CONCATENATE_SCRIPTS : true;
		if ( ! is_admin() || ( defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ) )
			$concatenate_scripts = false;
	}

	if ( ! isset($compress_scripts) ) {
		$compress_scripts = defined('COMPRESS_SCRIPTS') ? COMPRESS_SCRIPTS : true;
		if ( $compress_scripts && ( ! get_site_option('can_compress_scripts') || $compressed_output ) )
			$compress_scripts = false;
	}

	if ( ! isset($compress_css) ) {
		$compress_css = defined('COMPRESS_CSS') ? COMPRESS_CSS : true;
		if ( $compress_css && ( ! get_site_option('can_compress_scripts') || $compressed_output ) )
			$compress_css = false;
	}
}

add_action( 'nxt_default_scripts', 'nxt_default_scripts' );
add_filter( 'nxt_print_scripts', 'nxt_just_in_time_script_localization' );
add_filter( 'print_scripts_array', 'nxt_prototype_before_jquery' );

add_action( 'nxt_default_styles', 'nxt_default_styles' );
add_filter( 'style_loader_src', 'nxt_style_loader_src', 10, 2 );
