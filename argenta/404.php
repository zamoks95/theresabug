<?php
	get_header(); 
?>

	<div class="header-cap"></div>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<div class="page-content">
					<div class="page-error">
						<div class="icon-shape">
							<i class="ion-ios-close-empty"></i>
						</div>
						<div class="page-error-content">
							<h1 class="text-left"><?php esc_html_e( 'Error 404', 'argenta' ); ?></h1>
							<h3 class="text-left"><?php esc_html_e( 'Oops! That page can\'t be found', 'argenta' ); ?></h3>
							<p class="subtitle">
								<?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'argenta' ); ?>
							</p>
						</div>
						<form class="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="POST">
							<input type="text" placeholder="<?php esc_attr_e( 'Search', 'argenta' ); ?>" name="s">
							<button class="btn btn-outline" type="submit">
								<span class="icon ion-ios-search"></span>
							</button>
						</form>
					</div>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
	get_footer();