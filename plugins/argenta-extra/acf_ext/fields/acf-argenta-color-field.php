<?php

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;

// check if class already exists
if( ! class_exists( 'acf_field_argenta_color' ) ) :


class acf_field_argenta_color extends acf_field {

	function __construct( $settings ) {

		$this->name = 'argenta_color';
		/*
		*  label (string) Multiple words, can include spaces, visible when selecting a field type
		*/
		$this->label = __( 'Argenta Color', 'argenta_extra' );
		/*
		*  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
		*/
		$this->category = 'basic';
		/*
		*  defaults (array) Array of default settings which are merged into the field object. These are used later in settings
		*/
		$this->defaults = array(
			'add_theme_inherited' => true
		);
		/*
		*  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
		*  var message = acf._e('FIELD_NAME', 'error');
		*/
		
		$this->l10n = array(
			'error'	=> __( 'Error! Please enter a higher value', 'acf-argenta-typo' ),
		);
		/*
		*  settings (array) Store plugin settings (url, path, version) as a reference for later use with assets
		*/
		$this->settings = $settings;

		// ----------------------------------------------------------------------------------------------------

		// do not delete!
    	parent::__construct();
    	
	}



	/*function render_field_settings( $field ) {
		acf_render_field_setting( $field, array(
			'label'			=> __( 'Add "Theme inherited" option?','acf' ),
			'instructions'	=> '',
			'name'			=> 'add_theme_inherited',
			'type'			=> 'true_false',
			'ui'			=> 1,
		));
	}*/
	
	
	function render_field( $field ) {

		/*
		echo '<pre>';
		print_r( $field );
		echo '</pre>';
		*/

		$text = acf_get_sub_array( $field, array('id', 'class', 'name', 'value') );
		$hidden = acf_get_sub_array( $field, array('name', 'value') );
		$uniqid = uniqid( 'argenta-color' );
?>

		<div class="argenta-color-field-content" data-uniqid="<?php echo $uniqid; ?>">

			<!-- Hidden field -->
			<?php acf_hidden_input( $hidden ); ?>

			<input type="text" name="color" class="cs-wp-color-picker"<?php if ( $field['value'] ) { echo ' value="' . $field['value'] . '"'; } ?>>

		</div>

<?php
	}
	

	
	function input_admin_enqueue_scripts() {
		global $wp_scripts, $wp_styles;

		$url = $this->settings['url'];
		$version = $this->settings['version'];

		// wp_register_style( 'acf-input-argenta', "{$url}assets/css/input.css", array( 'acf-input' ), $version );
		wp_enqueue_style( 'acf-input-argenta' );
		
		wp_register_script( 'acf-input-argenta-color', "{$url}assets/js/input.js", array( 'acf-input' ), $version );
		wp_enqueue_script('acf-input-argenta-color');

		if ( ! isset( $wp_scripts->registered['iris'] ) ) {
			wp_register_style('wp-color-picker', admin_url( 'css/color-picker.css' ), array(), '', true);
			wp_register_script('iris', admin_url( 'js/iris.min.js' ), array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), '1.0.7', true);
			wp_register_script('wp-color-picker', admin_url( 'js/color-picker.min.js' ), array('iris'), '', true);
		    wp_localize_script('wp-color-picker', 'wpColorPickerL10n', array(
		        'clear'			=> __( 'Clear', 'acf' ),
		        'defaultString'	=> __( 'Default', 'acf' ),
		        'pick'			=> __( 'Select Color', 'acf' ),
		        'current'		=> __( 'Current Color', 'acf' )
		    ));
		}

		wp_enqueue_style( 'wp-color-picker' );
	    wp_enqueue_style( 'acf-input-argenta-picker', "{$url}assets/css/cs-wp-color-picker.min.css", array( 'wp-color-picker' ), '1.0.0', 'all' );
	    wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'acf-input-argenta-picker', "{$url}assets/js/cs-wp-color-picker.min.js", array( 'wp-color-picker' ), '1.0.0', true );
	}
	
	
	
	function load_value( $value, $post_id, $field ) {
		return $value;
	}
}

// initialize
new acf_field_argenta_color( $this->settings );

// class_exists check
endif;

?>