<?php 
/*
* @Title: Demo MinDef
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


<div id="demo_mindef" class="widget-full-page">
	<div id="" class="widget chart p-absolute" style="width: 100%; left: 5; right: 5; bottom: 130px; top: 0;"></div>
	<div id="" class="widget range-selector p-absolute" style="width: 100%; left: 0; right: 0; bottom: 0; height: 120px;"></div>
	
	<div class="popover popover-xl" id="">
		<div class="arrow"></div>
		<h3 class="popover-title">Popover right <i class="fa fa-remove pull-right cursor-pointer popover-close"></i></h3>
		<div class="popover-content widget max-height-320" data-bind="CustomScrollbar: { axis:'y', theme:'dark', scrollbarPosition: 'inside'}">
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
	</div>
</div>










