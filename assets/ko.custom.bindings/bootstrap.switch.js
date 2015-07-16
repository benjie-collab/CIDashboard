ko.bindingHandlers.BootstrapSwitch = {
	init: function(element, valueAccessor, allBindingsAccessor){	
		var typed = false;
		var options =  jQuery.extend(valueAccessor(), {
							onChange: function (cm) {
								typed = true;
								allBindingsAccessor().value(cm.getValue());
								typed = false;
							}
						});
						
						
		$(element).on('switchChange.bootstrapSwitch', function(event, state) {
		  //console.log(this); // DOM element
		  //console.log(event); // jQuery event
		  //console.log(state); // true | false
		});
		
		
		ko.utils.domData.set(element, "options", options);		
	},
		
		
		
		
	update: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
		var opts = ko.utils.domData.get(element, 'options');
		var $root = bindingContext.$root;
		
		
		$(element).bootstrapSwitch(opts);
		
		
		
		
		
	}
}