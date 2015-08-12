<?php 
$styles = $this->application->styles_setting();
$template_url 	= 'assets/themes/lte/';	

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
	$hidden 		= array('profile_pic' => $template_url . 'img/user.jpg');		
?>

<section class="content">	
	<?php echo $message;?>
			<?php echo form_open("user/add", $atts, $hidden);?>
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
				<label class="col-sm-3 control-label"><?php echo lang('edit_user_groups_heading');?></label>
				<div class="col-sm-9 checkbox">
					<?php if ($this->users->is_admin()): ?>
					  <?php foreach ($groups as $group):?>
							<div class="checkbox checkbox-primary m-l-0">	
								<input type="checkbox" 
								id="<?=element('id', $group)?>" 
								name="groups[]" 
								value="<?=element('id', $group)?>" 
								class=""/>
								<label for="<?=element('id', $group)?>">
									<?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>						 
								</label>
							</div>
					  <?php endforeach?>

				  <?php endif ?>

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

			
		
				
			<div class="row bg-gray p-10">
				<div class="col-sm-9 col-sm-offset-3">							 
				<button type="submit" class="btn <?=element('button_size_form', $styles)?> <?=element('button_color_submit', $styles)?> btn-flat" data-bind="css: { 'has-spinner active' : $root.Users.ajaxProcess}">
				<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
				<?=lang('edit_user_submit_btn')?></button>
				<?=anchor(base_url('user'), 'Cancel', array('class' => element('button_size_form', $styles) . ' ' . element('button_color_cancel', $styles) . ' btn btn-flat'))?>	
				</div>
			</div>
			<?php echo form_close();?>
</section>







