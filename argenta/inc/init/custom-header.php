<?php

function cbrio_init_custom_header() {
	add_theme_support( 'custom-header', apply_filters( 'argenta_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'argenta_lh_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'cbrio_init_custom_header' );

if ( ! function_exists( 'argenta_lh_header_style' ) ) {

	function argenta_lh_header_style() {
		// Thats all
	}

}