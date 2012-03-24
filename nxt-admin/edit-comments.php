<?php
/**
 * Edit Comments Administration Screen.
 *
 * @package NXTClass
 * @subpackage Administration
 */

/** NXTClass Administration Bootstrap */
require_once('./admin.php');
if ( !current_user_can('edit_posts') )
	nxt_die(__('Cheatin&#8217; uh?'));

$nxt_list_table = _get_list_table('nxt_Comments_List_Table');
$pagenum = $nxt_list_table->get_pagenum();

$doaction = $nxt_list_table->current_action();

if ( $doaction ) {
	check_admin_referer( 'bulk-comments' );

	if ( 'delete_all' == $doaction && !empty( $_REQUEST['pagegen_timestamp'] ) ) {
		$comment_status = $nxtdb->escape( $_REQUEST['comment_status'] );
		$delete_time = $nxtdb->escape( $_REQUEST['pagegen_timestamp'] );
		$comment_ids = $nxtdb->get_col( "SELECT comment_ID FROM $nxtdb->comments WHERE comment_approved = '$comment_status' AND '$delete_time' > comment_date_gmt" );
		$doaction = 'delete';
	} elseif ( isset( $_REQUEST['delete_comments'] ) ) {
		$comment_ids = $_REQUEST['delete_comments'];
		$doaction = ( $_REQUEST['action'] != -1 ) ? $_REQUEST['action'] : $_REQUEST['action2'];
	} elseif ( isset( $_REQUEST['ids'] ) ) {
		$comment_ids = array_map( 'absint', explode( ',', $_REQUEST['ids'] ) );
	} elseif ( nxt_get_referer() ) {
		nxt_safe_redirect( nxt_get_referer() );
		exit;
	}

	$approved = $unapproved = $spammed = $unspammed = $trashed = $untrashed = $deleted = 0;

	$redirect_to = remove_query_arg( array( 'trashed', 'untrashed', 'deleted', 'spammed', 'unspammed', 'approved', 'unapproved', 'ids' ), nxt_get_referer() );
	$redirect_to = add_query_arg( 'paged', $pagenum, $redirect_to );

	foreach ( $comment_ids as $comment_id ) { // Check the permissions on each
		if ( !current_user_can( 'edit_comment', $comment_id ) )
			continue;

		switch ( $doaction ) {
			case 'approve' :
				nxt_set_comment_status( $comment_id, 'approve' );
				$approved++;
				break;
			case 'unapprove' :
				nxt_set_comment_status( $comment_id, 'hold' );
				$unapproved++;
				break;
			case 'spam' :
				nxt_spam_comment( $comment_id );
				$spammed++;
				break;
			case 'unspam' :
				nxt_unspam_comment( $comment_id );
				$unspammed++;
				break;
			case 'trash' :
				nxt_trash_comment( $comment_id );
				$trashed++;
				break;
			case 'untrash' :
				nxt_untrash_comment( $comment_id );
				$untrashed++;
				break;
			case 'delete' :
				nxt_delete_comment( $comment_id );
				$deleted++;
				break;
		}
	}

	if ( $approved )
		$redirect_to = add_query_arg( 'approved', $approved, $redirect_to );
	if ( $unapproved )
		$redirect_to = add_query_arg( 'unapproved', $unapproved, $redirect_to );
	if ( $spammed )
		$redirect_to = add_query_arg( 'spammed', $spammed, $redirect_to );
	if ( $unspammed )
		$redirect_to = add_query_arg( 'unspammed', $unspammed, $redirect_to );
	if ( $trashed )
		$redirect_to = add_query_arg( 'trashed', $trashed, $redirect_to );
	if ( $untrashed )
		$redirect_to = add_query_arg( 'untrashed', $untrashed, $redirect_to );
	if ( $deleted )
		$redirect_to = add_query_arg( 'deleted', $deleted, $redirect_to );
	if ( $trashed || $spammed )
		$redirect_to = add_query_arg( 'ids', join( ',', $comment_ids ), $redirect_to );

	nxt_safe_redirect( $redirect_to );
	exit;
} elseif ( ! empty( $_GET['_nxt_http_referer'] ) ) {
	 nxt_redirect( remove_query_arg( array( '_nxt_http_referer', '_nxtnonce' ), stripslashes( $_SERVER['REQUEST_URI'] ) ) );
	 exit;
}

$nxt_list_table->prepare_items();

nxt_enqueue_script('admin-comments');
enqueue_comment_hotkeys_js();

if ( $post_id )
	$title = sprintf(__('Comments on &#8220;%s&#8221;'), nxt_html_excerpt(_draft_or_post_title($post_id), 50));
else
	$title = __('Comments');

add_screen_option( 'per_page', array('label' => _x( 'Comments', 'comments per page (screen options)' )) );

get_current_screen()->add_help_tab( array(
'id'		=> 'overview',
'title'		=> __('Overview'),
'content'	=>
	'<p>' . __( 'You can manage comments made on your site similar to the way you manage posts and other content. This screen is customizable in the same ways as other management screens, and you can act on comments using the on-hover action links or the Bulk Actions.' ) . '</p>'
) );
get_current_screen()->add_help_tab( array(
'id'		=> 'moderating-comments',
'title'		=> __('Moderating Comments'),
'content'	=>
	'<ul>' .
		'<li>' . __( 'A yellow row means the comment is waiting for you to moderate it.' ) . '</li>' .
		'<li>' . __( 'In the <strong>Author</strong> column, in addition to the author&#8217;s name, email address, and blog URL, the commenter&#8217;s IP address is shown. Clicking on this link will show you all the comments made from this IP address.' ) . '</li>' .
		'<li>' . __( 'In the <strong>Comment</strong> column, above each comment it says &#8220;Submitted on,&#8221; followed by the date and time the comment was left on your site. Clicking on the date/time link will take you to that comment on your live site. Hovering over any comment gives you options to approve, reply (and approve), quick edit, edit, spam mark, or trash that comment.' ) . '</li>' .
		'<li>' . __( 'In the <strong>In Response To</strong> column, there are three elements. The text is the name of the post that inspired the comment, and links to the post editor for that entry. The View Post link leads to that post on your live site. The small bubble with the number in it shows how many comments that post has received. If the bubble is gray, you have moderated all comments for that post. If it is blue, there are pending comments. Clicking the bubble will filter the comments screen to show only comments on that post.' ) . '</li>' .
		'<li>' . __( 'Many people take advantage of keyboard shortcuts to moderate their comments more quickly. Use the link to the side to learn more.' ) . '</li>' .
	'</ul>'
) );

get_current_screen()->set_help_sidebar(
	'<p><strong>' . __( 'For more information:' ) . '</strong></p>' .
	'<p>' . __( '<a href="http://codex.nxtclass.org/Administration_Screens#Comments" target="_blank">Documentation on Comments</a>' ) . '</p>' .
	'<p>' . __( '<a href="http://codex.nxtclass.org/Comment_Spam" target="_blank">Documentation on Comment Spam</a>' ) . '</p>' .
	'<p>' . __( '<a href="http://codex.nxtclass.org/Keyboard_Shortcuts" target="_blank">Documentation on Keyboard Shortcuts</a>' ) . '</p>' .
	'<p>' . __( '<a href="http://nxtclass.org/support/" target="_blank">Support Forums</a>' ) . '</p>'
);

require_once('./admin-header.php');
?>

<div class="wrap">
<?php screen_icon(); ?>
<h2><?php
if ( $post_id )
	echo sprintf(__('Comments on &#8220;%s&#8221;'),
		sprintf('<a href="%s">%s</a>',
			get_edit_post_link($post_id),
			nxt_html_excerpt(_draft_or_post_title($post_id), 50)
		)
	);
else
	echo __('Comments');

if ( isset($_REQUEST['s']) && $_REQUEST['s'] )
	printf( '<span class="subtitle">' . sprintf( __( 'Search results for &#8220;%s&#8221;' ), nxt_html_excerpt( esc_html( stripslashes( $_REQUEST['s'] ) ), 50 ) ) . '</span>' ); ?>
</h2>

<?php
if ( isset( $_REQUEST['error'] ) ) {
	$error = (int) $_REQUEST['error'];
	$error_msg = '';
	switch ( $error ) {
		case 1 :
			$error_msg = __( 'Oops, no comment with this ID.' );
			break;
		case 2 :
			$error_msg = __( 'You are not allowed to edit comments on this post.' );
			break;
	}
	if ( $error_msg )
		echo '<div id="moderated" class="error"><p>' . $error_msg . '</p></div>';
}

if ( isset($_REQUEST['approved']) || isset($_REQUEST['deleted']) || isset($_REQUEST['trashed']) || isset($_REQUEST['untrashed']) || isset($_REQUEST['spammed']) || isset($_REQUEST['unspammed']) || isset($_REQUEST['same']) ) {
	$approved  = isset( $_REQUEST['approved']  ) ? (int) $_REQUEST['approved']  : 0;
	$deleted   = isset( $_REQUEST['deleted']   ) ? (int) $_REQUEST['deleted']   : 0;
	$trashed   = isset( $_REQUEST['trashed']   ) ? (int) $_REQUEST['trashed']   : 0;
	$untrashed = isset( $_REQUEST['untrashed'] ) ? (int) $_REQUEST['untrashed'] : 0;
	$spammed   = isset( $_REQUEST['spammed']   ) ? (int) $_REQUEST['spammed']   : 0;
	$unspammed = isset( $_REQUEST['unspammed'] ) ? (int) $_REQUEST['unspammed'] : 0;
	$same      = isset( $_REQUEST['same'] )      ? (int) $_REQUEST['same']      : 0;

	if ( $approved > 0 || $deleted > 0 || $trashed > 0 || $untrashed > 0 || $spammed > 0 || $unspammed > 0 || $same > 0 ) {
		if ( $approved > 0 )
			$messages[] = sprintf( _n( '%s comment approved', '%s comments approved', $approved ), $approved );

		if ( $spammed > 0 ) {
			$ids = isset($_REQUEST['ids']) ? $_REQUEST['ids'] : 0;
			$messages[] = sprintf( _n( '%s comment marked as spam.', '%s comments marked as spam.', $spammed ), $spammed ) . ' <a href="' . esc_url( nxt_nonce_url( "edit-comments.php?doaction=undo&action=unspam&ids=$ids", "bulk-comments" ) ) . '">' . __('Undo') . '</a><br />';
		}

		if ( $unspammed > 0 )
			$messages[] = sprintf( _n( '%s comment restored from the spam', '%s comments restored from the spam', $unspammed ), $unspammed );

		if ( $trashed > 0 ) {
			$ids = isset($_REQUEST['ids']) ? $_REQUEST['ids'] : 0;
			$messages[] = sprintf( _n( '%s comment moved to the Trash.', '%s comments moved to the Trash.', $trashed ), $trashed ) . ' <a href="' . esc_url( nxt_nonce_url( "edit-comments.php?doaction=undo&action=untrash&ids=$ids", "bulk-comments" ) ) . '">' . __('Undo') . '</a><br />';
		}

		if ( $untrashed > 0 )
			$messages[] = sprintf( _n( '%s comment restored from the Trash', '%s comments restored from the Trash', $untrashed ), $untrashed );

		if ( $deleted > 0 )
			$messages[] = sprintf( _n( '%s comment permanently deleted', '%s comments permanently deleted', $deleted ), $deleted );

		if ( $same > 0 && $comment = get_comment( $same ) ) {
			switch ( $comment->comment_approved ) {
				case '1' :
					$messages[] = __('This comment is already approved.') . ' <a href="' . esc_url( admin_url( "comment.php?action=editcomment&c=$same" ) ) . '">' . __( 'Edit comment' ) . '</a>';
					break;
				case 'trash' :
					$messages[] = __( 'This comment is already in the Trash.' ) . ' <a href="' . esc_url( admin_url( 'edit-comments.php?comment_status=trash' ) ) . '"> ' . __( 'View Trash' ) . '</a>';
					break;
				case 'spam' :
					$messages[] = __( 'This comment is already marked as spam.' ) . ' <a href="' . esc_url( admin_url( "comment.php?action=editcomment&c=$same" ) ) . '">' . __( 'Edit comment' ) . '</a>';
					break;
			}
		}

		echo '<div id="moderated" class="updated"><p>' . implode( "<br/>\n", $messages ) . '</p></div>';
	}
}
?>

<?php $nxt_list_table->views(); ?>

<form id="comments-form" action="" method="get">

<?php $nxt_list_table->search_box( __( 'Search Comments' ), 'comment' ); ?>

<?php if ( $post_id ) : ?>
<input type="hidden" name="p" value="<?php echo esc_attr( intval( $post_id ) ); ?>" />
<?php endif; ?>
<input type="hidden" name="comment_status" value="<?php echo esc_attr($comment_status); ?>" />
<input type="hidden" name="pagegen_timestamp" value="<?php echo esc_attr(current_time('mysql', 1)); ?>" />

<input type="hidden" name="_total" value="<?php echo esc_attr( $nxt_list_table->get_pagination_arg('total_items') ); ?>" />
<input type="hidden" name="_per_page" value="<?php echo esc_attr( $nxt_list_table->get_pagination_arg('per_page') ); ?>" />
<input type="hidden" name="_page" value="<?php echo esc_attr( $nxt_list_table->get_pagination_arg('page') ); ?>" />

<?php if ( isset($_REQUEST['paged']) ) { ?>
	<input type="hidden" name="paged" value="<?php echo esc_attr( absint( $_REQUEST['paged'] ) ); ?>" />
<?php } ?>

<?php $nxt_list_table->display(); ?>
</form>
</div>

<div id="ajax-response"></div>

<?php
nxt_comment_reply('-1', true, 'detail');
nxt_comment_trashnotice();
include('./admin-footer.php'); ?>
