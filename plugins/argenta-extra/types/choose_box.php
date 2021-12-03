<?php

	/**
	* Visual Composer Argenta Choose box custom type
	*/
	if ( function_exists ( 'vc_add_shortcode_param' ) ) {
		vc_add_shortcode_param( 'argenta_choose_box', 'argenta_extra_choose_box_settings_field', plugins_url( 'choose_box.js' , __FILE__ ) );
	}

	function argenta_extra_choose_box_settings_field( $settings, $value ) {

		if ( empty( $value ) ) {
			$value = $settings['value'][0]['key'];
		} elseif( is_array( $value ) ) {
			$value = $value['key'];
		}

		ob_start();

?>
		<div class="argenta_choose_box_block">
			<input type="hidden" name="<?php echo esc_attr( $settings['param_name'] ); ?>"
				class="wpb_vc_param_value <?php echo esc_attr( $settings['param_name'] ) . esc_attr( $settings['type'] ) . '_field'; ?>"
				value="<?php echo esc_attr( $value ); ?>">
			<ul>
				<?php foreach ($settings['value'] as $option) { ?>
					<li>
						<input <?php if ($option['key'] == $value) echo 'checked="checked"'; ?> type="radio" class="wpb_vc_param_value" data-value="<?php echo $option['key']; ?>">
						<label style="background-image: url('<?php echo $option['icon']; ?>');"><div class="argenta_choose_box_title"><?php echo $option['title']; ?></div></label>
					</li>
				<?php } ?>
			</ul>
		</div>
<?php

		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}