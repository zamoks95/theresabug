<div class="team-member-image" data-cover-box-image="true">
	<div class="vc_row">
		<?php if ( $photo ) : ?>
		<img src="<?php echo $photo; ?>" alt="<?php echo esc_attr( $name ); ?>">
		<?php endif; ?>
	</div>
</div>

<div <?php if ( $with_styles ) { echo 'id="' . $team_member_uniqid . '" '; } ?>class="team-member-content<?php echo $css_class; ?>" data-cover-box-content="true">
	<div class="inner">
		<div class="content-wrap">
			<h3 class="title"><?php echo $name; ?></h3>
			<p class="subtitle small"><?php echo $position; ?></p>
			<p class="desc"><?php echo $description; ?></p>

			<?php if ( $social_bar ) : ?>
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
	</div>
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
			$_style_block .= '#' . $team_member_uniqid . ' p.desc{';
			$_style_block .= $description_css;
			$_style_block .= '}';
		}
		if ( $social_css ) {
			$_style_block .= '#' . $team_member_uniqid . ' a.social{';
			$_style_block .= $social_css;
			$_style_block .= '}';
		}
		if ( $social_hover_css ) {
			echo '#' . $team_member_uniqid . ' a.social:hover { ' . $social_hover_css . ' } ';
			$_style_block .= '#' . $team_group_uniqid . ' a.social:hover{';
			$_style_block .= $social_hover_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>