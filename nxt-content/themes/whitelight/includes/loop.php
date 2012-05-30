<?php // Display this loop for pages
if (is_page()) { ?>


	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="post-title page-title"><?php the_title(); ?></h2>

			<div class="post-content">
				<?php the_content(); ?>
				<?php nxt_link_pages( array( 'before' => '<div id="pagination"><span class="pages">' . __( 'Pages', 'huddle' ) . '</span>', 'after' => '</div>', 'link_before' => '<span class="page-link">', 'link_after' => '</span>' ) ); ?>
			</div>
		</div><!--post-->

	<?php endwhile; endif; ?>


<?php // Display this loop for single blog posts
} elseif (is_single()) { ?>


		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div class="post">
				<?php if( has_post_thumbnail() ) : ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
				<?php endif ?>

				<h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

				<em class="meta">
					<?php _e( 'Posted on', 'huddle' ) ?>
					<?php the_time(get_option('date_format')); ?><?php _e( ', in', 'huddle' ) ?>
					<?php the_category(', '); ?><?php _e( ', with', 'huddle' ) ?>
					<?php comments_popup_link( __( '0 Comments', 'huddle' ), __( '1 Comment', 'huddle' ), __( '% Comments', 'huddle' ) ); ?>	
				</em>

				<div class="post-content">
					<?php the_content(); ?>
					<?php the_tags(); ?>
					<?php nxt_link_pages( array( 'before' => '<div id="pagination" class="for-posts"><span class="pages">' . __( 'Pages', 'huddle' ) . '</span>', 'after' => '</div>', 'link_before' => '<span class="page-link">', 'link_after' => '</span>' ) ); ?>
			</div>
			</div><!--.post-->

		<?php endwhile; endif; ?>

		<?php //the author info box
		if( of_get_option( 'author_info' ) ) : ?>
			<?php load_template( TEMPLATEPATH . '/includes/author-info.php' ); ?>
		<?php endif ?>

		<?php //the related posts box
		if( of_get_option( 'related_posts' ) ) : ?>
			<?php load_template( TEMPLATEPATH . '/includes/related-posts.php' ); ?>
		<?php endif ?>

		<?php comments_template(); ?>


<?php // Display this loop for search results
} elseif (is_search()) { ?>
				

		<?php if (have_posts()) : ?>
		
			<?php while (have_posts()) : the_post(); ?>
					
				<div class="post">
					<h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

					<em class="meta">
						<?php _e( 'Posted on', 'huddle' ) ?>
						<?php the_time(get_option('date_format')); ?><?php _e( ', in', 'huddle' ) ?>
						<?php the_category(', '); ?><?php _e( ', with', 'huddle' ) ?>
						<?php comments_popup_link( __( '0 Comments', 'huddle' ), __( '1 Comment', 'huddle' ), __( '% Comments', 'huddle' ) ); ?>	
					</em>

					<p class="post-content">
						<?php the_excerpt(); ?>
					</p>

					<p class="read-more"><a href="<?php the_permalink() ?>"><span><?php _e('Continue Reading &rarr;', 'huddle'); ?></span></a></p>
				</div><!--.post-->
		
			<?php endwhile;?>
			
			<?php else : ?>
			
			<p><?php _e( 'No results were found. Please try again using a different keyword.', 'huddle' ); ?></p>
		
		<?php endif; ?>


		<?php // Include Pagination feature
		load_template( TEMPLATEPATH . '/includes/pagination.php' );
		?>

		
<?php // Display this loop for the blog
} else { ?>


		<?php $count = 0; ?>

    	<?php if( have_posts() ) : ?>

			<?php while( have_posts() ) : the_post(); $count++; ?>

				<?php do_action( 'bp_before_blog_post' ) ?>

				<div class="post">
					<?php if( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
					<?php endif ?>

					<h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

					<em class="meta">
						<?php _e( 'Posted on', 'huddle' ) ?>
						<?php the_time(get_option('date_format')); ?><?php _e( ', in', 'huddle' ) ?>
						<?php the_category(', '); ?><?php _e( ', with', 'huddle' ) ?>
						<?php comments_popup_link( __( '0 Comments', 'huddle' ), __( '1 Comment', 'huddle' ), __( '% Comments', 'huddle' ) ); ?>	
					</em>

					<p class="post-content"><?php the_excerpt(); ?></p>

					<p class="read-more"><a href="<?php the_permalink() ?>"><span><?php _e('Continue Reading &rarr;', 'huddle'); ?></span></a></p>

				</div><!--.post-->

				<?php do_action( 'bp_after_blog_post' ) ?>

			<?php endwhile;
		endif; ?>


		<?php // Include Pagination feature
		load_template( TEMPLATEPATH . '/includes/pagination.php' );
		?>


<?php // Close the main pages/blog 'if' statement
} ?>
