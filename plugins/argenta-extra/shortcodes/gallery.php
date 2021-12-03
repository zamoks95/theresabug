<?php 

	/**
	* Visual Composer Argenta Gallery shortcode
	*/

	add_shortcode( 'argenta_sc_gallery', 'argenta_sc_gallery_func' );

	function argenta_sc_gallery_func( $atts ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$gallery = ( isset( $content_images ) ) ? argenta_extra_filter_string( $content_images, 'string', '' ) : '';
		$gallery_style = ( isset( $gallery_style ) ) ? argenta_extra_filter_string( $gallery_style, 'string', 'dark' ) : 'dark';
		$columns = ( isset( $columns ) ) ? ' ' . argenta_extra_filter_string( $columns, 'attr', '3' )  : '3';
		$gap = ( isset( $gap ) ) ? ' ' . argenta_extra_filter_string( $gap, 'attr', '15px' )  : '15px';

		$overlay_color = ( isset( $overlay_color ) ) ? argenta_extra_filter_string( $overlay_color ) : false;
		$css_class = ( isset( $css_class ) ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' )  : '';

		$columns = 12 / intval($columns);

		$gallery = explode( ',', $gallery );
		$_gallery = array();
		foreach ($gallery as $media_id) {
			$_image = wp_prepare_attachment_for_js( $media_id );
			$_gallery[] = array(
				'url' => $_image['sizes']['thumbnail']['url'],
				'full' => $_image['url'],
				'title' => $_image['title'],
				'caption' => $_image['caption']
			);
		}
		$gallery = $_gallery;

		// Styling
		$gallery_uniqid = uniqid( 'argenta-custom-' );
		$images_uniqid = uniqid( 'argenta-custom-' );
		$gallery_int_uniqid = uniqid( 'gallery-' );

		$overlay_css = ( $overlay_color ) ? 'background-color: ' . $overlay_color . ';' : '';
		$images_css = ( $gap ) ? 'padding: ' . $gap . ';' : '';

		$with_styles = (bool) ( $overlay_css || $images_css );

		// Assembling
		ob_start();
		include( 'layout/gallery.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
		'name' => __( 'Gallery', 'argenta_extra' ),
		'description' => __( 'Simple lightbox gallery module', 'argenta_extra' ),
		'base' => 'argenta_sc_gallery',
		'category' => __( 'Argenta', 'argenta_extra' ),
		'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-GalleryModule.png',
		'params' => array(
			// General
			array(
				'type' => 'attach_images',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Images', 'argenta_extra' ),
				'param_name' => 'content_images',
				'description' => __( 'First image will be main. Set title and caption in WordPress media.', 'argenta_extra' ),
			),
			array(
				'type' => 'dropdown',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Style', 'argenta_extra' ),
				'param_name' => 'gallery_style',
				'value' => array(
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon82.png',
						'key' => 'dark',
						'title' => __( 'Dark', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon83.png',
						'key' => 'light',
						'title' => __( 'Light', 'argenta_extra' ),
					)
				)
			),
			array(
				'type' => 'textfield',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Columns', 'argenta_extra' ),
				'param_name' => 'columns',
				'description' => __( 'Default 3 columns.', 'argenta_extra' ),
			),
			array(
				'type' => 'textfield',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Gap between images', 'argenta_extra' ),
				'param_name' => 'gap',
				'std' => '15px',
				'description' => __( 'Css value.', 'argenta_extra' ),
			),

			// Style
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Overlay custom color', 'argenta_extra' ),
				'param_name' => 'overlay_color',
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
	
?>