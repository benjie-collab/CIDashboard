<?php 
/* 
	Parameters
		meta_key		(required)
*/
?>

<?php
	$delimiter 			= $this->application->get_config('metakey_delimiter', 'template');
	$is_statistics		= false;
	$widget_key 		= extract_metakey($meta_key, $delimiter);	
	$exist 				= file_exists( FCPATH . '\\application\\views\\widgets\\' . $widget_key);	
	$widgets_tool		= $this->application->get_session_userdata('widgets_tool');
	$widgets_js			= $this->application->get_session_userdata('widgets_js');
	
	if($exist){
		$folder 		= $widget_key;
		$widget_key 	= $meta_key;				
	}else{		
		$keys 			= $this->statistics_lib->extract_statistics_key($widget_key);
		$folder 		= element('type', $keys);
		$is_statistics 	= true;
	}
	
	$tools_exist		= file_exists( FCPATH . '\\application\\views\\widgets\\' . $folder . '\\tools.php');	
	$tool 				= 'widgets/' . $folder . '/tools';
	if($tools_exist && !in_array($tool, $widgets_tool))	{
		array_push($widgets_tool, $tool);
		$this->session->set_userdata('widgets_tool', $widgets_tool);		
	}
	
	
	$js_exist		= file_exists( FCPATH . '\\application\\views\\widgets\\' . $folder . '\\index.js');	
	if($js_exist)	{
		$js = 'application/views/widgets/' . $folder . '/index.js';
		array_push($widgets_js, $js);
		$this->session->set_userdata('widgets_js', $widgets_js);		
	}
	
	$data['widget_key'] = $widget_key;
	$data['meta_key']   = $meta_key;
?>
<div class="removable-widget" data-widget="<?=$meta_key?>">
	<?php
		$statistics = $this->statistics_model->get_statistic($widget_key);	
		$has_rights = $this->statistics_model->user_has_rights($statistics);	
		$is_owner 	= $this->statistics_model->user_is_owner($statistics);
		$config 	= unserialize(element('widget_settings',$statistics));
		$options	= array();	
		$mode 		= $this->application->get_mode('statistics_mode');
		$pages_mode = $this->application->get_mode('pages_mode');
		$is_page 	= is_page();
		//$keys 		= $this->statistics_lib->extract_statistics_key($widget_key);	
		$widgetize  = $this->application->is_statistic();		
		if($is_page){	
			$options 	= $this->application->get_settings($meta_key);
			$widgetize = element('widgetize', $options);
		}		
		
		$config_data= $config && array_key_exists('data',$config)? element('data',$config) : array();
		$config_visual= $config && array_key_exists('visual',$config)? element('visual',$config) : array();
	
		$title = element('title', $options) ? element('title', $options) : element('text', element('title', $config_visual));	
	if( $widgetize ) { ?>
	<div class="box box-solid <?=element('bgcolor', $options)? 'bg-'.element('bgcolor', $options).'-gradient' : '' ?> ">
		<div class="box-header with-border">
		  <h3 class="box-title">
			<i class="fa <?=element('icon', $options)?>"></i> <?=$title?>		
		  </h3>
			<div class="box-tools pull-right">				
				<span 
					data-toggle="popover" 
					data-placement="bottom" 
					data-content="<?=element('description', $config)?>" 
					title="Description" 
					data-html="true" 
					class="btn btn-xs">
					<i class="fa fa-ellipsis-v text-muted"></i>
				</span>
				<span class="btn btn-xs <?=$is_page?'hidden':''?>" data-toggle="tooltip" title="<?=(bool) element('active',$statistics) == 1 ? 'Active' : 'Inactive'?>">
					<i class="fa fa-globe <?=(bool)element('active',$statistics)==1 ? 'text-primary':'text-gray'?>"></i>
				</span>
			</div>
		</div>
		<div class="box-body">		
	<?php }?>	
				<div class="p-relative o-hidden">
					<?=$this->load->view('widgets/'. $folder . '/view', $data)?>
					
					<?php if(!$config && $is_statistics){ ?>
						<div class="btn-group widget-warning" 
							data-toggle="popover" 
							data-placement="auto" 
							data-container="" 
							data-content="This widget is not properly configured or has been deleted by the owner! You may remove this or wait for it to be configured." 
							title="Warning!" 
							data-html="true">
							  <span class="btn btn-warning btn-flat btn-md"><i class="fa fa-warning"></i> Warning</span>                     
							  <button class="btn btn-default btn-flat btn-md dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-caret-down"></i>
							  </button>
							  <ul class="dropdown-menu">
								<li>
									<a class="delete-widget-confirm" data-url="<?=base_url('/app/delete_widget')?>">
										<i class="fa fa-trash"></i> Delete
									</a>
								</li>
							  </ul>
						</div>
					<?php } ?>
					<?php if($pages_mode && $is_page){ ?>
					<div class="removable-widget-tools">
						<ul class="list-inline m-0">
							<li class="<?=$pages_mode && !isset($event) || !$event ? 'handle':'hidden'?>">
								<span class="btn text-muted cursor-move">
									<i class="fa fa-ellipsis-v "></i> 
									<i class="fa fa-ellipsis-v "></i> 
								</span>
							</li>					
							<li class="<?=($pages_mode? '':'hidden')?>">
								<a class="btn " 
									data-remote="<?=base_url('app/widget_options/' . urlencode($meta_key))?>"									
									data-toggle="modal" 
									href="#modal-widget-options"
								>
									<!--data-remote="<?=base_url('statistics/options/' . urlencode($meta_key))?>" -->
									<i class="fa fa-cog"></i>
								</a>
							</li>
							<li class="<?=($pages_mode? '':'hidden')?>">
								<a class="btn delete-widget-confirm" data-url="<?=base_url('/app/delete_widget')?>">
									<i class="fa fa-trash"></i>
								</a>
							</li>
							<li class="<?=($is_statistics? '':'hidden')?>"><a class="btn widget-expand"><i class="ion-android-expand"></i></a></li>				
						</ul>
					</div>
					<?php }	?>
					
					
				</div>
	<?php if( $widgetize ) { ?>		
		</div>
		<?php if(!$is_page && $mode ){ ?>
		<div class="box-footer clearfix">
			<ul class="list-inline m-0">
				<li>
					<span class="btn btn-xs">
					<i class="fa text-muted <?=$is_owner?'fa-unlock':'fa-lock'?>"></i>
					</span>	
				</li>
				<li data-toggle="tooltip" title="<?=$has_rights?'Configure':'' ?>">
					<a class="btn btn-xs <?=$has_rights?'':'disabled' ?>" 					
						href="javascript:void(0)"
						data-backdrop="static"
						data-target="#modal-configure-statistics"
						data-toggle="<?=$has_rights?'modal':'' ?>"
						data-remote="<?=base_url('statistics/configure/'.$widget_key . '?title=' .urlencode($title))?>"
						><i class="fa fa-gear text-muted"></i>
					</a>
				</li>
				<li data-toggle="tooltip" title="<?=$has_rights?'Copy':'' ?>">
					<a class="btn btn-xs <?=$has_rights?'copy-confirm':'disabled' ?>" data-url="<?=base_url('statistics/copy/'.$widget_key)?>" 
						href="javascript:void(0)">
						<i class="fa fa-copy text-muted"></i>
					</a>
				</li>			
				<li data-toggle="tooltip" title="<?=$has_rights?'Trash':'' ?>" class="pull-right">
					<a class="btn btn-xs <?=$has_rights?'delete-confirm':'disabled' ?>" data-url="<?=base_url('statistics/delete/'.$widget_key)?>" 
						href="javascript:void(0)">
						<i class="fa fa-trash text-muted"></i>
					</a>			
				</li>
			</ul>
		</div>
		<?php } ?>	
	</div>
	<?php }?>
</div>

