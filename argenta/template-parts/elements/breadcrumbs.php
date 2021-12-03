<?php
	// Settings
	$show_breadcrumbs = \Argenta\Settings::breadcrumbs_is_displayed();
	$page_wrapped = \Argenta\Settings::page_is_wrapped();
	$show_home_slug = \Argenta\Settings::breadcrumbs_home_slug_is_displayed();
	$show_portfolio_slug = \Argenta\Settings::breadcrumbs_portfolio_slug_is_displayed();
	$show_cats_filter = \Argenta\Settings::breadcrumbs_cats_filter_is_displayed();
	$show_tags_filter = \Argenta\Settings::breadcrumbs_tags_filter_is_displayed();
	$show_authors_filter = \Argenta\Settings::breadcrumbs_authors_filter_is_displayed();

	$have_right_side = false;
	$filter_published_posts = $GLOBALS['wp_query']->found_posts;
	$filter_pagination_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$filter_posts_per_page = \Argenta\Settings::posts_per_page();
	$filter_posts_offset = ( $filter_pagination_page - 1 ) * $filter_posts_per_page;
	$filter_posts_show_from = $filter_posts_offset + 1;
	$filter_posts_show_to = $filter_posts_offset + $filter_posts_per_page;
	if ( $filter_posts_show_to > $filter_published_posts ) {
		$filter_posts_show_to = $filter_published_posts;
	}
	$filter_cat_ids = get_terms( array( 'taxonomy' => 'category' ) );
	$filter_tag_ids = get_terms( array( 'taxonomy' => 'post_tag' ) );
	$filter_authors = get_users( array( 'who'      => 'authors'  ) );

	// Delimiter and slugs
	$delimiter_symbol = esc_html( \Argenta\Settings::get( 'breadcrumbs_separator', 'global' ) );
	if ( ! $delimiter_symbol ) {
		$delimiter_symbol = '/';
	}
	$home_slug = \Argenta\Settings::breadcrumbs_home_slug();
	$portfolio_slug = \Argenta\Settings::breadcrumbs_portfolio_slug();
	$search_slug = __( 'Search results', 'argenta' );
	$cats_slug = __( 'Tag:', 'argenta' ); 
	$tag_slug = __( 'Tag:', 'argenta' ); 
	$author_slug = __( 'Author:', 'argenta' );
	$not_found_slug = __( 'Page not found', 'argenta' );

	// Ancestors
	$breadcrumbs_ancestors = array();
	if ( $show_home_slug ) {
		$breadcrumbs_ancestors[] = array( $home_slug, home_url( '/' ) );
	}

	if ( \Argenta\Settings::page_is( 'home' ) ) {
		$have_right_side = true;
	} else {
		if ( \Argenta\Settings::page_is( 'category' ) ) {
			$cat = get_category( get_query_var( 'cat' ), false );
			if ( is_object( $cat ) ) {
				$have_right_side = true;
				if ( $cat->parent != 0 ) {
					$cats = get_category_parents( $cat->parent, true, '<br>' );
					$cats = explode( '<br>', $cats );
					foreach ( $cats as $key => $cat_link ) {
						if ( ! $cat_link ) continue;
						$_matches = false;
						if ( preg_match( '/<a href="([^"]+)">([^<]+)<\/a>/', $cat_link, $_matches ) ) {
							$breadcrumbs_ancestors[] = array( trim( $_matches[2] ), $_matches[1] );
						}
					}
				}
				$breadcrumbs_ancestors[] = $cat->name;
			}
		} elseif ( \Argenta\Settings::page_is( 'tag' ) ) {
			$have_right_side = true;
			$breadcrumbs_ancestors[] = $tag_slug . ' ' . single_tag_title( '', false );
		}elseif ( \Argenta\Settings::page_is( 'search' ) ) {
			$breadcrumbs_ancestors[] = $search_slug;
		} elseif ( is_day() ) {
			$have_right_side = true;
			$breadcrumbs_ancestors[] = array( get_the_time( 'Y' ), get_year_link( get_the_time( 'Y' ) ) );
			$breadcrumbs_ancestors[] = array( get_the_time( 'F' ), get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) );
			$breadcrumbs_ancestors[] = get_the_time( 'd' );
		} elseif ( is_month() ) {
			$have_right_side = true;
			$breadcrumbs_ancestors[] = array( get_the_time( 'Y' ), get_year_link( get_the_time( 'Y' ) ) );
			$breadcrumbs_ancestors[] = get_the_time( 'F' );
		} elseif ( is_year() ) {
			$have_right_side = true;
			$breadcrumbs_ancestors[] = get_the_time( 'Y' );
		} elseif ( \Argenta\Settings::page_is( 'blog' ) ) {
			$have_right_side = true;
		} elseif ( \Argenta\Settings::page_is( 'single' ) ) {
			$cat = get_the_category();
			if ( is_array( $cat ) && count( $cat ) > 0 ) {
				$cat = $cat[0];
			}
			if ( is_object( $cat ) ) {
				if ( $cat->parent != 0 ) {
					$cats = get_category_parents( $cat->parent, true, '<br>' );
					$cats = explode( '<br>', $cats );
					foreach ( $cats as $key => $cat_link ) {
						if ( ! $cat_link ) continue;
						$_matches = false;
						if ( preg_match( '/<a href="([^"]+)">([^<]+)<\/a>/', $cat_link, $_matches ) ) {
							$breadcrumbs_ancestors[] = array( trim( $_matches[2] ), $_matches[1] );
						}
					}
				}
				$breadcrumbs_ancestors[] = array( $cat->name, get_category_link( $cat->term_id ) );
			}
			if ( get_the_title() ) {
				$breadcrumbs_ancestors[] = get_the_title();
			} else {
				$breadcrumbs_ancestors[] = '[' . get_the_date( get_option( 'date_format' ), $post->ID ) . ']';
			}
		} elseif ( \Argenta\Settings::page_is( 'project' ) ) {
			if ( $show_portfolio_slug ) {
				$link_to_portfolio = \Argenta\Settings::get( 'portfolio_page', 'global' );
				if ( ! $link_to_portfolio ) {
					$link_to_portfolio = home_url( '/' );
				}
				$breadcrumbs_ancestors[] = array( $portfolio_slug , $link_to_portfolio);
			}
			if ( get_the_title() ) {
				$breadcrumbs_ancestors[] = get_the_title();
			} else {
				$breadcrumbs_ancestors[] = '[' . get_the_date( get_option( 'date_format' ), $post->ID ) . ']';
			}
		} elseif ( \Argenta\Settings::page_is( 'shop' ) ) {
			$breadcrumbs_ancestors[] = esc_html__( 'Shop', 'argenta' );
		} elseif ( \Argenta\Settings::page_is( 'product_category' ) ) {
			global $wp_query;
        	$cat = $wp_query->get_queried_object();
			$breadcrumbs_ancestors[] = array( 
				esc_html__( 'Shop', 'argenta' ),
				get_permalink( wc_get_page_id( 'shop' ) )
			);
			$breadcrumbs_ancestors[] = esc_html__( 'Category', 'argenta' ) . ': ' . $cat->name;
		} elseif ( \Argenta\Settings::page_is( 'product_tag' ) ) {
			global $wp_query;
			$cat = $wp_query->get_queried_object();
			$breadcrumbs_ancestors[] = array( 
				esc_html__( 'Shop', 'argenta' ),
				get_permalink( wc_get_page_id( 'shop' ) )
			);
			$breadcrumbs_ancestors[] = esc_html__( 'Tag', 'argenta' ) . ': ' . $cat->name;
		} elseif ( \Argenta\Settings::page_is( 'product' ) ) {
			global $args;
			$terms = wp_get_post_terms( $post->ID, 'product_cat', array( 'taxonomy' => 'product_cat' ) );
			$breadcrumbs_ancestors[] = array( 
				esc_html__( 'Shop', 'argenta' ),
				get_permalink( wc_get_page_id( 'shop' ) )
			);
			if ( is_array( $terms ) && count( $terms ) > 0 && is_object( $terms[0] ) ) {
				$breadcrumbs_ancestors[] = array( $terms[0]->name, get_term_link( $terms[0] ) );
			}
			$breadcrumbs_ancestors[] = get_the_title();
		} elseif ( \Argenta\Settings::page_is( 'cart' ) ) {
			$breadcrumbs_ancestors[] = array( 
				esc_html__( 'Shop', 'argenta' ),
				get_permalink( wc_get_page_id( 'shop' ) )
			);
			$breadcrumbs_ancestors[] = get_the_title();
		} elseif ( \Argenta\Settings::page_is( 'checkout' ) ) {
			$breadcrumbs_ancestors[] = array( 
				esc_html__( 'Shop', 'argenta' ),
				get_permalink( wc_get_page_id( 'shop' ) )
			);
			$breadcrumbs_ancestors[] = get_the_title();
		} elseif ( \Argenta\Settings::page_is( 'attachment' ) ) {
			$parent_id = ($post) ? $post->post_parent : '';
			$parent = get_post( $parent_id );
			$cat = get_the_category( $parent->ID );
			if ( is_array( $cat ) && count( $cat ) > 0 ) {
				$cat = $cat[0];
			}
			if ( is_object( $cat ) ) {
				if ( $cat->parent != 0 ) {
					$cats = get_category_parents( $cat->parent, true, '<br>' );
					$cats = explode( '<br>', $cats );
					foreach ( $cats as $key => $cat_link ) {
						if ( ! $cat_link ) continue;
						$_matches = false;
						if ( preg_match( '/<a href="([^"]+)">([^<]+)<\/a>/', $cat_link, $_matches ) ) {
							$breadcrumbs_ancestors[] = array( trim( $_matches[2] ), $_matches[1] );
						}
					}
				}
				$breadcrumbs_ancestors[] = array( $cat->name, get_category_link( $cat->term_id ) );
			}
			$breadcrumbs_ancestors[] = array( $parent->post_title,  get_permalink( $parent ) );
			$breadcrumbs_ancestors[] = get_the_title();
		} elseif ( \Argenta\Settings::page_is( 'page' ) && ( $post ) && ! $post->post_parent ) {
			if ( get_the_title() ) {
				$breadcrumbs_ancestors[] = get_the_title();
			} else {
				$breadcrumbs_ancestors[] = '[' . get_the_date( get_option( 'date_format' ), $post->ID ) . ']';
			}
		} elseif ( \Argenta\Settings::page_is( 'page' ) && ( $post ) && $post->post_parent ) {
			$parent_id = $post->post_parent;
			if ( $parent_id != get_option( 'page_on_front' ) ) {
				$_breadcrumbs = array();
				while ( $parent_id ) {
					$page = get_page( $parent_id );
					if ( $parent_id != get_option( 'page_on_front' ) ) {
						$_breadcrumbs[] = array( get_the_title( $page->ID ), get_permalink( $page->ID ) );
					}
					$parent_id = $page->post_parent;
				}
				$breadcrumbs_ancestors = array_merge( $breadcrumbs_ancestors, array_reverse( $_breadcrumbs ) );
			}
			if ( get_the_title() ) {
				$breadcrumbs_ancestors[] = get_the_title();
			} else {
				$breadcrumbs_ancestors[] = '[' . get_the_date( get_option( 'date_format' ), $page->ID ) . ']';
			}
		} elseif ( \Argenta\Settings::page_is( 'author' ) ) {
			$author = get_the_author();
			$breadcrumbs_ancestors[] = $author_slug . ' ' . ( ( $author) ? $author : __( 'Undefined', 'argenta' ) );
		} elseif ( \Argenta\Settings::page_is( '404' ) ) {
			$breadcrumbs_ancestors[] = $not_found_slug;
		} elseif ( has_post_format() && ! is_singular() ) {
			$format = has_post_format();
			if ( is_array( $format ) && count( $format ) > 0 ) {
				$format = $format[0];
			} 
			$breadcrumbs_ancestors[] = get_post_format_string( $format );
		}
	}
?>

<?php if ( $show_breadcrumbs ) : ?>
<div class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
	<div class="<?php echo esc_attr( $page_wrapped ) ? 'wrapped-container' : 'full-width-container'; ?>">
		<div class="vc_col-sm-12">
			
			<div class="left">
				<?php
					foreach ( $breadcrumbs_ancestors as $ancestor_key => $ancestor_value ) {
						if ( is_array( $ancestor_value ) ) {
							printf( '<a class="brand-color-hover" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" href="%s">%s</a>', esc_url( $ancestor_value[1] ), esc_html( $ancestor_value[0] ) );
						} else {
							if ( $ancestor_key == count( $breadcrumbs_ancestors ) - 1 ) {
								echo '<span class="current" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">' . esc_html( $ancestor_value ) . '</span>';
							} else {
								echo esc_html( $ancestor_value );
							}
						}
						if ( $ancestor_key < count( $breadcrumbs_ancestors ) - 1 ) {
							echo ' ' . $delimiter_symbol . ' ';
						}
					}
				?>
			</div>

			<?php if ( \Argenta\Settings::page_is( 'search' ) ) : ?>

			<div class="right">
				<div class="result">
					<?php echo sprintf( esc_html__( 'Showing %d-%d of %d results', 'argenta' ), $filter_posts_show_from, $filter_posts_show_to, $filter_published_posts ); ?>
				</div>
			</div>

			<?php elseif ( $have_right_side ) : ?>			
			<div class="right">
				<div class="result">
					<?php echo sprintf( esc_html__( 'Showing %d-%d of %d results', 'argenta' ), $filter_posts_show_from, $filter_posts_show_to, $filter_published_posts ); ?>
				</div>

				<?php if ( is_array( $filter_cat_ids ) && $filter_cat_ids && $show_cats_filter ) : ?>
				<div class="select" data-select="true">
					<select>
						<option value=""><?php esc_html_e( 'Categories', 'argenta' ); ?></option>
						<?php
							foreach ($filter_cat_ids as $cat_obj) {
								echo '<option value="' . esc_attr( $cat_obj->slug ) . '" data-select-href="' . esc_url( get_term_link( $cat_obj->term_id ) ) . '">' . esc_html( $cat_obj->name ) . '</option>';
							}
						?>
					</select>
					<a class="select-title brand-color-hover" data-toggle="select">
						<span></span>
						<i class="icon ion-android-arrow-dropdown"></i>
					</a>
					<ul class="select-menu"></ul>
				</div>
				<?php endif; ?>
				
				<?php if ( is_array( $filter_tag_ids ) && $filter_tag_ids && $show_tags_filter ) : ?>
				<div class="select" data-select="true">
					<select>
						<option value=""><?php esc_html_e( 'Tags', 'argenta' ); ?></option>
						<?php
							foreach ($filter_tag_ids as $tag_obj) {
								echo '<option value="' .  esc_attr( $tag_obj->slug ) . '" data-select-href="' . esc_url( get_term_link(  $tag_obj->term_id ) ) . '">' . esc_html( $tag_obj->name ) . '</option>';
							}
						?>
					</select>
					<a class="select-title brand-color-hover" data-toggle="select">
						<span></span>
						<i class="icon ion-android-arrow-dropdown"></i>
					</a>
					<ul class="select-menu"></ul>
				</div>
				<?php endif; ?>

				<?php if ( is_array( $filter_authors ) && count( $filter_authors ) > 1 && $show_authors_filter ) : ?>
				<div class="select" data-select="true">
					<select>
						<option value=""><?php esc_html_e( 'Authors', 'argenta' ); ?></option>
						<?php
							foreach ($filter_authors as $author) {
								echo '<option value="' . esc_attr( $author->data->user_login ) . '" data-select-href="' . esc_url( get_author_posts_url( $author->ID, $author->data->user_nicename ) ) . '">' . esc_html( $author->data->display_name ) . '</option>';
							}
						?>
					</select>
					<a class="select-title brand-color-hover" data-toggle="select">
						<span></span>
						<i class="icon ion-android-arrow-dropdown"></i>
					</a>
					<ul class="select-menu"></ul>
				</div>
				<?php endif; ?>

			</div>
			<?php endif; ?>

		</div>
		<div class="clear"></div>
	</div>
</div> <!-- .breadcrumbs -->
<?php endif; ?>