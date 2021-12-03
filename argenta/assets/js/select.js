jQuery(function($){
	'use strict';

	var Select = (function(){
		function Select(){};

		Select.refresh = function(){
			Select.refreshTitles();

			$('[data-select]').each(function(){
				var select = $(this);

				// Refresh select list
				var list = select.find('.select-menu');
				if(select.find('select option').length){
					list.html('');
					select.find('select option').each(function(){
						var option = $(this);
						var li = document.createElement('li');
						$(li).html('<a>' + $(this).html() + '</a>');
						if(option.attr('data-select-href')){
							$(li).find('a').attr('href', option.attr('data-select-href'));
						}
						$(li).on('click', function(){
							select.find('select').val(option.val()).trigger('change');
							Select.refreshTitles(select);
						});
						list.append(li);
					});
				}
			});
		};

		Select.refreshTitles = function(select){
			if(select == undefined){
				$('[data-select] a span').each(function(){
					$(this).html($(this).parent().parent().find('select option:selected').html());
				});
			} else {
				select.find('a span').html(select.find('select option:selected').html());
			}
		};

		Select.toggle = function(){
			if($(this).attr('select-open') == 'true'){
				// Deactivate current select
				$(this).attr('select-open', 'false').removeClass('active').css('z-index', '20')
					.find('.select-title').removeClass('brand-color');
			} else {
				// Deactivate all selects
				Select.closeAll();

				// Activate current select
				$(this).attr('select-open', 'true').addClass('active').css('z-index', '40')
					.find('.select-title').addClass('brand-color');
				var selectMenu = $(this).find('.select-menu').css('margin-left', '');
				var left = $(window).width() - selectMenu.offset().left - selectMenu.outerWidth();
				if(left < 0){
					selectMenu.css('margin-left', left + 'px');				
				}
			}
		};

		Select.closeAll = function(){
			$('[data-select]').each(function(){
				$(this).attr('select-open', 'false').removeClass('active').css('z-index', '20')
					.find('.select-title').removeClass('brand-color');
			});
		}

		// Initialization
		Select.refresh();

		$(window).on('click', function(e){
			if($(e.target).attr('data-select')){
				Select.toggle.call($(e.target));
			} else if($(e.target).parents('.select').length){
				Select.toggle.call($(e.target).parents('.select').eq(0));
			} else {
				Select.closeAll();
			}
		});

		return Select;
	})();
});