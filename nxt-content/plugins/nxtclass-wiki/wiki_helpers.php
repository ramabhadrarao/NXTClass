<?php
class WikiHelpers {
	function get_author($post) {
		$tmp = get_userdata($post->post_author);
		
		if ($tmp->ID > 0):
			return $tmp->display_name;
		else:
			$anon_meta = get_post_meta($post->ID, '_nxtw_anon_meta', true);
			return 'anonymous ('.$anon_meta['ip'].', '.$anon_meta['hostname'].')';
		endif;
	}
	
	function is_wiki($switch,$input = null) {
		global $nxt_version, $post;
		if ($switch == 'front_end_check') {
			if ($nxt_version < 3.0) {
				if (get_post_meta($post->ID,'_wiki_page',true) == 1)
					return true;
				else
					return false;
			} else {
				if ($post->post_type == 'wiki')
					return true;
				else
					return false;
			}
		} elseif ($switch == 'check_no_post') {
			if ($nxt_version < 3.0) {
				if (get_post_meta($input,'_wiki_page',true) == 1)
					return true;
				else
					return false;
			} else {
				$post_to_check = get_post($input);
				if ($post_to_check->post_type == 'wiki')
					return true;
				else
					return false;
			}
		} elseif ($switch == 'check_post_parent') {
			
			$post = get_post($input);
			
			if ($post->post_parent != 0)
				return false;
			else
				return false;
			
		} else {
			return false;
		}
		return false;
	}
	
	function is_restricted() {
		$nxtw_options = get_option('nxtw_options');
		if ( isset($nxtw_options['restrict_edits']) && $nxtw_options['restrict_edits'] == 1 ):
			if ( current_user_can('edit_wiki') )
				return false;
			else
				return true;
		else:
			return false;
		endif;
	}
}
?>