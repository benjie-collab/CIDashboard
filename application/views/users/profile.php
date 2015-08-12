<?php 
$styles = $this->application->styles_setting();
$template_url 	= base_url('assets/themes/lte/');
?>
<section class="content-header">
  <h1>
	<?php echo lang('profile_user_heading');?>
	<small><?php echo lang('profile_user_subheading');?></small>
  </h1>
    <?=$this->application->breadcrumb()?>
</section>
<?php 
	$atts = array(
			'class' => 'form-horizontal',
			'data-bind' => 'submit: $root.Users.updateProfile', 
			'onsubmit' => 'return false;', 
			'method' => 'POST',
			'id' => ''
	);
	$hidden 		= array();	
?>

<section class="content">	
	<?php echo $message;?>		
		<?php echo form_open(base_url("user/profile/" . $user->id), $atts, $hidden);?> 	
			<div class="form-group">
				<label class="col-sm-2 control-label"></label>
				<div class="col-sm-4 col-xs-6">
					<div class="dropzone text-center" data-bind="Dropzone: { 
					acceptedFiles: '.gif,.jpg,.png',
					createImageThumbnails: false,
					previewTemplate : '<div style=\'display:none\'></div>',
					uploadMultiple: false,				
					dictDefaultMessage: 'Click or Drop image here to change.',
					maxFiles: 1,
					maxfilesreached: function(){},
					init: function() {
						this.hiddenFileInput.removeAttribute('multiple');
					}, 
					success: function(e, r){					
						var messages = $(r.message).filter('div');
						if(messages)
						$.each(messages, function(i,v){
							$.notify({
								message: $(v).text() 
							},
							{
								type: r.response
							});
						
						})
						else
						$.notify({
							message: $(r.message).text() 
						},
						{
							type: r.response
						});					
					},
					complete: function(file, e){	
						this.removeFile(file);
						if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
							window.location.reload();
						}
					},
					sending: function(file, xhr, data){					
						if(typeof(data)!=='undefined')
						data.append('meta_key', 'favicon');
					},
					error: function(e, r){					
						$.notify({
							message: r
						},
						{
							type: 'danger'
						});
					},
					url: '<?=base_url('user/profile_pic/' . $user->id)?>'}">	
	<img src="<?=base_url($user->profile_pic);?>" class="img-circle" style="width: 120px; height: 120px;"/>				
					</div>
				
				</div>
			</div>
				
			<div class="form-group">
				<label class="col-sm-2 control-label"><?php echo lang('edit_user_fname_label', 'first_name');?></label>
				<div class="col-sm-8">
				 <?php echo form_input($first_name);?>
				 </div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label"><?php echo lang('edit_user_lname_label', 'last_name');?></label>
				<div class="col-sm-8">
				 <?php echo form_input($last_name);?>
				 </div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label"><?php echo lang('edit_user_company_label', 'company');?></label>
				<div class="col-sm-8">
				 <?php echo form_input($company);?>
				 </div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label"><?php echo lang('edit_user_phone_label', 'phone');?></label>
				<div class="col-sm-8">
				 <?php echo form_input($phone);?>
				 </div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label"><?php echo lang('edit_user_password_label', 'password');?></label>
				<div class="col-sm-8">
				 <?php echo form_input($password);?>
				 </div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label"><?php echo lang('edit_user_password_confirm_label', 'password_confirm');?></label>
				<div class="col-sm-8">
				 <?php echo form_input($password_confirm);?>
				 </div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label"><?php echo lang('edit_user_groups_heading');?></label>
				<div class="col-sm-8 checkbox">
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
			<div class="row bg-gray p-10">
				<div class="col-sm-8 col-sm-offset-3">							 
				<button type="submit" class="btn <?=element('button_size_form', $styles)?> <?=element('button_color_submit', $styles)?> btn-flat" data-bind="css: { 'has-spinner active' : $root.Users.ajaxProcess}">
				<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
				<?=lang('edit_user_submit_btn')?></button>
				<?=anchor(base_url('user'), 'Cancel', array('class' => element('button_size_form', $styles) . ' ' . element('button_color_cancel', $styles) . ' btn btn-flat'))?>	
				</div>
			</div>
		<?php echo form_close();?>
</section>






