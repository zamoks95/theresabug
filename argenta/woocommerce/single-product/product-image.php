<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
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

global $post, $product;

$attachment_ids = $product->get_gallery_image_ids();
?>

<div class="vc_col-md-7">


	<div class="images<?php if ( !$attachment_ids ) { echo ' without-thumbs'; } ?>">

		<?php if ( $product->is_on_sale() ) : ?>

			<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale brand-bg-color">' . esc_html__( 'SALE', 'argenta' ) . '</span>', $post, $product ); ?>

		<?php endif; ?>
		<?php
			if ( has_post_thumbnail() ) {
				$attachment_count = count( $product->get_gallery_image_ids() );
				$gallery          = $attachment_count > 0 ? '[product-gallery]' : '';
				$props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
				$image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
					'title'	 => $props['title'],
					'alt'    => $props['alt'],
				) );
			?>
			<div class="slider woocommerce-product-gallery__wrapper" data-wc-slider="true" data-gallery="products-gallery">
			<?php
				$attachment_ids = $product->get_gallery_image_ids();
                $image_class = '';

				echo apply_filters(
						'woocommerce_single_product_image_thumbnail_html',
						sprintf(
							'<div class="gallery-image woocommerce-product-gallery__image" data-gallery-item="0"><img class="gimg wp-post-image" src="%s" alt="'.$post->post_title.'"></div>',
							wp_get_attachment_image_url( $product->get_image_id(), 'original' )
						),
						$product->get_image_id(),
						$post->ID,
                        esc_attr( $image_class )
					);

				$loop = 1;

				foreach ( $attachment_ids as $attachment_id ) {

					$classes = array( 'zoom' );

					$image_class = implode( ' ', $classes );
					$props       = wc_get_product_attachment_props( $attachment_id, $post );

					if ( ! $props['url'] ) {
						continue;
					}

					echo apply_filters(
						'woocommerce_single_product_image_thumbnail_html',
						sprintf(
							'<div class="gallery-image" data-gallery-item="%s"><img class="gimg" src="%s" alt="'.$post->post_title.'"></div>',
							$loop, esc_url( wp_get_attachment_image_url( $attachment_id, 'original' ) )
						),
						$attachment_id,
						$post->ID,
						esc_attr( $image_class )
					);

					$loop++;
				}
			?>
			</div>
			<div class="gallery-custom gallery-light" id="products-gallery">
				<div class="close">
					<span class="ion-ios-close-empty"></span>
				</div>
			</div>
			<?php
			} else {
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'argenta' ) ), $post->ID );
			}

			do_action( 'woocommerce_product_thumbnails' );
		?>
	</div>
</div>
