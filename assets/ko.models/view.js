

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





