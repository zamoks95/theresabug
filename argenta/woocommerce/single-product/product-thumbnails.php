<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_image_ids();

if ( $attachment_ids ) {
	$loop 		= 0;
	$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
	$main_image_props = wc_get_product_attachment_props( $product->get_image_id(), $post );
	?>
	<div class="thumbnails <?php echo 'columns-' . $columns; ?>" id="product-thumbnails">
	<?php

		echo apply_filters(
				'woocommerce_single_product_image_thumbnail_html',
				sprintf(
					'<div class="image selected"><img src="%s" data-wc-toggle-image="0" alt="'.$post->post_title.'"></div>',
					//wp_get_attachment_image_url( $product->get_image_id(), array( 320 ) )
					wp_get_attachment_image_url( $product->get_image_id(), 'thumbnail' )
				),
				$product->get_image_id(),
				$post->ID,
				''
			);

		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array( 'zoom' );

			if ( $loop === 0 || $loop % $columns === 0 ) {
				$classes[] = 'first';
			}

			if ( ( $loop + 1 ) % $columns === 0 ) {
				$classes[] = 'last';
			}

			$image_class = implode( ' ', $classes );
			$props       = wc_get_product_attachment_props( $attachment_id, $post );

			if ( ! $props['url'] ) {
				continue;
			}

			echo apply_filters(
				'woocommerce_single_product_image_thumbnail_html',
				sprintf(
					'<div class="image"><img src="%s" data-wc-toggle-image="%s" alt="'.$post->post_title.'"></div>',
					//wp_get_attachment_image_url( $attachment_id, array(320) ), $loop+1
					wp_get_attachment_image_url( $attachment_id, 'thumbnail' ), $loop+1
				),
				$attachment_id,
				$post->ID,
				esc_attr( $image_class )
			);

			$loop++;
		}

	?>
	</div>

	<?php
}
