<div class="wrap-image column" data-cover-box-image="true">
	<?php if ( $background_image ) : ?>
	<img src="<?php echo $background_image; ?>" alt="<?php echo esc_attr( $title ); ?>">
	<?php endif; ?>
</div>

<div<?php if ( $with_styles ) { echo ' id="' . $banner_box_uniqid . '"'; } ?> class="column box-content" data-cover-box-content="true">
	<div class="content-wrap">	
		<?php if ( $subtitle && $block_type_subtitle == 'before' ) : ?>
			<p class="subtitle top"><?php echo $subtitle; ?></p>
		<?php endif; ?>
		<h3 class="title"><?php echo $title; ?></h3>
		<?php if ( $subtitle && $block_type_subtitle == 'after' ) : ?>
			<p class="subtitle"><?php echo $subtitle; ?></p>
		<?php endif; ?>
		<p class="description"><?php echo $description; ?></p>
		<?php if ( $use_link ) : ?>
			<?php if ( $button_settings['type'] != 'arrow_link' ) : ?>
			<a href="<?php echo $link_url['url']; ?>"<?php if ( $link_url['blank'] ) { echo ' target="_blank" '; } ?> class="btn box-btn<?php echo $button_css['classes']; ?> uppercase">
				<?php echo $link_url['caption']; ?>
			</a>
			<?php elseif ( $button_settings['type'] == 'arrow_link' ) : ?>
			<a href="<?php echo $link_url['url']; ?>"<?php if ( $link_url['blank'] ) { echo ' target="_blank" '; } ?> class="btn btn-link uppercase">
				<?php echo $link_url['caption']; ?>
				<span class="icon-arrow ion-ios-arrow-thin-right"></span>
			</a>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $title_css ) {
			$_style_block = '#' . $banner_box_uniqid . ' h3.title{';
			$_style_block .= $title_css;
			$_style_block .= '}';
		}
		if ( $subtitle_css ) {
			$_style_block = '#' . $banner_box_uniqid . ' p.subtitle{';
			$_style_block .= $subtitle_css;
			$_style_block .= '}';
		}
		if ( $description_css ) {
			$_style_block = '#' . $banner_box_uniqid . ' p.description{';
			$_style_block .= $description_css;
			$_style_block .= '}';
		}
		if ( isset( $button_css['css'] ) && $button_css['css'] ) {
			$_style_block = '#' . $banner_box_uniqid . ' .btn-link,';
			$_style_block .= '#' . $banner_box_uniqid . ' .btn{';
			$_style_block .= $button_css['css'];
			$_style_block .= '}';
		}
		if ( isset( $button_css['hover-css'] ) && $button_css['hover-css'] ) {
			$_style_block = '#' . $banner_box_uniqid . ' .btn:hover{';
			$_style_block .= $button_css['hover-css'];
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>