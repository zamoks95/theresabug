<?php 

	/**
	* Visual Composer Argenta Split box inner shortcode
	*/

	add_shortcode( 'argenta_sc_split_box_inner', 'argenta_sc_split_boxinner_func' );

	function argenta_sc_split_box_inner_func( $atts, $content = '' ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		$split_box_uniqid = uniqid('argenta-custom-');

		// Default values, parsing and filtering
		$css_class = ( isset( $css_class ) ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' )  : '';

		$bg_first_color  = ( isset( $bg_first_color ) ) ? argenta_extra_filter_string( $bg_first_color ) : false;
		$bg_second_color = ( isset( $bg_second_color ) ) ? argenta_extra_filter_string( $bg_second_color ) : false;
		$bg_first_image  = ( isset( $bg_first_image ) ) ? argenta_extra_filter_string( wp_get_attachment_url( argenta_extra_filter_string( $bg_first_image ) ), 'attr' ) : false;
		$bg_second_image = ( isset( $bg_second_image ) ) ? argenta_extra_filter_string( wp_get_attachment_url( argenta_extra_filter_string( $bg_second_image ) ), 'attr' ) : false;

		$bg_first_size  = ( isset( $bg_first_size ) ) ? argenta_extra_filter_string( $bg_first_size, 'string', '' ) : '';
		$bg_second_size = ( isset( $bg_second_size ) ) ? argenta_extra_filter_string( $bg_second_size, 'string', '' ) : '';
		$bg_first_parallax  = ( isset( $bg_first_parallax ) ) ? argenta_extra_filter_string( $bg_first_parallax, 'string', '' ) : '';
		$bg_second_parallax = ( isset( $bg_second_parallax ) ) ? argenta_extra_filter_string( $bg_second_parallax, 'string', '' ) : '';
		$bg_first_overlay_color = ( isset( $bg_first_overlay_color ) ) ? argenta_extra_filter_string( $bg_first_overlay_color ) : false;
		$bg_second_overlay_color = ( isset( $bg_second_overlay_color ) ) ? argenta_extra_filter_string( $bg_second_overlay_color ) : false;
		$bg_first_parallax_speed = ( isset( $bg_first_parallax_speed ) ) ? argenta_extra_filter_string( $bg_first_parallax_speed, 'attr', '1.0' )  : '1.0';
		$bg_second_parallax_speed = ( isset( $bg_second_parallax_speed ) ) ? argenta_extra_filter_string( $bg_second_parallax_speed, 'attr', '1.0' )  : '1.0';

		$bg_first_css = '';
		if ( $bg_first_color ) {
			$bg_first_css .= 'background-color: ' . $bg_first_color . ';';
		}
		if ( $bg_first_image ) {
			$bg_first_css .= 'background-image: url(' . $bg_first_image . ');';
		}
		if ( $bg_first_size ) {
			$bg_first_css .= 'background-size: ' . $bg_first_size . ';';
		}

		$bg_first_after_css = '';
		if ( $bg_first_overlay_color ) {
			$bg_first_after_css .= 'background-color: ' . $bg_first_overlay_color . '; ';
		}

		$bg_second_css = '';
		if ( $bg_second_color ) {
			$bg_second_css .= 'background-color: ' . $bg_second_color . ';';
		}
		if ( $bg_second_image ) {
			$bg_second_css .= 'background-image: url(' . $bg_second_image . ');';
		}
		if ( $bg_second_size ) {
			$bg_second_css .= 'background-size: ' . $bg_second_size . ';';
		}

		$bg_second_after_css = '';
		if ( $bg_second_overlay_color ) {
			$bg_second_after_css .= 'background-color: ' . $bg_second_overlay_color . '; ';
		}

		$column_now = 1;


		$with_styles = ( $bg_first_css || $bg_first_after_css || $bg_second_css || $bg_second_after_css );


		// Assembling
		ob_start();
		include( 'layout/split_box.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
			'name' => __( 'Split Box', 'argenta_extra' ),
			'description' => __( 'Split view box', 'argenta_extra' ),
			'base' => 'argenta_sc_split_box_inner',
			'category' => __( 'Argenta', 'argenta_extra' ),
			'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-SplitBox.png',
			'js_view' => 'VcArgentaSplitBoxColumnView',
			'show_settings_on_create' => false,
			'as_parent' => array( 
				'only' => 'argenta_sc_split_box_column_inner'
			),
			'as_child' => array( 
				'only' => 'argenta_sc_split_box_column'
			),
			'default_content' => '[argenta_sc_split_box_column_inner][/argenta_sc_split_box_column_inner][argenta_sc_split_box_column_inner][/argenta_sc_split_box_column_inner]',
			'params' => array(
				array(
					'type' => 'textfield',
					'group' => __( 'Styles and colors', 'argenta_extra' ),
					'heading' => __( 'Custom CSS class', 'argenta_extra' ),
					'param_name' => 'css_class',
					'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class.', 'argenta_extra' ),
				),

				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles for left block', 'argenta_extra' ),
					'heading' => __( 'Background color', 'argenta_extra' ),
					'param_name' => 'bg_first_color',
				),
				array(
					'type' => 'attach_image',
					'group' => __( 'Styles for left block', 'argenta_extra' ),
					'heading' => __( 'Background image', 'argenta_extra' ),
					'param_name' => 'bg_first_image',
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles for left block', 'argenta_extra' ),
					'heading' => __( 'Overlay color', 'argenta_extra' ),
					'param_name' => 'bg_first_overlay_color',
				),
				array(
					'type' => 'dropdown',
					'group' => __( 'Styles for left block', 'argenta_extra' ),
					'heading' => __( 'Background size', 'argenta_extra' ),
					'param_name' => 'bg_first_size',
					'value' => array(
						__( 'Auto', 'argenta_extra' ) => '',
						__( 'Contain', 'argenta_extra' ) => 'contain',
						__( 'Cover', 'argenta_extra' )   => 'cover',
						__( 'auto 100%', 'argenta_extra' )  => 'auto 100%',
						__( '100% auto', 'argenta_extra' )  => '100% auto',
						__( '100% 100%', 'argenta_extra' )  => '100% 100%',
					),
				),
				array(
					'type' => 'dropdown',
					'group' => __( 'Styles for left block', 'argenta_extra' ),
					'heading' => __( 'Background parallax type', 'argenta_extra' ),
					'param_name' => 'bg_first_parallax',
					'value' => array(
						__( 'None', 'argenta_extra' ) => '',
						__( 'Vertical', 'argenta_extra' ) => 'vertical',
						__( 'Horizontal', 'argenta_extra' ) => 'horizontal'
					),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'Styles for left block', 'argenta_extra' ),
					'heading' => __( 'Parallax speed', 'argenta_extra' ),
					'param_name' => 'bg_first_parallax_speed',
					'description' => __( 'Parallax speed (default 1.0).', 'argenta_extra' ),
					'dependency' => array(
						'element' => 'bg_first_parallax',
						'value' => array(
							'vertical',
							'horizontal'
						)
					),
				),

				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles for right block', 'argenta_extra' ),
					'heading' => __( 'Background color', 'argenta_extra' ),
					'param_name' => 'bg_second_color',
				),
				array(
					'type' => 'attach_image',
					'group' => __( 'Styles for right block', 'argenta_extra' ),
					'heading' => __( 'Background image', 'argenta_extra' ),
					'param_name' => 'bg_second_image',
				),
				array(
					'type' => 'colorpicker',
					'group' => __( 'Styles for right block', 'argenta_extra' ),
					'heading' => __( 'Overlay color', 'argenta_extra' ),
					'param_name' => 'bg_second_overlay_color',
				),
				array(
					'type' => 'dropdown',
					'group' => __( 'Styles for right block', 'argenta_extra' ),
					'heading' => __( 'Background size', 'argenta_extra' ),
					'param_name' => 'bg_second_size',
					'value' => array(
						__( 'Auto', 'argenta_extra' ) => '',
						__( 'Contain', 'argenta_extra' ) => 'contain',
						__( 'Cover', 'argenta_extra' )   => 'cover',
						__( 'auto 100%', 'argenta_extra' )  => 'auto 100%',
						__( '100% auto', 'argenta_extra' )  => '100% auto',
						__( '100% 100%', 'argenta_extra' )  => '100% 100%',
					),
				),
				array(
					'type' => 'dropdown',
					'group' => __( 'Styles for right block', 'argenta_extra' ),
					'heading' => __( 'Background parallax type', 'argenta_extra' ),
					'param_name' => 'bg_second_parallax',
					'value' => array(
						__( 'None', 'argenta_extra' ) => '',
						__( 'Vertical', 'argenta_extra' ) => 'vertical',
						__( 'Horizontal', 'argenta_extra' )   => 'horizontal'
					),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'Styles for right block', 'argenta_extra' ),
					'heading' => __( 'Parallax speed', 'argenta_extra' ),
					'param_name' => 'bg_second_parallax_speed',
					'description' => __( 'Parallax speed (default 1.0).', 'argenta_extra' ),
					'dependency' => array(
						'element' => 'bg_second_parallax',
						'value' => array(
							'vertical',
							'horizontal'
						)
					),
				),
			)
		)
	);

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Argenta_Sc_Split_Box_Inner extends WPBakeryShortCodesContainer {
			
			public function getColumnControls( $controls = 'full', $extended_css = '' ) {
				$controls_start = '<div class="vc_controls vc_controls-visible controls_column' . ( ! empty( $extended_css ) ? " {$extended_css}" : '' ) . '">';
				$controls_end = '</div>';

				if ( 'bottom-controls' === $extended_css ) {
					$control_title = sprintf( __( 'Append to this %s', 'argenta_extra' ), strtolower( $this->settings( 'name' ) ) );
				} else {
					$control_title = sprintf( __( 'Prepend to this %s', 'argenta_extra' ), strtolower( $this->settings( 'name' ) ) );
				}

				$controls_move = '<a class="vc_control column_move" data-vc-control="move" href="#" title="' . sprintf( __( 'Move this %s', 'argenta_extra' ), strtolower( $this->settings( 'name' ) ) ) . '"><span class="vc_icon"></span></a>';
				$controls_add = ''; //'<a class="vc_control column_add" data-vc-control="add" href="#" title="' . $control_title . '"><span class="vc_icon"></span></a>';
				$controls_edit = '<a class="vc_control column_edit" data-vc-control="edit" href="#" title="' . sprintf( __( 'Edit this %s', 'argenta_extra' ), strtolower( $this->settings( 'name' ) ) ) . '"><span class="vc_icon"></span></a>';
				$controls_clone = '<a class="vc_control column_clone" data-vc-control="clone" href="#" title="' . sprintf( __( 'Clone this %s', 'argenta_extra' ), strtolower( $this->settings( 'name' ) ) ) . '"><span class="vc_icon"></span></a>';
				$controls_delete = '<a class="vc_control column_delete" data-vc-control="delete" href="#" title="' . sprintf( __( 'Delete this %s', 'argenta_extra' ), strtolower( $this->settings( 'name' ) ) ) . '"><span class="vc_icon"></span></a>';
				$controls_full = $controls_move . $controls_add . $controls_edit . $controls_clone . $controls_delete;

				$editAccess = vc_user_access_check_shortcode_edit( $this->shortcode );
				$allAccess = vc_user_access_check_shortcode_all( $this->shortcode );

				if ( ! empty( $controls ) ) {
					if ( is_string( $controls ) ) {
						$controls = array( $controls );
					}
					$controls_string = $controls_start;
					foreach ( $controls as $control ) {
						$control_var = 'controls_' . $control;
						if ( ( $editAccess && 'edit' == $control ) || $allAccess ) {
							if ( isset( ${$control_var} ) ) {
								$controls_string .= ${$control_var};
							}
						}
					}

					return $controls_string . $controls_end;
				}

				if ( $allAccess ) {
					return $controls_start . $controls_full . $controls_end;
				} elseif ( $editAccess ) {
					return $controls_start . $controls_edit . $controls_end;
				}

				return $controls_start . $controls_end;
			}


		}
	}