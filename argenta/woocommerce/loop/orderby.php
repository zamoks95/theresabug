<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
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
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<!-- <form method="get">
	<div class="select" data-select="true">
		<select name="orderby">
			<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
				<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
			<?php endforeach; ?>
		</select>
		<a class="select-title brand-color-hover" data-toggle="select">
			<span></span>
			<i class="icon ion-android-arrow-dropdown"></i>
		</a>
		<ul class="select-menu"></ul>
	</div>
	<?php
		// Keep query string vars intact
		foreach ( $_GET as $key => $val ) {
			if ( 'orderby' === $key || 'submit' === $key ) {
				continue;
			}
			if ( is_array( $val ) ) {
				foreach( $val as $innerVal ) {
					echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
				}
			} else {
				echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
			}
		}
	?>
</form> -->


<?php global $wp_query; ?>

<form method="get">
	<div class="select" data-select="true">
		<a class="select-title brand-color-hover" data-toggle="select">
			<span>
				<?php 
					if(isset($wp_query->query_vars['product_cat'])) {
						$category = get_terms('product_cat', array(
							'slug' => $wp_query->query_vars['product_cat']
							));
						echo esc_attr( $category[0]->name );
					} else {
						esc_html_e( 'Category', 'argenta' );
					}
				?>
			</span>
			<i class="icon ion-android-arrow-dropdown"></i>
		</a>
		<ul class="select-menu">
			<li>
				<a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>">Categories</a>
			</li>
			<?php foreach ( get_terms( 'product_cat') as $id ) : ?>
				<li>
					<a href="<?php echo get_category_link( $id->term_id ); ?>">
						<?php echo esc_attr( $id->name ); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
		// Keep query string vars intact
		foreach ( $_GET as $key => $val ) {
			if ( 'orderby' === $key || 'submit' === $key ) {
				continue;
			}
			if ( is_array( $val ) ) {
				foreach( $val as $innerVal ) {
					echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
				}
			} else {
				echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
			}
		}
	?>
</form>

<form method="get">
	<div class="select" data-select="true">
		<a class="select-title brand-color-hover" data-toggle="select">
			<span>
				<?php 
					if(isset($wp_query->query_vars['product_tag'])) {
						$category = get_terms('product_tag', array(
							'slug' => $wp_query->query_vars['product_tag']
							));
						echo esc_attr( $category[0]->name );
					} else {
						esc_html_e( 'Tags', 'argenta' );
					}
				?>
			</span>
			<i class="icon ion-android-arrow-dropdown"></i>
		</a>
		<ul class="select-menu">
			<li>
				<a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>">Tags</a>
			</li>
			<?php foreach ( get_terms( 'product_tag') as $id ) : ?>
				<li>
					<a href="<?php echo get_category_link( $id->term_id ); ?>">
						<?php echo esc_attr( $id->name ); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
		// Keep query string vars intact
		foreach ( $_GET as $key => $val ) {
			if ( 'orderby' === $key || 'submit' === $key ) {
				continue;
			}
			if ( is_array( $val ) ) {
				foreach( $val as $innerVal ) {
					echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
				}
			} else {
				echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
			}
		}
	?>
</form>