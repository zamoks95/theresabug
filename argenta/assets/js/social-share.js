jQuery(function($){
	'use strict';

	$(".socialbar:not(.new-tab-links) a").on("click", function(e){
		e.preventDefault();
		window.open(this.href, '', 'width=800,height=300,resizable=yes,toolbar=0,status=0');
	});
});