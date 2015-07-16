ko.bindingHandlers.DXLineargauge = {
	init: function(element, valueAccessor, allBindingsAccessor, data, context){	
		var typed = false;		
		
		var options = valueAccessor();
        var newValueAccessor = function() {
            return function() {
                options.action.apply(data, options.params);
            };
        };
			
		jQuery(element).dxLinearGauge({
			dataSource: [],
			loadingIndicator: {
				backgroundColor: 'lightcyan',
				font: {
					size: 16
				}
			}
		});
		ko.utils.domData.set(element, "options", options.chartOptions);	
	},
	update: function(element, valueAccessor, allBindings) {
        // First get the latest data that we're bound to
		var opts = ko.utils.domData.get(element, 'options');
        var value = valueAccessor();
		
		jQuery(element).dxLinearGauge('instance').showLoadingIndicator();			
		if(jQuery(element).is(':visible')){
			jQuery(element).dxLinearGauge('instance').option(opts);
		}
		
		
    }
}


