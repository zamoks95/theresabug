<?php 

	/**
	* Visual Composer Argenta Video shortcode
	*/

	add_shortcode( 'argenta_sc_video_module', 'argenta_sc_video_module_func' );

	function argenta_sc_video_module_func( $atts ) {
		if ( is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$layout = isset( $layout ) ? argenta_extra_filter_string( $layout, 'string', 'boxed_shape') : 'boxed_shape';
		$icon_layout = isset( $icon_layout ) ? argenta_extra_filter_string( $icon_layout, 'string', 'default') : 'default';
		$button_layout = isset( $button_layout ) ? argenta_extra_filter_string( $button_layout, 'string', 'filled') : 'filled';
		$preview_image = isset( $preview_image ) ? wp_get_attachment_url( $preview_image ) : false;
		$link = isset( $link ) ? argenta_extra_filter_string( $link, 'string', '' ) : '';
		$title = isset( $title ) ? argenta_extra_filter_string( $title, 'string', '' ) : '';
		$subtitle = isset( $subtitle ) ? argenta_extra_filter_string( $subtitle, 'string', '' ) : '';

		$title_typo = ( isset( $title_typo ) ) ? argenta_extra_filter_string( $title_typo ) : false;
		$subtitle_typo = ( isset( $subtitle_typo ) ) ? argenta_extra_filter_string( $subtitle_typo ) : false;

		$shape_rounded = isset( $shape_rounded ) ? argenta_extra_filter_boolean( $shape_rounded ) : false;
		$background_color = isset( $background_color ) ? argenta_extra_filter_string( $background_color, 'string', false ) : false;
		$border_color = isset( $border_color ) ? argenta_extra_filter_string( $border_color, 'string', false ) : false;
		$button_color = isset( $button_color ) ? argenta_extra_filter_string( $button_color, 'string', false ) : false;
		$icon_color = isset( $icon_color ) ? argenta_extra_filter_string( $icon_color, 'string', false ) : false;
		$title_color = isset( $title_color ) ? argenta_extra_filter_string( $title_color, 'string', false ) : false;
		$subtitle_color = isset( $subtitle_color ) ? argenta_extra_filter_string( $subtitle_color, 'string', false ) : false;

		$appearance_effect = ( isset( $appearance_effect ) ) ? argenta_extra_filter_string( $appearance_effect, 'attr', 'none' )  : 'none';
		$appearance_duration = ( isset( $appearance_duration ) ) ? argenta_extra_filter_string( $appearance_duration, 'attr', false )  : false;

		$css_class = isset( $css_class ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' ) : '';


		$url = parse_url( $link );

		if ( isset( $url['host'] ) ) {
			// YouTube
			if( $url['host'] == 'www.youtube.com' || $url['host'] == 'youtube.com' || $url['host'] == 'youtu.be' ) {
				if ( isset( $url['query'] ) ) {
					parse_str( $url['query'], $query );
				}
				if ( isset( $query['v'] ) && $query['v'] ) {
					$link = 'https://www.youtube.com/embed/' . $query['v'];
				}
			}

			// Vimeo
			if( $url['host'] == 'www.vimeo.com' || $url['host'] == 'vimeo.com' ) {
				if( $url['path'] ) {
					$link = 'https://player.vimeo.com/video' . $url['path'];
				}
			}
		}

		// Styling
		$video_module_uniqid = uniqid( 'argenta-custom-' );
		$video_module_class = '';

		if ( $layout == 'outline' ) {
			$video_module_class .= ' video-module-outline';
		}

		switch ( $icon_layout ) {
			case 'boxed':
				$video_module_class .= ' video-module-shape';
				break;
			case 'full_boxed':
				$video_module_class .= ' video-module-shape-full';
				break;
		}

		if ( $shape_rounded ) {
			$video_module_class .= ' rounded';
		}
		
		$background_css = ( $background_color ) ? 'background-color: ' . $background_color . ';' : '';
		$background_css .= ( $border_color ) ? ' border-color: ' . $border_color . ';' : '';
		$button_css = ( $button_color ) ? 'background-color: ' . $button_color . ';' : '';
		$icon_css = ( $icon_color ) ? 'color: ' . $icon_color . ';' : '';
		$title_css = ( $title_color ) ? 'color: ' . $title_color . ';' : '';
		$subtitle_css = ( $subtitle_color ) ? 'color: ' . $subtitle_color . ';' : '';
		$button_outline_css = false;

		if ( $button_color ) {
			$button_outline_css = 'border-color: ' . $button_color . ';';
			if ( $icon_color ){
				$button_outline_css .= ' color: ' . $icon_color . ';';
			}
		}

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

		$with_styles = (bool) ( $button_outline_css || $background_css || $button_css || $icon_css || $title_css || $subtitle_css || count($element_custom_fonts) > 0 );

		// Assembling
		ob_start();
		include( 'layout/video_module.php' );
		$content = ob_get_contents();
		ob_end_clean();

		argenta_gh_add_required_script( 'video' );

		return $content;
	}


	vc_map( array(
			'name' => __( 'Video', 'argenta_extra' ),
			'description' => __( 'Popup video module', 'argenta_extra' ),
			'base' => 'argenta_sc_video_module',
			'category' => __( 'Argenta', 'argenta_extra' ),
			'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-VideoModule.png',
			'params' => array(

				// General
				array(
					'type' => 'argenta_choose_box',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Layout', 'argenta_extra' ),
					'param_name' => 'layout',
					'value' => array(
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon61.png',
							'key' => 'boxed_shape',
							'title' => __( 'Boxed Shape', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon62.png',
							'key' => 'outline',
							'title' => __( 'Outline', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon66.png',
							'key' => 'with_preview',
							'title' => __( 'With Preview Image', 'argenta_extra' ),
						)
					)
				),
				array(
					'type' => 'argenta_choose_box',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Icon layout', 'argenta_extra' ),
					'param_name' => 'icon_layout',
					'value' => array(
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon63.png',
							'key' => 'default',
							'title' => __( 'Default', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon64.png',
							'key' => 'boxed',
							'title' => __( 'Boxed', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon65.png',
							'key' => 'full_boxed',
							'title' => __( 'Full Boxed', 'argenta_extra' ),
						)
					),
					'dependency' => array(
						'element' => 'layout',
						'value' => array(
							'boxed_shape',
							'outline'
						)
					)
				),
				array(
					'type' => 'argenta_choose_box',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Button layout', 'argenta_extra' ),
					'param_name' => 'button_layout',
					'value' => array(
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon67.png',
							'key' => 'filled',
							'title' => __( 'Filled', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon68.png',
							'key' => 'outline',
							'title' => __( 'Outline', 'argenta_extra' ),
						),
					),
					'dependency' => array(
						'element' => 'layout',
						'value' => array(
							'with_preview'
						)
					)
				),
				array(
					'type' => 'attach_image',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Preview image', 'argenta_extra' ),
					'param_name' => 'preview_image',
					'dependency' => array(
						'element' => 'layout',
						'value' => array(
							'with_preview'
						)
					)
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Video URL', 'argenta_extra' ),
					'param_name' => 'link',
					'value' => '',
					'description' => 'For example, https://www.youtube.com/watch?v=dQw4w9WgXcQ'
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Video title', 'argenta_extra' ),
					'param_name' => 'title',
					'value' => '',
					'description' => '',
					'dependency' => array(
						'element' => 'layout',
						'value' => array(
							'boxed_shape',
							'outline'
						)
					)
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Subtitle', 'argenta_extra' ),
					'param_name' => 'subtitle',
					'value' => '',
					'description' => '',
					'dependency' => array(
						'element' => 'layout',
						'value' => array(
							'boxed_shape',
							'outline'
						)
					)
				),

				// Typography
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_title',
					'value' => __( 'Title', 'argenta_extra' ),
					'dependency' => array(
						'element' => 'layout',
						'value' => array(
							'boxed_shape',
							'outline'
						)
					)
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'title_typo',
					'dependency' => array(
						'element' => 'layout',
						'value' => array(
							'boxed_shape',
							'outline'
						)
					)
				),
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_subtitle',
					'value' => __( 'Subtitle', 'argenta_extra' ),
					'dependency' => array(
						'element' => 'layout',
						'value' => array(
							'boxed_shape',
							'outline'
						)
					)
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'subtitle_typo',
					'dependency' => array(
						'element' => 'layout',
						'value' => array(
							'boxed_shape',
							'outline'
						)
					)
				),
				
				// Style
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'param_name' => 'style_tab_divider_button',
					'value' => __( 'Button', 'argenta_extra' )
				),
				array(
					'type' => 'argenta_check',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Rounded shape', 'argenta_extra' ),
					'param_name' => 'shape_rounded',
					'value' => array(
						__( 'Yes', 'argenta_extra' ) => '0'
					),
					'dependency' => array(
						'element' => 'layout',
						'value' => array(
							'boxed_shape',
							'outline'
						)
					)
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Background color', 'argenta_extra' ),
					'param_name' => 'background_color',
					'dependency' => array(
						'element' => 'layout',
						'value' => array(
							'boxed_shape'
						)
					)
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Border color', 'argenta_extra' ),
					'param_name' => 'border_color',
					'dependency' => array(
						'element' => 'layout',
						'value' => array(
							'outline'
						)
					)
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Button color', 'argenta_extra' ),
					'param_name' => 'button_color'
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Icon color', 'argenta_extra' ),
					'param_name' => 'icon_color'
				),
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'param_name' => 'style_tab_divider_typo',
					'value' => __( 'Typography', 'argenta_extra' )
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Title color', 'argenta_extra' ),
					'param_name' => 'title_color',
					'dependency' => array(
						'element' => 'layout',
						'value' => array(
							'boxed_shape',
							'outline'
						)
					)
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Subtitle color', 'argenta_extra' ),
					'param_name' => 'subtitle_color',
					'dependency' => array(
						'element' => 'layout',
						'value' => array(
							'boxed_shape',
							'outline'
						)
					)
				),
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'param_name' => 'style_tab_divider_other',
					'value' => __( 'Other', 'argenta_extra' )
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
			)
		)
	);