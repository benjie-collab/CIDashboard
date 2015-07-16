<!DOCTYPE html> 
<html lang="en-US">
  <head>
    <title>K2 Dashboard- Forgot Password</title>
    <meta charset="utf-8">	
	<link href="<?=base_url('assets/css/admin/global.css'); ?>" rel="stylesheet" type="text/css"> 
	<link href="<?=base_url('assets/themes/lte/css/LTE.min.css'); ?>" rel="stylesheet" type="text/css">  
  </head>
  <body class="login-page">
    <div class="container login-box ">
      <?php 
      $attributes = array('class' => 'form-signin form');
      ?>   
		<div class="login-logo">
			<h1 class="m-b-10 text-center">
				<img src="<?=base_url('assets/img/k2-logo.png');?>" title="K2 Dashboard" alt="K2 Dashboard" width="200" class="p-relative"/>
			</h1>
		</div>
	  
		<div class="login-box-body">
			<h1 class="text-center"><?php echo lang('forgot_password_heading');?></h1>
			<p class="text-center"><?php echo lang('forgot_password_subheading');?></p>
			
			
			<div id="alert alert-warning"><?php echo $message;?></div>
			
			<?php echo form_open("user/forgot_password" , $attributes);?>
			<fieldset class="m-t-20">
			  <div class="form-group">	
					<label for="email" class="control-label">
						<?php echo sprintf(lang('forgot_password_email_label'), $identity_label);?>
					</label>
					<?php
					$data = array(
							'id' => 'email',
							'class' => 'form-control',
							'name' => 'email',
							);
					echo form_input($data);?>
			  </div>
			  <button class="btn btn-primary btn-block btn-flat" type="submit"><?=lang('forgot_password_submit_btn')?></button>
			</fieldset>
			<?php echo form_close();?>
			<br/>
			<p class="text-center">- OR -</p>
			<a href="<?=base_url('user/login'); ?>">Login</a><br/>
			<!--<a class="text-center" href="<?=base_url('user/register'); ?>">Register a new membership</a>-->
		</div>
    </div><!--container-->
	<!--
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>-->
  </body>
</html>    
    