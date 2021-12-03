<?php
/**
 * The template for displaying product widget entries
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
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
 * @version 3.5.5
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$allowed_html = array(
    'img' => array(
        'class' => true,
        'src' => true,
        'alt'=> true
    ),
    'span' =>array(
        'class' => true
    ),
    'del' => true,
    'old' => true,
    'ins' => true
);

?>


<li>
	<a href="<?php echo esc_url( $product->get_permalink() ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
		<div class="image-wrap"><?php echo wp_kses( $product->get_image(), $allowed_html);?></div>
		<span class="product-title"><?php echo wp_kses( $product->get_title(), 'default' ); ?></span>
	</a>
	<?php if ( ! empty( $show_rating ) ) : ?>
		<?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
	<?php else: ?>
		<div class="category subtitle-font brand-border-color brand-color">
			<?php echo wc_get_product_category_list( $product->get_id(), ', '); ?>
		</div>
	<?php endif; ?>
    <?php echo wp_kses($product->get_price_html(), 'post'); ?>
</li>
