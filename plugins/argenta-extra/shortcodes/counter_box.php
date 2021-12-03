<?php 

	/**
	* Visual Composer Argenta Counter box shortcode
	*/

	add_shortcode( 'argenta_sc_counter_box', 'argenta_sc_counter_box_func' );

	function argenta_sc_counter_box_func( $atts ) {
		if ( is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$layout = isset( $layout ) ? argenta_extra_filter_string( $layout, 'string', 'percent') : 'percent';
		
		$count_number = isset( $count_number ) ? argenta_extra_filter_string( str_replace( ' ', '', $count_number ), 'string', '0') : '0';
		$title = isset( $title ) ? argenta_extra_filter_string( $title, 'string', false) : false;
		$subtitle = isset( $subtitle ) ? argenta_extra_filter_string( $subtitle, 'string', false) : false;
		$subtitle_position = isset( $subtitle_position ) ? argenta_extra_filter_string( $subtitle_position, 'string', 'bottom') : 'bottom';

		$icon_position = isset( $icon_position ) ? argenta_extra_filter_string( $icon_position, 'string', 'left') : 'left';
		$icon_type = isset( $icon_type ) ? argenta_extra_filter_string( $icon_type, 'string', 'font_icon' ) : 'font_icon';
		$icon_as_icon = isset( $icon_as_icon ) ? argenta_extra_filter_string( $icon_as_icon, 'string', '' ) : '';
		$icon_as_image = isset( $icon_as_image ) ? argenta_extra_filter_string( $icon_as_image, 'string', '' ) : '';

		$title_typo = ( isset( $title_typo ) ) ? argenta_extra_filter_string( $title_typo ) : false;
		$subtitle_typo = ( isset( $subtitle_typo ) ) ? argenta_extra_filter_string( $subtitle_typo ) : false;
		$count_typo = ( isset( $count_typo ) ) ? argenta_extra_filter_string( $count_typo ) : false;

		$count_color = isset( $count_color ) ? argenta_extra_filter_string( $count_color, 'string', false ) : false;
		$icon_color = isset( $icon_color ) ? argenta_extra_filter_string( $icon_color, 'string', false ) : false;
		$title_color = isset( $title_color ) ? argenta_extra_filter_string( $title_color, 'string', false ) : false;
		$subtitle_color = isset( $subtitle_color ) ? argenta_extra_filter_string( $subtitle_color, 'attr', false ) : false;

		$css_class = isset( $css_class ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' ) : '';

		// Styling
		$counter_box_uniqid = uniqid( 'argenta-custom-' );
		
		if ( $icon_type == 'font_icon' && $icon_as_icon ) {
			$GLOBALS['argenta_pixellove_fonts'][] = $icon_as_icon;
		}

		if ($icon_as_image) {
			$icon_image = wp_get_attachment_image( $icon_as_image);
		}

		$count_css = ( $count_color ) ? 'color: ' . $count_color . ';' : '';
		$icon_css = ( $icon_color ) ? 'color: ' . $icon_color . ';' : false;
		$title_css = ( $title_color ) ? 'color: ' . $title_color . ';' : '';
		$subtitle_css = ( $subtitle_color ) ? 'color: ' . $subtitle_color . ';' : '';

		$element_custom_fonts = array();
		$title_custom_font = argenta_extra_parse_VC_typography_custom_font( $title_typo );
		if ( $title_custom_font ) {
			$element_custom_fonts[] = $title_custom_font;
		}
		$subtitle_custom_font = argenta_extra_parse_VC_typography_custom_font( $subtitle_typo );
		if ( $subtitle_custom_font ) {
			$element_custom_fonts[] = $subtitle_custom_font;
		}
		$count_custom_font = argenta_extra_parse_VC_typography_custom_font( $count_typo );
		if ( $count_custom_font ) {
			$element_custom_fonts[] = $count_custom_font;
		}

		$title_css = $title_css . argenta_extra_parse_VC_typography_to_CSS( $title_typo );
		$subtitle_css = $subtitle_css . argenta_extra_parse_VC_typography_to_CSS( $subtitle_typo );
		$count_css = $count_css . argenta_extra_parse_VC_typography_to_CSS( $count_typo );

		$title_css = $title_css ? $title_css : false;
		$subtitle_css = $subtitle_css ? $subtitle_css : false;

		$with_styles = ( $icon_css || $title_css || $subtitle_css || $count_css || count($element_custom_fonts) > 0 );

		// Assembling
		ob_start();
		include( 'layout/counter_box.php' );
		$content = ob_get_contents();
		ob_end_clean();

		argenta_gh_add_required_script( 'counter-box' );

		return $content;
	}


	vc_map( array(
			'name' => __( 'Counter Box', 'argenta_extra' ),
			'description' => __( 'Facts and numbers counter block', 'argenta_extra' ),
			'base' => 'argenta_sc_counter_box',
			'category' => __( 'Argenta', 'argenta_extra' ),
			'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-CounterBox.png',
			'params' => array(
				// General
				array(
					'type' => 'argenta_choose_box',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Layout', 'argenta_extra' ),
					'param_name' => 'layout',
					'value' => array(
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon50.png',
							'key' => 'number',
							'title' => __( 'Number', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon51.png',
							'key' => 'number_with_icon',
							'title' => __( 'Number with Icon', 'argenta_extra' ),
						)
					)
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Number', 'argenta_extra' ),
					'param_name' => 'count_number',
					'value' => '',
					'description' => __( 'The number of count', 'argenta_extra' ),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Title', 'argenta_extra' ),
					'param_name' => 'title',
					'value' => '',
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Subtitle', 'argenta_extra' ),
					'param_name' => 'subtitle',
					'value' => '',
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Subtitle position', 'argenta_extra' ),
					'param_name' => 'subtitle_position',
					'value' => array(
						__( 'Bottom', 'argenta_extra' ) => 'bottom',
						__( 'Top', 'argenta_extra' ) => 'top'
					)
				),

				// Icon
				array(
					'type' => 'dropdown',
					'group' => __( 'Icon', 'argenta_extra' ),
					'heading' => __( 'Icon position', 'argenta_extra' ),
					'param_name' => 'icon_position',
					'value' => array(
						__( 'Left', 'argenta_extra' ) => 'left',
						__( 'Right', 'argenta_extra' ) => 'right',
						__( 'Top', 'argenta_extra' ) => 'top'
					),
					'dependency' => array(
						'element' => 'layout',
						'value' => 'number_with_icon'
					)
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
						'element' => 'layout',
						'value' => array(
							'number_with_icon',
							'icon'
						)
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
					'param_name' => 'typo_tab_divider_count',
					'value' => __( 'Number of count', 'argenta_extra' ),
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'count_typo',
				),
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_title',
					'value' => __( 'Title', 'argenta_extra' ),
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'title_typo',
				),
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_subtitle',
					'value' => __( 'Subtitle', 'argenta_extra' ),
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'subtitle_typo',
				),
				
				// Style
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Number color', 'argenta_extra' ),
					'param_name' => 'count_color'
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Icon color', 'argenta_extra' ),
					'param_name' => 'icon_color',
					'dependency' => array(
						'element' => 'layout',
						'value' => 'number_with_icon'
					)
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Title color', 'argenta_extra' ),
					'param_name' => 'title_color'
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Subtitle color', 'argenta_extra' ),
					'param_name' => 'subtitle_color'
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