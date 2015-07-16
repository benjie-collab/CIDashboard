(function($) {
$.fn.serializeFormJSON = function() {

   var o = {};
   var a = this.serializeArray();
   $.each(a, function() {
       if (o[this.name]) {
           if (!o[this.name].push) {
               o[this.name] = [o[this.name]];
           }
           o[this.name].push(this.value || '');
       } else {
           o[this.name] = this.value || '';
       }
   });
   return o;
};
})(jQuery);

























localStorage.setItem('widgets','');
var Settings = function() {
	var self = this;
	self.xhr	= '', 
	self.ajaxProcess = ko.observable(false),  
	self.formSubmit= function(el){	
		if(self.xhr)
		self.xhr.abort;

		self.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			data: $(el).serializeArray(),
			beforeSend: function(){self.ajaxProcess(true)},
			success: function(data){ 	
				self.ajaxProcess(false);	
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
			}
		})
	}.bind(self);
	
    self.connect= function(el){	
		if(self.xhr)
		self.xhr.abort;
		
		self.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			data: $(el).serializeArray(),
			beforeSend: function(){self.ajaxProcess(true)},
			success: function(bool){			
				if(bool == true){
					$.notify({
						message: 'Applying new configuration...'
						
					},{ type: 'warning' });
					location.reload();
					
				}else
					$.notify({
						message: 'Configuration not saved! Could not connect to the specified server. Please check and try again'
					},{
						type: 'danger'
					});
			},
			complete: function(){
				self.ajaxProcess(false)
			}
		})
		
	}.bind(self);	
}



var SearchTemplate = function() {
	var self = this;
	self.xhr	= '', 
    self.formSubmit= function(el){	
		if(self.xhr)
		self.xhr.abort;
		
		self.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			data: $(el).serializeArray(),
			success: function(data){ console.log(data);}
		})
		
	}.bind(self);
	self.removeWidget= function(data, e){		
		
		var item = $(e.currentTarget).closest('.draggable-widgets');
		item.fadeOut(function() {
			var form = item.closest('form');			
			$.when(item.remove()).then( 			
				form
				.trigger('submit')
			);
		});
		
		e.preventDefault();	
	}.bind(self);
	
}


var Document = function() {
	var self = this;
	self.xhr	= '', 
	self.ajaxProcess = ko.observable(false),    
	self.update = function(el){	
		if(self.xhr)
		self.xhr.abort;		
		
		var widgets = [], data = $(el).serializeArray(), widget=[];
		if($(el).attr('id') == "document_settings_form")
		$.map( JSON.parse(localStorage.getItem('widgets')), function( val, i ) {			
			$.map( JSON.parse(localStorage.getItem(val)), function( v, j ) {				
				widgets.push({ 'name' : val + '[]', value: v  } );
			});
		});
		
		
		self.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			dataType: "json",
			data: $.merge(data,  widgets  ),
			success: function(data){ 
				if(localStorage.getItem('redirect') == 'true')
					location.reload();
				
			}
		})		
		return false;
		
	}.bind(self);
	
}

var Pages = function() {
	var self = this;
	self.xhr	= '', 
	self.ajaxProcess = ko.observable(false),
	self.updatePage = function(el){	
		if(self.xhr)
		self.xhr.abort;		
		
		var widgets = [], data = $(el).serializeArray(), widget=[], formData, widget_containers = JSON.parse(localStorage.getItem('widgets'));
		
		if($(el).attr('id') == "page_settings_form" || $(el).hasClass('page_settings_form'))
		$.map( widget_containers, function( val, i ) {			
			$.map( JSON.parse(localStorage.getItem(val)), function( v, j ) {				
				widgets.push({ 'name' : val + '[]', value: v  } );
			});
		});
		
		
		formData = $.grep( data, function( n, i ) {	
						return $.inArray( n.name.replace(/\[]/g, ''), widget_containers )==-1;
					});
		
		self.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			dataType: "json",
			data: $.merge(formData,  widgets  ),
			beforeSend: function(){ self.ajaxProcess(true) },
			success: function(data){ 
				self.ajaxProcess(false);	
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
				
				
				
				if(localStorage.getItem('redirect') == 'true' && data.redirect)
					location.reload();
				
			}
		})
		return false;
		
	}.bind(self),
    self.addPage = function(el){	
		if(self.xhr)
		self.xhr.abort;	
		
		var widgets = [], data = $(el).serializeArray(), widget=[];
		
		if($(el).attr('id') == "page_edit_form")
		$.map( JSON.parse(localStorage.getItem('widgets')), function( val, i ) {			
			$.map( JSON.parse(localStorage.getItem(val)), function( v, j ) {				
				widgets.push({ 'name' : val + '[]', value: v  } );
			});
		})		
		self.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			dataType: "json",
			data: $.merge(data,  widgets  ),
			beforeSend: function(){ self.ajaxProcess(true) },
			success: function(data){ 		
				self.ajaxProcess(false);
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
		})	
		return false;
		
	}.bind(self),
	 self.configurePage = function(el){	
		if(self.xhr)
		self.xhr.abort;		
		
		var widgets = [], data = $(el).serializeArray(), widget=[];
		$.map( JSON.parse(localStorage.getItem('widgets')), function( val, i ) {			
			$.map( JSON.parse(localStorage.getItem(val)), function( v, j ) {				
				widgets.push({ 'name' : val + '[]', value: v  } );
			});
		});
		
		self.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			dataType: "json",
			data: $.merge(data,  widgets  ),
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
				
				if(localStorage.getItem('redirect') == 'true')
				location.reload();
			}
		})		
		return false;
		
	}.bind(self);
	
	
}





var Dashboard = function() {
	var self = this;
	self.xhr	= '', 
	self.ajaxProcess = ko.observable(false),
	self.remove = function(el){	
		
	}.bind(self);
	self.update = function(el){	
		if(self.xhr)
		self.xhr.abort;		
		
		var widgets = [], data = $(el).serializeArray(), widget=[];
		if($(el).attr('id') == "dashboard_settings_form")
		$.map( JSON.parse(localStorage.getItem('widgets')), function( val, i ) {			
			$.map( JSON.parse(localStorage.getItem(val)), function( v, j ) {				
				widgets.push({ 'name' : val + '[]', value: v  } );
			});
		});
		
		self.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			dataType: "json",
			data: $.merge(data,  widgets  ),
			success: function(data){ 				
				if(localStorage.getItem('redirect') == 'true')
				location.reload();
			}
		})		
		return false;
		
	}.bind(self);
	
}


var Search = function() {
	var self = this;
	self.xhr = '', 	
	self.ajaxProcess = ko.observable(false),
	self.update = function(el){	
		if(self.xhr)
		self.xhr.abort;		
		
		var widgets = [], data = $(el).serializeArray(), widget=[];
		if($(el).attr('id') == "search_settings_form")
		$.map( JSON.parse(localStorage.getItem('widgets')), function( val, i ) {			
			$.map( JSON.parse(localStorage.getItem(val)), function( v, j ) {				
				widgets.push({ 'name' : val + '[]', value: v  } );
			});
		});
		
		
		self.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			dataType: "json",
			data: $.merge(data,  widgets  ),
			success: function(data){ 
				if(localStorage.getItem('redirect') == 'true')
					location.reload();				
			}
		})		
		return false;
		
	}.bind(self);
	
}

var User = function() {
	var self = this;
	self.xhr	= '', 
	self.ajaxProcess = ko.observable(false),
	self.update = function(el){	
		if(self.xhr)
		self.xhr.abort;		
		
		var widgets = [], data = $(el).serializeArray(), widget=[];
		if($(el).attr('id') == "dashboard_settings_form")
		$.map( JSON.parse(localStorage.getItem('widgets')), function( val, i ) {			
			$.map( JSON.parse(localStorage.getItem(val)), function( v, j ) {				
				widgets.push({ 'name' : val + '[]', value: v  } );
			});
		});
		
		self.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			dataType: "json",
			data: $.merge(data,  widgets  ),
			success: function(data){ 				
				if(localStorage.getItem('redirect') == 'true')
				location.reload();
			}
		})		
		return false;
		
	}.bind(self);
	
}



var SearchSettings = function() {
	var self = this;
	self.xhr	= '';
	self.ajaxProcess = ko.observable(false),
    self.formSubmit= function(el){	
		if(self.xhr)
		self.xhr.abort;

		self.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			data: $(el).serializeArray(),
			beforeSend: function(){self.ajaxProcess(true)},
			success: function(data){ 
				self.ajaxProcess(false);				
			}
		})
	}.bind(self);
	
}


var Profile = function(keywords) {
	var self 			= this;
	self.xhr			= '';
	self.ajaxProcess 	= ko.observable(false),
    self.formSubmit		= function(el){	
		if(self.xhr)
		self.xhr.abort;

		self.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			data: $(el).serializeArray(),
			beforeSend: function(){self.ajaxProcess(true)},
			success: function(data){ 
				self.ajaxProcess(false);				
			}
		})
	}.bind(self);
	
    self.keywords 		= ko.observableArray(keywords);
 
    self.addKeyword 	= function() {
							self.keywords.push('');
						};
 
    self.removeKeyword = function(contact) {
							self.keywords.remove(contact);
						};
 
    self.save			= function() {
							self.lastSavedJson(JSON.stringify(ko.toJS(self.keywords), null, 2));
						}; 
    self.lastSavedJson = ko.observable("")
}



var WidgetModal = 
{ 	
	xhr	: '', 
	ajaxProcess: ko.observable(false),
	formSubmit: function(el){	
		if(WidgetModal.xhr)
		WidgetModal.xhr.abort;

		WidgetModal.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			data: $(el).serializeArray(),
			beforeSend: function(){WidgetModal.ajaxProcess(true)},
			success: function(data){ 
				WidgetModal.ajaxProcess(false);	
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
		})
		return false;
	}
}


var WidgetOptions = 
{ 	
	xhr	: '', 
	ajaxProcess: ko.observable(false),
	formSubmit: function(el){	
		if(WidgetOptions.xhr)
		WidgetOptions.xhr.abort;

		WidgetOptions.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			data: $(el).serializeArray(),
			beforeSend: function(){WidgetOptions.ajaxProcess(true)},
			success: function(data){ 
				WidgetOptions.ajaxProcess(false);	
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
		})
		return false;
	}
}



var Statistics = 
{ 	
	xhr	: '', 
	ajaxProcess: ko.observable(false),
	formSubmit: function(el){	
		if(Statistics.xhr)
		Statistics.xhr.abort;
		
		Statistics.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			data: $(el).serializeArray(),
			beforeSend: function(){Statistics.ajaxProcess(true)},
			success: function(data){
			
				Statistics.ajaxProcess(false);
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
		})
		return false;
	}
}









var GeoSpatial = function() {
 
	self 				= this;
	self.args			= {
							content: '',
							disableAutoPan: false,
							maxWidth: 0,
							pixelOffset: new google.maps.Size(-40, -205),
							zIndex: 150,
							boxStyle: {
								background: "",
								opacity: 1,
								width: "365px"
							},
							closeBoxMargin: "-5px -5px 0 0",
							closeBoxURL: "",
							infoBoxClearance: new google.maps.Size(1, 1),
							isHidden: false,
							pane: "floatPane",
							enableEventPropagation: false
							};
	self.dropMarkers 	= function(markers, mapInst){	
								for (var i = 0, marker; marker = markers[i]; i++) {
									marker.setMap(mapInst);										
								}	
							};	
	self.clearInfoBox	= function(markers, mapInst){	
								for (var i = 0, marker; marker = markers[i]; i++) {
									marker.infoBox.setMap(mapInst);										
								}	
							};
 
 }
 
 
 
 var GeoSpatialSearch = function(options) {
	self 				= this;
	self.drawingManager	= ko.observable();
	self.selectedShape	= ko.observable();
	self.previousShape	= ko.observable();
	self.colors 		= ko.observableArray(['#1E90FF', '#FF1493', '#32CD32', '#FF8C00', '#4B0082']);
	self.selectedColor	= ko.observable();
	self.colorButtons 	= ko.observable({});
	self.polyOptions	= ko.observable(
							{
							  strokeWeight: 0,
							  fillOpacity: 0.45,
							  editable: false,
							  draggable: false
							});	
 } 



var Servers = function() {
	var self = this;
	self.xhr	= '';
	self.ajaxProcess = ko.observable(false);
    self.createServer = function(el){	
		if(self.xhr)
		self.xhr.abort;	
			
		var data = $(el).serializeArray(), widget=[];
		self.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			dataType: "json",
			data: data,
			beforeSend: function(){ self.ajaxProcess(true) },
			success: function(data){ 		
				self.ajaxProcess(false);
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
		})	
		return false;
		
	}.bind(self);
	
	self.updateServer = function(el){	
		if(self.xhr)
		self.xhr.abort;	
		
		var data = $(el).serializeArray(), widget=[];
		self.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			dataType: "json",
			data: data,
			beforeSend: function(){ self.ajaxProcess(true) },
			success: function(data){ 		
				self.ajaxProcess(false);
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
		})	
		return false;
		
	}.bind(self)
	
}




var Media = function() {
	var self = this;
	self.xhr	= '';
	self.ajaxProcess = ko.observable(false);
    self.addMedia = function(el){	
		if(self.xhr)
		self.xhr.abort;	
			
		var formData = new FormData();
		
		
		$.each( $(el).find('input[type=file]')[0].files , function(i, file) {
			formData.append('files[]', file);
		});


		var data = $(el).serializeArray(), widget=[];
		self.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			//dataType: "json",
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			beforeSend: function(){ self.ajaxProcess(true) },
			success: function(data){ 		
				self.ajaxProcess(false);
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
		})	
		return false;
		
	}.bind(self);
	
	self.updateMedia = function(el){	
		if(self.xhr)
		self.xhr.abort;	
		
		var data = $(el).serializeArray(), widget=[];
		self.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			dataType: "json",
			data: data,
			beforeSend: function(){ self.ajaxProcess(true) },
			success: function(data){ 		
				self.ajaxProcess(false);
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
		})	
		return false;
		
	}.bind(self)
	
}


var CategoryBuilder = function() {
	var self = this;
	self.xhr	= '';
	self.ajaxProcess = ko.observable(false);
    self.createCategorization = function(el){	
		if(self.xhr)
		self.xhr.abort;	
		
		var tree = $("#category-builder-create").fancytree("getTree");
		var nodes = tree.toDict(true);		
		var data = $(el).serializeArray(), widget=[];
		data.push({ 'name' : 'nodes' , value: JSON.stringify(nodes)  } );
		self.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			dataType: "json",
			data: data,
			beforeSend: function(){ self.ajaxProcess(true) },
			success: function(data){ 		
				self.ajaxProcess(false);
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
		})	
		return false;
		
	}.bind(self);
	
	self.updateCategorization = function(el){	
		if(self.xhr)
		self.xhr.abort;	
		
		var tree = $("#category-builder-edit").fancytree("getTree");
		var nodes = tree.toDict(true);		
		var data = $(el).serializeArray(), widget=[];
		
		
		if(nodes){
			data.push({ 'name' : 'nodes' , value: JSON.stringify(nodes)  } );
			self.xhr =
			$.ajax({
				url: $(el).attr('action'),
				method: 'POST',
				dataType: "json",
				data: data,
				beforeSend: function(){ self.ajaxProcess(true) },
				success: function(data){ 		
					self.ajaxProcess(false);
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
			})	
		}else{
			$.notify({
				message: 'Category tree is not properly configured'
				},{
				type: 'danger'
				});
		}
		return false;
		
	}.bind(self)
	
}




var RestAPISimulator = function() {
	var self = this;
	self.xhr	= '';
	self.ajaxProcess = ko.observable(false);
	self.responseData = ko.observable({});	
	self.clearResponseData = function(el){
		self.responseData({});	
	};
    self.formSubmit = function(el){	
		if(self.xhr)
		self.xhr.abort;

		self.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			data: $(el).serializeArray(),
			beforeSend: function(){self.ajaxProcess(true)},
			success: function(data){ 
				self.responseData(data);
				self.ajaxProcess(false);				
			}
		});
		
		return false;
		
	}.bind(self);
	
	
	
}





var Departments = function() {
	var self = this;
	self.xhr	= '';
	self.ajaxProcess = ko.observable(false);
    self.createDepartment = function(el){	
		if(self.xhr)
		self.xhr.abort;	
			
		var data = $(el).serializeArray(), widget=[];
		self.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			dataType: "json",
			data: data,
			beforeSend: function(){ self.ajaxProcess(true) },
			success: function(data){ 		
				self.ajaxProcess(false);
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
		})	
		return false;
		
	}.bind(self);
	
	self.updateDepartment = function(el){	
		if(self.xhr)
		self.xhr.abort;	
		
		var data = $(el).serializeArray(), widget=[];
		self.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			dataType: "json",
			data: data,
			beforeSend: function(){ self.ajaxProcess(true) },
			success: function(data){ 		
				self.ajaxProcess(false);
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
		})	
		return false;
		
	}.bind(self)
	
}


var Users = function() {
	var self = this;
	self.xhr	= '';
	self.ajaxProcess = ko.observable(false);
    self.createUser = function(el){	
		if(self.xhr)
		self.xhr.abort;	
			
		var data = $(el).serializeArray(), widget=[];
		self.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			dataType: "json",
			data: data,
			beforeSend: function(){ self.ajaxProcess(true) },
			success: function(data){ 		
				self.ajaxProcess(false);
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
		})	
		return false;
		
	}.bind(self);
	
	self.updateUser = function(el){	
		if(self.xhr)
		self.xhr.abort;	
		
		var data = $(el).serializeArray(), widget=[];
		self.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			dataType: "json",
			data: data,
			beforeSend: function(){ self.ajaxProcess(true) },
			success: function(data){ 		
				self.ajaxProcess(false);
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
		})	
		return false;
		
	}.bind(self)
	
}


var Popover = 
{ 	
	xhr	: '', 
	ajaxProcess: ko.observable(false),
	formSubmit: function(el){	
		if(Popover.xhr)
		Popover.xhr.abort;

		Popover.xhr =
		$.ajax({
			url: $(el).attr('action'),
			method: 'POST',
			data: $(el).serializeArray(),
			beforeSend: function(){Popover.ajaxProcess(true)},
			success: function(data){ 
				Popover.ajaxProcess(false);				
			}
		})
		return false;
	}
}



