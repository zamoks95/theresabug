
<?php get_template_part( 'template-parts/elements/breadcrumbs' ); ?>

<?php 
	global $post;
	$project = argenta_gh_get_project_settings( $post );
?>

<div class="wrapped-container">

	<?php if ( $project['navigation_position'] == 'top' && $project['show_navigation'] == 'prev_n_next' && ( $project['prev'] || $project['next'] ) ) : ?>
		<?php get_template_part( 'template-parts/elements/project-next-n-prev-nav' ); ?>
	<?php endif; ?>


	<div class="portfolio-container portfolio-seventh">

		<?php if ( $project['navigation_position'] == 'top' && $project['show_navigation'] == 'simple' && ( $project['prev'] || $project['next'] ) ) : ?>
			<?php get_template_part( 'template-parts/elements/project-simple-nav' ); ?>
		<?php endif; ?>

		<?php if ( $project['custom_content_position'] == 'top' ) : ?>
			<div class="portfolio-custom-content">
				<?php echo do_shortcode( get_post_field( 'post_content', $post->ID ) ); ?>
			</div>
		<?php endif; ?>

		<div class="wrap">
			<div class="portfolio-content<?php if ( ! $project['hide_breadcrumbs'] ) { echo ' no-margin'; } ?>">
				<div class="vc_col vc_col-sm-12">
					<?php if ( $project['categories_plain'] ) : ?>
					<p class="subtitle small"><?php esc_html_e( 'category', 'argenta' ); ?>: <?php echo esc_html( $project['categories_plain'] ); ?></p>
					<?php endif; ?>
					<?php the_title( '<h2 class="title text-left">', '</h2>'); ?>
				</div>
				<div class="portfolio-text vc_col vc_col-lg-8 vc_col-md-6 vc_col-sm-6">
                    <?php echo wp_kses_post( $project['description'] ); ?>
					<?php if ( $project['custom_content_position'] == 'center' ) : ?>
						<?php echo do_shortcode( get_post_field( 'post_content', $post->ID ) ); ?>
					<?php endif; ?>

					<?php if ( $project['task'] ) :?>
					<h5 class="title text-left uppercase"><?php esc_html_e( 'Task', 'argenta' ); ?></h5>
					<p><?php echo wp_kses( $project['task'], 'default' ); ?></p>
					<?php endif; ?>
				</div>
				<div class="portfolio-info vc_col vc_col-lg-4 vc_col-md-6 vc_col-sm-6">
					<ul class="portfolio-info-list">
						<?php if ( $project['date'] ) : ?>
						<li>
							<h5 class="title uppercase"><?php esc_html_e( 'Date', 'argenta' ); ?></h5>
							<p><?php echo esc_html( $project['date'] ); ?></p>
						</li>
						<?php endif; ?>

						<?php if ( $project['skills'] ) : ?>
						<li>
							<h5 class="title uppercase"><?php esc_html_e( 'Skills', 'argenta' ); ?></h5>
							<p><?php echo wp_kses( $project['skills'], 'default' ); ?></p>
						</li>
						<?php endif; ?>

						<?php if ( $project['client'] ) : ?>
						<li>
							<h5 class="title uppercase"><?php esc_html_e( 'Client', 'argenta' ); ?></h5>
							<p><?php echo wp_kses( $project['client'], 'default' ); ?></p>
						</li>
						<?php endif; ?>

						<?php if ( $project['link'] ) : ?>
						<li>
							<h5 class="title uppercase"><?php esc_html_e( 'Project link', 'argenta' ); ?></h5>
							<p><a href="<?php echo esc_url( $project['link'] ); ?>" target="_blank"><?php echo esc_html( $project['link'] ); ?></a></p>
						</li>
						<?php endif; ?>

						<?php if ( $project['custom_fields'] ) : ?>
							<?php foreach ( $project['custom_fields'] as $custom_field ) : ?>
							<li>
								<h5 class="title uppercase"><?php echo esc_html( $custom_field['title'] ); ?></h5>
								<p><?php echo esc_html( $custom_field['value'] ); ?></p>
							</li>
							<?php endforeach; ?>
						<?php endif; ?>
					</ul>

					<?php if ( ! $project['hide_sharing'] && count( $project['sharing_links'] ) > 0 ) : ?>
					<div class="socialbar small">
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( get_permalink() ); ?>" class="social">
							<span class="ion-social-facebook"></span>
						</a>
						<a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( $project['title'] ); ?>,+<?php echo rawurlencode( get_permalink() ); ?>" class="social">
							<span class="ion-social-twitter"></span>
						</a>
						<a href="https://plus.google.com/share?url=<?php echo rawurlencode( get_permalink() ); ?>" class="social">
							<span class="ion-social-googleplus-outline"></span>
						</a>
						<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo rawurlencode( get_permalink() ); ?>&title=<?php echo urlencode( $project['title'] ); ?>&source=<?php echo urlencode( get_bloginfo( 'name' ) ); ?>" class="social">
							<span class="ion-social-linkedin-outline"></span>
						</a>
						<a href="http://pinterest.com/pin/create/button/?url=<?php echo rawurlencode( get_permalink() ); ?>&description=<?php echo urlencode( $project['title'] ); ?>" class="social">
							<span class="ion-social-pinterest-outline"></span>
						</a>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	
		<div class="portfolio-images" data-gallery="portfolio-gallery">
			<?php if ( is_array( $project['images'] ) ) : ?>
			<?php $loop = 0; ?>
			<?php foreach ( $project['images'] as $i => $art ) : ?>
			<?php if ( $i % 9 == 0 && count( $project['images'] ) >= $i + 3 ) : ?>
			<div class="vc_col vc_col-lg-8 vc_col-sm-6 item">
			<?php else :?>
			<div class="vc_col vc_col-lg-4 vc_col-sm-6 item">
			<?php endif; ?>
				<div class="gallery-image" data-gallery-item="<?php echo esc_attr( $loop ); $loop += 1; ?>">
					<img class="gimg" src="<?php echo esc_url( $art ); ?>">
					<div class="overlay">
						<div class="icon-shape">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/images/arr-out.svg' ); ?>">
						</div>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>

	<?php if ( $project['custom_content_position'] == 'bottom' ) : ?>
		<div class="portfolio-custom-content">
			<?php echo do_shortcode( get_post_field( 'post_content', $post->ID ) ); ?>
		</div>
	<?php endif; ?>

	<?php 
		if ( ( $project['navigation_position'] == 'bottom' || $project['navigation_position'] == NULL ) &&
			$project['show_navigation'] == 'prev_n_next' && ( $project['prev'] || $project['next'] ) ) {
			get_template_part( 'template-parts/elements/project-next-n-prev-nav' );
		}
	?>

</div>

<?php 
	if ( ( $project['navigation_position'] == 'bottom' || $project['navigation_position'] == NULL ) &&
		$project['show_navigation'] == 'simple' && ( $project['prev'] || $project['next'] ) ) {
		get_template_part( 'template-parts/elements/project-simple-nav' );
	}
?>

<div class="gallery" id="portfolio-gallery">
	<div class="close">
		<span class="ion-ios-close-empty"></span>
	</div>
</div>