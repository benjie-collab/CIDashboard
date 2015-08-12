"use strict";
$( document ).ready(function() {
	
	$(document).on('click', '.delete-row-confirm', function(){
		var button = this;
		$.confirm({
			title:'Delete confirmation',
			text: 'This is very dangerous, you shouldn\'t do it! Are you really really sure?',
			confirm: function() {
			
				var table = $(button).parents('table').DataTable();
				
				$.ajax({
					url: $(button).data('url'),
					method: 'GET',
					dataType: "json",
					beforeSend: function(){ 
					
					},
					success: function(data){ 
						$.notify({
							message: $(data.message).text()
						},
						{
							type: data.response
						});
						
						if(table){
							$(button).parents('tr').addClass('slideOutLeft');							
							table
							.row( $(button).parents('tr') )	
							.remove()
							.draw();
						}
						
					}
				})			
				//window.location = $(button).data('url');
			},
			cancel: function() {
			},
			confirmButton: 'Yes I am',
			cancelButton: 'No'
		});	
	});
	
	
	$(document).on('click', '.edit-row-confirm', function(){
		var button = this;
		$.confirm({
			title:'Edit confirmation',
			text: 'This is very dangerous, you shouldn\'t do it! Are you really really sure?',
			confirm: function() {							
				window.location = $(button).data('url');
			},
			cancel: function() {
			},
			confirmButton: 'Yes I am',
			cancelButton: 'No'
		});	
	
	});	
	
	
	
	
	$(document).on('click', '.confirm-link', function(){
		var button = this, data = $(button).data(),		
		lang = {
				title:'Confirmation',
				text: 'This is very dangerous, you shouldn\'t do it! Are you really really sure?',
				confirmbutton: 'Yes I am',
				cancelbutton: 'No',
				ajax: false,
				}
		
		lang = $.extend(lang, data);
		
		$.confirm({
			title: lang.title,
			text: lang.text,
			confirm: function() {			
				var table = $(button).parents('table').DataTable();	
				if(lang.ajax)
				$.ajax({
					url: $(button).attr('href'),
					method: 'POST',
					dataType: "json",
					data: data,
					beforeSend: function(){ 
					
					},
					success: function(res){ 
						$.notify({
							message: $(res.message).text()
						},
						{
							type: res.response
						});
						
						if(table){
							$(button).parents('tr').addClass('slideOutLeft');							
							table
							.row( $(button).parents('tr') )	
							.remove()
							.draw();
						}
						
					}
				})			
				else
				window.location = $(button).attr('url');
				
			},
			cancel: function() {
			},
			confirmButton: lang.confirmbutton,
			cancelButton: lang.cancelbutton
		});	
		return false;
	});
  
});