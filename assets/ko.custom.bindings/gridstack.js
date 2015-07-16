ko.bindingHandlers.Gridstack	 = {
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
		var options ={
			cell_height: 80,
			vertical_margin: 10
		};
		
		
		$(element).gridstack(
			$.extend(options, opts)
		);
		
		
    }
}


