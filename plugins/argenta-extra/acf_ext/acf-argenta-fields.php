<?php

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

// check if class already exists
if ( ! class_exists('acf_plugin_argenta') ) :


class acf_plugin_argenta {
	
	function __construct() {
		$this->settings = array(
			'version'	=> '1.0.0',
			'url'		=> plugin_dir_url( __FILE__ ),
			'path'		=> plugin_dir_path( __FILE__ )
		);
		
		add_action( 'acf/include_field_types', array( $this, 'include_field_types' ) );
	}

	function include_field_types( $version = false ) {
		include_once( 'fields/acf-argenta-typo-field.php' );
		include_once( 'fields/acf-argenta-color-field.php' );
		include_once( 'fields/acf-argenta-columns-field.php' );
	}

}

// initialize
new acf_plugin_argenta();

endif;
	
?>