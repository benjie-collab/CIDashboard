ko.bindingHandlers.Masonry	 = {
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
		  // options
		  itemSelector: '.grid-item',
		  columnWidth: 200
		};
		
		
		$(element).masonry(
			$.extend(options, opts)
		);
		
		
    }
}


