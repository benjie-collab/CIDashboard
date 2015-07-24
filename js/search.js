"use strict";
$( document ).ready(function() {
	$('.delete-confirm').confirm({
		title:'Delete confirmation',
		text: 'This is very dangerous, you shouldn\'t do it! Are you really really sure?',
		confirm: function(button) {												
			window.location.href = $(button).data('url');
		},
		cancel: function(button) {
		},
		confirmButton: 'Yes I am',
		cancelButton: 'No'
	});
	
	$('.edit-confirm').confirm({
		title:'Redirect confirmation',
		text: 'This is very dangerous, you shouldn\'t do it! Are you really really sure?',
		confirm: function(button) {			
			var url = $(button).data('url');
			if($(button).attr('target')=='_blank')
			window.open(url, '_blank');
			else
			window.location.href = url;
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
			var rw = $(button).closest('.removable-widget'), parent = $(button).closest('.connected-widgets');							
			$.ajax({
				url: $(button).data('url'),
				type: 'POST',
				data: {
					widget_key: $(rw).data('widget')
				},
				success: function(res){
					$(rw).remove();
					var data = $(parent).sortable('toArray', {attribute: 'data-widget'});
					localStorage.setItem('redirect', false); 
					localStorage.setItem($(parent).attr('id'), JSON.stringify(data)); 
					$($(parent).data('form')).trigger('submit');	
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
				//$(ui.helper).find('li').removeAttr('data-toggle');	
				$(ui.helper).removeAttr('data-toggle');	
				$(ui.helper).attr('data-widget', data.widget + data.delimiter + ts);			
			},
			stop: function(){							
			}
	});
	
	
	$('.connected-widgets')
	.sortable(
	{
		dropOnEmpty: true,
		connectWith: '.connected-widgets',
		placeholder: 'sort-highlight',
		forcePlaceholderSize: true,	
		revert: true,
		appendTo: document.body,
		zIndex: 1032,
		handle: '.handle',
		items: '> .removable-widget, > .draggable-widgets',
		over: function() {
		},
		start: function( event, ui ){	
			if($(ui.item).find('.box-header').length > 0) 
			$(ui.item).find('.box-body').addClass('collapse');
		},
		stop: function( event, ui ){	
			if($(ui.item).find('.box-header').length > 0)
			$(ui.item).find('.box-body').removeClass('collapse');			
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
	
	
	/**
	
	$('.droppable-widgets')
	.droppable({
		hoverClass: 'droppable-hover',
		activeClass: 'droppable-active',
		accept: '.draggable-widgets',
		create: function( event, ui ){			
			var parent = this, data = $(parent).data();
			$(parent).siblings('.overlay:eq(0)').addClass('hidden');						
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
	});**/
		
  
});