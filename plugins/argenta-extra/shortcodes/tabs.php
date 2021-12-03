<?php 

	/**
	* Visual Composer Argenta Tabs shortcode
	*/

	add_shortcode( 'argenta_sc_tabs', 'argenta_sc_tabs_func' );

	function argenta_sc_tabs_func( $atts, $content = null ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$tabs_type = ( isset( $tabs_type ) ) ? argenta_extra_filter_string( $tabs_type, 'string', 'default' ) : 'default';
		if ( $tabs_type == 'default' ) {
			$tabs_layout = ( isset( $tabs_layout ) ) ? argenta_extra_filter_string( $tabs_layout, 'string', 'ontop' ) : 'ontop';
		} else {
			$tabs_layout = ( isset( $tabs_layout_2 ) ) ? argenta_extra_filter_string( $tabs_layout_2, 'string', 'ontop' ) : 'ontop';
		}
		$tabs_color = ( isset( $tabs_color ) ) ? argenta_extra_filter_string( $tabs_color ) : false;
		$tabs_background = ( isset( $tabs_background ) ) ? argenta_extra_filter_string( $tabs_background ) : false;
		$tabs_content_background = ( isset( $tabs_content_background ) ) ? argenta_extra_filter_string( $tabs_content_background ) : false;
		$tabs_title_typo = ( isset( $tabs_title_typo ) ) ? argenta_extra_filter_string( $tabs_title_typo ) : false;
		$appearance_effect = ( isset( $appearance_effect ) ) ? argenta_extra_filter_string( $appearance_effect, 'attr', 'none' )  : 'none';
		$appearance_duration = ( isset( $appearance_duration ) ) ? argenta_extra_filter_string( $appearance_duration, 'attr', false )  : false;
		$css_class = ( isset( $css_class ) ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' ) : '';

		// Styling
		$tabs_uniqid = uniqid( 'argenta-custom-' );

		$tabs_class_postfix = '';
		if ( $tabs_layout == 'onleft' )  {
			$tabs_class_postfix .= '-left';
		}
		if ( $tabs_type == 'bordered' ) {
			$tabs_class_postfix .= ' tab-box-material';
		}

		if ( $tabs_type == 'bordered' ) {
			$tabs_css = ( $tabs_background ) ? 'background-color: ' . $tabs_background . ';' : '';
			$tabs_css .= argenta_extra_parse_VC_typography_to_CSS( $tabs_title_typo );
			$tabs_active_css = ( $tabs_color ) ? 'color: ' . $tabs_color . ';' : '';
			$tabs_active_css .= ( $tabs_color ) ? 'border-color: ' . $tabs_color . ';' : '';
			$tabs_content_css = ( $tabs_content_background ) ? 'background-color: ' . $tabs_content_background . ';' : '';
		} else {
			$tabs_css = ( $tabs_color ) ? 'color: ' . $tabs_color . ';' : '';
			$tabs_css .= ( $tabs_background ) ? 'background-color: ' . $tabs_background . ';' : '';
			$tabs_css .= argenta_extra_parse_VC_typography_to_CSS( $tabs_title_typo );
			$tabs_active_css = 'color: #ffffff;';
			$tabs_active_css .= ( $tabs_color ) ? 'background-color: ' . $tabs_color . ';' : '';
			$tabs_content_css = ( $tabs_content_background ) ? 'background-color: ' . $tabs_content_background . ';' : '';
		}

		$element_custom_fonts = array();
		$tabs_title_custom_font = argenta_extra_parse_VC_typography_custom_font( $tabs_title_typo );
		if ( $tabs_title_custom_font ) {
			$element_custom_fonts[] = $tabs_title_custom_font;
		}

		$with_styles = ( $tabs_css || $tabs_active_css || $tabs_content_css || count( $element_custom_fonts ) > 0  );

		// Assembling
		ob_start();
		include( 'layout/tabs.php' );
		$content = ob_get_contents();
		ob_end_clean();

		argenta_gh_add_required_script( 'tabs' );

		return $content;
	}

	vc_map( array(
		'name' => __( 'Tabs', 'argenta_extra' ),
		'description' => __( 'Tabs module', 'argenta_extra' ),
		'base' => 'argenta_sc_tabs',
		'category' => __( 'Argenta', 'argenta_extra' ),
		'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-Tabs.png',
		'is_container' => true,
		'show_settings_on_create' => true,
		'as_parent' => array(
			'only' => 'argenta_sc_tabs_inner',
		),
		'js_view' => 'VcArgentaBackendTtaTabsView',
		'custom_markup' => '
			<div class="vc_tta-container" data-vc-action="collapse">
				<div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
					<div class="vc_tta-tabs-container">'
						. '<ul class="vc_tta-tabs-list">'
						. '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="vc_tta_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">{{ section_title }}</span></a></li>'
						. '</ul>
					</div>
					<div class="vc_tta-panels vc_clearfix {{container-class}}">
					  {{ content }}
					</div>
				</div>
			</div>
		',
		'default_content' => '
			[argenta_sc_tabs_inner title="' . sprintf( '%s %d', __( 'Tab', 'argenta_extra' ), 1 ) . '"][/argenta_sc_tabs_inner]
			[argenta_sc_tabs_inner title="' . sprintf( '%s %d', __( 'Tab', 'argenta_extra' ), 2 ) . '"][/argenta_sc_tabs_inner]
		',
		'admin_enqueue_js' => array(
			vc_asset_url( 'lib/vc_tabs/vc-tabs.min.js' ),
		),
		'params' => array(
			// Styles
			array(
				'type' => 'argenta_choose_box',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Tabs type', 'argenta_extra' ),
				'param_name' => 'tabs_type',
				'value' => array(
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon73.png',
						'key' => 'default',
						'title' => __( 'Filled', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon75.png',
						'key' => 'bordered',
						'title' => __( 'Bordered', 'argenta_extra' ),
					)
				)
			),
			array(
				'type' => 'argenta_choose_box',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Tabs layout', 'argenta_extra' ),
				'param_name' => 'tabs_layout',
				'value' => array(
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon73.png',
						'key' => 'ontop',
						'title' => __( 'Horizontal', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon74.png',
						'key' => 'onleft',
						'title' => __( 'Vertical', 'argenta_extra' ),
					)
				),
				'dependency' => array(
					'element' => 'tabs_type',
					'value' => 'default'
				)
			),
			array(
				'type' => 'argenta_choose_box',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Tabs layout', 'argenta_extra' ),
				'param_name' => 'tabs_layout_2',
				'value' => array(
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon75.png',
						'key' => 'ontop',
						'title' => __( 'Horizontal', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon76.png',
						'key' => 'onleft',
						'title' => __( 'Vertical', 'argenta_extra' ),
					)
				),
				'dependency' => array(
					'element' => 'tabs_type',
					'value' => 'bordered'
				)
			),

			// Typography
			array(
				'type' => 'argenta_divider',
				'group' => __( 'Typography', 'argenta_extra' ),
				'param_name' => 'typo_tab_divider_tabs_title',
				'value' => __( 'Tabs title', 'argenta_extra' ),
			),
			array(
				'type' => 'argenta_typography',
				'group' => __( 'Typography', 'argenta_extra' ),
				'param_name' => 'tabs_title_typo'
			),

			// Style
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Tabs accent color (font text/border/active)', 'argenta_extra' ),
				'param_name' => 'tabs_color'
			),
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Tabs background color', 'argenta_extra' ),
				'param_name' => 'tabs_background'
			),
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Content background', 'argenta_extra' ),
				'param_name' => 'tabs_content_background'
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
				'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class.', 'argenta_extra' ),
			),
		)
	) );

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Argenta_Sc_Tabs extends WPBakeryShortCode {
			static $filter_added = false;
			protected $controls_css_settings = 'out-tc vc_controls-content-widget';
			protected $controls_list = array( 'edit', 'clone', 'delete' );

			public function __construct( $settings ) {
				parent::__construct( $settings );
				if ( ! self::$filter_added ) {
					$this->addFilter( 'vc_inline_template_content', 'setCustomTabId' );
					self::$filter_added = true;
				}
			}

			public function getTabTemplate() {
				return '<div class="wpb_template">' . do_shortcode( '[vc_tab title="Tab" tab_id=""][/vc_tab]' ) . '</div>';
			}

			public function setCustomTabId( $content ) {
				return preg_replace( '/tab\_id\=\"([^\"]+)\"/', 'tab_id="$1-' . time() . '"', $content );
			}
		}
	}