(function ($) {
	'use strict';

	function handleMobileHeader() {
		if ( $('#masthead').length ) {
			if ( $(window).width() <= 768 ) {
				$('#masthead').addClass('mobile-header');
				if ( $('#masthead .second-logo img').length ) {
					$('#masthead .first-logo').css('display', 'none');
					$('#masthead .second-logo').css('display', 'block');
				}
			} else {
				$('#masthead').removeClass('mobile-header');
				if ( $('#masthead .second-logo img').length ) {
					$('#masthead .first-logo').css('display', 'block');
					$('#masthead .second-logo').css('display', 'none');
				}
			}
		}
	}

	function handleHeaders() {
		var header = $('#masthead');

		// Subheader search
		$('[data-nav-search]').on('click', function(e) {
			e.preventDefault();
			$('.header-search').addClass('opened');
			setTimeout( function(){
				$('.header-search form input').trigger('focus');
			}, 100);
		});

		$('.header-search').on('click', function(e) {
			$('.header-search').removeClass('opened');
		});

		$('.header-search form').on('click', function(e) {
			e.stopPropagation();
		});

		// Fixed header
		if ( $('[data-header-fixed]').length ) {
			header.addClass( 'fixed' );
		}

		if ( $('.subheader .content').length ) {
			header.addClass( 'with-subheader' );
		}

		var transparentHeader = !( $('#masthead.header-2').length || $('#masthead.header-3').length || 
			$('#masthead.header-4').length || $('#masthead.header-6').length);

		if ( !$('.header-title').length && $('.header-cap').length ) {
			header.addClass( 'without-header-title' );
		}
	}

	function handleHeaderSize(){
		if ( ! $('#masthead.header-6').length ) {
			$('#masthead').css('width', $('#masthead').parent().outerWidth() + 'px');
			$('.subheader').css('width', $('#masthead').parent().outerWidth() + 'px');
		}
	}

	function handleFiveHeader(){
		if ( $('#masthead.header-5').length ) {	
			$('#mega-menu-wrap').css( 'margin-left', '' );
			var logo = $('#masthead .site-title');
			var nav = $('#mega-menu-wrap > ul > li');
			
			if ( $(window).width() > 768 ) {
				// Hidden logo for repeat calculate
				logo.css('display', 'none');
				// Insert logo in center
				if ( nav.length ) {
					var centerMenu = $('#primary-menu').width() / 2;
					var centerLi = 0, countWidth = 0;

					// Find middle li tag
					for( var i = 0; i < nav.length; i++){
						countWidth += nav.eq(i).outerWidth();
						if( countWidth >= centerMenu ) {
							centerLi = i;
							break;
						}
					}

					$(nav[centerLi]).addClass( 'without-divider' );
					logo.insertAfter( $(nav[centerLi]) );
				} else {
					$('#mega-menu-wrap').append(logo);
				}

				// Restore hidden logo
				logo.css('display', 'block');

				// Centered menu
				var left = ( $(window).width()/2) - (logo.offset().left + logo.outerWidth()/2);
				$('#mega-menu-wrap').css( 'margin-left', (left*2) + 'px' );
			} else {
				$('#masthead .site-branding').append(logo);
			}
		}
	}

	function handleHeaderTitle() {
		// Ttitle Parallax
		//if ( $('.header-title').attr('data-title-padding') ) { // #enable-future
		if ( $('.header-title h1').length ) {
			var scroll = $(document).scrollTop() / 3;
			if ( scroll > 200 ) {
				scroll = 200;
			}
			$('.header-title h1, .header-title p.subtitle').css({
				'transform': 'translate3d(0,' + (scroll) + 'px, 0)',
				'opacity': 1 - ( scroll / 200)
			});
		}
	}


	function handleFixedHeader() {
		var header = $('#masthead');
		var firstLogo = header.find('.first-logo');
		var secondLogo = header.find('.second-logo');

		// If is not mobile header
		if ( !$('#masthead.mobile-header').length ) {
			if ( $(document).scrollTop() > 100 ) {
				if ( !header.hasClass('header-fixed') ) {
					header.addClass( 'header-fixed no-transition' );
					if( $('#wpadminbar').length ) {
						header.css('top', $('#wpadminbar').outerHeight() + 'px');
					}
				}
				if( secondLogo.find('img').length ){
					firstLogo.css( 'display', 'none' );
					secondLogo.css( 'display', 'inline-block' );
				}
			} else {
				header.removeClass( 'header-fixed' );
				header.css('top', '');
				firstLogo.css( 'display', 'inline-block' );
				secondLogo.css( 'display', 'none' );
			}
			if ( $(document).scrollTop() > 250 ) { 
				header.removeClass('no-transition').addClass('showed');
			} else {
				header.removeClass('showed');
			}
		} else {
			$('#masthead.mobile-header').css('top', '0');
		}
	}


	function handleNavigations() {

		// Mobile menu
		var menuNow = 0;
		$('#hamburger-menu').on('click', function() {
			$('#site-navigation').addClass( 'active' );
			$('.close-menu').css( 'right', '0' );
		});
		$('#site-navigation .close, .close-menu, .mobile-header #site-navigation a[href^="#"]').on('click', function() {
			if ( menuNow != 0 ) {
				$('#mega-menu-sub-' + menuNow).removeClass( 'active' );
				$('#mega-menu-sub-' + menuNow).removeAttr( 'id' );
				menuNow--;
			} else {
				$('#site-navigation').removeClass( 'active' );
				$('.close-menu').css( 'right', '-32%' );
			}
		});
		$('.has-submenu > a').on( 'click touchstart', function(e) {
			if( $(window).width() <= 768 ){
				var menu = $(this).parent().find('.sub-nav > ul.sub-menu, > ul.sub-sub-menu');
				menuNow++;
				menu.addClass('active').attr('id', 'mega-menu-sub-' + menuNow);
				e.preventDefault();
			}
		});
		if ( $('#masthead nav > .mobile-wpml-select').length ) {
			$('#masthead nav > .mobile-wpml-select').insertAfter( $('#mega-menu-wrap > ul > li').last() );
		}

		// Mega Menu
		if ( $('#mega-menu-wrap').length ) {
			$('#mega-menu-wrap').accessibleMegaMenu({
				uuidPrefix: 'accessible-megamenu',
				menuClass: 'menu',
				topNavItemClass: 'nav-item',
				panelClass: 'sub-nav',
				panelGroupClass: 'sub-sub-menu',
				hoverClass: 'hover',
				focusClass: 'focus',
				openClass: 'open'
			}).on( 'megamenu:open', function(e, el) {
				if ( $(window).width() <= 768 ) return false;

				var $menu = $(this),
					$el = $(el),
					$subNav;

				if ( $el.is( '.main-menu-link.open' ) && $el.siblings( 'div.sub-nav' ).length>0) {
					$subNav = $el.siblings( 'div.sub-nav' );
				} else if ( $el.is( 'div.sub-nav' ) ) {
					$subNav = $el;
					$el = $subNav.siblings( '.main-menu-link' );
				} else {
					return true;
				}
				
				$subNav.removeAttr( 'style' ).removeClass( 'sub-nav-onecol' );

				var ul = $subNav.find('ul.sub-menu-wide');
				ul.each( function() {
					var $ul = $(this);
					var total_width = 16;

					$ul.find('> .sub-nav-item').each( function() {
						total_width += $(this).outerWidth() + 15;
					});

					$ul.innerWidth( total_width );
				});

				var headerLeft = 0;
				if ( $('#masthead.header-3').length )  {
					var headerWrap = $('#masthead.header-3 .header-wrap');
					headerLeft = $(window).width() - headerWrap.outerWidth() - headerWrap.offset().left;
				}
				var windowWidth = $(window).width();

				var subNavWidth = $subNav.find('> ul').width();
				var subNavMargin = 0;

				$subNav.css({'max-width': windowWidth});

				if ( subNavWidth > windowWidth) {
					$subNav.addClass( 'sub-nav-onecol' );

					subNavWidth = $subNav.width();
				}
				var elWidth = $el.outerWidth();
				var elOffsetLeft = $el.offset().left;
				var elOffsetRight = windowWidth - $el.offset().left - elWidth;

				if ( elOffsetLeft < 0 )  {
					subNavMargin = -(elOffsetLeft -subNavWidth/2 + elWidth/2) - headerLeft;
				}
				if ( elOffsetRight < ( subNavWidth - elWidth) )  {
					subNavMargin = -( subNavWidth - elWidth - elOffsetRight) - headerLeft;
				}

				if ( ul.outerWidth() >= windowWidth ){
					$subNav.find(' > ul').css('left', '');
					ul.innerWidth( windowWidth );
					subNavMargin = -$subNav.find(' > ul').offset().left;
				}

				$subNav.find('> ul').css( 'left', subNavMargin );

			});

			$('#mega-menu-wrap ul.sub-sub-menu').each( function() {
				if ( $(this).offset().left + $(this).outerWidth() > $(window).width() )  {
					$(this).addClass('menu-left');
				}
			});
		}

		// Fullscreen Mega Menu
		$('#hamburger-fullscreen-menu').on( 'click', function() {
			$('#fullscreen-mega-menu').addClass( 'open' );
		});

		$('#fullscreen-menu-close, #fullscreen-mega-menu-wrap a[href^="#"]').on( 'click', function() {
			$('#fullscreen-mega-menu').removeClass( 'open' );
		});

		if ( $('#fullscreen-mega-menu-wrap').length ) {
			$('#fullscreen-mega-menu-wrap').accessibleMegaMenu({
				uuidPrefix: 'accessible-megamenu',
				menuClass: 'menu',
				topNavItemClass: 'nav-item',
				panelClass: 'sub-nav',
				panelGroupClass: 'sub-sub-menu',
				hoverClass: 'hover',
				focusClass: 'focus',
				openClass: 'open'
			}).on( 'megamenu:open', function(e, el) {
				var menu = $(el).parent().find('.sub-nav');
				menu.css( 'top', ( $('#fullscreen-mega-menu-wrap ul.menu').height()/2 - menu.height()/2) + 'px' );
			});
		}
	}


	function handleFooter() {
		// Sticky
		var stickyFooter = $('.site-footer.sticky');
		if( stickyFooter.length ) {
			$('.site-content').css({
				'margin-bottom': (stickyFooter.outerHeight() - 1) + 'px',
				'position': 'relative',
				'z-index': '3'
			});
		}
	};

	function handleFooterSize() {
		var stickyFooter = $('.site-footer.sticky');
		if( stickyFooter.length ){
			stickyFooter.css({
				'width': stickyFooter.parent().outerWidth() + 'px',
				'left': stickyFooter.parent().offset().left + 'px',
			});
		}
	}


	function handleGoogleMaps() {
		if ( typeof google != 'undefined' && google.maps != undefined ) {
			var googleMapStyles = {
				default: [{'featureType':'water','elementType':'geometry','stylers':[{'color':'#e9e9e9'},{'lightness':17}]},{'featureType':'landscape','elementType':'geometry','stylers':[{'color':'#f5f5f5'},{'lightness':20}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#ffffff'},{'lightness':17}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#ffffff'},{'lightness':29},{'weight':0.2}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'color':'#ffffff'},{'lightness':18}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#ffffff'},{'lightness':16}]},{'featureType':'poi','elementType':'geometry','stylers':[{'color':'#f5f5f5'},{'lightness':21}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#dedede'},{'lightness':21}]},{'elementType':'labels.text.stroke','stylers':[{'visibility':'on'},{'color':'#ffffff'},{'lightness':16}]},{'elementType':'labels.text.fill','stylers':[{'saturation':36},{'color':'#333333'},{'lightness':40}]},{'elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'transit','elementType':'geometry','stylers':[{'color':'#f2f2f2'},{'lightness':19}]},{'featureType':'administrative','elementType':'geometry.fill','stylers':[{'color':'#fefefe'},{'lightness':20}]},{'featureType':'administrative','elementType':'geometry.stroke','stylers':[{'color':'#fefefe'},{'lightness':17},{'weight':1.2}]}],
				light_dream: [{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}],
				shades_of_grey: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}],
				paper: [{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"simplified"},{"hue":"#0066ff"},{"saturation":74},{"lightness":100}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"off"},{"weight":0.6},{"saturation":-85},{"lightness":61}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"simplified"},{"color":"#5f94ff"},{"lightness":26},{"gamma":5.86}]}],
				light_monochrome: [{"featureType":"administrative.locality","elementType":"all","stylers":[{"hue":"#2c2e33"},{"saturation":7},{"lightness":19},{"visibility":"on"}]},{"featureType":"landscape","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"simplified"}]},{"featureType":"poi","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":-2},{"visibility":"simplified"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"hue":"#e9ebed"},{"saturation":-90},{"lightness":-8},{"visibility":"simplified"}]},{"featureType":"transit","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":10},{"lightness":69},{"visibility":"on"}]},{"featureType":"water","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":-78},{"lightness":67},{"visibility":"simplified"}]}],
				lunar_landscape: [{"stylers":[{"hue":"#ff1a00"},{"invert_lightness":true},{"saturation":-100},{"lightness":33},{"gamma":0.5}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#2D333C"}]}],
				routexl: [{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-100},{"lightness":20}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-100},{"lightness":40}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-10},{"lightness":30}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":-60},{"lightness":10}]},{"featureType":"landscape.natural","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":-60},{"lightness":60}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"},{"saturation":-100},{"lightness":60}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"},{"saturation":-100},{"lightness":60}]}],
				flat_pale: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#6195a0"}]},{"featureType":"administrative.province","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"lightness":"0"},{"saturation":"0"},{"color":"#f5f5f2"},{"gamma":"1"}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"lightness":"-3"},{"gamma":"1.00"}]},{"featureType":"landscape.natural.terrain","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#bae5ce"},{"visibility":"on"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45},{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#fac9a9"},{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"labels.text","stylers":[{"color":"#4e4e4e"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#787878"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"transit.station.airport","elementType":"labels.icon","stylers":[{"hue":"#0a00ff"},{"saturation":"-77"},{"gamma":"0.57"},{"lightness":"0"}]},{"featureType":"transit.station.rail","elementType":"labels.text.fill","stylers":[{"color":"#43321e"}]},{"featureType":"transit.station.rail","elementType":"labels.icon","stylers":[{"hue":"#ff6c00"},{"lightness":"4"},{"gamma":"0.75"},{"saturation":"-68"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#eaf6f8"},{"visibility":"on"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#c7eced"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"lightness":"-49"},{"saturation":"-53"},{"gamma":"0.79"}]}],
				flat_design: [{"featureType":"all","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"simplified"},{"color":"#5b6571"},{"lightness":"35"}]},{"featureType":"administrative.neighborhood","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"on"},{"color":"#f3f4f4"}]},{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"weight":0.9},{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#83cead"}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"on"},{"color":"#ffffff"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"on"},{"color":"#fee379"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.highway.controlled_access","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"visibility":"simplified"},{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"color":"#7fc8ed"}]}]
			};
			var geocoder = new google.maps.Geocoder();

			var googleMapCreateMarker = function( map, addr, icon ) {
				geocoder.geocode( { 'address': addr }, function(result, status) {
					if (result.length) {
						map.setCenter(result[0].geometry.location );
						var marker = new google.maps.Marker({
							map: map,
							icon: icon,
							position: result[0].geometry.location
						});
					}
				});
			};

			$('[data-google-map]').each( function() {

				var markerLocations = $(this).find('[data-google-map-markers]').html().replace( new RegExp( /(<br>|<br \/>|<br\/>)/g ), '|' ).trim().split( '|' );
				var zoomEnable = false;
				if ( $(this).attr( 'data-google-map-zoom-enable' ).length ) {
					zoomEnable = JSON.parse( $(this).attr( 'data-google-map-zoom-enable' ) );
				}

				var map_style = false;
				if ( $(this).attr( 'data-google-map-style' ) ) {
					map_style = googleMapStyles[ $(this).attr( 'data-google-map-style' ) ];
				}

				var map = new google.maps.Map( $(this).find('.google-maps-wrap')[0], {
					scrollwheel: false,
					zoom: parseInt( $(this).attr( 'data-google-map-zoom' ) ),
					zoomControl: zoomEnable,
					styles: map_style,
				});

				if ( markerLocations == '' || markerLocations == 'true' ) { 
					markerLocations = ['New York'];
				}

				for(var i = 0; i < markerLocations.length; i++) {
					googleMapCreateMarker( map, markerLocations[i], $(this).attr( 'data-google-map-marker' ) );
				}	
			});
		}
	}


	function handlePageScroll() {
		$('[data-page-scroll]').each( function() {
			$(this).onepage_scroll({
			   sectionContainer: "section",
			   easing: "ease",
			   animationTime: 1000,
			   pagination: true,
			   updateURL: false,
			   loop: false,
			   keyboard: true,
			   responsiveFallback: false,
			   direction: "vertical"
			});

			$(this).find('section').each( function() {
				$(this).css( 'background-image', 'url( ' + $(this).attr( 'data-img' ) + ' )' );
			});
		});
	}


	function handlePortfolio() {
		// Simple slider
		if ( $('#slider-portfolio').length > 0) {
			$('#slider-portfolio').owlCarousel({
				items: 3,
				responsive: {
					979:{
						items: 3
					},
					768:{
						items: 2
					},
					0:{
						items: 1
					}
				},
				nav: true,
				loop: true,
				navText: [ '<span class="ion-ios-arrow-left"></span>', '<span class="ion-ios-arrow-right"></span>' ],
				autoHeight: true,
				autoplay: false
			});
		}

		// Fullscreen slider
		if ( $('#slider-portfolio-full').length > 0 ) {
			$('#slider-portfolio-full').owlCarousel({
				items: 1,
				nav: false,
				dots: true,
				loop: true,
				autoplay: false
			});
		}

		// Portfolio 8 type description
		$('.portfolio-eight .portfolio-description').on('click', function() {
			var description = $(this);

			if ( !description.attr('data-open') ) {
				description.attr('data-open', 'true');
				// Change toggle icon
				description.find('.icon-toggle').removeClass('ion-plus').addClass('ion-minus');

				// Get end sizes
				description.addClass('no-transition open');
				description.css({
					'height': 'auto',
					'width': '1010px'
				});
				var endHeight = description.outerHeight();

				// Reset
				description.removeClass('open').css({
					'height': '',
					'width': ''
				});

				// Animate
				setTimeout( function() {
					description.removeClass('no-transition').addClass('open').css({
						'height': endHeight + 'px',
						'width': '1010px'
					});
				}, 30);
			}
		});

		$('.portfolio-eight .portfolio-description .icon-toggle').on('click', function() {
			var description = $(this).parent().parent();

			if ( description.attr('data-open') ) {
				// Change toggle icon
				description.find('.icon-toggle').removeClass('ion-minus');
				description.find('.icon-toggle').addClass('ion-plus');

				// Reset
				description.css({
					'height': '',
					'width': ''
				});

				setTimeout( function() {
					description.removeClass('open');
					description.removeAttr('data-open');
				}, 30);
			}
		});
	}

	function handleEightPortfolio() {
		if ( $('.portfolio-eight').length ) {
			$('.portfolio-container').css('height', ( $(window).height() - $('.portfolio-container').offset().top ) + 'px');
		}
	}


	function handleParallax() {
		var contentScroll = $(document).scrollTop();
		var wndHeight = $(window).height();

		$('[data-parallax-bg]').each( function() {
			var parallaxTop = $(this).offset().top;
			var parallaxHeight = $(this).outerHeight();
			var parallaxWidth = $(this).outerWidth();

			// If parallax block on screen
			if( parallaxTop <= contentScroll + wndHeight && parallaxTop + parallaxHeight >= contentScroll ){

				var speed = parseFloat( $(this).attr( 'data-parallax-speed' ) ) * 100;
				var bg = $(this).find('.parallax-bg');

				var percent = (-parallaxTop + contentScroll + wndHeight) / (parallaxHeight + wndHeight);
				var offset = -(percent * 2) * speed;

				if( $(this).attr('data-parallax-bg') == 'vertical' ){
					bg.css( 'transform', 'translate3d(0, ' + offset + 'px, 0)' );
				} else {
					bg.css( 'transform', 'translate3d(' + offset + 'px, 0, 0)' );
				}
			}
		});
	};


	function handleSplitboxParallax() {
		var processSplitParallax = function(side, num){
			if ( $(this).attr( 'data-parallax-' + side ) ) {
				$(this).find('.split-box-wrap').eq(num).attr({
					'data-parallax-bg': $(this).attr( 'data-parallax-' + side ),
					'data-parallax-speed': $(this).attr( 'data-parallax-speed-' + side )
				});
			} else {
				$(this).find('.split-box-wrap').eq(num).find('.parallax-bg').css({
					'height': '100%',
					'width': '100%'
				});
			}	
		};

		$('.split-box').each( function() {
			processSplitParallax.call(this, 'left', 0);
			processSplitParallax.call(this, 'right', 1);
		});
	}


	function handleSliders() {
		$('[data-slider]').each( function() {
			$(this).owlCarousel({
				items: parseInt( $(this).attr( 'data-items-desktop' ) ),
				responsive: {
					979:{
						items: parseInt( $(this).attr('data-items-desktop') ),
						nav: JSON.parse( $(this).attr('data-nav') )
					},
					768:{
						items: parseInt( $(this).attr('data-items-tablet') ),
						nav: JSON.parse( $(this).attr('data-nav') )
					},
					0:{
						items: parseInt( $(this).attr('data-items-mobile') ),
						nav: JSON.parse( $(this).attr('data-nav') )
					}
				},
				slideBy: 		$(this).attr('data-slide-by'),
				dotsEach: 		parseInt( $(this).attr('data-dots-each') ),
				nav: 			JSON.parse( $(this).attr('data-nav') ),
				navRewind: 		true,
				navText: 		[ '<span class="ion-ios-arrow-left"></span>', '<span class="ion-ios-arrow-right"></span>' ],
				navSpeed: 		350,
				dotsSpeed: 		500,
				dots: 			JSON.parse( $(this).attr('data-pagination') ),
				loop: 			JSON.parse( $(this).attr('data-loop') ),
				autoHeight: 	true,
				autoplay: 		JSON.parse( $(this).attr('data-autoplay') ),
				autoplayTimeout: parseInt( $(this).attr('data-autoplay-time') ) * 1000,
				autoplayHoverPause: JSON.parse( $(this).attr('data-stop-hover') ),
				autoplaySpeed:  350,
			});
		});
		$('[data-slider-simple]').each( function() {
			$(this).owlCarousel({
				items: 1,
				nav: true,
				navRewind: true,
				navText: [ '<span class="ion-ios-arrow-left"></span>', '<span class="ion-ios-arrow-right"></span>' ],
				dots: false,
				loop: true,
				autoHeight: true,
			});
		});
	}


	function handleSplitScreens(){
		$('[data-arg-splitscreen]').each(function(){
			if( $(window).width() > 768 ) {

				var navigation = !!$(this).attr('data-arg-splitscreen-nav');

				// If one element
				if( $(this).find('> .ms-right > .ms-section').length == 1 ){
					navigation = false;
				}

				$(this).multiscroll({
					verticalCentered: true,
					scrollingSpeed: 0,
					menu: true,
					sectionsColor: [],
					navigation: navigation,
					navigationPosition: 'right',
					navigationColor: '#000',
					navigationTooltips: [],
					loopBottom: false,
					loopTop: false,
					css3: true,
					paddingTop: 0,
					paddingBottom: 0,
					normalScrollElements: null,
					keyboardScrolling: true,
					touchSensitivity: 5,

					// Custom selectors
					sectionSelector: '.ms-section',
					leftSelector: '.ms-left',
					rightSelector: '.ms-right',

					//events
					onLeave: function(index, nextIndex, direction){
					},
					afterLoad: function(anchorLink, index){},
					afterRender: function(){},
					afterResize: function(){},
				});

				$(this).on('wheel mousewheel', function(e){
					if( window.AOS ){
						setTimeout( AOS.refresh, 400 );
					}
				});

				$(this).addClass('no-transition');
				var self = $(this);

				setTimeout(function(){
					// Fixed right column
					self.find('.ms-right').css('right', '0px');

					self.multiscroll.moveTo(1);
					setTimeout(function(){
						self.removeClass('no-transition');
					}, 50);
				}, 50);
			} else {
				var leftSections = $(this).find('.ms-left .ms-section');
				console.log($(this).find('.arg-splitscreen'));
				$('.arg-splitscreen').css('height', 'auto');

				$(this).find('.ms-right .ms-section').each(function(i){
					$(this).css('padding-top', '100%');
					$(this).insertAfter( leftSections.eq(i) );
				});
			}
		});
	}

	function handleSplitScreensSize(){
		$('[data-arg-splitscreen]').each(function(){
			var height = $(window).height();
			var headerCap = $('.header-cap');
			var footer = $('#colophon');
			var footerLang = $('#lang_sel_footer');

			if(	headerCap.length ) {
				height -= headerCap.outerHeight();
			}
			if( footer.length ) {
				height -= footer.outerHeight();
			}
			if( footerLang.length ) {
				height -= footerLang.outerHeight();
			}

			$(this).css('height', height + 'px');
		});
	}


	function handleVideoBackground(){
		$('[data-arg-video-bg]').each(function(){
			var videoLink = $(this).attr('data-arg-video-bg');
			var iframe = $(document.createElement('iframe'));

			iframe.addClass('arg-video-bg').attr('src', videoLink);
			$(this).append(iframe);
		});
	}


	function handleStretchContent(){

		$('[data-argenta-stretch-content], .alignfull').each( function() {
			if ( !$(this).parents('.page-with-right-sidebar') ) {

				$(this).css( 'margin-left', '0' );
				$(this).css({
					'width': $(window).width() + 'px',
					'margin-left': -$(this).offset().left + 'px'
				});
			}
		});

		// Six header, stretch content
		if ( $('#masthead.header-6').length ) {
			$('[data-vc-stretch-content="true"], [data-argenta-stretch-content="true"]').each( function() {
				$(this).css( 'padding-left',  ( $(window).width() <= 768 ) ? '0px' : '280px' );
			});
		}

		if( $('.boxed-container').length ){
			$('[data-vc-stretch-content="true"], [data-argenta-stretch-content="true"]').each( function() {
				$(this).css('margin-left', '0');
				var self = $(this);

				setTimeout(function(){
					self.css({
						'width': ($("#content").outerWidth()) + 'px',
						'left': '0px',
						'margin-left': ($('#content').offset().left - self.offset().left) + 'px',
					});
				}, 0);
			});
		}
	}


	function handleAOS(){
		if ( typeof(AOS) != 'undefined' ) {
			setTimeout(function(){
				AOS.init();
			}, 100);
		}
	}
	

	$(window).on('load', function() {

		// Header
		handleHeaders();
		if ( $('[data-header-fixed]').length ) {
			handleFixedHeader();
		}

		handleHeaderSize();
		handleMobileHeader();
		handleHeaderTitle();
		handleFiveHeader();
		handleNavigations();
		handleFooter();
		handleFooterSize();
		handlePortfolio();
		handleSplitboxParallax();
		handleGoogleMaps();
		handlePageScroll();
		handleStretchContent();
		handleEightPortfolio();
		handleVideoBackground();
		if ( $('[data-header-fixed]').length ) {
			handleFixedHeader();
		}

		if( $.fn.multiscroll ) {
			handleSplitScreens();
			if ( $(window).width() > 768 ) {
				handleSplitScreensSize();	
			}
		}

		// Scroll top button
		$('.scroll-top').on('click', function() {
			$('html, body').animate({ scrollTop: 0 }, 500);
			return false;
		});

		// Tooltips
		$('.tooltip').each( function() {
			var tooltip = $(this).find('.tooltip-top, .tooltip-bottom');
			if( tooltip.length && $(this).width() < tooltip.width() ){
				tooltip.css( 'margin-left', (-(tooltip.width()/2) + $(this).width()/2 ) + 'px' );
			}
		});

		// Message boxes
		$('body').on('click', '.message-box .close', function(){
			$(this).parent().slideUp({duration: 300, queue: false}).fadeOut(300);
			var self = $(this);
			setTimeout(function(){
				self.remove();
			}, 350);
		});

		// Blog layout
		if( $('.blog-posts-masonry').length ){
			setTimeout(function(){
				$('.blog-posts-masonry').masonry({
					percentPosition: true,
					itemSelector: '.blog-post-masonry',
					columnWidth: '.grid-item'
				});
				setTimeout(function(){
					handleAOS();
				}, 50);
			}, 50);
		} else {
			handleAOS();
		}

		// Close preloader
		$('#page-preloader').addClass( 'closed' );

		// Contact form button
		$('.contact-form[data-button-classes]').each(function(){
			var submit = $(this).find('input[type="submit"]');
			if( submit ){
				var btn = $('<button class="btn"><span class="btn-load"></span>' + submit.attr('value') + '</button>');
				submit.replaceWith( btn );
			}
			$(this).find('.btn').addClass( $(this).attr('data-button-classes') );
			$(this).find('.btn-link').append( $(document.createElement('span')).addClass('icon-arrow ion-ios-arrow-thin-right') );
		});

		// Filtering initialization
		if( $('div[data-filter="portfolio"]').length ){
			$('[data-isotope-grid]').isotope({
				percentPosition: true,
				masonry: { 
					columnWidth: '.grid-item'
				} 
			});

			$('div[data-filter="portfolio"] a').on("click", function(){
				$(this).closest('div[data-filter="portfolio"]').find(".active").removeClass("active");
				$(this).addClass("active");
				$('[data-isotope-grid]').isotope({
					filter: $(this).attr("data-isotope-filter")
				});
				if( window.AOS ){
					setTimeout( AOS.refresh, 600 );
				}
				return false;
			});
		}

		// Fixed pricing tables
		$('.pricing-table-labels').each(function(){
			var row = $(this).parents('.vc_row').eq(0);
			var table = row.find('.pricing-table, .pricing-table-best').eq(1);

			// Calculate position
			$(this).css({
				'padding-top': (table.find('.list-box, .list-box-clear').eq(0).offset().top - table.offset().top - $(this).find('h3').outerHeight() - 28) + 'px'
			});

			// Calculate sizes
			$(this).find('li').each(function(i){
				var max = 0;
				row.find('.pricing-table, .pricing-table-best').each(function(){
					var h = $(this).find('li').eq(i).outerHeight();
					if ( h > max ) {
						max = h;
					}
				});
				row.find('.pricing-table, .pricing-table-best').each(function(){
					$(this).find('li').eq(i).css('height', max + 'px');
				});
			});
		});

		// Parallax initialization
		$('[data-parallax-bg]').each( function() {
			var bg = $(this).find('.parallax-bg');
			var speed = $(this).attr( 'data-parallax-speed' );

			if( $(this).attr('data-parallax-bg') == 'vertical' ){
				$(this).find('.parallax-bg').css( {
					height: ( $(this).outerHeight() + speed * 200 ) + 'px'
				});
			} else {
				$(this).find('.parallax-bg').css( {
					width: ( $(this).outerWidth() + speed * 200 ) + 'px'
				});
			}
			bg.addClass( ( $(this).attr('data-parallax-bg') == 'vertical' ) ? '' : 'horizontal' );
		});

		// Fixed contact forms loader
		$('.contact-form form').on('submit', function(){
			$(this).find('.btn-load').css({
				'width': '21px',
				'margin-right': '6px'
			});
		});
		$(document).on('spam.wpcf7 invalid.wpcf7 spam.wpcf7 mailsent.wpcf7 mailfailed.wpcf7', function(e){
			var form = e.target;
			$(form).find('.btn-load').css({
				'width': '0px',
				'margin-right': '0px'
			});
		});

		handleParallax();
		handleSliders();
	});


	$(window).on( 'scroll', function() {
		if( window.requestAnimationFrame ) {
			window.requestAnimationFrame(function(){
				handleHeaderTitle();
				handleParallax();
			});
		} else {
			handleHeaderTitle();
			handleParallax();
		}

		if ( $('[data-header-fixed]').length ) {
			handleFixedHeader();
		}
		
		// Scroll top button
		if ( $(window).scrollTop() > 800 ) {
			$('#page-scroll-top, #purchase-link').fadeIn(600);
		} else {
			$('#page-scroll-top, #purchase-link').fadeOut(600);
		}
	});

	$(window).on('resize', function(){

		handleHeaderSize();
		handleHeaderTitle();
		handleMobileHeader();
		handleParallax();
		handleStretchContent();
		handleEightPortfolio();
		handleFiveHeader();

		if( $('[data-header-fixed]').length ){
			handleFixedHeader();
		}

		handleFooterSize();

		if( $.fn.multiscroll ) {
			if ( $(window).width() > 768 ) {
				handleSplitScreensSize();	
			}
		}
	});

})(jQuery);