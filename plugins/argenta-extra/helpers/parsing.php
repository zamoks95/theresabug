<?php

	/**
	* Typography type parsing to array
	*/
	function argenta_extra_parse_VC_typography_to_array( $typo_value ) {
		$result_arr = array(
			'font_size' => '',
			'line_height' => '',
			'letter_spacing' => '',
			'weight' => false,
			'normal' => false,
			'italic' => false,
			'underline' => false,
			'use_custom_font' => false,
			'custom_font' => ''
		);
		
		foreach ( explode( '||', $typo_value ) as $typo_value_row ) {
			$exp = explode( '~', $typo_value_row );
			if ( $exp[0] == 'font_size' && strlen( argenta_extra_filter_string( $exp[1] ) ) > 0 ) {
				$result_arr['font_size'] = argenta_extra_filter_string( $exp[1] );
			}
			if ( $exp[0] == 'line_height' && strlen( argenta_extra_filter_string( $exp[1] ) ) > 0 ) {
				$result_arr['line_height'] = argenta_extra_filter_string( $exp[1] );
			}
			if ( $exp[0] == 'letter_spacing' && strlen( argenta_extra_filter_string( $exp[1] ) ) > 0 ) {
				$result_arr['letter_spacing'] = argenta_extra_filter_string( $exp[1] );
			}
			if ( $exp[0] == 'weight' ) {
				$result_arr['weight'] = argenta_extra_filter_string( $exp[1] );
			}
			if ( $exp[0] == 'italic' ) {
				$result_arr['italic'] = argenta_extra_filter_boolean( $exp[1] );
			}
			if ( $exp[0] == 'normal' ) {
				$result_arr['normal'] = argenta_extra_filter_boolean( $exp[1] );
			}
			if ( $exp[0] == 'underline' ) {
				$result_arr['underline'] = argenta_extra_filter_boolean( $exp[1] );
			}
			if ( $exp[0] == 'use_custom_font' ) {
				$result_arr['use_custom_font'] = argenta_extra_filter_boolean( $exp[1] );
			}
			if ( $exp[0] == 'custom_font' && strlen( argenta_extra_filter_string( $exp[1] ) ) > 0 ) {
				$result_arr['custom_font'] = argenta_extra_filter_string( $exp[1] );
			}
		}
		return $result_arr;
	}


	/**
	* Typography type parsing to CSS
	*/
	function argenta_extra_parse_VC_typography_to_CSS( $typo_value ) {
		$typo_array = argenta_extra_parse_VC_typography_to_array( $typo_value );
		$result_string = '';
		$use_font = false;
		$custom_font = false;
		if ( $typo_array['font_size'] ) {
			$result_string .= 'font-size: ' . $typo_array['font_size'] . 'px; ';
		}
		if ( $typo_array['line_height'] ) {
			$result_string .= 'line-height: ' . $typo_array['line_height'] . 'px; ';
		}
		if ( $typo_array['letter_spacing'] ) {
			$result_string .= 'letter-spacing: ' . $typo_array['letter_spacing'] . 'px; ';
		}
		if ( $typo_array['weight'] && $typo_array['weight'] != 'inherit' ) {
			$result_string .= 'font-weight: ' . $typo_array['weight'] . '; ';
		}
		if ( $typo_array['normal'] ) {
			$result_string .= 'font-style: normal; ';
		}
		if ( $typo_array['italic'] ) {
			$result_string .= 'font-style: italic; ';
		}
		if ( $typo_array['underline'] ) {
			$result_string .= 'text-decoration: underline; ';
		}
		if ( $typo_array['use_custom_font'] && $typo_array['custom_font'] ) {
			$result_string .= 'font-family: \'' . substr( $typo_array['custom_font'], 0, strrpos( $typo_array['custom_font'], ':' ) ) . '\';';
		}
		return $result_string;
	}


	/**
	* Typography parse custom fonts
	*/
	function argenta_extra_parse_VC_typography_custom_font( $typo_value ) {
		$use_font = false;
		$font_key = false;
		foreach ( explode( '||', $typo_value ) as $typo_value_row ) {
			$exp = explode( '~', $typo_value_row );
			if ( $exp[0] == 'use_custom_font' )	{
				$use_font = argenta_extra_filter_boolean( $exp[1] );
			}
			if ( $exp[0] == 'custom_font' ) {
				$font_key = argenta_extra_filter_string( $exp[1] );
			}
		}
		if ( $use_font && $font_key ) {
			$exploded_font_key = explode( ':', $font_key );
			$font_key_array = array();
			$font_key_array['font'] = $exploded_font_key[0];
			$font_key_array['subsets'] = array();
			$font_key_array['variants'] = array();
			if ( $exploded_font_key[1] ) {
				foreach ( explode( ',', $exploded_font_key[1] ) as $variant ) {
					$font_key_array['variants'][] = $variant;
				}
			}
			$GLOBALS['argenta_google_fonts'][] = $font_key_array;
			return $font_key;
		} else {
			return false;
		}
	}

	/**
	* Columns type parsing to CSS
	*/
	function argenta_extra_parse_VC_columns_to_CSS( $value, $is_double = false ) {
		$value_array = explode( '-', $value );
		for ( $i = 0; $i < count( $value_array ); $i++ ) {
			switch ( intval( $value_array[$i] ) ) {
				case '1':
					$value_array[$i] = 12;
					break;
				case '2':
					$value_array[$i] = ( $is_double ) ? 12 : 6;
					break;
				case '3':
					$value_array[$i] = ( $is_double ) ? 8 : 4;
					break;
				case '4':
					$value_array[$i] = ( $is_double ) ? 6 : 3;
					break;
				case '5':
					$value_array[$i] = ( $is_double ) ? '2_5th' : '5th';
					break;
				case '6':
					$value_array[$i] = ( $is_double ) ? 4 : 2;
					break;
				case '12':
					$value_array[$i] = ( $is_double ) ? 2 : 1;
					break;
			}
		}
		$classes = '';

		if ( isset( $value_array[0] ) ) {
			$classes .= ' vc_col-lg-' . $value_array[0];
		}
		if ( isset( $value_array[1] ) ) {
			$classes .= ' vc_col-md-' . $value_array[1];
		}
		if ( isset( $value_array[2] ) ) {
			$classes .= ' vc_col-sm-' . $value_array[2];
		}
		if ( isset( $value_array[3] ) ) {
			$classes .= ' vc_col-xs-' . $value_array[3];
		}

		return $classes;
	}


	/**
	* Date and time parsing to array
	*/
	function argenta_extra_parse_VC_button_to_css( $settings, $brand = false ) {
		$css = $hover_css = $classes = '';

		if ( ! isset( $settings['type'] ) ) { $settings['type'] = 'flat'; }
		if ( ! isset( $settings['color'] ) ) { $settings['color'] = false; }
		if ( ! isset( $settings['hover-color'] ) ) { $settings['hover-color'] = false; }
		if ( ! isset( $settings['text-color'] ) ) { $settings['text-color'] = false; }
		if ( ! isset( $settings['text-hover-color'] ) ) { $settings['text-hover-color'] = false; }
		if ( ! isset( $settings['rounded'] ) ) { $settings['rounded'] = false; }
		if ( ! isset( $settings['fullwidth'] ) ) { $settings['fullwidth'] = false; }
		if ( ! isset( $settings['size'] ) ) { $settings['size'] = false; }
		if ( ! isset( $settings['color'] ) ) { $settings['color'] = false; }

		if ( $settings['type'] != 'arrow_link' ) {
			switch( $settings['type'] ) {
				case 'outline':
					if ( $settings['color'] ) {
						$css .= 'border-color:' . $settings['color'] . ';color: ' . $settings['color'] . ';';
					}
					if ( $settings['hover-color'] ) {
						$hover_css .= 'background:' . $settings['hover-color'] . ';border-color:' . $settings['hover-color'] . ';color: #fff;';
					} else if ( $settings['color'] ) {
						$hover_css .= 'background:' . $settings['color'] . ';color: #fff;';
					}
					if( $brand ){
						$classes .= ' brand-color brand-border-color brand-bg-color-hover';
						$hover_css .= 'color: #fff;';
					}
					break;
				case 'flat':
					if ( $settings['color'] ) {
						$css .= 'color: ' . $settings['color'] . ';';
					}
					if ( $settings['hover-color'] ) {
						$hover_css .= 'background:' . $settings['hover-color'] . ';color: #fff;';
					} else if ( $settings['color'] ) {
						$hover_css .= 'background:' . $settings['color'] . ';color: #fff;';
					}
					if( $brand ){
						$classes .= ' brand-color brand-bg-color-hover brand-border-color-hover';
						$hover_css .= 'color: #fff;';
					}
					break;
				default:
					if ( $settings['color'] ) {
						$css .= 'border-color:' . $settings['color'] . ';background-color: ' . $settings['color'] . ';';
					}
					if ( $settings['hover-color'] ) {
						$hover_css .= 'background:transparent;border-color:' . $settings['hover-color'] . ';color:' . $settings['hover-color'] . ';';
					} else if ( $settings['color'] ) {
						$hover_css .= 'background:transparent;color:' . $settings['color'] . ';';
					}
					if( $brand ){
						$classes .= ' brand-bg-color brand-border-color brand-color-hover';
					}
					break;
			}
		} else {
			$classes .= ' btn-link';
			if( $brand ){
				$classes .= ' brand-color brand-color-hover';
			}
		}

		if ( $settings['text-color'] ) {
			$css .= 'color: ' . $settings['text-color'] . ';';
		}
		if ( $settings['text-hover-color'] ) {
			$hover_css .= 'color: ' . $settings['text-hover-color'] . ';';
		}


		if (  $settings['type'] != 'arrow_link' ){

			if ( $settings['rounded'] ) { 
				$classes .= ' btn-rounded'; 
			}

			if ( $settings['fullwidth'] ) { 
				$classes .= ' btn-full-width';
			}

			switch ( $settings['size'] ) {
				case 'small':
					$classes .= ' btn-small';
					break;
				case 'large':
					$classes .= ' btn-large';
					break;
				case 'huge':
					$classes .= ' btn-large';
					break;
			}

			switch ( $settings['type'] ) {
				case 'outline':
					$classes .= ' btn-outline';
					break;
				case 'flat':
					$classes .= ' btn-flat';
					break;
			}
		}

		return array(
			'css' => $css,
			'hover-css' => $hover_css,
			'classes' => $classes
		);
	}
	

	/**
	* Date and time parsing to array
	*/
	function argenta_extra_parse_VC_datetime_to_array( $datetime_value ) {
		$result_arr = array(
			'year' => '2017',
			'month' => '1',
			'day' => '1',
			'hour' => '0',
			'minute' => '0',
			'second' => '0'
		);
		if ( !empty( $datetime_value ) ) {
			$time = strtotime( $datetime_value );
			$result_arr['year'] = date( 'Y', $time );
			$result_arr['month'] = date( 'n', $time );
			$result_arr['day'] = date( 'j', $time );
			$result_arr['hour'] = date( 'G', $time );
			$result_arr['minute'] = intval( date( 'i', $time ) );
			$result_arr['second'] = intval( date( 's', $time ) );
		}

		return $result_arr;
	}


	/**
	* Link params parsing
	*/
	function argenta_extra_parse_VC_link_params( $link_value, $default = array() ) {
		$result = array(
			'url' => '#',
			'caption' => '',
			'blank' => false
		);
		foreach ( $default as $key => $value ) {
			$result[$key] = $value;
		}
		$link_value = explode( '|', $link_value );
		if ( $link_value && count($link_value) > 0 ) {
			foreach ( $link_value as $link_attr ) {
				$link_attr = explode( ':', $link_attr );
				switch ( $link_attr[0] ) {
					case 'url':
						if ( argenta_extra_filter_string( $link_attr[1], 'url' ) ) {
							$result['url'] = argenta_extra_filter_string( $link_attr[1], 'url' );
						}
						break;
					case 'title':
						if ( argenta_extra_filter_string( urldecode( $link_attr[1] ) ) ) {
							$result['caption'] = argenta_extra_filter_string( urldecode( $link_attr[1] ) );
						}
						break;
					case 'target':
						$result['blank'] = argenta_extra_filter_boolean( $link_attr[1] );
						break;
				}
			}
		}
		return $result;
	}



	/**
	* Parse post data from object
	*/
	function argenta_extra_parse_post_object( $_post ) {
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
		$content_preview = argenta_extra_post_get_the_excerpt( $_post->ID );
		if ( ! $content_preview ) {
			$content_without_shotcodes = preg_replace( '/\[.+?\]/', '', $_post->post_content );
			$content_preview = wp_trim_words( $content_without_shotcodes, 30 );
		}
		// overlay
		$overlay = get_field( 'post_overlay_color', $_post->ID );
		// thumbnail
		$image = get_post_thumbnail_id( $_post->ID );
		if ( $image ) {
			$image = wp_get_attachment_image_src( $image, 'large' );
			if ( is_array( $image ) ) {
				$img_url = $image[0];
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
				$video_key = substr( $vimeo_link_matches[0], strpos( $vimeo_link_matches[0], 'vimeo.com/' ) + 10 );
				$video = '<iframe src="https://player.vimeo.com/video/' . $video_key . '" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" frameborder="0"></iframe>';
			}
			if ( is_array( $vimeo_frame_matches ) && $vimeo_frame_matches ) {
				$vimeo_frame_matches[0] = preg_replace( array( '/height\=\"[\d]+?\"/', '/width\=\"[\d]+?\"/' ), '', $vimeo_frame_matches[0] );
				$video = do_shortcode( $vimeo_frame_matches[0] );
			}
			if ( is_array( $youtube_link_matches ) && $youtube_link_matches ) {
				$video_key = substr( $youtube_link_matches[0], strpos( $youtube_link_matches[0], 'v=' ) + 2 );
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
			$boxed = (bool) get_field( 'global_blog_items_boxed_style', 'option' );
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
	function argenta_extra_post_get_the_excerpt( $post_id ) {
		global $post;
		$save_post = $post;
		$post = get_post( $post_id );
		$output = get_the_excerpt();
		$post = $save_post;
		return $output;
	}


	/*
	* Project post
	*/
	function argenta_extra_get_project_settings( $post ) {
		$project = array();
		// title
		$project['title'] = get_the_title( $post->ID );
		if ( ! $project['title'] ) {
			$project['title'] = '[' . get_the_date( get_option( 'date_format' ), $post->ID ) . ']';
		}
		// description
		$project['description'] = trim( get_field( 'project_description', $post->ID ) );
		$project['short_description'] = trim( get_field( 'project_description', $post->ID ) );
		if ( ! $project['short_description'] ) {
			$project['short_description'] = '';
		} elseif ( strlen( strip_tags( $project['short_description'] ) ) > 160 ) {
			$project['short_description'] = substr( strip_tags( $project['short_description'] ), 0, 160 ) . '&hellip;';
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
                // backward fix
                if ( is_numeric( $project['images'][$key] ) ) {
                    $project['images'][$key] = wp_get_attachment_url( $project['images'][$key] );
                }
            }
        } else {
            $project['images'] = array();
        }
        if (has_post_thumbnail($post)) {
            array_unshift($project['images'], get_the_post_thumbnail_url($post));
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
		// bradcrumbs
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
				'url' => get_post_permalink( $project['next']->ID ),
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
				'url' => get_post_permalink( $project['prev']->ID ),
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
		// animation
		$project['with_animation'] = get_field( 'global_portfolio_with_animation', 'option' );
		if ( $project['with_animation'] == NULL ) {
			$project['with_animation'] = false;
		}
		// grid
		$project['grid_style'] = get_field( 'project_style_in_grid', $post->ID );
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