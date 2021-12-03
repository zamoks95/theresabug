<?php /* Template Name: Portfolio page */ ?>

<?php
	$GLOBALS['argenta_pixellove_fonts'][] = 'my-icon-arr-out';

	get_header();

	$page_wrapped = \Argenta\Settings::page_is_wrapped();
	$add_content_padding = \Argenta\Settings::page_add_top_padding();

	// projects count
	$count_projects = wp_count_posts( 'argenta_portfolio' );
	$published_projects = $count_projects->publish;

	if ( get_query_var( 'paged' ) ) { 
		$pagination_page = get_query_var( 'paged' ); 
	} elseif ( get_query_var( 'page' ) ) {
		$pagination_page = get_query_var( 'page' ); 
	} else { 
		$pagination_page = 1;
	}

	// pagination settings
	$projects_per_page = get_field( 'portfolio_projects_per_page' );
	if ( ! $projects_per_page || $projects_per_page < 1 ) {
		$projects_per_page = 24;
	}

	$projects_offset = ( $pagination_page - 1 ) * $projects_per_page;

	$paginator_current = $pagination_page;
	if ( ! $projects_per_page || $projects_per_page < 1 ) {
		$projects_per_page = 1;
	}
	$paginator_all = ceil( $published_projects / $projects_per_page );

	// show filter
	$show_filter = (bool) get_field( 'project_show_filter' );
	$filter_align = get_field( 'portfolio_filter_align' );
	if ( ! $filter_align ) {
		$filter_align = 'center';
	}
	switch ( $filter_align ) {
		case 'left':
			$filter_align_class = ' text-left';
			break;
		case 'right':
			$filter_align_class = ' text-right';
			break;
		default:
			$filter_align_class = '';
			break;
	}

	// popup
	$open_in_popup = (bool) get_field( 'portfolio_projects_in_popup' );
	$loop_popup_slider = (bool) get_field( 'loop_popup_slider' );

	// results
	$projects_show_from = ( $projects_offset + 1 <= $published_projects ) ? $projects_offset + 1 : $published_projects ;
	$projects_show_to = $projects_offset + $projects_per_page;
	if ( $projects_show_to > $published_projects ) {
		$projects_show_to = $published_projects;
	}

	$args = array(
		'posts_per_page'	=> $projects_per_page,
		'offset'			=> $projects_offset,
		'category'			=> '',
		'category_name'		=> '',
		'orderby'			=> 'date',
		'order'				=> 'DESC',
		'include'			=> '',
		'exclude'			=> '',
		'meta_key'			=> '',
		'meta_value'		=> '',
		'post_type'			=> 'argenta_portfolio',
		'post_mime_type' 	=> '',
		'post_parent'		=> '',
		'author'			=> '',
		'author_name'		=> '',
		'post_status'		=> 'publish',
		'suppress_filters' 	=> false 
	);
	$projects_array = get_posts( $args );

	// sidebar and layout
	$sidebar_position = get_field( 'portfolio_sidebar' );
	if ( $sidebar_position == 'inherit' ) {
		$sidebar_position = get_field( 'global_portfolio_sidebar', 'option' );
	}
	$sidebar_page_class = '';
	if ( $sidebar_position == 'left' ) {
		$sidebar_page_class = 'page-with-left-sidebar';
	}
	if ( $sidebar_position == 'right' ) {
		$sidebar_page_class = 'page-with-right-sidebar';
	}

	$grid_item_style_class = '';
	$posts_without_paddings = get_field( 'portfolio_items_without_padding' );
	if ( $posts_without_paddings ) {
		$grid_item_style_class .= ' post-offset ';
	}

	$columns_num = \Argenta\Settings::get( 'portfolio_columns_in_row' );
	if ( ! isset( $columns_num ) ) {
		$columns_num = '1-1-1-1';
	}
	$columns_class = \Argenta\Helper::parse_columns_to_css( $columns_num, false );
	$columns_double_class = \Argenta\Helper::parse_columns_to_css( $columns_num, true );
?>

<?php get_template_part( 'template-parts/elements/header-title' ); ?>

<?php get_template_part( 'template-parts/elements/breadcrumbs' ); ?>

<?php if ( $show_filter ) : ?>
	<?php $cat_ids = get_terms( array( 'taxonomy' => 'argenta_portfolio_category' ) ); ?>
	<?php if ( is_array( $cat_ids ) && $cat_ids ) : ?>
		<?php if ( $page_wrapped ) : ?>
		<div class="wrapped-container">
		<?php else: ?>
		<div class="full-width-container">
		<?php endif; ?>
			<div class="vc_col-sm-12">
				<div class="portfolio-sorting<?php echo esc_attr( $filter_align_class ); ?>" data-filter="portfolio">
					<div class="title brand-color uppercase"><?php esc_html_e( 'Filter by:', 'argenta' ); ?></div>
					<ul class="unstyled">
						<li><a class="active" href="#all" data-isotope-filter="*"><?php esc_html_e( 'All', 'argenta' ); ?></a></li>
						<?php
							foreach ($cat_ids as $cat_obj) {
								$slug_hash = hash( 'md4', $cat_obj->slug, false );
								echo '<li><a href="#project-' . esc_attr( $slug_hash ) . '" data-isotope-filter=".argenta-filter-project-' . esc_attr( $slug_hash ) . '">' . esc_html( $cat_obj->name ) . '</a></li>';
							}
						?>
					</ul>
				</div>
			</div>
		</div>
	<?php endif; ?>
<?php endif; ?>

<div class="<?php echo esc_attr( $page_wrapped ) ? 'wrapped-container' : 'full-width-container'; ?>">
	<div id="primary" class="content-area">
		
		<?php if ( $sidebar_position == 'left' ) : ?>
		<div class="vc_col-md-3 page-sidebar">
			<aside id="secondary" class="widget-area">
				<?php dynamic_sidebar( 'argenta-sidebar-blog' ); ?>
			</aside>
		</div>
		<?php endif; ?>

		<div class="vc_col-md-<?php if ( $sidebar_position == 'without' ) { echo '12'; } else { echo esc_attr( '9 ' . $sidebar_page_class ); } ?> page-offset-bottom">
			<main id="main" class="site-main">
				<div class="vc_row blog-posts-masonry" data-isotope-grid="true">
				<?php
				$projects_layout_item = get_field( 'portfolio_item_layout_type' );
				if ( ! $projects_layout_item || $projects_layout_item == 'inherit' ) {
					$projects_layout_item = get_field( 'global_portfolio_item_layout_type', 'option' );
				}

				foreach ( $projects_array as $_project_index => $_project_object ) {
					$argenta_project = argenta_gh_get_project_settings( $_project_object );
					$argenta_project['in_popup'] = $open_in_popup;
					$argenta_project['loop_popup_slider'] = $loop_popup_slider;

					argenta_gh_set_current_item_data( $argenta_project );

					$col_class = $columns_class;
					$grid_class = ' grid-item';

					if ( $argenta_project['grid_style'] == '2col' ) {
						$col_class = $columns_double_class;
						$grid_class = '';
					}

					echo '<div class="' . esc_attr( $col_class . $grid_class ) . ' blog-post-masonry argenta-project-item ' . esc_attr( $grid_item_style_class  . $argenta_project['categories_group'] ) . '">';

					switch ( $projects_layout_item ) {
						case 'default':
							get_template_part( 'template-parts/portfolio-cards/default' );
							break;
						case 'default_show_now':
							get_template_part( 'template-parts/portfolio-cards/default_show_now' );
							break;
						case 'default_panel_show_now':
							get_template_part( 'template-parts/portfolio-cards/default_panel_show_now' );
							break;
						case 'default_with_description':
							get_template_part( 'template-parts/portfolio-cards/default_with_description' );
							break;
						case 'inner_show_now':
							get_template_part( 'template-parts/portfolio-cards/inner_show_now' );
							break;
						case 'inner_panel':
							get_template_part( 'template-parts/portfolio-cards/inner_panel' );
							break;
						case 'inner_wide_centred':
							get_template_part( 'template-parts/portfolio-cards/inner_wide_centred' );
							break;
						case 'inner_padding_bottom':
							get_template_part( 'template-parts/portfolio-cards/inner_padding_bottom' );
							break;
						default:
							get_template_part(  'template-parts/portfolio-cards/default' );
							break;
					}
					echo '<div class="clear"></div>';
					echo '</div>';

					ob_start();
					argenta_gh_set_current_item_data( $argenta_project );
					get_template_part( 'template-parts/portfolio-cards/_popup' );
					\Argenta\Layout::append_to_footer_buffer_content( ob_get_clean() );
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

	</div><!-- #primary -->
</div><!-- wrapper -->
	
<?php
	get_footer();