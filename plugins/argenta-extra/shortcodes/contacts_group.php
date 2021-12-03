<?php 

	/**
	* Visual Composer Argenta Contacts group shortcode
	*/

	add_shortcode( 'argenta_sc_contacts_group', 'argenta_sc_contacts_group_func' );

	function argenta_sc_contacts_group_func( $atts, $content = '' ) {
		if ( isset( $atts ) && is_array( $atts ) ) {
			extract( $atts );
		}

		// Default values, parsing and filtering
		$list_items_type = ( isset( $list_items_type ) ) ? argenta_extra_filter_string( $list_items_type, 'string', 'default' ) : 'default';
		$css_class = ( isset( $css_class ) ) ? ' ' . argenta_extra_filter_string( $css_class, 'attr', '' )  : '';

		// Assembling
		ob_start();
		include( 'layout/contacts_group.php' );
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	vc_map( array(
		'name' => __( 'Contacts', 'argenta_extra' ),
		'description' => __( 'Contacts group', 'argenta_extra' ),
		'base' => 'argenta_sc_contacts_group',
		'category' => __( 'Argenta', 'argenta_extra' ),
		'icon' => plugin_dir_url( __FILE__ ) . 'icons/VS-Icon-ContactsModule.png',
		'js_view' => 'VcArgentaContactsGroupColumnView',
		'show_settings_on_create' => false,
		'as_parent' => array( 
			'only' => 'argenta_sc_contact_inner'
		),
		'default_content' => '[argenta_sc_contact_inner block_type_layout="with_heading" heading="' . __( 'Our address', 'argenta_extra' ) . '" icon_as_icon="my-icon-loc-point"][argenta_sc_contact_inner block_type_layout="with_heading" heading="' . __( 'Email', 'argenta_extra' ) . '" icon_as_icon="my-icon-ema-email"][argenta_sc_contact_inner block_type_layout="with_heading" heading="' . __( 'Phone number', 'argenta_extra' ) . '" icon_as_icon="my-icon-tel-phone"]',
		'params' => array(
			// Styles
			array(
				'type' => 'argenta_choose_box',
				'group' => __( 'Styles', 'argenta_extra' ),
				'heading' => __( 'List items style', 'argenta_extra' ),
				'param_name' => 'list_items_type',
				'value' => array(
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon52.png',
						'key' => 'default',
						'title' => __( 'Default', 'argenta_extra' ),
					),
					array(
						'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon54.png',
						'key' => 'with_border',
						'title' => __( 'With bottom border', 'argenta_extra' ),
					)
				)
			),
			array(
				'type' => 'textfield',
				'group' => __( 'Styles', 'argenta_extra' ),
				'heading' => __( 'Custom CSS class', 'argenta_extra' ),
				'param_name' => 'css_class',
				'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class.', 'argenta_extra' ),
			),
		)
	) );
	

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Argenta_Sc_Contacts_Group extends WPBakeryShortCodesContainer {
			
		}
	}