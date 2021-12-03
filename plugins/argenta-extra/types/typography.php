<?php

	/**
	* Visual Composer Argenta Typography custom type
	*/
	if ( function_exists ( 'vc_add_shortcode_param' ) ) {
		vc_add_shortcode_param( 'argenta_typography', 'argenta_extra_typography_settings_field', plugins_url( 'typography.js?v=1.03' , __FILE__ ) );
	}
	
	function argenta_extra_typography_settings_field( $settings, $value ) {
		$font_size = $line_height = $letter_spacing = $weight = $italic = $underline = $use_custom_font = $custom_font = '';
		$value_array = argenta_extra_parse_VC_typography_to_array($value);
		$google_fonts = argenta_extra_get_google_fonts_array();
		$uniq = uniqid( 'clbr_vc_check_' );
		ob_start();

?>
		<div class="argenta_typography_block">
			<input type="hidden" name="<?php echo esc_attr( $settings['param_name'] ); ?>" class="wpb_vc_param_value" value="<?php echo esc_attr( $value ); ?>">
			<div class="row">
				<div class="split-column">
					<label>
						<div class="title"><?php _e( 'Font size', 'argenta_extra' ); ?></div>
						<div class="input-pixeles-wrap">
							<input type="text" data-target="font-size" value="<?php echo esc_attr( $value_array['font_size'] ); ?>">
							<div class="pixeles">px</div>
						</div>
					</label>
				</div>
				<div class="split-column">
					<label>
						<div class="title"><?php _e( 'Line height', 'argenta_extra' ); ?></div>
						<div class="input-pixeles-wrap">
							<input type="text" data-target="line-height" value="<?php echo esc_attr( $value_array['line_height'] ); ?>">
							<div class="pixeles">px</div>
						</div>
					</label>
				</div>
				<div class="split-column">
					<label>
						<div class="title"><?php _e( 'Letter spacing', 'argenta_extra' ); ?></div>
						<div class="input-pixeles-wrap">
							<input type="text" data-target="letter-spacing" value="<?php echo esc_attr( $value_array['letter_spacing'] ); ?>">
							<div class="pixeles">px</div>
						</div>
					</label>
				</div>
				<div class="split-column">
					<label>
						<div class="title"><?php _e( 'Font weight', 'argenta_extra' ); ?></div>
						<div class="input-pixeles-wrap">
							<select data-target="weight">
								<option value="inherit">inherit</option>
							<?php
								$check_point = false;
								if ( $value_array['weight'] ) {
									$check_point = $value_array['weight'];
								}
								for ($i=1; $i <= 9; $i++) {
									$selected = ( $check_point == $i * 100 ) ? ' selected="selected"' : '';
									echo '<option value="' . $i . '00"' . $selected . '>' . $i . '00</option>';
								}
							?>
							</select>
						</div>
					</label>
				</div>
			</div>
			<div class="row">
				<div class="split-column column-6">
					<div class="title"><?php _e( 'Font style', 'argenta_extra' ); ?></div>
					<div class="input-styles-wrap">
						<span class="cbrio_custom_check">
							<input id="<?php echo $uniq . 'n'; ?>" type="checkbox" data-target="normal"<?php if ($value_array['normal']) echo ' checked="checked"'; ?>>
							<label for="<?php echo $uniq . 'n'; ?>" class="cbrio_custom_check">normal</label>
						</span>
						<span class="cbrio_custom_check">
							<input id="<?php echo $uniq . 'i'; ?>" type="checkbox" data-target="italic"<?php if ($value_array['italic']) echo ' checked="checked"'; ?>>
							<label for="<?php echo $uniq . 'i'; ?>"><em>italic</em></label>
						</span>
						<span class="cbrio_custom_check">
							<input id="<?php echo $uniq . 'u'; ?>" type="checkbox" data-target="underline"<?php if ($value_array['underline']) echo ' checked="checked"'; ?>>
							<label for="<?php echo $uniq . 'u'; ?>" class="cbrio_custom_check"><u>underline</u></label>
						</span>
					</div>
				</div>
				<div class="split-column">
					<div class="title"><?php _e( 'Custom font family', 'argenta_extra' ); ?></div>
					<div class="input-styles-wrap">
						<span class="cbrio_custom_check">
							<input id="<?php echo $uniq . 'c'; ?>" type="checkbox" data-target="use-custom-font"<?php if ($value_array['use_custom_font']) echo ' checked="checked"'; ?>> 
							<label for="<?php echo $uniq . 'c'; ?>" class="cbrio_custom_check"><?php _e( 'Custom font', 'argenta_extra'); ?></label>
						</span>
					</div>
				</div>
				
				<div class="split-column custom-font-panel"<?php if (!$value_array['use_custom_font']) echo 'style="display: none;"';?>>
					<div class="title"><?php _e( 'Google Fonts', 'argenta_extra' ); ?></div>
					<div class="input-fonts-wrap">
						<select data-target="custom-font">
							<optgroup label="Recommend to use">
								<option value="Montserrat:400,700">Montserrat</option>
								<option value="Open Sans:300,300i,400,400i,700,700i"}">Open Sans</option>
								<option value="Lora:400,400i,700,700i">Lora</option>
							</optgroup>
							<option disabled>&mdash;</option>
						<?php foreach ($google_fonts as $font_object) { $_value = $font_object->font_family . ':' . $font_object->font_styles; ?>
							<option value="<?php echo $_value; ?>"<?php if ($_value == $value_array['custom_font']) echo 'selected="selected"'?>><?php echo $font_object->font_family; ?></option>
						<?php } ?>
						</select>
					</div>
					<div class="tip"><?php echo sprintf( __( 'See %s', 'argenta_extra'), '<a href="https://fonts.google.com/" target="_blank">fonts.google.com</a>' ); ?></div>
				</div>
			</div>
		</div>
<?php

		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}