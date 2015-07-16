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

<?php $this->load->view($tools); ?>

<div class="bg-gray p-10 p-l-20 p-r-20 main-footer" id="edit-mode-helper" data-bind="ScrollToFixed:{ bottom: 0, limit: $('#edit-mode-helper').offset().top}">
	

	<ul class="list-inline m-0">
		<li>
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
						size: 'medium', 
						onText: 'Edit', 
						offText: 'View', 
						labelText: 'Switch Mode',
						onSwitchChange: function(event, state){	
							$('#app-switch-mode').trigger('submit');							
						}}"/>
			<?=form_close()?>			
		</li>	

		<li class="pull-right">	
			<?php 	
			$hidden = array('active'=>element('active', $parameters));
			$atts = array(
					'class' => '',
					'method' => 'GET'
			);		
			?>
			<?php echo form_open( 'statistics/index/' . $category, $atts, $hidden ); ?>	
		
				<input type="checkbox" <?=(bool)element('user_id', $parameters)? 'checked' : '' ?> name="user_id" value="<?=$this->users->get_user_id()?>"
				data-bind="BootstrapSwitch:{
					onColor: 'primary', 
					offColor: 'warning',
					size: 'medium', 
					onText: 'Yes', 
					offText: 'No', 
					labelText: 'My Charts',
					onSwitchChange: function(event, state){		
						$(event.currentTarget).closest('form').trigger('submit')
					}}"/>
			<?=form_close()?>
		</li>	
		<li class="pull-right">	
			<?php 	
				$hidden = array('user_id'=>element('user_id', $parameters));
				$atts = array(
						'class' => '',
						'method' => 'GET'
				);		
				?>
				<?php echo form_open( 'statistics/index/' . $category, $atts, $hidden ); ?>		
					<?php 
						$atts = 'class="form-control dropup w-auto pull-right" data-bind=" event: { change: function(d,e){ $(e.currentTarget).closest(\'form\').trigger(\'submit\')} }, BootstrapSelect:{}"';
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
				<?=form_close()?>
				
				
			
		</li>	
	</ul>
	
</div>



<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/footer_scripts'); ?>