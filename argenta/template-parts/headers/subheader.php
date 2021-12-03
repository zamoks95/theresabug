<?php
	// Settings
	$show_subheader = \Argenta\Settings::subheader_is_displayed();
	$use_wrapper = \Argenta\Settings::header_use_wrapper();
	$is_fixed = \Argenta\Settings::header_is_fixed();

	$header_menu_style = \Argenta\Settings::header_menu_style();
	if ( $header_menu_style == 'style3' ) $use_wrapper = true;
	if ( $header_menu_style == 'style6' ) $use_wrapper = false;

	$subheader_have_nums = have_rows( 'global_header_menu_contacts_bar_phone_numbers', 'option' );
	$subheader_have_emails = have_rows( 'global_header_menu_contacts_bar_emails', 'option' );
	$subheader_additional = get_field( 'global_header_menu_contacts_bar_additional', 'option' );
	$subheader_have_social = have_rows( 'global_header_menu_contacts_bar_social_links', 'option' );
	$subheader_first_num = true;
	$subheader_first_email = true;
?>

<?php if ( $show_subheader ) : ?>

<div class="subheader<?php if ( $is_fixed ) { echo ' fixed'; } ?>">
	<div class="content">

		<?php if ( $use_wrapper ) : ?>
		<div class="wrapped-container">
		<?php endif; ?>

		<?php if ( $subheader_have_nums || $subheader_have_emails || $subheader_additional ) : ?>
		<ul class="subheader-contacts unstyled">
			<?php if ( $subheader_have_nums ) : ?>
			<li>
				<span class="icon icon-phone ion-iphone"></span>
			<?php while( have_rows( 'global_header_menu_contacts_bar_phone_numbers', 'option' ) ): the_row(); ?>
				<?php if ( ! $subheader_first_num ) { echo ' ,'; } ?>
				<a href="tel:<?php echo esc_attr( str_replace( ' ', '', get_sub_field( 'phone_numbers' ) ) ); ?>"><?php echo get_sub_field( 'phone_numbers' ); ?></a>
				<?php $subheader_first_num = false; ?>
			<?php endwhile; ?>
			</li>
			<?php endif; ?>

			<?php if ( $subheader_have_emails ) : ?>
			<li>
				<span class="icon icon-email ion-ios-email-outline"></span>
			<?php while( have_rows( 'global_header_menu_contacts_bar_emails', 'option' ) ): the_row(); ?>
				<?php if ( ! $subheader_first_email ) { echo ' ,'; } ?>
				<a href="mailto:<?php echo esc_attr( get_sub_field( 'emails' ) ); ?>"><?php echo esc_html( get_sub_field( 'emails' ) ); ?></a>
				<?php $subheader_first_email = false; ?>
			<?php endwhile; ?>
			</li>
			<?php endif; ?>

			<?php if ( $subheader_additional ) : ?>
			<li>
				<span class="icon icon-time ion-ios-clock-outline"></span>
				<?php echo wp_kses($subheader_additional, 'default' ); ?>
			</li>
			<?php endif; ?>
		</ul>
		<?php endif; ?>

		<?php if ( $subheader_have_social ) : ?>
		<ul class="social-bar unstyled inline">
			<?php while( have_rows( 'global_header_menu_contacts_bar_social_links', 'option' ) ): the_row(); ?>
				<li>
				<?php switch ( get_sub_field( 'social_network' ) ) {
					case 'facebook':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="facebook"><span class="ion-social-facebook"></span></a>';
						break;
					case 'twitter':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="twitter"><span class="ion-social-twitter"></span></a>';
						break;
					case 'googleplus':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="googleplus"><span class="ion-social-googleplus-outline"></span></a>';
						break;
					case 'instagram':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="instagram"><span class="ion-social-instagram-outline"></span></a>';
						break;
					case 'dribbble':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="dribbble"><span class="ion-social-dribbble-outline"></span></a>';
						break;
					case 'github':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="github"><span class="ion-social-github"></span></a>';
						break;
					case 'linkedin':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="linkedin"><span class="ion-social-linkedin"></span></a>';
						break;
					case 'vimeo':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="vimeo"><span class="ion-social-vimeo"></span></a>';
						break;
					case 'youtube':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="youtube"><span class="ion-social-youtube"></span></a>';
						break;
				} ?>
				</li>
			<?php endwhile; ?>
		</ul>
		<?php endif; ?>

		<?php if ( $use_wrapper ) : ?>
		</div>
		<?php endif; ?>

	</div>
</div><!-- .subheader -->

<?php endif; ?>