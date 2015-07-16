<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/nav'); ?>
<?php $this->load->view('template/aside'); ?>

 <div class="content-wrapper">	
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1 class="page-header"><?php echo lang('search_settings_heading');?>
		<small><?php echo lang('search_settings_subheading');?></small>
	  </h1>
	  <?=$this->template_model->get_breadcrumb() ?>
	</section>
	
	
	<section class="content">		
		<div class="row">
			<div class="col-md-8">
				  <div class="nav-tabs-custom">
					<ul class="nav nav-tabs pull-right">						
						
						<?php 
							foreach($settings as $key=>$tab):
						?>
							<li class=" <?=strcasecmp($setting, $key)===0? 'active': '' ?>"><a  href="<?=base_url()?>search/settings/<?=$key?>" ><?=$tab?></a></li>						
						<?php
							endforeach;
						?>						
					</ul>				
					
					<?php $this->load->view($content); ?>
					  
				  </div><!-- /.nav-tabs-custom -->
				
			</div>
			
			<div class="col-md-4">
				
					
					<div class="box box-danger">
						<div class="box-header">
						  <h3 class="box-title">Server Settings</h3>
						</div><!-- /.box-header -->
						<?php 
						$server 	 =  $this->application->get_config('server', 'search');
						$server 	 = array_merge($server , $this->search_model->get_options('server_settings'));
						$atts = array(
								'class' => '',
								'data-bind' => 'submit: $root.SearchSettings.formSubmit', 
								'method' => 'POST',
								'onSubmit' => 'return false;',
								'id' => 'search_settings_form'
						);
						
						$hidden 		= array('meta_key' => 'server_settings');			
					
						echo form_open( 'search/save_settings/', $atts, $hidden ); ?>
						<div class="box-body">	
							<div class="form-group">
								<label class="" for="text">Server Url</label>
								
							   <?php $data = array(
											  'name'        => 'url',
											  'id'          => 'url',							  
											  'class'		=> 'form-control',
											  'value'		=> element('url',$server),
											  'placeholder'	=> 'http://'
											);

								echo form_input($data); ?>
							</div>
							<div class="form-group">
								<label class="" for="text">Server Port</label>
								
							   <?php $data = array(
											  'name'        => 'port',
											  'id'          => 'port',							  
											  'class'		=> 'form-control',
											  'value'		=> element('port',$server),
											  'placeholder'	=> '8000'
											);

								echo form_input($data); ?>
							</div>
						</div>
						<div class="box-footer text-center">
							<button type="submit" class="btn btn-primary" data-bind="css: { 'has-spinner active' : $root.SearchSettings.ajaxProcess}">
							<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
							Save changes</button>
						</div>
						<?php echo form_close(); ?>
					</div>
						
					
			</div>
			
			
			
		</div>
	</section>
	
	
</div>
<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/footer_scripts'); ?>
