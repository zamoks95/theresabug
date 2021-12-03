<?php

	/**
	* Parse global array with PixelLove font icons
	*/
	function argenta_gh_parse_pixellove_fonts( $list ) {
		if ( is_array( $list ) && count( $list ) > 0 ) {
			$pixellove = array();
			foreach ( $list as $font_class ) {
				if ( substr( $font_class, 0, 6 ) == 'fa fa-' ) { // fontawesome required
					$icon_key = "fontawesome";
				} if ( substr( $font_class, 0, 6 ) == 'linea-' ) { // linea required
					$icon_key = 'linea-' . substr( substr( $font_class, 6 ), 0, strpos( substr( $font_class, 6 ), '-' ) );
				} else {
					$icon_key = substr( substr( $font_class, 8 ), 0, strpos( substr( $font_class, 8 ), '-' ) );
				}
				$icon_value = argenta_gh_insert_pixellove_link( $icon_key );
				if ( $icon_value ) {
					$pixellove[$icon_key] = $icon_value;
				}			
			}
			return $pixellove;
		} else {
			return false;
		}
	}


	/**
	* Parse post data from object
	*/
	function argenta_gh_parse_post_object( $_post ) {
		$format = get_post_format( $_post->ID );
		// date
		$date = get_the_date( get_option( 'date_format' ), $_post->ID );
		// title
		$title = $_post->post_title;
		if ( ! $title ) {
			$title = '[' . $date . ']';
		}
		// url
		$url = get_permalink( $_post->ID );
		// author
		$author = get_the_author_meta( 'display_name', $_post->post_author );
		// categories
		$categories = wp_get_post_categories( $_post->ID );
		foreach ($categories as $_i => $_category) {
			$categories[$_i] = get_category( $_category );
		}
		// preview
		$content_preview = argenta_lh_post_get_the_excerpt( $_post->ID );
		if ( ! $content_preview ) {
			$content_preview = preg_replace( '/\[.+?\]/', '', $_post->post_content );
		}
		$content_preview = wp_trim_words( strip_tags( $content_preview ), 35 );
		// overlay
		$overlay = get_field( 'post_overlay_color', $_post->ID );
		// thumbnail
		$image_id = get_post_thumbnail_id( $_post->ID );
		if ( $image_id ) {
			$image = wp_get_attachment_image_src( $image_id, 'large' );
			if ( is_array( $image ) ) {
				$img_url = $image[0];
				// fix vertical images
				if ( $image[1] < $image[2] ) {
					$_image_basename = basename( get_attached_file( $image_id ) );
					$_image_new_basename = substr( $_image_basename, 0, strrpos( $_image_basename, '.' ) ) . '-' . $image[1] . 'x' . $image[1] . substr( $_image_basename, strrpos( $_image_basename, '.' ));
					$_image_new_uri = str_replace( $_image_basename, $_image_new_basename, get_attached_file( $image_id ) );
					$_image_new_url = str_replace( $_image_basename, $_image_new_basename, $image[0] );
					if ( file_exists( $_image_new_uri ) ) {
						$img_url = $_image_new_url;
					} else {
						$_image = wp_get_image_editor( get_attached_file( $image_id ) );
						if ( ! is_wp_error( $_image ) ) {
							$_image->resize( $image[1], $image[1] - ( (int) ( $image[1] / 3 ) ), true );
							if ( $_image->save( $_image_new_uri ) ) {
								$img_url = $_image_new_url;
							}
						}
					}
				}
			} else {
				$img_url = $image;
			}
		} else {
			$img_url = false;
		}
		// check audio content
		$audio = false;


		if ( $format == 'audio' ) {
			preg_match( '/\[audio.+?\](\s)*(\[\/audio\])?/', $_post->post_content, $audio_matches);
			preg_match( '/\<iframe[^\>]*soundcloud\.com\/player[^\>]*>(\s)*(\<\/iframe\>)?/', $_post->post_content, $soundcloud_matches);
			if ( is_array( $audio_matches ) && $audio_matches ) {
				$audio = do_shortcode( $audio_matches[0] );
			}
			if ( is_array( $soundcloud_matches ) && $soundcloud_matches ) {
				if ( is_array( $audio_matches ) && $audio_matches ) {
					if ( strpos( $_post->post_content, $soundcloud_matches[0] ) < strpos( $_post->post_content, $audio_matches[0] ) ) {
						$audio = $soundcloud_matches[0];
					}
				} else {
					$audio = $soundcloud_matches[0];
				}
			}
		}
		// check video
		$video = false;
		if ( $format == 'video' ) {
			preg_match( '/\[video.+?\](\s)*(\[\/video\])?/', $_post->post_content, $video_matches );
			preg_match( '/(http:|https:)?\/\/(www\.)?youtube\.com\/watch?[^\s\"\]]*/', $_post->post_content, $youtube_link_matches );
			preg_match( '/(http:|https:)?\/\/(www\.)?vimeo\.com\/[\d]+[^\s\"\]]*/', $_post->post_content, $vimeo_link_matches );
			preg_match( '/\<iframe[^\>]*youtube\.com\/embed[^\>]*>(\s)*(\<\/iframe\>)?/', $_post->post_content, $youtube_frame_matches );
			preg_match( '/\<iframe[^\>]*vimeo\.com\/video[^\>]*>(\s)*(\<\/iframe\>)?/', $_post->post_content, $vimeo_frame_matches );
			if ( is_array( $video_matches ) && $video_matches ) {
				$video = do_shortcode( $video_matches[0] );
			}
			if ( is_array( $vimeo_link_matches ) && $vimeo_link_matches ) {
				$video_key = urlencode( substr( $vimeo_link_matches[0], strpos( $vimeo_link_matches[0], 'vimeo.com/' ) + 10 ) );
				$video = '<iframe src="https://player.vimeo.com/video/' . $video_key . '" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" frameborder="0"></iframe>';
			}
			if ( is_array( $vimeo_frame_matches ) && $vimeo_frame_matches ) {
				$vimeo_frame_matches[0] = preg_replace( array( '/height\=\"[\d]+?\"/', '/width\=\"[\d]+?\"/' ), '', $vimeo_frame_matches[0] );
				$video = do_shortcode( $vimeo_frame_matches[0] );
			}
			if ( is_array( $youtube_link_matches ) && $youtube_link_matches ) {
				$video_key = urlencode( substr( $youtube_link_matches[0], strpos( $youtube_link_matches[0], 'v=' ) + 2 ) );
				$video = '<iframe src="https://www.youtube.com/embed/' . $video_key . '" frameborder="0" allowfullscreen></iframe>';
			}
			if ( is_array( $youtube_frame_matches ) && $youtube_frame_matches ) {
				$youtube_frame_matches[0] = preg_replace( array( '/height\=\"[\d]+?\"/', '/width\=\"[\d]+?\"/' ), '', $youtube_frame_matches[0] );
				$video = do_shortcode( $youtube_frame_matches[0] );
			}
		}
		// check blockquote content
		$blockquote = false;
		if ( $format == 'quote' ) {
			preg_match( '/\<blockquote(.|\s)*?\>(.|\s)+?\<\/blockquote\>/', $_post->post_content, $blockquotes_matches );
			if ( is_array( $blockquotes_matches ) && $blockquotes_matches ) {
				$blockquote = $blockquotes_matches[0];
				$blockquote = wp_kses( str_replace( '\<a.*?\>', '', $blockquote ), 'default' );
			}
		}
		// check gallery content
		$gallery = false;
		if ( $format == 'gallery' ) {
			preg_match( '/\[gallery.*?\]/', $_post->post_content, $galleries_matches );
			if ( is_array( $galleries_matches ) && $galleries_matches ) {
				$gallery = do_shortcode( $galleries_matches[0] );
			}
		}
		if ( get_field( 'blog_item_layout_type' ) && get_field( 'blog_item_layout_type' ) != 'inherit' ) {
			$boxed = (bool) get_field( 'blog_items_boxed_style' );
		} else {
			$boxed = get_field( 'global_blog_items_boxed_style', 'option' );

			if ( $boxed === NULL ) {
				$boxed = true;
			} else {
				$boxed = (bool) get_field( 'global_blog_items_boxed_style', 'option' );
			}
		}
		// grid style
		$grid_style = get_field( 'post_style_in_grid', $_post->ID );

		return array(
			'post_id' => $_post->ID,
			'date' => $date,
			'media' => array(
				'image' => $img_url,
				'audio' => $audio,
				'video' => $video,
				'gallery' => $gallery,
				'blockquote' => $blockquote
			),
			'url' => $url,
			'title' => $title,
			'preview' => $content_preview,
			'overlay' => $overlay,
			'categories' => $categories,
			'author' => $author,
			'boxed' => $boxed,
			'grid_style' => $grid_style
		);
	}


	/*
	* Get post excerpt
	*/
	function argenta_lh_post_get_the_excerpt( $post_id ) {
		global $post;
		$save_post = $post;
		$post = get_post( $post_id );
        $output = get_the_excerpt();
		$post = $save_post;
		return $output;
	}


	/*
	* Get new post gallery layout
	*/
	function argenta_gh_parse_gallery_layout( $atts = false ) {
		if ( $atts && isset( $atts['ids'] ) ) {
			$attach_ids = explode( ',', $atts['ids'] );
		} else {
			return false;
		}

		$layout = '<div class="slider blog-slider" data-slider-simple="true">';
		foreach ($attach_ids as $attach_id) {
			$_url = wp_get_attachment_url( $attach_id );
			$layout .= '<img class="full-width" src="' . esc_url( $_url ) . '" alt="' . esc_attr__( 'Gallery slide', 'argenta' ) . '">';
		}
		$layout .= '</div>';
		return $layout;
	}


	/*
	* Return pagination layout
	*/
	function argenta_gh_parse_page_pagination_layout( $current_page, $all_pages ) {
		$current_page = (int) $current_page;
		$all_pages = (int) $all_pages;
		if ( $current_page < 1 ) {
			$current_page = 1;
		}
		if ( $current_page > $all_pages ) {
			$current_page = $all_pages;
		}

		$_range = array();
		if ( $all_pages > 5 ) {
			// first item
			$_range[] = 1;
			// border ranges
			if ( $current_page <= 4 ) {
				$_range[] = 2;
				$_range[] = 3;
			}
			if ( $current_page >= $all_pages - 3 ) {
				$_range[] = $all_pages - 2;
				$_range[] = $all_pages - 1;
			}
			// inner ranges
			$_range[] = $current_page;
			if ( $current_page > 1 ) {
				$_range[] = $current_page - 1;
			}
			if ( $current_page < $all_pages ) {
				$_range[] = $current_page + 1;
			}
			// first item
			$_range[] = $all_pages;

			sort( $_range );
			$new_range = array_values( array_unique( $_range ) );
			$ranges = array();
			foreach ($new_range as $_range_key => $_range_value) {
				$ranges[] = $_range_value;
				if ( $_range_key < count( $new_range ) - 1 && $_range_value + 1 != $new_range[ $_range_key + 1 ] ) {
					$ranges[] = '...';
				}
			}

		} else { // fast variant
			for ($i=1; $i <= $all_pages; $i++) { 
				$ranges[] = $i;
			}
		}

		$layout = '<nav class="pagination"><ul>';
		// prev button
		if ( $current_page > 1 ) {
			$layout .= '<li class="prev"><a href="' . esc_url( get_pagenum_link( $current_page - 1 ) ) . '" class="page-numbers">';
			$layout .= '<span class="icon-left ion-ios-arrow-left"></span> ' . esc_html__( 'PREV', 'argenta' );
			$layout .= '</a></li>';
		}
		// other button layout
		foreach ($ranges as $value) {
			if ( $value == '...' ) {
				$layout .= '<li><span class="page-numbers">...</span></li>';
			} else {
				$layout .= '<li><a href="' . esc_url( get_pagenum_link( $value ) ) . '" class="page-numbers' . ( ( $current_page == $value ) ? ' active' : '' ) . '">' . esc_html( $value ) . '</a></li>';
			}
		}
		// next button
		if ( $current_page < $all_pages ) {
			$layout .= '<li class="next"><a href="' . esc_url( get_pagenum_link( $current_page + 1 ) ) . '" class="page-numbers">';
			$layout .= esc_html__( 'NEXT', 'argenta' ) . ' <span class="icon-right ion-ios-arrow-right"></span>';
			$layout .= '</a></li>';
		}

		$layout .= '</ul></nav>';
        echo wp_kses( $layout, 'post' );
	}


	/*
	* Project post
	*/
	function argenta_gh_get_project_settings( $post ) {
		$project = array();
		// title
		$project['title'] = get_the_title( $post->ID );
		if ( ! $project['title'] ) {
			$project['title'] = '[' . get_the_date( get_option( 'date_format' ), $post->ID ) . ']';
		}
		// custom content position
		$project['custom_content_position'] = get_field( 'project_custom_content_position', $post->ID );
		if ( in_array( $project['custom_content_position'], array( 'inherit', NULL ) ) ) {
			$project['custom_content_position'] = get_field( 'global_project_custom_content_position', 'option' );
			if ( $project['custom_content_position'] == NULL ) {
				$project['custom_content_position'] = 'top';
			}
		}
		// description
		$project['description'] = trim( get_field( 'project_description', $post->ID ) );
		$project['short_description'] = strip_tags( trim( get_field( 'project_description', $post->ID ) ) );
		if ( ! $project['short_description'] ) {
			$project['short_description'] = '';
		} elseif ( strlen( $project['short_description'] ) > 160 ) {
			$project['short_description'] = substr( $project['short_description'], 0, 160 ) . '&hellip;';
		}
		// images
        $project['images'] = get_field( 'project_content', $post->ID );
        if ( is_array( $project['images'] ) && count( $project['images'] ) > 0 ) {
            foreach ( $project['images'] as $key => $value ) {
                if ( $value && is_string( $value ) ) {
                    $project['images'][$key] = wp_get_attachment_url( $value );
                } elseif ( is_array( $value ) ) {
                    $project['images'][$key] = $value['sizes']['large'];
                }
            }
        } else {
            $project['images'] = array();
        }

        if (has_post_thumbnail($post) ) {
            array_unshift($project['images'], get_the_post_thumbnail_url($post, 'large'));
        }

		// info
		$project['date'] = get_field( 'project_date', $post->ID );
		$project['task'] = get_field( 'project_task', $post->ID );
		$project['skills'] = get_field( 'project_skills', $post->ID );
		$project['client'] = get_field( 'project_client', $post->ID );
		$project['link'] = get_field( 'project_link', $post->ID );
		// custom info
		$project['custom_fields'] = array();
		$_custom_fields = get_field( 'project_custom_fields', $post->ID );
		if ( is_array( $_custom_fields ) && $_custom_fields ) {
			foreach ( $_custom_fields as $field ) {
				$project['custom_fields'][] = array(
					'title' => $field['project_custom_field_title'],
					'value' => $field['project_custom_field_value']
				);
			}
		}
		// show navigation
		$project['show_navigation'] = get_field( 'project_show_navigation', $post->ID );
		if ( $project['show_navigation'] == 'inherit' ) {
			$project['show_navigation'] = get_field( 'global_project_show_navigation', 'option' );
		}
		// navigation position
		$project['navigation_position'] = get_field( 'project_navigation_position', $post->ID );
		if ( $project['navigation_position'] == 'inherit' || $project['navigation_position'] == NULL ) {
			$project['navigation_position'] = get_field( 'global_project_navigation_position', 'option' );
			
			if ( $project['navigation_position'] == NULL ) {
				$project['navigation_position'] = 'bottom';
			}
		}
		// breadcrumbs
		$project['hide_breadcrumbs'] = get_field( 'project_hide_breadcrumbs', $post->ID );
		if ( $project['hide_breadcrumbs'] == 'inherit' ) {
			$project['hide_breadcrumbs'] = get_field( 'global_project_hide_breadcrumbs', 'option' );
		} else {
			$project['hide_breadcrumbs'] = ( get_field( 'project_hide_breadcrumbs' ) == 'yes' );
		}
		// sharing
		$project['hide_sharing'] = get_field( 'global_project_hide_sharing_buttons', 'option' );
		$project['sharing_links'] = get_field( 'global_project_social_sharing_buttons', 'option' );
		// portfolio link
		$project['link_to_all'] = get_field( 'global_portfolio_page', 'option' );
		if ( ! $project['link_to_all'] ) {
			$project['link_to_all'] = esc_url( home_url( '/' ) );
		}
		// categories
		$_categories = wp_get_post_terms( $post->ID, 'argenta_portfolio_category' );
		$project['categories'] = $_categories;
		if ( $project['categories'] && is_array( $project['categories'] ) && count( $project['categories'] ) > 0 ) {
			$_project_categories = array();
			foreach ($project['categories'] as $category) {
				$_project_categories[] = '<span class="brand-color brand-border-color">' . $category->name . '</span>';
			}
			$project['categories'] = implode( ' ', $_project_categories );
		} else {
			$project['categories'] = '';
		}
		$project['categories_plain'] = $_categories;
		if ( $project['categories_plain'] && is_array( $project['categories_plain'] ) && count( $project['categories_plain'] ) > 0 ) {
			$_project_categories = array();
			foreach ($project['categories_plain'] as $category) {
				$_project_categories[] = $category->name;
			}
			$project['categories_plain'] = implode( ', ', $_project_categories );
		} else {
			$project['categories_plain'] = '';
		}
		$project['categories_group'] = $_categories;
		if ( $project['categories_group'] && is_array( $project['categories_group'] ) && count( $project['categories_group'] ) > 0 ) {
			$_project_categories = array();
			foreach ($project['categories_group'] as $category) {
				$_project_categories[] = 'argenta-filter-project-' . hash( 'md4', $category->slug, false );
			}
			$project['categories_group'] = implode( ' ', $_project_categories );
		} else {
			$project['categories_group'] = '';
		}
		// next n prev
		$project['next'] = get_adjacent_post( false, '', false );
		if ( is_a( $project['next'], 'WP_Post' ) ) {
			$images = get_field( 'project_content', $project['next']->ID );
			$image = ( is_array( $images ) && count( $images ) > 0 ) ? $images[0] : false;
			if ( $image && is_string( $image ) ) {
				$image = wp_get_attachment_url( $image );
			} elseif ( is_array( $image ) ) {
				$image = $image['sizes']['thumbnail'];
			}
			$project['next'] = array(
				'title' => $project['next']->post_title,
				'url' => get_permalink( $project['next']->ID ),
				'image' => $image
			);
		} else {
			$project['next'] = false;
		}
		$project['prev'] = get_adjacent_post( false, '', true );
		if ( is_a( $project['prev'], 'WP_Post' ) ) {
			$images = get_field( 'project_content', $project['prev']->ID );
			$image = ( is_array( $images ) && count( $images ) > 0 ) ? $images[0] : false;
			if ( $image && is_string( $image ) ) {
				$image = wp_get_attachment_url( $image );
			} elseif ( is_array( $image ) ) {
				$image = $image['sizes']['thumbnail'];
			}
			$project['prev'] = array(
				'title' => $project['prev']->post_title,
				'url' => get_permalink( $project['prev']->ID ),
				'image' => $image
			);
		} else {
			$project['prev'] = false;
		}
		// overlay color
		$project['overlay'] = get_field( 'project_overlay_color', $post->ID );
		if ( ! $project['overlay'] ) {
			$project['overlay'] = false;
		}
		// grid
		$project['grid_style'] = get_field( 'project_style_in_grid', $post->ID );
		// animation
		$project['with_animation'] = get_field( 'global_portfolio_with_animation', 'option' );
		if ( $project['with_animation'] == NULL ) {
			$project['with_animation'] = false;
		}
		// popup
		$project['in_popup'] = false;
		$project['popup_id'] = uniqid( 'argenta-popup-' );
		if ( get_field( 'project_open_external', $post->ID ) ) {
			$project['url'] = $project['link'];
			$project['external'] = true;
		} else {
			$project['url'] = get_post_permalink( $post->ID );
			$project['external'] = false;
		}
		return $project;
	}


	/*
	* Insert Pixellove link-tag with font style by key value
	*/
	function argenta_gh_insert_pixellove_link( $font_key ) {
		$key_allias = array(
			"arr" => "Arrows",
			"cel" => "Celebrate",
			"cha" => "Chat",
			"cle" => "Cleaning",
			"clo" => "Clothes",
			"clou" => "Cloud",
			"com" => "Computers",
			"con" => "Construction",
			"db"  => "Database",
			"des" => "Design",
			"doc" => "Documents",
			"dri" => "Drinks",
			"ema" => "Email",
			"emo" => "Emoticons",
			"fil" => "Files",
			"fin" => "Finance",
			"fol" => "Folders",
			"foo" => "Food",
			"veg" => "Fruit_N_Veg",
			"gen" => "General",
			"hou" => "Household",
			"img" => "Images",
			"ios" => "Native_iOS",
			"ui"  => "Interface",
			"net" => "Internet",
			"kit" => "Kitchen",
			"loc" => "Location",
			"mov" => "Movies",
			"mus" => "Music",
			"peo" => "People",
			"pho" => "Photography",
			"pre" => "Presentation",
			"sec" => "Security",
			"sha" => "Shapes",
			"sho" => "Shopping",
			"spa" => "Space",
			"spo" => "Sport",
			"tel" => "Telephony",
			"tim" => "Time",
			"tra" => "Transport",
			"typ" => "Typography",
			"use" => "Users",
			"veh" => "Vehicles",
			"wea" => "Weather",
			"fontawesome" => "FontAwesome",
			"linea-arrows" => "linea/arrows",
			"linea-basic" => "linea/basic",
			"linea-basic-elaboration" => "linea/basic_ela",
			"linea-ecommerce" => "linea/ecommerce",
			"linea-music" => "linea/music",
			"linea-software" => "linea/software",
			"linea-weather" => "linea/weather",
		);

		if ( isset( $key_allias[$font_key] ) ) {
			return get_template_directory_uri() . '/assets/fonts/' . $key_allias[$font_key] . '/style.css';
		} else {
			return false;
		}
	}


	/*
	* Add required script
	*/
	function argenta_gh_add_required_script( $key ) {
		$GLOBALS['cbrio_required_scripts'][] = $key;
	}


	/*
	* Check required script including
	*/
	function argenta_gh_is_script_required( $key ) {
		if  ( is_array ($GLOBALS['cbrio_required_scripts'] ) ) {
			$list = array_unique( $GLOBALS['cbrio_required_scripts'] );
			return (bool) in_array( $key, $list );
		} else {
			return false;
		}
	}


	/*
	* Bridge for locate temp variables to views
	*/
	function argenta_gh_get_current_item_data( ) {
		$temp_data = $GLOBALS['cbrio_temp_data'];
		$GLOBALS['cbrio_temp_data'] = false;
		return ( $temp_data ) ? $temp_data : false;
	}

	function argenta_gh_set_current_item_data( $data ) {
		$GLOBALS['cbrio_temp_data'] = $data;
		return true;
	}


	/*
	* All header data in function
	*/
	function argenta_gh_get_header_data() {
		global $post;
		$data = array();
		// hide header
		$hide_header_layout = false;
		if ( is_page() && $post ) {
			$hide_header_layout = ( get_page_template_slug( $post->ID ) == 'page-templates/page_for-builder.php' );
		}
		// header menu style
		$header_menu_style = ( is_product() ) ? get_field( 'global_woocommerce_header_menu_style', 'option' ) : get_field( 'header_menu_style' );
		$_header_menu_inherit = ( $header_menu_style == 'inherit' );
		if ( ! $header_menu_style || $_header_menu_inherit ) {
			$header_menu_style = get_field( 'global_header_menu_style', 'option' );
		}
		// project layout type for handling
		$project_layout_type = get_field( 'project_layout_type' );
		if ( $project_layout_type == 'inherit' ) {
			$project_layout_type = get_field( 'global_project_layout_type', 'option' );
		}
		// add subheader
		$add_subheader_value = get_field( 'header_menu_add_contacts_bar' );
		if ( ! $add_subheader_value || $add_subheader_value == 'inherit' ) {
			$add_subheader_value = get_field( 'global_header_menu_hide_contacts_bar', 'option' );
			$add_subheader_value = ! $add_subheader_value;
		} else {
			if ( $add_subheader_value === null ) {
				$add_subheader_value = false;
			} else {
				$add_subheader_value = (bool) ( $add_subheader_value == 'yes' );
			}
		}
		// for empty content condition
		if ( $add_subheader_value ) {
			$subheader_have_nums = have_rows( 'global_header_menu_contacts_bar_phone_numbers', 'option' );
			$subheader_have_emails = have_rows( 'global_header_menu_contacts_bar_emails', 'option' );
			$subheader_additional = get_field( 'global_header_menu_contacts_bar_additional', 'option' );
			$subheader_have_social = have_rows( 'global_header_menu_contacts_bar_social_links', 'option' );
			if ( ! ( $subheader_have_nums || $subheader_have_emails || $subheader_additional || $subheader_have_social ) ) {
				$add_subheader_value = false;
			}
		}

		// add header cap
		if ( $_header_menu_inherit ) {
			$add_header_cap = 'inherit';
		} else {
			$add_header_cap = ( is_product() ) ? get_field( 'global_woocommerce_header_menu_add_cap', 'option' ) : get_field( 'header_menu_add_cap' );
		}
		if ( ! $add_header_cap || $add_header_cap == 'inherit' ) {
			$add_header_cap = get_field( 'global_header_menu_add_cap', 'option' );
			if ( $add_header_cap === null ) {
				$add_header_cap = false;
			} else {
				$add_header_cap = ( $add_header_cap == 'yes' );
			}
		} else {
			$add_header_cap = ( $add_header_cap == 'yes' );
		}
		$show_header_cap = (bool) ( $add_header_cap && $header_menu_style != 'style6' );
		// Check empty subheader content
		$subheader_have_nums = have_rows( 'global_header_menu_contacts_bar_phone_numbers', 'option' );
		$subheader_have_emails = have_rows( 'global_header_menu_contacts_bar_emails', 'option' );
		$subheader_additional = get_field( 'global_header_menu_contacts_bar_additional', 'option' );
		$subheader_have_social = have_rows( 'global_header_menu_contacts_bar_social_links', 'option' );
		if ( $show_header_cap && ! ( $subheader_have_nums || $subheader_have_emails || $subheader_additional || $subheader_have_social ) ) {
			$show_header_cap = false;
		}

		$data['show'] = ! $hide_header_layout;
		$data['menu_style'] = $header_menu_style;
		$data['append_subheader'] = $add_subheader_value;
		$data['append_header_cap'] = $show_header_cap;

		return $data;
	}


	/*
	* Check is really woocommerce page ( required for fix lodash error )
	*/
	function argenta_gh_check_woocommerce_page() {
		if(  function_exists ( "is_woocommerce" ) && is_woocommerce()){
			return true;
		}

		$woocommerce_keys = array (
			"woocommerce_shop_page_id",
			"woocommerce_terms_page_id",
			"woocommerce_cart_page_id",
			"woocommerce_checkout_page_id",
			"woocommerce_pay_page_id",
			"woocommerce_thanks_page_id",
			"woocommerce_myaccount_page_id",
			"woocommerce_edit_address_page_id",
			"woocommerce_view_order_page_id",
			"woocommerce_change_password_page_id",
			"woocommerce_logout_page_id",
			"woocommerce_lost_password_page_id"
		);

		foreach ( $woocommerce_keys as $wc_page_id ) {
			if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
				return true ;
			}
		}

		return false;
	}






	function argenta_gh_is_page( $key = false ) {
		switch ( $key ) {
			case 'shop':
				return ( function_exists( 'is_shop' ) && is_shop() ) 
					|| ( function_exists( 'is_product_category' ) && is_product_category() )
					|| ( function_exists( 'is_product_tag' ) && is_product_tag() );
				break;

			case 'cart':
				return function_exists( 'is_cart' ) && is_cart();
				break;

			case 'checkout':
				return function_exists( 'is_checkout' ) && is_checkout();
				break;

			case 'account':
				return function_exists( 'is_account' ) && is_account_page();
				break;

			case 'product':
				return function_exists( 'is_product' ) && is_product();
				break;

			case 'project':
				return ( get_post_type() == 'argenta_portfolio' );
				break;

			case 'single':
				return is_single() && ( get_post_type() == 'post' );
				break;
			
			case 'search':
				return is_search();

			case 'front':
				return is_front_page();
				break;

			case 'blog_template':
				return get_page_template();
				break;
			
			case 'archive':
				return is_archive();
				break;

			case 'product_category':
				return function_exists( 'is_product_category' ) && is_product_category();

			case 'blog':
				return argenta_gh_is_page( 'front' ) || basename( argenta_gh_is_page( 'blog_template' ) ) == 'page_for-posts.php';
				break;
			
			default:
				global $wp_query;
				return $wp_query->is_page();
				break;
		}
	}