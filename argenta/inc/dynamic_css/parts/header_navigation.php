<?php
/*
	Header navigation custom style
	
	Table of contents: (you can use search)
	# 1. Variables
	# 2. Background color
	# 3. Header menu typography
	# 4. Border state
	# 4.1. Border type
	# 4.2. Border color
	# 5. Header height
	# 6. Site name typography
	# 7. View
*/


# 1. Variables

use \Argenta\Settings	as ArSett;
use \Argenta\Layout		as ArLay;
use \Argenta\Helper		as ArHelp;

$background_color 	= false;
$header_typo 		= false;
$border_hide 		= false;
$border_type 		= false;
$border_color 		= false;
$header_height 		= false;
$sitename_typo 		= false;

$background_color_css 	= '';
$background_color_css_border = '';
$header_typo_css 		= '';
$border_css 			= '';
$header_height_css 		= '';
$sitename_typo_css 		= '';


# 2. Background color

if ( ArSett::get( 'header_menu_style_settings' ) == 'custom' ) {
	$background_color = ArSett::get( 'header_menu_background_color' );
} else {
	if ( ArSett::page_is( 'ecommerce' ) ) {
		if ( ArSett::get( 'woocommerce_header_menu_style_settings' ) == 'custom' ) {
			$background_color = ArSett::get( 'woocommerce_header_menu_background_color', 'global' );
		} else {
			$background_color = ArSett::get( 'header_menu_background_color', 'global' );
		}
	} else {
		$background_color = ArSett::get( 'header_menu_background_color', 'global' );
	}
}

if ( $background_color ) {
	$background_color_css = 'background-color:' . $background_color . ';';
}


# 3. Header menu typography

if ( ArSett::get( 'header_menu_style_settings' ) == 'custom' ) {
	$header_typo = ArSett::get( 'header_menu_text_typo' );
} else {
	if ( ArSett::page_is( 'ecommerce' ) ) {
		if ( ArSett::get( 'woocommerce_header_menu_style_settings' ) == 'custom' ) {
			$header_typo = ArSett::get( 'woocommerce_header_menu_text_typo', 'global' );
		} else {
			$header_typo = ArSett::get( 'header_menu_text_typo', 'global' );
		}
	} else {
		$header_typo = ArSett::get( 'header_menu_text_typo', 'global' );
	}
}

$header_typo_css = ArHelp::parse_acf_typo_to_css( $header_typo );
$background_color_css_border = ArHelp::parse_acf_typo_to_css( $header_typo, array( 'rule' => 'include', 'fields' => array( 'color' ) ) );
$background_color_css_border = str_replace( 'color', 'background-color', $background_color_css_border );

# 4. Border state

if ( ArSett::get( 'header_menu_style_settings' ) == 'custom' ) {
	$border_hide = ArSett::get( 'header_menu_hide_border' );
} else {
	if ( ArSett::page_is( 'ecommerce' ) ) {
		if ( ArSett::get( 'woocommerce_header_menu_style_settings' ) == 'custom' ) {
			$border_hide = ArSett::get( 'woocommerce_header_menu_hide_border', 'global' );
		} else {
			$border_hide = ArSett::get( 'header_menu_hide_border', 'global' );
			$border_hide = ( $border_hide ) ? 'yes' : 'no';
		}
	} else {
		$border_hide = ArSett::get( 'header_menu_hide_border', 'global' );
		$border_hide = ( $border_hide ) ? 'yes' : 'no';
	}
}

$border_hide = ( bool ) ( $border_hide == 'yes' );

if ( $border_hide ) {
	$border_css .= 'border:none;';
}

# 4.1. Border type

if ( ! $border_hide ) {
	if ( ArSett::get( 'header_menu_style_settings' ) == 'custom' ) {
		$border_type = ArSett::get( 'header_menu_border_type' );
	} else {
		if ( ArSett::page_is( 'ecommerce' ) ) {
			if ( ArSett::get( 'woocommerce_header_menu_style_settings' ) == 'custom' ) {
				$border_type = ArSett::get( 'woocommerce_header_menu_border_type', 'global' );
			} else {
				$border_type = ArSett::get( 'header_menu_border_type', 'global' );
			}
		} else {
			$border_type = ArSett::get( 'header_menu_border_type', 'global' );
		}
	}

	if ( $border_type ) {
		$border_css .= 'border-bottom-style:' . $border_type . ';';
	}
}


# 4.2. Border color

if ( ! $border_hide ) {
	if ( ArSett::get( 'header_menu_style_settings' ) == 'custom' ) {
		$border_color = ArSett::get( 'header_menu_border_color' );
	} else {
		if ( ArSett::page_is( 'ecommerce' ) ) {
			if ( ArSett::get( 'woocommerce_header_menu_style_settings' ) == 'custom' ) {
				$border_color = ArSett::get( 'woocommerce_header_menu_border_color', 'global' );
			} else {
				$border_color = ArSett::get( 'header_menu_border_color', 'global' );
			}
		} else {
			$border_color = ArSett::get( 'header_menu_border_color', 'global' );
		}
	}

	if ( $border_color ) {
		$border_css .= 'border-bottom-color:' . $border_color . ';';
	}
}


# 5. Header height

if ( ArSett::get( 'header_menu_style_settings' ) == 'custom' ) {
	$header_height = ArSett::get( 'header_menu_height' );
} else {
	if ( ArSett::page_is( 'ecommerce' ) ) {
		if ( ArSett::get( 'woocommerce_header_menu_style_settings' ) == 'custom' ) {
			$header_height = ArSett::get( 'woocommerce_header_menu_height', 'global' );
		} else {
			$header_height = ArSett::get( 'header_menu_height', 'global' );
		}
	} else {
		$header_height = ArSett::get( 'header_menu_height', 'global' );
	}
}

if ( $header_height ) {
	$header_height_css .= 'height:' . $header_height . 'px;';
	$header_height_css .= 'max-height:' . $header_height . 'px;';
	$header_height_css .= 'line-height:' . $header_height . 'px;';
}


# 6. Site name typography

if ( ArSett::get( 'header_logo_style' ) == 'sitename' ) {
	$sitename_typo = ArSett::get( 'header_menu_sitename_typo' );
} elseif ( in_array( ArSett::get( 'header_logo_style' ), array( 'inherit', NULL ) ) ) {
	if ( ArSett::page_is( 'ecommerce' ) ) {
		if ( ArSett::get( 'woocommerce_header_logo_style', 'global' ) == 'sitename' ) {
			$sitename_typo = ArSett::get( 'woocommerce_header_sitename_typo', 'global' );
		} elseif ( in_array( ArSett::get( 'woocommerce_header_logo_style', 'global' ), array( 'inherit', NULL ) ) ) {
			if ( ArSett::get( 'logo_type', 'global' ) == 'sitename' ) {
				$sitename_typo = ArSett::get( 'header_menu_logo_typo', 'global' );
			}
		}
	} else {
		if ( ArSett::get( 'logo_type', 'global' ) == 'sitename' ) {
			$sitename_typo = ArSett::get( 'header_menu_logo_typo', 'global' );
		}
	}
}

$sitename_typo_css = ArHelp::parse_acf_typo_to_css( $sitename_typo );


# 7. View
if ( $background_color_css || $header_typo_css ) {
	// --- start of CSS ---
	$_style_block = '#masthead.site-header a,.site-header.header-1,.site-header.header-2,.site-header.header-4,.site-header.header-5,.site-header.header-6,#masthead.site-header.header-3 .header-wrap,.menu-other > li .submenu,#mega-menu-wrap > ul ul.sub-menu, #mega-menu-wrap > ul ul.sub-sub-menu{';
	$_style_block .= $header_typo_css;
	$_style_block .= '}';

	$_style_block .= '.site-header.header-fixed.header-1,.site-header.header-fixed.header-2,.site-header.header-fixed.header-3,.site-header.header-fixed.header-4,.site-header.header-fixed.header-5,.site-header.header-fixed.header-6,#masthead.header-fixed .header-wrap,.header-fixed .menu-other > li .submenu, .header-fixed #mega-menu-wrap >  ul.sub-sub-menu,.hamburger-menu .btn-toggle{';
	$_style_block .= $header_typo_css;
	$_style_block .= '}';

	$_style_block .= '@media screen and (max-width: 1024px) { #masthead .header-wrap{';
	$_style_block .= $background_color_css;
	$_style_block .= $header_typo_css;
	$_style_block .= '}}';

	if ( $background_color_css_border ) {
		$_style_block .= '.hamburger-menu .btn-lines::after,.hamburger-menu .btn-lines::before,#masthead .hamburger-menu .btn-lines{';
		$_style_block .= $background_color_css_border;
		$_style_block .= '}';
	}

	// background
	$_style_block .= '.site-header.header-2,.site-header.header-4,.site-header.header-5,.site-header.header-6,#masthead.site-header.header-3 .header-wrap,.menu-other > li .submenu,#mega-menu-wrap > ul ul.sub-menu,.site-header.header-fixed.header-2,.site-header.header-fixed.header-3,.site-header.header-fixed.header-4,.site-header.header-fixed.header-5,.site-header.header-fixed.header-6,#masthead.header-fixed .header-wrap,.header-fixed .menu-other > li .submenu,#mega-menu-wrap > ul ul.sub-menu, #mega-menu-wrap > ul ul.sub-sub-menu,.header-fixed #mega-menu-wrap > ul ul.sub-menu,.header-fixed #mega-menu-wrap > ul ul.sub-sub-menu{';
	$_style_block .= $background_color_css;
	$_style_block .= '}';
	// --- end of CSS ---
	ArLay::append_to_dynamic_css_buffer( $_style_block );
}

if ( $border_css ) {
	// --- start of CSS ---
	$_style_block = '.site-header{';
	$_style_block .= $border_css;
	$_style_block .= '}';
	// --- end of CSS ---
	ArLay::append_to_dynamic_css_buffer( $_style_block );
}

if ( $header_height_css ) {
	// --- start of CSS ---
	$_style_block = '#masthead.site-header,#masthead.site-header .header-wrap{';
	$_style_block .= $header_height_css;
	$_style_block .= '}';
	// --- end of CSS ---
	ArLay::append_to_dynamic_css_buffer( $_style_block );
}

if ( $sitename_typo_css ) {
	// --- start of CSS ---
	$_style_block = '#masthead.site-header .site-title a,.fullscreen-navigation .site-title,.fullscreen-navigation .site-title a{';
	$_style_block .= $sitename_typo_css;
	$_style_block .= '}';
	// --- end of CSS ---
	ArLay::append_to_dynamic_css_buffer( $_style_block );
}