"use strict";
$( document ).ready(function() {
	var xhr = null;

	$('#category-builder-add-child').on('click', function(){
		var node = $("#category-builder").fancytree("getActiveNode");	
		if( !node ) {
			alert("Please activate a parent node.");
			return;
		}
		node.editCreateNode("child", "Sub-Category Name");
	});	
	
	$('#category-builder-add-sibling').on('click', function(){
		var node = $("#category-builder").fancytree("getActiveNode");	
		if( !node ) {
			alert("Please activate a parent node.");
			return;
		}
		node.editCreateNode("after", "Category Name");
	});
	
	
	
	$('#category-builder-add-child-edit').on('click', function(){
		var node = $("#category-builder-edit").fancytree("getActiveNode");	
		if( !node ) {
			alert("Please activate a parent node.");
			return;
		}
		node.editCreateNode("child", "Sub-Category Name");
	});	
	
	$('#category-builder-add-sibling-edit').on('click', function(){
		var node = $("#category-builder-edit").fancytree("getActiveNode");	
		if( !node ) {
			alert("Please activate a parent node.");
			return;
		}
		node.editCreateNode("after", "Category Name");
	});
	
	
	
	
	
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
	
	
	
	/**
	$('form#add_new_categorization_form').on('submit', function(){
		var tree = $("#category-builder").fancytree("getTree");
		var nodes = tree.toDict(true);
		
		var widgets = [], data = $(el).serializeArray(), widget=[];		
			
		xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			dataType: "json",
			data: $.merge(data,  
				{ 
					nodes :  nodes
				}  ),
			beforeSend: function(){ self.ajaxProcess(true) },
			success: function(data){ 		
				self.ajaxProcess(false);
				$.notify({
					message: data.message,
					type: data.response
				});
				
				if(data.redirect)
				window.location.href=data.redirect;
			}
		})	
		return false;
		
	});**/
	
});