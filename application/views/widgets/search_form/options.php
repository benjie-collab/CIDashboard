<?php 	
/*
* Received Parameters:
* 	$widget_key
*/
	
$options 	= $this->application->get_settings($widget_key);	
	
$current_search = $this->application->get_session_userdata('current_search');	
$search_settings =$this->application->get_session_userdata('search_settings');
	
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
	
	
echo form_open( 'app/widget_options', $atts, $hidden ); ?>
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs pull-right">
		  <li class="active"><a data-toggle="tab" data-target="#options-tab-1" href="javascript:void(0)">Display</a></li>			  
		  <li class=""><a data-toggle="tab" data-target="#options-tab-2" href="javascript:void(0)">Search Box</a></li>
		  <li class=""><a data-toggle="tab" data-target="#options-tab-3" href="javascript:void(0)">Suggest Box</a></li>
		</ul>
		<div class="tab-content">
			<div id="options-tab-1" class="tab-pane active">
				<?php $this->load->view('widgets/widget-options-basic', $options);?>
			</div>
			<div id="options-tab-2" class="tab-pane ">
				<div class="form-group">
					<label class="col-sm-3 control-label" for="url">Url</label>
					<div class="col-sm-9">
					   <?php $data = array(
									  'name'        => 'url',
									  'id'          => 'url',
									  'class'		=> 'form-control',
									  'value'		=> element('url', $options),
									  
									);

						echo form_input($data); ?>
						<p class="help-block">Some help text</p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="placeholder">Placeholder</label>
					<div class="col-sm-9">
					   <?php $data = array(
									  'name'        => 'placeholder',
									  'id'          => 'placeholder',
									   'maxlength'   => '30',
									  'class'		=> 'form-control',
									  'value'		=> element('placeholder', $options),
									  
									);

						echo form_input($data); ?>
						<p class="help-block">Some help text</p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="button_label">Button Label</label>
					<div class="col-sm-9">
					   <?php $data = array(
									  'name'        => 'button_label',
									  'id'          => 'button_label',
									  'maxlength'   => '30',
									  'class'		=> 'form-control',
									  'value'		=> element('button-label', $options),
									  
									);

						echo form_input($data); ?>
						<p class="help-block">Some help text</p>
					</div>
				</div>
			</div>
			<div id="options-tab-3" class="tab-pane ">
				<div class="form-group">
					<label class="col-sm-3 control-label" for="suggestbox">Suggest Box</label>				
					<div class="col-sm-9" >		
						<input type="hidden" name="suggestbox" value="0"/>
					   <?php $data = array(
							'name'        => 'suggestbox',
							'id'          => 'suggestbox',
							'value'       => 1,
							'checked'     => intval(element('suggestbox', $options))==1,
							'style'       => 'margin:10px',
							'class'		  => 'm-0 p-absolute',
							'data-bind'		=> 'BootstrapSwitch:{ size: \'mini\' }'
							);

						echo form_checkbox($data); ?>
						<p class="help-block">Some help text</p>			
					</div>	
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="database">Database to Suggest</label>				
					<div class="col-sm-9" >		
					   <?php 
							$suggest = element('suggest', $options) ;
							$value		= element('databasematch', $suggest) ;
							$databases	= $this->application->get_databases(elements(array('server'),$search_settings));
							
							
							$databases	= element('database', $databases );
							$dbs = array();
							if($databases)
							foreach( $databases as $key=>$db){
								$dbs[element('name',$db)] =  element('name',$db) . ' (' . element('documents',$db) . ')';
							}													
							$dbs 	= array_merge( array(''=> 'All'), $dbs);
							$atts = 'class=" form-control" data-max-options="5" data-live-search="true" data-size="5" data-bind="BootstrapSelect:{}" multiple';
							echo form_dropdown( 'suggest[databasematch][]', $dbs, $value, $atts);
						?>
						<p class="help-block">Some help text</p>
						
					</div>	
				</div>
		</div>
	</div>
	
<?php echo form_close(); ?>






