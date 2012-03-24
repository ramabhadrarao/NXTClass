<?php
/**
 * Includes all of the NXTClass Administration API files.
 *
 * @package NXTClass
 * @subpackage Administration
 */

/** NXTClass Bookmark Administration API */
require_once(ABSPATH . 'nxt-admin/includes/bookmark.php');

/** NXTClass Comment Administration API */
require_once(ABSPATH . 'nxt-admin/includes/comment.php');

/** NXTClass Administration File API */
require_once(ABSPATH . 'nxt-admin/includes/file.php');

/** NXTClass Image Administration API */
require_once(ABSPATH . 'nxt-admin/includes/image.php');

/** NXTClass Media Administration API */
require_once(ABSPATH . 'nxt-admin/includes/media.php');

/** NXTClass Import Administration API */
require_once(ABSPATH . 'nxt-admin/includes/import.php');

/** NXTClass Misc Administration API */
require_once(ABSPATH . 'nxt-admin/includes/misc.php');

/** NXTClass Plugin Administration API */
require_once(ABSPATH . 'nxt-admin/includes/plugin.php');

/** NXTClass Post Administration API */
require_once(ABSPATH . 'nxt-admin/includes/post.php');

/** NXTClass Administration Screen API */
require_once(ABSPATH . 'nxt-admin/includes/screen.php');

/** NXTClass Taxonomy Administration API */
require_once(ABSPATH . 'nxt-admin/includes/taxonomy.php');

/** NXTClass Template Administration API */
require_once(ABSPATH . 'nxt-admin/includes/template.php');

/** NXTClass List Table Administration API and base class */
require_once(ABSPATH . 'nxt-admin/includes/class-nxt-list-table.php');
require_once(ABSPATH . 'nxt-admin/includes/list-table.php');

/** NXTClass Theme Administration API */
require_once(ABSPATH . 'nxt-admin/includes/theme.php');

/** NXTClass User Administration API */
require_once(ABSPATH . 'nxt-admin/includes/user.php');

/** NXTClass Update Administration API */
require_once(ABSPATH . 'nxt-admin/includes/update.php');

/** NXTClass Deprecated Administration API */
require_once(ABSPATH . 'nxt-admin/includes/deprecated.php');

/** NXTClass Multisite support API */
if ( is_multisite() ) {
	require_once(ABSPATH . 'nxt-admin/includes/ms.php');
	require_once(ABSPATH . 'nxt-admin/includes/ms-deprecated.php');
}

?>
