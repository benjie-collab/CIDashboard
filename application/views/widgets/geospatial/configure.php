<?php 
	$statistics = $this->statistics_model->get_statistic($widget_key);
	$config = unserialize(element('widget_settings',$statistics));
	$av_options = $this->application->get_config('options', 'statistics');
	

	$hidden = array(
				'widget_key' => $widget_key,
				'data[text]' => '*',
				'visual[scrollwheel]' => false,
				'visual[disableDefaultUI]' => false,
				'visual[panControl]' => false,
				'visual[zoomControl]' => false,
				'visual[mapTypeControl]' => false,
				'visual[scaleControl]' => false,
				'visual[streetViewControl]' => false,
				'visual[overviewMapControl]' => false
			);
	$atts = array(
			'class' => 'form',
			'data-bind' => 'submit: $root.formSubmit', 
			'method' => 'POST',
			'onSubmit' => 'return false;',
			'id' => 'widget_options_form'
	);		 	
	
	$config_data= array_key_exists('data',$config)? element('data',$config) : array();
	$config_visual= array_key_exists('visual',$config)? element('visual',$config) : array();
	
	echo form_open('statistics/configure', $atts, $hidden);	
	?>
	
	<div class="nav-tabs-custom text-black m-0">
	
		<ul class="nav nav-tabs pull-right ">
			<li class="pull-left header">
				<i class="fa fa-laptop"></i> 
				Preview
			</li>			
			<li class="active"><a data-toggle="tab" href="#config_tab_2">Data</a></li>
			<li><a data-toggle="tab" href="#config_tab_3">Visual</a></li>
			<li><a data-toggle="tab" href="#config_tab_1">Info</a></li>
			<li class="header" data-toggle="popover" data-placement="bottom" title="Activate/Deactivate Statistics" data-content="Activate this statistics to be able to add this to you pages.">	
				<?php	
				$data = array(
				'name'        => 'active',
				'id'          => 'active',
				'value'       => true,
				'checked'     => (bool) element('active',$statistics) == 1,
				'style'       => 'margin:10px',
				'class'		  => 'm-0 p-absolute',
				'data-bind'	  => 'BootstrapSwitch:{ size: \'small\', onColor: \'primary\', offColor: \'warning\', onText: \'Activated\', offText: \'Deactivated\', labelText: \'Status\' }'
				);
				echo form_checkbox($data);
				?>
			</li>		
		</ul>
		
		
		<div class="row">		
			<div class="col-sm-7">	
				<div id="statistics-preview-container" class="form-inline">
					<?php $this->load->view('/widgets/geospatial/view', array('event' => 'modal')) ;?>
					<?php $source_keys = array(); ?>		
					<div class="p-10 m-t-20 text-center box-footer">
						<div class="input-group m-r-20">
							<label for="argumentField" class="input-group-addon">
								<i class="fa fa-long-arrow-right"></i> Argument Field
							</label>						
							<?php 
								$atts = 'class="form-control argumentfield-select" data-size="8" data-bind="BootstrapSelect:{}"';
								$value = element('series', $config)? element('argumentField',element('series',$config)) : '';	
								echo form_dropdown('series[argumentField]', $source_keys , $value , $atts);							
							?>	
						</div>
						<div class="input-group m-r-20">
							<label for="valueField" class="input-group-addon">
								<i class="fa fa-long-arrow-up"></i> Value Field
							</label>						
							<?php 
								$atts = 'class="form-control w-auto valuefield-select" data-size="8" data-bind="BootstrapSelect:{}"';
								$value = element('series', $config)? element('valueField',element('series',$config)) : '';		
								echo form_dropdown('series[valueField]', $source_keys , $value , $atts);							
							?>		
						</div>						
					</div>
				</div>						
			</div>	
			<div class="col-sm-5">
				<div class="tab-content p-10">	
					
					<div class="tab-pane " id="config_tab_1">
						<div class="form-group">
							<label for="title">Title</label>							
							<?php $data = array(
										  'name'        => 'visual[title][text]',
										  'id'          => 'title',
										  'maxlength'   => '30',
										  'class'		=> 'form-control',
										  'value'		=> element('text', element('title', $config_visual)),												  
										);
							echo form_input($data); ?>														   
						</div>
						<div class="form-group">
							<label for="description">Description</label>
							<?php $data = array(
									 'name'        => 'description',
									  'id'          => 'description',
									  'size'  		=> '30',
									  'rows'		=> '5',
									  'cols'		=> '12',
									  'class'		=> 'form-control',
									  'value'		=> element('description', $config),	
									  'data-bind'	=> 'BootstrapWYSIhtml5:{ html: true, image: false, \'font-styles\': false, link: false }'
									);
							echo form_textarea($data); ?>													   
						</div>
					</div>
					<div class="tab-pane active" id="config_tab_2">		
						
						<div class="form-group has-feedback">	
							<label for="data_fieldname">fieldname</label>
							<?php 				
								
								$data = array(
											'name'        => 'data[fieldname]',
											'id'          => 'data_fieldname',
											'maxlength'   => '30',
											'class'		  => 'form-control',
											'value'		  => element('fieldname', $config) ,		
											'data-bind'   => "
												TypeAhead:{
														ajax: {
																url: '". base_url('tags/get_tag_names'). "',																	
																params: {
																	print: 'all',
																	totalresults: 'true',
																	source: 'autn:name'
																}								
															}
													}"
										);
								echo form_input($data); 
							?>							
						</div>							
					</div>
					<div class="tab-pane" id="config_tab_3">						
						<div data-bind="CustomScrollbar: {  						
									axis:'y',  						
									theme:'dark',  						
									autoExpandScrollbar:true, 						
									advanced:{ 							
										autoExpandHorizontalScroll:true 							
									} 						
									}" class="max-height-500">

							<fieldset class="m-b-20">
								<legend><i class="fa fa-sliders"></i> Map Controls</legend>
								<div class="input-group m-b-10">
									<label for="visual_scrollwheel" class="input-group-addon">Scroll Wheel</label>						
									<div class="form-control p-5">
									<?php																
									$data = array(
									'name'        => 'visual[scrollwheel]',
									'id'          => 'visual_scrollwheel',
									'value'       => 1,
									'checked'     => array_get_value($config_visual,'scrollwheel') == 1,
									'style'       => 'margin:10px',
									'class'		  => 'm-0 p-absolute',
									'data-bind'	  => 'BootstrapSwitch:{ size: \'mini\' }'
									);
									echo form_checkbox($data); ?>
									</div>	
								</div>
								<div class="input-group m-b-10">
									<label for="visual_panControl" class="input-group-addon">Pan Control</label>						
									<div class="form-control p-5">
									<?php																
									$data = array(
									'name'        => 'visual[panControl]',
									'id'          => 'visual_panControl',
									'value'       => 1,
									'checked'     => array_get_value($config_visual,'panControl') == 1,
									'style'       => 'margin:10px',
									'class'		  => 'm-0 p-absolute',
									'data-bind'	  => 'BootstrapSwitch:{ size: \'mini\' }'
									);
									echo form_checkbox($data); ?>
									</div>	
								</div>
								<div class="input-group m-b-10">
									<label for="visual_disableDefaultUI" class="input-group-addon">Disable Default UI</label>						
									<div class="form-control p-5">
									<?php																
									$data = array(
									'name'        => 'visual[disableDefaultUI]',
									'id'          => 'visual_disableDefaultUI',
									'value'       => 1,
									'checked'     => array_get_value($config_visual,'disableDefaultUI') == 1,
									'style'       => 'margin:10px',
									'class'		  => 'm-0 p-absolute',
									'data-bind'	  => 'BootstrapSwitch:{ size: \'mini\' }'
									);
									echo form_checkbox($data); ?>
									</div>	
								</div>
								<div class="input-group m-b-10">
									<label for="visual_zoomControl" class="input-group-addon">Zoom Control</label>						
									<div class="form-control p-5">
									<?php																
									$data = array(
									'name'        => 'visual[zoomControl]',
									'id'          => 'visual_zoomControl',
									'value'       => 1,
									'checked'     => array_get_value($config_visual,'zoomControl') == 1,
									'style'       => 'margin:10px',
									'class'		  => 'm-0 p-absolute',
									'data-bind'	  => 'BootstrapSwitch:{ size: \'mini\' }'
									);
									echo form_checkbox($data); ?>
									</div>	
								</div>
								<div class="input-group m-b-10">
									<label for="visual_zoom" class="input-group-addon">Zoom</label>						
									<div class="form-control p-5">
									<div class="w-100 dark-slider">
										<input type="text" name="visual[zoom]" class="w-100 form-control" id="visual_zoom" value="<?=intval(element('zoom', $config_visual))?>"
										data-slider-orientation="horizontal" 
										data-bind="BootstrapSlider: {
											min: 1,
											max: 16,									
											reversed: false
										}"/>
									</div>
									</div>	
								</div>
								
								
								<div class="input-group m-b-10">
									<label for="visual_scaleControl" class="input-group-addon">Scale Control</label>						
									<div class="form-control p-5">
									<?php																
									$data = array(
									'name'        => 'visual[scaleControl]',
									'id'          => 'visual_scaleControl',
									'value'       => 1,
									'checked'     => array_get_value($config_visual,'scaleControl') == 1,
									'style'       => 'margin:10px',
									'class'		  => 'm-0 p-absolute',
									'data-bind'	  => 'BootstrapSwitch:{ size: \'mini\' }'
									);
									echo form_checkbox($data); ?>
									</div>	
								</div>
								<div class="input-group m-b-10">
									<label for="visual_streetViewControl" class="input-group-addon">Street View Control</label>						
									<div class="form-control p-5">
									<?php																
									$data = array(
									'name'        => 'visual[streetViewControl]',
									'id'          => 'visual_streetViewControl',
									'value'       => 1,
									'checked'     => array_get_value($config_visual,'streetViewControl') == 1,
									'style'       => 'margin:10px',
									'class'		  => 'm-0 p-absolute',
									'data-bind'	  => 'BootstrapSwitch:{ size: \'mini\' }'
									);
									echo form_checkbox($data); ?>
									</div>	
								</div>
								<div class="input-group m-b-10">
									<label for="visual_overviewMapControl" class="input-group-addon">Overview Control</label>						
									<div class="form-control p-5">
									<?php																
									$data = array(
									'name'        => 'visual[overviewMapControl]',
									'id'          => 'visual_overviewMapControl',
									'value'       => 1,
									'checked'     => array_get_value($config_visual,'overviewMapControl') == 1,
									'style'       => 'margin:10px',
									'class'		  => 'm-0 p-absolute',
									'data-bind'	  => 'BootstrapSwitch:{ size: \'mini\' }'
									);
									echo form_checkbox($data); ?>
									</div>	
								</div>
								<div class="input-group m-b-10">
									<label for="visual_mapTypeControl" class="input-group-addon">Map Type Control</label>						
									<div class="form-control p-5">
									<?php																
									$data = array(
									'name'        => 'visual[mapTypeControl]',
									'id'          => 'visual_mapTypeControl',
									'value'       => 1,
									'checked'     => array_get_value($config_visual,'mapTypeControl') == 1,
									'style'       => 'margin:10px',
									'class'		  => 'm-0 p-absolute',
									'data-bind'	  => 'BootstrapSwitch:{ size: \'mini\' }'
									);
									echo form_checkbox($data); ?>
									</div>	
								</div>
							</fieldset>
							
							
							<fieldset class="m-b-20">
								<legend><i class="fa fa-paint-brush"></i> Map Styles</legend>							
								<div class="input-group m-b-10">
									<label for="visual_theme" class="input-group-addon">Map Theme</label>		
									<?php 
										$themes = $this->application->get_config('map_themes','statistics');
										$theme = element('theme', $config_visual);
									?>
									<select class=" form-control" data-bind="BootstrapSelect:{}" name="visual[theme]">		
										<option value=''>None</option>
										<?php foreach( $themes as $key=>$th) :?>
											<option value="<?=$key?>" <?=strcasecmp($key, $theme)==0?'selected':''?>><?=$th?></option>	
										<?php endforeach;?>
									</select>
								</div>
								
								<div class="input-group m-b-10">
									<label for="visual_marker_shape" class="input-group-addon">Marker Shape</label>	
									<div class="form-control">
									<ul class="row list-inline">
										<?php 
											$icons = $this->application->get_config('map_icons','statistics');	
											foreach($icons as $k=>$icon):	
											echo '<li class="m-r-10">';
											?>							
												<div class="radio radio-primary m-0">														
													<input type="radio" 
														id="visual_marker_shape-<?=$k?>" name="visual[marker_shape]" 
														value="<?=$k?>" 
														class="" <?= strcasecmp(element('marker_shape', $config_visual), $k ) ==0? 'checked': ''; ?>/>
													<label for="marker_shape-<?=$k?>">
														<svg xml:space="preserve" enable-background="new 0 0 100 120" 
															viewBox="0 0 100 120" 
															id="marker_shape-<?=$k?>-pv"
															height="20px" 
															width="20px" y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" version="1.1">
															 <?=$icon?>
														</svg>
													</label>
												</div>	
											<?php
											echo '</li>';
											endforeach;
										?>
									</ul>
									</div>
								</div>
								
								<div class="input-group m-b-10" data-bind="BootstrapColorPicker: {container: 'body'}">
									<label for="visual_marker_color" class="input-group-addon">Marker Color </label>									
									 <?php $data = array(
											  'name'        => 'visual[marker_color]',
											  'id'          => 'visual_marker_color',
											  'maxlength'   => '30',
											  'class'		=> 'form-control',
											  'value'		=> element('marker_color', $config_visual),
											  'placeholder'	=> '#ccc'
											);

									echo form_input($data); ?>
									<span class="input-group-addon"><i></i></span>
								</div>
							</fieldset>
										
						</div>
					</div>
				</div>
			</div>
		
		</div>
	</div>
	<?=form_close()?>				



