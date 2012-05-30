<?php

/*
 * Widget Name: eNews Signup
 */


add_action( 'widgets_init', 'huddle_enews_widgets' );

function huddle_enews_widgets() {
	register_widget( 'huddle_enews_widget' );
}

class huddle_enews_widget extends nxt_Widget {
	
	function huddle_enews_widget() {
		$widget_ops = array( 'classname' => 'widget-enews', 'description' => __('Subscribe to email updates.', 'huddle') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'widget-enews' );
		$this->nxt_Widget( 'widget-enews', __('Huddle: eNews Signup','huddle'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$enews_text = $instance['enews_text'];
		$enews_input = $instance['enews_input'];
		$enews_id = $instance['enews_id'];
		$enews_btn = $instance['enews_btn'];
		echo $before_widget;
		?>

		<?php echo $before_title ?>
		<?php echo $title; ?>
		
		<?php if($instance['privacy_page']): $page = get_page($instance['privacy_page']); ?>
			<span><a href="<?php echo get_permalink($page->ID) ?>"><?php echo $page->post_title ?> &rarr;</a></span>
		<?php endif ?>
		
		<?php echo $after_title ?>

		<?php echo $instance['enews_text']; ?>
		
		<form id="subscribe" name="subscribe" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo esc_js( $instance['enews_id'] ); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
			<div class="form-box">
				<input type="text" name="email" class="field" id="email-address" placeholder="<?php echo $instance['enews_input']; ?>" />
				<input class="submit" type="submit" value="<?php echo $instance['enews_btn'] ?>" />
			</div>
			
			<input type="hidden" value="<?php echo $instance['enews_id']; ?>" name="uri" />
			<input type="hidden" name="loc" value="en_US" />
		</form>

		<div class="clear"></div>
		<?php 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['enews_text'] = $new_instance['enews_text'];
		$instance['privacy_page'] = $new_instance['privacy_page'];
		$instance['enews_input'] = strip_tags( $new_instance['enews_input'] );
		$instance['enews_id'] = strip_tags( $new_instance['enews_id'] );
		$instance['enews_btn'] = strip_tags( $new_instance['enews_btn'] );
		return $instance;
	}
	 
	function form( $instance ) {
		$defaults = array(
		'title' => 'Email Updates',
		'privacy_page' => '0',
		'enews_text' => '<p>Lorem ipsum dolor sit amet, quae jugis sudo, consequat, distineo, aliquip diam abdo saga citer.</p>',
		'enews_input' => 'Enter Valid Email Address',
		'enews_id' => 'TechCrunch',
		'enews_btn' => 'Sign Up'
		);
		$instance = nxt_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'huddle') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'privacy_page' ); ?>"><?php _e('\'Privacy Policy\' page:', 'huddle') ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'privacy_page' ); ?>" name="<?php echo $this->get_field_name( 'privacy_page' ); ?>">
				<option value="0"><?php _e(' - Select - ', 'huddle') ?></option>
				<?php foreach(get_pages() as $page): ?>
					<option <?php selected($instance['privacy_page'], $page->ID) ?> value="<?php echo $page->ID ?>"><?php echo $page->post_title ?></option>
				<?php endforeach ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'enews_text' ); ?>"><?php _e('Text:', 'huddle') ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'enews_text' ); ?>" name="<?php echo $this->get_field_name( 'enews_text' ); ?>" rows="10"><?php echo $instance['enews_text']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'enews_input' ); ?>"><?php _e('Default Text for Input Field:', 'huddle') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'enews_input' ); ?>" name="<?php echo $this->get_field_name( 'enews_input' ); ?>" value="<?php echo $instance['enews_input']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'enews_id' ); ?>"><?php _e('Feedburner ID:', 'huddle') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'enews_id' ); ?>" name="<?php echo $this->get_field_name( 'enews_id' ); ?>" value="<?php echo $instance['enews_id']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'enews_btn' ); ?>"><?php _e('Button Text:', 'huddle') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'enews_btn' ); ?>" name="<?php echo $this->get_field_name( 'enews_btn' ); ?>" value="<?php echo $instance['enews_btn']; ?>" />
		</p>
	<?php
	}
}
