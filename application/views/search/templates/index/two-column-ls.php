<?php
/*
* @Title: Two Column- Left Sidebar
* @Method: Search
* @icon: fa-ellipsis-v
*/
?>






<?php 
	$loading_state = str_replace('"','\'',$this->template_model->get_box_loading_state()) ;
	$mode 	  			= $this->application->get_mode('search_mode');
?>

<section class="content">
	<div class="row">
		<div class="col-md-8 col-md-offset-4">	
			<div class="p-relative" >
			<?php $id= 'widget_top_bar'; ?>
			<div id="<?=$id?>" class="connected-widgets <?=$mode? 'widget':''?>" 
			<?php if($mode): ?>
			data-bind="
				jQuerySortable: {
					connectWith: '.connected-widgets',
					placeholder: 'sort-highlight',
					forcePlaceholderSize: true,	
					handle: '.handle',
					revert: true,
					appendTo: document.body,zIndex: 1032,
					start: function( event, ui ){	
						if($(ui.item).find('div:has(.box-header)').length > 0) 
						$(ui.item). find('.box-body').addClass('collapse');
					},
					stop: function( event, ui ){	
						if($(ui.item).find('div:has(.box-header)').length > 0)
						$(ui.item). find('.box-body').removeClass('collapse');
					},
					create: function( event, ui ){	
						var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
						if(data.length ===0 )
						$(parent).addClass('widget-empty');
						else
						$(parent).removeClass('widget-empty');
						$(parent).siblings('.overlay:eq(0)').addClass('hidden');
					},	
					
					update: function( event, ui ){							
						var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
						if(data.length ===0 )
						$(parent).addClass('widget-empty');
						else
						$(parent).removeClass('widget-empty');
						
						if($(ui.item).hasClass('draggable-widgets')){
							redirect = true;	
						}
						$(parent).siblings('.overlay:eq(0)').removeClass('hidden');
						if(redirect){								
							$.redirect('<?=base_url()?>search/save_widget', {
											meta_key: '<?=$id?>',
											widgets: data
										} ); 
						}else{								
							$.post(
								'<?=base_url()?>search/save_widget',
								{
									redirect: redirect,
									meta_key: '<?=$id?>',
									widgets: data
								},
								function(data){
									console.log(data);
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
								}, 'json'
							)
						}
					}
				}
			"
			<?php endif; ?>
			>
			<?php 
				$options = $this->search_model->get_options($id);
				if($options):
				foreach($options as $key=>$widget):
				?>
					<div class="removable-widget" data-widget="<?=$widget?>">
						<?php $this->load->view('widgets/'.$widget. '/view'); ?>
					</div>
				<?php
				endforeach;
				endif;
			?>
			</div>
			<?php 
			if ($mode)
			echo $loading_state; 
			?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="p-relative" >
			<?php $id= 'widget_left_sidebar_1'; ?>
			<div id="<?=$id?>" class="connected-widgets <?=$mode? 'widget':''?> widget-sm" 
			<?php if($mode): ?>
			data-bind="
				jQuerySortable: {
					connectWith: '.connected-widgets',
					placeholder: 'sort-highlight',
					forcePlaceholderSize: true,	
					handle: '.handle',
					revert: true,
					appendTo: document.body,zIndex: 1032,
					start: function( event, ui ){	
						if($(ui.item).find('div:has(.box-header)').length > 0) 
						$(ui.item). find('.box-body').addClass('collapse');
					},
					stop: function( event, ui ){	
						if($(ui.item).find('div:has(.box-header)').length > 0)
						$(ui.item). find('.box-body').removeClass('collapse');
					},
					create: function( event, ui ){	
						var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
						if(data.length ===0 )
						$(parent).addClass('widget-empty');
						else
						$(parent).removeClass('widget-empty');
						$(parent).siblings('.overlay:eq(0)').addClass('hidden');
					},	
					
					update: function( event, ui ){							
						var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
						if(data.length ===0 )
						$(parent).addClass('widget-empty');
						else
						$(parent).removeClass('widget-empty');
						
						if($(ui.item).hasClass('draggable-widgets')){
							redirect = true;	
						}
						$(parent).siblings('.overlay:eq(0)').removeClass('hidden');
						if(redirect){								
							$.redirect('<?=base_url()?>search/save_widget', {
											meta_key: '<?=$id?>',
											widgets: data
										} ); 
						}else{								
							$.post(
								'<?=base_url()?>search/save_widget',
								{
									redirect: redirect,
									meta_key: '<?=$id?>',
									widgets: data
								},
								function(data){
									console.log(data);
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
								}, 'json'
							)
						}
					}
				}
			"
			<?php endif; ?>
			>
			<?php 
				$options = $this->search_model->get_options($id);
				if($options):
				foreach($options as $key=>$widget):
				?>
					<div class="removable-widget" data-widget="<?=$widget?>">
						<?php $this->load->view('widgets/'.$widget. '/view'); ?>
					</div>
				<?php
				endforeach;
				endif;
			?>
			</div>
			<?php 
			if ($mode)
			echo $loading_state; 
			?>
			</div>
			
			<div class="p-relative" >
			<?php $id= 'widget_left_sidebar_2'; ?>
			<div id="<?=$id?>" class="connected-widgets <?=$mode? 'widget':''?> widget-sm" 
			<?php if($mode): ?>
			data-bind="
				jQuerySortable: {
					connectWith: '.connected-widgets',
					placeholder: 'sort-highlight',
					forcePlaceholderSize: true,	
					handle: '.handle',
					revert: true,
					appendTo: document.body,zIndex: 1032,
					start: function( event, ui ){	
						if($(ui.item).find('div:has(.box-header)').length > 0) 
						$(ui.item). find('.box-body').addClass('collapse');
					},
					stop: function( event, ui ){	
						if($(ui.item).find('div:has(.box-header)').length > 0)
						$(ui.item). find('.box-body').removeClass('collapse');
					},
					create: function( event, ui ){	
						var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
						if(data.length ===0 )
						$(parent).addClass('widget-empty');
						else
						$(parent).removeClass('widget-empty');
						$(parent).siblings('.overlay:eq(0)').addClass('hidden');
					},	
					
					update: function( event, ui ){							
						var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
						if(data.length ===0 )
						$(parent).addClass('widget-empty');
						else
						$(parent).removeClass('widget-empty');
						
						if($(ui.item).hasClass('draggable-widgets')){
							redirect = true;	
						}
						$(parent).siblings('.overlay:eq(0)').removeClass('hidden');
						if(redirect){								
							$.redirect('<?=base_url()?>search/save_widget', {
											meta_key: '<?=$id?>',
											widgets: data
										} ); 
						}else{								
							$.post(
								'<?=base_url()?>search/save_widget',
								{
									redirect: redirect,
									meta_key: '<?=$id?>',
									widgets: data
								},
								function(data){
									console.log(data);
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
								}, 'json'
							)
						}
					}
				}
			"
			<?php endif; ?>
			>
			<?php 
				$options = $this->search_model->get_options($id);
				if($options):
				foreach($options as $key=>$widget):
				?>
					<div class="removable-widget" data-widget="<?=$widget?>">
						<?php $this->load->view('widgets/'.$widget. '/view'); ?>
					</div>
				<?php
				endforeach;
				endif;
			?>
			</div>
			<?php 
			if ($mode)
			echo $loading_state; 
			?>
			</div>
		
		</div>
		<div class="col-md-8">
			<div class="p-relative" >
			<?php $id= 'widget_content_top_bar'; ?>
			<div id="<?=$id?>" class="connected-widgets <?=$mode? 'widget':''?>" 
			<?php if($mode): ?>
			data-bind="
				jQuerySortable: {
					connectWith: '.connected-widgets',
					placeholder: 'sort-highlight',
					forcePlaceholderSize: true,	
					handle: '.handle',
					revert: true,
					appendTo: document.body,zIndex: 1032,
					start: function( event, ui ){	
						if($(ui.item).find('div:has(.box-header)').length > 0) 
						$(ui.item). find('.box-body').addClass('collapse');
					},
					stop: function( event, ui ){	
						if($(ui.item).find('div:has(.box-header)').length > 0)
						$(ui.item). find('.box-body').removeClass('collapse');
					},
					create: function( event, ui ){	
						var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
						if(data.length ===0 )
						$(parent).addClass('widget-empty');
						else
						$(parent).removeClass('widget-empty');
						$(parent).siblings('.overlay:eq(0)').addClass('hidden');
					},	
					
					update: function( event, ui ){							
						var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
						if(data.length ===0 )
						$(parent).addClass('widget-empty');
						else
						$(parent).removeClass('widget-empty');
						
						if($(ui.item).hasClass('draggable-widgets')){
							redirect = true;	
						}
						$(parent).siblings('.overlay:eq(0)').removeClass('hidden');
						if(redirect){								
							$.redirect('<?=base_url()?>search/save_widget', {
											meta_key: '<?=$id?>',
											widgets: data
										} ); 
						}else{								
							$.post(
								'<?=base_url()?>search/save_widget',
								{
									redirect: redirect,
									meta_key: '<?=$id?>',
									widgets: data
								},
								function(data){
									console.log(data);
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
								}, 'json'
							)
						}
					}
				}
			"
			<?php endif; ?>
			>
			<?php 
				$options = $this->search_model->get_options($id);
				if($options):
				foreach($options as $key=>$widget):
				?>
					<div class="removable-widget" data-widget="<?=$widget?>">
						<?php $this->load->view('widgets/'.$widget. '/view'); ?>
					</div>
				<?php
				endforeach;
				endif;
			?>
			</div>
			<?php 
			if ($mode)
			echo $loading_state; 
			?>
			</div>
			
			<div class="p-relative" >
			<?php $id= 'widget_content'; ?>
			<div id="<?=$id?>" class="connected-widgets <?=$mode? 'widget':''?> widget-md" 
			<?php if($mode): ?>
			data-bind="
				jQuerySortable: {
					connectWith: '.connected-widgets',
					placeholder: 'sort-highlight',
					forcePlaceholderSize: true,	
					handle: '.handle',
					revert: true,
					appendTo: document.body,zIndex: 1032,
					start: function( event, ui ){	
						if($(ui.item).find('div:has(.box-header)').length > 0) 
						$(ui.item). find('.box-body').addClass('collapse');
					},
					stop: function( event, ui ){	
						if($(ui.item).find('div:has(.box-header)').length > 0)
						$(ui.item). find('.box-body').removeClass('collapse');
					},
					create: function( event, ui ){	
						var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
						if(data.length ===0 )
						$(parent).addClass('widget-empty');
						else
						$(parent).removeClass('widget-empty');
						$(parent).siblings('.overlay:eq(0)').addClass('hidden');
					},	
					
					update: function( event, ui ){							
						var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
						if(data.length ===0 )
						$(parent).addClass('widget-empty');
						else
						$(parent).removeClass('widget-empty');
						
						if($(ui.item).hasClass('draggable-widgets')){
							redirect = true;	
						}
						$(parent).siblings('.overlay:eq(0)').removeClass('hidden');
						if(redirect){								
							$.redirect('<?=base_url()?>search/save_widget', {
											meta_key: '<?=$id?>',
											widgets: data
										} ); 
						}else{								
							$.post(
								'<?=base_url()?>search/save_widget',
								{
									redirect: redirect,
									meta_key: '<?=$id?>',
									widgets: data
								},
								function(data){
									console.log(data);
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
								}, 'json'
							)
						}
					}
				}
			"
			<?php endif; ?>
			>
			<?php 
				$options = $this->search_model->get_options($id);
				if($options):
				foreach($options as $key=>$widget):
				?>
					<div class="removable-widget" data-widget="<?=$widget?>">
						<?php $this->load->view('widgets/'.$widget. '/view'); ?>
					</div>
				<?php
				endforeach;
				endif;
			?>
			</div>
			<?php 
			if ($mode)
			echo $loading_state; 
			?>
			</div>
			
			<div class="p-relative" >
			<?php $id= 'widget_content_bottom_bar'; ?>
			<div id="<?=$id?>" class="connected-widgets <?=$mode? 'widget':''?>" 
			<?php if($mode): ?>
			data-bind="
				jQuerySortable: {
					connectWith: '.connected-widgets',
					placeholder: 'sort-highlight',
					forcePlaceholderSize: true,	
					handle: '.handle',
					revert: true,
					appendTo: document.body,zIndex: 1032,
					start: function( event, ui ){	
						if($(ui.item).find('div:has(.box-header)').length > 0) 
						$(ui.item). find('.box-body').addClass('collapse');
					},
					stop: function( event, ui ){	
						if($(ui.item).find('div:has(.box-header)').length > 0)
						$(ui.item). find('.box-body').removeClass('collapse');
					},
					create: function( event, ui ){	
						var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
						if(data.length ===0 )
						$(parent).addClass('widget-empty');
						else
						$(parent).removeClass('widget-empty');
						$(parent).siblings('.overlay:eq(0)').addClass('hidden');
					},	
					
					update: function( event, ui ){							
						var parent = this, redirect= false, data = $(parent).sortable('toArray', {attribute: 'data-widget'});
						if(data.length ===0 )
						$(parent).addClass('widget-empty');
						else
						$(parent).removeClass('widget-empty');
						
						if($(ui.item).hasClass('draggable-widgets')){
							redirect = true;	
						}
						$(parent).siblings('.overlay:eq(0)').removeClass('hidden');
						if(redirect){								
							$.redirect('<?=base_url()?>search/save_widget', {
											meta_key: '<?=$id?>',
											widgets: data
										} ); 
						}else{								
							$.post(
								'<?=base_url()?>search/save_widget',
								{
									redirect: redirect,
									meta_key: '<?=$id?>',
									widgets: data
								},
								function(data){
									console.log(data);
									$(parent).siblings('.overlay:eq(0)').addClass('hidden');
								}, 'json'
							)
						}
					}
				}
			"
			<?php endif; ?>
			>
			<?php 
				$options = $this->search_model->get_options($id);
				if($options):
				foreach($options as $key=>$widget):
				?>
					<div class="removable-widget" data-widget="<?=$widget?>">
						<?php $this->load->view('widgets/'.$widget. '/view'); ?>
					</div>
				<?php
				endforeach;
				endif;
			?>
			</div>
			<?php 
			if ($mode)
			echo $loading_state; 
			?>
			</div>
		</div>	
	</div>
</section>