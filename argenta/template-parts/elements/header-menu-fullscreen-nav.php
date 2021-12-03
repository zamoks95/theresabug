<?php
	$logo = \Argenta\Settings::get_logo( true );
	$logo_as_image = is_array( $logo );
?>

<div class="fullscreen-navigation" id="fullscreen-mega-menu">
	<div class="site-branding">
		<p class="site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php if ( $logo_as_image ) : ?>
				<?php if ( $logo['default'] || $logo['retina'] ) : ?>
					<span class="first-logo">
						<img src="<?php echo esc_url( ( $logo['default'] ) ? $logo['default'] : $logo['retina'] ); ?>" <?php if ( $logo['have_vector'] ) { echo ' class="svg-logo"'; } ?><?php if ( $logo['retina'] ) { echo ' srcset="' . $logo['retina'] . ' 2x"'; } ?> alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					</span>
				<?php endif; ?>
			<?php else : ?>
				<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
			<?php endif; ?>
			</a>
		</p>
	</div>
	<div class="fullscreen-menu-wrap">
		<div id="fullscreen-mega-menu-wrap">
			<?php 
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'secondary-menu' ) );
				} else {
					echo '<span class="menu-not-assigned">' . sprintf( esc_html__( 'Please %s assign a menu %s to the primary menu location', 'argenta' ), '<a href="' . esc_url( home_url( '/' ) ) . 'wp-admin/nav-menus.php">', '</a>' ) . '</span>';
				}
			?>
		</div>
	</div>
	<div class="copyright">
		<?php echo wp_kses( get_field( 'global_footer_copyright_text', 'option' ), 'post' ); ?>
	</div>
	<div class="close" id="fullscreen-menu-close">
		<span class="ion-ios-close-empty"></span>
	</div>
</div>