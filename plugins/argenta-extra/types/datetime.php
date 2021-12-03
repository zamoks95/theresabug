<?php

	/**
	* Visual Composer Argenta Date and time custom type
	*/

	if ( function_exists ( 'vc_add_shortcode_param' ) ) {
		vc_add_shortcode_param( 'argenta_datetime', 'argenta_extra_datetime_settings_field', plugins_url( 'datetime.js' , __FILE__ ) );
	}

	function argenta_extra_datetime_settings_field( $settings, $value ) {
		$year = $month = $day = $hour = $minute = $second = '';
		$value_array = argenta_extra_parse_VC_datetime_to_array( $value );
		ob_start();

?>
		<div class="argenta_datetime_block">
			<input type="hidden" name="<?php echo argenta_extra_filter_string( $settings['param_name'], 'attr', '' ); ?>" class="wpb_vc_param_value" value="<?php echo argenta_extra_filter_string( $value, 'attr', '' ); ?>">
			<div class="row">
				<label>
					<div class="title"><?php _e( 'Year', 'argenta_extra' ); ?></div>
					<input class="year" type="number" data-target="year" value="<?php echo argenta_extra_filter_string( $value_array['year'], 'attr', '' ); ?>">
				</label>
				<span class="divider">/</span>
				<label>
					<div class="title"><?php _e( 'Month', 'argenta_extra' ); ?></div>
					<input type="number" max="12" min="1" data-target="month" value="<?php echo argenta_extra_filter_string( $value_array['month'], 'attr', '' ); ?>">
				</label>
				<span class="divider">/</span>
				<label>
					<div class="title"><?php _e( 'Day', 'argenta_extra' ); ?></div>
					<input type="number" max="31" min="1" data-target="day" value="<?php echo argenta_extra_filter_string( $value_array['day'] ); ?>">
				</label>
				<label class="hour">
					<div class="title"><?php _e( 'Hour', 'argenta_extra' ); ?></div>
					<input type="number" max="23" min="0" data-target="hour" value="<?php echo esc_attr( $value_array['hour'] ); ?>">
				</label>
				<span class="divider">:</span>
				<label>
					<div class="title"><?php _e( 'Minute', 'argenta_extra' ); ?></div>
					<input type="number" max="59" min="0" data-target="minute" value="<?php echo esc_attr( $value_array['minute'] ); ?>">
				</label>
				<span class="divider">:</span>
				<label>
					<div class="title"><?php _e( 'Second', 'argenta_extra' ); ?></div>
					<input type="number" max="59" min="0" data-target="second" value="<?php echo esc_attr( $value_array['second'] ); ?>">
				</label>
			</div>
		</div>
<?php

		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}