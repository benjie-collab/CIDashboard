<section class="content-header">
  <h1>
	<?php echo lang('create_group_heading');?>
	<small><?php echo lang('create_group_subheading');?></small>
  </h1>
   <?=$this->application->breadcrumb()?>
</section>


<?php 
	$atts = array(
			'class' => 'form-horizontal',
			'data-bind' => 'submit: $root.Departments.createDepartment', 
			'onsubmit' => 'return false;', 
			'method' => 'POST',
			'id' => ''
	);
	$hidden 		= array();		
?>
<section class="content">	
	<?php echo $message;?>
	<div class="row">
		<div class="col-md-9">
			<?php echo form_open("departments/add", $atts, $hidden);?>
			<div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title"></h3>
				  <div class="box-tools pull-right">

				  </div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('create_group_name_label', 'group_name');?></label>
						<div class="col-sm-9">
						 <?php echo form_input($group_name);?>
						 </div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('create_group_desc_label', 'description');?></label>
						<div class="col-sm-9">
						 <?php echo form_input($description);?>
						 </div>
					</div>
					
				</div>				
				<div class="box-footer clearfix">	
					<a class="btn btn-sm btn-default btn-flat" type="button" href="<?=base_url('departments')?>">Cancel</a>
					<button type="submit" class="btn btn-sm btn-primary btn-flat pull-right" data-bind="css: { 'has-spinner active' : $root.Departments.ajaxProcess}">
					<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
					<?=lang('create_group_submit_btn')?></button>
				</div>
			</div>
			<?php echo form_close();?>
		
		</div>
	</div>
	<div class="col-md-3">	
	</div>	
</section>






