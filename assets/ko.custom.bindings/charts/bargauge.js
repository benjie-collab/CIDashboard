ko.bindingHandlers.DXBargauge = {
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
		
		
		jQuery(element).dxBarGauge('instance').showLoadingIndicator();			
		if(opts.event == 'carousel'){
			$(element).closest('.carousel').on('slid.bs.carousel', function(){	
				if($(element).closest('.item').hasClass('active'))
				update();			
			})			
		}else if(opts.event == 'tab'){
			var id= $(element).closest('.tab-pane').attr('id');			
			$('[data-toggle="tab"][data-target="#' + id + '"]').on('shown.bs.tab', function(){	
				if($(element).closest('.tab-pane').hasClass('active'))
				update();			
			})			
		}if(jQuery(element).is(':visible')){
			update();	
		}else{		
			//update();	
		}		
		
		function update(){			
			$.ajax({
				method: 'POST',
				url: opts.ajax,
				data: opts.post_data,
				success: function(data){
					jQuery(element).dxBarGauge('instance').option(data);	
				}
			});	
		}
		
		
		
		
    }
}


