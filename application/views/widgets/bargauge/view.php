<?php 
/*
* @Title: Bar Gauge
* @Key: bargauge
* @Method: Statistics 
* @icon: fa-dashboard fa
* @description: Bargauge Chart visualization with direct query to IDOL Server
*/ 
?>

<?php
	$config 	= $this->widgets_model->get_widget(NULL, array('widget_key' => $widget_key));
	$options	= $this->widgets_model->get_widget_options($widget_key);	
	$mode 		= $this->application->get_mode('statistics_mode');
	$pages_mode = $this->application->get_mode('pages_mode');	
	$keys 		= $this->statistics_lib->extract_Key($widget_key);	
	
if( !isset($widgetize) || (isset($widgetize) && $widgetize)) { ?>
<div class="removable-widget box box-solid <?=element('bgcolor', $options)? 'bg-'.element('bgcolor', $options).'-gradient' : '' ?> " data-widget="<?=$widget_key?>">
	<div class="box-header">
	  <h3 class="box-title handle"><?=$config? element('text', element('title', $config)) : 'Doesnt Exist anymore...' ?></h3>
	  <div class="box-tools pull-right">
		<!--<button class="btn bg-teal btn-sm"><i class="fa fa-gear"></i></button>-->
	  </div>
	</div>
	<div class="box-body">
<?php }?>
				<?php 
					$settings = element('settings', $config);
					if($settings){
				?>
					<div class="widget <?=element('size', $options)? element('size', $options) : 'widget-sm' ?>" 
					data-bind="DX<?=ucfirst(element('type', $keys))?>: { 
						ajax : '<?=base_url('statistics/get_settings')?>', 
						event: '<?=isset($event)? $event : ''?>',
						meta_key: '<?=$this->users->get_user_id() .'_'.$widget_key?>',
						series: {
							argumentField: 'value',
							valueField: '@count'
						},
						post_data: {
							maxresults: 1000000,
							meta_key: '<?=$widget_key?>',
							fieldname: '<?=$this->document_lib->get_element_name_from_tag_name(element('xAxis', $settings))?>',
							text: '*',
							valuedetails: true				
						}
					}"></div>
				<?php
					}else{
				?>
					<div class="alert alert-warning <?=$pages_mode? 'cursor-move': ''?>">
						<p><i class="ion-alert-circled font-180 pull-right"></i> This widget is either not properly configured or has been removed.</p>
					</div>
				<?php			
					}	
				?>

<?php if( !isset($widgetize) || (isset($widgetize) && $widgetize)) { ?>
	</div>
	<?php if((bool)$mode){ ?>	
	<div class="box-footer clearfix text-center">
		<ul class="list-inline m-0">	
			<li>
				<a class="text-danger" onClick="javascript:confirmDialog('<?=base_url('statistics/delete/'.$widget_key)?>')" 
					href="#" data-toggle="tooltip" title="Delete Statistics">
					<i class="fa fa-trash"></i>
				</a>			
			</li>
			<li>
				<a class="text-warning" 
					href="#modal-widget-options"
					data-toggle="modal"
					data-remote="<?=base_url('/statistics/configure/'.$widget_key)?>"
					><i class="fa fa-gear"></i>
				</a>
			</li>
		</ul>
	</div>
	<?php } ?>	
</div>
<?php }?>

