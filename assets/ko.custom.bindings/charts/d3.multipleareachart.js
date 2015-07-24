ko.bindingHandlers.MultipleAreaChart = {
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
	update: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
		var opts = ko.utils.domData.get(element, 'options');
		var $root = bindingContext.$root;

		jQuery(element).MultipleAreaChart(opts);		
		
    }
}