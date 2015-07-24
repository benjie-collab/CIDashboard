<?php 
/*
* @Title: D3 Multiple Area Chart
* @Method: Pages 
* @icon: fa-area-chart
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


<div  class="">		
	<div class="sigma-parent">
		<div class="sigma-expand widget widget-xl widget-full-page" id="sigma-canvas" data-bind="MultipleAreaChart:{ data: '<?=base_url('data/multipleareachart.csv')?>',}"></div>
	</div>
</div>










