<?php
/**
 * NXTClass core upgrade functionality.
 *
 * @package NXTClass
 * @subpackage Administration
 * @since 2.7.0
 */

/**
 * Stores files to be deleted.
 *
 * @since 2.7.0
 * @global array $_old_files
 * @var array
 * @name $_old_files
 */
global $_old_files;

$_old_files = array(
'nxt-admin/bookmarklet.php',
'nxt-admin/css/upload.css',
'nxt-admin/css/upload-rtl.css',
'nxt-admin/css/press-this-ie.css',
'nxt-admin/css/press-this-ie-rtl.css',
'nxt-admin/edit-form.php',
'nxt-admin/link-import.php',
'nxt-admin/images/box-bg-left.gif',
'nxt-admin/images/box-bg-right.gif',
'nxt-admin/images/box-bg.gif',
'nxt-admin/images/box-butt-left.gif',
'nxt-admin/images/box-butt-right.gif',
'nxt-admin/images/box-butt.gif',
'nxt-admin/images/box-head-left.gif',
'nxt-admin/images/box-head-right.gif',
'nxt-admin/images/box-head.gif',
'nxt-admin/images/heading-bg.gif',
'nxt-admin/images/login-bkg-bottom.gif',
'nxt-admin/images/login-bkg-tile.gif',
'nxt-admin/images/notice.gif',
'nxt-admin/images/toggle.gif',
'nxt-admin/images/comment-stalk-classic.gif',
'nxt-admin/images/comment-stalk-fresh.gif',
'nxt-admin/images/comment-stalk-rtl.gif',
'nxt-admin/images/comment-pill.gif',
'nxt-admin/images/del.png',
'nxt-admin/images/media-button-gallery.gif',
'nxt-admin/images/media-buttons.gif',
'nxt-admin/images/tail.gif',
'nxt-admin/images/gear.png',
'nxt-admin/images/tab.png',
'nxt-admin/images/postbox-bg.gif',
'nxt-admin/includes/upload.php',
'nxt-admin/js/dbx-admin-key.js',
'nxt-admin/js/link-cat.js',
'nxt-admin/js/forms.js',
'nxt-admin/js/upload.js',
'nxt-admin/js/set-post-thumbnail-handler.js',
'nxt-admin/js/set-post-thumbnail-handler.dev.js',
'nxt-admin/js/page.js',
'nxt-admin/js/page.dev.js',
'nxt-admin/js/slug.js',
'nxt-admin/js/slug.dev.js',
'nxt-admin/profile-update.php',
'nxt-admin/templates.php',
'nxt-includes/images/audio.png',
'nxt-includes/images/css.png',
'nxt-includes/images/default.png',
'nxt-includes/images/doc.png',
'nxt-includes/images/exe.png',
'nxt-includes/images/html.png',
'nxt-includes/images/js.png',
'nxt-includes/images/pdf.png',
'nxt-includes/images/swf.png',
'nxt-includes/images/tar.png',
'nxt-includes/images/text.png',
'nxt-includes/images/video.png',
'nxt-includes/images/zip.png',
'nxt-includes/js/dbx.js',
'nxt-includes/js/fat.js',
'nxt-includes/js/list-manipulation.js',
'nxt-includes/js/jquery/jquery.dimensions.min.js',
'nxt-includes/js/tinymce/langs/en.js',
'nxt-includes/js/tinymce/plugins/autosave/editor_plugin_src.js',
'nxt-includes/js/tinymce/plugins/autosave/langs',
'nxt-includes/js/tinymce/plugins/directionality/images',
'nxt-includes/js/tinymce/plugins/directionality/langs',
'nxt-includes/js/tinymce/plugins/inlinepopups/css',
'nxt-includes/js/tinymce/plugins/inlinepopups/images',
'nxt-includes/js/tinymce/plugins/inlinepopups/jscripts',
'nxt-includes/js/tinymce/plugins/paste/images',
'nxt-includes/js/tinymce/plugins/paste/jscripts',
'nxt-includes/js/tinymce/plugins/paste/langs',
'nxt-includes/js/tinymce/plugins/spellchecker/classes/HttpClient.class.php',
'nxt-includes/js/tinymce/plugins/spellchecker/classes/TinyGoogleSpell.class.php',
'nxt-includes/js/tinymce/plugins/spellchecker/classes/TinyPspell.class.php',
'nxt-includes/js/tinymce/plugins/spellchecker/classes/TinyPspellShell.class.php',
'nxt-includes/js/tinymce/plugins/spellchecker/css/spellchecker.css',
'nxt-includes/js/tinymce/plugins/spellchecker/images',
'nxt-includes/js/tinymce/plugins/spellchecker/langs',
'nxt-includes/js/tinymce/plugins/spellchecker/tinyspell.php',
'nxt-includes/js/tinymce/plugins/nxtclass/images',
'nxt-includes/js/tinymce/plugins/nxtclass/langs',
'nxt-includes/js/tinymce/plugins/nxtclass/popups.css',
'nxt-includes/js/tinymce/plugins/nxtclass/nxtclass.css',
'nxt-includes/js/tinymce/plugins/nxthelp',
'nxt-includes/js/tinymce/themes/advanced/css',
'nxt-includes/js/tinymce/themes/advanced/images',
'nxt-includes/js/tinymce/themes/advanced/jscripts',
'nxt-includes/js/tinymce/themes/advanced/langs',
'nxt-includes/js/tinymce/tiny_mce_gzip.php',
'nxt-includes/js/nxt-ajax.js',
'nxt-admin/admin-db.php',
'nxt-admin/cat.js',
'nxt-admin/categories.js',
'nxt-admin/custom-fields.js',
'nxt-admin/dbx-admin-key.js',
'nxt-admin/edit-comments.js',
'nxt-admin/install-rtl.css',
'nxt-admin/install.css',
'nxt-admin/upgrade-schema.php',
'nxt-admin/upload-functions.php',
'nxt-admin/upload-rtl.css',
'nxt-admin/upload.css',
'nxt-admin/upload.js',
'nxt-admin/users.js',
'nxt-admin/widgets-rtl.css',
'nxt-admin/widgets.css',
'nxt-admin/xfn.js',
'nxt-includes/js/tinymce/license.html',
'nxt-admin/cat-js.php',
'nxt-admin/edit-form-ajax-cat.php',
'nxt-admin/execute-pings.php',
'nxt-admin/import/b2.php',
'nxt-admin/import/btt.php',
'nxt-admin/import/jkw.php',
'nxt-admin/inline-uploading.php',
'nxt-admin/link-categories.php',
'nxt-admin/list-manipulation.js',
'nxt-admin/list-manipulation.php',
'nxt-includes/comment-functions.php',
'nxt-includes/feed-functions.php',
'nxt-includes/functions-compat.php',
'nxt-includes/functions-formatting.php',
'nxt-includes/functions-post.php',
'nxt-includes/js/dbx-key.js',
'nxt-includes/js/tinymce/plugins/autosave/langs/cs.js',
'nxt-includes/js/tinymce/plugins/autosave/langs/sv.js',
'nxt-includes/js/tinymce/themes/advanced/editor_template_src.js',
'nxt-includes/links.php',
'nxt-includes/pluggable-functions.php',
'nxt-includes/template-functions-author.php',
'nxt-includes/template-functions-category.php',
'nxt-includes/template-functions-general.php',
'nxt-includes/template-functions-links.php',
'nxt-includes/template-functions-post.php',
'nxt-includes/nxt-l10n.php',
'nxt-admin/import-b2.php',
'nxt-admin/import-blogger.php',
'nxt-admin/import-greymatter.php',
'nxt-admin/import-livejournal.php',
'nxt-admin/import-mt.php',
'nxt-admin/import-rss.php',
'nxt-admin/import-textpattern.php',
'nxt-admin/quicktags.js',
'nxt-images/fade-butt.png',
'nxt-images/get-firefox.png',
'nxt-images/header-shadow.png',
'nxt-images/smilies',
'nxt-images/nxt-small.png',
'nxt-images/nxtminilogo.png',
'nxt.php',
'nxt-includes/gettext.php',
'nxt-includes/streams.php',
// MU
'nxt-admin/nxtmu-admin.php',
'nxt-admin/nxtmu-blogs.php',
'nxt-admin/nxtmu-edit.php',
'nxt-admin/nxtmu-options.php',
'nxt-admin/nxtmu-themes.php',
'nxt-admin/nxtmu-upgrade-site.php',
'nxt-admin/nxtmu-users.php',
'nxt-includes/nxtmu-default-filters.php',
'nxt-includes/nxtmu-functions.php',
'nxtmu-settings.php',
'index-install.php',
'README.txt',
'htaccess.dist',
'nxt-admin/css/mu-rtl.css',
'nxt-admin/css/mu.css',
'nxt-admin/images/site-admin.png',
'nxt-admin/includes/mu.php',
'nxt-includes/images/nxtclass-mu.png',
// 3.0
'nxt-admin/categories.php',
'nxt-admin/edit-category-form.php',
'nxt-admin/edit-page-form.php',
'nxt-admin/edit-pages.php',
'nxt-admin/images/nxt-logo.gif',
'nxt-admin/js/nxt-gears.dev.js',
'nxt-admin/js/nxt-gears.js',
'nxt-admin/options-misc.php',
'nxt-admin/page-new.php',
'nxt-admin/page.php',
'nxt-admin/rtl.css',
'nxt-admin/rtl.dev.css',
'nxt-admin/update-links.php',
'nxt-admin/nxt-admin.css',
'nxt-admin/nxt-admin.dev.css',
'nxt-includes/js/codepress',
'nxt-includes/js/jquery/autocomplete.dev.js',
'nxt-includes/js/jquery/interface.js',
'nxt-includes/js/jquery/autocomplete.js',
'nxt-includes/js/scriptaculous/prototype.js',
'nxt-includes/js/tinymce/nxt-tinymce.js',
'nxt-admin/import',
'nxt-admin/images/ico-edit.png',
'nxt-admin/images/fav-top.png',
'nxt-admin/images/ico-close.png',
'nxt-admin/images/admin-header-footer.png',
'nxt-admin/images/screen-options-left.gif',
'nxt-admin/images/ico-add.png',
'nxt-admin/images/browse-happy.gif',
'nxt-admin/images/ico-vienxtage.png',
// 3.1
'nxt-includes/js/tinymce/blank.htm',
'nxt-includes/js/tinymce/plugins/safari',
'nxt-admin/edit-link-categories.php',
'nxt-admin/edit-post-rows.php',
'nxt-admin/edit-attachment-rows.php',
'nxt-admin/link-category.php',
'nxt-admin/edit-link-category-form.php',
'nxt-admin/sidebar.php',
'nxt-admin/images/list-vs.png',
'nxt-admin/images/button-grad-vs.png',
'nxt-admin/images/button-grad-active-vs.png',
'nxt-admin/images/fav-arrow-vs.gif',
'nxt-admin/images/fav-arrow-vs-rtl.gif',
'nxt-admin/images/fav-top-vs.gif',
'nxt-admin/images/screen-options-right.gif',
'nxt-admin/images/screen-options-right-up.gif',
'nxt-admin/images/visit-site-button-grad-vs.gif',
'nxt-admin/images/visit-site-button-grad.gif',
'nxt-includes/classes.php',
// 3.2
'nxt-includes/default-embeds.php',
'nxt-includes/js/tinymce/plugins/nxtclass/img/more.gif',
'nxt-includes/js/tinymce/plugins/nxtclass/img/toolbars.gif',
'nxt-includes/js/tinymce/plugins/nxtclass/img/help.gif',
'nxt-includes/js/tinymce/themes/advanced/img/fm.gif',
'nxt-includes/js/tinymce/themes/advanced/img/sflogo.png',
'nxt-admin/js/list-table.js',
'nxt-admin/js/list-table.dev.js',
'nxt-admin/images/logo-login.gif',
'nxt-admin/images/star.gif',
// 3.3
'nxt-admin/css/colors-classic-rtl.css',
'nxt-admin/css/colors-classic-rtl.dev.css',
'nxt-admin/css/colors-fresh-rtl.css',
'nxt-admin/css/colors-fresh-rtl.dev.css',
'nxt-admin/css/dashboard-rtl.css',
'nxt-admin/css/dashboard-rtl.dev.css',
'nxt-admin/css/dashboard.css',
'nxt-admin/css/dashboard.dev.css',
'nxt-admin/css/farbtastic-rtl.css',
'nxt-admin/css/global-rtl.css',
'nxt-admin/css/global-rtl.dev.css',
'nxt-admin/css/global.css',
'nxt-admin/css/global.dev.css',
'nxt-admin/css/install-rtl.css',
'nxt-admin/css/install-rtl.dev.css',
'nxt-admin/css/login-rtl.css',
'nxt-admin/css/login-rtl.dev.css',
'nxt-admin/css/login.css',
'nxt-admin/css/login.dev.css',
'nxt-admin/css/ms.css',
'nxt-admin/css/ms.dev.css',
'nxt-admin/css/nav-menu-rtl.css',
'nxt-admin/css/nav-menu-rtl.dev.css',
'nxt-admin/css/nav-menu.css',
'nxt-admin/css/nav-menu.dev.css',
'nxt-admin/css/plugin-install-rtl.css',
'nxt-admin/css/plugin-install-rtl.dev.css',
'nxt-admin/css/plugin-install.css',
'nxt-admin/css/plugin-install.dev.css',
'nxt-admin/css/press-this-rtl.css',
'nxt-admin/css/press-this-rtl.dev.css',
'nxt-admin/css/press-this.css',
'nxt-admin/css/press-this.dev.css',
'nxt-admin/css/theme-editor-rtl.css',
'nxt-admin/css/theme-editor-rtl.dev.css',
'nxt-admin/css/theme-editor.css',
'nxt-admin/css/theme-editor.dev.css',
'nxt-admin/css/theme-install-rtl.css',
'nxt-admin/css/theme-install-rtl.dev.css',
'nxt-admin/css/theme-install.css',
'nxt-admin/css/theme-install.dev.css',
'nxt-admin/css/widgets-rtl.css',
'nxt-admin/css/widgets-rtl.dev.css',
'nxt-admin/css/widgets.css',
'nxt-admin/css/widgets.dev.css',
'nxt-admin/includes/internal-linking.php',
'nxt-includes/images/admin-bar-sprite-rtl.png',
'nxt-includes/js/jquery/ui.button.js',
'nxt-includes/js/jquery/ui.core.js',
'nxt-includes/js/jquery/ui.dialog.js',
'nxt-includes/js/jquery/ui.draggable.js',
'nxt-includes/js/jquery/ui.droppable.js',
'nxt-includes/js/jquery/ui.mouse.js',
'nxt-includes/js/jquery/ui.position.js',
'nxt-includes/js/jquery/ui.resizable.js',
'nxt-includes/js/jquery/ui.selectable.js',
'nxt-includes/js/jquery/ui.sortable.js',
'nxt-includes/js/jquery/ui.tabs.js',
'nxt-includes/js/jquery/ui.widget.js',
'nxt-includes/js/l10n.dev.js',
'nxt-includes/js/l10n.js',
'nxt-includes/js/tinymce/plugins/nxtlink/css',
'nxt-includes/js/tinymce/plugins/nxtlink/img',
'nxt-includes/js/tinymce/plugins/nxtlink/js',
'nxt-includes/js/tinymce/themes/advanced/img/nxticons.png',
'nxt-includes/js/tinymce/themes/advanced/skins/nxt_theme/img/butt2.png',
'nxt-includes/js/tinymce/themes/advanced/skins/nxt_theme/img/button_bg.png',
'nxt-includes/js/tinymce/themes/advanced/skins/nxt_theme/img/down_arrow.gif',
'nxt-includes/js/tinymce/themes/advanced/skins/nxt_theme/img/fade-butt.png',
'nxt-includes/js/tinymce/themes/advanced/skins/nxt_theme/img/separator.gif',
);

/**
 * Stores new files in nxt-content to copy
 *
 * The contents of this array indicate any new bundled plugins/themes which
 * should be installed with the NXTClass Upgrade. These items will not be
 * re-installed in future upgrades, this behaviour is controlled by the
 * introduced version present here being older than the current installed version.
 *
 * The content of this array should follow the following format:
 *  Filename (relative to nxt-content) => Introduced version
 * Directories should be noted by suffixing it with a trailing slash (/)
 *
 * @since 3.2.0
 * @global array $_new_bundled_files
 * @var array
 * @name $_new_bundled_files
 */
global $_new_bundled_files;

$_new_bundled_files = array(
'plugins/akismet/' => '2.0',
'themes/twentyten/' => '3.0',
'themes/twentyeleven/' => '3.2'
);

/**
 * Upgrade the core of NXTClass.
 *
 * This will create a .maintenance file at the base of the NXTClass directory
 * to ensure that people can not access the web site, when the files are being
 * copied to their locations.
 *
 * The files in the {@link $_old_files} list will be removed and the new files
 * copied from the zip file after the database is upgraded.
 *
 * The files in the {@link $_new_bundled_files} list will be added to the installation
 * if the version is greater than or equal to the old version being upgraded.
 *
 * The steps for the upgrader for after the new release is downloaded and
 * unzipped is:
 *   1. Test unzipped location for select files to ensure that unzipped worked.
 *   2. Create the .maintenance file in current NXTClass base.
 *   3. Copy new NXTClass directory over old NXTClass files.
 *   4. Upgrade NXTClass to new version.
 *     4.1. Copy all files/folders other than nxt-content
 *     4.2. Copy any language files to nxt_LANG_DIR (which may differ from nxt_CONTENT_DIR
 *     4.3. Copy any new bundled themes/plugins to their respective locations
 *   5. Delete new NXTClass directory path.
 *   6. Delete .maintenance file.
 *   7. Remove old files.
 *   8. Delete 'update_core' option.
 *
 * There are several areas of failure. For instance if PHP times out before step
 * 6, then you will not be able to access any portion of your site. Also, since
 * the upgrade will not continue where it left off, you will not be able to
 * automatically remove old files and remove the 'update_core' option. This
 * isn't that bad.
 *
 * If the copy of the new NXTClass over the old fails, then the worse is that
 * the new NXTClass directory will remain.
 *
 * If it is assumed that every file will be copied over, including plugins and
 * themes, then if you edit the default theme, you should rename it, so that
 * your changes remain.
 *
 * @since 2.7.0
 *
 * @param string $from New release unzipped path.
 * @param string $to Path to old NXTClass installation.
 * @return nxt_Error|null nxt_Error on failure, null on success.
 */
function update_core($from, $to) {
	global $nxt_filesystem, $_old_files, $_new_bundled_files, $nxtdb;

	@set_time_limit( 300 );

	$php_version    = phpversion();
	$mysql_version  = $nxtdb->db_version();
	$required_php_version = '5.2.4';
	$required_mysql_version = '5.0';
	$nxt_version = '1.1.0';
	$php_compat     = version_compare( $php_version, $required_php_version, '>=' );
	if ( file_exists( nxt_CONTENT_DIR . '/db.php' ) && empty( $nxtdb->is_mysql ) )
		$mysql_compat = true;
	else
		$mysql_compat = version_compare( $mysql_version, $required_mysql_version, '>=' );

	if ( !$mysql_compat || !$php_compat )
		$nxt_filesystem->delete($from, true);

	if ( !$mysql_compat && !$php_compat )
		return new nxt_Error( 'php_mysql_not_compatible', sprintf( __('The update cannot be installed because NXTClass %1$s requires PHP version %2$s or higher and MySQL version %3$s or higher. You are running PHP version %4$s and MySQL version %5$s.'), $nxt_version, $required_php_version, $required_mysql_version, $php_version, $mysql_version ) );
	elseif ( !$php_compat )
		return new nxt_Error( 'php_not_compatible', sprintf( __('The update cannot be installed because NXTClass %1$s requires PHP version %2$s or higher. You are running version %3$s.'), $nxt_version, $required_php_version, $php_version ) );
	elseif ( !$mysql_compat )
		return new nxt_Error( 'mysql_not_compatible', sprintf( __('The update cannot be installed because NXTClass %1$s requires MySQL version %2$s or higher. You are running version %3$s.'), $nxt_version, $required_mysql_version, $mysql_version ) );

	// Sanity check the unzipped distribution
	apply_filters('update_feedback', __('Verifying the unpacked files&#8230;'));
	$distro = '';
	$roots = array( '/nxtclass/', '/nxtclass-mu/' );
	foreach( $roots as $root ) {
		if ( $nxt_filesystem->exists($from . $root . 'readme.html') && $nxt_filesystem->exists($from . $root . 'nxt-includes/version.php') ) {
			$distro = $root;
			break;
		}
	}
	if ( !$distro ) {
		$nxt_filesystem->delete($from, true);
		return new nxt_Error('insane_distro', __('The update could not be unpacked') );
	}

	apply_filters('update_feedback', __('Installing the latest version&#8230;'));

	// Create maintenance file to signal that we are upgrading
	$maintenance_string = '<?php $upgrading = ' . time() . '; ?>';
	$maintenance_file = $to . '.maintenance';
	$nxt_filesystem->delete($maintenance_file);
	$nxt_filesystem->put_contents($maintenance_file, $maintenance_string, FS_CHMOD_FILE);

	// Copy new versions of nxt files into place.
	$result = _copy_dir($from . $distro, $to, array('nxt-content') );

	// Custom Content Directory needs updating now.
	// Copy Languages
	if ( !is_nxt_error($result) && $nxt_filesystem->is_dir($from . $distro . 'nxt-content/languages') ) {
		if ( nxt_LANG_DIR != ABSPATH . nxtINC . '/languages' || @is_dir(nxt_LANG_DIR) )
			$lang_dir = nxt_LANG_DIR;
		else
			$lang_dir = nxt_CONTENT_DIR . '/languages';

		if ( !@is_dir($lang_dir) && 0 === strpos($lang_dir, ABSPATH) ) { // Check the language directory exists first
			$nxt_filesystem->mkdir($to . str_replace(ABSPATH, '', $lang_dir), FS_CHMOD_DIR); // If it's within the ABSPATH we can handle it here, otherwise they're out of luck.
			clearstatcache(); // for FTP, Need to clear the stat cache
		}

		if ( @is_dir($lang_dir) ) {
			$nxt_lang_dir = $nxt_filesystem->find_folder($lang_dir);
			if ( $nxt_lang_dir )
				$result = copy_dir($from . $distro . 'nxt-content/languages/', $nxt_lang_dir);
		}
	}

	// Copy New bundled plugins & themes
	// This gives us the ability to install new plugins & themes bundled with future versions of NXTClass whilst avoiding the re-install upon upgrade issue.
	if ( !is_nxt_error($result) && ( ! defined('CORE_UPGRADE_SKIP_NEW_BUNDLED') || ! CORE_UPGRADE_SKIP_NEW_BUNDLED ) ) {
		$old_version = $GLOBALS['nxt_version']; // $nxt_version in local scope == new version
		foreach ( (array) $_new_bundled_files as $file => $introduced_version ) {
			// If $introduced version is greater than what the site was previously running
			if ( version_compare($introduced_version, $old_version, '>') ) {
				$directory = ('/' == $file[ strlen($file)-1 ]);
				list($type, $filename) = explode('/', $file, 2);

				if ( 'plugins' == $type )
					$dest = $nxt_filesystem->nxt_plugins_dir();
				elseif ( 'themes' == $type )
					$dest = trailingslashit($nxt_filesystem->nxt_themes_dir()); // Back-compat, ::nxt_themes_dir() did not return trailingslash'd pre-3.2
				else
					continue;

				if ( ! $directory ) {
					if ( $nxt_filesystem->exists($dest . $filename) )
						continue;

					if ( ! $nxt_filesystem->copy($from . $distro . 'nxt-content/' . $file, $dest . $filename, FS_CHMOD_FILE) )
						$result = new nxt_Error('copy_failed', __('Could not copy file.'), $dest . $filename);
				} else {
					if ( $nxt_filesystem->is_dir($dest . $filename) )
						continue;

					$nxt_filesystem->mkdir($dest . $filename, FS_CHMOD_DIR);
					$_result = copy_dir( $from . $distro . 'nxt-content/' . $file, $dest . $filename);
					if ( is_nxt_error($_result) ) //If a error occurs partway through this final step, keep the error flowing through, but keep process going.
						$result = $_result;
				}
			}
		} //end foreach
	}

	// Handle $result error from the above blocks
	if ( is_nxt_error($result) ) {
		$nxt_filesystem->delete($maintenance_file);
		$nxt_filesystem->delete($from, true);
		return $result;
	}

	// Remove old files
	foreach ( $_old_files as $old_file ) {
		$old_file = $to . $old_file;
		if ( !$nxt_filesystem->exists($old_file) )
			continue;
		$nxt_filesystem->delete($old_file, true);
	}

	// Upgrade DB with separate request
	apply_filters('update_feedback', __('Upgrading database&#8230;'));
	$db_upgrade_url = admin_url('upgrade.php?step=upgrade_db');
	nxt_remote_post($db_upgrade_url, array('timeout' => 60));

	// Remove working directory
	$nxt_filesystem->delete($from, true);

	// Force refresh of update information
	if ( function_exists('delete_site_transient') )
		delete_site_transient('update_core');
	else
		delete_option('update_core');

	// Remove maintenance file, we're done.
	$nxt_filesystem->delete($maintenance_file);

	// If we made it this far:
	do_action( '_core_updated_successfully', $nxt_version );

	return $nxt_version;
}

/**
 * Copies a directory from one location to another via the NXTClass Filesystem Abstraction.
 * Assumes that nxt_Filesystem() has already been called and setup.
 *
 * This is a temporary function for the 3.1 -> 3.2 upgrade only and will be removed in 3.3
 *
 * @ignore
 * @since 3.2.0
 * @see copy_dir()
 *
 * @param string $from source directory
 * @param string $to destination directory
 * @param array $skip_list a list of files/folders to skip copying
 * @return mixed nxt_Error on failure, True on success.
 */
function _copy_dir($from, $to, $skip_list = array() ) {
	global $nxt_filesystem;

	$dirlist = $nxt_filesystem->dirlist($from);

	$from = trailingslashit($from);
	$to = trailingslashit($to);

	$skip_regex = '';
	foreach ( (array)$skip_list as $key => $skip_file )
		$skip_regex .= preg_quote($skip_file, '!') . '|';

	if ( !empty($skip_regex) )
		$skip_regex = '!(' . rtrim($skip_regex, '|') . ')$!i';

	foreach ( (array) $dirlist as $filename => $fileinfo ) {
		if ( !empty($skip_regex) )
			if ( preg_match($skip_regex, $from . $filename) )
				continue;

		if ( 'f' == $fileinfo['type'] ) {
			if ( ! $nxt_filesystem->copy($from . $filename, $to . $filename, true, FS_CHMOD_FILE) ) {
				// If copy failed, chmod file to 0644 and try again.
				$nxt_filesystem->chmod($to . $filename, 0644);
				if ( ! $nxt_filesystem->copy($from . $filename, $to . $filename, true, FS_CHMOD_FILE) )
					return new nxt_Error('copy_failed', __('Could not copy file.'), $to . $filename);
			}
		} elseif ( 'd' == $fileinfo['type'] ) {
			if ( !$nxt_filesystem->is_dir($to . $filename) ) {
				if ( !$nxt_filesystem->mkdir($to . $filename, FS_CHMOD_DIR) )
					return new nxt_Error('mkdir_failed', __('Could not create directory.'), $to . $filename);
			}
			$result = _copy_dir($from . $filename, $to . $filename, $skip_list);
			if ( is_nxt_error($result) )
				return $result;
		}
	}
	return true;
}

/**
 * Redirect to the About NXTClass page after a successful upgrade.
 *
 * This function is only needed when the existing install is older than 3.3.0.
 *
 * @since 3.3.0
 *
 */
function _redirect_to_about_nxtclass( $new_version ) {
	global $nxt_version, $pagenow, $action;

	if ( version_compare( $nxt_version, '3.3', '>=' ) )
		return;

	// Ensure we only run this on the update-core.php page. nxt_update_core() could be called in other contexts.
	if ( 'update-core.php' != $pagenow )
		return;

 	if ( 'do-core-upgrade' != $action && 'do-core-reinstall' != $action )
 		return;

	// Load the updated default text localization domain for new strings
	load_default_textdomain();

	// See do_core_upgrade()
	show_message( __('NXTClass updated successfully') );
	show_message( '<span class="hide-if-no-js">' . sprintf( __( 'Welcome to NXTClass %1$s. You will be redirected to the About NXTClass screen. If not, click <a href="%s">here</a>.' ), $new_version, esc_url( admin_url( 'about.php?updated' ) ) ) . '</span>' );
	show_message( '<span class="hide-if-js">' . sprintf( __( 'Welcome to NXTClass %1$s. <a href="%2$s">Learn more</a>.' ), $new_version, esc_url( admin_url( 'about.php?updated' ) ) ) . '</span>' );
	echo '</div>';
	?>
<script type="text/javascript">
window.location = '<?php echo admin_url( 'about.php?updated' ); ?>';
</script>
	<?php

	// Include admin-footer.php and exit
	include(ABSPATH . 'nxt-admin/admin-footer.php');
	exit();
}
add_action( '_core_updated_successfully', '_redirect_to_about_nxtclass' );
