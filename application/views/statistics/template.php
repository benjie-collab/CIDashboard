<?php 
	$mode 				= $this->application->get_mode('statistics_mode');
	$is_admin 			= $this->users->is_admin();	
?>

<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/nav'); ?>
<?php $this->load->view('template/aside'); ?>

 <div class="content-wrapper" id="statistics_page">	
	<?php 	
	$this->load->view($main_content); ?>
</div>


<a href="javascript:void(0)" 
	class="no-print floating-tools-button">
	<i class="fa-wrench fa"></i>
</a>
<div class="no-print floating-tools-content">
	<h4 class="text-light-blue p-b-15 m-t-0 m-b-5" style="border-bottom: 1px solid #ddd;">Tools</h4>
	<div class="">
		<div class="form-group">
			<label class="control-label ">Statistics Mode</label>
			<div class="">
				<?php 
					$atts = array(
						'class' => '',
						'method' => 'POST',
						'id' => 'app-switch-mode'
					);					
					$hidden = array('name'=> 'statistics_mode');
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
		
		
		<?php 	
		$hidden = array('user_id'=>element('user_id', $parameters));
		$atts = array(
				'class' => '',
				'method' => 'GET'
		);	
		$value = element('active', $parameters); 
		?>
		<?php echo form_open( 'statistics/index/' . $category, $atts, $hidden ); ?>	
		<div class="form-group">
			<label class="control-label ">Status</label>
			<div class="">
				<?php 
					$atts = 'class="form-control" data-bind=" event: { change: function(d,e){ $(e.currentTarget).closest(\'form\').trigger(\'submit\')} }, 
						BootstrapSelect:{ style: \'btn-sm\'}"';
					$value = element('active', $parameters); 							
					if($value==1)
					$status = 'primary';
					elseif(strcasecmp($value,"'0'")==0 )
					$status = 'gray';
					else
					$status = 'warning';
					
					$elements = array(1 => 'Active', "'0'" => 'Inactive', ''=>'All');
				
					echo form_dropdown('active', $elements , $value , $atts);								
				?>
			</div>
		</div>
		<?=form_close()?>
		<?php 	
			$hidden = array('active'=>element('active', $parameters));
			$value = element('user_id', $parameters); 
			$atts = array(
					'class' => '',
					'method' => 'GET'
			);		
			?>
		<?php echo form_open( 'statistics/index/' . $category, $atts, $hidden ); ?>
		<div class="form-group">
			<label class="control-label ">Only My Charts</label>
			<div class="">
				<input type="checkbox" <?=(bool)element('user_id', $parameters)? 'checked' : '' ?> name="user_id" value="<?=$this->users->get_user_id()?>"
				data-bind="BootstrapSwitch:{
					onColor: 'primary', 
					offColor: 'warning',
					size: 'mini', 
					onText: 'Yes', 
					offText: 'No', 
					handleWidth: 40,
					onSwitchChange: function(event, state){		
						$(event.currentTarget).closest('form').trigger('submit')
					}}"/>
			</div>
		</div>
		<?=form_close()?>
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