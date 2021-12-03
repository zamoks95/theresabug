<?php
/*
	Page custom style
	
	Table of contents: (you can use search)
	# 1. Variables
	# 2. Background color
	# 3. Background image
	# 3.1. Background size
	# 3.2. Background position
	# 3.3. Background repeat
	# 3.4. Background attachment
	# 4. Full width container margins
	# 5. View
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
$background_attachment	= false;
$full_width_margins		= false;

$background_color_css 		= '';
$background_image_css 		= '';
$background_size_css 		= '';
$background_position_css 	= '';
$background_repeat_css 		= '';
$background_attachment_css 	= '';
$full_width_margins_css 	= '';


# 2. Background color

if ( ArSett::page_is( 'single' ) ) {
	$background_color = ArSett::get( 'post_page_background' );
	if ( ! $background_color && in_array( ArSett::get( 'post_page_background_type' ), array( 'inherit', NULL ) ) ) {
		$background_color = ArSett::get( 'page_background_color', 'global' );
	}
} elseif ( ArSett::page_is( 'ecommerce' ) ) {
	$background_color = ArSett::get( 'page_background_color' );
	if ( ! $background_color && in_array( ArSett::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		$background_color = ArSett::get( 'woocommerce_page_background_color', 'global' );
		if ( ! $background_color && in_array( ArSett::get( 'woocommerce_page_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
			$background_color = ArSett::get( 'page_background_color', 'global' );
		}
	}
} elseif ( ArSett::page_is( 'project' ) ) {
	$background_color = ArSett::get( 'page_background_color' );
	if ( ! $background_color && in_array( ArSett::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		// Need more settings!
		$background_color = ArSett::get( 'page_background_color', 'global' );
	}
} else {
	$background_color = ArSett::get( 'page_background_color' );
	if ( ! $background_color && in_array( ArSett::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		$background_color = ArSett::get( 'page_background_color', 'global' );
	}
}

if ( $background_color ) {
	$background_color_css = 'background-color:' . $background_color . ';';
}


# 3. Background image

if ( ArSett::page_is( 'single' ) ) {
	if ( ArSett::get( 'post_page_background_type' ) == 'custom' ) {
		$background_image = ArSett::get( 'post_page_background_image' );
	} elseif ( in_array( ArSett::get( 'post_page_background_type' ), array( 'inherit', NULL ) ) ) {
		// Need more settings!
		$background_image = ArSett::get( 'page_background_image', 'global' );
	}
} elseif ( ArSett::page_is( 'ecommerce' ) ) {
	if ( ArSett::get( 'page_background_type' ) == 'custom' ) {
		$background_image = ArSett::get( 'page_background_image' );
	} elseif ( in_array( ArSett::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		if ( ArSett::get( 'woocommerce_page_background_type' ) == 'custom' ) {
			$background_image = ArSett::get( 'woocommerce_page_background_image', 'global' );
		} elseif ( in_array( ArSett::get( 'woocommerce_page_background_type' ), array( 'inherit', NULL ) ) ) {
			$background_image = ArSett::get( 'page_background_image', 'global' );
		}
	}
} elseif ( ArSett::page_is( 'project' ) ) {
	if ( ArSett::get( 'page_background_type' ) == 'custom' ) {
		$background_image = ArSett::get( 'page_background_image' );
	} elseif ( in_array( ArSett::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		// Need more settings!
		$background_image = ArSett::get( 'page_background_image', 'global' );
	}
} else {
	if ( ArSett::get( 'page_background_type' ) == 'custom' ) {
		$background_image = ArSett::get( 'page_background_image' );
	} elseif ( in_array( ArSett::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		$background_image = ArSett::get( 'page_background_image', 'global' );
	}
}

if ( $background_image ) {
	$background_image_css = 'background-image:url(\'' . $background_image . '\');';
}


# 3.1. Background image size

if ( ArSett::page_is( 'single' ) ) {
	if ( ArSett::get( 'post_page_background_type' ) == 'custom' ) {
		$background_size = ArSett::get( 'post_page_background_size' );
	} elseif ( in_array( ArSett::get( 'post_page_background_type' ), array( 'inherit', NULL ) ) ) {
		// Need more settings!
		$background_size = ArSett::get( 'page_background_size', 'global' );
	}
} elseif ( ArSett::page_is( 'ecommerce' ) ) {
	if ( ArSett::get( 'page_background_type' ) == 'custom' ) {
		$background_size = ArSett::get( 'page_background_size' );
	} elseif ( in_array( ArSett::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		if ( ArSett::get( 'woocommerce_page_background_type', 'global' ) == 'custom' ) {
			$background_size = ArSett::get( 'woocommerce_page_background_size', 'global' );
		} elseif ( in_array( ArSett::get( 'woocommerce_page_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
			$background_size = ArSett::get( 'page_background_size', 'global' );
		}
	}
} elseif ( ArSett::page_is( 'project' ) ) {
	if ( ArSett::get( 'page_background_type' ) == 'custom' ) {
		$background_size = ArSett::get( 'page_background_size' );
	} elseif ( in_array( ArSett::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		// Need more settings!
		$background_size = ArSett::get( 'page_background_size', 'global' );
	}
} else {
	if ( ArSett::get( 'page_background_type' ) == 'custom' ) {
		$background_size = ArSett::get( 'page_background_size' );
	} elseif ( in_array( ArSett::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		$background_size = ArSett::get( 'page_background_size', 'global' );
	}
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

if ( $background_size == 'auto' || $background_size == 'contain' ) {
	if ( ArSett::page_is( 'single' ) ) {
		if ( ArSett::get( 'post_page_background_type' ) == 'custom' ) {
			$background_position = ArSett::get( 'post_page_background_position' );
		} elseif ( in_array( ArSett::get( 'post_page_background_type' ), array( 'inherit', NULL ) ) ) {
			// Need more settings!
			$background_position = ArSett::get( 'page_background_position', 'global' );
		}
	} elseif ( ArSett::page_is( 'ecommerce' ) ) {
		if ( ArSett::get( 'page_background_type' ) == 'custom' ) {
			$background_position = ArSett::get( 'page_background_position' );
		} elseif ( in_array( ArSett::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
			if ( ArSett::get( 'woocommerce_page_background_type' ,'global' ) == 'custom' ) {
				$background_position = ArSett::get( 'woocommerce_page_background_position', 'global' );
			} elseif ( in_array( ArSett::get( 'woocommerce_page_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
				$background_position = ArSett::get( 'page_background_position', 'global' );
			}
		}
	} elseif ( ArSett::page_is( 'project' ) ) {
		if ( ArSett::get( 'page_background_type' ) == 'custom' ) {
			$background_position = ArSett::get( 'page_background_position' );
		} elseif ( in_array( ArSett::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
			// Need more settings!
			$background_position = ArSett::get( 'page_background_position', 'global' );
		}
	} else {
		if ( ArSett::get( 'page_background_type' ) == 'custom' ) {
			$background_position = ArSett::get( 'page_background_position' );
		} elseif ( in_array( ArSett::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
			$background_position = ArSett::get( 'page_background_position', 'global' );
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
}


# 3.3. Background image repeat

if ( $background_size == 'auto' || $background_size == 'contain' ) {
	if ( ArSett::page_is( 'single' ) ) {
		if ( ArSett::get( 'post_page_background_type' ) == 'custom' ) {
			$background_repeat = ArSett::get( 'post_page_background_repeat' );
		} elseif ( in_array( ArSett::get( 'post_page_background_type' ), array( 'inherit', NULL ) ) ) {
			// Need more settings!
			$background_repeat = ArSett::get( 'page_background_position', 'global' );
		}
	} elseif ( ArSett::page_is( 'ecommerce' ) ) {
		if ( ArSett::get( 'page_background_type' ) == 'custom' ) {
			$background_repeat = ArSett::get( 'page_background_repeat' );
		} elseif ( in_array( ArSett::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
			if ( ArSett::get( 'woocommerce_page_background_type' ,'global' ) == 'custom' ) {
				$background_repeat = ArSett::get( 'woocommerce_page_background_repeat', 'global' );
			} elseif ( in_array( ArSett::get( 'woocommerce_page_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
				$background_repeat = ArSett::get( 'page_background_repeat', 'global' );
			}
		}
	} elseif ( ArSett::page_is( 'project' ) ) {
		if ( ArSett::get( 'page_background_type' ) == 'custom' ) {
			$background_repeat = ArSett::get( 'page_background_repeat' );
		} elseif ( in_array( ArSett::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
			// Need more settings!
			$background_repeat = ArSett::get( 'page_background_repeat', 'global' );
		}
	} else {
		if ( ArSett::get( 'page_background_type' ) == 'custom' ) {
			$background_repeat = ArSett::get( 'page_background_repeat' );
		} elseif ( in_array( ArSett::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
			$background_repeat = ArSett::get( 'page_background_repeat', 'global' );
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
}


# 3.4. Background image attachment

if ( ArSett::page_is( 'single' ) ) {
	if ( ArSett::get( 'post_page_background_type' ) == 'custom' ) {
		$background_attachment = ArSett::get( 'post_page_attach_background' );
	} elseif ( in_array( ArSett::get( 'post_page_background_type' ), array( 'inherit', NULL ) ) ) {
		// Need more settings!
		$background_attachment = ArSett::get( 'page_background_attach', 'global' );
	}
} elseif ( ArSett::page_is( 'ecommerce' ) ) {
	if ( ArSett::get( 'page_background_type' ) == 'custom' ) {
		$background_attachment = ArSett::get( 'page_background_is_attached' );
	} elseif ( in_array( ArSett::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		if ( ArSett::get( 'woocommerce_page_background_type', 'global' ) == 'custom' ) {
			$background_attachment = ArSett::get( 'woocommerce_page_background_is_attached', 'global' );
		} elseif ( in_array( ArSett::get( 'woocommerce_page_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
			$background_attachment = ArSett::get( 'page_background_attach', 'global' );
		}
	}
} elseif ( ArSett::page_is( 'project' ) ) {
	if ( ArSett::get( 'page_background_type' ) == 'custom' ) {
		$background_attachment = ArSett::get( 'page_background_is_attached' );
	} elseif ( in_array( ArSett::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		// Need more settings!
		$background_attachment = ArSett::get( 'page_background_attach', 'global' );
	}
} else {
	if ( ArSett::get( 'page_background_type' ) == 'custom' ) {
		$background_attachment = ArSett::get( 'page_background_is_attached' );
	} elseif ( in_array( ArSett::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		$background_attachment = ArSett::get( 'page_background_attach', 'global' );
	}
}

if ( $background_attachment ) {
	$background_attachment_css = 'background-attachment:fixed;';
}


# 4. Full width container margins

$full_width_margins = ArSett::get( 'full_width_margins_type' );
if ( $full_width_margins == 'custom' ) {
	$full_width_margins = ArSett::get( 'full_width_margins_size' );
} else {
	$full_width_margins = ArSett::get( 'full_width_margins_size', 'global' );
}

if ( $full_width_margins ) {
	$full_width_margins_css = 'margin-left:' . $full_width_margins . ';margin-right:' . $full_width_margins . ';';
}


# 5. View

if ( $background_color_css || $background_image_css || $background_size_css || $background_position_css 
	|| $background_repeat_css || $background_attachment_css ) {
	// --- start of CSS ---
	$_style_block = 'body .site-content{';
	$_style_block .= $background_color_css;
	$_style_block .= $background_image_css;
	$_style_block .= $background_size_css;
	$_style_block .= $background_position_css;
	$_style_block .= $background_repeat_css;
	$_style_block .= $background_attachment_css;
	$_style_block .= '}';
	// --- end of CSS ---
	ArLay::append_to_dynamic_css_buffer( $_style_block );
}

if ( $full_width_margins_css ) {
	// --- start of CSS ---
	$_style_block = '.full-width-container{';
	$_style_block .= $full_width_margins_css;
	$_style_block .= '}';
	// --- end of CSS ---
	ArLay::append_to_dynamic_css_buffer( $_style_block );
}
