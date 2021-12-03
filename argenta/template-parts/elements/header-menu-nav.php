<?php
	// Settings
	$menu_type = \Argenta\Settings::menu_type();
	$have_woocomerce = function_exists( 'WC' );
	$have_woocomerce_wl = function_exists( 'YITH_WCWL' );
	$have_wpml = function_exists( 'icl_get_languages' );
	$wpml_show_in_header = get_field( 'global_wpml_show_in_header', 'option' );
	$wpml_show_in_header = ( $wpml_show_in_header === false ) ? false : true;
?>

<nav id="site-navigation" class="main-nav<?php if ( $menu_type != 'full' ) { echo ' hidden'; } ?>">
	<div id="mega-menu-wrap">
		<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) );
			} else {
				echo '<span class="menu-not-assigned">' . sprintf( esc_html__( 'Please %s assign a menu %s to the primary menu location', 'argenta' ), '<a href="' . esc_url( home_url( '/' ) ) . 'wp-admin/nav-menus.php">', '</a>' ) . '</span>';
			}
		?>
	</div>
	<div class="close">
		<span class="icon ion-ios-close-empty"></span>
	</div>

	<!-- Mobile elements -->
	<form class="form-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<span class="ion-ios-search"></span>
		<input type="text" placeholder="<?php esc_attr_e( 'Search', 'argenta' ); ?>" name="s">
	</form>

	<?php if ( $have_wpml && $wpml_show_in_header ) : ?>
	<li class="mega-menu-item has-submenu mobile-wpml-select">
		<a class="menu-link uppercase">
			<span class="icon ion-ios-world-outline"></span>
			<?php
				$selected_language = icl_get_languages( 'active=true' );
				if ( defined( ICL_LANGUAGE_NAME_EN ) ) {
					echo ICL_LANGUAGE_NAME_EN;
				}
			?>
		</a>
		<div class="sub-nav no-paddings">
			<ul class="sub-menu sub-nav-group">
				<?php
					$languages = icl_get_languages( 'orderby=name' );

					foreach( $languages as $language ) {
						$class = ( $language['active'] ) ? ' active' : '';

						printf( 
							'<li class="class="mega-menu-item%s"><a href="%s" class="menu-link"><img src="%s" alt="'.$post->post_title.'"> %s</a></li>',
							$class, 
							$language['url'],
							$language['country_flag_url'], 
							$language['native_name'] 
						);
					} 
				?>
			</ul>
		</div>
	</li>
	<?php endif; ?>
</nav>