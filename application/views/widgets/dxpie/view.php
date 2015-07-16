<?php 
/*
* @Title: Pie Chart
* @Key: DXPie
* @Method: Statistics 
* @icon: fa-pie-chart fa
* @description: Pie Chart visualization with direct query to IDOL Server
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
		$is_page 	= is_page();
		$config 	= array_key_exists('widget_settings',$statistics)? unserialize(element('widget_settings',$statistics)) : array();	
		$config_data= array_key_exists('data',$config)? element('data',$config) : array();
		$config_visual= array_key_exists('visual',$config)? element('visual',$config) : array();
		
		
		$keys 		= $this->statistics_lib->extract_statistics_key($widget_key);
		$post_data 	= array_merge(
						array_filter($config_data, 'is_scalar'),
						array(
						'text'=> '*',
						'valuedetails'=> 'true',
						'source' => 'autn:value',
						'widget_key' => $widget_key
						)
					);
		$data		= array(
					'ajax' => base_url('statistics/settings'),
					'event'=> isset($event)? $event : '',
					'widget_key'=> $widget_key
					//'post_data'=> $post_data
					);
					
		$data		= array_merge($config, $data);	
		$config_visual['dataSource'] = isset($source)? $source : $this->statistics_model->get_source($post_data);
		$data['visual'] = $config_visual;
		
		$options 	= isset($meta_key)? $this->application->get_settings($meta_key) : array();
		$widget_size= array_key_exists('size', $options)? element('size', $options) : 'widget-sm';
		
		echo '<div class="widget m-0 o-hidden ' . $widget_size . '" 
				data-bind="' . ucfirst(element('type', $keys)) . ' : ' . htmlspecialchars(json_encode($data, JSON_NUMERIC_CHECK), ENT_QUOTES, 'UTF-8') . '"></div>';		
		
		
?>	

