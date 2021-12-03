	<div class="banner-box cover vc_row <?php echo 'column-' . preg_match_all( '/argenta_sc_banner_box_inner/i', $content, $matches ) . $css_class; ?>" data-cover-box="true" <?php if ( $appearance_effect != 'none' ) { echo 'data-aos="' . $appearance_effect . '"'; } ?> <?php if ( $appearance_duration ) { echo 'data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>

		<?php echo do_shortcode( $content ); ?>
		
	</div>