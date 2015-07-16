<?php 
	
	
	//$server 		=  $this->config->item('server', 'search');
	
	
	
	
	$user_options	=  $this->search_model->get_options($setting.'_settings');
	$options		=  $this->application->get_config('query', 'search');
	$options		= array_merge($options, $user_options);
	
	
	
	$atts = array(
			'class' => 'form-horizontal',
			'data-bind' => 'submit: $root.SearchSettings.formSubmit', 
			'method' => 'POST',
			'onSubmit' => 'return false;',
			'id' => 'search_settings_form'
	);	
	$hidden 		= array('meta_key' => 'search_settings');
	
?>

<?php echo form_open( '/search/save_settings/', $atts, $hidden ); ?>
	<div class="box-body">
		
			<p class="lead"><?=lang('search_settings_description') ?></p>
			
			<div class="form-group">
				<label class="col-sm-3 control-label" for="action">action</label>
				<div class="col-sm-9">
				   <?php 
						$atts = 'class="selectpicker" data-bind=""';
						$actions 		=  $this->application->get_config('actions', 'search');
						echo form_dropdown('action', $actions, $options['action'], $atts);
					?>
					<p class="help-block">action</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="anylanguage">anylanguage</label>
				<div class="col-sm-9">
				   <?php $data = array(
							'name'        => 'anylanguage',
							'id'          => 'anylanguage',
							'value'       => 'true',
							'checked'     => $options['anylanguage'],
							'style'       => 'margin:10px',
							'class'		  => 'm-0 p-absolute',
							'data-bind'	  => 'BootstrapSwitch:{ size: \'mini\' }'
							);

						echo form_checkbox($data); ?>
					<p class="help-block">anylanguage</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="responseformat">ResponseFormat</label>
				<div class="col-sm-9">
				   <?php 
						$atts = 'class="selectpicker" data-bind=""';
						$responseformats=  $this->application->get_config('format', 'search') ;	
						echo form_dropdown('responseformat', $responseformats, $options['responseformat'], $atts);
					?>
					<p class="help-block">responseformat</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="databasematch">databasematch</label>
				<div class="col-sm-9">
				   <?php 
						$sources	=  $this->application->get_config('sources', 'search');
						$sources 	= array_merge( array(''=> 'All'), $sources);
						$atts = 'class="selectpicker form-control" data-bind="" multiple';
						echo form_dropdown('databasematch[]', $sources, $options['databasematch'], $atts);
					?>
					<p class="help-block">databasematch</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="text">text</label>
				<div class="col-sm-9">
				   <?php $data = array(
								  'name'        => 'text',
								  'id'          => 'text',							  
								  'class'		=> 'form-control',
								  'value'		=> $options['text'],
								  'placeholder'	=> '*'
								);

					echo form_input($data); ?>
					<p class="help-block">text</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="fieldtext">fieldtext</label>
				<div class="col-sm-9">
				   <?php $data = array(
								  'name'        => 'fieldtext',
								  'id'          => 'fieldtext',							  
								  'class'		=> 'form-control',
								  'value'		=> $options['fieldtext'],
								  'placeholder'	=> '*'
								);

					echo form_input($data); ?>
					<p class="help-block">fieldtext</p>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label" for="start">start</label>
				<div class="col-sm-9">
				   <?php $data = array(
								  'name'        => 'start',
								  'id'          => 'start',
								  
								  'class'		=> 'form-control w-auto',
								  'value'		=> $options['start'],
								  'placeholder'	=> 'start',
								  'type'		=> 'number'
								);

					echo form_input($data); ?>
					<p class="help-block">start</p>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label" for="maxresults">maxresults</label>
				<div class="col-sm-9">
				   <?php $data = array(
								  'name'        => 'maxresults',
								  'id'          => 'maxresults',							  
								  'class'		=> 'form-control w-auto',
								  'value'		=> $options['maxresults'],
								  'placeholder'	=> 'maxresults',
								  'type'		=> 'number'
								);

					echo form_input($data); ?>
					<p class="help-block">maxresults</p>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label" for="indexes">indexes</label>
				<div class="col-sm-9">
				   <?php 
						
						
						$elements = $this->document_lib->elements(null, array('action'=>'GetTagNames', 'fieldType' =>'index', 'responseformat'=>'json','text'=>'*'));
						$atts = 'class="form-control selectpicker" data-live-search="true" data-max-options="5" data-size="5" data-bind="" multiple';
						$selected = array_key_exists('indexes', $options)? $options['indexes'] : array();
						echo form_dropdown('indexes[]', $elements, $selected, $atts);
					?>
					<p class="help-block">indexes</p>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label" for="print">print</label>
				<div class="col-sm-9">
				   <?php 
						
						$print			=  $this->application->get_config('print', 'search') ;
						$atts 			= 'class="form-control selectpicker" data-live-search="true" data-max-options="5" data-size="5" data-bind="" multiple';
						$selected = array_key_exists('print', $options)? $options['print'] : array();
						echo form_dropdown('print[]', $print, $selected, $atts);
					?>
					<p class="help-block">print</p>
				</div>
			</div>
			
			
			<div class="form-group">
				<label class="col-sm-3 control-label" for="printfields">printfields</label>
				<div class="col-sm-9">
				   <?php 
				   
						$elements = $this->document_lib->elements(null, array('action'=>'GetTagNames', 'fieldType' => 'print', 'responseformat'=>'json','text'=>'*'));
						$atts = 'class="form-control selectpicker" data-live-search="true" data-max-options="5" data-size="5" data-bind="" multiple';
						$selected = array_key_exists('printfields', $options)? $options['printfields'] : array();
						echo form_dropdown('printfields[]', $elements, $selected, $atts);
					?>
					<p class="help-block">printfields</p>
				</div>
			</div>
			
			
			<div class="form-group">
				<label class="col-sm-3 control-label" for="highlight">highlight</label>
				<div class="col-sm-9">
				   <?php 
						
						$highlight		=  $this->application->get_config('highlight', 'search');
						$atts = 'class="selectpicker"  multiple data-bind=""';
						echo form_dropdown('highlight[]', $highlight, $options['highlight'], $atts);
					?>
					<p class="help-block">highlight</p>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label" for="mindate">mindate</label>
				<div class="col-sm-9">				
					<div class='input-group date' data-bind="BootstrapDateTimePicker:{format:'DD-MM-YYYY'}">
						 <?php $data = array(
								  'name'        => 'mindate',
								  'id'          => 'mindate',							  
								  'class'		=> 'form-control',
								  'value'		=> $options['mindate'],
								  'placeholder'	=> 'DD-MM-YYYY'
								);

						echo form_input($data); ?>
						<span class="input-group-addon">
							<span class="fa fa-calendar"></span>
						</span>
					</div>	
				  
					<p class="help-block">mindate</p>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label" for="maxdate">maxdate</label>
				<div class="col-sm-9">
				   <div class='input-group date' data-bind="BootstrapDateTimePicker:{ format:'DD-MM-YYYY' }">
						 <?php $data = array(
								  'name'        => 'maxdate',
								  'id'          => 'maxdate',							  
								  'class'		=> 'form-control',
								  'value'		=> $options['maxdate'],
								  'placeholder'	=> 'DD-MM-YYYY'
								);

						echo form_input($data); ?>
						<span class="input-group-addon">
							<span class="fa fa-calendar"></span>
						</span>
					</div>	
					<p class="help-block">maxdate</p>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label" for="minscore">minscore</label>
				<div class="col-sm-9">
				   <?php $data = array(
								  'name'        => 'minscore',
								  'id'          => 'minscore',							  
								  'class'		=> 'form-control',
								  'value'		=> $options['minscore'],
								);

					echo form_input($data); ?>
					<p class="help-block">minscore</p>
				</div>
			</div>
			
			
			<div class="form-group">
				<label class="col-sm-3 control-label" for="sort">sort</label>
				<div class="col-sm-9">
				   <?php 
						
						$sorts			=  $this->application->get_config('sorts', 'search') ;	
						$atts = 'class="selectpicker"  data-bind=""';
						echo form_dropdown('sort', $sorts, $options['sort'], $atts);
					?>
					<p class="help-block">sort</p>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label" for="totalresults">totalresults</label>
				<div class="col-sm-9">
				   <?php $data = array(
							'name'        => 'totalresults',
							'id'          => 'totalresults',
							'value'       => 'true',
							'checked'     => $options['totalresults'],
							'style'       => 'margin:10px',
							'class'		  => 'm-0 p-absolute',
							'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
							);

						echo form_checkbox($data); ?>
					<p class="help-block">totalresults</p>
				</div>
			</div>
			
			
			<div class="form-group">
				<label class="col-sm-3 control-label" for="starttag">starttag</label>
				<div class="col-sm-9">
				   <?php $data = array(
								  'name'        => 'starttag',
								  'id'          => 'starttag',							  
								  'class'		=> 'form-control',
								  'value'		=> $options['starttag']
								);

					echo form_input($data); ?>
					<p class="help-block">starttag</p>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label" for="endtag">endtag</label>
				<div class="col-sm-9">
				   <?php $data = array(
								  'name'        => 'endtag',
								  'id'          => 'endtag',							  
								  'class'		=> 'form-control',
								  'value'		=> $options['endtag']
								);

					echo form_input($data); ?>
					<p class="help-block">endtag</p>
				</div>
			</div>
			
			
			<div class="form-group">
				<label class="col-sm-3 control-label" for="summary">summary</label>
				<div class="col-sm-9">
				   <?php 
						$summary =  $this->application->get_config('summary', 'search') ;
						$atts = 'class="selectpicker"  data-bind=""';
						echo form_dropdown('summary', $summary, $options['summary'], $atts);
					?>
					<p class="help-block">summary</p>
				</div>
			</div>
			
	
	</div>
	
	<div class="box-footer text-center">
		<button type="submit" class="btn btn-primary" data-bind="css: { 'has-spinner active' : $root.SearchSettings.ajaxProcess}">
		<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
		Save changes</button>
	</div>
	
<?php echo form_close(); ?>