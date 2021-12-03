<?php
	$project = argenta_gh_get_project_settings( $post );
?>

<div class="portfolio-container portfolio-eight">

	<?php if ( is_array( $project['images'] ) ) : ?>
	<!-- Vertical slider -->
	<div class="portfolio-full" data-page-scroll="true">
		<?php foreach ( $project['images'] as $art ) : ?>
		<section data-img="<?php echo esc_url( $art ); ?>"></section>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>

	<!-- Portfolio description hidden -->
	<div class="portfolio-description">
		<div class="content">
			<i class="icon-toggle ion-plus"></i>
			<div class="content-close<?php if ( ! $project['categories_plain'] ) { echo ' without-categories'; } ?>">
				<?php if ( $project['categories_plain'] ) : ?>
				<p class="subtitle small"><?php esc_html_e( 'category', 'argenta' ); ?>: <?php echo esc_html( $project['categories_plain'] ); ?></p>
				<?php endif; ?>
				<?php the_title( '<h3 class="title text-left">', '</h3>'); ?>
			</div>
			<div class="content-open portfolio-content">
				<?php if ( $project['categories_plain'] ) : ?>
				<p class="subtitle small"><?php esc_html_e( 'category', 'argenta' ); ?>: <?php echo esc_html( $project['categories_plain'] ); ?></p>
				<?php endif; ?>
				<?php the_title( '<h3 class="title text-left">', '</h3>'); ?>
				<div class="text-justify">
                    <?php echo wp_kses_post( $project['description'] ); ?>
					<?php echo do_shortcode( get_post_field( 'post_content', $post->ID ) ); ?>
					<?php if ( $project['task'] ) :?>
					<h5 class="title text-left uppercase"><?php esc_html_e( 'Task', 'argenta' ); ?></h5>
					<p><?php echo wp_kses( $project['task'], 'default' ); ?></p>
					<?php endif; ?>
				</div>
				<ul class="portfolio-info-list-inline">
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

	<?php if ( $project['show_navigation'] != 'none' ) : ?>
	<div class="portfolio-nav-paginator">
		<?php if ( $project['prev'] ) : ?>
		<a href="<?php echo esc_url( $project['prev']['url'] ); ?>" class="left brand-color-hover">
			<i class="ion-ios-arrow-left"></i>
		</a>
		<?php else : ?>
		<div class="left"></div>
		<?php endif; ?>

		<?php if ( $project['link_to_all'] ) : ?>
		<a href="<?php echo esc_url( $project['link_to_all'] ); ?>" class="center brand-color-hover">
			<i class="ion-grid"></i> 
		</a>
		<?php else : ?>
		<div class="center"></div>
		<?php endif; ?>

		<?php if ( $project['next'] ) : ?>
		<a href="<?php echo esc_url( $project['next']['url'] ); ?>" class="right brand-color-hover">
			<i class="ion-ios-arrow-right"></i>
		</a>
		<?php else : ?>
		<div class="right"></div>
		<?php endif; ?>
	</div>
	<?php endif; ?>

</div>