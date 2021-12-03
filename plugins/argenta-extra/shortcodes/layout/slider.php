<div class="slider<?php echo $slider_class; ?><?php echo $css_class; ?>" id="<?php echo $slider_uniqid; ?>" data-slider="true"
	data-slide-by="<?php echo $slide_by; ?>" data-autoplay-time="<?php echo $autoplay_time; ?>"
	data-autoplay="<?php echo $autoplay; ?>" data-nav="<?php echo $navigation_buttons; ?>" data-pagination="<?php echo $pagination_show; ?>"
	data-loop="<?php echo $loop; ?>" data-items-desktop="<?php echo $item_desktop; ?>" data-items-tablet="<?php echo $item_tablet; ?>"
	data-items-mobile="<?php echo $item_mobile; ?>" data-stop-hover="<?php echo $stop_on_hover; ?>" <?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?><?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?><?php if ( $dots_each ) { echo ' data-dots-each="' . $dots_each . '"'; } ?>>

	<?php echo do_shortcode( $content ); ?>
	
</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $items_css ) {
			$_style_block .= '#' . $slider_uniqid . ' .owl-item{';
			$_style_block .= $items_css;
			$_style_block .= '}';
		}
		if ( $dots_css ) {
			$_style_block .= '#' . $slider_uniqid . ' .owl-controls .owl-dots .owl-dot{';
			$_style_block .= $dots_css;
			$_style_block .= '}';
			$_style_block .= '#' . $slider_uniqid . ' .owl-controls .owl-dots .owl-dot.active{';
			$_style_block .= 'background-color:transparent;';
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>