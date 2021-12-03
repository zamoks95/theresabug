<?php
	get_header();

	// Settings
	$page_wrapped = \Argenta\Settings::page_is_wrapped();
	$no_ecommerce = ! \Argenta\Settings::page_is( 'ecommerce' );
	$add_content_padding = \Argenta\Settings::page_add_top_padding();

	ob_start();
	dynamic_sidebar( 'argenta-sidebar-page' );
	$sidebar_layout = ob_get_clean();
?>
	
<?php get_template_part( 'template-parts/elements/header-title' ); ?>

<?php get_template_part( 'template-parts/elements/breadcrumbs' ); ?>

<div class="<?php echo esc_attr( $page_wrapped ) ? 'wrapped-container' : 'full-width-container'; ?>">
	<div id="primary" class="content-area">
		<?php if ( $no_ecommerce && $sidebar_layout ) : ?>
		<div class="vc_col-md-9 page-with-right-sidebar<?php if ( $add_content_padding ) echo ' page-offset page-offset-bottom'; ?>">
		<?php else : ?>
		<div class="vc_col-md-12<?php if ( $add_content_padding ) echo ' page-offset page-offset-bottom'; ?>">
		<?php endif; ?>
			<main id="main" class="site-main">
			<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', 'page' );
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				endwhile;
			?>
			</main><!-- #main -->
		</div>
		
		<?php if ( $no_ecommerce && $sidebar_layout ) : ?>
		<div class="vc_col-md-3 page-sidebar">
			<aside id="secondary" class="widget-area">
                <?php dynamic_sidebar( 'argenta-sidebar-page' ); ?>
			</aside>
		</div>
		<?php endif; ?>
	</div><!-- #primary -->

</div><!-- wrapper -->

<?php
	get_footer();
?>
