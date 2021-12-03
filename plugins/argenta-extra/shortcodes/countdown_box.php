<?php 

	/**
	* Visual Composer Argenta Countdown box shortcode
	*/

	add_shortcode( 'argenta_sc_countdown_box', 'argenta_sc_countdown_box_func' );

	function argenta_sc_countdown_box_func( $atts ) {
		if ( is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$layout = isset( $layout ) ? argenta_extra_filter_string( $layout, 'string', 'default') : 'default';
		$countdown_underline = isset( $countdown_underline ) ? argenta_extra_filter_boolean( $countdown_underline ) : false;
		$countdown_filled = isset( $countdown_filled ) ? argenta_extra_filter_boolean( $countdown_filled ) : true;
		$countdown_date = isset( $countdown_date ) ? argenta_extra_filter_string( $countdown_date, 'string', '2017/1/1 0:0:0') : '2017/1/1 0:0:0';

		$numbers_typo = ( isset( $numbers_typo ) ) ? argenta_extra_filter_string( $numbers_typo ) : false;
		$titles_typo = ( isset( $titles_typo ) ) ? argenta_extra_filter_string( $titles_typo ) : false;

		$numbers_color = isset( $numbers_color ) ? argenta_extra_filter_string( $numbers_color, 'string', false ) : false;
		$titles_color = isset( $titles_color ) ? argenta_extra_filter_string( $titles_color, 'string', false ) : false;
		$box_color = isset( $box_color ) ? argenta_extra_filter_string( $box_color, 'string', false ) : false;
		$box_border_color = isset( $box_border_color ) ? argenta_extra_filter_string( $box_border_color, 'string', false ) : false;
		$divider_dots_color = isset( $divider_dots_color ) ? argenta_extra_filter_string( $divider_dots_color, 'string', false ) : false;

		$css_class = isset( $css_class ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' ) : '';

		// Styling
		$countdown_box_uniqid = uniqid( 'argenta-custom-' );

		$countdown_box_class = ( $layout == 'boxed' ) ? ' countdown-box-outline' : '';
		$countdown_box_class .= ( $countdown_underline && $layout == 'boxed' ) ? ' countdown-box-underline' : '';
		$countdown_box_class .= ( $countdown_filled && $layout == 'boxed' ) ? ' countdown-box-filled' : '';

		$numbers_css = ( $numbers_color ) ? 'color: ' . $numbers_color . ';'  : '';
		$titles_css = ( $titles_color ) ? 'color: ' . $titles_color . ';'  : '';
		$box_css = ( $box_color ) ? 'background-color: ' . $box_color . ';' : '';
		$box_css .= ( $box_border_color ) ? ' border-color: ' . $box_border_color . ';'  : '';
		$box_line_css = ( $box_border_color ) ? 'background: ' . $box_border_color . ';' : '';
		$box_bg_css = ( $box_color ) ? 'background-color: ' . $box_color . ';' : '';
		$box_border_css = ( $box_border_color ) ? 'border-color: ' . $box_border_color . ';' : '';
		$divider_dots_css = ( $divider_dots_color ) ? 'border-color: ' . $divider_dots_color . ';' : '';

		$element_custom_fonts = array();
		$numbers_custom_font = argenta_extra_parse_VC_typography_custom_font( $numbers_typo );
		if ( $numbers_custom_font ) {
			$element_custom_fonts[] = $numbers_custom_font;
		}
		$titles_custom_font = argenta_extra_parse_VC_typography_custom_font( $titles_typo );
		if ( $titles_custom_font ) {
			$element_custom_fonts[] = $titles_custom_font;
		}

		$numbers_css = $numbers_css . argenta_extra_parse_VC_typography_to_CSS( $numbers_typo );
		$titles_css = $titles_css . argenta_extra_parse_VC_typography_to_CSS( $titles_typo );

		$with_styles = ( $numbers_css || $box_css || $titles_css || count($element_custom_fonts) > 0 );

		// Assembling
		ob_start();
		include( 'layout/countdown_box.php' );
		$content = ob_get_contents();
		ob_end_clean();

		argenta_gh_add_required_script( 'countdown-box' );

		return $content;
	}


	vc_map( array(
			'name' => __( 'Countdown Box', 'argenta_extra' ),
			'description' => __( 'Time countdown module', 'argenta_extra' ),
			'base' => 'argenta_sc_countdown_box',
			'category' => __( 'Argenta', 'argenta_extra' ),
			'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-CountDownBox.png',
			'params' => array(

				// General
				array(
					'type' => 'argenta_choose_box',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Layout', 'argenta_extra' ),
					'param_name' => 'layout',
					'value' => array(
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon48.png',
							'key' => 'default',
							'title' => __( 'Default', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon49.png',
							'key' => 'boxed',
							'title' => __( 'Boxed', 'argenta_extra' ),
						)
					)
				),
				array(
					'type' => 'argenta_check',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Underline', 'argenta_extra' ),
					'param_name' => 'countdown_underline',
					'value' => array(
						__( 'Yes', 'argenta_extra' ) => '0'
					),
					'dependency' => array(
						'element' => 'layout',
						'value' => 'boxed'
					)
				),
				array(
					'type' => 'argenta_check',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Filled', 'argenta_extra' ),
					'param_name' => 'countdown_filled',
					'value' => array(
						__( 'Yes', 'argenta_extra' ) => '1'
					),
					'dependency' => array(
						'element' => 'layout',
						'value' => 'boxed'
					)
				),
				array(
					'type' => 'argenta_datetime',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Expiration date', 'argenta_extra' ),
					'param_name' => 'countdown_date'
				),

				// Typography
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_numbers',
					'value' => __( 'Numbers', 'argenta_extra' ),
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'numbers_typo',
				),
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_titles',
					'value' => __( 'Titles', 'argenta_extra' ),
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'titles_typo'
				),
				
				// Style
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Numbers color', 'argenta_extra' ),
					'param_name' => 'numbers_color',
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Titles color', 'argenta_extra' ),
					'param_name' => 'titles_color',
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Divider dots', 'argenta_extra' ),
					'param_name' => 'divider_dots_color',
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Box color', 'argenta_extra' ),
					'param_name' => 'box_color',
					'dependency' => array(
						'element' => 'countdown_filled',
						'value' => '1'
					)
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Box border color', 'argenta_extra' ),
					'param_name' => 'box_border_color',
					'dependency' => array(
						'element' => 'countdown_filled',
						'value' => '1'
					)
				),
				array(
					'type' => 'textfield',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Custom CSS class', 'argenta_extra' ),
					'param_name' => 'css_class',
					'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class, and then use this class in your custom CSS.', 'argenta_extra' ),
				),
			)
		)
	);