<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/nav'); ?>
<?php $this->load->view('template/aside'); ?>

<?php 

$method = $this->router->fetch_method();
$pages = $this->application->get_methods('application/views/settings/pages/', $method);

if(!$page)
$page = element('@title',$pages[0]);
?>

 <div class="content-wrapper">	
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1 class="page-header">Settings and Configuration
		<small>Here you customize the settings of your applications and widgets. Otherwise, default will be uses.</small>
	  </h1>
	  <?=$this->template_model->get_breadcrumb() ?>
	</section>	
	
	<section class="content">		
		<div class="row">
			<div class="col-md-7">
				<div class="p-relative">
					<div class="nav-tabs-custom droppable-active">
						<ul class="nav nav-tabs pull-right" data-bind="ScrollToFixed:{ marginTop: 51 }">						
							
							<?php 
								foreach($pages as $key=>$tab):
							?>
								<li class=" <?=strcasecmp($page, element('@title', $tab))===0? 'active': '' ?>">
									<a  href="<?=base_url('settings/'. $method . '/' . element('@title', $tab))?>" >
									<i class="fa <?=element('@icon', $tab)?>"></i>
									<?=element('@title', $tab)?></a>
								</li>						
							<?php
								endforeach;
							?>						
						</ul>				
					
					<?php $this->load->view( 'settings/pages/' . $page);?>					  
					</div>
					<?php if(!isset($server_status) ||  !$server_status) :?>
					<div class="drop-here-helper d-block">
						<div class="p-relative">
							<span class="ion-minus-circled"></span>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
			
			<div class="col-md-5">	
					
					<div class="box box-solid bg-red-gradient">
						<div class="box-header">
						  <h3 class="box-title">Server Configuration</h3>
						</div><!-- /.box-header -->
						<?php 
						$server 	 =  $this->application->get_config('server', 'status');
						$server 	 = array_merge($server , $this->search_model->get_options('server_status'));
						$atts = array(
								'class' => '',
								'data-bind' => 'submit: $root.Settings.connect', 
								'method' => 'POST',
								'onSubmit' => 'return false;',
								'id' => ''
						);						
						$hidden 		= array('meta_key' => 'server_settings');						
						echo form_open( 'settings/connect?'  , $atts ); ?>
						<div class="box-body">	
							<div class="form-group">
								<label class="" for="text">Server Url</label>
								
							   <?php $data = array(
											  'name'        => 'url',
											  'id'          => 'url',							  
											  'class'		=> 'form-control',
											  'value'		=> element('url',$server),
											  'placeholder'	=> 'http://'
											);

								echo form_input($data); ?>
							</div>
							<div class="form-group">
								<label class="" for="text">Server Port</label>
								
							   <?php $data = array(
											  'name'        => 'port',
											  'id'          => 'port',							  
											  'class'		=> 'form-control',
											  'value'		=> element('port',$server),
											  'placeholder'	=> '8000'
											);

								echo form_input($data); ?>
							</div>
						</div>
						<div class="box-footer text-center">
							<button type="submit" class="btn btn-danger btn-flat" data-bind="css: { 'has-spinner active' : $root.Settings.ajaxProcess}">
							<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
							Apply changes</button>
						</div>
						
						
						<?php echo form_close(); ?>						
					</div>
					
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs pull-right ui-sortable-handle">
							<li class="active"><a data-toggle="tab" href="#server-info-tab-1">Statistics</a></li>
							<li><a data-toggle="tab" href="#server-info-tab-2">Info</a></li>
							<li class="pull-left header"><i class="fa fa-inbox"></i> Server Information</li>
						</ul>
						<div class="tab-content">
						  <div style="" id="server-info-tab-1" class="tab-pane active">
							<?php 
							if(isset($server_status)){
								if($server_status){	
								
								$responsedata = get_responsedata($server_status);
								
						?>
							<h3 class="text-black m-0 m-b-10">Databases</h3>
							<div class="row">							
							
								<?php 
									$databases = element('databases', $responsedata);
									$database = element('database', $databases);
									
									if($database){
									foreach($database as $i=>$db):
								?>
									<div class="col-xs-4 text-center">
										<div class="widget m-0" style="height: 60px; width: 60px; display: inline-block;" data-bind="SettingsBarGauge:{
											startValue: 0,
											label: { visible: false },
											endValue: 50000,
											barSpacing: 1,
											values: [<?=element('documents', $db)?>, <?=element('sections', $db)?>],
											geometry: {
												endAngle: -90,
												startAngle: 270
											}
										}">								
										</div>
										<h3 class="m-0 text-black"><?=element('documents', $db)?></h3>
										<div class="knob-label"><?=element('name', $db)?></div>
									</div>								
								<?php								
									endforeach;			
									}									
								?>
							</div>
						<?php 
								}else{
									echo $this->application->get_config('error_start_delimiter', 'template') . lang('server_setting_error') . $this->application->get_config('error_end_delimiter', 'template');
								}
							}else{
							
								echo $this->application->get_config('error_start_delimiter', 'template') . lang('server_setting_error') . $this->application->get_config('error_end_delimiter', 'template');
							}
						?>
						  </div>
						  <div style="" id="server-info-tab-2" class="tab-pane ">
							<?php 
							if(isset($server_status) && $server_status){
									?>
										<div data-bind="SlimScroll: { 
														position: 'right', 
														height: 500, 
														size: '5px',  
														railOpacity: 0.3,
														wheelStep: 10,
														allowPageScroll: false}">
									<?php
									$responsedata = get_responsedata($server_status);
									
									foreach($responsedata as $k=>$a):
										echo('<ul class="list-unstyled">');
										echo('<li>');
										if(!is_string($a)){	
											echo ('<h5 class="text-capitalize">' . $k . '</h5>');
											echo('<ul class="list-unstyled m-l-20">');
												foreach($a as $l=>$b):
													if(!is_string($b)){	
														echo ('<h5 class="text-capitalize">' . $l . '</h5>');
														echo('<ul class="list-unstyled m-l-40">');
															foreach($b as $m=>$c):
																if(!is_string($c)){	
																	if(is_int($m))
																		echo ('---');
																	else
																		echo ('<h5 class="text-capitalize">' . $m . '</h5>');
																	
																	echo('<ul class="list-unstyled m-l-60">');
																		foreach($c as $n=>$d):
																			if(!is_string($d)){	
																			?>
																				<div class="input-group input-group-sm m-b-5">
																					<div class="input-group-btn">
																						<button class="btn btn-primary" type="button"><?=$n?></button>
																					</div><!-- /btn-group -->
																					<input type="text" class="form-control"  value="---"/>
																				</div>											
																			<?php
																			}else{	
																			?>
																				<div class="input-group input-group-sm m-b-5">
																					<div class="input-group-btn">
																						<button class="btn btn-primary" type="button"><?=$n?></button>
																					</div><!-- /btn-group -->
																					<input type="text" class="form-control"  value="<?=$d?>"/>
																				</div>											
																			<?php
																			}
																		endforeach;	
																	echo('</ul>');
																}else{	
																?>
																	<div class="input-group input-group-sm m-b-5">
																		<div class="input-group-btn">
																			<button class="btn btn-primary" type="button"><?=$m?></button>
																		</div><!-- /btn-group -->
																		<input type="text" class="form-control"  value="<?=$c?>"/>
																	</div>											
																<?php
																}
															endforeach;	
														echo('</ul>');
													}else{	
													?>
														<div class="input-group input-group-sm m-b-5">
															<div class="input-group-btn">
																<button class="btn btn-primary" type="button"><?=$l?></button>
															</div><!-- /btn-group -->
															<input type="text" class="form-control"  value="<?=$b?>"/>
														</div>											
													<?php
													}
												endforeach;											
											echo('</ul>');
										}else{												
											?>											
											<div class="input-group input-group-sm m-b-5">
												<div class="input-group-btn">
													<button class="btn btn-primary" type="button"><?=$k?></button>
												</div><!-- /btn-group -->
												<input type="text" class="form-control"  value="<?=$a?>"/>
											</div>
											<?php
										}
										echo('</li>');
										echo('</ul>');
									endforeach;	
							?>
								</div>
							<?php						
							}else{								
									echo $this->application->get_config('error_start_delimiter', 'template') . lang('server_setting_error') . $this->application->get_config('error_end_delimiter', 'template');
								}	
							
							?>
						  </div>
						</div>
					</div>
				  
					
			</div>
			
			
			
		</div>
	</section>
	
	
</div>
<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/footer_scripts'); ?>
