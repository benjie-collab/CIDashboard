<?php 
	$mode 				= $this->application->get_mode('search_mode');
	$is_admin 			= $this->users->is_admin();
	$document_options	= $this->search_model->get_options('document_options');
	$template 			= element('template', $document_options)? element('template', $document_options): 'default';
?>
<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/nav'); ?>
<?php $this->load->view('template/aside'); ?>
 <div class="content-wrapper">	
	<?php $this->load->view('search/templates/document/'. $template); ?>
</div>

<?php if($is_admin) { ?>
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
		<li>
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
						size: 'medium', 
						onText: 'Edit', 
						offText: 'View', 
						labelText: 'Switch Mode',
						onSwitchChange: function(event, state){	
							$('#app-switch-mode').trigger('submit');							
						}}"/>
			<?=form_close()?>			
		</li>
	</ul>
</div>
<?php } ?>


<?php 	
	if($mode)
	$this->load->view($tools); 	
?>
<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/footer_scripts'); ?>