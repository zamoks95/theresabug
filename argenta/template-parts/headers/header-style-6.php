<?php
	// Settings
	$subheader_have_social = have_rows( 'global_header_menu_contacts_bar_social_links', 'option' );
?>

<header id="masthead" class="site-header dark-text header-6">
	<div class="header-wrap">
		<?php get_template_part( 'template-parts/elements/header-menu-logo' ); ?>
		<?php get_template_part( 'template-parts/elements/header-menu-optional-nav' ); ?>
		<?php get_template_part( 'template-parts/elements/header-menu-nav' ); ?>	
		<?php get_template_part( 'template-parts/elements/header-menu-hamburger' ); ?>
		<div class="close-menu"></div>
	</div><!-- .header-wrap -->

	<div class="header-bottom">
		<?php if ( $subheader_have_social ) : ?>
		<div class="socialbar">
			<?php while( have_rows( 'global_header_menu_contacts_bar_social_links', 'option' ) ): the_row(); ?>
				<a href="<?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="social flat rounded">
				<?php switch ( get_sub_field( 'social_network' ) ) {
					case 'facebook':
						echo '<span class="ion-social-facebook"></span>';
						break;
					case 'twitter':
						echo '<span class="ion-social-twitter"></span>';
						break;
					case 'googleplus':
						echo '<span class="ion-social-googleplus-outline"></span>';
						break;
					case 'instagram':
						echo '<span class="ion-social-instagram-outline"></span>';
						break;
					case 'dribbble':
						echo '<span class="ion-social-dribbble-outline"></span>';
						break;
					case 'github':
						echo '<span class="ion-social-github"></span>';
						break;
					case 'linkedin':
						echo '<span class="ion-social-linkedin"></span>';
						break;
					case 'vimeo':
						echo '<span class="ion-social-vimeo"></span>';
						break;
					case 'youtube':
						echo '<span class="ion-social-youtube"></span>';
						break;
				} ?>
				</a>
			<?php endwhile; ?>
		</div>
		<?php endif; ?>
		<p class="copyright">
			<?php echo get_field( 'global_footer_copyright_text', 'option' ); ?>
		</p>
	</div>
</header><!-- #masthead -->