<?php
/*
	Brand color
	
	Table of contents: (you can use search)
	# 1. Variables
	# 2. Brand color
	# 3. View
*/


# 1. Variables

use \Argenta\Settings	as ArSett;
use \Argenta\Layout		as ArLay;
use \Argenta\Helper		as ArHelp;

$brand_color = false;


# 2. Brand color

$brand_color = ArSett::get( 'page_brand_color', 'global' );


# 3. View
if ( !$brand_color ) {
	$brand_color = '#987f71';
}

if ( $brand_color ) {
	// --- start of CSS ---
	$_style_block = 'a:hover,input.brand-color,input[type="submit"].brand-color,
button.brand-color,a.brand-color,div.brand-color,span.brand-color,.brand-color,input.brand-color-hover:hover,input[type="submit"].brand-color-hover:hover,button.brand-color-hover:hover,a.brand-color-hover:hover,div.brand-color-hover:hover,span.brand-color-hover:hover,.brand-color-hover:hover, .has-brand-color-color, .is-style-outline .has-brand-color-color{';
	$_style_block .= 'color:' . $brand_color . ';';
	$_style_block .= '}';

	$_style_block .= 'input.brand-border-color,input[type="submit"].brand-border-color,button.brand-border-color,a.brand-border-color,div.brand-border-color,span.brand-border-color,.brand-border-color,input.brand-border-color-hover:hover,input[type="submit"].brand-border-color-hover:hover,button.brand-border-color-hover:hover,a.brand-border-color-hover:hover,div.brand-border-color-hover:hover,span.brand-border-color-hover:hover,.brand-border-color-hover:hover,.widget_calendar tbody tr td#today, .has-brand-color-background-color, .is-style-outline .has-brand-color-color{';
	$_style_block .= 'border-color:' . $brand_color . ';';
	$_style_block .= '}';

	$_style_block .= 'input.brand-bg-color,input[type="submit"].brand-bg-color,button.brand-bg-color,a.brand-bg-color,div.brand-bg-color,span.brand-bg-color,.brand-bg-color,input.brand-bg-color-hover:hover,input[type="submit"].brand-bg-color-hover:hover,button.brand-bg-color-hover:hover,a.brand-bg-color-hover:hover,div.brand-bg-color-hover:hover,span.brand-bg-color-hover:hover,.brand-bg-color-hover:hover,.list-box li:after, .widget-list-box li:after, .widget_categories ul li:after, .widget_recent_comments ul li:after, .widget_recent_entries ul li:after, .widget_meta ul li:after, .widget_archive ul li:after, .widget_nav_menu li:after, .widget_pages li:after, .widget_product_categories ul.product-categories li:after,.widget_calendar caption,.list-box-icon li:after, .list-box-clear li:after,.team-member-cover-list .team-member-content .socialbar .social:hover,.woocommerce .widget_rating_filter ul li:after, .woocommerce .widget_layered_nav ul li:after, .woocommerce .widget_price_filter .price_slider_wrapper .price_slider .ui-slider-handle:after,.woocommerce .widget_price_filter .price_slider_wrapper .price_slider .ui-slider-range,.woocommerce span.onsale,.single-product.woocommerce #content div.product .price del:after,.woocommerce #content div.product div.summary .yith-wcwl-add-to-wishlist a.add_to_wishlist:hover span:before, .has-brand-color-background-color{';
	$_style_block .= 'background-color:' . $brand_color . ';';
	$_style_block .= '}';

	$_style_block .= '.site-footer .widget_argenta_widget_subscribe button.btn,.widget.widget_shopping_cart .buttons > a.button.checkout{';
	$_style_block .= 'background-color:' . $brand_color . ';';
	$_style_block .= 'border-color:' . $brand_color . ';';
	$_style_block .= '}';

	$_style_block .= '.tab-box-material .tab-box-btn-active,.tab-box-left.tab-box-material .tab-box-btn-active,.site-footer .widget_argenta_widget_subscribe button.btn:hover,.woocommerce #content .product .price ins span.woocommerce-Price-amount.amount,.woocommerce #content div.product .product_meta span span,.woocommerce #content div.product .product_meta span a,.woocommerce #content div.product .product_meta span a:hover,#content .woocommerce .cart-collaterals table.shop_table a.shipping-calculator-button,#content .woocommerce #payment li.wc_payment_method a.about_paypal,.woocommerce #content div.product div.summary .yith-wcwl-add-to-wishlist a.add_to_wishlist:hover,.woocommerce #content div.product div.summary .yith-wcwl-add-to-wishlist a.add_to_wishlist:hover i,.single-product.woocommerce #content div.product .price del span.woocommerce-Price-amount.amount,#content .woocommerce .product .wc-product-title-wrap .price ins .amount,.single-product.woocommerce #content div.product a.woocommerce-review-link:hover,.widget.widget_shopping_cart .buttons > a.button.checkout:hover,.widget.woocommerce.widget_shopping_cart_content .buttons a.button.checkout:hover,.woocommerce #content .star-rating, #content .woocommerce .star-rating,.woocommerce #content .star-rating:before, #content .woocommerce .star-rating:before,.woocommerce #content #reviews #comments ol.commentlist li.comment .star-rating,.woocommerce #content #reviews #comments ol.commentlist li.comment .star-rating:before,.star-rating,.woocommerce .star-rating:before,.portfolio-sorting ul li a:hover,.widget_recent_comments ul a,.widget_rss ul a,.header-6 #mega-menu-wrap #primary-menu > li.current-menu-item > a,.header-6 #mega-menu-wrap #primary-menu > li.current-menu-ancestor > a,.post .entry-content a:not(.wp-block-button__link){';
	$_style_block .= 'color:' . $brand_color . ';';
	$_style_block .= '}';

	$_style_block .= '.portfolio-sorting ul li a.active{';
	$_style_block .= 'border-color:' . $brand_color . ';';
	$_style_block .= 'color:' . $brand_color . ';';
	$_style_block .= '}';

	$_style_block .= '#mega-menu-wrap ul li.current-menu-item > a,#mega-menu-wrap ul li.current-menu-ancestor > a{';
	$_style_block .= 'box-shadow:0 2px 0px ' . $brand_color . ' inset;' ;
	$_style_block .= '}';

	$_style_block .= '.header-6 #mega-menu-wrap ul#primary-menu li.current-menu-item > a,.header-6 #mega-menu-wrap ul#primary-menu li.current-menu-ancestor > a{';
	$_style_block .= 'box-shadow:none;';
	$_style_block .= '}';
	// --- end of CSS ---
	ArLay::append_to_dynamic_css_buffer( $_style_block );
}