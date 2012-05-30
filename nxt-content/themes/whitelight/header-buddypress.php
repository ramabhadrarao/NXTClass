<?php
/**
 * Header Template
 *
 * Here we setup all logic and XHTML that is required for the header section of all screens.
 *
 * @package WooFramework
 * @subpackage Template
 */
 
 global $woo_options;
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>" media="screen" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	nxt_head();
	woo_head();
?>
</head>

<body <?php body_class(); ?>>
<?php woo_top(); ?>

<div id="wrapper">

	<?php if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'top-menu' ) ) { ?>

	<div id="top">
		<nav class="col-full" role="navigation">
			<?php nxt_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'top-nav', 'menu_class' => 'nav fl', 'theme_location' => 'top-menu' ) ); ?>
		</nav>
	</div><!-- /#top -->

    <?php } ?>

	<header id="header">
	
		<div class="col-full">
		
		<?php
		    $logo = get_template_directory_uri() . '/images/logo.png';
		    if ( isset( $woo_options['woo_logo'] ) && $woo_options['woo_logo'] != '' ) { $logo = $woo_options['woo_logo']; }
		?>
		<?php if ( ! isset( $woo_options['woo_texttitle'] ) || $woo_options['woo_texttitle'] != 'true' ) { ?>
		    <a id="logo" href="<?php bloginfo( 'url' ); ?>" title="<?php bloginfo( 'description' ); ?>">
		    	<img src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
		    </a>
	    <?php } ?>
	    
	    <hgroup>
	        
			<h1 class="site-title"><a href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			<h3 class="nav-toggle"><a href="#navigation"><?php _e('Navigation', 'woothemes'); ?></a></h3>
		      	
		</hgroup>

		<?php if ( isset( $woo_options['woo_ad_top'] ) && $woo_options['woo_ad_top'] == 'true' ) { ?>
        <div id="topad">
			<?php
				if ( isset( $woo_options['woo_ad_top_adsense'] ) && $woo_options['woo_ad_top_adsense'] != '' ) {
					echo stripslashes( $woo_options['woo_ad_top_adsense'] );
				} else {
					if ( isset( $woo_options['woo_ad_top_url'] ) && isset( $woo_options['woo_ad_top_image'] ) )
			?>
				<a href="<?php echo $woo_options['woo_ad_top_url']; ?>"><img src="<?php echo $woo_options['woo_ad_top_image']; ?>" width="468" height="60" alt="advert" /></a>
			<?php } ?>
		</div><!-- /#topad -->
        <?php } ?>
		
		<nav id="navigation" role="navigation">
			<?php
			if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary-menu' ) ) {
				nxt_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'main-nav', 'menu_class' => 'nav fl', 'theme_location' => 'primary-menu' ) );
			} else {
			?>
    	    <ul id="main-nav" class="nav fl">
				<?php if ( is_page() ) $highlight = 'page_item'; else $highlight = 'page_item current_page_item'; ?>
				<li class="<?php echo $highlight; ?>"><a href="<?php echo home_url( '/' ); ?>"><?php _e( 'Home', 'woothemes' ); ?></a></li>
				<?php nxt_list_pages( 'sort_column=menu_order&depth=6&title_li=&exclude=' ); ?>
			</ul><!-- /#nav -->
    	    <?php } ?>
    	    		
		</nav><!-- /#navigation -->
		
		<?php if ( isset( $woo_options['woo_header_search'] ) && $woo_options['woo_header_search'] == 'true' ) { ?>
		<div class="search_main fix">
		    <form method="get" class="searchform" action="<?php echo home_url( '/' ); ?>" >
		        <input type="text" class="field s" name="s" value="<?php esc_attr_e( 'Search…', 'woothemes' ); ?>" onfocus="if ( this.value == '<?php esc_attr_e( 'Search…', 'woothemes' ); ?>' ) { this.value = ''; }" onblur="if ( this.value == '' ) { this.value = '<?php esc_attr_e( 'Search…', 'woothemes' ); ?>'; }" />
		        <input type="image" src="<?php echo get_template_directory_uri(); ?>/images/ico-search.png" class="search-submit" name="submit" alt="Submit" />
		    </form>    
		</div><!--/.search_main-->
		<?php } ?>
		<br>
		<div class="login">
						<?php if( is_user_logged_in() ) : ?>
							<?php
							global $current_user, $bp;
							get_currentuserinfo();
							?>
							<div class="fields"><p><?php printf( __( '<br><h4>Welcome %s', 'woothemes' ), '<a href="' . $bp->loggedin_user->domain . '">' . $bp->loggedin_user->fullname . '</a>' ) ?>. <a href="<?php echo nxt_logout_url(); ?>"><?php _e( 'Logout', 'woothemes' ) ?></a></h4></p></div>
						<?php else : ?>
							<div class="fields">
								<form action="<?php echo site_url() ?>/nxt-login.php" method="post">
									<input type="text" class="user-login" name="log" placeholder="<?php _e( 'Username', 'woothemes' ) ?>" />
									<input type="password" class="user-pass" name="pwd" placeholder="<?php _e( 'Password', 'woothemes' ) ?>" />
									<input type="submit" class="btn-submit" value="Login" />
									<input type="hidden" name="redirect_to" value="<?php echo substr_count( $_SERVER['REQUEST_URI'], 'activate' ) ? home_url() : $_SERVER['REQUEST_URI'] ?>" />
								    <a class="forgot-pass" href="<?php echo site_url() ?>/nxt-login.php?action=lostpassword"><?php _e( 'Forgot Password?', 'woothemes' ) ?></a>
								</form> 
							</div>
						<?php endif ?>
					</div>
		
		</div><!-- /.col-full -->
		
	</header><!-- /#header -->
	
	<?php 
		// Featured Slider
		if ( ( is_home() || is_front_page() ) && !$paged && isset( $woo_options['woo_featured'] ) && $woo_options['woo_featured'] == 'true' ) 
			get_template_part ( 'includes/featured' ); 
	  global $woo_options;
	?>	
	<div id="content">
    	<div class="page col-full">
    	
    		<?php if ( isset( $woo_options['woo_breadcrumbs_show'] ) && $woo_options['woo_breadcrumbs_show'] == 'true' && !is_front_page() ) { ?>
				<section id="breadcrumbs">
					<?php woo_breadcrumbs(); ?>
				</section><!--/#breadcrumbs -->
			<?php } ?> 
    	
			<section id="main" class="col-left">