<?php 

	/**
	* Visual Composer Argenta Banner box shortcode
	*/

	add_shortcode( 'argenta_sc_banner_box', 'argenta_sc_banner_box_func' );

	function argenta_sc_banner_box_func( $atts ) {
		if ( isset( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$block_type_layout 	= ( isset( $block_type_layout ) ) ? argenta_extra_filter_string( $block_type_layout, 'string', 'full' ) : 'full';
		$block_type_full_align = ( isset( $block_type_full_align ) ) ? argenta_extra_filter_string( $block_type_full_align, 'string', 'left' ) : 'left';
		$block_type_inner_align = ( isset( $block_type_inner_align ) ) ? argenta_extra_filter_string( $block_type_inner_align, 'string', 'top_left' ) : 'top_left';
		$block_type_subtitle = ( isset( $block_type_subtitle ) ) ? argenta_extra_filter_string( $block_type_subtitle, 'string', 'after' ) : 'after';
		$title = ( isset( $title ) ) ? argenta_extra_filter_string( $title ) : false;
		$subtitle = ( isset( $subtitle ) ) ? argenta_extra_filter_string( $subtitle ) : false;
		$description = ( isset( $description ) ) ? argenta_extra_filter_string( $description, 'textarea', '' ) : '';
		$background_image = ( isset( $background_image ) ) ? argenta_extra_filter_string( wp_get_attachment_url( argenta_extra_filter_string( $background_image ) ), 'attr' ) : false;
		$use_link = ( isset( $use_link ) ) ? argenta_extra_filter_boolean( $use_link ) : true;

		$readmore_button = ( isset( $readmore_button ) ) ? argenta_extra_filter_string( $readmore_button ) : false;
		$readmore_type = ( isset( $readmore_type ) ) ? argenta_extra_filter_string( $readmore_type, 'string', 'color_button' ) : 'color_button';
		$readmore_size = ( isset( $readmore_size ) ) ? argenta_extra_filter_string( $readmore_size, 'string', 'small' ) : 'small';
		$readmore_color = ( isset( $readmore_color ) ) ? argenta_extra_filter_string( $readmore_color ) : false;
		$button_rounded = ( isset( $button_rounded ) ) ? argenta_extra_filter_boolean( $button_rounded ) : false;

		$title_typo = ( isset( $title_typo ) ) ? argenta_extra_filter_string( $title_typo ) : false;
		$subtitle_typo = ( isset( $subtitle_typo ) ) ? argenta_extra_filter_string( $subtitle_typo ) : false;
		$description_typo = ( isset( $description_typo ) ) ? argenta_extra_filter_string( $description_typo ) : false;
		$button_typo = ( isset( $button_typo ) ) ? argenta_extra_filter_string( $button_typo ) : false;
		$title_color = ( isset( $title_color ) ) ? argenta_extra_filter_string( $title_color ) : false;
		$subtitle_color = ( isset( $subtitle_color ) ) ? argenta_extra_filter_string( $subtitle_color ) : false;
		$description_color = ( isset( $description_color ) ) ? argenta_extra_filter_string( $description_color ) : false;
		$overlay_color = ( isset( $overlay_color ) ) ? argenta_extra_filter_string( $overlay_color ) : false;
		$appearance_effect = ( isset( $appearance_effect ) ) ? argenta_extra_filter_string( $appearance_effect, 'attr', 'none' )  : 'none';
		$appearance_duration = ( isset( $appearance_duration ) ) ? argenta_extra_filter_string( $appearance_duration, 'attr', false )  : false;
		$css_class = ( isset( $css_class ) ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' )  : '';

		if ( isset( $link_url ) ) {
			$link_url = argenta_extra_parse_VC_link_params( $link_url, array( 'caption' => 'Read more' ) );
		} else {
			$link_url = argenta_extra_parse_VC_link_params( '', array( 'caption' => 'Read more' ) );
		}

		// Styling
		$banner_box_uniqid = uniqid('argenta-custom-');

		$banner_box_class = 'banner-box';
		if ( $block_type_layout == 'full' ) {
			switch ( $block_type_full_align ) {
				case 'center':
					$banner_box_class .= ' text-center';
					break;
				case 'right':
					$banner_box_class .= ' text-right';
					break;
			}
		} else {
			switch ( $block_type_inner_align ) {
				case 'top_left':
					$banner_box_class .= ' move-top';
					break;
				case 'top_center':
					$banner_box_class .= ' move-top text-center';
					break;
				case 'top_right':
					$banner_box_class .= ' move-top text-right';
					break;
				case 'bottom_left':
					$banner_box_class .= ' move-bottom';
					break;
				case 'bottom_center':
					$banner_box_class .= ' move-bottom text-center';
					break;
				case 'bottom_right':
					$banner_box_class .= ' move-bottom text-right';
					break;
			}
		}

		$title_css = argenta_extra_parse_VC_typography_to_CSS( $title_typo ) . ( ( $title_color ) ? 'color: ' . $title_color . ';' : '' );
		$subtitle_css = argenta_extra_parse_VC_typography_to_CSS( $subtitle_typo ) . ( ( $subtitle_color ) ? 'color: ' . $subtitle_color . ';' : '' );
		$description_css = argenta_extra_parse_VC_typography_to_CSS( $description_typo ) . ( ( $description_color ) ? 'color: ' . $description_color . ';' : '' );
		$title_css = ( $title_css ) ? $title_css : false;
		$subtitle_css = ( $subtitle_css ) ? $subtitle_css : false;
		$description_css = ( $description_css ) ? $description_css : false;
		$overlay_css = ( $overlay_color ) ? 'background-color: ' . $overlay_color : false;


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

		$with_styles = ( $title_css || $subtitle_css || $description_css || $button_settings || $overlay_css || count( $element_custom_fonts ) > 0 );

		// Assembling
		ob_start();
		include( 'layout/banner_box.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
		'name' => __( 'Banner Box', 'argenta_extra' ),
		'description' => __( 'Banner / announcement box', 'argenta_extra' ),
		'base' => 'argenta_sc_banner_box',
		'category' => __( 'Argenta', 'argenta_extra' ),
		'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-BannerBox.png',
		'js_view' => 'VcArgentaBannerBoxView',
		'custom_markup' => '{{title}}<div class="vc_argenta_banner_box-container">
				<div class="image" style="background-image: url(\'' . plugin_dir_url( __FILE__ ) . 'images/vc_gap_image.svg\');">
					<div class="title">%%title%%</div>
					<div class="lines">%%subtitle%%</div>
				</div>
			</div>',
		'params' => array(
			// General
			array(
				'type' => 'argenta_choose_box',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Block layout', 'argenta_extra' ),
				'param_name' => 'block_type_layout',
				'value' => array(
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon24.png',
						'key' => 'full',
						'title' => __( 'Full content', 'argenta_extra' )
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon28.png',
						'key' => 'inner',
						'title' => __( 'Inner content', 'argenta_extra' )
					)
				)
			),
			array(
				'type' => 'argenta_choose_box',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Content align', 'argenta_extra' ),
				'param_name' => 'block_type_full_align',
				'value' => array(
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon27.png',
						'key' => 'left',
						'title' => __( 'Left', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon25.png',
						'key' => 'center',
						'title' => __( 'Center', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon26.png',
						'key' => 'right',
						'title' => __( 'Right', 'argenta_extra' ),
					)
				),
				'dependency' => array(
					'element' => 'block_type_layout',
					'value' => array(
						'full'
					)
				)
			),
			array(
				'type' => 'argenta_choose_box',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Content align', 'argenta_extra' ),
				'param_name' => 'block_type_inner_align',
				'value' => array(
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon28.png',
						'key' => 'top_left',
						'title' => __( 'Top - Left', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon29.png',
						'key' => 'top_center',
						'title' => __( 'Top - Center', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon30.png',
						'key' => 'top_right',
						'title' => __( 'Top - Right', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon31.png',
						'key' => 'bottom_left',
						'title' => __( 'Bottom - Left', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon32.png',
						'key' => 'bottom_center',
						'title' => __( 'Bottom - Center', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon33.png',
						'key' => 'bottom_right',
						'title' => __( 'Bottom - Right', 'argenta_extra' ),
					)
				),
				'dependency' => array(
					'element' => 'block_type_layout',
					'value' => array(
						'inner'
					)
				)
			),
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
				'group' => __( 'Content', 'argenta_extra' ),
				'heading' => __( 'Title', 'argenta_extra' ),
				'param_name' => 'title'
			),
			array(
				'type' => 'textfield',
				'group' => __( 'Content', 'argenta_extra' ),
				'heading' => __( 'Subtitle', 'argenta_extra' ),
				'param_name' => 'subtitle',
			),
			array(
				'type' => 'textarea',
				'group' => __( 'Content', 'argenta_extra' ),
				'heading' => __( 'Description', 'argenta_extra' ),
				'param_name' => 'description',
				'description' => __( 'Banner box can be used as announcement block. Therefore, you can write text of the announcement for page / post / category / external link.', 'argenta_extra' )
			),
			array(
				'type' => 'attach_image',
				'group' => __( 'Content', 'argenta_extra' ),
				'heading' => __( 'Background image', 'argenta_extra' ),
				'param_name' => 'background_image',
				'description' => __( 'Choose block background image.', 'argenta_extra' ),
			),

			// Link
			array(
				'type' => 'argenta_check',
				'group' => __( 'Link', 'argenta_extra' ),
				'heading' => __( 'With link?', 'argenta_extra' ),
				'param_name' => 'use_link',
				'description' => __( 'Select if you want to block links to a some page.', 'argenta_extra' ),
				'value' => array(
					__( 'Yes, sure', 'argenta_extra' ) => '1'
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
				'param_name' => 'style_tab_divider_readmore',
				'value' => __( 'Read more button', 'argenta_extra' ),
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
				'heading' => __( 'Background overlay color', 'argenta_extra' ),
				'param_name' => 'overlay_color',
				'value' => 'rgba(52, 52, 54, 0.9)',
				'dependency' => array(
					'element' => 'block_type_layout',
					'value' => array(
						'inner'
					)
				),
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
			)
		)
	) );