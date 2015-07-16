ko.bindingHandlers.SettingsBar = {
	init: function(element, valueAccessor, allBindingsAccessor, data, context){	
		var typed = false;		
		
		var options = valueAccessor();
        var newValueAccessor = function() {
            return function() {
                options.action.apply(data, options.params);
            };
        };
		
		
		jQuery(element).dxChart({
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
		var opts = ko.utils.domData.get(element, 'options')
        var value = valueAccessor();
		
		$.ajax({
			method: 'POST',
			url: opts.ajax,
			success: function(data){
				jQuery(element).dxChart('instance').option(
					$.extend(
					opts.options,
					{
						dataSource: data.autnresponse.responsedata.databases.database
					})
				
				);			
				
			}
		});	
    }
}











ko.bindingHandlers.SettingsBarGauge = {
	init: function(element, valueAccessor, allBindingsAccessor, data, context){	
		var typed = false;		
		
		var options = valueAccessor();
        var newValueAccessor = function() {
            return function() {
                options.action.apply(data, options.params);
            };
        };
				
		jQuery(element).dxBarGauge({
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
		
		
		jQuery(element).dxBarGauge('instance').option(opts);	
		
		
    }
}


