<?php
/**
 * Manage link administration actions.
 *
 * This page is accessed by the link management pages and handles the forms and
 * AJAX processes for link actions.
 *
 * @package NXTClass
 * @subpackage Administration
 */

/** Load NXTClass Administration Bootstrap */
require_once ('admin.php');

nxt_reset_vars(array('action', 'cat_id', 'linkurl', 'name', 'image', 'description', 'visible', 'target', 'category', 'link_id', 'submit', 'order_by', 'links_show_cat_id', 'rating', 'rel', 'notes', 'linkcheck[]'));

if ( ! current_user_can('manage_links') )
	nxt_die( __('You do not have sufficient permissions to edit the links for this site.') );

if ( !empty($_POST['deletebookmarks']) )
	$action = 'deletebookmarks';
if ( !empty($_POST['move']) )
	$action = 'move';
if ( !empty($_POST['linkcheck']) )
	$linkcheck = $_POST['linkcheck'];

$this_file = admin_url('link-manager.php');

switch ($action) {
	case 'deletebookmarks' :
		check_admin_referer('bulk-bookmarks');

		//for each link id (in $linkcheck[]) change category to selected value
		if (count($linkcheck) == 0) {
			nxt_redirect($this_file);
			exit;
		}

		$deleted = 0;
		foreach ($linkcheck as $link_id) {
			$link_id = (int) $link_id;

			if ( nxt_delete_link($link_id) )
				$deleted++;
		}

		nxt_redirect("$this_file?deleted=$deleted");
		exit;
		break;

	case 'move' :
		check_admin_referer('bulk-bookmarks');

		//for each link id (in $linkcheck[]) change category to selected value
		if (count($linkcheck) == 0) {
			nxt_redirect($this_file);
			exit;
		}
		$all_links = join(',', $linkcheck);
		// should now have an array of links we can change
		//$q = $nxtdb->query("update $nxtdb->links SET link_category='$category' WHERE link_id IN ($all_links)");

		nxt_redirect($this_file);
		exit;
		break;

	case 'add' :
		check_admin_referer('add-bookmark');

		$redir = nxt_get_referer();
		if ( add_link() )
			$redir = add_query_arg( 'added', 'true', $redir );

		nxt_redirect( $redir );
		exit;
		break;

	case 'save' :
		$link_id = (int) $_POST['link_id'];
		check_admin_referer('update-bookmark_' . $link_id);

		edit_link($link_id);

		nxt_redirect($this_file);
		exit;
		break;

	case 'delete' :
		$link_id = (int) $_GET['link_id'];
		check_admin_referer('delete-bookmark_' . $link_id);

		nxt_delete_link($link_id);

		nxt_redirect($this_file);
		exit;
		break;

	case 'edit' :
		nxt_enqueue_script('link');
		nxt_enqueue_script('xfn');

		$parent_file = 'link-manager.php';
		$submenu_file = 'link-manager.php';
		$title = __('Edit Link');

		$link_id = (int) $_GET['link_id'];

		if (!$link = get_link_to_edit($link_id))
			nxt_die(__('Link not found.'));

		include ('edit-link-form.php');
		include ('admin-footer.php');
		break;

	default :
		break;
}
?>
