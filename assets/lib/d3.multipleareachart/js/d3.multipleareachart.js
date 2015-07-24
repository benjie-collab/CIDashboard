/**
var margin = {top: 10, right: 40, bottom: 150, left: 60},
		width = 940 - margin.left - margin.right,
		height = 500 - margin.top - margin.bottom,
		contextHeight = 50;
		contextWidth = width * .5;
	
self.svg = d3.select("#chart-container").append("svg")
						.attr("width", width + margin.left + margin.right)
						.attr("height", (height + margin.top + margin.bottom));**/
									
									
(function($) {

    $.fn.MultipleAreaChart = function(options) {

        var defaults = {				
					data: "",
					margin: {top: 10, right: 10, bottom: 150, left: 80},
					context: { width: 10, height: 50},
				};
		 
		var settings = $.extend( {}, defaults, options );
		
		
		return this.each( function() {
			
			var self = this;
			self.color = d3.scale.category20();
			self.canvas		= $(self).get(0);
			self.config		= settings;
			self.margin		= settings.margin;
			self.context	= settings.context;
			self.width		= $(self).width() - self.margin.left - self.margin.right;
			self.height		= $(self).height() - self.margin.top - self.margin.bottom - self.context.height;
						
			self.svg		= d3.select(self.canvas).append("svg")
							.attr("width", $(self).width()- self.margin.right)
							.attr("height", $(self).height());
			
			console.log(self.width);
			self.context['width'] = $(self).width()-self.margin.left- self.margin.right;
			
			
			
			
			
			
			d3.csv(self.config.data, dataReady);		
			
			function Chart(options){
				this.chartData = options.data;
				this.width = options.width;
				this.height = options.height;
				this.maxDataPoint = options.maxDataPoint;
				this.svg = options.svg;
				this.id = options.id;
				this.name = options.name;
				this.margin = options.margin;
				this.showBottomAxis = options.showBottomAxis;
				
				var localName = this.name;
				
				/* XScale is time based */
				this.xScale = d3.time.scale()
															.range([0, this.width])
															.domain(d3.extent(this.chartData.map(function(d) { return d.Year; })));
				
				/* YScale is linear based on the maxData Point we found earlier */
				this.yScale = d3.scale.linear()
															.range([this.height,0])
															.domain([0,this.maxDataPoint]);
				var xS = this.xScale;
				var yS = this.yScale;
				
				/* 
					This is what creates the chart.
					There are a number of interpolation options. 
					'basis' smooths it the most, however, when working with a lot of data, this will slow it down 
				*/
				this.area = d3.svg.area()
															.interpolate("basis")
															.x(function(d) { return xS(d.Year); })
															.y0(this.height)
															.y1(function(d) { return yS(d[localName]); });
				/*
					This isn't required - it simply creates a mask. If this wasn't here,
					when we zoom/panned, we'd see the chart go off to the left under the y-axis 
				*/
				this.svg.append("defs").append("clipPath")
																.attr("id", "clip-" + this.id)
																.append("rect")
																	.attr("width", this.width)
																	.attr("height", this.height);
				/*
					Assign it a class so we can assign a fill color
					And position it on the page
				*/
				this.chartContainer = self.svg.append("g")
																	.attr('class',this.name.toLowerCase())
																	.attr("transform", "translate(" + this.margin.left + "," + (this.margin.top + (this.height * this.id) + (10 * this.id)) + ")");
	
				/* We've created everything, let's actually add it to the page */
				this.chartContainer.append("path")
														.data([this.chartData])
														.attr("class", "chart")
														.attr("clip-path", "url(#clip-" + this.id + ")")
														.attr("fill",self.color(this.id))
														.attr("d", this.area);
												
				this.xAxisTop = d3.svg.axis().scale(this.xScale).orient("bottom");
				this.xAxisBottom = d3.svg.axis().scale(this.xScale).orient("top");
				/* We only want a top axis if it's the first country */
				if(this.id == 0){
					this.chartContainer.append("g")
								.attr("class", "x axis top")
								.attr("transform", "translate(0,0)")
								.call(this.xAxisTop);
				}
				
				/* Only want a bottom axis on the last country */
				if(this.showBottomAxis){
						this.chartContainer.append("g")
								.attr("class", "x axis bottom")
								.attr("transform", "translate(0," + this.height + ")")
								.call(this.xAxisBottom);
					}  
					
				this.yAxis = d3.svg.axis().scale(this.yScale).orient("left").ticks(5);
					
				this.chartContainer.append("g")
														.attr("class", "y axis")
														.attr("transform", "translate(-15,0)")
														.call(this.yAxis);
														
				this.chartContainer.append("text")
														.attr("class","country-title")
														.attr("transform", "translate(15,40)")
														.text(this.name);				
			}
				
			Chart.prototype.showOnly = function(b){
					this.xScale.domain(b);
					this.chartContainer.select("path").data([this.chartData]).attr("d", this.area);
					this.chartContainer.select(".x.axis.top").call(this.xAxisTop);
					this.chartContainer.select(".x.axis.bottom").call(this.xAxisBottom);
			}
			
			
			
			function dataReady(data){
				var countries = [];
				var charts = [];
				var maxDataPoint = 0;
				
				/* Loop through first row and get each country 
					and push it into an array to use later */
				for (var prop in data[0]) {
					if (data[0].hasOwnProperty(prop)) {
						if (prop != 'Year') {
							countries.push(prop);
						}
					}
				};
				
				var countriesCount = countries.length;
				var startYear = data[0].Year;
				var endYear = data[data.length - 1].Year;
				var chartHeight = self.height * (1 / countriesCount);
				
				/* Let's make sure these are all numbers, 
				we don't want javaScript thinking it's text 
				
				Let's also figure out the maximum data point
				We'll use this later to set the Y-Axis scale
				*/
				data.forEach(function(d) {
					for (var prop in d) {
						if (d.hasOwnProperty(prop)) {
							d[prop] = parseFloat(d[prop]);
							
							if (d[prop] > maxDataPoint) {
								maxDataPoint = d[prop];
							}
						}
					}
					
					// D3 needs a date object, let's convert it just one time
					d.Year = new Date(d.Year,0,1);
				});
	
				for(var i = 0; i < countriesCount; i++){
					charts.push(new Chart({
									data: data.slice(),
									id: i,
									name: countries[i],
									width: self.width,
									height: self.height * (1 / countriesCount),
									maxDataPoint: maxDataPoint,
									svg: self.svg,
									margin: self.margin,
									showBottomAxis: (i == countries.length - 1)
								}));
					
				}
				
				/* Let's create the context brush that will 
						let us zoom and pan the chart */
				var contextXScale = d3.time.scale()
													.range([0, self.context.width])
													.domain(charts[0].xScale.domain());	
				
				var contextAxis = d3.svg.axis()
													.scale(contextXScale)
													.tickSize(self.context.height)
													.tickPadding(-10)
													.orient("bottom");
				
				var contextArea = d3.svg.area()
													.interpolate("monotone")
													.x(function(d) { return contextXScale(d.date); })
													.y0(self.context.height)
													.y1(0);
	
				var brush = d3.svg.brush()
													.x(contextXScale)
													.on("brush", onBrush);
	
				var context = self.svg.append("g")
													.attr("class","context")
													.attr("transform", "translate(" + (self.margin.left) + "," + (self.height + self.margin.top + chartHeight) + ")");
				
				context.append("g")
													.attr("class", "x axis top")
													.attr("transform", "translate(0,0)")
													.call(contextAxis)
													
				context.append("g")
													.attr("class", "x brush")
													.call(brush)
													.selectAll("rect")
													.attr("y", 0)
													.style('fill', 'rgba(0, 0, 0, 0.1)')
													.style('visibility', 'visible')
													.attr("height", self.context.height);
				
				context.append("text")
									.attr("class","instructions")
									.attr("transform", "translate(0," + (self.context.height + 20) + ")")
									.text('Click and drag above to zoom / pan the data');
									
				 function onBrush(){
						/* this will return a date range to pass into the chart object */
						var b = brush.empty() ? contextXScale.domain() : brush.extent();
						for(var i = 0; i < countriesCount; i++){
							charts[i].showOnly(b);
						}
				}
				
			}
			
			
			
			
			
        });
    }
}(jQuery));