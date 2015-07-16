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
		'id' => ''
);
/** Add meta_key for options form recognition **/
$hidden 		= array('meta_key' => $widget_key);	



	$feeds 			= $this->rules_model->get_rules(NULL, array('category'=>'report', 'active'=> true));	
	$feed_settings	= array_column($feeds, 'rule_settings');
	$feed_settings	= unserialize_array_values($feed_settings);
	$feed_ids		= array_column($feeds, 'id');	
	$feeds_select	= array_combine($feed_ids,array_column($feed_settings, 'name'));

	
?>

<?php echo form_open( 'app/widget_options', $atts, $hidden ); ?>		
		<div class="form-group">
			<label for="title" class="col-sm-3 control-label">Title</label>	
			<div class="col-sm-9 ">			
			<?php $data = array(
						  'name'        => 'title',
						  'id'          => 'title',
						  'maxlength'   => '30',
						  'class'		=> 'form-control',
						  'value'		=> element('title', $options),												  
						);
			echo form_input($data); ?>	
			</div>			
		</div>
						
						
		<div class="form-group">
			<label class="col-sm-3 control-label" for="feed">Select Feed Type</label>
			<div class="col-sm-9 ">
				<?php
					$feed = element('feed', $options)? element('feed', $options) : '';
					$atts = 'class="selectpicker" data-live-search="true" data-bind="BootstrapSelect:{}"';
					echo form_dropdown('feed', $feeds_select, $feed, $atts);
				?>
			</div>
		</div>
<?php echo form_close(); ?>