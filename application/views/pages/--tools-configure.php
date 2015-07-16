<?php 
	$statistics = $this->statistics_model->get_statistics(0, array('category' => '') );	
?>
<div id="floating-tool" 
	class="no-print floating-tools-button">
	<i class="fa-gear fa"></i>
</div>
<div id="floating-tool-content" class="no-print floating-tools-content" data-bind="
			jQueryDroppable: {
							hoverClass: 'bg-black-active',
							accept: '.removable-widget',							
							drop: function( event, ui ) {		
										ui.draggable.remove();	
									}
					}">

	<?php 
	$atts = array(
			'class' => '',
			'data-bind' => 'submit: $root.Pages.configurePage', 
			'method' => 'POST',
			'onSubmit' => 'return false;',
			'id' => ''
	);
	
	$hidden 		= array('meta_key' => 'pages', 'id' => element('id', $page));	
	?>			
	<?php echo form_open( '/pages/configure/', $atts, $hidden ); ?>
	
	
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs pull-right ui-sortable-handle">
		  <li class="active"><a data-toggle="tab" href="#page-edit-tab-1" aria-expanded="false"><i class="fa fa-text-width"></i> </a></li>
		  <li class=""><a data-toggle="tab" href="#page-edit-tab-2" aria-expanded="true"><i class="fa fa-tasks"></i></a></li>
		  <li class="pull-left header"><?=character_limiter(element('page_name', $page)? element('page_name', $page): '', 7) ?></li>
		</ul>
		<div class="tab-content no-padding">
			<div style="" id="page-edit-tab-1" class="tab-pane active">
				<div class="form-group">
					<label class="control-label" for="title">Page Name</label>		  
					<?php $data = array(
							  'name'        => 'page_name',
							  'id'          => 'page_name',
							  'maxlength'   => '30',
							  'class'		=> 'form-control',
							  'value'		=> element('page_name', $page),
							  'placeholder'	=> 'Enter name'
							);
					echo form_input($data); ?>			
					<p class="help-block"></p>
				</div>
				
				<div class="form-group">
					<label class="control-label" for="page_desc">Description</label>	
					<div class="text-center">
					<?php $data = array(
							  'name'        => 'page_desc',
							  'id'          => 'page_desc',
							  'maxlength'   => '30',
							  'class'		=> 'form-control',
							  'value'		=>  element('page_desc', $page),
							  'data-bind'	=> 'BootstrapWYSIhtml5:{ html: true, image: false, \'font-styles\': false, link: false }',
							  'placeholder'	=> 'Some description'
							);
					echo form_textarea($data); ?>			
					</div>
					<p class="help-block"></p>
				</div>
			</div>
			<div id="page-edit-tab-2" class="tab-pane">
				<?php 
					foreach($statistics as $key=>$widget):
					
					$config 	= $this->widgets_model->get_widget(NULL, array('widget_key' => element('widget_key',$widget)));					
					$settings 	= element('settings', $config);	
					$title = array_shift(element('title', $config));
					$widget_key = element('widget_key', $widget);
					$category = element('category', $widget);
					
				?>	
					<ul class="todo-list draggable-widgets m-b-5" data-widget="<?=$widget_key?>"
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
								},
								stop: function(){
									$('.content-wrapper').removeClass('container');	
									
								}
							}">	
							
							
							
						<li class="" data-toggle="popover"
							data-html="true" data-placement="left" title="<?=$title?>" 
							data-content="<div class='text-center'><p><small class='text-muted'><?=element('description', $settings)?></small></p></div>"
						>
							<!-- drag handle -->
						  <span class="handle">
							<i class="fa fa-arrows "></i>
						  </span>
						  
						  <span class="text"><?=character_limiter($title, 10) ?></span>
						  <!-- Emphasis label -->
						  <small class="label label-default"><?=$category?></small>
						  <!-- General tools such as edit or delete-->
						  <div class="tools">
							<a  href="#modal-page-options" 
								data-toggle="modal" 
								data-backdrop="static"								
								data-remote="<?=base_url('pages/widget_options_modal/?widget_key=' . $widget_key . '&widget=' . strtolower($category) . '&title=' . urlencode($title.' Options') )?>"
								
								class=""><i class="fa fa-gear"></i></a>
						  </div>
						</li>
					</ul>
				<?php	
					endforeach;	
				?>
			</div>
		</div>
	</div>
	
	<div class="box-footer">		
		<a href="javascript:void(0)" onclick="javascript:confirmDialog('<?=base_url('pages/delete/'.$page['id'])?>', '<?=lang('confirm_d')?>')" class="btn btn-danger btn-flat pull-left">Delete</a>		
		<button type="submit" class="btn btn-primary btn-flat pull-right">Save Page</button>
	</div>	
	<?=form_close()?>
</div>


