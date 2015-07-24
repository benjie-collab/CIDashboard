<?php 
	$delimiter = $this->application->get_config('metakey_delimiter', 'template');
?>
<a href="javascript:void(0)" 
	class="no-print floating-tools-button">
	<i class="fa-gear fa"></i>
</a>
<div class="no-print floating-tools-content">	
	<h4 style="border-bottom: 1px solid #ddd; " class="m-b-5 p-b-15 m-t-0 text-light-blue">Tools</h4>	
	<div id="mainpanel">
		<div class="col">
			<!--
			<div id="legend">
				<div class="">
					<h2>Legend:</h2>
					<dl>
						<dt class="node"></dt>
						<dd></dd>
						<dt class="edge"></dt>
						<dd></dd>
						<dt class="colours"></dt>
						<dd></dd>		
					</dl>
				</div>
			</div> -->
			<div class="b1">
				<form>
					<div class="form-group" id="sigma_network_search">
						<input type="text" name="search" placeholder="Search by name" class="form-control"/><div class="state"></div>
						<div class="results"></div>							
					</div>
					<div class="widget widget-sm max-height-320" id="attributeselect" data-bind="CustomScrollbar:{}">						
						<!--<div class="select">Select Group</div>-->
						<b>Groups:</b>
						<ul class="list list-unstyled"></ul>
					</div>
				</form>
			</div>
		</div>
		<div id="information">
		</div>
	</div>
	
	<div class="box-footer clearfix text-center">
		<ul id="zoom" class="list-inline m-0">
			<li><a href="javascript:void(0)" class="z btn btn-sm btn-flat btn-default" rel="in"><i class="fa fa-search-plus"></i></a></li> 
			<li><a href="javascript:void(0)" class="z btn btn-sm btn-flat btn-default" rel="out"><i class="fa fa-search-minus"></i></a></li> 
			<li><a href="javascript:void(0)" class="z btn btn-sm btn-flat btn-default" rel="center"><i class="fa fa-plus"></i></a></li>
		</ul>
	</div>
</div>


<a href="javascript:void(0)" 
	class="no-print floating-tools-button">
	<i class="fa-info-circle fa"></i>
</a>
<div class="no-print floating-tools-content" id="attributepane">	
	<h4 style="border-bottom: 1px solid #ddd; " class="m-b-5 p-b-15 m-t-0 text-light-blue">Information</h4>
	<div class="text">				
		<div class="nodeattributes max-height-420 widget widget-md" data-bind="CustomScrollbar:{}">
			<div class="name"></div>
			<div class="data"></div>
			<b>Connections:</b>
			<div class="link">
				<ul>
				</ul>
			</div>
		</div>
	</div>
	<div class="box-footer clearfix text-center">
		<a href="javascript:void(0)" class="returntext btn btn-sm btn-flat btn-default"><i class="fa fa-reply"></i> Return to the full network</a>	
	</div>
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