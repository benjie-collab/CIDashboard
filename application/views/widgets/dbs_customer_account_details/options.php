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
$hidden 		= array(
					'meta_key' => $widget_key,
					'widgetize' => false,
					'query[print]' => 'all',
					
				);	
//$widget_options = $this->config->item('widget_options', 'template');

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
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">	
								<label class="control-label" for="template">Template</label>
								<div class="">
							   <?php 
									$templates = $this->application->get_templates('application/views/template/', 'DocumentTemplate');
									$atts = 'class="form-control"  data-bind="BootstrapSelect:{}"';
									echo form_dropdown('template', $templates, element('template', $options), $atts);
								?>
									<p class="help-block">Some help text</p>
								</div>
								
							</div>						
						</div>
						<div class="col-md-7">
							<?php
							$document_options = $this->application->get_config('document_options', 'template');
							
							foreach(element('elements', $document_options ) as $name=>$element):
							
							if(is_str_contain($name, '[]')){ //its array					
							$name_ = str_replace("[]", "", $name);
							$selected = array_key_exists($name_, $options)? element($name_, $options): array();
							$elements = array_combine($selected,$selected);
						?>
							<div class="form-group has-feedback">	
								<label class="control-label col-sm-3" for="<?=$name?>"><?=$element?></label>
								<div class="col-sm-9">
								
								
								<?php 
									$atts = 'class="form-control selectpicker" data-live-search="true" data-max-options="10" multiple data-size="5" 
									data-bind="BootstrapSelectAjax: {											
											ajax: {
												url: \'' . base_url('tags/get_tag_names') . '\',
												data: function () {
													var params = {
														text: \'{{{q}}}\',
														source: \'autn:name\',
													};
													return params;
												}
											},
											locale: {
												emptyTitle: \'Search for fields...\'
											},
											preprocessData: function(data){
												var fields = [];
												var len = data.length;
												for(var i = 0; i < len; i++){
													var curr = data[i];
													fields.push(
														{
															value: curr,
															text: curr,
															disable: false
														}
													);
												}
												return fields;
											},
											preserveSelectedPosition: \'before\',
											restoreOnError: true,
											preserveSelected: true
										}"';
									echo form_dropdown($name, $elements, $selected, $atts);
								?>
								
								<span class="form-control-feedback typeahead-spinner"><i class="fa fa fa-spinner fa fa-spin text-muted"></i></span>
								<p class="help-block">Some help text</p>
								</div>
							</div>				
						<?php
							}else{
						?>
							<div class="form-group has-feedback">	
								<label class="control-label col-sm-3" for="<?=$name?>"><?=$element?></label>
								<div class="col-sm-9">
								<?php 								
									$data = array(
												'name'        => $name,
												'id'          => $name,
												'maxlength'   => '30',
												'class'		  => 'form-control',
												'value'		  => element($name, $options),		
												'data-bind'   => "
													TypeAhead:{
															ajax: {
																	url: '". base_url('tags/get_tag_names'). "',																	
																	params: {
																		print: 'all',
																		totalresults: 'true',
																		source: 'autn:name'
																	}								
																}
														}"
											);
									echo form_input($data); 
								?>						
								<span class="form-control-feedback typeahead-spinner"><i class="fa fa fa-spinner fa fa-spin text-muted"></i></span>
								<p class="help-block">Some help text</p>
								</div>
							</div>	
						
						<?php }	
							endforeach;					
						?>						
						</div>
					</div>			
				</div>
				<div id="options-tab-2" class="tab-pane">
				<?php 
					$av_options = $this->application->get_config('options', 'actions');
					
				?>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="database">Database</label>				
						<div class="col-sm-9" >		
						   <?php 
								$value		= array_get_value($options, 'databasematch');
								$databases	= $this->application->get_databases();
								$databases	= element('database', $databases );
								$dbs = array();
								if($databases)
								foreach( $databases as $key=>$db){
									$dbs[element('name',$db)] =  element('name',$db) . ' (' . element('documents',$db) . ')';
								}													
								$dbs 	= array_merge( array(''=> 'All'), $dbs);
								$atts = 'class=" form-control" data-max-options="5" data-live-search="true" data-size="5" data-bind="BootstrapSelect:{}" multiple';
								echo form_dropdown( 'query[databasematch][]', $dbs, $value, $atts);
							?>
							<p class="help-block">Some help text</p>
							
						</div>	
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="fieldname">Primary Key</label>				
						<div class="col-sm-9" >		
						   <?php 				
								
								$data = array(
											'name'        => 'fieldname',
											'id'          => 'fieldname',
											'maxlength'   => '30',
											'class'		  => 'form-control',
											'value'		  => element('fieldname', $options) ,		
											'data-bind'   => "
												TypeAhead:{
														ajax: {
																url: '". base_url('tags/get_tag_names'). "',																	
																params: {
																	print: 'all',
																	totalresults: 'true',
																	source: 'autn:name'
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
			</div>
		</div>
		
<?php echo form_close(); ?>





