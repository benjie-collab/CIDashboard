<?php
	$template_url = $this->template_model->get_template_url();
	$profile 		= $this->users->user()->row();
	$pages 			= $this->application->get_methods('application/views/profile/', 'profile');
	$application 	= $this->template_model->application_data();
	$profile 		= (array) $profile;
?>

<div class="box box-solid">
	<div class="box-body no-padding">
		
		<div class="text-center p-10 bg-maroon-gradient">
			<img src="<?=$template_url?>img/user.jpg" class="img-circle" alt="User Image" />
			<h4><?=element( 'first_name', $profile)?> <?=element( 'last_name', $profile)?></h4>
		</div>
	  <ul class="nav nav-pills nav-stacked">
		<?php 
			foreach($pages as $page):
			$fm = strcasecmp(element('current_fetch_method', $application), 'index')==0? 'profile': element('current_fetch_method', $application);
			$active = strcasecmp($fm, element( '@title', $page))==0? 'active' : '';
			
		?>
			<li class="<?=$active?>">
			<a class="" href="<?=base_url('profile/'. strtolower(element( '@title', $page)) )?>">
				<i class="<?=element( '@icon', $page);?>"></i> <?=element( '@title', $page);?>
			</a>	
			</li>
		<?php	
			endforeach;	
		?>
	  </ul>
	</div><!-- /.box-body -->
</div>

