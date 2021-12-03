<?php
/*
	Other elements custom style
	
	Table of contents: (you can use search)
	# 1. Variables
	# 2. "Go top" arrow background color
	# 3. Preloader shape color
	# 3.1. Preloader background color
	# 4. Portfolio filter text color
	# 4.1. Accent color
	# 5. View
*/


# 1. Variables

use \Argenta\Settings	as ArSett;
use \Argenta\Layout		as ArLay;
use \Argenta\Helper		as ArHelp;

$go_top_background 		= false;
$preloader_color 		= false;
$preloader_background 	= false;
$portfolio_page_text 	= false;
$portfolio_page_accent 	= false;

$go_top_background_css 		= '';
$preloader_color_css 		= '';
$preloader_background_css 	= '';
$portfolio_page_text_css 	= '';
$portfolio_page_accent_css 	= '';


# 2. "Go top" arrow background color

$go_top_background = ArSett::get( 'page_arrow_color', 'global' );

if ( $go_top_background ) {
	$go_top_background_css = 'background-color:' . $go_top_background . ';';
}


# 3. Preloader shape color

$preloader_color = ArSett::get( 'preloader_shapes_color', 'global' );

if ( $preloader_color ) {
	$preloader_color_css = 'border-color:' . $preloader_color . ';'; // ?
}


# 3.1. Preloader background color

$preloader_background = ArSett::get( 'preloader_background_color', 'global' );

if ( $preloader_background ) {
	$preloader_background_css = 'background-color:' . $preloader_background . ';';
}


# 4. Portfolio filter text color

$portfolio_page_text = ArSett::get( 'project_filter_text_color' );

if ( $portfolio_page_text ) {
	$portfolio_page_text_css = 'color:' . $portfolio_page_text  .';';
}


# 4.1. Accent color

$portfolio_page_accent = ArSett::get( 'project_filter_accent_color' );

if ( $portfolio_page_accent ) {
	$portfolio_page_accent_css = 'color:' . $portfolio_page_accent  .';border-color:' . $portfolio_page_accent . ';';
}


# 5. View

if ( $preloader_color_css ) {
	// --- start of CSS ---
	$_style_block = '.page-preloader .loader::before,.page-preloader .loader::after{';
	$_style_block .= $preloader_color_css;
	$_style_block .= '}';
	// --- end of CSS ---
	ArLay::append_to_dynamic_css_buffer( $_style_block );
}

if ( $preloader_background_css ) {
	// --- start of CSS ---
	$_style_block = '.page-preloader{';
	$_style_block .= $preloader_background_css;
	$_style_block .= '}';
	// --- end of CSS ---
	ArLay::append_to_dynamic_css_buffer( $_style_block );
}

if ( $go_top_background_css ) {
	// --- start of CSS ---
	$_style_block = '.scroll-top{';
	$_style_block .= 'opacity:.6;';
	$_style_block .= $go_top_background_css;
	$_style_block .= '}';
	$_style_block .= '.scroll-top:hover{';
	$_style_block .= 'opacity:.9;';
	$_style_block .= $go_top_background_css;
	$_style_block .= '}';
	// --- end of CSS ---
	ArLay::append_to_dynamic_css_buffer( $_style_block );
}

if ( $portfolio_page_text_css ) {
	// --- start of CSS ---
	$_style_block = '.portfolio-sorting ul.unstyled li a,';
	$_style_block .= '.portfolio-sorting ul.unstyled li a:hover{';
	$_style_block .= $portfolio_page_text_css;
	$_style_block .= '}';
	// --- end of CSS ---
	ArLay::append_to_dynamic_css_buffer( $_style_block );
}

if ( $portfolio_page_accent_css ) {
	// --- start of CSS ---
	$_style_block = '.portfolio-sorting .title,';
	$_style_block .= '.portfolio-sorting ul.unstyled li a.active{';
	$_style_block .= $portfolio_page_accent_css;
	$_style_block .= '}';
	// --- end of CSS ---
	ArLay::append_to_dynamic_css_buffer( $_style_block );
}


