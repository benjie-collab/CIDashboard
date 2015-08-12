<?php 
	$delimiter = $this->application->get_config('metakey_delimiter', 'template');
?>
<a href="javascript:void(0)" 
	class="no-print floating-tools-button">
	<i class="fa-gear fa"></i>
</a>
<div class="no-print floating-tools-content">	
	<h4 style="border-bottom: 1px solid #ddd; " class="m-b-5 p-b-15 m-t-0 text-light-blue">Options</h4>	
	
	<form method="POST" class="dx-multiple-panes-form">
		<div class="form-group" id="">
			<label>Search by Keyword</label>
			<input type="text" class="form-control" name="search" placeholder="Search..." />						
		</div>
		<div class="form-group" id="">
			<label>Filter by Date</label>
			<input type="text" 
				name="daterange" value="" 
				class="form-control" 
				placeholder="DD/MM/YYYY - DD/MM/YYYY" 
				data-bind="BootstrapDateRangePicker:{ format:'DD/MM/YYYY',  opens: 'left'}"/>
		</div>
		<div class="form-group" id="">
			<a class="btn btn-app play-button">
				<i class="fa fa-play"></i> Play
			</a>
		</div>
	<div class="box-footer clearfix">
		<button class="btn btn-sm btn-flat btn-primary" rel="in">Submit</button>
	</div>
	</form>
</div>

<a href="javascript:void(0)" 
	class="no-print floating-tools-button">
	<i class="ion ion-arrow-graph-up-right"></i>
</a>
<div class="no-print floating-tools-content">	
	<h4 style="border-bottom: 1px solid #ddd; " class="m-b-5 p-b-15 m-t-0 text-light-blue">More Statistics</h4>	
	<div id="" data-bind="CustomScrollbar: {
		theme:'minimal-dark', 
		scrollbarPosition: 'inside',
		autoExpandScrollbar: true}" class="max-height-420 sub-panes">
	<ul class="list-unstyled">
		<li class="widget widget-xs bg-gray disabled"></li>
		<li class="widget widget-xs bg-gray disabled"></li>
		<li class="widget widget-xs bg-gray disabled"></li>
		<li class="widget widget-xs bg-gray disabled"></li>
	</ul>
	</div>
</div>






<div class="modal fade" id="MinDef-Demo-Modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" >
			<div class="text-center has-spinner active">
				<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>
			</div>
			</div>			
		</div>
	</div>
</div>