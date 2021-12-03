<?php
/*
	Breadcrumbs custom style
	
	Table of contents: (you can use search)
	# 1. Variables
	# 2. Background color
	# 3. Text color
	# 4. View
*/


# 1. Variables

use \Argenta\Settings	as ArSett;
use \Argenta\Layout		as ArLay;
use \Argenta\Helper		as ArHelp;

$background_color 	= false;
$text_color 		= false;

$background_color_css 	= '';
$text_color_css 		= '';


# 2. Background color

if ( ArSett::page_is( 'single' ) ) {
	if ( ArSett::get( 'post_breadcrumbs_background_color' ) ) {
		$background_color = ArSett::get( 'post_breadcrumbs_background_color' );
	} else {
		$background_color = ArSett::get( 'breadcrumbs_background_color', 'global' );
	}
} else {
	if ( ArSett::get( 'breadcrumbs_background_color' ) ) {
		$background_color = ArSett::get( 'breadcrumbs_background_color' );
	} else {
		$background_color = ArSett::get( 'breadcrumbs_background_color', 'global' );
	}
}

if ( $background_color ) {
	$background_color_css = 'background-color:' . $background_color . ';';
}


# 3. Text color

if ( ArSett::page_is( 'single' ) ) {
	if ( ArSett::get( 'post_breadcrumbs_text_color' ) ) {
		$text_color = ArSett::get( 'post_breadcrumbs_text_color' );
	} else {
		$text_color = ArSett::get( 'breadcrumbs_text_color', 'global' );
	}
} else {
	if ( ArSett::get( 'breadcrumbs_background_color' ) ) {
		$text_color = ArSett::get( 'breadcrumbs_text_color' );
	} else {
		$text_color = ArSett::get( 'breadcrumbs_text_color', 'global' );
	}
}

if ( $text_color ) {
	$text_color_css = 'color:' . $text_color . ';';
}


# 4. View

if ( $background_color_css || $text_color_css ) {
	// --- start of CSS ---
	$_style_block = '.breadcrumbs{';
	$_style_block .= $background_color_css;
	$_style_block .= $text_color_css;
	$_style_block .= '}';
	// --- end of CSS ---
	ArLay::append_to_dynamic_css_buffer( $_style_block );
}