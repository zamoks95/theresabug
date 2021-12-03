<?php 

	/**
	* Visual Composer Argenta Message box shortcode
	*/

	add_shortcode( 'argenta_sc_message_box', 'argenta_sc_message_box_func' );

	function argenta_sc_message_box_func( $atts ) {
		if ( is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$layout = isset( $layout ) ? argenta_extra_filter_string( $layout, 'string', 'default') : 'default';
		$text = isset( $text ) ? argenta_extra_filter_string( $text, 'string', '') : '';
		$text_typo = ( isset( $text_typo ) ) ? argenta_extra_filter_string( $text_typo ) : false;
		$link_typo = ( isset( $link_typo ) ) ? argenta_extra_filter_string( $link_typo ) : false;
		$text_color = isset( $text_color ) ? argenta_extra_filter_string( $text_color, 'string', false ) : false;
		$link_color = isset( $link_color ) ? argenta_extra_filter_string( $link_color, 'string', false ) : false;
		
		$appearance_effect = ( isset( $appearance_effect ) ) ? argenta_extra_filter_string( $appearance_effect, 'attr', 'none' )  : 'none';
		$appearance_duration = ( isset( $appearance_duration ) ) ? argenta_extra_filter_string( $appearance_duration, 'attr', false )  : false;
		$css_class = isset( $css_class ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' ) : '';

		// Styling
		$message_box_uniqid = uniqid( 'argenta-custom-' );

		switch ( $layout ) {
			case 'warning':
				$message_box_class = ' message-box-warning';
				break;
			case 'success':
				$message_box_class = ' message-box-success';
				break;
			case 'primary':
				$message_box_class = ' message-box-primary';
				break;
			case 'danger':
				$message_box_class = ' message-box-error';
				break;
			default:
				$message_box_class = false;
		}

		$link = isset( $link ) ? argenta_extra_parse_VC_link_params( $link, array( 'caption' => __( 'Click me', 'argenta_extra' ) ) ) : false;

		$text_css = ( $text_color ) ? 'color: ' . $text_color . ';' : '';
		$link_css = ( $link_color ) ? 'color: ' . $link_color . ';' : '';

		$element_custom_fonts = array();
		$text_custom_font = argenta_extra_parse_VC_typography_custom_font( $text_typo );
		if ( $text_custom_font ) {
			$element_custom_fonts[] = $text_custom_font;
		}
		$link_custom_font = argenta_extra_parse_VC_typography_custom_font( $link_typo );
		if ( $link_custom_font ) {
			$element_custom_fonts[] = $link_custom_font;
		}

		$text_css = $text_css . argenta_extra_parse_VC_typography_to_CSS( $text_typo );
		$link_css = $link_css . argenta_extra_parse_VC_typography_to_CSS( $link_typo );

		$with_styles = ( $text_css || $link_css || count($element_custom_fonts) > 0 );

		// Assembling
		ob_start();
		include( 'layout/message_box.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
			'name' => __( 'Message Box', 'argenta_extra' ),
			'description' => __( 'Messages and notifications box', 'argenta_extra' ),
			'base' => 'argenta_sc_message_box',
			'category' => __( 'Argenta', 'argenta_extra' ),
			'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-MessageBox.png',
			'params' => array(

				// General
				array(
					'type' => 'dropdown',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Layout', 'argenta_extra' ),
					'param_name' => 'layout',
					'value' => array(
						__( 'Default', 'argenta_extra' ) => 'default',
						__( 'Warning', 'argenta_extra' ) => 'warning',
						__( 'Primary', 'argenta_extra' ) => 'primary',
						__( 'Success', 'argenta_extra' ) => 'success',
						__( 'Danger', 'argenta_extra' ) => 'danger'
					),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Text', 'argenta_extra' ),
					'param_name' => 'text'
				),
				array(
					'type' => 'argenta_check',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Use link', 'argenta_extra' ),
					'param_name' => 'use_link',
					'value' => array(
						__( 'Yes', 'argenta_extra' ) => '0'
					),
				),
				array(
					'type' => 'vc_link',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Link', 'argenta_extra' ),
					'param_name' => 'link',
					'dependency' => array(
						'element' => 'use_link',
						'value' => '1'
					)
				),

				// Typography
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_text',
					'value' => __( 'Text', 'argenta_extra' ),
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'text_typo',
				),
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_link',
					'value' => __( 'Link', 'argenta_extra' ),
					'dependency' => array(
						'element' => 'use_link',
						'value' => '1'
					)
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'link_typo',
					'dependency' => array(
						'element' => 'use_link',
						'value' => '1'
					)
				),

				// Style
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Text color', 'argenta_extra' ),
					'param_name' => 'text_color',
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Link color', 'argenta_extra' ),
					'param_name' => 'link_color',
					'dependency' => array(
						'element' => 'use_link',
						'value' => '1'
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
		)
	);