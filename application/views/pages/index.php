<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/nav'); ?>
<?php $this->load->view('template/aside'); ?>
<?php 
	$mode   = $this->application->get_mode('pages_mode');
?>
 <div class="content-wrapper" id="pages_page">	
	<?php $this->load->view($main_content); ?>
</div>
<div class="bg-gray p-10 p-l-20 p-r-20 main-footer" id="edit-mode-helper" data-bind="ScrollToFixed:{ bottom: 0, limit: $('#edit-mode-helper').offset().top}">
	<ul class="list-inline m-0">
		<li>
			<a class="sidebar-toggle btn-group" href="javascript:void(0)" data-toggle="offcanvas">
			  <button class="btn btn-default" type="button">Menu</button>
			  <button class="btn btn-default" type="button" >
				<i class="fa fa-bars"></i>
			  </button>			 
			</a>
		</li>
		<li class="pull-right">
			<?php 
				$atts = array(
					'class' => '',
					'method' => 'POST',
					'id' => 'app-switch-mode'
				);					
				$hidden = array('name'=> 'pages_mode');
				echo form_open( 'app/switch_mode/', $atts, $hidden); ?>		
				<input type="checkbox" <?=(bool)$mode? 'checked' : '' ?> name="mode"
					data-bind="BootstrapSwitch:{
						onColor: 'danger', 
						offColor: 'warning',
						size: 'medium', 
						onText: 'Edit', 
						offText: 'View', 
						labelText: 'Mode',
						onSwitchChange: function(event, state){	
							$('#app-switch-mode').trigger('submit');							
						}}"/>
			<?=form_close()?>			
		</li>
		<li class="pull-right">	
			<input type="checkbox" class="share-location" value="" name="share-location" data-bind=""/>
		</li>
	</ul>
</div>
<?php 
if($mode )
$this->load->view($tools); 
?>
<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/footer_scripts'); ?>