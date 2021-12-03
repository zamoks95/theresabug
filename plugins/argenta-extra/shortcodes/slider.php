<?php 

	/**
	* Visual Composer Argenta Slider shortcode
	*/

	add_shortcode( 'argenta_sc_slider', 'argenta_sc_slider_func' );

	function argenta_sc_slider_func( $atts, $content = '' ) {
		if ( is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$loop = ( isset( $loop ) ) ? argenta_extra_filter_boolean( $loop ) : true;

		$offset_items = ( isset( $offset_items ) ) ? argenta_extra_filter_boolean( $offset_items ) : false;
		$item_desktop = ( isset( $item_desktop ) ) ? argenta_extra_filter_string( $item_desktop, 'string', '5' ) : '5';
		$item_tablet = ( isset( $item_tablet ) ) ? argenta_extra_filter_string( $item_tablet, 'string', '3' ) : '3';
		$item_mobile = ( isset( $item_mobile ) ) ? argenta_extra_filter_string( $item_mobile, 'string', '1' ) : '1';
		$items_gap = ( isset( $items_gap ) ) ? argenta_extra_filter_string( $items_gap, 'string', '0' ) : '0';

		$pagination_show = ( isset( $pagination_show ) ) ? argenta_extra_filter_boolean( $pagination_show ) : true;
		$navigation_buttons = ( isset( $navigation_buttons ) ) ? argenta_extra_filter_boolean( $navigation_buttons ) : true;

		$slide_by = ( isset( $slide_by ) ) ? argenta_extra_filter_string( $slide_by, 'string', '1' ) : '1';
		$dots_each = ( isset( $dots_each ) ) ? argenta_extra_filter_string( $dots_each, 'string', '' ) : '';
		$scroll_per_page = ( isset( $scroll_per_page ) ) ? argenta_extra_filter_boolean( $scroll_per_page ) : true;
		$autoplay = ( isset( $autoplay ) ) ? argenta_extra_filter_boolean( $autoplay ) : true;
		$autoplay_time = ( isset( $autoplay_time ) ) ? argenta_extra_filter_string( $autoplay_time, 'string', '5' ) : '5';
		$stop_on_hover = ( isset( $stop_on_hover ) ) ? argenta_extra_filter_boolean( $stop_on_hover ) : true;

		$loop = ( $loop ) ? 'true' : 'false';
		$navigation_buttons = ( $navigation_buttons ) ? 'true' : 'false';
		$pagination_show = ( $pagination_show ) ? 'true' : 'false';
		$autoplay = ( $autoplay ) ? 'true' : 'false';
		$stop_on_hover = ( $stop_on_hover ) ? 'true' : 'false';

		$dots_color = ( isset( $dots_color ) ) ? argenta_extra_filter_string( $dots_color ) : false;
		$appearance_effect = ( isset( $appearance_effect ) ) ? argenta_extra_filter_string( $appearance_effect, 'attr', 'none' )  : 'none';
		$appearance_duration = ( isset( $appearance_duration ) ) ? argenta_extra_filter_string( $appearance_duration, 'attr', false )  : false;
		$css_class = ( isset( $css_class ) ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' )  : '';

		// Styling
		$slider_uniqid = uniqid( 'argenta-custom-' );

		$slider_class = '';

		$slider_class .= ( $offset_items ) ? ' slider-offset' : '';
		$slider_class .= ( $navigation_buttons == 'false' ) ? ' full' : '';
		$slider_class .= ( $pagination_show == 'false' ) ? ' without-dots' : '';

		$items_css = '';
		$items_css .= ( $items_gap ) ? 'padding-left: ' . $items_gap . '; padding-right: ' . $items_gap . ';' : '';

		$dots_css = ( $dots_color ) ? 'background-color: ' . $dots_color . '; border-color: ' . $dots_color . ';' : '';

		$with_styles = ( $items_css || $dots_css );

		// Assembling
		ob_start();
		include( 'layout/slider.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
			'name' => __( 'Slider', 'argenta_extra' ),
			'description' => __( 'Slider module', 'argenta_extra' ),
			'base' => 'argenta_sc_slider',
			'category' => __( 'Argenta', 'argenta_extra' ),
			'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-Slider.png',
			'is_container' => true,
			'show_settings_on_create' => true,
			'as_parent' => array(
				'only' => 'argenta_sc_slider_inner',
			),
			'js_view' => 'VcArgentaBackendTtaSliderView',
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
				[argenta_sc_slider_inner title="' . sprintf( '%s %d', __( 'Section', 'argenta_extra' ), 1 ) . '"][/argenta_sc_slider_inner]
				[argenta_sc_slider_inner title="' . sprintf( '%s %d', __( 'Section', 'argenta_extra' ), 2 ) . '"][/argenta_sc_slider_inner]
				[argenta_sc_slider_inner title="' . sprintf( '%s %d', __( 'Section', 'argenta_extra' ), 3 ) . '"][/argenta_sc_slider_inner]
			',
			'admin_enqueue_js' => array(
				vc_asset_url( 'lib/vc_tabs/vc-tabs.min.js' ),
			),
			'params' => array(

				// General
				array(
					'type' => 'argenta_check',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Loop', 'argenta_extra' ),
					'param_name' => 'loop',
					'value' => array(
						__( 'Yes', 'argenta_extra' ) => '1'
					),
				),

				// Items
				array(
					'type' => 'argenta_check',
					'group' => __( 'Items', 'argenta_extra' ),
					'heading' => __( 'Offset items', 'argenta_extra' ),
					'param_name' => 'offset_items',
					'value' => array(
						__( 'Yes', 'argenta_extra' ) => '0'
					),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'Items', 'argenta_extra' ),
					'heading' => __( 'Items desktop', 'argenta_extra' ),
					'param_name' => 'item_desktop',
					'description' => __( 'Default 5 items.', 'argenta_extra' ),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'Items', 'argenta_extra' ),
					'heading' => __( 'Items tablet', 'argenta_extra' ),
					'param_name' => 'item_tablet',
					'description' => __( 'Default 3 items.', 'argenta_extra' ),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'Items', 'argenta_extra' ),
					'heading' => __( 'Items mobile', 'argenta_extra' ),
					'param_name' => 'item_mobile',
					'description' => __( 'Default 1 items.', 'argenta_extra' ),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'Items', 'argenta_extra' ),
					'heading' => __( 'Items gap', 'argenta_extra' ),
					'param_name' => 'items_gap',
					'description' => __( 'Gap between items (css value).', 'argenta_extra' ),
				),

				// Pagination
				array(
					'type' => 'argenta_check',
					'group' => __( 'Pagination', 'argenta_extra' ),
					'heading' => __( 'Bullets', 'argenta_extra' ),
					'param_name' => 'pagination_show',
					'description' => __( 'Show bullets navigation.', 'argenta_extra' ),
					'std' => 'true',
					'value' => array(
						__( 'Yes', 'argenta_extra' ) => '1'
					),
				),
				array(
					'type' => 'argenta_check',
					'group' => __( 'Pagination', 'argenta_extra' ),
					'heading' => __( 'Buttons', 'argenta_extra' ),
					'param_name' => 'navigation_buttons',
					'std' => 'true',
					'description' => __( 'Show navigation buttons.', 'argenta_extra' ),
					'value' => array(
						__( 'Yes', 'argenta_extra' ) => '1'
					),
				),

				// Scroll
				array(
					'type' => 'textfield',
					'group' => __( 'Slide', 'argenta_extra' ),
					'heading' => __( 'Slide by', 'argenta_extra' ),
					'param_name' => 'slide_by',
					'description' => __( 'Navigation slide by x. `page` string can be set to slide by page.', 'argenta_extra' ),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'Slide', 'argenta_extra' ),
					'heading' => __( 'Dots each', 'argenta_extra' ),
					'param_name' => 'dots_each',
					'description' => __( 'Show bullet each x item.', 'argenta_extra' ),
					'dependency' => array(
						'element' => 'pagination_show',
						'value' => array(
							'1'
						)
					)
				),
				array(
					'type' => 'argenta_check',
					'group' => __( 'Slide', 'argenta_extra' ),
					'heading' => __( 'Scroll per page', 'argenta_extra' ),
					'param_name' => 'scroll_per_page',
					'description' => __( 'Scroll per page not per item. This affect next/prev buttons and mouse/touch dragging.', 'argenta_extra' ),
					'value' => array(
						__( 'Yes', 'argenta_extra' ) => '1'
					),
				),
				array(
					'type' => 'argenta_check',
					'group' => __( 'Slide', 'argenta_extra' ),
					'heading' => __( 'Autoplay', 'argenta_extra' ),
					'param_name' => 'autoplay',
					'value' => array(
						__( 'Yes', 'argenta_extra' ) => '1'
					),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'Slide', 'argenta_extra' ),
					'heading' => __( 'Autoplay time', 'argenta_extra' ),
					'param_name' => 'autoplay_time',
					'description' => __( 'Autoplay interval timeout in seconds. Default 5 second.', 'argenta_extra' ),
					'dependency' => array(
						'element' => 'autoplay',
						'value' => '1',
					)
				),
				array(
					'type' => 'argenta_check',
					'group' => __( 'Slide', 'argenta_extra' ),
					'heading' => __( 'Stop on hover', 'argenta_extra' ),
					'param_name' => 'stop_on_hover',
					'description' => __( 'Stop autoplay on mouse hover.', 'argenta_extra' ),
					'value' => array(
						__( 'Yes', 'argenta_extra' ) => '1'
					),
					'dependency' => array(
						'element' => 'autoplay',
						'value' => '1',
					)
				),

				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Dots color', 'argenta_extra' ),
					'param_name' => 'dots_color',
					'dependency' => array(
						'element' => 'pagination_show',
						'value' => '1',
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
					'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class, and then use this class in your custom CSS.', 'argenta_extra' )
				),
			)
		)
	);

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Argenta_Sc_Slider extends WPBakeryShortCode {
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
