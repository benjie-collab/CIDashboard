function SigmaNetwork(settings){
	var self 		= this;
	self.xhr		= '';
	self.sigInst	= '';
	self.canvas		= '';
	self._GP		= '';
	self.config		= settings;
	self.size		= function(obj){
						var size = 0, key;
						for (key in obj) {
							if (obj.hasOwnProperty(key)) size++;
						}
						return size;
					}.bind(self);
	self.initSigma	= function(){
						var data=self.config.data
	
						var drawProps, graphProps,mouseProps;
						if (self.config.sigma && self.config.sigma.drawingProperties) 
							drawProps=self.config.sigma.drawingProperties;
						else
							drawProps={
							defaultLabelColor: "#000",
							defaultLabelSize: 14,
							defaultLabelBGColor: "#ddd",
							defaultHoverLabelBGColor: "#002147",
							defaultLabelHoverColor: "#fff",
							labelThreshold: 10,
							defaultEdgeType: "curve",
							hoverFontStyle: "bold",
							fontStyle: "bold",
							activeFontStyle: "bold"
						};
						
						if (self.config.sigma && self.config.sigma.graphProperties)	
							graphProps=self.config.sigma.graphProperties;
						else
							graphProps={
							minNodeSize: 1,
							maxNodeSize: 7,
							minEdgeSize: 0.2,
							maxEdgeSize: 0.5
							};
						
						if (self.config.sigma && self.config.sigma.mouseProperties) 
							mouseProps=self.config.sigma.mouseProperties;
						else
							mouseProps={
							minRatio: 0.75, // How far can we zoom out?
							maxRatio: 20, // How far can we zoom in?
							};
						
						var a = sigma.init(document.getElementById("sigma-canvas")).drawingProperties(drawProps).graphProperties(graphProps).mouseProperties(mouseProps);
						sigInst = a;
						a.active = !1;
						a.neighbors = {};
						a.detail = !1;


						dataReady = function() {//This is called as soon as data is loaded
							a.clusters = {};

							a.iterNodes(
								function (b) { //This is where we populate the array used for the group select box

									// note: index may not be consistent for all nodes. Should calculate each time. 
									 // alert(JSON.stringify(b.attr.attributes[5].val));
									// alert(b.x);
									a.clusters[b.color] || (a.clusters[b.color] = []);
									a.clusters[b.color].push(b.id);//SAH: push id not label
								}
							
							);
						
							a.bind("upnodes", function (a) {
								self.nodeActive(a.content[0])
							});

							a.draw();
							self.configSigmaElements();
						}

						if (data.indexOf("gexf")>0 || data.indexOf("xml")>0)
							a.parseGexf(data,dataReady);
						else
							a.parseJson(data,dataReady);
						gexf = sigmaInst = null;
					}.bind(self);

	self.configSigmaElements = function() {
					
					// Node hover behaviour
					if (self.config.features.hoverBehaviour == "dim") {

						var greyColor = '#ccc';
						sigInst.bind('overnodes',function(event){
						var nodes = event.content;
						var neighbors = {};
						sigInst.iterEdges(function(e){
						if(nodes.indexOf(e.source)<0 && nodes.indexOf(e.target)<0){
							if(!e.attr['grey']){
								e.attr['true_color'] = e.color;
								e.color = greyColor;
								e.attr['grey'] = 1;
							}
						}else{
							e.color = e.attr['grey'] ? e.attr['true_color'] : e.color;
							e.attr['grey'] = 0;

							neighbors[e.source] = 1;
							neighbors[e.target] = 1;
						}
						}).iterNodes(function(n){
							if(!neighbors[n.id]){
								if(!n.attr['grey']){
									n.attr['true_color'] = n.color;
									n.color = greyColor;
									n.attr['grey'] = 1;
								}
							}else{
								n.color = n.attr['grey'] ? n.attr['true_color'] : n.color;
								n.attr['grey'] = 0;
							}
						}).draw(2,2,2);
						}).bind('outnodes',function(){
						sigInst.iterEdges(function(e){
							e.color = e.attr['grey'] ? e.attr['true_color'] : e.color;
							e.attr['grey'] = 0;
						}).iterNodes(function(n){
							n.color = n.attr['grey'] ? n.attr['true_color'] : n.color;
							n.attr['grey'] = 0;
						}).draw(2,2,2);
						});

					} else if (self.config.features.hoverBehaviour == "hide") {

						sigInst.bind('overnodes',function(event){
							var nodes = event.content;
							var neighbors = {};
						sigInst.iterEdges(function(e){
							if(nodes.indexOf(e.source)>=0 || nodes.indexOf(e.target)>=0){
								neighbors[e.source] = 1;
								neighbors[e.target] = 1;
							}
						}).iterNodes(function(n){
							if(!neighbors[n.id]){
								n.hidden = 1;
							}else{
								n.hidden = 0;
						  }
						}).draw(2,2,2);
						}).bind('outnodes',function(){
						sigInst.iterEdges(function(e){
							e.hidden = 0;
						}).iterNodes(function(n){
							n.hidden = 0;
						}).draw(2,2,2);
						});

					}
					self._GP.bg = $(sigInst._core.domElements.bg);
					self._GP.bg2 = $(sigInst._core.domElements.bg2);
					var a = [],
						b,x=1;
						for (b in sigInst.clusters) a.push('<div style="line-height:12px"><a href="#' + b + '"><div style="width:40px;height:12px;border:1px solid #fff;background:' + b + ';display:inline-block"></div> Group ' + (x++) + ' (' + sigInst.clusters[b].length + ' members)</a></div>');
					//a.sort();
					self._GP.cluster.content(a.join(""));
					b = {
						minWidth: 400,
						maxWidth: 800,
						maxHeight: 600
					};//        minHeight: 300,
					$("a.fb").fancybox(b);
					$("#zoom").find("div.z").each(function () {
						var a = $(this),
							b = a.attr("rel");
						a.click(function () {
							if (b == "center") {
								sigInst.position(0,0,1).draw();
							} else {
								var a = sigInst._core;
								sigInst.zoomTo(a.domElements.nodes.width / 2, a.domElements.nodes.height / 2, a.mousecaptor.ratio * ("in" == b ? 1.5 : 0.5));		
							}

						})
					});
					self._GP.mini.click(function () {
						self._GP.mini.hide();
						self._GP.intro.show();
						self._GP.minifier.show()
					});
					self._GP.minifier.click(function () {
						self._GP.intro.hide();
						self._GP.minifier.hide();
						self._GP.mini.show()
					});
					self._GP.intro.find("#showGroups").click(function () {
						!0 == self._GP.showgroup ? showGroups(!1) : showGroups(!0)
					});
					a = window.location.hash.substr(1);
					if (0 < a.length) switch (a) {
					case "Groups":
						showGroups(!0);
						break;
					case "information":
						$.fancybox.open($("#information"), b);
						break;
					default:
						self._GP.search.exactMatch = !0, self._GP.search.search(a)
						self._GP.search.clean();
					}

				}.bind(self);

	self.Search = function (a) {
					this.input = a.find("input[name=search]");
					this.state = a.find(".state");
					this.results = a.find(".results");
					this.exactMatch = !1;
					this.lastSearch = "";
					this.searching = !1;
					var b = this;
					this.input.focus(function () {
						var a = $(this);
						a.data("focus") || (a.data("focus", !0), a.removeClass("empty"));
						b.clean()
					});
					this.input.keydown(function (a) {
						if (13 == a.which) return b.state.addClass("searching"), b.search(b.input.val()), !1
					});
					this.state.click(function () {
						var a = b.input.val();
						b.searching && a == b.lastSearch ? b.close() : (b.state.addClass("searching"), b.search(a))
					});
					this.dom = a;
					this.close = function () {
						this.state.removeClass("searching");
						this.results.hide();
						this.searching = !1;
						this.input.val("");//SAH -- let's erase string when we close
						self.nodeNormal()
					};
					this.clean = function () {
						this.results.empty().hide();
						this.state.removeClass("searching");
						this.input.val("");
					};
					this.search = function (a) {
						var b = !1,
							c = [],
							b = this.exactMatch ? ("^" + a + "$").toLowerCase() : a.toLowerCase(),
							g = RegExp(b);
						this.exactMatch = !1;
						this.searching = !0;
						this.lastSearch = a;
						this.results.empty();
						if (2 >= a.length) this.results.html("<i>You must search for a name with a minimum of 3 letters.</i>");
						else {
							sigInst.iterNodes(function (a) {
								g.test(a.label.toLowerCase()) && c.push({
									id: a.id,
									name: a.label
								})
							});
							c.length ? (b = !0, self.nodeActive(c[0].id)) : b = self.showCluster(a);
							a = ["<b>Search Results: </b>"];
							if (1 < c.length) for (var d = 0, h = c.length; d < h; d++) a.push('<a href="#' + c[d].name + '" onclick="nodeActive(\'' + c[d].id + "')\">" + c[d].name + "</a>");
							0 == c.length && !b && a.push("<i>No results found.</i>");
							1 < a.length && this.results.html(a.join(""));
						   }
						if(c.length!=1) this.results.show();
						if(c.length==1) this.results.hide();   
					}
				}.bind(self);

	self.Cluster = function (a) {
					this.cluster = a;
					this.display = !1;
					this.list = this.cluster.find(".list");
					this.list.empty();
					this.select = this.cluster.find(".select");
					this.select.click(function () {
						self._GP.cluster.toggle()
					});
					this.toggle = function () {
						this.display ? this.hide() : this.show()
					};
					this.content = function (a) {
						this.list.html(a);
						this.list.find("a").click(function () {
							var a = $(this).attr("href").substr(1);
							self.showCluster(a)
						})
					};
					this.hide = function () {
						this.display = !1;
						this.list.hide();
						this.select.removeClass("close")
					};
					this.show = function () {
						this.display = !0;
						this.list.show();
						this.select.addClass("close")
					}
				}.bind(self);
	self.showGroups = function(a) {
					a ? (self._GP.intro.find("#showGroups").text("Hide groups"), self._GP.bg.show(), self._GP.bg2.hide(), self._GP.showgroup = !0) : (self._GP.intro.find("#showGroups").text("View Groups"), self._GP.bg.hide(), self._GP.bg2.show(), self._GP.showgroup = !1)
				}.bind(self);

	self.nodeNormal = function () {
					!0 != self._GP.calculating && !1 != sigInst.detail && (self.showGroups(!1), self._GP.calculating = !0, sigInst.detail = !0, self._GP.info.delay(400).animate({width:'hide'},350),self._GP.cluster.hide(), sigInst.iterEdges(function (a) {
						a.attr.color = !1;
						a.hidden = !1
					}), sigInst.iterNodes(function (a) {
						a.hidden = !1;
						a.attr.color = !1;
						a.attr.lineWidth = !1;
						a.attr.size = !1
					}), sigInst.draw(2, 2, 2, 2), sigInst.neighbors = {}, sigInst.active = !1, self._GP.calculating = !1, window.location.hash = "")
				}.bind(self);

	self.nodeActive = function (a) {

					var groupByDirection=false;
					if (self.config.informationPanel.groupByEdgeDirection && self.config.informationPanel.groupByEdgeDirection==true)	groupByDirection=true;
					
					sigInst.neighbors = {};
					sigInst.detail = !0;
					var b = sigInst._core.graph.nodesIndex[a];
					self.showGroups(!1);
					var outgoing={},incoming={},mutual={};//SAH
					sigInst.iterEdges(function (b) {
						b.attr.lineWidth = !1;
						b.hidden = !0;
						
						n={
							name: b.label,
							colour: b.color
						};
						
					   if (a==b.source) outgoing[b.target]=n;		//SAH
					   else if (a==b.target) incoming[b.source]=n;		//SAH
					   if (a == b.source || a == b.target) sigInst.neighbors[a == b.target ? b.source : b.target] = n;
					   b.hidden = !1, b.attr.color = "rgba(0, 0, 0, 1)";
					});
					var f = [];
					sigInst.iterNodes(function (a) {
						a.hidden = !0;
						a.attr.lineWidth = !1;
						a.attr.color = a.color
					});
					
					if (groupByDirection) {
						//SAH - Compute intersection for mutual and remove these from incoming/outgoing
						for (e in outgoing) {
							//name=outgoing[e];
							if (e in incoming) {
								mutual[e]=outgoing[e];
								delete incoming[e];
								delete outgoing[e];
							}
						}
					}
					
					var createList=function(c) {
						var f = [];
						var e = [],
							 //c = sigInst.neighbors,
							 g;
					for (g in c) {
						var d = sigInst._core.graph.nodesIndex[g];
						d.hidden = !1;
						d.attr.lineWidth = !1;
						d.attr.color = c[g].colour;
						a != g && e.push({
							id: g,
							name: d.label,
							group: (c[g].name)? c[g].name:"",
							colour: c[g].colour
						})
					}
					e.sort(function (a, b) {
						var c = a.group.toLowerCase(),
							d = b.group.toLowerCase(),
							e = a.name.toLowerCase(),
							f = b.name.toLowerCase();
						return c != d ? c < d ? -1 : c > d ? 1 : 0 : e < f ? -1 : e > f ? 1 : 0
					});
					d = "";
						for (g in e) {
							c = e[g];
							/*if (c.group != d) {
								d = c.group;
								f.push('<li class="cf" rel="' + c.color + '"><div class=""></div><div class="">' + d + "</div></li>");
							}*/
							f.push('<li class="membership"><a href="#' + c.name + '" onmouseover="sigInst._core.plotter.drawHoverNode(sigInst._core.graph.nodesIndex[\'' + c.id + '\'])\" onclick=\"nodeActive(\'' + c.id + '\')" onmouseout="sigInst.refresh()">' + c.name + "</a></li>");
						}
						return f;
					}
					
					/*console.log("mutual:");
					console.log(mutual);
					console.log("incoming:");
					console.log(incoming);
					console.log("outgoing:");
					console.log(outgoing);*/
					
					
					var f=[];
					
					//console.log("neighbors:");
					//console.log(sigInst.neighbors);

					if (groupByDirection) {
						size=self.size(mutual);
						f.push("<h2>Mututal (" + size + ")</h2>");
						(size>0)? f=f.concat(createList(mutual)) : f.push("No mutual links<br>");
						size=self.size(incoming);
						f.push("<h2>Incoming (" + size + ")</h2>");
						(size>0)? f=f.concat(createList(incoming)) : f.push("No incoming links<br>");
						size=self.size(outgoing);
						f.push("<h2>Outgoing (" + size + ")</h2>");
						(size>0)? f=f.concat(createList(outgoing)) : f.push("No outgoing links<br>");
					} else {
						f=f.concat(createList(sigInst.neighbors));
					}
					//b is object of active node -- SAH
					b.hidden = !1;
					b.attr.color = b.color;
					b.attr.lineWidth = 6;
					b.attr.strokeStyle = "#000000";
					sigInst.draw(2, 2, 2, 2);

					self._GP.info_link.find("ul").html(f.join(""));
					self._GP.info_link.find("li").each(function () {
						var a = $(this),
							b = a.attr("rel");
					});
					f = b.attr;
					if (f.attributes) {
						var image_attribute = false;
						if (self.config.informationPanel.imageAttribute) {
							image_attribute=self.config.informationPanel.imageAttribute;
						}
						e = [];
						temp_array = [];
						g = 0;
						for (var attr in f.attributes) {
							var d = f.attributes[attr],
								h = "";
							if (attr!=image_attribute) {
								h = '<span><strong>' + attr + ':</strong> ' + d + '</span><br/>'
							}
							//temp_array.push(f.attributes[g].attr);
							e.push(h)
						}

						if (image_attribute) {
							//image_index = jQuery.inArray(image_attribute, temp_array);
							self._GP.info_name.html("<div><img src=" + f.attributes[image_attribute] + " style=\"vertical-align:middle\" /> <span onmouseover=\"sigInst._core.plotter.drawHoverNode(sigInst._core.graph.nodesIndex['" + b.id + '\'])" onmouseout="sigInst.refresh()">' + b.label + "</span></div>");
						} else {
							self._GP.info_name.html("<div><span onmouseover=\"sigInst._core.plotter.drawHoverNode(sigInst._core.graph.nodesIndex['" + b.id + '\'])" onmouseout="sigInst.refresh()">' + b.label + "</span></div>");
						}
						// Image field for attribute pane
						self._GP.info_data.html(e.join("<br/>"))
					}
					self._GP.info_data.show();
					self._GP.info_p.html("Connections:");
					self._GP.info.animate({width:'show'},350);
					self._GP.info_donnees.hide();
					self._GP.info_donnees.show();
					sigInst.active = a;
					window.location.hash = b.label;
				}.bind(self);

	self.showCluster = function (a) {
					var b = sigInst.clusters[a];
					if (b && 0 < b.length) {
						self.showGroups(!1);
						sigInst.detail = !0;
						b.sort();
						sigInst.iterEdges(function (a) {
							a.hidden = !1;
							a.attr.lineWidth = !1;
							a.attr.color = !1
						});
						sigInst.iterNodes(function (a) {
							a.hidden = !0
						});
						for (var f = [], e = [], c = 0, g = b.length; c < g; c++) {
							var d = sigInst._core.graph.nodesIndex[b[c]];
							!0 == d.hidden && (e.push(b[c]), d.hidden = !1, d.attr.lineWidth = !1, d.attr.color = d.color, f.push('<li class="membership"><a href="#'+d.label+'" onmouseover="sigInst._core.plotter.drawHoverNode(sigInst._core.graph.nodesIndex[\'' + d.id + "'])\" onclick=\"nodeActive('" + d.id + '\')" onmouseout="sigInst.refresh()">' + d.label + "</a></li>"))
						}
						sigInst.clusters[a] = e;
						sigInst.draw(2, 2, 2, 2);
						self._GP.info_name.html("<b>" + a + "</b>");
						self._GP.info_data.hide();
						self._GP.info_p.html("Group Members:");
						self._GP.info_link.find("ul").html(f.join(""));
						self._GP.info.animate({width:'show'},350);
						self._GP.search.clean();
						self._GP.cluster.hide();
						return !0
					}
					return !1
				}.bind(self);
				
				
	
	
	if (self.config.legend.nodeLabel) {
		$(".node").next().html(self.config.legend.nodeLabel);
	} else {
		//hide more information link
		$(".node").hide();
	}
	// Edge
	if (self.config.legend.edgeLabel) {
		$(".edge").next().html(self.config.legend.edgeLabel);
	} else {
		//hide more information link
		$(".edge").hide();
	}
	// Colours
	if (self.config.legend.nodeLabel) {
		$(".colours").next().html(self.config.legend.colorLabel);
	} else {
		//hide more information link
		$(".colours").hide();
	}

	self._GP = {
		calculating: !1,
		showgroup: !1
	};
	self._GP.intro = $("#intro");
	self._GP.minifier = self._GP.intro.find("#minifier");
	self._GP.mini = $("#minify");
	self._GP.info = $("#attributepane");
	self._GP.info_donnees = self._GP.info.find(".nodeattributes");
	self._GP.info_name = self._GP.info.find(".name");
	self._GP.info_link = self._GP.info.find(".link");
	self._GP.info_data = self._GP.info.find(".data");
	self._GP.info_close = self._GP.info.find(".returntext");
	self._GP.info_close2 = self._GP.info.find(".close");
	self._GP.info_p = self._GP.info.find(".p");
	self._GP.info_close.click(self.nodeNormal);
	self._GP.info_close2.click(self.nodeNormal);
	self._GP.form = $("#mainpanel").find("form");
	self._GP.search = new self.Search(self._GP.form.find("#search"));
	if (!self.config.features.search.enabled == true) {
		$("#search").hide();
	}
	if (!self.config.features.groupSelector.enabled == true) {
		$("#attributeselect").hide();
	}
	self._GP.cluster = new self.Cluster(self._GP.form.find("#attributeselect"));
	
	self.initSigma();

}