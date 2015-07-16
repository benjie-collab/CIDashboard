<section class="content-header">
  <h1>
	<?php echo lang('statistics_configure_heading');?>
	<small><?php echo lang('statistics_configure_subheading');?></small>
  </h1>
  <?=$this->template_model->get_breadcrumb()?>
</section>
 <section class="content">	


	<div class="row">		
		<div class="col-sm-8">		
			<div class="box box-default">
				<div class="box-header with-border">
				  <h3 class="box-title">Live Preview</h3>
				  <div class="box-tools pull-right">
					<button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
					<button data-widget="remove" class="btn btn-box-tool"><i class="fa fa-times"></i></button>
				  </div>
				</div><!-- /.box-header -->
				<div class="box-body">
					<div class="widget widget-xl" 
					data-bind="DX<?=ucfirst($key['type'])?>: { 
						ajax : '<?=base_url('statistics/get_config')?>',
						meta_key: '<?=$widget_key?>'
					}"></div>
				</div><!-- /.box-body -->
				<!--<div class="box-footer no-padding">
				  <ul class="nav nav-pills nav-stacked">
					<li>
					<a href="#">Y-Axis 
						<span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span>
						<select class="pull-right selectpicker" multiple data-live-search="true">
							<option data-content="<span class='label label-warning'>People</span>" selected>People</option>
							<option data-content="<span class='label label-warning'>Conent Type</span>" selected>Conent Type</option>
							<option data-content="<span class='label label-warning'>Prescription Date</span>">Prescription Date</option>
						</select>
					</a>
						
					</li>
					<li><a href="#">X-Axis <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a></li>
					<li><a href="#">Entity to Count <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
				  </ul>
				</div>--><!-- /.footer -->
			 </div>
		</div>
	
		<div class="col-sm-4">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs pull-right">
				  <li class="active"><a href="javascript:void(0)"><i class="ion ion-ios-calendar-outline"></i></a></li>
				  <li class=""><a href="javascript:void(0)" ><i class="ion ion-ios-people-outline"></i></a></li>
				  <li class=""><a href="javascript:void(0)" ><i class="ion ion-ios-chatboxes-outline"></i></a></li>
				  <li class=""><a href="javascript:void(0)" ><i class="ion ion-levels"></i></a></li>
				  
				  <li class="pull-left header"><i class="fa fa-th"></i>Fields</li>
				</ul>
				<div class="tab-content">
				  <div class="tab-pane active">
					<ul class="todo-list">
						<li>
						  <!-- drag handle -->
						  <span class="handle cursor-move">
							<i class="fa fa-ellipsis-v"></i>
							<i class="fa fa-ellipsis-v"></i>
						  </span>								  
						  <!-- todo text -->
						  <span class="text">Prescription Date</span>
						  <!-- Emphasis label -->
						  <small class="label label-danger"><i class="fa fa-clock-o"></i> dd/mm/yyy</small>
						  <!-- General tools such as edit or delete-->
						  <div class="tools">
							<i class="fa fa-gear"></i>
						  </div>
						</li>
					</ul>
				  </div><!-- /.tab-pane -->
				</div><!-- /.tab-content -->
			  </div>
				
		</div>
	</div>
</section>
<?php $this->load->view($tools); ?>




