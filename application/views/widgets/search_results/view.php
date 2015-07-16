<?php 
/*
* @Title: Search Results
* @Method: Search 
* @icon: fa-list-ol
* @Description: Search results list. Configure the view accordingly especially the document view.
*/ 
?>
<?php 	
/** 
	Received Parameters:
	$widget_key
	$meta_key
	$query_settings
**/

	$options 	= $this->application->get_settings($meta_key);	
	$data_options= array_get_value($options, 'data');
	$templates = $this->application->get_templates('application/views/template/', 'DocumentTemplate');	
	$template_options 	= array_key_exists('template', $options)? element('template', $options): array(); 
	$template = array_key_exists('name', $template_options) ? element('name', $template_options): 'document-template-chat';
	
	/** Dropdown options **/
	$sorts				= $this->application->get_config('sorts', 'search');
	$results_per_page	= $this->application->get_config('results_per_page', 'search');
	$default_elements	= array_keys($this->document_lib->default_elements());				
			
			$query_settings = array_merge($search_parameters, $data_options);
			/**
			$parameters = array();	
			if ($this->input->server('REQUEST_METHOD') === 'POST'){
				$parameters = $_POST;			
			}			
			elseif ($this->input->server('REQUEST_METHOD') === 'GET'){
				$parameters = $_GET;						
			}	
			
			$start = 1;
			
			//Get previous Search Options from Session 
			$query_settings_sess 		= $this->application->get_session_userdata('current_search');	
			$query_parameters 			= $this->application->get_config('query', 'actions');	
			$search_settings 			= $this->usermeta_model->get_usermeta(null, array('meta_key'=> 'settings_search'));			
			$um_search_settings		 	= array_merge(
											$query_parameters, 
											array('server'=>element('server', $search_settings)),
											$data_options
										);				
			if ($parameters):
				// Massage parameters 
				$parameters['databasematch'] = array_key_exists('databasematch', $parameters)? array_values($parameters['databasematch']) : element('databasematch', $query_settings_sess) ;
				// New search reset to page 1 	
				$start = 1;
				$query_settings = array_merge($um_search_settings, $query_settings_sess, $parameters, array('start' => $start));			
				
			elseif($page):
				// This call is pagination load options from session			
				$query_settings = array_merge($um_search_settings, $query_settings_sess);				
				$start = $page-1;
				$query_settings = array_merge($query_settings, array('start' => ($start*$query_settings['maxresults'])+1));
			
			else:
				//Its not a post  Give all results				
				$query_settings = $um_search_settings;
				
			endif;	**/
			
				
			// Call Search	
		
			$search_results	 = $this->idol->QueryAction($query_settings);			
			$message = $this->notification->errors()? $this->notification->errors(): ($this->notification->messages()? $this->notification->messages() : $this->session->flashdata('message'));
			
if(!empty($search_results)):	
	
	$results = clean_json_response($search_results);
	$responsedata = get_responsedata($results);
	$sort 				= array_key_exists('sort', $query_settings)? 			element('sort', $query_settings): ''; 
	$maxresults 		= array_key_exists('maxresults', $query_settings)? 		element('maxresults', $query_settings): 0; 
	$totalresults 		= array_key_exists('autn:totalhits', $responsedata)?  	element('autn:totalhits', $responsedata): 0;	
	$numhits 			= array_key_exists('autn:numhits', $responsedata)?  	element('autn:numhits', $responsedata) : 0;		
	$info				=
						$this->search_model->search_info(
									array( 
											'total_rows' 	=> intval($totalresults), 
											'per_page' 		=> intval($maxresults),
											'start' 		=> intval(element('start', $query_settings)),
										)
								);
?>

<div class="box box-default o-hidden">			
	
	<div class="box-header with-border">
	  <h3 class="box-title">
	  <i class="fa <?=element('icon', $options)?>"></i>
	  <?=element('title', $options)?>	</h3>	 
	  <div class="box-tools pull-right">
		 <?php
		$atts = array('class' => '');			 
		echo form_open('/search/?'. http_build_query($_GET), $atts); ?>
		
		<div class="btn-group btn-box-tool">
		  <button class="btn btn-xs btn-default" type="button">Export</button>
		  <button data-toggle="dropdown" class="btn-xs btn btn-default dropdown-toggle" type="button">
			<span class="caret"></span>
			<span class="sr-only">Export</span>
		  </button>
		  <ul role="menu" class="dropdown-menu">
			<li><a href="#">PDF</a></li>
			<li><a href="#">CSV</a></li>
		  </ul>
		</div>
		<?php 
			if( element('sort', $options)):
			$atts = 'class="w-auto btn-group-xs btn-box-tool btn-flat"  data-size="5" data-bind="BootstrapSelect:{ container: \'body\'}, event: { change: function(dta,e){ $(e.target).closest(\'form\').trigger(\'submit\') }}"';				
			echo form_dropdown('sort', $sorts, $sort, $atts);
			endif;
		?>
		<?php 
			if( element('maxresults', $options)):
			$atts = 'class="w-auto btn-group-xs btn-box-tool btn-flat"  data-size="5" data-bind="BootstrapSelect:{ container: \'body\'}, event: { change: function(dta,e){ $(e.target).closest(\'form\').trigger(\'submit\') }}"';
			echo form_dropdown('maxresults', $results_per_page, $maxresults, $atts);
			endif;
		?>
		<?php echo form_close(); ?>
		
			
	  </div> 	  
	</div>
	
	<div class="box-body">	
		<small class="text-muted"><?=$info?> in <?=$this->idol->response_time()?></small>		
		<?php 
		$data['responsedata'] = $responsedata;
		$data['template'] = $template_options;		
		echo $this->load->view('template/'.$template, $data); 
		?>
	</div>
	<div class="box-footer clearfix">
		<?php
		$pagination_config 			=  $this->application->get_config('pagination','pagination');
		$pagination_saved			= $this->usermeta_model->get_usermeta(0, array( 'meta_key' => 'settings_pagination'));
		$pagination					=  $this->search_model->pagination(
											array_merge(
												$pagination_config,
												$pagination_saved,
												array( 
													'total_rows' => intval($totalresults), 
													'per_page' => intval($query_settings['maxresults'])
												)
											)
								);									

		?>
		<div class="pull-right">
		<?=$pagination;?>
		</div>
	</div>
</div>		
<?php
else:

					
?>
	
			<?php echo (!$message)? '':  $message;?>
<?php
endif;
?>











