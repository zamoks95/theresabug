<?php 

	/**
	* Visual Composer Argenta Paralax shortcode
	*/

	add_shortcode( 'argenta_sc_parallax', 'argenta_sc_parallax_func' );

	function argenta_sc_parallax_func( $atts, $content = '' ) {
		if ( is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$image = ( isset( $image ) ) ? argenta_extra_filter_string( wp_get_attachment_url( argenta_extra_filter_string( $image ) ), 'attr' ) : false;
		$size = ( isset( $size ) ) ? argenta_extra_filter_string( $size, 'string', '' ) : '';
		$parallax = ( isset( $parallax ) ) ? argenta_extra_filter_string( $parallax, 'string', 'vertical' ) : 'vertical';
		$parallax_speed = ( isset( $parallax_speed ) ) ? argenta_extra_filter_string( $parallax_speed, 'attr', '1.0' )  : '1.0';
		$use_overlay = ( isset( $use_overlay ) ) ? argenta_extra_filter_boolean( $use_overlay ) : false;
		$overlay_color = ( isset( $overlay_color ) ) ? argenta_extra_filter_string( $overlay_color ) : false;

		$css_class = ( isset( $css_class ) ) ? argenta_extra_filter_string( $css_class, 'attr', '' )  : '';

		// Styling
		$parallax_uniqid = uniqid( 'argenta-custom-' );

		$parallax_css = '';
		$parallax_css .= ( $image ) ? 'background-image: url(' . $image . ');' : '';
		$parallax_css .= ( $size ) ? 'background-size: ' . $size . ';' : '';

		$overlay_css = '';
		if ( $use_overlay && $overlay_color ) {
			$overlay_css .= 'background-color: ' . $overlay_color . ';';
		}

		$with_styles = ( $parallax_css || $overlay_css );

		// Assembling
		ob_start();
		include( 'layout/parallax.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
			'name' => __( 'Parallax', 'argenta_extra' ),
			'description' => __( 'Parallax block', 'argenta_extra' ),
			'base' => 'argenta_sc_parallax',
			'category' => __( 'Argenta', 'argenta_extra' ),
			"content_element" => true,
			"is_container" => true,
			"js_view" => 'VcColumnView',
			'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-Parallax.png',
			'params' => array(

				// General
				array(
					'type' => 'attach_image',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Image', 'argenta_extra' ),
					'param_name' => 'image',
				),
				array(
					'type' => 'dropdown',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Size', 'argenta_extra' ),
					'param_name' => 'size',
					'value' => array(
						__( 'Auto', 'argenta_extra' ) => '',
						__( 'Contain', 'argenta_extra' ) => 'contain',
						__( 'Cover', 'argenta_extra' )   => 'cover',
						__( 'auto 100%', 'argenta_extra' )  => 'auto 100%',
						__( '100% auto', 'argenta_extra' )  => '100% auto',
						__( '100% 100%', 'argenta_extra' )  => '100% 100%',
					),
				),
				array(
					'type' => 'dropdown',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Parallax type', 'argenta_extra' ),
					'param_name' => 'parallax',
					'value' => array(
						__( 'Vertical', 'argenta_extra' ) => 'vertical',
						__( 'Horizontal', 'argenta_extra' ) => 'horizontal'
					),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Parallax speed', 'argenta_extra' ),
					'param_name' => 'parallax_speed',
					'description' => __( 'Parallax speed (default 1.0).', 'argenta_extra' ),
				),
				array(
					'type' => 'argenta_check',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Use overlay?', 'argenta_extra' ),
					'param_name' => 'use_overlay',
					'value' => array(
						__( 'Yes, sure', 'argenta_extra' ) => '0'
					)
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Overlay color', 'argenta_extra' ),
					'param_name' => 'overlay_color',
					'dependency' => array(
						'element' => 'use_overlay',
						'value' => '1'
					),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Custom CSS class', 'argenta_extra' ),
					'param_name' => 'css_class',
					'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class.', 'argenta_extra' )
				),
			)
		)
	);
	

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Argenta_Sc_Parallax extends WPBakeryShortCodesContainer {
			
		}
	}