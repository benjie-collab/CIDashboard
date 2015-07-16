ko.bindingHandlers.AnyListScroller = {
	init: function(element, valueAccessor, allBindingsAccessor, data, context){	
		var typed = false;		
		
		var options = valueAccessor();
        var newValueAccessor = function() {
            return function() {
                options.action.apply(data, options.params);
            };
        };
		
		
		ko.utils.domData.set(element, "options", options);
	},
	update: function(element, valueAccessor, allBindings) {
        
		var opts = ko.utils.domData.get(element, 'options');		
		
		var def = {
						visible_items: 3,
						scrolling_items: 1,
						orientation: "horizontal",
						circular: "no",
						autoscroll: "no",
						interval: 6000,
						speed: 400,
						easing: "linear",
						direction: "right",
						start_from: 0						
					}
		
		$(element).als(
			$.extend(def, opts)
		);
		
		
    }
}


