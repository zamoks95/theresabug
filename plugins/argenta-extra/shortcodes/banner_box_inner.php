<?php 

	/**
	* Visual Composer Argenta Banner box inner shortcode
	*/

	add_shortcode( 'argenta_sc_banner_box_inner', 'argenta_sc_banner_box_inner_func' );

	function argenta_sc_banner_box_inner_func( $atts ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$block_type_subtitle = ( isset( $block_type_subtitle ) ) ? argenta_extra_filter_string( $block_type_subtitle, 'string', 'after' ) : 'after';
		$title = ( isset( $title ) ) ? argenta_extra_filter_string( $title, 'string', '' ) : '';
		$subtitle = ( isset( $subtitle ) ) ? argenta_extra_filter_string( $subtitle, 'string', '' ) : '';
		$description = ( isset( $description ) ) ? argenta_extra_filter_string( $description, 'textarea', '' ) : '';
		$background_image 	= ( isset( $background ) ) ? wp_get_attachment_url( argenta_extra_filter_string( $background ) ) : false;
		$use_link = ( isset( $use_link ) ) ? argenta_extra_filter_boolean( $use_link ) : false;
		$title_typo = ( isset( $title_typo ) ) ? argenta_extra_filter_string( $title_typo ) : false;
		$subtitle_typo = ( isset( $subtitle_typo ) ) ? argenta_extra_filter_string( $subtitle_typo ) : false;
		$description_typo = ( isset( $description_typo ) ) ? argenta_extra_filter_string( $description_typo ) : false;
		$title_color = ( isset( $title_color ) ) ? argenta_extra_filter_string( $title_color ) : false;
		$subtitle_color = ( isset( $subtitle_color ) ) ? argenta_extra_filter_string( $subtitle_color ) : false;
		$description_color = ( isset( $description_color ) ) ? argenta_extra_filter_string( $description_color ) : false;
		$readmore_button = ( isset( $readmore_button ) ) ? argenta_extra_filter_string( $readmore_button ) : false;
		$readmore_color = ( isset( $readmore_color ) ) ? argenta_extra_filter_string( $readmore_color ) : false;
		$readmore_hover_text_color = ( isset( $readmore_hover_text_color ) ) ? argenta_extra_filter_string( $readmore_hover_text_color ) : false;
		$readmore_type = ( isset( $readmore_type ) ) ? argenta_extra_filter_string( $readmore_type, 'string', 'color_button' ) : 'color_button';
		$readmore_size = ( isset( $readmore_size ) ) ? argenta_extra_filter_string( $readmore_size, 'string', 'small' ) : 'small';
		$button_rounded = ( isset( $button_rounded ) ) ? argenta_extra_filter_boolean( $button_rounded ) : false;
		$css_class = ( isset( $css_class ) ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' )  : '';

		if ( isset( $link_url ) ) {
			$link_url = argenta_extra_parse_VC_link_params( $link_url, array( 'caption' => __( 'Read more', 'argenta_extra' ) ) );
		} else {
			$link_url = argenta_extra_parse_VC_link_params( '', array( 'caption' => __( 'Read more', 'argenta_extra' ) ) );
		}

		// Styling
		$banner_box_uniqid = uniqid( 'argenta-custom-' );

		$title_css = argenta_extra_parse_VC_typography_to_CSS( $title_typo ) . ( ( $title_color ) ? 'color: ' . $title_color . ';' : '' );
		$subtitle_css = argenta_extra_parse_VC_typography_to_CSS( $subtitle_typo ) . ( ( $subtitle_color ) ? 'color: ' . $subtitle_color . ';' : '' );
		$description_css = argenta_extra_parse_VC_typography_to_CSS( $description_typo ) . ( ( $description_color ) ? 'color: ' . $description_color . ';' : '' );
		$title_css = ( $title_css ) ? $title_css : false;
		$subtitle_css = ( $subtitle_css ) ? $subtitle_css : false;
		$description_css = ( $description_css ) ? $description_css : false;
		

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
		if ( $readmore_size && !isset( $button_settings['type'] ) ) {
			$button_settings['size'] = $readmore_size;
		}
		if ( $readmore_hover_text_color && !isset( $button_settings['text-hover-color'] ) ) {
			$button_settings['text-hover-color'] = $readmore_hover_text_color;
		}

		$button_css = argenta_extra_parse_VC_button_to_css( $button_settings );



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

		$with_styles = ( $title_css || $subtitle_css || $description_css || $button_css['css'] || $button_css['hover-css'] || count( $element_custom_fonts ) > 0 );

		// Assembling
		ob_start();
		include( 'layout/banner_box_inner.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
			'name' => 'Banner Box',
			'description' => 'Banner box module',
			'base' => 'argenta_sc_banner_box_inner',
			'category' => 'Argenta',
			'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-BannerBox.png',
			'content_element' => true,
			'as_child' => array( 'only' => 'argenta_sc_banner_box_group' ),
			'js_view' => 'VcArgentaBannerBoxInnerView',
			'custom_markup' => '{{title}}<div class="vc_argenta_banner_box_inner-container">
					<div class="image" style="background-image: url(\'' . plugin_dir_url( __FILE__ ) . 'images/vc_gap_image.svg\');"></div>
					<div class="_wrap">
						<div class="title">%%title%%</div>
						<div class="lines">%%subtitle%%</div>
						<div class="desc">
							<div></div>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
						</div>
						<div class="more"></div>
					</div>
				</div>',
			'params' => array(
				// General
				array(
					'type' => 'argenta_choose_box',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Subtitle position', 'argenta_extra' ),
					'param_name' => 'block_type_subtitle',
					'value' => array(
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon124.png',
							'key' => 'after',
							'title' => __( 'After title', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon125.png',
							'key' => 'before',
							'title' => __( 'Before title', 'argenta_extra' ),
						)
					),
				),
				array(
					'type' => 'textfield',
					'holder' => 'em',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Title', 'argenta_extra' ),
					'param_name' => 'title',
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Subtitle', 'argenta_extra' ),
					'param_name' => 'subtitle'
				),
				array(
					'type' => 'textarea',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Description', 'argenta_extra' ),
					'param_name' => 'description',
					'description' => __( 'Banner box can be used as announcement block.', 'argenta_extra' ),
				),
				array(
					'type' => 'attach_image',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Background', 'argenta_extra' ),
					'param_name' => 'background',
					'description' => __( 'Choose background image.', 'argenta_extra' ),
				),

				// Link
				array(
					'type' => 'argenta_check',
					'group' => __( 'Link', 'argenta_extra' ),
					'heading' => __( 'Use link?', 'argenta_extra' ),
					'param_name' => 'use_link',
					'description' => __( 'Select if you want to block links to a some page.', 'argenta_extra' ),
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

				// Typography options
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_title',
					'value' => __( 'Title', 'argenta_extra' )
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

				// Styles
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
					'param_name' => 'style_tab_divider_readmore',
					'value' => __( 'Read more', 'argenta_extra' ),
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
					'type' => 'textfield',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Custom CSS class', 'argenta_extra' ),
					'param_name' => 'css_class',
					'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class, and then use this class in your custom CSS.', 'argenta_extra' )
				),
			)
		)
	);