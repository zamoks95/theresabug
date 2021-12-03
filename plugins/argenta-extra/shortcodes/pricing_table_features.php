<?php 

	/**
	* Visual Composer Argenta Pricing table fetures shortcode
	*/

	add_shortcode( 'argenta_sc_pricing_table_features', 'argenta_sc_pricing_table_features_func' );

	function argenta_sc_pricing_table_features_func( $atts ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$title = ( isset( $title ) ) ? argenta_extra_filter_string( $title ) : false;
		$features_value = ( isset( $features_value ) ) ? json_decode( urldecode( argenta_extra_filter_string( $features_value ) ) ) : false;
		$title_typo = ( isset( $title_typo ) ) ? argenta_extra_filter_string( $title_typo ) : false;
		$features_title_typo = ( isset( $features_title_typo ) ) ? argenta_extra_filter_string( $features_title_typo ) : false;
		$title_color = ( isset( $title_color ) ) ? argenta_extra_filter_string( $title_color ) : false;
		$features_title_color = ( isset( $features_title_color ) ) ? argenta_extra_filter_string( $features_title_color ) : false;
		$features_icons_color = ( isset( $features_icons_color ) ) ? argenta_extra_filter_string( $features_icons_color ) : false;
		$space_gap = ( isset( $space_gap ) ) ? argenta_extra_filter_string( $space_gap, 'attr' ) : false;
		$appearance_effect = ( isset( $appearance_effect ) ) ? argenta_extra_filter_string( $appearance_effect, 'attr', 'none' )  : 'none';
		$appearance_duration = ( isset( $appearance_duration ) ) ? argenta_extra_filter_string( $appearance_duration, 'attr', false )  : false;
		$css_class = ( isset( $css_class ) ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' )  : '';

		if ( $features_value ) {
			foreach ($features_value as $feature_key => $feature_value) {
				if ( isset( $feature_value->feature_title ) ) {
					$features_value[$feature_key]->feature_title = argenta_extra_filter_string( $feature_value->feature_title );
				} else {
					$features_value[$feature_key]->feature_title = false;
				}
				if ( isset( $feature_value->feature_icon ) ) {
					$features_value[$feature_key]->feature_icon = argenta_extra_filter_string( $feature_value->feature_icon, 'attr' );
					$GLOBALS['argenta_pixellove_fonts'][] = argenta_extra_filter_string( $feature_value->feature_icon, 'attr' );
				} else {
					$features_value[$feature_key]->feature_icon = false;
				}
				if ( isset( $feature_value->feature_image ) ) {
					$features_value[$feature_key]->feature_image = argenta_extra_filter_string( wp_get_attachment_url( argenta_extra_filter_string( $feature_value->feature_image ) ), 'attr' );
				} else {
					$features_value[$feature_key]->feature_image = false;
				}
			}
		}

		// Styling
		$pricing_table_uniqid = uniqid( 'argenta-custom-' );

		$title_css = argenta_extra_parse_VC_typography_to_CSS( $title_typo ) . ( ( $title_color ) ? 'color: ' . $title_color . ';' : false );
		$features_title_css = argenta_extra_parse_VC_typography_to_CSS( $features_title_typo ) . ( ( $features_title_color ) ? 'color: ' . $features_title_color . ';' : false );
		$icon_css = ( $features_icons_color ) ? 'color: ' . $features_icons_color . ';' : false;
		$space_gap_css = ( $space_gap ) ? 'padding-top: ' . $space_gap . ';' : false;

		$element_custom_fonts = array();
		$title_custom_font = argenta_extra_parse_VC_typography_custom_font($title_typo);
		if ($title_custom_font) {
			$element_custom_fonts[] = $title_custom_font;
		}
		$features_title_custom_font = argenta_extra_parse_VC_typography_custom_font($features_title_typo);
		if ($features_title_custom_font) {
			$element_custom_fonts[] = $features_title_custom_font;
		}

		$icons_collection = array();

		$with_styles = ( $title_css || $icon_css || $features_title_css || count($element_custom_fonts) > 0 );

		// Assembling
		ob_start();
		include( 'layout/pricing_table_features.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
			'name' => __( 'Pricing Table Features', 'argenta_extra' ),
			'description' => __( 'Features column for pricing table', 'argenta_extra' ),
			'base' => 'argenta_sc_pricing_table_features',
			'category' => __( 'Argenta', 'argenta_extra' ),
			'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-PricingFeatures.png',
			'js_view' => 'VcArgentaPricingTableFeaturesView',
			'custom_markup' => '{{title}}<div class="vc_argenta_pricing_table_features-container">
					<div class="title">%%title%%</div>
					<div class="divider"></div>
					<div class="item"></div>
					<div class="divider"></div>
					<div class="item"></div>
					<div class="divider"></div>
					<div class="item"></div>
					<div class="divider"></div>
					<div class="item"></div>
					<div class="divider"></div>
				</div>',
			'params' => array(
				// General
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Title', 'argenta_extra' ),
					'param_name' => 'title',
					'value' => '',
					'description' => __( 'Title like <strong>Features</strong>, <strong>Services</strong>, <strong>Access to</strong> ...', 'argenta_extra' ),
				),

				array(
					'type' => 'param_group',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Features', 'argenta_extra' ),
					'param_name' => 'features_value',
					'value' => array(
						false
					),
					'params' => array(
						array(
							'type' => 'argenta_icon_picker',
							'heading' => __( 'Icon', 'argenta_extra' ),
							'param_name' => 'feature_icon',
							'description' => __( 'Choose icon.', 'argenta_extra' ),
						),
						array(
							'type' => 'attach_image',
							'heading' => __( 'or Icon image', 'argenta_extra' ),
							'param_name' => 'feature_image',
							'description' => __( 'If you select an image, then choosed an icon will be ignored.', 'argenta_extra' ),
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'Title', 'argenta_extra' ),
							'param_name' => 'feature_title',
						),
					),						
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
					'param_name' => 'typo_tab_divider_features_title',
					'value' => __( 'Features title', 'argenta_extra' ),
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'features_title_typo',
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
					'heading' => __( 'Features title color', 'argenta_extra' ),
					'param_name' => 'features_title_color',
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Features icon color', 'argenta_extra' ),
					'param_name' => 'features_icons_color',
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
					'param_name' => 'space_gap',
					'title' => __( 'Top space gap size', 'argenta_extra' ),
					'description' => __( 'Top padding size for pixel perfect grid. Value in CSS. For ex., 20px, 25.4px, 10%, 2em...', 'argenta_extra' ),
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