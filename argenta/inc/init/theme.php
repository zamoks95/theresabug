<?php

if ( ! function_exists( 'argenta_setup' ) ) :

	function argenta_setup() {
		load_theme_textdomain( 'argenta', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'woocommerce' );
		set_post_thumbnail_size( 200, 200, true );
		add_image_size( 'argenta_thumbnail_next_and_prev', 200, 140, true );

		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'argenta' ),
		) );

		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
		add_theme_support( 'post-formats', array( 'video', 'gallery', 'audio', 'quote' ) );

		$GLOBALS['content_width'] = apply_filters( 'argenta_content_width', 640 );
		
		$GLOBALS['argenta_google_fonts'] = array();
		$GLOBALS['argenta_pixellove_fonts'] = array();
		$GLOBALS['cbrio_required_scripts'] = array();

		if ( ! get_option( 'argenta_version' ) || get_option( 'argenta_version' ) < 200 ) {
			add_option( 'argenta_version', 200, '', 'yes' );
		}
		if ( isset( $_GET['argenta_migrate_notification'] ) && $_GET['argenta_migrate_notification'] == 'hide' && ( ! get_option( 'argenta_migrate_notification' ) || get_option( 'argenta_migrate_notification' ) != 'hidden' ) ) {
			add_option( 'argenta_migrate_notification', 'hidden', '', 'yes' );
		}

		if ( get_option( 'argenta_version' ) > 0 && get_option( 'argenta_version' ) < 200
				&& ( ! get_option( 'argenta_migrate_notification' ) || get_option( 'argenta_migrate_notification' ) != 'hidden' )
				&& ( ! isset( $_GET['argenta_migrate_notification'] ) || $_GET['argenta_migrate_notification'] != 'hide' ) ) {
			add_action( 'admin_notices', 'argenta_admin_notice_migrate_to_2_0' );
		}


// Adding support for core block visual styles.
        add_theme_support( 'wp-block-styles' );

        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );

        // Add support for custom color scheme.
//        add_theme_support( 'disable-custom-colors' );


        $brand_color = \Argenta\Settings::get( 'page_brand_color', 'global' );

        if(!$brand_color){
            $brand_color = '#987f71';
        }

        add_theme_support( 'editor-color-palette', array(
            array(
                'name'  => __( 'Brand color', 'argenta' ),
                'slug'  => 'brand-color',
                'color' => $brand_color,
            ),
            array(
                'name'  => __( 'Beige Dark', 'argenta' ),
                'slug'  => 'beige_dark',
                'color' => '#987f71',
            ),
            array(
                'name'  => __( 'Dark Strong', 'argenta' ),
                'slug'  => 'dark_strong',
                'color' => '#24262B',
            ),
            array(
                'name'  => __( 'Dark Light', 'argenta' ),
                'slug'  => 'dark_light',
                'color' => '#32353C',
            ),
            array(
                'name'  => __( 'Grey Strong', 'argenta' ),
                'slug'  => 'grey_strong',
                'color' => '#6A707E',
            ),
            array(
                'name'  => __( 'Grey Light', 'argenta' ),
                'slug'  => 'grey_light',
                'color' => '#949597',
            ),
        ) );


        // Add support for custom sizes
        // add_theme_support('disable-custom-font-sizes');
        add_theme_support( 'editor-font-sizes', array(
            array(
                'name' => __( 'Extra Small', 'argenta' ),
                'size' => 12,
                'slug' => 'extra-small'
            ),
            array(
                'name' => __( 'Small', 'argenta' ),
                'size' => 13,
                'slug' => 'small'
            ),
            array(
                'name' => __( 'Normal', 'argenta' ),
                'size' => 14,
                'slug' => 'normal'
            ),
            array(
                'name' => __( 'Large', 'argenta' ),
                'size' => 17,
                'slug' => 'large'
            ),
            array(
                'name' => __( 'Extra Large', 'argenta' ),
                'size' => 20,
                'slug' => 'larger'
            )
        ) );

        // Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

        // Add editor styles support
        add_editor_style( '/assets/style_editor/style-editor.css' );
		add_theme_support('editor-styles');
	}

endif;

add_action( 'after_setup_theme', 'argenta_setup' );


function argenta_admin_notice_migrate_to_2_0() {
    global $wp;

	$message = '<p><strong>Argenta 2.0 Now! Totally Reworked to be Awesome!</strong></p>';

	$message .= '<p>Check out more demos, more features, more optimizations and more impressions.<br>Make your site even better by migrate to the new version.</p>';

	$message .= '<p class="links">';

	$params = $_GET;
    unset( $params['argenta_migrate_notification'] );
    $params['argenta_migrate_notification'] = 'hide';
	$message .= '<a class="button-primary" href="https://colabrio.ticksy.com/article/11111/" target="_blank">Migrate to Argenta 2.0</a> ';
	$message .= '<a class="button-primary" href="https://colabrio.ticksy.com/article/11109" target="_blank">Return Old Version</a> ';
	$message .= '<a class="button-secondary" href="' . basename( $wp->request ) . '?' . http_build_query( $params ) . '" onclick="jQuery(this).closest(\'.argenta-admin-notif\').slideUp(500);">Hide Message</a>';
	$message .= '</p>';

	echo '<div class="notice notice-warning argenta-admin-notif" style="background: #F7F7F7 url(\'' . get_template_directory_uri() . '/images/migrate_notifi_1_1.jpg\') center right no-repeat; background-size: auto 110%;">' . $message . '</div>';
}