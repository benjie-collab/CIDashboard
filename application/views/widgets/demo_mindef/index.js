"use strict";






(function($) {

    $.fn.DemoMindef = function(options) {

        var defaults = {				
					data	: "/k2dashboard/data/zooming.json",
					margin	: {top: 10, right: 10, bottom: 150, left: 80},
					context	: { width: 10, height: 50},
					chart	: 	{
									tooltip: {  
										enabled: true,
										shared: true 
									},
									crosshair: {
										enabled: true,
										horizontalLine: { visible: false },
										verticalLine: {
											opacity: 0.8
										}
									},
									commonSeriesSettings:{
										type: "bubble",
										argumentField: "date"										
									},        
									commonPaneSettings: {
										border: {
											visible: true,
											left: false,
											right: false,
											top: false
										}										
									},									
									commonAxisSettings: {										
										grid: {
											visible: false
										},
										title: { visible: false },
										label:{ visible: true},
										constantLineStyle: {
											width: 1,
											color: '#ccc',
											dashStyle: 'solid',
											label: {
												font: {
													size: 18,
													family: 'Rockwell',
													color: '#000000'
												}
											}
										}
									},
									argumentAxis: {
									   valueMarginsEnabled: false,
									   label: {
											visible: true,
											format: "shortDate"
										}
									},
									legend:{
										visible: false
									}
								},
					range	: 	{
									size: {
										height: 120
									},
									margin: {
										left: 0
									},
									behavior: {
										callSelectedRangeChanged: "onMoving"
									},
									scale: {
										showMinorTicks: false,
										minorTickInterval: "day",
										majorTickInterval: 'month',	
										startValue: null,
										endValue: null,
									},
									sliderMarker: {
										format: "monthAndDay"
									}
								}
				};
		 
		var settings = $.extend( {}, defaults, options );
		
		
		return this.each( function() {
			
			var self = this;
			
			
			self.config 	= settings;
			self.dataSource = null;
			self.chart		= $(self).find('.chart');
			self.selector	= $(self).find('.range-selector');
			self.form		= $('#demo_form');	
			self.zoomedChart = null;
			self.rangeSelector = null;
			self.startDate	= moment().startOf('year');
			self.endDate 	= moment().endOf('year');
			
			self.popover 	= $(self).find('.popover'), 											
			self.popoverArrow = $(self).find('.popover .arrow'), 
			self.popoverClose= $(self).find('.popover .popover-close');

					
			self.initChart = function(){
				var chartOptions={};
				
				chartOptions['dataSource'] 
							= self.dataSource;
				chartOptions['panes'] 
							= [{
									name: "P_1"
								}, {
									name: "P_2"
								}, {
									name: "P_3"
								}, {
									name: "P_4"
								}, {
									name: "P_5"
							}];
				chartOptions['series']
							= [{
									pane: "P_1",
									valueField: 'y1',
									sizeField: 'y1',
									tagField:'arg',
									name: "Barak Obama" 
								}, {
									pane: "P_2",
									valueField: 'y2',
									sizeField: 'y2',
									tagField:'arg',
									name: "John Kerry" 
								}, {
									pane: "P_3",
									valueField: 'y3',
									sizeField: 'y3',
									tagField:'arg',
									name: "Angela Merkel" 
								}, {
									pane: "P_4",
									valueField: 'y4',
									sizeField: 'y4',
									tagField:'arg',
									name: "Uhuru Kenyatta" 
								}, {
									pane: "P_5",
									valueField: 'y5',
									sizeField: 'y5',
									tagField:'arg',
									name: "Ashton Carter" 
							}];
							
				chartOptions['valueAxis'] 
							= [
								{	
									constantLines: [{											
										value: 0,
										label: {
											text: 'Barak Obama',
											position: 'inside'
										}
									}],
									min: 0,
									max: 300,
									showZero: true,
									pane: "P_1"
								}, {		
									constantLines: [{
										value: 0,
										label: {
											text: 'John Kerry'
										}
									}],
									min: 0,
									max: 300,
									showZero: true,
									pane: "P_2"
								}, {		
									constantLines: [{
										value: 0,
										label: {
											text: 'Angela Merkel'
										}
									}],
									min: 0,
									max: 300,
									showZero: true,
									pane: "P_3"
								}, {		
									constantLines: [{
										value: 0,
										label: {
											text: 'Uhuru Kenyatta'
										}
									}],
									min: 0,
									max: 300,
									showZero: true,
									pane: "P_4"
								}, {		
									constantLines: [{
										value: 0,
										label: {
											text: 'Ashton Carter'
										}
									}],
									min: 0,
									max: 300,
									showZero: true,
									pane: "P_5"
								}
							]
				chartOptions['pointClick'] 
							= function(point) {
								point.isSelected() ? point.clearSelection() : point.select();
								var e = this, ex = e.x ,ey = e.y, 
									ph = self.popover.outerHeight()+10,
									pw= self.popover.outerWidth()+10,
									fh =  $('footer.main-footer').outerHeight(),
									wh=$( window ).height(), ww=$( window ).width(), pos = 'right',											
									
									left = ex+10,
									top = 5,
									bottom = 'auto';											
									self.popover.show();
																		
									
									if((ex + pw) > ww){
										pos = 'left';
										left = ex - pw;
									}
									
									if((ex - pw) < 0){
										pos = 'right';
										left = ex;
									}
									
									
									if(ey > ph && ( (ey + ph) > wh ) ){
										bottom = 5;
										top = 'auto';
										console.log('bottom');	
										self.popoverArrow.css('top', 'auto');
										self.popoverArrow.css('bottom', (wh-ey-fh-20));
									}else if(ey < ph && ( (ey - ph) < 0 )	){
										top = 5;
										bottom = 'auto';
										console.log('top');
										self.popoverArrow.css('top', ey-5);
									}else{
										top = ey - (ph/2);
										bottom = 'auto';	
										console.log('middle');
										self.popoverArrow.removeAttr("style");
									}
									
														
									
									self.popover.removeClass('left right top bottom').addClass(pos);
									self.popover.css('left', left);
									self.popover.css('top', top);
									self.popover.css('bottom', bottom);
							}
				chartOptions['drawn'] 
							= function(){									
										
									}
				self.config.chart = $.extend({}, self.config.chart,chartOptions);
				$(self.chart).dxChart(self.config.chart);	
				self.zoomedChart = $(self.chart).dxChart("instance");	
			}.bind(self);
			
			self.initRange = function(){
				var rangeOptions = {};
				
				rangeOptions['dataSource'] 
								= self.dataSource;
				rangeOptions['chart'] 
								= {
									'series' : 
									[{
										argumentField: "date",
										valueField: "y1"
									}, {
										argumentField: "date",
										valueField: "y2"
									}, {
										argumentField: "date",
										valueField: "y3"
									}, {
										argumentField: "date",
										valueField: "y4"
									}, {
										argumentField: "date",
										valueField: "y5"
									}]
								};				
				rangeOptions['selectedRangeChanged'] 
								= function (e) {
									self.zoomedChart.zoomArgument(e.startValue, e.endValue);
								}					
				rangeOptions['selectedRange'] 
								= {
									startValue: self.startDate,
									endValue: self.endDate
								};
				rangeOptions['drawn'] 
								= function(){									
									self.zoomedChart.zoomArgument(self.startDate, self.endDate);
								};
								
				self.config.range = $.extend({}, self.config.range, rangeOptions);
				$(self.selector).dxRangeSelector(self.config.range);	
				self.rangeSelector	= $(self.selector).dxRangeSelector("instance");	
			}.bind(self);
			
			
			self.dataReady = function(d){	
				self.dataSource = d;
				var start=new Date(2014, 0, 1), end= new Date();
				
				self.dataSource = $.map(d, function(n, i){
					n['date'] = new Date(start.getTime() + Math.random() * (end.getTime() - start.getTime()));
					return n
				});
				self.initChart();
				self.initRange();
				
				
			}.bind(self);
			
			d3.json(self.config.data, self.dataReady);	
			
			
			/** Events **/
			self.popoverClose.on('click', function(){
				self.popover.hide();
			});
			self.form.on('submit', function(){
				return false;
			})
			self.form.find('[name=daterange]').on('change', function(){
				var drp = $(this).data('daterangepicker'),					
					def = {
								startValue: drp.startDate._d,
								endValue: drp.endDate._d
							};
				
					
				self.rangeSelector.setSelectedRange( def);
			})
			
			
			
        });
    }
	
}(jQuery));




$( document ).ready(function() {	
	
	$('#demo_mindef').DemoMindef();	

});