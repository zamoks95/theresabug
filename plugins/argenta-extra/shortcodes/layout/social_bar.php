<div class="socialbar<?php echo $socialbar_class; ?><?php echo $css_class; ?>"<?php if ( $with_styles ) { echo ' id="' . $social_bar_uniqid . '"';  } ?> <?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?> <?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>

	<?php if ( $facebook_link ) : ?>
	<a href="<?php echo $facebook_link; ?>" target="_blank" class="social facebook<?php echo $link_class; ?>">
		<span class="social-icon ion-social-facebook"></span>
		<?php if ( $icon_layout == 'boxed_full') : ?>
		<span class="social-text"><?php _e( 'Facebook', 'argenta_extra' ); ?></span>
		<?php endif; ?>
	</a>
	<?php endif; ?>

	<?php if ( $twitter_link ) : ?>
	<a href="<?php echo $twitter_link; ?>" target="_blank" class="social twitter<?php echo $link_class; ?>">
		<span class="social-icon ion-social-twitter"></span>
		<?php if ( $icon_layout == 'boxed_full') : ?>
		<span class="social-text"><?php _e( 'Twitter', 'argenta_extra' ); ?></span>
		<?php endif; ?>
	</a>
	<?php endif; ?>

	<?php if ( $googleplus_link ) : ?>
	<a href="<?php echo $googleplus_link; ?>" target="_blank" class="social googleplus<?php echo $link_class; ?>">
		<span class="social-icon ion-social-googleplus-outline"></span>
		<?php if ( $icon_layout == 'boxed_full') : ?>
		<span class="social-text"><?php _e( 'Google+', 'argenta_extra' ); ?></span>
		<?php endif; ?>
	</a>
	<?php endif; ?>

	<?php if ( $instagram_link ) : ?>
	<a href="<?php echo $instagram_link; ?>" class="social instagram<?php echo $link_class; ?>">
		<span class="social-icon ion-social-instagram-outline"></span>
		<?php if ( $icon_layout == 'boxed_full') : ?>
		<span class="social-text"><?php _e( 'Instagram', 'argenta_extra' ); ?></span>
		<?php endif; ?>
	</a>
	<?php endif; ?>

	<?php if ( $dribbble_link ) : ?>
	<a href="<?php echo $dribbble_link; ?>" class="social dribbble<?php echo $link_class; ?>">
		<span class="social-icon ion-social-dribbble-outline"></span>
		<?php if ( $icon_layout == 'boxed_full') : ?>
		<span class="social-text"><?php _e( 'Dribbble', 'argenta_extra' ); ?></span>
		<?php endif; ?>
	</a>
	<?php endif; ?>

	<?php if ( $linkedin_link ) : ?>
	<a href="<?php echo $linkedin_link; ?>" target="_blank" class="social linkedin<?php echo $link_class; ?>">
		<span class="social-icon ion-social-linkedin-outline"></span>
		<?php if ( $icon_layout == 'boxed_full') : ?>
		<span class="social-text"><?php _e( 'LinkedIn', 'argenta_extra' ); ?></span>
		<?php endif; ?>
	</a>
	<?php endif; ?>

	<?php if ( $pinterest_link ) : ?>
	<a href="<?php echo $pinterest_link; ?>" target="_blank" class="social pinterest<?php echo $link_class; ?>">
		<span class="social-icon ion-social-pinterest-outline"></span>
		<?php if ( $icon_layout == 'boxed_full') : ?>
		<span class="social-text"><?php _e( 'Pinterest', 'argenta_extra' ); ?></span>
		<?php endif; ?>
	</a>
	<?php endif; ?>

	<?php if ( $github_link ) : ?>
	<a href="<?php echo $github_link; ?>" class="social github<?php echo $link_class; ?>">
		<span class="social-icon ion-social-github"></span>
		<?php if ( $icon_layout == 'boxed_full') : ?>
		<span class="social-text"><?php _e( 'GitHub', 'argenta_extra' ); ?></span>
		<?php endif; ?>
	</a>
	<?php endif; ?>

</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $social_css ) {
			$_style_block .= '#' . $social_bar_uniqid . '.socialbar a.social{';
			$_style_block .= $social_css;
			$_style_block .= '}';
		}
		if ( $social_css_after ) {
			$_style_block .= '#' . $social_bar_uniqid . '.socialbar a.social:after{';
			$_style_block .= $social_css_after;
			$_style_block .= '}';
		}
		if ( $social_css_hover ) {
			$_style_block .= '#' . $social_bar_uniqid . '.socialbar a.social:hover{';
			$_style_block .= $social_css_hover;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>