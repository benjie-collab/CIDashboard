"use strict";
$( document ).ready(function() {

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
   
   $('.draggable-widgets').draggable({
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
	
   $('.connected-widgets-droppable').droppable({
		hoverClass: 'droppable-hover',
		activeClass: 'droppable-active',
		accept: '.removable-widget',							
		drop: function( event, ui ) {	
			var data = $(ui.draggable).data();
			$(ui.draggable).addClass('dropped');				
			$.ajax({
				url: data.url,
				type: 'POST',
				data: {
					widget_key: data.widget
				},
				success: function(res){
					ui.draggable.remove();	
				}
			});
					
		}
	})
	
   $('.connected-widgets').sortable(
	{
		tolerance: 'pointer',
		cursor: 'pointer',
		dropOnEmpty: true,
		connectWith: '.connected-widgets',
		placeholder: 'sort-highlight',
		forcePlaceholderSize: true,	
		handle: '.handle',
		revert: true,
		appendTo: document.body,
		zIndex: 1032,
		items: '.removable-widget, .draggable-widgets',
		over: function(event, ui){			
			var parent = this, redirect= false, trash = parent.id=='widget-trash';
			if(trash){				
				$('#widget-trash').removeClass('droppable-active');
				$('#widget-trash').addClass('droppable-hover');
			}
		},
		out: function(event, ui){
			var parent = this, redirect= false, trash = parent.id=='widget-trash';
			if(trash){
				$('#widget-trash').removeClass('droppable-hover');
				$('#widget-trash').addClass('droppable-active');
			}
		},
		start: function( event, ui ){	
			if($(ui.item).find('.box-header').length > 0) 
			$(ui.item).find('.box-body').addClass('collapse');
			//$('#widget-trash').removeClass('hidden');
			$('#widget-trash').addClass('droppable-active');
		},
		stop: function( event, ui ){	
			if($(ui.item).find('.box-header').length > 0)
			$(ui.item).find('.box-body').removeClass('collapse');	
			$('#widget-trash').removeClass('droppable-hover, droppable-active');			
		},
		create: function( event, ui ){	
			var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'}), trash = parent.id=='widget-trash';
			if(trash){
				$(parent).sortable( "option", "forcePlaceholderSize", false );
				$(parent).sortable( "option", "forcePlaceholderSize", false );
				$(parent).sortable( "option", "placeholder", false );
			}
			
			if(data.length ===0 )
			$(parent).addClass('widget-empty');
			else
			$(parent).removeClass('widget-empty');
			$(parent).siblings('.overlay:eq(0)').addClass('hidden');							
			var widgets = [], widget = $(parent).attr('id'); 
			if(localStorage.getItem('widgets'))
			widgets = JSON.parse(localStorage.getItem('widgets'));						
			if(jQuery.inArray(widget, widgets ) === -1 )
			widgets.push(widget);
			localStorage.setItem(widget, JSON.stringify(data));
			localStorage.setItem('widgets', JSON.stringify(widgets));
		},
		update: function( event, ui ){	
			var parent = this, redirect= false, trash = parent.id=='widget-trash';				
			if(trash){
				$.ajax({
					url: $(parent).data('url'),
					type: 'POST',
					data: {
						widget_key: $(ui.item).data('widget')
					},
					success: function(res){
						$(ui.item).remove();
						$($(parent).data('form')).trigger('submit');
					}
				});
			}else{
				var data = $(parent).sortable('toArray', {attribute: 'data-widget'});					
				if(data.length ===0 )
				$(parent).addClass('widget-empty');
				else
				$(parent).removeClass('widget-empty');								
				if($(ui.item).hasClass('draggable-widgets')){
					redirect = true;						
				}
				$(parent).siblings('.overlay:eq(0)').removeClass('hidden');					
				localStorage.setItem(parent.id, JSON.stringify(data)); 
				localStorage.setItem('redirect', redirect);
				$(parent).siblings('.overlay:eq(0)').addClass('hidden');
				var self_sort = $(ui.item).parent('.connected-widgets').attr('id') == parent.id;	
				if (ui.sender != null || (ui.sender == null && self_sort) || redirect == true) {$($(parent).data('form')).trigger('submit');}				
			}	
			
		}
	}
   );
});