<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>


<div style="max-width: 1350px; margin: 30px auto;">

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_cart_is_empty' ); ?>

<?php if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
	<div class="page-error woocommerce-shop">
		<div class="icon-shape">
			<i class="ion-bag"></i>
		</div>
		<div class="page-error-content">
			<h2 class="text-left"><?php esc_html_e( 'Oops', 'argenta' ); ?></h2>
			<h3 class="text-left"><?php esc_html_e( 'Your cart is empty', 'argenta' ); ?></h3>
			<p class="subtitle"><?php esc_html_e( 'You may check out all the available products and buy some in the shop.', 'argenta' ); ?></p>
			<a class="btn btn-outline" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
				<?php esc_html_e( 'Return To Shop', 'argenta' ) ?>
			</a>
		</div>
	</div>
<?php endif; ?>

</div>