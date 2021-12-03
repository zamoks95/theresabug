jQuery(function($){
	"use strict";

	var labels = ['Months', 'Days', 'Hours', 'Minutes', 'Seconds'],
		parser = /([0-9]{2})/gi;

	// Parse countdown string to an object
	function strfobj(str) {
		var parsed = str.match(parser),
			obj = {};
		labels.forEach(function(label, i) {
			obj[label] = parsed[i]
		});
		return obj;
	}

	// Return the time components that diffs
	function diff(obj1, obj2) {
		var diff = [];
		labels.forEach(function(key) {
			if (obj1[key] !== obj2[key]) {
				diff.push(key);
			}
		});
		return diff;
	}

	$("[data-countdown-box]").each(function(){
		var countdownBox = $(this);
		var template = _.template($("#"+countdownBox.attr("data-countdown-box")).html()),
			currentDate = '00:00:00:00:00',
			nextDate = '00:00:00:00:00';
		// Build the layout
		var initData = strfobj(currentDate);
		labels.forEach(function(label, i) {
			countdownBox.append(template({
				current: initData[label],
				next: initData[label],
				label: label
			}));
		});
		// Starts the countdown
		countdownBox.countdown(new Date($(this).attr("data-countdown-time")), function(event) {
			window.c = event;
			var newDate = event.strftime('%m:%n:%H:%M:%S'), data;
			if (newDate !== nextDate) {
				currentDate = nextDate;
				nextDate = newDate;
				// Setup the data
				data = {
					'current': strfobj(currentDate),
					'next': strfobj(nextDate)
				};
				// Apply the new values to each node that changed
				diff(data.current, data.next).forEach(function(label) {
					var selector = '.%s'.replace(/%s/, label),
						node = countdownBox.find(selector);
					// Update the node
					node.removeClass('countdown-box-flip');
					node.find('.box-current .countdown-box-wrap-number').text(data.current[label]);
					node.find('.box-next .countdown-box-wrap-number').text(data.next[label]);
					// Wait for a repaint to then flip
					_.delay(function(node) {
						node.addClass('countdown-box-flip');
					}, 50, node);
				});
			}
		});
	});
});