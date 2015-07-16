<?php 
/*
* @Title: Category Builder
* @Method: categorybuilder
* @icon: fa-circle-o fa
*/ 
?>

<div class="row">
	<div class="col-md-9 col-sm-12">
		<?php 
			$ts = generate_timestamp();			
		?>
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">
				<i class="fa fa-long-arrow-right"></i>
				My Categorizations</h3>
				<div class="box-tools pull-right">
					<a class="btn btn-success btn-flat btn-sm pull-right" href="<?=base_url('tools/categorybuilder/add')?>" >New Categorization</a>
				</div>
			</div>		
			<div class="box-body" >
				
				<div>
					<table class="table table-bordered table-striped display responsive no-wrap" width="100%"
						data-bind="jQueryDataTable: {
							sPaginationType: 'simple',
							bProcessing: true,
							bServerSide: true,
							sAjaxSource: '<?php echo base_url('tools/categorybuilder_datatable'); ?>',
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
									data: 'id'
								},
								{ 
									data: 'name'
								},
								{ 
									data: 'active',
									render: function ( data, type, full, meta ) {
									  var color = data==0? 'label-warning' : 'label-primary';
									  var status = data==0? 'in-active' : 'active';
									  return '<span class=\'label '+color+'\'>' + status + '</span>';
									}
								},		
								{ 
									data: 'actions',
									sortable: false
								}
							],
							order: [[ 0, 'desc' ]],
							columnDefs: [],	
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
								<th>Name</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>	
						</thead>
						
					</table>
				
				
				</div>
			</div>
			<div class="box-footer clearfix">
				<a class="btn btn-success btn-flat btn-sm pull-right" href="<?=base_url('tools/categorybuilder/add')?>" >New Categorization</a>
			</div>
		</div>
	
	</div>
	
	
	
	
	<div class="col-md-3 col-sm-12">	
		
	</div>
	
</div>




