<?php 
/*
* @Title: Results Summary
* @Method: Search 
* @icon: fa-cloud
* @Description: A could of summary terms. Turn on QuerySummary options to show.
*/ 
?>

<?php 	
/** 
	Received Parameters:
	$widget_key
	$meta_key
	$query_settings
**/

	$options 	= $this->application->get_settings($meta_key);
	$visual_options		= array_key_exists('visual', $options)? element('visual', $options): array();	
	$data_options		= array_key_exists('data', $options)? element('data', $options): array();		
	
	$querysummary = array_get_value($raw, 'autn:qs');
	if($querysummary){
		$querysummary = array_get_value($querysummary, 'autn:element');
		$this->session->set_userdata('search_querysummary', $querysummary);		
		$querysummary = htmlspecialchars(json_encode($querysummary, JSON_NUMERIC_CHECK), ENT_QUOTES, 'UTF-8');
	}else{
		$querysummary = htmlspecialchars(json_encode(array()), ENT_QUOTES, 'UTF-8');
	}
	
	
	
?>
		<div class="widget widget-md" data-bind="D3CirclePacking:{		
			data: <?=$querysummary?>,
			termName: '<?=element('termfield', $data_options)?>',
			termUri: 'www.benznext.com',
			termFrequency: '<?=element('termcount', $data_options)?>'
		}">
		
		</div>
	
		<?php 
			$atts = array('class' => '');
		if($querysummary):
			echo form_open('/search/?'. http_build_query($_GET), $atts); 	

			
		?>
		<div id="tag-cloud" class="widget widget-md" data-bind="D3TagCloud:
			{ 
				source: <?=$querysummary?>,				
				height: 300,
				fontMin: '<?=element('fontmin', $visual_options)?>', 
				fontMax: '<?=element('fontmax', $visual_options)?>',
				min:  '<?=element('min', $visual_options)?>',
				max:  '<?=element('max', $visual_options)?>',
				font: '<?=element('font', $visual_options)?>',
				padding: '<?=element('spacing', $visual_options)?>',
				termField: '<?=element('termfield', $data_options)?>',
				termCount: '<?=element('termcount', $data_options)?>',
				click:  function(d){
					$(this).closest('form')
					.append('<input type=\'hidden\' name=\'text\' value=\'' + d.text + '\'/>')
					.trigger('submit');
				}			
			}
			"></div>
		<?php echo form_close();
		endif;

		?>