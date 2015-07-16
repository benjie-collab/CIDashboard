<?php 
$widget_options = $this->config->item('widget_options', 'template');
?>

<div class="form-group">
	<label class="col-sm-3 control-label" for="title">Widget Title</label>				
	<div class="col-sm-9" >		
	   <?php $data = array(
			'name'        => 'title',
			'id'          => 'title',
			'value'       => isset($title)? $title: '',
			'class'		  => 'form-control'
			);
		echo form_input($data); ?>
		<p class="help-block">Only applicable for widgets.</p>
		
	</div>	
</div>
<div class="form-group">
	<label class="col-sm-3 control-label" for="widgetize">Widgetize</label>				
	<div class="col-sm-9" >		
		<input type="hidden" name="widgetize" value="0"/>
	   <?php $data = array(
			'name'        => 'widgetize',
			'id'          => 'widgetize',
			'value'       => true,
			'checked'     => isset($widgetize)? ($widgetize==1): false,
			'style'       => 'margin:10px',
			'class'		  => 'm-0 p-absolute',
			'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
			);

		echo form_checkbox($data); ?>
		<p class="help-block">Some help text</p>							
	</div>	
</div>

<div class="form-group">
	<label class="col-sm-3 control-label" for="icon">Icon</label>				
	<div class="col-sm-9" >	
		<div class="input-group">
			<?php $data = array(
				'name'        => 'icon',
				'id'          => 'icon',
				'value'       => isset($icon)? $icon: 'fa-android', 
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
		<?php					
		$bg = isset($bgcolor)? $bgcolor: '';	
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
			$size = isset($size)? $size: '';
			$atts = 'class="selectpicker" data-bind="BootstrapSelect:{}"';
			echo form_dropdown('size', $widget_options['size'], $size, $atts);
		?>
		<p class="help-block">Some help text</p>
	</div>
</div>