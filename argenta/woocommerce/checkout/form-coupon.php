<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! wc_coupons_enabled() ) {
	return;
}
?>


<?php
	if ( empty( WC()->cart->applied_coupons ) ) {
		$info_message = apply_filters( 'woocommerce_checkout_coupon_message', esc_html__( 'Have a coupon?', 'argenta' ) . ' <a href="#" class="showcoupon">' . esc_html__( 'Click here to enter your code', 'argenta' ) . '</a>' );
		wc_print_notice( $info_message, 'notice' );
	}
?>

<form class="checkout_coupon" method="post" style="display:none;">
	<input type="text" name="coupon_code" class="input-text classic left" placeholder="<?php esc_attr_e( 'Coupon code', 'argenta' ); ?>" id="coupon_code" value="" />
	<input type="submit" class="btn left" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'argenta' ); ?>" />
	<div class="clear"></div>
</form>