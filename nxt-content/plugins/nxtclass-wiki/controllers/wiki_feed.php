<?php
class WikiFeed {
	/**
	 * Add new feed to NXTClass
	 * @global <type> $nxt_rewrite
	 */
	function add_feed() {
	    if (function_exists('load_plugin_textdomain')) {
	        $plugin_dir = basename(dirname(__FILE__));
	        load_plugin_textdomain('nxtclass_wiki', '', $plugin_dir);
	    }
	
	    add_feed('wiki', array($this,'create_feed'));
	    add_action('generate_rewrite_rules', array($this,'feed_rewrite_rules'));
	}
	
	/**
	 * Modify feed rewrite rules
	 * @param <type> $nxt_rewrite
	 */
	function feed_rewrite_rules( $nxt_rewrite ) {
	  $new_rules = array(
	    'feed/(.+)' => 'index.php?feed='.$nxt_rewrite->preg_index(1)
	  );
	  $nxt_rewrite->rules = $new_rules + $nxt_rewrite->rules;
	}
	
	/**
	 * This function creates the actual feed
	 */
	function create_feed() {
	    global $nxtdb, $nxt_version;
		if ($nxt_version < 3.0) {
			$where ="ID in (select post_id from $nxtdb->postmeta where
					meta_key = 'wiki_page' and meta_value = 1)
					and post_type in ('post','page')";
		} else {
			$where ="post_type = 'wiki' AND post_parent = ''";
		}
	    
	    $posts = $nxtdb->get_results($nxtdb->prepare("select * from $nxtdb->posts where $where
	                    order by post_modified desc"));
	
	 	include(nxtWIKI_FILE_PATH.'/views/feed.php');
	 }

}
?>