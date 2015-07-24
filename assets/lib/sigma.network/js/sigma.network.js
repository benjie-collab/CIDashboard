sigma.utils.pkg('sigma.canvas.nodes');
sigma.canvas.nodes.image = (function() {
  var _cache = {},
	  _loading = {},
	  _callbacks = {};

  // Return the renderer itself:
  var renderer = function(node, context, settings) {
	var args = arguments,
		prefix = settings('prefix') || '',
		size = node[prefix + 'size'],
		color = node.color || settings('defaultNodeColor'),
		url = node.url;

	if (_cache[url]) {
	  context.save();

	  // Draw the clipping disc:
	  context.beginPath();
	  context.arc(
		node[prefix + 'x'],
		node[prefix + 'y'],
		node[prefix + 'size'],
		0,
		Math.PI * 2,
		true
	  );
	  context.closePath();
	  context.clip();

	  // Draw the image
	  context.drawImage(
		_cache[url],
		node[prefix + 'x'] - size,
		node[prefix + 'y'] - size,
		2 * size,
		2 * size
	  );

	  // Quit the "clipping mode":
	  context.restore();

	  // Draw the border:
	  context.beginPath();
	  context.arc(
		node[prefix + 'x'],
		node[prefix + 'y'],
		node[prefix + 'size'],
		0,
		Math.PI * 2,
		true
	  );
	  context.lineWidth = size / 5;
	  context.strokeStyle = node.color || settings('defaultNodeColor');
	  context.stroke();
	} else {
	  sigma.canvas.nodes.image.cache(url);
	  sigma.canvas.nodes.def.apply(
		sigma.canvas.nodes,
		args
	  );
	}
  };

  // Let's add a public method to cache images, to make it possible to
  // preload images before the initial rendering:
  renderer.cache = function(url, callback) {
	if (callback)
	  _callbacks[url] = callback;

	if (_loading[url])
	  return;

	var img = new Image();

	
	img.onload = function() {
	  _loading[url] = false;
	  _cache[url] = img;

	  if (_callbacks[url]) {
		_callbacks[url].call(this, img);
		delete _callbacks[url];
	  }
	};

	_loading[url] = true;
	img.src = url;
  };

  return renderer;
})();



sigma.classes.graph.addMethod('neighbors', function(nodeId) {
var k,
	neighbors = {},
	index = this.allNeighborsIndex[nodeId] || {};

for (k in index)
  neighbors[k] = this.nodesIndex[k];

return neighbors;
});




(function($) {

    $.fn.SigmaNetwork = function(options) {

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
			self.sigInst	= '';
			self.canvas		= $(self).get(0);
			self.g			= {nodes: [], edges:[]};
			self.G			= {nodes: [], edges:[]};
			self.config		= settings;
			self.filter		= null;
			
			
			
			
			
			self.nodeActive = function(e){
				var nodeId = e.data.node.id,
					toKeep = self.sigInst.graph.neighbors(nodeId);
				toKeep[nodeId] = e.data.node;

				self.sigInst.graph.nodes().forEach(function(n) {
				  if (toKeep[n.id])
					n.color = n.originalColor;
				  else
					//n.color = '#eee';
					n.hidden = true;
				});

				self.sigInst.graph.edges().forEach(function(e) {
				  if (toKeep[e.source] && toKeep[e.target])
					e.color = e.originalColor;
				  else
					//e.color = '#eee';
					e.hidden = true;
				});
				
				self.sigInst.refresh();
			}.bind(self);

			self.nodeOver = function(e){
				var nodeId = e.data.node.id,
					toKeep = self.sigInst.graph.neighbors(nodeId);
				toKeep[nodeId] = e.data.node;

				self.sigInst.graph.nodes().forEach(function(n) {
				  if (toKeep[n.id])
					n.color = n.originalColor;
				  else if(!n.hidden)
					n.color = '#eee';
				});

				self.sigInst.graph.edges().forEach(function(e) {
				  if (toKeep[e.source] && toKeep[e.target])
					e.color = e.originalColor;
				   else if(!e.hidden)
					e.color = '#eee';
				});
				
				self.sigInst.refresh();
			}.bind(self);

			self.nodeOut = function(e){
				self.sigInst.graph.nodes().forEach(function(n) {	 		
					if(!e.hidden)
					n.color = n.originalColor;
				});
				self.sigInst.graph.edges().forEach(function(e) {
					if(!e.hidden)
					e.color = e.originalColor;
				});
				
				self.sigInst.refresh();
			}.bind(self);

			self.nodeNormal = function(e){
				self.sigInst.graph.nodes().forEach(function(n) {	 
					n.color = n.originalColor;
					n.hidden = false;
				});
				self.sigInst.graph.edges().forEach(function(e) {
					e.color = e.originalColor;
					e.hidden = false;
				});
				
				self.sigInst.refresh();
			}.bind(self);


			self.applyCategoryFilter = function(e){
				var c = e.target[e.target.selectedIndex].value;
				 self.filter
				  .undo('node-category')
				  .nodesBy(function(n) {		
					return !c.length || n.type === c;
				  }, 'node-category')
				  .apply();
			}.bind(self);

			
			self.cacheImages =  function(){
				$.map(self.G.nodes, function(n, i){		
					sigma.canvas.nodes.image.cache(
						n.url,
						function(e) {
							if (++i === self.G.nodes.length){						
								self.initSigma();								
							}
						}
					  );				
				})
			}.bind(self);
			
			self.transformNodes =  function(){
				var N = self.g.nodes.length;
				self.G.nodes=
				$.map(self.g.nodes, function(n, i){		
					n['originalColor'] = n.color;
					n['x'] =  Math.cos(2 * i * Math.PI / N);
					n['y'] =  Math.cos(2 * i * Math.PI / N);
					return n;
				});
			}.bind(self);
			
			self.transformEdges =  function(){					
				self.G.edges=
				$.map(self.g.edges, function(e, i){	
					e['originalColor'] = e.color;
					e['size'] =Math.random();
					e['type'] =['line', 'curve', 'arrow', 'curvedArrow'][Math.random() * 3 | 0]
					return e;
				});		
			}.bind(self);	
			
			
			self.setPlugins = function(){	
				sigma.renderers.def = sigma.renderers.canvas;
				self.filter	= new sigma.plugins.filter(self.sigInst);				
			}.bind(self);	
			
			self.initPlugins = function(){	
				sigma.plugins.dragNodes(self.sigInst, self.sigInst.renderers[0]);				
			}.bind(self);
			

			self.initSigma =  function(){				
				self.sigInst = new sigma({
					  graph: self.G,
					  /**renderer: {
						// IMPORTANT:
						// This works only with the canvas renderer, so the
						// renderer type set as "canvas" is necessary here.
						container: self.canvas,
						type: 'canvas'
					  },**/
					  container: self.canvas,
					  settings: {
						minNodeSize: 5,
						maxNodeSize: 10,
						//drawEdges: false
					  }
					});				
				self.initPlugins();		  
				self.sigInst.bind("clickNode", self.nodeActive);
				self.sigInst.bind("overNode", self.nodeOver);
				self.sigInst.bind("outNode", self.nodeOut);
				self.sigInst.bind("clickStage", self.nodeNormal);	
				
				//self.sigInst.startForceAtlas2();
						
			}.bind(self);			
			
			self.dataReady =  function(g){
				self.g=g;
				self.setPlugins();
				self.transformNodes();
				self.transformEdges();				
				self.cacheImages(); //callback to initSigma once ready					
			}.bind(self);
			
			d3.json(self.config.data, self.dataReady);		
        });

    }

}(jQuery));







