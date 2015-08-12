<?php 
/*
* @Title: Sigma Network
* @Method: Pages 
* @icon: fa-info-circle
* @Description: Search results list. Configure the view accordingly especially the document view.
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
	$data_options= array_get_value($options, 'data');
?>


<div class="">		
	<div class="sigma-parent">
		<div class="sigma-expand widget widget-xl widget-full-page m-0" id="sigma-canvas" data-bind="SigmaNetwork:{ data: '<?=base_url('assets/ko.models/twitter_mutual.json')?>',}"></div>
	</div>
</div>










