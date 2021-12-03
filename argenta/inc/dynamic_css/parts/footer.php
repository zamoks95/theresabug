<?php
/*
	Footer custom style
	
	Table of contents: (you can use search)
	# 1. Variables
	# 2. Background color
	# 3. Background image
	# 3.1. Background image size
	# 3.2. Background image position
	# 3.3. Background image repeat
	# 4. Text color
	# 5. Widget logo site name typography
	# 6. Copyright background color
	# 7. Copyright text color
	# 8. View
*/


# 1. Variables

use \Argenta\Settings	as ArSett;
use \Argenta\Layout		as ArLay;
use \Argenta\Helper		as ArHelp;

$background_color 		= false;
$background_image 		= false;
$background_size 		= false;
$background_position 	= false;
$background_repeat 		= false;
$text_color 			= false;
$footer_sitename_typo 	= false;
$copyright_background 	= false;
$copyright_text_color 	= false;

$background_color_css 		= '';
$background_image_css 		= '';
$background_size_css 		= '';
$background_position_css 	= '';
$background_repeat_css 		= '';
$text_color_css 			= '';
$footer_sitename_typo_css 	= '';
$copyright_background_css 	= '';
$copyright_text_color_css 	= '';


# 2. Background color

if ( in_array( ArSett::get( 'footer_background_type' ), array( 'inherit', NULL ) ) ) {
	if ( ArSett::page_is( 'ecommerce' ) ) {
		if ( in_array( ArSett::get( 'woocommerce_footer_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
			$background_color = ArSett::get( 'footer_background_color', 'global' );
		} else {
			$background_color = ArSett::get( 'woocommerce_footer_background_color', 'global' );
		}
	} else {
		$background_color = ArSett::get( 'footer_background_color', 'global' );
	}
} else {
	$background_color = ArSett::get( 'footer_background_color' );
}

if ( $background_color ) {
	$background_color_css = 'background-color:' . $background_color . ';';
}


# 3. Background image

if ( in_array( ArSett::get( 'footer_background_type' ), array( 'inherit', NULL ) ) ) {
	if ( ArSett::page_is( 'ecommerce' ) ) {
		if ( in_array( ArSett::get( 'woocommerce_footer_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
			$background_image = ArSett::get( 'footer_background_image', 'global' );
		} else {
			$background_image = ArSett::get( 'woocommerce_footer_background_image', 'global' );
		}
	} else {
		$background_image = ArSett::get( 'footer_background_image', 'global' );
	}
} else {
	$background_image = ArSett::get( 'footer_background_image' );
}

if ( $background_image ) {
	$background_image_css = 'background-image:url(\'' . $background_image . '\');';
}


# 3.1. Background image size

if ( in_array( ArSett::get( 'footer_background_type' ), array( 'inherit', NULL ) ) ) {
	if ( ArSett::page_is( 'ecommerce' ) ) {
		if ( in_array( ArSett::get( 'woocommerce_footer_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
			$background_size = ArSett::get( 'footer_background_size', 'global' );
		} else {
			$background_size = ArSett::get( 'woocommerce_footer_background_size', 'global' );
		}
	} else {
		$background_size = ArSett::get( 'footer_background_size', 'global' );
	}
} else {
	$background_size = ArSett::get( 'footer_background_size' );
}

switch ( $background_size ) {
	case 'auto':
		$background_size_css = 'background-size:auto;';
		break;
	case 'cover':
		$background_size_css = 'background-size:cover;';
		break;
	case 'contain':
		$background_size_css = 'background-size:contain;';
		break;
	case '100per':
		$background_size_css = 'background-size:100% 100%;';
		break;
}


# 3.2. Background image position

if ( in_array( $background_size, array( 'auto', 'contain' ) ) ) {
	if ( in_array( ArSett::get( 'footer_background_type' ), array( 'inherit', NULL ) ) ) {
		if ( ArSett::page_is( 'ecommerce' ) ) {
			if ( in_array( ArSett::get( 'woocommerce_footer_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
				$background_position = ArSett::get( 'footer_background_position', 'global' );
			} else {
				$background_position = ArSett::get( 'woocommerce_footer_background_position', 'global' );
			}
		} else {
			$background_position = ArSett::get( 'footer_background_position', 'global' );
		}
	} else {
		$background_position = ArSett::get( 'footer_background_position' );
	}
}

if ( $background_position ) {
	switch ( $background_position ) {
		case 'left_top':
			$background_position_css = 'background-position:left top;';
			break;
		case 'left_center':
			$background_position_css = 'background-position:left center;';
			break;
		case 'left_bottom':
			$background_position_css = 'background-position:left bottom;';
			break;
		case 'center_top':
			$background_position_css = 'background-position:center top;';
			break;
		case 'center':
			$background_position_css = 'background-position:center center;';
			break;
		case 'center_right':
			$background_position_css = 'background-position:center bottom;';
			break;
		case 'right_top':
			$background_position_css = 'background-position:right top;';
			break;
		case 'right_center':
			$background_position_css = 'background-position:right center;';
			break;
		case 'right_bottom':
			$background_position_css = 'background-position:right bottom;';
			break;
	}
}


# 3.3. Background image repeat

if ( in_array( $background_size, array( 'auto', 'contain' ) ) ) {
	if ( in_array( ArSett::get( 'footer_background_type' ), array( 'inherit', NULL ) ) ) {
		if ( ArSett::page_is( 'ecommerce' ) ) {
			if ( in_array( ArSett::get( 'woocommerce_footer_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
				$background_repeat = ArSett::get( 'footer_background_repeat', 'global' );
			} else {
				$background_repeat = ArSett::get( 'woocommerce_footer_background_repeat', 'global' );
			}
		} else {
			$background_repeat = ArSett::get( 'footer_background_repeat', 'global' );
		}
	} else {
		$background_repeat = ArSett::get( 'footer_background_repeat' );
	}
}

if ( $background_repeat ) {
	switch ( $background_repeat ) {
		case 'repeat':
			$background_repeat_css = 'background-repeat: repeat;';
			break;
		case 'no_repeat':
			$background_repeat_css = 'background-repeat: no-repeat;';
			break;
		case 'repeat_x':
			$background_repeat_css = 'background-repeat: repeat-x;';
			break;
		case 'repeat_y':
			$background_repeat_css = 'background-repeat: repeat-y;';
			break;
	}
}


# 4. Text color

$text_color = ArSett::get( 'footer_text_color' );
if ( ! $text_color ) {
	if ( ArSett::page_is( 'ecommerce' ) ) {
		$text_color = ArSett::get( 'woocommerce_footer_text_color', 'global' );
		if ( ! $text_color ) {
			$text_color = ArSett::get( 'footer_text_color', 'global' );
		}
	} else {
		$text_color = ArSett::get( 'footer_text_color', 'global' );
	}
}

if ( $text_color ) {
	$text_color_css = 'color:' . $text_color . ';';
}


# 5. Widget logo site name typography

if ( ArSett::get( 'footer_logo_widget_type' ) == 'sitename' ) {
	$footer_sitename_typo = ArSett::get( 'footer_sitename_typo' );
} elseif ( in_array( ArSett::get( 'footer_logo_widget_type' ), array( 'inherit', NULL ) ) ) {
	if ( ArSett::page_is( 'ecommerce' ) ) {
		if ( ArSett::get( 'woocommerce_footer_widget_logo_type', 'global' ) == 'sitename' ) {
			$footer_sitename_typo = ArSett::get( 'woocommerce_footer_sitename_typo', 'global' );
		} elseif ( in_array( ArSett::get( 'woocommerce_footer_widget_logo_type', 'global' ), array( 'inherit', NULL ) ) ) {
			$footer_sitename_typo = ArSett::get( 'footer_logo_font_typo', 'global' );
		}
	} else {
		$footer_sitename_typo = ArSett::get( 'footer_logo_font_typo', 'global' );
	}
}

$footer_sitename_typo_css = ArHelp::parse_acf_typo_to_css( $footer_sitename_typo );


# 6. Copyright background color

$copyright_background = ArSett::get( 'footer_copyright_section_background' );
if ( ! $copyright_background ) {
	if ( ArSett::page_is( 'ecommerce' ) ) {
		$copyright_background = ArSett::get( 'woocommerce_footer_copyright_section_background', 'global' );
		if ( ! $copyright_background ) {
			$copyright_background = ArSett::get( 'footer_copyright_background_color', 'global' );
		}
	} else {
		$copyright_background = ArSett::get( 'footer_copyright_background_color', 'global' );
	}
}

if ( $copyright_background ) {
	$copyright_background_css = 'background-color:' . $copyright_background . ';';
}


# 7. Copyright text color

$copyright_text_color = ArSett::get( 'footer_copyright_section_text_color' );
if ( ! $copyright_text_color ) {
	if ( ArSett::page_is( 'ecommerce' ) ) {
		$copyright_text_color = ArSett::get( 'woocommerce_footer_copyright_section_text_color', 'global' );
		if ( ! $copyright_text_color ) {
			$copyright_text_color = ArSett::get( 'footer_copyright_text_color', 'global' );
		}
	} else {
		$copyright_text_color = ArSett::get( 'footer_copyright_text_color', 'global' );
	}
}

if ( $copyright_text_color ) {
	$copyright_text_color_css = 'color:' . $copyright_text_color . ';';
}


# 8. View

if ( $background_color_css || $background_image_css || $background_size_css 
		|| $background_position_css || $background_repeat_css || $text_color_css ) {
	// --- start of CSS ---
	$_style_block = 'footer.site-footer{';
	$_style_block .= $background_color_css;
	$_style_block .= $background_image_css;
	$_style_block .= $background_size_css;
	$_style_block .= $background_position_css;
	$_style_block .= $background_repeat_css;
	$_style_block .= $text_color_css;
	$_style_block .= '}';

	$_style_block .= '.site-footer .widget_text,.site-footer .widgettitle,.site-footer .widgets .list-box-icon,.site-footer .widgets .list-box-icon span.icon,.site-footer .widgets a,.site-footer .widget_argenta_widget_recent_posts ul.recent-posts-list .content-wrap p,.site-footer .widget_argenta_widget_recent_posts ul.recent-posts-list .content-wrap .date,.site-footer .widgets .socialbar a.social.outline span,.site-footer .widgets .socialbar a.social.outline:hover span,.site-footer .widget_argenta_widget_subscribe input,.site-footer .widget_argenta_widget_subscribe input::placeholder{';
	$_style_block .= $text_color_css;
	$_style_block .= '}';
	// --- end of CSS ---
	ArLay::append_to_dynamic_css_buffer( $_style_block );
}

if ( $copyright_background_css || $copyright_text_color_css ) {
	// --- start of CSS ---
	$_style_block = 'footer.site-footer .site-info,footer.site-footer .site-info a{';
	$_style_block .= $copyright_background_css;
	$_style_block .= $copyright_text_color_css;
	$_style_block .= '}';
	// --- end of CSS ---
	ArLay::append_to_dynamic_css_buffer( $_style_block );
}

if ( $footer_sitename_typo_css ) {
	// --- start of CSS ---
	$_style_block = 'footer.site-footer .widget_argenta_widget_logo .theme-logo a h3{';
	$_style_block .= $footer_sitename_typo_css;
	$_style_block .= '}';
	// --- end of CSS ---
	ArLay::append_to_dynamic_css_buffer( $_style_block );
}