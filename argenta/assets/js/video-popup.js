jQuery(function($){
	"use strict";

	$('body').on( 'click', '[data-video-module]', function() {
		// Create popup block
		var popup = $(document.createElement('div')).addClass('video-module-popup');	
		var popupVideo = $(document.createElement('div')).addClass('video-module-video');

		// Create popup close button
		var popupClose = $(document.createElement('div')).addClass('video-module-popup-close').on('click', function(){
			var popup = $(this).parent();
			popup.removeClass('open');
			setTimeout(function(){
				popup.remove();
			}, 300);
		}).html('<span class="ion-ios-close-empty"></span>');

		// Append video
		popupVideo.append( $(document.createElement("iframe")).attr({
			'src': $(this).attr('data-video-module') + "?autoplay=1",
			'allowfullscreen': 'true',
			'frameborder': '0'
		}) );

		// Append popup
		$(document.body).append( popup.append( popupClose ).append( popupVideo ) );

		// Activate popup
		popup.addClass('open');
	});
});