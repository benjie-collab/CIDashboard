<?php 
$styles = $this->application->styles_setting();
?>
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
	
	<?php echo form_open("departments/add", $atts, $hidden);?>
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
		<div class="row bg-gray p-10">
			<div class="col-sm-9 col-sm-offset-3">			
			<button type="submit" class="btn <?=element('button_size_form', $styles)?> <?=element('button_color_submit', $styles)?> btn-flat" data-bind="css: { 'has-spinner active' : $root.Departments.ajaxProcess}">
			<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
			<?=lang('create_group_submit_btn')?></button>
			<?=anchor(base_url('departments'), 'Cancel', array('class' => element('button_size_form', $styles) . ' ' . element('button_color_cancel', $styles) . ' btn btn-flat'))?>	
			</div>
		</div>
	<?php echo form_close();?>
</section>






