<?php


function argenta_lh_register_plugins() {
	$plugins = array(
		array(
			'name' => 'WPBakery Page Builder',
			'slug' => 'js_composer',
			'source' => 'https://plugins.clbthemes.com/js_composer.zip',
			'required' => true,
			'version' => '6.4.2',
			'force_activation' => false,
			'force_deactivation' => false
		),
		array(
			'name' => 'Advanced Custom Fields PRO',
			'slug' => 'advanced-custom-fields-pro',
			'source' => 'https://plugins.clbthemes.com/advanced-custom-fields-pro.zip',
			'required' => true,
			'version' => '5.9.3',
			'force_activation' => false,
			'force_deactivation' => false
		),
		array(
			'name' => 'WooCommerce',
			'slug' => 'woocommerce',
			'required' => true
		),
		array(
			'name' => 'Slider Revolution',
			'slug' => 'slider-revolution',
			'source' => 'https://plugins.clbthemes.com/slider-revolution.zip',
			'required' => true,
			'version' => '6.3.3',
			'force_activation' => false,
			'force_deactivation' => false
		),
		array(
			'name' => 'Argenta Portfolio',
			'slug' => 'argenta-portfolio',
			'source' => 'https://plugins.clbthemes.com/argenta-portfolio_v24.zip',
			'required' => true,
			'version' => '2.4',
			'force_activation' => false,
			'force_deactivation' => true
		),
		array(
			'name' => 'Argenta Shortcodes and Widgets',
			'slug' => 'argenta-extra',
			'source' => 'https://plugins.clbthemes.com/argenta-extra_v213.zip',
			'required' => true,
			'version' => '2.1.3',
			'force_activation' => false,
			'force_deactivation' => true
		),
		array(
			'name' => 'One Click Import',
			'slug' => 'demo-import',
			'source' => 'https://plugins.clbthemes.com/demo-import_v222.zip',
			'required' => true,
			'version' => '2.2.2',
			'force_activation' => false,
			'force_deactivation' => false
		),
		array(
			'name' => 'Contact Form 7',
			'slug' => 'contact-form-7',
			'required' => false
		),
		array(
			'name' => 'Envato Market',
			'slug' => 'envato-market',
			'source' => 'http://envato.github.io/wp-envato-market/dist/envato-market.zip',
			'required' => false,
			'version' => '2.0.6',
			'force_activation' => false,
			'force_deactivation' => false
		),
	);

	$config = array(
		'domain' => 'argenta',
		'default_path' => '',
		'menu' => 'install-required-plugins',
		'has_notices' => true,
		'is_automatic' => false,
		'message' => ''
	);
	
	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'argenta_lh_register_plugins' );