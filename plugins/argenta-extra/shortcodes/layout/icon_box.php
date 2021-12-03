<div<?php if ( $with_styles ) { echo ' id="' . $icon_box_uniqid . '"'; } ?> class="<?php echo $icon_box_class_main . $css_class; ?>" <?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?> <?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>

	<div class="icon-box-image brand-color brand-border-color<?php echo $icon_box_class_icon; ?>">
		<?php if ( $icon_type == 'font_icon' && $icon_as_icon ) : ?>
		<span class="<?php echo $icon_as_icon; ?> brand-color"></span>
		<?php elseif ( $icon_as_image ) : ?>
		<img src="<?php echo $icon_as_image; ?>" alt="<?php echo esc_attr( $title ); ?>">
		<?php endif; ?>
	</div>

	<div class="icon-box-wrap-content">
		<h3 class="title icon-box-title"><?php echo $title; ?></h3>
		<?php if ( $subtitle ) : ?>
			<p class="subtitle icon-box-subtitle"><?php echo $subtitle; ?></p>
		<?php endif; ?>

		<?php if ( $box_type_layout == 'top_icon' && !$hide_divider ) : ?>
		<div class="divider-dashed">
			<div class="divider-line brand-bg-color"></div>
			<div class="divider-line brand-bg-color"></div>
		</div>
		<?php endif; ?>
		
		<?php if ( $content_full ) : ?>
			</div>
		<?php endif; ?>
			<p class="icon-box-description<?php if ( $content_full ) { echo ' content-full'; } ?>"><?php echo $description; ?></p>

		<?php if ( $use_link && $button_settings['type'] != 'arrow_link' ) : ?>
		<a class="btn btn-outline uppercase brand-color brand-border-color<?php if ( isset( $button_css['classes'] ) ) { echo $button_css['classes']; } ?>" href="<?php echo $link_url['url']; ?>"<?php if ( $link_url['blank'] ) { echo ' target="_blank"'; } ?>>
			<?php echo $link_url['caption']; ?>
		</a>
		<?php elseif ( $use_link && $button_settings['type'] == 'arrow_link' ) : ?>
		<a class="icon-box-link brand-color brand-border-color" href="<?php echo $link_url['url']; ?>"<?php if ( $link_url['blank'] ) { echo ' target="_blank"'; } ?>>
			<?php echo $link_url['caption']; ?>
			<span class="icon-arrow ion-ios-arrow-thin-right"></span>
		</a>
		<?php endif; ?>
	<?php if ( ! $content_full ) : ?>
		</div>
	<?php endif; ?>
	
</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $icon_fill_css || $icon_border_css ) {
			$_style_block .= '#' . $icon_box_uniqid . ' .icon-box-image{';
			$_style_block .= $icon_fill_css;
			$_style_block .= $icon_border_css;
			$_style_block .= '}';
		}
		if ( $title_css ) {
			$_style_block .= '#' . $icon_box_uniqid . ' .icon-box-title{';
			$_style_block .= $title_css;
			$_style_block .= '}';
		}
		if ( $subtitle_css ) {
			$_style_block .= '#' . $icon_box_uniqid . ' .icon-box-subtitle{';
			$_style_block .= $subtitle_css;
			$_style_block .= '}';
		}
		if ( $description_css ) {
			$_style_block .= '#' . $icon_box_uniqid . ' .icon-box-description{';
			$_style_block .= $description_css;
			$_style_block .= '}';
		}
		if ( $icon_color_css ) {
			$_style_block .= '#' . $icon_box_uniqid . ' .icon-box-image span{';
			$_style_block .= $icon_color_css;
			$_style_block .= '}';
		}
		if ( $divider_color_css ) {
			$_style_block .= '#' . $icon_box_uniqid . ' .divider-dashed .divider-line.brand-bg-color{';
			$_style_block .= $divider_color_css;
			$_style_block .= '}';
		}
		if ( isset( $button_css['css'] ) && $button_css['css'] ) {
			$_style_block .= '#' . $icon_box_uniqid . ' .icon-box-link,';
			$_style_block .= '#' . $icon_box_uniqid . ' .icon-box-link .icon-arrow,';
			$_style_block .= '#' . $icon_box_uniqid . ' .btn{';
			$_style_block .= $button_css['css'];
			$_style_block .= '}';
		}
		if ( isset( $button_css['hover-css'] ) && $button_css['hover-css'] ) {
			$_style_block .= '#' . $icon_box_uniqid . ' .btn:hover{';
			$_style_block .= $button_css['hover-css'];
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>