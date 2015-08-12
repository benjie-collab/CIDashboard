<?php 
/*
* @Title: PLGN DXMultiplePanes
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

	$options 	= $this->widgets_model->get_widgetoptions($meta_key);	
	$data_options= array_get_value($options, 'data');
	$data_parameters = array_key_exists('parameters', $data_options)? element('parameters', $data_options): array();
?>

<div class="widget-full-page dx-multiple-panes" id="" data-url="<?=base_url('api/call/' . element('server', $data_options))?>" data-parameters="<?=htmlspecialchars(json_encode($data_parameters), ENT_QUOTES, 'UTF-8')?>">
	<div id="" class="widget dx-chart p-absolute" style="width: 100%; left: 5; right: 5; bottom: 130px; top: 0;"></div>
	<div id="" class="widget dx-range-selector p-absolute" style="width: 100%; left: 0; right: 0; bottom: 0; height: 120px;"></div>
	
	<div class="p-absolute right-0 bottom-0 col-md-1 col-sm-2 col-xs-4">
		<div class="box box-solid">		
			<div class="box-body m-0">
				<ul class="list-unstyled legend">
				</ul>
			</div>
			<div class="box-header with-border">
			  <h3 class="box-title">Legend</h3>
			  <div class="box-tools pull-right">
				<button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
			  </div>
			</div>
		</div>
	</div>
		
	
	<div class="popover popover-xl" id="" style="z-index: 1040">
		<div class="arrow"></div>
		<h3 class="popover-title">Popover right <i class="fa fa-remove pull-right cursor-pointer popover-close"></i></h3>
		<div class="popover-content">
			<div class="widget max-height-250" data-bind="CustomScrollbar: { 
				theme:'minimal-dark', 
				scrollbarPosition: 'outside',
				autoExpandScrollbar: true}">
				<ul class="m-0 p-0">
					<li>The number returned by dimensions-related APIs, including .outerHeight(), may be fractional in some cases.</li>
					<li>Code should not assume it is an integer. Also, dimensions may be incorrect when the page is zoomed by the user;</li>
					<li>browsers do not expose an API to detect this condition.</li>
					<li>The value reported by .outerHeight() is not guaranteed to be accurate when the element or its parent is hidden.</li>
					<li>To get an accurate value, ensure the element is visible before using .outerHeight().</li>
					<li>Will attempt to temporarily show and then re-hide an element in order to measure its dimensions</li>
					<li>The value reported by .outerHeight() is not guaranteed to be accurate when the element or its parent is hidden</li>
					<li>To get an accurate value, ensure the element is visible before using .outerHeight()</li>
					<li>Also, dimensions may be incorrect when the page is zoomed by the user; browsers do not expose an API to detect this condition.</li>
				</ul>
			</div>
			<span class="btn btn-success btn-flat btn-sm" 
				data-remote="<?=base_url('pages/modal/?path='.urlencode('widgets/plgn_dxmultiplepanes/modal-analyze'))?>"
				data-toggle="modal" 
				data-target="#MinDef-Demo-Modal">Analyze</span>
		</div>
	</div>
</div>











