<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/nav'); ?>
<?php $this->load->view('template/aside'); ?>

<?php
	$mode 				= $this->application->get_mode('dashboard_mode');
	$is_admin 			= $this->users->is_admin();
?>
 <div class="content-wrapper">	
	<?php $this->load->view($main_content); ?>
</div>


<a href="javascript:void(0)" 
	class="no-print floating-tools-button">
	<i class="fa-wrench fa"></i>
</a>
<div class="no-print floating-tools-content">
	<h4 class="text-light-blue p-b-15 m-t-0 m-b-5" style="border-bottom: 1px solid #ddd;">Dashboard Tools</h4>
	<div class="">
		<div class="form-group">
			<label class="control-label ">Dashboard Mode</label>
			<div class="">
				<?php 
					$atts = array(
						'class' => '',
						'method' => 'POST',
						'id' => 'app-switch-mode'
					);					
					$hidden = array('name'=> 'dashboard_mode');
				echo form_open( 'app/switch_mode/', $atts, $hidden); ?>		
				<input type="checkbox" <?=(bool)$mode? 'checked' : '' ?> name="mode"
				data-bind="BootstrapSwitch:{
					onColor: 'danger', 
					offColor: 'warning',
					size: 'mini', 
					onText: 'Edit', 
					offText: 'View',
					handleWidth: 40,
					onSwitchChange: function(event, state){	
						$('#app-switch-mode').trigger('submit');							
					}}"/>
				<?=form_close()?>
			</div>
		</div>
	</div>
	
	
</div>


<?php 		
	foreach($tools as $key=>$tool){		
		if(!strcasecmp($key, 'edit')==0)
		$this->load->view($tool);
		elseif($mode && strcasecmp($key, 'edit')==0)
		$this->load->view($tool);
	}
?>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/footer_scripts'); ?>





