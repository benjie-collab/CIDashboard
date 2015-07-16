ko.bindingHandlers.Dxpie = {
	init: function(element, valueAccessor, allBindingsAccessor, data, context){	
		var typed = false;		
		
		var options = valueAccessor();
        var newValueAccessor = function() {
            return function() {
                options.action.apply(data, options.params);
            };
        };				
		
		jQuery(element).dxPieChart({
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
	update: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
        var opts = ko.utils.domData.get(element, 'options');
		var $root = bindingContext.$root;

		jQuery(element).dxPieChart('instance').showLoadingIndicator();	
		var preview = $(element).closest('#widget_options_form');	
		
		if(preview.length > 0){	
			var subs = 
			$root['ajaxProcess'].subscribe(function(value) {
				if(value==false)
				$.ajax({
					method: 'POST',
					url: opts.ajax,
					data: $(preview).serializeArray(),
					beforeSend: loadingIndicator,
					success: function(data){
						
						var values = [], arguments = [];
						var visual_options = ( ( "visual" in data ) ? data.visual : {}  ),
							dataSource = ( ( "dataSource" in visual_options ) ? visual_options.dataSource : {}  );
						
						if(dataSource.length > 0) {
							var source = dataSource.length> 0? dataSource[0] : {};
							var series = visual_options.series;
							arguments = 
							$.map(source, function(value, key ) {
								var selected = (typeof(series)!='undefined' && series.argumentField == key) ? 'selected' : '';
								return '<option ' + selected + ' value="' + key + '" >' + key + '</option>';
							}) ;				
							values = 
							$.map(source, function(value, key ) {
								var selected = (typeof(series)!='undefined' && series.valueField == key) ? 'selected' : '';
								return '<option ' + selected + ' value="' + key + '" >' + key + '</option>';
							}) ;						
						}
						
						$(preview)
						.find('select.argumentfield-select')
						.html(arguments.join())
						.promise().done(function(){
							$(preview).find('.argumentfield-select').selectpicker('refresh');
						});
						$(preview)
						.find('select.valuefield-select')
						.html(values.join())
						.promise().done(function(){
							$(preview).find('.valuefield-select').selectpicker('refresh');
						});
												
						initialize(data)				
					},
					complete: function(data){
						
					}
				});
			});	

			$('body').on('hide.bs.modal', jQuery(element).closest('.modal').get(0), function () {
				subs.dispose();
			})						
		}	
		if(jQuery(element).is(':visible') && !opts.event){
			update();	
		}else if(opts.event == 'carousel'){	
			if(jQuery(element).is(':visible'))
			update();
			$(element).closest('.carousel').on('slid.bs.carousel', function(){	
				if($(element).closest('.item').hasClass('active'))
				update();			
			})			
		}else if(opts.event == 'modal'){
			if(jQuery(element).is(':visible'))
			update();
			$(element).closest('.modal').on('shown.bs.modal', function(){
				update();			
			})			
		}else if(opts.event == 'tab'){
			if(jQuery(element).is(':visible'))
			update();
			
			var id= $(element).closest('.tab-pane').attr('id');
			$('[data-toggle="tab"][data-target="#' + id + '"]').on('shown.bs.tab', function(){	
				if($(element).closest('.tab-pane').hasClass('active'))
				update();			
			})
			$('[data-toggle="tab"][href="#' + id + '"]').on('shown.bs.tab', function(){	
				if($(element).closest('.tab-pane').hasClass('active'))
				update();			
			})
		}else{		
			//update();	
		}		
		
		function update(){
			if(opts.event)
			$.ajax({
				method: 'POST',
				url: opts.ajax,
				data: opts.data,
				beforeSend: loadingIndicator,
				success: initialize
			});	
			else
				initialize(opts)
			
		}
		
		
		
		function initialize(settings){
			var visual_options = ( ( "visual" in settings ) ? settings.visual : {}  ) ;
			jQuery(element).dxPieChart('instance').option(visual_options);
		
		}
		
		function loadingIndicator(){
			jQuery(element).dxPieChart('instance').showLoadingIndicator();			
		}
		
		
    }
}


