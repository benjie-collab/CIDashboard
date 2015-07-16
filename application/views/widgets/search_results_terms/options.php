<?php 	
/*
* Received Parameters:
* 	$widget_key
*/
	
$options 	= $this->application->get_settings($widget_key);	
$visual_options 	= array_key_exists('visual', $options)? element('visual', $options) : array();	
	
	
	
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
		  <li class=""><a data-toggle="tab" data-target="#options-tab-2" href="javascript:void(0)">Visualization</a></li>
		</ul>
		<div class="tab-content">
			<div id="options-tab-1" class="tab-pane active">				
				<?php $this->load->view('widgets/widget-options-basic', $options);?>	
			</div>
			<div id="options-tab-2" class="tab-pane">
				<div class="form-group">
					<label class="col-sm-3 control-label" for="min">Minimum Score</label>
					<div class="col-sm-9">
					   <div class="dark-slider" >
							<input type="text" name="visual[min]" data-slider-value="<?=element('min', $visual_options)?>"
							data-slider-orientation="horizontal" 
							data-bind="BootstrapSlider: {
								min: 0,
								max: 500,
								ticks_snap_bounds: 1,
								tooltip: 'always',
								reversed: false
							}"/>
						</div>
						<p class="help-block">Estimated minimum score; to be used on scaling font size</p>
					</div>
				</div>	
				
				<div class="form-group">
					<label class="col-sm-3 control-label" for="max">Maximum Score</label>
					<div class="col-sm-9">
						<div class="dark-slider" >
							<input type="text" name="visual[max]" data-slider-value="<?=element('max', $visual_options)?>"
							data-slider-orientation="horizontal" 
							data-bind="BootstrapSlider: {
								min: 20,
								max: 500,
								ticks_snap_bounds: 1,
								tooltip: 'always',
								reversed: false
							}"/>
						</div>
						
						<p class="help-block">Estimated maximum score; to be used on scaling font size</p>
					</div>
				</div>	
				
				<div class="form-group">
					<label class="col-sm-3 control-label" for="title">Font</label>
					<div class="col-sm-9">
						<?php 
							$fonts = $this->application->get_config('fonts', 'template');
							$atts = 'class="form-control selectpicker" data-live-search="true" data-size="3" data-bind="BootstrapSelect:{}"';
							$selected = array_key_exists('font', $visual_options)? element('font', $visual_options) : '';
							echo form_dropdown('visual[font]', $fonts, $selected, $atts);
						?>
						<p class="help-block"><?=lang('search_form_options_title_help_text')?></p>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label" for="fontmin">Min Font</label>
					<div class="col-sm-9">
						<div class="dark-slider" >
							<input type="text" name="visual[fontmin]" data-slider-value="<?=element('fontmin', $visual_options)?>"
							data-slider-orientation="horizontal" 
							data-bind="BootstrapSlider: {
								min: 8,
								max: 40,
								ticks_snap_bounds: 1,
								tooltip: 'always',
								reversed: false
							}"/>
						</div>
						<p class="help-block"><?=lang('search_form_options_title_help_text')?></p>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label" for="fontmax">Max Font</label>
					<div class="col-sm-9">
						<div class="dark-slider" >
							<input type="text" name="visual[fontmax]" data-slider-value="<?=element('fontmax', $visual_options)?>"
							data-slider-orientation="horizontal" 
							data-bind="BootstrapSlider: {
								min: 8,
								max: 40,
								ticks_snap_bounds: 1,
								tooltip: 'always',
								reversed: false
							}"/>
						</div>
						<p class="help-block"><?=lang('search_form_options_title_help_text')?></p>
					</div>
				</div>
				
				
				<div class="form-group">
					<label class="col-sm-3 control-label" for="spacing">Term Spacing</label>
					<div class="col-sm-9">
					   <?php $data = array(
									  'name'        => 'visual[spacing]',
									  'id'          => 'spacing',
									  'maxlength'   => '30',
									  'class'		=> 'form-control',
									  'value'		=> element('spacing', $visual_options),
									  'placeholder'	=> '5'
									);

						echo form_input($data); ?>
						<p class="help-block"><?=lang('search_form_options_title_help_text')?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
			
			
		
<?php echo form_close(); ?>



