<li<?php if ( $with_styles ) { echo ' id="' . $contact_inner_uniqid . '"'; } ?><?php if ( $icon_is_filled ) { echo ' class="contact-item-icon-filled"'; } ?>>

	<span class="icon<?php if ( $icon_is_filled ) { echo '-shape'; } echo ' ' . $icon_as_icon;  ?>"></span>
	<?php if ( $block_type_layout == 'with_heading' ) : ?>
	<h4 class="title"><?php echo $heading; ?></h4>
	<?php endif; ?>
	<address><?php echo $info; ?></address>	

</li>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $info_css ) {
			$_style_block .= '#' . $contact_inner_uniqid . ' address{';
			$_style_block .= $info_css;
			$_style_block .= '}';
		}
		if ( $heading_css && $block_type_layout == 'with_heading' ) {
			$_style_block .= '#' . $contact_inner_uniqid . ' h4.title{';
			$_style_block .= $heading_css;
			$_style_block .= '}';
		}
		if ( $icon_fill_css && $icon_is_filled ) {
			$_style_block .= '#' . $contact_inner_uniqid . ' .icon-shape{';
			$_style_block .= $icon_fill_css;
			$_style_block .= '}';
		}
		if ( $icon_css ) {
			$_style_block .= '#' . $contact_inner_uniqid . ' .icon-shape,';
			$_style_block .= '#' . $contact_inner_uniqid . ' .icon{';
			$_style_block .= $icon_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>