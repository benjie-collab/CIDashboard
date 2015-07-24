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
<?php if($is_admin) { ?>
<div class="bg-gray p-5 p-l-10 p-r-10 main-footer" id="edit-mode-helper" data-bind="ScrollToFixed:{ bottom: 0, limit: $('#edit-mode-helper').offset().top}">
	<ul class="list-inline m-0">
		<li></li>
		<li class="pull-right">
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
						onColor: 'warning', 
						offColor: 'warning',
						size: 'mini', 
						onText: 'Edit', 
						offText: 'View', 
						labelText: 'Mode',
						onSwitchChange: function(event, state){	
							$('#app-switch-mode').trigger('submit');							
						}}"/>
			<?=form_close()?>			
		</li>
	</ul>
</div>
<?php } ?>
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





