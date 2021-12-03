<?php

if ( ! class_exists( 'Cbrio_Mega_Menu' ) ) {
	class Cbrio_Mega_Menu {
		var $_options;

		public function __construct() {
			$this->_options = self::options();
			$this->_add_filters();
		}
		
		public static function options() {
			return array(
				'argenta_mega_menu_subtitle' => array(
					'type' 		=> 'text',
					'label' 	=> esc_html__( 'Subtitle', 'argenta' ),
					'default' => '',
					'size' 		=> 'wide',
					'class' 	=> 'argenta-hide-only-depth-0',
				),
				'argenta_mega_menu_image' => array(
					'type' 		=> 'upload',
					'label' 	=> esc_html__( 'Image', 'argenta' ),
					'default' => '',
					'size' 		=> 'wide',
					'class' 	=> 'argenta-show-only-depth-0',
				),
				
				'argenta_mega_menu_bg_position' => array(
					'type' 		=> 'select',
					'label' 	=> esc_html__( 'Background position', 'argenta' ),
					'default' => 0,
					'options' => array(
						'left top' => esc_html__( 'Left top', 'argenta' ),
						'left center' => esc_html__( 'Left center', 'argenta' ),
						'left bottom' => esc_html__( 'Left bottom', 'argenta' ),
						'right top' => esc_html__( 'Right top', 'argenta' ),
						'right center' => esc_html__( 'Right center', 'argenta' ),
						'right bottom' => esc_html__( 'Right bottom', 'argenta' ),
						'center top' => esc_html__( 'Center top', 'argenta' ),
						'center center' => esc_html__( 'Center center', 'argenta' ),
						'center bottom' => esc_html__( 'Center bottom', 'argenta' )
					),
					'size' => 'thin',
					'class' => 'argenta-show-only-depth-0',
				),
				'argenta_mega_menu_bg_repeat' => array(
					'type' => 'select',
					'label' => esc_html__( 'Background repeat', 'argenta' ),
					'default' => 'no-repeat',
					'options' => array(
						'no-repeat' => esc_html__( 'No-repeat', 'argenta' ),
						'repeat' => esc_html__( 'Repeat', 'argenta' ),
						'repeat-x' => esc_html__( 'Repeat-x', 'argenta' ),
						'repeat-y' => esc_html__( 'Repeat-y', 'argenta' ),
					),
					'size' 	=> 'thin',
					'class' => 'argenta-show-only-depth-0',
				),
				'argenta_wide_menu_enabled' => array(
					'type' 		=> 'select',
					'label' 	=> esc_html__( 'Enable wide menu', 'argenta' ),
					'default' => 0,
					'options' => array( 
						1 => esc_html__( 'Yes', 'argenta' ),
						0 => esc_html__( 'No', 'argenta' ) 
					),
					'size' => 'thin',
					'class' => 'argenta-show-only-depth-0',
				),
				'argenta_full_width_menu_enabled' => array(
					'type' => 'select',
					'label' => esc_html__( 'Enable full-width menu', 'argenta' ),
					'default' => 0,
					'options' => array( 
						1 => esc_html__( 'Yes', 'argenta' ),
						0 => esc_html__( 'No', 'argenta' ) 
					),
					'size' => 'thin',
					'class' => 'argenta-show-only-depth-0',
				),
			);
		}

		private function _add_filters() {
			# Add custom options to menu
			add_filter( 'wp_setup_nav_menu_item', array( $this, 'add_custom_options' ) );

			# Update custom menu options
			add_action( 'wp_update_nav_menu_item', array( $this, 'update_custom_options' ), 10, 3 );

			# Set edit menu walker
			add_filter( 'wp_edit_nav_menu_walker', array( $this, 'apply_edit_walker_class' ), 10, 2 );

			# Addition style
			add_action('admin_enqueue_scripts', array( $this, 'add_menu_css' ) );

			# Mega menu javascript
			add_action( 'admin_enqueue_scripts', array( $this, 'argenta_lh_mega_menu_admin_scripts' ), 80 );
		}

		public function argenta_lh_mega_menu_admin_scripts() {
			wp_enqueue_media();
			wp_register_script( 'argenta-mega-menu-loader', get_template_directory_uri() . '/inc/menu/js/image-upload.js', array( 'jquery' ) );
			wp_enqueue_script( 'argenta-mega-menu-loader' );
		}

		/**
		 * Register custom options and load options values
		 * 
		 * @param obj $item Menu Item
		 * @return obj Menu Item
		 */
		public function add_custom_options( $item ) {

			foreach( $this->_options as $option => $params ) {


				// For qTranslate
				$id = 0;
				if ( isset( $item->ID ) ) {
					$id = $item->ID;
				}
				

				$item->$option = get_post_meta( $id, $option, true );
				if ( $item->$option === false ) {
					$item->$option = $params['default'];
				}
			}

			return $item;
		}

		public function update_custom_options( $menu_id, $menu_item_id, $args ) {
			foreach( $this->_options as $option => $params ) {
				$key = 'menu-item-'. $option;
				
				$option_value = '';
				
				if ( isset( $_REQUEST[$key], $_REQUEST[$key][$menu_item_id] ) ) {
					$option_value = $_REQUEST[$key][$menu_item_id];
				}
				
				update_post_meta( $menu_item_id, $option, $option_value );
			}
		}

		public function add_menu_css() {
			$css = ".menu-item-settings { overflow: hidden; }";
			wp_add_inline_style('wp-admin', $css);
		}

		public function apply_edit_walker_class( $walker, $menu_id ) {
			return CBRIO_EDIT_MENU_WALKER_CLASS;
		}
	}
}
