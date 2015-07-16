ko.bindingHandlers.JSONView = {
	init: function(element, valueAccessor, allBindingsAccessor){	
		var typed = false;
		var options =  jQuery.extend(valueAccessor(), {
							onChange: function (cm) {
								typed = true;
								allBindingsAccessor().value(cm.getValue());
								typed = false;
							}
						});
						
						
		 $('#server-response-collapse-btn').on('click', function() {
			$(element).JSONView('collapse');
		  });

		  $('#server-response-expand-btn').on('click', function() {
			$(element).JSONView('expand');
		  });

		  $('#server-response-toggle-btn').on('click', function() {
			$(element).JSONView('toggle');
		  });

		  $('#server-response-toggle-level1-btn').on('click', function() {
			$(element).JSONView('toggle', 1);
		  });

		  $('#server-response-toggle-level2-btn').on('click', function() {
			$(element).JSONView('toggle', 2);
		  });
		
		
		ko.utils.domData.set(element, "options", options);		
	},
		
		
		
		
	update: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
		var opts = ko.utils.domData.get(element, 'options');
		var $root = bindingContext.$root;
		opts = ko.toJS(opts);
		$(element).JSONView(opts, { collapsed: true, nl2br: true, recursive_collapser: true });		
	}
}