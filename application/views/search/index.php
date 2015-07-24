<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/nav'); ?>
<?php $this->load->view('template/aside'); ?>

<?php 
	$mode 				= $this->application->get_mode('search_mode');
	$is_admin 			= $this->users->is_admin();
	//$search_options 	= $this->search_model->get_options('search_options');
	//$template 			= element('template', $search_options)? element('template', $search_options): 'default';	
	$template 			= isset($template) && $template? $template : 'default';	
?>

 <div class="content-wrapper">	
	<?php 
		//if(!$responsedata):	
			//$this->load->view('search/error');
		//else:
			$this->load->view('search/templates/index/'. $template);
		//endif;
	?>
</div>




<a href="javascript:void(0)" 
	class="no-print floating-tools-button">
	<i class="fa-wrench fa"></i>
</a>
<div class="no-print floating-tools-content">
	<h4 style="border-bottom: 1px solid #ddd; " class="text-light-blue p-b-15 m-t-0 m-b-5">Search Tools</h4>
	<div class="">
		<div class="form-group">
			<label class="control-label ">Toggle Menu</label>
			<div class="">
				<a class="sidebar-toggle btn-group" href="javascript:void(0)" data-toggle="offcanvas">
				  <button class="btn btn-default btn-sm" type="button">Menu</button>
				  <button class="btn btn-default btn-sm" type="button" >
					<i class="fa fa-bars"></i>
				  </button>			 
				</a>
			</div>
		</div>
		<div class="form-group <?=$is_admin?'':'hidden'?>">
			<label class="control-label ">Mode</label>
			<div class="">
				<?php 
					$atts = array(
						'class' => '',
						'method' => 'POST',
						'id' => 'app-switch-mode'
					);					
					$hidden = array('name'=> 'search_mode');
					echo form_open( 'app/switch_mode/', $atts, $hidden); ?>		
					<input type="checkbox" <?=(bool)$mode? 'checked' : '' ?> name="mode"
						data-bind="BootstrapSwitch:{
							onColor: 'danger', 
							offColor: 'warning',
							size: 'small', 
							onText: 'Edit', 
							offText: 'View', 
							labelText: 'Mode',
							onSwitchChange: function(event, state){	
								$('#app-switch-mode').trigger('submit');							
							}}"/>
				<?=form_close()?>			
			</div>
		</div>
		
	</div>
</div>		
<?php 	
	if($mode)
	$this->load->view($tools); 	
?>
<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/footer_scripts'); ?>