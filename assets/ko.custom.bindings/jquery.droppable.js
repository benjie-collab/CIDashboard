ko.bindingHandlers.jQueryDroppable = {
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
				drop: function( event, ui ) {		
					$( this ).find( '.placeholder' ).remove();
					var clone_item = ui.draggable.clone();
					$(clone_item).appendTo( this );					
					$(this).closest('form').trigger('submit');									
				}
			},
			opts
		)		
		$(element).droppable(opts);
	}
}