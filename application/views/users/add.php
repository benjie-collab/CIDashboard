<?php 
$styles = $this->application->styles_setting();



?>
<section class="content-header">
  <h1>
	<?php echo lang('create_user_heading');?>
	<small><?php echo lang('create_user_subheading');?></small>
  </h1>
    <?=$this->application->breadcrumb()?>
</section>
<?php 
	$atts = array(
			'class' => 'form-horizontal',
			'data-bind' => 'submit: $root.Users.createUser', 
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
			<?php echo form_open("user/add", $atts, $hidden);?>
			<div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title"></h3>
				  <div class="box-tools pull-right">

				  </div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('create_user_fname_label', 'first_name');?></label>
						<div class="col-sm-9">
						 <?php echo form_input($first_name);?>
						 </div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('create_user_lname_label', 'last_name');?></label>
						<div class="col-sm-9">
						 <?php echo form_input($last_name);?>
						 </div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('create_user_company_label', 'company');?></label>
						<div class="col-sm-9">
						 <?php echo form_input($company);?>
						 </div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('create_user_email_label', 'email');?></label>
						<div class="col-sm-9">
						 <?php echo form_input($email);?>
						 </div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('create_user_phone_label', 'phone');?></label>
						<div class="col-sm-9">
						 <?php echo form_input($phone);?>
						 </div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('create_user_password_label', 'password');?></label>
						<div class="col-sm-9">
						 <?php echo form_input($password);?>
						 </div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('create_user_password_confirm_label', 'password_confirm');?></label>
						<div class="col-sm-9">
						 <?php echo form_input($password_confirm);?>
						 </div>
					</div>
					

					
				</div>				
				<div class="box-footer clearfix">	
					<?=anchor(base_url('user'), 'Cancel', array('class' => element('button_size_form', $styles) . ' ' . element('button_color_cancel', $styles) . ' btn btn-flat'))?>				 
					<button type="submit" class="btn <?=element('button_size_form', $styles)?> <?=element('button_color_submit', $styles)?> btn-flat pull-right" data-bind="css: { 'has-spinner active' : $root.Users.ajaxProcess}">
				<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
				<?=lang('create_user_submit_btn')?></button>
				</div>
			</div>
			<?php echo form_close();?>
		
		</div>
	</div>
	<div class="col-md-3">	
	</div>	
</section>







