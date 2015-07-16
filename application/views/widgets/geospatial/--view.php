<?php 
/*
* @Title: GeoSpatial
* @Key: GeoSpatial
* @Method: Statistics 
* @icon: fa-map-marker fa
* @description: Google Map visualization with search and marker drops.
*/ 

/* 
	Parameters
		widget_key		(required)
*/
?>

<?php
	$statistics = $this->statistics_model->get_statistic($widget_key);
	$has_rights = $this->statistics_model->user_has_rights($statistics);
	$is_owner 	= $this->statistics_model->user_is_owner($statistics);
	$config 	= unserialize(element('widget_settings',$statistics));
	$options	= isset($meta_key) ? $this->application->get_settings($meta_key): array();	
	$mode 		= $this->application->get_mode('statistics_mode');
	$pages_mode = $this->application->get_mode('pages_mode');
	$is_page 	= $this->application->is_page();
	$keys 		= $this->statistics_lib->extract_statistics_key($widget_key);	
	$widgetize 	= !isset($widgetize) || (isset($widgetize) && $widgetize);
	if($is_page){	
		$options 	= $this->application->get_settings($meta_key);
		$widgetize = element('widgetize', $options);
	}	
	$title = element('name', $options) ? element('name', $options) : element('text', element('title', $config));	
if( $widgetize ) { ?>
<div class="box box-solid <?=element('bgcolor', $options)? 'bg-'.element('bgcolor', $options).'-gradient' : '' ?> ">
	<div class="box-header with-border">
	  <h3 class="box-title handle <?=(bool)element('active',$statistics)==1 ? '' : 'text-gray'?>"><?=$title?></h3>
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
	<div class="box-body p-0">		
<?php }?>	
			<div class="p-relative o-hidden">
			<?php if(!$config){ ?>
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
					<li class="<?=$pages_mode && !isset($event)? 'handle':'hidden'?>">
						<span class="btn text-muted cursor-move">
							<i class="fa fa-ellipsis-v "></i> 
							<i class="fa fa-ellipsis-v "></i> 
						</span>
					</li>					
					<li class="<?=($pages_mode? '':'hidden')?>">
						<a class="btn " data-remote="<?=base_url('/statistics/options/' . urlencode($meta_key))?>" data-toggle="modal" href="#modal-widget-options">
							<i class="fa fa-cog"></i>
						</a>
					</li>
					<li class="<?=($pages_mode? '':'hidden')?>">
						<a class="btn delete-widget-confirm" data-url="<?=base_url('/app/delete_widget')?>">
							<i class="fa fa-trash"></i>
						</a>
					</li>
					<li><a class="btn widget-expand"><i class="ion-android-expand"></i></a></li>				
				</ul>
			</div>
			<?php }

					$themes = $this->application->get_config('map_themes','statistics');
					$post_data = array(
								'widget_key'=> $widget_key,
								'text'=> '*',
								'valuedetails'=> 'true',
								'source' => 'autn:value'
								);
					$settings = array(
								'dataSource' => array(),
								'theme' 	 =>  element('theme', $config),
								'themes' 	 =>  $themes,
								array( 
									'mapTypeControlOptions' => 
										array(
											'mapTypeIds' => array_keys($themes)
										),
									'mapTypeId' => element('theme', $config)
									)
								);
					if($config){
						$post_data = array_merge(array_filter($config, 'is_scalar'), $post_data);
						$config = array_merge($config, $settings);
					}
				?>
				<?php if(!isset($event)){?>					
				<div class="widget m-0 o-hidden <?=element('size', $options)? element('size', $options) : 'widget-sm' ?>" 
					data-bind="
						<?=ucfirst(element('type', $keys))?>:
						<?=htmlspecialchars(json_encode($config, JSON_NUMERIC_CHECK), ENT_QUOTES, 'UTF-8') ?>
						">				
				</div>
				<?php }else {					
					$settings = array(
									'ajax' => base_url('statistics/settings'),
									'event'=> $event,
									'widget_key'=> $widget_key,
									'post_data'=> $post_data,
									'theme' =>  element('theme', $config),
									'themes' 	 =>  $themes,
									array( 
										'mapTypeControlOptions' => 
											array(
												'mapTypeIds' => array_keys($themes)
											),
										'mapTypeId' => element('theme', $config)
										)
								);
					if($config){					
						$settings =  array_merge($config, $settings);
					}			
				?>
				<div class="widget m-0 o-hidden <?=element('size', $options)? element('size', $options) : 'widget-lg' ?>" 
				data-bind="<?=ucfirst(element('type', $keys))?>: 									
					<?=htmlspecialchars(json_encode($settings, JSON_NUMERIC_CHECK), ENT_QUOTES, 'UTF-8')?>
				"></div>
				<?php } ?>
			</div>
<?php if( $widgetize ) { ?>		
	</div>
	<?php if(!$is_page){ ?>	
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
