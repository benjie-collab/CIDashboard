<?php 
	
	
	/**
	$per_page				= array_key_exists('per_page', $user_meta)? $user_meta['per_page'] : $pagination['per_page'];
	$base_url				= array_key_exists('base_url', $user_meta)? $user_meta['base_url'] : $pagination['base_url'];
	$total_rows				= array_key_exists('total_rows', $user_meta)? $user_meta['total_rows'] : $pagination['total_rows'];
	
	
	**/
	
	$user_options	=  $this->search_model->get_options($setting.'_settings');
	$options		=  $this->application->get_config('pagination', 'pagination');
	$options		= array_merge($options, $user_options);
	
	
	
	$atts = array(
			'class' => 'form-horizontal',
			'data-bind' => 'submit: $root.SearchSettings.formSubmit', 
			'method' => 'POST',
			'onSubmit' => 'return false;',
			'id' => 'search_settings_form'
	);
	
	$hidden 		= array('meta_key' => 'pagination_settings');
	
?>

<?php echo form_open( '/search/save_settings/', $atts, $hidden ); ?>
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
							  'value'		=> $options['per_page'],
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
							  'value'		=> $options['base_url'] ,
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
							  'value'		=> $options['total_rows'],
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
							  'value'		=> $options['uri_segment'],
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
							  'value'		=> $options['num_links'] ,
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
				<div class="">
				   <?php $data = array(
						'name'        => 'use_page_numbers',
						'id'          => 'use_page_numbers',
						'value'       => 'true',
						'checked'     => $options['use_page_numbers'],
						'style'       => 'margin:10px',
						'class'		  => 'm-0 p-absolute',
						'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
						);

					echo form_checkbox($data); ?>
				</div>
				<p class="help-block">use_page_numbers</p>					
			</div>	
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="page_query_string">page_query_string</label>	
			<div class="col-sm-9" >				
				<div class="">
				   <?php $data = array(
						'name'        => 'page_query_string',
						'id'          => 'page_query_string',
						'value'       => 'true',
						'checked'     => $options['page_query_string'],
						'style'       => 'margin:10px',
						'class'		  => 'm-0 p-absolute',
						'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
						);

					echo form_checkbox($data); ?>
				</div>
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
							  'value'		=> $options['full_tag_open'] ,
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
							  'value'		=> $options['full_tag_close'] ,
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
							  'value'		=> $options['first_link'] ,
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
							  'value'		=> $options['first_tag_open'] ,
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
							  'value'		=> $options['first_tag_close'] ,
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
							  'value'		=> $options['last_link'] ,
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
							  'value'		=> $options['last_tag_open'] ,
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
							  'value'		=> $options['last_tag_close'] ,
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
							  'value'		=> $options['next_link'],
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
							  'value'		=> $options['next_tag_open'],
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
							  'value'		=> $options['next_tag_close'],
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
							  'value'		=> $options['prev_link'],
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
							  'value'		=> $options['prev_tag_open'],
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
							  'value'		=> $options['prev_tag_close'],
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
							  'value'		=> $options['cur_tag_open'] ,
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
							  'value'		=> $options['cur_tag_close'],
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
							  'value'		=> $options['num_tag_open'] ,
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
							  'value'		=> $options['num_tag_close'],
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
			   <?php $data = array(
					'name'        => 'display_pages',
					'id'          => 'display_pages',
					'value'       => 'true',
					'checked'     => $options['display_pages'],
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
	
	<div class="box-footer text-center">
		<button type="submit" class="btn btn-primary" data-bind="css: { 'has-spinner active' : $root.SearchSettings.ajaxProcess}">
		<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
		Save changes</button>
	</div>
	
<?php echo form_close(); ?>