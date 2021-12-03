<div id="<?php echo $text_uniqid; ?>"<?php if ( $css_class ) echo ' class="text-wrapper ' . $css_class . '"'; ?> <?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?> <?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>
	<?php echo do_shortcode( $content_html ); ?>
</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';
		
		if ( $text_css ) {
			$_style_block .= '#' . $text_uniqid . ',#' . $text_uniqid . ' > *{';
			$_style_block .= $text_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>