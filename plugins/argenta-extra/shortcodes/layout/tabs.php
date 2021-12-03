<div class="tab-box<?php echo $tabs_class_postfix . $css_class; ?>"<?php if ( $with_styles ) { echo ' id="' . $tabs_uniqid . '"';  } ?> data-tab-box="true" <?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?> <?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>
	<div class="tab-box-buttons" data-tab-box-buttons="true" role="tablist">
		<?php /* Generated tabs here */ ?>
	</div>
	<div class="tab-box-content" data-tab-box-content="true" role="tabpanel">
		<?php echo do_shortcode( $content ); ?>	
	</div>
</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $tabs_css ) {
			$_style_block .= '#' . $tabs_uniqid . ' .tab-box-buttons .tab-box-btn{';
			$_style_block .= $tabs_css;
			$_style_block .= '}';
		}
		if ( $tabs_active_css ) {
			$_style_block .= '#' . $tabs_uniqid . ' .tab-box-buttons .tab-box-btn.tab-box-btn-active{';
			$_style_block .= $tabs_active_css;
			$_style_block .= '}';
		}
		if ( $tabs_content_css ) {
			$_style_block .= '#' . $tabs_uniqid . ' .tab-box-content{';
			$_style_block .= $tabs_content_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>