<div <?php if ( $with_styles ) { echo 'id="' . $testimonial_uniqid . '" '; } ?>class="<?php echo $type_class . $css_class; ?>">
	<?php if ( $block_type_layout == 'photo_top' && $photo ) : ?>
	
	<div class="testimonials-avatar">
		<img src="<?php echo $photo; ?>" alt="<?php echo $author; ?>">
	</div>
	<?php endif; ?>

	<?php if ( $block_type_layout == 'photo_and_mark' || $block_type_layout == 'default' ) : ?>
	<div class="testimonials-quote">
		<span class="icon ion-quote"></span>
	</div>
	<?php endif; ?>

	<blockquote><?php echo $quote; ?></blockquote>

	<?php if ( $block_type_layout == 'left_align' || $block_type_layout == 'right_align' ) : ?>
	<div class="testimonials-quote">
		<span class="icon ion-quote"></span>
	</div>
	<?php endif; ?>

	<?php if ( ( $block_type_layout == 'photo_middle' || $block_type_layout == 'photo_and_mark' ) && $photo ) : ?>
	<div class="testimonials-avatar">
		<img src="<?php echo $photo; ?>" alt="<?php echo $author; ?>">
	</div>
	<?php endif; ?>

	<?php if ( $block_type_layout == 'left_align' || $block_type_layout == 'right_align' ) : ?>
	<div class="testimonials-wrap-content">
	<?php endif; ?>
	<h4 class="title">- <?php echo $author; ?></h4>
	<p class="subtitle small"><?php echo $position; ?></p>
	<?php if ( $block_type_layout == 'left_align' || $block_type_layout == 'right_align' ) : ?>
	</div>
	<?php endif; ?>

</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $quote_css ) {
			$_style_block .= '#' . $testimonial_uniqid . ' blockquote{';
			$_style_block .= $quote_css;
			$_style_block .= '}';
		}
		if ( $image_css ) {
			$_style_block .= '#' . $testimonial_uniqid . ' .testimonials-avatar{';
			$_style_block .= $image_css;
			$_style_block .= '}';
		}
		if ( $author_css ) {
			$_style_block .= '#' . $testimonial_uniqid . ' h4.title{';
			$_style_block .= $author_css;
			$_style_block .= '}';
		}
		if ( $position_css ) {
			$_style_block .= '#' . $testimonial_uniqid . ' p.subtitle{';
			$_style_block .= $position_css;
			$_style_block .= '}';
		}
		if ( $mark_css ) {
			$_style_block .= '#' . $testimonial_uniqid . ' .testimonials-quote .icon{';
			$_style_block .= $mark_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>