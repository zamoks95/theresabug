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
						<h1 class="text-left"><?php esc_html_e( 'No Result', 'argenta' ); ?></h1>
						<h3 class="second-title text-left"><?php esc_html_e( 'Sorry, but nothing matched your search criteria', 'argenta' ); ?></h3>
						<p class="subtitle">
							<?php esc_html_e( 'Please try again with some different keywords', 'argenta' ); ?>
						</p>
					</div>
					<?php get_search_form( true ); ?>
				</div>
			</div><!-- .page-content -->
		</section>

	</main><!-- #main -->
</div><!-- #primary -->
