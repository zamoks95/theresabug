<?php 

	/**
	* Visual Composer Argenta Contact inner shortcode
	*/

	add_shortcode( 'argenta_sc_contact_inner', 'argenta_sc_contact_inner_func' );

	function argenta_sc_contact_inner_func( $atts ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$block_type_layout = ( isset( $block_type_layout ) ) ? argenta_extra_filter_string( $block_type_layout, 'string', 'with_heading' ) : 'with_heading';
		$heading = ( isset( $heading ) ) ? argenta_extra_filter_string( $heading, 'string', '' ) : '';
		$info = ( isset( $info ) ) ? argenta_extra_filter_string( $info, 'string', '' ) : '';
		$icon_is_filled = ( isset( $icon_is_filled ) ) ? argenta_extra_filter_boolean( $icon_is_filled ) : false;
		$icon_as_icon = ( isset( $icon_as_icon ) ) ? argenta_extra_filter_string( $icon_as_icon, 'attr', '' ) : '';
		$info_typo = ( isset( $info_typo ) ) ? argenta_extra_filter_string( $info_typo ) : false;
		$heading_typo = ( isset( $heading_typo ) ) ? argenta_extra_filter_string( $heading_typo ) : false;
		$info_color = ( isset( $info_color ) ) ? argenta_extra_filter_string( $info_color ) : false;
		$heading_color = ( isset( $heading_color ) ) ? argenta_extra_filter_string( $heading_color ) : false;
		$icon_color = ( isset( $icon_color ) ) ? argenta_extra_filter_string( $icon_color ) : false;
		$icon_fill_color = ( isset( $icon_fill_color ) ) ? argenta_extra_filter_string( $icon_fill_color ) : false;
		$css_class = ( isset( $css_class ) ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' )  : '';

		// Styling
		$contact_inner_uniqid = uniqid( 'argenta-custom-' );

		if ( $icon_as_icon ) {
			$GLOBALS['argenta_pixellove_fonts'][] = $icon_as_icon;
		}

		$info_css = argenta_extra_parse_VC_typography_to_CSS( $info_typo ) . ( ( $info_color ) ? 'color: ' . $info_color . ';' : '' );
		$heading_css = argenta_extra_parse_VC_typography_to_CSS( $heading_typo ) . ( ( $heading_color ) ? 'color: ' . $heading_color . ';' : '' );
		$icon_css = ( $icon_color ) ? 'color: ' . $icon_color . ';' : false;
		$icon_fill_css = ( $icon_fill_color ) ? 'background: ' . $icon_fill_color . ';' : false;
		$info_css = $info_css ? $info_css : false;
		$heading_css = $heading_css ? $heading_css : false;
		$icon_css = $icon_css ? $icon_css : false;
		$icon_fill_css = $icon_fill_css ? $icon_fill_css : false;

		$element_custom_fonts = array();
		$info_custom_font = argenta_extra_parse_VC_typography_custom_font( $info_typo );
		if ( $info_custom_font ) {
			$element_custom_fonts[] = $info_custom_font;
		}
		$heading_custom_font = argenta_extra_parse_VC_typography_custom_font( $heading_typo );
		if ( $heading_custom_font && $block_type_layout == 'with_heading' ) {
			$element_custom_fonts[] = $heading_custom_font;
		}

		$with_styles = ( $info_css || $heading_css || $icon_css || $icon_fill_css || count( $element_custom_fonts ) > 0 );

		// Assembling
		ob_start();
		include( 'layout/contact_inner.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
			'name' => __( 'Contact Info', 'argenta_extra' ),
			'description' => __( 'Contact info module', 'argenta_extra' ),
			'base' => 'argenta_sc_contact_inner',
			'category' => __( 'Argenta', 'argenta_extra' ),
			'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-ContactsModule.png',
			'content_element' => true,
			'as_child' => array( 
				'only' => 'argenta_sc_contacts_group'
			),
			'js_view' => 'VcArgentaContactInnerView',
			'custom_markup' => '{{title}}<div class="vc_argenta_contact_inner-container">
					<div class="_contain">
						<div class="icon"></div>
						<div class="right">
							%%heading%%
							<div class="info">%%info%%</div>
						</div>
					</div>
				</div>',
			'params' => array(
				// General
				array(
					'type' => 'argenta_choose_box',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Layout', 'argenta_extra' ),
					'param_name' => 'block_type_layout',
					'value' => array(
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon71.png',
							'key' => 'with_heading',
							'title' => __( 'With Heading', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon72.png',
							'key' => 'without_heading',
							'title' => __( 'Without Heading', 'argenta_extra' ),
						)
					)
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Heading', 'argenta_extra' ),
					'param_name' => 'heading',
					'description' => __( 'For example, <strong>Phone</strong> or <strong>Address</strong>.', 'argenta_extra' ),
					'dependency' => array(
						'element' => 'block_type_layout',
						'value' => array(
							'with_heading'
						)
					),
				),
				array(
					'type' => 'textarea',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Info', 'argenta_extra' ),
					'param_name' => 'info',
					'description' => __( 'Tell what this remarkable team member in your team.', 'argenta_extra' ),
				),

				// Icon
				array(
					'type' => 'argenta_icon_picker',
					'group' => __( 'Icon', 'argenta_extra' ),
					'heading' => __( 'Icon', 'argenta_extra' ),
					'param_name' => 'icon_as_icon',
					'description' => __( 'Choose icon.', 'argenta_extra' ),
				),

				// Typography
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_heading',
					'value' => __( 'Heading', 'argenta_extra' ),
					'dependency' => array(
						'element' => 'block_type_layout',
						'value' => array(
							'with_heading'
						)
					),
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'heading_typo',
					'dependency' => array(
						'element' => 'block_type_layout',
						'value' => array(
							'with_heading'
						)
					),
				),
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_info',
					'value' => __( 'Info', 'argenta_extra' ),
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'info_typo',
				),

				// Styles
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'param_name' => 'style_tab_divider_content',
					'value' => __( 'Content', 'argenta_extra' ),
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Heading color', 'argenta_extra' ),
					'param_name' => 'heading_color',
					'dependency' => array(
						'element' => 'block_type_layout',
						'value' => array(
							'with_heading'
						)
					),
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Info color', 'argenta_extra' ),
					'param_name' => 'info_color',
				),
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'param_name' => 'style_tab_divider_icon',
					'value' => __( 'Icon', 'argenta_extra' ),
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Icon color', 'argenta_extra' ),
					'param_name' => 'icon_color',
				),
				array(
					'type' => 'argenta_check',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Fill icon background?', 'argenta_extra' ),
					'param_name' => 'icon_is_filled',
					'value' => array(
						__( 'Yes', 'argenta_extra' ) => '0'
					)
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Icon fill color', 'argenta_extra' ),
					'param_name' => 'icon_fill_color',
					'dependency' => array(
						'element' => 'icon_is_filled',
						'value' => array(
							'1'
						)
					),
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
					'heading' => __( 'Custom CSS class', 'argenta_extra' ),
					'param_name' => 'css_class',
					'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class, and then use this class in your custom CSS.', 'argenta_extra' ),
				),
			)
		)
	);