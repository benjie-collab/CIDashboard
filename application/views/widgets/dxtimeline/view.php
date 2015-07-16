<?php 
/*
* @Title: Timeline Chart
* @Key: DXTimeline
* @Method: Statistics 
* @icon: fa-line-chart fa
* @description: Basic Chart visualization with direct query to IDOL Server
*/ 

/* 
	Parameters
		widget_key		(required)
*/
?>

<?php
		
		$query_settings = isset($query_settings)?	$query_settings : array();	
		
		$statistics = $this->statistics_model->get_statistic($widget_key);
		$has_rights = $this->statistics_model->user_has_rights($statistics);
		$is_owner 	= $this->statistics_model->user_is_owner($statistics);
		$config 	= array_key_exists('widget_settings',$statistics)? unserialize(element('widget_settings',$statistics)) : array();	
		$config_data= array_key_exists('data',$config)? element('data',$config) : array();
		$config_visual= array_key_exists('visual',$config)? element('visual',$config) : array();
		
		
		$keys 		= $this->statistics_lib->extract_statistics_key($widget_key);
		$post_data 	= array_filter($config_data, 'is_scalar');
		$data		= array(
					'ajax' => base_url('statistics/timeline'),
					'event'=> isset($event)? $event : '',
					'widget_key'=> $widget_key
					//'post_data'=> $post_data
					);					
		$data		= array_merge($config, $data);

		if(!isset($timeline)){
		$timeline = $this->statistics_model->get_timeline($post_data);
		}
		
		
		if(!$timeline)
		$timeline = element('dataSource', $config_visual);		
		
		
		$config_visual['dataSource'] = element('dataSource', $timeline);		
		$config_visual['series'] = element('series', $timeline);	
		$data['visual'] = $config_visual;	
		
		$options 	= isset($meta_key)? $this->application->get_settings($meta_key) : array();
		$widget_size= array_key_exists('size', $options)? element('size', $options) : 'widget-sm';	
		
		?>	

		
		<!--
		<div class="form-inline widget-tools">
			<div class="form-group">
				<label class="" for="year">Year</label>
				<?php 
					$atts 		= 'class="form-control" data-size="5" data-bind="
									 event: { change: function(d,e){ $(e.currentTarget).closest(\'form\').trigger(\'submit\')} }, BootstrapSelect:{}
									"';								
					$elements	= array( '2014'=> '2014','2015'=> '2015');
					$value 		= element('year', $config_data);	
					echo form_dropdown('data[year]', $elements , $value , $atts);							
				?>					
			</div>
		</div>-->
		
		<?php		
		echo '<div class="widget m-0 o-hidden ' . $widget_size . '" 
				data-bind="' . ucfirst(element('type', $keys)) . ' : ' . htmlspecialchars(json_encode($data, JSON_NUMERIC_CHECK), ENT_QUOTES, 'UTF-8') . '"></div>';
		?>


