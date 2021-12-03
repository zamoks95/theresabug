<?php 

	/**
	* Visual Composer Argenta Accordion shortcode
	*/

	add_shortcode( 'argenta_sc_accordion', 'argenta_sc_accordion_func' );

	function argenta_sc_accordion_func( $atts, $content = null ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$accordion_tabs_type = ( isset( $accordion_tabs_type ) ) ? argenta_extra_filter_string( $accordion_tabs_type, 'string', 'default' ) : 'default';
		$active_tab_color = ( isset( $active_tab_color ) ) ? argenta_extra_filter_string( $active_tab_color ) : false;
		$css_class = ( isset( $css_class ) ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' )  : '';

		// Styling
		$accordion_uniqid = uniqid('argenta-custom-');

		$active_tab_css = '';
		if ( $active_tab_color ) {
			$active_tab_css .= 'color: ' . $active_tab_color . ';';
		}

		$with_styles = ( bool ) $active_tab_css;

		// Assembling
		ob_start();
		include( 'layout/accordion.php' );
		$content = ob_get_contents();
		ob_end_clean();

		argenta_gh_add_required_script( 'accordion' );

		return $content;
	}


	vc_map( array(
		'name' => __( 'Accordion', 'argenta_extra' ),
		'description' => __( 'Collapsible accordion module', 'argenta_extra' ),
		'base' => 'argenta_sc_accordion',
		'category' => __( 'Argenta', 'argenta_extra' ),
		'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-Accordion.png',
		'is_container' => true,
		'show_settings_on_create' => false,
		'as_parent' => array(
			'only' => 'argenta_sc_accordion_inner',
		),
		'js_view' => 'VcArgentaBackendTtaAccordionView',
		'custom_markup' => '
			<div class="vc_tta-container" data-vc-action="collapseAll">
				<div class="vc_general vc_tta vc_tta-accordion vc_tta-color-backend-accordion-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-o-shape-group vc_tta-controls-align-left vc_tta-gap-2">
				   <div class="vc_tta-panels vc_clearfix {{container-class}}">
				      <div class="vc_tta-panel vc_tta-section-append">
				         <div class="vc_tta-panel-heading">
				            <h4 class="vc_tta-panel-title vc_tta-controls-icon-position-left">
				               <a href="javascript:;" aria-expanded="false" class="vc_tta-backend-add-control">
				                   <span class="vc_tta-title-text">' . __( 'Add Section', 'argenta_extra' ) . '</span>
				                    <i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i>
								</a>
				            </h4>
				         </div>
				      </div>
				   </div>
				</div>
			</div>
		',
		'default_content' => '[argenta_sc_accordion_inner title="' . sprintf( '%s %d', __( 'Section', 'argenta_extra' ), 1 ) . '"][/argenta_sc_accordion_inner][argenta_sc_accordion_inner title="' . sprintf( '%s %d', __( 'Section', 'argenta_extra' ), 2 ) . '"][/argenta_sc_accordion_inner]',
		'params' => array(
			// Styles
			array(
				'type' => 'argenta_choose_box',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Accordion tabs style', 'argenta_extra' ),
				'param_name' => 'accordion_tabs_type',
				'value' => array(
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon69.png',
						'key' => 'default',
						'title' => __( 'Filled header', 'argenta_extra' )
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon70.png',
						'key' => 'outline',
						'title' => __( 'Outline header', 'argenta_extra' )
					)
				)
			),
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Active tab color', 'argenta_extra' ),
				'param_name' => 'active_tab_color',
			),
			array(
				'type' => 'textfield',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Custom CSS class', 'argenta_extra' ),
				'param_name' => 'css_class',
				'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class.', 'argenta_extra' )
			),
		)
	) );

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Argenta_Sc_Accordion extends WPBakeryShortCode {
		protected $controls_css_settings = 'out-tc vc_controls-content-widget';

		public function __construct( $settings ) {
			parent::__construct( $settings );
		}

		public function contentAdmin( $atts, $content = null ) {
			$width = $custom_markup = '';
			$shortcode_attributes = array( 'width' => '1/1' );
			foreach ( $this->settings['params'] as $param ) {
				if ( 'content' !== $param['param_name'] ) {
					$shortcode_attributes[ $param['param_name'] ] = isset( $param['value'] ) ? $param['value'] : null;
				} elseif ( 'content' === $param['param_name'] && null === $content ) {
					$content = $param['value'];
				}
			}
			extract( shortcode_atts( $shortcode_attributes, $atts ) );

			$elem = $this->getElementHolder( $width );

			$inner = '';
			foreach ( $this->settings['params'] as $param ) {
				$param_value = isset( ${$param['param_name']} ) ? ${$param['param_name']} : '';
				if ( is_array( $param_value ) ) {
					// Get first element from the array
					reset( $param_value );
					$first_key = key( $param_value );
					$param_value = $param_value[ $first_key ];
				}
				$inner .= $this->singleParamHtmlHolder( $param, $param_value );
			}

			$tmp = '';

			if ( isset( $this->settings['custom_markup'] ) && '' !== $this->settings['custom_markup'] ) {
				if ( '' !== $content ) {
					$custom_markup = str_ireplace( '%content%', $tmp . $content, $this->settings['custom_markup'] );
				} elseif ( '' === $content && isset( $this->settings['default_content_in_template'] ) && '' !== $this->settings['default_content_in_template'] ) {
					$custom_markup = str_ireplace( '%content%', $this->settings['default_content_in_template'], $this->settings['custom_markup'] );
				} else {
					$custom_markup = str_ireplace( '%content%', '', $this->settings['custom_markup'] );
				}
				$inner .= do_shortcode( $custom_markup );
			}
			$output = str_ireplace( '%wpb_element_content%', $inner, $elem );

			return $output;
		}
	}
}