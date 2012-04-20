<?php
class WikiDashboardWidget {
	function WikiDashboardWidget() {
		$this->WikiHelper = new WikiHelpers();
	}
	
	function dashboard_widget_function() {
	    global $nxtdb;
	    $posts = $nxtdb->get_results($nxtdb->prepare("select * from $nxtdb->posts where ID in (
	                    select post_id from $nxtdb->postmeta where
	                    meta_key = 'wiki_page' and meta_value = 1)
	                    or post_type in ('wiki') order by post_modified desc limit 5"));
		include(nxtWIKI_FILE_PATH.'/views/dashboard_widget.php');
	}
	
	function dashboard_widget_hook() {
		nxt_add_dashboard_widget(
			'nxtw_dashboard_widget', 
			'Recent contributions to Wiki', 
			array($this,'dashboard_widget_function')
		);
	}
}
?>