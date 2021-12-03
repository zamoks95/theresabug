<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="woo-quantity">
	<div class="plus">+</div>
	<div class="minus">-</div>
	<?php 
		$min = ' ';
		$max = ' ';
		if ( $min_value ) {
			$min = 'min="' . esc_attr( $min_value ) . '" ';
		}
		if ( $max_value ) {
			$max = 'min="' . esc_attr( $max_value ) . '" ';
		}
	?>
	<input
		type="number"
		id="<?php echo esc_attr( $input_id ); ?>"
		class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?>"
		step="<?php echo esc_attr( $step ); ?>"
		min="<?php echo esc_attr( $min_value ); ?>"
		max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
		name="<?php echo esc_attr( $input_name ); ?>"
		value="<?php echo esc_attr( $input_value ); ?>"
		title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'argenta' ); ?>"
		size="4"
		placeholder="<?php echo esc_attr( $placeholder ); ?>"
		inputmode="<?php echo esc_attr( $inputmode ); ?>" />
</div>
