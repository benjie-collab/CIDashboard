<?php 	
/*
* Received Parameters:
* 	$widget_key
*/
	
$options 	= $this->application->get_settings($widget_key);	
$page 			= $this->session->userdata('current_page');
	
	
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
					'query[print]' => 'all',
					
				);	
$widget_options = $this->config->item('widget_options', 'template');
$action_options 	= $this->application->get_config('options', 'actions');
$template_options = array_key_exists('template', $options)? element('template', $options): array();
$data_options  = array_key_exists('data', $options)? element('data', $options): array();
 echo form_open( 'app/widget_options', $atts, $hidden ); ?>

			
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
				
				<div id="options-tab-3" class="tab-pane">
					<?php 
					$template['document_template'] = $template_options;
					$template['prefix'] = 'template';
					$this->load->view('widgets/widget-options-document-template', $template);?>	
				</div>
				<div id="options-tab-2" class="tab-pane">
				<?php 
					$av_options = $this->application->get_config('options', 'actions');
					
				?>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="data_action">Action</label>				
						<div class="col-sm-9" >										   
						   <?php 
								$actions = element('actions', $action_options);
								$atts = 'class="form-control"  data-bind="BootstrapSelect:{}" id=""';
								echo form_dropdown('data[action]', $actions, element('action', $data_options), $atts);
							?>
							<p class="help-block">Some help text</p>										
						</div>	
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="data_database">Database</label>				
						<div class="col-sm-9" >		
						   <?php 
								$databasematch		= array_get_value($data_options, 'databasematch');
								$databases	= $this->application->get_databases(array('server'=>$page->server));
								$databases	= element('database', $databases );
								$dbs = array();
								if($databases)
								foreach( $databases as $key=>$db){
									$dbs[element('name',$db)] =  element('name',$db) . ' (' . element('documents',$db) . ')';
								}													
								$dbs 	= array_merge( array(''=> 'All'), $dbs);
								$atts = 'class=" form-control" data-max-options="5" data-live-search="true" data-size="5" data-bind="BootstrapSelect:{}" multiple';
								echo form_dropdown( 'data[databasematch][]', $dbs, $databasematch, $atts);
							?>
							<p class="help-block">Some help text</p>
							
						</div>	
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="data_fieldname">Primary Key</label>				
						<div class="col-sm-9" >		
						   <?php 				
								
								$data = array(
											'name'        => 'data[fieldname]',
											'id'          => 'data_fieldname',
											'maxlength'   => '30',
											'class'		  => 'form-control',
											'value'		  => element('fieldname', $data_options) ,		
											'data-bind'   => "
												TypeAhead:{
														ajax: {
																url: '". base_url('tags/get_tag_names'). "',																	
																params: {
																	print: 'all',
																	totalresults: 'true',
																	source: 'autn:name',
																	server: '" . $page->server . "',
																	'databasematch[]': " . htmlspecialchars(json_encode($databasematch), ENT_QUOTES, 'UTF-8') . "
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
						<label class="col-sm-3 control-label" for="data_summary">Summary</label>				
						<div class="col-sm-9" >										   
						   <?php 
								$summary = element('summary', $action_options);
								$atts = 'class="form-control"  data-bind="BootstrapSelect:{}"';
								echo form_dropdown('data[summary]', $summary, element('summary', $data_options), $atts);
							?>
							<p class="help-block">Some help text</p>										
						</div>	
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label" for="data_highlight">Highlight</label>				
						<div class="col-sm-9" >								
							<input type="hidden" name="data[highlight]" value="false"/>
						   <?php
								$value = element('highlight', $data_options);
								$data = array(
								'name'        => 'data[highlight]',
								'id'          => 'data_highlight',
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
						<label class="col-sm-3 control-label" for="data_synonym">Synonym</label>				
						<div class="col-sm-9" >								
							<input type="hidden" name="data[synonym]" value="false"/>
						   <?php
								$value = element('synonym', $data_options);
								$data = array(
								'name'        => 'data[synonym]',
								'id'          => 'data_synonym',
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
						<label class="col-sm-3 control-label" for="data_sentences">Sentences</label>				
						<div class="col-sm-9" >										   
						   <div class="dark-slider m-r-10" >
								<input type="text" name="data[sentences]" class="w-100"
								data-slider-orientation="horizontal" 
								data-bind="BootstrapSlider: {
									max: 5,
									ticks_snap_bounds: 1,
									tooltip: 'always',
									value: <?=intval(element('sentences', $data_options))?>
								}"/>
							</div>
							<p class="help-block">Some help text</p>										
						</div>	
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label" for="data_minscore">Min. Score</label>				
						<div class="col-sm-9" >										   
						   <div class="dark-slider m-r-10" >
								<input type="text" name="data[minscore]" class="w-100"
								data-slider-orientation="horizontal" 
								data-bind="BootstrapSlider: {
									max: 100,
									ticks_snap_bounds: 1,
									tooltip: 'always',
									value: <?=intval(element('minscore', $data_options))?>
								}"/>
							</div>
							<p class="help-block">Some help text</p>										
						</div>	
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label" for="data_maxresults">Max Results</label>				
						<div class="col-sm-9" >										   
						   <div class="dark-slider m-r-10" >
								<input type="text" name="data[maxresults]" class="w-100"
								data-slider-orientation="horizontal" 
								data-bind="BootstrapSlider: {
									max: 20,
									ticks_snap_bounds: 1,
									tooltip: 'always',
									value: <?=intval(element('maxresults', $data_options))?>
								}"/>
							</div>
							<p class="help-block">Some help text</p>										
						</div>	
					</div>
				</div>
			</div>
		</div>
		
<?php echo form_close(); ?>





