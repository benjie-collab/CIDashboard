<?php 
	$config 	= $this->widgets_model->get_widget(NULL, array('widget_key' => $widget_key));
	$settings 	= element('settings', $config);	
	$av_options = $this->application->get_config('options', 'statistics');

	$hidden = array(
				'widget_key' => $widget_key,
				'tooltip[enabled]' => 0,
				'legend[visible]' => 0
			);
	$atts = array(
			'class' => 'form',
			'data-bind' => 'submit: $root.formSubmit', 
			'method' => 'POST',
			'onSubmit' => 'return false;',
			'id' => 'widget_options_form'
	);		 	
	echo form_open('/statistics/configure', $atts, $hidden);	
	?>

	<div class="nav-tabs-custom text-black">
	
		<ul class="nav nav-tabs pull-right ui-sortable-handle">			
			<li class="active"><a data-toggle="tab" href="#config_tab_2">Data</a></li>
			<li><a data-toggle="tab" href="#config_tab_3">Display</a></li>
			<li><a data-toggle="tab" href="#config_tab_1">Info</a></li>
		</ul>
		
		
		<div class="row">		
			<div class="col-sm-7">	
				<div class="p-10">
					<?php $this->load->view('/widgets/bargauge/view', array('widget_key' => $widget_key, 'widgetize' => false) ) ;?>
				</div>			
			</div>	
			<div class="col-sm-5">
				<div class="tab-content p-10">					
					<div class="tab-pane " id="config_tab_1">
						<div class="form-group">
							<label for="title">Title</label>							
							<?php $data = array(
										  'name'        => 'title[text]',
										  'id'          => 'title',
										  'maxlength'   => '30',
										  'class'		=> 'form-control',
										  'value'		=> element('text', element('title', $config)),												  
										);
							echo form_input($data); ?>														   
						</div>
						<div class="form-group">
							<label for="description">Description</label>							
							<?php $data = array(
										  'name'        => 'settings[description]',
										  'id'          => 'description',
										  'size'  		=> '30',
										  'rows'		=> '5',
										  'cols'		=> '12',
										  'class'		=> 'form-control',
										  'value'		=> element('description', $settings),												  
										);
							echo form_textarea($data); 
							?>														   
						</div>
					</div>
					<div class="tab-pane active" id="config_tab_2">
						<div class="form-group">	
							<label for="xAxis">X-Axis</label>
							<?php 								
								$selected = element('xAxis', $settings)? element('xAxis', $settings) : '';	
								$elements = $this->document_lib->elements(null, array('action'=>'GetTagNames', 'responseformat'=>'json', 'FieldType' => 'parametric'), false);
								$atts = 'id="xAxis" data-live-search="true" data-size="10" class="selectpicker form-control" data-bind="BootstrapSelect:{}" ';
								echo form_dropdown('settings[xAxis]', $elements, $selected, $atts);
							?>							
						</div>
						
						<div class="form-group">	
							<label for="yAxis">Y-Axis</label>
							<?php 								
								$selected = element('yAxis', $settings)? element('yAxis', $settings) : '';	
								$elements = $this->document_lib->elements(null, array('action'=>'GetTagNames', 'responseformat'=>'json', 'FieldType' => 'parametric'), false);
								$atts = 'id="yAxis" data-live-search="true" data-size="10" class="selectpicker form-control" data-bind="BootstrapSelect:{}"';
								echo form_dropdown('settings[yAxis]', $elements, $selected, $atts);
							?>							
						</div>
						
						<div class="form-group">	
							<label for="count">Element Count</label>
							<?php 								
								$selected = element('count', $settings)? element('count', $settings) : '';	
								$elements = $this->document_lib->elements(null, array('action'=>'GetTagNames', 'responseformat'=>'json', 'FieldType' => 'index'), false);
								$atts = 'id="count" data-live-search="true" data-size="10" class="selectpicker form-control" data-bind="BootstrapSelect:{}"';
								echo form_dropdown('settings[count]', $elements, $selected, $atts);
							?>							
						</div>
						
						
					</div>
					<div class="tab-pane form-horizontal" id="config_tab_3">
					<div data-bind="SlimScroll: { height: 500}">
						<fieldset>
							<legend>Common</legend>
							<div class="form-group">
								<label for="verticalAlignment" class="control-label col-md-4">Type</label>	
								<?php 
									$atts = 'class="form-control w-auto col-md-8" data-size="8" data-bind="BootstrapSelect:{}"';
									$type = element('commonSeriesSettings', $config)? element('type',element('commonSeriesSettings',$config)) : '';	
									echo form_dropdown('commonSeriesSettings[type]', element('type', $av_options) , $type , $atts);		
									
								?>	
							</div>
						</fieldset>
						<fieldset>
							<legend>Title</legend>
							<div class="form-group">
								<label for="verticalAlignment" class="control-label col-md-4">v-alignment</label>	
								<?php 
									$atts = 'class="form-control w-auto col-md-8" data-size="8" data-bind="BootstrapSelect:{}"';
									$verticalAlignment = element('title', $config)? element('verticalAlignment', element('title', $config)) : '';	
									echo form_dropdown('title[verticalAlignment]', element('verticalAlignment', $av_options) , $verticalAlignment , $atts);		
								?>	
							</div>
							<div class="form-group">
								<label for="verticalAlignment" class="control-label col-md-4">h-alignment</label>		
								<?php 
									$atts = 'class="form-control w-auto col-md-8" data-size="8" data-bind="BootstrapSelect:{}"';
									$horizontalAlignment = element('title', $config)? element('horizontalAlignment', element('title', $config)) : '';	
									echo form_dropdown('title[horizontalAlignment]', element('horizontalAlignment', $av_options) , $horizontalAlignment , $atts);		
								?>	
							</div>
						</fieldset>
						<fieldset>
							<legend>Tooltip</legend>
							<div class="form-group">
								<label for="tooltip" class="control-label col-md-4">Enabled</label>
								<div class="col-md-8">
									 <?php	
									$data = array(
									'name'        => 'tooltip[enabled]',
									'id'          => 'tooltip',
									'value'       => 1,
									'checked'     => (bool) element('enabled', element('tooltip', $config)) == 1,
									'style'       => 'margin:10px',
									'class'		  => 'm-0 p-absolute',
									'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
									);
									echo form_checkbox($data); ?>
								</div>
							</div>	
						</fieldset>
						
						<fieldset>
							<legend>Legend</legend>
							<div class="form-group">
								<label for="visible" class="control-label col-md-4">Visible</label>
								<div class="col-md-8">
									 <?php	
									$data = array(
									'name'        => 'legend[visible]',
									'id'          => 'visible',
									'value'       => 1,
									'checked'     => (bool) element('visible', element('legend', $config)) == 1,
									'style'       => 'margin:10px',
									'class'		  => 'm-0 p-absolute',
									'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
									);
									echo form_checkbox($data); ?>
								</div>
							</div>
							<div class="form-group">
								<label for="verticalAlignment" class="control-label col-md-4">v-alignment</label>	
								<?php 
									$atts = 'class="form-control w-auto col-md-8" data-size="8" data-bind="BootstrapSelect:{}"';
									$verticalAlignment = element('legend', $config)? element('verticalAlignment', element('legend', $config)) : '';	
									echo form_dropdown('legend[verticalAlignment]', element('verticalAlignment', $av_options) , $verticalAlignment , $atts);		
								?>	
							</div>
							<div class="form-group">
								<label for="verticalAlignment" class="control-label col-md-4">h-alignment</label>		
								<?php 
									$atts = 'class="form-control w-auto col-md-8" data-size="8" data-bind="BootstrapSelect:{}"';
									$horizontalAlignment = element('legend', $config)? element('horizontalAlignment', element('legend', $config)) : '';	
									echo form_dropdown('legend[horizontalAlignment]', element('horizontalAlignment', $av_options) , $horizontalAlignment , $atts);		
								?>	
							</div>
							<div class="form-group">
								<label for="verticalAlignment" class="control-label col-md-4">text-position</label>		
								<?php 
									$atts = 'class="form-control w-auto col-md-8" data-size="8" data-bind="BootstrapSelect:{}"';
									$itemTextPosition = element('legend', $config)? element('itemTextPosition', element('legend', $config)) : '';	
									echo form_dropdown('legend[itemTextPosition]', element('itemTextPosition', $av_options) , $itemTextPosition , $atts);		
								?>	
							</div>
							<div class="form-group">
								<label for="verticalAlignment" class="control-label col-md-4">col-count</label>		
								<?php 
									$columnCount = element('legend', $config)? element('columnCount', element('legend', $config)) : 10;	
								
									  $data = array(
									  'name'        => 'legend[columnCount]',
									  'id'          => 'legend[columnCount]',							  
									  'class'		=> 'form-control w-auto col-md-8 ',
									  'value'		=> $columnCount,
									  'placeholder'	=> 'columnCount',
									  'type'		=> 'number'
									);

								echo form_input($data); ?>	
							</div>
						</fieldset>
						
						<fieldset>
							<legend>Color/Style</legend>
							<div class="form-group">
								<label for="verticalAlignment" class="control-label col-md-4">palette</label>	
								<?php 
									$atts = 'class="form-control w-auto col-md-8" data-size="8" data-bind="BootstrapSelect:{}"';
									$palette = element('palette', $config)? element('palette',$config) : '';	
									echo form_dropdown('palette', element('palette', $av_options) , $palette , $atts);		
								?>	
							</div>
						</fieldset>
					</div>
					</div>
				
				
				
				
				
				</div>
			</div>
		
		</div>
	</div>
	<?=form_close()?>				



