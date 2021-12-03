<?php 

	/**
	* Visual Composer Argenta Social bar shortcode
	*/

	add_shortcode( 'argenta_sc_contact_form', 'argenta_sc_contact_form_func' );

	function argenta_sc_contact_form_func( $atts ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$form_id = isset( $form_id ) ? argenta_extra_filter_string( $form_id, 'string', '') : '';
		$form_style = isset( $form_style ) ? argenta_extra_filter_string( $form_style, 'string', 'border') : 'border';
		$fields_offset = isset( $fields_offset ) ? argenta_extra_filter_string( $fields_offset, 'string', '10px') : '10px';

		$button = isset( $button ) ? argenta_extra_filter_string( $button ) : false;
		$button_type = isset( $button_type ) ? argenta_extra_filter_string( $button_type, 'string', 'default') : 'default';
		$button_position = isset( $button_position ) ? argenta_extra_filter_string( $button_position, 'string', 'center') : 'center';
		$button_rounded = isset( $button_rounded ) ? argenta_extra_filter_boolean( $button_rounded ) : false;
		$button_color = ( isset( $button_color ) ) ? argenta_extra_filter_string( $button_color ) : false;
		$button_text_color = ( isset( $button_text_color ) ) ? argenta_extra_filter_string( $button_text_color ) : false;
		$button_text_hover_color = ( isset( $button_text_hover_color ) ) ? argenta_extra_filter_string( $button_text_hover_color ) : false;
		$fields_color = ( isset( $fields_color ) ) ? argenta_extra_filter_string( $fields_color ) : false;
		$fields_border_color = ( isset( $fields_border_color ) ) ? argenta_extra_filter_string( $fields_border_color ) : false;
		$fields_text_color = ( isset( $fields_text_color ) ) ? argenta_extra_filter_string( $fields_text_color ) : false;
		$appearance_effect = ( isset( $appearance_effect ) ) ? argenta_extra_filter_string( $appearance_effect, 'attr', 'none' )  : 'none';
		$appearance_duration = ( isset( $appearance_duration ) ) ? argenta_extra_filter_string( $appearance_duration, 'attr', false )  : false;
		$css_class = ( isset( $css_class ) ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' )  : '';

		// Styling
		$contact_form_uniqid = uniqid('argenta-custom-');

		$contact_form_class = '';
		if ( $button_position ) {
			$contact_form_class .= ' text-' . $button_position;
		}
		if ( $form_style != 'border' ) {
			$contact_form_class .= ' ' . $form_style;
		}
		if ( intval( $fields_offset ) == 0 ) {
			$contact_form_class .= ' without-label-offset';
		}

		$fields_css = '';
		$fields_placeholder_css = '';
		if ( $fields_color ) {
			if ( $form_style == 'classic') {
				$fields_css .= 'border-color: ' . $fields_color . '; color: ' . $fields_color . ';';
				$fields_placeholder_css .= 'color: ' . $fields_color . ';';
			} else {
				$fields_css .= 'background: ' . $fields_color . ';';
			}
		}
		if ( $fields_border_color && $form_style == 'border' ) {
			$fields_css .= 'border-color: ' . $fields_border_color . ';';
		}
		if ( $fields_text_color ) {
			$fields_css .= 'color: ' . $fields_text_color . ';';
			$fields_placeholder_css .= 'color: ' . $fields_text_color . ';';
		}

		
		// Read more button
		$button = preg_replace( '/\&amp\;/', '&', $button );
		parse_str( $button, $button_settings );

		// Backward compatibility
		if ( $button_color && !isset( $button_settings['color'] ) ) {
			$button_settings['color'] = $button_color;
		}
		if ( $button_rounded && !isset( $button_settings['rounded'] ) ) {
			$button_settings['rounded'] = 'true';
		}
		if ( $button_type && $button_type != 'color_button' && !isset( $button_settings['type'] ) ) {
			$button_settings['type'] = $button_type;
		}
		if ( $button_text_color && !isset( $button_settings['text-color'] ) ) {
			$button_settings['text-color'] = $button_text_color;
		}
		if ( $button_text_hover_color && !isset( $button_settings['text-hover-color'] ) ) {
			$button_settings['text-hover-color'] = $button_text_hover_color;
		}

		$button_css = argenta_extra_parse_VC_button_to_css( $button_settings );

		$label_css = '';
		if ( $fields_offset ) {
			$label_css = 'padding-top: ' . $fields_offset . '; padding-right: ' . $fields_offset .';';
		}

		$with_styles = ( $fields_css || $button_css['css'] || $button_css['hover-css'] || $label_css );

		// Assembling
		ob_start();
		include( 'layout/contact_form.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


		$argenta_extra_cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

		$argenta_extra_contact_forms = array();
		if ( $argenta_extra_cf7 ) {
			foreach ( $argenta_extra_cf7 as $cform ) {
				$argenta_extra_contact_forms[ $cform->post_title ] = $cform->ID;
			}
		} else {
			$argenta_extra_contact_forms[ __( 'No contact forms found', 'argenta_extra' ) ] = 0;
		}

		vc_map( array(
				'name' => __( 'Contact Form', 'argenta_extra' ),
				'description' => __( 'Argenta Contact 7 form module', 'argenta_extra' ),
				'base' => 'argenta_sc_contact_form',
				'category' => __( 'Argenta', 'argenta_extra' ),
				'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-ContactForm.png',
				'params' => array(

					// General
					array(
						'type' => 'dropdown',
						'group' => __( 'General', 'argenta_extra' ),
						'heading' => __( 'Form', 'argenta_extra' ),
						'param_name' => 'form_id',
						'value' => $argenta_extra_contact_forms,
					),
					array(
						'type' => 'argenta_choose_box',
						'group' => __( 'General', 'argenta_extra' ),
						'heading' => __( 'Form style', 'argenta_extra' ),
						'param_name' => 'form_style',
						'value' => array(
							array(
								'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon77.png',
								'key' => 'border',
								'title' => __( 'Outline', 'argenta_extra' ),
							),
							array(
								'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon78.png',
								'key' => 'flat',
								'title' => __( 'Flat', 'argenta_extra' ),
							),
							array(
								'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon79.png',
								'key' => 'classic',
								'title' => __( 'Classic', 'argenta_extra' ),
							)
						)
					),
					array(
						'type' => 'textfield',
						'group' => __( 'General', 'argenta_extra' ),
						'heading' => __( 'Fields offset', 'argenta_extra' ),
						'param_name' => 'fields_offset',
						'description' => __( 'CSS value.', 'argenta_extra' ),
						'value' => '10px'
					),

					array(
						'type' => 'argenta_divider',
						'group' => __( 'Styles and colors', 'argenta_extra' ),
						'param_name' => 'style_tab_divider_fields',
						'value' => __( 'Fields', 'argenta_extra' ),
					),
					array(
						'type' => 'colorpicker',
						'group' => __( 'Styles and colors', 'argenta_extra' ),
						'heading' => __( 'Fields background color', 'argenta_extra' ),
						'param_name' => 'fields_color',
					),
					array(
						'type' => 'colorpicker',
						'group' => __( 'Styles and colors', 'argenta_extra' ),
						'heading' => __( 'Fields border color', 'argenta_extra' ),
						'param_name' => 'fields_border_color',
						'dependency' => array(
							'element' => 'form_style',
							'value' => array(
								'border',
								'classic'
							)
						)
					),
					array(
						'type' => 'colorpicker',
						'group' => __( 'Styles and colors', 'argenta_extra' ),
						'heading' => __( 'Fields text color', 'argenta_extra' ),
						'param_name' => 'fields_text_color',
					),
					array(
						'type' => 'argenta_divider',
						'group' => __( 'Styles and colors', 'argenta_extra' ),
						'param_name' => 'style_tab_divider_button',
						'value' => __( 'Button', 'argenta_extra' ),
					),
					array(
						'type' => 'argenta_button',
						'group' => __( 'Styles and colors', 'argenta_extra' ),
						'param_name' => 'button',
					),
					array(
						'type' => 'dropdown',
						'group' => __( 'Styles and colors', 'argenta_extra' ),
						'heading' => __( 'Button position', 'argenta_extra' ),
						'param_name' => 'button_position',
						'value' => array(
							__( 'Center', 'argenta_extra' ) => 'center',
							__( 'Left', 'argenta_extra' ) => 'left',
							__( 'Right', 'argenta_extra' ) => 'right'
						),
					),
					array(
						'type' => 'argenta_divider',
						'group' => __( 'Styles and colors', 'argenta_extra' ),
						'param_name' => 'style_tab_divider_other',
						'value' => __( 'Other', 'argenta_extra' ),
					),
					array(
						'type' => 'dropdown',
						'group' => __( 'Styles and colors', 'argenta_extra' ),
						'heading' => __( 'Appearance effect', 'argenta_extra' ),
						'param_name' => 'appearance_effect',
						'value' => array(
							__( 'None', 'argenta_extra' ) => 'none',
							__( 'Fade up', 'argenta_extra' ) => 'fade-up',
							__( 'Fade down', 'argenta_extra' ) => 'fade-down',
							__( 'Fade right', 'argenta_extra' ) => 'fade-right',
							__( 'Fade left', 'argenta_extra' ) => 'fade-left',
							__( 'Flip up', 'argenta_extra' ) => 'flip-up',
							__( 'Flip down', 'argenta_extra' ) => 'flip-down',
							__( 'Zoom in', 'argenta_extra' ) => 'zoom-in',
							__( 'Zoom out', 'argenta_extra' ) => 'zoom-out'
						)
					),
					array(
						'type' => 'textfield',
						'group' => __( 'Styles and colors', 'argenta_extra' ),
						'heading' => __( 'Appearance effect duration', 'argenta_extra' ),
						'param_name' => 'appearance_duration',
						'description' => __( 'Duration accept values from 50ms to 3000ms, with step 50ms', 'argenta_extra' ),
					),
					array(
						'type' => 'textfield',
						'group' => __( 'Styles and colors', 'argenta_extra' ),
						'heading' => __( 'Custom CSS class', 'argenta_extra' ),
						'param_name' => 'css_class',
						'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class, and then use this class in your custom CSS.', 'argenta_extra' )
					),
				)
			)
		);