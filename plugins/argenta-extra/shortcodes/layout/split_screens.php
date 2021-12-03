<div class="arg-splitscreen<?php echo $css_class; ?>" id="<?php echo $split_screens_uniqid; ?>" data-arg-splitscreen="true" <?php if ( $navigation_buttons ) { echo ' data-arg-splitscreen-nav="true"'; } ?>>
	<?php 
		echo do_shortcode( $content );
	?>	
</div>

<?php 
	if ( $with_styles ) {
		$_style_block = '';

		if ( $animation_duration_css ) {
			$_style_block .= '#' . $split_screens_uniqid . ' .ms-easing{';
			$_style_block .= $animation_duration_css;
			$_style_block .= '}'; 
		}
		if ( $navigation_css ) {
			$_style_block .= '#multiscroll-nav li a{';
			$_style_block .= $navigation_css;
			$_style_block .= '}';
			$_style_block .= '#multiscroll-nav li a.active{';
			$_style_block .= $navigation_active_css;
			$_style_block .= '}'; 
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>