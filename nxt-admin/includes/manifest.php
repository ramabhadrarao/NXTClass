<?php

if ( !defined('ABSPATH') )
	exit;

require(ABSPATH . 'nxt-includes/version.php');

$man_version = md5( $tinymce_version . $manifest_version );
$mce_ver = "ver=$tinymce_version";

/**
 * Retrieve list of all cacheable nxt files
 *
 * Array format: file, version (optional), bool (whether to use src and set ignoreQuery, defaults to true)
 */
function &get_manifest() {
	global $mce_ver;

	$files = array(
		array('images/align-center.png'),
		array('images/align-left.png'),
		array('images/align-none.png'),
		array('images/align-right.png'),
		array('images/archive-link.png'),
		array('images/blue-grad.png'),
		array('images/bubble_bg.gif'),
		array('images/bubble_bg-rtl.gif'),
		array('images/button-grad.png'),
		array('images/button-grad-active.png'),
		array('images/comment-grey-bubble.png'),
		array('images/date-button.gif'),
		array('images/ed-bg.gif'),
		array('images/fade-butt.png'),
		array('images/fav.png'),
		array('images/fav-arrow.gif'),
		array('images/fav-arrow-rtl.gif'),
		array('images/generic.png'),
		array('images/gray-grad.png'),
		array('images/icons32.png'),
		array('images/icons32-vs.png'),
		array('images/list.png'),
		array('images/nxtspin_light.gif'),
		array('images/nxtspin_dark.gif'),
		array('images/logo.gif'),
		array('images/logo-ghost.png'),
		array('images/logo-login.gif'),
		array('images/media-button-image.gif'),
		array('images/media-button-music.gif'),
		array('images/media-button-other.gif'),
		array('images/media-button-video.gif'),
		array('images/menu.png'),
		array('images/menu-vs.png'),
		array('images/menu-arrows.gif'),
		array('images/menu-bits.gif'),
		array('images/menu-bits-rtl.gif'),
		array('images/menu-dark.gif'),
		array('images/menu-dark-rtl.gif'),
		array('images/no.png'),
		array('images/required.gif'),
		array('images/resize.gif'),
		array('images/screen-options-right.gif'),
		array('images/screen-options-right-up.gif'),
		array('images/se.png'),
		array('images/star.gif'),
		array('images/toggle-arrow.gif'),
		array('images/toggle-arrow-rtl.gif'),
		array('images/white-grad.png'),
		array('images/white-grad-active.png'),
		array('images/nxtclass-logo.png'),
		array('images/nxt-logo.png'),
		array('images/xit.gif'),
		array('images/yes.png'),
		array('../nxt-includes/images/crystal/archive.png'),
		array('../nxt-includes/images/crystal/audio.png'),
		array('../nxt-includes/images/crystal/code.png'),
		array('../nxt-includes/images/crystal/default.png'),
		array('../nxt-includes/images/crystal/document.png'),
		array('../nxt-includes/images/crystal/interactive.png'),
		array('../nxt-includes/images/crystal/text.png'),
		array('../nxt-includes/images/crystal/video.png'),
		array('../nxt-includes/images/crystal/spreadsheet.png'),
		array('../nxt-includes/images/rss.png'),
		array('../nxt-includes/images/blank.gif'),
		array('../nxt-includes/images/upload.png'),
		array('../nxt-includes/js/thickbox/loadingAnimation.gif'),
		array('../nxt-includes/js/thickbox/tb-close.png'),
	);

	if ( @is_file('../nxt-includes/js/tinymce/tiny_mce.js') ) :
	$mce = array(
		array('../nxt-includes/js/tinymce/nxt-tinymce.php', $mce_ver),

		array('../nxt-includes/js/tinymce/tiny_mce.js', $mce_ver),
		array('../nxt-includes/js/tinymce/langs/nxt-langs-en.js', $mce_ver),
		array('../nxt-includes/js/tinymce/utils/mctabs.js', $mce_ver),
		array('../nxt-includes/js/tinymce/utils/validate.js', $mce_ver),
		array('../nxt-includes/js/tinymce/utils/form_utils.js', $mce_ver),
		array('../nxt-includes/js/tinymce/utils/editable_selects.js', $mce_ver),
		array('../nxt-includes/js/tinymce/tiny_mce_popup.js', $mce_ver),

		array('../nxt-includes/js/tinymce/themes/advanced/editor_template.js', $mce_ver),
		array('../nxt-includes/js/tinymce/themes/advanced/source_editor.htm', $mce_ver),
		array('../nxt-includes/js/tinymce/themes/advanced/anchor.htm', $mce_ver),
		array('../nxt-includes/js/tinymce/themes/advanced/image.htm', $mce_ver),
		array('../nxt-includes/js/tinymce/themes/advanced/link.htm', $mce_ver),
		array('../nxt-includes/js/tinymce/themes/advanced/color_picker.htm', $mce_ver),
		array('../nxt-includes/js/tinymce/themes/advanced/charmap.htm', $mce_ver),
		array('../nxt-includes/js/tinymce/themes/advanced/js/color_picker.js', $mce_ver),
		array('../nxt-includes/js/tinymce/themes/advanced/js/charmap.js', $mce_ver),
		array('../nxt-includes/js/tinymce/themes/advanced/js/image.js', $mce_ver),
		array('../nxt-includes/js/tinymce/themes/advanced/js/link.js', $mce_ver),
		array('../nxt-includes/js/tinymce/themes/advanced/js/source_editor.js', $mce_ver),
		array('../nxt-includes/js/tinymce/themes/advanced/js/anchor.js', $mce_ver),
		array('../nxt-includes/js/tinymce/themes/advanced/skins/nxt_theme/ui.css', $mce_ver),
		array('../nxt-includes/js/tinymce/themes/advanced/skins/nxt_theme/content.css', $mce_ver),
		array('../nxt-includes/js/tinymce/themes/advanced/skins/nxt_theme/dialog.css', $mce_ver),

		array('../nxt-includes/js/tinymce/plugins/fullscreen/editor_plugin.js', $mce_ver),
		array('../nxt-includes/js/tinymce/plugins/fullscreen/fullscreen.htm', $mce_ver),

		array('../nxt-includes/js/tinymce/plugins/inlinepopups/editor_plugin.js', $mce_ver),
		array('../nxt-includes/js/tinymce/plugins/inlinepopups/template.htm', $mce_ver),
		array('../nxt-includes/js/tinymce/plugins/inlinepopups/skins/clearlooks2/window.css', $mce_ver),

		array('../nxt-includes/js/tinymce/plugins/media/editor_plugin.js', $mce_ver),
		array('../nxt-includes/js/tinymce/plugins/media/js/media.js', $mce_ver),
		array('../nxt-includes/js/tinymce/plugins/media/media.htm', $mce_ver),
		array('../nxt-includes/js/tinymce/plugins/media/css/content.css', $mce_ver),
		array('../nxt-includes/js/tinymce/plugins/media/css/media.css', $mce_ver),

		array('../nxt-includes/js/tinymce/plugins/paste/editor_plugin.js', $mce_ver),
		array('../nxt-includes/js/tinymce/plugins/paste/js/pasteword.js', $mce_ver),
		array('../nxt-includes/js/tinymce/plugins/paste/js/pastetext.js', $mce_ver),
		array('../nxt-includes/js/tinymce/plugins/paste/pasteword.htm', $mce_ver),
		array('../nxt-includes/js/tinymce/plugins/paste/blank.htm', $mce_ver),
		array('../nxt-includes/js/tinymce/plugins/paste/pastetext.htm', $mce_ver),

		array('../nxt-includes/js/tinymce/plugins/safari/editor_plugin.js', $mce_ver),

		array('../nxt-includes/js/tinymce/plugins/spellchecker/editor_plugin.js', $mce_ver),
		array('../nxt-includes/js/tinymce/plugins/spellchecker/css/content.css', $mce_ver),

		array('../nxt-includes/js/tinymce/plugins/tabfocus/editor_plugin.js', $mce_ver),

		array('../nxt-includes/js/tinymce/plugins/nxtclass/editor_plugin.js', $mce_ver),
		array('../nxt-includes/js/tinymce/plugins/nxtclass/css/content.css', $mce_ver),

		array('../nxt-includes/js/tinymce/plugins/nxteditimage/editor_plugin.js', $mce_ver),
		array('../nxt-includes/js/tinymce/plugins/nxteditimage/editimage.html', $mce_ver),
		array('../nxt-includes/js/tinymce/plugins/nxteditimage/js/editimage.js', $mce_ver),
		array('../nxt-includes/js/tinymce/plugins/nxteditimage/css/editimage.css', $mce_ver),
		array('../nxt-includes/js/tinymce/plugins/nxteditimage/css/editimage-rtl.css', $mce_ver),

		array('../nxt-includes/js/tinymce/plugins/nxtgallery/editor_plugin.js', $mce_ver),

		array('../nxt-includes/js/tinymce/themes/advanced/img/icons.gif'),
		array('../nxt-includes/js/tinymce/themes/advanced/img/colorpicker.jpg'),
		array('../nxt-includes/js/tinymce/themes/advanced/img/fm.gif'),
		array('../nxt-includes/js/tinymce/themes/advanced/img/gotmoxie.png'),
		array('../nxt-includes/js/tinymce/themes/advanced/img/sflogo.png'),
		array('../nxt-includes/js/tinymce/themes/advanced/skins/nxt_theme/img/fade-butt.png'),
		array('../nxt-includes/js/tinymce/themes/advanced/skins/nxt_theme/img/tabs.gif'),
		array('../nxt-includes/images/down_arrow.gif'),
		array('../nxt-includes/js/tinymce/themes/advanced/skins/default/img/progress.gif'),
		array('../nxt-includes/js/tinymce/themes/advanced/skins/default/img/menu_check.gif'),
		array('../nxt-includes/js/tinymce/themes/advanced/skins/default/img/menu_arrow.gif'),
		array('../nxt-includes/js/tinymce/plugins/inlinepopups/skins/clearlooks2/img/drag.gif'),
		array('../nxt-includes/js/tinymce/plugins/inlinepopups/skins/clearlooks2/img/corners.gif'),
		array('../nxt-includes/js/tinymce/plugins/inlinepopups/skins/clearlooks2/img/buttons.gif'),
		array('../nxt-includes/js/tinymce/plugins/inlinepopups/skins/clearlooks2/img/horizontal.gif'),
		array('../nxt-includes/js/tinymce/plugins/inlinepopups/skins/clearlooks2/img/alert.gif'),
		array('../nxt-includes/js/tinymce/plugins/inlinepopups/skins/clearlooks2/img/button.gif'),
		array('../nxt-includes/js/tinymce/plugins/inlinepopups/skins/clearlooks2/img/confirm.gif'),
		array('../nxt-includes/js/tinymce/plugins/inlinepopups/skins/clearlooks2/img/vertical.gif'),
		array('../nxt-includes/js/tinymce/plugins/media/img/flash.gif'),
		array('../nxt-includes/js/tinymce/plugins/media/img/quicktime.gif'),
		array('../nxt-includes/js/tinymce/plugins/media/img/realmedia.gif'),
		array('../nxt-includes/js/tinymce/plugins/media/img/shockwave.gif'),
		array('../nxt-includes/js/tinymce/plugins/media/img/windowsmedia.gif'),
		array('../nxt-includes/js/tinymce/plugins/media/img/trans.gif'),
		array('../nxt-includes/js/tinymce/plugins/spellchecker/img/wline.gif'),
		array('../nxt-includes/js/tinymce/plugins/nxtclass/img/more.gif'),
		array('../nxt-includes/js/tinymce/plugins/nxtclass/img/more_bug.gif'),
		array('../nxt-includes/js/tinymce/plugins/nxtclass/img/page.gif'),
		array('../nxt-includes/js/tinymce/plugins/nxtclass/img/page_bug.gif'),
		array('../nxt-includes/js/tinymce/plugins/nxtclass/img/toolbars.gif'),
		array('../nxt-includes/js/tinymce/plugins/nxtclass/img/help.gif'),
		array('../nxt-includes/js/tinymce/plugins/nxtclass/img/image.gif'),
		array('../nxt-includes/js/tinymce/plugins/nxtclass/img/media.gif'),
		array('../nxt-includes/js/tinymce/plugins/nxtclass/img/video.gif'),
		array('../nxt-includes/js/tinymce/plugins/nxtclass/img/audio.gif'),
		array('../nxt-includes/js/tinymce/plugins/nxteditimage/img/image.png'),
		array('../nxt-includes/js/tinymce/plugins/nxteditimage/img/delete.png'),
		array('../nxt-includes/js/tinymce/plugins/nxtgallery/img/delete.png'),
		array('../nxt-includes/js/tinymce/plugins/nxtgallery/img/edit.png'),
		array('../nxt-includes/js/tinymce/plugins/nxtgallery/img/gallery.png')
	);
	$files = array_merge($files, $mce);
	endif;

	return $files;
}
