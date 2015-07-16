<?php 	
/*
* Received Parameters:
* 	$meta_key
*/
	
$options 	= $this->application->get_settings($meta_key);	
	
	
	
/** Form attributes with some Knockoutjs bindings for submission. **/
$atts = array(
		'class' => 'form-horizontal',
		'data-bind' => 'submit: $root.formSubmit', 
		'method' => 'POST',
		'onSubmit' => 'return false;',
		'id' => 'widget_options_form'
);
/** Add meta_key for options form recognition **/
$hidden 		= array('meta_key' => $meta_key);

$widget_options = $this->config->item('widget_options', 'template');
?>
<?php echo form_open( 'app/widget_options', $atts, $hidden ); ?>
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs pull-right">
			  <li class="active"><a data-toggle="tab" data-target="#options-tab-1" href="javascript:void(0)">Display</a></li>			  
			  <li class=""><a data-toggle="tab" data-target="#options-tab-2" href="javascript:void(0)">Data</a></li>
			  <li class=""><a data-toggle="tab" data-target="#options-tab-3" href="javascript:void(0)">Template</a></li>
			</ul>
			<div class="tab-content">
				<div id="options-tab-1" class="tab-pane active">
					<?php $this->load->view('widgets/widget-options-basic', $options);?>					
				</div>
				<div id="options-tab-2" class="tab-pane"></div>
				<div id="options-tab-3" class="tab-pane"></div>
			</div>
		</div>
<?php echo form_close(); ?>





