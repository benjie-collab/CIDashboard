"use strict";
$( document ).ready(function() {
	
	$(document).on('click', '.delete-row-confirm', function(){
		var button = this;
		$.confirm({
			title:'Delete confirmation',
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
  
});