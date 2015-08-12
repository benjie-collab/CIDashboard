"use strict";
(function($) {

    $.fn.dxMultiplePanes = function(options) {

        var defaults = {				
					data	: {
								url: "/k2dashboard/data/zooming.json",
								parameters: {}
							},
					margin	: {top: 10, right: 10, bottom: 150, left: 80},
					context	: { width: 10, height: 50},
					startDate: moment().startOf('year').subtract(1, 'y'), 
					endDate: moment().startOf('year').subtract(1, 'y').add(3, 'M'),
					chart	: 	{
									dataSource: [],
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
											left: true,
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
										grid:{
											visible: false
										},
										argumentType: 'datetime',
										label: {
											visible: true,
											format: "shortTime"
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
										minorTickInterval: "minutes",
										majorTickInterval: 'hours',	
										startValue: null,
										endValue: null,
									},
									sliderMarker: {
										format: "shortTime"
									}
								}
				};
		
		var settings = $.extend( {}, defaults, options );
		
		return this.each( function() {
			
			var self = this;
			self.rainbow = new Rainbow();
						
			self.dataSource 	= [];
			self.panes 			= [];
			self.chartSeries 	= [];
			self.valueAxis 		= [];
			self.rangeSeries 	= [];
			self.legends 		= {};
			
			self.config 	= settings;
			self.chart		= $(self).find('.dx-chart').first();
			self.selector	= $(self).find('.dx-range-selector').first();
			self.form		= $('.dx-multiple-panes-form').first();	
			self.playBtn	= $('.dx-multiple-panes-form').first().find('.play-button').first();
			self.subPanes	= $(self).find('.sub-panes').first();
			self.legend		= $(self).find('.legend').first(); 
			self.zoomedChart = null;
			self.rangeSelector = null;			
			self.interval 	= null;
			self.popover 	= $(self).find('.popover').first(), 											
			self.popoverArrow = $(self).find('.popover .arrow').first(), 
			self.popoverClose= $(self).find('.popover .popover-close').first();
			
			
			
			self.startDate	= self.config.startDate;
			self.endDate 	= self.config.endDate;
			self.pointSelected= null;

					
			self.initChart = function(){
				var chartOptions={};
				
				chartOptions['dataSource'] 
							= self.dataSource;
				chartOptions['panes'] 
							= self.panes;
				chartOptions['series']
							= self.chartSeries;
							
				chartOptions['valueAxis'] 
							= self.valueAxis
							/**[
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
							]**/
				chartOptions['pointClick'] = self.pointSelect;
				chartOptions['drawn'] 
							= function(){									
										
									}
				self.config.chart = $.extend({}, self.config.chart,chartOptions);
				$(self.chart).dxChart('instance').option(self.config.chart);
			}.bind(self);
			
			self.initRange = function(){
				var rangeOptions = {};
				
				rangeOptions['dataSource'] 
								= self.dataSource;
				rangeOptions['chart'] 
								= {
									'series' :  self.rangeSeries
									/**
									[{
										argumentField: "date",
										valueField: "y1",
									}, {
										argumentField: "date",
										valueField: "y2",
									}, {
										argumentField: "date",
										valueField: "y3",
									}, {
										argumentField: "date",
										valueField: "y4",
									}, {
										argumentField: "date",
										valueField: "y5",
									}]**/
								};				
				rangeOptions['selectedRangeChanged'] 
								= function (e) {
									$(self.chart).dxChart('instance').zoomArgument(e.startValue, e.endValue);
									//=self.startDate = e.startValue;
									//self.endDate = e.endValue;
								}					
				rangeOptions['selectedRange'] 
								= {
									//startValue: self.startDate,
									//endValue: self.endDate
								};
				rangeOptions['drawn'] 
								= function(e){	
									var def = {
										startValue: self.startDate.toDate(),
										endValue: self.endDate.toDate()
									};
									//$(self.selector).dxRangeSelector("instance").setSelectedRange(def);
									//self.zoomedChart.zoomArgument(e.startValue, e.endValue);
								};
								
				self.config.range = $.extend({}, self.config.range, rangeOptions);
				$(self.selector).dxRangeSelector("instance").option(self.config.range);
			}.bind(self);
			
			
			self.initLegends = function(){
				$.each(self.legends, function(v,i){
					self.legend.append('<li class="text-capitalize"><i class="fa fa-circle" style="color: ' + i + '"></i> ' + v + '</li>');
				})
			}.bind(self);
			
			self.pointSelect = function (point, e) {
				point.isSelected() ? point.clearSelection() : point.select();
				var ex = e.clientX ,ey = e.clientY, 
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
					self.popover.css({'left': left, 'top': top, 'bottom': bottom});
			}.bind(self);

			
			self.playInterval = function () {				
				var
				def = {
								startValue: self.startDate.toDate(),
								endValue: self.endDate.toDate()
							};	
				$(self.selector).dxRangeSelector("instance").setSelectedRange(def);									
				self.startDate = moment(self.startDate).add(1, 'days');
				self.endDate = moment(self.startDate).add(60, 'days');
				if(self.endDate == self.config.endDate )
					clearInterval(self.interval);
			}.bind(self);
			
			
			self.toggleInterval = function (e) {
				if(e){
					self.playBtn.toggleClass( "active" );
				}				
				if(self.playBtn.hasClass('active'))
				    self.interval = setInterval(self.playInterval, 250);	
				else{
					clearInterval(self.interval);
				}
			}.bind(self);
			
			self.initSubPanes = function(){				
				var h = $(self).height();
				self.subPanes.css('height', h-100 + 'px');
			}.bind(self);
			
			
			self.dataReady = function(d){
				var cnt=1, dates=[];
				self.rainbow.setNumberRange(0, d.response.legend.length);
				/** Legend/Panes **/
				cnt=1;
				self.panes = $.map(d.response.data, function(v, i){
					return { name: i };
				});				
				$.map(d.response.legend, function(v, i){
					self.legends[v]= '#' + self.rainbow.colourAt(cnt);
					cnt++;
				});
				
				/** Data Source **/
				cnt=1;
				self.dataSource = $.map(d.response.data, function(v, i){
					var z={};
					z = $.map(v, function(o, j){
							var p={}, key='s_'+cnt, cats=[];
							p[key] = i;
							p['date']= new Date(o.date);													
							
							cats = $.grep(d.response.legend, function( legend, index  ) {
									  return ( legend+'YAxis' in o && legend+'Frequency' in o );
									});
									
							$.map(cats, function(p, k){
								o[i+p+'YAxis']= o[p+'YAxis'];
								o[i+p+'Frequency']=o[p+'Frequency'];
							});						
							dates.push(p.date);	
							return $.extend({}, o, p);
						});
					cnt++;
					return z;
				});				
				
				/** Series **/
				$.each(d.response.legend, function(index, legend ){	
					var chSeries = $.map(d.response.data, function(v, i){
										var z={};										
										z['pane']= i;
										z['valueField']= i+legend+'Frequency';
										z['sizeField']= i+legend+'Frequency';
										z['tagField']= i+legend+'YAxis';
										z['name']= i + " : " + legend;
										z['color']= self.legends[legend];
										return z;
									});
					var rgSeries = $.map(d.response.data, function(v, i){
										var z={};		
										z['valueField']= i+legend+'YAxis';
										z['argumentField']= 'date';
										return z;
									});
					self.chartSeries = $.merge(
						self.chartSeries,
						chSeries
					);
					self.rangeSeries = $.merge(
						self.rangeSeries,
						rgSeries
					);
				});
				/** Value Axis/ Constant Lines **/
				self.valueAxis = $.map(d.response.data,function(v, i){										
										var z = {};
										z['pane'] = i;
										z['constantLines'] = [{											
															value: 0,
															label: {
																text: i,
																position: 'inside'
															}
														}];
										z['min'] = 0;
										z['max'] = 300;
										z['showZero'] = true;
										return z;
									});
				self.initLegends();	
				self.initChart();
				self.initRange();
				self.toggleInterval();
				self.initSubPanes();
			}.bind(self);	
			
			
			
			
			
			
			$(self.chart).dxChart({dataSource: [],
			loadingIndicator: {
				backgroundColor: 'lightcyan',
				font: {
					size: 16
				}
			}});			
			$(self.selector).dxRangeSelector({dataSource: [],
			loadingIndicator: {
				backgroundColor: 'lightcyan',
				font: {
					size: 16
				}
			}});
			
			$.ajax({
				url: $(self).data('url'),
				type: 'POST',
				dataType: 'json',
				data: $(self).data('parameters'),
				beforeSend: function(){					
					$(self.chart).dxChart("instance").showLoadingIndicator();
					$(self.selector).dxRangeSelector("instance").showLoadingIndicator();
				},
				success: self.dataReady,
				error: function(e, f){
				}
			});			
			
			//Events 
			self.popoverClose.on('click', function(){
				self.popover.hide();
			});
			$(window).on('resize', function(){
				self.popover.hide();
			});
			$(window).on('resize', self.initSubPanes);
			self.form.on('submit', function(){
				return false;
			})
			self.form.find('[name=daterange]').on('change', function(){
				var drp = $(this).data('daterangepicker'),					
					def = {
								startValue: drp.startDate.toDate(),
								endValue: drp.endDate.toDate()
							};
				$(self.selector).dxRangeSelector("instance").setSelectedRange(def);
			});
			self.playBtn.on('click', self.toggleInterval);
        });
    }
	
}(jQuery));




$( document ).ready(function() {	
	
	$('.dx-multiple-panes').dxMultiplePanes();	

});