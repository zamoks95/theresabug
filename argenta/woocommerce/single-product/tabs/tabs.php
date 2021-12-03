<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );














global $post;
global $product;

$_type = get_field( 'global_woocommerce_product_description_layout', 'options' );
if ( ! $_type ) { $_type = 'default'; }

$type = $_type; // <= ['default', 'tabs_details', 'extended_details']
	
if ( $type == 'default' ) : ?>

	<?php if ( ! empty( $product_tabs ) ) : ?>
		<div class="accordion-box outline" data-accordion="true">
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
				<div data-accordion-item="true">
					<div class="buttons" <?php if($product_tab['callback'] == 'comments_template'){ echo "id=accordion-reviews"; } ?>>
						<h5 class="title left uppercase">
							<?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ); ?>
						</h5>
						<div class="control">
							<span class="ion-plus"></span>
						</div>
						<div class="clear"></div>
					</div>
					<div class="content">
						<div class="wrap">
							<?php call_user_func( $product_tab['callback'], $key, $product_tab ); ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

<?php endif; ?>

</div><!-- .vc_col-md-5 -->

<div class="vc_row-fluid" data-argenta-stretch-content="true">
	<div class="woocommerce-share<?php if ( $type == 'extended_details' ) { echo ' share-extended-details'; } ?>">
		<div class="wrap">
			<b><?php esc_html_e( 'SHARE THIS PRODUCT', 'argenta' ); ?>: </b>
			<div class="socialbar">
				<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( get_post_permalink($post) ); ?>" target="_blank" class="social rounded outline">
					<span class="ion-social-facebook"></span>
				</a>
				<a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( $post->post_title ); ?>,+<?php echo rawurlencode( get_post_permalink($post) ); ?>" target="_blank" class="social rounded outline twitter">
					<span class="ion-social-twitter"></span>
				</a>
				<a href="https://plus.google.com/share?url=<?php echo rawurlencode( get_post_permalink($post) ); ?>" target="_blank" class="social rounded outline">
					<span class="ion-social-googleplus-outline"></span>
				</a>
				<a href="http://pinterest.com/pin/create/button/?url=<?php echo rawurlencode( get_post_permalink($post) ); ?>&media=<?php echo wp_get_attachment_image_url( $product->get_image_id(), 'original' ); ?>&description=<?php echo urlencode($post->post_title); ?>" class="social rounded outline" target="_blank">
					<span class="ion-social-pinterest-outline"></span>
				</a>
			</div>
		</div>
	</div>
</div>

<?php if ( $type == 'tabs_details' ) : ?>

	<?php if ( ! empty( $product_tabs ) ) : ?>
	<div class="vc_col-md-12">
		<div class="tab-box tab-box-material" data-tab-box="true">
			<div class="tab-box-buttons text-center" data-tab-box-buttons="true" role="tablist">
			<?php $item = 1; ?>
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
				<div class="tab-box-btn uppercase" data-tab-box-item="<?php echo esc_attr( $item++ ); ?>" role="tab" role="tab" 
					<?php if( $product_tab['callback'] == 'comments_template' ){ echo "id=tab-reviews"; } ?>>
					<?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ); ?>
				</div>
			<?php endforeach; ?>
			</div>
			<div class="tab-box-content" data-tab-box-content="true" role="tabpanel">
				<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
				<div class="tab-box-item">
					<?php call_user_func( $product_tab['callback'], $key, $product_tab ); ?>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	
<?php endif; ?>

<?php if ( $type == 'extended_details' ) : ?>

	<?php if ( ! empty( $product_tabs ) ) : ?>
			</div><!--.product-->
		</div><!--.site-container-->
	</div><!-- container -->

	<div class="extended-top">
		<div class="wrapped-container">
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
				<?php if( $product_tab['callback'] != 'comments_template' ) : ?>
				<div class="vc_col-md-6">
					<h3 class="title text-left">
						<?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ); ?>
					</h3>
					<?php call_user_func( $product_tab['callback'], $key, $product_tab ); ?>
				</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="wrapped-container">
		<div class="site-container">
		<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
			<?php if( $product_tab['callback'] == 'comments_template' ) : ?>
			<div class="vc_col-md-12 extended-reviews comments-half">
				<h3 class="title text-left">
					<?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ); ?>
				</h3>
				<?php call_user_func( $product_tab['callback'], $key, $product_tab ); ?>
			</div>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>
	
<?php endif; ?>

</div>