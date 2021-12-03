!function($) {

	function argentaButtonSerialize($block, $hidden_input) {
		var serialize_string = '';

		var type = $block.find('select.type').val();
		var size = $block.find('select.size').val();
		var rounded = $block.find('input[name="rounded"]')[0].checked;
		var fullwidth = $block.find('input[name="fullwidth"]')[0].checked;

		var color = $block.find('input[name="color"]').val();
		var hoverColor = $block.find('input[name="hover-color"]').val();
		var textColor = $block.find('input[name="text-color"]').val();
		var textHoverColor = $block.find('input[name="text-hover-color"]').val();
		
		if( type ) {
			serialize_string += 'type=' + type;
		}
		if( size ) {
			serialize_string += '&size=' + size;
		}
		if( rounded ) {
			serialize_string += '&rounded=true';
		}
		if( fullwidth ) {
			serialize_string += '&fullwidth=true';
		}

		if( color ) {
			serialize_string += '&color=' + color;
		}
		if( hoverColor ) {
			serialize_string += '&hover-color=' + hoverColor;
		}
		if( textColor ) {
			serialize_string += '&text-color=' + textColor;
		}
		if( textHoverColor ) {
			serialize_string += '&text-hover-color=' + textHoverColor;
		}

		$hidden_input.val( serialize_string );
	}

	function argentaHideFields(){
		var buttonType = $('.argenta_button_block select.type').val(); 
		var size = $('.argenta_button_block .col-3.size')[0];
		var rounded = $('.argenta_button_block .col-3.rounded')[0];
		var fullwidth = $('.argenta_button_block .col-3.fullwidth')[0];
		var color = $('.argenta_button_block .col-3.button-color')[0];
		var hoverColor = $('.argenta_button_block .col-3.button-hover-color')[0];

		if( buttonType == 'arrow_link' ){
			$([size, rounded, fullwidth, color, hoverColor]).addClass('disabled');
		} else {
			$([size, rounded, fullwidth, color, hoverColor]).removeClass('disabled');
		}
	}

	vc.atts.colorpicker.init( {}, '.argenta_button_block' );

	$('#vc_ui-panel-edit-element').on(
		'change', 
		'.argenta_button_block input, .argenta_button_block select',
		function(e){
			var $closest = $(this).closest('.argenta_button_block');
			var $value_hidden_input = $closest.find('.wpb_vc_param_value');
			argentaButtonSerialize( $closest, $value_hidden_input );
			argentaHideFields();
		}
	);

	$('.argenta_button_block .wp-picker-clear').on('click', function(e){
		var $closest = $(this).closest('.argenta_button_block');
		var $value_hidden_input = $closest.find('.wpb_vc_param_value');
		argentaButtonSerialize( $closest, $value_hidden_input );
		argentaHideFields();
	});


	$('.argenta_button_block .wp-picker-container').on('click', function(){
		var holder = $(this).find('.wp-picker-holder');

		$(this).css('left', '');
		var diff = (holder.outerWidth() + $(this).parent().parent().position().left) - $('.argenta_button_block').outerWidth();

		if( diff > 0 ){
			$(this).addClass('invert-position');
			$(this).find('.wp-picker-input-wrap, .wp-picker-holder').css('left', -diff + 'px');
		} else {
			$(this).removeClass('invert-position');
		}
	});


	argentaHideFields();

}(window.jQuery);