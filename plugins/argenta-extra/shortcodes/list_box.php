<?php 

	/**
	* Visual Composer Argenta List box shortcode
	*/

	add_shortcode( 'argenta_sc_list_box', 'argenta_sc_list_box_func' );

	function argenta_sc_list_box_func( $atts ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$list_layout = isset( $list_layout ) ? argenta_extra_filter_string( $list_layout, 'string', 'default') : 'default';
		$list_style = isset( $list_style ) ? argenta_extra_filter_string( $list_style, 'string', 'default') : 'default';
		$list_value_type1 = ( isset( $list_value_type1 ) ) ? json_decode( urldecode( argenta_extra_filter_string( $list_value_type1 ) ) ) : false;
		$list_value_type2 = ( isset( $list_value_type2 ) ) ? json_decode( urldecode( argenta_extra_filter_string( $list_value_type2 ) ) ) : false;

		$title_typo = ( isset( $title_typo ) ) ? argenta_extra_filter_string( $title_typo ) : false;
		$subtitle_typo = ( isset( $subtitle_typo ) ) ? argenta_extra_filter_string( $subtitle_typo ) : false;

		$border_color = isset( $border_color ) ? argenta_extra_filter_string( $border_color, 'string', false ) : false;
		$icon_color = isset( $icon_color ) ? argenta_extra_filter_string( $icon_color, 'string', false ) : false;
		$shape_icon_color = isset( $shape_icon_color ) ? argenta_extra_filter_string( $shape_icon_color, 'string', false ) : false;
		$title_color = isset( $title_color ) ? argenta_extra_filter_string( $title_color, 'string', false ) : false;
		$subtitle_color = isset( $subtitle_color ) ? argenta_extra_filter_string( $subtitle_color, 'string', false ) : false;

		$css_class = isset( $css_class ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' ) : '';

		if ( $list_value_type1 ) {
			foreach ($list_value_type1 as $list_key => $list_value) {
				if ( isset( $list_value->list_title ) ) {
					$list_value_type1[$list_key]->list_title = argenta_extra_filter_string( $list_value->list_title );
				} else {
					$list_value_type1[$list_key]->list_title = false;
				}
				if ( isset( $list_value->list_subtitle ) ) {
					$list_value_type1[$list_key]->list_subtitle = argenta_extra_filter_string( $list_value->list_subtitle );
				} else {
					$list_value_type1[$list_key]->list_subtitle = false;
				}
			}
		}

		if ( $list_value_type2 ) {
			foreach ($list_value_type2 as $list_key => $list_value) {
				if ( isset( $list_value->list_title ) ) {
					$list_value_type2[$list_key]->list_title = argenta_extra_filter_string( $list_value->list_title );
				} else {
					$list_value_type2[$list_key]->list_title = false;
				}
				if ( isset( $list_value->list_subtitle ) ) {
					$list_value_type2[$list_key]->list_subtitle = argenta_extra_filter_string( $list_value->list_subtitle );
				} else {
					$list_value_type2[$list_key]->list_subtitle = false;
				}
				if ( isset( $list_value->list_icon ) ) {
					$list_value_type2[$list_key]->list_icon = argenta_extra_filter_string( $list_value->list_icon, 'attr' );
					$GLOBALS['argenta_pixellove_fonts'][] = argenta_extra_filter_string( $list_value_type2[$list_key]->list_icon, 'attr' );
				} else {
					$list_value_type2[$list_key]->list_icon = false;
				}
				if ( isset( $list_value->list_image ) ) {
					$list_value_type2[$list_key]->list_image = argenta_extra_filter_string( wp_get_attachment_url( argenta_extra_filter_string( $list_value->list_image ) ), 'attr' );
				} else {
					$list_value_type2[$list_key]->list_image = false;
				}
			}
		}

		// Styling
		$list_box_uniqid = uniqid( 'argenta-custom-' );

		$list_box_class = '';

		if ( $list_style == 'icon' ) {
			$list_box_class .= '-icon';
		}

		if ( $list_style == 'shape_icon' ) {
			$list_box_class .= '-icon list-box-fill-icon';
		} 

		switch ( $list_layout ) {
			case 'border_items':
				$list_box_class .= ' list-box-border-items';
				break;
			case 'offset_border_items':
				$list_box_class .= ' list-box-border-items-offset';
				break;
		}

		$border_css = ( $border_color ) ? 'border-color: ' . $border_color . ';' : '';
		$icon_css = ( $icon_color ) ? 'color: ' . $icon_color . ';' : '';
		$shape_icon_css = ( $shape_icon_color ) ? 'background-color: ' . $shape_icon_color . ';' : '';
		$title_css = ( $title_color ) ? 'color: ' . $title_color . ';' : '';
		$subtitle_css = ( $subtitle_color ) ? 'color: ' . $subtitle_color . ';' : '';

		$element_custom_fonts = array();
		$title_custom_font = argenta_extra_parse_VC_typography_custom_font( $title_typo );
		$subtitle_custom_font = argenta_extra_parse_VC_typography_custom_font( $subtitle_typo );

		if ( $title_custom_font ) {
			$element_custom_fonts[] = $title_custom_font;
		}
		if ( $subtitle_custom_font ) {
			$element_custom_fonts[] = $subtitle_custom_font;
		}

		$title_css = $title_css . argenta_extra_parse_VC_typography_to_CSS( $title_typo );
		$subtitle_css = $subtitle_css . argenta_extra_parse_VC_typography_to_CSS( $subtitle_typo );

		$with_styles = ( $icon_css || $shape_icon_css || $title_css || $subtitle_css || count($element_custom_fonts) > 0 );

		// Assembling
		ob_start();
		include( 'layout/list_box.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
			'name' => __( 'List Box', 'argenta_extra' ),
			'description' => __( 'Elements list block', 'argenta_extra' ),
			'base' => 'argenta_sc_list_box',
			'category' => __( 'Argenta', 'argenta_extra' ),
			'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-ListBox.png',
			'params' => array(

				// General
				array(
					'type' => 'argenta_choose_box',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'List layout', 'argenta_extra' ),
					'param_name' => 'list_layout',
					'value' => array(
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon52.png',
							'key' => 'default',
							'title' => __( 'Default', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon53.png',
							'key' => 'border_items',
							'title' => __( 'Border Items', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon54.png',
							'key' => 'offset_border_items',
							'title' => __( 'Offset Border Items', 'argenta_extra' ),
						)
					)
				),
				array(
					'type' => 'argenta_choose_box',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'List style', 'argenta_extra' ),
					'param_name' => 'list_style',
					'value' => array(
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon52.png',
							'key' => 'default',
							'title' => __( 'Default', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon55.png',
							'key' => 'icon',
							'title' => __( 'Icon', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon56.png',
							'key' => 'shape_icon',
							'title' => __( 'Shape Icon', 'argenta_extra' ),
						)
					)
				),
				array(
					'type' => 'param_group',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'List items', 'argenta_extra' ),
					'param_name' => 'list_value_type1',
					'value' => array(
						false
					),
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => __( 'Title', 'argenta_extra' ),
							'param_name' => 'list_title',
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'Subtitle', 'argenta_extra' ),
							'param_name' => 'list_subtitle',
						),
					),
					'dependency' => array(
						'element' => 'list_style',
						'value' => array(
							'default'
						)
					)
				),
				array(
					'type' => 'param_group',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'List items', 'argenta_extra' ),
					'param_name' => 'list_value_type2',
					'value' => array(
						false
					),
					'params' => array(
						array(
							'type' => 'argenta_icon_picker',
							'heading' => __( 'Icon', 'argenta_extra' ),
							'param_name' => 'list_icon',
							'description' => __( 'Choose icon.', 'argenta_extra' ),
						),
						array(
							'type' => 'attach_image',
							'heading' => __( 'or Icon image', 'argenta_extra' ),
							'param_name' => 'list_image',
							'description' => __( 'If you select an image, then choosed an icon will be ignored.', 'argenta_extra' ),
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'Title', 'argenta_extra' ),
							'param_name' => 'list_title',
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'Subtitle', 'argenta_extra' ),
							'param_name' => 'list_subtitle',
						),
					),
					'dependency' => array(
						'element' => 'list_style',
						'value' => array(
							'icon',
							'shape_icon'
						)
					)						
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
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'subtitle_typo'
				),
				
				// Style
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Border color', 'argenta_extra' ),
					'param_name' => 'border_color',
					'dependency' => array(
						'element' => 'list_layout',
						'value' => array(
							'border_items',
							'offset_border_items'
						)
					)
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Icon color', 'argenta_extra' ),
					'param_name' => 'icon_color',
					'dependency' => array(
						'element' => 'list_style',
						'value' => array(
							'shape_icon',
							'icon'
						)
					)
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Shape icon color', 'argenta_extra' ),
					'param_name' => 'shape_icon_color',
					'dependency' => array(
						'element' => 'list_style',
						'value' => 'shape_icon'
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