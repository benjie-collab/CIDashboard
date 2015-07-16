<?php 
	$atts = array(
			'class' => '',
			'data-bind' => 'submit: $root.formSubmit', 
			'method' => 'POST',
			'onSubmit' => 'return false;',
			'id' => 'widget_options_form'
	);
	
	
 echo form_open( '/pages/save_widget_options/', $atts ); 
		
?>
		<div class="bg-gray" style="height: 116px; overflow-y: auto;">
			<?php print_r($parameters);?>
		</div>
		<div class="form-group has-feedback">							
			<?php $data = array(
						  'name'        => 'title',
						  'id'          => 'title',
						  'maxlength'   => '30',
						  'class'		=> 'form-control',
						  'value'		=> '',												  
						  'placeholder' => 'Enter new synonym'
						);
			echo form_input($data); ?>
			<span class="form-control-feedback"><i class="fa fa-sign-in text-muted"></i></span>			
		</div>
<?php echo form_close(); ?>