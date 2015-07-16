ko.bindingHandlers.jQueryHorizontalScroll = {
	init: function(element, valueAccessor, allBindingsAccessor, data, context){	
		var typed = false;		
		
		var options = valueAccessor();
        var newValueAccessor = function() {
            return function() {
                options.action.apply(data, options.params);
            };
        };
		
		//$(element).on('mouseover', function(){
			//$(element).getNiceScroll().resize();		
		//})
		ko.utils.domData.set(element, "options", options);
	},
	update: function(element, valueAccessor, allBindings) {
        
		var opts = ko.utils.domData.get(element, 'options');
		//if(jQuery(element).width() > opts.width){
			 $(element).horizontalScroll(opts);
		//}
		
		
    }
}


