<?php 
	$delimiter = $this->application->get_config('metakey_delimiter', 'template');
?>
<a id="floating-tool" href="javascript:void(0)" 
	class="floating-tools-button">
	<i class="fa-gear fa"></i>
</a>
<div id="floating-tool-content" class="no-print floating-tools-content">
	<div class="connected-widgets-droppable" data-url="<?=base_url('/app/delete_widget')?>">	
	
	<h4 style="border-bottom: 1px solid #ddd; " class="m-b-5 p-b-15 m-t-0 text-light-blue">Widgets Available</h4>	
	<div class="m-t-10">
		<?php 		
		$atts = array(
				'class' => '',
				'data-bind' => 'submit: $root.Dashboard.update', 
				'method' => 'POST',
				'onSubmit' => 'return false;',
				'id' => 'dashboard_settings_form'
		);
		
		$hidden 		= array('meta_key' => 'dashboard_settings');	
		?>
		<?php echo form_open( 'dashboard', $atts, $hidden ); ?>			
			
		<?=form_close()?>



		<div data-bind="SlimScroll: {height: 300}">
		
		<?php 				
			$widgets = $this->application->get_widgets('profile');
		
			foreach($widgets as $key=>$widget):
		?>	
			<ul class="todo-list draggable-widgets m-b-5" data-widget="<?=$key?>" data-delimiter="<?=$delimiter?>">	
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
				  <span class="text text-capitalize"><?=element('@title', $widget)?></span>
				  <small class="label label-default">Default</small>
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