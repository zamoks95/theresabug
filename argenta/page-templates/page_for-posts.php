<?php /* Template Name: Blog page */ ?>

<?php
	get_header();

	$page_wrapped = \Argenta\Settings::page_is_wrapped();

	$count_posts = wp_count_posts();
	$published_posts = $count_posts->publish;

	if ( get_query_var( 'paged' ) ) { 
		$pagination_page = get_query_var( 'paged' ); 
	} elseif ( get_query_var( 'page' ) ) {
		$pagination_page = get_query_var( 'page' ); 
	} else { 
		$pagination_page = 1;
	}

	$posts_per_page = \Argenta\Settings::posts_per_page();
	$posts_offset = ( $pagination_page - 1 ) * $posts_per_page;

	$paginator_current = $pagination_page;
	if ( ! $posts_per_page || $posts_per_page < 1 ) {
		$posts_per_page = 1;
	}
	$paginator_all = ceil( $published_posts / $posts_per_page );

	$posts_show_from = $posts_offset + 1;
	$posts_show_to = $posts_offset + $posts_per_page;
	if ( $posts_show_to > $published_posts ) {
		$posts_show_to = $published_posts;
	}

	$args = array(
		'posts_per_page' => $posts_per_page,
		'offset' => $posts_offset,
		'category' => '',
		'category_name' => '',
		'orderby' => 'date',
		'order' => 'DESC',
		'include' => '',
		'exclude' => '',
		'meta_key' => '',
		'meta_value' => '',
		'post_type' => 'post',
		'post_mime_type' => '',
		'post_parent' => '',
		'author' => '',
		'author_name' => '',
		'post_status' => 'publish',
		'suppress_filters' => false 
	);
	$posts_array = get_posts( $args );

	$sidebar_position = \Argenta\Settings::get( 'blog_sidebar' );
	if ( in_array( $sidebar_position, array( 'inherit', NULL ) ) ) {
		$sidebar_position = \Argenta\Settings::get( 'blog_sidebar', 'global' );
		if ( $sidebar_position === NULL ) { $sidebar_position = 'right';  }
	}

	$sidebar_page_class = '';
	if ( $sidebar_position == 'left' ) {
		$sidebar_page_class = 'page-with-left-sidebar';
	}
	if ( $sidebar_position == 'right' ) {
		$sidebar_page_class = 'page-with-right-sidebar';
	}

	$posts_grid = \Argenta\Settings::get( 'blog_page_layout' );
	if ( in_array( $posts_grid, array( 'inherit', NULL ) ) ) {
		$posts_grid = \Argenta\Settings::get( 'blog_page_layout', 'global' );
	}
	$grid_style_class = ( $posts_grid == 'masonry' ) ? 'blog-posts-masonry' : 'blog-posts-classic';

	$grid_item_style_class = '';
	$posts_without_paddings = \Argenta\Settings::get( 'blog_items_without_padding' );
	if ( $posts_without_paddings ) {
		$grid_item_style_class .= ' post-offset';
	}

	$columns_num = \Argenta\Settings::get( 'blog_columns_in_row' );
	$columns_global_num = \Argenta\Settings::get( 'blog_columns_in_row', 'global' );

	if ( ! isset( $columns_num ) ) {
		$columns_num = 'i-i-i-i';
	}
	if ( $posts_grid == 'classic' ) { 
		$columns_num = '1-1-1-1'; 
	}
	if ( ! isset( $columns_global_num ) ) { 
		$columns_global_num = '1-1-1-1'; 
	}
	$columns_class = \Argenta\Helper::parse_columns_to_css( $columns_num, false, $columns_global_num );
	$columns_double_class = \Argenta\Helper::parse_columns_to_css( $columns_num, true, $columns_global_num );
?>

<?php get_template_part( 'template-parts/elements/header-title' ); ?>

<?php get_template_part( 'template-parts/elements/breadcrumbs' ); ?>

<div class="<?php echo esc_attr( $page_wrapped ) ? 'wrapped-container' : 'full-width-container'; ?>">
	<div id="primary" class="content-area">
			
		<?php if ( $sidebar_position == 'left' ) : ?>
		<div class="vc_col-md-3 page-sidebar">
			<aside id="secondary" class="widget-area">
				<?php dynamic_sidebar( 'argenta-sidebar-blog' ); ?>
			</aside>
		</div>
		<?php endif; ?>

			
		<div class="vc_col-md-<?php if ( $sidebar_position == 'without' ) { echo '12'; } else { echo '9 ' . esc_attr( $sidebar_page_class ); } ?> page-offset-bottom">
			<main id="main" class="site-main">
				<div class="vc_row <?php echo esc_attr( $grid_style_class ); ?>">
				<?php
				$posts_layout_item = \Argenta\Settings::get( 'blog_item_layout_type' );
				if ( in_array( $posts_layout_item, array( 'inherit', NULL ) ) ) {
					$posts_layout_item = \Argenta\Settings::get( 'blog_item_layout_type', 'global' );
				}
				foreach ( $posts_array as $post_index => $_post_object ) {
					$_parsed_post = argenta_gh_parse_post_object( $_post_object );
					argenta_gh_set_current_item_data( $_parsed_post );

					$col_class = $columns_class;
					$grid_class = ' grid-item';

					if ( $_parsed_post['grid_style'] == '2col' ) {
						$col_class = $columns_double_class;
						$grid_class = '';
					}

					echo '<div class="' . esc_attr( $col_class . $grid_class . $grid_item_style_class . ( ( $posts_grid == 'masonry' ) ? ' blog-post-masonry' : '' ) ) . '">';

					switch ( $posts_layout_item ) {
						case 'default':
							get_template_part( 'template-parts/blog/default' );
							break;
						case 'without_excerpt':
							get_template_part( 'template-parts/blog/without_excerpt' );
							break;
						case 'date_top':
							get_template_part( 'template-parts/blog/date_top' );
							break;
						case 'inner':
							get_template_part( 'template-parts/blog/inner' );
							break;
						case 'inner_with_desciption':
							get_template_part( 'template-parts/blog/inner_with_description' );
							break;
						default:
							get_template_part( 'template-parts/blog/default' );
							break;
					}
					echo '<div class="clear"></div>';
					echo '</div>';
				}
				?>
				</div>

				<?php
					if ( $paginator_all > 1 ) {
						\Argenta\Layout::the_paginator_layout( $paginator_current, $paginator_all );
					}
				?>
			</main><!-- #main -->
		</div>

		<?php if ( $sidebar_position == 'right' ) : ?>
		<div class="vc_col-md-3 page-sidebar">
			<aside id="secondary" class="widget-area">
				<?php dynamic_sidebar( 'argenta-sidebar-blog' ); ?>
			</aside>
		</div>
		<?php endif; ?>

	</div><!--#primary-->
</div><!-- wrapper -->
	
<?php
	get_footer();