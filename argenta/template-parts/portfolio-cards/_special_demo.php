<?php
	$argenta_project = argenta_gh_get_current_item_data();
?>

<div class="portfolio-item portfolio-item-special"<?php if ( $argenta_project['in_popup'] ) { echo ' data-portfolio-popup="' . esc_attr( $argenta_project['popup_id'] ) . '"'; } ?>>
	<div class="portfolio-item-image">
		<?php if ( is_array( $argenta_project['images'] ) && count( $argenta_project['images'] ) > 0) : ?>
		<div class="portfolio-item-image-wrap">
			<a href="<?php echo esc_url( $argenta_project['url'] ); ?>"<?php if ( $argenta_project['external'] ) { echo ' target="_blank"'; } ?>>
				<img src="<?php echo esc_url( $argenta_project['images'][0] ); ?>" alt="<?php echo esc_attr( $argenta_project['title'] ); ?>">
			</a>
		</div>
		<?php endif; ?>
	</div>
	<div class="portfolio-item-description">
		<h4 class="title text-center"><a href="<?php echo esc_url( $argenta_project['url'] ); ?>"<?php if ( $argenta_project['external'] ) { echo ' target="_blank"'; } ?>><?php echo esc_html( $argenta_project['title'] ); ?></a></h4>
		<?php if ( $argenta_project['categories'] ) : ?>
		<p class="subtitle"><?php echo wp_kses( $argenta_project['task'], 'post'); ?></p>
		<?php endif; ?>
	</div>
</div>