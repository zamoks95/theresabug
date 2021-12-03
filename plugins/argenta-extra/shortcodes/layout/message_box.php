<div class="message-box<?php echo $message_box_class . $css_class; ?>"<?php if ( $with_styles ) { echo ' id="' . $message_box_uniqid . '"';  } ?> <?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?> <?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>

	<?php echo $text; ?>
	<?php if ( $link ): ?>
	<a href="<?php echo $link['url']; ?>"<?php if ( $link['blank'] ) echo ' target="_blank"'; ?>>
		<?php echo $link['caption']; ?>
	</a>
	<?php endif; ?>

</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $text_css ) {
			$_style_block .= '#' . $message_box_uniqid . '.message-box{';
			$_style_block .= $text_css;
			$_style_block .= '}';
		}
		if ( $link_css ) {
			$_style_block .= '#' . $message_box_uniqid . '.message-box a{';
			$_style_block .= $link_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>
