<section class="content-header">
  <h1>
	<?php echo lang('document_heading');?>
	<small><?php echo lang('document_subheading');?></small>
  </h1>
    <?=$this->application->breadcrumb()?>
   
</section>

<section class="content">
	<?=$message?>
	<div class="row">
		<div class="col-md-9">
			<div class="box box-primary">
				<div class="box-header">
				  <h3 class="box-title">
					<i class="fa fa-file-text-o"></i>
					Documents</h3>
				  <div class="box-tools pull-right">
					<?php echo anchor(base_url('document/add'), 'Upload Document', array('class' => 'btn btn-success btn-flat btn-sm'))?>	
				  </div>
				</div>
				<div class="box-body">
					<div class="">
					<table class="table table-bordered table-striped display responsive no-wrap" width="100%"
						data-bind="jQueryDataTable: {
							bProcessing: true,
							bServerSide: true,
							sAjaxSource: '<?php echo base_url('document/datatable'); ?>',
							sPaginationType: 'simple',
							iDisplayStart: 0,
							oLanguage: {								
								sProcessing: '<i class=\'fa fa-spinner\'></i>'
							},
							fnInitComplete: function () {
							},
							columns: [
								{ 
									data: 'id',
									visible: false
								},
								{ 
									data: 'file_name'
								},
								{ 
									data: 'file_type'
								},
								{ 
									data: 'file_size'
								},
								{ 
									data: 'actions',
									sortable: false
								}
							],
							order: [[ 0, 'desc' ]],
							fnServerData: function (sSource, aoData, fnCallback) {
								$.ajax
								({
									dataType: 'json',
									type: 'POST',
									url: sSource,
									data: aoData,
									success: fnCallback
								});
							}
						}">
						
						<thead>
							<tr>
								<th>Id</th>
								<th>File Name</th>
								<th>Type</th>
								<th>Size</th>
								<th>Actions</th>
							</tr>	
						</thead>
						
					</table>
					
					</div>
				</div>
				
				<div class="box-footer clearfix">				 
					<?php echo anchor(base_url('document/add'), 'Upload Document', array('class' => 'btn btn-success btn-flat btn-sm pull-right'))?>				 
				</div>
			</div>
		
		</div>
	</div>
	<div class="col-md-3">	
	</div>	
</section>







