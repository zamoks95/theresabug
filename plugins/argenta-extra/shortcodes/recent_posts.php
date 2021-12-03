<?php

	/**
	* Visual Composer Argenta Recent Posts shortcode
	*/

	add_shortcode( 'argenta_sc_recent_posts', 'argenta_sc_recent_posts_func' );

	function argenta_sc_recent_posts_func( $atts ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$post_category = isset( $post_category ) ? argenta_extra_filter_string( $post_category, 'string', 'all' ) : 'all';
		$card_layout = ( isset( $card_layout ) ) ? argenta_extra_filter_string( $card_layout, 'string', 'default' ) : 'default';
		$columns_in_row = ( isset( $columns_in_row ) ) ? argenta_extra_filter_string( $columns_in_row, 'string', '4-3-2-1' ) : '4-3-2-1';
		$posts_in_block = ( isset( $posts_in_block ) ) ? argenta_extra_filter_string( $posts_in_block, 'string', 12 ) : 12;
		$card_boxed = ( isset( $card_boxed ) ) ? argenta_extra_filter_boolean( $card_boxed ) : true;
		$card_gap = ( isset( $card_gap ) ) ? argenta_extra_filter_string( $card_gap, 'string', '15px' ) : '15px';
		$css_class = ( isset( $css_class ) ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' )  : '';

		if ( $post_category != 'all' ) {
			$_post_category = $post_category;
			$post_category = array();
			foreach ( explode( ',', $_post_category) as $category) {
				$post_category[] = intval( trim( $category ) );
			}
		}

		$_tax_query = array();
		if ( $post_category != 'all' ) {
			$_tax_query = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $post_category
				)
			);
		}

		$args = array(
			'posts_per_page'	=> intval( $posts_in_block ),
			'offset'			=> 0,
			'category'			=> '',
			'category_name'     => '',
			'orderby'			=> 'date',
			'order'				=> 'DESC',
			'include'			=> '',
			'exclude'			=> '',
			'meta_key'			=> '',
			'meta_value'		=> '',
			'post_type'			=> 'post',
			'tax_query' 		=> $_tax_query,
			'post_mime_type'	=> '',
			'post_parent'		=> '',
			'author'			=> '',
			'author_name'		=> '',
			'post_status'		=> 'publish',
			'suppress_filters' => true
		);
		$posts_data = get_posts( $args );

		$column_class = argenta_extra_parse_VC_columns_to_CSS( $columns_in_row );
		$column_double_class = argenta_extra_parse_VC_columns_to_CSS( $columns_in_row, true );

		$columns_in_row = explode( '-', $columns_in_row );
		if ( is_array( $columns_in_row ) ) {
			$columns_in_row = intval( $columns_in_row[0] );
		}

		$items_css = '';
		if ( $card_gap ) {
			$items_css = 'padding: ' . $card_gap . '; ';
		}

		// Styling
		$recent_posts_uniqid = uniqid( 'argenta-custom-' );
		$with_styles = (bool)( $items_css );

		// Assembling
		ob_start();
		include( 'layout/recent_posts.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
		'name' => __( 'Recent Posts', 'argenta_extra' ),
		'description' => __( 'Block with recent posts', 'argenta_extra' ),
		'base' => 'argenta_sc_recent_posts',
		'category' => __( 'Argenta', 'argenta_extra' ),
		'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-RecentPosts.png',
		'params' => array(
			// General
			array(
				'type' => 'argenta_post_types',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Post categories', 'argenta_extra' ),
				'param_name' => 'post_category',
				'value'		=> ''
			),
			array(
				'type' => 'dropdown',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Post card layout type', 'argenta_extra' ),
				'param_name' => 'card_layout',
				'value' => array(
					__( 'Default', 'argenta_extra' ) => 'default',
					__( 'Without excerpt', 'argenta_extra' ) => 'without_excerpt',
					__( 'Footer top', 'argenta_extra' ) => 'date_top',
					__( 'Inner wrapped', 'argenta_extra' ) => 'inner',
					__( 'Inner wrapped with description', 'argenta_extra' ) => 'inner_with_description'
				),
			),
			array(
				'type' => 'argenta_check',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Items boxed style', 'argenta_extra' ),
				'param_name' => 'card_boxed',
				'description' => __( 'Append box wrapper for post cards', 'argenta_extra' ),
				'value' => array(
					__( 'Wrap in box', 'argenta_extra' ) => '1'
				),
			),
			array(
				'type' => 'argenta_columns',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Columns in row', 'argenta_extra' ),
				'param_name' => 'columns_in_row',
				'value' => '4-3-2-1'
			),
			array(
				'type' => 'textfield',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Posts in the block', 'argenta_extra' ),
				'param_name' => 'posts_in_block',
				'description' => __( 'Chose number of last projects in the block', 'argenta_extra' ),
				'value' => 12
			),
			array(
				'type' => 'textfield',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Items gap', 'argenta_extra' ),
				'param_name' => 'card_gap',
				'description' => __( 'In css value.', 'argenta_extra' ),
				'value' => '30px'
			),

			// Style
			array(
				'type' => 'textfield',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Custom CSS class', 'argenta_extra' ),
				'param_name' => 'css_class',
				'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class, and then use this class in your custom CSS.', 'argenta_extra' ),
			),
		)
	) );
