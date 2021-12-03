!function($) {

	$('#vc_ui-panel-edit-element .argenta_post_types_block select').select2({
		maximumSelectionLength: 24,
		placeholder: 'All categories'
	});

	$('#vc_ui-panel-edit-element').on('change', '.argenta_post_types_block select', function(e){
		var $input = $(this);
		var $value_hidden_input = $(this).closest('.argenta_post_types_block').find('input.wpb_vc_param_value');
		$value_hidden_input.val($input.val()).trigger('change');
	});

}(window.jQuery);
