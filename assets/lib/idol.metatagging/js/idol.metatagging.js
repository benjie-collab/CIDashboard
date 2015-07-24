(function($) {

    $.fn.MetaTagging = function(options) {

        var defaults = {					
					'el_zoom': '#zoom',
					'el_show_groups': '#showGroups',
					'el_search': '#search',
					'el_search': '#search',
					'el_search': '#search',
					
					"type": "network",
					"data": "",
					"version": "1.0",
					"legend": {
						"nodeLabel": "A twitter account.",
						"edgeLabel": "A follower/followee relationship between two accounts",
						"colorLabel": "Colour represents an automatic grouping of users according to who they are most connected to."
					},
					"features": {
						"search": {
							"enabled": true
						},
						"hoverBehaviour": "default",
						"groupSelector": {
							"enabled": true,
							"attribute": "whatAttributeShouldWeGroupBy"
						}
					},
					"informationPanel": {
						"groupByEdgeDirection": false,
						"imageAttribute": "Image File"
					},
					"sigma": {
						"drawingProperties":{    
							"defaultLabelColor": "#000",
							"defaultLabelSize": 14,
							"defaultLabelBGColor": "#ddd",
							"defaultHoverLabelBGColor": "#002147",
							"defaultLabelHoverColor": "#fff",
							"labelThreshold": 10,
							"defaultEdgeType": "curve",
							"hoverFontStyle": "bold",
							"fontStyle": "bold",
							"activeFontStyle": "bold"
						},
						"graphProperties":{
							"minNodeSize": 1,
							"maxNodeSize": 7,
							"minEdgeSize": 0.2,
							"maxEdgeSize": 0.5
						},		
						"mouseProperties":{
							"minRatio": 0.75, 
							"maxRatio": 20
						}
					}
					
				};
		 
		var settings = $.extend( {}, defaults, options );
		
		
		return this.each( function() {
			
			var self = this;
			
			
			
        });

    }

}(jQuery));







