<?php 	
/*
* Received Parameters:
* 	$widget_key
*
* Read session $current_page for page settings
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
$hidden 		= array(
					'meta_key' => $widget_key,
					'widgetize' => false,
					'issues[data][print]' => 'all',
					'solution[data][print]' => 'all',
					
				);	
$widget_options 	= $this->config->item('widget_options', 'template');
$action_options 	= $this->application->get_config('options', 'actions');


$solution_options 	= array_key_exists('solution', $options)? element('solution', $options): array();
$issues_options 	= array_key_exists('issues', $options)? element('issues', $options): array();

$solution_template_options 	= array_key_exists('template', $solution_options)? element('template', $solution_options): array();
$issues_template_options 	= array_key_exists('template', $issues_options)? element('template', $issues_options): array();

$solution_data_options 	= array_key_exists('data', $solution_options)? element('data', $solution_options): array();
$issues_data_options 	= array_key_exists('data', $issues_options)? element('data', $issues_options): array();


$current_page = $this->application->get_session_userdata('current_page');

 echo form_open( 'app/widget_options', $atts, $hidden ); ?>

			
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs pull-right">
			  <li class="active"><a data-toggle="tab" data-target="#options-tab-1" href="javascript:void(0)">Display</a></li>	
			  <li class="dropdown">
				<a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0)">
					Issues
					<span class="caret"></span>					
				</a>
				<ul role="menu" class="dropdown-menu">
						<li class=""><a data-toggle="tab" data-target="#options-tab-2" href="javascript:void(0)">Data</a></li>			  
						<li class=""><a data-toggle="tab" data-target="#options-tab-3" href="javascript:void(0)">Template</a></li>	
						<li class=""><a data-toggle="tab" data-target="#options-tab-4" href="javascript:void(0)">Outstanding</a></li>		
						<li class=""><a data-toggle="tab" data-target="#options-tab-5" href="javascript:void(0)">Closed</a></li>	
				</ul>
			  </li>
			  <li class="dropdown">
				<a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0)">
					Solutions
					<span class="caret"></span>					
				</a>
				<ul role="menu" class="dropdown-menu">
						<li class=""><a data-toggle="tab" data-target="#options-tab-6" href="javascript:void(0)">Data</a></li>			  
						<li class=""><a data-toggle="tab" data-target="#options-tab-7" href="javascript:void(0)">Template</a></li>	
						<li class=""><a data-toggle="tab" data-target="#options-tab-8" href="javascript:void(0)">Recommended</a></li>		
						<li class=""><a data-toggle="tab" data-target="#options-tab-9" href="javascript:void(0)">Other</a></li>	
				</ul>
			  </li>
			</ul>
			<div class="tab-content">
			
				<div id="options-tab-1" class="tab-pane active">				
					<?php $this->load->view('widgets/widget-options-basic', $options);?>
				</div>
				<div id="options-tab-3" class="tab-pane">
					<?php 
					$template['document_template'] = $issues_template_options;
					$template['prefix'] = 'issues[template]';
					$this->load->view('widgets/widget-options-document-template', $template);?>
				</div>
				<div id="options-tab-4" class="tab-pane">
					<?php 
						$open = array_key_exists('open', $issues_options)? element('open', $issues_options): array();
					?>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="open_name">Tab Name</label>				
						<div class="col-sm-9" >		
						   <?php $data = array(
								'name'        => 'issues[open][name]',
								'id'          => 'open_name',
								'value'       => element('name', $open),
								'class'		  => 'form-control'
								);
							echo form_input($data); ?>
							<p class="help-block">Some help text</p>
							
						</div>	
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="open_icon">Icon</label>				
						<div class="col-sm-9" >	
							<div class="input-group">
								<?php $data = array(
									'name'        => 'issues[open][icon]',
									'id'          => 'open_icon',
									'value'       => array_key_exists('icon', $open)? element('icon', $open): 'fa-android', 
									'class'		  => 'form-control',
									'data-bind'	  => 'BootstrapIconPicker:{}'
									);
								echo form_input($data); ?>
								<span class="input-group-addon"></span>
							</div>
						   
							<p class="help-block">Some help text</p>
							
						</div>	
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="title">Color</label>
						<div class="col-sm-9">	
							<?php $bg = element('bgcolor', $open); ?>
							<select class="selectpicker" data-bind="BootstrapSelect:{}" name="issues[open][bgcolor]">		
								<option value=''>None</option>
								<?php foreach( $widget_options['bg'] as $key=>$nm) :?>
									<option value="<?=$key?>" <?=strcasecmp($key, $bg)==0?'selected':''?> data-content="<span class='p-l-5 p-r-5 label bg-<?=$key?>-gradient'><?=$key?></span>"><?=$nm?></option>	
								<?php endforeach;?>
							</select>					
							<p class="help-block">Some help text</p>
						</div>
					</div>					
				</div>
				<div id="options-tab-5" class="tab-pane">	
					<?php 
						$closed = array_key_exists('closed', $issues_options)? element('closed', $issues_options): array();
					?>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="closed_name">Tab Name</label>				
						<div class="col-sm-9" >		
						   <?php $data = array(
								'name'        => 'issues[closed][name]',
								'id'          => 'closed_name',
								'value'       => element('name', $closed),
								'class'		  => 'form-control'
								);
							echo form_input($data); ?>
							<p class="help-block">Some help text</p>
							
						</div>	
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="closed_icon">Icon</label>				
						<div class="col-sm-9" >	
							<div class="input-group">
								<?php $data = array(
									'name'        => 'issues[closed][icon]',
									'id'          => 'closed_icon',
									'value'       => array_key_exists('icon', $closed)? element('icon', $closed): 'fa-android', 
									'class'		  => 'form-control',
									'data-bind'	  => 'BootstrapIconPicker:{}'
									);
								echo form_input($data); ?>
								<span class="input-group-addon"></span>
							</div>
						   
							<p class="help-block">Some help text</p>
							
						</div>	
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="title">Color</label>
						<div class="col-sm-9">	
							<?php $bg = element('bgcolor', $closed); ?>
							<select class="selectpicker" data-bind="BootstrapSelect:{}" name="issues[closed][bgcolor]">		
								<option value=''>None</option>
								<?php foreach( $widget_options['bg'] as $key=>$nm) :?>
									<option value="<?=$key?>" <?=strcasecmp($key, $bg)==0?'selected':''?> data-content="<span class='p-l-5 p-r-5 label bg-<?=$key?>-gradient'><?=$key?></span>"><?=$nm?></option>	
								<?php endforeach;?>
							</select>					
							<p class="help-block">Some help text</p>
						</div>
					</div>	
				</div>
				<div id="options-tab-2" class="tab-pane">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="issues_action">Action</label>				
						<div class="col-sm-9" >										   
						   <?php 
								$actions = element('actions', $action_options);
								$atts = 'class="form-control"  data-bind="BootstrapSelect:{}" id="issues_action"';
								echo form_dropdown('issues[data][action]', $actions, element('action', $issues_data_options), $atts);
							?>
							<p class="help-block">Some help text</p>										
						</div>	
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="issues_print">Print</label>				
						<div class="col-sm-9" >										   
						   <?php 
								$print = element('print', $action_options);
								$atts = 'class="form-control"  data-bind="BootstrapSelect:{}" data-live-search="true" data-size="5" id="issues_print"';
								echo form_dropdown('issues[data][print]', $print, element('print', $issues_data_options), $atts);
							?>
							<p class="help-block">Some help text</p>										
						</div>	
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="issues_summary">Summary</label>				
						<div class="col-sm-9" >										   
						   <?php 
								$summary = element('summary', $action_options);
								$atts = 'class="form-control"  data-bind="BootstrapSelect:{}" data-live-search="true" data-size="5" id="issues_summary"';
								echo form_dropdown('issues[data][summary]', $summary, element('summary', $issues_data_options), $atts);
							?>
							<p class="help-block">Some help text</p>										
						</div>	
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="issues_highlight">Highlight</label>				
						<div class="col-sm-9" >								
							<input type="hidden" name="issues[data][highlight]" value="false"/>
						   <?php
								$value = element('highlight', $issues_data_options);
								$data = array(
								'name'        => 'issues[data][highlight]',
								'id'          => 'issues_highlight',
								'value'       => 'true',
								'checked'     => strcasecmp('true', $value) == 0,
								'style'       => 'margin:10px',
								'class'		  => 'm-0 p-absolute',
								'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
								);

							echo form_checkbox($data); ?>
							<p class="help-block">Some help text</p>										
						</div>	
					</div>
					
					
					<div class="form-group">
						<label class="col-sm-3 control-label" for="database">Database</label>				
						<div class="col-sm-9" >		
						   <?php 
								$databasematch = array_get_value($issues_data_options, 'databasematch');
								$databases	= $this->application->get_databases((array)$current_page);
								$databases	= element('database', $databases );
								$dbs = array();
								if($databases)
								foreach( $databases as $key=>$db){
									$dbs[element('name',$db)] =  element('name',$db) . ' (' . element('documents',$db) . ')';
								}													
								$dbs 	= array_merge( array(''=> 'All'), $dbs);
								$atts = 'class=" form-control" data-max-options="5" data-live-search="true" data-size="5" data-bind="BootstrapSelect:{}" multiple';
								echo form_dropdown( 'issues[data][databasematch][]', $dbs, $databasematch, $atts);
							?>
							<p class="help-block">Some help text</p>
							
						</div>	
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="issues_fieldname">Primary Key</label>				
						<div class="col-sm-9" >		
						   <?php 				
								
								$data = array(
											'name'        => 'issues[data][fieldname]',
											'id'          => 'issues_fieldname',
											'maxlength'   => '30',
											'class'		  => 'form-control',
											'value'		  => element('fieldname', $issues_data_options) ,		
											'data-bind'   => "
												TypeAhead:{
														ajax: {
																url: '". base_url('tags/get_tag_names'). "',																	
																params: {
																	totalresults: 'true',
																	source: 'autn:name',
																	server: '". $current_page->server. "',
																}								
															}
													}"
										);
								echo form_input($data); 
							?>	
							<p class="help-block">Some help text</p>
							
						</div>	
					</div>				
				</div>
				
							
				<div class="tab-pane" id="options-tab-6">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="solution_action">Action</label>				
							<div class="col-sm-9" >										   
							   <?php 
									$actions = element('actions', $action_options);
									$atts = 'class="form-control"  data-bind="BootstrapSelect:{}" id="solution_action"';
									echo form_dropdown('solution[data][action]', $actions, element('action', $solution_data_options), $atts);
								?>
								<p class="help-block">Some help text</p>										
							</div>	
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="issues_print">Print</label>				
							<div class="col-sm-9" >										   
							   <?php 
									$print = element('print', $action_options);
									$atts = 'class="form-control"  data-bind="BootstrapSelect:{}" data-live-search="true" data-size="5" id="issues_print"';
									echo form_dropdown('solution[data][print]', $print, element('print', $solution_data_options), $atts);
								?>
								<p class="help-block">Some help text</p>										
							</div>	
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label" for="database">Database</label>				
							<div class="col-sm-9" >		
							   <?php 
									$databasematch		= array_get_value($solution_data_options, 'databasematch');
									$databases			= $this->application->get_databases(array('server'=>$current_page->server));
									$databases			= element('database', $databases );
									$dbs = array();
									if($databases)
									foreach( $databases as $key=>$db){
										$dbs[element('name',$db)] =  element('name',$db) . ' (' . element('documents',$db) . ')';
									}													
									$dbs 	= array_merge( array(''=> 'All'), $dbs);
									$atts = 'class=" form-control" data-max-options="5" data-live-search="true" data-size="5" data-bind="BootstrapSelect:{}" multiple';
									echo form_dropdown( 'solution[data][databasematch][]', $dbs, $databasematch, $atts);
								?>
								<p class="help-block">Some help text</p>
								
							</div>	
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="solution_fieldname">Primary Key</label>				
							<div class="col-sm-9" >		
							   <?php 			
									
									$data = array(
												'name'        => 'solution[data][fieldname]',
												'id'          => 'solution_fieldname',
												'maxlength'   => '30',
												'class'		  => 'form-control',
												'value'		  => element('fieldname', $solution_data_options) ,		
												'data-bind'   => "
													TypeAhead:{
															ajax: {
																	url: '". base_url('tags/get_tag_names'). "',																	
																	params: {
																		totalresults: 'true',
																		source: 'autn:name',
																		server: '". $current_page->server. "',
																	}								
																}
														}"
											);
									echo form_input($data); 
								?>	
								<p class="help-block">Some help text</p>
								
							</div>	
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="solution_summary">Summary</label>				
							<div class="col-sm-9" >										   
							   <?php 
									$summary = element('summary', $action_options);
									$atts = 'class="form-control"  data-bind="BootstrapSelect:{}"';
									echo form_dropdown('solution[data][summary]', $summary, element('summary', $solution_data_options), $atts);
								?>
								<p class="help-block">Some help text</p>										
							</div>	
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="solution_highlight">Highlight</label>				
							<div class="col-sm-9" >								
								<input type="hidden" name="solution[data][highlight]" value="false"/>
							   <?php
									$value = element('highlight', $solution_data_options);
									$data = array(
									'name'        => 'solution[data][highlight]',
									'id'          => 'solution_highlight',
									'value'       => 'true',
									'checked'     => strcasecmp('true', $value) == 0,
									'style'       => 'margin:10px',
									'class'		  => 'm-0 p-absolute',
									'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
									);

								echo form_checkbox($data); ?>
								<p class="help-block">Some help text</p>										
							</div>	
						</div>
					
						<div class="form-group">
							<label class="col-sm-3 control-label" for="solution_synonym">Synonym</label>				
							<div class="col-sm-9" >								
								<input type="hidden" name="solution[data][synonym]" value="false"/>
							   <?php
									$value = element('synonym', $solution_data_options);
									$data = array(
									'name'        => 'solution[data][synonym]',
									'id'          => 'solution_synonym',
									'value'       => 'true',
									'checked'     => strcasecmp('true', $value) == 0,
									'style'       => 'margin:10px',
									'class'		  => 'm-0 p-absolute',
									'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
									);

								echo form_checkbox($data); ?>
								<p class="help-block">Some help text</p>										
							</div>	
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label" for="solution_sentences">Sentences</label>				
							<div class="col-sm-9" >										   
							   <div class="dark-slider m-r-10" >
									<input type="text" name="solution[data][sentences]" class="w-100"
									data-slider-orientation="horizontal" 
									data-bind="BootstrapSlider: {
										max: 5,
										ticks_snap_bounds: 1,
										tooltip: 'always',
										value: <?=intval(element('sentences', $solution_data_options))?>
									}"/>
								</div>
								<p class="help-block">Some help text</p>										
							</div>	
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label" for="solution_minscore">Min. Score</label>				
							<div class="col-sm-9" >										   
							   <div class="dark-slider m-r-10" >
									<input type="text" name="solution[data][minscore]" class="w-100"
									data-slider-orientation="horizontal" 
									data-bind="BootstrapSlider: {
										max: 100,
										ticks_snap_bounds: 1,
										tooltip: 'always',
										value: <?=intval(element('minscore', $solution_data_options))?>
									}"/>
								</div>
								<p class="help-block">Some help text</p>										
							</div>	
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label" for="solution_maxresults">Max Results</label>				
							<div class="col-sm-9" >										   
							   <div class="dark-slider m-r-10" >
									<input type="text" name="solution[data][maxresults]" class="w-100"
									data-slider-orientation="horizontal" 
									data-bind="BootstrapSlider: {
										max: 20,
										ticks_snap_bounds: 1,
										tooltip: 'always',
										value: <?=intval(element('maxresults', $solution_data_options))?>
									}"/>
								</div>
								<p class="help-block">Some help text</p>										
							</div>	
						</div>
				</div>
				
				<div class="tab-pane" id="options-tab-7">				
					<?php 
					$solution['document_template'] = $solution_template_options;
					$solution['prefix'] = 'solution[template]';
					$this->load->view('widgets/widget-options-document-template', $solution);?>
				</div>				
				
				<?php 
					$recommended = array_key_exists('recommended', $solution_options)? element('recommended', $solution_options): array();
					$other 		 = array_key_exists('other', $solution_options)? element('other', $solution_options): array();
				?>
				<div class="tab-pane" id="options-tab-8">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="recommended_name">Tab Name</label>				
						<div class="col-sm-9" >		
						   <?php $data = array(
								'name'        => 'solution[recommended][name]',
								'id'          => 'recommended_name',
								'value'       => element('name', $recommended),
								'class'		  => 'form-control'
								);
							echo form_input($data); ?>
							<p class="help-block">Some help text</p>
							
						</div>	
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="recommended_icon">Icon</label>				
						<div class="col-sm-9" >	
							<div class="input-group">
								<?php $data = array(
									'name'        => 'solution[recommended][icon]',
									'id'          => 'recommended_icon',
									'value'       => array_key_exists('icon', $recommended)? element('icon', $recommended): 'fa-android', 
									'class'		  => 'form-control',
									'data-bind'	  => 'BootstrapIconPicker:{}'
									);
								echo form_input($data); ?>
								<span class="input-group-addon"></span>
							</div>
						   
							<p class="help-block">Some help text</p>
							
						</div>	
					</div>
				</div>
				<div class="tab-pane " id="options-tab-9">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="other_name">Tab Name</label>				
						<div class="col-sm-9" >		
						   <?php $data = array(
								'name'        => 'solution[other][name]',
								'id'          => 'other_name',
								'value'       => element('name', $other),
								'class'		  => 'form-control'
								);
							echo form_input($data); ?>
							<p class="help-block">Some help text</p>
							
						</div>	
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="other_icon">Icon</label>				
						<div class="col-sm-9" >	
							<div class="input-group">
								<?php $data = array(
									'name'        => 'solution[other][icon]',
									'id'          => 'other_icon',
									'value'       => array_key_exists('icon', $other)? element('icon', $other): 'fa-android', 
									'class'		  => 'form-control',
									'data-bind'	  => 'BootstrapIconPicker:{}'
									);
								echo form_input($data); ?>
								<span class="input-group-addon"></span>
							</div>
						   
							<p class="help-block">Some help text</p>
							
						</div>	
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="other_enable">Enable/Disable</label>	
						<div class="col-sm-9 checkbox" >				
							<input type="hidden" name="solution[other][enable]" value="0"/>
						   <?php $data = array(
								'name'        => 'solution[other][enable]',
								'id'          => 'other_enable',
								'value'       => 1,
								'checked'     => intval(element('enable', $other))==1,
								'style'       => 'margin:10px',
								'class'		  => 'm-0 p-absolute',
								'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
								);
							echo form_checkbox($data); ?>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		
<?php echo form_close(); ?>





