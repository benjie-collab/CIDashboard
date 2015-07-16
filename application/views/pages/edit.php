<?php 
$atts = array(
		'class' => 'page_settings_form',
		'data-bind' => 'submit: updatePage', 
		'method' => 'POST',
		'onSubmit' => 'return false;',
		'id' => ''
);

$hidden 		= array();	
?>			
<?php echo form_open( '/pages/edit/'. element('id', $page), $atts, $hidden ); ?>
	<div class="row">
		<div class="col-sm-5">
			<div class="form-group">
				<label class="control-label" for="title"><span class="text-danger">*</span> Page Name</label>		  
				<?php $data = array(
						  'name'        => 'page_name',
						  'id'          => 'page_name',
						  'class'		=> 'form-control',
						  'value'		=> element('page_name', $page),
						  'placeholder'	=> 'Enter name'
						);
				echo form_input($data); ?>			
				<p class="help-block">Some help text</p>	
			</div>
			
			<div class="form-group">		
				<label class="control-label" for="server"><span class="text-danger">*</span> Server</label>
			   <?php 
					$servers = $this->servers_model->get_servers();				
				?>
				<select name="server" id="server"
					class="form-control" data-bind="BootstrapSelect:{}">
					<option data-hidden="true" value="">-- Select one --</option>
					<?php 
						$value = element('server', $page);
						foreach($servers as $k=>$server):	
						$selected = strcasecmp($value, element('server', $server) )==0 ? 'selected' : '';
						echo '<option value="' . element('server', $server)  . '" ' . $selected . '>' . element('server', $server) . '</option>';
						endforeach;				
					?>	
				</select>
				<p class="help-block">Some help text</p>	
			</div>		
			
			<div class="form-group">
				<label class="control-label" for="page_desc">Description</label>	
				<div class="text-center">
				<?php $data = array(
						  'name'        => 'page_desc',
						  'id'          => 'page_desc',
						  'class'		=> 'form-control',
						  'value'		=>  element('page_desc', $page),
						  'rows'			=>  '2',
						  'data-bind'	=> 'BootstrapWYSIhtml5:{ html: true, image: false, \'font-styles\': false, link: false }',
						  'placeholder'			=> 'Some description'
						);
				echo form_textarea($data); ?>			
				</div>
				<p class="help-block"></p>
			</div>
			
			<div class="form-group">	
				<label class="control-label">Template</label>
			   <?php 
					$value = element('page_desc', $page);
					$templates = $this->application->get_templates('application/views/pages/templates/');
					$atts = 'class="form-control selectpicker" 
					data-bind="BootstrapSelect:{}"';
					echo form_dropdown('template', $templates, $value, $atts);
				?>
			</div>
			
			
		</div>
		<div class="col-sm-7">			
			<div class="form-group">		
				<label class="control-label">Skin</label>
			   <?php 
					$skins = $this->application->skins();
					$value = element('skin', $page);
				?>
				<div data-bind="CustomScrollbar: { 
							axis:'x', 
							theme:'dark',
							scrollbarPosition:'inside',
							autoExpandScrollbar:true,
							advanced:{
								autoExpandHorizontalScroll:true
								}
							}" class="m-t-10 max-height-150 o-hidden">
							
					<ul class="users-list clearfix skin-selector list-selection" data-skins="<?=htmlspecialchars(json_encode($skins), ENT_QUOTES, 'UTF-8')?>">
						<?php 
						foreach($skins as $skin=>$thumb){
						$selected = strcasecmp($value, $skin)==0;
						?>
							<li class="w-auto <?=$selected? 'active' : ''?>">					 
							  <label for="<?=$skin?>"><img src="<?=base_url($thumb)?>" class="b-radius-0 cursor-pointer list-select" width="120px"/></label>
							  <a href="javascript:void(0)" class="users-list-name"><?=$skin?></a>
							  <span class="radio radio-primary m-l-0 hidden">
								<input type="radio" class="" name="skin" value="<?=$skin?>" id="<?=$skin?>" <?=$selected? 'checked' : ''?>/>
								<label for="<?=$skin?>"><?=$skin?></label>
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
									<label for="<?=$opt_key. '_'.$key?>" class="btn btn-sm btn-flat <?=$key?> list-select"><?=$key?></label>
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
	
	

	

<?=form_close()?>