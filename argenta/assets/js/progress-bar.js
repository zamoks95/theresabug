jQuery(function($){
	"use strict";

	$(window).on('load scroll', function(){
		$("[data-progress-bar-fill]").each(function(){
			var progressBar = $(this);
			var viewportHeight = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
			var scrollTop = $(document).scrollTop() + viewportHeight;

			if(scrollTop > progressBar.offset().top + progressBar.height()){
				var progressEnd = parseInt(progressBar.attr("data-progress-bar-fill"));
				progressBar.removeAttr("data-progress-bar-fill");
				progressBar.css("width", progressEnd + "%");

				for(var j = 0; j <= 20; j++){
					(function(count, progressBar, progressEnd){
						setTimeout(function(){
							var number = Math.round((progressEnd / 20) * count);
							progressBar.parent().parent().find(".progress-bar-percent .count").html(number);
						}, 50 * count);
					})(j, progressBar, progressEnd);
				}
			}
		});
	});
});