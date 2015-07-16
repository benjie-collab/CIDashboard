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
		meta_key		(optional) //for options
*/
?>
<?php
	
		$is_page 	= $this->application->is_page();
		$options 	= isset($meta_key)? $this->application->get_settings($meta_key) : array();
		
		$statistics = $this->statistics_model->get_statistic($widget_key);
		$has_rights = $this->statistics_model->user_has_rights($statistics);
		$is_owner 	= $this->statistics_model->user_is_owner($statistics);		
		$config 	= array_key_exists('widget_settings',$statistics)? unserialize(element('widget_settings',$statistics)) : array();
		$keys 		= $this->statistics_lib->extract_statistics_key($widget_key);		
		$themes 	= $this->application->get_config('map_themes','statistics');
		$theme 		= element('theme', $config);
		$post_data 	= array_merge(
						array_filter($config, 'is_scalar'),
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
					'widget_key'=> $widget_key,
					'post_data'=> $post_data,
					'dataSource' => array(),
					'theme' 	 =>  $theme,
					'themes' 	 =>  $themes,
					array( 
						'mapTypeControlOptions' => 
							array(
								'mapTypeIds' => array_keys($themes)
							),
						'mapTypeId' => $theme
						)
					);				
		
		if($is_page)
			$widget_size = element('size', $options)? element('size', $options) : 'widget-sm';
		else
			$widget_size = 'widget-sm';
		$data		= array_merge($data, $config);		
		
		echo '<div class="widget m-0 o-hidden ' . $widget_size . '" 
				data-bind="' . ucfirst(element('type', $keys)) . ' : ' . htmlspecialchars(json_encode($data, JSON_NUMERIC_CHECK), ENT_QUOTES, 'UTF-8') . '"></div>';		
		
		
?>				
	
