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

		<form class="achievement-edit-form standard-form" method="post" action="<?php dpa_achievements_permalink() ?>/<?php echo DPA_SLUG_CREATE ?>">

			<?php do_action( 'dpa_before_create_achievement' ) ?>

			<h3><?php _e( 'Create Achievement', 'dpa' ) ?> &nbsp;<a class="button" href="<?php dpa_achievements_permalink() ?>"><?php _e( 'Achievements Directory', 'dpa' ) ?></a></h3>

			<div id="item-nav">
				<div class="item-list-tabs no-ajax" id="achievement-single">
					<ul>
						<?php if ( !dpa_is_create_achievement_page() ) : ?>
							<?php bp_get_options_nav() ?>
						<?php endif; ?>

						<?php do_action( 'achievement_options_nav' ) ?>
					</ul>
				</div>
			</div><!-- #item-nav -->

			<div class="item-body" id="achievements-create-body">
				<?php do_action( 'dpa_before_create_achievement_body' ) ?>

				<?php if ( bp_is_active( 'groups' ) || is_multisite() && bp_is_active( 'blogs' ) ) : ?>
					<noscript><p><?php _e( "Some of the Action options below may not be relevant to the type or event of the Achievement.", 'dpa' ) ?></p></noscript>
				<?php endif; ?>
				<p><?php _e( "After you create the Achievement, you'll be able to choose a picture for it.", 'dpa' ) ?></p>

				<?php do_action( 'template_notices' ) ?>

				<?php dpa_load_template( array( 'achievements/_addedit.php' ) ) ?>

				<?php nxt_nonce_field( 'achievement-create' ) ?>

				<?php do_action( 'dpa_after_create_achievement_body' ); ?>

			</div><!-- .item-body -->

			<?php do_action( 'dpa_after_create_achievement' ) ?>

		</form>

		</div><!-- .padder -->
	</section><!-- /#main -->
	
	        <?php get_sidebar(); ?>
		</div>
    </div><!-- /#content -->
		
<?php get_footer(); ?>