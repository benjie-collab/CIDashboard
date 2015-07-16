ko.bindingHandlers.TypeAhead = {
	init: function(element, valueAccessor, allBindingsAccessor){	
		var typed = false;
		var opts =  jQuery.extend(valueAccessor(), {
							onChange: function (cm) {
								typed = true;
								allBindingsAccessor().value(cm.getValue());
								typed = false;
							}
						});
						
						
		
		var tpa = new Bloodhound({
			datumTokenizer: function (d) {
					return Bloodhound.tokenizers.whitespace(d.NRIC_M_FT);
				},
			queryTokenizer: Bloodhound.tokenizers.whitespace,			
			remote: {
				wildcard: '%QUERY',
				url: opts.ajax.url + '?' + $.param(opts.ajax.params) + '&text=%QUERY',	
				/**
				ajax:{
					type:"POST",
					cache:false,
					data:{
						limit: 12
					},
					beforeSend:function(jqXHR,settings){	
						console.log('sending');
						//opts.ajax.params['text'] = $(element).typeahead('val');
						//settings.data+= $.param(opts.ajax.params);
					},
					complete:function(jqXHR,textStatus){
						//tpa.clearRemoteCache();
						console.log('recieved');
					}
				},**/				
				filter: function(response) {	
					if(typeof opts.ajax.source != 'undefined')
					if(response.hasOwnProperty(opts.ajax.source)){							
						response = [].concat(response);
					}		
					response = 
					$.map(response, function(v){
						var d;
						if(typeof opts.ajax.source != 'undefined')
						 d = v[opts.ajax.source].DOCUMENT;
						else
						 d = v;
						return d;
					});					
					return response;
			   }
			}
		});
		
		tpa.initialize();
		$(element).typeahead(
			null, 
			$.extend( 
				{ source: tpa }, 
				{ limit: 12 },
				opts
			)
		);		
		
		ko.utils.domData.set(element, "options", opts);	
		
	},
		
		
		
		
	update: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
		var opts = ko.utils.domData.get(element, 'options');
		var $root = bindingContext.$root;
		
		
		/**
		 $(element)
		 .typeahead(opts)
		 .on('keyup', function(event){

		   // Define tab key
            var e = jQuery.Event("keydown");
            e.keyCode = e.which = 9; // 9 == tab
			
            if (event.which == 13) // if pressing enter
                $(element).trigger(e); // trigger "tab" key - which works as "enter"

		});**/
		
		

		
		
		
		
		
	}
}