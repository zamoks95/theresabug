jQuery(function($){
	'use strict';

	var counterProcess = function(){
		$('[data-counter]').each(function(){
			var counter = $(this);
			var viewportHeight = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
			var scrollTop = $(document).scrollTop() + viewportHeight;

			if(scrollTop > counter.offset().top + counter.height()){
				var countEnd = parseInt(counter.attr('data-counter').replace(/\s/g, ''));
				counter.removeAttr('data-counter');

				for(var j = 0; j <= 20; j++){
					(function(count, counter, countEnd){

						setTimeout(function(){
							var number = Math.round((countEnd / 20) * count);

							counter.find('.count').html(number);
						}, 50 * count);

					})(j, counter, countEnd);
				}
			}
		});
	};

	$(window).on('load resize', function(){
		counterProcess();
	});

	$(document).on('scroll', counterProcess);
});