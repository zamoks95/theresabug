<?php /* Template Name: For page builder */ ?>

<?php
	get_header();

	$page_wrapped = \Argenta\Settings::page_is_wrapped();
	$add_content_padding = \Argenta\Settings::page_add_top_padding();
?>

<div class="<?php echo esc_attr( $page_wrapped ) ? 'wrapped-container' : 'full-width-container'; ?>">
	
	<div class="vc_col-sm-12<?php if ( $add_content_padding ) echo ' page-offset page-offset-bottom'; ?>">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">

				<?php
					while ( have_posts() ) {
						the_post();
						get_template_part( 'template-parts/content', 'page' );
					}
				?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- .vc_col-sm-12 -->

</div><!-- wrapper -->
	
<?php
	get_footer();