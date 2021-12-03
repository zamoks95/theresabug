<div<?php if ( $with_styles ) { echo ' id="' . $banner_box_uniqid . '"'; } ?> class="banner-box-wrapper <?php echo $banner_box_class . $css_class; ?>" <?php if ( $appearance_effect != 'none' ) { echo 'data-aos="' . $appearance_effect . '"'; } ?> <?php if ( $appearance_duration ) { echo 'data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>
	
	<div class="wrap-image">
		<img src="<?php echo $background_image; ?>" alt="<?php echo argenta_extra_filter_string( $title, 'attr', '' ); ?>">
	</div>

	<?php if ( $block_type_layout == 'inner' ) : ?>

		<div class="box-content<?php if ( ! $subtitle ) echo ' without-subtitle'; ?>">
			<div class="box-title">
				<?php if ( $subtitle && $block_type_subtitle == 'before' ) : ?>
				<p class="subtitle top"><?php echo $subtitle; ?></p>
				<?php endif; ?>
				<h3 class="title"><?php echo $title; ?></h3>
				<?php if ( $subtitle && $block_type_subtitle == 'after' ) : ?>
				<p class="subtitle"><?php echo $subtitle; ?></p>
				<?php endif; ?>
			</div>

			<div class="wrap-content">
				<p class="description"><?php echo $description; ?></p>
			</div>

			<?php if ( $use_link ) : ?>
			<div class="wrap-btn">
				<?php if ( !isset( $button_settings['type'] ) || $button_settings['type'] != 'arrow_link' ) : ?>
				<a href="<?php echo $link_url['url']; ?>"<?php if ( $link_url['blank'] ) { echo ' target="_blank" '; } ?> class="btn box-btn<?php echo $button_css['classes']; ?> uppercase">
					<?php echo $link_url['caption']; ?>
				</a>
				<?php elseif ( $button_settings['type'] == 'arrow_link' ) : ?>
				<a href="<?php echo $link_url['url']; ?>"<?php if ( $link_url['blank'] ) { echo ' target="_blank" '; } ?> class="btn btn-link uppercase">
					<?php echo $link_url['caption']; ?> <span class="icon-arrow ion-ios-arrow-thin-right"></span>
				</a>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</div>

	<?php elseif ( $block_type_layout = 'full' ) : ?>

		<h3 class="title"><?php echo $title; ?></h3>

		<?php if ( $subtitle ) : ?>
		<p class="subtitle<?php if ( $block_type_subtitle == 'before' ) { echo ' top'; } ?>">
			<?php echo $subtitle; ?>
		</p>
		<?php endif; ?>

		<p class="description">
			<?php echo $description; ?>
		</p>

		<?php if ( $use_link ) : ?>
			<?php if ( !isset( $button_settings['type'] ) || $button_settings['type'] != 'arrow_link' ) : ?>
		<a href="<?php echo $link_url['url']; ?>"<?php if ( $link_url['blank'] ) { echo ' target="_blank" '; } ?> class="btn box-btn<?php echo $button_css['classes']; ?> uppercase">
			<?php echo $link_url['caption']; ?>
		</a>
			<?php elseif ( $button_settings['type'] == 'arrow_link' ) : ?>
		<a href="<?php echo $link_url['url']; ?>"<?php if ( $link_url['blank'] ) { echo ' target="_blank" '; } ?> class="btn btn-link uppercase">
			<?php echo $link_url['caption']; ?> <span class="icon-arrow ion-ios-arrow-thin-right"></span>
		</a>
			<?php endif; ?>
		<?php endif; ?>

	<?php endif; ?>
</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';
		
		if ( $title_css ) {
			$_style_block .= '#' . $banner_box_uniqid . ' h3.title{';
			$_style_block .= $title_css;
			$_style_block .= '}';
		}
		if ( $subtitle_css ) {
			$_style_block .= '#' . $banner_box_uniqid . ' p.subtitle{';
			$_style_block .= $subtitle_css;
			$_style_block .= '}';
		}
		if ( $description_css ) {
			$_style_block .= '#' . $banner_box_uniqid . ' p.description{';
			$_style_block .= $description_css;
			$_style_block .= '}';
		}
		if ( $overlay_css ) {
			$_style_block .= '#' . $banner_box_uniqid . ' .box-title,';
			$_style_block .= '#' . $banner_box_uniqid . ' .wrap-content{';
			$_style_block .= $overlay_css;
			$_style_block .= '}';
		}
		if ( isset( $button_css['css'] ) && $button_css['css'] ) {
			$_style_block .= '#' . $banner_box_uniqid . ' .btn-link,';
			$_style_block .= '#' . $banner_box_uniqid . ' .btn{';
			$_style_block .= $button_css['css'];
			$_style_block .= '}';
		}
		if ( isset( $button_css['hover-css'] ) && $button_css['hover-css'] ) {
			$_style_block .= '#' . $banner_box_uniqid . ' .btn:hover{';
			$_style_block .= $button_css['hover-css'];
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>