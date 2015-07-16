
<div id="jspanel-search-tools" data-bind="BootSideMenu: {
	side:'left', 
	autoClose:true 
	}">
	<div class="p-10">
		<h4 class="page-header"><?php echo lang('search_settings_heading');?></h4>

		<p class="text-muted"><?php echo lang('search_settings_subheading');?></p>
		
		<div class="search-widgets">
		<?php 
			foreach($widgets as $key=>$widget):
		?>			
				<div class="panel panel-warning draggable-widgets"
					data-bind="jQueryDraggable: {
						helper: 'clone',
						handle: '',
						connectWith: '.droppable-widgets',
						appendTo: 'body',
						zIndex : 9999999,
						start : function(event, ui) {
						  ui.helper.width($(this).width());
						}
					}"
				>
					<div class="panel-heading p-t-10 p-b-10 p-l-15 p-r-15">
						<h5 class="m-0">
							<i class="fa <?=$widget['icon']?> "></i> <?=$widget['title']?>						
							<a class="text-muted pull-right p-l-5 p-r-0 cursor-move drag-tools">		
								<i class="fa fa-arrows"></i>
							</a>
							<div class="dropdown pull-right edit-tools">
							  <a class="text-muted pull-right p-l-5 p-r-5 cursor-pointer dropdown-toggle"  data-toggle="dropdown" >		
								<i class="fa fa-ellipsis-v"></i>
							  </a>
							  <ul class="dropdown-menu" >
								<li ><a  href="#" class="" data-bind="click: $root.SearchTemplate.removeWidget "><i class="fa fa-trash"></i> Delete</a></li>
								<li ><a  href="#modal-search-options" 
										data-toggle="modal" 
										data-backdrop="static"
										data-remote="<?=base_url()?>search/widget_options_modal/?widget=<?=$key?>&title=<?=urlencode($widget['title'].' Options')?>"
										class=""><i class="fa fa-cog"></i> Configure</a></li>
							  </ul>
							</div>
						</h5>
						<?php 
							$data = array(
								'name'        => 'widgets[]',
								'value'       => $key,
								'checked'     => TRUE,
								'class'       => 'hidden',
								);

							echo form_checkbox($data);
						?>
					</div>
				</div>
		<?php	
			endforeach;	
		?>
		</div>
	</div>
</div>


<footer class="footer " data-bind="ScrollToFixed: { bottom: 0, left: 0, right: 0}">
     
	<div class="bg-warning p-5">
		<div class="container-fluid">
		<?php 
		$atts = array(
				'class' => 'form-inline',
				//'data-bind' => 'submit: $root.SearchTemplate.formSubmit', 
				'method' => 'POST',
				//'onSubmit' => 'return false;',
				//'id' => 'widget_options_form'
		);
		
		$hidden 		= array('meta_key' => 'search_template');	
		?>
		<?php echo form_open( '/search/save_template/', $atts, $hidden ); ?>		
				<div class="form-group">
					<label class="" for="action">Template: </label>
					
					   <?php 
							$atts = 'class="form-control selectpicker w-auto " 
							data-bind="
								BootstrapSelect:{},
								event: { change: function(data, e){ console.log(e); $(e.currentTarget).closest(\'form\').trigger(\'submit\'); } }
							"';
							echo form_dropdown('template', $templates, $template, $atts);
						?>
				</div>
		<?=form_close()?>
		</div>
	  </div>
</footer>