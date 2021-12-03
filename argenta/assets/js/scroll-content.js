jQuery(function($){
	'use strict';

	var ScrollContent = (function(){
		function Scroll(){};
	
		Scroll.init = function(){
			$('[data-content-scroll]').each(function(){
				var parent = $('#' + $(this).attr('data-content-scroll'));
	
				$(this).attr('data-scroll-start-top', $(this).offset().top);
				$(this).css({
					'position': 'absolute',
					'top': ($(this).offset().top - parent.offset().top) + 'px',
					'left': $(this).offset().left - parent.offset().left + 'px'
				});
			});
	
			ScrollContent.refresh();
	
			$(window).on('scroll', Scroll.refresh).on('resize', Scroll.resize);
		};
	
		Scroll.resize = function(){
			$('[data-content-scroll]').each(function(){
				var parent = $('#'+ $(this).attr('data-content-scroll'));
				$(this).css('position', 'static');
				var _this = this;
				clearTimeout(parseInt($(this).attr('data-scroll-timer')));
				var timer = setTimeout(function(){
					$(_this).attr('data-scroll-start-top', $(_this).offset().top);
					$(_this).css({
						'position': 'absolute',
						'top': ($(_this).offset().top - parent.offset().top) + 'px',
						'left': $(_this).offset().left - parent.offset().left + 'px'
					});
					Scroll.refresh();
				}, 30);
				$(this).attr('data-scroll-timer', timer);
			});
		};
	
		Scroll.refresh = function(){
			$('[data-content-scroll]').each(function(){
				var parent = $('#'+$(this).attr('data-content-scroll'));
				var scroll = $(window).scrollTop();
				var top = parseInt($(this).attr('data-scroll-start-top'));
				var minWidth = 768;
				var header = $('#masthead.fixed');
				var subheader = $('.subheader');
				if($(this).attr('data-content-scroll-min-width')){
					minWidth = parseInt($(this).attr('data-content-scroll-min-width'));
				}

				if(header.length){
					scroll += header.outerHeight();

					if(subheader.length){
						scroll += subheader.outerHeight();
					}
				}
	
				if($(window).width() > minWidth && $(this).outerHeight() < parent.outerHeight()){
					if(scroll > top){
						var headerTop = 0;
						if(header.length){
							headerTop += header.outerHeight(); 

							if(subheader.length){
								headerTop += subheader.outerHeight(); 
							}
						}
						$(this).css({
							'max-width': $(this).outerWidth() + 'px',
							'position': 'fixed',
							'top': headerTop + 'px',
							'left': $(this).offset().left + 'px'
						});
					} else {
						$(this).css({
							'max-width': 'none',
							'position': 'relative',
							'top': '0px',
							'left': '0px'
						});
					}
					if(scroll + $(this).outerHeight() > parent.offset().top + parent.outerHeight()){
						var portfolioTop = parent.outerHeight() - $(this).outerHeight();
						$(this).css({
							'max-width': 'none',
							'position': 'relative',
							'top': portfolioTop + 'px',
							'left': '0' + 'px'
						});
					}
				} else {
					$(this).css({
						'max-width': 'none',
						'position': 'relative',
						'top': '0px',
						'left': '0px'
					});
				}
			});
		};
	
		return Scroll;
	})();
	
	
	$(window).on('load', ScrollContent.init);
});