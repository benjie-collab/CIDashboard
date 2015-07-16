<?php 
/*
* @Title: Search
* @Method: Search
* @icon: fa-search fa
*/ 
?>

<?php 
$atts = array(
		'class' => 'form-horizontal',
		'data-bind' => 'submit: $root.Settings.formSubmit', 
		'method' => 'POST',
		'onSubmit' => 'return false;',
		'id' => ''
);	
$hidden 		= array('meta_key' => 'settings_search');
?>
<section class="content-header">
  <h1>
	<?php echo lang('search_settings_heading');?>
	<small><?php echo lang('search_settings_subheading');?></small>
  </h1>
   <?=$this->application->breadcrumb()?>
</section>

<section class="content">
	<?=$message?>	
	
	<?php echo form_open( '/settings', $atts, $hidden ); ?>		
		<div class="form-group">		
			<label class="col-sm-2 control-label" for="server">Server</label>
		   <?php 
				$value = element('server',$settings);
				$servers = $this->servers_model->get_servers();		
			?>
			<div class="col-sm-7">
			<select name="server" id="server"
				class="selectpicker" title="Please select server">
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
		</div>	

		<div class="form-group">		
			<label class="col-sm-2 control-label" for="template">Template</label>
			<div class="col-sm-7">
				<?php 		
					$templates = $this->application->get_templates('application/views/search/templates/index/');			
					$atts = 'class="selectpicker" 
					data-bind="BootstrapSelect:{}"';
					echo form_dropdown('template', $templates, element('template', $settings), $atts);
				?>
				<p class="help-block">Some help text</p>	
			</div>
		</div>
		
		
		<div data-bind="ScrollToFixed:{ bottom: 0, limit: $('#edit-mode-helper').offset().top}" id="edit-mode-helper" class="bg-gray p-10 row" >		
			<div class="col-sm-10 col-sm-offset-2">	
				<button type="submit" class="btn btn-primary btn-flat" data-bind="css: { 'has-spinner active' : $root.Settings.ajaxProcess}">
				<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
				Save Changes</button>					
			</div>		
		</div>
		
		
	<?php echo form_close(); ?>	
</section>

