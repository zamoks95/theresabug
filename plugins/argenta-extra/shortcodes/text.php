<?php 

	/**
	* Visual Composer Argenta Button shortcode
	*/

	add_shortcode( 'argenta_sc_text', 'argenta_sc_text_func' );

	function argenta_sc_text_func( $atts, $content_html = '' ) {
		if ( is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$text_typo = ( isset( $text_typo ) ) ? argenta_extra_filter_string( $text_typo ) : false;
		$appearance_effect = ( isset( $appearance_effect ) ) ? argenta_extra_filter_string( $appearance_effect, 'attr', 'none' )  : 'none';
		$appearance_duration = ( isset( $appearance_duration ) ) ? argenta_extra_filter_string( $appearance_duration, 'attr', false )  : false;
		$css_class = ( isset( $css_class ) ) ? argenta_extra_filter_string( $css_class, 'attr', '' )  : '';

		// Handling
		$content_html = wpautop( $content_html );

		// Styling
		$text_uniqid = uniqid( 'argenta-custom-' );

		$text_css = argenta_extra_parse_VC_typography_to_CSS( $text_typo );

		$text_custom_font = argenta_extra_parse_VC_typography_custom_font( $text_typo );
		if ( $text_custom_font ) {
			$element_custom_fonts[] = $text_custom_font;
		}

		$with_styles = (bool) ( $text_css );

		// Assembling
		ob_start();
		include( 'layout/text.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

	vc_map( array(
			'name' => __( 'Text', 'argenta_extra' ),
			'description' => __( 'Simple text block', 'argenta_extra' ),
			'base' => 'argenta_sc_text',
			'category' => __( 'Argenta', 'argenta_extra' ),
			'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-TextBox.png',
			'params' => array(

				// General
				array(
					'type' => 'textarea_html',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Content', 'argenta_extra' ),
					'param_name' => 'content',
					'description' => '',
					'holder' => 'span',
				),
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_text',
					'value' => __( 'Typography', 'argenta_extra' ),
				),

				// Typography
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'text_typo',
				),

				// Styles and color
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