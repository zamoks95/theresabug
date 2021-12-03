<?php 

	/**
	* Visual Composer Argenta Heading shortcode
	*/

	add_shortcode( 'argenta_sc_heading', 'argenta_sc_heading_func' );

	function argenta_sc_heading_func( $atts ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$module_type_layout = ( isset( $module_type_layout ) ) ? argenta_extra_filter_string( $module_type_layout, 'string', 'on_middle' ) : 'on_middle';
		$subtitle_type_layout = ( isset( $subtitle_type_layout ) ) ? argenta_extra_filter_string( $subtitle_type_layout, 'string', 'bottom_subtitle' ) : 'bottom_subtitle';
		$title = ( isset( $title ) ) ? argenta_extra_filter_string( $title, 'string', '' ) : '';
		$subtitle = ( isset( $subtitle ) ) ? argenta_extra_filter_string( $subtitle, 'string', '' ) : '';
		$heading_tag = ( isset( $heading_tag ) ) ? argenta_extra_filter_string( $heading_tag, 'attr', 'h3' )  : 'h3';
		$title_typo = ( isset( $title_typo ) ) ? argenta_extra_filter_string( $title_typo ) : false;
		$subtitle_typo = ( isset( $subtitle_typo ) ) ? argenta_extra_filter_string( $subtitle_typo ) : false;
		$title_color = ( isset( $title_color ) ) ? argenta_extra_filter_string( $title_color ) : false;
		$subtitle_color = ( isset( $subtitle_color ) ) ? argenta_extra_filter_string( $subtitle_color ) : false;
		$divider_color = ( isset( $divider_color ) ) ? argenta_extra_filter_string( $divider_color ) : false;
		$divider_type = ( isset( $divider_type ) ) ? argenta_extra_filter_string( $divider_type, 'string', 'dashed' ) : 'dashed';
		$hide_divider = ( isset( $hide_divider ) ) ? argenta_extra_filter_boolean( $hide_divider ) : false;
		$appearance_effect = ( isset( $appearance_effect ) ) ? argenta_extra_filter_string( $appearance_effect, 'attr', 'none' )  : 'none';
		$appearance_duration = ( isset( $appearance_duration ) ) ? argenta_extra_filter_string( $appearance_duration, 'attr', false )  : false;
		$css_class = ( isset( $css_class ) ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' )  : '';

		// Styling
		$headings_uniqid = uniqid( 'argenta-custom-' );
		
		$title_css = argenta_extra_parse_VC_typography_to_CSS( $title_typo ) . ( ( $title_color ) ? 'color: ' . $title_color . ';' : '' );
		$subtitle_css = argenta_extra_parse_VC_typography_to_CSS( $subtitle_typo ) . ( ( $subtitle_color ) ? 'color: ' . $subtitle_color . ';' : '' );
		$divider_color_css = ( $divider_color ) ? 'background-color: ' . $divider_color . ';' : false;
		$title_css = ( $title_css ) ? $title_css : false;
		$subtitle_css = ( $subtitle_css ) ? $subtitle_css : false;


		$element_custom_fonts = array();
		$title_custom_font = argenta_extra_parse_VC_typography_custom_font( $title_typo );
		if ( $title_custom_font ) {
			$element_custom_fonts[] = $title_custom_font;
		}
		$subtitle_custom_font = argenta_extra_parse_VC_typography_custom_font( $subtitle_typo );
		if ( $subtitle_custom_font ) {
			$element_custom_fonts[] = $subtitle_custom_font;
		}

		$module_layout_class = 'text-center';
		switch ( $module_type_layout ) {
			case 'on_middle':
				$module_layout_class = 'text-center';
				break;
			case 'on_left':
				$module_layout_class = 'text-left';
				break;
			case 'on_right':
				$module_layout_class = 'text-right';
				break;
		}

		$with_styles = ( $title_css || $subtitle_css || $divider_color_css || count( $element_custom_fonts ) > 0 );

		// Assembling
		ob_start();
		include( 'layout/heading.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
		'name' => __( 'Heading', 'argenta_extra' ),
		'description' => __( 'Headnig block', 'argenta_extra' ),
		'base' => 'argenta_sc_heading',
		'category' => __( 'Argenta', 'argenta_extra' ),
		'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-Heading.png',
		'params' => array(
			// General
			array(
				'type' => 'argenta_choose_box',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Module align', 'argenta_extra' ),
				'param_name' => 'module_type_layout',
				'value' => array(
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon9.png',
						'key' => 'on_middle',
						'title' => __( 'Centred', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon10.png',
						'key' => 'on_left',
						'title' => __( 'Left Alignment', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon11.png',
						'key' => 'on_right',
						'title' => __( 'Right Alignment', 'argenta_extra' ),
					)
				)
			),
			array(
				'type' => 'argenta_choose_box',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Subtitle layout', 'argenta_extra' ),
				'param_name' => 'subtitle_type_layout',
				'value' => array(
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon12.png',
						'key' => 'bottom_subtitle',
						'title' => __( 'Bottom Subtitle', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon13.png',
						'key' => 'middle_subtitle',
						'title' => __( 'Middle Subtitle', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon14.png',
						'key' => 'top_subtitle',
						'title' => __( 'Top Subtitle', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon15.png',
						'key' => 'without_subtitle',
						'title' => __( 'Without Subtitle', 'argenta_extra' ),
					)
				)
			),
			array(
				'type' => 'textfield',
				'holder' => 'div class="argenta_heading_VC_gap"',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Title', 'argenta_extra' ),
				'param_name' => 'title',
				'description' => __( 'Title for block.', 'argenta_extra' ),
			),
			array(
				'type' => 'textfield',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Subtitle', 'argenta_extra' ),
				'param_name' => 'subtitle',
				'description' => __( 'And subtitle.', 'argenta_extra' ),
				'dependency' => array(
					'element' => 'subtitle_type_layout',
					'value' => array(
						'bottom_subtitle',
						'middle_subtitle',
						'top_subtitle'
					)
				),
			),
			array(
				'type' => 'dropdown',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Heading tag', 'argenta_extra' ),
				'param_name' => 'heading_tag',
				'value' => array(
					__( '<h1>', 'argenta_extra' ) => 'h1',
					__( '<h2>', 'argenta_extra' ) => 'h2',
					__( '<h3>', 'argenta_extra' ) => 'h3',
					__( '<h4>', 'argenta_extra' ) => 'h4',
					__( '<h5>', 'argenta_extra' ) => 'h5',
				),
				'std' => 'h3',
			),

			// Typography
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
				'dependency' => array(
					'element' => 'subtitle_type_layout',
					'value' => array(
						'bottom_subtitle',
						'middle_subtitle',
						'top_subtitle'
					)
				),
			),
			array(
				'type' => 'argenta_typography',
				'group' => __( 'Typography', 'argenta_extra' ),
				'param_name' => 'subtitle_typo',
				'dependency' => array(
					'element' => 'subtitle_type_layout',
					'value' => array(
						'bottom_subtitle',
						'middle_subtitle',
						'top_subtitle'
					)
				),
			),

			// Style
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Title color', 'argenta_extra' ),
				'param_name' => 'title_color',
			),
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Subtitle color', 'argenta_extra' ),
				'param_name' => 'subtitle_color',
				'dependency' => array(
					'element' => 'subtitle_type_layout',
					'value' => array(
						'bottom_subtitle',
						'middle_subtitle',
						'top_subtitle'
					)
				),
			),
			array(
				'type' => 'dropdown',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Divider type', 'argenta_extra' ),
				'param_name' => 'divider_type',
				'value' => array(
					__( 'Dashed line', 'argenta_extra' ) => 'dashed',
					__( 'Solid line', 'argenta_extra' ) => 'solid'
				)
			),
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Divider color', 'argenta_extra' ),
				'param_name' => 'divider_color'
			),
			array(
				'type' => 'argenta_check',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Hide divider?', 'argenta_extra' ),
				'param_name' => 'hide_divider',
				'value' => array(
					__( 'Yes, please', 'argenta_extra' ) => '0'
				)
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
				'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class, and then use this class in your custom CSS.', 'argenta_extra' ),
			),
		),
	));
?>