<?php 
	$delimiter = $this->application->get_config('metakey_delimiter', 'template');
	$search_page_settings = $this->usermeta_model->get_usermeta(0, array('meta_key'=>'search_page_settings'));
?>
<a id="floating-tool" href="javascript:void(0)" 
	class="floating-tools-button">
	<i class="fa-gear fa"></i>
</a>
<div id="floating-tool-content" class="no-print floating-tools-content">
	<div class="connected-widgets-droppable" data-url="<?=base_url('/app/delete_widget')?>">	
		<?php 		
		$atts = array(
				'class' => '',
				'data-bind' => 'submit: $root.Search.update', 
				'method' => 'POST',
				'onSubmit' => 'return false;',
				'id' => 'search_settings_form'
		);
		
		$hidden 		= array('meta_key' => 'search_page_settings');	
		?>
		<?php echo form_open( 'search/options/', $atts, $hidden ); ?>	
		<?=form_close()?>	
		
		
		
		<h4 style="border-bottom: 1px solid #ddd; " class="text-light-blue p-b-15 m-t-0 m-b-5"><?php echo lang('search_widgets_heading');?></h4>
		<small><?php echo lang('search_widgets_subheading');?></small>
		
		
		<div data-bind="CustomScrollbar: { axis:'y', theme:'dark'}" class="max-height-320">
		
		<?php 				
			$widgets = $this->application->get_widgets('search');					
			foreach($widgets as $key=>$widget):
		?>	
			<ul class="bg-orange external-event draggable-widgets" 
				data-widget="<?=$key?>" 
				data-delimiter="<?=$delimiter?>"
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
				<small class="label label-warning pull-right"><?=element('@method', $widget)?></small>	
			</ul>
		<?php	
			endforeach;	
		?>	
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