<?php
	get_header();

	$page_wrapped = \Argenta\Settings::page_is_wrapped();
	$sidebar_position = \Argenta\Settings::get_post_sidebar_position();

	ob_start();
	dynamic_sidebar( 'argenta-sidebar-blog' );
	$sidebar_layout = ob_get_clean();

	$sidebar_row_class = '';
	if ( $sidebar_position == 'right' ) {
		$sidebar_row_class = '9 page-with-right-sidebar';
	} elseif ( $sidebar_position == 'left' ) {
		$sidebar_row_class = '9 page-with-left-sidebar';
	} else {
		$sidebar_row_class = '12';
	}

	while ( have_posts() ) : the_post();
?>

<?php get_template_part( 'template-parts/elements/header-title' ); ?>

<?php get_template_part( 'template-parts/elements/breadcrumbs' ); ?>

<div class="<?php echo esc_attr( $page_wrapped ) ? 'wrapped-container' : 'full-width-container'; ?>">
	
	<?php if ( $sidebar_layout && $sidebar_position == 'left' ) : ?>
	<div class="vc_col-md-3 page-sidebar">
		<aside id="secondary" class="widget-area">
			<?php dynamic_sidebar( 'argenta-sidebar-blog' ); ?>
		</aside>
	</div>
	<?php endif; ?>

	<div class="vc_col-md-<?php echo esc_attr( $sidebar_row_class ); ?> page-offset-bottom">
		<div id="primary" class="content-area">
			<main id="main" class="site-main page-offset-bottom">
				<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
				<?php
					$author = get_the_author_meta( 'ID' );
					if ( $author && get_the_author_meta( 'description', $author ) ) {
						the_widget( 'argenta_widget_about_author', array( 'words' => '' ) );
					}
				?>
				<?php get_template_part( 'template-parts/elements/next-n-prev-posts' ); ?>
				<?php get_template_part( 'template-parts/elements/related-posts' ); ?>
				<?php if ( comments_open() || get_comments_number() ) { comments_template(); } ?>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div>

	<?php if ( $sidebar_layout && $sidebar_position == 'right' ) : ?>
	<div class="vc_col-md-3 page-sidebar">
		<aside id="secondary" class="widget-area">
            <?php dynamic_sidebar( 'argenta-sidebar-blog' ); ?>
		</aside>
	</div>
	<?php endif; ?>

</div>

<?php
	endwhile;

	get_footer();