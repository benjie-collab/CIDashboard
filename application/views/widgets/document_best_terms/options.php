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


echo form_open( '/app/widget_options/', $atts, $hidden ); ?>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="title">Title</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'title',
							  'id'          => 'title',
							  'maxlength'   => '30',
							  'class'		=> 'form-control',
							  'value'		=> element('title', $options),
							  'placeholder'	=> 'Enter Title'
							);

				echo form_input($data); ?>
				<p class="help-block"><?=lang('search_form_options_title_help_text')?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="widgetize">Widgetize</label>	
			<div class="col-sm-9 checkbox" >				
				<input type="hidden" name="widgetize" value="0"/>
			   <?php $data = array(
					'name'        => 'widgetize',
					'id'          => 'widgetize',
					'value'       => 1,
					'checked'     => intval(element('widgetize', $options))==1,
					'style'       => 'margin:10px',
					'class'		  => 'm-0 p-absolute',
					'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
					);
				echo form_checkbox($data); ?>
			</div>
		</div>	
		
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="min">Minimum Score</label>
			<div class="col-sm-9">
			   <div class="dark-slider" >
					<input type="text" name="min" data-slider-value="<?=element('min', $options)?>"
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
					<input type="text" name="max" data-slider-value="<?=element('max', $options)?>"
					data-slider-orientation="horizontal" 
					data-bind="BootstrapSlider: {
						min: 0,
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
					$selected = array_key_exists('font', $options)? element('font', $options) : '';
					echo form_dropdown('font', $fonts, $selected, $atts);
				?>
				<p class="help-block"><?=lang('search_form_options_title_help_text')?></p>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="fontmin">Min Font</label>
			<div class="col-sm-9">
			    <div class="dark-slider" >
					<input type="text" name="fontmin" data-slider-value="<?=element('fontmin', $options)?>"
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
					<input type="text" name="fontmax" data-slider-value="<?=element('fontmax', $options)?>"
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
							  'name'        => 'spacing',
							  'id'          => 'spacing',
							  'maxlength'   => '30',
							  'class'		=> 'form-control',
							  'value'		=> element('spacing', $options),
							  'placeholder'	=> '5'
							);

				echo form_input($data); ?>
				<p class="help-block"><?=lang('search_form_options_title_help_text')?></p>
			</div>
		</div>
		
		
		
		
		<!--
		<div class="modal-footer p-b-0">
			<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary btn-flat" data-bind="css: { 'has-spinner active' : $root.ajaxProcess}">
				<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
				Save changes</button>		
		</div>-->
<?php echo form_close(); ?>
<script>
	//ko.applyBindings(VMSearchWidgetOptions, $('#widget_options_form').get(0) );
</script>





