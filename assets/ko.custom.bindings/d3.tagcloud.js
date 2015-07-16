ko.bindingHandlers.D3TagCloud = {
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
		
		opts = 
		$.extend (		
			{
				height: $(element).height(),
				width: $(element).width(),
				fontMin: 8, 
				fontMax: 30,
				min:  50,
				max:  1000,
				font: 'Impact',
				padding: 5,
				termField: 'value',
				termCount: '@document_occurrences'
			},
			opts
		)
			
		
		var fill = d3.scale.category20b();
		
			if(opts.ajax)
			$.ajax({			
				url: opts.ajax,
				data: {},
				type: 'post',
				success: callback
			})
			else if(opts.source){	
				console.log(opts.source);
				callback(opts.source)
			}
				
				
			function callback(remoteData){	
				if(opts.ajax)
					remoteData = remoteData['autn:term'];
				  d3.layout.cloud()
					  .size([opts.width, opts.height])
					  /**.words([
						"When", "this", " option", " is ", "set ", "to", " a ", "number,", " the ", "specified ", "margin ", "applies to", " all the ", "sides ", "of the", " legend", ". ", "Alternatively,", " the margin ", "option ", "can be ", "set", " to an object.", " This ", "object ", "specifies ", "margins ", "for ", "each ", "side", " of ", "the", " legend ", "separately"]
						.map(function(d) {
							return {text: d, size: 8 + Math.random() * 20};
						  })
					   )**/
					  .words(
						remoteData
						.map(function(d) {
							return {
								text: d[opts.termField],
								size: 								
									 d[opts.termCount] == opts.min ? opts.fontMin
													: (d[opts.termCount] / opts.max) * (opts.fontMax - opts.fontMin) + opts.fontMin
								};
						  })
						)
					  .padding( opts.padding )
					  .rotate(function() { return ~~(Math.random() * 2) * 45; })
					  .font(opts.font)
					  .fontSize(function(d) { return d.size; })
					  .on("end", draw)			  
					  .start();	
			
			}
		 
		
		
		  function draw(words) {
			var viz = 
			d3.select(element)
			  //.append("div")
				//.classed("svg-container", true) //container class to make it responsive
			  .append("svg")				
				.attr("viewBox", "0 0 " + opts.width + " " + opts.height + "")
				.attr("preserveAspectRatio", "xMinYMin meet")
				//.classed("svg-content-responsive", true)
				//.attr("width", 400)
				//.attr("height", 400)				
			  .append("g")
				.attr("transform", "translate(" + opts.width/2 + ", " + opts.height/2 + ")")
			
			var text = 
			viz				
				.selectAll("text")
					  .data(words, function(d) { return d.text; });					  
				  text.transition()
					  .duration(1000)
					  .attr("transform", function(d) { return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")"; })
					  .style("font-size", function(d) { return d.size + "px"; });
				  text.enter().append("text")
					  .attr("text-anchor", "middle")
					  .attr("transform", function(d) { return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")"; })
					  .style("font-size", "1px")
					.transition()
					  .duration(1000)
					  .style("font-size", function(d) { return d.size + "px"; })
				  text.style("font-family", function(d) { return d.font; })
					  .style("fill", function(d) { return fill( d.text); })	  
					  .text(function(d) { return d.text; })		  
					  .style("cursor", "pointer")
					  
					.on("click", opts.click)
					  
					  
					 
				
		  }
		
		
		
		
	}
}