<?php 
/*
* @Title: General
* @Method: General
* @icon: fa-gear fa
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
$hidden 		= array('meta_key' => 'settings_general');
?>
<section class="content-header">
  <h1>
	<?php echo lang('general_settings_heading');?>
	<small><?php echo lang('general_settings_subheading');?></small>
  </h1>
   <?=$this->application->breadcrumb()?>
</section>

<section class="content">
	<?=$message?>	
	
	<?php echo form_open( '/settings', $atts, $hidden ); ?>		
	
	
		<div class="form-group">
			<label class="col-sm-2 control-label">Logo</label>
			<div class="col-sm-4 col-xs-6">
				<div class="dropzone text-center" id="" data-bind="Dropzone: { 
				acceptedFiles: '.gif,.jpg,.png',
				createImageThumbnails: false,
				previewTemplate : '<div style=\'display:none\'></div>',
				uploadMultiple: false,
				maxFiles: 1,
				dictDefaultMessage: 'Click or Drop image here to change.',
				maxfilesreached: function(){
				
				},
				init: function() {
					this.hiddenFileInput.removeAttribute('multiple');
				}, 
				success: function(e, r){					
					var messages = $(r.message).filter('div');
					if(messages)
					$.each(messages, function(i,v){
						$.notify({
							message: $(v).text() 
						},
						{
							type: r.response
						});
					
					})
					else
					$.notify({
						message: $(r.message).text() 
					},
					{
						type: r.response
					});					
				},
				complete: function(file, e){	
					this.removeFile(file);
					if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
						window.location.reload();
					}
				},
				sending: function(file, xhr, data){					
					if(typeof(data)!=='undefined')
					data.append('meta_key', 'logo');
				},
				error: function(e, r){	
					
					$.notify({
						message: r
					},
					{
						type: 'danger'
					});
				},
				url: '<?=base_url('settings/logo')?>'}">	
<img src="<?=base_url(element('logo', $settings));?>" class="img-circle" style="width: 120px; height: 120px;"/>				
				</div>
			</div>
		</div>
	
		<div class="form-group">
			<label class="col-sm-2 control-label" for="application_title">Title</label>
			<div class="col-sm-8">
					<?php $data = array(
						'name'        => 'title',
						'id'          => 'application_title',
						'class'		  => 'form-control',
						'value'		  => element('title', $settings)
						);
					echo form_input($data); 
					?>
				<p class="help-block">Some help text</p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="application_tagline">Tag Line</label>
			<div class="col-sm-8">
					<?php $data = array(
						'name'        => 'tagline',
						'id'          => 'application_tagline',
						'class'		  => 'form-control',
						'value'		  => element('tagline', $settings)
						);
					echo form_input($data); 
					?>
				<p class="help-block">Some help text</p>
			</div>
		</div>	
		
		<div class="form-group">		
			<label class="col-sm-2 control-label">Date Format</label>
		   <?php 
				$dateformats = $this->application->get_config('dateformat', 'template');				
			?>
			<div class="col-sm-8">
				<?php 
				$value = element('dateformat', $settings);
				$counter = 0;
				foreach($dateformats as $k=>$df):	
				?>							
					<div class="radio radio-primary m-l-0">														
						<input type="radio" 
							id="dateformat-<?=$counter?>" name="dateformat" 
							value="<?=$k?>" 
							class="" <?=strcasecmp($value, $k)==0? 'checked' : ''?>/>
						<label for="dateformat-<?=$counter?>"><?=$df?></label>
					</div>	
				<?php
				$counter++;
				endforeach;
				?>
				<p class="help-block">Some help text</p>		
			</div>			
		</div>
		
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="application_copyright">Copyright</label>
			<div class="col-sm-8">
					<?php $data = array(
						'name'        => 'copyright',
						'id'          => 'application_copyright',
						'class'		  => 'form-control',
						'value'		  => element('copyright', $settings)
						);
					echo form_input($data); 
					?>
				<p class="help-block">Some help text</p>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="application_copyright_link">Copyright Link</label>
			<div class="col-sm-8">
					<?php $data = array(
						'name'        => 'copyright_link',
						'id'          => 'application_copyright_link',
						'class'		  => 'form-control',
						'value'		  => element('copyright_link', $settings)
						);
					echo form_input($data); 
					?>
				<p class="help-block">Some help text</p>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label">Favicon</label>
			
			<div class="col-sm-2 col-xs-4">
				<div class="dropzone text-center" style="max-height: 80px" data-bind="Dropzone: { 
				acceptedFiles: '.ico,.gif',
				createImageThumbnails: false,
				previewTemplate : '<div style=\'display:none\'></div>',
				uploadMultiple: false,				
				dictDefaultMessage: 'Click or Drop image here to change.',
				maxFiles: 1,
				maxfilesreached: function(){},
				init: function() {
					this.hiddenFileInput.removeAttribute('multiple');
				}, 
				success: function(e, r){					
					var messages = $(r.message).filter('div');
					if(messages)
					$.each(messages, function(i,v){
						$.notify({
							message: $(v).text() 
						},
						{
							type: r.response
						});
					
					})
					else
					$.notify({
						message: $(r.message).text() 
					},
					{
						type: r.response
					});					
				},
				complete: function(file, e){	
					this.removeFile(file);
					if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
						window.location.reload();
					}
				},
				sending: function(file, xhr, data){					
					if(typeof(data)!=='undefined')
					data.append('meta_key', 'favicon');
				},
				error: function(e, r){					
					$.notify({
						message: r
					},
					{
						type: 'danger'
					});
				},
				url: '<?=base_url('settings/favicon')?>'}">	
<img src="<?=base_url(element('favicon', $settings));?>" class="" style="width: 16px; height: 16px;"/>				
				</div>
			</div>
		</div>
		
		<div data-bind="ScrollToFixed:{ bottom: 0, limit: $('#edit-mode-helper').offset().top}" id="edit-mode-helper" class="bg-gray p-10 row" >		
			<div class="col-sm-8 col-sm-offset-2">	
				<button type="submit" class="btn btn-primary btn-flat" data-bind="css: { 'has-spinner active' : $root.Settings.ajaxProcess}">
				<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
				Save Changes</button>					
			</div>		
		</div>
		
		
		
		
	<?php echo form_close(); ?>	
</section>

