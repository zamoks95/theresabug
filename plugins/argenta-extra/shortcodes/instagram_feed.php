<?php

	/**
	* Visual Composer Argenta Instagram feed shortcode
	*/

	add_shortcode( 'argenta_sc_instagram_feed', 'argenta_sc_instagram_feed_func' );

	function argenta_sc_instagram_feed_func( $atts ) {
		if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

		// Default values, parsing and filtering
		$username = isset( $username ) ? argenta_extra_filter_string( $username, 'string', 'instagram') : 'instagram';
		$photo_count = isset( $photo_count ) ? argenta_extra_filter_string( $photo_count, 'string', '4') : '4';
		$columns = isset( $columns ) ? argenta_extra_filter_string( $columns, 'string', '4') : '4';
		$card_type = isset( $card_type ) ? argenta_extra_filter_string( $card_type, 'string', 'cropped') : 'cropped';
		$offset_photo = isset( $offset_photo ) ? argenta_extra_filter_string( $offset_photo, 'string', '') : '';

		$appearance_effect = isset( $appearance_effect ) ? argenta_extra_filter_string( $appearance_effect, 'attr', 'none' ) : 'none';
		$appearance_duration = isset( $appearance_duration ) ? argenta_extra_filter_string( $appearance_duration, 'attr', false ) : false;
		if ( $appearance_duration ) $appearance_duration = intval( str_replace( 'ms', '', $appearance_duration ) );

		$css_class = isset( $css_class ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' ) : '';

		$result = false;
		if ( $username ){
			$insta_source = file_get_contents( 'http://instagram.com/' . $username );
			$shards = explode( 'window._sharedData = ', $insta_source );
			$insta_json = explode( ';</script>', $shards[1] );
			$result = json_decode( $insta_json[0], TRUE );
			$result = $result['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
		}


		$column = 12 / intval( $columns );

		// Styling
		$instagram_feed_uniqid = uniqid( 'argenta-custom-' );

		$column_css = $image_css = false;
		if ( $offset_photo ) {
			if ( $card_type == 'vertical' ) {
				$column_css = 'padding: ' . $offset_photo . ';';
			} else {
				$image_css = 'top:' . $offset_photo . ';left:' . $offset_photo . ';width:calc(100% - ' . $offset_photo . ');height:calc(100% - ' . $offset_photo . ');';
			}
		}

		$card_type_class = ( $card_type == 'vertical' ) ? 'vertical' : 'boxed';

		$with_styles = (bool)( $column_css || $image_css );

		// Assembling
		ob_start();
		include( 'layout/instagram_feed.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}




	vc_map( array(
		'name' => __( 'Instagram Feed', 'argenta_extra' ),
		'description' => __( 'Instagram feed module', 'argenta_extra' ),
		'base' => 'argenta_sc_instagram_feed',
		'category' => __( 'Argenta', 'argenta_extra' ),
		'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-InstagramFeed.png',
		'params' => array(

			// General
			array(
				'type' => 'textfield',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Your Instagram username', 'argenta_extra' ),
				'param_name' => 'username',
			),
			array(
				'type' => 'textfield',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Number of photos', 'argenta_extra' ),
				'param_name' => 'photo_count',
				'description' => __( 'Default 4. We recommend using a number that is suitable for the number of columns.', 'argenta_extra' ),
			),
			array(
				'type' => 'dropdown',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Columns', 'argenta_extra' ),
				'param_name' => 'columns',
				'value' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'12' => '12',
				),
				'default' => '4',
			),

			// Styles and colors
			array(
				'type' => 'dropdown',
				'group' => __( 'Styles and Colors', 'argenta_extra' ),
				'heading' => __( 'Style of cards', 'argenta_extra' ),
				'param_name' => 'card_type',
				'value' => array(
					'Vertical aligned' => 'vertical',
					'Cropped squares' => 'cropped',
				),
				'default' => 'cropped',
			),
			array(
				'type' => 'textfield',
				'group' => __( 'Styles and Colors', 'argenta_extra' ),
				'heading' => __( 'Photos offset size', 'argenta_extra' ),
				'param_name' => 'offset_photo',
				'description' => __( 'Space between photos (CSS value).', 'argenta_extra' ),
			),
			array(
				'type' => 'dropdown',
				'group' => __( 'Styles and Colors', 'argenta_extra' ),
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
				'group' => __( 'Styles and Colors', 'argenta_extra' ),
				'heading' => __( 'Appearance effect duration', 'argenta_extra' ),
				'param_name' => 'appearance_duration',
				'description' => __( 'Duration accept values from 50 to 3000(ms), with step 50.', 'argenta_extra' ),
			),
			array(
				'type' => 'textfield',
				'group' => __( 'Styles and Colors', 'argenta_extra' ),
				'heading' => __( 'Custom CSS class', 'argenta_extra' ),
				'param_name' => 'css_class',
				'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class.', 'argenta_extra' ),
			),
		)
	) );
