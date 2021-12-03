<div class="button_wrapper" <?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?> <?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>
	
	<a href="<?php echo esc_url($link['url']); ?>"<?php if ( $link['blank'] ) echo ' target="_blank"'; ?> class="btn<?php echo $button_class . $css_class; ?>"<?php if ( $with_styles ) { echo ' id="' . $button_uniqid . '"';  } ?>>
		<?php if ( $icon_use && $icon_as_icon ): ?>
		<span class="icon <?php echo $icon_as_icon; ?>"></span>
		<?php endif; ?>
		<span class="text"><?php if ( isset( $link['caption'] ) ) { echo $link['caption']; } ?></span>
		<?php if ( $layout == 'link') : ?>
		<span class="icon-arrow ion-ios-arrow-thin-right"></span>
		<?php endif; ?>
	</a>
	
</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $color_css ) {
			$_style_block .= '#' . $button_uniqid . '.btn{';
			$_style_block .= $color_css;
			$_style_block .= '}';
		}
		if ( $color_css_hover ) {
			$_style_block .= '#' . $button_uniqid . '.btn:hover{';
			$_style_block .= $color_css_hover;
			$_style_block .= '}';
		}
		if ( $title_css ) {
			$_style_block .= '#' . $button_uniqid . '.btn span.text{';
			$_style_block .= $title_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>