ko.bindingHandlers.jQueryTreeGrid = {
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
		
		
		$(element).treegrid({
                    onChange: function() {
                        console.log("Changed: " + $(this).attr("id"));
                    },
                    onCollapse: function() {
                        console.log("Collapsed " + $(this).attr("id"));
                    },
                    onExpand: function() {
                        console.log("Expanded: " + $(this).attr("id"));
                    }});
					
				/**
                $('#node-1').on("change", function() {
                    alert("Event from " + $(this).attr("id"));
                });**/
		
		
		
		
	}
}