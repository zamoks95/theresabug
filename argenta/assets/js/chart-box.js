jQuery(function($){
	"use strict";

	var ChartBox = (function(){
		function ChartBox(){};

		ChartBox.settings = {
			size: 160,
			trackColor: "#e0e0e0",
			scaleColor: false,
			lineWidth: 7,
			trackWidth: 7,
			lineCap: "butt",
			onStep: function(from, to, percent){
				if($(this.el)){
					$(this.el).find(".percent").html(Math.round(percent));
				}
			}
		};

		ChartBox.process = function(){
			var viewportHeight = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
			var scrollTop = $(document).scrollTop() + viewportHeight;
			$("[data-chart-box]").each(function(){
				var chartBox = $(this);
				if(scrollTop > chartBox.offset().top + chartBox.height()){
					if(chartBox.attr("data-color") != undefined){
						ChartBox.settings.barColor = chartBox.attr("data-color");	
					} else {
						ChartBox.settings.barColor = "#987f71";
					}
					chartBox.easyPieChart(ChartBox.settings);
				}
			});
		};

		return ChartBox;
	})();

	ChartBox.process();

	$(document).on('scroll', function(){
		ChartBox.process();
	});
});	