<?php 
/*
* @Title: TermExpand
* @Method: Term
* @icon: fa-search fa
*/ 
?>
<?php 
		
	$av_options = $this->application->get_config('options', 'actions');
	$options	=  $this->search_model->get_options('settings_term_termexpand');
	$config		=  $this->application->get_config('termexpand', 'actions');
	$options	= array_merge($config, $options);	
	
	
	$atts = array(
			'class' => 'form-horizontal',
			'data-bind' => 'submit: $root.SearchSettings.formSubmit', 
			'method' => 'POST',
			'onSubmit' => 'return false;',
			'id' => 'settings_term_termexpand_form'
	);	
	$hidden 		= array('meta_key' => 'settings_term_termexpand');
	
?>

<?php echo form_open( '/settings', $atts, $hidden ); ?>
	<div class="box-body">
		
			<p class="lead"><?=lang('suggest_description') ?></p>			
			
			<?php 
			
			foreach($config as $name=>$default){
			?>
			<div class="form-group">
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
					<p class="help-block"><?=lang('suggest_'.$name)?></p>
				</div>
			</div>
			<?php		
			}
			?>
			
			<!--
			
			<div class="form-group">
				<label class="col-sm-3 control-label" for="action">action</label>
				<div class="col-sm-9">
				   <?php 
						$atts = 'class="selectpicker" disabled data-bind=""';
						$actions 		=  $this->application->get_config('actions', 'search');
						echo form_dropdown('action', $actions, element('action', $options) , $atts);
					?>
					<p class="help-block">action</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="anylanguage">anylanguage</label>
				<div class="col-sm-9">
					<input type="hidden" value="0" name="anylanguage"/>
					<?php $data = array(
						'name'        => 'anylanguage',
						'id'          => 'anylanguage',
						'value'       => '1',
						'checked'     => intval(element('anylanguage', $options)) === 1,
						'style'       => 'margin:10px',
						'class'		  => 'm-0 p-absolute',
						'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
						);
					echo form_checkbox($data); ?>
					
					<p class="help-block">anylanguage</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="responseformat">ResponseFormat</label>
				<div class="col-sm-9">
				   <?php 
						$atts = 'class="selectpicker" disabled  data-bind=""';
						$responseformats=  $this->application->get_config('format', 'search') ;	
						echo form_dropdown('responseformat', $responseformats, element('responseformat', $options) , $atts);
					?>
					<p class="help-block">responseformat</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="databasematch">databasematch</label>
				<div class="col-sm-9">
				   <?php 
						$databases	= $this->application->get_databases();
						$databases	= element('database', $databases );
						$dbs = array();
						if($databases)
						foreach( $databases as $key=>$db){
							$dbs[element('name',$db)] =  element('name',$db) . ' (' . element('documents',$db) . ')';
						}						
						
						$dbs 	= array_merge( array(''=> 'All'), $dbs);
						$atts = 'class="selectpicker form-control" data-bind="" multiple';
						echo form_dropdown('databasematch[]', $dbs, element('databasematch', $options), $atts);
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
								  'value'		=> element('text', $options),
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
								  'value'		=> element('fieldtext', $options), 
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
								  'value'		=> element('start', $options), 
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
								  'value'		=> element('maxresults', $options), 
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
						$elements = $this->document_lib->elements(null, array('action'=>'GetTagNames', 'responseformat'=>'json','text'=>'*', 'FieldType' => 'INDEX'), false);
						$atts = 'class="form-control selectpicker" data-live-search="true" data-max-options="5" data-size="5" data-bind="" multiple';
						$selected = array_key_exists('indexes', $options)? element('indexes', $options) : array();
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
						$selected = array_key_exists('print', $options)? element('print', $options) : array();
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
						$selected = array_key_exists('printfields', $options)? element('printfields', $options) : array();
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
						echo form_dropdown('highlight[]', $highlight, element('highlight', $options) , $atts);
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
								  'value'		=> element('mindate', $options),
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
								  'value'		=> element('maxdate', $options) ,
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
					<div class="dark-slider" >
						<input type="text" name="minscore" class=""	data-slider-value="<?=element('minscore', $options)?>"
						data-slider-orientation="horizontal" 
						data-bind="BootstrapSlider: {
							ticks: [50, 60, 70, 80, 90, 100],
							ticks_labels: ['100%','90%','80%','70%','60%','50%'],
							ticks_snap_bounds: 1,
							tooltip: 'always',
							reversed: true
						}"/>
					</div>				
					<p class="help-block">minscore</p>
				</div>
			</div>
			
			
			<div class="form-group">
				<label class="col-sm-3 control-label" for="sort">sort</label>
				<div class="col-sm-9">
				   <?php 
						
						$sorts			=  $this->application->get_config('sorts', 'search') ;	
						$atts = 'class="selectpicker"  data-bind=""';
						echo form_dropdown('sort', $sorts, element('sort', $options), $atts);
					?>
					<p class="help-block">sort</p>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label" for="totalresults">totalresults</label>
				<div class="col-sm-9">
					<input type="hidden" value="0" name="totalresults"/>
					<?php $data = array(
						'name'        => 'totalresults',
						'id'          => 'totalresults',
						'value'       => '1',
						'checked'     => intval(element('totalresults', $options)) === 1,
						'style'       => 'margin:10px',
						'class'		  => 'm-0 p-absolute',
						'data-bind'	  => 'BootstrapSwitch:{ size: \'mini\' }'
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
								  'value'		=> element('starttag', $options)
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
								  'value'		=>  element('endtag', $options) 
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
						echo form_dropdown('summary', $summary, element('summary', $options)  , $atts);
					?>
					<p class="help-block">summary</p>
				</div>
			</div>-->
			
	
	</div>
	
	<div class="box-footer text-center" id="settings-page" data-bind="ScrollToFixed:{ bottom: 0, limit: $('#settings-page').offset().top}">
		<button type="submit" class="btn btn-warning btn-flat" data-bind="css: { 'has-spinner active' : $root.SearchSettings.ajaxProcess}">
		<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
		Restore Defaults</button>
		<button type="submit" class="btn btn-primary btn-flat" data-bind="css: { 'has-spinner active' : $root.SearchSettings.ajaxProcess}">
		<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
		Save changes</button>
	</div>
	
<?php echo form_close(); ?>