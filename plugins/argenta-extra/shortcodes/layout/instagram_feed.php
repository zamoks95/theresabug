
<div class="argenta-instagram-feed-sc instagram-feed vc_row<?php echo $css_class ? $css_class : '' ?>"
	id="<?php echo esc_attr( $instagram_feed_uniqid ); ?>"
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . esc_attr( $appearance_effect ) . '"'; } ?>
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . esc_attr( $appearance_duration ) . '"'; } ?>>

	<?php
		if( isset( $result ) ) :
			$_counter = 0;
			foreach ( $result as $post ) : ?>
				<?php $thumbnail = end( $post['node']['thumbnail_resources'] ); ?>

				<?php $_counter++; ?>
				<?php if ( $_counter > $photo_count ) break; ?>

				<?php if ( $columns == '5' ) : ?>
					<div class="col-md-five-columns column">
				<?php else : ?>
					<div class="vc_col-md-<?php echo $column; ?> column">
				<?php endif; ?>

				<?php if ( $card_type == 'vertical' ) : ?>
					<a href="<?php echo esc_url( 'https://www.instagram.com/p/' . $post['node']['shortcode'] . '/?taken-by=' . $username ); ?>"><img src="<?php echo esc_attr( $thumbnail['src'] ) ?>" alt=""/></a>
				<?php else : ?>
					<a href="<?php echo esc_url( 'https://www.instagram.com/p/' . $post['node']['shortcode'] . '/?taken-by=' . $username ); ?>"><div style="background-size:cover;background-image:url('<?php echo esc_url( $thumbnail['src'] ) ?>');"></div></a>
				<?php endif; ?>

					</div>

			<?php endforeach;
		endif;
	?>
</div>


<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $column_css ) {
			$_style_block .= '#' . $instagram_feed_uniqid . ' .column{';
			$_style_block .= $column_css;
			$_style_block .= '}';
		}
		if ( $image_css ) {
			$_style_block .= '#' . $instagram_feed_uniqid . ' .column a{';
			$_style_block .= $image_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>
