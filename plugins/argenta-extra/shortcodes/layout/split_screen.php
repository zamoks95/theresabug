<div class="ms-section" id="<?php echo $split_screen_uniqid; ?>">
	<?php echo do_shortcode( $content ); ?>
</div>

<?php 
	if ( $with_styles ) {
		$_style_block = '';
		$_style_block .= '#' . $split_screen_uniqid . '{';
		if ( bg_css ) {
			$_style_block .= $bg_css;
		}
		if ( $side_paddings_css ) {
			$_style_block .= $side_paddings_css;
		}
		$_style_block .= '}';
		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>