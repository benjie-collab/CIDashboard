(function($) {
"use strict";
    $.fn.Parametric = function(options) {

        var defaults = {				
					url	: "/k2dashboard/api/categorization/",
					data	: "/k2dashboard/data/zooming.json",
					fancytree: { 
								init: function(event, data){},
								renderNode: function(event, data){	
									var node = data.node;
									var ndata = node.data;						
									if(ndata.expand == true)
									node.setExpanded();
									return false;
								},
								  checkbox: true,
								  source: [],
								  /**
								  lazyLoad: function(event, data){
									 var node = data.node;
									  data.result = {
										url: '<?=base_url('parametric/tag_values')?>',
										data: {mode: 'children', parent: node.key, fieldname: node.title},
										cache: true
									  };
								  },**/
								  selectMode: 3,
								  select: function(event, data){
										
								  },
									dblclick: function(event, data) {
										data.node.toggleSelected();
									},
									keydown: function(event, data) {
										if( event.which === 32 ) {
											data.node.toggleSelected();
											return false;
										}
									}
							}
				};
		 
		var settings = $.extend( {}, defaults, options );	
		
		
		return this.each( function() {
			
			var self 		= $( this );
			self.config 	= settings;
			self.dropDown	= $(self).find('.parametric_dp:eq(0)');	
			self.view 		= $(self).find('.parametric_view:eq(0)');
			self.inst 		= null;	
			
			
			self.dpChange = function(){				
				var id = self.dropDown.val();
				self.inst = self.view.fancytree('getTree');
				self.inst.
				reload({
					url: self.config.url + id,
					type: 'GET',
					dataType: 'json'
				  });	
			
			}.bind(self);

			self.init = function(){	
				var id = self.dropDown.val();
				self.view.fancytree(self.config.fancytree);
				self.inst = self.view.fancytree('getTree');
				if(id)
				self.inst.
				reload({
					url: self.config.url + id,
					type: 'GET',
					dataType: 'json'
				  });
			}.bind(self);
			self.init();
			self.dropDown.on('change', self.dpChange);			
        });
		
		
    }
	
}(jQuery));
$( document ).ready(function() {		
	var inst = $('.plgn_parametric')
	.Parametric();
	
});