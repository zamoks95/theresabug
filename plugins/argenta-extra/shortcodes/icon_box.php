<?php 

	/**
	* Visual Composer Argenta Icon box shortcode
	*/

	add_shortcode( 'argenta_sc_icon_box', 'argenta_sc_icon_box_func' );

	function argenta_sc_icon_box_func( $atts ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$box_type_layout = ( isset( $box_type_layout ) ) ? argenta_extra_filter_string( $box_type_layout, 'string', 'top_icon' ) : 'top_icon';
		$title = ( isset( $title ) ) ? argenta_extra_filter_string( $title, 'string', '' ) : '';
		$subtitle = ( isset( $subtitle ) ) ? argenta_extra_filter_string( $subtitle, 'string', '' ) : '';
		$description = ( isset( $description ) ) ? argenta_extra_filter_string( $description, 'textarea', '' ) : '';
		$content_full = ( isset( $content_full ) ) ? argenta_extra_filter_boolean( $content_full ) : false;
		
		$image = ( isset( $image ) ) ? argenta_extra_filter_string( wp_get_attachment_url( argenta_extra_filter_string( $image ) ), 'attr' ) : false;
		$icon_type_layout = ( isset( $icon_type_layout ) ) ? argenta_extra_filter_string( $icon_type_layout, 'string', 'default' ) : 'default';
		$icon_type = ( isset( $icon_type ) ) ? argenta_extra_filter_string( $icon_type, 'string', 'font_icon' ) : 'font_icon';
		$icon_as_icon = ( isset( $icon_as_icon ) ) ? argenta_extra_filter_string( $icon_as_icon, 'attr', '' ) : '';
		$icon_as_image = ( isset( $icon_as_image ) ) ? argenta_extra_filter_string( wp_get_attachment_url( argenta_extra_filter_string( $icon_as_image ) ), 'attr' ) : false;
		$icon_use_shadow = ( isset( $icon_use_shadow ) ) ? argenta_extra_filter_boolean( $icon_use_shadow ) : false;
		
		$use_link = ( isset( $use_link ) ) ? argenta_extra_filter_boolean( $use_link ) : false;
		
		$title_typo = ( isset( $title_typo ) ) ? argenta_extra_filter_string( $title_typo ) : false;
		$subtitle_typo = ( isset( $subtitle_typo ) ) ? argenta_extra_filter_string( $subtitle_typo ) : false;
		$description_typo = ( isset( $description_typo ) ) ? argenta_extra_filter_string( $description_typo ) : false;
		$button_typo = ( isset( $button_typo ) ) ? argenta_extra_filter_string( $button_typo ) : false;
		
		$title_color = ( isset( $title_color ) ) ? argenta_extra_filter_string( $title_color ) : false;
		$subtitle_color = ( isset( $subtitle_color ) ) ? argenta_extra_filter_string( $subtitle_color ) : false;
		$description_color = ( isset( $description_color ) ) ? argenta_extra_filter_string( $description_color ) : false;
		$fill_color = ( isset( $fill_color ) ) ? argenta_extra_filter_string( $fill_color ) : false;
		$border_color = ( isset( $border_color ) ) ? argenta_extra_filter_string( $border_color ) : false;
		$icon_color = ( isset( $icon_color ) ) ? argenta_extra_filter_string( $icon_color ) : false;
		$divider_color = ( isset( $divider_color ) ) ? argenta_extra_filter_string( $divider_color ) : false;
		$hide_divider = ( isset( $hide_divider ) ) ? argenta_extra_filter_boolean( $hide_divider ) : false;
		$readmore_button = ( isset( $readmore_button ) ) ? argenta_extra_filter_string( $readmore_button ) : false;
		$readmore_color = ( isset( $readmore_color ) ) ? argenta_extra_filter_string( $readmore_color ) : false;
		$readmore_type = ( isset( $readmore_type ) ) ? argenta_extra_filter_string( $readmore_type, 'string', 'arrow_link' ) : 'arrow_link';
		$button_rounded = ( isset( $button_rounded ) ) ? argenta_extra_filter_boolean( $button_rounded ) : false;
		$appearance_effect = ( isset( $appearance_effect ) ) ? argenta_extra_filter_string( $appearance_effect, 'attr', 'none' )  : 'none';
		$appearance_duration = ( isset( $appearance_duration ) ) ? argenta_extra_filter_string( $appearance_duration, 'attr', false )  : false;
		$css_class = ( isset( $css_class ) ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' )  : '';

		if ( isset( $link_url ) ) {
			$link_url = argenta_extra_parse_VC_link_params( $link_url, array( 'caption' => __( 'Read more', 'argenta_extra' ) ) );
		} else {
			$link_url = argenta_extra_parse_VC_link_params( '', array( 'caption' => __( 'Read more', 'argenta_extra' ) ) );
		}

		// Styling
		$icon_box_uniqid = uniqid('argenta-custom-');

		if ( $icon_type == 'font_icon' && $icon_as_icon ) {
			$GLOBALS['argenta_pixellove_fonts'][] = $icon_as_icon;
		}

		$icon_box_class_main = 'icon-box';
		if ( $box_type_layout == 'left_icon' ) {
			$icon_box_class_main .= '-left';
		}
		if ( $box_type_layout == 'right_icon' ) {
			$icon_box_class_main .= '-right';
		}

		$icon_box_class_icon = '';
		switch ( $icon_type_layout ) {
			case 'border':
				$icon_box_class_icon = ' icon-box-shape-border';
				break;
			case 'double':
				$icon_box_class_icon = ' icon-box-shape-border-double';
				break;
			case 'fill_and_border':
				$icon_box_class_icon = ' icon-box-shape-border icon-box-shape-fill';
				break;
			case 'only_fill':
				$icon_box_class_icon = ' icon-box-shape-fill';
				break;
		}
		if ( $icon_use_shadow ) {
			$icon_box_class_icon .= ' icon-box-shape-shadow';
		}

		$icon_color_css = ( $icon_color ) ? 'color: ' . $icon_color . ';' : false;
		$icon_border_css = ( $border_color ) ? 'border-color: ' . $border_color . ';' : false;
		if ( ! $icon_border_css && $icon_color ) {
			$icon_border_css = 'border-color: ' . $icon_color . ';';
		}
		$icon_border_css = ( $border_color ) ? 'border-color: ' . $border_color . ';' : false;
		$icon_fill_css = ( $fill_color ) ? 'background-color: ' . $fill_color . ';' : '';
		
		$divider_color_css = ( $divider_color ) ? 'background-color: ' . $divider_color . ';' : false;

		$title_css = argenta_extra_parse_VC_typography_to_CSS( $title_typo ) . ( ( $title_color ) ? 'color: ' . $title_color . ';' : '' );
		$subtitle_css = argenta_extra_parse_VC_typography_to_CSS( $subtitle_typo ) . ( ( $subtitle_color ) ? 'color: ' . $subtitle_color . ';' : '' );
		$description_css = argenta_extra_parse_VC_typography_to_CSS( $description_typo ) . ( ( $description_color ) ? 'color: ' . $description_color . ';' : '' );
		$title_css = $title_css ? $title_css : false;
		$subtitle_css = $subtitle_css ? $subtitle_css : false;
		$description_css = $description_css ? $description_css : false;


		// Read more button
		$readmore_button = preg_replace( '/\&amp\;/', '&', $readmore_button );
		parse_str( $readmore_button, $button_settings );

		// Backward compatibility
		if ( $readmore_color && !isset( $button_settings['color'] ) ) {
			$button_settings['color'] = $readmore_color;
		}
		if ( $button_rounded && !isset( $button_settings['rounded'] ) ) {
			$button_settings['rounded'] = 'true';
		}
		if ( $readmore_type && $readmore_type != 'color_button' && !isset( $button_settings['type'] ) ) {
			$button_settings['type'] = $readmore_type;
		}

		$button_css = argenta_extra_parse_VC_button_to_css( $button_settings );
		$button_css['css'] .= argenta_extra_parse_VC_typography_to_CSS( $button_typo );


		$element_custom_fonts = array();
		$title_custom_font = argenta_extra_parse_VC_typography_custom_font( $title_typo );
		if ( $title_custom_font ) {
			$element_custom_fonts[] = $title_custom_font;
		}
		$subtitle_custom_font = argenta_extra_parse_VC_typography_custom_font( $subtitle_typo );
		if ( $subtitle_custom_font ) {
			$element_custom_fonts[] = $subtitle_custom_font;
		}
		$description_custom_font = argenta_extra_parse_VC_typography_custom_font( $description_typo );
		if ( $description_custom_font ) {
			$element_custom_fonts[] = $description_custom_font;
		}
		$button_custom_font = argenta_extra_parse_VC_typography_custom_font( $button_typo );
		if ( $button_custom_font ) {
			$element_custom_fonts[] = $button_custom_font;
		}

		$with_styles = (bool) ( $title_css || $subtitle_css || $description_css || count($element_custom_fonts) > 0 || $icon_color_css || $button_css['css'] || $button_css['hover-css'] || $divider_color_css || $icon_border_css || $icon_fill_css || ( $icon_type == 'font_icon' && $icon_as_icon ) );

		// Assembling
		ob_start();
		include( 'layout/icon_box.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
		'name' => __( 'Icon Box', 'argenta_extra' ),
		'description' => __( 'Argenta eye catching icons', 'argenta_extra' ),
		'base' => 'argenta_sc_icon_box',
		'category' => __( 'Argenta', 'argenta_extra' ),
		'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-IconBox.png',
		'js_view' => 'VcArgentaIconBoxView',
		'custom_markup' => '{{title}}<div class="vc_argenta_icon_box-container">
				<div class="icon">%%icon%%</div>
				<div class="title">%%title%%</div>
				<div class="subtitle"></div>
				<div class="divider"></div>
				<div class="lines"><div class="line"></div><div class="line"></div><div class="line"></div></div>
				<div class="read_more"></div>
			</div>',
		'params' => array(
			// General
			array(
				'type' => 'argenta_choose_box',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Box layout', 'argenta_extra' ),
				'param_name' => 'box_type_layout',
				'value' => array(
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon1.png',
						'key' => 'top_icon',
						'title' => __( 'Top Icon', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon2.png',
						'key' => 'left_icon',
						'title' => __( 'Left Icon', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon3.png',
						'key' => 'right_icon',
						'title' => __( 'Right Icon', 'argenta_extra' ),
					)
				)
			),
			array(
				'type' => 'textfield',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Title', 'argenta_extra' ),
				'param_name' => 'title',
				'description' => __( 'Main title for block.', 'argenta_extra' ),
			),
			array(
				'type' => 'textfield',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Subtitle', 'argenta_extra' ),
				'param_name' => 'subtitle',
				'description' => __( 'Subtitle.', 'argenta_extra' ),
			),
			array(
				'type' => 'textarea',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Description', 'argenta_extra' ),
				'param_name' => 'description',
				'description' => __( 'Description content.', 'argenta_extra' ),
			),
			array(
				'type' => 'argenta_check',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Full width content', 'argenta_extra' ),
				'param_name' => 'content_full',
				'value' => array(
					'Yes' => '0'
				),
				'dependency' => array(
					'element' => 'box_type_layout',
					'value' => array(
						'left_icon',
						'right_icon'
					)
				),
			),

			// Icon
			array(
				'type' => 'argenta_choose_box',
				'group' => __( 'Icon', 'argenta_extra' ),
				'heading' => __( 'Icon layout', 'argenta_extra' ),
				'param_name' => 'icon_type_layout',
				'value' => array(
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon4.png',
						'key' => 'default',
						'title' => __( 'Default', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon5.png',
						'key' => 'border',
						'title' => __( 'Border', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon6.png',
						'key' => 'double',
						'title' => __( 'Double Border', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon7.png',
						'key' => 'fill_and_border',
						'title' => __( 'Fill and Border', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon8.png',
						'key' => 'only_fill',
						'title' => __( 'Only Fill', 'argenta_extra' ),
					),
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
			),
			array(
				'type' => 'argenta_icon_picker',
				'group' => __( 'Icon', 'argenta_extra' ),
				'heading' => __( 'Icon', 'argenta_extra' ),
				'param_name' => 'icon_as_icon',
				'description' => __( 'Choose icon.', 'argenta_extra' ),
				'settings' => array(
					'emptyIcon' => false,
					'type' => 'pixellove',
					'iconsPerPage' => 200,
				),
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

			// Link
			array(
				'type' => 'argenta_check',
				'group' => __( 'Link', 'argenta_extra' ),
				'heading' => __( 'Use link?', 'argenta_extra' ),
				'param_name' => 'use_link',
				'description' => __( 'Select if you want to block links to some page.', 'argenta_extra' ),
				'value' => array(
					__( 'Yes, sure', 'argenta_extra' ) => '0'
				)
			),
			array(
				'type' => 'vc_link',
				'group' => __( 'Link', 'argenta_extra' ),
				'heading' => __( 'Link URL', 'argenta_extra' ),
				'param_name' => 'link_url',
				'dependency' => array(
					'element' => 'use_link',
					'value' => array(
						'1'
					)
				),
				'description' => __( 'Fill title field to change the <strong>Read more</strong> inscription.', 'argenta_extra' ),
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
				'param_name' => 'subtitle_typo',
			),
			array(
				'type' => 'argenta_divider',
				'group' => __( 'Typography', 'argenta_extra' ),
				'param_name' => 'typo_tab_divider_description',
				'value' => __( 'Description', 'argenta_extra' ),
			),
			array(
				'type' => 'argenta_typography',
				'group' => __( 'Typography', 'argenta_extra' ),
				'param_name' => 'description_typo',
			),
			array(
				'type' => 'argenta_divider',
				'group' => __( 'Typography', 'argenta_extra' ),
				'param_name' => 'typo_tab_divider_heading',
				'value' => __( 'Button text', 'argenta_extra' ),
				'dependency' => array(
					'element' => 'use_link',
					'value' => array(
						'1'
					)
				),
			),
			array(
				'type' => 'argenta_typography',
				'group' => __( 'Typography', 'argenta_extra' ),
				'param_name' => 'button_typo',
				'dependency' => array(
					'element' => 'use_link',
					'value' => array(
						'1'
					)
				),
			),

			// Style
			array(
				'type' => 'argenta_divider',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'param_name' => 'style_tab_divider_content',
				'value' => __( 'Content', 'argenta_extra' ),
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
				'heading' => __( 'Description color', 'argenta_extra' ),
				'param_name' => 'description_color',
			),
			array(
				'type' => 'argenta_divider',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'param_name' => 'style_tab_divider_icon',
				'value' => __( 'Icon', 'argenta_extra' ),
			),
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Fill color', 'argenta_extra' ),
				'param_name' => 'fill_color',
				'dependency' => array(
					'element' => 'icon_type_layout',
					'value' => array(
						'fill_and_border',
						'only_fill'
					)
				)
			),
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Border color', 'argenta_extra' ),
				'param_name' => 'border_color',
				'dependency' => array(
					'element' => 'icon_type_layout',
					'value' => array(
						'fill_and_border',
						'border',
						'double'
					)
				)
			),
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Icon color', 'argenta_extra' ),
				'param_name' => 'icon_color',
				'dependency' => array(
					'element' => 'icon_type',
					'value' => array(
						'font_icon'
					)
				)
			),
			array(
				'type' => 'argenta_check',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Add shadow?', 'argenta_extra' ),
				'param_name' => 'icon_use_shadow',
				'description' => __( 'We recommend add shadow to the icon that has light colors fill.', 'argenta_extra' ),
				'value' => array(
					'Yes' => '0'
				)
			),
			array(
				'type' => 'argenta_divider',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'param_name' => 'style_tab_divider_readmore',
				'value' => __( 'Readmore button', 'argenta_extra' ),
				'dependency' => array(
					'element' => 'use_link',
					'value' => array(
						'1'
					)
				),
			),
			array(
				'type' => 'argenta_button',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'param_name' => 'readmore_button',
				'dependency' => array(
					'element' => 'use_link',
					'value' => array(
						'1'
					)
				),
			),
			array(
				'type' => 'argenta_divider',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'param_name' => 'style_tab_divider_other',
				'value' => __( 'Other', 'argenta_extra' ),
			),
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Divider color', 'argenta_extra' ),
				'param_name' => 'divider_color',
				'dependency' => array(
					'element' => 'box_type_layout',
					'value' => array(
						'top_icon'
					)
				)
			),
			array(
				'type' => 'argenta_check',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Hide divider?', 'argenta_extra' ),
				'param_name' => 'hide_divider',
				'value' => array(
					__( 'Yes, please', 'argenta_extra' ) => '0'
				),
				'dependency' => array(
					'element' => 'box_type_layout',
					'value' => array(
						'top_icon'
					)
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
				'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class, and then use this class in your custom CSS.', 'argenta_extra' )
			),
		)
	) );
?>