<?php
	$argenta_project = argenta_gh_get_current_item_data();
?>
<div class="portfolio-item portfolio-item-hover-3"
	<?php if ( $argenta_project['in_popup'] ) { echo ' data-portfolio-popup="' . esc_attr( $argenta_project['popup_id'] ) . '"'; } ?> 
	<?php if ( $argenta_project['with_animation'] ) { echo ' data-aos="fade-up" data-aos-once="true"'; } ?>>
	
	<div class="portfolio-item-image">
		<?php if ( is_array( $argenta_project['images'] ) && count( $argenta_project['images'] ) > 0) : ?>
		<div class="portfolio-item-image-wrap">
			<img src="<?php echo esc_url( $argenta_project['images'][0] ); ?>" alt="<?php echo esc_attr( $argenta_project['title'] ); ?>">
		</div>
		<?php endif; ?>
	</div>
	
	<div class="portfolio-item-image-overlay">
		<a class="portfolio-item-resize" href="<?php echo esc_url( $argenta_project['url'] ); ?>"<?php if ( $argenta_project['external'] ) { echo ' target="_blank"'; } ?>>
			<span class="icon my-icon-arr-out"></span>
		</a>
	</div>
	
	<div class="portfolio-item-description">
		<h4 class="title"><a href="<?php echo esc_url( $argenta_project['url'] ); ?>"<?php if ( $argenta_project['external'] ) { echo ' target="_blank"'; } ?>><?php echo esc_html( $argenta_project['title'] ); ?></a></h4>
		<?php if ( $argenta_project['short_description'] ) : ?>
		<div class="details">
			<p><?php echo wp_kses($argenta_project['short_description'], 'post'); ?></p>
		</div>
		<?php endif; ?>
		<?php if ( $argenta_project['categories_plain'] ) : ?>
		<div class="category subtitle-font"><?php echo wp_kses($argenta_project['categories_plain'], 'post'); ?></div>
		<?php endif; ?>
	</div>

</div>