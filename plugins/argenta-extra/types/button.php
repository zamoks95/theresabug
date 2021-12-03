<?php

	/**
	* Visual Composer Argenta button custom type
	*/

	if ( function_exists ( 'vc_add_shortcode_param' ) ) {
		vc_add_shortcode_param( 'argenta_button', 'argenta_extra_button_settings_field', plugins_url( 'button.js' , __FILE__ ) );
	}

	function argenta_extra_button_settings_field( $settings, $value ) {
		parse_str( $value, $value_array );
		ob_start();

?>
		<div class="argenta_button_block">
			<input type="hidden" name="<?php echo argenta_extra_filter_string( $settings['param_name'], 'attr', '' ); ?>" class="wpb_vc_param_value" value="<?php echo argenta_extra_filter_string( $value, 'attr', '' ); ?>">
			<div class="col-3 type">
				<label>
					<div class="wpb_element_label"><?php _e( 'Type', 'argenta_extra' ); ?></div>
					<select class="type">
						<option value="default"<?php if ( $value_array['type'] == 'default' ) { echo 'selected="selected"'; } ?>>Default</option>
						<option value="outline"<?php if ( $value_array['type'] == 'outline' ) { echo 'selected="selected"'; } ?>>Outline</option>
						<option value="flat"<?php if ( $value_array['type'] == 'flat' ) { echo 'selected'; } ?>>Flat</option>
						<option value="arrow_link"<?php if ( $value_array['type'] == 'arrow_link' ) { echo 'selected="selected"'; } ?>>Link with arrow</option>
					</select>
				</label>
			</div>
			<div class="col-3 size">
				<label>
					<div class="wpb_element_label"><?php _e( 'Size', 'argenta_extra' ); ?></div>
					<select class="size">
						<option value="default"<?php if ( $value_array['size'] == 'default' ) { echo 'selected="selected"'; } ?>>Default</option>
						<option value="small"<?php if ( $value_array['size'] == 'small' ) { echo 'selected="selected"'; } ?>>Small</option>
						<option value="large"<?php if ( $value_array['size'] == 'large' ) { echo 'selected="selected"'; } ?>>Large</option>
						<option value="huge"<?php if ( $value_array['size'] == 'huge' ) { echo 'selected="selected"'; } ?>>Huge</option>
					</select>
				</label>
			</div>
			<div class="col-3 rounded button-checkbox">
				<label>
					<input type="checkbox" name="rounded"<?php if ( $value_array['rounded'] ) { echo 'checked="checked"'; } ?>>
					Rounded shape
				</label>
			</div>
			<div class="col-3 fullwidth button-checkbox">
				<label>
					<input type="checkbox" name="fullwidth"<?php if ( $value_array['fullwidth'] ) { echo 'checked="checked"'; } ?>>
					Full width
				</label>
			</div>
			<div class="col-3 button-color">
				<div class="wpb_element_label"><?php _e( 'Color', 'argenta_extra' ); ?></div>
				<div class="color-group">
					<input name="color" class="vc_color-control" type="text" value="<?php echo argenta_extra_filter_string( $value_array['color'], 'attr', '' ); ?>">
				</div>
			</div>
			<div class="col-3 button-hover-color">
				<div class="wpb_element_label"><?php _e( 'Hover color', 'argenta_extra' ); ?></div>
				<div class="color-group">
					<input name="hover-color" class="vc_color-control" type="text" value="<?php echo argenta_extra_filter_string( $value_array['hover-color'], 'attr', '' ); ?>">
				</div>
			</div>
			<div class="col-3 text-color">
				<div class="wpb_element_label"><?php _e( 'Text color', 'argenta_extra' ); ?></div>
				<div class="color-group">
					<input name="text-color" class="vc_color-control" type="text" value="<?php echo argenta_extra_filter_string( $value_array['text-color'], 'attr', '' ); ?>">
				</div>
			</div>
			<div class="col-3 text-hover-color">
				<div class="wpb_element_label"><?php _e( 'Text hover color', 'argenta_extra' ); ?></div>
				<div class="color-group">
					<input name="text-hover-color" class="vc_color-control" type="text" value="<?php echo argenta_extra_filter_string( $value_array['text-hover-color'], 'attr', '' ); ?>">
				</div>
			</div>
		</div>
<?php

		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}