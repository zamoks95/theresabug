!function($) {

	$('#vc_ui-panel-edit-element').on('change', '.argenta_check_block input[type="checkbox"]', function(e){
		var $input = $(this);
		var $value_hidden_input = $(this).closest('.argenta_check_block').find('input.wpb_vc_param_value');
		if ($input.is(':checked')) {
			$value_hidden_input.val('1').change();
		} else {
			$value_hidden_input.val('0').change();
		}
	});

}(window.jQuery);