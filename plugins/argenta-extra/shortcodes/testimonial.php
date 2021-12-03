<?php 

	/**
	* Visual Composer Argenta Testimonial shortcode
	*/

	add_shortcode( 'argenta_sc_testimonial', 'argenta_sc_testimonial_func' );

	function argenta_sc_testimonial_func( $atts ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$block_type_layout = ( isset( $block_type_layout ) ) ? argenta_extra_filter_string( $block_type_layout, 'string', 'default' ) : 'default';
		$quote = ( isset( $quote ) ) ? argenta_extra_filter_string( $quote, 'textarea', '' ) : '';
		$author = ( isset( $author ) ) ? argenta_extra_filter_string( $author, 'string', '' ) : '';
		$position = ( isset( $position ) ) ? argenta_extra_filter_string( $position, 'string', '' ) : '';
		$photo = ( isset( $photo ) ) ? argenta_extra_filter_string( wp_get_attachment_url( argenta_extra_filter_string( $photo ) ), 'attr' ) : false;
		$quote_typo = ( isset( $quote_typo ) ) ? argenta_extra_filter_string( $quote_typo ) : false;
		$author_typo = ( isset( $author_typo ) ) ? argenta_extra_filter_string( $author_typo ) : false;
		$position_typo = ( isset( $position_typo ) ) ? argenta_extra_filter_string( $position_typo ) : false;
		$image_border_color = ( isset( $image_border_color ) ) ? argenta_extra_filter_string( $image_border_color ) : false;
		$quote_color = ( isset( $quote_color ) ) ? argenta_extra_filter_string( $quote_color ) : false;
		$author_color = ( isset( $author_color ) ) ? argenta_extra_filter_string( $author_color ) : false;
		$position_color = ( isset( $position_color ) ) ? argenta_extra_filter_string( $position_color ) : false;
		$mark_color = ( isset( $mark_color ) ) ? argenta_extra_filter_string( $mark_color ) : false;
		$css_class = ( isset( $css_class ) ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' )  : '';

		$type_class = 'testimonials';
		switch ( $block_type_layout ) {
			case 'photo_top':
				$type_class .= '-top-avatar';
				break;
			case 'photo_middle':
				$type_class .= '-middle-avatar';
				break;
			case 'photo_and_mark':
				$type_class .= '-middle-avatar-quote';
				break;
			case 'left_align':
				$type_class .= '-align';
				break;
			case 'right_align':
				$type_class .= '-align text-right';
				break;
		}

		// Styling
		$testimonial_uniqid = uniqid( 'argenta-custom-' );

		$image_css = ( $image_border_color ) ? 'border-color: ' . $image_border_color . ';' : '';
		$quote_css = argenta_extra_parse_VC_typography_to_CSS( $quote_typo ) . ( ( $quote_color ) ? 'color: ' . $quote_color . ';' : '' );
		$author_css = argenta_extra_parse_VC_typography_to_CSS( $author_typo ) . ( ( $author_color ) ? 'color: ' . $author_color . ';' : '' );
		$position_css = argenta_extra_parse_VC_typography_to_CSS( $position_typo ) . ( ( $position_color ) ? 'color: ' . $position_color . ';' : '' );
		$mark_css = ( $mark_color ) ? 'color: ' . $mark_color . ';' : '';
		$quote_css = $quote_css ? $quote_css : false;
		$author_css = $author_css ? $author_css : false;
		$position_css = $position_css ? $position_css : false;
		$mark_css = $mark_css ? $mark_css : false;

		$element_custom_fonts = array();
		$quote_custom_font = argenta_extra_parse_VC_typography_custom_font( $quote_typo );
		if ( $quote_custom_font ) {
			$element_custom_fonts[] = $quote_custom_font;
		}
		$author_custom_font = argenta_extra_parse_VC_typography_custom_font( $author_typo );
		if ( $author_custom_font ) {
			$element_custom_fonts[] = $author_custom_font;
		}
		$position_custom_font = argenta_extra_parse_VC_typography_custom_font( $position_typo );
		if ( $position_custom_font ) {
			$element_custom_fonts[] = $position_custom_font;
		}

		$with_styles = ( $image_css || $quote_css || $author_css || $position_css || count( $element_custom_fonts ) > 0 );

		// Assembling
		ob_start();
		include( 'layout/testimonial.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
		'name' => __( 'Testimonials', 'argenta_extra' ),
		'description' => __( 'Testimonial module', 'argenta_extra' ),
		'base' => 'argenta_sc_testimonial',
		'category' => __( 'Argenta', 'argenta_extra' ),
		'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-Testimonials.png',
		'js_view' => 'VcArgentaTestimonialView',
		'custom_markup' => '{{title}}<div class="vc_argenta_testimonial-container">
				<div class="lines"><div class="line"></div><div class="line"></div><div class="line"></div></div>
				<div class="photo"></div>
				<div class="name">%%author%%</div>
				<div class="position"></div>
			</div>',
		'params' => array(
			// General
			array(
				'type' => 'argenta_choose_box',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Box layout', 'argenta_extra' ),
				'param_name' => 'block_type_layout',
				'value' => array(
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon16.png',
						'key' => 'default',
						'title' => __( 'Default', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon17.png',
						'key' => 'photo_top',
						'title' => __( 'Image Top', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon18.png',
						'key' => 'photo_middle',
						'title' => __( 'Image Middle', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon19.png',
						'key' => 'photo_and_mark',
						'title' => __( 'Image with Quotation Mark', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon20.png',
						'key' => 'left_align',
						'title' => __( 'Left Alignment', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon21.png',
						'key' => 'right_align',
						'title' => __( 'Right Alignment', 'argenta_extra' ),
					)
				)
			),
			array(
				'type' => 'textarea',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Testimonial text', 'argenta_extra' ),
				'param_name' => 'quote'
			),
			array(
				'type' => 'attach_image',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Image', 'argenta_extra' ),
				'param_name' => 'photo',
				'description' => __( 'Choose author photo.', 'argenta_extra' ),
				'dependency' => array(
					'element' => 'block_type_layout',
					'value' => array(
						'photo_top',
						'photo_middle',
						'photo_and_mark'
					)
				)
			),
			array(
				'type' => 'textfield',
				'holder' => 'em',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Author', 'argenta_extra' ),
				'param_name' => 'author',
				'description' => __( 'Testimonial author name.', 'argenta_extra' ),
			),
			array(
				'type' => 'textfield',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Position', 'argenta_extra' ),
				'param_name' => 'position',
				'description' => __( 'For example, <strong>Product manager at Colabr.io</strong>.', 'argenta_extra' )
			),

			// Typography
			array(
				'type' => 'argenta_divider',
				'group' => __( 'Typography', 'argenta_extra' ),
				'param_name' => 'typo_tab_divider_quote',
				'value' => __( 'Testimonial text', 'argenta_extra' ),
			),
			array(
				'type' => 'argenta_typography',
				'group' => __( 'Typography', 'argenta_extra' ),
				'param_name' => 'quote_typo',
			),
			array(
				'type' => 'argenta_divider',
				'group' => __( 'Typography', 'argenta_extra' ),
				'param_name' => 'typo_tab_divider_author',
				'value' => __( 'Author', 'argenta_extra' ),
			),
			array(
				'type' => 'argenta_typography',
				'group' => __( 'Typography', 'argenta_extra' ),
				'param_name' => 'author_typo',
			),
			array(
				'type' => 'argenta_divider',
				'group' => __( 'Typography', 'argenta_extra' ),
				'param_name' => 'typo_tab_divider_position',
				'value' => __( 'Position', 'argenta_extra' ),
			),
			array(
				'type' => 'argenta_typography',
				'group' => __( 'Typography', 'argenta_extra' ),
				'param_name' => 'position_typo',
			),

			// Style
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Image border color', 'argenta_extra' ),
				'param_name' => 'image_border_color',
				'dependency' => array(
					'element' => 'block_type_layout',
					'value' => array(
						'photo_top',
						'photo_middle',
						'photo_and_mark'
					)
				)
			),
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Testimonial text color', 'argenta_extra' ),
				'param_name' => 'quote_color'
			),
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Author text color', 'argenta_extra' ),
				'param_name' => 'author_color'
			),
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Position text color', 'argenta_extra' ),
				'param_name' => 'position_color'
			),
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Quotation mark color', 'argenta_extra' ),
				'param_name' => 'mark_color',
				'dependency' => array(
					'element' => 'block_type_layout',
					'value' => array(
						'default',
						'photo_and_mark',
						'left_align',
						'right_align',
					)
				)
			),
			array(
				'type' => 'textfield',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Custom CSS class', 'argenta_extra' ),
				'param_name' => 'css_class',
				'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class, and then use this class in your custom CSS.', 'argenta_extra' ),
			),
		)
	) );