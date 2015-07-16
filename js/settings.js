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
	
	
	
	$(document).on('change', '.skin-selector li input[type=radio]', function(e){
		
		var value= $(e.currentTarget).val(),
		skins = $(e.currentTarget).parents('.skin-selector').data('skins');
		$.each(skins, function(k, v){
			$('body').removeClass(k);
		});
		$('body').addClass(value);
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