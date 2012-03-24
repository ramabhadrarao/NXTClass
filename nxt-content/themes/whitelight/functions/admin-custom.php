<?php
/**
 * Custom fields for NXTClass write panels.
 *
 * Add custom fields to various post types "Add" and "Edit" screens within NXTClass.
 * Also processes the custom fields as post meta when the post is saved.
 *
 * @category CustomFields
 * @package NXTClass
 * @subpackage lokFramework
 * @author lokThemes
 * @since 1.0.0
 *
 * TABLE OF CONTENTS
 *
 * - lokthemes_metabox_create()
 * - lokthemes_metabox_handle()
 * - lokthemes_metabox_add()
 * - lokthemes_metabox_fieldtypes()
 * - lokthemes_uploader_custom_fields()
 * - lok_custom_enqueue()
 * - lok_custom_enqueue_css()
 */

/**
 * lokthemes_metabox_create function.
 *
 * @access public
 * @param object $post
 * @param array $callback
 * @return void
 */
function lokthemes_metabox_create( $post, $callback ) {
    global $post;

	// Allow child themes/plugins to act here.
	do_action( 'lokthemes_metabox_create', $post, $callback );

    $template_to_show = $callback['args'];

    $lok_metaboxes = get_option( 'lok_custom_template' );

    $seo_metaboxes = get_option( 'lok_custom_seo_template' );

    if( empty( $seo_metaboxes ) && $template_to_show == 'seo' ) {
    	return;
    }
    if( get_option( 'seo_lok_hide_fields' ) != 'true' && $template_to_show == 'seo' ) {
    	$lok_metaboxes = $seo_metaboxes;
    }

	// Array sanity check.
	if ( ! is_array( $lok_metaboxes ) ) { return; }

    $output = '';
    $output .= '<table class="lok_metaboxes_table">'."\n";
    foreach ( $lok_metaboxes as $k => $lok_metabox ) {
    
    	// Setup CSS classes to be added to each table row.
    	$row_css_class = 'lok-custom-field';
    	if ( ( $k + 1 ) == count( $lok_metaboxes ) ) { $row_css_class .= ' last'; }
    
    	$lok_id = 'lokthemes_' . $lok_metabox['name'];
    	$lok_name = $lok_metabox['name'];

    	if ( $template_to_show == 'seo' ) {
    		$metabox_post_type_restriction = 'undefined';
    	} elseif ( function_exists( 'lokthemes_content_builder_menu' ) ) {
    		$metabox_post_type_restriction = $lok_metabox['cpt'][$post->post_type];
    	} else {
    		$metabox_post_type_restriction = 'undefined';
    	}

    	if ( ( $metabox_post_type_restriction != '' ) && ( $metabox_post_type_restriction == 'true' ) ) {
    		$type_selector = true;
    	} elseif ( $metabox_post_type_restriction == 'undefined' ) {
    		$type_selector = true;
    	} else {
    		$type_selector = false;
    	}

   		$lok_metaboxvalue = '';

    	if ( $type_selector ) {

    		if( isset( $lok_metabox['type'] ) && ( in_array( $lok_metabox['type'], lokthemes_metabox_fieldtypes() ) ) ) {

        	    	$lok_metaboxvalue = get_post_meta($post->ID,$lok_name,true);

				}
				
				// Make sure slashes are stripped before output.
				foreach ( array( 'label', 'desc', 'std' ) as $k ) {
					if ( isset( $lok_metabox[$k] ) && ( $lok_metabox[$k] != '' ) ) {
						$lok_metabox[$k] = stripslashes( $lok_metabox[$k] );
					}
				}
				
        	    if ( $lok_metaboxvalue == '' && isset( $lok_metabox['std'] ) ) {

        	        $lok_metaboxvalue = $lok_metabox['std'];
        	    } 
        	    
        	    // Add a dynamic CSS class to each row in the table.
        	    $row_css_class .= ' lok-field-type-' . strtolower( $lok_metabox['type'] );
        	    
				if( $lok_metabox['type'] == 'info' ) {

        	        $output .= "\t".'<tr class="' . $row_css_class . '" style="background:#f8f8f8; font-size:11px; line-height:1.5em;">';
        	        $output .= "\t\t".'<th class="lok_metabox_names"><label for="'. esc_attr( $lok_id ) .'">'.$lok_metabox['label'].'</label></th>'."\n";
        	        $output .= "\t\t".'<td style="font-size:11px;">'.$lok_metabox['desc'].'</td>'."\n";
        	        $output .= "\t".'</tr>'."\n";

        	    }
        	    elseif( $lok_metabox['type'] == 'text' ) {

        	    	$add_class = ''; $add_counter = '';
        	    	if($template_to_show == 'seo'){$add_class = 'words-count'; $add_counter = '<span class="counter">0 characters, 0 words</span>';}
        	        $output .= "\t".'<tr class="' . $row_css_class . '">';
        	        $output .= "\t\t".'<th class="lok_metabox_names"><label for="'.esc_attr( $lok_id ).'">'.$lok_metabox['label'].'</label></th>'."\n";
        	        $output .= "\t\t".'<td><input class="lok_input_text '.$add_class.'" type="'.$lok_metabox['type'].'" value="'.esc_attr( $lok_metaboxvalue ).'" name="'.$lok_name.'" id="'.esc_attr( $lok_id ).'"/>';
        	        $output .= '<span class="lok_metabox_desc">'.$lok_metabox['desc'] .' '. $add_counter .'</span></td>'."\n";
        	        $output .= "\t".'</tr>'."\n";

        	    }

        	    elseif ( $lok_metabox['type'] == 'textarea' ) {

        	   		$add_class = ''; $add_counter = '';
        	    	if( $template_to_show == 'seo' ){ $add_class = 'words-count'; $add_counter = '<span class="counter">0 characters, 0 words</span>'; }
        	        $output .= "\t".'<tr class="' . $row_css_class . '">';
        	        $output .= "\t\t".'<th class="lok_metabox_names"><label for="'.$lok_metabox.'">'.$lok_metabox['label'].'</label></th>'."\n";
        	        $output .= "\t\t".'<td><textarea class="lok_input_textarea '.$add_class.'" name="'.$lok_name.'" id="'.esc_attr( $lok_id ).'">' . esc_textarea(stripslashes($lok_metaboxvalue)) . '</textarea>';
        	        $output .= '<span class="lok_metabox_desc">'.$lok_metabox['desc'] .' '. $add_counter.'</span></td>'."\n";
        	        $output .= "\t".'</tr>'."\n";

        	    }

        	    elseif ( $lok_metabox['type'] == 'calendar' ) {

        	        $output .= "\t".'<tr class="' . $row_css_class . '">';
        	        $output .= "\t\t".'<th class="lok_metabox_names"><label for="'.$lok_metabox.'">'.$lok_metabox['label'].'</label></th>'."\n";
        	        $output .= "\t\t".'<td><input class="lok_input_calendar" type="text" name="'.$lok_name.'" id="'.esc_attr( $lok_id ).'" value="'.esc_attr( $lok_metaboxvalue ).'">';
        	        $output .= "\t\t" . '<input type="hidden" name="datepicker-image" value="' . get_template_directory_uri() . '/functions/images/calendar.gif" />';
        	        $output .= '<span class="lok_metabox_desc">'.$lok_metabox['desc'].'</span></td>'."\n";
        	        $output .= "\t".'</tr>'."\n";

        	    }

        	    elseif ( $lok_metabox['type'] == 'time' ) {

        	        $output .= "\t".'<tr>';
        	        $output .= "\t\t".'<th class="lok_metabox_names"><label for="' . esc_attr( $lok_id ) . '">' . $lok_metabox['label'] . '</label></th>'."\n";
        	        $output .= "\t\t".'<td><input class="lok_input_time" type="' . $lok_metabox['type'] . '" value="' . esc_attr( $lok_metaboxvalue ) . '" name="' . $lok_name . '" id="' . esc_attr( $lok_id ) . '"/>';
        	        $output .= '<span class="lok_metabox_desc">' . $lok_metabox['desc'] . '</span></td>'."\n";
        	        $output .= "\t".'</tr>'."\n";

        	    }

        	    elseif ( $lok_metabox['type'] == 'select' ) {

        	        $output .= "\t".'<tr class="' . $row_css_class . '">';
        	        $output .= "\t\t".'<th class="lok_metabox_names"><label for="' . esc_attr( $lok_id ) . '">' . $lok_metabox['label'] . '</label></th>'."\n";
        	        $output .= "\t\t".'<td><select class="lok_input_select" id="' . esc_attr( $lok_id ) . '" name="' . esc_attr( $lok_name ) . '">';
        	        $output .= '<option value="">Select to return to default</option>';

        	        $array = $lok_metabox['options'];

        	        if( $array ) {

        	            foreach ( $array as $id => $option ) {
        	                $selected = '';

        	                if( isset( $lok_metabox['default'] ) )  {
								if( $lok_metabox['default'] == $option && empty( $lok_metaboxvalue ) ) { $selected = 'selected="selected"'; }
								else  { $selected = ''; }
							}

        	                if( $lok_metaboxvalue == $option ){ $selected = 'selected="selected"'; }
        	                else  { $selected = ''; }

        	                $output .= '<option value="' . esc_attr( $option ) . '" ' . $selected . '>' . $option . '</option>';
        	            }
        	        }

        	        $output .= '</select><span class="lok_metabox_desc">' . $lok_metabox['desc'] . '</span></td>'."\n";
        	        $output .= "\t".'</tr>'."\n";
        	    }
        	    elseif ( $lok_metabox['type'] == 'select2' ) {

        	        $output .= "\t".'<tr class="' . $row_css_class . '">';
        	        $output .= "\t\t".'<th class="lok_metabox_names"><label for="' . esc_attr( $lok_id ) . '">' . $lok_metabox['label'] . '</label></th>'."\n";
        	        $output .= "\t\t".'<td><select class="lok_input_select" id="' . esc_attr( $lok_id ) . '" name="' . esc_attr( $lok_name ) . '">';
        	        $output .= '<option value="">Select to return to default</option>';

        	        $array = $lok_metabox['options'];

        	        if( $array ) {

        	            foreach ( $array as $id => $option ) {
        	                $selected = '';

        	                if( isset( $lok_metabox['default'] ) )  {
								if( $lok_metabox['default'] == $id && empty( $lok_metaboxvalue ) ) { $selected = 'selected="selected"'; }
								else  { $selected = ''; }
							}

        	                if( $lok_metaboxvalue == $id ) { $selected = 'selected="selected"'; }
        	                else  {$selected = '';}

        	                $output .= '<option value="'. esc_attr( $id ) .'" '. $selected .'>' . $option . '</option>';
        	            }
        	        }

        	        $output .= '</select><span class="lok_metabox_desc">'.$lok_metabox['desc'].'</span></td>'."\n";
        	        $output .= "\t".'</tr>'."\n";
        	    }

        	    elseif ( $lok_metabox['type'] == 'checkbox' ){

        	        if( $lok_metaboxvalue == 'true' ) { $checked = ' checked="checked"'; } else { $checked=''; }

        	        $output .= "\t".'<tr class="' . $row_css_class . '">';
        	        $output .= "\t\t".'<th class="lok_metabox_names"><label for="'.esc_attr( $lok_id ).'">'.$lok_metabox['label'].'</label></th>'."\n";
        	        $output .= "\t\t".'<td><input type="checkbox" '.$checked.' class="lok_input_checkbox" value="true"  id="'.esc_attr( $lok_id ).'" name="'. esc_attr( $lok_name ) .'" />';
        	        $output .= '<span class="lok_metabox_desc" style="display:inline">'.$lok_metabox['desc'].'</span></td>'."\n";
        	        $output .= "\t".'</tr>'."\n";
        	    }

        	    elseif ( $lok_metabox['type'] == 'radio' ) {

        	    $array = $lok_metabox['options'];

        	    if( $array ) {

        	    $output .= "\t".'<tr class="' . $row_css_class . '">';
        	    $output .= "\t\t".'<th class="lok_metabox_names"><label for="' . esc_attr( $lok_id ) . '">' . $lok_metabox['label'] . '</label></th>'."\n";
        	    $output .= "\t\t".'<td>';

        	        foreach ( $array as $id => $option ) {
        	            if($lok_metaboxvalue == $id) { $checked = ' checked'; } else { $checked=''; }

        	                $output .= '<input type="radio" '.$checked.' value="' . $id . '" class="lok_input_radio"  name="'. esc_attr( $lok_name ) .'" />';
        	                $output .= '<span class="lok_input_radio_desc" style="display:inline">'. $option .'</span><div class="lok_spacer"></div>';
        	            }
        	            $output .= "\t".'</tr>'."\n";
        	         }
        	    } elseif ( $lok_metabox['type'] == 'images' ) {

				$i = 0;
				$select_value = '';
				$layout = '';

				foreach ( $lok_metabox['options'] as $key => $option ) {
					 $i++;

					 $checked = '';
					 $selected = '';
					 if( $lok_metaboxvalue != '' ) {
					 	if ( $lok_metaboxvalue == $key ) { $checked = ' checked'; $selected = 'lok-meta-radio-img-selected'; }
					 }
					 else {
					 	if ($option['std'] == $key) { $checked = ' checked'; }
						elseif ($i == 1) { $checked = ' checked'; $selected = 'lok-meta-radio-img-selected'; }
						else { $checked=''; }

					 }

						$layout .= '<div class="lok-meta-radio-img-label">';
						$layout .= '<input type="radio" id="lok-meta-radio-img-' . $lok_name . $i . '" class="checkbox lok-meta-radio-img-radio" value="' . esc_attr($key) . '" name="' . $lok_name . '" ' . $checked . ' />';
						$layout .= '&nbsp;' . esc_html($key) . '<div class="lok_spacer"></div></div>';
						$layout .= '<img src="' . esc_url( $option ) . '" alt="" class="lok-meta-radio-img-img '. $selected .'" onClick="document.getElementById(\'lok-meta-radio-img-'. esc_js( $lok_metabox["name"] . $i ) . '\').checked = true;" />';
					}

				$output .= "\t".'<tr class="' . $row_css_class . '">';
				$output .= "\t\t".'<th class="lok_metabox_names"><label for="' . esc_attr( $lok_id ) . '">' . $lok_metabox['label'] . '</label></th>'."\n";
				$output .= "\t\t".'<td class="lok_metabox_fields">';
				$output .= $layout;
				$output .= '<span class="lok_metabox_desc">' . $lok_metabox['desc'] . '</span></td>'."\n";
        	    $output .= "\t".'</tr>'."\n";

				}

        	    elseif( $lok_metabox['type'] == 'upload' )
        	    {
					if( isset( $lok_metabox['default'] ) ) $default = $lok_metabox['default'];
					else $default = '';

        	    	// Add support for the lokThemes Media Library-driven Uploader Module // 2010-11-09.
        	    	if ( function_exists( 'lokthemes_medialibrary_uploader' ) ) {

        	    		$_value = $default;

        	    		$_value = get_post_meta( $post->ID, $lok_metabox['name'], true );

        	    		$output .= "\t".'<tr class="' . $row_css_class . '">';
	    	            $output .= "\t\t".'<th class="lok_metabox_names"><label for="'.$lok_metabox['name'].'">'.$lok_metabox['label'].'</label></th>'."\n";
	    	            $output .= "\t\t".'<td class="lok_metabox_fields">'. lokthemes_medialibrary_uploader( $lok_metabox['name'], $_value, 'postmeta', $lok_metabox['desc'], $post->ID );
	    	            $output .= '</td>'."\n";
	    	            $output .= "\t".'</tr>'."\n";

        	    	} else {

	    	            $output .= "\t".'<tr class="' . $row_css_class . '">';
	    	            $output .= "\t\t".'<th class="lok_metabox_names"><label for="'.esc_attr( $lok_id ).'">'.$lok_metabox['label'].'</label></th>'."\n";
	    	            $output .= "\t\t".'<td class="lok_metabox_fields">'. lokthemes_uploader_custom_fields( $post->ID, $lok_name, $default, $lok_metabox['desc'] );
	    	            $output .= '</td>'."\n";
	    	            $output .= "\t".'</tr>'."\n";

        	        }
        	    }
        	    
        	    // Timestamp field.
        	    elseif ( $lok_metabox['type'] == 'timestamp' ) {
        	    	$lok_metaboxvalue = get_post_meta($post->ID,$lok_name,true);
        	    	
					// Default to current UNIX timestamp.
					if ( $lok_metaboxvalue == '' ) {
						$lok_metaboxvalue = time();
					}
					
        	        $output .= "\t".'<tr class="' . $row_css_class . '">';
        	        $output .= "\t\t".'<th class="lok_metabox_names"><label for="'.$lok_metabox.'">'.$lok_metabox['label'].'</label></th>'."\n";
        	        $output .= "\t\t".'<td><input type="hidden" name="datepicker-image" value="' . admin_url( 'images/date-button.gif' ) . '" /><input class="lok_input_calendar" type="text" name="'.$lok_name.'[date]" id="'.esc_attr( $lok_id ).'" value="' . esc_attr( date( 'm/d/Y', $lok_metaboxvalue ) ) . '">';
        	        
        	        $output .= ' <span class="lok-timestamp-at">' . __( '@', 'lokthemes' ) . '</span> ';
        	        
        	        $output .= '<select name="' . $lok_name . '[hour]" class="lok-select-timestamp">' . "\n";
						for ( $i = 0; $i <= 23; $i++ ) {
							
							$j = $i;
							if ( $i < 10 ) {
								$j = '0' . $i;
							}
							
							$output .= '<option value="' . $i . '"' . selected( date( 'H', $lok_metaboxvalue ), $j, false ) . '>' . $j . '</option>' . "\n";
						}
					$output .= '</select>' . "\n";
					
					$output .= '<select name="' . $lok_name . '[minute]" class="lok-select-timestamp">' . "\n";
						for ( $i = 0; $i <= 59; $i++ ) {
							
							$j = $i;
							if ( $i < 10 ) {
								$j = '0' . $i;
							}
							
							$output .= '<option value="' . $i . '"' . selected( date( 'i', $lok_metaboxvalue ), $j, false ) .'>' . $j . '</option>' . "\n";
						}
					$output .= '</select>' . "\n";
					/*
					$output .= '<select name="' . $lok_name . '[second]" class="lok-select-timestamp">' . "\n";
						for ( $i = 0; $i <= 59; $i++ ) {
							
							$j = $i;
							if ( $i < 10 ) {
								$j = '0' . $i;
							}
							
							$output .= '<option value="' . $i . '"' . selected( date( 's', $lok_metaboxvalue ), $j, false ) . '>' . $j . '</option>' . "\n";
						}
					$output .= '</select>' . "\n";
        	        */
        	        $output .= '<span class="lok_metabox_desc">'.$lok_metabox['desc'].'</span></td>'."\n";
        	        $output .= "\t".'</tr>'."\n";

        	    }
        } // End IF Statement
    }

    $output .= '</table>'."\n\n";
    
    echo $output;
} // End lokthemes_metabox_create()

/*-----------------------------------------------------------------------------------*/

/**
 * lokthemes_metabox_handle function.
 * 
 * @access public
 * @return void
 */
function lokthemes_metabox_handle() {

    $pID = '';
    global $globals, $post;

    $lok_metaboxes = get_option( 'lok_custom_template' );

    $seo_metaboxes = get_option( 'lok_custom_seo_template' );
	
    if( ! empty( $seo_metaboxes ) && get_option( 'seo_lok_hide_fields' ) != 'true' ) {
    	$lok_metaboxes = array_merge( (array)$lok_metaboxes, (array)$seo_metaboxes );
    }

    // Sanitize post ID.
    if( isset( $_POST['post_ID'] ) ) {

		$pID = intval( $_POST['post_ID'] );

    } // End IF Statement

    // Don't continue if we don't have a valid post ID.
    if ( $pID == 0 ) {

    	return;

    } // End IF Statement

    $upload_tracking = array();

    if ( isset( $_POST['action'] ) && $_POST['action'] == 'editpost' ) {

        foreach ( $lok_metaboxes as $k => $lok_metabox ) { // On Save.. this gets looped in the header response and saves the values submitted
            if( isset( $lok_metabox['type'] ) && ( in_array( $lok_metabox['type'], lokthemes_metabox_fieldtypes() ) ) ) {
				$var = $lok_metabox['name'];

				// Get the current value for checking in the script.
			    $current_value = '';
			    $current_value = get_post_meta( $pID, $var, true );

				if ( isset( $_POST[$var] ) ) {

					// Sanitize the input.
					$posted_value = '';
					$posted_value = $_POST[$var];

					 // If it doesn't exist, add the post meta.
					if(get_post_meta( $pID, $var ) == "") {

						add_post_meta( $pID, $var, $posted_value, true );

					}
					// Otherwise, if it's different, update the post meta.
					elseif( $posted_value != get_post_meta( $pID, $var, true ) ) {

						update_post_meta( $pID, $var, $posted_value );

					}
					// Otherwise, if no value is set, delete the post meta.
					elseif($posted_value == "") {

						delete_post_meta( $pID, $var, get_post_meta( $pID, $var, true ) );

					} // End IF Statement

				} elseif ( ! isset( $_POST[$var] ) && $lok_metabox['type'] == 'checkbox' ) {

					update_post_meta( $pID, $var, 'false' );

				} else {

					delete_post_meta( $pID, $var, $current_value ); // Deletes check boxes OR no $_POST

				} // End IF Statement

            } else if ( $lok_metabox['type'] == 'timestamp' ) {
            	// Timestamp save logic.
            	
            	// It is assumed that the data comes back in the following format:
				// date: month/day/year
				// hour: int(2)
				// minute: int(2)
				// second: int(2)
				
				$var = $lok_metabox['name'];
				
				// Format the data into a timestamp.
				$date = $_POST[$var]['date'];
				
				$hour = $_POST[$var]['hour'];
				$minute = $_POST[$var]['minute'];
				// $second = $_POST[$var]['second'];
				$second = '00';
				
				$day = substr( $date, 3, 2 );
				$month = substr( $date, 0, 2 );
				$year = substr( $date, 6, 4 );
				
				$timestamp = mktime( $hour, $minute, $second, $month, $day, $year );
				
				update_post_meta( $pID, $var, $timestamp );
            
            } elseif( isset( $lok_metabox['type'] ) && $lok_metabox['type'] == 'upload' ) { // So, the upload inputs will do this rather

				$id = $lok_metabox['name'];
				$override['action'] = 'editpost';

			    if(!empty($_FILES['attachement_'.$id]['name'])){ //New upload
			    $_FILES['attachement_'.$id]['name'] = preg_replace( '/[^a-zA-Z0-9._\-]/', '', $_FILES['attachement_'.$id]['name']);
			           $uploaded_file = nxt_handle_upload($_FILES['attachement_' . $id ],$override);
			           $uploaded_file['option_name']  = $lok_metabox['label'];
			           $upload_tracking[] = $uploaded_file;
			           update_post_meta( $pID, $id, $uploaded_file['url'] );

			    } elseif ( empty( $_FILES['attachement_'.$id]['name'] ) && isset( $_POST[ $id ] ) ) {

			       	// Sanitize the input.
					$posted_value = '';
					$posted_value = $_POST[$id];

			        update_post_meta($pID, $id, $posted_value);

			    } elseif ( $_POST[ $id ] == '' )  {

			    	delete_post_meta( $pID, $id, get_post_meta( $pID, $id, true ) );

			    } // End IF Statement

			} // End IF Statement

               // Error Tracking - File upload was not an Image
               update_option( 'lok_custom_upload_tracking', $upload_tracking );

            } // End FOREACH Loop

        } // End IF Statement

} // End lokthemes_metabox_handle()

/*-----------------------------------------------------------------------------------*/

/**
 * lokthemes_metabox_add function.
 * 
 * @access public
 * @since 1.0.0
 * @return void
 */
function lokthemes_metabox_add() {
	$seo_metaboxes = get_option( 'lok_custom_seo_template' );
	$seo_post_types = array( 'post','page' );
	if( defined( 'SEOPOSTTYPES' ) ) {
		$seo_post_types_update = unserialize( constant( 'SEOPOSTTYPES' ) );
	}

	if( ! empty( $seo_post_types_update ) ) {
		$seo_post_types = $seo_post_types_update;
	}

	$lok_metaboxes = get_option( 'lok_custom_template' );

    if ( function_exists( 'add_meta_box' ) ) {

    	if ( function_exists( 'get_post_types' ) ) {
    		$custom_post_list = get_post_types();

    		// Get the theme name for use in multiple meta boxes.
    		$theme_name = get_option( 'lok_themename' );

			foreach ($custom_post_list as $type){

				$settings = array(
									'id' => 'lokthemes-settings',
									'title' => $theme_name . __( ' Custom Settings', 'lokthemes' ),
									'callback' => 'lokthemes_metabox_create',
									'page' => $type,
									'priority' => 'normal',
									'callback_args' => ''
								);

				// Allow child themes/plugins to filter these settings.
				$settings = apply_filters( 'lokthemes_metabox_settings', $settings, $type, $settings['id'] );

				if ( ! empty( $lok_metaboxes ) ) {
					add_meta_box( $settings['id'], $settings['title'], $settings['callback'], $settings['page'], $settings['priority'], $settings['callback_args'] );
				}

				//if(!empty($lok_metaboxes)) Temporarily Removed

				if( array_search( $type, $seo_post_types ) !== false ) {
					if( get_option( 'seo_lok_hide_fields') != 'true' ) {
						add_meta_box( 'lokthemes-seo', $theme_name . ' SEO Settings', 'lokthemes_metabox_create', $type, 'normal', 'high', 'seo' );
					}
				}
			}
    	} else {
    		add_meta_box( 'lokthemes-settings', $theme_name . ' Custom Settings', 'lokthemes_metabox_create', 'post', 'normal' );
        	add_meta_box( 'lokthemes-settings', $theme_name . ' Custom Settings', 'lokthemes_metabox_create', 'page', 'normal' );
        	if(get_option( 'seo_lok_hide_fields') != 'true'){
        		add_meta_box( 'lokthemes-seo', $theme_name . ' SEO Settings', 'lokthemes_metabox_create', 'post', 'normal', 'high', 'seo' );
        		add_meta_box( 'lokthemes-seo', $theme_name . ' SEO Settings', 'lokthemes_metabox_create', 'page', 'normal', 'high', 'seo' );
    		}
    	}

    }
} // End lokthemes_metabox_add()

/*-----------------------------------------------------------------------------------*/

/**
 * lokthemes_metabox_fieldtypes function.
 * 
 * @description Return a filterable array of supported field types.
 * @access public
 * @author Matty
 * @return void
 */
function lokthemes_metabox_fieldtypes() {
	return apply_filters( 'lokthemes_metabox_fieldtypes', array( 'text', 'calendar', 'time', 'select', 'select2', 'radio', 'checkbox', 'textarea', 'images' ) );
} // End lokthemes_metabox_fieldtypes()

/*-----------------------------------------------------------------------------------*/

/**
 * lokthemes_uploader_custom_fields function.
 * 
 * @access public
 * @param int $pID
 * @param string $id
 * @param string $std
 * @param string $desc
 * @return void
 */
function lokthemes_uploader_custom_fields( $pID, $id, $std, $desc ) {

    // Start Uploader
    $upload = get_post_meta( $pID, $id, true);
	$href = cleanSource($upload);
	$uploader = '';
    $uploader .= '<input class="lok_input_text" name="'.$id.'" type="text" value="'.esc_attr($upload).'" />';
    $uploader .= '<div class="clear"></div>'."\n";
    $uploader .= '<input type="file" name="attachement_'.$id.'" />';
    $uploader .= '<input type="submit" class="button button-highlighted" value="Save" name="save"/>';
    if ( $href )
		$uploader .= '<span class="lok_metabox_desc">'.$desc.'</span></td>'."\n".'<td class="lok_metabox_image"><a href="'. $upload .'"><img src="'.get_template_directory_uri().'/functions/thumb.php?src='.$href.'&w=150&h=80&zc=1" alt="" /></a>';

return $uploader;
} // End lokthemes_uploader_custom_fields()

/*-----------------------------------------------------------------------------------*/

/**
 * lok_custom_enqueue function.
 * 
 * @description Enqueue JavaScript files used with the custom fields.
 * @access public
 * @param string $hook
 * @since 2.6.0
 * @return void
 */
function lok_custom_enqueue ( $hook ) {
	nxt_register_script( 'jquery-ui-datepicker', get_template_directory_uri() . '/functions/js/ui.datepicker.js', array( 'jquery-ui-core' ) );
	nxt_register_script( 'jquery-input-mask', get_template_directory_uri() . '/functions/js/jquery.maskedinput-1.2.2.js', array( 'jquery' ) );
	nxt_register_script( 'lok-custom-fields', get_template_directory_uri() . '/functions/js/lok-custom-fields.js', array( 'jquery' ) );
		
  	if ( in_array( $hook, array( 'post.php', 'post-new.php', 'page-new.php', 'page.php' ) ) ) {
		nxt_enqueue_script( 'jquery-ui-datepicker' );
		nxt_enqueue_script( 'jquery-input-mask' );
  		nxt_enqueue_script( 'lok-custom-fields' );
  	}
} // End lok_custom_enqueue()

/*-----------------------------------------------------------------------------------*/

/**
 * lok_custom_enqueue_css function.
 * 
 * @description Enqueue CSS files used with the custom fields.
 * @access public
 * @author Matty
 * @since 4.8.0
 * @return void
 */
function lok_custom_enqueue_css () {
	global $pagenow;
	
	nxt_register_style( 'lok-custom-fields', get_template_directory_uri() . '/functions/css/lok-custom-fields.css' );
	nxt_register_style( 'jquery-ui-datepicker', get_template_directory_uri() . '/functions/css/jquery-ui-datepicker.css' );
	
	if ( in_array( $pagenow, array( 'post.php', 'post-new.php', 'page-new.php', 'page.php' ) ) ) {
		nxt_enqueue_style( 'lok-custom-fields' );
		nxt_enqueue_style( 'jquery-ui-datepicker' );
	}
} // End lok_custom_enqueue_css()

/*-----------------------------------------------------------------------------------*/

/**
 * Specify action hooks for the functions above.
 *
 * @access public
 * @since 1.0.0
 * @return void
 */
add_action( 'admin_enqueue_scripts', 'lok_custom_enqueue', 10, 1 );
add_action( 'admin_print_styles', 'lok_custom_enqueue_css', 10 );
add_action( 'edit_post', 'lokthemes_metabox_handle', 10 );
add_action( 'admin_menu', 'lokthemes_metabox_add', 10 ); // Triggers lokthemes_metabox_create()
?>