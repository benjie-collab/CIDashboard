<?php 
/*
* @Title: Styles
* @Method: Styles
* @icon: fa-paint-brush fa
*/ 
?>

<?php 
$atts = array(
		'class' => 'form-horizontal',
		'data-bind' => 'submit: $root.Settings.formSubmit', 
		'method' => 'POST',
		'onSubmit' => 'return false;',
		'id' => ''
);	
$hidden 		= array('meta_key' => 'settings_styles');
$skins  = $this->application->skins();
?>
<section class="content-header">
  <h1>
	<?php echo lang('styles_settings_heading');?>
	<small><?php echo lang('styles_settings_subheading');?></small>
  </h1>
    <?=$this->application->breadcrumb()?>
</section>

<section class="content">
	<?=$message?>	
	
	<?php echo form_open( '/settings', $atts, $hidden ); ?>
	
	
	
	<div class="row">
		<div class="col-md-12">
		<h4 class="m-b-20">Skin/Layout</h4>
			<div class="form-group">	
				<label class="control-label col-sm-2">Skin</label>
				<div class="col-sm-10">	
					<div data-bind="CustomScrollbar: { 
								axis:'x', 
								theme:'dark',
								scrollbarPosition:'inside',
								autoExpandScrollbar:true,
								advanced:{
									autoExpandHorizontalScroll:true
									}
								}" class="m-t-10 max-height-420">
								
						<ul class="users-list clearfix skin-selector list-selection" data-skins="<?=htmlspecialchars(json_encode($skins), ENT_QUOTES, 'UTF-8')?>">
							<?php 
							foreach($skins as $value=>$thumb){
							$selected = strcasecmp($value, element('skin', $settings))==0;
							?>
								<li class="w-auto <?=$selected? 'active' : '';?>">					 
								  <label for="<?=$value?>"><img src="<?=base_url($thumb)?>" class="b-radius-0 cursor-pointer list-select"/></label>
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
					<p class="help-block">Some help text</p>	
				</div>		
			</div>
			
			<div class="form-group">	
				<label class="control-label col-sm-2 ">Layout</label>
				<div class="col-sm-10">	
					<ul class="list-unstyled">
				   <?php 
						$layouts = $this->application->get_config('layouts', 'template');
						$layout = element('layout', $settings);					
						$layout = $layout && is_array($layout)? $layout : array();
					?>				
					<?php 
						foreach($layouts as $value=>$name):
					?>				
						<li class="checkbox checkbox-primary m-l-0 m-b-10">														
							<input type="checkbox" 
								id="<?=$value?>" name="layout[]" 
								value="<?=$value?>" 
								class="layout-selector" <?php echo in_array($value, $layout)? 'checked': ''; ?>/>
							<label for="<?=$value?>"><?=$name?></label>
						</li>	
					
					<?php
						endforeach;				
					?>	
					</ul>
					<p class="help-block">Some help text</p>						
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
					<label class="control-label col-sm-2 "><?=$opt_label?></label>
					<div class="col-sm-10">	
						<ul class="button-selector list-inline list-selection">
							<?php 
							$value = element($opt_key, $settings);		
							foreach($buttons as $key=>$button){
							$selected = strcasecmp($key, $value)==0;						
							?>
								<li class="w-auto <?=$selected? 'active' : '';?>">	
									<label for="<?=$opt_key. '_'.$key?>" class="btn btn-sm btn-flat <?=$key?> list-select"><?=$button?></label>
									<span class="radio radio-primary m-l-0 hidden">
										<input type="radio" class="" name="<?=$opt_key?>" value="<?=$key?>" id="<?=$opt_key. '_'.$key?>" <?=$selected? 'checked' : '';?>/>
										<label for="<?=$opt_key. '_'.$key?>"><?=$key?></label>
									</span>						  
								</li>
							<?php
							}
							?>					
						</ul>
						<p class="help-block">Some help text</p>						
					</div>		
				</div>			
			<?php
			}		
			?>
			
			<h4 class="m-b-20 m-t-40">Button Sizes</h4>
			<?php 
			foreach($button_size_options as $opt_key=>$opt_label){
			?>
				<div class="form-group">	
					<label class="control-label col-sm-2 "><?=$opt_label?></label>
					<div class="col-sm-10">	
						<ul class="button-selector list-inline list-selection">
							<?php 
							$value = element($opt_key, $settings);		
							foreach($buttons_sizes as $key=>$button){
							$selected = strcasecmp($key, $value)==0;						
							?>
								<li class="w-auto <?=$selected? 'active' : '';?>">	
									<label for="<?=$opt_key. '_'.$key?>" class="btn <?=$key?> btn-flat bg-navy list-select"><?=$button?></label>
									<span class="radio radio-primary m-l-0 hidden">
										<input type="radio" class="" name="<?=$opt_key?>" value="<?=$key?>" id="<?=$opt_key. '_'.$key?>" <?=$selected? 'checked' : '';?>/>
										<label for="<?=$opt_key. '_'.$key?>"><?=$key?></label>
									</span>						  
								</li>
							<?php
							}
							?>					
						</ul>
						<p class="help-block">Some help text</p>						
					</div>		
				</div>			
			<?php
			}		
			?>
		</div>
	</div>
	
	<div data-bind="ScrollToFixed:{ bottom: 0, limit: $('#edit-mode-helper').offset().top}" id="edit-mode-helper" class="bg-gray p-10 row" >		
		<div class="col-sm-10 col-sm-offset-2">	
			<button type="submit" class="btn btn-primary btn-flat" data-bind="css: { 'has-spinner active' : $root.Settings.ajaxProcess}">
			<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
			Save Changes</button>					
		</div>		
	</div>
		
		
		
		
		
	<?php echo form_close(); ?>	
</section>

