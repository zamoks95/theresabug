<div class="gallery-wrap<?php echo $css_class; ?>"<?php if ( $images_uniqid ) { echo ' id="' . $images_uniqid . '"'; } ?> data-gallery="<?php echo $gallery_uniqid; ?>">

	<?php $loop = 0; ?>
	<?php foreach ( $gallery as $image ) : ?>
	<div class="vc_col-md-<?php echo $columns; ?> gallery-image" data-gallery-item="<?php echo $loop; ?>">
		<div class="wrap">
			<img class="gimg" src="<?php echo $image['full']; ?>" alt="">
			<div class="overlay">
				<div class="icon-shape">
					<img src="<?php echo get_template_directory_uri(); ?>/images/arr-out.svg" alt="">
				</div>
			</div>
			<div class="gallery-description">
				<p class="subtitle small">
					<?php echo $image['caption']; ?>
				</p>
				<h3 class="title"><?php echo $image['title']; ?></h3>
			</div>
		</div>
	</div>
	<?php $loop++; ?>
	<?php endforeach; ?>
	<div class="clear"></div>

</div>

<div class="gallery-custom<?php if ( $gallery_style == 'light' ) { echo ' gallery-light'; } echo $css_class; ?>" id="<?php echo $gallery_uniqid; ?>">
	<div class="close">
		<span class="ion-ios-close-empty"></span>
	</div>
</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $overlay_css ) {
			$_style_block .= '#' . $gallery_uniqid . '{';
			$_style_block .= $overlay_css;
			$_style_block .= '}';
		}
		if ( $images_css ) {
			$_style_block .= '#' . $images_uniqid . ' .gallery-image{';
			$_style_block .= $images_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>