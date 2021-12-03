jQuery(function($) {
	'use strict';

	window.Tab = function() {};

	Tab.toggle = function(){
		// if this not active tab
		if ( !$(this).attr('data-tab-box-active') ) {
			var tabBox = $($(this).parent().parent());
			var tabButtons = $($(this).parent());
			var oldItem = tabBox.find('[data-tab-box-active]');

			// reset active tab button
			var activeTabButton = tabButtons.find('[data-tab-box-active]');
			activeTabButton.removeClass('tab-box-btn-active').removeAttr('data-tab-box-active');

			// reset active tab content
			var activeTabItem = tabBox.find('.tab-box-item[data-tab-box-active]');
			activeTabItem.removeClass('tab-box-active').removeAttr('data-tab-box-active');

			// make this tab active
			$(this).addClass('tab-box-btn-active').attr('data-tab-box-active', 'true');

			var newItem = $(tabBox.find('.tab-box-item')[parseInt($(this).attr('data-tab-box-item'))-1]);

			newItem.addClass('tab-box-active').attr('data-tab-box-active', 'true');
		}
	};
	$('body').on('click', '[data-tab-box] .tab-box-btn', Tab.toggle);


	$('[data-tab-box]').each( function() {
		var tabButtons = $(this).find('[data-tab-box-buttons]');

		// Generate tab buttons
		$(this).find('[data-tab-box-content] [data-tab-box-title]').each( function(i) {
			var div = document.createElement('div');
			$(div).addClass('tab-box-btn').attr('data-tab-box-item', i + 1).html($(this).attr('data-tab-box-title'));
			tabButtons.append(div);
		});

		// Set first active if it need
		if( !$(this).find('[data-tab-box-active]').length ) {
			$(this).find('.tab-box-btn').eq(0).addClass('tab-box-btn-active').attr('data-tab-box-active', 'true');
			$(this).find('.tab-box-item').eq(0).addClass('tab-box-active').attr('data-tab-box-active', 'true');
		}
	});
});