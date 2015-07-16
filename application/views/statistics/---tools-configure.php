<div id="floating-tool" 
	class="no-print  floating-tools-button">
	<i class="ion ion-ios-gear-outline"></i>
</div>
<div id="floating-tool-content" class="no-print floating-tools-content" data-bind="">

	<div class="">	
	
		<?php 
		$statistics_settings = $this->statistics_model->get_config($widget_key);
		$statistics_settings = json_decode($statistics_settings);
		$hidden 		= array(
							'widget_key' => $widget_key,
							'tooltip[enabled]' => 0
						);
		$attributes = array('class' => '');			 
		echo form_open('/statistics/update_statistics_settings', $attributes, $hidden); ?>
	
	
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs pull-right">
		  <li class="active"><a href="javascript:void(0)" data-target="#config_tab_1" data-toggle="tab"><i class="fa fa-sort-numeric-asc"></i></a></li>
		  <li class=""><a href="javascript:void(0)" data-target="#config_tab_2" data-toggle="tab"><i class="fa fa-tasks"></i></a></li>
		</ul>
		<div class="tab-content p-0">
			<div class="tab-pane active" id="config_tab_1">
				<div data-bind="SlimScroll: { height: 450, width: '100%'}">
					<fieldset>
						<legend>Basic</legend>
						
						
						
						<div class="form-group">
							<label for="title">Title</label>
							   <?php $data = array(
											  'name'        => 'title',
											  'id'          => 'title',
											  'maxlength'   => '30',
											  'class'		=> 'form-control',
											  'value'		=> $statistics_settings->title,
											  
											);
								echo form_input($data); ?>
						</div>
						
						<div class="form-group">
							<label for="short_name">Short Name</label>
							   <?php $data = array(
											  'name'        => 'short_name',
											  'id'          => 'short_name',
											  'maxlength'   => '30',
											  'class'		=> 'form-control',
											  'value'		=> $statistics_settings->short_name,
											  
											);
								echo form_input($data); ?>
						</div>
						
						<div class="form-group">
							<label for="tooltip">Tooltip</label>				
						   <?php
								$enabled = array_key_exists('enabled', $statistics_settings->tooltip)? $statistics_settings->tooltip->enabled : true;	
								$data = array(
								'name'        => 'tooltip[enabled]',
								'id'          => 'tooltip',
								'value'       => 1,
								'checked'     => $enabled,
								'style'       => 'margin:10px',
								'class'		  => 'm-0 p-absolute',
								'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
								);
							echo form_checkbox($data); ?>
						</div>
					</fieldset>
					
					
					<fieldset>
						<legend>Legend</legend>
						<div class="form-group">
							<label for="verticalAlignment">verticalAlignment</label>		
							<?php 
								$atts = 'class="selectpicker " data-bind="BootstrapSelect:{}"';
								$verticalAlignment = array_key_exists('verticalAlignment', $statistics_settings->legend)? $statistics_settings->legend->verticalAlignment : $options['verticalAlignment']['top'];
								echo form_dropdown('legend[verticalAlignment]', $options['verticalAlignment'] , $verticalAlignment , $atts);		
							?>	
						</div>
						<div class="form-group">
							<label for="horizontalAlignment">horizontalAlignment</label>				
							<?php 
								$atts = 'class="selectpicker " data-bind="BootstrapSelect:{}"';
								$horizontalAlignment = array_key_exists('horizontalAlignment', $statistics_settings->legend)? $statistics_settings->legend->horizontalAlignment : $options['horizontalAlignment']['right'];
								echo form_dropdown('legend[horizontalAlignment]', $options['horizontalAlignment'] , $horizontalAlignment , $atts);		
							?>			
						</div>
						<div class="form-group">
							<label for="itemTextPosition">itemTextPosition</label>			
							<?php 
								$atts = 'class="selectpicker" data-bind="BootstrapSelect:{}"';
								$itemTextPosition = array_key_exists('itemTextPosition', $statistics_settings->legend)? $statistics_settings->legend->itemTextPosition : '';
								echo form_dropdown('legend[itemTextPosition]', $options['itemTextPosition'] , $itemTextPosition , $atts);		
							?>		
						</div>
						<div class="form-group">
							<label for="columnCount">columnCount</label>			
							<?php 
								$columnCount = array_key_exists('columnCount', $statistics_settings->legend)? $statistics_settings->legend->columnCount : 10;
							
								  $data = array(
								  'name'        => 'legend[columnCount]',
								  'id'          => 'legend[columnCount]',							  
								  'class'		=> 'form-control ',
								  'value'		=> $columnCount,
								  'placeholder'	=> 'columnCount',
								  'type'		=> 'number'
								);

							echo form_input($data); ?>	
						</div>
					</fieldset>
				</div>
			</div><!-- /.tab-pane -->
			
			<div class="tab-pane" id="config_tab_2" >
				<div data-bind="SlimScroll: { height: 450, width: '100%'}">
						
						<div class="form-group">	
							<label for="yAxis">Y-Axis</label>
							<?php 
								$selected = array_key_exists('yAxis', $statistics_settings->settings)? $statistics_settings->settings->yAxis : $options['settings']['yAxis'];
								$atts = 'data-container="body" data-live-search="true" data-size="10" class="selectpicker"  multiple';
								echo form_dropdown('settings[yAxis][]', $elements, $selected, $atts);
							?>
							
							
							
							
						</div>
						<div class="form-group">	
							<label for="x-axis">X-Axis</label>	
							<?php 
								$selected = array_key_exists('xAxis', $statistics_settings->settings)? $statistics_settings->settings->xAxis : $options['settings']['xAxis'];
								$atts = 'data-container="body" data-live-search="true" data-size="10" class="selectpicker"  multiple';
								echo form_dropdown('settings[xAxis][]', $elements, $selected, $atts);
							?>
						</div>
						<div class="form-group">	
							<label for="count">Entity to Count</label>	
							<?php 
								$selected = array_key_exists('count', $statistics_settings->settings)? $statistics_settings->settings->count : $options['settings']['count'];
								$atts = 'data-container="body" data-live-search="true" data-size="10" class="selectpicker"  multiple';
								echo form_dropdown('settings[count][]', $elements, $selected, $atts);
							?>
						</div>
				</div>
			</div><!-- /.tab-pane -->
		</div><!-- /.tab-content -->
	  </div>
	
	
	
	
	
	
	
	
	
		
			
			
			
		<div class="box-footer text-center">
		  <ul class="nav nav-pills nav-stacked ">
			<li>
				<button type="submit" class="btn btn-primary" data-bind="">
				<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
				Save changes</button>
			</li>
		  </ul>
		</div>
			
			
		
		<?=form_close()?>
		
		
		
		
	</div>
	
	
	
	
	
	
</div>
