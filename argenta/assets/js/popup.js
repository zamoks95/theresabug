jQuery(function($){
	'use strict';

	// Open popups
	$("body").on("click", "[data-popup-open]", function(){
		var popup = $("[data-popup='"+$(this).attr("data-popup-open")+"']");
		popup.addClass("active");
	});

	// Close popups
	$("body").on("click", "[data-popup-close]", function(){
		var popup = $("[data-popup='"+$(this).attr("data-popup-close")+"']");
		popup.removeClass("active");
	});
}