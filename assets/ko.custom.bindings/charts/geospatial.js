ko.bindingHandlers.Geospatial= {
	init: function(element, valueAccessor, allBindings, viewModel, bindingContext) { 
		var gssmodel= new GeoSpatialSearch({});
		var options =  jQuery.extend(valueAccessor(), {
							onChange: function (cm) {
								typed = true;
								allBindingsAccessor().value(cm.getValue());
								typed = false;
							}
						});	
		
		var location = { latitude: 34.513, longitude: -94.162} ;			
		if(localStorage.getItem('geolocation')){
			location = JSON.parse(localStorage.getItem('geolocation'));
		}
		
		var visual_options = ( ( "visual" in options ) ? options.visual : {}  ) ;
		
		visual_options = 
			$.extend(				
				{
					zoom: 4,
					minZoom: 1,
					maxZoom: 18,
					center: new google.maps.LatLng(location.latitude, location.longitude ),
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					scrollwheel: false,
					disableDefaultUI: true,
					panControl: false,
					zoomControl: true,
					mapTypeControl: false,
					scaleControl: false,
					streetViewControl: false,
					overviewMapControl: false					
				},
				visual_options				
			);
		var mapInst = new google.maps.Map( element, visual_options);
		function CoordMapType(tileSize) {
			this.tileSize = tileSize;
		}

		CoordMapType.prototype.getTile = function(coord, zoom, ownerDocument) {
			var div = ownerDocument.createElement('div');
			div.style.width = this.tileSize.width + 'px';
			div.style.height = this.tileSize.height + 'px';
			div.style.fontSize = '10';
			div.style.backgroundColor = '#33363b';
			div.style.opacity = '0.6';
			return div;
		};	
		mapInst.overlayMapTypes.insertAt(0, new CoordMapType(new google.maps.Size(256, 256)));
		
			
		
		gssmodel.drawingManager (new google.maps.drawing.DrawingManager({
									  //drawingMode: google.maps.drawing.OverlayType.POLYGON,
									  drawingControlOptions: {
										position: google.maps.ControlPosition.RIGHT_TOP,
										drawingModes: [
										  google.maps.drawing.OverlayType.CIRCLE,
										  google.maps.drawing.OverlayType.POLYGON,
										  google.maps.drawing.OverlayType.RECTANGLE
										]
									  },
									  rectangleOptions: gssmodel.polyOptions(),
									  circleOptions: gssmodel.polyOptions(),
									  polygonOptions: gssmodel.polyOptions(),
									  map: mapInst
									})
									);
		
		
		function clearSelection() {
			if (gssmodel.selectedShape()) {
			  gssmodel.selectedShape().setEditable(false);
			  gssmodel.selectedShape(null);
			}
		  };
		function selectColor(color) {
			gssmodel.selectedColor(color);
			var updtclr = gssmodel.colorButtons();
			    
			for (var i = 0; i < gssmodel.colors().length; ++i) {
			  var currColor = gssmodel.colors()[i];
			  updtclr[currColor].style.border = (currColor == color) ? '1px solid #000' : '1px solid #fff';
			}
			var rectangleOptions = gssmodel.drawingManager().get('rectangleOptions');
			rectangleOptions.fillColor = color;
			gssmodel.drawingManager().set('rectangleOptions', rectangleOptions);

			var circleOptions = gssmodel.drawingManager().get('circleOptions');
			circleOptions.fillColor = color;
			gssmodel.drawingManager().set('circleOptions', circleOptions);

			var polygonOptions = gssmodel.drawingManager().get('polygonOptions');
			polygonOptions.fillColor = color;
			gssmodel.drawingManager().set('polygonOptions', polygonOptions);
		  };
		function setSelection(shape) {
			clearSelection();
			gssmodel.selectedShape(shape);
			//shape.setEditable(true);
			selectColor(shape.get('fillColor') || shape.get('strokeColor'));
		  };
		function deleteSelectedShape() {
			if (gssmodel.selectedShape()) {
			  gssmodel.selectedShape().setMap(null);
			}
		  };
		function setSelectedShapeColor(color) {
			if (gssmodel.selectedShape()) {
			  if (gssmodel.selectedShape().type == google.maps.drawing.OverlayType.POLYLINE) {
				gssmodel.selectedShape().set('strokeColor', color);
			  } else {
				gssmodel.selectedShape().set('fillColor', color);
			  }
			}
		  };
		function makeColorButton(color) {
			var button = document.createElement('span');
			button.className = 'color-button';
			button.style.backgroundColor = color;
			google.maps.event.addDomListener(button, 'click', function() {
			  selectColor(color);
			  setSelectedShapeColor(color);
			});

			return button;
		  };
		function buildColorPalette() {	 
			 var 	div = document.createElement('div');
					div.setAttribute('class','margin-5');	
					
			 var 	delButton = document.createElement('div');
					delButton.setAttribute('class','btn btn-xs btn-danger btn-flat m-5');
					delButton.setAttribute('id','cm-geospatial-delete-button');
					delButton.innerHTML = 'Delete';					
					
			 var 	colorPalette = document.createElement('div');
					colorPalette.setAttribute('class','btn btn-xs btn-inverse');
					colorPalette.setAttribute('id','cm-geospatial-color-palette');
					
					
			 for (var i = 0; i < gssmodel.colors().length; ++i) {
			   var currColor = gssmodel.colors()[i];
			   var colorButton = makeColorButton(currColor);
			   colorPalette.appendChild(colorButton);
			   var updtclr = gssmodel.colorButtons();
			   updtclr[currColor] = colorButton;
			   gssmodel.colorButtons(updtclr);		   
			 }							
			div.appendChild(colorPalette);	
			mapInst.controls[google.maps.ControlPosition.RIGHT_TOP].push(div);	
			mapInst.controls[google.maps.ControlPosition.RIGHT_TOP].push(delButton);	
			
			google.maps.event.addDomListener(delButton, 'click', deleteSelectedShape);
			selectColor(gssmodel.colors()[0]);
		   };
							   
		

		google.maps.event.addListener(gssmodel.drawingManager(), 'overlaycomplete', function(e) {
			if(gssmodel.previousShape())
			gssmodel.previousShape().setMap(null);
			
			if (e.type != google.maps.drawing.OverlayType.MARKER) {
			// Switch back to non-drawing mode after drawing a shape.
			gssmodel.drawingManager().setDrawingMode(null);        
		   
			// Add an event listener that selects the newly-drawn shape when the user
			// mouses down on it.
			var newShape = e.overlay;
			newShape.type = e.type;
			google.maps.event.addListener(newShape, 'click', function() {
			  setSelection(newShape);
			});
			setSelection(newShape);
			
			var radius, center, polygon,
			NE,SW,NW,SE, bounds, rec= [], soptions=null;
			
			
			switch(e.type){
				
				case 'polygon'		: 		polygon = e.overlay.getPath().getArray();	        							
											polygon = jQuery.map( polygon, function( val, i ) {
															return val.toString().replace(/^\(|\)$/g, '');
													  });	        							
											rec = polygon.join("::");
											//soptions = Siloam.GeospatialOptions();
											//soptions['points'] = rec;
											//soptions['geotype'] = 'polygon';
											//delete soptions['type'];
											//delete soptions['rsz'];											
											//Siloam.GeospatialOptions(soptions);
											//obj.newSearch = new obj.searchUrl('0', null, null, null, rec, null )	        							
											//obj.doSearchMap();
											break;
				case 'circle'		:		center = e.overlay.getCenter();
											radius = e.overlay.getRadius();
											
											//soptions = Siloam.GeospatialOptions();
											//soptions['points'] = center.toString().replace(/^\(|\)$/g, '', null);
											//soptions['radius'] = radius;
											//soptions['geotype'] = 'circle';
											//Siloam.GeospatialOptions(soptions);
											break;
				case 'rectangle'	:		bounds = e.overlay.getBounds();
											NE = bounds.getNorthEast();
											SW = bounds.getSouthWest();
											NW = new google.maps.LatLng(NE.lat(),SW.lng());
											SE = new google.maps.LatLng(SW.lat(),NE.lng());
											
											rec.push(NE.toString().replace(/^\(|\)$/g, ''));
											rec.push(SE.toString().replace(/^\(|\)$/g, ''));
											rec.push(SW.toString().replace(/^\(|\)$/g, ''));
											rec.push(NW.toString().replace(/^\(|\)$/g, ''));

											//soptions = Siloam.GeospatialOptions();
											//soptions['points'] = rec.join("::");
											//soptions['geotype'] = 'polygon';
											//Siloam.GeospatialOptions(soptions);
											break;
				default 	:	
											break;
			
			}        
			gssmodel.previousShape(newShape);        
		  }
		});
		buildColorPalette();	
		
		options = 
			$.extend(	
				options,
				{ visual :visual_options }
			);
		google.maps.event.addListener(gssmodel.drawingManager(), 'drawingmode_changed', clearSelection);		
		ko.utils.domData.set(element, "ko_map", mapInst);
		ko.utils.domData.set(element, "ko_map_markers", null);
		ko.utils.domData.set(element, "options", options);
		
    },
	update: function(element, valueAccessor, allBindings, viewModel, bindingContext) {
		
		var gsmodel = new GeoSpatial();	
		//var opts = ko.utils.domData.get(element, 'options');
		var $root = bindingContext.$root;
		
		var i =0,
			markers = [],  
			//data = options['data'],
			//entity = Siloam.Entities()[0],
			data = [],
			entity = {},
			marker=null, 
			latLng=null, 
			markerImage=null,
			mapInst = ko.utils.domData.get(element, 'ko_map'),
			domMarkers = ko.utils.domData.get(element, 'ko_map_markers'),
			opts = ko.utils.domData.get(element, 'options')
			visual_options = ( ( "visual" in opts ) ? opts.visual : {}  ) ;			
		
		if(domMarkers!==null){
			gsmodel.dropMarkers(domMarkers, null);	
			gsmodel.clearInfoBox(domMarkers, null);					
		}
		
		var styles = JSON.parse(localStorage.getItem('googleMapStyles'))[visual_options.theme];
		var styledMapType = new google.maps.StyledMapType(
							styles, { name: visual_options.theme });
		mapInst.mapTypes.set(visual_options.theme, styledMapType);
		
		var preview = $(element).closest('#widget_options_form');		
		if(preview.length > 0){	
			var subs = 
			$root['ajaxProcess'].subscribe(function(value) {
				if(value==false)
				$.ajax({
					method: 'POST',
					url: opts.ajax,
					data: $(preview).serializeArray(),
					beforeSend: function(){
						gsmodel.dropMarkers(markers, null);	
						gsmodel.clearInfoBox(markers, null);
					},
					success: function(data){						
						var values = [], arguments = [];
						
						initialize(data)			
					},
					complete: function(data){
						
					}
				});
			});	

			$('body').on('hide.bs.modal', jQuery(element).closest('.modal').get(0), function () {
				subs.dispose();
			})						
		}
			
		if(jQuery(element).is(':visible') && !opts.event){
			update();	
		}else if(opts.event == 'carousel'){	
			if(jQuery(element).is(':visible'))
			update();
			$(element).closest('.carousel').on('slid.bs.carousel', function(){	
				if($(element).closest('.item').hasClass('active'))
				update();			
			})			
		}else if(opts.event == 'modal'){
			if(jQuery(element).is(':visible'))
			update();
			$(element).closest('.modal').on('shown.bs.modal', function(){
				update();			
			})			
		}else if(opts.event == 'tab'){
			if(jQuery(element).is(':visible'))
			update();
			
			var id= $(element).closest('.tab-pane').attr('id');
			$('[data-toggle="tab"][data-target="#' + id + '"]').on('shown.bs.tab', function(){	
				if($(element).closest('.tab-pane').hasClass('active'))
				update();			
			})
			$('[data-toggle="tab"][href="#' + id + '"]').on('shown.bs.tab', function(){	
				if($(element).closest('.tab-pane').hasClass('active'))
				update();			
			})
		}else{		
			//update();	
		}	
		
		
		function update(){	
			if(opts.event)
			$.ajax({
				method: 'POST',
				url: opts.ajax,
				data: opts.post_data,
				success: initialize
			});	
			else
				initialize(opts)
			
		}
		
		function initialize(data) {
			visual_options = ( ( "visual" in data ) ? data.visual : {}  ) ;				
			
			mapInst.setOptions(visual_options)
			google.maps.event.trigger(mapInst,'resize');

			styledMapType = new google.maps.StyledMapType(
							styles, { name: visual_options.theme });
			mapInst.mapTypes.set(visual_options.theme, styledMapType);
		
			var source = [
				{ center: { lat: 11.943008, lng: 109.043512} },
				{ center: { lat: 12.943008, lng: 111.043512} },
				{ center: { lat: 13.943008, lng: 119.043512} },
				{ center: { lat: 14.943008, lng: 69.043512} },
				{ center: { lat: 15.943008, lng: 99.043512} },
				{ center: { lat: 11.943008, lng: 79.043512} },
				{ center: { lat: 11.943008, lng: 101.043512} },
			]
			if(source.length>0) {		
					var marker_shape = visual_options.marker_shape? marker_shapes[visual_options.marker_shape]: marker_shapes['SQUARE_PIN'];
					for (var i = 0; i < source.length; i++) {
						latLng = new google.maps.LatLng(source[i].center.lat, source[i].center.lng);
						/**markerImage = new google.maps.MarkerImage(
									entity.icon,
									null,ss
									null,
									new google.maps.Point(24, 45),
									new google.maps.Size(48, 48)
									
									);**/					
						
						/**marker = new google.maps.Marker({
							position: latLng,
							icon: markerImage,
							draggable: false,
							title: data[i].NameValue,
							visible: true,
							animation: google.maps.Animation.DROP
						  });**/
						 marker =  new Marker({
										title: 'Map Icons',
										position: latLng,
										zIndex: 9,										
										icon: {
											path: marker_shape,
											fillColor: visual_options.marker_color || '#0E77E9',
											fillOpacity: 1,
											strokeColor: '#ffffff',
											rotation :0,
											strokeWeight: 1,
											scale: 1/2
										},
										label: '<i class="map-icon-subway-station"></i>'
									})
						  
						  
						//var title = data[i].NameValue;
						//var fileurl = 'wp-content/plugins/siloam/img/profiles/hospital.gif';//data[i].tbUrl;

						
						  
						var infoHtml = '<div class="google-info-box">' +
							'<a class="google-info-box-close google-info-box-close colabs-sc-button green small"><i class="fa fa-remove"></i></a>' +'<div class="marker-holder">'+
									'<div class="marker-content with-image"><img src="http://preview.ait-themes.com/directory/wp1/wp-content/uploads//bigstock-Pepperoni-Pizza-Slice-2471467-aff220d7599a4d750dbcb14c002c9523.jpg" alt="">'+
										'<div class="map-item-info">'+
											'<div class="title">'+"Pizza House JARO"+'</div>'+
											'<div class="address">'+"66 Pearl Street, New York, NY 10000, United States"+'</div>'+
											'<a href="http://preview.ait-themes.com/directory/wp1/item/jaro-pizza-2/" class="btn btn-sm btn-flat btn-success">' + "VIEW MORE" + '</a>'+
											'</div><div class="arrow-down"></div>'+
										'</div>'+
									'</div>'+
								'</div>' + 
								'</div>';						
							marker.infoBox = new InfoBox(gsmodel.args);
							marker.infoBoxHtml = infoHtml;
						
						var fn = function() {							
											var infoBox = marker.infoBox;										
											infoBox.setContent(this.infoBoxHtml);
											infoBox.open(mapInst, this);
											google.maps.event.addListener(infoBox, 'domready', function () {
												var infoBoxClose = document.getElementsByClassName("google-info-box-close");
												infoBoxClose[0].addEventListener('click', function() {
													infoBox.close(mapInst, marker);
												}, false);
											});
										 };
										 
						google.maps.event.addListener(marker, 'click', fn);
						markers.push(marker);
					}				
						
					gsmodel.dropMarkers(markers, mapInst);				
					ko.utils.domData.set(element, "ko_map_markers", markers);
			}
		}
	}
	
	
}