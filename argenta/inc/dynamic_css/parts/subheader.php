<?php
/*
	Subheader custom style
	
	Table of contents: (you can use search)
	# 1. Variables
	# 2. Background color
	# 3. Typography
	# 4. Subheader height
	# 5. View
*/


# 1. Variables

use \Argenta\Settings	as ArSett;
use \Argenta\Layout		as ArLay;
use \Argenta\Helper		as ArHelp;

$subheader_background 	= false;
$subheader_typo 		= false;
$subheader_height 		= false;

$subheader_background_css 	= '';
$subheader_typo_css 		= '';
$subheader_height_css 		= '';


# 2. Background color

if ( ArSett::get( 'header_menu_contacts_bar_style' ) == 'custom' ) {
	$subheader_background = ArSett::get( 'header_menu_contacts_bar_background' );
} else {
	if ( ArSett::page_is( 'ecommerce' ) ) {
		if ( ArSett::get( 'woocommerce_header_menu_contacts_bar_style' ) == 'custom' ) {
			$subheader_background = ArSett::get( 'woocommerce_header_menu_contacts_bar_background', 'global' );
		} else {
			$subheader_background = ArSett::get( 'header_menu_contacts_bar_background', 'global' );
		}
	} else {
		$subheader_background = ArSett::get( 'header_menu_contacts_bar_background', 'global' );
	}
}

if ( $subheader_background ) {
	$subheader_background_css = 'background-color:' . $subheader_background . ';';
}


# 3. Typography

if ( ArSett::get( 'header_menu_contacts_bar_style' ) == 'custom' ) {
	$subheader_typo = ArSett::get( 'header_menu_contacts_bar_text_typo' );
} else {
	if ( ArSett::page_is( 'ecommerce' ) ) {
		if ( ArSett::get( 'woocommerce_header_menu_contacts_bar_style' ) == 'custom' ) {
			$subheader_typo = ArSett::get( 'woocommerce_header_menu_contacts_bar_text_typo', 'global' );
		} else {
			$subheader_typo = ArSett::get( 'header_menu_contacts_bar_text_typo', 'global' );
		}
	} else {
		$subheader_typo = ArSett::get( 'header_menu_contacts_bar_text_typo', 'global' );
	}
}

$subheader_typo_css = ArHelp::parse_acf_typo_to_css( $subheader_typo );


# 4. Subheader height

if ( ArSett::get( 'header_menu_contacts_bar_style' ) == 'custom' ) {
	$subheader_height = ArSett::get( 'header_menu_contacts_bar_height' );
} else {
	if ( ArSett::page_is( 'ecommerce' ) ) {
		if ( ArSett::get( 'woocommerce_header_menu_contacts_bar_style' ) == 'custom' ) {
			$subheader_height = ArSett::get( 'woocommerce_header_menu_contacts_bar_height', 'global' );
		} else {
			$subheader_height = ArSett::get( 'subheader_height', 'global' );
		}
	} else {
		$subheader_height = ArSett::get( 'subheader_height', 'global' );
	}
}

if ( $subheader_height ) {
	$subheader_height_css  = 'height:' . $subheader_height . 'px;';
	$subheader_height_css .= 'max-height:' . $subheader_height . 'px;';
	$subheader_height_css .= 'line-height:' . $subheader_height . 'px;';
}


# 5. View


if ( $subheader_background || $subheader_typo ) {
	// --- start of CSS ---
	$_style_block = '.subheader, .subheader .subheader-contacts .icon,.subheader a, .subheader .social-bar li a{';
	$_style_block .= $subheader_background_css;
	$_style_block .= $subheader_typo_css;
	$_style_block .= '}';
	// --- end of CSS ---
	ArLay::append_to_dynamic_css_buffer( $_style_block );
}


if ( $subheader_height_css ) {
	// --- start of CSS ---
	$_style_block = '.subheader,.subheader .content,.subheader .social-bar li a{';
	$_style_block .= $subheader_height_css;
	$_style_block .= '}';
	// --- end of CSS ---
	ArLay::append_to_dynamic_css_buffer( $_style_block );
}



