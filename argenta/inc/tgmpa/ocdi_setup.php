<?php

function argenta_lh_ocdi_import_files() {
	return array(
		array(
			'import_file_name' => 'Personal',
			'categories' => array( esc_html__( 'Personal', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/04/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/04/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/04/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/04/preview.jpg',
		),
		array(
			'import_file_name' => 'Personal Portfolio',
			'categories' => array( esc_html__( 'Personal', 'argenta' ), esc_html__( 'Portfolio', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/15/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/15/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/15/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/15/preview.jpg',
		),
		array(
			'import_file_name' => 'Caffe',
			'categories' => array( esc_html__( 'Multipurpose', 'argenta' ), esc_html__( 'Business', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/21/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/21/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/21/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/21/preview.jpg',
		),
		array(
			'import_file_name' => 'Digital Agency',
			'categories' => array( esc_html__( 'Business', 'argenta' ), esc_html__( 'Multipurpose', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/01/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/01/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/01/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/01/preview.jpg',
		),
		array(
			'import_file_name' => 'Traditional Shop',
			'categories' => array( esc_html__( 'Shop', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/02/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/02/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/02/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/02/preview.jpg',
		),
		array(
			'import_file_name' => 'Grid Portfolio',
			'categories' => array( esc_html__( 'Portfolio', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/03/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/03/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/03/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/03/preview.jpg',
		),
		array(
			'import_file_name' => 'Corporate Business',
			'categories' => array( esc_html__( 'Business', 'argenta' ), esc_html__( 'Multipurpose', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/12/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/12/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/12/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/12/preview.jpg',
		),
		array(
			'import_file_name' => 'Classic Blog',
			'categories' => array( esc_html__( 'Blog', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/05/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/05/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/05/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/05/preview.jpg',
		),
		array(
			'import_file_name' => 'Creative Portfolio',
			'categories' => array( esc_html__( 'Portfolio', 'argenta' ), esc_html__( 'Multipurpose', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/06/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/06/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/06/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/06/preview.jpg',
		),
		array(
			'import_file_name' => 'Personal Simple',
			'categories' => array( esc_html__( 'Personal', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/07/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/07/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/07/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/07/preview.jpg',
		),
		array(
			'import_file_name' => 'Trendy Shop',
			'categories' => array( esc_html__( 'Shop', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/08/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/08/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/08/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/08/preview.jpg',
		),
		array(
			'import_file_name' => 'Personal Blog',
			'categories' => array( esc_html__( 'Personal', 'argenta' ), esc_html__( 'Blog', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/09/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/09/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/09/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/09/preview.jpg',
		),
		array(
			'import_file_name' => 'Creative Agency',
			'categories' => array( esc_html__( 'Business', 'argenta' ), esc_html__( 'Multipurpose', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/11/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/11/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/11/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/11/preview.jpg',
		),
		array(
			'import_file_name' => 'Photographer Gallery',
			'categories' => array( esc_html__( 'Portfolio', 'argenta' ), esc_html__( 'Personal', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/10/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/10/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/10/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/10/preview.jpg',
		),
		array(
			'import_file_name' => 'Mobile App',
			'categories' => array( esc_html__( 'Business', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/16/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/16/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/16/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/16/preview.jpg',
		),
		array(
			'import_file_name' => 'Health Center',
			'categories' => array( esc_html__( 'Business', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/17/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/17/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/17/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/17/preview.jpg',
		),
		array(
			'import_file_name' => 'Restaurant & Caffe',
			'categories' => array( esc_html__( 'Business', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/13/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/13/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/13/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/13/preview.jpg',
		),
		array(
			'import_file_name' => 'Sports & Fitness',
			'categories' => array( esc_html__( 'Business', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/14/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/14/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/14/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/14/preview.jpg',
		),
		array(
			'import_file_name' => 'Barber Vintage',
			'categories' => array( esc_html__( 'Business', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/18/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/18/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/18/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/18/preview.jpg',
		),
		array(
			'import_file_name' => 'Startup Simple',
			'categories' => array( esc_html__( 'Business', 'argenta' ), esc_html__( 'Multipurpose', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/19/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/19/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/19/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/19/preview.jpg',
		),
		array(
			'import_file_name' => 'Coming Soon',
			'categories' => array( esc_html__( 'Multipurpose', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/20/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/20/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/20/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/20/preview.jpg',
		),
		/*array(
			'import_file_name' => 'Partially: About Pages',
			'categories' => array( esc_html__( 'Partially', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/contact_forms/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/contact_forms/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/contact_forms/preview.jpg',
		),
		array(
			'import_file_name' => 'Partially: Contact Us Pages',
			'categories' => array( esc_html__( 'Partially', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/contact_forms/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/contact_forms/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/contact_forms/preview.jpg',
		),
		array(
			'import_file_name' => 'Partially: Team Pages',
			'categories' => array( esc_html__( 'Partially', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/contact_forms/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/contact_forms/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/contact_forms/preview.jpg',
		),
		array(
			'import_file_name' => 'Partially: Services Pages',
			'categories' => array( esc_html__( 'Partially', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/contact_forms/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/contact_forms/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/contact_forms/preview.jpg',
		),
		array(
			'import_file_name' => 'Partially: Contact Forms 7 Forms',
			'categories' => array( esc_html__( 'Partially', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/contact_forms/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/contact_forms/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/contact_forms/preview.jpg',
		),
		array(
			'import_file_name' => 'Partially: Portfolio Projects',
			'categories' => array( esc_html__( 'Partially', 'argenta' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/contact_forms/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/contact_forms/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/contact_forms/preview.jpg',
		),*/
	);
}

add_filter( 'pt-ocdi/import_files', 'argenta_lh_ocdi_import_files' );


function argenta_lh_ocdi_after_import_setup( $selected_import ) {
	global $wpdb;

	$front_page_id = get_page_by_title( str_replace( esc_html( '&' ), 'n', $selected_import['import_file_name'] ) );

	if ( $selected_import['import_file_name'] === 'Classic Blog' ) { // i dont know why
		$front_page_id = get_page_by_title( 'Blog Classic' );
	}

	if ( isset( $front_page_id ) and is_object( $front_page_id ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
	}

	// Set menu
	$main_menu = wp_get_nav_menus();
	if ( is_array( $main_menu ) && count( $main_menu ) > 0 ) {
		$main_menu = $main_menu[0];
	}
	if ( is_object( $main_menu ) ) {
		$locations = get_theme_mod('nav_menu_locations');
		$locations['primary'] = $main_menu->term_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}

	// VC background images links update
	$site_url = explode( '//', get_site_url() )[1];
	$wpdb->query( $wpdb->prepare( 'UPDATE ' . $wpdb->postmeta . ' SET meta_value = REPLACE( meta_value, \'{{this_domain}}\', %s )', $site_url ) );
	$wpdb->query( $wpdb->prepare( 'UPDATE ' . $wpdb->posts . ' SET post_content = REPLACE( post_content, \'{{this_domain}}\', %s )', $site_url ) );
}

add_action( 'pt-ocdi/after_import', 'argenta_lh_ocdi_after_import_setup' );