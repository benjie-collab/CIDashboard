"use strict";
$( document ).ready(function() {

	$('.no-content').parents('div[data-form="#page_settings_form"]').css({ display: 'none'});	

	var
	data = $('#modal-page-search-form').data();
	if(data)
	$('#modal-page-search-form').modal(	
		{  
			backdrop : "static",
			keyboard: false,
			show: data.show
		}	
	);

	function geolocation_success(pos) {
		// Location found, show map with these coordinates
		//drawMap(new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude));
		localStorage.setItem( 'geolocation' , JSON.stringify({latitude: pos.coords.latitude, longitude: pos.coords.longitude}));
		location.reload();
		return false;
	}

	function geolocation_fail(error) {
		//drawMap(defaultLatLng);  // Failed to find location, show default map
		localStorage.removeItem('geolocation');		
		return false;
	}
	
	
	var shareLocation = (localStorage.getItem('geolocation'))? true : false;
	$('.share-location')
	.on('switchChange.bootstrapSwitch', function(event, state){
		if ( state == true && navigator.geolocation ) {	
			// Find the users current position.  Cache the location for 5 minutes, timeout after 6 seconds
			navigator.geolocation.getCurrentPosition(geolocation_success, geolocation_fail, {maximumAge: 500000, enableHighAccuracy:true, timeout: 6000});
		}else{
			localStorage.removeItem('geolocation');
			location.reload();
		}
	})
	.bootstrapSwitch({
					onColor: 'primary', 
					offColor: 'warning',
					size: 'medium', 
					onText: 'On', 
					offText: 'Off', 
					labelText: 'Location'
				})
	.bootstrapSwitch('state', shareLocation, true);
	
		
	
	$('.copy-confirm').confirm({
		title:'Copy Confirmation',
		text: 'Your about to copy, page will be refreshed! Are you really really sure?',
		confirm: function(button) {												
			window.location.href = $(button).data('url');
		},
		cancel: function(button) {
		},
		confirmButton: 'Yes I am',
		cancelButton: 'No'
	});
	
	$('.delete-confirm').confirm({
		title:'Delete Confirmation',
		text: 'This is very dangerous, you shouldn\'t do it! Are you really really sure?',
		confirm: function(button) {	
			
			$.ajax({
				url: $(button).data('url'),
				type: 'GET',
				success: function(data){
					var messages = $(data.message).filter('div');
					if(messages)
					$.each(messages, function(i,v){
						$.notify({
							message: $(v).text() 
						},
						{
							type: data.response
						});
					
					})
					else
					$.notify({
						message: $(data.message).text() 
					},
					{
						type: data.response
					});
					
					if(data.redirect)
					window.location.href=data.redirect;
					
				}
			});
			
		},
		cancel: function(button) {
		},
		confirmButton: 'Yes I am',
		cancelButton: 'No'
	});
	
	
	$('.delete-widget-confirm').confirm({
		title:'Delete confirmation',
		text: 'This is very dangerous, you shouldn\'t do it! Are you really really sure?',
		confirm: function(button) {							
			var rw = $(button).parents('.removable-widget'), 
			cw = $(button).parents('.connected-widgets'),
			dw = $(button).parents('.droppable-widgets'),
			widget = $(rw).data('widget');
			
			$.ajax({
				url: $(button).data('url'),
				type: 'POST',
				data: {
					widget_key: widget
				},
				success: function(res){
					$(rw).remove();
					var widgets;
					
					
					var widgets = $(cw).sortable('toArray', {attribute: 'data-widget'});
					if(cw && widgets){						
						localStorage.setItem('redirect', false); 
						localStorage.setItem($(cw).attr('id'), JSON.stringify(widgets)); 
						$($(cw).data('form')).trigger('submit');					
					}
					
					widgets = $(dw).data('widget');	
					if(dw && widgets){
						var index = widgets.indexOf(widget);
						if (index > -1) {
							widgets.splice(index, 1);
						}
						localStorage.setItem('redirect', true); 
						localStorage.setItem($(dw).attr('id'), JSON.stringify(widgets)); 
						$($(dw).data('form')).trigger('submit');					
					}
					
				}
			});
		},
		cancel: function(button) {
		},
		confirmButton: 'Yes I am',
		cancelButton: 'No'
	});
	

	$('.draggable-widgets')
	.draggable({
			helper: 'clone',
			//handle: '.handle',
			appendTo: document.body,
			connectToSortable: '.connected-widgets',
			revert: 'true',
			zIndex : 1032,
			start : function(event, ui) {
				var data= ui.helper.data();
				ui.helper.width($(this).width());
				$(window).trigger('resize');
				var ts = moment().valueOf();	
				$('[data-toggle=popover]').popover('hide');		
				//$(ui.helper).find('handle').removeAttr('data-toggle');			
				$(ui.helper).removeAttr('data-toggle')
				$(ui.helper).attr('data-widget', data.widget + data.delimiter + ts);		
			},
			stop: function(){							
			}
	});
	
	
	$('.connected-widgets')
	.sortable({
		connectWith: '.connected-widgets',
		placeholder: 'sort-highlight',
		forcePlaceholderSize: 'true',	
		revert: 'false',
		appendTo: document.body,
		zIndex: 1032,
		handle: '.handle',
		scroll:true,
		items: '> .removable-widget, > .draggable-widgets',
		drag: function() {
			 var st = parseInt($(this).data("startingScrollTop"));
			ui.position.top -= $(this).parent().scrollTop() - st;
		},
		start: function( event, ui ){	
			$(this).data("startingScrollTop",$(this).parent().scrollTop());
			if($(ui.item).find('.box-body:eq(0)').length > 0) 
			$(ui.item).find('.box-body:eq(0)').addClass('collapse');
		},
		stop: function( event, ui ){	
			if($(ui.item).find('.box-body:eq(0)').length > 0)
			$(ui.item).find('.box-body:eq(0)').removeClass('collapse');			
		},
		create: function( event, ui ){	
			var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
			if(data.length ===0 )
			$(parent).addClass('widget-empty');
			else
			$(parent).removeClass('widget-empty');
			$(parent).find('.overlay:eq(0)').addClass('hidden');							
			var widgets = [], widget = $(parent).attr('id'); 
			if(localStorage.getItem('widgets'))
			widgets = JSON.parse(localStorage.getItem('widgets'));						
			if(jQuery.inArray(widget, widgets ) === -1 )
			widgets.push(widget);
			localStorage.setItem(widget, JSON.stringify(data));
			localStorage.setItem('widgets', JSON.stringify(widgets));
		},
		update: function( event, ui ){				
			var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});					
			if(data.length ===0 )
			$(parent).addClass('widget-empty');
			else
			$(parent).removeClass('widget-empty');								
			if($(ui.item).hasClass('draggable-widgets')){
				redirect = true;						
			}							
			localStorage.setItem(parent.id, JSON.stringify(data)); 
			localStorage.setItem('redirect', redirect);			
			var self_sort = $(ui.item).parent('.connected-widgets').attr('id') == parent.id;				
			if (ui.sender != null || (ui.sender == null && self_sort) || redirect == true) {
				$($(parent).data('form')).trigger('submit');
			}	
		}
	});
	
	
	
	
	$('.droppable-widgets')
	.droppable({
		hoverClass: 'droppable-hover',
		activeClass: 'droppable-active',
		accept: '.draggable-widgets',
		create: function( event, ui ){		
			var parent = this, data = $(parent).data();
			
			if(data.widget.length ===0 )
			$(parent).addClass('widget-empty');
			else
			$(parent).removeClass('widget-empty');	
			
			
			$(parent).find('.overlay:eq(0)').addClass('hidden');						
			var widgets = [], widget = $(parent).attr('id'); 
			if(localStorage.getItem('widgets'))
			widgets = JSON.parse(localStorage.getItem('widgets'));						
			if(jQuery.inArray(widget, widgets ) == -1 )
			widgets.push(widget);				
			localStorage.setItem('widgets', JSON.stringify(widgets));
			localStorage.setItem(widget, JSON.stringify(data.widget));
		},
		over: function() {
		},
		drop: function( event, ui ) {		
			var parent = this, data = $(ui.helper).data(), widgets = [];				
			if(localStorage.getItem( $(parent).attr('id') ))
			widgets = JSON.parse(localStorage.getItem($(parent).attr('id')));						
			if(jQuery.inArray(data.widget, widgets ) == -1 )
			widgets.push(data.widget);					
			localStorage.setItem( $(parent).attr('id') , JSON.stringify(widgets));
			localStorage.setItem('redirect', true);
			if (ui.sender !== null || redirect == true) {$( $(parent).data().form).trigger('submit');}
		}		
	});
	
	
	
	$(document).on('change', '.skin-selector li input[type=radio]', function(e){
		
		var value= $(e.currentTarget).val();
		$(e.currentTarget)
			.parents('.skin-selector')
			.children('li')
			.removeClass('active')
			.end()
			.end()
			.parents('li')
			.addClass('active')
			
	});	
	
	
	$(document).on('change', '.button-selector li input[type=radio]', function(e){
		
		var value= $(e.currentTarget).val();		
		$(e.currentTarget)
			.parents('.button-selector')
			.children('li')
			.removeClass('active')
			.end()
			.end()
			.parents('li')	
			.addClass('active')			
	});	
	
	$(document).on('change', '.layout-selector', function(e){
		
		var value= $(e.currentTarget).val();		
		$('body').toggleClass(value);
			
	});	
		
  
});