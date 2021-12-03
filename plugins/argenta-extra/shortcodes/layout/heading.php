<div <?php if ( $with_styles ) { echo 'id="' . $headings_uniqid . '" '; } ?> class="heading-wrapper <?php echo $module_layout_class . $css_class; ?>" <?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?> <?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>
	<?php if ( $subtitle_type_layout == 'top_subtitle' ) : ?>
		<p class="subtitle"><?php echo $subtitle; ?></p>
	<?php endif; ?>

	<<?php echo $heading_tag; ?> class="second-title <?php echo $module_layout_class; ?>"><?php echo $title; ?></<?php echo $heading_tag; ?>>

	<?php if ( $subtitle_type_layout == 'middle_subtitle' ) : ?>
		<p class="subtitle"><?php echo $subtitle; ?></p>
	<?php endif; ?>

	<?php if ( ! $hide_divider ) : ?>
	<?php switch ( $divider_type ) {
		case 'dashed':
			echo '<div class="divider-dashed"><div class="divider-line"></div><div class="divider-line"></div></div>';
			break;
		case 'solid':
			echo '<div class="divider-solid"><div class="divider-line"></div></div>';
			break;
	} ?>
	<?php endif; ?>

	<?php if ( $subtitle_type_layout == 'bottom_subtitle' ) : ?>
		<p class="subtitle"><?php echo $subtitle; ?></p>
	<?php endif; ?>
</div>	

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $title_css ) {
			$_style_block .= '#' . $headings_uniqid . ' ' . $heading_tag . '{';
			$_style_block .= $title_css;
			$_style_block .= '}';
		}
		if ( $subtitle_css ) {
			$_style_block .= '#' . $headings_uniqid . ' p.subtitle{';
			$_style_block .= $subtitle_css;
			$_style_block .= '}';
		}
		if ( $divider_color_css ) {
			$_style_block .= '#' . $headings_uniqid . ' .divider-line{';
			$_style_block .= $divider_color_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>