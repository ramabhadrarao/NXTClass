<?php
class WikiNotifications {
	function __construct() {
		$this->WikiNotifications();
	}
	
	function WikiNotifications() {
		if (!nxt_next_scheduled('cron_email_hook'))
	    	nxt_schedule_event( time(), 'weekly', 'cron_email_hook' );
	}
	/**
	 * wiki_page_edit_notification 
	 * @global <type> $nxtdb
	 * @param <type> $pageID
	 * @return NULL
	 */
	function page_edit_notification($pageID) {
	    global $nxtdb;
	    $nxtw_options = get_option('nxtw_options');
	    if($nxtw_options['email_admins'] == 1){
	  
			$emails = $this->getAllAdmins();
			$sql = "SELECT post_title, guid FROM ".$nxtdb->prefix."posts WHERE ID=".$pageID;
			$subject = "Wiki Change";
			$results = $nxtdb->get_results($sql);
		
			$pageTitle = $results[0]->post_title;
			$pagelink = $results[0]->guid;
			
			$message = sprintf(__("A Wiki Page has been modified on %s."),get_option('home'),$pageTitle);
			$message .= "\n\r";
			$message .= sprintf(__("The page title is %s"), $pageTitle); 
			$message .= "\n\r";
			$message .= __('To visit this page, ').'<a href='.$pagelink.'>'.__('click here').'</a>';
			//exit(print_r($emails, true));
			foreach($emails as $email){
				nxt_mail($email, $subject, $message);
		    } 
	    }
	}
	/**
	 * getAllAdmins 
	 * @global <type> $nxtdb
	 * @param <type> NULL
	 * @return email addresses for all administrators
	 */
	function getAllAdmins(){
		global $nxtdb;
		$sql = "SELECT ID from $nxtdb->users";
		$IDS = $nxtdb->get_col($sql);
	
		foreach($IDS as $id){
			$user_info = get_userdata($id);
			if($user_info->user_level == 10){
				$emails[] = $user_info->user_email;
			
			}
		}
		return $emails;
	}
		
	function more_reccurences() {
	    return array(
	        'weekly' => array('interval' => 604800, 'display' => 'Once Weekly'),
	        'fortnightly' => array('interval' => 1209600, 'display' => 'Once Fortnightly'),
	    );
	}
	
	function cron_email() {
		$nxtw_options = get_option('nxtw_options');
	    
	    if ($nxtw_options['cron_email'] == 1) {
	        $last_email = $nxtw_options['cron_last_email_date'];
	        
			$emails = getAllAdmins();
			$sql = "SELECT post_title, guid FROM ".$nxtdb->prefix."posts WHERE post_modifiyed > ".$last_email;
	        
			$subject = "Wiki Change";
			$results = $nxtdb->get_results($sql);
		
	        $message = " The following Wiki Pages has been modified on '".get_option('home')."' \n\r ";
	        if ($results) {
	            foreach ($results as $result) {
	                $pageTitle = $result->post_title;
	                $pagelink = $result->guid;
	                $message .= "Page title is ".$pageTitle.". \n\r To visit this page <a href='".$pagelink."'> click here</a>.\n\r\n\r";
	                //exit(print_r($emails, true));
	                foreach($emails as $email){
	                    nxt_mail($email, $subject, $message);
	                }
	            }
	        }
	        $nxtw_options['cron_last_email_date'] = date('Y-m-d G:i:s');
	        update_option('nxtw_options', serialize($nxtw_options));
	    }
	}

}
?>