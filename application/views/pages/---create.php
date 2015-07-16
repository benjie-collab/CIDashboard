<?php 
	$loading_state = str_replace('"','\'',$this->template_model->get_box_loading_state()) ;
?>
<section class="content" style="">
	<div class="row">
		<div class="col-md-3">
			<div class="p-relative" >
				<?php $id="page_widget_left_1"; ?>
				<div id="<?=$id?>" class="connected-widgets widget widget-empty widget-sm"
					data-bind="
					jQuerySortable: {
						connectWith: '.connected-widgets',
						placeholder: 'sort-highlight',
						forcePlaceholderSize: true,	
						handle: '.handle',
						revert: true,
						appendTo: document.body,
						create: function( event, ui ){	
							var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
							if(data.length ===0 )
							$(parent).addClass('widget-empty');
							else
							$(parent).removeClass('widget-empty');
							$(parent).siblings('.overlay:eq(0)').addClass('hidden');
							
							var widgets = [], widget = '<?=$id?>'; 
							if(localStorage.getItem('widgets'))
							widgets = JSON.parse(localStorage.getItem('widgets'));						
							if(jQuery.inArray(widget, widgets ) === -1 )
							widgets.push(widget);
							localStorage.setItem(widget, JSON.stringify([]));
							localStorage.setItem('widgets', JSON.stringify(widgets));
						},
						start: function(event, ui) {
							var parent = $(this), data = $(parent).sortable('toArray', {attribute: 'data-widget'});							
						},
						update: function( event, ui ){							
							var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
							if($(ui.item).hasClass('draggable-widgets')){
								redirect = true;	
							}
							$(parent).siblings('.overlay:eq(0)').removeClass('hidden');							
							localStorage.setItem('<?=$id?>', JSON.stringify(data));
							$(parent).siblings('.overlay:eq(0)').addClass('hidden');
						}
					}
					"
				>				
				</div>
				<?=$loading_state?>
			</div>
			<div class="p-relative" >
				<?php $id="page_widget_left_2"; ?>
				<div id="<?=$id?>" class="connected-widgets widget widget-empty widget-xs"
					data-bind="
					jQuerySortable: {
						connectWith: '.connected-widgets',
						placeholder: 'sort-highlight',
						forcePlaceholderSize: true,	
						handle: '.handle',
						revert: true,
						appendTo: document.body,
						create: function( event, ui ){	
							var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
							if(data.length ===0 )
							$(parent).addClass('widget-empty');
							else
							$(parent).removeClass('widget-empty');
							$(parent).siblings('.overlay:eq(0)').addClass('hidden');
							
							var widgets = [], widget = '<?=$id?>'; 
							if(localStorage.getItem('widgets'))
							widgets = JSON.parse(localStorage.getItem('widgets'));						
							if(jQuery.inArray(widget, widgets ) === -1 )
							widgets.push(widget);
							localStorage.setItem(widget, JSON.stringify([]));
							localStorage.setItem('widgets', JSON.stringify(widgets));
						},
						start: function(event, ui) {
							var parent = $(this), data = $(parent).sortable('toArray', {attribute: 'data-widget'});							
						},
						update: function( event, ui ){									
							var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
							if($(ui.item).hasClass('draggable-widgets')){
								redirect = true;	
							}
							$(parent).siblings('.overlay:eq(0)').removeClass('hidden');							
							localStorage.setItem('<?=$id?>', JSON.stringify(data));
							$(parent).siblings('.overlay:eq(0)').addClass('hidden');
						}
					}
					"
				>				
				</div>
				<?=$loading_state?>
			</div>
			<div class="p-relative" >
				<?php $id="page_widget_left_3"; ?>
				<div id="<?=$id?>" class="connected-widgets widget widget-empty widget-sm"
					data-bind="
					jQuerySortable: {
						connectWith: '.connected-widgets',
						placeholder: 'sort-highlight',
						forcePlaceholderSize: true,	
						handle: '.handle',
						revert: true,
						appendTo: document.body,
						create: function( event, ui ){	
							var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
							if(data.length ===0 )
							$(parent).addClass('widget-empty');
							else
							$(parent).removeClass('widget-empty');
							$(parent).siblings('.overlay:eq(0)').addClass('hidden');
							
							var widgets = [], widget = '<?=$id?>'; 
							if(localStorage.getItem('widgets'))
							widgets = JSON.parse(localStorage.getItem('widgets'));						
							if(jQuery.inArray(widget, widgets ) === -1 )
							widgets.push(widget);
							localStorage.setItem(widget, JSON.stringify([]));
							localStorage.setItem('widgets', JSON.stringify(widgets));
						},
						start: function(event, ui) {
							var parent = $(this), data = $(parent).sortable('toArray', {attribute: 'data-widget'});							
						},
						update: function( event, ui ){							
							var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
							
							
							
							
							
							if($(ui.item).hasClass('draggable-widgets')){
								redirect = true;	
							}
							$(parent).siblings('.overlay:eq(0)').removeClass('hidden');							
							localStorage.setItem('<?=$id?>', JSON.stringify(data));
							$(parent).siblings('.overlay:eq(0)').addClass('hidden');
						}
					}
					"
				>				
				</div>
				<?=$loading_state?>
			</div>
			<div class="p-relative" >
				<?php $id="page_widget_left_4"; ?>
				<div id="<?=$id?>" class="connected-widgets widget widget-empty widget-xs"
					data-bind="
					jQuerySortable: {
						connectWith: '.connected-widgets',
						placeholder: 'sort-highlight',
						forcePlaceholderSize: true,	
						handle: '.handle',
						revert: true,
						appendTo: document.body,
						create: function( event, ui ){	
							var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
							if(data.length ===0 )
							$(parent).addClass('widget-empty');
							else
							$(parent).removeClass('widget-empty');
							$(parent).siblings('.overlay:eq(0)').addClass('hidden');
							
							var widgets = [], widget = '<?=$id?>'; 
							if(localStorage.getItem('widgets'))
							widgets = JSON.parse(localStorage.getItem('widgets'));						
							if(jQuery.inArray(widget, widgets ) === -1 )
							widgets.push(widget);
							localStorage.setItem(widget, JSON.stringify([]));
							localStorage.setItem('widgets', JSON.stringify(widgets));
						},
						start: function(event, ui) {
							var parent = $(this), data = $(parent).sortable('toArray', {attribute: 'data-widget'});							
						},
						update: function( event, ui ){							
							var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
							
							
							
							
							
							if($(ui.item).hasClass('draggable-widgets')){
								redirect = true;	
							}
							$(parent).siblings('.overlay:eq(0)').removeClass('hidden');							
							localStorage.setItem('<?=$id?>', JSON.stringify(data));
							$(parent).siblings('.overlay:eq(0)').addClass('hidden');
						}
					}
					"
				>				
				</div>
				<?=$loading_state?>
			</div>
		</div>
		<div class="col-md-6">
			<div class="p-relative" >
				<?php $id="page_widget_content_1"; ?>
				<div id="<?=$id?>" class="connected-widgets widget widget-empty widget-xs"
					data-bind="
					jQuerySortable: {
						connectWith: '.connected-widgets',
						placeholder: 'sort-highlight',
						forcePlaceholderSize: true,	
						handle: '.handle',
						revert: true,
						appendTo: document.body,
						create: function( event, ui ){	
							var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
							if(data.length ===0 )
							$(parent).addClass('widget-empty');
							else
							$(parent).removeClass('widget-empty');
							$(parent).siblings('.overlay:eq(0)').addClass('hidden');
							
							var widgets = [], widget = '<?=$id?>'; 
							if(localStorage.getItem('widgets'))
							widgets = JSON.parse(localStorage.getItem('widgets'));						
							if(jQuery.inArray(widget, widgets ) === -1 )
							widgets.push(widget);
							localStorage.setItem(widget, JSON.stringify([]));
							localStorage.setItem('widgets', JSON.stringify(widgets));
						},
						start: function(event, ui) {
							var parent = $(this), data = $(parent).sortable('toArray', {attribute: 'data-widget'});							
						},
						update: function( event, ui ){							
							var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
							
							
							
							
							
							if($(ui.item).hasClass('draggable-widgets')){
								redirect = true;	
							}
							$(parent).siblings('.overlay:eq(0)').removeClass('hidden');							
							localStorage.setItem('<?=$id?>', JSON.stringify(data));
							$(parent).siblings('.overlay:eq(0)').addClass('hidden');
						}
					}
					"
				>				
				</div>
				<?=$loading_state?>
			</div>	
			<div id="page_content_carousel" class="carousel slide" data-ride="carousel" data-interval="false">
				<ol class="carousel-indicators">
				  <li data-target="#page_content_carousel" data-slide-to="0" class="active"></li>
				  <li data-target="#page_content_carousel" data-slide-to="1" class=""></li>
				  <li data-target="#page_content_carousel" data-slide-to="2" class=""></li>
				</ol>
				<div class="carousel-inner">
				  <div id="page_content_carousel_1" class="item  active">					
						<?php $id="page_widget_content_carousel_1"; ?>
						<div id="<?=$id?>" class="connected-widgets widget widget-empty widget-md"
							data-bind="
							jQuerySortable: {
								connectWith: '.connected-widgets',
								placeholder: 'sort-highlight',
								forcePlaceholderSize: true,	
								handle: '.handle',
								revert: true,
								appendTo: document.body,
								create: function( event, ui ){	
									var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
									if(data.length ===0 )
									$(parent).addClass('widget-empty');
									else
									$(parent).removeClass('widget-empty');
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
									
									var widgets = [], widget = '<?=$id?>'; 
									if(localStorage.getItem('widgets'))
									widgets = JSON.parse(localStorage.getItem('widgets'));						
									if(jQuery.inArray(widget, widgets ) === -1 )
									widgets.push(widget);
									localStorage.setItem(widget, JSON.stringify([]));
									localStorage.setItem('widgets', JSON.stringify(widgets));
								},
								start: function(event, ui) {
									var parent = $(this), data = $(parent).sortable('toArray', {attribute: 'data-widget'});							
								},
								update: function( event, ui ){							
									var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
									
									
									
									
									
									if($(ui.item).hasClass('draggable-widgets')){
										redirect = true;	
									}
									$(parent).siblings('.overlay:eq(0)').removeClass('hidden');							
									localStorage.setItem('<?=$id?>', JSON.stringify(data));
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
								}
							}
							"
						>				
						</div>
						<?=$loading_state?>
				  </div>
				  <div id="page_content_carousel_2" class="item ">
						<?php $id="page_widget_content_carousel_2"; ?>
						<div id="<?=$id?>" class="connected-widgets widget widget-empty widget-md"
							data-bind="
							jQuerySortable: {
								connectWith: '.connected-widgets',
								placeholder: 'sort-highlight',
								forcePlaceholderSize: true,	
								handle: '.handle',
								revert: true,
								appendTo: document.body,
								create: function( event, ui ){	
									var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
									if(data.length ===0 )
									$(parent).addClass('widget-empty');
									else
									$(parent).removeClass('widget-empty');
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
									
									var widgets = [], widget = '<?=$id?>'; 
									if(localStorage.getItem('widgets'))
									widgets = JSON.parse(localStorage.getItem('widgets'));						
									if(jQuery.inArray(widget, widgets ) === -1 )
									widgets.push(widget);
									localStorage.setItem(widget, JSON.stringify([]));
									localStorage.setItem('widgets', JSON.stringify(widgets));
								},
								start: function(event, ui) {
									var parent = $(this), data = $(parent).sortable('toArray', {attribute: 'data-widget'});							
								},
								update: function( event, ui ){							
									var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
									
									
									
									
									
									if($(ui.item).hasClass('draggable-widgets')){
										redirect = true;	
									}
									$(parent).siblings('.overlay:eq(0)').removeClass('hidden');							
									localStorage.setItem('<?=$id?>', JSON.stringify(data));
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
								}
							}
							"
						>				
						</div>
						<?=$loading_state?>
				  </div>
				  <div id="page_content_carousel_3" class="item ">
						<?php $id="page_widget_content_carousel_3"; ?>
						<div id="<?=$id?>" class="connected-widgets widget widget-empty widget-md"
							data-bind="
							jQuerySortable: {
								connectWith: '.connected-widgets',
								placeholder: 'sort-highlight',
								forcePlaceholderSize: true,	
								handle: '.handle',
								revert: true,
								appendTo: document.body,
								create: function( event, ui ){	
									var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
									if(data.length ===0 )
									$(parent).addClass('widget-empty');
									else
									$(parent).removeClass('widget-empty');
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
									
									var widgets = [], widget = '<?=$id?>'; 
									if(localStorage.getItem('widgets'))
									widgets = JSON.parse(localStorage.getItem('widgets'));						
									if(jQuery.inArray(widget, widgets ) === -1 )
									widgets.push(widget);
									localStorage.setItem(widget, JSON.stringify([]));
									localStorage.setItem('widgets', JSON.stringify(widgets));
								},
								start: function(event, ui) {
									var parent = $(this), data = $(parent).sortable('toArray', {attribute: 'data-widget'});							
								},
								update: function( event, ui ){							
									var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
									
									
									
									
									
									if($(ui.item).hasClass('draggable-widgets')){
										redirect = true;	
									}
									$(parent).siblings('.overlay:eq(0)').removeClass('hidden');							
									localStorage.setItem('<?=$id?>', JSON.stringify(data));
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
								}
							}
							"
						>				
						</div>
						<?=$loading_state?>
				  </div>
				</div>
				<a class="left carousel-control" href="#page_content_carousel" data-slide="prev">
				  <span class="fa fa-angle-left"></span>
				</a>
				<a class="right carousel-control" href="#page_content_carousel" data-slide="next">
				  <span class="fa fa-angle-right"></span>
				</a>
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<div class="p-relative" >
						
						<?php $id="page_widget_content_2"; ?>
						<div id="<?=$id?>" class="connected-widgets widget widget-empty widget-md"
							data-bind="
							jQuerySortable: {
								connectWith: '.connected-widgets',
								placeholder: 'sort-highlight',
								forcePlaceholderSize: true,	
								handle: '.handle',
								revert: true,
								appendTo: document.body,
								create: function( event, ui ){	
									var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
									if(data.length ===0 )
									$(parent).addClass('widget-empty');
									else
									$(parent).removeClass('widget-empty');
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
									
									var widgets = [], widget = '<?=$id?>'; 
									if(localStorage.getItem('widgets'))
									widgets = JSON.parse(localStorage.getItem('widgets'));						
									if(jQuery.inArray(widget, widgets ) === -1 )
									widgets.push(widget);
									localStorage.setItem(widget, JSON.stringify([]));
									localStorage.setItem('widgets', JSON.stringify(widgets));
								},
								start: function(event, ui) {
									var parent = $(this), data = $(parent).sortable('toArray', {attribute: 'data-widget'});							
								},
								update: function( event, ui ){							
									var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
									
									
									
									
									
									if($(ui.item).hasClass('draggable-widgets')){
										redirect = true;	
									}
									$(parent).siblings('.overlay:eq(0)').removeClass('hidden');							
									localStorage.setItem('<?=$id?>', JSON.stringify(data));
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
								}
							}
							"
						>				
						</div>
						<?=$loading_state?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="p-relative" >
						<?php $id="page_widget_content_3"; ?>
						<div id="<?=$id?>" class="connected-widgets widget widget-empty widget-md"
							data-bind="
							jQuerySortable: {
								connectWith: '.connected-widgets',
								placeholder: 'sort-highlight',
								forcePlaceholderSize: true,	
								handle: '.handle',
								revert: true,
								appendTo: document.body,
								create: function( event, ui ){	
									var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
									if(data.length ===0 )
									$(parent).addClass('widget-empty');
									else
									$(parent).removeClass('widget-empty');
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
									
									var widgets = [], widget = '<?=$id?>'; 
									if(localStorage.getItem('widgets'))
									widgets = JSON.parse(localStorage.getItem('widgets'));						
									if(jQuery.inArray(widget, widgets ) === -1 )
									widgets.push(widget);
									localStorage.setItem(widget, JSON.stringify([]));
									localStorage.setItem('widgets', JSON.stringify(widgets));
								},
								start: function(event, ui) {
									var parent = $(this), data = $(parent).sortable('toArray', {attribute: 'data-widget'});							
								},
								update: function( event, ui ){							
									var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
									
									
									
									
									
									if($(ui.item).hasClass('draggable-widgets')){
										redirect = true;	
									}
									$(parent).siblings('.overlay:eq(0)').removeClass('hidden');							
									localStorage.setItem('<?=$id?>', JSON.stringify(data));
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
								}
							}
							"
						>				
						</div>
						<?=$loading_state?>
					</div>
				</div>
			</div>
			
			<div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right ui-sortable-handle">
                  <li class="active">
					<a data-toggle="tab" href="javascript:void(0)" data-target="#page_content_4_tab_1">Tab 1</a></li>
                  <li>
					<a data-toggle="tab" href="javascript:void(0)" data-target="#page_content_4_tab_2">Tab 2</a></li>
				  <li>
					<a data-toggle="tab" href="javascript:void(0)" data-target="#page_content_4_tab_3">Tab 3</a></li>
				  <li>
					<a data-toggle="tab" href="javascript:void(0)" data-target="#page_content_4_tab_4">Tab 4</a></li>
				  <li>
					<a data-toggle="tab" href="javascript:void(0)" data-target="#page_content_4_tab_5">Tab 5</a></li>
                </ul>
                <div class="tab-content no-padding p-relative">
					<div id="page_content_4_tab_1" class="tab-pane active">
						<?php $id="page_widget_content_4_tab_1"; ?>
						<div id="<?=$id?>" class="connected-widgets widget widget-empty widget-md"
							data-bind="
							jQuerySortable: {
								connectWith: '.connected-widgets',
								placeholder: 'sort-highlight',
								forcePlaceholderSize: true,	
								handle: '.handle',
								revert: true,
								appendTo: document.body,
								create: function( event, ui ){	
									var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
									if(data.length ===0 )
									$(parent).addClass('widget-empty');
									else
									$(parent).removeClass('widget-empty');
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
									
									var widgets = [], widget = '<?=$id?>'; 
									if(localStorage.getItem('widgets'))
									widgets = JSON.parse(localStorage.getItem('widgets'));						
									if(jQuery.inArray(widget, widgets ) === -1 )
									widgets.push(widget);
									localStorage.setItem(widget, JSON.stringify([]));
									localStorage.setItem('widgets', JSON.stringify(widgets));
								},
								start: function(event, ui) {
									var parent = $(this), data = $(parent).sortable('toArray', {attribute: 'data-widget'});							
								},
								update: function( event, ui ){							
									var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
									
									
									
									
									
									if($(ui.item).hasClass('draggable-widgets')){
										redirect = true;	
									}
									$(parent).siblings('.overlay:eq(0)').removeClass('hidden');							
									localStorage.setItem('<?=$id?>', JSON.stringify(data));
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
								}
							}
							"
						>				
						</div>
						<?=$loading_state?>
					</div>
					<div id="page_content_4_tab_2" class="tab-pane ">
						<?php $id="page_widget_content_4_tab_2"; ?>
						<div id="<?=$id?>" class="connected-widgets widget widget-empty widget-md"
							data-bind="
							jQuerySortable: {
								connectWith: '.connected-widgets',
								placeholder: 'sort-highlight',
								forcePlaceholderSize: true,	
								handle: '.handle',
								revert: true,
								appendTo: document.body,
								create: function( event, ui ){	
									var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
									if(data.length ===0 )
									$(parent).addClass('widget-empty');
									else
									$(parent).removeClass('widget-empty');
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
									
									var widgets = [], widget = '<?=$id?>'; 
									if(localStorage.getItem('widgets'))
									widgets = JSON.parse(localStorage.getItem('widgets'));						
									if(jQuery.inArray(widget, widgets ) === -1 )
									widgets.push(widget);
									localStorage.setItem(widget, JSON.stringify([]));
									localStorage.setItem('widgets', JSON.stringify(widgets));
								},
								start: function(event, ui) {
									var parent = $(this), data = $(parent).sortable('toArray', {attribute: 'data-widget'});							
								},
								update: function( event, ui ){							
									var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
									
									
									
									
									
									if($(ui.item).hasClass('draggable-widgets')){
										redirect = true;	
									}
									$(parent).siblings('.overlay:eq(0)').removeClass('hidden');							
									localStorage.setItem('<?=$id?>', JSON.stringify(data));
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
								}
							}
							"
						>				
						</div>
						<?=$loading_state?>
						
					</div>
					<div id="page_content_4_tab_3" class="tab-pane ">
						<?php $id="page_widget_content_4_tab_3"; ?>
						<div id="<?=$id?>" class="connected-widgets widget widget-empty widget-md"
							data-bind="
							jQuerySortable: {
								connectWith: '.connected-widgets',
								placeholder: 'sort-highlight',
								forcePlaceholderSize: true,	
								handle: '.handle',
								revert: true,
								appendTo: document.body,
								create: function( event, ui ){	
									var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
									if(data.length ===0 )
									$(parent).addClass('widget-empty');
									else
									$(parent).removeClass('widget-empty');
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
									
									var widgets = [], widget = '<?=$id?>'; 
									if(localStorage.getItem('widgets'))
									widgets = JSON.parse(localStorage.getItem('widgets'));						
									if(jQuery.inArray(widget, widgets ) === -1 )
									widgets.push(widget);
									localStorage.setItem(widget, JSON.stringify([]));
									localStorage.setItem('widgets', JSON.stringify(widgets));
								},
								start: function(event, ui) {
									var parent = $(this), data = $(parent).sortable('toArray', {attribute: 'data-widget'});							
								},
								update: function( event, ui ){							
									var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
									
									
									
									
									
									if($(ui.item).hasClass('draggable-widgets')){
										redirect = true;	
									}
									$(parent).siblings('.overlay:eq(0)').removeClass('hidden');							
									localStorage.setItem('<?=$id?>', JSON.stringify(data));
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
								}
							}
							"
						>				
						</div>
						<?=$loading_state?>
						
					</div>
					<div id="page_content_4_tab_4" class="tab-pane ">
						<?php $id="page_widget_content_4_tab_4"; ?>
						<div id="<?=$id?>" class="connected-widgets widget widget-empty widget-md"
							data-bind="
							jQuerySortable: {
								connectWith: '.connected-widgets',
								placeholder: 'sort-highlight',
								forcePlaceholderSize: true,	
								handle: '.handle',
								revert: true,
								appendTo: document.body,
								create: function( event, ui ){	
									var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
									if(data.length ===0 )
									$(parent).addClass('widget-empty');
									else
									$(parent).removeClass('widget-empty');
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
									
									var widgets = [], widget = '<?=$id?>'; 
									if(localStorage.getItem('widgets'))
									widgets = JSON.parse(localStorage.getItem('widgets'));						
									if(jQuery.inArray(widget, widgets ) === -1 )
									widgets.push(widget);
									localStorage.setItem(widget, JSON.stringify([]));
									localStorage.setItem('widgets', JSON.stringify(widgets));
								},
								start: function(event, ui) {
									var parent = $(this), data = $(parent).sortable('toArray', {attribute: 'data-widget'});							
								},
								update: function( event, ui ){							
									var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
									
									
									
									
									
									if($(ui.item).hasClass('draggable-widgets')){
										redirect = true;	
									}
									$(parent).siblings('.overlay:eq(0)').removeClass('hidden');							
									localStorage.setItem('<?=$id?>', JSON.stringify(data));
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
								}
							}
							"
						>				
						</div>
						<?=$loading_state?>
						
					</div>
					<div id="page_content_4_tab_5" class="tab-pane ">
						<?php $id="page_widget_content_4_tab_5"; ?>
						<div id="<?=$id?>" class="connected-widgets widget widget-empty widget-md"
							data-bind="
							jQuerySortable: {
								connectWith: '.connected-widgets',
								placeholder: 'sort-highlight',
								forcePlaceholderSize: true,	
								handle: '.handle',
								revert: true,
								appendTo: document.body,
								create: function( event, ui ){	
									var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
									if(data.length ===0 )
									$(parent).addClass('widget-empty');
									else
									$(parent).removeClass('widget-empty');
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
									
									var widgets = [], widget = '<?=$id?>'; 
									if(localStorage.getItem('widgets'))
									widgets = JSON.parse(localStorage.getItem('widgets'));						
									if(jQuery.inArray(widget, widgets ) === -1 )
									widgets.push(widget);
									localStorage.setItem(widget, JSON.stringify([]));
									localStorage.setItem('widgets', JSON.stringify(widgets));
								},
								start: function(event, ui) {
									var parent = $(this), data = $(parent).sortable('toArray', {attribute: 'data-widget'});							
								},
								update: function( event, ui ){							
									var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
									
									
									
									
									
									if($(ui.item).hasClass('draggable-widgets')){
										redirect = true;	
									}
									$(parent).siblings('.overlay:eq(0)').removeClass('hidden');							
									localStorage.setItem('<?=$id?>', JSON.stringify(data));
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
								}
							}
							"
						>				
						</div>
						<?=$loading_state?>
						
					</div>
				</div>
			</div>
						
		</div>
		<div class="col-md-3">
			<div class="p-relative" >				
				<?php $id="page_widget_right_1"; ?>
				<div id="<?=$id?>" class="connected-widgets widget widget-empty widget-sm"
					data-bind="
					jQuerySortable: {
						connectWith: '.connected-widgets',
						placeholder: 'sort-highlight',
						forcePlaceholderSize: true,	
						handle: '.handle',
						revert: true,
						appendTo: document.body,
						create: function( event, ui ){	
							var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
							if(data.length ===0 )
							$(parent).addClass('widget-empty');
							else
							$(parent).removeClass('widget-empty');
							$(parent).siblings('.overlay:eq(0)').addClass('hidden');
							
							var widgets = [], widget = '<?=$id?>'; 
							if(localStorage.getItem('widgets'))
							widgets = JSON.parse(localStorage.getItem('widgets'));						
							if(jQuery.inArray(widget, widgets ) === -1 )
							widgets.push(widget);
							localStorage.setItem(widget, JSON.stringify([]));
							localStorage.setItem('widgets', JSON.stringify(widgets));
						},
						start: function(event, ui) {
							var parent = $(this), data = $(parent).sortable('toArray', {attribute: 'data-widget'});							
						},
						update: function( event, ui ){							
							var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
							
							
							
							
							
							if($(ui.item).hasClass('draggable-widgets')){
								redirect = true;	
							}
							$(parent).siblings('.overlay:eq(0)').removeClass('hidden');							
							localStorage.setItem('<?=$id?>', JSON.stringify(data));
							$(parent).siblings('.overlay:eq(0)').addClass('hidden');
						}
					}
					"
				>				
				</div>
				<?=$loading_state?>
			</div>
			<div class="p-relative" >
				<?php $id="page_widget_right_2"; ?>
				<div id="<?=$id?>" class="connected-widgets widget widget-empty widget-xs"
					data-bind="
					jQuerySortable: {
						connectWith: '.connected-widgets',
						placeholder: 'sort-highlight',
						forcePlaceholderSize: true,	
						handle: '.handle',
						revert: true,
						appendTo: document.body,
						create: function( event, ui ){	
							var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
							if(data.length ===0 )
							$(parent).addClass('widget-empty');
							else
							$(parent).removeClass('widget-empty');
							$(parent).siblings('.overlay:eq(0)').addClass('hidden');
							
							var widgets = [], widget = '<?=$id?>'; 
							if(localStorage.getItem('widgets'))
							widgets = JSON.parse(localStorage.getItem('widgets'));						
							if(jQuery.inArray(widget, widgets ) === -1 )
							widgets.push(widget);
							localStorage.setItem(widget, JSON.stringify([]));
							localStorage.setItem('widgets', JSON.stringify(widgets));
						},
						start: function(event, ui) {
							var parent = $(this), data = $(parent).sortable('toArray', {attribute: 'data-widget'});							
						},
						update: function( event, ui ){							
							var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
							
							
							
							
							
							if($(ui.item).hasClass('draggable-widgets')){
								redirect = true;	
							}
							$(parent).siblings('.overlay:eq(0)').removeClass('hidden');							
							localStorage.setItem('<?=$id?>', JSON.stringify(data));
							$(parent).siblings('.overlay:eq(0)').addClass('hidden');
						}
					}
					"
				>				
				</div>
				<?=$loading_state?>
			</div>	
			<div class="p-relative" >
				<?php $id="page_widget_right_3"; ?>
				<div id="<?=$id?>" class="connected-widgets widget widget-empty widget-xs"
					data-bind="
					jQuerySortable: {
						connectWith: '.connected-widgets',
						placeholder: 'sort-highlight',
						forcePlaceholderSize: true,	
						handle: '.handle',
						revert: true,
						appendTo: document.body,
						create: function( event, ui ){	
							var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
							if(data.length ===0 )
							$(parent).addClass('widget-empty');
							else
							$(parent).removeClass('widget-empty');
							$(parent).siblings('.overlay:eq(0)').addClass('hidden');
							
							var widgets = [], widget = '<?=$id?>'; 
							if(localStorage.getItem('widgets'))
							widgets = JSON.parse(localStorage.getItem('widgets'));						
							if(jQuery.inArray(widget, widgets ) === -1 )
							widgets.push(widget);
							localStorage.setItem(widget, JSON.stringify([]));
							localStorage.setItem('widgets', JSON.stringify(widgets));
						},
						start: function(event, ui) {
							var parent = $(this), data = $(parent).sortable('toArray', {attribute: 'data-widget'});							
						},
						update: function( event, ui ){							
							var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
							
							
							
							
							
							if($(ui.item).hasClass('draggable-widgets')){
								redirect = true;	
							}
							$(parent).siblings('.overlay:eq(0)').removeClass('hidden');							
							localStorage.setItem('<?=$id?>', JSON.stringify(data));
							$(parent).siblings('.overlay:eq(0)').addClass('hidden');
						}
					}
					"
				>				
				</div>
				<?=$loading_state?>
			</div>
			<div class="p-relative" >
				<?php $id="page_widget_right_4"; ?>
				<div id="<?=$id?>" class="connected-widgets widget widget-empty widget-xs"
					data-bind="
					jQuerySortable: {
						connectWith: '.connected-widgets',
						placeholder: 'sort-highlight',
						forcePlaceholderSize: true,	
						handle: '.handle',
						revert: true,
						appendTo: document.body,
						create: function( event, ui ){	
							var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
							if(data.length ===0 )
							$(parent).addClass('widget-empty');
							else
							$(parent).removeClass('widget-empty');
							$(parent).siblings('.overlay:eq(0)').addClass('hidden');
							
							var widgets = [], widget = '<?=$id?>'; 
							if(localStorage.getItem('widgets'))
							widgets = JSON.parse(localStorage.getItem('widgets'));						
							if(jQuery.inArray(widget, widgets ) === -1 )
							widgets.push(widget);
							localStorage.setItem(widget, JSON.stringify([]));
							localStorage.setItem('widgets', JSON.stringify(widgets));
						},
						start: function(event, ui) {
							var parent = $(this), data = $(parent).sortable('toArray', {attribute: 'data-widget'});							
						},
						update: function( event, ui ){							
							var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
							
							
							
							
							
							if($(ui.item).hasClass('draggable-widgets')){
								redirect = true;	
							}
							$(parent).siblings('.overlay:eq(0)').removeClass('hidden');							
							localStorage.setItem('<?=$id?>', JSON.stringify(data));
							$(parent).siblings('.overlay:eq(0)').addClass('hidden');
						}
					}
					"
				>				
				</div>
				<?=$loading_state?>
			</div>
			
		</div>	
	</div>
</section>
<?php $this->load->view($tools); ?>