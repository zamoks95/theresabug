!function($) {

    function argentaTypographySerialize($block, $hidden_input) {
        var serialize_string = '';

        var font_size = $block.find('input[data-target="font-size"]').val();
        var line_height = $block.find('input[data-target="line-height"]').val();
        var letter_spacing = $block.find('input[data-target="letter-spacing"]').val();
        var weight = $block.find('select[data-target="weight"]').val();
        var italic = $block.find('input[data-target="italic"]').prop('checked');
        var normal = $block.find('input[data-target="normal"]').prop('checked');
        var underline = $block.find('input[data-target="underline"]').prop('checked');
        var use_custom_font = $block.find('input[data-target="use-custom-font"]').prop('checked');
        var custom_font = $block.find('select[data-target="custom-font"]').val();
        
        if (font_size) { serialize_string += 'font_size~' + font_size + '||'; }
        if (line_height) { serialize_string += 'line_height~' + line_height + '||'; }
        if (letter_spacing) { serialize_string += 'letter_spacing~' + letter_spacing + '||'; }
        if (italic) { serialize_string += 'italic~1||'; }
        if (normal) { serialize_string += 'normal~1||'; }
        if (weight) { serialize_string += 'weight~' + weight + '||'; }
        if (underline) { serialize_string += 'underline~1||'; }
        if (use_custom_font) { serialize_string += 'use_custom_font~1||'; }
        if (use_custom_font && custom_font) {
            serialize_string += 'custom_font~' + custom_font + '||';
        }

        $hidden_input.val((serialize_string != '') ? serialize_string.substring(0, serialize_string.length-2) : '');
    }

    $('#vc_ui-panel-edit-element').on('change', '.argenta_typography_block input, .argenta_typography_block select', function(e){
        var $closest = $(this).closest('.argenta_typography_block');
        var $value_hidden_input = $closest.find('.wpb_vc_param_value');
        argentaTypographySerialize($closest, $value_hidden_input);
    });


    $('#vc_ui-panel-edit-element').on('change', '.argenta_typography_block input[data-target="use-custom-font"]', function(e){
        if ($(this).prop('checked')) {
            $(this).closest('.argenta_typography_block').find('.custom-font-panel').show();
        } else {
            $(this).closest('.argenta_typography_block').find('.custom-font-panel').hide();
        }
    });
}(window.jQuery);