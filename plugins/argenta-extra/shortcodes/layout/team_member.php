<div <?php if ( $with_styles ) { echo 'id="' . $team_member_uniqid . '" '; } ?>class="<?php echo $main_class . ' text-center' . $css_class; ?>" <?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?> <?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>

	<?php if ( $fill_bottom ) : ?>
	<div class="team-member-wrap-title">
	<?php endif; ?>

	<div class="team-member-image">
		<?php if ( $photo ) : ?>
		<img src="<?php echo $photo; ?>" alt="<?php echo esc_attr( $name ); ?>">
		<?php endif; ?>
		<?php if ( $block_type_layout == 'inner' ) : ?>
		<div class="team-member-content">
			<div class="inner">
				<div class="wrap-inner">
				<p><?php echo $description; ?></p>
				<div class="socialbar">
					<?php if ( $facebook_link ) : ?>
					<a href="<?php echo $facebook_link; ?>" class="social flat rounded"><span class="icon ion-social-facebook"></span></a>
					<?php endif; ?>
					<?php if ( $twitter_link ) : ?>
					<a href="<?php echo $twitter_link; ?>" class="social flat rounded"><span class="icon ion-social-twitter"></span></a>
					<?php endif; ?>
					<?php if ( $dribbble_link ) : ?>
					<a href="<?php echo $dribbble_link; ?>" class="social flat rounded"><span class="icon ion-social-dribbble-outline"></span></a>
					<?php endif; ?>
					<?php if ( $pinterest_link ) : ?>
					<a href="<?php echo $pinterest_link; ?>" class="social flat rounded"><span class="icon ion-social-pinterest-outline"></span></a>
					<?php endif; ?>
					<?php if ( $github_link ) : ?>
					<a href="<?php echo $github_link; ?>" class="social flat rounded"><span class="icon ion-social-github"></span></a>
					<?php endif; ?>
					<?php if ( $instagram_link ) : ?>
					<a href="<?php echo $instagram_link; ?>" class="social flat rounded"><span class="icon ion-social-instagram-outline"></span></a>
					<?php endif; ?>
					<?php if ( $linkedin_link ) : ?>
					<a href="<?php echo $linkedin_link; ?>" class="social flat rounded"><span class="icon ion-social-linkedin-outline"></span></a>
					<?php endif; ?>
				</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>

	<?php if ( $fill_bottom ) : ?>
		<div class="team-member-title">
	<?php endif; ?>
	<h3 class="title"><?php echo $name; ?></h3>
	<p class="subtitle small"><?php echo $position; ?></p>
	<?php if ( $fill_bottom ) : ?>
		</div>
	</div>
	<?php endif; ?>

	<?php if ( $block_type_layout == 'full' ) : ?>

	<p><?php echo $description; ?></p>
	<div class="socialbar">
		<?php if ( $facebook_link ) : ?>
		<a href="<?php echo $facebook_link; ?>" class="social flat rounded"><span class="icon ion-social-facebook"></span></a>
		<?php endif; ?>
		<?php if ( $twitter_link ) : ?>
		<a href="<?php echo $twitter_link; ?>" class="social flat rounded"><span class="icon ion-social-twitter"></span></a>
		<?php endif; ?>
		<?php if ( $dribbble_link ) : ?>
		<a href="<?php echo $dribbble_link; ?>" class="social flat rounded"><span class="icon ion-social-dribbble-outline"></span></a>
		<?php endif; ?>
		<?php if ( $pinterest_link ) : ?>
		<a href="<?php echo $pinterest_link; ?>" class="social flat rounded"><span class="icon ion-social-pinterest-outline"></span></a>
		<?php endif; ?>
		<?php if ( $github_link ) : ?>
		<a href="<?php echo $github_link; ?>" class="social flat rounded"><span class="icon ion-social-github"></span></a>
		<?php endif; ?>
		<?php if ( $instagram_link ) : ?>
		<a href="<?php echo $instagram_link; ?>" class="social flat rounded"><span class="icon ion-social-instagram-outline"></span></a>
		<?php endif; ?>
		<?php if ( $linkedin_link ) : ?>
		<a href="<?php echo $linkedin_link; ?>" class="social flat rounded"><span class="icon ion-social-linkedin-outline"></span></a>
		<?php endif; ?>
	</div>

	<?php endif; ?>
</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $name_css ) {
			$_style_block .= '#' . $team_member_uniqid . ' h3.title{';
			$_style_block .= $name_css;
			$_style_block .= '}';
		}
		if ( $position_css ) {
			$_style_block .= '#' . $team_member_uniqid . ' p.subtitle{';
			$_style_block .= $position_css;
			$_style_block .= '}';
		}
		if ( $description_css ) {
			$_style_block .= '#' . $team_member_uniqid . ' .team-member-content p,';
			$_style_block .= '#' . $team_member_uniqid . ' > p{';
			$_style_block .= $description_css;
			$_style_block .= '}';
		}
		if ( $bottom_color_css ) {
			$_style_block .= '#' . $team_member_uniqid . ' .team-member-title{';
			$_style_block .= $bottom_color_css;
			$_style_block .= '}';
		}
		if ( $social_css ) {
			$_style_block .= '#' . $team_member_uniqid . ' a.social{';
			$_style_block .= $social_css;
			$_style_block .= '}';
		}
		if ( $social_hover_css ) {
			$_style_block .= '#' . $team_member_uniqid . ' a.social:hover{';
			$_style_block .= $social_hover_css;
			$_style_block .= '}';
		}
		if ( $card_hover_css ) {
			$_style_block .= '#' . $team_member_uniqid . ' .team-member-content{';
			$_style_block .= $card_hover_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>