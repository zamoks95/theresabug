<?php 

	/**
	* Visual Composer Argenta Chart box shortcode
	*/

	add_shortcode( 'argenta_sc_chart_box', 'argenta_sc_chart_box_func' );

	function argenta_sc_chart_box_func( $atts ) {
		if ( is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$layout = isset( $layout ) ? argenta_extra_filter_string( $layout, 'string', 'percent') : 'percent';
		$percent = isset( $percent ) ? argenta_extra_filter_string( $percent, 'string', '100') : '100';
		$title = isset( $title ) ? argenta_extra_filter_string( $title, 'string', false) : false;
		$subtitle = isset( $subtitle ) ? argenta_extra_filter_string( $subtitle, 'string', false) : false;
		$subtitle_position = isset( $subtitle_position ) ? argenta_extra_filter_string( $subtitle_position, 'string', 'bottom') : 'bottom';
		$icon_position = isset( $icon_position ) ? argenta_extra_filter_string( $icon_position, 'string', 'left') : 'left';
		$icon_type = isset( $icon_type ) ? argenta_extra_filter_string( $icon_type, 'string', 'font_icon' ) : 'font_icon';
		$icon_as_icon = isset( $icon_as_icon ) ? argenta_extra_filter_string( $icon_as_icon, 'string', '' ) : '';
		$icon_as_image = isset( $icon_as_image ) ? argenta_extra_filter_string( $icon_as_image, 'string', '' ) : '';
		$title_typo = ( isset( $title_typo ) ) ? argenta_extra_filter_string( $title_typo ) : false;
		$subtitle_typo = ( isset( $subtitle_typo ) ) ? argenta_extra_filter_string( $subtitle_typo ) : false;
		$percent_typo = ( isset( $percent_typo ) ) ? argenta_extra_filter_string( $percent_typo ) : false;
		$chart_color = isset( $chart_color ) ? argenta_extra_filter_string( $chart_color, 'string', false ) : false;
		$title_color = isset( $title_color ) ? argenta_extra_filter_string( $title_color, 'string', false ) : false;
		$subtitle_color = isset( $subtitle_color ) ? argenta_extra_filter_string( $subtitle_color, 'attr', false ) : false;
		$chart_content_color = isset( $chart_content_color ) ? argenta_extra_filter_string( $chart_content_color, 'attr', false ) : false;
		$css_class = isset( $css_class ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' ) : '';

		// Styling
		$chart_box_uniqid = uniqid( 'argenta-custom-' );
		
		if ( $icon_type == 'font_icon' && $icon_as_icon ) {
			$GLOBALS['argenta_pixellove_fonts'][] = $icon_as_icon;
		}

		$title_css = ( $title_color ) ? 'color: ' . $title_color . ';' : '';
		$subtitle_css = ( $subtitle_color ) ? 'color: ' . $subtitle_color . ';' : '';
		$chart_content_css = ( $chart_content_color ) ? 'color: ' . $chart_content_color . ';' : false;

		$element_custom_fonts = array();
		$title_custom_font = argenta_extra_parse_VC_typography_custom_font( $title_typo );
		if ( $title_custom_font ) {
			$element_custom_fonts[] = $title_custom_font;
		}
		$subtitle_custom_font = argenta_extra_parse_VC_typography_custom_font( $subtitle_typo );
		if ( $subtitle_custom_font ) {
			$element_custom_fonts[] = $subtitle_custom_font;
		}
		$percent_custom_font = argenta_extra_parse_VC_typography_custom_font( $percent_typo );
		if ( $percent_custom_font ) {
			$element_custom_fonts[] = $percent_custom_font;
		}

		$title_css = $title_css . argenta_extra_parse_VC_typography_to_CSS( $title_typo );
		$subtitle_css = $subtitle_css . argenta_extra_parse_VC_typography_to_CSS( $subtitle_typo );
		$percent_css = argenta_extra_parse_VC_typography_to_CSS( $percent_typo );

		$title_css = $title_css ? $title_css : false;
		$subtitle_css = $subtitle_css ? $subtitle_css : false;

		$with_styles = ( $title_css || $subtitle_css || $percent_css || $chart_content_css || count($element_custom_fonts) > 0 );

		// Assembling
		ob_start();
		include( 'layout/chart_box.php' );
		$content = ob_get_contents();
		ob_end_clean();

		argenta_gh_add_required_script( 'chart-box' );

		return $content;
	}


	vc_map( array(
			'name' => __( 'Chart Box', 'argenta_extra' ),
			'description' => __( 'Chart box module', 'argenta_extra' ),
			'base' => 'argenta_sc_chart_box',
			'category' => __( 'Argenta', 'argenta_extra' ),
			'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-ChartBox.png',
			'params' => array(

				// General
				array(
					'type' => 'argenta_choose_box',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Layout', 'argenta_extra' ),
					'param_name' => 'layout',
					'value' => array(
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon45.png',
							'key' => 'percent',
							'title' => __( 'Percent', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon46.png',
							'key' => 'icon',
							'title' => __( 'Icon', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon47.png',
							'key' => 'icon_with_percent',
							'title' => __( 'Icon with Percent', 'argenta_extra' ),
						)
					)
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Percent', 'argenta_extra' ),
					'param_name' => 'percent',
					'value' => '',
					'description' => __( 'Percent of pie chart', 'argenta_extra' ),
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
						__( 'Right', 'argenta_extra' ) => 'right'
					),
					'dependency' => array(
						'element' => 'layout',
						'value' => 'icon_with_percent'
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
							'icon_with_percent',
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
					'param_name' => 'typo_tab_divider_percent',
					'value' => __( 'Percent', 'argenta_extra' ),
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'percent_typo',
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
					'heading' => __( 'Chart color', 'argenta_extra' ),
					'param_name' => 'chart_color',
				),
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
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Chart content color', 'argenta_extra' ),
					'param_name' => 'chart_content_color',
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