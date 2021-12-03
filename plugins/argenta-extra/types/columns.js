!function($){

	function argentaColumnsSerialize( $block ){
		var $hidden_input =  $block.find('.wpb_vc_param_value');
		var serialize_string = '';

		var large = $block.find('.arg-col-large').val();
		var medium = $block.find('.arg-col-medium').val();
		var small = $block.find('.arg-col-small').val();
		var extraSmall = $block.find('.arg-col-extra-small').val();
		
		serialize_string = large + '-' + medium + '-' + small + '-' + extraSmall;

		$hidden_input.val( serialize_string );
	}


	$(document).on( 'change', '.arg-col-large, .arg-col-medium, .arg-col-small, .arg-col-extra-small', function(){
		argentaColumnsSerialize( $(this).closest('.argenta_extra_columns_block') );
	});

}(window.jQuery);