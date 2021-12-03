<?php 

	/**
	* Visual Composer Argenta Progress bar shortcode
	*/

	add_shortcode( 'argenta_sc_progress_bar', 'argenta_sc_progress_bar_func' );

	function argenta_sc_progress_bar_func( $atts ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$layout = isset( $layout ) ? argenta_extra_filter_string( $layout, 'string', 'default') : 'default';
		$name = ( isset( $name ) ) ? argenta_extra_filter_string( $name, 'string', '' ) : '';
		$percent = ( isset( $percent ) ) ? argenta_extra_filter_string( $percent, 'string', '100' ) : '100';

		$name_typo = ( isset( $name_typo ) ) ? argenta_extra_filter_string( $name_typo ) : false;
		$percent_typo = ( isset( $percent_typo ) ) ? argenta_extra_filter_string( $percent_typo ) : false;

		$bar_color = isset( $bar_color ) ? argenta_extra_filter_string( $bar_color, 'string', false ) : false;
		$name_color = isset( $name_color ) ? argenta_extra_filter_string( $name_color, 'string', false ) : false;
		$percent_color = isset( $percent_color ) ? argenta_extra_filter_string( $percent_color, 'string', false ) : false;

		$css_class = isset( $css_class ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' ) : '';

		$percent = intval($percent);
		if ( $percent < 0 || $percent > 100 ) {
			$percent = 100;
		}

		// Styling
		$progress_bar_uniqid = uniqid( 'argenta-custom-' );

		switch ( $layout ) {
			case 'outline':
				$progress_bar_class = ' progress-bar-outline';
				break;
			case 'split':
				$progress_bar_class = ' progress-bar-split';
				break;
			case 'pattern':
				$progress_bar_class = ' progress-bar-pattern';
				break;
			default:
				$progress_bar_class = false;
		}

		$bar_css = ( $bar_color ) ? 'background-color: ' . $bar_color . ';' : false;
		$bar_wrap_css = ( $bar_color && $layout == 'outline' ) ? 'border-color: ' . $bar_color . ';' : false;
		$name_css = ( $name_color ) ? 'color: ' . $name_color . ';' : '';
		$percent_css = ( $percent_color ) ? 'color: ' . $percent_color . ';' : '';

		$element_custom_fonts = array();
		$percent_custom_font = argenta_extra_parse_VC_typography_custom_font( $percent_typo );
		if ( $percent_custom_font ) {
			$element_custom_fonts[] = $percent_custom_font;
		}
		$name_custom_font = argenta_extra_parse_VC_typography_custom_font( $name_typo );
		if ( $name_custom_font ) {
			$element_custom_fonts[] = $name_custom_font;
		}

		$name_css = $name_css . argenta_extra_parse_VC_typography_to_CSS( $name_typo );
		$percent_css = $percent_css . argenta_extra_parse_VC_typography_to_CSS( $percent_typo );

		$with_styles = ( $bar_css || $bar_wrap_css || $name_css || $percent_css || count($element_custom_fonts) > 0 );

		// Assembling
		ob_start();
		include( 'layout/progress_bar.php' );
		$content = ob_get_contents();
		ob_end_clean();

		argenta_gh_add_required_script( 'progress-bar' );

		return $content;
	}


	vc_map( array(
			'name' => __( 'Progress Bar', 'argenta_extra' ),
			'description' => __( 'Progress bar section', 'argenta_extra' ),
			'base' => 'argenta_sc_progress_bar',
			'category' => __( 'Argenta', 'argenta_extra' ),
			'js_view' => 'VcArgentaProgressBarView',
			'custom_markup' => '{{title}}<div class="vc_argenta_progress_bar-container"><em>%%title%%</em></div>',
			'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-ProgressBar.png',
			'params' => array(

				// General
				array(
					'type' => 'argenta_choose_box',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Layout', 'argenta_extra' ),
					'param_name' => 'layout',
					'value' => array(
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon57.png',
							'key' => 'default',
							'title' => __( 'Default', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon58.png',
							'key' => 'outline',
							'title' => __( 'Outline', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon59.png',
							'key' => 'split',
							'title' => __( 'Split', 'argenta_extra' ),
						),
						array(
							'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon60.png',
							'key' => 'pattern',
							'title' => __( 'Pattern', 'argenta_extra' ),
						)
					)
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Label', 'argenta_extra' ),
					'param_name' => 'name',
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Progress value', 'argenta_extra' ),
					'param_name' => 'percent',
					'value' => '100',
				),

				// Typography
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_name',
					'value' => __( 'Label', 'argenta_extra' ),
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'name_typo',
				),
				array(
					'type' => 'argenta_divider',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'typo_tab_divider_percent',
					'value' => __( 'Percent', 'argenta_extra' ),
				),
				array(
					'type' => 'argenta_typography',
					'group' => __( 'Typography', 'argenta_extra' ),
					'param_name' => 'percent_typo',
				),
				
				// Style
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Bar color', 'argenta_extra' ),
					'param_name' => 'bar_color'
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Label color', 'argenta_extra' ),
					'param_name' => 'name_color'
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Progress value color', 'argenta_extra' ),
					'param_name' => 'percent_color'
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