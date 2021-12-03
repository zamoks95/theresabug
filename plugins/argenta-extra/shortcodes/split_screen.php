<?php 

	/**
	* Visual Composer Argenta Split screen page shortcode
	*/

	add_shortcode( 'argenta_sc_split_screen', 'argenta_sc_split_screen_func' );

	function argenta_sc_split_screen_func( $atts, $content = '' ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$bg_color = ( isset( $bg_color ) ) ? argenta_extra_filter_string( $bg_color ) : false;
		$bg_image = ( isset( $bg_image ) ) ? argenta_extra_filter_string( $bg_image ) : false;
		$bg_size = ( isset( $bg_size ) ) ? argenta_extra_filter_string( $bg_size, 'string', 'cover' ) : 'cover';
		$side_paddings = ( isset( $side_paddings ) ) ? argenta_extra_filter_string( $side_paddings ) : false;
		$css_class = ( isset( $css_class ) ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' )  : '';

		// Style
		$split_screen_uniqid = uniqid( 'argenta-custom-' );

		$bg_css = '';
		if ( $bg_color ) {
			$bg_css .= 'background-color: ' . $bg_color . ';';
		}
		if ( $bg_image ) {
			$bg_image = wp_get_attachment_image_src( $bg_image, 'full' );
			if ( is_array( $bg_image ) ) {
				$bg_image = $bg_image[0];
			}
			$bg_css .= 'background-image: url(\'' . $bg_image . '\');';
			switch ( $bg_size ) {
				case 'contain':
					$bg_css .= 'background-size: contain;';
					break;
				case 'no-repeat':
					$bg_css .= 'background-repeat: no-repeat;';
					break;
				case 'repeat':
					$bg_css .= 'background-repeat: repeat;';
					break;
				case 'cover':
				default:
					$bg_css .= 'background-size: cover;';
					break;
			}
		}

		if ( $side_paddings ) {
			$side_paddings_css = 'padding: 0 ' . $side_paddings . ';';
		}

		$with_styles = (bool) ( $bg_css || $side_paddings_css );


		// Assembling
		ob_start();
		include( 'layout/split_screen.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


		vc_map( array(
				'name' => __( 'Split Screen', 'argenta_extra' ),
				'description' => __( 'Split view in screens', 'argenta_extra' ),
				'base' => 'argenta_sc_split_screen',
				'category' => __( 'Argenta', 'argenta_extra' ),
				'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-SplitScreen.png',
				'js_view' => 'VcArgentaSplitScreenView',
				'show_settings_on_create' => false,
				'as_parent' => array( 
					'only' => array( 
						'argenta_sc_split_screen_column_left',
						'argenta_sc_split_screen_column_right'
					)
				),
				'as_child' => array( 
					'only' => 'argenta_sc_split_screens'
				),
				'default_content' => '[argenta_sc_split_screen_column_left][/argenta_sc_split_screen_column_left][argenta_sc_split_screen_column_right][/argenta_sc_split_screen_column_right]'
			)
	);

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

		class WPBakeryShortCode_Argenta_Sc_Split_Screen extends WPBakeryShortCodesContainer {
			
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
				$controls_edit = ''; //'<a class="vc_control column_edit" data-vc-control="edit" href="#" title="' . sprintf( __( 'Edit this %s', 'argenta_extra' ), strtolower( $this->settings( 'name' ) ) ) . '"><span class="vc_icon"></span></a>';
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