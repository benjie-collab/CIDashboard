ko.bindingHandlers.MagicSuggest = {
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
		
		
		$(element).magicSuggest({
			data: opts.data,
			renderer: function(data){
				return '<div style="padding: 5px; overflow:hidden;">' +
					'<div style="float: left;"><img src="' + data.picture + '" /></div>' +
					'<div style="float: left; margin-left: 5px">' +
						'<div style="font-weight: bold; color: #333; font-size: 10px; line-height: 11px">' + data.name + '</div>' +
						'<div style="color: #999; font-size: 9px">' + data.email + '</div>' +
					'</div>' +
				'</div>'; // make sure we have closed our dom stuff
			}
		});
		
		
		
		
		
	}
}