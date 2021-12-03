!function($) {

	function argentaDatetimeSerialize($block, $hidden_input) {
		var serialize_string = '';

		var year 		= $block.find('input[data-target="year"]').val();
		var month 	= $block.find('input[data-target="month"]').val();
		var day 		= $block.find('input[data-target="day"]').val();
		var hour 		= $block.find('input[data-target="hour"]').val();
		var minute 	= $block.find('input[data-target="minute"]').val();
		var second 	= $block.find('input[data-target="second"]').val();

		if (year == '') 	{ year = '0'; }
		if (month == '') 	{ month = '0'; }
		if (day == '') 		{ day = '0'; }
		if (hour == '') 	{ hour = '0'; }
		if (minute == '') { minute = '0'; }
		if (second == '') { second = '0'; }
		
		serialize_string += year + '/' + month + '/' + day + ' ' + hour + ':' + minute + ':' + second;

		$hidden_input.val(serialize_string);
	}

	$('#vc_ui-panel-edit-element').on('change', '.argenta_datetime_block input', function(e){
		var $closest = $(this).closest('.argenta_datetime_block');
		var $value_hidden_input = $closest.find('.wpb_vc_param_value');
		argentaDatetimeSerialize($closest, $value_hidden_input);
	});
}(window.jQuery);