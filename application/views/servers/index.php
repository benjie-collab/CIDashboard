<section class="content-header">
  <h1>
	<?php echo lang('servers_heading');?>
	<small><?php echo lang('servers_subheading');?></small>
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
					<i class="fa fa-server"></i>
					Current Servers</h3>
				  <div class="box-tools pull-right">
					<?php echo anchor(base_url('servers/add'), 'New Server', array('class' => 'btn btn-success btn-flat btn-sm'))?>	
				  </div>
				</div>
				<div class="box-body">
				  <div class="">
					<table class="table table-bordered table-striped" 
						data-bind="jQueryDataTable: {
							bProcessing: true,
							bServerSide: true,
							sAjaxSource: '<?php echo base_url('servers/datatable'); ?>',
							sPaginationType: 'simple',
							iDisplayStart: 0,
							oLanguage: {								
								sProcessing: '<i class=\'fa fa-spinner\'></i>'
							},
							fnInitComplete: function () {
							},
							columns: [
								{ 
									data: 'server'
								},
								{ 
									data: 'username',
									sortable: false
								},								
								{ 
									data: 'password',
									sortable: false
								},
								{ 
									data: 'actions',
									sortable: false
								}
							],
							aoColumnDefs: [
								{
									fnRender: function ( oObj ) {
													return '<a href=\'' + oObj.aData[0] + '\'>' + oObj.aData[0] + '</a>';   
												},
									aTargets: [ 0 ]
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
								<th><?php echo lang('servers_url_th');?></th>
								<th><?php echo lang('servers_username_th');?></th>
								<th><?php echo lang('servers_password_th');?></th>
								<th><?php echo lang('servers_actions_th');?></th>
							</tr>	
						</thead>
						
					</table>
				</div>
				</div>
				
				<div class="box-footer clearfix">				 
					<?php echo anchor(base_url('servers/add'), 'New Server', array('class' => 'btn btn-success btn-flat btn-sm pull-right'))?>				 
				</div>
			</div>
		
		</div>
	</div>
	<div class="col-md-3">	
	</div>	
</section>







