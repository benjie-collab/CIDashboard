<?php 
	$delimiter = $this->application->get_config('metakey_delimiter', 'template');
	$statistics = $this->statistics_model->get_statistics( array('active' => 1 ));	
	$widgets = $this->application->get_widgets('pages');	
?>
	
	<a href="javascript:void(0)" 
		class="no-print floating-tools-button">
		<i class="fa-pencil fa"></i>
	</a>
	<div class="no-print floating-tools-content">
		<?php 
			
		$atts = array(
				'class' => '',
				'data-bind' => 'submit: $root.Pages.updatePage', 
				'method' => 'POST',
				'onSubmit' => 'return false;',
				'id' => 'page_settings_form'
		);	
		$hidden = $page;	
		echo form_open( '/pages/edit/' . element('id', $page) , $atts, $hidden ); ?>
		<?=form_close()?>

		<h4 class="text-light-blue p-b-15 m-t-0 m-b-5" style="border-bottom: 1px solid #ddd; ">Widgets Available</h4>
		<small>Drag widgets below to the template on the right. And drag widgets back to this area to remove.</small>
		
		<div data-bind="CustomScrollbar: { axis:'y', theme:'dark', scrollbarPosition: 'inside'}" class="max-height-420">
		<?php 
			foreach($statistics as $key=>$widget):
			
			$config 	= $this->statistics_model->get_settings(element('widget_key', $widget));	
			$title 		= array_get_value($config, 'text');
			$widget_key = element('widget_key', $widget);
			$category   = element('category', $widget);
			
		?>	
			<div class="bg-navy external-event draggable-widgets" 
				data-delimiter="<?=$delimiter?>" 
				data-widget="<?=$widget_key.$delimiter.time()?>"
				data-toggle="popover"
				data-html="true" 
				data-container="body"
				data-placement="left" title="<?=$config? $title: 'Warning'?>" 
				data-content="<p><small class='text-muted'><?=$config? element('description', $config) : 'This is not properly configured! ' ?></small></p>"
				>				
				  <span class="handle">
					<i class="fa fa-ellipsis-v"></i>
					<i class="fa fa-ellipsis-v"></i>
				  </span>						  
				  <span class="text"><?=$config? character_limiter($title, 10): '#Warning#'?></span>
				  <small class="label label-primary pull-right"><?=$category?></small>	
			</div>
		<?php	
			endforeach;	
		?>
		<?php 
			foreach($widgets as $key=>$widget):						
		?>	
			<div class="bg-blue external-event draggable-widgets" 
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
				   <small class="label label-info pull-right"><?=element('@method', $widget)?></small>
			</div>
		<?php	
			endforeach;	
		?>
		</div>
		
		
		
			
			
			
			<div class="box-footer">
				<a class="btn btn-danger btn-flat btn-sm delete-confirm"
					href="javascript:void(0)"
					data-url="<?=base_url('pages/delete/'.$page['id'])?>"						
				>Delete</a>		
				<a
					data-remote="<?=base_url('pages/edit/'.element('id', $page))?>"
					data-backdrop="static" data-toggle="modal" href="#modal-page-options"
					class="pull-right btn btn-sm btn-warning btn-flat"
				>
					Edit
				</a>
			</div>	
	</div>




