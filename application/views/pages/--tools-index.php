<?php 
	$delimiter = $this->application->get_config('metakey_delimiter', 'template');
	$statistics = $this->statistics_model->get_statistics( array('active' => 1 ));	
	$widgets = $this->application->get_widgets('pages');	
?>
<div id="floating-tool" 
	class="no-print floating-tools-button">
	<i class="fa-gear fa"></i>
</div>
<div id="floating-tool-content" class="no-print floating-tools-content">
	<div data-bind="">
		<?php 
		
		$atts = array(
				'class' => '',
				'data-bind' => 'submit: $root.Pages.updatePage', 
				'method' => 'POST',
				'onSubmit' => 'return false;',
				'id' => 'page_settings_form'
		);
		
		$hidden 		= array();	
		echo form_open( '/pages/edit/' . element('id', $page) , $atts, $hidden ); ?>
		
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
			  
			  <li class="dropdown pull-right active">
				<a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0)"><i class="fa fa-ellipsis-v"></i></a>
				<ul class="dropdown-menu">
				  <li class="active"><a data-toggle="tab" href="#page-edit-tab-1">
					<i class="fa fa-info-circle"></i> Info</a></li>
				  <li><a data-toggle="tab" href="#page-edit-tab-2">
					<i class="fa fa-tasks"></i> Widgets</a></li>
				  <li><a data-toggle="tab" href="#page-edit-tab-3">
					<i class="fa fa-keyboard-o"></i> Styles</a></li>
				</ul>
			  </li>
			  
			  <li class="pull-left header"><?=string_limit(element('page_name', $page)? element('page_name', $page): '', 10) ?></li>
			</ul>
			<div class="tab-content p-l-0 p-r-0">
				<div id="page-edit-tab-1" class="tab-pane active">
					<div class="form-group">
						<label class="control-label" for="title">Page Name</label>		  
						<?php $data = array(
								  'name'        => 'page_name',
								  'id'          => 'page_name',
								  'maxlength'   => '30',
								  'class'		=> 'form-control',
								  'value'		=> element('page_name', $page),
								  'placeholder'	=> 'Enter name'
								);
						echo form_input($data); ?>			
						<p class="help-block"></p>
					</div>
					<div class="form-group">		
						<label class="control-label" for="server">Server</label>
					   <?php 
							$value = element('server',$page);
							$servers = $this->servers_model->get_servers();		
						?>
						<select name="server" id="server"
							class="selectpicker" title="Please select server">
							<?php 
								foreach($servers as $k=>$server):
								$selected = strcasecmp($value, element('server', $server))==0 ? 'selected' : '';
								echo '<option value="' . element('server', $server)  . '" ' . $selected . '>' . element('server', $server) . '</option>';
								endforeach;				
							?>	
						</select>
						<p class="help-block">Some help text</p>	
					</div>		
					
					<div class="form-group">
						<label class="control-label" for="page_desc">Description</label>	
						<div class="">
						<?php $data = array(
								  'name'        => 'page_desc',
								  'id'          => 'page_desc',
								  'rows'   		=> 2,
								  'class'		=> 'form-control',
								  'value'		=>  element('page_desc', $page),
								  'data-bind'	=> 'BootstrapWYSIhtml5:{ html: true, image: false, \'font-styles\': false, link: false }',
								  'placeholder'	=> 'Some description'
								);
						echo form_textarea($data); ?>			
						</div>
						<p class="help-block"></p>
					</div>
				</div>
				<div id="page-edit-tab-2" class="tab-pane">
					<div data-bind="CustomScrollbar: { axis:'y', theme:'dark'}" class="max-height-320">
					<?php 
						foreach($statistics as $key=>$widget):
						
						$config 	= $this->statistics_model->get_settings(element('widget_key', $widget));	
						$title 		= array_get_value($config, 'text');
						$widget_key = element('widget_key', $widget);
						$category   = element('category', $widget);
						
					?>	
						<ul class="todo-list m-b-5 draggable-widgets" data-delimiter="<?=$delimiter?>" data-widget="<?=$widget_key.$delimiter.time()?>">	
							<li class="" 
								data-toggle="popover"
								data-html="true" 
								data-placement="left" title="<?=$config? $title: 'Warning'?>" 
								data-content="<div class='text-center'><p><small class='text-muted'><?=$config? element('description', $config) : 'This is not properly configured! ' ?></small></p></div>"
							>
							  <span class="handle">
								<i class="fa fa-ellipsis-v"></i>
								<i class="fa fa-ellipsis-v"></i>
							  </span>						  
							  <span class="text"><?=$config? character_limiter($title, 10): '#Warning#'?></span>
							  <small class="label label-default"><?=$category?></small>						  
							</li>
						</ul>
					<?php	
						endforeach;	
					?>
					<?php 
						foreach($widgets as $key=>$widget):						
					?>	
						<ul class="todo-list draggable-widgets m-b-5" data-widget="<?=$key?>" data-delimiter="<?=$delimiter?>">	
							<li class=""
								data-toggle="popover"
								data-content="<p><small><?=element('@description', $widget)?></small></p>"
								data-placement="left"
								data-html="true"
								data-container="body"
								title="<i class='fa <?=element('@icon', $widget)?>'></i> <?=element('@title', $widget)?>"
							>
							  <span class="handle">
								<i class="fa <?=element('@icon', $widget)?>"></i>
							  </span>						  
							  <span class="text"><?=element('@title', $widget)?></span>
							   <small class="label label-default"><?=element('@method', $widget)?></small>					  
							</li>
						</ul>
					<?php	
						endforeach;	
					?>
					</div>
				</div>
				
				<div id="page-edit-tab-3" class="tab-pane">
				
					<div class="form-group">	
						<label class="control-label">Template</label>
					   <?php 
							$templates = $this->application->get_templates('application/views/pages/templates/');
							$atts = 'class="form-control selectpicker" 
							data-bind="BootstrapSelect:{}"';
							echo form_dropdown('template', $templates, element('template', $page), $atts);
						?>
					</div>
					
				
					<div class="form-group">		
						<label class="control-label">Skin</label>
						 <?php 
							$skins = $this->application->skins();
							$selected = empty(element('skin', $page))? 'selected' : '';
						?>
						<div data-bind="CustomScrollbar: { 
									axis:'x', 
									theme:'dark',
									scrollbarPosition:'inside',
									autoExpandScrollbar:true,
									advanced:{
										autoExpandHorizontalScroll:true
										}
									}" class="m-t-10">
									
							<ul class="users-list clearfix skin-selector list-selection m-0" data-skins="<?=htmlspecialchars(json_encode($skins), ENT_QUOTES, 'UTF-8')?>">
								<?php 
								foreach($skins as $value=>$thumb){
								$selected = strcasecmp($value, element('skin', $page))==0;
								?>
									<li class="w-auto <?=$selected? 'active' : '';?>">					 
									  <label for="<?=$value?>"><img src="<?=base_url($thumb)?>" class="b-radius-0 cursor-pointer list-select" width="80px"/></label>
									  <a href="javascript:void(0)" class="users-list-name"><?=$value?></a>
									  <span class="radio radio-primary m-l-0 hidden">
										<input type="radio" class="" name="skin" value="<?=$value?>" id="<?=$value?>" <?=$selected? 'checked' : '';?>/>
										<label for="<?=$value?>"><?=$value?></label>
									  </span>						  
									</li>
								<?php
								}
								?>					
							</ul>						
						</div>				
					</div>
					
					
					
					<h4 class="m-b-20">Button Colours</h4>
					<?php  
						$buttons_sizes = $this->application->get_config('buttons_size', 'template');
						$buttons = $this->application->get_config('buttons', 'template'); 
						$button_color_options = array(
										'button_color_submit' => 'Submit',
										'button_color_add' => 'Add',
										'button_color_cancel' => 'Cancel',
										'button_color_delete' => 'Delete',
										'button_color_info' => 'Info'
									);
						$button_size_options = array(
										'button_size_tool' => 'Tool',
										'button_size_form' => 'Form',
										'button_size_modal' => 'Modal'
									);?>
					
					<div data-bind="CustomScrollbar: { 
									axis:'y', 
									theme:'dark',
									scrollbarPosition:'inside',
									autoExpandScrollbar:true,
									advanced:{
										autoExpandHorizontalScroll:true
										}
									}" class="m-t-10 max-height-250">
					<?php 
					foreach($button_color_options as $opt_key=>$opt_label){
					?>
						<div class="form-group">	
							<label class="control-label"><?=$opt_label?></label>
							<div class="">	
								<ul class="button-selector list-inline list-selection">
									<?php 
									$value = element($opt_key, $page);		
									foreach($buttons as $key=>$button){
									$selected = strcasecmp($key, $value)==0;						
									?>
										<li class="w-auto m-0 p-0 <?=$selected? 'active' : '';?>">	
											<label for="<?=$opt_key. '_'.$key?>" class="btn btn-xs btn-flat <?=$key?> list-select">btn</label>
											<span class="radio radio-primary m-l-0 hidden">
												<input type="radio" class="" name="<?=$opt_key?>" value="<?=$key?>" id="<?=$opt_key. '_'.$key?>" <?=$selected? 'checked' : '';?>/>
												<label for="<?=$opt_key. '_'.$key?>"><?=$key?></label>
											</span>						  
										</li>
									<?php
									}
									?>					
								</ul>					
							</div>		
						</div>			
					<?php
					}		
					?>
					</div>
					
					
				
				</div>
			</div>
		</div>
		
		
		
		<div class="box-footer">
			<a class="btn btn-danger btn-flat pull-left delete-confirm"
				href="javascript:void(0)"
				data-url="<?=base_url('pages/delete/'.$page['id'])?>"						
			>Delete</a>		
			<button type="submit" class="btn btn-primary btn-flat pull-right">Save</button>
		</div>	
		<?=form_close();?>
	</div>
	<div class="drop-here-helper">
		<div class="p-relative">
			<span class="ion-trash-a"></span>
		</div>
	</div>
</div>




