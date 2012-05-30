<?php

add_action('widgets_init', 'huddle_widget_recent_posts');

function huddle_widget_recent_posts() {
	unregister_widget('nxt_Widget_Recent_Posts');
	register_widget('huddle_widget_recent_posts');
}

class huddle_widget_recent_posts extends nxt_Widget_Recent_Posts {

	function huddle_widget_recent_posts() {
		parent::__construct();
		$this->name = __('Huddle: Posts', 'huddle');
		$this->widget_options['description'] = __('The most recent/popular posts on your site', 'huddle');
	}

	function widget($args, $instance) {
		$cache = nxt_cache_get('widget_recent_posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __( 'Recent Posts', 'huddle' ) : $instance['title'], $instance, $this->id_base);
		if ( ! $number = absint( $instance['number'] ) )
 			$number = 10;
 		$thumbs = isset($instance['thumbs']) && $instance['thumbs'];
		$show = isset($instance['show']) ? $instance['show'] : 'recent';

		$nxtq_args = array('posts_per_page' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => true);
		if($show == 'popular') {
			$nxtq_args['orderby'] = 'comment_count';
		}

		$r = new nxt_Query($nxtq_args);
		if ($r->have_posts()) :
			?>
			<?php echo $before_widget; ?>
			<?php if ( $title ) echo $before_title . $title . $after_title; ?>
			<?php  while ($r->have_posts()) : $r->the_post(); ?>
				<div class="post">
					<div class="post-img fl"><a href="<?php the_permalink();?>"><?php the_post_thumbnail( 'post-small' ); ?></a></div>
					<h4 class="post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
					<span>
						<?php _e( 'On', 'huddle' ) ?>
						<?php the_time( get_option( 'date_format' ) ) ?>,
						<?php _e( 'with', 'huddle' ) ?>
						<?php comments_popup_link(__('0 Comments', 'huddle'), __('1 Comment', 'huddle'), __('% Comments', 'huddle')); ?>
					</span>
					<div class="clf"></div>
				</div><!--post-->
			<?php endwhile; ?>
			<?php echo $after_widget; ?>
			<?php
			// Reset the global $the_post as this query will have stomped on it
			nxt_reset_postdata();
		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		nxt_cache_set('widget_recent_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = parent::update( $new_instance, $old_instance );
		$instance['thumbs'] = isset($new_instance['thumbs']);
		$instance['show'] = $new_instance['show'];
		return $instance;
	}

	function form( $instance ) {
		parent::form($instance);
		$thumbs = isset($instance['thumbs']) && $instance['thumbs'];
		$show = isset($instance['show']) ? $instance['show'] : 'recent';
		?>
		<p>
			<label for="<?php echo $this->get_field_id('show'); ?>"><?php _e('Show ', 'huddle'); ?> <select name="<?php echo $this->get_field_name('show'); ?>">
				<option value="recent" <?php selected($show, 'recent') ?>><?php _e('recent', 'huddle') ?></option>
				<option value="popular" <?php selected($show, 'popular') ?>><?php _e('popular', 'huddle') ?></option>
			</select> <?php _e('posts', 'huddle') ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('thumbs'); ?>" name="<?php echo $this->get_field_name('thumbs'); ?>" type="checkbox" <?php checked($thumbs, true) ?> />
			<label for="<?php echo $this->get_field_id('thumbs'); ?>"><?php _e('Show Post Thumbnails', 'huddle'); ?></label>
		</p>
		<?php
	}

}

