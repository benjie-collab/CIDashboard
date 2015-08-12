<?php 	
/*
* Received Parameters:
* 	$widget_key
*/
	
$options 	= $this->widgets_model->get_widgetoptions($widget_key);	

$action_options= $this->application->get_config('options', 'actions');
$current_search = $this->application->get_session_userdata('current_search');	
$search_settings =$this->application->get_session_userdata('search_settings');


	
	
/** Form attributes with some Knockoutjs bindings for submission. **/
$atts = array(
		'class' => 'form-horizontal',
		'data-bind' => 'submit: $root.formSubmit', 
		'method' => 'POST',
		'onSubmit' => 'return false;',
		'id' => 'widget_options_form'
);
/** Add meta_key for options form recognition **/
//$hidden 		= array('meta_key' => $widget_key);	
$page = $this->session->userdata('current_page');
$ts 		= generate_timestamp();		
echo form_open( 'app/widget_options/' . urlencode( $widget_key ) . '/' . $page->id , $atts); ?>
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs pull-right">
		  <li class="active"><a data-toggle="tab" data-target="#options-tab-1" href="javascript:void(0)">Display</a></li>
		  <li class=""><a data-toggle="tab" data-target="#options-tab-2" href="javascript:void(0)">Data</a></li>
		 
		</ul>
		<div class="tab-content p-0 p-t-20">
			<div id="options-tab-1" class="tab-pane active">
				<?php $this->load->view('widgets/widget-options-basic', $options);?>
			</div>
			
			<div id="options-tab-2" class="tab-pane">
				<?php 					
					$data_options = element('data', $options);
				?>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="data_server">Server</label>
					<div class="col-sm-9">
						<?php 
						$servers = $this->servers_model->get_servers();
						$value = element('server', $data_options);
						?>	
						<select name="data[server]" id="data_server"
						class="form-control" data-bind="BootstrapSelect:{}">
						<option data-hidden="true" value="">-- Select one --</option>
						<?php 
							foreach($servers as $k=>$server):	
							$selected = strcasecmp($value, element('id', $server) )==0 ? 'selected' : '';
							echo '<option value="' . element('id', $server)  . '" ' . $selected . '>' . element('server', $server) . '</option>';
							endforeach;				
						?>	
						</select>
										  
						<p class="help-block">Some help text.</p>
					</div>
				</div>
				<?php 					
					$data_parameters = array_key_exists('parameters', $data_options)? element('parameters', $data_options): array();
				?>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="parameter_format">Format</label>
					<div class="col-sm-9">
						<?php 
						$formats = element('responseformat', $action_options);
						$value = element('format', $data_parameters);
						?>	
						<select name="data[parameters][format]" id="data_server"
						class="form-control" data-bind="BootstrapSelect:{}">
						<?php 
							foreach($formats as $k=>$format):	
							$selected = strcasecmp($value, $format )==0 ? 'selected' : '';
							echo '<option value="' . $format  . '" ' . $selected . '>' . $format . '</option>';
							endforeach;				
						?>	
						</select>								  
						<p class="help-block">Some help text.</p>
					</div>
				</div>
				
			</div>
			
			
			
				
		</div>
	</div>
<?php echo form_close(); ?>