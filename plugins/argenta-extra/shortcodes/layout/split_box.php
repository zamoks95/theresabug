<div class="split-box<?php echo $css_class; if ( $full_vh ) { echo ' full-vh'; } ?>" id="<?php echo $split_box_uniqid; ?>" 
	<?php if ( $bg_first_parallax ) echo 'data-parallax-left="' . $bg_first_parallax . '"'; ?>
	<?php if ( $bg_second_parallax ) echo 'data-parallax-right="' . $bg_second_parallax . '"'; ?>
	<?php if ( $bg_first_parallax ) echo 'data-parallax-speed-left="' . $bg_first_parallax_speed . '"'; ?>
	<?php if ( $bg_second_parallax ) echo 'data-parallax-speed-right="' . $bg_second_parallax_speed . '"'; ?>>
	<?php echo do_shortcode( $content ); ?>	
</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $bg_first_css ) {
			$_style_block .= '#' . $split_box_uniqid . ' .split-box-wrap:nth-child(1) .parallax-bg{';
			$_style_block .= $bg_first_css;
			$_style_block .= '}';
		}
		if ( $bg_first_after_css ) {
			$_style_block .= '#' . $split_box_uniqid . ' .split-box-wrap:nth-child(1):after{';
			$_style_block .= $bg_first_after_css;
			$_style_block .= '}';
		}
		if ( $bg_second_css ) {
			$_style_block .= '#' . $split_box_uniqid . ' .split-box-wrap:nth-child(2) .parallax-bg{';
			$_style_block .= $bg_second_css;
			$_style_block .= '}';
		}
		if ( $bg_second_after_css ) {
			$_style_block .= '#' . $split_box_uniqid . ' .split-box-wrap:nth-child(2):after{';
			$_style_block .= $bg_second_after_css;
			$_style_block .= '}';
		}
		if ( $first_side_paddings_css || $first_vertical_paddings_css ) {
			$_style_block .= '#' . $split_box_uniqid . ' .split-box-wrap:nth-child(1){';
			$_style_block .= $first_side_paddings_css;
			$_style_block .= $first_vertical_paddings_css;
			$_style_block .= '}';
		}
		if ( $second_side_paddings_css || $second_vertical_paddings_css ) {
			$_style_block .= '#' . $split_box_uniqid . ' .split-box-wrap:nth-child(2){';
			$_style_block .= $second_side_paddings_css;
			$_style_block .= $second_vertical_paddings_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>