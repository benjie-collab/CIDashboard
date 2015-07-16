<?php 
/*
* @Title: DBS Issues Sol.
* @Method: Pages
* @icon: ion-wand ion
* @Description: Displays the result of the documents with configurable options.
*/ 
?>

<?php 	
/** 
	Received Parameters:
	$widget_key
	$meta_key
	$query_settings
**/
	
	$query_config	= $this->application->get_config('query','actions');
	$query_settings = isset($query_settings)?	$query_settings : $this->application->get_session_userdata('current_search');	
	$dbs_customer 	= $this->application->get_session_userdata('dbs_customer');
	
	$is_page 		= $this->application->is_page();
	$options 		= isset($meta_key)? $this->application->get_settings(urldecode($meta_key)) : array();
	
	$template_options 	= array_key_exists('template', $options)? element('template', $options): array();
	$data_options 	= array_key_exists('data', $options)? element('data', $options): array();
	
	$ts = generate_timestamp();		
	
	$get_data		= $_GET;
	
	$fieldname = end(explode(  '/', element('fieldname', $data_options)));
	$fieldtext[] = 'MATCH{' . (array_key_exists($fieldname, $get_data)? element($fieldname, $get_data) : 'CLOSED') . '}:' .$fieldname;
	$fieldtext[] = 'EMPTY{}:' .$fieldname;	
	
	/**
						$query = array_merge(
									//$query_config,
									//$query_settings,
									$data_options,
									$get_data,
									array(
										'fieldtext' => join(' OR ', $fieldtext),									
										'action' => 'suggestontext',										
										'totalresults' => true
									));
						$results = $this->search_model->call_search($query);
						$results = clean_json_response($results);						
						
						$totalhits 	= array_get_value($results, 'autn:totalhits');
						$numhits 		= array_get_value($results, 'autn:numhits');
						$document_options = $this->application->get_config('document_options', 'template');	
						
						$hit 		= array_get_value($results, 'autn:hit');	
						$solutions 	= intval($numhits)===1? array( 0 => $hit) : $hit;**/
	
	
	
	//$template = array_key_exists('name', $template_options) ? element('name', $template_options): 'document-template-chat';	
?>

			<?php
			$atts = array(
					'class' => 'form-inline',
					'data-bind' => "jQueryLiveSearch: 
										{ 
											input: '#livesearch-input-" . $ts . "',
											container: '#livesearch-container-" . $ts . "',
											spinner: '#livesearch-spinner-" . $ts . "',
											template: '" . htmlspecialchars(json_encode($template_options, JSON_NUMERIC_CHECK), ENT_QUOTES, 'UTF-8') . "',
											url : '" . base_url('search/') . "',
											event : 'masonry'
										}", 
					'method' => 'POST',
					'onSubmit' => 'return false;',
					'id' => 'widget_options_form'
					
					);
			$hidden 		= array_merge(
							$data_options,
							//$get_data,
							array(
								'fieldtext' => join(' OR ', $fieldtext),	
								'dataType'=> "html",
								'summary' => 'concept',
								'totalresults' => true,	
								//'action' => 'suggestontext',
								'template' => $template_options
								
							) );	
							

			 echo form_open( 'app/widget_options', $atts, $hidden ); ?>			
				<div class="text-center">
				<div class="input-group input-group-md">
					<div class="form-group has-feedback text-left">						 
					  <input id="livesearch-input-<?=$ts?>" type="text" class="form-control input-md" placeholder="Search" name="text" size="40"/>					  
						<span class="form-control-feedback m-r-20 typeahead-spinner" id="livesearch-spinner-<?=$ts?>"><i class="fa fa fa-spinner fa fa-spin text-muted"></i></span>
						<span class="form-control-feedback"><i class="fa fa-microphone text-muted"></i></span>						
					</div>
					<span class="input-group-btn">
					  <button type="submit" class="btn btn-flat btn-xl <?=element('submit_buttons', $page)?>">Search</button>
					</span>
				</div>
				</div>
				<div data-bind="" class="m-t-10 ">
					<div class="w-100" id="livesearch-container-<?=$ts?>">	
						
					</div>						
				</div>		
			<?=form_close()?>


	
		


