<?php
/*
	Header title custom style
	
	Table of contents: (you can use search)
	# 1. Variables
	# 2. Background color
	# 3. Background image
	# 3.1. Background image size
	# 3.2. Background image position
	# 3.3. Background image repeat
	# 4. Title settings
	# 5. Subtitle settings
	# 6. Overlay color
	# 7. Header title height
	# 8. View
*/


# 1. Variables

use \Argenta\Settings	as ArSett;
use \Argenta\Layout		as ArLay;
use \Argenta\Helper		as ArHelp;

$header_title_height 	= false;
$background_color 		= false;
$background_image 		= false;
$background_size 		= false;
$background_position 	= false;
$background_repeat 		= false;
$title_typo				= false;
$subtitle_typo 			= false;
$overlay_color 			= false;

$background_color_css 	= '';
$background_image_css 	= '';
$background_size_css 	= '';
$background_position_css = '';
$background_repeat_css 	= '';
$title_typo_css 		= '';
$subtitle_typo_css 		= '';
$overlay_color_css 		= '';
$header_title_height_css = '';


# 2. Background color
  
if ( ArSett::page_is( 'single' ) ) {
	$background_color = ArSett::get( 'post_title_background_color' );
	if ( ! $background_color && in_array( ArSett::get( 'post_title_background' ), array( 'inherit', NULL ) ) ) { 
		$background_color = ArSett::get( 'post_title_background_color', 'global' );
		if ( ! $background_color && in_array( ArSett::get( 'post_title_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
			$background_color = ArSett::get( 'header_background_color', 'global' );
		}
	}
} elseif ( ArSett::page_is( 'ecommerce' ) ) {
	$background_color = ArSett::get( 'header_background_color' );
	if ( ! $background_color && in_array( ArSett::get( 'header_background_type' ), array( 'inherit', NULL ) ) ) {
		$background_color = ArSett::get( 'woocommerce_header_background_color', 'global' );
		if ( ! $background_color && in_array( ArSett::get( 'woocommerce_header_title_background_type', 'global' ), array( 'inherit', NULL ) ) ) { 
			$background_color = ArSett::get( 'header_background_color', 'global' );
		}
	}
} elseif ( ArSett::page_is( 'project' ) ) {
	$background_color = ArSett::get( 'header_background_color' );
	if ( ! $background_color && in_array( ArSett::get( 'header_background_type' ), array( 'inherit', NULL ) ) ) {
		if ( in_array( ArSett::get( 'portfolio_header_title_type', 'global' ), array( 'inherit', NULL ) ) ) {
			$background_color = ArSett::get( 'header_background_color', 'global' );
		} else {
			$background_color = ArSett::get( 'portfolio_title_background_color', 'global' );
		}
	}
} else {
	$background_color = ArSett::get( 'header_background_color' );
	if ( ! $background_color && in_array( ArSett::get( 'header_background_type' ), array( 'inherit', NULL ) ) ) {
		$background_color = ArSett::get( 'header_background_color', 'global' );
	}
}

if ( $background_color ) {
	$background_color_css = 'background-color:' . $background_color . ';';
}


# 3. Background image

if ( ArSett::page_is( 'single' ) ) {
	switch ( ArSett::get( 'post_title_background' ) ) {
		case 'post_thumbnail':
			$post_thumbnail_images = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail-size', true);
			if ( is_array( $post_thumbnail_images ) ) {
				$background_image = $post_thumbnail_images[0];
			}
			break;
		case 'loaded_image':
			$background_image = ArSett::get( 'post_title_background_image' );
			break;
		case 'inherit':
		default:
			switch ( ArSett::get( 'post_title_background_type', 'global' ) ) {
				case 'post_thumbnail':
					$post_thumbnail_images = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail-size', true);
					if ( is_array( $post_thumbnail_images ) ) {
						$background_image = $post_thumbnail_images[0];
					}
					break;
				case 'loaded_image':
					$background_image = ArSett::get( 'post_title_background_image', 'global' );
					break;
				case 'color':
					$background_image = false;
					break;
				default:
					if ( ArSett::get( 'header_title_background_type', 'global' ) == 'image' ) {
						$background_image = ArSett::get( 'header_title_background_image', 'global' );
					}
					break;
			}
			break;
	}
} elseif ( ArSett::page_is( 'ecommerce' ) ) {
	$_woocommerce_inherit = true;
	if ( ArSett::page_is( 'product_category' ) ) {
		global $wp_query;
		$cat = $wp_query->get_queried_object();
		$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
		if ( $thumbnail_id ) {
			$background_image = wp_get_attachment_url( $thumbnail_id );
			$_woocommerce_inherit = false;
		}
	}
	if ( $_woocommerce_inherit ) {
		if ( ArSett::get( 'header_background_type' ) == 'image' ) {
			$background_image = ArSett::get( 'header_background_image' );
		} elseif ( in_array( ArSett::get( 'header_background_type' ), array( 'inherit', NULL ) ) ) {
			if ( ArSett::get( 'woocommerce_header_title_background_type', 'global' ) == 'image' ) {
				$background_image = ArSett::get( 'woocommerce_header_background_image', 'global' );
			} elseif ( in_array( ArSett::get( 'woocommerce_header_title_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
				if ( ArSett::get( 'header_title_background_type', 'global' ) == 'image' ) {
					$background_image = ArSett::get( 'header_title_background_image', 'global' );
				}
			}
		}
	}
} elseif ( ArSett::page_is( 'project' ) ) {

    if (has_post_thumbnail()) {
        $background_image = get_the_post_thumbnail_url($post, 'full');
    } else {
        if (ArSett::get('header_background_type') == 'image') {
            $background_image = ArSett::get('header_background_image');
        } elseif (in_array(ArSett::get('header_background_type'), array('inherit', NULL))) {
            if (ArSett::get('portfolio_header_title_type', 'global') == 'custom') {
                $background_image = ArSett::get('portfolio_title_background_image', 'global');
            } elseif (in_array(ArSett::get('portfolio_header_title_type', 'global'), array('inherit', NULL))) {
                if (ArSett::get('header_title_background_type', 'global') == 'image') {
                    $background_image = ArSett::get('header_title_background_image', 'global');
                }
            }
        }
    }

} else {
    if (has_post_thumbnail()) {
        $background_image = get_the_post_thumbnail_url($post, 'full');
    } else {
        if (ArSett::get('header_background_type') == 'image') {
            $background_image = ArSett::get('header_background_image');
        } elseif (ArSett::get('header_background_type') == 'inherit'
            || ArSett::get('header_background_type') === NULL) {
            if (ArSett::get('header_title_background_type', 'global') == 'image') {
                $background_image = ArSett::get('header_title_background_image', 'global');
            }
        }
    }
}

if ( $background_image ) {
	$background_image_css = 'background-image:url(\'' . $background_image . '\');';
}


# 3.1. Background image size

if ( ArSett::page_is( 'single' ) ) {
	switch ( ArSett::get( 'post_title_background' ) ) {
		case 'post_thumbnail':
		case 'loaded_image':
		$background_size = ArSett::get( 'post_title_background_size' );
			break;
		case 'color':
	 	$background_size = false;
			break;
		default:
			switch ( ArSett::get( 'post_title_background_type', 'global' ) ) {
				case 'post_thumbnail':
				case 'custom':
					$background_size = ArSett::get( 'post_title_background_size', 'global' );
					break;
				case 'color':
					$background_size = false;
					break;
				default:
					if ( ArSett::get( 'header_title_background_type' == 'image') ) {
						$background_size = ArSett::get( 'header_title_background_size', 'global' );
				}
					break;
			}
			break;
	}
} elseif ( ArSett::page_is( 'ecommerce' ) ) {
	if ( ArSett::get( 'header_background_type' ) == 'image' ) {
		$background_size = ArSett::get( 'header_background_size' );
	} elseif ( ArSett::get( 'header_background_type' ) == 'inherit'
				|| ArSett::get( 'header_background_type' ) === NULL ) {
		if ( ArSett::get( 'woocommerce_header_title_background_type', 'global' ) == 'custom' ) {
			$background_size = ArSett::get( 'woocommerce_header_background_size', 'global' );
		} elseif ( ArSett::get( 'woocommerce_header_title_background_type', 'global' ) == 'inherit'
					|| ArSett::get( 'woocommerce_header_title_background_type', 'global' ) === NULL ) {
			if ( ArSett::get( 'header_title_background_type', 'global' ) == 'image' ) {
				$background_size = ArSett::get( 'header_title_background_size', 'global' );
			}
		}
	}
} elseif ( ArSett::page_is( 'project' ) ) {
	if ( ArSett::get( 'header_background_type' ) == 'image' ) {
		$background_size = ArSett::get( 'header_background_size' );
	} elseif ( in_array( ArSett::get( 'header_background_type' ), array( 'inherit', NULL ) ) ) {
		if ( ArSett::get( 'portfolio_header_title_type', 'global' ) == 'custom' ) {
			$background_size = ArSett::get( 'portfolio_title_background_size', 'global' );
		} elseif ( in_array( ArSett::get( 'portfolio_header_title_type', 'global' ), array( 'inherit', NULL ) ) ) {
			if ( ArSett::get( 'header_title_background_type', 'global' ) == 'image' ) {
				$background_size = ArSett::get( 'header_title_background_size', 'global' );
			}
		}
	}
} else {
	if ( ArSett::get( 'header_background_type' ) == 'image' ) {
		$background_size = ArSett::get( 'header_background_size' );
	} elseif ( in_array( ArSett::get( 'header_background_type' ), array( 'inherit', NULL ) ) ) {
		if ( ArSett::get( 'header_title_background_type', 'global' ) == 'image' ) {
			$background_size = ArSett::get( 'header_title_background_size', 'global' );
		}
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
		switch ( ArSett::get( 'post_title_background' ) ) {
			case 'post_thumbnail':
			case 'loaded_image':
				$background_position = ArSett::get( 'post_title_background_position' );
				break;
			case 'color':
		 		$background_position = false;
				break;
			default:
				switch ( ArSett::get( 'post_title_background_type', 'global' ) ) {
					case 'post_thumbnail':
					case 'custom':
						$background_position = ArSett::get( 'post_title_background_position', 'global' );
						break;
					case 'color':
						$background_position = false;
						break;
					default:
						if ( ArSett::get( 'header_title_background_type' == 'image' ) ) {
							$background_position = ArSett::get( 'header_title_background_position', 'global' );
						}
						break;
				}
				break;
		}
	} elseif ( ArSett::page_is( 'ecommerce' ) ) {
		if ( ArSett::get( 'header_background_type' ) == 'image' ) {
			$background_position = ArSett::get( 'header_background_position' );
		} elseif ( ArSett::get( 'header_background_type' ) == 'inherit'
					|| ArSett::get( 'header_background_type' ) === NULL ) {
			if ( ArSett::get( 'woocommerce_header_title_background_type', 'global' ) == 'custom' ) {
				$background_position = ArSett::get( 'woocommerce_header_background_position', 'global' );
			} elseif ( ArSett::get( 'woocommerce_header_title_background_type', 'global' ) == 'inherit'
						|| ArSett::get( 'woocommerce_header_title_background_type', 'global' ) === NULL ) {
				if ( ArSett::get( 'header_title_background_type', 'global' ) == 'image' ) {
					$background_position = ArSett::get( 'header_background_position', 'global' );
				}
			}
		}
	} elseif ( ArSett::page_is( 'project' ) ) {
		if ( ArSett::get( 'header_background_type' ) == 'image' ) {
			$background_position = ArSett::get( 'header_background_position' );
		} elseif ( in_array( ArSett::get( 'header_background_type' ), array( 'inherit', NULL ) ) ) {
			if ( ArSett::get( 'portfolio_header_title_type', 'global' ) == 'image' ) {
				$background_position = ArSett::get( 'portfolio_title_background_position', 'global' );
			} elseif ( in_array( ArSett::get( 'portfolio_header_title_type', 'global' ), array( 'inherit', NULL ) ) ) {
				if ( ArSett::get( 'header_title_background_type', 'global' ) == 'image' ) {
					$background_position = ArSett::get( 'header_background_position', 'global' );
				}
			}
		}
	} else {
		if ( ArSett::get( 'header_background_type' ) == 'image' ) {
			$background_position = ArSett::get( 'header_background_position' );
		} elseif ( ArSett::get( 'header_background_type' ) == 'inherit'
					|| ArSett::get( 'header_background_type' ) === NULL ) {
			if ( ArSett::get( 'header_title_background_type', 'global' ) == 'image' ) {
				$background_position = ArSett::get( 'header_background_position', 'global' );
			}
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
		switch ( ArSett::get( 'post_title_background' ) ) {
			case 'post_thumbnail':
			case 'loaded_image':
				$background_repeat = ArSett::get( 'post_title_background_repeat' );
				break;
			case 'color':
		 		$background_repeat = false;
				break;
			default:
				switch ( ArSett::get( 'post_title_background_type', 'global' ) ) {
					case 'post_thumbnail':
					case 'custom':
						$background_repeat = ArSett::get( 'post_title_background_repeat', 'global' );
						break;
					case 'color':
						$background_repeat = false;
						break;
					default:
						if ( ArSett::get( 'header_title_background_type' == 'image' ) ) {
							$background_repeat = ArSett::get( 'header_title_background_repeat', 'global' );
						}
						break;
				}
				break;
		}
	} elseif ( ArSett::page_is( 'ecommerce' ) ) {
		if ( ArSett::get( 'header_background_type' ) == 'image' ) {
			$background_repeat = ArSett::get( 'header_background_repeat' );
		} elseif ( ArSett::get( 'header_background_type' ) == 'inherit'
					|| ArSett::get( 'header_background_type' ) === NULL ) {
			if ( ArSett::get( 'woocommerce_header_title_background_type', 'global' ) == 'custom' ) {
				$background_repeat = ArSett::get( 'woocommerce_header_background_repeat', 'global' );
			} elseif ( ArSett::get( 'woocommerce_header_title_background_type', 'global' ) == 'inherit'
						|| ArSett::get( 'woocommerce_header_title_background_type', 'global' ) === NULL ) {
				if ( ArSett::get( 'header_title_background_type', 'global' ) == 'image' ) {
					$background_repeat = ArSett::get( 'header_background_repeat', 'global' );
				}
			}
		}
	} elseif ( ArSett::page_is( 'project' ) ) {
		if ( ArSett::get( 'header_background_type' ) == 'image' ) {
			$background_repeat = ArSett::get( 'header_background_repeat' );
		} elseif ( in_array( ArSett::get( 'header_background_type' ), array( 'inherit', NULL ) ) ) {
			if ( ArSett::get( 'portfolio_header_title_type', 'global' ) == 'image' ) {
				$background_repeat = ArSett::get( 'portfolio_title_background_repeat', 'global' );
			} elseif ( in_array( ArSett::get( 'portfolio_header_title_type', 'global' ), array( 'inherit', NULL ) ) ) {
				if ( ArSett::get( 'header_title_background_type', 'global' ) == 'image' ) {
					$background_repeat = ArSett::get( 'header_background_repeat', 'global' );
				}
			}
		}
	} else {
		if ( ArSett::get( 'header_background_type' ) == 'image' ) {
			$background_repeat = ArSett::get( 'header_background_repeat' );
		} elseif ( ArSett::get( 'header_background_type' ) == 'inherit'
					|| ArSett::get( 'header_background_type' ) === NULL ) {
			if ( ArSett::get( 'header_title_background_type', 'global' ) == 'image' ) {
				$background_repeat = ArSett::get( 'header_background_repeat', 'global' );
			}
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


# 4. Title typography

if ( ArSett::page_is( 'single' ) ) {
	if ( ArSett::get( 'post_typography_settings' ) == 'custom' ) {
		if ( ArSett::get( 'post_header_title_typo' ) ) {
			$title_typo = json_decode( ArSett::get( 'post_header_title_typo' ) );
		}
	} elseif ( ArSett::get( 'post_typography_settings' ) == 'inherit' 
				|| ArSett::get( 'post_typography_settings' ) === NULL ) {
		if ( ArSett::get( 'post_typography_settings', 'global' ) == 'custom' ) {
			if ( ArSett::get( 'post_header_title_typo', 'global' ) ) {
				$title_typo = json_decode( ArSett::get( 'post_header_title_typo', 'global' ) );
			}
		} elseif ( ArSett::get( 'post_typography_settings', 'global' ) == 'inherit'
					|| ArSett::get( 'post_typography_settings', 'global' ) === NULL ) {
			if ( ArSett::get( 'header_tilte_typo', 'global' ) ) {
				$title_typo = json_decode( ArSett::get( 'header_tilte_typo', 'global' ) );
			}
		}
	}
} elseif ( ArSett::page_is( 'ecommerce' ) ) {
	if ( ArSett::get( 'page_typography_settings' ) == 'custom' ) {
		if ( ArSett::get( 'page_header_title_typo' ) ) {
			$title_typo = json_decode( ArSett::get( 'page_header_title_typo' ) );
		}
	} elseif ( ArSett::get( 'page_typography_settings' ) == 'inherit' 
				|| ArSett::get( 'page_typography_settings' ) === NULL ) {
		if ( ArSett::get( 'woocommerce_page_typography_settings', 'global' ) == 'custom' ) {
			if ( ArSett::get( 'woocommerce_header_title_typo', 'global' ) ) {
				$title_typo = json_decode( ArSett::get( 'woocommerce_header_title_typo', 'global' ) );
			}
		} elseif ( ArSett::get( 'woocommerce_page_typography_settings', 'global' ) == 'inherit'
					|| ArSett::get( 'woocommerce_page_typography_settings', 'global' ) === NULL ) {
			if ( ArSett::get( 'header_tilte_typo', 'global' ) ) {
				$title_typo = json_decode( ArSett::get( 'header_tilte_typo', 'global' ) );
			}
		}
	}
} elseif ( ArSett::page_is( 'project' ) ) {
	if ( ArSett::get( 'page_typography_settings' ) == 'custom' ) {
		if ( ArSett::get( 'page_header_title_typo' ) ) {
			$title_typo = json_decode( ArSett::get( 'page_header_title_typo' ) );
		}
	} elseif ( in_array( ArSett::get( 'page_typography_settings' ), array( 'inherit', NULL ) ) ) { 
		if ( ArSett::get( 'portfolio_typography_settings', 'global' ) == 'custom' ) {
			if ( ArSett::get( 'project_header_title_typo', 'global' ) ) {
				$title_typo = json_decode( ArSett::get( 'project_header_title_typo', 'global' ) );
			}
		} elseif ( in_array( ArSett::get( 'portfolio_typography_settings', 'global' ), array( 'inherit', NULL ) ) ) {
			if ( ArSett::get( 'header_tilte_typo', 'global' ) ) {
				$title_typo = json_decode( ArSett::get( 'header_tilte_typo', 'global' ) );
			}
		}
	}
} else {
	if ( ArSett::get( 'page_typography_settings' ) == 'custom' ) {
		if ( ArSett::get( 'page_header_title_typo' ) ) {
			$title_typo = json_decode( ArSett::get( 'page_header_title_typo' ) );
		}
	} elseif ( ArSett::get( 'page_typography_settings' ) == 'inherit' 
				|| ArSett::get( 'page_typography_settings' ) === NULL ) {
		if ( ArSett::get( 'header_tilte_typo', 'global' ) ) {
			$title_typo = json_decode( ArSett::get( 'header_tilte_typo', 'global' ) );
		}
	}
}

$title_typo_css = \Argenta\Helper::parse_acf_typo_to_css( $title_typo );


# 5. Subtitle typography

if ( ArSett::page_is( 'single' ) ) {
	if ( ArSett::get( 'post_typography_settings' ) == 'custom' ) {
		if ( ArSett::get( 'post_header_subtitle_typo' ) ) {
			$subtitle_typo = json_decode( ArSett::get( 'post_header_subtitle_typo' ) );
		}
	} elseif ( ArSett::get( 'post_typography_settings' ) == 'inherit' 
				|| ArSett::get( 'post_typography_settings' ) === NULL ) {
		if ( ArSett::get( 'post_typography_settings', 'global' ) == 'custom' ) {
			if ( ArSett::get( 'post_header_subtitle_typo', 'global' ) ) {
				$subtitle_typo = json_decode( ArSett::get( 'post_header_subtitle_typo', 'global' ) );
			}
		} elseif ( ArSett::get( 'post_typography_settings', 'global' ) == 'inherit'
					|| ArSett::get( 'post_typography_settings', 'global' ) === NULL ) {
			if ( ArSett::get( 'header_subtilte_typo', 'global' ) ) {
				$subtitle_typo = json_decode( ArSett::get( 'header_subtilte_typo', 'global' ) );
			}
		}
	}
} elseif ( ArSett::page_is( 'ecommerce' ) ) {
	if ( ArSett::get( 'page_typography_settings' ) == 'custom' ) {
		if ( ArSett::get( 'page_header_subtitle_typo' ) ) {
			$subtitle_typo = json_decode( ArSett::get( 'page_header_subtitle_typo' ) );
		}
	} elseif ( ArSett::get( 'page_typography_settings' ) == 'inherit' 
				|| ArSett::get( 'page_typography_settings' ) === NULL ) {
		if ( ArSett::get( 'woocommerce_page_typography_settings', 'global' ) == 'custom' ) {
			if ( ArSett::get( 'woocommerce_header_subtitle_typo', 'global' ) ) {
				$subtitle_typo = json_decode( ArSett::get( 'woocommerce_header_subtitle_typo', 'global' ) );
			}
		} elseif ( ArSett::get( 'woocommerce_page_typography_settings', 'global' ) == 'inherit'
					|| ArSett::get( 'woocommerce_page_typography_settings', 'global' ) === NULL ) {
			if ( ArSett::get( 'header_subtilte_typo', 'global' ) ) {
				$subtitle_typo = json_decode( ArSett::get( 'header_subtilte_typo', 'global' ) );
			}
		}
	}
} elseif ( ArSett::page_is( 'project' ) ) {
	if ( ArSett::get( 'page_typography_settings' ) == 'custom' ) {
		if ( ArSett::get( 'page_header_subtitle_typo' ) ) {
			$subtitle_typo = json_decode( ArSett::get( 'page_header_subtitle_typo' ) );
		}
	} elseif ( in_array( ArSett::get( 'page_typography_settings' ), array( 'inherit', NULL ) ) ) { 
		if ( ArSett::get( 'portfolio_typography_settings', 'global' ) == 'custom' ) {
			if ( ArSett::get( 'project_header_subtitle_typo', 'global' ) ) {
				$subtitle_typo = json_decode( ArSett::get( 'project_header_subtitle_typo', 'global' ) );
			}
		} elseif ( in_array( ArSett::get( 'portfolio_typography_settings', 'global' ), array( 'inherit', NULL ) ) ) {
			if ( ArSett::get( 'header_subtilte_typo', 'global' ) ) {
				$subtitle_typo = json_decode( ArSett::get( 'header_subtilte_typo', 'global' ) );
			}
		}
	}
} else {
	if ( ArSett::get( 'page_typography_settings' ) == 'custom' ) {
		if ( ArSett::get( 'page_header_subtitle_typo' ) ) {
			$subtitle_typo = json_decode( ArSett::get( 'page_header_subtitle_typo' ) );
		}
	} elseif ( ArSett::get( 'page_typography_settings' ) == 'inherit' 
				|| ArSett::get( 'page_typography_settings' ) === NULL ) {
		if ( ArSett::get( 'header_subtilte_typo', 'global' ) ) {
			$subtitle_typo = json_decode( ArSett::get( 'header_subtilte_typo', 'global' ) );
		}
	}
}

$subtitle_typo_css = \Argenta\Helper::parse_acf_typo_to_css( $subtitle_typo );


# 6. Overlay color

if ( ArSett::page_is( 'single' ) ) {
	switch ( ArSett::get( 'post_title_background' ) ) {
		case 'post_thumbnail':
		case 'loaded_image':
			if ( ArSett::get( 'post_title_use_overlay' ) == 'yes' ) {
				$overlay_color = ArSett::get( 'post_title_background_overlay' );
			} elseif ( ArSett::get( 'post_title_use_overlay' ) == 'inherit'
						|| ArSett::get( 'post_title_use_overlay' ) === NULL ) {
				switch ( ArSett::get( 'post_title_background_type', 'global' ) ) {
					case 'post_thumbnail':
					case 'custom':
						if ( ArSett::get( 'post_use_title_overlay', 'global' ) ) {
							$overlay_color = ArSett::get( 'post_title_background_overlay_color', 'global' );
						}
						break;
					case 'color':
						break;
					default:
						if ( ArSett::get( 'header_title_background_type', 'global' ) == 'image' ) {
							if ( ArSett::get( 'header_use_overlay', 'global' ) ) {
								$overlay_color = ArSett::get( 'header_overlay_color', 'global' );
							}
						}
						break;
				}
			}
			break;
		case 'color':
			break;
		default:
			switch ( ArSett::get( 'post_title_background_type', 'global' ) ) {
				case 'post_thumbnail':
				case 'custom':
					if ( ArSett::get( 'post_use_title_overlay', 'global' ) ) {
						$overlay_color = ArSett::get( 'post_title_background_overlay_color', 'global' );
					}
					break;
				case 'color':
					break;
				default:
					if ( ArSett::get( 'header_title_background_type', 'global' ) == 'image' ) {
						if ( ArSett::get( 'header_use_overlay', 'global' ) ) {
							$overlay_color = ArSett::get( 'header_overlay_color', 'global' );
						}
					}
					break;
			}
	}
} elseif ( ArSett::page_is( 'ecommerce' ) ) {
	if ( ArSett::get( 'header_background_type' ) == 'image' ) {
		if ( ArSett::get( 'header_use_overlay' ) == 'yes' ) {
			$overlay_color = ArSett::get( 'header_overlay_color' );
		} elseif ( ArSett::get( 'header_use_overlay' ) == 'inherit' 
					|| ArSett::get( 'header_use_overlay' ) === NULL ) {
			if ( ArSett::get( 'woocommerce_header_title_background_type', 'global' ) == 'custom' ) {
				if ( ArSett::get( 'woocommerce_header_use_overlay', 'global' ) == 'yes' ) {
					$overlay_color = ArSett::get( 'woocommerce_header_overlay_color', 'global' );
				} elseif ( ArSett::get( 'woocommerce_header_use_overlay', 'global' ) == 'inherit' 
							|| ArSett::get( 'woocommerce_header_use_overlay', 'global' ) === NULL ) {
					if ( ArSett::get( 'header_use_overlay', 'global' )
						&& ArSett::get( 'header_title_background_type', 'global' ) == 'image' ) {
						$overlay_color = ArSett::get( 'header_overlay_color', 'global' );
					}
				}
			} elseif ( ArSett::get( 'woocommerce_title_background_type', 'global' ) == 'inherit'
						|| ArSett::get( 'woocommerce_title_background_type', 'global' ) === NULL ) {
				if ( ArSett::get( 'header_use_overlay', 'global' )
					&& ArSett::get( 'header_title_background_type', 'global' ) == 'image' ) {
					$overlay_color = ArSett::get( 'header_overlay_color', 'global' );
				}
			}
		}
	} elseif ( ArSett::get( 'header_background_type' ) == 'inherit'
				|| ArSett::get( 'header_background_type' ) === NULL ) {
		if ( ArSett::get( 'woocommerce_header_use_overlay', 'global' ) == 'yes' ) {
			$overlay_color = ArSett::get( 'woocommerce_header_overlay_color', 'global' );
		} elseif ( ArSett::get( 'woocommerce_header_use_overlay', 'global' ) == 'inherit' 
					|| ArSett::get( 'woocommerce_header_use_overlay', 'global' ) === NULL ) {
			if ( ArSett::get( 'header_use_overlay', 'global' )
				&& ArSett::get( 'header_title_background_type', 'global' ) == 'image' ) {
				$overlay_color = ArSett::get( 'header_overlay_color', 'global' );
			}
		}
	}
} elseif ( ArSett::page_is( 'project' ) ) {
	if ( ArSett::get( 'header_background_type' ) == 'image' ) {
		if ( ArSett::get( 'header_use_overlay' ) == 'yes' ) {
			$overlay_color = ArSett::get( 'header_overlay_color' );
		} elseif ( in_array( ArSett::get( 'header_use_overlay' ), array( 'inherit', NULL ) ) ) {
			if ( ArSett::get( 'portfolio_header_title_type', 'global' ) == 'custom' ) {
				if ( ArSett::get( 'portfolio_use_title_overlay', 'global' ) == 'yes' ) {
					$overlay_color = ArSett::get( 'portfolio_title_background_overlay_color', 'global' );
				} elseif ( in_array( ArSett::get( 'portfolio_use_title_overlay', 'global' ), array( 'inherit', NULL ) ) ) {
					if ( ArSett::get( 'header_use_overlay', 'global' )
						&& ArSett::get( 'header_title_background_type', 'global' ) == 'image' ) {
						$overlay_color = ArSett::get( 'header_overlay_color', 'global' );
					}
				}
			} elseif ( in_array( ArSett::get( 'portfolio_header_title_type', 'global' ), array( 'inherit', NULL ) ) ) {
				if ( ArSett::get( 'header_use_overlay', 'global' )
					&& ArSett::get( 'header_title_background_type', 'global' ) == 'image' ) {
					$overlay_color = ArSett::get( 'header_overlay_color', 'global' );
				}
			}
		}
	} elseif ( in_array( ArSett::get( 'header_background_type' ), array( 'inherit', NULL ) ) ) {
		if ( ArSett::get( 'portfolio_header_title_type', 'global' ) == 'custom' 
				&& ArSett::get( 'portfolio_use_title_overlay', 'global' ) ) {
			$overlay_color = ArSett::get( 'portfolio_title_background_overlay_color', 'global' );
		} elseif ( in_array( ArSett::get( 'portfolio_header_title_type', 'global' ), array( 'inherit', NULL ) ) ) { 
			if ( ArSett::get( 'header_use_overlay', 'global' ) 
					&& ArSett::get( 'header_title_background_type', 'global' ) == 'image' ) {
				$overlay_color = ArSett::get( 'header_overlay_color', 'global' );
			}
		}
	}
} else {
	if ( ArSett::get( 'header_background_type' ) == 'image' ) {
		if ( ArSett::get( 'header_use_overlay' ) == 'yes' ) {
			$overlay_color = ArSett::get( 'header_overlay_color' );
		} elseif ( in_array( ArSett::get( 'header_use_overlay' ), array( 'inherit', NULL ) ) ) { 
			if ( ArSett::get( 'header_use_overlay', 'global' )
				&& ArSett::get( 'header_title_background_type', 'global' ) == 'image' ) {
				$overlay_color = ArSett::get( 'header_overlay_color', 'global' );
			}
		}
	} elseif ( ArSett::get( 'header_background_type' ) == 'inherit'
				|| ArSett::get( 'header_background_type' ) === NULL ) {
		if ( ArSett::get( 'header_title_background_type', 'global' ) == 'image' ) {
			if ( ArSett::get( 'header_use_overlay', 'global' ) ) {
				$overlay_color = ArSett::get( 'header_overlay_color', 'global' );
			}
		}
	}
}

if ( $overlay_color && substr( trim( $overlay_color ), 0, 4 ) != 'rgba' ) {
	$overlay_color = ArHelp::hex_to_rgba( $overlay_color, 0.6 );
}
if ( ! $background_image || ! ArSett::header_title_use_overlay() ) {
	$overlay_color = 'transparent';
}

if ( $overlay_color ) {
	$overlay_color_css = 'background-color:' . $overlay_color . ';';
}


# 7. Header title height

if ( ArSett::page_is( 'single' ) ) {
	$header_title_height = ArSett::get( 'post_title_height' );
	if ( ! $header_title_height ) {
		$header_title_height = ArSett::get( 'post_header_height', 'global' );
		if ( ! $header_title_height ) {
			$header_title_height = ArSett::get( 'header_height', 'global' );
		}
	}
} elseif ( ArSett::page_is( 'ecommerce' ) ) {
	$header_title_height = ArSett::get( 'header_height' );
	if ( ! $header_title_height ) {
		$header_title_height = ArSett::get( 'woocommerce_header_height', 'global' );
		if ( ! $header_title_height ) {
			$header_title_height = ArSett::get( 'header_height', 'global' );
		}
	}
} elseif ( ArSett::page_is( 'project' ) ) {
	$header_title_height = ArSett::get( 'header_height' );
	if ( ! $header_title_height ) {
		if ( ArSett::get( 'project_header_title_height_settings', 'global' ) == 'custom' ) {
			$header_title_height = ArSett::get( 'project_header_height', 'global' );
		} else {
			$header_title_height = ArSett::get( 'header_height', 'global' );
		}
	}
} else {
	$header_title_height = ArSett::get( 'header_height' );
	if ( ! $header_title_height ) {
		$header_title_height = ArSett::get( 'header_height', 'global' );
	}
}

if ( ArSett::header_title_is_full_height() ) {
	$header_title_height = false;
}

if ( $header_title_height ) {
	$header_title_height_css = 'height:' . $header_title_height . ';';
	$header_title_height_css .= 'min-height:' . $header_title_height . ';';
}


# 8. View

if ( $background_color_css || $background_image_css || $background_image_css || $background_size_css 
	|| $background_position_css || $background_repeat_css || $header_title_height_css ) {
	// --- start of CSS ---
	$_style_block = '.header-title{';
	$_style_block .= $background_color_css;
	$_style_block .= $background_image_css;
	$_style_block .= $background_size_css;
	$_style_block .= $background_position_css;
	$_style_block .= $background_repeat_css;
	$_style_block .= $header_title_height_css;
	$_style_block .= '}';
	// --- end of CSS ---
	ArLay::append_to_dynamic_css_buffer( $_style_block );
}

if ( $overlay_color_css ) {
	// --- start of CSS ---
	$_style_block = '.header-title::after{';
	$_style_block .= $overlay_color_css;
	$_style_block .= '}';
	// --- end of CSS ---
	ArLay::append_to_dynamic_css_buffer( $_style_block );
}

// Title and subtitle
if ( $title_typo_css ) {
	// --- start of CSS ---
	$_style_block = '.header-title h1.page-title{';
	$_style_block .= $title_typo_css;
	$_style_block .= '}';
	// --- end of CSS ---
	ArLay::append_to_dynamic_css_buffer( $_style_block );
}
if ( $subtitle_typo_css ) {
	// --- start of CSS ---
	$_style_block = '.header-title .subtitle{';
	$_style_block .= $subtitle_typo_css;
	$_style_block .= '}';
	// --- end of CSS ---
	ArLay::append_to_dynamic_css_buffer( $_style_block );
}