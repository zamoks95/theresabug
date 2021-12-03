jQuery(function($){
	"use strict";

	// Quantities - plus, minus
	$("body").on("click", ".woo-quantity .plus", function(){
		var input = $(this).parent().find("input");

		if(input.attr("max") != input.attr("value")){
			input.attr("value", parseInt(input.attr("value")) + 1);
		}

		input.trigger('change');
	});

	$("body").on("click", ".woo-quantity .minus", function(){
		var input = $(this).parent().find("input");
		if(input.attr("min") != input.attr("value") && parseInt(input.attr("value")) > 1 ){
			input.attr("value", parseInt(input.attr("value")) - 1);
		}

		input.trigger('change');
	});

	// Fixed wishlist button in single page
	if($('.summary .yith-wcwl-add-to-wishlist').length) {
		$('.single_add_to_cart_button').after($('.summary .yith-wcwl-add-to-wishlist').clone());
		$('.summary .yith-wcwl-add-to-wishlist').eq(1).remove();
	}

	// Checkout right form
	$(window).on("load resize", function(){
		var orderReview = $("#order_review");
		if(orderReview){
			$(".wc-checkout-wrap").css("min-height", orderReview.outerHeight() + 180 + "px");
		}
	});

	// Reviews link
	$("a.woocommerce-review-link").on("click", function(){
		if ( $('#accordion-reviews').length ) {
			Accordion.toggle.apply($("#accordion-reviews"));
			$("html, body").animate({
				scrollTop: $(".accordion-box").offset().top
			}, 500);
		} else if ( $('#tab-reviews').length ) {
			Tab.toggle.apply($("#tab-reviews"));
			$("html, body").animate({
				scrollTop: $("#tab-reviews").offset().top - 60
			}, 500);
		} else {
			$("html, body").animate({
				scrollTop: $("#reviews").offset().top - 150
			}, 500);
		}
	});

	// Shop product gallery
	$("[data-product-item]").on('mouseenter', function(){
		if(!$(this).find(".wc-gallery-images .active").length){
			$($(this).find(".wc-gallery-images img")[0]).addClass("active");
		}
		var _this = $(this);
		this.interval = setInterval(function(){
			_this.find(".wc-gallery-images").each(function(){
				if($(this).find(".active").length){
					var current = $($(this).find(".active")[0]);
					current.removeClass("active");
					if(current.next().length){
						current.next().addClass("active");
					} else {
						$($(this).find("img")[0]).addClass("active");
					}
				} else {
					$($(this).find("img")[0]).addClass("active");
				}
			});
		}, 3500);
	});

	$("[data-product-item]").on('mouseleave', function(){
		clearInterval(this.interval);
	});


	// Single product slider

	setTimeout(function(){ // For slider height when image load

		if($('[data-wc-slider] img').length > 1) {	
			$('[data-wc-slider]').owlCarousel({
				items: 1,
				slideBy: 	1,
				nav: 		true,
				navText: 	[ '<span class="ion-ios-arrow-left"></span>', '<span class="ion-ios-arrow-right"></span>' ],
				dots: 		false,
				loop: 		false,
				autoHeight: true,
				autoplay: 	false,
				mouseDrag: 	false,
				touchDrag: 	false
			}).on('changed.owl.carousel', function(obj){
				var currentItem = obj.item.index;
				$('#product-thumbnails .image').removeClass('selected');
				$($('#product-thumbnails .image')[currentItem]).addClass('selected');
			});

			$('[data-wc-toggle-image]').on('click', function(){
				$('[data-wc-slider]').trigger('to.owl.carousel', [parseInt($(this).attr('data-wc-toggle-image')), 0, true]);
			});
		}

	}, 10);
});