<?php get_header();
	global $lok_options;
?>
       
    <div id="content">
    	<div class="page col-full">
    	
    		<?php if ( isset( $lok_options['lok_breadcrumbs_show'] ) && $lok_options['lok_breadcrumbs_show'] == 'true' && !is_front_page() ) { ?>
				<section id="breadcrumbs">
					<?php lok_breadcrumbs(); ?>
				</section><!--/#breadcrumbs -->
			<?php } ?>
			<section id="main" class="col-left"> 
		<div class="padder">

			<?php do_action( 'bp_before_member_home_content' ) ?>

			<div id="item-header">
				<?php dpa_load_template( array( 'members/single/member-header.php' ) ) ?>
			</div><!-- #item-header -->

			<div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav">
					<ul>
						<?php bp_get_displayed_user_nav() ?>

						<?php do_action( 'bp_member_options_nav' ) ?>
					</ul>
				</div>
			</div><!-- #item-nav -->

			<div id="item-body">
				<?php do_action( 'bp_before_member_body' ) ?>

				<?php if ( dpa_is_member_my_achievements_page() ) : ?>
					<?php dpa_load_template( array( 'members/single/achievements/unlocked.php' ) ) ?>
				<?php endif; ?>

				<?php do_action( 'bp_after_member_body' ) ?>

			</div><!-- #item-body -->

			<?php do_action( 'bp_after_member_home_content' ) ?>

		</div><!-- .padder -->
	</section><!-- /#main -->
	
	        <?php get_sidebar(); ?>
		</div>
    </div><!-- /#content -->
		
<?php get_footer(); ?>