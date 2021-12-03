<?php 

	/**
	* Visual Composer Argenta Split screen shortcode
	*/

	add_shortcode( 'argenta_sc_split_screens', 'argenta_sc_split_screens_func' );

	function argenta_sc_split_screens_func( $atts, $content = '' ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}


		// Default values, parsing and filtering
		$animation_duration = ( isset( $animation_duration ) ) ? argenta_extra_filter_string( $animation_duration ) : 'default';
		$navigation_buttons  = ( isset( $navigation_buttons ) ) ? argenta_extra_filter_boolean( $navigation_buttons ) : true;
		$navigation_color = ( isset( $navigation_color ) ) ? argenta_extra_filter_string( $navigation_color ) : false;
		$css_class = ( isset( $css_class ) ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' )  : '';

		// Styles
		$split_screens_uniqid = uniqid('argenta-custom-');

		$animation_duration_css = false;
		if ( $animation_duration != 'default' ) {
			switch ( $animation_duration ) {
				case 'fast':
					$animation_duration_css = 'transition: all .3s ease-in-out;';
					break;
				case 'slow':
					$animation_duration_css = 'transition: all 1s ease-in-out;';
					break;

			}
		}

		$navigation_css = '';
		$navigation_active_css = '';
		if ( $navigation_color ) {
			$navigation_css = 'background:' . $navigation_color . ';border-color:' . $navigation_color . ';';
			$navigation_active_css = 'background:transparent;';
		}

		$with_styles = (bool) ( $animation_duration_css || $navigation_css || $navigation_active_css );

		// Assembling
		$screens_content = array();
		$_screens_content = explode( '[/argenta_sc_split_screen]', $content );
		foreach ( $_screens_content as $screen ) {
			$enter_pos = strpos( $screen, '[argenta_sc_split_screen]' );
			if ( $enter_pos > -1 ) {
				$screens_content[] = substr( $screen, $enter_pos + 25 );
			}
		}
		foreach ( $screens_content as $key => $screen ) {
			$screens_content[$key] = array(
				'left' => array(
					'attr' => '',
					'content' => ''
				),
				'right' => array(
					'attr' => '',
					'content' => ''
				),
			);
			preg_match( '/\[argenta_sc_split_screen_column_left.*?\]/', $screen, $matches, PREG_OFFSET_CAPTURE );
			if ( count( $matches ) > 0 ) {
				$left_enter_pos = $matches[0][1];
			} else {
				$left_enter_pos = false;
			}
			$left_close_pos = strpos( $screen, '[/argenta_sc_split_screen_column_left]' );			
			if ( $left_enter_pos > -1 && $left_close_pos > -1 ) {
				$screens_content[$key]['left']['content'] = substr(
					$screen, 
					$left_enter_pos + ( strlen( $matches[0][0] ) ), 
					$left_close_pos - $left_enter_pos - strlen( $matches[0][0] )
				);
				$screens_content[$key]['left']['attr'] = substr( $matches[0][0], 36, strlen( $matches[0][0] ) - 37 );
			}

			preg_match( '/\[argenta_sc_split_screen_column_right.*?\]/', $screen, $matches, PREG_OFFSET_CAPTURE );
			if ( count( $matches ) > 0 ) {
				$right_enter_pos = $matches[0][1];
			} else {
				$right_enter_pos = false;
			}
			$right_close_pos = strpos( $screen, '[/argenta_sc_split_screen_column_right]' );
			if ( $right_enter_pos > -1 && $right_close_pos > -1 ) {
				$screens_content[$key]['right']['content'] = substr(
					$screen, 
					$right_enter_pos + ( strlen( $matches[0][0] ) ), 
					$right_close_pos - $right_enter_pos - strlen( $matches[0][0] )
				);
				$screens_content[$key]['right']['attr'] = substr( $matches[0][0], 37, strlen( $matches[0][0] ) - 38 );
			}
		}

		$content = '[argenta_sc_split_screen_column_left]';
		foreach ( $screens_content as $screen ) {
			$content .= '[argenta_sc_split_screen' . $screen['left']['attr'] . ']' . $screen['left']['content'] . '[/argenta_sc_split_screen]';
		}
		$content .= '[/argenta_sc_split_screen_column_left]';
		$content .= '[argenta_sc_split_screen_column_right]';
		foreach ( $screens_content as $screen ) {
			$content .= '[argenta_sc_split_screen' . $screen['right']['attr'] . ']' . $screen['right']['content'] . '[/argenta_sc_split_screen]';
		}
		$content .= '[/argenta_sc_split_screen_column_right]';

		ob_start();
		include( 'layout/split_screens.php' );
		$content = ob_get_contents();
		ob_end_clean();

		argenta_gh_add_required_script( 'multiscroll' );

		return $content;
	}


		vc_map( array(
				'name' => __( 'Split Screen', 'argenta_extra' ),
				'description' => __( 'Split view in screens', 'argenta_extra' ),
				'base' => 'argenta_sc_split_screens',
				'category' => __( 'Argenta', 'argenta_extra' ),
				'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-SplitScreen.png',
				'holder' => '',
				'js_view' => 'VcArgentaSplitScreensView',
				'show_settings_on_create' => false,
				'content_element' => true,
				'is_container' => true,
				'as_parent' => array(
					'only' => 'argenta_sc_split_screen'
				),
				'default_content' => '[argenta_sc_split_screen][/argenta_sc_split_screen]',
				'params' => array(
					array(
						'type' => 'dropdown',
						'group' => __( 'Styles and colors', 'argenta_extra' ),
						'heading' => __( 'Scroll animation duration', 'argenta_extra' ),
						'param_name' => 'animation_duration',
						'value' => array(
							__( 'Default', 'argenta_extra' ) => 'default',
							__( 'Fast', 'argenta_extra' ) => 'fast',
							__( 'Slow', 'argenta_extra' ) => 'slow'
						),
					),
					array(
						'type' => 'argenta_check',
						'group' => __( 'Styles and colors', 'argenta_extra' ),
						'heading' => __( 'Show navigation buttons?', 'argenta_extra' ),
						'param_name' => 'navigation_buttons',
						'description' => __( 'Show navigation dots on page' ),
						'value' => array(
							__( 'Yes', 'argenta_extra' ) => '1'
						),
					),
					array(
						'type' => 'colorpicker',
						'group' => __( 'Styles and colors', 'argenta_extra' ),
						'heading' => __( 'Navigation buttons color', 'argenta_extra' ),
						'param_name' => 'navigation_color',
						'dependency' => array(
							'element' => 'navigation_buttons',
							'value' => array(
								'1',
								true
							)
						)
					),
					array(
						'type' => 'textfield',
						'group' => __( 'Styles and colors', 'argenta_extra' ),
						'heading' => __( 'Custom CSS class', 'argenta_extra' ),
						'param_name' => 'css_class',
						'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class.', 'argenta_extra' ),
					),
				)
			)
	);

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

		class WPBakeryShortCode_Argenta_Sc_Split_Screens extends WPBakeryShortCodesContainer {
		}

	}