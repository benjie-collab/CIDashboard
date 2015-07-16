<?php 
	$delimiter = $this->application->get_config('metakey_delimiter', 'template');
	$document_page_settings = $this->search_model->get_options('document_page_settings');
?>

<div id="floating-tool" 
	class="no-print  floating-tools-button">
	<i class="fa-gear fa"></i>
</div>
<div id="floating-tool-content" class="no-print floating-tools-content">
	<div class="connected-widgets-droppable" data-url="<?=base_url('/app/delete_widget')?>">	
		<h4 style="border-bottom: 1px solid #ddd;" class="text-light-blue p-b-15 m-t-0 m-b-5">Configure Document Page</h4>
		<small></small>
		
		<div class="m-t-10">
			<?php 		
			$templates = $this->application->get_templates('application/views/search/templates/document/');
			$atts = array(
					'class' => '',
					'data-bind' => 'submit: $root.Document.update', 
					'method' => 'POST',
					'onSubmit' => 'return false;',
					'id' => 'document_settings_form'
			);
			
			$hidden 		= array('meta_key' => 'document_page_settings');	
			?>
			<?php echo form_open( 'search/options', $atts, $hidden ); ?>			
				<div class="form-group">			
						<label class="control-label" for="title">Template</label>		
					   <?php 
							$atts = 'class="form-control selectpicker" 
							data-bind="
								BootstrapSelect:{},
								event: { change: function(data, e){ $(e.currentTarget).closest(\'form\').trigger(\'submit\'); } }
							"';
							echo form_dropdown('template', $templates, element('template', $document_page_settings), $atts);
						?>
				</div>
			<?=form_close()?>
		</div>

		
		<h4 style="border-bottom: 1px solid #ddd; " class="m-b-5 p-b-15 m-t-20 text-light-blue">Widgets Available</h4>
		<small>Drag elements to display.</small>		
		<div class="m-t-10">
			<div data-bind="SlimScroll: {height: 300}">					
			<?php 				
				$widgets = $this->application->get_widgets('document');					
				foreach($widgets as $key=>$widget):
			?>	
				<ul class="todo-list draggable-widgets m-b-5" data-widget="<?=$key?>" data-delimiter="<?=$delimiter?>">
					<!--
						data-bind="jQueryDraggable: {
							helper: 'clone',
							handle: '.handle',
							appendTo: document.body,
							connectToSortable: '.connected-widgets',
							revert: 'true',
							zIndex : 9999999,
							start : function(event, ui) {
							  ui.helper.width($(this).width());
							  $('.content-wrapper').addClass('container');
							  $(window).trigger('resize');
							  var ts = moment().valueOf();	
								$('[data-toggle=popover]').popover('hide');		
								$(ui.helper).find('li').removeAttr('data-toggle');
								$(ui.helper).attr('data-widget', '<?=$key?>' + '<?=$delimiter?>' + ts);									  
							},
							stop: function(){	
								$('.content-wrapper').removeClass('container');	
							}
						}">	-->
						
						
						
					<li class=""
						data-toggle="popover"
						data-content="<p><small><?=element('@description', $widget)?></small></p>"
						data-placement="left"
						data-html="true"
						data-container="body"
						title="<i class='fa <?=element('@icon', $widget)?>'></i> <?=element('@title', $widget)?>"
					>
					  <span class="handle">
						<i class="fa <?=element('@icon', $widget)?>"></i>
					  </span>						  
					  <span class="text"><?=element('@title', $widget)?></span>
					   <small class="label label-default"><?=element('@method', $widget)?></small>					  
					</li>
				</ul>
			<?php	
				endforeach;	
			?>	
			</div>	
		</div>
	</div>
	<div class="drop-here-helper">
		<div class="p-relative">
			<span class="ion-trash-a"></span>
		</div>
	</div>
</div>


<div class="modal fade" id="modal-widget-options">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
			<div class="text-center has-spinner active">
				<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>
			</div>
			</div>			
		</div>
	  </div>
</div>