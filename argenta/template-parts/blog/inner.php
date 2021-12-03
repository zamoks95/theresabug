<?php
	$argenta_post = argenta_gh_get_current_item_data();
	$_post_uniqid = false;
	if ( isset( $argenta_post['overlay'] ) && $argenta_post['overlay'] ) {
		$_post_uniqid = uniqid( 'argenta_post_style_' );
		if ( substr( trim( $argenta_project['overlay'] ), 0, 4 ) != 'rgba' ) {
			$_overlay_color = \Argenta\Helper::hex_to_rgba( $argenta_post['overlay'], 0.5 );
			$_overlay_color_hover = \Argenta\Helper::hex_to_rgba( $argenta_post['overlay'], 0.7 );
		} else {
			$_overlay_color = $argenta_post['overlay'];
			$_overlay_color_hover = $argenta_post['overlay'];
		}
	}
?>

<article class="blog-item blog-item-hovering"<?php if ( $_post_uniqid ) { echo ' id="' . $_post_uniqid . '"'; } if ( in_array( 'sticky', get_post_class( '', $argenta_post['post_id'] ) ) ) { echo ' sticky'; } ?> data-aos="fade-up" data-aos-once="true">
	<div class="blog-item-image-wrap">
		<?php if ( $argenta_post['media']['image'] ) : // simple link image ?>
		<a href="<?php echo esc_url( $argenta_post['url'] ); ?>">
			<img class="full-width" src="<?php echo esc_url( $argenta_post['media']['image'] ); ?>" alt="<?php echo esc_attr( $argenta_post['title'] ); ?>">
		</a>
		<?php endif; ?>
	</div>
	<div class="overlay">
		<?php if ( $argenta_post['categories'] ) : ?>
		<div class="category subtitle-font">
			<?php foreach ($argenta_post['categories'] as $_category) : ?>
				<a class="brand-border-color brand-color" href="<?php echo esc_url( get_category_link( $_category->cat_ID ) ); ?>">
					<?php echo esc_html( $_category->name ); ?>
				</a>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

		<h3 class="title text-left"><a href="<?php echo esc_url( $argenta_post['url'] ); ?>"><?php echo esc_html( $argenta_post['title'] ); ?></a></h3>

		<footer class="item-footer top">
			<?php if ( $argenta_post['author'] ) : ?>
			<div class="left">
				<p class="text-small">
					<b><?php esc_html_e( 'By', 'argenta' ); ?> <?php echo esc_html( $argenta_post['author'] ); ?></b>
				</p>
			</div>
			<?php endif; ?>
			
			<?php if ( $argenta_post['date'] ) : ?>
			<div class="right">
				<p class="subtitle text-small"><?php echo esc_html( $argenta_post['date'] ); ?></p>
			</div>
			<?php endif; ?>
		</footer>
	</div>
</article>

<?php
	if ( $_post_uniqid ) {
		$custom_css = '#' . $_post_uniqid . ' .overlay { background: ' . $_overlay_color . '; } ' . "\n";
		$custom_css .= '#' . $_post_uniqid . ' .overlay:hover { background: ' . $_overlay_color_hover . '; } ';
		wp_add_inline_style( 'argenta-style', $custom_css );
	}
?>