<?php
	$argenta_post = argenta_gh_get_current_item_data();
?>
	<article class="blog-item<?php if ( $argenta_post['boxed'] ) { echo ' blog-item-boxed'; } if ( in_array( 'sticky', get_post_class( '', $argenta_post['post_id'] ) ) ) { echo ' sticky'; } ?>" data-aos="fade-up" data-aos-once="true">
		<div class="blog-item-image-wrap">
			<?php if ( $argenta_post['media']['video'] ) :
                // video
                $allowed_html = array(
                    'iframe' => array(
                        'frameborder' => true,
                        'allowfullscreen' => true,
                        'src' => true
                    )
                );
                echo wp_kses($argenta_post['media']['video'], $allowed_html);
            ?>

			<?php elseif ( $argenta_post['media']['audio'] ) : // audio ?>
			<?php echo wp_kses( $argenta_post['media']['audio'], 'post' ); ?>

			<?php elseif ( $argenta_post['media']['gallery'] ) : //gallery ?>
			<?php echo wp_kses( $argenta_post['media']['gallery'], 'post' ); ?>
			
			<?php elseif ( $argenta_post['media']['image'] ) : // simple link image ?>
			<a href="<?php echo esc_url( $argenta_post['url'] ); ?>">
				<img class="full-width" src="<?php echo esc_url( $argenta_post['media']['image'] ); ?>" alt="<?php echo esc_attr( $argenta_post['title'] ); ?>">
			</a>
			<?php endif; ?>
		</div>
		
		<div class="blog-item-content">

			<?php if ( $argenta_post['categories'] ) : ?>
			<div class="category subtitle-font">
				<?php foreach ($argenta_post['categories'] as $_category) : ?>
					<a class="brand-border-color brand-color" href="<?php echo esc_url( get_category_link( $_category->cat_ID ) ); ?>">
						<?php echo esc_html( $_category->name ); ?>
					</a>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

			<?php if ( $argenta_post['media']['blockquote'] ) : // blockquote ?>
			<div class="blog-item-blockquote-wrap">
				<a href="<?php echo esc_url( $argenta_post['url'] ); ?>">
					<?php echo wp_kses( $argenta_post['media']['blockquote'], 'post' ); ?>
				</a>
			</div>
			<?php endif; ?>

			<?php if ( ! $argenta_post['media']['blockquote'] ) : ?>

			<h3 class="title text-left"><?php if ( in_array( 'sticky', get_post_class( '', $argenta_post['post_id'] ) ) ) { echo '<span class="ion-pin"></span>'; } ?><a href="<?php echo esc_url( $argenta_post['url'] ); ?>"><?php echo esc_html( $argenta_post['title'] ); ?></a></h3>

			<?php endif; ?>

		</div>

		<footer class="item-footer">
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

	</article>