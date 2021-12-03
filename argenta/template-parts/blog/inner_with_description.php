<?php
	$argenta_post = argenta_gh_get_current_item_data();
	$argenta_post['preview'] = wp_trim_words( $argenta_post['preview'], 22 );
?>

<article class="blog-item blog-item-hovering<?php if ( in_array( 'sticky', get_post_class( '', $argenta_post['post_id'] ) ) ) { echo ' sticky'; } ?>" data-aos="fade-up" data-aos-once="true">
	<div class="blog-item-image-wrap">
		<?php if ( $argenta_post['media']['image'] ) : // simple image link ?>
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

		<?php if ( $argenta_post['preview'] ) : ?>
		<p><?php echo esc_html( $argenta_post['preview'] ); ?></p>
		<?php endif; ?>

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