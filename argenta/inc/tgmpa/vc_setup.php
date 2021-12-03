<?php

function argenta_lh_vc_set_as_theme() {
	vc_set_default_editor_post_types( array(
		'page',
		'post',
		'custom_post_type',
		'argenta_portfolio'
	) );
	vc_set_as_theme();
}

add_action( 'vc_before_init', 'argenta_lh_vc_set_as_theme' );


if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
	$vc_template_dir = get_stylesheet_directory() . '/inc/vc_templates';
	vc_set_shortcodes_templates_dir( $vc_template_dir );
}

/*
function argenta_lh_vc_remove_frontend_links() {
    vc_disable_frontend(); // this will disable frontend editor
}

add_action( 'vc_after_init', 'argenta_lh_vc_remove_frontend_links' );
*/

//function argenta_lh_vc_remove_wp_admin_bar_button() {
//    remove_action( 'admin_bar_menu', array( vc_frontend_editor(), 'adminBarEditLink' ), 1000 );
//}
//
//add_action( 'vc_after_init', 'argenta_lh_vc_remove_wp_admin_bar_button' );
