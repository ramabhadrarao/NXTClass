
	<?php
	$orig_post = $post;
	global $post;
	$tags = nxt_get_post_tags( $post->ID );

	if( $tags ) {
	    $tag_ids = array();
	    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

	    $my_query = new nxt_query(array(
	    	'tag__in'			=>	$tag_ids,
	    	'post__not_in'		=>	array( $post->ID ),
	    	'posts_per_page'	=>	of_get_option( 'related_posts_count' ) + 1
	    ));

		if( $my_query->have_posts() ) { ?>

			<div class="post-info related-posts clf">

				<h3><?php _e( 'Related Posts', 'huddle' ) ?></h3>

				<?php $i = 0; while( $my_query->have_posts() ) { $my_query->the_post(); ?>
					<div class="post <?php echo ++$i % 2 == 0 ? 'even' : 'odd' ?>">
						<a class="post-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'post-small' ); ?></a>
						<h4><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
						<em class="meta">
							<?php _e( 'On', 'huddle' ) ?>
							<?php the_time( get_option( 'date_format' ) ) ?>,
							<?php _e( 'with', 'huddle' ) ?>
							<?php comments_popup_link(__('0 Comments', 'huddle'), __('1 Comment', 'huddle'), __('% Comments', 'huddle')); ?>
						</em>
					</div><!--.post-->
				<?php } ?>

				<div class="clear"></div>
			</div>	

			<?php 
		}
	
		$post = $orig_post;
		nxt_reset_query();
	}
	?>
