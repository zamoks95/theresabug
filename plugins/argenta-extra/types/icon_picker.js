jQuery(function($){

	$('.argenta_icon_picker_block').each( function(){
		var paramName = $(this).find('.wpb_vc_param_value');
		var select = $(this).find('.selected-icon');
		var content = $(this).find('.content');
		var list = $(this).find('.icons');
		var $categories = $(this).find('.icons > li');
		var $icons = $(this).find('.icons ul > li');
		var $search = $(this).find('input.search');
		var open = false;
		var categoryNow = 'all';

		var paginator = {
			itemsPerPage: 140,
			pageNow: 1,

			refresh: function(){
				var items = list.find('li:not(.category-hidden):not(.search-hidden)');
				items.each(function(i){
					var startPosition = paginator.pageNow * paginator.itemsPerPage;
					if(i > startPosition && i < startPosition + paginator.itemsPerPage) {
						$(this).removeClass('hidden');
					} else {
						$(this).addClass('hidden');
					}
				});
			},

			left: function(){
				this.pageNow--;
				if( this.pageNow < 1 ){
					this.pageNow = 1;
				}
				this.refresh();
			},

			right: function(){
				this.pageNow++;
				if((this.pageNow - 1) * this.itemsPerPage > items.length ){
					this.pageNow = Math.ceil( items.length / this.itemsPerPage );	
				}
				this.refresh();
			}
		};

		function toggleContent(){
			if(open){
				open = false;
				content.removeClass('open');
				select.find('.select i').removeClass('fa-angle-up').addClass('fa-angle-down');
			} else {
				open = true;
				content.addClass('open');
				select.find('.select i').removeClass('fa-angle-down').addClass('fa-angle-up');
			}
			//paginator.refresh();
		}
		select.on('click', toggleContent);


		// Search
		$search.on( 'input', function(){
			var value = $(this).val();
			$icons.removeClass( 'search-hidden' );

			if ( value.trim().length > 0 ) {
				$icons.not('[data-search*="' + value + '"]').addClass( 'search-hidden' );
			}

			$categories.removeClass( 'category-hidden' );

			$categories.each( function(){
				if ( $(this).find( 'li:not(.search-hidden)' ).length == 0 ) {
					$(this).addClass( 'category-hidden' );
				}
			});

			if ( content.find( '.categories' ).val() != 'all' ) {
				content.find( '.categories' ).val( 'all' );
			}

			//paginator.refresh();
		});

		// Categories
		$(this).find( '.categories' ).on( 'change', function(){
			var current_category = $(this).val();

			$categories.removeClass( 'category-hidden' );
			if ( current_category != 'all' ) {
				$categories.not('[data-category="' + current_category + '"]').addClass( 'category-hidden' );
			}

			$icons.removeClass( 'search-hidden' );
			$search.val( '' );

			$categories.each( function(){
				if ( $(this).find( 'li:not(.search-hidden)' ).length == 0 ) {
					$(this).addClass( 'category-hidden' );
				}
			});

			//paginator.refresh();
		});

		// Select icon
		list.find('li li').on('click', function(){
			var value = $(this).find('i').attr('class');

			paramName.val( value );
			paramName.change();

			list.find('.selected').removeClass('selected');
			$(this).addClass('selected');

			select.find('[data-selected-icon]').attr('class', value);

			toggleContent();
		});
	});

});