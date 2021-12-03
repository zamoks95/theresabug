<?php 

	/**
	* Visual Composer Argenta Social bar shortcode
	*/

	add_shortcode( 'argenta_sc_social_bar', 'argenta_sc_social_bar_func' );

	function argenta_sc_social_bar_func( $atts ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$icon_layout = isset( $icon_layout ) ? argenta_extra_filter_string( $icon_layout, 'string', 'fill') : 'fill';
		$shape_rounded = isset( $shape_rounded ) ? argenta_extra_filter_boolean( $shape_rounded ) : true;
		$shape_shadow = isset( $shape_shadow ) ? argenta_extra_filter_boolean( $shape_shadow ) : true;

		$css_class = isset( $css_class ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' ) : '';
		$hover = isset( $hover ) ? argenta_extra_filter_string( $hover, 'string', 'default') : 'default';
		$default_colors = isset( $default_colors ) ? argenta_extra_filter_boolean( $default_colors ) : true;
		$appearance_effect = ( isset( $appearance_effect ) ) ? argenta_extra_filter_string( $appearance_effect, 'attr', 'none' )  : 'none';
		$appearance_duration = ( isset( $appearance_duration ) ) ? argenta_extra_filter_string( $appearance_duration, 'attr', false )  : false;
		
		$type_links = ( isset( $type_links ) ) ? argenta_extra_filter_string( $type_links, 'string', 'share' ) : 'share';

		$facebook = isset( $facebook ) ? argenta_extra_filter_boolean( $facebook ) : true;
		$googleplus = isset( $googleplus ) ? argenta_extra_filter_boolean( $googleplus ) : true;
		$twitter = isset( $twitter ) ? argenta_extra_filter_boolean( $twitter ) : true;
		$pinterest = isset( $pinterest ) ? argenta_extra_filter_boolean( $pinterest ) : true;
		$linkedin = isset( $linkedin ) ? argenta_extra_filter_boolean( $linkedin ) : true;

		$facebook_link_custom = isset( $facebook_link_custom ) ? ' ' . argenta_extra_filter_string( $facebook_link_custom, 'attr', '' ) : '';
		$twitter_link_custom = isset( $twitter_link_custom ) ? ' ' . argenta_extra_filter_string( $twitter_link_custom, 'attr', '' ) : '';
		$instagram_link_custom = isset( $instagram_link_custom ) ? ' ' . argenta_extra_filter_string( $instagram_link_custom, 'attr', '' ) : '';
		$dribbble_link_custom = isset( $dribbble_link_custom ) ? ' ' . argenta_extra_filter_string( $dribbble_link_custom, 'attr', '' ) : '';
		$googleplus_link_custom = isset( $googleplus_link_custom ) ? ' ' . argenta_extra_filter_string( $googleplus_link_custom, 'attr', '' ) : '';
		$pinterest_link_custom = isset( $pinterest_link_custom ) ? ' ' . argenta_extra_filter_string( $pinterest_link_custom, 'attr', '' ) : '';
		$linkedin_link_custom = isset( $linkedin_link_custom ) ? ' ' . argenta_extra_filter_string( $linkedin_link_custom, 'attr', '' ) : '';
		$github_link_custom = isset( $github_link_custom ) ? ' ' . argenta_extra_filter_string( $github_link_custom, 'attr', '' ) : '';

		$hide_border = isset( $hide_border ) ? argenta_extra_filter_boolean( $hide_border ) : true;
		$color = isset( $color ) ? argenta_extra_filter_string( $color, 'string', false ) : false;
		$icon_color = isset( $icon_color ) ? argenta_extra_filter_string( $icon_color, 'string', false ) : false;


		$dribbble_link = false;
		$github_link = false;
		$instagram_link = false;

		if ( $type_links == 'custom' ) {
			$facebook_link 	= $facebook_link_custom;
			$twitter_link 		= $twitter_link_custom;
			$dribbble_link 	= $dribbble_link_custom;
			$googleplus_link 	= $googleplus_link_custom;
			$pinterest_link 	= $pinterest_link_custom;
			$linkedin_link 	= $linkedin_link_custom;
			$github_link 		= $github_link_custom;
			$instagram_link 	= $instagram_link_custom;
		} else {
			global $post;
			$facebook_link 		= ( $facebook ) ? 'https://www.facebook.com/sharer/sharer.php?u=' . get_permalink() : '';
			$twitter_link 		= ( $twitter ) ? 'https://twitter.com/intent/tweet?text=' . urlencode( $post->post_title ) . ',+' . get_permalink() : '';
			$googleplus_link 	= ( $googleplus ) ? 'https://plus.google.com/share?url=' . urlencode( get_permalink() ) : '';
			$pinterest_link 	= ( $pinterest ) ? 'http://pinterest.com/pin/create/button/?url=' . urlencode( get_permalink() ) . '&description=' . urlencode( $post->post_title ) : '';
			$linkedin_link 		= ( $linkedin ) ? 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode( get_permalink() ) . '&title=' . urlencode( $post->post_title ) . '&source=' . urlencode( get_bloginfo( 'name' ) ) : '';
		}

		// Styling
		$social_bar_uniqid = uniqid( 'argenta-custom-' );
		$link_class = '';
		$socialbar_class = '';

		if ( $shape_rounded && $icon_layout != 'boxed_full' ) {
			$link_class .= ' rounded';
		}

		if ( $type_links == 'custom' ) {
			$link_class .= ' custom-link';
		}

		switch ( $icon_layout ) {
			case 'outline':
				$link_class .= ' outline';
				break;
			case 'flat':
				$link_class .= ' flat';
				break;
			case 'boxed_full':
				$socialbar_class .= ' boxed-fullwidth';
				break;
		}


		if ( $icon_layout != 'boxed_full' ) {
			switch ( $hover ) {
				case 'inner_border':
					$link_class .= ' social-hover-1';
					break;
				case 'inner':
					$link_class .= ' social-hover-2';
					break;
				case 'fade_in':
					$link_class .= ' social-hover-3';
					break;
				case 'fade_out':
					$link_class .= ' social-hover-4';
					break;
				case 'slide':
					$link_class .= ' social-hover-5';
					break;
			}
		}


		$link_count = 0;
		if ( $facebook_link ) {
			$link_count++;
		}
		if ( $googleplus_link ) {
			$link_count++;
		}
		if ( $twitter_link ) {
			$link_count++;
		}
		if ( $pinterest_link ) {
			$link_count++;
		}
		if ( $linkedin_link ) {
			$link_count++;
		}
		if ( $github_link ) {
			$link_count++;
		}
		if ( $dribbble_link ) {
			$link_count++;
		}
		if ( $instagram_link ) {
			$link_count++;
		}

		$socialbar_class .= ' social-column-' . $link_count;

		if ( $shape_shadow && $icon_layout != 'boxed_full' ) {
			$link_class .= ' shadow';
		}


		if ( $default_colors ) {
			$link_class .= ' default';
		}

		$social_css = '';
		$social_css_hover = '';
		$social_css_after = '';
		
		if ( $color && !$default_colors ) {
			if( $hover == 'default' ) {
				switch ( $icon_layout ) {
					case 'outline':
						$social_css = 'color: ' . $color . '; border-color: ' . $color . ';';
						$social_css_hover = 'background-color: ' . $color . '; color: #ffffff;';
						break;
					case 'shadow':
						$social_css = 'color: ' . $color . ';';
						$social_css_hover = '';
						break;
					case 'flat':
						$social_css = 'color: ' . $color . ';';
						$social_css_hover = 'background-color: ' . $color . '; color: #ffffff;';
						break;
					case 'fill':
						$social_css = 'background-color: ' . $color . '; color: ' . ( ( $icon_color ) ? $icon_color : '#ffffff' ) . ';';
						$social_css_hover = 'background-color: ' . ( ( $icon_color ) ? $icon_color : 'transparent' ) . '; color: ' . $color . ';';
						break;
					default:
						$social_css = 'background-color: ' . $color . ';';
						$social_css_hover = 'background-color: transparent; color: ' . $color . ';';
				}
			} else {
				switch ( $hover ) {
					case 'inner_border':
						$social_css = 'border-color: ' . $color . ';';
						$social_css_hover = false;
						$social_css_after = 'background-color: ' . $color . ';';
						break;
					case 'inner':
						$social_css = 'border-color: ' . $color . ';';
						$social_css_hover = 'color: ' . $color . ';';
						$social_css_after = 'background-color: ' . $color . ';';
						break;
					case 'fade_in':
						$social_css = 'border-color: ' . $color . ';';
						$social_css_hover = 'color: ' . $color . ';';
						$social_css_after = 'background-color: ' . $color . ';';
						break;
					case 'fade_out':
						$social_css = 'color: ' . $color . '; border-color: ' . $color;
						$social_css_hover = 'color: #ffffff';
						$social_css_after = 'background-color: ' . $color . ';';
						break;
					case 'slide':
						$social_css = 'color: ' . $color . '; border-color: ' . $color;
						$social_css_hover = 'background: ' . $color . '; color: #ffffff';
						$social_css_after = 'background-color: ' . $color . ';';
						break;
					default:
						$social_css = 'background-color: ' . $color . '; border-color: ' . $color . ';';
						$social_css_hover = 'background-color: transparent; color: ' . $color . ';';
				}
			}
		}

		if ( $hide_border && $icon_layout == 'fill' ) {
			$social_css .= 'border-width: 0px;';
		}

		$with_styles = ( $social_css || $social_css_hover || $social_css_after );

		// Assembling
		ob_start();
		include( 'layout/social_bar.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
			'name' => __( 'Social Bar', 'argenta_extra' ),
			'description' => __( 'Social sharing buttons block', 'argenta_extra' ),
			'base' => 'argenta_sc_social_bar',
			'category' => __( 'Argenta', 'argenta_extra' ),
			'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-SocialBar.png',
			'params' => array(

				// General
				array(
					'type' => 'argenta_choose_box',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Icon layout', 'argenta_extra' ),
					'param_name' => 'icon_layout',
					'value' => array(
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon39.png',
							'key' => 'fill',
							'title' => __( 'Fill', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon40.png',
							'key' => 'outline',
							'title' => __( 'Outline', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon41.png',
							'key' => 'flat',
							'title' => __( 'Flat', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon41.1.png',
							'key' => 'boxed_full',
							'title' => __( 'Boxed Full Width', 'argenta_extra' ),
						)
					)
				),
				array(
					'type' => 'dropdown',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Links click action', 'argenta_extra' ),
					'param_name' => 'type_links',
					'value' => array(
						__( 'Share to social media', 'argenta_extra' ) => 'share',
						__( 'Open links in new tab', 'argenta_extra' ) => 'custom',
					),
				),
				array(
					'type' => 'argenta_check',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => '<em class="argenta_is ion-social-facebook"></em>' . __( 'Facebook share', 'argenta_extra' ),
					'param_name' => 'facebook',
					'value' => array(
						__( 'Add', 'argenta_extra' ) => '1'
					),
					'dependency' => array(
						'element' => 'type_links',
						'value' => 'share',
					),
				),
				array(
					'type' => 'argenta_check',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => '<em class="argenta_is ion-social-twitter"></em>' . __( 'Twitter share', 'argenta_extra' ),
					'param_name' => 'twitter',
					'value' => array(
						__( 'Add', 'argenta_extra' ) => '1'
					),
					'dependency' => array(
						'element' => 'type_links',
						'value' => 'share',
					),
				),
				array(
					'type' => 'argenta_check',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => '<em class="argenta_is ion-social-googleplus-outline"></em>' . __( 'Google+ share', 'argenta_extra' ),
					'param_name' => 'googleplus',
					'value' => array(
						__( 'Add', 'argenta_extra' ) => '1'
					),
					'dependency' => array(
						'element' => 'type_links',
						'value' => 'share',
					),
				),
				array(
					'type' => 'argenta_check',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => '<em class="argenta_is ion-social-linkedin-outline"></em>' . __( 'LinkedIn share', 'argenta_extra' ),
					'param_name' => 'linkedin',
					'value' => array(
						__( 'Add', 'argenta_extra' ) => '1'
					),
					'dependency' => array(
						'element' => 'type_links',
						'value' => 'share',
					),
				),
				array(
					'type' => 'argenta_check',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => '<em class="argenta_is ion-social-pinterest-outline"></em>' . __( 'Pinterest share', 'argenta_extra' ),
					'param_name' => 'pinterest',
					'value' => array(
						__( 'Add', 'argenta_extra' ) => '1'
					),
					'dependency' => array(
						'element' => 'type_links',
						'value' => 'share',
					),
				),
				/* Custom */
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => '<em class="argenta_is ion-social-facebook"></em>' . __( 'Facebook link', 'argenta_extra' ),
					'param_name' => 'facebook_link_custom',
					'dependency' => array(
						'element' => 'type_links',
						'value' => 'custom',
					),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => '<em class="argenta_is ion-social-twitter"></em>' . __( 'Twitter link', 'argenta_extra' ),
					'param_name' => 'twitter_link_custom',
					'dependency' => array(
						'element' => 'type_links',
						'value' => 'custom',
					),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => '<em class="argenta_is ion-social-googleplus-outline"></em>' . __( 'Google+ link', 'argenta_extra' ),
					'param_name' => 'googleplus_link_custom',
					'dependency' => array(
						'element' => 'type_links',
						'value' => 'custom',
					),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => '<em class="argenta_is ion-social-instagram-outline"></em>' . __( 'Instagram link', 'argenta_extra' ),
					'param_name' => 'instagram_link_custom',
					'dependency' => array(
						'element' => 'type_links',
						'value' => 'custom',
					),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => '<em class="argenta_is ion-social-dribbble"></em>' . __( 'Dribbble link', 'argenta_extra' ),
					'param_name' => 'dribbble_link_custom',
					'dependency' => array(
						'element' => 'type_links',
						'value' => 'custom',
					),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => '<em class="argenta_is ion-social-linkedin-outline"></em>' . __( 'LinkedIn link', 'argenta_extra' ),
					'param_name' => 'linkedin_link_custom',
					'dependency' => array(
						'element' => 'type_links',
						'value' => 'custom',
					),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => '<em class="argenta_is ion-social-pinterest-outline"></em>' . __( 'Pinterest link', 'argenta_extra' ),
					'param_name' => 'pinterest_link_custom',
					'dependency' => array(
						'element' => 'type_links',
						'value' => 'custom',
					),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => '<em class="argenta_is ion-social-github"></em>' . __( 'GitHub link', 'argenta_extra' ),
					'param_name' => 'github_link_custom',
					'dependency' => array(
						'element' => 'type_links',
						'value' => 'custom',
					),
				),
				
				// Style
				array(
					'type' => 'argenta_check',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Rounded shape', 'argenta_extra' ),
					'param_name' => 'shape_rounded',
					'value' => array(
						__( 'Yes', 'argenta_extra' ) => '1'
					),
					'dependency' => array(
						'element' => 'icon_layout',
						'value' => array(
							'fill',
							'outline',
							'flat'
						),
					),
				),
				array(
					'type' => 'argenta_check',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Shadow shape', 'argenta_extra' ),
					'param_name' => 'shape_shadow',
					'value' => array(
						__( 'Yes', 'argenta_extra' ) => '1'
					),
					'dependency' => array(
						'element' => 'icon_layout',
						'value' => array(
							'fill',
							'outline',
							'flat'
						),
					),
				),
				array(
					'type' => 'argenta_check',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Hide border?', 'argenta_extra' ),
					'param_name' => 'hide_border',
					'value' => array(
						__( 'Yes', 'argenta_extra' ) => '1'
					),
					'dependency' => array(
						'element' => 'icon_layout',
						'value' => 'fill',
					),
				),
				array(
					'type' => 'dropdown',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Hover', 'argenta_extra' ),
					'param_name' => 'hover',
					'value' => array(
						__( 'Default', 'argenta_extra' ) => 'default',
						__( 'Inner border', 'argenta_extra' ) => 'inner_border',
						__( 'Inner', 'argenta_extra' ) => 'inner',
						__( 'Fade in', 'argenta_extra' ) => 'fade_in',
						__( 'Fade out', 'argenta_extra' ) => 'fade_out',
						__( 'Slide', 'argenta_extra' ) => 'slide'
					),
					'dependency' => array(
						'element' => 'icon_layout',
						'value' => array(
							'fill',
							'outline',
							'flat'
						),
					),
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Background color', 'argenta_extra' ),
					'param_name' => 'color',
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Icon color', 'argenta_extra' ),
					'param_name' => 'icon_color',
					'dependency' => array(
						'element' => 'icon_layout',
						'value' => 'fill',
					),
				),
				array(
					'type' => 'argenta_check',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Use default colors', 'argenta_extra' ),
					'param_name' => 'default_colors',
					'value' => array(
						__( 'Yes', 'argenta_extra' ) => '1'
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
				),
			)
		)
	);