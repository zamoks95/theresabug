<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
 * @version     3.4.0
 */

	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}

	global $post;
	$shop_page_id = wc_get_page_id( 'shop' );

	if ( $post && is_object( $post ) ) {
		$postID = $post->ID;
		if ( is_shop() || is_product_category() || is_product_tag() ) {
			$post->ID = get_option( 'woocommerce_shop_page_id' ); // woocomerce wrong post id fix
		}
	}

	$page_wrapped = \Argenta\Settings::page_is_wrapped();
	$product_now = 0;

	get_header( 'shop' );
?>

<?php get_template_part( 'template-parts/elements/header-title' ); ?>

<?php get_template_part( 'template-parts/elements/breadcrumbs' ); ?>

<?php
	/**
	 * woocommerce_before_main_content hook.
	 *
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 * @hooked woocommerce_breadcrumb - 20
	 */
	do_action( 'woocommerce_before_main_content' );
?>

<div class="<?php echo esc_attr( $page_wrapped ) ? 'wrapped-container' : 'full-width-container'; ?>">
	
	<?php if ( have_posts() ) : ?>
	<div class="shop-row">
		<div class="vc_col-md-9 page-with-right-sidebar page-offset-top page-offset-bottom columns-3">
			<?php wc_print_notices(); ?>
			<?php
				/**
				 * woocommerce_archive_description hook.
				 *
				 * @hooked woocommerce_taxonomy_archive_description - 10
				 * @hooked woocommerce_product_archive_description - 10
				 */
				do_action( 'woocommerce_archive_description' );
			?>
			<?php 
				if ( is_shop() || is_product_category() || is_product_tag() ) {
					$post->ID = $postID;
				}
				woocommerce_product_loop_start();
				woocommerce_product_subcategories();

				while ( have_posts() ) { the_post();

					/**
					 * woocommerce_shop_loop hook.
					 *
					 * @hooked WC_Structured_Data::generate_product_data() - 10
					 */
					do_action( 'woocommerce_shop_loop' );
					wc_get_template_part( 'content', 'product' );
				}

				woocommerce_product_loop_end(); 
			?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>
		</div>
	<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
		<?php do_action( 'woocommerce_no_products_found' ); ?>
	<?php endif; ?>

		<div class="vc_col-md-3 page-sidebar woocommerce-sidebar">
			<aside id="secondary" class="widget-area">
				<ul>
					<?php dynamic_sidebar( 'wc_shop' ); ?>
				</ul>
			</aside>
		</div>

	</div>
</div><!--.wrapper-->

<?php
	/**
	 * woocommerce_after_main_content hook.
	 *
	 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'woocommerce_after_main_content' );
?>

<?php get_footer( 'shop' ); ?>
