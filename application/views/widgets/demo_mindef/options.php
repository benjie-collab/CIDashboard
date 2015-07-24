<?php 	
/*
* Received Parameters:
* 	$widget_key
*/
	
$options 	= $this->application->get_settings($widget_key);	

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
$hidden 		= array('meta_key' => $widget_key);	

$ts 		= generate_timestamp();		
echo form_open( 'app/widget_options', $atts, $hidden ); ?>
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
					$data_options= array_get_value($options, 'data');
					$data_config= $this->application->get_config('query', 'actions');
					$settings= array(
									'detectlanguagetype',
									'endtag',
									'highlight',
									'languagetype',
									'predict',
									'print',
									'querysummary',
									'sort',
									'starttag',
									'summary',
									'timeoutms',
									'totalresults'
								);
					$data_config = elements( $settings, $data_config);
				?>
				
				
			
					<?php 			
					foreach($data_config as $name=>$default){
					?>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="data_<?=$name?>"><?=$name?></label>
						<?php $checkbox = strcasecmp('true', $default) === 0 || strcasecmp('false', $default) === 0;?>
						<div class="col-sm-9 <?=$checkbox?'checkbox': ''?>">
						   <?php
							if( $checkbox ){
								$value = array_key_exists($name, $data_options)? element($name, $data_options) : $default;
							?>
								<input type="hidden" value="false" name="data[<?=$name?>]"/>
								<?php $data = array(
									'name'        => 'data[' . $name . ']',
									'id'          => 'data_'.$name,
									'value'       => 'true',
									'checked'     => strcasecmp('true', $value) == 0,
									'style'       => 'margin:10px',
									'class'		  => 'm-0 p-absolute',
									'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
									);
								echo form_checkbox($data); 
							
							}else{
							
								$value = array_key_exists($name, $data_options)? element($name, $data_options) : $default;
							
								if(element($name, $action_options)){ // dropdown select
								
									$atts = 'class="" data-bind="BootstrapSelect:{}"';							
									echo form_dropdown('data[' . $name . ']', element($name, $action_options),  $value, $atts);			
									
								}elseif(strcasecmp('databasematch', $name) === 0 ){
									$databases	= $this->application->get_databases($search_settings);
									$databases	= element('database', $databases );
									$dbs = array();
									if($databases)
									foreach( $databases as $key=>$db){
										$dbs[element('name',$db)] =  element('name',$db) . ' (' . element('documents',$db) . ')';
									}						
									
									$dbs 	= array_merge( array(''=> 'All'), $dbs);
									$atts = 'class="selectpicker form-control" data-bind="BootstrapSelect:{}" multiple';
									echo form_dropdown( 'data[' .$name.'][]', $dbs, $value, $atts);
								
								}else{
									$data = array(
											  'name'        => 'data[' . $name . ']',
											  'id'          => 'data_' . $name,							  
											  'class'		=> 'form-control',
											  'value'		=>  $value
											);
									echo form_input($data);
								}
							}?>
							<p class="help-block"><?=lang('query_'.$name)?></p>
						</div>
					</div>
					<?php		
					}
					?>
			</div>
		</div>
	</div>
<?php echo form_close(); ?>