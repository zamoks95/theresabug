<?php 
	$argenta_project = argenta_gh_get_current_item_data();
	if ( $argenta_project ) :
?>

	<div class="portfolio-gallery<?php if ( \Argenta\Settings::get( 'portfolio_gallery_light', 'global' ) != 'light' ) { echo ' gallery-dark'; } ?>" id="<?php echo esc_attr( $argenta_project['popup_id'] ); ?>">
		<div class="slider"<?php if ( $argenta_project['loop_popup_slider'] ) { echo ' data-loop="true"'; } ?>>
			<?php foreach ( $argenta_project['images'] as $i => $art ) : ?>
			<img data-src="<?php echo esc_url( $art ); ?>">
			<?php endforeach; ?>
		</div>

		<div class="gallery-content">
			<div class="block-centered">
				<div class="content">
					<div class="portfolio-content">
						<?php if ( $argenta_project['categories_plain'] ) : ?>
						<p class="subtitle small"><?php echo esc_html__( 'category', 'argenta' ) . ': ' . esc_html( $argenta_project['categories_plain'] ); ?></p>
						<?php endif; ?>
						<h2 class="title text-left"><?php echo esc_html( $argenta_project['title'] ); ?></h2>
						<p>
                            <?php echo wp_kses_post( $argenta_project['description'] ); ?>
						</p>
						<div class="portfolio-info">
							<ul class="portfolio-info-list">
								<?php if ( $argenta_project['date'] ) : ?>
								<li>
									<h5 class="title uppercase"><?php esc_html_e( 'Date', 'argenta' ); ?></h5>
									<p><?php echo esc_html( $argenta_project['date'] ); ?></p>
								</li>
								<?php endif; ?>

								<?php if ( $argenta_project['skills'] ) : ?>
								<li>
									<h5 class="title uppercase"><?php esc_html_e( 'Skills', 'argenta' ); ?></h5>
									<p><?php echo wp_kses( $argenta_project['skills'], 'default' ); ?></p>
								</li>
								<?php endif; ?>

								<?php if ( $argenta_project['client'] ) : ?>
								<li>
									<h5 class="title uppercase"><?php esc_html_e( 'Client', 'argenta' ); ?></h5>
									<p><?php echo wp_kses( $argenta_project['client'], 'default' ); ?></p>
								</li>
								<?php endif; ?>

								<?php if ( $argenta_project['link'] ) : ?>
								<li>
									<h5 class="title uppercase"><?php esc_html_e( 'Project link', 'argenta' ); ?></h5>
									<p><a href="<?php echo esc_url( $argenta_project['link'] ); ?>" target="_blank"><?php echo esc_html( $argenta_project['link'] ); ?></a></p>
								</li>
								<?php endif; ?>

								<?php if ( $argenta_project['custom_fields'] ) : ?>
									<?php foreach ( $argenta_project['custom_fields'] as $custom_field ) : ?>
									<li>
										<h5 class="title uppercase"><?php echo esc_html( $custom_field['title'] ); ?></h5>
										<p><?php echo esc_html( $custom_field['value'] ); ?></p>
									</li>
									<?php endforeach; ?>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="gallery-close" data-popup-close="true">
			<span class="ion-ios-close-empty"></span>
		</div>
	</div>

<?php endif;