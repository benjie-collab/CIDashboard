ko.bindingHandlers.DXCirculargauge = {
	init: function(element, valueAccessor, allBindingsAccessor, data, context){	
		var typed = false;		
		
		var options = valueAccessor();
        var newValueAccessor = function() {
            return function() {
                options.action.apply(data, options.params);
            };
        };
			
		jQuery(element).dxCircularGauge({
			dataSource: [],
			loadingIndicator: {
				backgroundColor: 'lightcyan',
				font: {
					size: 16
				}
			}
		});
		ko.utils.domData.set(element, "options", options);		
	},
	update: function(element, valueAccessor, allBindings) {
        // First get the latest data that we're bound to
		var opts = ko.utils.domData.get(element, 'options');
        var value = valueAccessor();
		
		jQuery(element).dxCircularGauge('instance').showLoadingIndicator();			
		if(jQuery(element).is(':visible')){
			jQuery(element).dxCircularGauge('instance').option(opts);
		}
		
		
    }
}


