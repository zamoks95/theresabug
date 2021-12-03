<?php 

	/**
	* Visual Composer Argenta Google Maps shortcode
	*/

	add_shortcode( 'argenta_sc_google_maps', 'argenta_sc_google_maps_func' );

	function argenta_sc_google_maps_func( $atts ) {
		if ( is_array( $atts ) ) {
			extract( $atts );
		}

		$default_map_marker = get_template_directory_uri() . '/images/google-maps-marker.png';

		// Default values, parsing and filtering
		$marker_locations = isset( $marker_locations ) ? argenta_extra_filter_string( $marker_locations, 'string', '') : '';
		$map_height = isset( $map_height ) ? argenta_extra_filter_string( $map_height, 'string', '') : '';
		$map_zoom = isset( $map_zoom ) ? argenta_extra_filter_string( $map_zoom, 'string', '14') : '14';
		$map_zoom_enable = ( isset( $map_zoom_enable ) ) ? argenta_extra_filter_boolean( $map_zoom_enable ) : false;
		$map_style = isset( $map_style ) ? argenta_extra_filter_string( $map_style, 'string', 'default') : 'default';

		if ( isset( $map_marker ) ) {
			$map_marker = argenta_extra_filter_string( $map_marker, 'string', $default_map_marker );
			$map_marker = wp_get_attachment_image_src( $map_marker, 'full' );
			$map_marker = $map_marker[0];
		} else {
			$map_marker = $default_map_marker;
		}

		$GLOBALS['argenta_use_map'] = true;

		$google_maps_uniqid = uniqid('argenta-custom-');
		$map_uniqid = uniqid();

		$with_styles = (bool) $map_height;

		// Assembling
		ob_start();
		include( 'layout/google_maps.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
			'name' => __( 'Google Maps', 'argenta_extra' ),
			'description' => __( 'Google Maps block', 'argenta_extra' ),
			'base' => 'argenta_sc_google_maps',
			'category' => __( 'Argenta', 'argenta_extra' ),
			'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-Map.png',
			'params' => array(

				// General
				array(
					'type' => 'textarea',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Map marker locations', 'argenta_extra' ),
					'param_name' => 'marker_locations',
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Map height', 'argenta_extra' ),
					'param_name' => 'map_height',
					'description' => __( 'Enter map height (in pixels or leave empty for responsive map).', 'argenta_extra' ),
				),
				array(
					'type' => 'attach_image',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Map marker image', 'argenta_extra' ),
					'param_name' => 'map_marker',
					'description' => __( 'Choose marker image.', 'argenta_extra' ),
				),
				array(
					'type' => 'argenta_check',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Enable map zoom buttons', 'argenta_extra' ),
					'param_name' => 'map_zoom_enable',
					'value' => array(
						__( 'Yes', 'argenta_extra' ) => '0'
					),
				),
				array(
					'type' => 'textfield',
					'group' => __( 'General', 'argenta_extra' ),
					'heading' => __( 'Map zoom', 'argenta_extra' ),
					'param_name' => 'map_zoom',
					'description' => __( 'Map zoom level (min - 1, max - 20, default - 14)', 'argenta_extra' ),
				),
				array(
				'type' => 'argenta_choose_box',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Map style', 'argenta_extra' ),
				'param_name' => 'map_style',
				'value' => array(
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/maps/default.png',
						'key' => 'default',
						'title' => __( 'Default', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/maps/light_dream.png',
						'key' => 'light_dream',
						'title' => __( 'Light Dream', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/maps/shades_of_grey.png',
						'key' => 'shades_of_grey',
						'title' => __( 'Shades of Grey', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/maps/paper.png',
						'key' => 'paper',
						'title' => __( 'Paper', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/maps/light_monochrome.png',
						'key' => 'light_monochrome',
						'title' => __( 'Monochrome', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/maps/lunar_landscape.png',
						'key' => 'lunar_landscape',
						'title' => __( 'Lunar', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/maps/routexl.png',
						'key' => 'routexl',
						'title' => __( 'Routexl', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/maps/flat_pale.png',
						'key' => 'flat_pale',
						'title' => __( 'Flat Pale', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/maps/flat_design.png',
						'key' => 'flat_design',
						'title' => __( 'Flat Design', 'argenta_extra' ),
					)
				)
			),
			)
		)
	);