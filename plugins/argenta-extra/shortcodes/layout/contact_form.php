<div class="contact-form<?php echo $contact_form_class; ?><?php if ( $css_class ) echo $css_class; ?>" <?php if ( isset( $button_css['classes'] ) ) { echo 'data-button-classes="' . $button_css['classes'] . '"'; } ?> <?php if ( $with_styles ) echo 'id="' . $contact_form_uniqid . '"'; ?> <?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?> <?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>

	<?php echo do_shortcode( '[contact-form-7 id="' . $form_id . '" title=""]' ); ?>

</div>

<?php
	if ( $with_styles ) {
		$_style_block = '';

		if ( $fields_css ) {
			$_style_block .= '#' . $contact_form_uniqid . ' input,';
			$_style_block .= '#' . $contact_form_uniqid . ' textarea,';
			$_style_block .= '#' . $contact_form_uniqid . ' select,';
			$_style_block .= '#' . $contact_form_uniqid . ' select option{';
			$_style_block .= $fields_css;
			$_style_block .= '}';
		}
		if ( $fields_placeholder_css ) {
			$_style_block .= '#' . $contact_form_uniqid . ' input::-webkit-input-placeholder,';
			$_style_block .= '#' . $contact_form_uniqid . ' textarea::-webkit-input-placeholder{';
			$_style_block .= $fields_placeholder_css;
			$_style_block .= '}';
			$_style_block .= '#' . $contact_form_uniqid . ' input::-moz-input-placeholder,';
			$_style_block .= '#' . $contact_form_uniqid . ' textarea::-moz-input-placeholder{';
			$_style_block .= $fields_placeholder_css;
			$_style_block .= '}';
			$_style_block .= '#' . $contact_form_uniqid . ' input::-ms-input-placeholder,';
			$_style_block .= '#' . $contact_form_uniqid . ' textarea::-ms-input-placeholder{';
			$_style_block .= $fields_placeholder_css;
			$_style_block .= '}';
			$_style_block .= '#' . $contact_form_uniqid . ' input::-moz-placeholder,';
			$_style_block .= '#' . $contact_form_uniqid . ' textarea::-moz-placeholder{';
			$_style_block .= $fields_placeholder_css;
			$_style_block .= '}';
		}
		if ( isset( $button_css['css'] ) && $button_css['css'] ) {
			$_style_block .= '#' . $contact_form_uniqid . ' button.btn{';
			$_style_block .= $button_css['css'];
			$_style_block .= '}';
		}
		if ( isset( $button_css['hover-css'] ) && $button_css['hover-css'] ) {
			$_style_block .= '#' . $contact_form_uniqid . ' button.btn:hover{';
			$_style_block .= $button_css['hover-css'];
			$_style_block .= '}';
		}
		if ( $label_css ) {
			$_style_block .= '#' . $contact_form_uniqid . ' label{';
			$_style_block .= $label_css;
			$_style_block .= '}';
		}

		\Argenta\Layout::append_to_shortcodes_css_buffer( $_style_block );
	}
?>