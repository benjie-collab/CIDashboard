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

$filter_options		= array_key_exists('filter', $options)? element('filter', $options): array();	
echo form_open( '/app/widget_options/', $atts, $hidden ); ?>

	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs pull-right">
		  <li class="active"><a data-toggle="tab" data-target="#options-tab-1" href="javascript:void(0)">Display</a></li>			  
		  <li class=""><a data-toggle="tab" data-target="#options-tab-2" href="javascript:void(0)">Filters</a></li>
		</ul>
		<div class="tab-content">
			<div id="options-tab-1" class="tab-pane active">
				<?php $this->load->view('widgets/widget-options-basic', $options);?>
			</div>
			<div id="options-tab-2" class="tab-pane">
				<div class="form-group">
					<label class="col-sm-3 control-label" for="sources">Sources</label>	
					<div class="col-sm-9 checkbox" >				
						<input type="hidden" name="filter[sources]" value="0"/>
					   <?php $data = array(
							'name'        => 'filter[sources]',
							'id'          => 'sources',
							'value'       => 1,
							'checked'     => (bool)element('sources', $filter_options )==1,
							'style'       => 'margin:10px',
							'class'		  => 'm-0 p-absolute',
							'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
							);
						echo form_checkbox($data); ?>
						<p class="help-block">Some help text</p>
					</div>	
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label" for="synonym">Synonym</label>	
					<div class="col-sm-9 checkbox" >				
						<input type="hidden" name="filter[synonym]" value="0"/>
						   <?php $data = array(
								'name'        => 'filter[synonym]',
								'id'          => 'synonym',
								'value'       => 1,
								'checked'     => (bool)element('synonym', $filter_options )==1,
								'style'       => 'margin:10px',
								'class'		  => 'm-0 p-absolute',
								'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
								);

							echo form_checkbox($data); ?>
						
						<p class="help-block">Some help text</p>
					</div>	
				</div>
				
				
				<div class="form-group">
					<label class="col-sm-3 control-label" for="minscore">Min. Score</label>	
					<div class="col-sm-9 checkbox" >				
						<input type="hidden" name="filter[minscore]" value="0"/>
						   <?php $data = array(
								'name'        => 'filter[minscore]',
								'id'          => 'minscore',
								'value'       => 1,
								'checked'     => (bool)element('minscore', $filter_options )==1,
								'style'       => 'margin:10px',
								'class'		  => 'm-0 p-absolute',
								'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
								);

							echo form_checkbox($data); ?>
						
						<p class="help-block">Some help text</p>
					</div>	
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label" for="daterange">Date Range</label>	
					<div class="col-sm-9 checkbox" >				
						<input type="hidden" name="filter[daterange]" value="0"/>
						   <?php $data = array(
								'name'        => 'filter[daterange]',
								'id'          => 'daterange',
								'value'       => 1,
								'checked'     => (bool)element('daterange', $filter_options )==1,
								'style'       => 'margin:10px',
								'class'		  => 'm-0 p-absolute',
								'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
								);

							echo form_checkbox($data); ?>
						
						<p class="help-block">Some help text</p>
					</div>	
				</div>	
			</div>
		</div>
	


	
		
		
<?php echo form_close(); ?>