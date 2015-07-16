ko.bindingHandlers.DXMap = {	
	init: function(element, valueAccessor, allBindings) {
	
		var typed = false;		
		
		var options = valueAccessor();
        var newValueAccessor = function() {
            return function() {
                options.action.apply(data, options.params);
            };
        };
		
		/**
		jQuery('#LocationSwitchType').change(function () {
			
			var vectorMap = jQuery(element).dxVectorMap('instance');
			console.log(vectorMap);
			vectorMap.option({
				markerSettings: { type: this.value }
			});
		});**/
		
		
		var options = valueAccessor();
        var newValueAccessor = function() {
            return function() {
                options.action.apply(data, options.params);
            };
        };
		
		
		
		ko.utils.domData.set(element, "options", options);		
		
		
	
	
	},
	update: function(element, valueAccessor, allBindings) {
        
		var config = ko.utils.domData.get(element, 'options');
		console.log(config.options);
		/**
		var nameToIndexMap = {
				'Indonesia': 1,
			};		**/
			
		jQuery(element).dxVectorMap(config.options);
			/**
		jQuery(element).dxVectorMap({
			mapData: DevExpress.viz.map.sources.world,
			markers: options.markers,
			zoomFactor: 16,
			background: { color: '#f1f1f1', borderColor: '#f1f1f1'},
			center: [120,-2],
			markerSettings: {
				palette: 'Violet',
				font: { size: 11 },
				type: options.type,
				opacity: 0.9,
				borderColor: 'rgba(255,255,255, 0.6)',
				borderWidth: 5,
				hoveredBorderColor: 'rgba(255,255,255, 1.0)',
				hoveredBorderWidth: 5,
				click: function (marker) {
					marker.selected(!marker.selected());
				},
				selectedColor: 'dodgerblue'
			},
			areaSettings: {
				palette: 'Soft',
				paletteSize: 5,
				hoverEnabled: false,
				customize: function (arg) {
					var paletteIndex = nameToIndexMap[arg.attributes.name];
					return paletteIndex >= 0 ? {
						paletteIndex: paletteIndex
					} : null;
				}
			}
			
		});**/
		
			
			
			
			
			
			
			/**
			
		var markers = [
			{
				coordinates: [115.2167, -8.6500],
				text: 'Bali' ,
				value: 20,
				values: [2, 12, 6]
			},
			{
				coordinates: [106.8167, -6.2000],
				text: 'Jakarta' ,
				value: 15,
				values: [5, 1, 9]
			},
			{ 
				coordinates: [139.7167, -5.5333],
				text:  'Papua' ,
				value: 5,
				 values: [3, 1, 1]
			},
			{
				coordinates: [110.3644, -7.8014],
				text: 'Yogyakarta' ,
				value: 10,
				values: [5, 2, 3]
			},
			{
				coordinates: [95.3167, 5.5500],
				text: 'Aceh' ,
				value: 6,
				values: [3, 1, 2]
			},
			{
				coordinates: [112.7500, -7.2667],
				text: 'East Java' ,
				value: 8,
				values: [2, 2, 4]
			},
			{
				coordinates: [107.5000, -6.7500],
				text: 'West Java' ,
				value: 16,
				values: [3, 9, 4]
			},
			{
				coordinates: [110.0000, -7.5000],
				text: 'Central Java' ,
				value: 13,
				values: [7, 2, 4]
			},
			{
				coordinates: [106.2500, -6.5000],
				text: 'Banten' ,
				value: 4,
				values: [2, 1, 1]
			},
			{
				coordinates: [116.3167, -1.0500],
				text: 'east kalimantan' ,
				value: 11,
				values: [4, 1, 6]
			}	
			
		];
**/
		
		
		
		
		
    }
}


