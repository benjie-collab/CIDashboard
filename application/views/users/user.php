
<?php 
	$profile = $this->ion_auth->user()->row();	
	$template_url = $this->template_model->get_template_url();
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
		<div class="list-group">
			<a class="list-group-item active" href="#">
				<i class="fa fa-user"></i> Profile
			</a>
			<a class="list-group-item " href="#">
				<i class="fa fa-warning"></i> Notifications
			</a>
			<a class="list-group-item " href="#">
				<i class="fa fa-tasks"></i> Rules
			</a>
			<a class="list-group-item " href="#">
				<i class="fa fa-dashboard"></i> Dashboard
			</a>
			<a class="list-group-item " href="#">
				<i class="fa fa-calendar"></i> Date
			</a>
			<a class="list-group-item " href="#">
				<i class="fa fa-bars"></i> Others
			</a>
			<a class="list-group-item " href="#">
				<i class="fa fa-bars"></i> Others
			</a>
			<a class="list-group-item " href="#">
				<i class="fa fa-bars"></i> Others
			</a>
			<a class="list-group-item " href="#">
				<i class="fa fa-bars"></i> Others
			</a>
			<a class="list-group-item " href="#">
				<i class="fa fa-bars"></i> Others
			</a>
			<a class="list-group-item " href="#">
				<i class="fa fa-bars"></i> Others
			</a>
		 
		</div>
	</div>
	
	<div class="col-md-9">	
		<ul class="users-list clearfix text-center list-inline">
			<li class="pull-none">
			  <img src="<?=$template_url?>img/user2-160x160.jpg" class="img-circle" alt="User Image" />
			  <a href="#" class="users-list-name">Alexander Pierce</a>
			  <span class="users-list-date">Today</span>
			</li>
			
		  </ul>
		<ul class="timeline">			
			<li>
			  <i class="fa fa-envelope bg-blue"></i>
			  <div class="timeline-item">
				<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
				<h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
				<div class="timeline-body">
				  Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
				  weebly ning heekya handango imeem plugg dopplr jibjab, movity
				  jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
				  quora plaxo ideeli hulu weebly balihoo...
				</div>
				<div class="timeline-footer">
				  <a class="btn btn-primary btn-xs">Read more</a>
				  <a class="btn btn-danger btn-xs">Delete</a>
				</div>
			  </div>
			</li>
		</ul>
	</div>
	


	<?php echo form_open();?>
	<div class="row">
		<div class="col-lg-4">
			<h2 class="page-header"><small>First Name</small></h2>
			 <?php echo form_input('', $profile->first_name, 'class="form-control" disabled');?>
			
			<h2 class="page-header"><small>Last Name</small></h2>
			<?php echo form_input('', $profile->last_name, 'class="form-control" disabled');?>
			
			<h2 class="page-header"><small>Email</small></h2>
			<?php echo form_input('', $profile->email, 'class="form-control" disabled');?>
			
			<h2 class="page-header"><small>Company</small></h2>
			<?php echo form_input('', $profile->company, 'class="form-control" disabled');?>
			
			
			<h2 class="page-header"><small>Phone</small></h2>
			<?php echo form_input('', $profile->phone, 'class="form-control" disabled');?>
			
			<h2 class="page-header"><small>Roles</small></h2>
			<?php foreach ($currentGroups as $group):?>						 
				<?php
				  echo htmlspecialchars($group->name,ENT_QUOTES,'UTF-8');
				 ?>						 
			 <?php endforeach?>
			
			
		</div>
	</div>
	<?php echo form_close();?>

</section>
 






