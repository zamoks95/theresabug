<div data-accordion-item="true"<?php if ( $with_styles ) { echo ' id="' . $accordion_inner_uniqid . '"'; } ?> <?php if ( $css_class ) { echo ' class="' . $css_class . '"'; } ?>>

	<div class="buttons">
		<?php if ( $with_icon && $icon_as_icon) : ?>
		<span class="icon <?php echo $icon_as_icon; ?>"></span>
		<?php endif; ?>
		<h5 class="title"><?php echo $heading; ?></h5>
		<div class="control">
			<span class="ion-plus"></span>
		</div>
		<div class="clear"></div>
	</div>

	<div class="content">
		<div class="wrap"><?php echo do_shortcode( $content_html ); ?></div>
	</div>

</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $heading_css ) {
			$_style_block .= '#' . $accordion_inner_uniqid . ' h5.title{';
			$_style_block .= $heading_css;
			$_style_block .= '}';
		}
		if ( $head_fill_css ) {
			$_style_block .= '#' . $accordion_inner_uniqid . ' .buttons{';
			$_style_block .= $head_fill_css;
			$_style_block .= '}';
		}
		if ( $icon_css ) {
			$_style_block .= '#' . $accordion_inner_uniqid . ' .icon{';
			$_style_block .= $icon_css;
			$_style_block .= '}';
		}
		if ( $heading_text_color ) {
			$_style_block .= '#' . $accordion_inner_uniqid . ' .control{';
			$_style_block .= 'color: ' . $heading_text_color;
			$_style_block .= '}';
		}
		if ( $content_css ) {
			$_style_block .= '#' . $accordion_inner_uniqid . ' .content .wrap, #' . $accordion_inner_uniqid . ' .content .wrap p {';
			$_style_block .= $content_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>
