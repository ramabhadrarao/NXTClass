<?php
/*-----------------------------------------------------------------------------------*/
/* Framework Settings page - lokthemes_framework_settings_page */
/*-----------------------------------------------------------------------------------*/

function lokthemes_framework_settings_page() {
    $themename =  get_option( 'lok_themename' );
    $manualurl =  get_option( 'lok_manual' );
	$shortname =  'framework_lok';

    //Framework Version in Backend Head
    $lok_framework_version = get_option( 'lok_framework_version' );

    //Version in Backend Head
    $theme_data = get_theme_data( get_template_directory() . '/style.css' );
    $local_version = $theme_data['Version'];

    //GET themes update RSS feed and do magic
	include_once(ABSPATH . WPINC . '/feed.php' );

	$pos = strpos( $manualurl, 'documentation' );
	$theme_slug = str_replace( "/", '', substr( $manualurl, ( $pos + 13 ) ) ); //13 for the word documentation

    //add filter to make the rss read cache clear every 4 hours
    add_filter( 'nxt_feed_cache_transient_lifetime', create_function( '$a', 'return 14400;' ) );

	$framework_options = array();

	$framework_options[] = array( 	'name' => __( 'Admin Settings', 'lokthemes' ),
									'icon' => 'general',
									'type' => 'heading' );

	$framework_options[] = array( 	'name' => __( 'Super User (username)', 'lokthemes' ),
									'desc' => sprintf( __( 'Enter your %s to hide the Framework Settings and Update Framework from other users. Can be reset from the %s under %s.', 'lokthemes' ), '<strong>' . __( 'username', 'lokthemes' ) . '</strong>', '<a href="' . admin_url( 'options.php' ) . '">' . __( 'WP options page', 'lokthemes' ) . '</a>', '<code>framework_lok_super_user</code>' ),
									'id' => $shortname . '_super_user',
									'std' => '',
									'class' => 'text',
									'type' => 'text' );

	$framework_options[] = array( 	'name' => __( 'Disable SEO Menu Item', 'lokthemes' ),
									'desc' => sprintf( __( 'Disable the %s menu item in the theme menu.', 'lokthemes' ), '<strong>' . __( 'SEO', 'lokthemes' ) . '</strong>' ),
									'id' => $shortname . '_seo_disable',
									'std' => '',
									'type' => 'checkbox' );

	$framework_options[] = array( 	'name' => __( 'Disable Sidebar Manager Menu Item', 'lokthemes' ),
									'desc' => sprintf( __( 'Disable the %s menu item in the theme menu.', 'lokthemes' ), '<strong>' . __( 'Sidebar Manager', 'lokthemes' ) . '</strong>' ),
									'id' => $shortname . '_sbm_disable',
									'std' => '',
									'type' => 'checkbox' );

	$framework_options[] = array( 	'name' => __( 'Disable Backup Settings Menu Item', 'lokthemes' ),
									'desc' => sprintf( __( 'Disable the %s menu item in the theme menu.', 'lokthemes' ), '<strong>' . __( 'Backup Settings', 'lokthemes' ) . '</strong>' ),
									'id' => $shortname . '_backupmenu_disable',
									'std' => '',
									'type' => 'checkbox' );

	$framework_options[] = array( 	'name' => __( 'Disable Buy Themes Menu Item', 'lokthemes' ),
									'desc' => sprintf( __( 'Disable the %s menu item in the theme menu.', 'lokthemes' ), '<strong>' . __( 'Buy Themes', 'lokthemes' ) . '</strong>' ),
									'id' => $shortname . '_buy_themes_disable',
									'std' => '',
									'type' => 'checkbox' );

	$framework_options[] = array( 	'name' => __( 'Enable Custom Navigation', 'lokthemes' ),
									'desc' => sprintf( __( 'Enable the old %s menu item. Try to use %s instead, as this function is outdated.', 'lokthemes' ), '<strong>' . __( 'Custom Navigation', 'lokthemes' ) . '</strong>', '<a href="' . admin_url( 'nav-menus.php' ) . '">' . __( 'WP Menus', 'lokthemes' ) . '</a>' ),
									'id' => $shortname . '_loknav',
									'std' => '',
									'type' => 'checkbox' );

	$framework_options[] = array( 	'name' => __( 'Theme Update Notification', 'lokthemes' ),
									'desc' => __( 'This will enable notices on your theme options page that there is an update available for your theme.', 'lokthemes' ),
									'id' => $shortname . '_theme_version_checker',
									'std' => '',
									'type' => 'checkbox' );
									
	$framework_options[] = array( 	'name' => __( 'lokFramework Update Notification', 'lokthemes' ),
									'desc' => __( 'This will enable notices on your theme options page that there is an update available for the lokFramework.', 'lokthemes' ),
									'id' => $shortname . '_framework_version_checker',
									'std' => '',
									'type' => 'checkbox' );

	$framework_options[] = array( 	'name' => __( 'Theme Settings', 'lokthemes' ),
									'icon' => 'general',
									'type' => 'heading' );

	$framework_options[] = array( 	'name' => __( 'Remove Generator Meta Tags', 'lokthemes' ),
									'desc' => __( 'This disables the output of generator meta tags in the HEAD section of your site.', 'lokthemes' ),
									'id' => $shortname . '_disable_generator',
									'std' => '',
									'type' => 'checkbox' );

	$framework_options[] = array( 	'name' => __( 'Image Placeholder', 'lokthemes' ),
									'desc' => __( 'Set a default image placeholder for your thumbnails. Use this if you want a default image to be shown if you haven\'t added a custom image to your post.', 'lokthemes' ),
									'id' => $shortname . '_default_image',
									'std' => '',
									'type' => 'upload' );

	$framework_options[] = array( 	'name' => __( 'Disable Shortcodes Stylesheet', 'lokthemes' ),
									'desc' => __( 'This disables the output of shortcodes.css in the HEAD section of your site.', 'lokthemes' ),
									'id' => $shortname . '_disable_shortcodes',
									'std' => '',
									'type' => 'checkbox' );

	$framework_options[] = array( 	'name' => __( 'Output "Tracking Code" Option in Header', 'lokthemes' ),
									'desc' => sprintf( __( 'This will output the %s option in your header instead of the footer of your website.', 'lokthemes' ), '<strong>' . __( 'Tracking Code', 'lokthemes' ) . '</strong>' ),
									'id' => $shortname . '_move_tracking_code',
									'std' => 'false',
									'type' => 'checkbox' );

	$framework_options[] = array( 	'name' => __( 'Branding', 'lokthemes' ),
									'icon' => 'misc',
									'type' => 'heading' );

	$framework_options[] = array( 	'name' => __( 'Options panel header', 'lokthemes' ),
									'desc' => __( 'Change the header image for the lokThemes Backend.', 'lokthemes' ),
									'id' => $shortname . '_backend_header_image',
									'std' => '',
									'type' => 'upload' );

	$framework_options[] = array( 	'name' => __( 'Options panel icon', 'lokthemes' ),
									'desc' => __( 'Change the icon image for the NXTClass backend sidebar.', 'lokthemes' ),
									'id' => $shortname . '_backend_icon',
									'std' => '',
									'type' => 'upload' );

	$framework_options[] = array( 	'name' => __( 'NXTClass login logo', 'lokthemes' ),
									'desc' => __( 'Change the logo image for the NXTClass login page.', 'lokthemes' ),
									'id' => $shortname . '_custom_login_logo',
									'std' => '',
									'type' => 'upload' );

	$framework_options[] = array( 	'name' => __( 'NXTClass login URL', 'lokthemes' ),
									'desc' => __( 'Change the URL that the logo image on the NXTClass login page links to.', 'lokthemes' ),
									'id' => $shortname . '_custom_login_logo_url',
									'std' => '',
									'class' => 'text',
									'type' => 'text' );
									
	$framework_options[] = array( 	'name' => __( 'NXTClass login logo Title', 'lokthemes' ),
									'desc' => __( 'Change the title of the logo image on the NXTClass login page.', 'lokthemes' ),
									'id' => $shortname . '_custom_login_logo_title',
									'std' => '',
									'class' => 'text',
									'type' => 'text' );

/*
	$framework_options[] = array( 	'name' => __( 'Font Stacks (Beta)', 'lokthemes' ),
									'icon' => 'typography',
									'type' => 'heading' );

	$framework_options[] = array( 	'name' => __( 'Font Stack Builder', 'lokthemes' ),
									'desc' => __( 'Use the font stack builder to add your own custom font stacks to your theme.
									To create a new stack, fill in the name and a CSS ready font stack.
									Once you have added a stack you can select it from the font menu on any of the
									Typography settings in your theme options.', 'lokthemes' ),
									'id' => $shortname . '_font_stack',
									'std' => 'Added Font Stacks',
									'type' => 'string_builder" );
*/

	global $nxt_version;

	if ( $nxt_version >= '3.1' ) {

	$framework_options[] = array( 	'name' => __( 'NXTClass Toolbar', 'lokthemes' ),
									'icon' => 'header',
									'type' => 'heading' );

	$framework_options[] = array( 	'name' => __( 'Disable NXTClass Toolbar', 'lokthemes' ),
									'desc' => __( 'Disable the NXTClass Toolbar.', 'lokthemes' ),
									'id' => $shortname . '_admin_bar_disable',
									'std' => '',
									'type' => 'checkbox' );

	$framework_options[] = array( 	'name' => __( 'Enable the lokFramework Toolbar enhancements', 'lokthemes' ),
									'desc' => __( 'Enable several lokFramework-specific enhancements to the NXTClass Toolbar, such as custom navigation items for "Theme Options".', 'lokthemes' ),
									'id' => $shortname . '_admin_bar_enhancements',
									'std' => '',
									'type' => 'checkbox' );

	}

	// PressTrends Integration
	if ( defined( 'lok_PRESSTRENDS_THEMEKEY' ) ) {
		$framework_options[] = array( 	'name' => __( 'PressTrends', 'lokthemes' ),
										'icon' => 'presstrends',
										'type' => 'heading' );
									
		$framework_options[] = array( 	'name' => __( 'Disable PressTrends Tracking', 'lokthemes' ),
										'desc' => __( 'Disable sending of usage data to PressTrends.', 'lokthemes' ),
										'id' => $shortname . '_presstrends_disable',
										'std' => 'false',
										'type' => 'checkbox' );
	
		$framework_options[] = array( 	'name' => __( 'What is PressTrends?', 'lokthemes' ),
										'desc' => '',
										'id' => $shortname . '_presstrends_info',
										'std' => sprintf( __( 'PressTrends is a simple usage tracker that allows us to see how our customers are using lokThemes themes - so that we can help improve them for you. %sNone%s of your personal data is sent to PressTrends.%sFor more information, please view the PressTrends %s.', 'lokthemes' ), '<strong>', '</strong>', '<br /><br />', '<a href="http://presstrends.io/privacy" target="_blank">' . __( 'privacy policy', 'lokthemes' ) . '</a>' ),
										'type' => 'info' );
	}

    update_option( 'lok_framework_template', $framework_options );

	?>

    <div class="wrap" id="lok_container">
    <div id="lok-popup-save" class="lok-save-popup"><div class="lok-save-save"><?php _e( 'Options Updated', 'lokthemes' ); ?></div></div>
    <div id="lok-popup-reset" class="lok-save-popup"><div class="lok-save-reset"><?php _e( 'Options Reset', 'lokthemes' ); ?></div></div>
        <form action='' enctype="multipart/form-data" id="lokform" method="post">
        <?php
	    	// Add nonce for added security.
	    	if ( function_exists( 'nxt_nonce_field' ) ) { nxt_nonce_field( 'lokframework-framework-options-update' ); } // End IF Statement

	    	$lok_nonce = '';

	    	if ( function_exists( 'nxt_create_nonce' ) ) { $lok_nonce = nxt_create_nonce( 'lokframework-framework-options-update' ); } // End IF Statement

	    	if ( $lok_nonce == '' ) {} else {

	    ?>
	    	<input type="hidden" name="_ajax_nonce" value="<?php echo $lok_nonce; ?>" />
	    <?php

	    	} // End IF Statement
	    ?>
            <div id="header">
                <div class="logo">
                <?php if( get_option( 'framework_lok_backend_header_image' ) ) { ?>
                <img alt="" src="<?php echo get_option( 'framework_lok_backend_header_image' ); ?>"/>
                <?php } else { ?>
                <img alt="lokThemes" src="<?php echo get_template_directory_uri(); ?>/functions/images/logo.png"/>
                <?php } ?>
                </div>
                <div class="theme-info">
                    <span class="theme"><?php echo $themename; ?> <?php echo $local_version; ?></span>
                    <span class="framework"><?php printf( __( 'Framework %s', 'lokthemes' ), $lok_framework_version ); ?></span>
                </div>
                <div class="clear"></div>
            </div>
            <div id="support-links">
                <ul>
                    <li class="changelog"><a title="Theme Changelog" href="<?php echo $manualurl; ?>#Changelog"><?php _e( 'View Changelog', 'lokthemes' ); ?></a></li>
                    <li class="docs"><a title="Theme Documentation" href="<?php echo $manualurl; ?>"><?php _e( 'View Themedocs', 'lokthemes' ); ?></a></li>
                    <li class="forum"><a href="http://www.lokthemes.com/support-forum" target="_blank"><?php _e( 'Visit Forum', 'lokthemes' ); ?></a></li>
                    <li class="right"><img style="display:none" src="<?php echo get_template_directory_uri(); ?>/functions/images/loading-top.gif" class="ajax-loading-img ajax-loading-img-top" alt="<?php esc_attr_e( 'Working...', 'lokthemes' ); ?>" /><a href="#" id="expand_options">[+]</a> <input type="submit" value="<?php esc_attr_e( 'Save All Changes', 'lokthemes' ); ?>" class="button submit-button" /></li>
                </ul>
            </div>
            <?php $return = lokthemes_machine( $framework_options ); ?>
            <div id="main">
                <div id="lok-nav">
                    <ul>
                        <?php echo $return[1]; ?>
                    </ul>
                </div>
                <div id="content">
   				<?php echo $return[0]; ?>
                </div>
                <div class="clear"></div>

            </div>
            <div class="save_bar_top">
            <input type="hidden" name="lok_save" value="save" />
            <img style="display:none" src="<?php echo get_template_directory_uri(); ?>/functions/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="<?php esc_attr_e( 'Working...', 'lokthemes' ); ?>" />
            <input type="submit" value="<?php esc_attr_e( 'Save All Changes', 'lokthemes' ); ?>" class="button submit-button" />
            </form>

            <form action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" method="post" style="display:inline" id="lokform-reset">
            <?php
		    	// Add nonce for added security.
		    	if ( function_exists( 'nxt_nonce_field' ) ) { nxt_nonce_field( 'lokframework-framework-options-reset' ); } // End IF Statement

		    	$lok_nonce = '';

		    	if ( function_exists( 'nxt_create_nonce' ) ) { $lok_nonce = nxt_create_nonce( 'lokframework-framework-options-reset' ); } // End IF Statement

		    	if ( $lok_nonce == '' ) {} else {

		    ?>
		    	<input type="hidden" name="_ajax_nonce" value="<?php echo $lok_nonce; ?>" />
		    <?php

		    	} // End IF Statement
		    ?>
            <span class="submit-footer-reset">
<!--             <input name="reset" type="submit" value="<?php esc_attr_e( 'Reset Options', 'lokthemes' ); ?>" class="button submit-button reset-button" onclick="return confirm( '<?php esc_attr_e( 'Click OK to reset. Any settings will be lost!', 'lokthemes' ); ?>' );" /> -->
            <input type="hidden" name="lok_save" value="reset" />
            </span>
        	</form>


            </div>

    <div style="clear:both;"></div>
    </div><!--wrap-->
<?php } ?>