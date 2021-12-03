<?php if ( $layout == 'with_preview' ): ?>

<div class="video-module video-module-preview<?php echo $video_module_class . $css_class; ?>"<?php if ( $with_styles ) { echo ' id="' . $video_module_uniqid . '"';  } ?> data-video-module="<?php if( $link ) { echo $link; } ?>" <?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?> <?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>
	<div class="video-module-video">
		<div class="video-module-image-preview">
		<?php if ( $preview_image ): ?>
			<img src="<?php echo $preview_image; ?>" alt="">
		<?php endif; ?>
		</div>
	</div>
	<div class="btn-play<?php if ( $button_layout == 'outline' ) echo '-outline'; ?>">
		<span class="icon ion-ios-play"></span>
	</div>
</div>

<?php else: ?>

<div class="video-module<?php echo $video_module_class . $css_class; ?>"<?php if ( $with_styles ) { echo ' id="' . $video_module_uniqid . '"';  } ?> <?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?> <?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>
	<div class="btn-play" data-video-module="<?php if( $link ) { echo $link; } ?>" data-video-module-open="<?php echo $video_module_uniqid; ?>">
		<span class="icon ion-ios-play"></span>
	</div>
	<div class="content-center">
		<div class="wrap">
			<?php if ( $title ): ?>
			<h3 class="title text-left"><?php echo $title; ?></h3>
			<?php endif; ?>
			<?php if ( $subtitle ): ?>
			<p class="subtitle small text-left"><?php echo $subtitle; ?></p>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php endif; ?>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $background_css ) {
			$_style_block .= '#' . $video_module_uniqid . '.video-module{';
			$_style_block .= $background_css;
			$_style_block .= '}';
		}
		if ( $button_css ) {
			$_style_block .= '#' . $video_module_uniqid . '.video-module .btn-play{';
			$_style_block .= $button_css;
			$_style_block .= '}';
		}
		if ( $button_outline_css ) {
			$_style_block .= '#' . $video_module_uniqid . '.video-module .btn-play-outline{';
			$_style_block .= $button_outline_css;
			$_style_block .= '}';
		}
		if ( $icon_css ) {
			$_style_block .= '#' . $video_module_uniqid . '.video-module .btn-play{';
			$_style_block .= $icon_css;
			$_style_block .= '}';
		}
		if ( $title_css ) {
			$_style_block .= '#' . $video_module_uniqid . '.video-module h3.title{';
			$_style_block .= $title_css;
			$_style_block .= '}';
		}
		if ( $subtitle_css ) {
			$_style_block .= '#' . $video_module_uniqid . '.video-module p.subtitle{';
			$_style_block .= $subtitle_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>