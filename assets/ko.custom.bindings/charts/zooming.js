ko.bindingHandlers.DXZooming = {
	init: function(element, valueAccessor, allBindingsAccessor, data, context){	
		var typed = false;		
		
		var options = valueAccessor();
        var newValueAccessor = function() {
            return function() {
                options.action.apply(data, options.params);
            };
        };
		
		
		/**
		var op = {
					title: options.title,
					dataSource: options.dataSource,		 
					series: options.series,
					valueAxis: options.valueAxis,
					argumentAxis: options.argumentAxis,
					customizePoint: options.customizePoint,		
					customizeLabel: options.customizeLabel,			
					commonSeriesSettings: options.commonSeriesSettings,
					commonPaneSettings: options.commonPaneSettings,
					tooltip: options.toolTip,	
					palette: options.palette,	
					legend: options.legend,	
					label: options.label,	
					pointClick: options.pointClick
					
				};**/
				
		
		
		var model = {};
			model.chartOptions = options.chartOptions;
			model.rangeOptions = options.rangeOptions;
		
		
		var html = [
			'<div id="ChartZooming">',
			'<div class="zoomedChart" data-bind="dxChart: chartOptions" style="height: 335px;margin: 0 0 15px"></div>',
			'<div data-bind="dxRangeSelector: rangeOptions" style="height: 80px"></div>',
			'</div>'
		].join('');

		jQuery(element).before(html);
		
		
		ko.utils.domData.set(element, "model", model);
		//ko.utils.domData.set(element, "range_options", options.rangeOptions);
		
		
		
		
				
		
		
		//jQuery(element).dxChart({});		
	},
	update: function(element, valueAccessor, allBindings) {
        // First get the latest data that we're bound to
        var value = valueAccessor();		
		if(jQuery(element).is(':visible')){
			ko.applyBindings(ko.utils.domData.get(element, 'model'), jQuery('#ChartZooming')[0]);
			//jQuery(element).dxChart(ko.utils.domData.get(element, 'options'));
		}
		
		
		
		
    }
}


