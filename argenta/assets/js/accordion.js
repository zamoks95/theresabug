jQuery( function($) {
	'use strict';

	window.Accordion = function() {};

	Accordion.toggle = function() {
		if( !$($(this).parent() ).attr('data-active') ) {
			var accordion = $($(this).parent().parent() );
			// Change control icons
			$(this).find('.control span').removeClass('ion-plus').addClass('ion-minus');
			var icon = $(accordion.find('.active .control span')[0] );
			icon.removeClass('ion-minus');
			icon.addClass('ion-plus');

			// Animate accordion
			$(accordion.find('.active .content .wrap')[0] ).css('display', 'block').slideUp('fast');
			var accordions = $($(this).parent().parent() ).find('[data-accordion-item]');
			for( var i = 0; i < accordions.length; i++ ) {
				$(accordions[i] ).removeClass('active').find('.buttons, .buttons h5').removeClass('brand-color');
				$(accordions[i] ).removeAttr('data-active');
			}
			$( $(this).parent() ).attr('data-active', 'true');
			$( $(this).parent() ).addClass('active').find('.buttons, .buttons h5').addClass('brand-color');
			$(accordion.find('.active .content .wrap')[0] ).slideDown('fast');
		}
	}

	$('body').on('click', '[data-accordion] .buttons', Accordion.toggle);

	$('[data-accordion-item]').each( function() {
		if( !$(this).attr('data-active') ) {
			$(this).find('.wrap').slideUp(0);
		}
	});

	$('[data-accordion]').each( function() {
		if( $(this).find('[data-active]').length <= 0 ) {
			var item = $($(this).find('[data-accordion-item]')[0] );
			var icon = $(item.find('.control span')[0] );
			item.attr('data-active', 'true');
			item.addClass('active').find('.buttons, .buttons h5').addClass('brand-color');
			icon.removeClass('ion-plus');
			icon.addClass('ion-minus');
			$(item.find('.content .wrap')[0] ).css('display', 'block');
		}
	});
});