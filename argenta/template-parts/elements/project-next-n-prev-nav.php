<?php 
	$project = argenta_gh_get_project_settings( $post );
?>

<div class="portfolio-post-navigation vc_row vc_row-full-width">
	<div class="vc_col-md-6">
		<?php if ( $project['prev'] ) : ?>
		<a href="<?php echo esc_url( $project['prev']['url'] ); ?>" class="portfolio-post-navigation-block left text-center">
			<div class="portfolio-btn">
				<span class="ion-ios-arrow-left"></span>
			</div>
			<?php if ( $project['prev']['image'] ) : ?>
			<div class="post-image">
				<img src="<?php echo esc_url( $project['prev']['image'] ); ?>" alt="<?php echo esc_attr( $project['prev']['title'] ); ?>">
			</div>
			<?php endif; ?>
			<div class="content">
				<div class="wrap">
					<div class="wrap-center">
						<p class="subtitle small"><?php esc_html_e( 'Previous project', 'argenta' ); ?></p>
						<h3 class="title"><?php echo wp_kses( $project['prev']['title'], 'default' ); ?></h3>
					</div>
				</div>
			</div>
		</a>
		<?php endif; ?>
	</div>
	<div class="vc_col-md-6">
		<?php if ( $project['next'] ) : ?>
		<a href="<?php echo esc_url( $project['next']['url'] ); ?>" class="portfolio-post-navigation-block right text-center">
			<div class="content">
				<div class="wrap">
					<div class="wrap-center">
						<p class="subtitle small"><?php esc_html_e( 'Next project', 'argenta' ); ?></p>
						<h3 class="title"><?php echo wp_kses( $project['next']['title'], 'default' ); ?></h3>
					</div>
				</div>
			</div>
			<div class="portfolio-btn">
				<span class="ion-ios-arrow-right"></span>
			</div>
			<?php if ( $project['next']['image'] ) : ?>
			<div class="post-image">
				<img src="<?php echo esc_url( $project['next']['image'] ); ?>" alt="<?php echo esc_attr( $project['next']['title'] ); ?>">
			</div>
			<?php endif; ?>
		</a>
		<?php endif; ?>
	</div>
</div>
