
		<div class="post-info author-info">

			<p class="more-posts"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'id' ) ) ?>"><?php _e( 'View All Posts From This Author &rarr;', 'huddle' ) ?></a></p>
			<h3><?php _e( 'About The Author', 'huddle' ) ?></h3>

			<div class="author-photo fl">
				<?php echo get_avatar( get_the_author_meta( 'email' ), 35 ); ?>
			</div>

			<div class="author-name fl">
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'id' ) ) ?>"><?php the_author_meta( 'display_name' ) ?></a>
				<p><em><?php the_author_meta( 'nickname' )  ?></em></p>
			</div>

			<div class="author-bio fl">
				<p><?php the_author_meta( 'description' ) ?></p>
			</div>

			<div class="clear"></div>
		</div>
