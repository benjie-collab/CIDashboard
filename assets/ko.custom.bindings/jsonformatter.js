ko.bindingHandlers.jsonFormatter = {
	init: function(element, valueAccessor, allBindingsAccessor){	
		var typed = false;
		var options =  jQuery.extend(valueAccessor(), {
							onChange: function (cm) {
								typed = true;
								allBindingsAccessor().value(cm.getValue());
								typed = false;
							}
						});
						
						
		
		
		$(element).jsonFormatter(options);
		ko.utils.domData.set(element, "options", options);		
	},
	
	update: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
		var opts = ko.utils.domData.get(element, 'options');
		var $root = bindingContext.$root;
		
		
		console.log(opts);
		$(element).jsonFormatter(opts);
		
		
		
		
	}
}