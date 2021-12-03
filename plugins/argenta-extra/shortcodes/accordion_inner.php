<?php 

	/**
	* Visual Composer Argenta Accordion Inner shortcode
	*/

	add_shortcode( 'argenta_sc_accordion_inner', 'argenta_sc_accordion_inner_func' );

	function argenta_sc_accordion_inner_func( $atts, $content_html = '' ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$heading = ( isset( $heading ) ) ? argenta_extra_filter_string( $heading, 'string', '' ) : '';
		$with_icon = ( isset( $with_icon ) ) ? argenta_extra_filter_boolean( $with_icon ) : false;
		$icon_as_icon = ( isset( $icon_as_icon ) ) ? argenta_extra_filter_string( $icon_as_icon, 'attr' ) : false;
		$heading_typo = ( isset( $heading_typo ) ) ? argenta_extra_filter_string( $heading_typo ) : false;
		$content_typo = ( isset( $content_typo ) ) ? argenta_extra_filter_string( $content_typo ) : false;
		$heading_text_color = ( isset( $heading_text_color ) ) ? argenta_extra_filter_string( $heading_text_color ) : false;
		$content_color = ( isset( $content_color ) ) ? argenta_extra_filter_string( $content_color ) : false;
		$icon_color = ( isset( $icon_color ) ) ? argenta_extra_filter_string( $icon_color ) : false;
		$heading_fill_color = ( isset( $heading_fill_color ) ) ? argenta_extra_filter_string( $heading_fill_color ) : false;
		$css_class = ( isset( $css_class ) ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' )  : '';

		// Handling
		$content_html = wpautop( $content_html );

		// Styling
		$accordion_inner_uniqid = uniqid( 'argenta-custom-' );

		if ( $with_icon && $icon_as_icon ) {
			$GLOBALS['argenta_pixellove_fonts'][] = $icon_as_icon;
		}

		$heading_css = argenta_extra_parse_VC_typography_to_CSS( $heading_typo ) . ( ( $heading_text_color ) ? 'color: ' . $heading_text_color . ';' : '' );
		$content_css = argenta_extra_parse_VC_typography_to_CSS( $content_typo ) . ( ( $content_color ) ? 'color: ' . $content_color . ';' : '' );
		$icon_css = ( $icon_color ) ? 'color: ' . $icon_color . ';' : false;
		$head_fill_css = ( $heading_fill_color ) ? 'background-color: ' . $heading_fill_color . ';' : false;
		$heading_css = ( $heading_css ) ? $heading_css : false;
		$content_css = ( $content_css ) ? $content_css : false;

		$element_custom_fonts = array();
		$heading_custom_font = argenta_extra_parse_VC_typography_custom_font( $heading_typo );
		if ( $heading_custom_font ) {
			$element_custom_fonts[] = $heading_custom_font;
		}
		$content_custom_font = argenta_extra_parse_VC_typography_custom_font( $content_typo );
		if ( $content_custom_font ) {
			$element_custom_fonts[] = $content_custom_font;
		}

		$with_styles = ( $heading_css || $content_css || $head_fill_css || count( $element_custom_fonts ) > 0 );

		// Assembling
		ob_start();
		include( 'layout/accordion_inner.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
		'name' => __( 'Tab', 'argenta_extra' ),
		'description' => __( 'Argenta accordion tab', 'argenta_extra' ),
		'base' => 'argenta_sc_accordion_inner',
		'category' => __( 'Argenta', 'argenta_extra' ),
		'allowed_container_element' => 'vc_row',
		'is_container' => true,
		'show_settings_on_create' => false,
		'as_child' => array(
			'only' => 'argenta_sc_accordion',
		),
		'js_view' => 'VcBackendTtaSectionView',
		'custom_markup' => '
			<div class="vc_tta-panel-heading">
				<h4 class="vc_tta-panel-title vc_tta-controls-icon-position-left"><a href="javascript:;" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-accordion data-vc-container=".wpb_argenta_sc_accordion"><span class="vc_tta-title-text">{{ section_title }}</span><i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i></a></h4>
			</div>
			<div class="vc_tta-panel-body">
				{{ editor_controls }}
				<div class="{{ container-class }}"></div>
			</div>
		',
		'default_content' => '',
		'params' => array(
			// General
			array(
				'type' => 'textfield',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Heading', 'argenta_extra' ),
				'param_name' => 'heading',
				'description' => __( 'Accordion tab title.', 'argenta_extra' ),
			),
			array(
				'type' => 'textarea_html',
				'group' => __( 'General', 'argenta_extra'),
				'heading' => __( 'Content', 'argenta_extra'),
				'param_name' => 'content',
				'description' => __( 'Tell what this remarkable team member in your team.', 'argenta_extra' ),
			),
			array(
				'type' => 'el_id',
				'param_name' => 'tab_id',
				'settings' => array(
					'auto_generate' => true,
				),
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Tab unique ID', 'argenta_extra' ),
				'description' => __( 'Enter section ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'argenta_extra' ),
			),

			/* Icon */
			array(
				'type' => 'argenta_check',
				'group' => __( 'Icon', 'argenta_extra' ),
				'heading' => __( 'Add icon?', 'argenta_extra' ),
				'description' => __( 'Note that the tabs with icons for many informative.', 'argenta_extra' ),
				'param_name' => 'with_icon',
				'value' => array(
					'Yes, sure' => '0'
				)
			),
			array(
				'type' => 'argenta_icon_picker',
				'group' => __( 'Icon', 'argenta_extra' ),
				'heading' => __( 'Icon', 'argenta_extra' ),
				'param_name' => 'icon_as_icon',
				'description' => __( 'Choose icon.', 'argenta_extra' ),
				'dependency' => array(
					'element' => 'with_icon',
					'value' => array(
						'1'
					)
				),
			),

			// Typography
			array(
				'type' => 'argenta_divider',
				'group' => __( 'Typography', 'argenta_extra' ),
				'param_name' => 'typo_tab_divider_heading',
				'value' => __( 'Heading', 'argenta_extra' ),
			),
			array(
				'type' => 'argenta_typography',
				'group' => __( 'Typography', 'argenta_extra' ),
				'param_name' => 'heading_typo'
			),
			array(
				'type' => 'argenta_divider',
				'group' => __( 'Typography', 'argenta_extra' ),
				'param_name' => 'typo_tab_divider_info',
				'value' => __( 'Content', 'argenta_extra' ),
			),
			array(
				'type' => 'argenta_typography',
				'group' => __( 'Typography', 'argenta_extra' ),
				'param_name' => 'content_typo',
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
				'heading' => __( 'Heading text color', 'argenta_extra' ),
				'param_name' => 'heading_text_color'
			),
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Content text color', 'argenta_extra' ),
				'param_name' => 'content_color',
			),
			array(
				'type' => 'argenta_divider',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'param_name' => 'style_tab_divider_heading',
				'value' => __( 'Heading', 'argenta_extra' ),
			),
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Icon color', 'argenta_extra' ),
				'param_name' => 'icon_color',
				'dependency' => array(
					'element' => 'with_icon',
					'value' => array(
						'1'
					)
				),
			),
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Heading fill color', 'argenta_extra' ),
				'param_name' => 'heading_fill_color',
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
				'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class, and then use this class in your custom CSS.', 'argenta_extra'),
			),
		)
	) );



if ( class_exists( 'VcShortcodeAutoloader' ) ) {
VcShortcodeAutoloader::getInstance()->includeClass( 'WPBakeryShortCode_VC_Tta_Accordion' );

class WPBakeryShortCode_Argenta_Sc_Accordion_Inner extends WPBakeryShortCode_VC_Tta_Accordion {
	protected $controls_css_settings = 'tc vc_control-container';
	protected $controls_list = array( 'add', 'edit', 'clone', 'delete' );
	protected $backened_editor_prepend_controls = true;
	/**
	 * @var WPBakeryShortCode_VC_Tta_Accordion
	 */
	public static $tta_base_shortcode;
	public static $self_count = 0;
	public static $section_info = array();

	public function getFileName() {
		if ( isset( self::$tta_base_shortcode ) && 'vc_tta_pageable' === self::$tta_base_shortcode->getShortcode() ) {
			return 'vc_tta_pageable_section';
		} else {
			return 'vc_tta_section';
		}
	}

	public function containerContentClass() {
		return 'wpb_column_container vc_container_for_children vc_clearfix';
	}

	public function getElementClasses() {
		$classes = array();
		$classes[] = 'vc_tta-panel';
		$isActive = ! vc_is_page_editable() && $this->getTemplateVariable( 'section-is-active' );

		if ( $isActive ) {
			$classes[] = $this->activeClass;
		}

		/**
		 * @since 4.6.2
		 */
		if ( isset( $this->atts['el_class'] ) ) {
			$classes[] = $this->atts['el_class'];
		}

		return implode( ' ', array_filter( $classes ) );
	}

	/**
	 * @param $atts
	 * @param $content
	 *
	 * @return string
	 */
	public function getParamContent( $atts, $content ) {
		return wpb_js_remove_wpautop( $content );
	}

	/**
	 * @param $atts
	 * @param $content
	 *
	 * @return string|null
	 */
	public function getParamTabId( $atts, $content ) {
		if ( isset( $atts['tab_id'] ) && strlen( $atts['tab_id'] ) > 0 ) {
			return $atts['tab_id'];
		}

		return null;
	}

	/**
	 * @param $atts
	 * @param $content
	 *
	 * @return string|null
	 */
	public function getParamTitle( $atts, $content ) {
		if ( isset( $atts['title'] ) && strlen( $atts['title'] ) > 0 ) {
			return $atts['title'];
		}

		return null;
	}

	/**
	 * @param $atts
	 * @param $content
	 *
	 * @return string|null
	 */
	public function getParamIcon( $atts, $content ) {
		if ( ! empty( $atts['add_icon'] ) && 'true' === $atts['add_icon'] ) {
			$iconClass = '';
			if ( isset( $atts[ 'i_icon_' . $atts['i_type'] ] ) ) {
				$iconClass = $atts[ 'i_icon_' . $atts['i_type'] ];
			}
			vc_icon_element_fonts_enqueue( $atts['i_type'] );

			return '<i class="vc_tta-icon ' . esc_attr( $iconClass ) . '"></i>';
		}

		return null;
	}

	/**
	 * @param $atts
	 * @param $content
	 *
	 * @return string|null
	 */
	public function getParamIconLeft( $atts, $content ) {
		if ( 'left' === $atts['i_position'] ) {
			return $this->getParamIcon( $atts, $content );
		}

		return null;
	}

	/**
	 * @param $atts
	 * @param $content
	 *
	 * @return string|null
	 */
	public function getParamIconRight( $atts, $content ) {
		if ( 'right' === $atts['i_position'] ) {
			return $this->getParamIcon( $atts, $content );
		}

		return null;
	}

	/**
	 * Section param active
	 */
	public function getParamSectionIsActive( $atts, $content ) {
		if ( is_object( self::$tta_base_shortcode ) ) {
			if ( isset( self::$tta_base_shortcode->atts['active_section'] ) && strlen( self::$tta_base_shortcode->atts['active_section'] ) > 0 ) {
				$active = (int) self::$tta_base_shortcode->atts['active_section'];
				if ( $active === self::$self_count ) {
					return true;
				}
			}
		}

		return null;
	}

	public function getParamControlIconPosition( $atts, $content ) {
		if ( is_object( self::$tta_base_shortcode ) ) {
			if (
				isset( self::$tta_base_shortcode->atts['c_icon'] ) && strlen( self::$tta_base_shortcode->atts['c_icon'] ) > 0 &&
				isset( self::$tta_base_shortcode->atts['c_position'] ) && strlen( self::$tta_base_shortcode->atts['c_position'] ) > 0
			) {
				$c_position = self::$tta_base_shortcode->atts['c_position'];

				return 'vc_tta-controls-icon-position-' . $c_position;
			}
		}

		return null;
	}

	public function getParamControlIcon( $atts, $content ) {
		if ( is_object( self::$tta_base_shortcode ) ) {
			if ( isset( self::$tta_base_shortcode->atts['c_icon'] ) && strlen( self::$tta_base_shortcode->atts['c_icon'] ) > 0 ) {
				$c_icon = self::$tta_base_shortcode->atts['c_icon'];

				return '<i class="vc_tta-controls-icon vc_tta-controls-icon-' . $c_icon . '"></i>';
			}
		}

		return null;
	}

	public function getParamHeading( $atts, $content ) {
		$isPageEditable = vc_is_page_editable();

		$h4attributes = array();
		$h4classes = array(
			'vc_tta-panel-title',
		);
		if ( $isPageEditable ) {
			$h4attributes[] = 'data-vc-tta-controls-icon-position=""';
		} else {
			$controlIconPosition = $this->getTemplateVariable( 'control-icon-position' );
			if ( $controlIconPosition ) {
				$h4classes[] = $controlIconPosition;
			}
		}
		$h4attributes[] = 'class="' . implode( ' ', $h4classes ) . '"';

		$output = '<h4 ' . implode( ' ', $h4attributes ) . '>'; // close h4

		if ( $isPageEditable ) {
			$output .= '<a href="javascript:;" data-vc-target=""';
			$output .= ' data-vc-tta-controls-icon-wrapper';
			$output .= ' data-vc-use-cache="false"';
		} else {
			$output .= '<a href="#' . esc_attr( $this->getTemplateVariable( 'tab_id' ) ) . '"';
		}

		$output .= ' data-vc-accordion';

		$output .= ' data-vc-container=".vc_tta-container">';
		$output .= $this->getTemplateVariable( 'icon-left' );
		$output .= '<span class="vc_tta-title-text">'
		           . $this->getTemplateVariable( 'title' )
		           . '</span>';
		$output .= $this->getTemplateVariable( 'icon-right' );
		if ( ! $isPageEditable ) {
			$output .= $this->getTemplateVariable( 'control-icon' );
		}

		$output .= '</a>';
		$output .= '</h4>'; // close h4 fix #2229

		return $output;
	}

	/**
	 * Get basic heading
	 *
	 * These are used in Pageable element inside content and are hidden from view
	 *
	 * @param $atts
	 * @param $content
	 *
	 * @return string
	 */
	public function getParamBasicHeading( $atts, $content ) {
		$isPageEditable = vc_is_page_editable();

		if ( $isPageEditable ) {
			$attributes = array(
				'href' => 'javascript:;',
				'data-vc-container' => '.vc_tta-container',
				'data-vc-accordion' => '',
				'data-vc-target' => '',
				'data-vc-tta-controls-icon-wrapper' => '',
				'data-vc-use-cache' => 'false',
			);
		} else {
			$attributes = array(
				'data-vc-container' => '.vc_tta-container',
				'data-vc-accordion' => '',
				'data-vc-target' => esc_attr( '#' . $this->getTemplateVariable( 'tab_id' ) ),
			);
		}

		$output = '
			<span class="vc_tta-panel-title">
				<a ' . vc_convert_atts_to_string( $attributes ) . '></a>
			</span>
		';

		return $output;
	}
	/**
	 * Check is allowed to add another element inside current element.
	 *
	 * @since 4.8
	 *
	 * @return bool
	 */
	public function getAddAllowed() {
		return  vc_user_access()
			->part( 'shortcodes' )
			->checkStateAny( true, 'custom', null )->get();
	}
}
}