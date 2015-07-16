<?php 
$prefix = isset($prefix)? $prefix: '';
$search_settings = $this->application->get_session_userdata('search_settings');	
$document_template = isset($document_template)? $document_template: array();

?>
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="form-group">	
			<label class="control-label" for="template_name">Template</label>
			<div class="">
		   <?php 
				$templates = $this->application->get_templates('application/views/template/', 'DocumentTemplate');
				$atts = 'class="form-control"  data-bind="BootstrapSelect:{}"';
				echo form_dropdown($prefix .'[name]', $templates, element('name', $document_template), $atts);
			?>
				<p class="help-block">Some help text</p>
			</div>		
		</div>						
	</div>
	
	<div class="col-md-6">
			<?php
			$document_options = $this->application->get_config('document_options', 'template');
			//$document_options = array_chunk(element('elements', $document_options ), 2, true);
			$document_options = element('elements', $document_options );
			

			foreach($document_options as $name=>$element):
			if(is_str_contain($name, '[]')){ //its array					
			$name_ = str_replace("[]", "", $name);
			$selected = is_array($document_template)? array_key_exists($name_, $document_template)? element($name_, $document_template): array() : array();
			$elements = array_combine($selected,$selected);
		?>
			<div class="form-group has-feedback m-0">	
				<label class="control-label col-md-3" for="<?=$name?>"><?=$element?></label>
				<div class="col-md-9">	
				<?php 
					$atts = 'class="form-control selectpicker" data-live-search="true" data-max-options="10" multiple data-size="5" 
					data-bind="BootstrapSelectAjax: {											
							ajax: {
								url: \'' . base_url('tags/get_tag_names') . '\',
								data: function () {
									var params = {
										text: \'{{{q}}}\',
										source: \'autn:name\',
										server: \'' . element('server', $search_settings) . '\',
									};
									return params;
								}
							},
							locale: {
								emptyTitle: \'Search for fields...\'
							},
							preprocessData: function(data){
								var fields = [];
								var len = data.length;
								for(var i = 0; i < len; i++){
									var curr = data[i];
									fields.push(
										{
											value: curr,
											text: curr,
											disable: false
										}
									);
								}
								return fields;
							},
							preserveSelected: true,
							preserveSelectedPosition: \'before\',
							emptyRequest: false,
							restoreOnError: true
							
						}"';
					echo form_dropdown($prefix .'[' .$name_ . '][]', $elements, $selected, $atts);
				?>
				
				<span class="form-control-feedback typeahead-spinner"><i class="fa fa fa-spinner fa fa-spin text-muted"></i></span>
				<p class="help-block">Some help text</p>
				</div>
			</div>				
		<?php
			}else{
		?>
			<div class="form-group has-feedback m-0">	
				<label class="control-label col-md-3" for="<?=$name?>"><?=$element?></label>
				<div class="col-md-9">
				<?php 								
					$data = array(
								'name'        => $prefix .'[' .$name . ']',
								'id'          => $name,
								'class'		  => 'form-control',
								'value'		  => element($name, $document_template),		
								'data-bind'   => "
									TypeAhead:{
											ajax: {
													url: '". base_url('tags/get_tag_names'). "',																	
													params: {
														totalresults: 'true',
														source: 'autn:name',
														server: '" . element('server', $search_settings) . "',
													}								
												}
										}"
							);
					echo form_input($data); 
				?>						
				<span class="form-control-feedback typeahead-spinner"><i class="fa fa fa-spinner fa fa-spin text-muted"></i></span>
				<p class="help-block">Some help text</p>
				</div>
			</div>	
		<?php }	
			endforeach;	
		?>		
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="col-sm-3 control-label" for="read_more_text">Read More Text</label>
			<div class="col-sm-9">
			   <?php						
						$data = array(
								  'name'        => $prefix .'[read_more_text]',
								  'id'          => 'read_more_text',							  
								  'class'		=> 'form-control',
								  'value'		=> element('read_more_text', $document_template),
								);
						echo form_input($data);
					?>
				<p class="help-block">Some help text</p>
			</div>
		</div>
	</div>
</div>

			
