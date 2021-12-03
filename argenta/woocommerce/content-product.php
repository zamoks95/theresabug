<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$use_masonry_grid = (bool) ( \Argenta\Settings::get( 'woocommerce_shop_layout', 'global' ) == 'masonry' );

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) return;

?>

<li <?php ( $use_masonry_grid ) ? post_class( array( 'masonry-block grid-item blog-post-masonry' ) ) : post_class(); ?> data-product-item="true">
	<div class="product-content">
		<div class="image-wrap">
			<?php
			if ( shortcode_exists("yith_wcwl_add_to_wishlist") ) {
				echo do_shortcode("[yith_wcwl_add_to_wishlist]");
			}

			/**
			 * woocommerce_before_shop_loop_item hook.
			 *
			 * @hooked woocommerce_template_loop_product_link_open - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item' );
			
			/**
			 * woocommerce_before_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
			?>

			<div class="wc-gallery-images">
				<?php
					$attachment_ids = $product->get_gallery_image_ids();
					foreach ($attachment_ids as $attachment_id) {
						echo wp_get_attachment_image( $attachment_id, 'large' );	
					}
				?>
			</div>

			<?php
			/**
			 * woocommerce_after_shop_loop_item hook.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item' );

			?>
		</div>
		<div class="wc-product-title-wrap">
			<h3 class="title">
				<a href="<?php echo get_post_permalink(); ?>">
					<?php echo esc_attr( $product->get_title() ); ?>
				</a>
			</h3>
			<div class="price">
                <?php echo wp_kses($product->get_price_html(), 'post'); ?>
			</div>
			<?php
				$categories = explode(', ', wc_get_product_category_list( $product->get_id(), ', ', '', '' ) ); 
				if ( $categories ) :
					foreach ( $categories as $category ):
			 ?>
				<div class="category subtitle-font">
					<?php echo preg_replace('/(<a)(.+\/a>)/i', '${1} class="brand-border-color brand-color" ${2}', $category); ?>
				</div>
			<?php
					endforeach;
				endif; 
			?>
		</div>
	</div>
</li>