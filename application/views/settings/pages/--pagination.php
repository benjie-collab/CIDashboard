<?php 
/*
* @Title: Pagination
* @Method: Others
* @icon: fa fa-sort-numeric-asc
*/ 



	
$options	=  $this->search_model->get_options('settings_others_pagination');
$config		=  $this->application->get_config('pagination', 'pagination');
$options	= array_merge($config, $options);



$atts = array(
		'class' => 'form-horizontal',
		'data-bind' => 'submit: $root.SearchSettings.formSubmit', 
		'method' => 'POST',
		'onSubmit' => 'return false;',
		'id' => 'settings_others_pagination_form'
);

$hidden 		= array('meta_key' => 'settings_others_pagination');
	
?>

<?php echo form_open( '/settings' . http_build_query($_GET), $atts, $hidden ); ?>
	<div class="box-body">
		
		<p class="lead"><?=lang('pagination_settings_description') ?></p>
		<fieldset class="scheduler-border">
		<legend class="scheduler-border">Basic</legend>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="per_page">per_page</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'per_page',
							  'id'          => 'per_page',
							  'class'		=> 'form-control w-auto',
							  'value'		=> element('per_page', $options),
							  'placeholder'	=> 'per_page',
							  'type'		=> 'number'
							);

				echo form_input($data); ?>
				<p class="help-block">per_page</p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="base_url">base_url</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'base_url',
							  'id'          => 'base_url',							  
							  'class'		=> 'form-control',
							  'value'		=> element('base_url', $options), 
							  'placeholder'	=> 'base_url'
							);

				echo form_input($data); ?>
				<p class="help-block">base_url</p>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="total_rows">total_rows</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'total_rows',
							  'id'          => 'total_rows',							  
							  'class'		=> 'form-control w-auto',
							  'value'		=> element('total_rows', $options), 
							  'placeholder'	=> 'total_rows',
							  'type'		=> 'number',
							  'disabled'	=> 'disabled'
							);

				echo form_input($data); ?>
				<p class="help-block">total_rows</p>
			</div>
		</div>
	</fieldset>
	
	<fieldset class="scheduler-border">
		<legend class="scheduler-border">Customizing the Pagination</legend>	
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="uri_segment">uri_segment</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'uri_segment',
							  'id'          => 'uri_segment',							  
							  'class'		=> 'form-control w-auto',
							  'value'		=> element('uri_segment', $options), 
							  'placeholder'	=> 'uri_segment',
							  'type'		=> 'number'
							);

				echo form_input($data); ?>
				<p class="help-block">uri_segment</p>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="per_page">num_links</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'num_links',
							  'id'          => 'num_links',							  
							  'class'		=> 'form-control w-auto',
							  'value'		=> element('num_links', $options), 
							  'placeholder'	=> 'num_links',
							  'type'		=> 'number'
							);

				echo form_input($data); ?>
				<p class="help-block">num_links</p>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="use_page_numbers">use_page_numbers</label>	
			<div class="col-sm-9" >				
				<input type="hidden" value="0" name="use_page_numbers"/>
			    <?php $data = array(
					'name'        => 'use_page_numbers',
					'id'          => 'use_page_numbers',
					'value'       => '1',
					'checked'     => intval(element('use_page_numbers', $options)) === 1,
					'style'       => 'margin:10px',
					'class'		  => 'm-0 p-absolute',
					'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
					);
				echo form_checkbox($data); ?>
				
				<p class="help-block">use_page_numbers</p>					
			</div>	
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="page_query_string">page_query_string</label>	
			<div class="col-sm-9" >	
				<input type="hidden" value="0" name="page_query_string"/>
			    <?php $data = array(
					'name'        => 'page_query_string',
					'id'          => 'page_query_string',
					'value'       => '1',
					'checked'     => intval(element('page_query_string', $options)) === 1,
					'style'       => 'margin:10px',
					'class'		  => 'm-0 p-absolute',
					'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
					);
				echo form_checkbox($data); ?>
				
				<p class="help-block">page_query_string</p>					
			</div>	
		</div>		
		
	</fieldset>	
	
	<fieldset class="scheduler-border">
		<legend class="scheduler-border">Adding Enclosing Markup</legend>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="full_tag_open">full_tag_open</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'full_tag_open',
							  'id'          => 'full_tag_open',							  
							  'class'		=> 'form-control',
							  'value'		=> element('full_tag_open', $options), 
							  'placeholder'	=> 'full_tag_open'
							);

				echo form_input($data); ?>
				<p class="help-block">full_tag_open</p>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="full_tag_close">full_tag_close</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'full_tag_close',
							  'id'          => 'full_tag_close',							  
							  'class'		=> 'form-control',
							  'value'		=> element('full_tag_close', $options), 
							  'placeholder'	=> 'full_tag_close'
							);

				echo form_input($data); ?>
				<p class="help-block">full_tag_close</p>
			</div>
		</div>
	
	</fieldset>	
	
	<fieldset class="scheduler-border">
		<legend class="scheduler-border">Customizing the First Link</legend>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="first_link">first_link</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'first_link',
							  'id'          => 'first_link',							  
							  'class'		=> 'form-control',
							  'value'		=> element('first_link', $options),
							  'placeholder'	=> 'first_link'
							);

				echo form_input($data); ?>
				<p class="help-block">first_link</p>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="first_tag_open">first_tag_open</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'first_tag_open',
							  'id'          => 'first_tag_open',							  
							  'class'		=> 'form-control',
							  'value'		=> element('first_tag_open', $options),
							  'placeholder'	=> 'first_tag_open'
							);

				echo form_input($data); ?>
				<p class="help-block">first_tag_open</p>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="first_tag_close">first_tag_close</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'first_tag_close',
							  'id'          => 'first_tag_close',							  
							  'class'		=> 'form-control',
							  'value'		=> element('first_tag_close', $options),
							  'placeholder'	=> 'first_tag_close'
							);

				echo form_input($data); ?>
				<p class="help-block">first_tag_close</p>
			</div>
		</div>

	</fieldset>	
	
	
	<fieldset class="scheduler-border">
		<legend class="scheduler-border">Customizing the Last Link</legend>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="first_link">last_link</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'last_link',
							  'id'          => 'last_link',							  
							  'class'		=> 'form-control',
							  'value'		=> element('last_link', $options),
							  'placeholder'	=> 'last_link'
							);

				echo form_input($data); ?>
				<p class="help-block">last_link</p>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="last_tag_open">last_tag_open</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'last_tag_open',
							  'id'          => 'last_tag_open',							  
							  'class'		=> 'form-control',
							  'value'		=> element('last_tag_open', $options),
							  'placeholder'	=> 'last_tag_open'
							);

				echo form_input($data); ?>
				<p class="help-block">last_tag_open</p>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="last_tag_close">last_tag_close</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'last_tag_close',
							  'id'          => 'last_tag_close',							  
							  'class'		=> 'form-control',
							  'value'		=> element('last_tag_close', $options),
							  'placeholder'	=> 'last_tag_close'
							);

				echo form_input($data); ?>
				<p class="help-block">last_tag_close</p>
			</div>
		</div>

	</fieldset>	
	
	
	<fieldset class="scheduler-border">
		<legend class="scheduler-border">Customizing the "Next" Link</legend>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="next_link">next_link</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'next_link',
							  'id'          => 'next_link',							  
							  'class'		=> 'form-control',
							  'value'		=> element('next_link', $options),
							  'placeholder'	=> 'next_link'
							);

				echo form_input($data); ?>
				<p class="help-block">next_link</p>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="next_tag_open">next_tag_open</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'next_tag_open',
							  'id'          => 'next_tag_open',							  
							  'class'		=> 'form-control',
							  'value'		=> element('next_tag_open', $options),
							  'placeholder'	=> 'next_tag_open'
							);

				echo form_input($data); ?>
				<p class="help-block">next_tag_open</p>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="next_tag_close">next_tag_close</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'next_tag_close',
							  'id'          => 'next_tag_close',							  
							  'class'		=> 'form-control',
							  'value'		=> element('next_tag_close', $options),
							  'placeholder'	=> 'next_tag_close'
							);

				echo form_input($data); ?>
				<p class="help-block">next_tag_close</p>
			</div>
		</div>
	</fieldset>	
	
	
	<fieldset class="scheduler-border">
		<legend class="scheduler-border">Customizing the "Previous" Link</legend>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="prev_link">prev_link</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'prev_link',
							  'id'          => 'prev_link',							  
							  'class'		=> 'form-control',
							  'value'		=> element('prev_link', $options),
							  'placeholder'	=> 'prev_link'
							);

				echo form_input($data); ?>
				<p class="help-block">prev_link</p>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="prev_tag_open">prev_tag_open</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'prev_tag_open',
							  'id'          => 'prev_tag_open',							  
							  'class'		=> 'form-control',
							  'value'		=> element('prev_tag_open', $options),
							  'placeholder'	=> 'prev_tag_open'
							);

				echo form_input($data); ?>
				<p class="help-block">prev_tag_open</p>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="prev_tag_close">prev_tag_close</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'prev_tag_close',
							  'id'          => 'prev_tag_close',							  
							  'class'		=> 'form-control',
							  'value'		=> element('prev_tag_close', $options),
							  'placeholder'	=> 'prev_tag_close'
							);

				echo form_input($data); ?>
				<p class="help-block">prev_tag_close</p>
			</div>
		</div>
	</fieldset>	
	
	
	
	<fieldset class="scheduler-border">
		<legend class="scheduler-border">Customizing the "Current Page" Link</legend>		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="cur_tag_open">cur_tag_open</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'cur_tag_open',
							  'id'          => 'cur_tag_open',							  
							  'class'		=> 'form-control',
							  'value'		=> element('cur_tag_open', $options),
							  'placeholder'	=> 'cur_tag_open'
							);

				echo form_input($data); ?>
				<p class="help-block">cur_tag_open</p>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="cur_tag_close">cur_tag_close</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'cur_tag_close',
							  'id'          => 'cur_tag_close',							  
							  'class'		=> 'form-control',
							  'value'		=> element('cur_tag_close', $options),
							  'placeholder'	=> 'cur_tag_close'
							);

				echo form_input($data); ?>
				<p class="help-block">cur_tag_close</p>
			</div>
		</div>
	</fieldset>
	
	
	<fieldset class="scheduler-border">
		<legend class="scheduler-border">Customizing the "Digit" Link</legend>		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="num_tag_open">num_tag_open</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'num_tag_open',
							  'id'          => 'num_tag_open',							  
							  'class'		=> 'form-control',
							  'value'		=> element('num_tag_open', $options),
							  'placeholder'	=> 'num_tag_open'
							);

				echo form_input($data); ?>
				<p class="help-block">num_tag_open</p>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="num_tag_close">num_tag_close</label>
			<div class="col-sm-9">
			   <?php $data = array(
							  'name'        => 'num_tag_close',
							  'id'          => 'num_tag_close',							  
							  'class'		=> 'form-control',
							  'value'		=> element('num_tag_close', $options),
							  'placeholder'	=> 'num_tag_close'
							);

				echo form_input($data); ?>
				<p class="help-block">num_tag_close</p>
			</div>
		</div>
	</fieldset>	
	
	
	<fieldset class="scheduler-border">
		<legend class="scheduler-border">Hiding the Pages</legend>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="num_tag_close">display_pages</label>
			<div class="col-sm-9" >				
			<div class="">
				<input type="hidden" value="0" name="display_pages"/>
			    <?php $data = array(
					'name'        => 'display_pages',
					'id'          => 'display_pages',
					'value'       => '1',
					'checked'     => intval(element('display_pages', $options)) === 1,
					'style'       => 'margin:10px',
					'class'		  => 'm-0 p-absolute',
					'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
					);
				echo form_checkbox($data); ?>
			</div>
			<p class="help-block">display_pages</p>					
		</div>
		</div>
		
	</fieldset>	
			
	
	</div>
	
	<div class="box-footer text-center" id="settings-page" data-bind="ScrollToFixed:{ bottom: 0, limit: $('#settings-page').offset().top}">
		<button type="" class="btn btn-warning btn-flat" data-bind="css: { 'has-spinner active' : $root.SearchSettings.ajaxProcess}">
		<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
		Restore Default</button>
		<button type="submit" class="btn btn-primary btn-flat" data-bind="css: { 'has-spinner active' : $root.SearchSettings.ajaxProcess}">
		<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
		Save changes</button>
	</div>
	
<?php echo form_close(); ?>