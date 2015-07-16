<!-- Modal -->  
<?php 
	$atts = array(
			'class' => 'form-horizontal',
			'data-bind' => 'submit: $root.formSubmit', 
			'method' => 'POST',
			'onSubmit' => 'return false;',
			'id' => 'widget_options_form'
	);
	
	$hidden 		= array('widget_key' => $this->widgets_model->generate_widget_options_key($parameters['widget_key']));
	$widget_options = $this->config->item('widget_options', 'template');
	$options 		= $this->widgets_model->get_widget_options($parameters['widget_key']);
	$is_mode_edit 		= $this->application->is_mode('edit');
?>
<?php echo form_open( 'statistics/options', $atts, $hidden ); ?>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="title">Color</label>
			<div class="col-sm-9">			  
				<?php					
				$bg = element('bgcolor', $options)? element('bgcolor', $options) : '';	
				?>
				<select class="selectpicker" data-bind="BootstrapSelect:{}" name="bgcolor">		
					<option value=''>None</option>
					<?php foreach( $widget_options['bg'] as $key=>$nm) :?>
						<option value="<?=$key?>" <?=strcasecmp($key, $bg)==0?'selected':''?> data-content="<span class='p-l-5 p-r-5 label bg-<?=$key?>-gradient'><?=$key?></span>"><?=$nm?></option>	
					<?php endforeach;?>
				</select>
				
				<p class="help-block">Some help text</p>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="action">Size</label>
			<div class="col-sm-9">
			   <?php 
					$size = element('size', $options)? element('size', $options) : '';
					$atts = 'class="selectpicker" data-bind="BootstrapSelect:{}"';
					echo form_dropdown('size', $widget_options['size'], $size, $atts);
				?>
				<p class="help-block">size</p>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="show_widget_title">Show Widget Title</label>				
			<div class="col-sm-9" >		
				<input type="hidden" name="show_widget_title" value="0"/>
			   <?php $data = array(
					'name'        => 'show_widget_title',
					'id'          => 'show_widget_title',
					'value'       => 1,
					'checked'     => element('show_widget_title', $options) == 1,
					'style'       => 'margin:10px',
					'class'		  => 'm-0 p-absolute',
					'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
					);

				echo form_checkbox($data); ?>
				<p class="help-block">Some help text</p>
				
			</div>	
		</div>
		
		

		<!--
		<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary" data-bind="css: { 'has-spinner active' : $root.ajaxProcess}">
			<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
			Save changes</button>
		
		</div>-->
<?php echo form_close(); ?>
<script>
	//ko.applyBindings(VMSearchWidgetOptions, $('#widget_options_form').get(0) );
</script>





