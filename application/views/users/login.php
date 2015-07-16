<!DOCTYPE html> 
<html lang="en-US">
  <head>
    <title>CodeIgniter Admin Sample Project</title>
    <meta charset="utf-8">
	<link href="<?php echo base_url(); ?>assets/css/admin/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/themes/todc/css/todc-bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/admin/admin.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div class="container login ">
      <?php 
      $attributes = array('class' => 'form-signin form');
      /**echo form_open('admin/login/validate_credentials', $attributes);
      echo '<h2 class="form-signin-heading">Login</h2>';
      echo form_input('user_name', '', 'placeholder="Username"');
      echo form_password('password', '', 'placeholder="Password"');
      if(isset($message_error) && $message_error){
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
          echo '</div>';             
      }
      echo "<br />";
      echo anchor('admin/user/add', 'Signup!');
      echo "<br />";
      echo "<br />";
      echo form_submit('submit', 'Login', 'class="btn btn-large btn-primary"');
      echo form_close();**/
      ?>   
		<h1 class="m-b-10 text-center">
			<img src="<?php echo base_url();?>assets/img/k2-logo.png" title="K2 Dashboard" alt="K2 Dashboard" width="200" class="p-relative"/>
		</h1>
		
	  
		<?php 
		echo form_open('/user/login', $attributes);
		  ?>
			
			<h1 class="text-center"><?php echo lang('login_heading');?></h1>
			<p class="text-center"><?php echo lang('login_subheading');?></p>			
			<?=$message?>
			<fieldset class="m-t-20">
			  <div class="form-group">				
				  <input type="text" id="identity" class="form-control" name="identity" placeholder="Username/Email" value="<?php echo set_value('identity'); ?>" >
					<?php if(form_error('identity')): ?>
						<?php //echo form_error('identity'); ?>
					<?php endif; ?>				
			  </div>
			  <div class="form-group">					
				<input type="password" id="password" class="form-control" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>" >	
					<?php if(form_error('password')): ?>
						<?php //echo form_error('password'); ?>
					<?php endif; ?>
				
			  </div>
			  
			    <div class="checkbox">	
					<label for="remember">					
					<input type="checkbox" id="remember" name="remember" value="<?php echo set_value('remember'); ?>" >
					<?php echo lang('login_remember_label');?>
					</label>
				</div>
			  
			  		
				
				<div class="text-center m-t-20">
				<?php echo form_submit('Login', lang('login_submit_btn'), "class='btn btn-large btn-primary'");?>
				</div>
				<p class="text-center"><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
			 
			<fieldset>
		<?php 
		echo form_close();
		?>      
		
    </div><!--container-->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>    
    