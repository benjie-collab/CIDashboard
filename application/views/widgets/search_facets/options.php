<?php 	
/*
* Received Parameters:
* 	$widget_key
*/
	
$options 	= $this->application->get_settings($widget_key);	
	
	
	
/** Form attributes with some Knockoutjs bindings for submission. **/
$atts = array(
		'class' => 'form-horizontal',
		'data-bind' => 'submit: $root.formSubmit', 
		'method' => 'POST',
		'onSubmit' => 'return false;',
		'id' => 'widget_options_form'
);
/** Add meta_key for options form recognition **/
$hidden 		= array('meta_key' => $widget_key);	


echo form_open( 'app/widget_options' ); ?>

	<div class="form-group">
        <label for="exampleInputEmail1" class="m-0">Title</label>
		  <?php $data = array(
							  'name'        => 'title',
							  'id'          => 'title',
							  'maxlength'   => '100',
							  'class'		=> 'form-control'
							);

				echo form_input($data); ?>
	</div>
	<div class="checkbox checkbox-primary m-l-10">
		
		  <?php $data = array(
					'name'        => 'suggest',
					'id'          => 'suggest_box',
					'value'       => 'accept',
					'checked'     => TRUE,
					'style'       => 'margin:10px',
					'class'		  => 'm-0 p-absolute'
					);

				echo form_checkbox($data); ?>
		<label class="text-capitalize" for="suggest_box">Suggest Box</label>	
	</div>	
<?php echo form_close(); ?>