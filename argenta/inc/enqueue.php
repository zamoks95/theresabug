<?php

function argenta_lh_admin_style() {
	wp_enqueue_style( "admin_styles", get_template_directory_uri() . "/assets/css/admin_styles.css" );
	wp_enqueue_style( "ionicons_font", get_template_directory_uri() . "/assets/css/ionicons.min.css" );
	wp_enqueue_style( 'select2css', get_template_directory_uri() . '/assets/css/select2.min.css' );
	wp_enqueue_script( 'select2', get_template_directory_uri() . '/assets/js/libs/select2.min.js' );
	wp_enqueue_script( "admin_scripts", get_template_directory_uri() . "/assets/js/admin.js" );
}

add_action( "admin_head", "argenta_lh_admin_style" );


// Styles including
function argenta_lh_enqueue_own_styles() {
	wp_enqueue_style( 'argenta-style', get_stylesheet_uri(), array(), '2.0.28' );
	wp_enqueue_style( 'argenta-grid', get_template_directory_uri() . '/assets/css/grid.min.css', false );
	get_template_part( 'inc/dynamic_css/index' );
}

add_action( 'wp_enqueue_scripts', 'argenta_lh_enqueue_own_styles' );


function argenta_lh_enqueue_own_styles_secondary() {
	wp_enqueue_style( 'aos', get_template_directory_uri() . '/assets/css/aos.css', false );
	wp_enqueue_style( 'ionicons', get_template_directory_uri() . '/assets/css/ionicons.min.css', false );
}

add_action( 'wp_footer', 'argenta_lh_enqueue_own_styles_secondary' );


// Scripts including
function argenta_lh_enqueue_own_scripts() {
	if ( get_field( 'global_page_smooth_scroll', 'option' ) ) {
		argenta_gh_add_required_script( 'smooth-scroll' );
	}

	$google_fonts_string = \Argenta\Helper::parse_google_fonts_to_query_string( $GLOBALS['argenta_google_fonts'] );
	if ( $google_fonts_string ) {
		wp_enqueue_style( 'argenta-global-fonts', $google_fonts_string, array(), '1.0.0' );
	}

	wp_enqueue_script( 'masonry', get_template_directory_uri() . '/assets/js/masonry.pkgd.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'aos', get_template_directory_uri() . '/assets/js/libs/aos.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/js/libs/isotope.pkgd.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'underscore', get_template_directory_uri() . '/assets/js/libsunderscore.js', array( 'jquery' ), false, true);
	wp_enqueue_script( 'jquery-mega-menu', get_template_directory_uri() . '/assets/js/libs/jquery.mega-menu.min.js', array( 'jquery' ), false, true);
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'argenta-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '1.0.0', true );
	wp_enqueue_script( 'argenta-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '1.0.0', true  );
	wp_enqueue_script( 'argenta-select', get_template_directory_uri() . '/assets/js/select.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'argenta-social-share', get_template_directory_uri() . '/assets/js/social-share.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/libs/owl.carousel.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'argenta-gallery', get_template_directory_uri() . '/assets/js/gallery.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'argenta-portfolio-gallery', get_template_directory_uri() . '/assets/js/portfolio-gallery.js', array( 'jquery' ), false, true );
	

	if ( argenta_gh_is_script_required( 'argenta-login' ) ) { // AJAX Login & Register
		wp_enqueue_script( 'argenta-login', get_template_directory_uri() . '/assets/js/argenta-login.js', array('jquery'), false, true );
		wp_localize_script( 'argenta-login', 'argenta_login_obj', array( 'url' => admin_url( 'admin-ajax.php' ) ) );
	}
	if ( argenta_gh_is_script_required( 'smooth-scroll' ) ) { // smooth scroll
		wp_enqueue_script( 'scroll-smooth', get_template_directory_uri() . '/assets/js/libs/scroll-smooth.min.js', array('jquery'), false, true );
	}
	if ( argenta_gh_is_script_required( 'multiscroll' ) ) { // multiscreen
		wp_enqueue_script( 'multiscroll', get_template_directory_uri() . '/assets/js/libs/jquery.multiscroll.min.js', array( 'jquery' ), '1.0.0', true );
	}
	if ( argenta_gh_is_script_required( 'accordion' ) ) { // accordions
		wp_enqueue_script( 'argenta-accordion', get_template_directory_uri() . '/assets/js/accordion.js', array( 'jquery' ), '1.0.0', true );
	}
	if ( argenta_gh_is_script_required( 'counter-box' ) ) { // counter box
		wp_enqueue_script( 'argenta-counter-box', get_template_directory_uri() . '/assets/js/counter-box.js', array( 'jquery' ), '1.0.0', true );
	}
	if ( argenta_gh_is_script_required( 'chart-box' ) ) { // chart box
		wp_enqueue_script( 'jquery-easypiechart', get_template_directory_uri() . '/assetsjs/libs/jquery.easypiechart.min.js', array('jquery'), false, true );
		wp_enqueue_script( 'argenta-chart-box', get_template_directory_uri() . '/assets/js/chart-box.js', array( 'jquery' ), '1.0.0', true );
	}
	if ( argenta_gh_is_script_required( 'video' ) ) { // video popup
		wp_enqueue_script( 'argenta-video-popup', get_template_directory_uri() . '/assets/js/video-popup.js', array( 'jquery' ), '1.0.0', true );
	}
	if ( argenta_gh_is_script_required( 'tabs' ) ) { // tabs
		wp_enqueue_script( 'argenta-tab-box', get_template_directory_uri() . '/assets/js/tabs.js', array( 'jquery' ), '1.0.0', true );
	}
	if ( argenta_gh_is_script_required( 'progress-bar' ) ) { // progress bar
		wp_enqueue_script( 'argenta-progress-bar', get_template_directory_uri() . '/assets/js/progress-bar.js', array( 'jquery' ), '1.0.0', true );
	}
	if ( argenta_gh_is_script_required( 'countdown-box' ) ) { // count box
		wp_enqueue_script( 'jquery-countdown', get_template_directory_uri() . '/assets/js/libs/jquery.countdown.min.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'argenta-countdown-box', get_template_directory_uri() . '/assets/js/countdown-box.js', array( 'jquery' ), '1.0.0', true );
	}
	if ( argenta_gh_is_script_required( 'cover-box' ) ) { // cover box
		wp_enqueue_script( 'argenta-cover-box', get_template_directory_uri() . '/assets/js/cover-box.js', array( 'jquery' ), '1.0.0', true );
	}
	if ( argenta_gh_is_script_required( 'project-scroll' ) ) { // project page scroll
		wp_enqueue_script( 'argenta-scroll-content', get_template_directory_uri() . '/assets/js/scroll-content.js', array( 'jquery' ), '1.0.0', true );
	}
	if ( argenta_gh_is_script_required( 'one-page-scroll' ) ) { // one page scroll
		wp_enqueue_script( 'page-scroll', get_template_directory_uri() . '/assets/js/libs/jquery.onepage-scroll.min.js', array( 'jquery' ), '1.0.0', true );
	}
	if ( ( isset( $GLOBALS['argenta_use_map'] ) && $GLOBALS['argenta_use_map'] ) || argenta_gh_is_script_required( 'google-maps' ) ) { // Google Maps
		$api_key = '';
		if ( function_exists( 'get_field' ) ) {
			$settings_api_key = get_field( 'global_google_maps_api_key', 'option' );
		} else {
            $settings_api_key = get_option('options_global_google_maps_api_key');
            if (empty($settings_api_key)) {
                $settings_api_key = false;
            }
		}
		if ( $settings_api_key ) {
			$api_key = $settings_api_key;
		}
		wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=' . urlencode( esc_attr( $api_key ) ), false, NULL, true);
	}
	wp_enqueue_script( 'argenta-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), false, true );
}

add_action( 'wp_footer', 'argenta_lh_enqueue_own_scripts' );


// Pixellove icons in footer
function argenta_lh_pixellove_fonts() {
	$pixellove_fonts = argenta_gh_parse_pixellove_fonts( $GLOBALS['argenta_pixellove_fonts'] );

	if ( $pixellove_fonts ) {
		foreach ($pixellove_fonts as $key => $value) {
			wp_enqueue_style( 'fonts_pack_' . $key, $value, array(), '2.0.0' );
		}
	}
}

add_action( 'wp_footer', 'argenta_lh_pixellove_fonts' );