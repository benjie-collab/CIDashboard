<?php 
/*
* @Title: Results Terms
* @Method: Search 
* @icon: fa-cloud
* @Description: Best terms extracted from the search result documents. Displayed as cloud.
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
	$visual_options 	= array_key_exists('visual', $options)? element('visual', $options) : array();	

$results_ids = get_autnhit_ids($results);	
?>
<?php 
	$atts = array('class' => '');
if($results_ids):
	echo form_open('/search/?'. http_build_query($_GET), $atts);
	
	$post_data = array(
		'id'=> implode("+", $results_ids)
	);
	
	$terms = $this->terms_model->call_term_get_best($post_data);
	$terms = element('autn:term', $terms);
	if($terms){
		$terms = htmlspecialchars(json_encode($terms, JSON_NUMERIC_CHECK), ENT_QUOTES, 'UTF-8');
	}else{
		$terms = htmlspecialchars(json_encode(array()), ENT_QUOTES, 'UTF-8');
	}
	
?>
<div id="tag-cloud" class="widget widget-md" data-bind="D3TagCloud:
	{ 
			
		source: <?=$terms?>,		
		height: 300,
		fontMin: '<?=element('fontmin', $visual_options)?>', 
		fontMax: '<?=element('fontmax', $visual_options)?>',
		min:  '<?=element('min', $visual_options)?>',
		max:  '<?=element('max', $visual_options)?>',
		font: '<?=element('font', $visual_options)?>',
		padding: '<?=element('spacing', $visual_options)?>',
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