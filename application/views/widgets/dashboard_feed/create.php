<?php 
		
	$av_options = $this->application->get_config('options', 'actions');
	$config		= $this->application->get_config('query', 'actions');
	$options	= array_merge($config, array());	
	
	
	$atts = array(
			'class' => 'form-horizontal',
			'data-bind' => 'submit: $root.formSubmit', 
			'method' => 'POST',
			'onSubmit' => 'return false;',
			'id' => 'query_settings_form'
	);	
	$hidden 		= array('category' => 'feed', 'active' => false);
	
?>

<?php echo form_open( '/profile/create_rule', $atts, $hidden ); ?>
		
			<p class="lead"><?=lang('query_description') ?></p>		

			<div class="form-group">
				<label class="col-sm-3 control-label" for="name">Name</label>
				<div class="col-sm-9">
					<?php
						$data = array(
								  'name'        => 'name',
								  'id'          => 'name',							  
								  'class'		=> 'form-control',
								  'value'		=>  ''
								);
						echo form_input($data);
					?>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label" for="active">Activate</label>
				<div class="col-sm-9 checkbox">
					<?php $data = array(
						'name'        => 'active',
						'id'          => 'active',
						'value'       => true,
						'checked'     => false,
						'style'       => 'margin:10px',
						'class'		  => 'm-0 p-absolute',
						'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
						);
					echo form_checkbox($data); 
					?>
				</div>
			</div>	
			
			<div class="form-group">
				<label class="col-sm-3 control-label" for="keywords">Keywords</label>
				<div class="col-sm-9">
					<?php
						$data = array(
								  'name'        => 'keywords',
								  'id'          => 'keywords',							  
								  'class'		=> 'form-control',
								  'data-bind'	=> 'BootstrapTokenField: {}',
								  'data-tokens'	=> '',
								  'placeholder'	=> 'Enter new term'
								);
						echo form_input($data);
					?>
				</div>
			</div>	
			 
	
	
<?php echo form_close(); ?>