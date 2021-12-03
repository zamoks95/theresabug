<?php 

	/**
	* Visual Composer Argenta Menu list shortcode
	*/

	add_shortcode( 'argenta_sc_menu_list', 'argenta_sc_menu_list_func' );

	function argenta_sc_menu_list_func( $atts ) {
		if ( is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$name = isset( $name ) ? argenta_extra_filter_string( $name, 'string', '') : '';
		$indigriends = isset( $indigriends ) ? argenta_extra_filter_string( $indigriends, 'string', '') : '';
		$sale_price = isset( $sale_price ) ? argenta_extra_filter_string( $sale_price, 'string', '') : '';
		$regular_price = isset( $regular_price ) ? argenta_extra_filter_string( $regular_price, 'string', '') : '';
		$mark = isset( $new ) ? argenta_extra_filter_boolean( $new ) : false;

		$name_typo = ( isset( $name_typo ) ) ? argenta_extra_filter_string( $name_typo ) : false;
		$indigriends_typo = ( isset( $indigriends_typo ) ) ? argenta_extra_filter_string( $indigriends_typo ) : false;
		$sale_price_typo = ( isset( $sale_price_typo ) ) ? argenta_extra_filter_string( $sale_price_typo ) : false;
		$regular_price_typo = ( isset( $regular_price_typo ) ) ? argenta_extra_filter_string( $regular_price_typo ) : false;
		$mark_typo = ( isset( $mark_typo ) ) ? argenta_extra_filter_string( $mark_typo ) : false;

		$name_color = isset( $name_color ) ? argenta_extra_filter_string( $name_color, 'string', false ) : false;
		$indigriends_color = isset( $indigriends_color ) ? argenta_extra_filter_string( $indigriends_color, 'string', false ) : false;
		$sale_price_color = isset( $sale_price_color ) ? argenta_extra_filter_string( $sale_price_color, 'string', false ) : false;
		$regular_price_color = isset( $regular_price_color ) ? argenta_extra_filter_string( $regular_price_color, 'string', false ) : false;
		$border_color = isset( $border_color ) ? argenta_extra_filter_string( $border_color, 'string', false ) : false;
		$mark_color = isset( $mark_color ) ? argenta_extra_filter_string( $mark_color, 'string', false ) : false;
		$mark_background_color = isset( $mark_background_color ) ? argenta_extra_filter_string( $mark_background_color, 'string', false ) : false;

		$appearance_effect = ( isset( $appearance_effect ) ) ? argenta_extra_filter_string( $appearance_effect, 'attr', 'none' )  : 'none';
		$appearance_duration = ( isset( $appearance_duration ) ) ? argenta_extra_filter_string( $appearance_duration, 'attr', false )  : false;
		
		$css_class = isset( $css_class ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' ) : '';

		// Styling
		$menu_list_uniqid = uniqid( 'argenta-custom-' );

		$name_css = ( $name_color ) ? 'color: ' . $name_color . ';' : '';
		$indigriends_css = ( $indigriends_color ) ? 'color: ' . $indigriends_color . ';' : '';
		$sale_price_css = ( $sale_price_color ) ? 'color: ' . $sale_price_color . ';' : '';
		$regular_price_css = ( $regular_price_color ) ? 'color: ' . $regular_price_color . ';' : '';
		$border_css = ( $border_color ) ? 'border-color: ' . $border_color . ';' : '';
		$mark_css = ( $mark_color ) ? 'color: ' . $mark_color . ';' : '';
		$mark_css .= ( $mark_background_color ) ? 'background-color: ' . $mark_background_color . ';' : '';

		$element_custom_fonts = array();
		$name_custom_font = argenta_extra_parse_VC_typography_custom_font( $name_typo );
		$indigriends_custom_font = argenta_extra_parse_VC_typography_custom_font( $indigriends_typo );
		$sale_price_custom_font = argenta_extra_parse_VC_typography_custom_font( $sale_price_typo );
		$regular_price_custom_font = argenta_extra_parse_VC_typography_custom_font( $regular_price_typo );
		$mark_custom_font = argenta_extra_parse_VC_typography_custom_font( $mark_typo );
		
		if ( $name_custom_font ) {
			$element_custom_fonts[] = $name_custom_font;
		}
		if ( $indigriends_custom_font ) {
			$element_custom_fonts[] = $indigriends_custom_font;
		}
		if ( $sale_price_custom_font ) {
			$element_custom_fonts[] = $sale_price_custom_font;
		}
		if ( $regular_price_custom_font ) {
			$element_custom_fonts[] = $regular_price_custom_font;
		}
		if ( $mark_custom_font ) {
			$element_custom_fonts[] = $mark_custom_font;
		}

		$name_css = $name_css . argenta_extra_parse_VC_typography_to_CSS( $name_typo );
		$indigriends_css = $indigriends_css . argenta_extra_parse_VC_typography_to_CSS( $indigriends_typo );
		$sale_price_css = $sale_price_css . argenta_extra_parse_VC_typography_to_CSS( $sale_price_typo );
		$regular_price_css = $regular_price_css . argenta_extra_parse_VC_typography_to_CSS( $regular_price_typo );
		$mark_css = $mark_css . argenta_extra_parse_VC_typography_to_CSS( $mark_typo );

		$with_styles = ( $name_css || $indigriends_css || $sale_price_css || $border_css || $regular_price_css || $mark_css || count($element_custom_fonts) > 0 );

		// Assembling
		ob_start();
		include( 'layout/menu_list.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
			'name' => __( 'Menu List', 'argenta_extra' ),
			'description' => __( 'Pricing/menu list', 'argenta_extra' ),
			'base' => 'argenta_sc_menu_list',
			'category' => __( 'Argenta', 'argenta_extra' ),
			'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-ListBox.png',
			'params' => array(

				// General
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Name', 'argenta_extra' ),
					'param_name' => 'name'
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Indigriends', 'argenta_extra' ),
					'param_name' => 'indigriends'
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Sale price', 'argenta_extra' ),
					'param_name' => 'sale_price'
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Regular price', 'argenta_extra' ),
					'param_name' => 'regular_price'
				),
				array(
					'type' => 'argenta_check',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'New', 'argenta_extra' ),
					'param_name' => 'new',
					'value' => array(
						__( 'Yes', 'argenta_extra' ) => '0'
					)
				),

				// Typography
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_name',
					'value' => __( 'Name', 'argenta_extra' )
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'name_typo',
				),
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_indigriends',
					'value' => __( 'Indigriends', 'argenta_extra' ),
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'indigriends_typo',
				),
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_sale_price',
					'value' => __( 'Sale price', 'argenta_extra' ),
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'sale_price_typo',
				),
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_regular_price',
					'value' => __( 'Regular price', 'argenta_extra' ),
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'regular_price_typo',
				),
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_mark',
					'value' => __( 'Mark', 'argenta_extra' ),
					'dependency' => array(
						'element' => 'new',
						'value' => '1'
					)
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'mark_typo',
					'dependency' => array(
						'element' => 'new',
						'value' => '1'
					)
				),

				// Style
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Name color', 'argenta_extra' ),
					'param_name' => 'name_color',
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Indigriends color', 'argenta_extra' ),
					'param_name' => 'indigriends_color',
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Sale price color', 'argenta_extra' ),
					'param_name' => 'sale_price_color',
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Regular price color', 'argenta_extra' ),
					'param_name' => 'regular_price_color',
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Border color', 'argenta_extra' ),
					'param_name' => 'border_color',
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Mark color', 'argenta_extra' ),
					'param_name' => 'mark_color',
					'dependency' => array(
						'element' => 'new',
						'value' => '1'
					)
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Mark background color', 'argenta_extra' ),
					'param_name' => 'mark_background_color',
					'dependency' => array(
						'element' => 'new',
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
					'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class, and then use this class in your custom CSS.', 'argenta_extra' ),
				),
			)
		)
	);