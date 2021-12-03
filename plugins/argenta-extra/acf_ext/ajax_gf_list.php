<?php

add_action( 'wp_ajax_argenta_get_font', 'argenta_gf_get_font' );

function argenta_gf_get_font() {
	include_once( plugin_dir_path( __FILE__ ) . 'gf_list.php' );
	foreach ( $argenta_gf_object->items as $font_object ) {
		if ( $font_object->family == $_POST['font_family'] ) {
			echo json_encode( $font_object );
		}
	}
	wp_die();
}