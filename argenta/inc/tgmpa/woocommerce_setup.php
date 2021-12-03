<?php

// add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );


// Widgets
function argenta_lh_woocommerce_tag_cloud_widget() {
	$args = array(
		'smallest' => 13,
		'largest' => 13,
		'unit'  => 'px',
		'number' => 15,
		'taxonomy' => 'product_tag'
	);
	return $args;
}

add_filter( 'woocommerce_product_tag_cloud_widget_args', 'argenta_lh_woocommerce_tag_cloud_widget' );


function argenta_lh_woocommerce_scripts(){
	wp_register_script( 'woocommerce_hack', get_template_directory_uri() . '/assets/js/woocommerce-hack.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'woocommerce_hack' );
}

add_action( 'wp_enqueue_scripts', 'argenta_lh_woocommerce_scripts' );


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 15 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );


function argenta_lh_wc_message_filter_function( $message ) {
	$message = preg_replace( '/(<a)(.+\/a>)(.+)/i', '${3} ${1} ${2}', $message );
	$message = preg_replace( '/"button/i', '"', $message );
	return $message;
}

add_filter( 'woocommerce_add_message', 'argenta_lh_wc_message_filter_function', 10, 1 );
add_filter( 'woocommerce_add_error', 'argenta_lh_wc_message_filter_function', 10, 1 );
add_filter( 'woocommerce_add_notice', 'argenta_lh_wc_message_filter_function', 10, 1 );


// Custom fields in ckeckout woocommerce page
function argenta_lh_override_checkout_fields( $fields ) {
	$fields['billing']['billing_first_name']['placeholder'] = esc_attr( _x( 'First name', 'placeholder', 'argenta' ) );
	$fields['billing']['billing_first_name']['clear'] = true;
	$fields['billing']['billing_first_name']['class'] = '';

	$fields['billing']['billing_last_name']['placeholder'] = esc_attr( _x( 'Last name', 'placeholder', 'argenta' ) );
	$fields['billing']['billing_last_name']['clear'] = true;
	$fields['billing']['billing_last_name']['class'] = '';

	$fields['billing']['billing_company']['placeholder'] = esc_attr( _x( 'Company name', 'placeholder', 'argenta' ) );
	$fields['billing']['billing_company']['clear'] = true;

	$fields['billing']['billing_email']['placeholder'] = esc_attr( _x( 'Email', 'placeholder', 'argenta' ) );
	$fields['billing']['billing_email']['clear'] = true;

	$fields['billing']['billing_address_1']['placeholder'] = esc_attr( _x( 'Street address', 'placeholder', 'argenta' ) );
	$fields['billing']['billing_address_1']['clear'] = true;
	$fields['billing']['billing_address_1']['class'] = '';

	$fields['billing']['billing_city']['placeholder'] = esc_attr( _x( 'Town / city', 'placeholder', 'argenta' ) );
	$fields['billing']['billing_city']['clear'] = true;
	$fields['billing']['billing_city']['class'] = '';

	$fields['billing']['billing_state']['placeholder'] = esc_attr( _x( 'State / country', 'placeholder', 'argenta' ) );
	$fields['billing']['billing_state']['clear'] = true;
	$fields['billing']['billing_state']['class'] = '';

	$fields['billing']['billing_phone']['placeholder'] = esc_attr( _x( 'Phone', 'placeholder', 'argenta' ) );
	$fields['billing']['billing_phone']['clear'] = true;

	$fields['billing']['billing_postcode']['placeholder'] = esc_attr( _x( 'Postcode / ZIP', 'placeholder', 'argenta' ) );
	$fields['billing']['billing_postcode']['clear'] = true;
	$fields['billing']['billing_postcode']['class'] = '';

	$fields['order']['order_comments']['placeholder'] = esc_attr( _x( 'Notes about your order, e.g. special notes for delivery', 'placeholder', 'argenta' ) );
	$fields['order']['order_comments']['clear'] = true;
	$fields['order']['order_comments']['type'] = 'textarea';

	$fields['account']['account_username']['placeholder'] = esc_attr( _x( 'Username', 'placeholder', 'argenta' ) );
	$fields['account']['account_username']['clear'] = true;

	$fields['account']['account_password']['placeholder'] = esc_attr( _x( 'Password', 'placeholder', 'argenta' ) );
	$fields['account']['account_password']['clear'] = true;

	return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'argenta_lh_override_checkout_fields' );


function argenta_lh_override_default_address_fields( $fields ) {
	$fields['first_name']['placeholder'] = esc_attr( _x( 'First name', 'placeholder', 'argenta' ) );
	$fields['first_name']['clear'] = true;
	$fields['first_name']['class'] = '';

	$fields['last_name']['placeholder'] = esc_attr( _x( 'Last name', 'placeholder', 'argenta' ) );
	$fields['last_name']['clear'] = true;
	$fields['last_name']['class'] = '';

	$fields['company']['placeholder'] = esc_attr( _x( 'Company name', 'placeholder', 'argenta' ) );
	$fields['company']['clear'] = true;

	$fields['email']['placeholder'] = esc_attr( _x( 'Email', 'placeholder', 'argenta' ) );
	$fields['email']['clear'] = true;

	$fields['address_1']['placeholder'] = esc_attr( _x( 'Street address', 'placeholder', 'argenta' ) );
	$fields['address_1']['clear'] = true;

	$fields['city']['placeholder'] = esc_attr( _x( 'Town / city', 'placeholder', 'argenta' ) );
	$fields['city']['clear'] = true;
	$fields['city']['class'] = '';

	$fields['state']['placeholder'] = esc_attr( _x( 'State / country', 'placeholder', 'argenta' ) );
	$fields['state']['clear'] = true;
	$fields['state']['class'] = '';

	$fields['phone']['placeholder'] = esc_attr( _x( 'Phone', 'placeholder', 'argenta' ) );
	$fields['phone']['clear'] = true;

	$fields['postcode']['placeholder'] = esc_attr( _x( 'Postcode / ZIP', 'placeholder', 'argenta' ) );
	$fields['postcode']['clear'] = true;
	$fields['postcode']['class'] = '';

	return $fields;
}
add_filter( 'woocommerce_default_address_fields', 'argenta_lh_override_default_address_fields' );


// Custom icon for PayPal payment option on WooCommerce checkout page.
function argenta_lh_isa_extended_paypal_icon() {
	return get_stylesheet_directory_uri() . '/images/paypal-logo.png';
}
add_filter( 'woocommerce_paypal_icon', 'argenta_lh_isa_extended_paypal_icon' );



// WooCommerce sidebar
function argenta_lh_wc_widgets_init() {
	register_sidebar( array(
		'name' => esc_html__( 'Shop', 'argenta' ),
		'id' => 'wc_shop',
		'description' => esc_html__( 'WooCommerce sidebar.', 'argenta' ),
		'before_title'  => '<h3 class="title widgettitle">',
		'after_title'   => '</h3>',
	));
}
add_action( 'widgets_init', 'argenta_lh_wc_widgets_init' );


function argenta_lh_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	$fragments['span.cart-count'] = '<span class="cart-count">(' . esc_attr( $woocommerce->cart->cart_contents_count ) . ')</span>';
	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'argenta_lh_woocommerce_header_add_to_cart_fragment' );


// WooCommerce size images
function argenta_lh_wc_image_dimensions() {
	$catalog = array(
		'width'   => '800',
		'height'  => '',
		'crop'    => 1
	);
	$single = array(
		'width'   => '600',
		'height'  => '',
		'crop'    => 1
	);
	$thumbnail = array(
		'width'   => '120',
		'height'  => '',
		'crop'    => 1
	);

	update_option( 'shop_catalog_image_size', $catalog );
	update_option( 'shop_single_image_size', $single );
	update_option( 'shop_thumbnail_image_size', $thumbnail );
}

add_action( 'init', 'argenta_lh_wc_image_dimensions', 1 );


add_filter( 'login_errors', '__return_false' );


// Wishlist

if( ! function_exists( 'yith_wcwl_is_wishlist_page' ) && function_exists( 'yith_wcwl_object_id' ) ){
    /**
     * Check if current page is wishlist
     *
     * @return bool
     * @since 2.0.13
     */
    function yith_wcwl_is_wishlist_page(){
        $wishlist_page_id = yith_wcwl_object_id( get_option( 'yith_wcwl_wishlist_page_id' ) );

        if( ! $wishlist_page_id ){
            return false;
        }

        return is_page( $wishlist_page_id );
    }
}



//	WooProduct fallback
if ( ! function_exists('is_product') ) {
	function is_product() { return false; }
}



// Standart user avatar
function argenta_lh_new_gravatar( $avatar_defaults ) {
	$myavatar = get_template_directory_uri() . '/images/user.png';
	$avatar_defaults[$myavatar] = esc_html__( 'Argenta Avatar', 'argenta' );
	return $avatar_defaults;
}

add_filter( 'avatar_defaults', 'argenta_lh_new_gravatar' );