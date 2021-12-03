<div class="accordion-box<?php if( $accordion_tabs_type == 'outline' ) { echo ' outline'; } ?><?php echo $css_class; ?>" data-accordion="true" <?php if ( $with_styles ) { echo ' id="' . $accordion_uniqid . '"'; } ?>>
	
	<?php echo do_shortcode( $content ); ?>
	<div class="clear"></div>

</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $active_tab_css ) {
			$_style_block .= '#' . $accordion_uniqid . ' .active .title{';
			$_style_block .= $active_tab_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>