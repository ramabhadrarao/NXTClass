<?php
class WikiAdmin {
	
	function __construct() {
		$this->WikiAdmin();
	}
	
	function WikiAdmin() {
		$this->WikiHelper = new WikiHelpers();
	}
	
	function check_option($option, $index, $val) {
		if (isset($option[$index]) && $option[$index] == $val)
			echo 'checked="checked"';
	}
	
	function check_meta($post, $index, $val) {
		if (get_post_meta($post, $index, true) == $val)
			echo 'checked="checked"';
	}
	
	function register_options_page() {
		
		$page = add_options_page( 
			'Wiki Options', 	//Options page title
			'Wiki Options', 	//"
			'switch_themes', 	//Permissions
			'nxtw-options', 		//Slug
			array($this,'options_page') 	//Callback
		);
		//add_action('admin_print_scripts-'.$page,'scc_post_order_scripts'); //In case it needs scripts
		//add_action('admin_print_styles-'.$page,'scc_post_order_styles'); //In case it needs styles
		register_setting('nxtw_options_group','nxtw_options'); //We're only going to register one option and store serialized data in it
	}
	
	function upgrade_check() {
		if ( get_option( 'numberOfRevisions' ) != false ) {
			return true;
		} else {
			$wiki = get_role('wiki_editor');			
			if ( $wiki != null) {
				if ($wiki->has_cap('edit_posts') ) {
					return true;
				}	
			} else {
				if ($wiki == null) {
					add_role( 'wiki_editor', 'Wiki Editor', array('read' => true) );
				}
				return false;
			}
		}
	}
	
	function options_page() {
		global $nxt_version;
		$nxtw_options = get_option('nxtw_options');
		include(nxtWIKI_FILE_PATH.'/views/options_page.php');
	}
	
	function upgrade_wiki_editor() {
		global $nxt_roles;
		$wiki = get_role('wiki_editor');
		if ($wiki->has_cap('edit_posts')) {
			remove_role('wiki_editor');
		}
		echo "Succesfully upgraded Wiki Editor role";
	}
	
	function upgrade() {
		//Alternate form in case we're upgrading.
		
		global $nxt_version;
		
		$nxtw_options = get_option('nxtw_options');
		$test = get_posts('post_type=wiki');
		if ( $nxt_version >= 3.0 && empty( $test ) ) {
			$old_wikis = get_pages('meta_key=_wiki_page&meta_value=1');
			foreach($old_wikis as $wiki) {
				$wiki->post_type = 'wiki';
				$wiki->ID = null;
				if (nxt_insert_post($wiki) != false) {
					echo "<p>".__('Wiki page')." ".$wiki->post_title." ".__('successfully upgraded to Wiki post type.')."</p><br />";
					nxt_delete_post($wiki->ID);
				}
			}
		}
		
		$this->upgrade_wiki_editor();
	
		if( !isset($nxtw_options['number_of_revisions']) && get_option('numberOfRevisions') != false ) {
			echo '<input type="hidden" name="nxtw_options[number_of_revisions]" value="'.get_option('numberOfRevisions').'" />';
		} elseif (empty($nxtw_options['number_of_revisions'])) {
			echo '<input type="hidden" name="nxtw_options[number_of_revisions]" value="5" />';
		}
		
		delete_option('numberOfRevisions');
	
		if( !isset($nxtw_options['email_admins']) && get_option('wiki_email_admins') != false ) {
			echo '<input type="hidden" name="nxtw_options[email_admins]" value="'.get_option('wiki_email_admins').'" />';
		} elseif (empty($nxtw_options['email_admins'])) {
			echo '<input type="hidden" name="nxtw_options[email_admins]" value="0" />';
		}
		
		delete_option('wiki_email_admins');
		
		if( !isset($nxtw_options['show_toc_onfrontpage']) && get_option('wiki_show_toc_onfrontpage') != false ) {
			echo '<input type="hidden" name="nxtw_options[show_toc_onfrontpage]" value="'.get_option('wiki_show_toc_onfrontpage').'" />';
		} elseif (empty($nxtw_options['show_toc_onfrontpage'])) {
			echo '<input type="hidden" name="nxtw_options[show_toc_onfrontpage]" value="0" />';
		}
		
		delete_option('wiki_show_toc_onfrontpage');
		
		if( !isset($nxtw_options['cron_email']) && get_option('wiki_cron_email') != false ) {
			echo '<input type="hidden" name="nxtw_options[cron_email]" value="'.get_option('wiki_cron_email').'" />';
		} elseif (empty($nxtw_options['cron_email'])) {
			echo '<input type="hidden" name="nxtw_options[cron_email]" value="0" />';
		}
		
		delete_option('wiki_cron_email');
		
		echo '<input type="hidden" name="nxtw_options[nxtw_upgrade]" value="done_gone_and_upgraded" />';
		
		echo '
		<tr>
			<td><input class="button-primary" type="submit" value="'.__('Finish Upgrade').'" /></td>
		</tr>
		';
	}
	
	//On page update/edit
	
	function convert_pages_recursively($id) {
		$children = get_posts('post_type=any&post_parent='.$id.'&status=publish&numberposts=-1');
		if (!empty($children)) {
			foreach ($children as $child) {
				$child->post_type = 'wiki';
				$child->post_status = 'publish';
				nxt_update_post($child);
				$this->convert_pages_recursively($child->ID);
			}
		}
	}
	
	function replace_current_with_pending($id) {
		//$revision = get_posts('include='.$id.'&post_status=pending');
		//var_dump($revision[0])
		
		if(!isset($_POST['nxtw_is_admin']))
			return;
		
		if(!isset($_POST['nxtw_change_to_wiki']))
			unset($GLOBALS['nxtw_prevent_recursion']);
			
		global $nxt_version;
		
		if($nxt_version < 3.0) {
			if(isset($_POST['nxtw_is_wiki']) && $_POST['nxtw_is_wiki'] == "true" ):
				update_post_meta($id, '_wiki_page', 1);
			else:
				delete_post_meta($id, '_wiki_page');
			endif;
		}
		
		if($this->WikiHelper->is_wiki('check_no_post',$id)) {
			if(isset( $_POST['nxtw_toc']) && ($_POST['nxtw_toc'] == "true" ) ):
				update_post_meta($id, '_wiki_page_toc', 1);
			else:
				delete_post_meta($id, '_wiki_page_toc');
			endif;
				
			if(isset($_POST['nxtw_approve_revision']) && $_POST['nxtw_approve_revision'] == "true" ) {
				$_POST['nxtw_approve_revision'] = null; //Prevent recursion!
				$revision = get_post($id);
				//var_dump($revision);
				$n_post = array();
				$n_post['ID'] = $revision->post_parent;
				$n_post['post_content'] = $revision->post_content;
				nxt_update_post($n_post);
			}
		}
		
		if ($nxt_version >= 3.0 && isset($_POST['nxtw_change_to_wiki']) && !isset($GLOBALS['nxtw_prevent_recursion'])) {
			$GLOBALS['nxtw_prevent_recursion'] = true;
			$id_we_are_changing = $_POST['nxtw_change_wiki_id'];
			$update_post = get_post($id_we_are_changing, 'ARRAY_A');
			//The hackiest hack that ever hacked
			if ( !empty($id_we_are_changing) )
				$this->convert_pages_recursively($id_we_are_changing);
				
			$update_post['post_type'] = 'wiki';
			$update_post['post_status'] = 'publish';
			$new = nxt_update_post($update_post);
			nxt_redirect( get_edit_post_link($new, 'go_to_it') );
		}
	
		//echo print_r($_POST, true).get_option('wiki_email_admins');
	}	
	
	///BUH
	
	
	/* Use the admin_menu action to define the custom boxes */
	
	
	/* Use the save_post action to do something with the data entered */
	//add_action('save_post', 'myplugin_save_postdata');
	
	
	
	//Hook functions into AJAX here as well
	
	
	
	/* Adds a custom section to the "advanced" Post and Page edit screens */
	function add_custom_box() {
	    //Wordpress 2.6 + -- this is the only one we need
	    global $nxt_version;
	    if ($nxt_version < 3.0) {
		    add_meta_box( 'nxtw_meta_box', __( 'Wiki Options', 'nxt-wiki' ), 
		                array($this, 'meta_box_inner'), 'page', 'side', 'high' );
		} else {
			add_meta_box( 'nxtw_meta_box', __( 'Wiki Options', 'nxt-wiki' ), 
		                array($this, 'meta_box_inner'), 'wiki', 'side', 'high' );
	
			add_meta_box( 'nxtw_meta_box', __( 'Wiki Options', 'nxt-wiki' ), 
		                array($this, 'meta_box_inner_pages'), 'page', 'side', 'high' );
		}
	}
	   
	/* Prints the inner fields for the custom post/page section */
	function meta_box_inner() {
		echo '<input type="hidden" name="nxtw_is_admin" value="1" />';
		global $nxt_version;
		if($nxt_version < 3.0) { 
		?>
			<h5><?php _e('Wiki Page'); ?></h5>	
			<input type="checkbox" <?php $this->check_meta($_GET['post'], '_wiki_page', 1); ?> name="nxtw_is_wiki" value="true" />
			<label for="nxtw_is_wiki"><?php _e('This is a Wiki page. Logged in users can edit its content.'); ?></label>
	
		<?php  
		}
		
		if($this->WikiHelper->is_wiki('check_no_post',@$_GET['post'])) {
		?>
			<h5><?php _e('Wiki Table of Contents'); ?></h5>	
			<input type="checkbox" <?php $this->check_meta(@$_GET['post'], '_wiki_page_toc', 1); ?> name="nxtw_toc" value="true" />
			<label for="nxtw_toc"><?php _e('Show table of contents'); ?></label>
			
			<br />
			
			<?php if($this->WikiHelper->is_wiki('check_post_parent' , @$_GET['post']) ) { ?>
				<h5><?php _e('Approve Revision'); ?></h5>	
				<input type="checkbox" name="nxtw_approve_revision" value="true" />
				<label for="nxtw_approve_revision"><?php _e('Approve this revision'); ?></label>
			
			<?php }
		}
	}
	
	function meta_box_inner_pages() {
		echo '<input type="hidden" name="nxtw_is_admin" value="1" />';
		global $nxt_version;
	?>
			<h5><?php _e('Wiki Page'); ?></h5>	
			<input type="checkbox" name="nxtw_change_to_wiki" value="true" />
			<label for="nxtw_change_to_wiki"><?php _e('Convert this page and all of its subpages to Wikis.'); ?></label>
			<input type="hidden" name="nxtw_change_wiki_id" value="<?php echo $_GET['post']; ?>" />
	<?php  
	
	}

}
?>