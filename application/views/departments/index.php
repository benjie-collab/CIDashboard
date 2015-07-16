<section class="content-header">
  <h1>
	<?php echo lang('groups_heading');?>
	<small><?php echo lang('groups_subheading');?></small>
  </h1>
    <?=$this->application->breadcrumb()?>
</section>

<section class="content">	
	<div id="infoMessage"><?php echo $message;?></div>
	<div class="row">
		<div class="col-md-9">
		
			<div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title">Current Departments</h3>
				  <div class="box-tools pull-right">
					<?php echo anchor(base_url('departments/add'), lang('groups_create_group_link'), array('class' => 'btn btn-sm btn-success btn-flat pull-right'))?>	
				  </div>
				</div>
				<div class="box-body">				  
					<table class="table table-bordered table-striped dt-responsive" cellspacing="0" width="100%"
						data-bind="jQueryDataTable: {
							bProcessing: true,
							bServerSide: true,
							responsive: true,
							sAjaxSource: '<?php echo base_url('departments/datatable'); ?>',
							sPaginationType: 'simple',
							iDisplayStart: 0,
							oLanguage: {								
								sProcessing: '<i class=\'fa fa-spinner\'></i>'
							},
							fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {								
								$(nRow).addClass( 'animated' );
								return nRow;
							},		
							columns: [
								{ 
									data: 'name'
								},
								{ 
									data: 'description'
								},								
								{ 
									data: 'actions',
									sortable: false
								}
							],
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
								<th><?php echo lang('groups_name_th');?></th>								
								<th><?php echo lang('groups_description_th');?></th>								
								<th><?php echo lang('groups_action_th');?></th>
							</tr>	
						</thead>
						
					</table>
				</div>
				
				<div class="box-footer clearfix">				 
					<?php echo anchor(base_url('departments/add'), lang('groups_create_group_link'), array('class' => 'btn btn-sm btn-success btn-flat pull-right'))?>				 
				</div>
			</div>
			
			
			
			
		
		</div>
	</div>
	<div class="col-md-3">	
	</div>	
</section>












