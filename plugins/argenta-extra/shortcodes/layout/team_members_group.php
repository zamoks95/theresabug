<div class="team-member-cover-list <?php echo 'column-' . preg_match_all('/argenta_sc_team_member_inner/i', $content, $matches); ?><?php echo $css_class; ?>" <?php if ( $with_styles ) { echo ' id="' . $team_group_uniqid . '"'; } ?> data-cover-box="true" <?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?> <?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>
	<?php echo do_shortcode( $content ); ?>
</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $content_bg_css ) {
			$_style_block = '#' . $team_group_uniqid . ' .team-member-content{';
			$_style_block .= $content_bg_css;
			$_style_block .= '}';
		}
		
		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>