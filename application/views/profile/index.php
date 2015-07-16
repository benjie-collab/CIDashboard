<?php 
/*
* @Title: Profile
* @Method: Profile 
* @icon: fa-user fa
*/ 
?>


<?php 
	$profile = $this->users->user()->row();	
	$template_url = $this->template_model->get_template_url();
	$profile = (array) $profile;
?>

<section class="content-header">
  <h1>
	<?php echo lang('profile_heading');?>
	<small><?php echo lang('profile_subheading');?></small>
  </h1>
  <?=$this->application->breadcrumb()?>
</section>
<section class="content">
	<div class="col-md-3">
		<?php $this->load->view($sidebar); ?>		
	</div>
	
	<div class="col-md-9">	
		<div class="box box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"></h3>
			</div>
			<div class="box-body">
				<form class="form-horizontal" action="" >
					<div class="form-group">
						<label class="col-sm-3 control-label">First Name</label>
						<div class="col-sm-9">
							<input type="text" value="<?=element('first_name', $profile);?>" class="form-control input-lg"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Last Name</label>
						<div class="col-sm-9">
							<input type="text" value="<?=element('last_name', $profile);?>" class="form-control input-lg"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Email</label>
						<div class="col-sm-9">
							<input type="text" value="<?=element('email', $profile);?>" class="form-control input-lg"/>
						</div>
					</div>			
				</form>
			</div><!-- /.box-body -->
		</div>
			
	</div>
</section>
 






