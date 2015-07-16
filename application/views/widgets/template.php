<?php 
/* 
	Parameters
		meta_key		(required)
*/
?>

<?php
	$mode 	  			= $this->application->get_mode('search_mode');	
	$delimiter 			= $this->application->get_config('metakey_delimiter', 'template');
	$widget_key 		= extract_metakey($meta_key, $delimiter);	
	$exist 				= file_exists( FCPATH . '\\application\\views\\widgets\\' . $widget_key);	
	
	if($exist){
		$folder 		= $widget_key;
		$widget_key 	= $meta_key;				
	}else{		
		$keys 			= $this->statistics_lib->extract_statistics_key($widget_key);
		$folder 		= element('type', $keys);
		$is_statistics 	= true;
	}
	
	$data['widget_key'] = $widget_key;
	$data['meta_key']   = $meta_key;
	
	
?>
<div class="removable-widget p-relative" data-widget="<?=$meta_key?>">
	<?php	
		$options 	= $this->application->get_settings($meta_key);
		$widgetize = element('widgetize', $options);
?>	

	<?php		
	if( $widgetize ) { ?>
	<div class="box box-solid <?=element('bgcolor', $options)?>-gradient ">
		<div class="box-header with-border">
		  <h3 class="box-title handle">
			<i class="fa <?=element('icon', $options)?>"></i>
			<?=element('title', $options)?></h3>
			<div class="box-tools pull-right">				
				
			</div>
		</div>
		<div class="box-body">		
	<?php }?>			
			<?=$this->load->view('widgets/'. $folder . '/view', $data)?>	
	<?php
	if( $widgetize ) { ?>
		</div>		
	</div>
	<?php }?>
	
	<div class="removable-widget-tools">
		<ul class="list-inline m-0">
			<li class="<?=$mode? 'handle':'hidden'?>">
				<span class="btn text-muted cursor-move">
					<i class="fa fa-ellipsis-v "></i> 
					<i class="fa fa-ellipsis-v "></i> 
				</span>
			</li>
			<li class="<?=($mode? '':'hidden')?>">
				<a class="btn " 
					data-toggle="modal"
					data-target="#modal-widget-options"
					data-remote="<?=base_url('app/widget_options/' . urlencode($meta_key) . '/?title=' . urlencode('Widget Options'))?>">
					<i class="fa fa-cog"></i>
				</a>
			</li>
			<li class="<?=($mode? '':'hidden')?>">
				<a class="btn delete-widget-confirm" data-url="<?=base_url('app/delete_widget')?>">
					<i class="fa fa-trash"></i>
				</a>
			</li>				
		</ul>
	</div>
</div>