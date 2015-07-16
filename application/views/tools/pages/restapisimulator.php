<?php 
/*
* @Title: Rest API Simulator
* @Method: restapisimulator
* @icon: fa-circle-o fa
*/ 
?>

<div class="row">
	<div class="col-md-5 col-sm-12">
		<div class="box box-primary">
			<div class="box-header">
			  <h3 class="box-title">Fill in necessary fields</h3>
			</div>
		<?php 
			$options = $this->application->get_config('options', 'actions');
			$servers = $this->servers_model->get_servers();
			$server  = isset($server)? $server : null;
			$atts = array(
						'class' => 'form-horizontal',
						'data-bind' => 'submit: $root.RestAPISimulator.formSubmit', 
						'method' => 'POST',
						'onSubmit' => 'return false;',
						'id' => ''
				);	
				$hidden 	= array();
				$ts 		= generate_timestamp();		
			?>

			<?php echo form_open( '/tools/restapisimulator', $atts, $hidden ); ?>
				<div class="box-body">					
					<div class=""  data-bind="jQueryQuickSearch: { 
							input_selector: '#<?=$ts?>-input', 
							elements_to_search: 'ul#<?=$ts?>-list li', 
							loader: '#<?=$ts?>-spinner',
							noResults: 'ul#<?=$ts?>-list li.noresults'
						} ">	
							
							<ul class="list-unstyled" id="<?=$ts?>-list">
								<li class="noresults item">No results found...</li>
								
								
								
								<li class="form-group">
									<label class="col-sm-3 control-label" for="server">Server</label>
									<div class="col-sm-9">	
										<select name="server" id="server"
											class="selectpicker btn-group-sm" data-style="btn-warning"  title="Please select server">
											<?php 
												foreach($servers as $k=>$srvr):
												$selected = strcasecmp($server, element('server', $srvr))==0 ? 'selected' : '';
												echo '<option value="' . element('server', $srvr)  . '" ' . $selected . '>' . element('server', $srvr) . '</option>';
												endforeach;				
											?>	
										</select>
										<?php
										if($this->users->is_admin())
										echo anchor('servers/add', '<i class="fa fa-plus-circle"></i>', array('class'=>'btn btn-default btn-sm btn-flat', 'target'=>'_blank'))?>								
									</div>
									<hr/>
								</li>
								
								
								
						
								<?php 			
								foreach($action as $name=>$default){
								$boolean = ( strcasecmp('true', $default) == 0 || strcasecmp('false', $default) == 0  );
								?>
								<li class="form-group">
									<label class="col-sm-3 control-label" for="<?=$name?>"><?=$name?></label>
									<div class="col-sm-9 <?=$boolean? 'checkbox' : ''?>">
									   <?php
										if($boolean){
											
										?>
											<input type="hidden" value="false" name="<?=$name?>"/>
											<?php $data = array(
												'name'        => $name,
												'id'          => $name,
												'value'       => 'true',
												'checked'     => strcasecmp('true', $default) == 0,
												'style'       => 'margin:10px',
												'class'		  => 'm-0 p-absolute',
												'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
												);
											echo form_checkbox($data); 
										
										}else{
										
										
											if(element($name, $options)){ // dropdown select
											
												$atts = 'class="selectpicker btn-group-sm" data-bind=""';							
												echo form_dropdown($name, element($name, $options),  $default, $atts);			
												
											}elseif(strcasecmp('action', $name) === 0 ){
											
												$atts = 'class="btn-group-sm" data-style="btn-warning" data-bind="BootstrapSelect:{},				
														event: { change: function(e,f){ 
															var value= $(f.currentTarget).val();
															window.location= \'' . base_url('tools/restapisimulator'). '/\' + value
														}}"';				
												echo form_dropdown($name, $actions,  $default, $atts);	
											
											}elseif(strcasecmp('databasematch', $name) === 0 ){
												$server = isset($server) && !$server ? $server:  element('server', $servers[0]);
												$databases	= $this->application->get_databases(array('server'=> $server));
												$databases	= element('database', $databases );
												$dbs = array();
												if($databases)
												foreach( $databases as $key=>$db){
													$dbs[element('name',$db)] =  element('name',$db) . ' (' . element('documents',$db) . ')';
												}						
												
												$dbs 	= array_merge( array(''=> 'All'), $dbs);
												$atts = 'class="selectpicker form-control" data-bind="" multiple';
												echo form_dropdown( $name.'[]', $dbs, $default, $atts);
											
											}else{
												$data = array(
														  'name'        => $name,
														  'id'          => $name,							  
														  'class'		=> 'form-control input-sm',
														  'value'		=>  $default
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
						<input type="text" id="<?=$ts?>-input" class="form-control" placeholder="Find option..."/>	
						<span class="form-control-feedback typeahead-spinner" id="<?=$ts?>-spinner"><i class="fa fa fa-spinner fa fa-spin text-muted"></i></span>
					</div>
					<button type="Reset" class="btn btn-warning btn-flat ">
					Reset</button>
					<button type="submit" class="btn btn-primary btn-flat" data-bind="css: { 'has-spinner active' : $root.RestAPISimulator.ajaxProcess}">
					<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
					Submit</button>
				</div>
				
			<?php echo form_close(); ?>
	</div>	
	</div>
	<div class="col-md-7 col-sm-12">
		<div class="box box-solid bg-black-gradient " id="tools-server-response" 
			data-bind="ScrollToFixed:{ marginTop: 45}"
		>
			<div class="box-header">
			  <h3 class="box-title">Server Response</h3>
			</div>		
			
			<div class="max-height-420 clearfix box-body"
				data-bind="CustomScrollbar: { 
					axis:'y', 
					theme:'light', 
					autoExpandScrollbar:true,
					advanced:{
						autoExpandHorizontalScroll:true
						}
				}">
				<div data-bind="JSONView: $root.RestAPISimulator.responseData" class="">
				</div>
			</div>	
			<div class="box-footer no-border">
				<ul class="m-0 list-inline">
					<li><button class="btn btn-default btn-sm btn-flat" id="server-response-collapse-btn">Collapse</button></li>
					<li><button class="btn btn-default btn-sm btn-flat" id="server-response-expand-btn">Expand</button></li>
					<li><button class="btn btn-default btn-sm btn-flat" id="server-response-toggle-btn">Toggle</button></li>
					<li><button class="btn btn-default btn-sm btn-flat" id="server-response-toggle-level1-btn">Toggle level1</button></li>
					<li><button class="btn btn-default btn-sm btn-flat" id="server-response-toggle-level2-btn">Toggle level2</button></li>
					<li class="pull-right">
						<button class="btn btn-warning btn-sm btn-flat " data-bind="click: $root.RestAPISimulator.clearResponseData"
						>Clear Response</button>
					</li>
				</ul
			</div>
		</div>
	</div>
</div>
	





