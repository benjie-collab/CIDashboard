ko.bindingHandlers.Dropzone= {
	init: function(element, valueAccessor, allBindingsAccessor){	
		var typed = false;
		var options =  jQuery.extend(valueAccessor(), {
							onChange: function (cm) {
								typed = true;
								allBindingsAccessor().value(cm.getValue());
								typed = false;
							}
						});
		Dropzone.autoDiscover = false;		
		var defaults = {
							url: "/dropzone",
							addRemoveLinks : false,
							maxFilesize: 2.0,
							maxFiles: 100,
							init: function() {
							},
							success: function(file, response) {
								var messages = $(response.message).filter('div');
								if(messages)
								$.each(messages, function(i,v){
									$.notify({
										message: $(v).text() 
									},
									{
										type: response.response
									});
								
								})
								else
								$.notify({
									message: $(response.message).text() 
								},
								{
									type: response.response
								});
							} ,
							error: function(file, response) {
								var messages = $(response.message).filter('div');
								if(messages)
								$.each(messages, function(i,v){
									$.notify({
										message: $(v).text() 
									},
									{
										type: response.response
									});
								
								})
								else
								$.notify({
									message: $(response.message).text() 
								},
								{
									type: response.response
								});
							}   
						}
		options = $.extend(defaults, options);	
		$(element)
		.dropzone(options);
			
		
		ko.utils.domData.set(element, "options", options);		
	},
		
		
		
		
	update: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
		var opts = ko.utils.domData.get(element, 'options');
		var $root = bindingContext.$root;
	}
}