<?php /* Template Name: Page with left sidebar */ ?>

<?php
	get_header();
	
	$page_wrapped = \Argenta\Settings::page_is_wrapped();
	$add_content_padding = \Argenta\Settings::page_add_top_padding();
	$no_ecommerce = ! \Argenta\Settings::page_is( 'ecommerce' );
?>

<?php get_template_part( 'template-parts/elements/header-title' ); ?>

<?php get_template_part( 'template-parts/elements/breadcrumbs' ); ?>

<div class="<?php echo esc_attr( $page_wrapped ) ? 'wrapped-container' : 'full-width-container'; ?>">
	<div id="primary" class="content-area">

		<?php if ( $no_ecommerce ) : ?>
		<div class="vc_col-md-3 page-sidebar">
			<aside id="secondary" class="widget-area">
				<?php dynamic_sidebar( 'argenta-sidebar-page' ); ?>
			</aside>
		</div>
		<?php endif; ?>

		<div class="vc_col-md-<?php echo esc_attr( $no_ecommerce ) ? '9' : '12'; ?> page-with-left-sidebar<?php if ( $add_content_padding ) echo ' page-offset-top page-offset-bottom'; ?>">
			<main id="main" class="site-main">
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content', 'page' );
				}
				?>
			</main><!-- #main -->
		</div>

	</div><!-- #primary -->
</div><!-- wrapper -->
	
<?php
	get_footer();