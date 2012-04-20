<?php
/*
Plugin Name:NXTClass Wiki
Plugin URI: http://nxtclass.org/extend/plugins/nxtclass-wiki/
Description: Add Wiki functionality to your nxtclass site.
Version: 1.0.2
Author: Dan Milward/Matthew Gerring
Author URI: http://www.instinct.co.nz
*/

class nxt_Wiki {
	function __construct() {
		$this->nxt_Wiki();
	}
	
	function nxt_Wiki() {
		global $nxt_version;
		/**
		* Todo: There is no need to guess the nxt-content folder any more...
		*/
		
		if ( !defined('nxt_CONTENT_URL') )
		    define( 'nxt_CONTENT_URL', get_option('siteurl') . '/nxt-content');
		if ( !defined('nxt_CONTENT_DIR') )
		    define( 'nxt_CONTENT_DIR', ABSPATH . 'nxt-content' );
		
		if (!defined('PLUGIN_URL'))
		    define('PLUGIN_URL', nxt_CONTENT_URL . '/plugins');
		if (!defined('PLUGIN_PATH'))
		    define('PLUGIN_PATH', nxt_CONTENT_DIR . '/plugins');
		
		define('nxtWIKI_FILE_PATH', dirname(__FILE__));
		define('nxtWIKI_DIR_NAME', basename(nxtWIKI_FILE_PATH));
		
		//include component controllers
		include(nxtWIKI_FILE_PATH.'/model/wiki_post_type.php');
		include(nxtWIKI_FILE_PATH.'/controllers/wiki_pages.php');
		include(nxtWIKI_FILE_PATH.'/controllers/wiki_notifications.php');
		include(nxtWIKI_FILE_PATH.'/controllers/wiki_feed.php');
		include(nxtWIKI_FILE_PATH.'/controllers/wiki_admin.php');
		include(nxtWIKI_FILE_PATH.'/controllers/wiki_dashboard_widget.php');
		include(nxtWIKI_FILE_PATH.'/controllers/wiki_user_contrib_widget.php');
		include(nxtWIKI_FILE_PATH.'/wiki_helpers.php');
		
		//include Wiki Parser class here so it doesn't get re-declared- fixes issue #4 on GitHub. Thanks Nexiom!
		include(nxtWIKI_FILE_PATH.'/lib/nxtw_wikiparser.php');
		
		//Flush rewrite rules on activation to enable siteurl.com/wiki feed url. Can't use activation hook b/c it comes too late (after init)
		if ( is_admin() && $_GET['activate'] && $_SERVER['SCRIPT_NAME'] == '/nxt-admin/plugins.php' )
			add_action( 'init', 'flush_rewrite_rules', 12 );
		
		
		//Enables Wiki Pages
		$WikiPostType = new WikiPostType();
		
		//Create classes for our components. This will be changed to allow filtering in a future release.
		$WikiPageController = new WikiPageController();
		$WikiNotifications = new WikiNotifications();
		$WikiFeed = new WikiFeed();
		$WikiAdmin = new WikiAdmin();
		$WikiDashboardWidget = new WikiDashboardWidget();
		
		//Version-specific actions and filters
		
		if ($nxt_version >= 3.0):
			//Register the post type
			add_action('init', array($WikiPostType,'register') );
			
			//Set permissions
			add_action('init', array($WikiPostType,'set_permissions') );
			
			//Make Table of Contents on by default for Wiki post type
			add_action('publish_wiki',array($WikiPageController,'set_toc'), 12);
			
			//Make Table of Contents on by default for pages marked as Wikis
			add_action('publish_page',array($WikiPageController,'set_toc'));
		else:
			//Make Table of Contents on by default for pages marked as Wikis
			add_action('publish_page',array($WikiPageController,'set_toc'));
			//Manage permissions for versions prior to 3.0
			add_filter('user_has_cap', array($WikiPostType, 'page_cap'), 100, 3);
		endif;
		
		//Front-end editor
		add_action('nxt', array($WikiPageController, 'set_query'));
		add_action('template_redirect', array($WikiPageController, 'invoke_editor'));
		add_action('init', array($WikiPageController, 'create_new_and_redirect'));
		add_action('nxt', array($WikiPageController, 'fake_page'));
		add_action('_nxt_put_post_revision', array($WikiPageController,'anon_meta_save_as_revision'), 10);
		
		//Ajax functions
		add_action('nxt_ajax_ajax_save',array($WikiPageController,'ajax_save'));
		add_action('nxt_ajax_nopriv_ajax_save',array($WikiPageController,'ajax_save'));
		
		//if JavaScript isn't available...
		if( !defined('DOING_AJAX') && isset($_POST['nxtw_editor_content']) )
			add_action('init',array($WikiPageController,'no_js_save'));
		
		//Notifications
		add_action('save_post', array($WikiNotifications,'page_edit_notification'));
		add_action('cron_email_hook', array($WikiNotifications,'cron_email'));
		add_filter('cron_schedules', array($WikiNotifications,'more_reccurences'));
		
		//Feed
		add_action('init', array($WikiFeed, 'add_feed'), 11);
		
		//Admin pages
		add_action('admin_menu', array($WikiAdmin,'register_options_page'));
		add_action('publish_wiki', array($WikiAdmin,'replace_current_with_pending'), 11);
		add_action('publish_page', array($WikiAdmin,'replace_current_with_pending'), 11);
		add_action('admin_menu', array($WikiAdmin,'add_custom_box'));
		
		//Widgets
		add_action('widgets_init', create_function('', 'return register_widget("WikiUserContribWidget");'));
		add_action('nxt_dashboard_setup', array($WikiDashboardWidget, 'dashboard_widget_hook') );
	}
}
$nxt_Wiki = new nxt_Wiki();

//That's all she wrote!
?>