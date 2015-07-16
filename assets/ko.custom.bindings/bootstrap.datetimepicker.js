ko.bindingHandlers.BootstrapDateTimePicker = {
	init: function(element, valueAccessor, allBindingsAccessor){	
		var typed = false;
		var options =  valueAccessor();
						
						
		
		
		ko.utils.domData.set(element, "options", options);		
	},
		
		
		
		
	update: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
		var opts = ko.utils.domData.get(element, 'options');
		var $root = bindingContext.$root;
		
		$(element).datetimepicker(opts);
		
		
		
		
		
	}
}