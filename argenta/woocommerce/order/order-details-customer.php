<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="woocommerce-customer-details">

	<table class="shop_table customer_details">
		<?php if ( $order->get_customer_note() ) : ?>
			<tr>
				<th><?php esc_html_e( 'Note:', 'argenta' ); ?></th>
				<td><?php echo wptexturize( $order->get_customer_note() ); ?></td>
			</tr>
		<?php endif; ?>

		<?php if ( $order->get_billing_email() ) : ?>
			<tr>
				<th><?php esc_html_e( 'Email:', 'argenta' ); ?></th>
				<td><?php echo esc_attr( $order->get_billing_email() ); ?></td>
			</tr>
		<?php endif; ?>

		<?php if ( $order->get_billing_phone() ) : ?>
			<tr>
				<th><?php esc_html_e( 'Telephone:', 'argenta' ); ?></th>
				<td><?php echo esc_attr( $order->get_billing_phone() ); ?></td>
			</tr>
		<?php endif; ?>

		<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>
	</table>

	<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>

	<div class="col2-set addresses">

	<?php endif; ?>

		<div class="vc_col-md-6 u-column woocommerce-Address">
			<header class="woocommerce-Address-title title">
				<h3 class="second-title"><?php esc_html_e( 'Billing Address', 'argenta' ); ?></h3>
			</header>
			<address>
				<?php echo esc_html( $address = $order->get_formatted_billing_address() ) ? $address : esc_html__( 'N/A', 'argenta' ); ?>
			</address>
		</div>

	<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>

		<div class="vc_col-md-6 u-column woocommerce-Address">
			<header class="woocommerce-Address-title title">
				<h3 class="second-title"><?php esc_html_e( 'Shipping Address', 'argenta' ); ?></h3>
			</header>
			<address>
				<?php echo esc_html( $address = $order->get_formatted_shipping_address() ) ? $address : esc_html__( 'N/A', 'argenta' ); ?>
			</address>
		</div>
	</div><!--.col2-set-->

	<?php endif; ?>
	
</section>