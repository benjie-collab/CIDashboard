<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/nav'); ?>
<?php $this->load->view('template/aside'); ?>
<?php 
	$mode   = $this->application->get_mode('pages_mode');
?>
 <div class="content-wrapper <?=strcasecmp(element('template', $page), 'full-page')==0? 'p-0' : ''?>" id="pages_page">	
	<?php $this->load->view($main_content); ?>
</div>



<a href="javascript:void(0)" 
	class="no-print floating-tools-button">
	<i class="fa-wrench fa"></i>
</a>
<div class="no-print floating-tools-content">
	<h4 class="text-light-blue p-b-15 m-t-0 m-b-5" style="border-bottom: 1px solid #ddd;">Page Tools</h4>
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
		<div class="form-group">
			<label class="control-label ">Share Location</label>
			<div class="">
				<input type="checkbox" class="share-location" value="" name="share-location" data-bind=""/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label ">Page Mode</label>
			<div class="">
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
					size: 'small', 
					onText: 'Edit', 
					offText: 'View', 
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
	/** Widget Tools **/
	$widgets_tool = $this->application->get_session_userdata('widgets_tool');
	foreach($widgets_tool as $tool){		
		$this->load->view($tool);
	}
?>
<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/footer_scripts'); ?>