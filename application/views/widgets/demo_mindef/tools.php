<?php 
	$delimiter = $this->application->get_config('metakey_delimiter', 'template');
?>
<a href="javascript:void(0)" 
	class="no-print floating-tools-button">
	<i class="fa-gear fa"></i>
</a>
<div class="no-print floating-tools-content">	
	<h4 style="border-bottom: 1px solid #ddd; " class="m-b-5 p-b-15 m-t-0 text-light-blue">Options</h4>	
	
	<form method="POST" id="demo_form">
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
	
	<div class="box-footer clearfix">
		<button class="btn btn-sm btn-flat btn-primary" rel="in">Submit</button>
	</div>
	</form>
</div>



<!--
<div class="modal fade" id="modal-widget-options">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
			<div class="text-center has-spinner active">
				<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>
			</div>
			</div>			
		</div>
	</div>
</div>-->