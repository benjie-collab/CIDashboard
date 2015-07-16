<?php 
/*
* @Title: Query
* @Method: Query
* @icon: fa-search fa
*/ 
?>
<?php 
		
	$av_options = $this->application->get_config('options', 'actions');
	$options	=  $this->search_model->get_options('settings_query_query');
	$config		=  $this->application->get_config('query', 'actions');
	$options	= array_merge($config, $options);	
	
	
	$atts = array(
			'class' => 'form-horizontal',
			'data-bind' => 'submit: $root.SearchSettings.formSubmit', 
			'method' => 'POST',
			'onSubmit' => 'return false;',
			'id' => 'settings_query_query_form'
	);	
	$hidden 	= array('meta_key' => 'settings_query_query');
	$ts 		= generate_timestamp();		
?>

<?php echo form_open( '/settings', $atts, $hidden ); ?>
	<div class="box-body">
		
		<p class="lead"><?=lang('query_description') ?></p>
		
		<div class=""  data-bind="jQueryQuickSearch: { 
				input_selector: '#<?=$ts?>-input', 
				elements_to_search: 'ul#<?=$ts?>-list li', 
				loader: '#<?=$ts?>-spinner',
				noResults: 'ul#<?=$ts?>-list li.noresults'
			} ">	
				
				<ul class="list-unstyled" id="<?=$ts?>-list">
					<li class="noresults item">No results found...</li>
			
					<?php 			
					foreach($config as $name=>$default){
					?>
					<li class="form-group">
						<label class="col-sm-3 control-label" for="<?=$name?>"><?=$name?></label>
						<div class="col-sm-9">
						   <?php
							if( strcasecmp('true', $default) === 0 || strcasecmp('false', $default) === 0  ){
								$value = array_key_exists($name, $options)? element($name, $options) : $default;
							?>
								<input type="hidden" value="false" name="<?=$name?>"/>
								<?php $data = array(
									'name'        => $name,
									'id'          => $name,
									'value'       => 'true',
									'checked'     => strcasecmp('true', $value) == 0,
									'style'       => 'margin:10px',
									'class'		  => 'm-0 p-absolute',
									'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
									);
								echo form_checkbox($data); 
							
							}else{
							
								$value = array_key_exists($name, $options)? element($name, $options) : $default;
							
								if(element($name, $av_options)){ // dropdown select
								
									$atts = 'class="selectpicker" data-bind=""';							
									echo form_dropdown($name, element($name, $av_options),  $value, $atts);			
									
								}elseif(strcasecmp('databasematch', $name) === 0 ){
								
									$databases	= $this->application->get_databases();
									$databases	= element('database', $databases );
									$dbs = array();
									if($databases)
									foreach( $databases as $key=>$db){
										$dbs[element('name',$db)] =  element('name',$db) . ' (' . element('documents',$db) . ')';
									}						
									
									$dbs 	= array_merge( array(''=> 'All'), $dbs);
									$atts = 'class="selectpicker form-control" data-bind="" multiple';
									echo form_dropdown( $name.'[]', $dbs, $value, $atts);
								
								}else{
									$data = array(
											  'name'        => $name,
											  'id'          => $name,							  
											  'class'		=> 'form-control',
											  'value'		=>  $value
											);
									echo form_input($data);
								}
							}?>
							<p class="help-block"><?=lang('query_'.$name)?></p>
						</div>
					</li>
					<?php		
					}
					?>
				</ul>
		</div>	
	</div>	
	<div class="box-footer" id="settings-page" data-bind="ScrollToFixed:{ bottom: 0, limit: $('#settings-page').offset().top}">
		<div class="form-group has-feedback pull-right m-0">
			<input type="text" id="<?=$ts?>-input" class="form-control" placeholder="Filter..."/>	
			<span class="form-control-feedback typeahead-spinner" id="<?=$ts?>-spinner"><i class="fa fa fa-spinner fa fa-spin text-muted"></i></span>
		</div>
		<button type="submit" class="btn btn-warning btn-flat " data-bind="css: { 'has-spinner active' : $root.SearchSettings.ajaxProcess}">
		<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
		Restore Defaults</button>
		<button type="submit" class="btn btn-primary btn-flat" data-bind="css: { 'has-spinner active' : $root.SearchSettings.ajaxProcess}">
		<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
		Save changes</button>
	</div>
	
<?php echo form_close(); ?>