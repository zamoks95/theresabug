<?php
	$argenta_project = argenta_gh_get_current_item_data();
	$_project_uniqid = false;
	if ( isset( $argenta_project['overlay'] ) && $argenta_project['overlay'] ) {
		$_project_uniqid = uniqid( 'argenta_post_style_' );
		if ( substr( trim( $argenta_project['overlay'] ), 0, 4 ) != 'rgba' ) {
			$_overlay_color = \Argenta\Helper::hex_to_rgba( $argenta_project['overlay'], 0.5 );
		} else {
			$_overlay_color = $argenta_project['overlay'];
		}
	}
?>
<div class="portfolio-item-2"
	<?php if ( $_project_uniqid ) { echo ' id="' . $_project_uniqid . '"'; } ?>
	<?php if ( $argenta_project['in_popup'] ) { echo ' data-portfolio-popup="' . esc_attr( $argenta_project['popup_id'] ) . '"'; } ?>
	<?php if ( $argenta_project['with_animation'] ) { echo ' data-aos="fade-up" data-aos-once="true"'; } ?>>
	
	<div class="portfolio-item-image">
		<?php if ( is_array( $argenta_project['images'] ) && count( $argenta_project['images'] ) > 0) : ?>
		<div class="portfolio-item-image-wrap">
			<img src="<?php echo esc_url( $argenta_project['images'][0] ); ?>" alt="<?php echo esc_attr( $argenta_project['title'] ); ?>">
		</div>
		<div class="portfolio-item-image-overlay">
			<a class="portfolio-item-resize" href="<?php echo esc_url( $argenta_project['url'] ); ?>"<?php if ( $argenta_project['external'] ) { echo ' target="_blank"'; } ?>>
				<span class="icon my-icon-arr-out"></span>
			</a>
		</div>
		<?php endif; ?>
	</div>

	<div class="portfolio-item-description">
		<h4 class="title"><a href="<?php echo esc_url( $argenta_project['url'] ); ?>"<?php if ( $argenta_project['external'] ) { echo ' target="_blank"'; } ?>><?php echo esc_html( $argenta_project['title'] ); ?></a></h4>
		<?php if ( $argenta_project['categories_plain'] ) : ?>
		<div class="category subtitle-font gray"><?php echo wp_kses($argenta_project['categories_plain'], 'post'); ?></div>
		<?php endif; ?>
	</div>

</div>

<?php
	if ( $_project_uniqid ) {
		$custom_css = '#' . $_project_uniqid . ' .portfolio-item-image-overlay {background:' . $_overlay_color . ';} '; 
		wp_add_inline_style( 'argenta-style', $custom_css );
	}
?>