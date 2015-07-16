ko.bindingHandlers.SlimScroll = {
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
	update: function(element, valueAccessor, allBindings) {
        
		var opts = ko.utils.domData.get(element, 'options');		
		
		var def = {
						width: 'auto',
						height: '500px',
						size: '5px',
						position: 'right',
						color: '#000',
						alwaysVisible: false,
						distance: '1px',
						start: 'top',
						railVisible: true,
						railColor: '#333',
						railOpacity: 0.3,
						wheelStep: 10,
						allowPageScroll: false,
						disableFadeOut: false
					}
		
		$(element).slimScroll(
			$.extend(def, opts)
		);
		
		
    }
}


