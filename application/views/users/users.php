<?php 
$styles = $this->application->styles_setting();



?>

<section class="content-header">
  <h1>
	<?php echo lang('members_heading');?>
	<small><?php echo lang('members_subheading');?></small>
  </h1>
    <?=$this->application->breadcrumb()?>
</section>
<section class="content">	
	<?=$message?>
	<div class="row">
		<div class="col-md-9">
			<div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title">Current Users</h3>
				  <div class="box-tools pull-right">
					<?php echo anchor(base_url('user/add'), lang('members_create_user_link'), 
						array('class' => element('button_size_tool', $styles) . ' ' . element('button_color_add', $styles) . ' btn btn-flat pull-right'))
					?>	
				  </div>
				</div>
				<div class="box-body">				  
					<table class="table table-bordered table-striped dt-responsive" cellspacing="0" width="100%"
						data-bind="jQueryDataTable: {
							bProcessing: true,
							bServerSide: true,
							responsive: true,
							sAjaxSource: '<?php echo base_url('user/datatable'); ?>',
							sPaginationType: 'simple',
							iDisplayStart: 0,
							oLanguage: {								
								sProcessing: '<i class=\'fa fa-spinner\'></i>'
							},
							fnInitComplete: function () {
							},
							createdRow: function ( row, data, index ) {
								var html ='';
								$.ajax({
									url: '<?php echo base_url('user/get_users_groups'); ?>/' + data.id,
									type: 'GET',
									success: function(group){										
										$(group).each(function(d, i){
											html+= '<a class=\'m-r-5\'>'+ i.name +'<a>';
										})
										.promise()
										.done(function(){
											$('td', row).eq(3).html(html)
										});
									}
								})
								
							},
							columns: [
								{ 
									data: 'email'
								},								
								{ 
									data: 'first_name'
								},
								{ 
									data: 'last_name' 
								},								
								{ 
									data: 'groups',
									sortable: false
								},
								{ 
									data: 'active',
									sortable: false,
									render: function ( data, type, full, meta ) {
									  var color = data==0? 'label-warning' : 'label-primary';
									  var status = data==0? '<?=lang('members_inactive_link');?>' : '<?=lang('members_active_link');?>';
									  return '<span class=\'label '+color+'\'>' + status + '</span>';
									}
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
								<th><?php echo lang('members_email_th');?></th>								
								<th><?php echo lang('members_fname_th');?></th>
								<th><?php echo lang('members_lname_th');?></th>								
								<th><?php echo lang('members_groups_th');?></th>
								<th><?php echo lang('members_status_th');?></th>
								<th><?php echo lang('members_action_th');?></th>
							</tr>	
						</thead>
						
					</table>
				</div>
				
				<div class="box-footer clearfix">				 
					<?php echo anchor(base_url('user/add'), lang('members_create_user_link'), array('class' => element('button_size_form', $styles) . ' ' . element('button_color_add', $styles) . ' btn btn-flat pull-right'))?>				 
				</div>
			</div>
		
		</div>
	</div>
	<div class="col-md-3">	
	</div>	
</section>







