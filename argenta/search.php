<?php
	get_header();

	// Settings
	$sidebar_position = \Argenta\Settings::get_archive_sidebar_position();
	$sidebar_page_class = '';
	if ( $sidebar_position == 'left' ) {
		$sidebar_page_class = 'page-with-left-sidebar';
	} elseif ( $sidebar_position == 'right' ) {
		$sidebar_page_class = 'page-with-right-sidebar';
	}

	$posts_grid = \Argenta\Settings::get( 'blog_page_layout', 'global' );
	$grid_style_class = ( $posts_grid == 'masonry' ) ? 'blog-posts-masonry' : 'blog-posts-classic';

	$columns_num = \Argenta\Settings::get( 'blog_columns_in_row', 'global' );
	if ( ! isset( $columns_num ) ) {
		$columns_num = '1-1-1-1';
	}
	if ( $posts_grid == 'classic' ) { 
		$columns_num = '1-1-1-1'; 
	}
	$columns_class = \Argenta\Helper::parse_columns_to_css( $columns_num, false );
	$columns_double_class = \Argenta\Helper::parse_columns_to_css( $columns_num, true );


	$grid_item_style_class = '';
	$posts_without_paddings = (bool) \Argenta\Settings::get( 'blog_items_without_padding', 'global' );
	if ( $posts_without_paddings ) {
		$grid_item_style_class .= ' post-offset';
	}

	$page_wrapped = \Argenta\Settings::page_is_wrapped();

	if ( have_posts() ) : 
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

		<div class="vc_col-md-<?php if ( $sidebar_position == 'without' ) { echo '12'; } else { echo esc_attr( '9 ' . $sidebar_page_class ); } ?> page-offset-bottom">
			<main id="main" class="site-main">
				<div class="vc_row search-page <?php echo esc_attr( $grid_style_class ); ?>">
				<?php
					$posts_layout_item = \Argenta\Settings::get( 'blog_item_layout_type', 'global' );
					/* Start the Loop */
					while ( have_posts() ) : the_post();
						switch ( $post->post_type ) {
							case 'argenta_portfolio': // projects
								$parsed_post = argenta_gh_get_project_settings( $post );
								argenta_gh_set_current_item_data( $parsed_post );

								$col_class = $columns_class;
								$grid_class = ' grid-item';

								if ( $parsed_post['grid_style'] == '2col' ) {
									$col_class = $columns_double_class;
									$grid_class = '';
								}

								echo '<div class="' . esc_attr( $col_class . $grid_class . $grid_item_style_class ) . ' masonry-block blog-post-masonry">';
								get_template_part( 'template-parts/portfolio-cards/default' );
								echo '</div>';
								break;
							
							default: // default post or undefined custom
								$parsed_post = argenta_gh_parse_post_object( $post );
								argenta_gh_set_current_item_data( $parsed_post );

								$col_class = $columns_class;
								$grid_class = ' grid-item';

								if ( $parsed_post['grid_style'] == '2col' ) {
									$col_class = $columns_double_class;
									$grid_class = '';
								}

								echo '<div class="vc_col-sm-' . esc_attr( $col_class . $grid_class . $grid_item_style_class . ( ( $posts_grid == 'masonry' ) ? ' masonry-block blog-post-masonry' : '' ) ) . '">';

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
									case 'inner_with_description':
										get_template_part( 'template-parts/blog/inner_with_description' );
										break;
									default:
										get_template_part( 'template-parts/blog/default' );
										break;
								}
								echo '</div>';
								break;
						}

					endwhile;
				?>
				</div>
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
</div>

<?php else : ?>
	<?php get_template_part( 'template-parts/content', 'none' ); ?>
<?php endif; ?>

<?php get_footer();