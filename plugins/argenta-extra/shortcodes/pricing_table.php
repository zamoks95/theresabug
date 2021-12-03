<?php 

	/**
	* Visual Composer Argenta Pricing table shortcode
	*/

	add_shortcode( 'argenta_sc_pricing_table', 'argenta_sc_pricing_table_func' );

	function argenta_sc_pricing_table_func( $atts ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$table_type = ( isset( $table_type ) ) ? argenta_extra_filter_string( $table_type, 'string', 'default' ) : 'default';
		$title = ( isset( $title ) ) ? argenta_extra_filter_string( $title ) : false;
		$subtitle = ( isset( $subtitle ) ) ? argenta_extra_filter_string( $subtitle ) : false;
		$description = ( isset( $description ) ) ? argenta_extra_filter_string( $description, 'textarea', '' ) : '';
		
		$price = ( isset( $price ) ) ? argenta_extra_filter_string( $price, 'string', '' ) : '';
		$price_currency = ( isset( $price_currency ) ) ? argenta_extra_filter_string( $price_currency ) : false;
		$price_caption = ( isset( $price_caption ) ) ? argenta_extra_filter_string( $price_caption ) : false;
		$features_type = ( isset( $features_type ) ) ? argenta_extra_filter_string( $features_type, 'string', 'default' ) : 'default';
		$features_value_type1 = ( isset( $features_value_type1 ) ) ? json_decode( urldecode( argenta_extra_filter_string( $features_value_type1 ) ) ) : false;
		$features_value_type2 = ( isset( $features_value_type2 ) ) ? json_decode( urldecode( argenta_extra_filter_string( $features_value_type2 ) ) ) : false;
		$features_value_type3 = ( isset( $features_value_type3 ) ) ? json_decode( urldecode( argenta_extra_filter_string( $features_value_type3 ) ) ) : false;
		$select_as_best = ( isset( $select_as_best ) ) ? argenta_extra_filter_boolean( $select_as_best ) : false;
		$label_text = ( isset( $label_text ) ) ? argenta_extra_filter_string( $label_text, 'string', __( 'Best choise', 'argenta_extra' ) ) : __( 'Best choise', 'argenta_extra' );
		$add_button = ( isset( $add_button ) ) ? argenta_extra_filter_boolean( $add_button ) : false;
		
		$title_typo = ( isset( $title_typo ) ) ? argenta_extra_filter_string( $title_typo ) : false;
		$subtitle_typo = ( isset( $subtitle_typo ) ) ? argenta_extra_filter_string( $subtitle_typo ) : false;
		$description_typo = ( isset( $description_typo ) ) ? argenta_extra_filter_string( $description_typo ) : false;
		$price_typo = ( isset( $price_typo ) ) ? argenta_extra_filter_string( $price_typo ) : false;
		$button_typo = ( isset( $button_typo ) ) ? argenta_extra_filter_string( $button_typo ) : false;
		$features_title_typo = ( isset( $features_title_typo ) ) ? argenta_extra_filter_string( $features_title_typo ) : false;
		$features_subtitle_typo = ( isset( $features_subtitle_typo ) ) ? argenta_extra_filter_string( $features_subtitle_typo ) : false;
		
		$title_color = ( isset( $title_color ) ) ? argenta_extra_filter_string( $title_color ) : false;
		$subtitle_color = ( isset( $subtitle_color ) ) ? argenta_extra_filter_string( $subtitle_color ) : false;
		$description_color = ( isset( $description_color ) ) ? argenta_extra_filter_string( $description_color ) : false;
		$price_color = ( isset( $price_color ) ) ? argenta_extra_filter_string( $price_color ) : false;
		$price_caption_color = ( isset( $price_caption_color ) ) ? argenta_extra_filter_string( $price_caption_color ) : false;
		$features_title_color = ( isset( $features_title_color ) ) ? argenta_extra_filter_string( $features_title_color ) : false;
		$features_subtitle_color = ( isset( $features_subtitle_color ) ) ? argenta_extra_filter_string( $features_subtitle_color ) : false;
		$readmore_button = ( isset( $readmore_button ) ) ? argenta_extra_filter_string( $readmore_button ) : false;
		$button_color = ( isset( $button_color ) ) ? argenta_extra_filter_string( $button_color ) : false;
		$button_rounded = ( isset( $button_rounded ) ) ? argenta_extra_filter_boolean( $button_rounded ) : false;
		$label_color = ( isset( $label_color ) ) ? argenta_extra_filter_string( $label_color ) : false;
		$border_color = ( isset( $border_color ) ) ? argenta_extra_filter_string( $border_color ) : false;
		$features_icons_color = ( isset( $features_icons_color ) ) ? argenta_extra_filter_string( $features_icons_color ) : false;
		
		$appearance_effect = ( isset( $appearance_effect ) ) ? argenta_extra_filter_string( $appearance_effect, 'attr', 'none' )  : 'none';
		$appearance_duration = ( isset( $appearance_duration ) ) ? argenta_extra_filter_string( $appearance_duration, 'attr', false )  : false;

		$css_class = ( isset( $css_class ) ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' )  : '';

		if ( isset( $button_link ) ) {
			$button_link = argenta_extra_parse_VC_link_params( $button_link, array( 'caption' => __( 'Read more', 'argenta_extra' ) ) );
		} else {
			$button_link = argenta_extra_parse_VC_link_params( '', array( 'caption' => __( 'Read more', 'argenta_extra' ) ) );
		}

		if ( $features_value_type1 ) {
			foreach ($features_value_type1 as $feature_key => $feature_value) {
				if ( isset( $feature_value->feature_title ) ) {
					$features_value_type1[$feature_key]->feature_title = argenta_extra_filter_string( $feature_value->feature_title );
				} else {
					$features_value_type1[$feature_key]->feature_title = false;
				}
				if ( isset( $feature_value->feature_subtitle ) ) {
					$features_value_type1[$feature_key]->feature_subtitle = argenta_extra_filter_string( $feature_value->feature_subtitle );
				} else {
					$features_value_type1[$feature_key]->feature_subtitle = false;
				}
			}
		}

		if ( $features_value_type2 ) {
			foreach ($features_value_type2 as $feature_key => $feature_value) {
				if ( isset( $feature_value->feature_title ) ) {
					$features_value_type2[$feature_key]->feature_title = argenta_extra_filter_string( $feature_value->feature_title );
				} else {
					$features_value_type2[$feature_key]->feature_title = false;
				}
				if ( isset( $feature_value->feature_icon ) ) {
					$features_value_type2[$feature_key]->feature_icon = argenta_extra_filter_string( $feature_value->feature_icon, 'attr' );
					$GLOBALS['argenta_pixellove_fonts'][] = argenta_extra_filter_string( $feature_value->feature_icon, 'attr' );
				} else {
					$features_value_type2[$feature_key]->feature_icon = false;
				}
				if ( isset( $feature_value->feature_image ) ) {
					$features_value_type2[$feature_key]->feature_image = argenta_extra_filter_string( wp_get_attachment_url( argenta_extra_filter_string( $feature_value->feature_image ) ), 'attr' );
				} else {
					$features_value_type2[$feature_key]->feature_image = false;
				}
			}
		}

		if ( $features_value_type3 ) {
			foreach ($features_value_type3 as $feature_key => $feature_value) {
				if ( isset( $feature_value->feature_icon ) ) {
					$features_value_type3[$feature_key]->feature_icon = argenta_extra_filter_string( $feature_value->feature_icon, 'string', 'yes' );
				} else {
					$features_value_type3[$feature_key]->feature_icon = 'yes';
				}
				$GLOBALS['argenta_pixellove_fonts'][] = 'my-icon-ui-cross';
			}
		}

		// Styling
		$pricing_table_uniqid = uniqid( 'argenta-custom-' );

		$pricing_table_class = 'pricing-table';
		if ( $select_as_best ) {
			$pricing_table_class .= '-best brand-border-color';
		}
		if ( $table_type == 'borderless' ) {
			$pricing_table_class .= ' pricing-table-boxed';
		}

		$list_align_class = ( $features_type == 'only_icons' ) ? 'text-center': 'text-left';

		$list_box_class = 'list-box';
		if ( $features_type == 'simple_list' ) {
			$list_box_class .= '-icon';
		}
		if ( $features_type == 'only_icons' ) {
			$list_box_class .= '-clear';
		}


		// Read more button
		$readmore_button = preg_replace( '/\&amp\;/', '&', $readmore_button );
		parse_str( $readmore_button, $button_settings );

		// Backward compatibility
		if ( $button_color && !isset( $button_settings['color'] ) ) {
			$button_settings['color'] = $button_color;
		}
		if ( $button_rounded && !isset( $button_settings['rounded'] ) ) {
			$button_settings['rounded'] = 'true';
		}

		$button_css = argenta_extra_parse_VC_button_to_css( $button_settings, (bool)( $select_as_best ) );
		$button_css['css'] .= argenta_extra_parse_VC_typography_to_CSS( $button_typo );


		$title_css = argenta_extra_parse_VC_typography_to_CSS( $title_typo ) . ( ( $title_color ) ? 'color: ' . $title_color . ';' : false );
		$subtitle_css = argenta_extra_parse_VC_typography_to_CSS( $subtitle_typo ) . ( ( $subtitle_color ) ? 'color: ' . $subtitle_color . ';' : false );
		$description_css = argenta_extra_parse_VC_typography_to_CSS( $description_typo ) . ( ( $description_color ) ? 'color: ' . $description_color . ';' : false );
		$price_css = argenta_extra_parse_VC_typography_to_CSS( $price_typo ) . ( ( $price_color ) ? 'color: ' . $price_color . ';' : false );
		$title_css = ( $title_css ) ? $title_css : false;
		$subtitle_css = ( $subtitle_css ) ? $subtitle_css : false;
		$description_css = ( $description_css ) ? $description_css : false;
		$price_css = ( $price_css ) ? $price_css : false;
		$price_caption_css = ( $price_caption_color ) ? 'color: ' . $price_caption_color . ';' : false;
		$label_css = ( $label_color && $select_as_best) ? 'background-color: ' . $label_color . ';' : false;
		$border_css = ( $border_color && $table_type == 'default' ) ? 'border-color: ' . $border_color . ';' : false;
		$features_title_css = argenta_extra_parse_VC_typography_to_CSS( $features_title_typo ) . ( ( $features_title_color && ( $features_type == 'default' || $features_type == 'simple_list' ) ) ? 'color: ' . $features_title_color . ';' : false );
		$features_subtitle_css = argenta_extra_parse_VC_typography_to_CSS( $features_title_typo ) . ( ( $features_subtitle_color && $features_type == 'default') ? 'color: ' . $features_subtitle_color . ';' : false );

		$icon_css_type1 = ( $features_type == 'default' && $features_icons_color ) ? 'background: ' . $features_icons_color . ';' : false;
		$icon_css_type2 = ( $features_type == 'simple_list' && $features_icons_color ) ? 'color: ' . $features_icons_color . ';' : false;
		$icon_css_type3 = ( $features_type == 'only_icons' && $features_icons_color ) ? 'color: ' . $features_icons_color . ';' : false;

		$element_custom_fonts = array();
		$title_custom_font = argenta_extra_parse_VC_typography_custom_font($title_typo);
		if ($title_custom_font) {
			$element_custom_fonts[] = $title_custom_font;
		}
		$subtitle_custom_font = argenta_extra_parse_VC_typography_custom_font($subtitle_typo);
		if ($subtitle_custom_font) {
			$element_custom_fonts[] = $subtitle_custom_font;
		}
		$description_custom_font = argenta_extra_parse_VC_typography_custom_font($description_typo);
		if ($description_custom_font) {
			$element_custom_fonts[] = $description_custom_font;
		}
		$price_custom_font = argenta_extra_parse_VC_typography_custom_font($price_typo);
		if ($price_custom_font) {
			$element_custom_fonts[] = $price_custom_font;
		}
		$button_custom_font = argenta_extra_parse_VC_typography_custom_font( $button_typo );
		if ( $button_custom_font ) {
			$element_custom_fonts[] = $button_custom_font;
		}
		$features_title_custom_font = argenta_extra_parse_VC_typography_custom_font($features_title_typo);
		if ($features_title_custom_font) {
			$element_custom_fonts[] = $features_title_custom_font;
		}
		$features_subtitle_custom_font = argenta_extra_parse_VC_typography_custom_font($features_subtitle_typo);
		if ($features_subtitle_custom_font) {
			$element_custom_fonts[] = $features_subtitle_custom_font;
		}

		$icons_collection = array();

		$with_styles = ( $title_css || $subtitle_css || $description_css || $price_css || $price_caption_css || $button_css['css'] || $button_css['hover-css'] || $label_css || $border_css || $icon_css_type1 || $icon_css_type2 || $icon_css_type3 || $features_title_css || $features_subtitle_css || count($element_custom_fonts) > 0 );

		// Assembling
		ob_start();
		include( 'layout/pricing_table.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
			'name' => __( 'Pricing Table', 'argenta_extra' ),
			'description' => __( 'Simple pricing table block', 'argenta_extra' ),
			'base' => 'argenta_sc_pricing_table',
			'category' => __( 'Argenta', 'argenta_extra' ),
			'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-PricingTable.png',
			'js_view' => 'VcArgentaPricingTableView',
			'custom_markup' => '{{title}}<div class="vc_argenta_pricing_table-container">
					<div class="title">%%title%%</div>
					<div class="subtitle"></div>
					<div class="divider"></div>
					<div class="price"><span></span>%%price%%</div>
					<div class="divider"></div>
					<div class="item"></div>
					<div class="divider"></div>
					<div class="item"></div>
					<div class="divider"></div>
					<div class="item"></div>
					<div class="divider"></div>
					<div class="item"></div>
					<div class="divider"></div>
					<div class="read_more"></div>
				</div>',
			'params' => array(
				// General
				array(
					'type' => 'argenta_choose_box',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Table type', 'argenta_extra' ),
					'param_name' => 'table_type',
					'value' => array(
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon34.png',
							'key' => 'default',
							'title' => __( 'Default', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon35.png',
							'key' => 'borderless',
							'title' => __( 'Borderless', 'argenta_extra' ),
						),
					)
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Title', 'argenta_extra' ),
					'param_name' => 'title',
					'value' => '',
					'description' => __( 'You can specify the name of the tariff plan like <b>Basic</b> and <b>Business</b> or your product name.', 'argenta_extra' ),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Subtitle', 'argenta_extra' ),
					'param_name' => 'subtitle',
					'value' => '',
					'description' => ''
				),
				array(
					'type' => 'textarea',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Description', 'argenta_extra' ),
					'param_name' => 'description',
					'value' => '',
					'description' => __( 'Short description.', 'argenta_extra' ),
				),

				// Price
				array(
					'type' => 'textfield',
					'group' => __( 'Price', 'argenta_extra' ),
					'heading' => __( 'Price', 'argenta_extra' ),
					'param_name' => 'price',
					'value' => '',
					'description' => __( 'Number or specific phrases like <b>Free</b>, <b>Personal price</b> and <b>Beta testers only</b>.', 'argenta_extra' ),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'Price', 'argenta_extra' ),
					'heading' => __( 'Currency', 'argenta_extra' ),
					'param_name' => 'price_currency',
					'value' => '',
					'description' => __( '<b>&#36;</b>, <b>&euro;</b>, <b>&pound;</b>, <b>&yen;</b>, USD, EUR, anything.', 'argenta_extra' ),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'Price', 'argenta_extra' ),
					'heading' => __( 'Caption', 'argenta_extra' ),
					'param_name' => 'price_caption',
					'value' => '',
					'description' => __( 'You can write that this amount per year or month. For ex. <b>per month</b> or <b>per year</b>', 'argenta_extra' ),
				),

				// Features
				array(
					'type' => 'argenta_choose_box',
					'group' => __( 'Features', 'argenta_extra' ),
					'heading' => __( 'Features type', 'argenta_extra' ),
					'param_name' => 'features_type',
					'value' => array(
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon36.png',
							'key' => 'default',
							'title' => __( 'List', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon37.png',
							'key' => 'simple_list',
							'title' => __( 'Simple Icon List', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon38.png',
							'key' => 'only_icons',
							'title' => __( 'Inclusive Icons', 'argenta_extra' ),
						),
					)
				),
				array(
					'type' => 'param_group',
					'group' => __( 'Features', 'argenta_extra' ),
					'heading' => __( 'Features', 'argenta_extra' ),
					'param_name' => 'features_value_type1',
					'value' => array(
						false
					),
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => __( 'Title', 'argenta_extra' ),
							'param_name' => 'feature_title',
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'Subtitle', 'argenta_extra' ),
							'param_name' => 'feature_subtitle',
						),
					),
					'dependency' => array(
						'element' => 'features_type',
						'value' => array(
							'default'
						)
					)
				),
				array(
					'type' => 'param_group',
					'group' => __( 'Features', 'argenta_extra' ),
					'heading' => __( 'Features', 'argenta_extra' ),
					'param_name' => 'features_value_type2',
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
					'dependency' => array(
						'element' => 'features_type',
						'value' => array(
							'simple_list'
						)
					)						
				),
				array(
					'type' => 'param_group',
					'group' => __( 'Features', 'argenta_extra' ),
					'heading' => __( 'Features', 'argenta_extra' ),
					'param_name' => 'features_value_type3',
					'value' => array(
						false
					),
					'params' => array(
						array(
							'type' => 'argenta_choose_box',
							'heading' => __( 'Icon', 'argenta_extra' ),
							'param_name' => 'feature_icon',
							'value' => array(
								array(
									'icon' => plugin_dir_url( __FILE__ ) . 'images/type_layout_top.jpg',
									'key' => 'yes',
									'title' => __( 'Yes', 'argenta_extra' ),
								),
								array(
									'icon' => plugin_dir_url( __FILE__ ) . 'images/type_layout_top.jpg',
									'key' => 'no',
									'title' => __( 'No', 'argenta_extra' ),
								)
							)
						),
					),
					'dependency' => array(
						'element' => 'features_type',
						'value' => array(
							'only_icons'
						)
					)
				),
				array(
					'type' => 'argenta_check',
					'group' => __( 'Features', 'argenta_extra' ),
					'heading' => __( 'Select as Best choise', 'argenta_extra' ),
					'description' => __( 'This option add label and highlight block', 'argenta_extra' ),
					'param_name' => 'select_as_best',
					'value' => array(
						__( 'Yes, please', 'argenta_extra' ) => '0'
					),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'Features', 'argenta_extra' ),
					'heading' => __( 'Label text', 'argenta_extra' ),
					'param_name' => 'label_text',
					'value' => __( 'Best choise', 'argenta_extra' ),
					'dependency' => array(
						'element' => 'select_as_best',
						'value' => array(
							'1'
						)
					)
				),
				
				// Button
				array(
					'type' => 'argenta_check',
					'group' => __( 'Button', 'argenta_extra' ),
					'heading' => __( 'Add button', 'argenta_extra' ),
					'param_name' => 'add_button',
					'value' => array(
						__( 'Yes, please', 'argenta_extra' ) => '0'
					),
				),
				array(
					'type' => 'vc_link',
					'group' => __( 'Button', 'argenta_extra' ),
					'heading' => __( 'Button link', 'argenta_extra' ),
					'param_name' => 'button_link',
					'dependency' => array(
						'element' => 'add_button',
						'value' => array(
							'1'
						)
					),
					'description' => __( 'Fill title field to change the <strong>Get started</strong> inscription.', 'argenta_extra' ),
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
					'param_name' => 'typo_tab_divider_subtitle',
					'value' => __( 'Subtitle', 'argenta_extra' ),
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'subtitle_typo',
				),
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_description',
					'value' => __( 'Description', 'argenta_extra' ),
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'description_typo',
				),
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_price',
					'value' => __( 'Price', 'argenta_extra' ),
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'price_typo',
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
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_features_subtitle',
					'value' => __( 'Features subtitle', 'argenta_extra' ),
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'features_subtitle_typo',
				),
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_heading',
					'value' => __( 'Button text', 'argenta_extra' ),
					'dependency' => array(
						'element' => 'add_button',
						'value' => array(
							'1'
						)
					),
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'button_typo',
					'dependency' => array(
						'element' => 'add_button',
						'value' => array(
							'1'
						)
					),
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
					'heading' => __( 'Subtitle color', 'argenta_extra' ),
					'param_name' => 'subtitle_color',
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Description color', 'argenta_extra' ),
					'param_name' => 'description_color',
				),
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'param_name' => 'style_tab_divider_price',
					'value' => __( 'Price', 'argenta_extra' ),
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Price color', 'argenta_extra' ),
					'param_name' => 'price_color',
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Price caption color', 'argenta_extra' ),
					'param_name' => 'price_caption_color',
				),
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'param_name' => 'style_tab_divider_features',
					'value' => __( 'Features', 'argenta_extra' ),
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Titles color', 'argenta_extra' ),
					'param_name' => 'features_title_color',
					'dependency' => array(
						'element' => 'features_type',
						'value' => array(
							'default',
							'simple_list'
						)
					),
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Subtitles color', 'argenta_extra' ),
					'param_name' => 'features_subtitle_color',
					'dependency' => array(
						'element' => 'features_type',
						'value' => array(
							'default'
						)
					),
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Icons color', 'argenta_extra' ),
					'param_name' => 'features_icons_color',
				),
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'param_name' => 'style_tab_divider_button',
					'value' => __( 'Button', 'argenta_extra' ),
					'dependency' => array(
						'element' => 'add_button',
						'value' => array(
							'1'
						)
					),
				),
				array(
					'type' => 'argenta_button',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'param_name' => 'readmore_button',
					'dependency' => array(
						'element' => 'add_button',
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
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Label color', 'argenta_extra' ),
					'param_name' => 'label_color',
					'dependency' => array(
						'element' => 'select_as_best',
						'value' => array(
							'1'
						)
					),
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Block border color', 'argenta_extra' ),
					'param_name' => 'border_color',
					'dependency' => array(
						'element' => 'table_type',
						'value' => array(
							'default'
						)
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