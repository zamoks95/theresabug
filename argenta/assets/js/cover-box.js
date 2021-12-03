jQuery(function($){
	'use strict';

	$(window).on('load resize', function(){
		$('[data-cover-box]').each(function(){
			$(this).find('[data-cover-box-image]').each(function(){
				$(this).next().find('> .content-wrap, > .inner').css('width', $(this).outerWidth() + 'px');
			});

			// Remove attributes
			$(this).find('[data-cover-box-active][data-cover-box-content]').css({'max-width': 0});
			$(this).find('[data-cover-box-active]').removeAttr('data-cover-box-active');

			// Set attributes on last child
			var content = $(this).find('[data-cover-box-content]').last();
			var image = $(this).find('[data-cover-box-image]').last();
			content.attr('data-cover-box-active', 'true');
			image.attr('data-cover-box-active', 'true');
			content.css('max-width', image.outerWidth() + 'px');

			// Set content equal height
			$(this).find('[data-cover-box-content]').css('height', image.height() + 'px');
		});
	});

	var coverActive = false;

	$('body').on('mouseenter', '[data-cover-box] > [data-cover-box-image]', function(){
		var image = $(this);
		if(!image.attr('data-cover-box-active') && !coverActive){
			coverActive = true;
			image.parent().find('[data-cover-box-active][data-cover-box-content]').css({'max-width': 0});
			image.parent().find('[data-cover-box-active]').removeAttr('data-cover-box-active');

			image.attr('data-cover-box-active', 'true');
			image.next().attr('data-cover-box-active', 'true');
			
			setTimeout(function(){
				image.next().css({'max-width': image.outerWidth()});
				coverActive = false;
			}, 30);
		}
	});
});
