<?php
/**
 * Header Template
 *
 * Here we setup all logic and XHTML that is required for the header section of all screens.
 *
 * @package lokFramework
 * @subpackage Template
 */
 
 global $lok_options;
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title><?php lok_title(); ?></title>
<?php lok_meta(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>" media="screen" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	nxt_head();
	lok_head();
?>
</head>

<body <?php body_class(); ?>>
<?php lok_top(); ?>

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
		    if ( isset( $lok_options['lok_logo'] ) && $lok_options['lok_logo'] != '' ) { $logo = $lok_options['lok_logo']; }
		?>
		<?php if ( ! isset( $lok_options['lok_texttitle'] ) || $lok_options['lok_texttitle'] != 'true' ) { ?>
		    <a id="logo" href="<?php bloginfo( 'url' ); ?>" title="<?php bloginfo( 'description' ); ?>">
		    	<img src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
		    </a>
	    <?php } ?>
	    
	    <hgroup>
	        
			<h1 class="site-title"><a href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			<h3 class="nav-toggle"><a href="#navigation"><?php _e('Navigation', 'lokthemes'); ?></a></h3>
		      	
		</hgroup>

		<?php if ( isset( $lok_options['lok_ad_top'] ) && $lok_options['lok_ad_top'] == 'true' ) { ?>
        <div id="topad">
			<?php
				if ( isset( $lok_options['lok_ad_top_adsense'] ) && $lok_options['lok_ad_top_adsense'] != '' ) {
					echo stripslashes( $lok_options['lok_ad_top_adsense'] );
				} else {
					if ( isset( $lok_options['lok_ad_top_url'] ) && isset( $lok_options['lok_ad_top_image'] ) )
			?>
				<a href="<?php echo $lok_options['lok_ad_top_url']; ?>"><img src="<?php echo $lok_options['lok_ad_top_image']; ?>" width="468" height="60" alt="advert" /></a>
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
				<li class="<?php echo $highlight; ?>"><a href="<?php echo home_url( '/' ); ?>"><?php _e( 'Home', 'lokthemes' ); ?></a></li>
				<?php nxt_list_pages( 'sort_column=menu_order&depth=6&title_li=&exclude=' ); ?>
			</ul><!-- /#nav -->
    	    <?php } ?>
    	    		
		</nav><!-- /#navigation -->
		
		<?php if ( isset( $lok_options['lok_header_search'] ) && $lok_options['lok_header_search'] == 'true' ) { ?>
		<div class="search_main fix">
		    <form method="get" class="searchform" action="<?php echo home_url( '/' ); ?>" >
		        <input type="text" class="field s" name="s" value="<?php esc_attr_e( 'Search…', 'lokthemes' ); ?>" onfocus="if ( this.value == '<?php esc_attr_e( 'Search…', 'lokthemes' ); ?>' ) { this.value = ''; }" onblur="if ( this.value == '' ) { this.value = '<?php esc_attr_e( 'Search…', 'lokthemes' ); ?>'; }" />
		        <input type="image" src="<?php echo get_template_directory_uri(); ?>/images/ico-search.png" class="search-submit" name="submit" alt="Submit" />
		    </form>    
		</div><!--/.search_main-->
		<?php } ?>
		
		</div><!-- /.col-full -->
		
	</header><!-- /#header -->
	
	<?php 
		// Featured Slider
		if ( ( is_home() || is_front_page() ) && !$paged && isset( $lok_options['lok_featured'] ) && $lok_options['lok_featured'] == 'true' ) 
			get_template_part ( 'includes/featured' ); 
	?>	