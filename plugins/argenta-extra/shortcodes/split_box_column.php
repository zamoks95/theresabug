<?php 

	/**
	* Visual Composer Argenta Split box column shortcode
	*/

	add_shortcode( 'argenta_sc_split_box_column', 'argenta_sc_split_box_column_func' );

	function argenta_sc_split_box_column_func( $atts, $content = '' ) {

		// Assembling
		ob_start();
		include( 'layout/split_box_column.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
		'name' => __( 'Split Box Column', 'argenta_extra' ),
		'description' => __( 'Split box column', 'argenta_extra' ),
		'base' => 'argenta_sc_split_box_column',
		'category' => __( 'Argenta', 'argenta_extra' ),
		'js_view' => 'VcArgentaSplitBoxColumnInnerView',
		'show_settings_on_create' => false,
		'is_container' => true,
		'as_child' => array( 
			'only' => 'argenta_sc_split_box'
		),
	));



	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Argenta_Sc_Split_Box_Column extends WPBakeryShortCodesContainer {
			
			public function getColumnControls( $controls = 'full', $extended_css = '' ) {
				$controls_start = '<div class="vc_controls vc_controls-visible controls_column' . ( ! empty( $extended_css ) ? " {$extended_css}" : '' ) . '">';
				$controls_end = '</div>';

				if ( 'bottom-controls' === $extended_css ) {
					$control_title = sprintf( __( 'Append to this %s', 'argenta_extra' ), strtolower( $this->settings( 'name' ) ) );
				} else {
					$control_title = sprintf( __( 'Prepend to this %s', 'argenta_extra' ), strtolower( $this->settings( 'name' ) ) );
				}

				$controls_move = '';
				$controls_add = '<a class="vc_control column_add" data-vc-control="add" href="#" title="' . $control_title . '"><span class="vc_icon"></span></a>';
				$controls_edit = '';
				$controls_clone = '';
				$controls_delete = '';
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

			protected function outputTitle( $title ) {
				$icon = $this->settings( 'icon' );
				if ( filter_var( $icon, FILTER_VALIDATE_URL ) ) {
					$icon = '';
				}
				$params = array(
					'icon' => $icon,
					'is_container' => $this->settings( 'is_container' ),
					'title' => $title,
				);

				return '';//<h4 class="wpb_element_title"> ' . $this->getIcon( $params ) . '</h4>';
			}

			public function mainHtmlBlockParams( $width, $i ) {
				$sortable = ( vc_user_access_check_shortcode_all( $this->shortcode ) ? 'wpb_sortable' : $this->nonDraggableClass );

				return 'data-element_type="' . $this->settings['base'] . '" class="wpb_' . $this->settings['base'] . ' ' /*. $sortable*/ . ' wpb_content_holder vc_shortcodes_container"' . $this->customAdminBlockParams();
			}

		}
	}