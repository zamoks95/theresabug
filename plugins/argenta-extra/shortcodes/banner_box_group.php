<?php 

	/**
	* Visual Composer Argenta Banner box group shortcode
	*/

	add_shortcode( 'argenta_sc_banner_box_group', 'argenta_sc_banner_box_group_func' );

	function argenta_sc_banner_box_group_func( $atts, $content = '' ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$appearance_effect = ( isset( $appearance_effect ) ) ? argenta_extra_filter_string( $appearance_effect, 'attr', 'none' )  : 'none';
		$appearance_duration = ( isset( $appearance_duration ) ) ? argenta_extra_filter_string( $appearance_duration, 'attr', false )  : false;
		$css_class = ( isset( $css_class ) ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' )  : '';

		// Assembling
		ob_start();
		include( 'layout/banner_box_group.php' );
		$content = ob_get_contents();
		ob_end_clean();

		argenta_gh_add_required_script( 'cover-box' );

		return $content;
	}


	vc_map( array(
			'name' => __( 'Banner Box Group', 'argenta_extra' ),
			'description' => __( 'Banners hover group', 'argenta_extra' ),
			'base' => 'argenta_sc_banner_box_group',
			'category' => __( 'Argenta', 'argenta_extra' ),
			'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-BannerBoxGroup.png',
			'js_view' => 'VcArgentaBannersGroupColumnView',
			'show_settings_on_create' => false,
			'as_parent' => array( 
				'only' => 'argenta_sc_banner_box_inner'
			),
			'default_content' => '[argenta_sc_banner_box_inner][argenta_sc_banner_box_inner]',
			'params' => array(
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
					'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class.', 'argenta_extra' ),
				),
			)
		)
	);

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Argenta_Sc_Banner_Box_Group extends WPBakeryShortCodesContainer {
			
		}
	}