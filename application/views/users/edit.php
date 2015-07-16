<?php 
$styles = $this->application->styles_setting();



?>
<section class="content-header">
  <h1>
	<?php echo lang('edit_user_heading');?>
	<small><?php echo lang('edit_user_subheading');?></small>
  </h1>
    <?=$this->application->breadcrumb()?>
</section>
<?php 
	$atts = array(
			'class' => 'form-horizontal',
			'data-bind' => 'submit: $root.Users.updateUser', 
			'onsubmit' => 'return false;', 
			'method' => 'POST',
			'id' => ''
	);
	$hidden 		= array();		
?>

<section class="content">	
	<?php echo $message;?>
	<div class="row">
		<div class="col-sm-8">
		<?php echo form_open(base_url("user/edit/" . $user->id), $atts, $hidden);?>
		<div class="box box-default">
			<div class="box-header with-border">
			  <h3 class="box-title"></h3>
			</div>
			<div class="box-body">
					<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('edit_user_fname_label', 'first_name');?></label>
					<div class="col-sm-9">
					 <?php echo form_input($first_name);?>
					 </div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('edit_user_lname_label', 'last_name');?></label>
					<div class="col-sm-9">
					 <?php echo form_input($last_name);?>
					 </div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('edit_user_company_label', 'company');?></label>
					<div class="col-sm-9">
					 <?php echo form_input($company);?>
					 </div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('edit_user_phone_label', 'phone');?></label>
					<div class="col-sm-9">
					 <?php echo form_input($phone);?>
					 </div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('edit_user_password_label', 'password');?></label>
					<div class="col-sm-9">
					 <?php echo form_input($password);?>
					 </div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('edit_user_password_confirm_label', 'password_confirm');?></label>
					<div class="col-sm-9">
					 <?php echo form_input($password_confirm);?>
					 </div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('edit_user_groups_heading');?></label>
					<div class="col-sm-9 checkbox">
						<?php if ($this->users->is_admin()): ?>
						  <?php foreach ($groups as $group):?>
							 
							  <?php
								  $gID=$group['id'];
								  $checked = null;
								  $item = null;
								  foreach($currentGroups as $grp) {
									  if ($gID == $grp->id) {
										  $checked= ' checked="checked"';
									  break;
									  }
								  }
							  ?>
								<div class="checkbox checkbox-primary m-l-0">	
									<input type="checkbox" 
									id="<?=element('id', $group)?>" 
									name="groups[]" 
									value="<?=element('id', $group)?>" 
									class="" <?=$checked?>/>
									<label for="<?=element('id', $group)?>">
										<?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>						 
									</label>
								</div>
						  <?php endforeach?>

					  <?php endif ?>
					  <?php echo form_hidden('id', $user->id);?>
					  <?php echo form_hidden($csrf); ?>

					 </div>
				</div>
			</div><!-- /.box-body -->
			<div class="box-footer clearfix">
				<?=anchor(base_url('user'), 'Cancel', array('class' => element('button_size_form', $styles) . ' ' . element('button_color_cancel', $styles) . ' btn btn-flat'))?>				 
				<button type="submit" class="btn <?=element('button_size_form', $styles)?> <?=element('button_color_submit', $styles)?> btn-flat pull-right" data-bind="css: { 'has-spinner active' : $root.Users.ajaxProcess}">
				<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
				<?=lang('edit_user_submit_btn')?></button>
			</div>
		</div>
		<?php echo form_close();?>
	</div>
	<div class="col-sm-4">	
	
	</div>	
</section>






