ko.bindingHandlers.BootstrapIconPicker = {
	init: function(element, valueAccessor, allBindingsAccessor){	
		var typed = false;
		var options =  jQuery.extend(valueAccessor(), {
							onChange: function (cm) {
								typed = true;
								allBindingsAccessor().value(cm.getValue());
								typed = false;
							}
						});
						
						
		
		ko.utils.domData.set(element, "options", options);		
	},
		
		
		
		
	update: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
		var opts = ko.utils.domData.get(element, 'options');
		var $root = bindingContext.$root;		
		opts = $.extend(
			{
				title: 'With custom options',
				//icons: ['github', 'heart', 'html5', 'css3'],
				selectedCustomClass: 'label label-success',
				mustAccept: true,
				placement: 'bottomLeft',
				showFooter: true,
				// note that this is ignored cause we have an accept button:
				hideOnSelect: true                       
            },
			opts
		)
		$(element).iconpicker(opts);
		
		
		
		
		
	}
}