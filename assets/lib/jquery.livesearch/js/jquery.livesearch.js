(function($) {

    $.fn.liveSearch = function(options) {

        var defaults = {
				url: '/',
				method: 'POST',
				complete: function(data){
					options.container.innerHTML = 	JSON.stringify(data);	
				}
			};
		 
		var settings = $.extend( {}, defaults, options );
		
		
		return this.each( function() {
			
			var self = this, isActive = true;			
			if(settings.spinner) $(settings.spinner).hide();	
			
			if(settings.input)
			$(document).on('keyup', settings.input,  function (e) {
				var $input = $(this);
				if ($input.val() != self.liveSearchLastValue) {

					var q = $input.val();
					
					// Clear previous ajax request
					if (self.liveSearchTimer) {
						clearTimeout(self.liveSearchTimer);
					}

					
					if(self.xhr)
					self.xhr.abort;	
					
					var data = $(self).serializeArray();	
						
					  
					self.liveSearchTimer = setTimeout(function () {
						if (q) {						
							self.xhr = 
							$.ajax({
								method: 'POST',
								url: settings.url, 
								dataType: "html",
								data: data,
								beforeSend: function(){ 								
									if(settings.spinner)
									$(settings.spinner).show();  
								},
								success: function(data){
									$(settings.container).html(data)
								},
								complete: function(){	
									if(settings.spinner) $(settings.spinner).hide();
								}
							})						
						}
						else {
							settings.container.innerHTML = '';
						}
					}, 300);

					self.liveSearchLastValue = $input.val();
				}
			});
			
        });

    }

}(jQuery));


