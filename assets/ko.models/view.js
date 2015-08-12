

var viewModel = {
	Search : new Search(),
	Document : new Document(),
	SearchSettings  : new SearchSettings(),
	Settings  : new Settings(),
	Pages: new Pages(),
	Profile: new Profile([]),
	Dashboard: new Dashboard(),
	User: new User(),
	Users: new Users(),
	Servers: new Servers(),
	Media: new Media(),
	Departments: new Departments(),
	CategoryBuilder: new CategoryBuilder(),
	RestAPISimulator: new RestAPISimulator()	
};



ko.applyBindings(viewModel);




"use strict";
$( document ).ready(function() {
	$('body').on('loaded.bs.modal', '#modal-widget-options', function(){
		ko.applyBindings( WidgetOptions, $(this).get(0));	
	})
	$('body').on('hidden.bs.modal', '#modal-widget-options', function(){	
		ko.cleanNode($(this).get(0));
	})
	
	$('body').on('loaded.bs.modal', '#modal-widget', function(){
		ko.applyBindings( WidgetModal, $(this).get(0));	
	})
	$('body').on('hidden.bs.modal', '#modal-widget', function(){	
		 ko.cleanNode($(this).get(0));
	})
	
	
	$('body').on('loaded.bs.modal', '#modal-user', function(){
		ko.applyBindings( User, $(this).get(0));	
	})
	$('body').on('hidden.bs.modal', '#modal-user', function(){	
		 ko.cleanNode($(this).get(0));
	})
	
	
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
	
	
	
})

















$(function(){

	$.notifyDefaults(
		{
			element: 'body',
			newest_on_top: true,
			type: 'warning',
			position: 'fixed',
			z_index: 1041,
			placement: {
				from: "top",
				align: "right"
			}
		}
	);

})





