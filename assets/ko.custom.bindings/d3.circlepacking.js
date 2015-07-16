ko.bindingHandlers.D3CirclePacking = {
	init: function(element, valueAccessor, allBindingsAccessor){	
		var typed = false;
		var options =  jQuery.extend(valueAccessor(), {
							onChange: function (cm) {
								typed = true;
								allBindingsAccessor().value(cm.getValue());
								typed = false;
							}
						});
		
		
		
		ko.utils.domData.set(element, "options", options);
	
        
	},
		
		
		
		
	update: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
		var opts = ko.utils.domData.get(element, 'options');
		
		
		
		var $root = bindingContext.$root;
		
		
		var max = 131; // Should be computed
		var min = 1;   // Should be computed

		var radiusMin = 4;
		var radiusMax = 40;

		opts = $.extend(
				{
					termFrequency: 'frequency',
					termName: 'name',
					termUri: 'uri',
				},
				opts
			);
		
		
		
		
		
		var margin = {top: 0, right: 0, bottom: 0, left: 0},
		width = jQuery(element).width() - margin.left - margin.right,
		height = jQuery(element).height() - margin.top - margin.bottom;
		 
		var rect = [50,50, width - 50, height - 50];
		 
		var n = 20,
		m = 4,
		padding = 6,
		maxSpeed = 0.5,
		radius = d3.scale.sqrt().range([2, 20]),
		//color = d3.scale.category10().domain(d3.range(m));
		color = d3.scale.category10().domain(d3.range(1));
		var nodes = [];
		var things = ['Rock', 'Paper', 'Scissor'];
		 
		 /**
		for (i in d3.range(n)){
		nodes.push({
			radius: radius(1 + Math.floor(Math.random() * 4)),
			color: color(Math.floor(Math.random() * m)),
			x: rect[0] + (Math.random() * (rect[2] - rect[0])),
			y:rect[1] + (Math.random() * (rect[3] - rect[1])),
			speedX: (Math.random() - 0.5) * 2 *maxSpeed,
			speedY: (Math.random() - 0.5) * 2 *maxSpeed,
			name : things[Math.floor(Math.random()*things.length)]
			});
		}**/
		
			nodes = 
			
			jQuery.map( opts.data, function( n ) {
				return {
						//radius: radius(1 + parseInt(n.frequency)),
						radius: parseInt(n[opts.termFrequency]) == min ? radiusMin : (parseInt(n[opts.termFrequency]) / max) * (radiusMax - radiusMin) + radiusMin,
						color: color(Math.floor(Math.random() * m)),
						x: rect[0] + (Math.random() * (rect[2] - rect[0])),
						y:rect[1] + (Math.random() * (rect[3] - rect[1])),
						speedX: (Math.random() - 0.5) * 2 *maxSpeed,
						speedY: (Math.random() - 0.5) * 2 *maxSpeed,
						name : n[opts.termName],
						uri : n[opts.termUri],
						frequency : n[opts.termFrequency]
					};
			});
		
		
		 
		 
		var force = d3.layout.force()
		.nodes(nodes)
		.size([width, height])
		.gravity(0)
		.charge(0)
		.on("tick", tick)
		.start();
		 
		var svg = d3.select(jQuery(element).get(0)).append("svg")
		.attr("width", width + margin.left + margin.right)
		.attr("height", height + margin.top + margin.bottom)
		.append("g")
		//.attr("transform", "translate(" + margin.left + "," + margin.top + ")");
		 
		svg.append("svg:rect")
		.attr("width", rect[2] - rect[0])
		.attr("height", rect[3] - rect[1])
		.attr("x", rect[0])
		.attr("y", rect[1])
		.style("fill", "None")
		.style({"stroke": "#ddd", 'stroke-width': '1px' });
		 
		var circle = svg.selectAll("circle")
		.data(nodes)
		.enter().append("circle")
		.attr("r", function(d) { return d.radius; })
		.attr("cx", function(d) { return d.x; })
		.attr("cy", function(d) { return d.y; })
		.style("fill", function(d) { return d.color; })
		.style("cursor", "move")
		.call(force.drag);
		
		
		var texts = svg.selectAll("text.label")
			.data(nodes)
			.enter().append("svg:text")
			.attr("class", "label")
			//.attr("dx", "-22")
			.attr("dy", "0")
			.attr("text-anchor", "middle")
			.attr("font-size","11px")
			.text(function(d) { return  d.name; })
			.style("cursor", "pointer")
			.on("dblclick", $root.vSelectGenre)
			.call(force.drag);
			
			
		var freq = svg.selectAll("text.labal")
			.data(nodes)
			.enter().append("svg:text")
			.attr("class", "label")
			//.attr("dx", "-22")
			.attr("dy", "10")
			.attr("text-anchor", "middle")
			.attr("font-size","10px")
			.text(function(d) { return  '(' + d.frequency + ')'; })
			.style("cursor", "pointer")
			.call(force.drag);
			
			
		 
		var flag = false;
		function tick(e) {
			force.alpha(0.1)
			
			circle
			.each(gravity(e.alpha))
			.each(collide(.5))
			.attr("cx", function(d) { return d.x; })
			.attr("cy", function(d) { return d.y; });
			
			texts.attr("transform", function(d) {
				return "translate(" + d.x + "," + d.y + ")";
			});
			
			freq.attr("transform", function(d) {
				return "translate(" + d.x + "," + d.y + ")";
			});
			
			/**
			texts
			.each(gravity(e.alpha))
			.each(collide(.5))
			.attr("cx", function(d) { return d.x; })
			.attr("cy", function(d) { return d.y; });**/
		}
		 
		 
		 
		// Move nodes toward cluster focus.
		function gravity(alpha) {
		return function(d) {
		if ((d.x - d.radius - 2) < rect[0]) d.speedX = Math.abs(d.speedX);
		if ((d.x + d.radius + 2) > rect[2]) d.speedX = -1 * Math.abs(d.speedX);
		if ((d.y - d.radius - 2) < rect[1]) d.speedY = -1 * Math.abs(d.speedY);
		if ((d.y + d.radius + 2) > rect[3]) d.speedY = Math.abs(d.speedY);
		 
		d.x = d.x + (d.speedX * alpha);
		d.y = d.y + (-1 * d.speedY * alpha);
		 
		};
		}
		 
		// Resolve collisions between nodes.
		function collide(alpha) {
		var quadtree = d3.geom.quadtree(nodes);
		return function(d) {
		var r = d.radius + radius.domain()[1] + padding,
		nx1 = d.x - r,
		nx2 = d.x + r,
		ny1 = d.y - r,
		ny2 = d.y + r;
		quadtree.visit(function(quad, x1, y1, x2, y2) {
		if (quad.point && (quad.point !== d)) {
		var x = d.x - quad.point.x,
		y = d.y - quad.point.y,
		l = Math.sqrt(x * x + y * y),
		r = d.radius + quad.point.radius + (d.color !== quad.point.color) * padding;
		if (l < r) {
		l = (l - r) / l * alpha;
		d.x -= x *= l;
		d.y -= y *= l;
		quad.point.x += x;
		quad.point.y += y;
		}
		}
		return x1 > nx2
		|| x2 < nx1
		|| y1 > ny2
		|| y2 < ny1;
		});
		};
		}		
	}
}