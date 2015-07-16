<?php 
	$statistics = $this->statistics_model->get_statistic($widget_key);
	$config		= unserialize(element('widget_settings',$statistics));
	$av_options = $this->application->get_config('options', 'statistics');
	$av_types 	= element('types', $av_options);	
	$post_data 	= array_filter($config, 'is_scalar');
	$source 	= $this->statistics_model->get_source($post_data);	

	$hidden = array(
				'data[text]' => '*',
				'data[valuedetails]' => 'true',
				'data[documentcount]' => 'true',
				'data[source]' => 'autn:value',
				'active' => false,
				'widget_key' => $widget_key,				
				'visual[tooltip][enabled]' => false,
				'visual[legend][visible]' => false,
				'visual[rotated]' => false,
				'visual[argumentAxis][inverted]' => false,
				'visual[valueAxis][inverted]' => false,
				'visual[argumentAxis][valueMarginsEnabled]' => false,
				'visual[commonSeriesSettings][label][visible]' => false,	
				'visual[series][label][connector][visible]' => false				
				
			);
	$atts = array(
			'class' => 'form',
			'data-bind' => 'submit: $root.formSubmit', 
			'method' => 'POST',
			'onSubmit' => 'return false;',
			'id' => 'widget_options_form'
	);	
	
	$actions_options 	= $this->application->get_config('options', 'actions');
	$config_data= array_key_exists('data',$config)? element('data',$config) : array();
	$config_visual= array_key_exists('visual',$config)? element('visual',$config) : array();
	
	
	$post_data  = array_filter($config_data, 'is_scalar');
	$source = $this->statistics_model->get_source($post_data);
	
	echo form_open('/statistics/configure', $atts, $hidden);	
	?>	
	<div class="nav-tabs-custom text-black m-0">
	
		<ul class="nav nav-tabs pull-right ">
			<li class="pull-left header">
				<i class="fa fa-laptop"></i> 
				Preview
			</li>			
			<li class="active"><a data-toggle="tab" href="#config_tab_2">Data</a></li>
			<li><a data-toggle="tab" href="#config_tab_3">Display</a></li>
			<li><a data-toggle="tab" href="#config_tab_1">Info</a></li>
			<li class="header" data-toggle="popover" data-placement="bottom" title="Activate/Deactivate Statistics" data-content="Activate this statistics to be able to add this to you pages.">	
				<?php	
				$data = array(
				'name'        => 'active',
				'id'          => 'active',
				'value'       => true,
				'checked'     => (bool) element('active',$statistics) == 1,
				'style'       => 'margin:10px',
				'class'		  => 'm-0 p-absolute',
				'data-bind'	  => 'BootstrapSwitch:{ size: \'small\', onColor: \'primary\', offColor: \'warning\', onText: \'Activated\', offText: \'Deactivated\', labelText: \'Status\' }'
				);
				echo form_checkbox($data);
				?>
			</li>		
		</ul>
		
		
		<div class="row">		
			<div class="col-md-8 col-sm-7">	
				<div id="statistics-preview-container" class="form-inline">
					<?php $this->load->view('/widgets/DXPie/view', array(
						'widget_key' => $widget_key, 
						'widgetize' => false,
						'source' =>$source,
						'event' => 'modal')
						) ;?>
					<?php 
					$sample = array_multi($source)? array_shift($source) : $source;
					$source_keys = ($source)? array_combine(array_keys($sample), array_keys($sample)) : array();
					$series = array_key_exists('series', $config_visual)? element('series', $config_visual) : array();
					?>		
					<div class="p-10 m-t-20 text-center box-footer">
						<div class="input-group m-r-20">
							<label for="argumentField" class="input-group-addon">
								<i class="fa fa-long-arrow-right"></i> Argument Field
							</label>						
							<?php 
								$atts = 'class="form-control argumentfield-select" data-size="8" data-bind="BootstrapSelect:{}"';
								$value = element('argumentField', $series);
								echo form_dropdown('visual[series][argumentField]', $source_keys , $value , $atts);							
							?>	
						</div>
						<div class="input-group m-r-20">
							<label for="valueField" class="input-group-addon">
								<i class="fa fa-long-arrow-up"></i> Value Field
							</label>						
							<?php 
								$atts = 'class="form-control w-auto valuefield-select" data-size="8" data-bind="BootstrapSelect:{}"';
								$value = element('valueField', $series);
								echo form_dropdown('visual[series][valueField]', $source_keys , $value , $atts);							
							?>		
						</div>						
					</div>
				</div>			
			</div>	
			
			
			<div class="col-md-4 col-sm-5">
				<div class="tab-content p-10">
				
					<div class="tab-pane " id="config_tab_1">
						<div class="form-group">
							<label for="title">Title</label>							
							<?php $data = array(
										  'name'        => 'visual[title][text]',
										  'id'          => 'title',
										  'maxlength'   => '30',
										  'class'		=> 'form-control',
										  'value'		=> element('text', element('title', $config_visual)),												  
										);
							echo form_input($data); ?>														   
						</div>
						<div class="form-group">
							<label for="description">Description</label>
							<?php $data = array(
									 'name'        => 'description',
									  'id'          => 'description',
									  'size'  		=> '30',
									  'rows'		=> '5',
									  'cols'		=> '12',
									  'class'		=> 'form-control',
									  'value'		=> element('description', $config),	
									  'data-bind'	=> 'BootstrapWYSIhtml5:{ html: true, image: false, \'font-styles\': false, link: false }'
									);
							echo form_textarea($data); ?>													   
						</div>
						<div class="form-group">
							<label for="icon">Icon</label>							
							<div class="input-group">
								<?php $data = array(
									'name'        => 'icon',
									'id'          => 'icon',
									'value'       => array_key_exists('icon', $config)? element('icon', $config): 'fa-map-marker', 
									'class'		  => 'form-control',
									'data-bind'	  => 'BootstrapIconPicker:{}'
									);
								echo form_input($data); ?>
								<span class="input-group-addon"></span>
							</div>
						   
							<p class="help-block">Some help text</p>
						</div>
					</div>
					
					
					<div class="tab-pane active" id="config_tab_2">		
						<div class="form-group">		
							<label class="control-label" for="data_server">Server</label>
						   <?php 
								$value = element('server',$config_data);
								$servers = $this->servers_model->get_servers();			
							?>
							<select name="data[server]" id="data_server"
								class="form-control" data-bind="BootstrapSelect:{}">
								<option data-hidden="true" value="">-- Select one --</option>
								<?php 
									foreach($servers as $k=>$server):
									$selected = strcasecmp($value, element('server', $server))==0 ? 'selected' : '';
									echo '<option value="' . element('server', $server)  . '" ' . $selected . '>' . element('server', $server) . '</option>';
									endforeach;				
								?>	
							</select>
							<p class="help-block">Some help text</p>
						</div>			
						
						<div class="form-group has-feedback">	
							<label for="fieldname">Field Name</label>
							<?php 				
								
								$data = array(
											'name'        => 'data[fieldname]',
											'id'          => 'data_fieldname',
											'maxlength'   => '30',
											'class'		  => 'form-control',
											'value'		  => element('fieldname', $config_data) ,		
											'data-bind'   => "
												TypeAhead:{
														ajax: {
																url: '". base_url('tags/get_tag_names'). "',																	
																params: {
																	print: 'all',
																	totalresults: 'true',
																	source: 'autn:name',
																	server: '" . element('server',$config_data) . "'
																}								
															}
													}"
										);
								echo form_input($data); 
							?>	
						</div>
						
						<div class="form-group ">
							<label for="data_maxresults">Max Results</label>							
							<?php 
								$maxresults = element('maxresults', $config_data)? element('maxresults', $config_data) : 100000;	
							
								  $data = array(
								  'name'        => 'data[maxresults]',
								  'id'          => 'data_maxresults',							  
								  'class'		=> 'form-control',
								  'value'		=> $maxresults,
								  'type'		=> 'number'
								);
							echo form_input($data); ?>
						</div>			
						
						
						<div class="form-group">
							<label for="dateperiod">Date Period</label>						
							<?php 
								$atts 		= 'class="form-control col-md-8" data-size="5" data-bind="BootstrapSelect:{}"';
								
								$elements	= element('dateperiod', $actions_options);
								$value 		= element('dateperiod', $config_data);	
								echo form_dropdown('data[dateperiod]', $elements , $value , $atts);							
							?>	
						</div>
					</div>
					<div class="tab-pane" id="config_tab_3">
						<div data-bind="CustomScrollbar: {  						
									axis:'y',  						
									theme:'dark',  						
									autoExpandScrollbar:true, 						
									advanced:{ 							
										autoExpandHorizontalScroll:true 							
									} 						
									}" class="max-height-500">			
							
							<fieldset class="m-b-20">
								<legend><i class="fa fa-cogs"></i> Common</legend>
								<?php $commonSeriesSettings = array_key_exists('commonSeriesSettings', $config_visual)? element('commonSeriesSettings', $config_visual) : array();?>
								<div class="input-group m-b-10">
									<label for="type" class="input-group-addon">Type</label>						
									<?php 
										$atts = 'class="form-control" data-size="8" data-bind="BootstrapSelect:{}"';
										$value = element('type', $commonSeriesSettings);
										echo form_dropdown('visual[commonSeriesSettings][type]', element('pie', $av_types) , $value , $atts);												
									?>		
								</div>
								
								<div class="input-group m-b-10">
									<label for="rotated" class="input-group-addon">Rotated</label>						
									<div class="form-control p-5">
									<?php			
									$value = element('type', $config_visual);									
									$data = array(
									'name'        => 'visual[rotated]',
									'id'          => 'rotated',
									'value'       => 1,
									'checked'     => (bool) $value == 1,
									'style'       => 'margin:10px',
									'class'		  => 'm-0 p-absolute',
									'data-bind'	  => 'BootstrapSwitch:{ size: \'mini\' }'
									);
									echo form_checkbox($data); ?>
									</div>	
								</div>
							</fieldset>
							
							<fieldset class="m-b-20">
								<legend><i class="fa fa-font"></i> Title</legend>
								<?php $title = array_key_exists('title', $config_visual)? element('title', $config_visual) : array();?>								
								<div class="input-group m-b-10">
									<label for="verticalAlignment" class="input-group-addon">v-alignment</label>						
									<?php 
										$atts = 'class="form-control" data-size="8" data-bind="BootstrapSelect:{}"';
										$value = element('verticalAlignment', $title);	
										echo form_dropdown('visual[title][verticalAlignment]', element('verticalAlignment', $av_options) , $value , $atts);		
									?>			
								</div>									
								<div class="input-group m-b-10">
									<label for="horizontalAlignment" class="input-group-addon">h-alignment</label>						
									<?php 
										$atts = 'class="form-control" data-size="8" data-bind="BootstrapSelect:{}"';
										$value = element('horizontalAlignment', $title);	
										echo form_dropdown('visual[title][horizontalAlignment]', element('horizontalAlignment', $av_options) , $value , $atts);		
									?>		
								</div>
							</fieldset>
							
							<fieldset class="m-b-20">
								
								<legend><i class="fa fa-comments-o"></i> Label
									<div class="pull-right">
									<?php	
									$label = array_key_exists('label', $series)? element('label', $series) : array();
														
									$data = array(
									'name'        => 'visual[series][label][visible]',
									'id'          => 'labelVisible',
									'value'       => 1,
									'checked'     => (element('visible', $label) == true),
									'style'       => 'margin:10px',
									'class'		  => 'm-0 p-absolute',
									'data-bind'	  => 'BootstrapSwitch:{ size: \'mini\' }'
									);
									echo form_checkbox($data); ?>
									</div>
								</legend>
								
								<div class="input-group m-b-10">
									<label for="connectorVisible" class="input-group-addon">Connector</label>						
									<div class="form-control p-5">
									<?php	
									$connector = array_key_exists('connector', $label)? element('connector', $label) : array();
									$data = array(
									'name'        => 'visual[series][label][connector][visible]',
									'id'          => 'connectorVisible',
									'value'       => 1,
									'checked'     => (element('visible', $connector) == true),
									'style'       => 'margin:10px',
									'class'		  => 'm-0 p-absolute',
									'data-bind'	  => 'BootstrapSwitch:{ size: \'mini\' }'
									);
									echo form_checkbox($data); ?>
									</div>	
								</div>
								
							</fieldset>
							
							<fieldset class="m-b-20">
								<?php $tooltip = array_key_exists('tooltip', $config_visual)? element('tooltip', $config_visual) : array();?>	
								<legend><i class="fa fa-comments-o"></i> Tooltip
									<div class="pull-right">
									<?php	
									$value = element('enabled', $tooltip);	
									$data = array(
									'name'        => 'visual[tooltip][enabled]',
									'id'          => 'tooltip',
									'value'       => 1,
									'checked'     => (bool) $value == 1,
									'style'       => 'margin:10px',
									'class'		  => 'm-0 p-absolute',
									'data-bind'	  => 'BootstrapSwitch:{ size: \'mini\' }'
									);
									echo form_checkbox($data); ?>
									</div>
								</legend>
							</fieldset>
							
							<fieldset class="m-b-20">
								<?php $legend = array_key_exists('legend', $config_visual)? element('legend', $config_visual) : array();?>	
								<legend><i class="fa fa-bars"></i> Legend
									<div class="pull-right">
									<?php	
									$value = element('visible', $legend);	
									$data = array(
									'name'        => 'visual[legend][visible]',
									'id'          => 'legend',
									'value'       => 1,
									'checked'     => (bool) $value == 1,
									'style'       => 'margin:10px',
									'class'		  => 'm-0 p-absolute',
									'data-bind'	  => 'BootstrapSwitch:{ size: \'mini\' }'
									);
									echo form_checkbox($data); ?>
									</div>							
								</legend>
								<div class="input-group m-b-10">
									<label for="verticalAlignment" class="input-group-addon">v-alignment</label>	
									<?php 
										$atts = 'class="form-control " data-size="5" data-bind="BootstrapSelect:{}"';
										$value = element('verticalAlignment', $legend);	
										echo form_dropdown('visual[legend][verticalAlignment]', element('verticalAlignment', $av_options) , $value , $atts);		
									?>	
								</div>
								<div class="input-group m-b-10">
									<label for="verticalAlignment" class="input-group-addon">h-alignment</label>		
									<?php 
										$atts = 'class="form-control " data-size="5" data-bind="BootstrapSelect:{}"';
										$value = element('horizontalAlignment', $legend);	
										echo form_dropdown('visual[legend][horizontalAlignment]', element('horizontalAlignment', $av_options) , $value , $atts);		
									?>	
								</div>
								<div class="input-group m-b-10">
									<label for="verticalAlignment" class="input-group-addon">text-position</label>		
									<?php 
										$atts = 'class="form-control " data-size="5" data-bind="BootstrapSelect:{}"';
										$value = element('itemTextPosition', $legend);		
										echo form_dropdown('visual[legend][itemTextPosition]', element('itemTextPosition', $av_options) , $value , $atts);		
									?>	
								</div>
								<div class="input-group m-b-10">
									<label for="verticalAlignment" class="input-group-addon">col-count</label>		
									<?php 
										$value = element('columnCount', $legend);		
										  $data = array(
										  'name'        => 'visual[legend][columnCount]',
										  'id'          => 'columnCount',							  
										  'class'		=> 'form-control',
										  'value'		=> $value,
										  'placeholder'	=> 'columnCount',
										  'type'		=> 'number'
										);

									echo form_input($data); ?>	
								</div>
							</fieldset>						
							<fieldset class="m-b-20">
								<legend><i class="fa fa-long-arrow-right"></i> Argument Axis</legend>
								<?php $argumentAxis = array_key_exists('argumentAxis', $config_visual)? element('argumentAxis', $config_visual) : array();?>
									
								<div class="input-group m-b-10">
									<label for="argumentType" class="input-group-addon">Argument Type</label>		
									<?php 
										$value =  element('argumentType', $argumentAxis);	

										$atts = 'class="form-control " data-size="5" data-live-search="false" data-bind="BootstrapSelect:{}"';
										echo form_dropdown('visual[argumentAxis][argumentType]', element('argumentType', $av_options) , $value , $atts);	
									?>
								</div>
								<div class="input-group m-b-10">
									<label for="axisDivisionFactor" class="input-group-addon">Axis Division Factor</label>	
									<?php	
									$value =  element('axisDivisionFactor', $argumentAxis);	
														
									$data = array(
										  'name'        => 'visual[argumentAxis][axisDivisionFactor]',
										  'id'          => 'axisDivisionFactor',							  
										  'class'		=> 'form-control',
										  'value'		=> $value,
										  'type'		=> 'number'
										);
									echo form_input($data); ?>
								</div>
								
								<div class="input-group m-b-10">
									<label for="argumentAxisInverted" class="input-group-addon">Inverted</label>		
									<div class="form-control p-5">
									<?php	
									$data = array(
									'name'        => 'visual[argumentAxis][inverted]',
									'id'          => 'argumentAxis',
									'value'       => 1,
									'checked'     => (bool)element('inverted', $argumentAxis) == 1,
									'style'       => 'margin:10px',
									'class'		  => 'm-0 p-absolute',
									'data-bind'	  => 'BootstrapSwitch:{ size: \'mini\' }'
									);
									echo form_checkbox($data); ?>
									</div>
								</div>
								<div class="input-group m-b-10">
									<label for="valueMarginsEnabled" class="input-group-addon">Enable Margins</label>		
									<div class="form-control p-5">
									<?php	
									$value =  element('valueMarginsEnabled', $argumentAxis);	
									$data = array(
									'name'        => 'visual[argumentAxis][valueMarginsEnabled]',
									'id'          => 'valueMarginsEnabled',
									'value'       => true,
									'checked'     => (bool)$value == true,
									'style'       => 'margin:10px',
									'class'		  => 'm-0 p-absolute',
									'data-bind'	  => 'BootstrapSwitch:{ size: \'mini\' }'
									);
									echo form_checkbox($data); ?>
									</div>
								</div>
								
								<div class="input-group m-b-10">
									<label for="labelFormat" class="input-group-addon">labelFormat</label>		
									<?php 
										$label =  element('label', $argumentAxis);	
										$value =  is_array($label)? $label : array();
										$atts = 'class="form-control " data-size="5" data-live-search="false" data-bind="BootstrapSelect:{}"';
										echo form_dropdown('visual[argumentAxis][label][format]', element('labelformat', $av_options) , element('format', $value) , $atts);	
									?>	
								</div>
								<div class="input-group m-b-10">
									<label for="argumentAxisPosition" class="input-group-addon">Position</label>		
									<?php 
										$atts 	= 'class="form-control" data-size="5" data-bind="BootstrapSelect:{}"';
										$value =  element('position', $argumentAxis);	
										echo form_dropdown('visual[argumentAxis][position]', element('position', $av_options) , $value , $atts);							
									?>
								</div>
							</fieldset>
							
							<fieldset class="m-b-20">
								<legend><i class="fa fa-long-arrow-up"></i> Value Axis</legend>
								<?php $valueAxis = array_key_exists('valueAxis', $config_visual)? element('valueAxis', $config_visual) : array();?>
								<div class="input-group m-b-10">
									<label for="valueAxisInverted" class="input-group-addon">Inverted</label>		
									<div class="form-control p-5">
									<?php	
									$data = array(
									'name'        => 'visual[valueAxis][inverted]',
									'id'          => 'tooltip',
									'value'       => 1,
									'checked'     => (bool) element('inverted', $valueAxis) == 1,
									'style'       => 'margin:10px',
									'class'		  => 'm-0 p-absolute',
									'data-bind'	  => 'BootstrapSwitch:{ size: \'mini\' }'
									);
									echo form_checkbox($data); ?>
									</div>
								</div>
								
								<div class="input-group m-b-10">
									<label for="labelFormat" class="input-group-addon">labelFormat</label>		
									<?php 
										$label =  element('label', $valueAxis);	
										$value =  is_array($label)? $label : array();	

										$atts = 'class="form-control " data-size="5" data-live-search="false" data-bind="BootstrapSelect:{}"';
										echo form_dropdown('visual[valueAxis][label][format]', element('labelformat', $av_options) , element('format', $value) , $atts);	
									?>	
								</div>
								<div class="input-group m-b-10">
									<label for="argumentAxisPosition" class="input-group-addon">Position</label>		
									<?php 
										$atts  = 'class="form-control" data-size="5" data-bind="BootstrapSelect:{}"';
										$value =  element('position', $valueAxis);		
										echo form_dropdown('visual[valueAxis][position]', element('position', $av_options) , $value , $atts);							
									?>
								</div>
							</fieldset>
							
							
							
							<fieldset class="m-b-20">
								<legend><i class="fa fa-paint-brush"></i> Color/ Style</legend>
								
								<div class="input-group m-b-10">
									<label for="palette" class="input-group-addon">Palette</label>		
									<?php 
										$atts = 'class="form-control dropup" data-size="5" data-bind="BootstrapSelect:{}"';
										$value = element('palette',$config_visual);
										echo form_dropdown('visual[palette]', element('palette', $av_options) , $value , $atts);		
									?>	
								</div>
							</fieldset>
						</div><!-- //SlimScroll-->
					</div>
				</div>
			</div>
			
			
		</div>
	</div>
	<?=form_close()?>				



