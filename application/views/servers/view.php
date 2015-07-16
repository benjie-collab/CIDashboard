<section class="content-header">
  <h1>
	<?php echo lang('view_server_heading');?>
	<small><?php echo lang('view_server_subheading');?></small>
  </h1>
   <?=$this->application->breadcrumb()?>
</section>

<section class="content">	
	<?php echo $message;?>
	<?php 
	
	if($status){	
		$responsedata = array_get_value($status, 'responsedata');				
		$indexqueue = array_get_value($responsedata, 'indexqueue');
		$termcache = array_get_value($responsedata, 'termcache');
		$indexcache = array_get_value($responsedata, 'indexcache');
		$fieldcodes = array_get_value($responsedata, 'fieldcodes');
		$language_type_settings = array_get_value($responsedata, 'language_type_settings');
		$validation = array_get_value($responsedata, 'validation');
		$compaction = array_get_value($responsedata, 'compaction');	
		$databases = array_get_value($responsedata, 'databases');
		$database = array_get_value($databases, 'database');				
	?>
	
	
	<div class="row">
		<div class="col-md-4">
			<div class="small-box bg-blue">
				<div class="inner">
				  <h3>Server</h3>
				  <p><?=$server->server?></p>
				</div>
				<div class="icon">
				  <i class="fa fa-server"></i>
				</div>
				<a class="small-box-footer" href="#">
				  More info <i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
			
			<div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Databases</h3>
                </div>
                <div class="box-body no-padding">
					<div class="p-10 p-b-0">
					<?php 
						$percentage = ceil((intval(element('num_databases', $databases)) / intval(element('max_databases', $databases))) * 100);
					?>
					  <div class="clearfix  m-t-10">
						<span class="pull-left"><?=intval(element('num_databases', $databases))?> of <?=intval(element('max_databases', $databases))?> Databases</span>
						<small class="pull-right"><?=$percentage?>%</small>
					  </div>
					  <div class="progress md m-t-10">
						<div style="width: <?=$percentage?>%;" class="progress-bar progress-bar-blue"></div>
					  </div>
					</div>			  
					  
					  <div class="max-height-420 p-relative">
							
							<table class="table table-striped table-bordered m-t-10 ">
								<thead>  
									<tr>
										<th>Name</th>
										<th>Documents</th>
										<th>Sections</th>									
									</tr>
								</thead>  
								<tbody>  
									<?php 											
									foreach($database as $data){
									?>
									
										<tr>
											<th><?=element('name', $data)?></th>
											<td><?=element('documents', $data)?></td>
											<td><?=element('sections', $data)?></td>									
										</tr>
									
															
									<?php
									}
								  ?>
								</tbody>
							</table>
							
						 
					  
					  </div>
				</div>
			</div>
			
			  
			  
		</div>
		<div class="col-md-8">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<!--<li class="pull-left header"><i class="fa fa-info-circle"></i> Server Information</li>-->
					<li class="active"><a data-toggle="tab" href="javascript:void(0)" data-target="#view-server-tab-1"> Basic</a></li>
					<li><a data-toggle="tab" href="javascript:void(0)" data-target="#view-server-tab-2">Index Queue</a></li>
					<li><a data-toggle="tab" href="javascript:void(0)" data-target="#view-server-tab-3"> Cache</a></li>
					<!--<li><a data-toggle="tab" href="javascript:void(0)" data-target="#view-server-tab-4"> Index Cache</a></li>-->
					<li><a data-toggle="tab" href="javascript:void(0)" data-target="#view-server-tab-5"> Field Codes</a></li>
					<li><a data-toggle="tab" href="javascript:void(0)" data-target="#view-server-tab-6"> Language</a></li>
					<!--<li><a data-toggle="tab" href="javascript:void(0)" data-target="#view-server-tab-7"> Validation</a></li>-->
					<li><a data-toggle="tab" href="javascript:void(0)" data-target="#view-server-tab-8"> Compaction</a></li>
					<li><a data-toggle="tab" href="javascript:void(0)" data-target="#view-server-tab-9"> Indexer</a></li>
				</ul>
				
				<div class="tab-content">
					<div class="tab-pane active" id="view-server-tab-1">
						<h3>Basic</h3>
						<ul class="list-unstyled">
							<li></li>
							<li></li>
							<li></li>
						</ul>
						<table class="table no-margin table-striped table-bordered">
						  <tbody>                        
							  <?php 
								$info = elements(
											array(
												'product',
												'version',
												'build',
												'licensed_languages',
												'indexport',
												'indexport_ssl_enabled',
												'queryport',
												'aciport',
												'serviceport',
												'directory',
												'querythreads',
												'acithreads',
												'termsperdoc',
												'suggestterms',
												'documents',
												'document_sections',
												'committed_documents',
												'deleted_section',
												'full',
												'full_ratio',
												'terms',
												'total_terms',
												'term_hashes',
												'record_size',
												'max_occurrences',
												'mindate',
												'maxdate',
												'mindatestring',
												'maxdatestring',
												'ref_fields',
												'ref_hashes'
											),
											$responsedata
										);
										
								foreach($info as $key=>$data){
								?>
									<tr>
										<td class="text-capitalize"><?=str_replace(array('_'), ' ', $key) ?></td>
										<th><?=$data?><th>
									</tr>
									
								<?php
								}
							  ?>
							  
							</tbody>
						</table>							
					</div>
					<div class="tab-pane " id="view-server-tab-2">
						<h3>Index Queue</h3>
						<ul class="list-unstyled">
							<li></li>
							<li></li>
							<li></li>
						</ul>
						<table class="table no-margin table-striped table-bordered">
							<tbody>                        
							  <?php 											
								foreach($indexqueue as $key=>$data){
								?>
									<tr>
										<td class="text-right text-capitalize" width="25%"><?=str_replace(array('_'), ' ', $key) ?></td>
										<th><?=$data?></th>
									</tr>
									
								<?php
								}
							  ?>
							  
							</tbody>
						</table>
					</div>							
					<div class="tab-pane " id="view-server-tab-3">
						<h3>Term Cache</h3>
						<ul class="list-unstyled">
							<li></li>
							<li></li>
							<li></li>
						</ul>
						<table class="table no-margin table-striped table-bordered">
							<tbody>                        
							  <?php 											
								foreach($termcache  as $key=>$data){
								?>
									<tr>
										<td class="text-right text-capitalize" width="25%"><?=str_replace(array('_'), ' ', $key) ?></td>
										<th><?=$data?></th>
									</tr>
									
								<?php
								}
							  ?>
							  
							</tbody>
						</table>
						<h3>Index Cache</h3>
						<ul class="list-unstyled">
							<li></li>
							<li></li>
							<li></li>
						</ul>
						<table class="table no-margin table-striped table-bordered">
							<tbody>                        
							  <?php 											
								foreach($indexcache   as $key=>$data){
								?>
									<tr>
										<td class="text-right text-capitalize" width="25%"><?=str_replace(array('_'), ' ', $key) ?></td>
										<th><?=$data?></th>
									</tr>
									
								<?php
								}
							  ?>
							  
							</tbody>
						</table>
					</div>
					<div class="tab-pane " id="view-server-tab-5">
						<h3>Field Codes</h3>
						<ul class="list-unstyled">
							<li></li>
							<li></li>
							<li></li>
						</ul>
						<table class="table no-margin table-striped table-bordered">
							<tbody>                        
							  <?php 											
								foreach($fieldcodes as $key=>$data){
								?>
									<tr>
										<td class="text-right text-capitalize" width="25%"><?=str_replace(array('_'), ' ', $key) ?></td>
										<th><?=$data?></th>
									</tr>
									
								<?php
								}
							  ?>
							  
							</tbody>
						</table>
					</div>
					<div class="tab-pane " id="view-server-tab-6">
						<?php 
							$languages_types = element('no_of_language_types', $language_type_settings);
							$languages_type = element('language_type', $language_type_settings)
						?>
						<h3><?=$languages_types?> Language Types</h3>
						<table class="table no-margin table-striped table-bordered">	
							<thead>  
								<tr>
									<th>Name</th>
									<th>Language</th>
									<th>Encoding</th>									
									<th>Documents</th>
									<th>Sections</th>
								</tr>
							</thead> 
							<tbody>                        
							  <?php 
								foreach($languages_type as $key=>$data){
								?>
									<tr>
										<td><?=element('name', $data)?></td>
										<td><?=element('language', $data)?></td>
										<td><?=element('encoding', $data)?></td>
										<td><?=element('documents', $data)?></td>
										<td><?=element('sections', $data)?></td>
									</tr>									
								<?php
								}
							  ?>
							  
							</tbody>
						</table>
					</div>
					<div class="tab-pane " id="view-server-tab-8">
						<h3>Compaction</h3>
						<ul class="list-unstyled">
							<li></li>
							<li></li>
							<li></li>
						</ul>
						<table class="table no-margin table-striped table-bordered">
							<tbody>                        
							  <?php 											
								foreach($compaction as $key=>$data){
								?>
									<tr>
										<td class="text-right text-capitalize" width="25%"><?=str_replace(array('_'), ' ', $key) ?></td>
										<th><?=$data?></th>
									</tr>
									
								<?php
								}
							  ?>
							  
							</tbody>
						</table>
					</div>
					<div class="tab-pane " id="view-server-tab-9">
						<h3>Indexer</h3>
						<ul class="list-unstyled">
							<li></li>
							<li></li>
							<li></li>
						</ul>
						 <div data-bind="CustomScrollbar: { 
								axis:'y', 
								theme:'dark', 
								autoExpandScrollbar:true, 
								advanced:{
									autoExpandHorizontalScroll:true
									}
								}" class="max-height-500">
							  <?php 	
								$item = array_get_value($indexer_status, 'item');
								$statuscodes = $this->application->get_config('statuscode', 'status');
								
								foreach($item as $key=>$data){
								$idx =  element('status', $data);
								
								?>
									<div class="info-box <?=$idx==-1? 'bg-green' : 'bg-yellow'?>">
										<span class="info-box-icon">
											<?=lang('statuscode_' . abs($idx))?>
										</span>
										<div class="info-box-content">
										  <span class="info-box-text"><?=element(abs($idx), $statuscodes)?></span>
										  <span class="info-box-number"><?=element('documents_processed', $data)?> Documents</span>
										  <div class="progress">
											<div style="width: <?=element('percentage_processed', $data)?>%" class="progress-bar"></div>
										  </div>
										  <span class="progress-description">
											<?=element('percentage_processed', $data)?>% in <?=element('duration_secs', $data)?> seconds
										  </span>
										</div><!-- /.info-box-content -->
									</div>
									
								<?php
								}
							  ?>
						</div>
					</div>
				</div>
				<div class="box-footer">
					
				</div>		
			</div>
			
		
		</div>
	
	</div>
	
	
	<?php
	}
	?>
</section>







