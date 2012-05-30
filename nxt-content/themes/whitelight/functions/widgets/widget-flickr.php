<?php

/*
 * Widget Name: Flickr
 */


add_action( 'widgets_init', 'huddle_flickr_widgets' );

function huddle_flickr_widgets() {
	register_widget( 'huddle_flickr_widget' );
}

class huddle_flickr_widget extends nxt_Widget {
	
	function huddle_flickr_widget() {
		$widget_ops = array( 'classname' => 'widget-flickr', 'description' => __('Display your flickr photos.', 'huddle') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'widget-flickr' );
		$this->nxt_Widget( 'widget-flickr', __('Huddle: Flickr Photos', 'huddle'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$flickr_id = $instance['flickr_id'];
		$flickr_count = $instance['flickr_count'];
		$flickr_type = $instance['flickr_type'];
		echo $before_widget;
		if ( $title ) {
			echo $before_title . $title; ?>
			<?php echo $after_title;
		 } ?>
			
			<div id="flickr_badge_wrapper">
				<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $flickr_count ?>&amp;flickr_display=latest&amp;size=s&amp;layout=x&amp;source=<?php echo $flickr_type ?>&amp;<?php echo $flickr_type ?>=<?php echo $flickr_id ?>"></script>
				<a class="more-photos" href="http://www.flickr.com/<?php echo ($flickr_type == 'user' ? 'photos' : 'groups') ?>/<?php echo $flickr_id ?>"><?php _e( 'View All', 'huddle' ) ?> <span>&rarr;</span></a>
			</div>
			<div class="clear"></div>
		<?php
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['flickr_id'] = strip_tags( $new_instance['flickr_id'] );
		$instance['flickr_count'] = $new_instance['flickr_count'];
		$instance['flickr_type'] = $new_instance['flickr_type'];
		return $instance;
	}
	 
	function form( $instance ) {
		$defaults = array(
		'title' => 'Flickr Photos',
		'flickr_id' => '675729@N22',
		'flickr_count' => '9',
		'flickr_type' => 'group'
		);
		$instance = nxt_parse_args( (array) $instance, $defaults ); ?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'huddle') ?></label><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'flickr_id' ); ?>"><?php _e('Flickr ID:', 'huddle') ?> (<a href="http://idgettr.com/" target="_blank">Find Flickr ID</a>)</label><input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" value="<?php echo $instance['flickr_id']; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'flickr_count' ); ?>"><?php _e('How Many Photos:', 'huddle') ?></label>
			<select id="<?php echo $this->get_field_id( 'flickr_count' ); ?>" name="<?php echo $this->get_field_name('flickr_count'); ?>" class="widefat">
			<?php for($i = 1; $i < 11; $i++) : ?>		
				<option <?php if ( $i == $instance['flickr_count'] ) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
			<?php endfor; ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'flickr_type' ); ?>"><?php _e('flickr_type (user or group):', 'huddle') ?></label>
			<select id="<?php echo $this->get_field_id( 'flickr_type' ); ?>" name="<?php echo $this->get_field_name('flickr_type'); ?>" class="widefat">
				<option <?php if ( 'user' == $instance['flickr_type'] ) echo 'selected="selected"'; ?>>user</option>
				<option <?php if ( 'group' == $instance['flickr_type'] ) echo 'selected="selected"'; ?>>group</option>
			</select>
		</p>
	<?php
	}
}
