<div class="parallax<?php if ( $css_class ) echo $css_class; ?>" id="<?php echo $parallax_uniqid; ?>"
	data-parallax-bg="<?php echo $parallax; ?>" data-parallax-speed="<?php echo $parallax_speed; ?>">

	<div class="parallax-bg"></div>
	<div class="parallax-content">
		<?php echo do_shortcode( $content ); ?>
	</div>

</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $parallax_css ) {
			$_style_block .= '#' . $parallax_uniqid . ' .parallax-bg{';
			$_style_block .= $parallax_css;
			$_style_block .= '}';
		}
		if ( $overlay_css ) {
			$_style_block .= '#' . $parallax_uniqid . ':after{';
			$_style_block .= $overlay_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>