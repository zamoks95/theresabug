<?php 

	/**
	* Visual Composer Argenta Recent Portfolio Projects shortcode
	*/

	add_shortcode( 'argenta_sc_recent_projects', 'argenta_sc_recent_projects_func' );

	function argenta_sc_recent_projects_func( $atts ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$projects_layout = ( isset( $projects_layout ) ) ? argenta_extra_filter_string( $projects_layout, 'string', 'grid' ) : 'grid';
		$card_layout = ( isset( $card_layout ) ) ? argenta_extra_filter_string( $card_layout, 'string', 'default' ) : 'default';
		$columns_in_row = ( isset( $columns_in_row ) ) ? argenta_extra_filter_string( $columns_in_row, 'attr', '4-3-2-1' ) : '4-3-2-1';
		$projects_in_block = ( isset( $projects_in_block ) ) ? argenta_extra_filter_string( $projects_in_block, 'attr', 12 ) : 12;
		$projects_solid = ( isset( $projects_solid ) ) ? argenta_extra_filter_boolean( $projects_solid ) : false;
		$show_projects_filter = ( isset( $show_projects_filter ) ) ? argenta_extra_filter_boolean( $show_projects_filter ) : true;
		$open_in_popup = ( isset( $open_in_popup ) ) ? argenta_extra_filter_boolean( $open_in_popup ) : false;
		$loop_popup_slider = ( isset( $loop_popup_slider ) ) ? argenta_extra_filter_boolean( $loop_popup_slider ) : false;
		$filter_align = ( isset( $filter_align ) ) ? argenta_extra_filter_string( $filter_align, 'attr', 'center' ) : 'center';
		$filter_color = isset( $filter_color ) ? argenta_extra_filter_string( $filter_color, 'string', false ) : false;
		$filter_accent_color = isset( $filter_accent_color ) ? argenta_extra_filter_string( $filter_accent_color, 'string', false ) : false;
		$projects_category = ( isset( $projects_category ) ) ? argenta_extra_filter_string( $projects_category, 'attr', 'all' ) : 'all';
		
		if ( strpos( $projects_category, ',' ) > 0 ) {
			$_projects_category = $projects_category;
			$projects_category = array();
			foreach ( explode( ',', $_projects_category) as $category) {
				$projects_category[] = intval( trim( $category ) );
			}
		}

		$css_class = ( isset( $css_class ) ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' )  : '';

		if ( $show_projects_filter ) {
			$css_class .= ' with-sorting';
		}

		$loop = ( isset( $loop ) ) ? argenta_extra_filter_boolean( $loop ) : true;

		$offset_items = ( isset( $offset_items ) ) ? argenta_extra_filter_boolean( $offset_items ) : false;
		$item_desktop = ( isset( $item_desktop ) ) ? argenta_extra_filter_string( $item_desktop, 'attr', '5' ) : '5';
		$item_tablet = ( isset( $item_tablet ) ) ? argenta_extra_filter_string( $item_tablet, 'attr', '3' ) : '3';
		$item_mobile = ( isset( $item_mobile ) ) ? argenta_extra_filter_string( $item_mobile, 'attr', '1' ) : '1';
		$items_gap = ( isset( $items_gap ) ) ? argenta_extra_filter_string( $items_gap, 'attr', '0' ) : '0';

		$pagination_show = ( isset( $pagination_show ) ) ? argenta_extra_filter_boolean( $pagination_show ) : true;
		$navigation_buttons = ( isset( $navigation_buttons ) ) ? argenta_extra_filter_boolean( $navigation_buttons ) : false;

		$slide_by = ( isset( $slide_by ) ) ? argenta_extra_filter_string( $slide_by, 'attr', '1' ) : '1';
		$scroll_per_page = ( isset( $scroll_per_page ) ) ? argenta_extra_filter_boolean( $scroll_per_page ) : true;
		$autoplay = ( isset( $autoplay ) ) ? argenta_extra_filter_boolean( $autoplay ) : true;
		$autoplay_time = ( isset( $autoplay_time ) ) ? argenta_extra_filter_string( $autoplay_time, 'attr', '5' ) : '5';
		$stop_on_hover = ( isset( $stop_on_hover ) ) ? argenta_extra_filter_boolean( $stop_on_hover ) : true;

		$loop = ( $loop ) ? 'true' : 'false';
		$navigation_buttons = ( $navigation_buttons ) ? 'true' : 'false';
		$pagination_show = ( $pagination_show ) ? 'true' : 'false';
		$autoplay = ( $autoplay ) ? 'true' : 'false';
		$stop_on_hover = ( $stop_on_hover ) ? 'true' : 'false';

		$dots_color = ( isset( $dots_color ) ) ? argenta_extra_filter_string( $dots_color ) : false;

		$_tax_query = array();
		if ( $projects_category != 'all' ) {
			$_tax_query = array(
				array(
					'taxonomy' => 'argenta_portfolio_category',
					'terms'    => $projects_category
				)
			);
		}

		$args = array(
			'posts_per_page'	=> intval( $projects_in_block ),
			'offset'			=> 0,
			'category'			=> '',
			'category_name'     => '',
			'orderby'			=> 'date',
			'order'				=> 'DESC',
			'include'			=> '',
			'exclude'			=> '',
			'meta_key'			=> '',
			'meta_value'		=> '',
			'post_type'			=> 'argenta_portfolio',
			'tax_query' 		=> $_tax_query,
			'post_mime_type'	=> '',
			'post_parent'		=> '',
			'author'			=> '',
			'author_name'		=> '',
			'post_status'		=> 'publish',
			'suppress_filters'  => false 
		);
		$projects_data = get_posts( $args );

		$column_class = argenta_extra_parse_VC_columns_to_CSS( $columns_in_row );
		$column_double_class = argenta_extra_parse_VC_columns_to_CSS( $columns_in_row, true );

		$columns_in_row = explode( '-', $columns_in_row );
		if ( is_array( $columns_in_row ) ) {
			$columns_in_row = intval( $columns_in_row[0] );
		}

		// Styling
		$recent_projects_uniqid = uniqid( 'argenta-custom-' );
		$GLOBALS['argenta_pixellove_fonts'][] = 'my-icon-arr-out';
		$slider_class = '';
		if ( $offset_items ) {
			$slider_class .= ' slider-offset';
		}
		if ( $navigation_buttons == 'false' ) {
			$slider_class .= ' full';
		}

		switch ($filter_align) {
			case 'left':
				$filter_align_class = ' text-left';
				break;
			case 'right':
				$filter_align_class = ' text-right';
				break;
			
			default:
				$filter_align_class = '';
				break;
		}

		$items_css = ( $items_gap ) ? 'padding-left: ' . $items_gap . '; padding-right: ' . $items_gap . ';' : '';
		$dots_css = ( $dots_color ) ? 'background-color: ' . $dots_color . '; border-color: ' . $dots_color . ';' : '';
		$filter_css = ( $filter_color ) ? 'color: ' . $filter_color . ';' : '';
		$filter_accent_css = ( $filter_accent_color ) ? 'color: ' . $filter_accent_color . '; border-top-color: ' . $filter_accent_color . ';' : '';

		$with_styles = ( $items_css || $dots_css || $filter_css || $filter_accent_css );


		// Assembling
		ob_start();
		include( 'layout/recent_projects.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
		'name' => __( 'Recent Projects', 'argenta_extra' ),
		'description' => __( 'Recent Argenta portfolio projects', 'argenta_extra' ),
		'base' => 'argenta_sc_recent_projects',
		'category' => __( 'Argenta', 'argenta_extra' ),
		'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-RecentProjects.png',
		'params' => array(
			// General
			array(
				'type' => 'argenta_choose_box',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Projects layout', 'argenta_extra' ),
				'param_name' => 'projects_layout',
				'value' => array(
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon84.png',
						'key' => 'grid',
						'title' => __( 'Grid', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon85.png',
						'key' => 'slider',
						'title' => __( 'Slider', 'argenta_extra' ),
					),
				)
			),
			array(
				'type' => 'argenta_portfolio_types',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Projects category', 'argenta_extra' ),
				'param_name' => 'projects_category',
				'value' => 'all'
			),
			array(
				'type' => 'dropdown',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Card layout type', 'argenta_extra' ),
				'param_name' => 'card_layout',
				'value' => array(
					__( 'Default. Panel text', 'argenta_extra' ) => 'default',
					__( 'Default. "Show now" button', 'argenta_extra' ) => 'default_show_now',
					__( 'Default. Panel text with "Show now" button', 'argenta_extra' ) => 'default_panel_show_now',
					__( 'Default. Description with "Show now" button', 'argenta_extra' ) => 'default_with_description',
					__( 'Inner. "Show now" button', 'argenta_extra' ) => 'inner_show_now',
					__( 'Inner. Panel text', 'argenta_extra' ) => 'inner_panel',
					__( 'Inner. Wide with centred text', 'argenta_extra' ) => 'inner_wide_centred',
					__( 'Inner. Padding with bottom text', 'argenta_extra' ) => 'inner_padding_bottom',
				),
				'dependency' => array(
					'element' => 'projects_layout',
					'value' => array(
						'grid'
					)
				)
			),
			array(
				'type' => 'argenta_columns',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Columns in row', 'argenta_extra' ),
				'param_name' => 'columns_in_row',
				'value' => '4-3-2-1',
				'dependency' => array(
					'element' => 'projects_layout',
					'value' => array(
						'grid'
					)
				)
			),
			array(
				'type' => 'textfield',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Projects in the block', 'argenta_extra' ),
				'param_name' => 'projects_in_block',
				'description' => __( 'Chose number of last projects in the block', 'argenta_extra' ),
				'value' => 12
			),
			array(
				'type' => 'argenta_check',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Items in no-gap grid', 'argenta_extra' ),
				'param_name' => 'projects_solid',
				'description' => __( 'This will make solid grid', 'argenta_extra' ),
				'value' => array(
					__( 'Without paddings', 'argenta_extra' ) => '0'
				),
				'dependency' => array(
					'element' => 'projects_layout',
					'value' => array(
						'grid'
					)
				)
			),
			array(
				'type' => 'argenta_check',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Show categories filter', 'argenta_extra' ),
				'param_name' => 'show_projects_filter',
				'description' => '',
				'value' => array(
					__( 'Yes', 'argenta_extra' ) => '1'
				),
				'dependency' => array(
					'element' => 'projects_layout',
					'value' => array(
						'grid'
					)
				)
			),
			array(
				'type' => 'dropdown',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Filter block align', 'argenta_extra' ),
				'param_name' => 'filter_align',
				'value' => array(
					__( 'Left', 'argenta_extra' ) => 'left',
					__( 'Center', 'argenta_extra' ) => 'center',
					__( 'Right', 'argenta_extra' ) => 'right',
				),
				'std' => 'center',
				'dependency' => array(
					'element' => 'show_projects_filter',
					'value' => array(
						'1'
					)
				)
			),
			array(
				'type' => 'argenta_check',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Open projects in popup', 'argenta_extra' ),
				'param_name' => 'open_in_popup',
				'description' => '',
				'value' => array(
					__( 'Yes', 'argenta_extra' ) => '0'
				),
			),
			array(
				'type' => 'argenta_check',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Loop popup slider', 'argenta_extra' ),
				'param_name' => 'loop_popup_slider',
				'description' => '',
				'value' => array(
					__( 'Yes', 'argenta_extra' ) => '0'
				),
				'dependency' => array(
					'element' => 'open_in_popup',
					'value' => array(
						'1'
					)
				)
			),
			array(
				'type' => 'argenta_check',
				'group' => __( 'General', 'argenta_extra' ),
				'heading' => __( 'Loop slider', 'argenta_extra' ),
				'param_name' => 'loop',
				'value' => array(
					__( 'Yes', 'argenta_extra' ) => '1'
				),
				'dependency' => array(
					'element' => 'projects_layout',
					'value' => array(
						'slider'
					)
				)
			),

			// Items
			array(
				'type' => 'argenta_check',
				'group' => __( 'Items', 'argenta_extra' ),
				'heading' => __( 'Offset slider items', 'argenta_extra' ),
				'param_name' => 'offset_items',
				'value' => array(
					__( 'Yes', 'argenta_extra' ) => '0'
				),
				'dependency' => array(
					'element' => 'projects_layout',
					'value' => array(
						'slider'
					)
				)
			),
			array(
				'type' => 'textfield',
				'group' => __( 'Items', 'argenta_extra' ),
				'heading' => __( 'How many items to display on desktop', 'argenta_extra' ),
				'param_name' => 'item_desktop',
				'description' => __( 'Default value &mdash; 5 items.', 'argenta_extra' ),
				'dependency' => array(
					'element' => 'projects_layout',
					'value' => array(
						'slider'
					)
				)
			),
			array(
				'type' => 'textfield',
				'group' => __( 'Items', 'argenta_extra' ),
				'heading' => __( 'How many items to display on tablet', 'argenta_extra' ),
				'param_name' => 'item_tablet',
				'description' => __( 'Default value &mdash; 3 items.', 'argenta_extra' ),
				'dependency' => array(
					'element' => 'projects_layout',
					'value' => array(
						'slider'
					)
				)
			),
			array(
				'type' => 'textfield',
				'group' => __( 'Items', 'argenta_extra' ),
				'heading' => __( 'How many items to display on mobile', 'argenta_extra' ),
				'param_name' => 'item_mobile',
				'description' => __( 'Default value &mdash; 1 items.', 'argenta_extra' ),
				'dependency' => array(
					'element' => 'projects_layout',
					'value' => array(
						'slider'
					)
				)
			),
			array(
				'type' => 'textfield',
				'group' => __( 'Items', 'argenta_extra' ),
				'heading' => __( 'Items gap', 'argenta_extra' ),
				'param_name' => 'items_gap',
				'description' => __( 'Gap between items (css value).', 'argenta_extra' ),
				'dependency' => array(
					'element' => 'projects_layout',
					'value' => array(
						'slider'
					)
				)
			),

			// Pagination
			array(
				'type' => 'argenta_check',
				'group' => __( 'Pagination', 'argenta_extra' ),
				'heading' => __( 'Navigation dots', 'argenta_extra' ),
				'param_name' => 'pagination_show',
				'value' => array(
					__( 'Show', 'argenta_extra' ) => '1'
				),
				'dependency' => array(
					'element' => 'projects_layout',
					'value' => array(
						'slider'
					)
				)
			),
			array(
				'type' => 'argenta_check',
				'group' => __( 'Pagination', 'argenta_extra' ),
				'heading' => __( 'Navigation buttons', 'argenta_extra' ),
				'param_name' => 'navigation_buttons',
				'value' => array(
					__( 'Show', 'argenta_extra' ) => '0'
				),
				'dependency' => array(
					'element' => 'projects_layout',
					'value' => array(
						'slider'
					)
				)
			),

			// Scroll
			array(
				'type' => 'textfield',
				'group' => __( 'Slide', 'argenta_extra' ),
				'heading' => __( 'Slide by', 'argenta_extra' ),
				'param_name' => 'slide_by',
				'description' => __( 'Navigation slide by x. `page` string can be set to slide by page.', 'argenta_extra' ),
				'dependency' => array(
					'element' => 'projects_layout',
					'value' => array(
						'slider'
					)
				)
			),
			array(
				'type' => 'argenta_check',
				'group' => 'Slide',
				'heading' => __( 'Scroll per page', 'argenta_extra' ),
				'param_name' => 'scroll_per_page',
				'description' => __( 'Scroll per page not per item. This affect next/prev buttons and mouse/touch dragging.', 'argenta_extra' ),
				'value' => array(
					__( 'Yes', 'argenta_extra' ) => '1'
				),
				'dependency' => array(
					'element' => 'projects_layout',
					'value' => array(
						'slider'
					)
				)
			),
			array(
				'type' => 'argenta_check',
				'group' => __( 'Slide', 'argenta_extra' ),
				'heading' => __( 'Autoplay', 'argenta_extra' ),
				'param_name' => 'autoplay',
				'value' => array(
					__( 'Yes', 'argenta_extra' ) => '1'
				),
				'dependency' => array(
					'element' => 'projects_layout',
					'value' => array(
						'slider'
					)
				)
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

			// Style
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Filter text color', 'argenta_extra' ),
				'param_name' => 'filter_color'
			),
			array(
				'type' => 'colorpicker',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Filter accent color', 'argenta_extra' ),
				'param_name' => 'filter_accent_color'
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
				'type' => 'textfield',
				'group' => __( 'Styles and colors', 'argenta_extra' ),
				'heading' => __( 'Custom CSS class', 'argenta_extra' ),
				'param_name' => 'css_class',
				'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class, and then use this class in your custom CSS.', 'argenta_extra' ),
			),
		)
	) );
?>