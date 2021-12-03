<?php 

	/**
	* Visual Composer Argenta Button shortcode
	*/

	add_shortcode( 'argenta_sc_button', 'argenta_sc_button_func' );

	function argenta_sc_button_func( $atts ) {
		if ( is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$layout = isset( $layout ) ? argenta_extra_filter_string( $layout, 'string', 'fill') : 'fill';
		$shape_rounded = isset( $shape_rounded ) ? argenta_extra_filter_boolean( $shape_rounded ) : false;
		$shape_size = isset( $shape_size ) ? argenta_extra_filter_string( $shape_size, 'string', '' ) : '';
		$title = isset( $title ) ? argenta_extra_filter_string( $title, 'string', '' ) : '';
		$full_width = isset( $full_width ) ? argenta_extra_filter_boolean( $full_width ) : false;
		$title_typo = ( isset( $title_typo ) ) ? argenta_extra_filter_string( $title_typo ) : false;
		$icon_use = isset( $icon_use ) ? argenta_extra_filter_boolean( $icon_use ) : false;
		$icon_type = isset( $icon_type ) ? argenta_extra_filter_string( $icon_type, 'string', 'font_icon' ) : 'font_icon';
		$icon_as_icon = isset( $icon_as_icon ) ? argenta_extra_filter_string( $icon_as_icon, 'string', '' ) : '';
		$icon_as_image = isset( $icon_as_image ) ? argenta_extra_filter_string( $icon_as_image, 'string', '' ) : '';
		$color = isset( $color ) ? argenta_extra_filter_string( $color, 'string', false ) : false;
		$text_color = isset( $text_color ) ? argenta_extra_filter_string( $text_color, 'string', false ) : false;
		$hover_text_color = isset( $hover_text_color ) ? argenta_extra_filter_string( $hover_text_color, 'string', false ) : false;
		$appearance_effect = ( isset( $appearance_effect ) ) ? argenta_extra_filter_string( $appearance_effect, 'attr', 'none' )  : 'none';
		$appearance_duration = ( isset( $appearance_duration ) ) ? argenta_extra_filter_string( $appearance_duration, 'attr', false )  : false;
		$css_class = isset( $css_class ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' ) : '';

		if ( isset( $link ) ) {
			$link = argenta_extra_parse_VC_link_params( $link, array( 'caption' => __( 'Click me', 'argenta_extra' ) ) );
		} else {
			$link = argenta_extra_parse_VC_link_params( '', array( 'caption' => __( 'Click me', 'argenta_extra' ) ) );
		}

		// Styling
		$button_uniqid = uniqid( 'argenta-custom-' );

		if ( $icon_type == 'font_icon' && $icon_as_icon ) {
			$GLOBALS['argenta_pixellove_fonts'][] = $icon_as_icon;
		}
		
		$button_class = '';

		if ( $shape_rounded ) {
			$button_class .= ' btn-rounded';
		}

		switch ( $layout ) {
			case 'outline':
				$button_class .= ' btn-outline';
				break;
			case 'flat':
				$button_class .= ' btn-flat';
				break;
			case 'link':
				$button_class .= ' btn-link';
				break;
		}

		switch ( $shape_size ) {
			case 'small':
				$button_class .= ' btn-small';
				break;
			case 'large':
				$button_class .= ' btn-large';
				break;
			case 'huge':
				$button_class .= ' btn-huge';
				break;
		}

		if ( $full_width ) {
			$button_class .= ' full-width';
		}

		$color_css = '';
		$color_css_hover = '';
		
		if ( $color ) {
			if ( $layout == 'outline' ) {
				$color_css = 'color: ' . $color . '; border-color: ' . $color . ';';
				$color_css_hover = 'background-color: ' . $color . '; color: #ffffff;';
			} elseif ( $layout == 'flat' ) {
				$color_css = 'color: ' . $color . ';';
				$color_css_hover = 'background-color: ' . $color . '; color: #ffffff;';
			} elseif ( $layout == 'link' ) {
				$color_css = 'color: ' . $color . ';';
			} else {
				$color_css = 'background-color: ' . $color . '; border-color: ' . $color . ';';
				$color_css_hover = 'background-color: transparent; color: ' . $color . ';';
			}
		}

		if ( $text_color ) {
			$color_css .= 'color: ' . $text_color . ';';
		}

		if ( $hover_text_color ) {
			$color_css_hover .= 'color: ' . $hover_text_color . ';';
		}

		$element_custom_fonts = array();
		$title_custom_font = argenta_extra_parse_VC_typography_custom_font( $title_typo );
		if ( $title_custom_font ) {
			$element_custom_fonts[] = $title_custom_font;
		}
		$title_css = argenta_extra_parse_VC_typography_to_CSS( $title_typo );

		$with_styles = ( $color_css_hover || $color_css || $title_css || count($element_custom_fonts) > 0 );

		// Assembling
		ob_start();
		include( 'layout/button.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
			'name' => __( 'Button', 'argenta_extra' ),
			'description' => __( 'Simple eye catching button', 'argenta_extra' ),
			'base' => 'argenta_sc_button',
			'category' => __( 'Argenta', 'argenta_extra' ),
			'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-Button.png',
			'params' => array(

				// General
				array(
					'type' => 'argenta_choose_box',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Layout', 'argenta_extra' ),
					'param_name' => 'layout',
					'value' => array(
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon42.png',
							'key' => 'fill',
							'title' => __( 'Fill', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon43.png',
							'key' => 'outline',
							'title' => __( 'Outline', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon44.png',
							'key' => 'flat',
							'title' => __( 'Flat', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon44.png',
							'key' => 'link',
							'title' => __( 'Link', 'argenta_extra' ),
						)
					)
				),
				array(
					'type' => 'vc_link',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Link', 'argenta_extra' ),
					'param_name' => 'link',
					'description' => __( 'Fill title field to change the \'Get started\' inscription.', 'argenta_extra' ),
				),
				array(
					'type' => 'dropdown',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Button size', 'argenta_extra' ),
					'param_name' => 'shape_size',
					'value' => array(
						__( 'Default', 'argenta_extra' ) => '',
						__( 'Small', 'argenta_extra' ) => 'small',
						__( 'Large', 'argenta_extra' ) => 'large',
						__( 'Huge', 'argenta_extra' ) => 'huge',
					),
				),
				array(
					'type' => 'argenta_check',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Full width', 'argenta_extra' ),
					'param_name' => 'full_width',
					'value' => array(
						__( 'Yes, set 100% width', 'argenta_extra' ) => '0'
					),
				),

				// Icon
				array(
					'type' => 'argenta_check',
					'group' => __( 'Icon', 'argenta_extra' ),
					'heading' => __( 'Add icon?', 'argenta_extra' ),
					'param_name' => 'icon_use',
					'value' => array(
						__( 'Yes, sure', 'argenta_extra' ) => '0'
					),
				),
				array(
					'type' => 'dropdown',
					'group' => __( 'Icon', 'argenta_extra' ),
					'heading' => __( 'Icon type', 'argenta_extra' ),
					'param_name' => 'icon_type',
					'value' => array(
						__( 'Font icon', 'argenta_extra' ) => 'font_icon',
						__( 'Custom image', 'argenta_extra' ) => 'user_image'
					),
					'dependency' => array(
						'element' => 'icon_use',
						'value' => '1'
					)
				),
				array(
					'type' => 'argenta_icon_picker',
					'group' => __( 'Icon', 'argenta_extra' ),
					'heading' => __( 'Icon', 'argenta_extra' ),
					'param_name' => 'icon_as_icon',
					'description' => __( 'Choose icon.', 'argenta_extra' ),
					'dependency' => array(
						'element' => 'icon_type',
						'value' => array(
							'font_icon'
						)
					)
				),
				array(
					'type' => 'attach_image',
					'group' => __( 'Icon', 'argenta_extra' ),
					'heading' => __( 'Icon image', 'argenta_extra' ),
					'param_name' => 'icon_as_image',
					'description' => __( 'Choose icon image.', 'argenta_extra' ),
					'dependency' => array(
						'element' => 'icon_type',
						'value' => array(
							'user_image'
						)
					)
				),

				// Typography
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_heading',
					'value' => __( 'Button text', 'argenta_extra' ),
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'title_typo',
				),
				
				// Style
				array(
					'type' => 'argenta_check',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Rounded shape', 'argenta_extra' ),
					'param_name' => 'shape_rounded',
					'value' => array(
						__( 'Yes', 'argenta_extra' ) => '0'
					),
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Button color', 'argenta_extra' ),
					'param_name' => 'color',
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Text color', 'argenta_extra' ),
					'param_name' => 'text_color',
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Hover text color', 'argenta_extra' ),
					'param_name' => 'hover_text_color',
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