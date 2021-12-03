<?php
	// Settings
	$header_style = \Argenta\Settings::header_menu_style();

	$show_search = ! \Argenta\Settings::get( 'header_hide_search', 'global' );
	$aligment_class = '';
	if ( $header_style == 'style4' ) {
		$show_search = false;
		$aligment_class = ' right';
	}

	$have_woocomerce = function_exists( 'WC' );
	$have_woocomerce_wl = function_exists( 'YITH_WCWL' );
	$have_wpml = function_exists( 'icl_get_languages' );
	$wpml_show_in_header = \Argenta\Settings::wpml_menu_item_is_displayed();
?>

<?php if ( $show_search || ( $have_wpml && $wpml_show_in_header ) || $have_woocomerce || $have_woocomerce_wl ) : ?>

<ul class="menu-other<?php echo esc_attr( $aligment_class ); ?>">
	<?php if ( $show_search ) : ?>
	<li>
		<a class="search" data-nav-search="true">
			<span class="icon ion-ios-search"></span>
			<?php if ( $header_style == 'style6' ) { esc_html_e( 'Search', 'argenta' ); } ?>
		</a>
	</li>
	<?php endif; ?>

	<?php if ( $have_wpml && $wpml_show_in_header ) : ?>
	<li>
		<a class="language uppercase">
			<span class="icon ion-ios-world-outline"></span>
			<?php
				$selected_language = icl_get_languages( 'active=true' );
				echo ICL_LANGUAGE_CODE;
			?>
		</a>
		<div class="submenu no-paddings">
			<ul class="sub-nav languages">
				<?php
					$languages = icl_get_languages('orderby=name');
					foreach( $languages as $language ) {
						$class = ( $language['active'] ) ? ' class="active"' : '';
						printf( '<li%s><a href="%s"><img src="%s" alt="'.$post->post_title.'"> %s</a></li>', $class, $language['url'],
							$language['country_flag_url'], $language['native_name'] );
					} 
				?>
			</ul>
		</div>
	</li>
	<?php endif; ?>

	<?php if ( $have_woocomerce ) : ?>
	<li>
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart">
			<span class="icon ion-bag"></span>
			<?php if ( $header_style == 'style6' ) { esc_html_e( 'Cart', 'argenta' ); } ?>
			<span class="cart-count">(<?php echo WC()->cart->get_cart_contents_count(); ?>)</span>
		</a>
		<div class="submenu submenu_cart <?php if ( ! WC()->cart->is_empty() ) echo 'cart'; ?>">
			<div class="widget_shopping_cart_content">
				<?php woocommerce_mini_cart(); ?>
			</div>
		</div>
	</li>

	<?php if ( $have_woocomerce_wl ) : ?>
	<li>
		<a href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url( 'user' . '/' . get_current_user_id() ) ); ?>" class="wishlist">
			<span class="icon ion-android-favorite-outline"></span>
			<?php if ( $header_style == 'style6' ) { esc_html_e( 'Wishlist', 'argenta' ); } ?>
		</a>
	</li>
	<?php endif; ?>
	<?php endif; ?>

</ul>

<?php endif; ?>