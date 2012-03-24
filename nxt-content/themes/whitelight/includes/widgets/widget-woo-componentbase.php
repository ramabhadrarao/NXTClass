<?php
/*-----------------------------------------------------------------------------------

CLASS INFORMATION

Description: A custom lokThemes Component widget.
Date Created: 2011-07-27.
Last Modified: 2011-07-27.
Author: lokThemes.
Since: 1.0.0


TABLE OF CONTENTS

- var $lok_widget_cssclass
- var $lok_widget_description
- var $lok_widget_idbase
- var $lok_widget_title
- var $lok_widget_component
- var $lok_widget_componentslist

- function (constructor)
- function widget ()
- function update ()
- function form ()

- Register the widget on `widgets_init`.

-----------------------------------------------------------------------------------*/

class lok_Widget_Component extends WP_Widget {

	var $lok_widget_cssclass;
	var $lok_widget_description;
	var $lok_widget_idbase;
	var $lok_widget_title;
	var $lok_widget_component;
	var $lok_widget_componentslist;
	
	var $widget_ops = array();
	var $control_ops = array();

	/*----------------------------------------
	  Constructor.
	  ----------------------------------------
	  
	  * The constructor. Sets up the widget.
	----------------------------------------*/
	
	function lok_Widget_Component () {
		
		/* Widget variable settings. */

		$this->lok_widget_cssclass = 'widget_lok_component';
		$this->lok_widget_idbase = 'lok_component';
		$this->lok_widget_componenttitle = __( 'Component', 'lokthemes' );
		$this->lok_widget_title = __('lok - ', 'lokthemes' ) . $this->lok_widget_componenttitle;
		$this->lok_widget_description = sprintf( __( 'This is a lokThemes standardized component widget for loading components into a custom layout.', 'lokthemes' ) );
		
		$this->lok_widget_componentslist = array(
												'features' => __( 'Features', 'lokthemes' ), 
												'portfolio' => __( 'Portfolio', 'lokthemes' ),
												'blog' => __( 'Blog', 'lokthemes' )
												);
		
		/* Widget settings. */
		$this->widget_ops = array( 'classname' => $this->lok_widget_cssclass, 'description' => $this->lok_widget_description );

		/* Widget control settings. */
		$this->control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => $this->lok_widget_idbase );

		/* Create the widget. */
		$this->WP_Widget( $this->lok_widget_idbase, $this->lok_widget_title, $this->widget_ops, $this->control_ops );
		
	} // End Constructor

	/*----------------------------------------
	  widget()
	  ----------------------------------------
	  
	  * Displays the widget on the frontend.
	----------------------------------------*/

	function widget( $args, $instance ) {  
		
		extract( $args, EXTR_SKIP );
		
		$component = $instance['component'];
		
		if ( $component != '' ) { locate_template( 'includes/homepage-' . $component . '-panel.php', true ); }

	} // End widget()

	/*----------------------------------------
	  update()
	  ----------------------------------------
	
	* Function to update the settings from
	* the form() function.
	
	* Params:
	* - Array $new_instance
	* - Array $old_instance
	----------------------------------------*/
	
	function update ( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		/* The select box is returning a text value, so we escape it. */
		$instance['component'] = esc_attr( $new_instance['component'] );
		
		return $instance;
		
	} // End update()

   /*----------------------------------------
	 form()
	 ----------------------------------------
	  
	  * The form on the widget control in the
	  * widget administration area.
	  
	  * Make use of the get_field_id() and 
	  * get_field_name() function when creating
	  * your form elements. This handles the confusing stuff.
	  
	  * Params:
	  * - Array $instance
	----------------------------------------*/

    function form( $instance ) {       
   
   		/* Set up some default widget settings. */
		$defaults = array(
						'component' => ''
					);
		
		$instance = nxt_parse_args( (array) $instance, $defaults );
   
?>
		<!-- Widget Example Select: Select Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'component' ); ?>"><?php _e( 'Component:', 'lokthemes' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'component' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'component' ); ?>">
			<?php foreach ( $this->lok_widget_componentslist as $k => $v ) { ?>
				<option value="<?php echo $k; ?>"<?php selected( $instance['component'], $k ); ?>><?php echo $v; ?></option>
			<?php } ?>       
			</select>
		</p>
<?php
   
   		echo sprintf( __( 'All options for the components are set on the %1$s screen.', 'lokthemes' ), '<a href="' . admin_url( 'admin.php?page=lokthemes' ) . '">' . __( 'Theme Options', 'lokthemes' ) . '</a>' );
   
	} // End form()
	
} // End Class

/*----------------------------------------
  Register the widget on `widgets_init`.
  ----------------------------------------
  
  * Registers this widget.
----------------------------------------*/

add_action( 'widgets_init', create_function( '', 'return register_widget("lok_Widget_Component");' ), 1 );
?>