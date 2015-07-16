"use strict";
$( document ).ready(function() {
	$('body').on('loaded.bs.modal', '#modal-configure-statistics', function(){
		ko.applyBindings( Statistics, $(this).get(0));	
	})
	$('body').on('hidden.bs.modal', '#modal-configure-statistics', function(){	
		 ko.cleanNode($(this).get(0));
	})

	
	
	$(document).on('click', '.copy-confirm', function(){
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
						
						if(data.redirect){
							window.location = data.redirect;
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
	
	
	$(document).on('click', '.delete-confirm', function(){
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
						
						if(data.redirect){
							window.location = data.redirect;
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
	
});