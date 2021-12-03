<?php

	namespace Argenta;

	class Settings {

		static public $page_is_keys = false; // page is ...

		static function get( $key, $type = 'clear', $default = NULL ) {
			if ( !$key ) return NULL;
			global $post;

			switch ( $type ) {
				case 'color':
                    if( function_exists('get_field')){
                        $result = get_field( $key );
                    } else{
                        $result = get_post_meta( $post->ID, $key );
                    }

					if ( ! $result ) {
                        if( function_exists('get_field')){
                            $result = get_field( 'global_' . $key, 'option' );
                        } else{
                            $result = get_option( 'options_global_', $key );
                        }

						if ( $result === NULL && $default !== NULL ) {
							return $default;
						} else {
							return $result;
						}
					} else {
						return $result;
					}
					break;

				case 'yesno':
                    if( function_exists('get_field')){
                        $result = get_field( $key );
                    } else{
                        $result = get_post_meta( $post->ID, $key );
                    }
					if ( $result === NULL || $result == 'inherit' ) {
                        if( function_exists('get_field')){
                            $result = get_field( 'global_' . $key, 'option' );
                        } else{
                            $result = get_option( 'options_global_', $key );
                        }
						if ( $result === NULL && $default !== NULL ) {
							return $default;
						} else {
							return (bool) $result;
						}
					} else {
						return (bool) ($result == 'yes');
					}
					break;

				case 'type':
					if ( is_home() ) {


                        if( function_exists('get_field')){
                            $result = get_field( $key, get_option( 'page_for_posts' ) );
                        } else{
                            $result = get_post_meta( get_option( 'page_for_posts' ), $key );
                        }

					} else {

                        if( function_exists('get_field')){
                            $result = get_field( $key );
                        } else{
                            $result = get_post_meta( $post->ID, $key );
                        }

					}
					if ( $result === NULL || $result == 'inherit' ) {

                        if( function_exists('get_field')){
                            $result = get_field( 'global_' . $key, 'option' );
                        } else{
                            $result = get_option( 'options_global_', $key );
                        }

						if ( $result === NULL && $default !== NULL ) {
							return $default;
						} else {
							return $result;
						}
					} else {
						return $result;
					}
					break;

				case 'global':
                    if( function_exists('get_field')){
                        return get_field( 'global_' . $key, 'option' );
                    } else{
                        return get_option( 'options_global_', $key );
                    }

					break;

				case 'clear':
				default:
					if ( is_home() ) {
                        if( function_exists('get_field')){
                            return get_field( $key, get_option( 'page_for_posts' ) );
                        } else{
                            return get_post_meta( get_option( 'page_for_posts' ), $key );
                        }

					}

                    if( function_exists('get_field')){
                        return get_field( $key );
                    } else{
                        return get_post_meta( $post->ID, $key );
                    }


					break;
			}
		}


		/* Return all page type slugs. Cache after first call */
		static function page_is( $key = false, $strictly = false ) {
			$cases = array();
			if ( is_array( self::$page_is_keys ) ) {
				$cases = self::$page_is_keys;
			} else {
				global $wp_query;

				if ( is_front_page() ) {
					$cases[] = 'front';
				}
				if ( ( function_exists( 'is_shop' ) && is_shop() ) ) {
					$cases[] = 'shop';
				}
				if ( function_exists( 'is_product_category' ) && is_product_category() ) {
					$cases[] = 'product_category';
				}
				if ( function_exists( 'is_product_tag' ) && is_product_tag() ) {
					$cases[] = 'product_tag';
				}
				if ( function_exists( 'is_product' ) && is_product() ) {
					$cases[] = 'product';
				}
				if ( function_exists( 'is_cart' ) && is_cart() ) {
					$cases[] = 'cart';
				}
				if ( function_exists( 'is_checkout' ) && is_checkout() ) {
					$cases[] = 'checkout';
				}
				if ( function_exists( 'is_account' ) && is_account_page() ) {
					$cases[] = 'account';
				}
				if ( function_exists( 'is_product' ) && is_product() ) {
					$cases[] = 'product';
				}
				if ( get_post_type() == 'argenta_portfolio' ) {
					$cases[] = 'project';
				}
				if ( is_single() && ( get_post_type() == 'post' ) ) {
					$cases[] = 'single';
				}
				if ( is_search() ) {
					$cases[] = 'search';
				}
				if ( is_category() ) {
					$cases[] = 'category';
				}
				if ( is_tag() ) {
					$cases[] = 'tag';
				}
				if ( is_author() ) {
					$cases[] = 'author';
				}
				if ( is_archive() ) {
					$cases[] = 'archive';
				}
				if ( is_attachment() ) {
					$cases[] = 'attachment';
				}
				if ( function_exists( 'is_product_category' ) && is_product_category() ) {
					$cases[] = 'product_category';
				}
				if ( get_page_template_slug() == 'page-templates/page_for-builder.php' ) {
					$cases[] = 'for_builder';
				}
				if ( is_home() || get_page_template_slug() == 'page-templates/page_for-posts.php' ) {
					$cases[] = 'blog';
				}
				if ( is_home() ) {
					$cases[] = 'home';
				}
				if ( $wp_query->is_page() ) {
					$cases[] = 'page';
				}
				if ( function_exists( 'is_shop' ) && function_exists( 'is_cart' ) && function_exists( 'is_checkout' ) && function_exists( 'is_account_page' ) && function_exists( 'is_product_category' ) && function_exists( 'is_product_tag' ) && function_exists( 'is_product' ) ) {
					if ( is_shop() || is_cart() || is_checkout() || is_account_page() || is_product_category() || is_product_tag() || is_product() ) {
						$cases[] = 'ecommerce';
					}
				}
				if ( function_exists( 'yith_wcwl_is_wishlist_page' ) ) {
					if ( yith_wcwl_is_wishlist_page() ) {
						$cases[] = 'ecommerce';
					}
				}

				self::$page_is_keys = $cases;
			}
			if ( ! $key ) {
				return ( $strictly ) ? $cases[0] : $cases;
			} else {
				return ( $strictly ) ? ( $key == $cases[0] ) : in_array( $key, $cases );
			}
		}


		/* Return logo objects array for current page */
		static function get_logo( $contrast = false, $fixed = false ) {
			$_sitename_result = 'sitename';
			$_logo_result = array(
				'default' => false,
				'retina' => false,
				'mobile' => false,
				'have_vector' => false,
				'type' => false
			);

			$logo_type = self::get( 'header_logo_style' );
			if ( in_array( $logo_type, array( 'inherit', NULL ) ) ) {
				if ( self::page_is( 'ecommerce' ) ) {
					$logo_type = self::get( 'woocommerce_header_logo_style', 'global' );
					if ( in_array( $logo_type, array( 'inherit', NULL ) ) ) {
						$logo_type = self::get( 'logo_type', 'global' );
						if ( $logo_type === NULL ) {
							$logo_type = 'sitename';
						}
						if ( $logo_type != 'sitename' ) {
							$logo_type = self::get( 'header_logo_by_default', 'global' );
							if ( ! $logo_type ) {
								$logo_type = 'dark_variant';
							}
						}
					}
				} else {
					$logo_type = self::get( 'logo_type', 'global' );
					if ( $logo_type === NULL ) {
							$logo_type = 'sitename';
						}
					if ( $logo_type != 'sitename' ) {
						$logo_type = self::get( 'header_logo_by_default', 'global' );
						if ( ! $logo_type ) {
							$logo_type = 'dark_variant';
						}
					}
				}
			}

			// Contrast logo
			if ( $contrast && $logo_type == 'dark_variant' ) {
				$_logo = self::get( 'logo_image', 'global' );
				if ( is_array( $_logo ) && ( $_logo['global_logo_image_light'] || $_logo['global_logo_image_light_retina'] ) ) {
					$logo_type = 'light_variant';
				}
			}

			// Logo for fixed
			if ( $fixed ) {
				$fixed_type = \Argenta\Settings::get( 'header_logo_when_fixed', 'global' );
				if ( in_array( $fixed_type, array( 'dark_variant', NULL ) ) ) {
					$logo_type = 'dark_variant';
				} else {
					switch ( $fixed_type ) {
						case 'light_variant':
							$logo_type = 'light_variant';
							break;
						case 'custom':
							$_logo = self::get( 'logo_image_fixed_variant', 'global' );
							if ( is_array( $_logo ) ) {
								if ( $_logo['global_logo_image_fixed'] ) {
									$_logo_result['default'] = $_logo['global_logo_image_fixed'];
									if ( ( substr( $_logo['global_logo_image_fixed'], -4, 4) == '.svg' ) ) {
										$_logo_result['have_vector'] = true;
									}
								}
								if ( $_logo['global_logo_image_fixed_retina'] ) {
									$_logo_result['retina'] = $_logo['global_logo_image_fixed_retina'];
									if ( ( substr( $_logo['global_logo_image_fixed_retina'], -4, 4) == '.svg' ) ) {
										$_logo_result['have_vector'] = true;
									}
								}
								if ( $_logo['global_logo_image_fixed_mobile'] ) {
									$_logo_result['mobile'] = $_logo['global_logo_image_fixed_mobile'];
									if ( ( substr( $_logo['global_logo_image_fixed_mobile'], -4, 4) == '.svg' ) ) {
										$_logo_result['have_vector'] = true;
									}
								}
							}
							return $_logo_result;
							break;
						case 'sitename':
							return $_sitename_result;
							break;
						case 'inherit':
						default:
							break;
					}
				}
			}

			$_logo_result['type'] = $logo_type;

			switch ( $logo_type ) {
				case 'dark_variant':
					$_logo = self::get( 'logo_image_dark_variant', 'global' );
					if ( is_array( $_logo ) ) {
						if ( $_logo['global_logo_image_dark'] ) {
							$_logo_result['default'] = $_logo['global_logo_image_dark'];
							if ( ( substr( $_logo['global_logo_image_dark'], -4, 4) == '.svg' ) ) {
								$_logo_result['have_vector'] = true;
							}
						}
						if ( $_logo['global_logo_image_dark_retina'] ) {
							$_logo_result['retina'] = $_logo['global_logo_image_dark_retina'];
							if ( ( substr( $_logo['global_logo_image_dark_retina'], -4, 4) == '.svg' ) ) {
								$_logo_result['have_vector'] = true;
							}
						}
						if ( $_logo['global_logo_image_dark_mobile'] ) {
							$_logo_result['mobile'] = $_logo['global_logo_image_dark_mobile'];
							if ( ( substr( $_logo['global_logo_image_dark_mobile'], -4, 4) == '.svg' ) ) {
								$_logo_result['have_vector'] = true;
							}
						}
					}
					return $_logo_result;
					break;
				case 'light_variant':
					$_logo = self::get( 'logo_image', 'global' );
					if ( is_array( $_logo ) ) {
						if ( $_logo['global_logo_image_light'] ) {
							$_logo_result['default'] = $_logo['global_logo_image_light'];
							if ( ( substr( $_logo['global_logo_image_light'], -4, 4) == '.svg' ) ) {
								$_logo_result['have_vector'] = true;
							}
						}
						if ( $_logo['global_logo_image_light_retina'] ) {
							$_logo_result['retina'] = $_logo['global_logo_image_light_retina'];
							if ( ( substr( $_logo['global_logo_image_light_retina'], -4, 4) == '.svg' ) ) {
								$_logo_result['have_vector'] = true;
							}
						}
						if ( $_logo['global_logo_image_light_mobile'] ) {
							$_logo_result['mobile'] = $_logo['global_logo_image_light_mobile'];
							if ( ( substr( $_logo['global_logo_image_light_mobile'], -4, 4) == '.svg' ) ) {
								$_logo_result['have_vector'] = true;
							}
						}
					}
					return $_logo_result;
					break;
				case 'custom':
					if ( self::page_is( 'ecommerce' ) ) {
						$_logo = self::get( 'woocommerce_header_custom_logo', 'global' );
						if ( $_logo ) {
							$_logo_result['default'] = $_logo;
							$_logo_result['have_vector'] = ( substr( $_logo, -4, 4) == '.svg' );
						}
						return $_logo_result;
					} else {
						$_logo = self::get( 'header_menu_custom_logo' );
						if ( $_logo ) {
							$_logo_result['default'] = $_logo;
							$_logo_result['have_vector'] = ( substr( $_logo, -4, 4) == '.svg' );
						}
						return $_logo_result;
					}
					break;
				case 'sitename':
				default:
					return $_sitename_result;
					break;
			}
		}

		/* Return header menu style? */
		static function header_menu_style() {
			$header_menu_style = self::get( 'header_menu_style' );
			if ( in_array( $header_menu_style, array( 'inherit', NULL ) ) ) {
				if ( self::page_is( 'ecommerce' ) ) {
					$header_menu_style = self::get( 'woocommerce_header_menu_style', 'global' );
					if ( in_array( $header_menu_style, array( 'inherit', NULL ) ) ) {
						$header_menu_style = self::get( 'header_menu_style', 'global' );
					}
				} else {
					$header_menu_style = self::get( 'header_menu_style', 'global' );
				}
			}
			return $header_menu_style;
		}

		/* Show header cap on this page? */
		static function header_cap_is_displayed() {
			$add_cap = self::get( 'header_menu_add_cap' );
			if ( in_array( $add_cap, array( 'inherit', NULL ) ) ) {
				if ( self::page_is( 'ecommerce' ) ) {
					$add_cap = self::get( 'woocommerce_header_add_cap', 'global' );
					if ( in_array( $add_cap, array( 'inherit', NULL ) ) ) {
						$add_cap = self::get( 'header_menu_add_cap', 'global' );
					}
				} else {
					$add_cap = self::get( 'header_menu_add_cap', 'global' );
				}
			}
			if ( $add_cap === NULL ) {
				$add_cap = 'no';
			}
			return ( bool ) ( $add_cap == 'yes' );
		}


		/* Header title to full height? */
		static function header_title_is_full_height() {
			$is_full = false;

			if ( self::page_is( 'single' ) ) {
				$is_full = self::get( 'header_height_fullscreen' );
				if ( in_array( $is_full, array( 'inherit', NULL ) ) ) {
					$is_full = self::get( 'post_title_height_fullscreen', 'global' );
					if ( in_array( $is_full, array( 'inherit', NULL ) ) ) {
						$is_full = self::get( 'header_height_fullscreen', 'global' );
						$is_full = ( $is_full ) ? 'yes' : 'no';
					}
				}
			} elseif ( self::page_is( 'ecommerce' ) ) {
				$is_full = self::get( 'header_height_fullscreen' );
				if ( in_array( $is_full, array( 'inherit', NULL ) ) ) {
					$is_full = self::get( 'woocommerce_header_height_fullscreen', 'global' );
					if ( in_array( $is_full, array( 'inherit', NULL ) ) ) {
						$is_full = self::get( 'header_height_fullscreen', 'global' );
						$is_full = ( $is_full ) ? 'yes' : 'no';
					}
				}
			} elseif ( self::page_is( 'project' ) ) {
				$is_full = self::get( 'header_height_fullscreen' );
				if ( in_array( $is_full, array( 'inherit', NULL ) ) ) {
					$is_full = self::get( 'project_header_title_height_settings', 'global' );
					if ( $is_full == 'custom' ) {
						$is_full = self::get( 'project_title_height_fullscreen', 'global' );
					} else {
						$is_full = self::get( 'header_height_fullscreen', 'global' );
					}
					$is_full = ( $is_full ) ? 'yes' : 'no';
				}
			} else {
				$is_full = self::get( 'header_height_fullscreen' );
				if ( in_array( $is_full, array( 'inherit', NULL ) ) ) {
					$is_full = self::get( 'header_height_fullscreen', 'global' );
					$is_full = ( $is_full ) ? 'yes' : 'no';
				}
			}

			return (bool) ( $is_full == 'yes' );
		}


		/* Show header title? */
		static function header_title_is_displayed() {
			if ( self::page_is( 'ecommerce' ) ) {
				$hero_title_is_show = self::get( 'header_use_hero' );
				if ( in_array( $hero_title_is_show, array( 'inherit', NULL ) ) ) {
					$hero_title_is_show = self::get( 'woocommerce_header_use_hero', 'global' );
					if ( in_array( $hero_title_is_show, array( 'inherit', NULL ) ) ) {
						$hero_title_is_show = self::get( 'header_use_hero', 'global' );
						if ( $hero_title_is_show === NULL ) {
							$hero_title_is_show = 'no';
						} else {
							$hero_title_is_show = ( $hero_title_is_show ) ? 'yes' : 'no';
						}
					}
				}
			} elseif ( self::page_is( 'project' ) ) {
				$hero_title_is_show = self::get( 'header_use_hero' );
				if ( ! in_array( $hero_title_is_show, array( 'yes', 'no' ) ) ) { // backward compatibility
					$hero_title_is_show = self::get( 'project_header_use_hero', 'global' );
					if ( in_array( $hero_title_is_show, array( 'inherit', NULL ) ) ) {
						$hero_title_is_show = self::get( 'header_use_hero', 'global' );
						if ( $hero_title_is_show === NULL ) {
							$hero_title_is_show = 'no';
						} else {
							$hero_title_is_show = ( $hero_title_is_show ) ? 'yes' : 'no';
						}
					}
				}
			} elseif ( self::page_is( 'single' ) ) {
				$hero_title_is_show = self::get( 'post_title_hide' );
				if ( ! in_array( $hero_title_is_show, array( 'yes', 'no' ) ) ) {
					$hero_title_is_show = self::get( 'post_hide_header_title', 'global' );
					if ( in_array( $hero_title_is_show, array( 'inherit', NULL ) ) ) {
						$hero_title_is_show = self::get( 'header_use_hero', 'global' );
						if ( $hero_title_is_show === NULL ) {
							$hero_title_is_show = 'no';
						} else {
							$hero_title_is_show = ( $hero_title_is_show ) ? 'yes' : 'no';
						}
					}
				}
			} else {
				$hero_title_is_show = self::get( 'header_use_hero' );
				if ( in_array( $hero_title_is_show, array( 'inherit', NULL ) ) ) {
					$hero_title_is_show = self::get( 'header_use_hero', 'global' );
					if ( $hero_title_is_show === NULL ) {
						$hero_title_is_show = 'no';
					} else {
						$hero_title_is_show = ( $hero_title_is_show ) ? 'yes' : 'no';
					}
				}
			}
			return (bool) ( $hero_title_is_show != 'yes' );
		}


		static function get_post_sidebar_position() {
			$position = self::get( 'post_single_sidebar', 'global' );
			return ( ( $position ) ? $position : 'right' );
		}

		static function get_archive_sidebar_position() {
			$position = self::get( 'blog_sidebar', 'global' );
			return ( ( $position ) ? $position : 'right' );
		}


		static function footer_widget_logo() {
			$_sitename_result = 'sitename';
			$_logo_result = array(
				'default' => false,
				'retina' => false,
				'mobile' => false,
				'have_vector' => false
			);

			$logo_type = self::get( 'footer_logo_widget_type' );
			if ( in_array( $logo_type, array( 'inherit', NULL ) ) ) {
				if ( self::page_is( 'ecommerce' ) ) {
					$logo_type = self::get( 'woocommerce_header_logo_style', 'global' );
					if ( in_array( $logo_type, array( 'inherit', NULL ) ) ) {
						$logo_type = self::get( 'footer_logo_type', 'global' );
						if ( ! $logo_type ) { $logo_type = 'sitename'; }
					}
				} else {
					$logo_type = self::get( 'footer_logo_type', 'global' );
					if ( ! $logo_type ) { $logo_type = 'sitename'; }
				}
			}

			switch ( $logo_type ) {
				case 'dark_variant':
					$_logo = self::get( 'logo_image_dark_variant', 'global' );
					if ( is_array( $_logo ) ) {
						if ( $_logo['global_logo_image_dark'] ) {
							$_logo_result['default'] = $_logo['global_logo_image_dark'];
							if ( ( substr( $_logo['global_logo_image_dark'], -4, 4) == '.svg' ) ) {
								$_logo_result['have_vector'] = true;
							}
						}
						if ( $_logo['global_logo_image_dark_retina'] ) {
							$_logo_result['retina'] = $_logo['global_logo_image_dark_retina'];
							if ( ( substr( $_logo['global_logo_image_dark_retina'], -4, 4) == '.svg' ) ) {
								$_logo_result['have_vector'] = true;
							}
						}
						if ( $_logo['global_logo_image_dark_mobile'] ) {
							$_logo_result['mobile'] = $_logo['global_logo_image_dark_mobile'];
							if ( ( substr( $_logo['global_logo_image_dark_mobile'], -4, 4) == '.svg' ) ) {
								$_logo_result['have_vector'] = true;
							}
						}
					}
					return $_logo_result;
					break;
				case 'light_variant':
					$_logo = self::get( 'logo_image', 'global' );
					if ( is_array( $_logo ) ) {
						if ( $_logo['global_logo_image_light'] ) {
							$_logo_result['default'] = $_logo['global_logo_image_light'];
							if ( ( substr( $_logo['global_logo_image_light'], -4, 4) == '.svg' ) ) {
								$_logo_result['have_vector'] = true;
							}
						}
						if ( $_logo['global_logo_image_light_retina'] ) {
							$_logo_result['retina'] = $_logo['global_logo_image_light_retina'];
							if ( ( substr( $_logo['global_logo_image_light_retina'], -4, 4) == '.svg' ) ) {
								$_logo_result['have_vector'] = true;
							}
						}
						if ( $_logo['global_logo_image_light_mobile'] ) {
							$_logo_result['mobile'] = $_logo['global_logo_image_light_mobile'];
							if ( ( substr( $_logo['global_logo_image_light_mobile'], -4, 4) == '.svg' ) ) {
								$_logo_result['have_vector'] = true;
							}
						}
					}
					return $_logo_result;
					break;
				case 'custom':
					$logo_type = self::get( 'footer_logo_widget_type' );
					if ( $logo_type == 'custom' ) {
						$_logo = self::get( 'footer_custom_logo' );
						if ( $_logo ) {
							$_logo_result['default'] = $_logo;
							$_logo_result['have_vector'] = ( substr( $_logo, -4, 4) == '.svg' );
						}
					} elseif ( in_array( $logo_type, array( 'inherit', NULL ) ) ) {
						if ( self::page_is( 'ecommerce' ) ) {
							$logo_type = self::get( 'woocommerce_header_logo_style', 'global' );
							if ( $logo_type == 'custom' ) {
								$_logo = self::get( 'woocommerce_footer_custom_logo', 'global' );
								if ( $_logo ) {
									$_logo_result['default'] = $_logo;
									$_logo_result['have_vector'] = ( substr( $_logo, -4, 4) == '.svg' );
								}
							} elseif ( in_array( $logo_type, array( 'inherit', NULL ) ) ) {
								$logo_type = self::get( 'footer_logo_type', 'global' );
								if ( $logo_type == 'custom' ) {
									$_logo = self::get( 'footer_logo_image', 'global' );
									if ( $_logo ) {
										$_logo_result['default'] = $_logo;
										$_logo_result['have_vector'] = ( substr( $_logo, -4, 4) == '.svg' );
									}
								}
							}
						} else {
							$logo_type = self::get( 'footer_logo_type', 'global' );
							if ( $logo_type == 'custom' ) {
								$_logo = self::get( 'footer_logo_image', 'global' );
								if ( $_logo ) {
									$_logo_result['default'] = $_logo;
									$_logo_result['have_vector'] = ( substr( $_logo, -4, 4) == '.svg' );
								}
							}
						}
					}
					return $_logo_result;
					break;
				case 'sitename':
				default:
					return $_sitename_result;
					break;
			}
		}



		/* Show header subtitle? */
		static function header_subtitle_type() {
			$subtitle_type = false;
			if ( self::page_is( 'single' ) ) {
				$subtitle_type = self::get( 'header_title_subtitle_type' );
				if ( in_array( self::get( 'header_title_subtitle_type' ), array( 'inherit', NULL ) ) ) {
					$subtitle_type = self::get( 'post_hide_subtitle', 'global' );
					if ( $subtitle_type === NULL ) {
						$subtitle_type = 'generated';
					}
				}
			}
			return $subtitle_type;
		}


		/* Show header subtitle? */
		static function header_subtitle_custom_text() {
			$custom_text = '';
			if ( self::page_is( 'single' ) ) {
				$subtitle_type = self::get( 'header_title_subtitle_type' );
				if ( $subtitle_type == 'custom' ) {
					$custom_text = self::get( 'header_subtitle' );
				} elseif ( in_array( self::get( 'header_title_subtitle_type' ), array( 'inherit', NULL ) ) ) {
					$subtitle_type = self::get( 'post_hide_subtitle', 'global' );
					if ( $subtitle_type == 'custom' ) {
						$custom_text = self::get( 'post_custom_subtitle', 'global' );
					}
				}
			}
			return $custom_text;
		}


		static function subheader_is_displayed() {
			if ( self::page_is( 'ecommerce' ) ) {
				$add_subheader = self::get( 'header_menu_add_contacts_bar' );
				if ( in_array( $add_subheader, array( 'inherit', NULL ) ) ) {
					$add_subheader = self::get( 'woocommerce_header_menu_add_contacts_bar', 'global' );
					if ( in_array( $add_subheader, array( 'inherit', NULL ) ) ) {
						$add_subheader = self::get( 'header_menu_hide_contacts_bar', 'global' );
						$add_subheader = ( $add_subheader ) ? 'no' : 'yes';
					}
				}
			} else {
				$add_subheader = self::get( 'header_menu_add_contacts_bar' );
				if ( in_array( $add_subheader, array( 'inherit', NULL ) ) ) {
					$add_subheader = self::get( 'header_menu_hide_contacts_bar', 'global' );
					$add_subheader = ( $add_subheader ) ? 'no' : 'yes';
				}
			}
			if ( $add_subheader == 'yes' ) {
				$subheader_have_nums = have_rows( 'global_header_menu_contacts_bar_phone_numbers', 'option' );
				$subheader_have_emails = have_rows( 'global_header_menu_contacts_bar_emails', 'option' );
				$subheader_have_social = have_rows( 'global_header_menu_contacts_bar_social_links', 'option' );
				$subheader_additional = self::get( 'header_menu_contacts_bar_additional', 'global' );
				if ( ! ( $subheader_have_nums || $subheader_have_emails || $subheader_additional || $subheader_have_social ) ) {
					$add_subheader = 'no';
				}
			}
			return (bool) ( $add_subheader == 'yes' );
		}


		/* Show breadcrumbs? */
		static function breadcrumbs_is_displayed() {
			if ( self::page_is( 'single' ) ) {
				$show_breadcrumbs = self::get( 'post_show_breadcrumbs' );
				if ( in_array( $show_breadcrumbs, array( 'inherit', NULL ) ) ) {
					$show_breadcrumbs = self::get( 'blog_page_show_breadcrumbs', 'global' );
					if ( in_array( $show_breadcrumbs, array( 'inherit', NULL ) ) ) {
						$show_breadcrumbs = self::get( 'page_show_breadcrumbs', 'global' );
						if ( $show_breadcrumbs || $show_breadcrumbs === NULL ) {
							$show_breadcrumbs = ( $show_breadcrumbs || $show_breadcrumbs === NULL ) ? 'yes' : 'no';
						}
					}
				}
			} elseif ( self::page_is( 'ecommerce' ) ) {
				$show_breadcrumbs = self::get( 'page_show_breadcrumbs' );
				if ( in_array( $show_breadcrumbs, array( 'inherit', NULL ) ) ) {
					$show_breadcrumbs = self::get( 'woocommerce_page_show_breadcrumbs', 'global' );
					if ( in_array( $show_breadcrumbs, array( 'inherit', NULL ) ) ) {
						$show_breadcrumbs = self::get( 'page_show_breadcrumbs', 'global' );
						$show_breadcrumbs = ( $show_breadcrumbs || $show_breadcrumbs === NULL ) ? 'yes' : 'no';
					}
				}
			} elseif ( self::page_is( 'project' ) ) {
				$show_breadcrumbs = self::get( 'page_show_breadcrumbs' );
				if ( in_array( $show_breadcrumbs, array( 'inherit', NULL ) ) ) {
					$show_breadcrumbs = self::get( 'project_show_breadcrumbs', 'global' );
					if ( in_array( $show_breadcrumbs, array( 'inherit', NULL ) ) ) {
						$show_breadcrumbs = self::get( 'page_show_breadcrumbs', 'global' );
						$show_breadcrumbs = ( $show_breadcrumbs || $show_breadcrumbs === NULL ) ? 'yes' : 'no';
					}
				}
			} else {
				$show_breadcrumbs = self::get( 'page_show_breadcrumbs' );
				if ( in_array( $show_breadcrumbs, array( 'inherit', NULL ) ) ) {
					$show_breadcrumbs = self::get( 'page_show_breadcrumbs', 'global' );
					$show_breadcrumbs = ( $show_breadcrumbs || $show_breadcrumbs === NULL ) ? 'yes' : 'no';
				}
			}
			return (bool) ( $show_breadcrumbs == 'yes' );
		}


		/* Show breadcrumbs home slug? */
		static function breadcrumbs_home_slug_is_displayed() {
			$show_home_slug = self::get( 'page_show_home_breadcrumb', 'global' );
			if ( $show_home_slug === NULL ) {
				$show_home_slug = true;
			}
			return (bool) $show_home_slug;
		}


		/* Show breadcrumbs portfolio slug? */
		static function breadcrumbs_portfolio_slug_is_displayed() {
			$show_portfolio_slug = self::get( 'portfolio_hide_breadcrumb_slug', 'global' );
			if ( $show_portfolio_slug === NULL ) {
				$show_portfolio_slug = true;
			} else {
				$show_portfolio_slug = ! $show_portfolio_slug;
			}
			return (bool) $show_portfolio_slug;
		}


		/* Show breadcrumbs categories filter? */
		static function breadcrumbs_cats_filter_is_displayed() {
			$show_cats_filter = self::get( 'breadcrumbs_show_cats', 'global' );
			if ( $show_cats_filter === NULL ) {
				$show_cats_filter = true;
			}
			return (bool) $show_cats_filter;
		}


		/* Show breadcrumbs tags filter? */
		static function breadcrumbs_tags_filter_is_displayed() {
			$show_tags_filter = self::get( 'breadcrumbs_show_tags', 'global' );
			if ( $show_tags_filter === NULL ) {
				$show_tags_filter = true;
			}
			return (bool) $show_tags_filter;
		}


		/* Show breadcrumbs authors filter? */
		static function breadcrumbs_authors_filter_is_displayed() {
			$show_authors_filter = self::get( 'breadcrumbs_show_author', 'global' );
			if ( $show_authors_filter === NULL ) {
				$show_authors_filter = true;
			}
			return (bool) $show_authors_filter;
		}


		/* Add wrapper to page? */
		static function page_is_wrapped() {
			if ( self::page_is( 'single' ) ) {
				$page_wrapped = self::get( 'post_page_add_wrapper' );
				if ( in_array( $page_wrapped, array( 'inherit', NULL ) ) ) {
					$page_wrapped = self::get( 'post_page_add_wrapper', 'global' );
					if ( in_array( $page_wrapped, array( 'inherit', NULL ) ) ) {
						$page_wrapped = ( self::get( 'page_is_wrapped', 'global' ) ) ? 'yes' : 'no';
					}
				}
			} elseif ( self::page_is( 'ecommerce' ) ) {
				$page_wrapped = self::get( 'page_is_wrapped' );
				if ( in_array( $page_wrapped, array( 'inherit', NULL ) ) ) {
					$page_wrapped = self::get( 'woocommerce_page_is_wrapped', 'global' );
					if ( in_array( $page_wrapped, array( 'inherit', NULL ) ) ) {
						$page_wrapped = ( self::get( 'page_is_wrapped', 'global' ) ) ? 'yes' : 'no';
					}
				}
			} else {
				$page_wrapped = self::get( 'page_is_wrapped' );
				if ( in_array( $page_wrapped, array( 'inherit', NULL ) ) ) {
					$page_wrapped = ( self::get( 'page_is_wrapped', 'global' ) ) ? 'yes' : 'no';
				}
			}
			return (bool) ( $page_wrapped == 'yes' );
		}


		/* Return slug for home page */
		static function breadcrumbs_home_slug() {
			$home_slug = self::get( 'page_home_breadcrumb_slug', 'global' );
			if ( ! $home_slug ) {
				$home_slug = __( 'Home', 'argenta' );
			}
			return $home_slug;
		}


		/* Return slug for home page */
		static function breadcrumbs_portfolio_slug() {
			$portfolio_slug = self::get( 'portfolio_breadcrumb_slug', 'global' );
			if ( ! $portfolio_slug ) {
				$portfolio_slug = __( 'Portfolio', 'argenta' );
			}
			return $portfolio_slug;
		}


		/* Return number of posts on blog page */
		static function posts_per_page() {
			$posts_count = self::get( 'blog_posts_per_page', 'global' );
			if ( ! $posts_count || ! is_numeric( $posts_count ) || $posts_count < 1 ) {
				$posts_count = get_option( 'posts_per_page' );
			}
			return ( $posts_count ) ? $posts_count : 15;
		}


		/* Logo is loaded image? */
		static function logo_is_image() {
			return ( self::get( 'logo_type', 'global' ) == 'image' );
		}


		/* Add color overlay to header title? */
		static function header_title_use_overlay() {
			$use_overlay = false;

			if ( self::page_is( 'single' ) ) {
				if ( self::get( 'post_title_use_overlay' ) == 'yes' ) {
					$use_overlay = true;
				} elseif ( in_array( self::get( 'post_title_use_overlay' ), array( 'inherit', NULL ) ) ) {
					if ( in_array( self::get( 'post_use_title_overlay', 'global' ), array( '1', true, NULL ) ) ) {
						$use_overlay = true;
					} else {
						if ( in_array( self::get( 'header_use_overlay', 'global' ), array( '1', true, NULL ) ) ) {
							$use_overlay = true;
						}
					}
				}
			} elseif ( self::page_is( 'ecommerce' ) ) {
				if ( self::get( 'header_use_overlay' ) == 'yes' ) {
					$use_overlay = true;
				} elseif ( in_array( self::get( 'header_use_overlay' ), array( 'inherit', NULL ) ) ) {
					if ( self::get( 'woocommerce_header_use_overlay', 'global' ) == 'yes' ) {
						$use_overlay = true;
					} elseif ( in_array( self::get( 'woocommerce_header_use_overlay', 'global' ), array( 'inherit', NULL ) ) ) {
						if ( self::get( 'header_use_overlay', 'global' ) ) {
							$use_overlay = true;
						} elseif ( self::get( 'header_use_overlay', 'global' ) === NULL ) {
							$use_overlay = true;
						}
					}
				}
			} elseif ( self::page_is( 'project' ) ) {
				if ( self::get( 'header_use_overlay' ) == 'yes' ) {
					$use_overlay = true;
				} elseif ( in_array( self::get( 'header_use_overlay' ), array( 'inherit', NULL ) ) ) {
					if ( self::get( 'portfolio_use_title_overlay', 'global' ) == 'yes' ) {
						$use_overlay = true;
					} elseif ( in_array( self::get( 'portfolio_use_title_overlay', 'global' ), array( 'inherit', NULL ) ) ) {
						if ( self::get( 'header_use_overlay', 'global' ) ) {
							$use_overlay = true;
						} elseif ( self::get( 'header_use_overlay', 'global' ) === NULL ) {
							$use_overlay = true;
						}
					}
				}
			} else {
				if ( self::get( 'header_use_overlay' ) == 'yes' ) {
					$use_overlay = true;
				} elseif ( in_array( self::get( 'header_use_overlay' ), array( 'inherit', NULL ) ) ) {
					if ( self::get( 'header_use_overlay', 'global' ) ) {
						$use_overlay = true;
					} elseif ( self::get( 'header_use_overlay', 'global' ) === NULL ) {
						$use_overlay = true;
					}
				}
			}
			return $use_overlay;
		}


		/* Return menu type (humburger or nav list) */
		static function menu_type() {
			$menu_type = self::get( 'menu_type' );
			if ( in_array( $menu_type, array( 'inherit', NULL ) ) ) {
				if ( self::page_is( 'product' ) ) {
					$menu_type = self::get( 'woocommerce_menu_type', 'global' );
					if ( in_array( $menu_type, array( 'inherit', NULL ) ) ) {
						$menu_type = self::get( 'menu_type', 'global' );
					}
				} else {
					$menu_type = self::get( 'menu_type', 'global' );
				}
			}
			if ( ! $menu_type ) { $menu_type = 'full'; }
			return $menu_type;
		}


		/* Add centred wrapper to header? */
		static function header_use_wrapper() {
			$use_wrapper = self::get( 'header_menu_use_wrapper' );
			if ( in_array( $use_wrapper, array( 'inherit', NULL ) ) ) {
				if ( self::page_is( 'ecommerce' ) ) {
					$use_wrapper = self::get( 'woocommerce_header_menu_use_wrapper', 'global' );
					if ( in_array( $use_wrapper, array( 'inherit', NULL ) ) ) {
						$use_wrapper = self::get( 'header_menu_use_wrapper', 'global' );
						$use_wrapper = ( $use_wrapper ) ? 'yes' : 'no';
					}
				} else {
					$use_wrapper = self::get( 'header_menu_use_wrapper', 'global' );
					$use_wrapper = ( $use_wrapper ) ? 'yes' : 'no';
				}
			}
			return ( bool ) ( $use_wrapper == 'yes' );
		}


		/* Fix header when scroll? */
		static function header_is_fixed() {
			$is_fixed = self::get( 'header_menu_fixed' );
			if ( in_array( $is_fixed, array( 'inherit', NULL ) ) ) {
				if ( self::page_is( 'ecommerce' ) ) {
					$is_fixed = self::get( 'woocommerce_header_menu_fixed', 'global' );
					if ( in_array( $is_fixed, array( 'inherit', NULL ) ) ) {
						$is_fixed = self::get( 'header_menu_fixed', 'global' );
						$is_fixed = ( $is_fixed ) ? 'yes' : 'no';
					}
				} else {
					$is_fixed = self::get( 'header_menu_fixed', 'global' );
					$is_fixed = ( $is_fixed ) ? 'yes' : 'no';
				}
			}
			if ( self::page_is( 'project' ) ) {
				$project_layout_type = self::get( 'project_layout_type' );
				if ( in_array( $project_layout_type, array( 'inherit', NULL ) ) ) {
					$project_layout_type = self::get( 'project_layout_type', 'global' );
				}
				if ( in_array( $project_layout_type, array( 'type_1', 'type_2', 'type_3' ) ) ) {
					$is_fixed = 'no';
				}
			}
			return ( bool ) ( $is_fixed == 'yes' );
		}


		/* Add vertical paddings for this page? */
		static function page_add_top_padding() {
			$add_content_padding = self::get( 'page_add_top_padding' );
			if ( in_array( $add_content_padding, array( 'inherit', NULL ) ) ) {
				$add_content_padding = self::get( 'page_add_top_padding', 'global' );
				if ( $add_content_padding ) { $add_content_padding = true; }
				$add_content_padding = ( $add_content_padding ) ? 'yes' : 'no';
			}
			return (bool) ( $add_content_padding == 'yes' );
		}


		/* Show copyright section in footer? */
		static function footer_copytight_is_displayed() {
			$show_copyright = self::get( 'footer_show_copyright_section' );
			if ( in_array( $show_copyright, array( 'inherit', NULL ) ) ) {
				if ( self::page_is( 'ecommerce' ) ) {
					$show_copyright = self::get( 'woocommerce_footer_show_copyright_section', 'global' );
					if ( in_array( $show_copyright, array( 'inherit', NULL ) ) ) {
						$show_copyright = self::get( 'footer_hide_copyright', 'global' );
						if ( $show_copyright === NULL ) {
							return NULL;
						} else {
							$show_copyright = ( $show_copyright ) ? 'no' : 'yes';
						}
					}
				} else {

					$show_copyright = self::get( 'footer_hide_copyright', 'global' );
					if ( $show_copyright === NULL ) {
						return NULL;
					} else {
						$show_copyright = ( $show_copyright ) ? 'no' : 'yes';
					}
				}
			}
			return (bool) ( $show_copyright == 'yes' );
		}

		/* Footer is sticky? */
		static function footer_is_sticky() {
			$sticky_footer = self::get( 'footer_as_sticky' );
			if ( in_array( $sticky_footer, array( 'inherit', NULL ) ) ) {
				if ( self::page_is( 'ecommerce' ) ) {
					$sticky_footer = self::get( 'woocommerce_footer_is_sticky', 'global' );
					if ( in_array( $sticky_footer, array( 'inherit', NULL ) ) ) {
						$sticky_footer = self::get( 'footer_is_sticky', 'global' );
						$sticky_footer = ( $sticky_footer ) ? 'yes' : 'no';
					}
				} else {
					$sticky_footer = self::get( 'footer_is_sticky', 'global' );
					$sticky_footer = ( $sticky_footer ) ? 'yes' : 'no';
				}
			}
			return ( bool ) ( $sticky_footer == 'yes' );
		}


		/* Add wrapper to footer? */
		static function footer_is_wrapped() {
			$footer_wrapped = self::get( 'footer_is_wrapped' );
			if ( in_array( $footer_wrapped, array( 'inherit', NULL ) ) ) {
				if ( self::page_is( 'ecommerce' ) ) {
					$footer_wrapped = self::get( 'woocommerce_footer_is_wrapped', 'global' );
					if ( in_array( $footer_wrapped, array( 'inherit', NULL ) ) ) {
						$footer_wrapped = self::get( 'footer_is_wrapped', 'global' );
						$footer_wrapped = ( $footer_wrapped ) ? 'yes' : 'no';
					}
				} else {
					$footer_wrapped = self::get( 'footer_is_wrapped', 'global' );
					$footer_wrapped = ( $footer_wrapped ) ? 'yes' : 'no';
				}
			}
			return ( bool ) ( $footer_wrapped == 'yes' );
		}


		/* Hide footer from this page? */
		static function footer_is_hidden() {
			$hide_footer = self::get( 'footer_hide' );
			if ( in_array( $hide_footer, array( 'inherit', NULL ) ) ) {
				if ( in_array( $hide_footer, array( 'inherit', NULL ) ) ) {
					$hide_footer = self::get( 'woocommerce_footer_hide', 'global' );
					if ( in_array( $hide_footer, array( 'inherit', NULL ) ) ) {
						$hide_footer = self::get( 'footer_hide', 'global' );
						$hide_footer = ( $hide_footer ) ? 'yes' : 'no';
					}
				} else {
					$hide_footer = self::get( 'footer_hide', 'global' );
					$hide_footer = ( $hide_footer ) ? 'yes' : 'no';
				}
			}
			return (bool) ( $hide_footer == 'yes' );
		}


		/* Current page is boxed? */
		static function page_is_boxed() {
			if ( self::page_is( 'single' ) ) {
				$is_boxed = self::get( 'post_use_boxed_wrapper' );
				if ( in_array( $is_boxed, array( 'inherit', NULL ) ) ) {
					$is_boxed = self::get( 'post_use_boxed_wrapper', 'global' );
					if ( in_array( $is_boxed, array( 'inherit', NULL ) ) ) {
						$is_boxed = ( self::get( 'page_use_boxed_wrapper', 'global' ) ) ? 'yes' : 'no';
					}
				}
			}
			if ( self::page_is( 'ecommerce' ) ) {
				$is_boxed = self::get( 'page_use_boxed_wrapper' );
				if ( in_array( $is_boxed, array( 'inherit', NULL ) ) ) {
					$is_boxed = self::get( 'woocommerce_use_boxed_wrapper', 'global' );
					if ( in_array( $is_boxed, array( 'inherit', NULL ) ) ) {
						$is_boxed = ( self::get( 'page_use_boxed_wrapper', 'global' ) ) ? 'yes' : 'no';
					}
				}
			} else {
				$is_boxed = self::get( 'page_use_boxed_wrapper' );
				if ( in_array( $is_boxed, array( 'inherit', NULL ) ) ) {
					$is_boxed = ( self::get( 'page_use_boxed_wrapper', 'global' ) ) ? 'yes' : 'no';
				}
			}
			return (bool) ( $is_boxed == 'yes' );
		}


		/* Return header title content aligment */
		static function header_title_align() {
			if ( self::page_is( 'single' ) ) {
				if ( in_array( self::get( 'post_header_title_align' ), array( NULL, 'inherit' ) ) ) {
					if ( in_array( self::get( 'post_header_title_align', 'global' ), array( NULL, 'inherit' ) ) ) {
						$title_align = self::get( 'header_title_align', 'global' );
					} else {
						$title_align = self::get( 'post_header_title_align', 'global' );
					}
				} else {
					$title_align = self::get( 'post_header_title_align' );
				}
			} elseif ( self::page_is( 'ecommerce' ) ) {
				if ( in_array( self::get( 'header_title_align' ), array( NULL, 'inherit' ) ) ) {
					if ( in_array( self::get( 'woocommerce_header_title_align', 'global' ), array( NULL, 'inherit' ) ) ) {
						$title_align = self::get( 'header_title_align', 'global' );
					} else {
						$title_align = self::get( 'woocommerce_header_title_align', 'global' );
					}
				} else {
					$title_align = self::get( 'header_title_align' );
				}
			} elseif ( self::page_is( 'project' ) ) {
				if ( in_array( self::get( 'header_title_align' ), array( NULL, 'inherit' ) ) ) {
					if ( in_array( self::get( 'portfolio_header_title_align', 'global' ), array( NULL, 'inherit' ) ) ) {
						$title_align = self::get( 'header_title_align', 'global' );
					} else {
						$title_align = self::get( 'portfolio_header_title_align', 'global' );
					}
				} else {
					$title_align = self::get( 'header_title_align' );
				}
			} else {
				if ( in_array( self::get( 'header_title_align' ), array( NULL, 'inherit' ) ) ) {
					$title_align = self::get( 'header_title_align', 'global' );
				} else {
					$title_align = self::get( 'header_title_align' );
				}
			}
			return ( $title_align ) ? $title_align : 'center';
		}


		/* Add WPML language select ot header? */
		static function wpml_menu_item_is_displayed() {
			$wpml_show_in_header = self::get( 'wpml_show_in_header', 'global' );
			return ( $wpml_show_in_header === false ) ? false : true;
		}

	}
