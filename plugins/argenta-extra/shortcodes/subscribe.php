<?php 

	/**
	* Visual Composer Argenta Subscribe shortcode
	*/

	add_shortcode( 'argenta_sc_subscribe', 'argenta_sc_subscribe_func' );

	function argenta_sc_subscribe_func( $atts ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$input_type = isset( $input_type ) ? argenta_extra_filter_string( $input_type, 'string', 'outline') : 'outline';
		$fullwidth = ( isset( $fullwidth ) ) ? argenta_extra_filter_boolean( $fullwidth ) : true;
		$input_placeholder = isset( $input_placeholder ) ? argenta_extra_filter_string( $input_placeholder, 'string', __( 'Enter your email', 'argenta_extra' ) ) : __( 'Enter your email', 'argenta_extra' );
		$feedburner_name = isset( $feedburner_name ) ? argenta_extra_filter_string( $feedburner_name, 'attr', '' ) : '';
		$input_color = isset( $input_color ) ? argenta_extra_filter_string( $input_color, 'string', false ) : false;
		$button_color = isset( $button_color ) ? argenta_extra_filter_string( $button_color, 'string', false ) : false;
		$button_typo = ( isset( $button_typo ) ) ? argenta_extra_filter_string( $button_typo ) : false;
		$appearance_effect = ( isset( $appearance_effect ) ) ? argenta_extra_filter_string( $appearance_effect, 'attr', 'none' )  : 'none';
		$appearance_duration = ( isset( $appearance_duration ) ) ? argenta_extra_filter_string( $appearance_duration, 'attr', false )  : false;
		$css_class = isset( $css_class ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' ) : '';

		// Styling
		$subscribe_uniqid = uniqid( 'argenta-custom-' );
		$subscribe_append_class = '';
		switch ( $input_type ) {
			case 'fill':
				$subscribe_append_class = ' subscribe-flat';
				break;
			case 'rounded_outline':
				$subscribe_append_class = ' subscribe-rounded';
				break;
			case 'rounded_fill':
				$subscribe_append_class = ' subscribe-flat subscribe-rounded';
				break;
		}

		$table_css = '';
		if ( $fullwidth ) {
			$table_css .= 'width: 100%;';
		}

		$input_color_css = ( $input_color ) ? 'background-color: ' . $input_color . ';' : false;
		$button_color_hover_css = ( $button_color ) ? 'border-color: ' . $button_color . '; color: ' . $button_color . '; background-color: #ffffff; ' : false;
		$button_color_css = ( $button_color ) ? 'background-color: ' . $button_color . '; border-color: ' . $button_color . ';' : '';
		$button_color_css .= argenta_extra_parse_VC_typography_to_CSS( $button_typo );

		$element_custom_fonts = array();
		$button_custom_font = argenta_extra_parse_VC_typography_custom_font( $button_typo );
		if ( $button_custom_font ) {
			$element_custom_fonts[] = $button_custom_font;
		}

		$with_styles = ( $table_css || $button_color_css || $input_color_css );

		// Assembling
		ob_start();
		include( 'layout/subscribe.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
			'name' => __( 'Subscribe Module', 'argenta_extra' ),
			'description' => __( 'Feed subscribe module', 'argenta_extra' ),
			'base' => 'argenta_sc_subscribe',
			'category' => __( 'Argenta', 'argenta_extra' ),
			'js_view' => 'VcArgentaSubscribeView',
			'custom_markup' => '{{title}}<div class="vc_argenta_subscribe-container">
				<em>%%title%%</em>
			</div>',
			'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-SubscribeModule.png',
			'params' => array(

				// General
				array(
					'type' => 'argenta_choose_box',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Form type', 'argenta_extra' ),
					'param_name' => 'input_type',
					'value' => array(
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon120.png',
							'key' => 'outline',
							'title' => __( 'Outline', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon121.png',
							'key' => 'fill',
							'title' => __( 'Flat', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon122.png',
							'key' => 'rounded_outline',
							'title' => __( 'Rounded outline', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon123.png',
							'key' => 'rounded_fill',
							'title' => __( 'Rounded flat', 'argenta_extra' ),
						)
					)
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Input placeholder', 'argenta_extra' ),
					'value' => __( 'Enter your email', 'argenta_extra' ),
					'param_name' => 'input_placeholder',
					'description' => __( 'Don\'t leave empty', 'argenta_extra' ),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Feedburner feed name', 'argenta_extra' ),
					'param_name' => 'feedburner_name',
					'description' => __( 'See <a href="https://feedburner.google.com/" target="_blank">Feedburner.com</a> service', 'argenta_extra' ),
				),

				// Typography
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_heading',
					'value' => __( 'Button text', 'argenta_extra' )
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'button_typo'
				),
				 
				// Style
				array(
					'type' => 'argenta_check',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Full width', 'argenta_extra' ),
					'param_name' => 'fullwidth',
					'value' => array(
						__( 'Yes, sure', 'argenta_extra' ) => '1'
					)
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Input background color', 'argenta_extra' ),
					'param_name' => 'input_color',
					'dependency' => array(
						'element' => 'input_type',
						'value' => array(
							'fill',
							'rounded_fill'
						)
					)
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Button color', 'argenta_extra' ),
					'param_name' => 'button_color',
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