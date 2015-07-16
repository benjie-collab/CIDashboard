<?php

class Search extends CI_Controller {

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */		

    public function __construct()
    {
        parent::__construct();
		
		$this->lang->load('search'); 		
		$this->load->library(array('dashboard_lib','document_lib'));		
		//$this->load->model(array( 'servers_model', 'search_model', 'usermeta_model', 'statistics_model', 'document_model', 'terms_model', 'tags_model', 'suggest_model'));
		
		$this->load->model( array('statistics_model', 'search_model', 'usermeta_model', 'servers_model'));
		
		$this->form_validation->set_error_delimiters(
			$this->application->get_config('error_start_delimiter', 'template'), 
			$this->application->get_config('error_end_delimiter', 'template')
		);		
    }
	
	function index($start=null)
	{
		
		if (!$this->users->logged_in())
		{			
			r_direct_login();
		}
		else
		{		
		
			/**
			$parameters = array();	
			if ($this->input->server('REQUEST_METHOD') === 'POST'){
				$parameters = $_POST;			
			}			
			elseif ($this->input->server('REQUEST_METHOD') === 'GET'){
				$parameters = $_GET;						
			}	
			
			$start = 1;
			
			$data['title'] 	= 'Research';
			$data['js'] 	= array('js/search.js');
			
			//Get previous Search Options from Session 
			$query_settings_sess 		= $this->application->get_session_userdata('current_search');	
			$query_parameters 			= $this->application->get_config('query', 'actions');	
			$search_settings 			= $this->usermeta_model->get_usermeta(null, array('meta_key'=> 'settings_search'));			
			$um_search_settings		 	= array_merge(
											$query_parameters, 
											array('server'=>element('server', $search_settings))											
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
				
			endif;
			
			
				
			// Call Search
			$raw	 = $this->idol->QueryAction($query_settings);			
			$results = clean_json_response($raw);
			
			//Prepare Custom Search Widgets 
			foreach($this->search_model->widget_containers as $key=>$container):
				$data['widget_' . $key] = $this->search_model->get_options('widget_' . $key);
			endforeach;				
			
			//Tools
			$data['tools'] 			= 'search/tools-index';

			//Pass results 
			$data['raw'] 			= clean_terms_json_response($raw);
			$data['results'] 		= $results;
			$data['responsedata'] 	= get_responsedata($results);
			$data['page'] 			= $page?$page:1;
			$data['query_settings']	= $query_settings;
			$data['template']		= element('template', $parameters);
			$data['search_settings']=$search_settings;
			
			
			

			// Add Message
			$data['message'] = $this->notification->errors()? $this->notification->errors() : ($this->notification->messages()? $this->notification->messages() : $this->session->flashdata('message'));
				
				
			if(strcasecmp(element('dataType', $parameters), 'json') ===0 ){
				header('Content-Type: application/json');
				echo json_encode($data['responsedata'], true);	
			}elseif(strcasecmp(element('dataType', $parameters), 'html') ===0){	
				$template = array_key_exists('name', $data['template']) ? element('name', $data['template']): 'document-template-chat';	
				echo $this->load->view('template/'.$template, $data); 			
			}else{
				//Save current search options to session 
				$this->session->set_userdata('current_search', $query_settings);
				$this->load->view('search/index', $data); 
			}**/
			
			$search_parameters = $this->search_model->search_parameters(array('start'=> $start));
			$search_settings = $this->usermeta_model->get_usermeta(0, array('meta_key'=> 'settings_search'));		
			$data['title'] 	= 'Research';
			//$data['page'] 	= $page;
			$data['js'] 	= array('js/search.js');
			$data['tools'] 			= 'search/tools-index';
			$data['template']		= element('template', $search_settings);
			$data['search_parameters']= $search_parameters;
			$data['search_settings']= $search_settings;
			
			
			
			$this->session->set_userdata('search_settings', $search_settings);
			$this->session->set_userdata('search_parameters', $search_parameters);
			//$this->session->set_userdata('current_search', $query_settings);
			$this->load->view('search/index', $data); 
			
		}
		
	}
	
	
	
	
	
	
	function document($id=null)
	{				
		$this->output->cache(0);
		if (!$this->users->logged_in())
		{			
			r_direct_login();
		}
		elseif ( $id )
		{
			$data['title'] 	= 'Document';
			$data['js'] 		= array('js/search.js');								
			$document = $this->document_model->call_get_content(array('id' => $id));
			$data['tools'] 	= 'search/tools-document';
			$data['document'] = $document;
			$this->load->view('search/document', $data);			
		}
		else
		{
			r_direct();
		}
	}	
	
	
	function options()
	{
		$post_data = (isset($_POST) && !empty($_POST))? $_POST : array();	
	
		if (!$this->users->logged_in())
		{
			r_direct_login();
		}
		elseif ($this->users->is_admin() && !empty($post_data)) //remove this elseif if you want to enable this for non-admins
		{					
			$usermeta= array();
			$usermeta[element('meta_key',$post_data)] = $post_data;
			$meta = $this->usermeta_model->save_usermeta(0, $usermeta);	
			header('Content-Type: application/json');
			echo json_encode($meta, true);	
			
			
		}else
		{		
			r_direct();
		}			
	}
	
	
	function query()
	{		
	
		if (!$this->users->logged_in())
		{
			r_direct_login();
		}
		else //remove this elseif if you want to enable this for non-admins
		{					
			$parameters = array();	
			if ($this->input->server('REQUEST_METHOD') === 'POST'){
				$parameters = $_POST;			
			}			
			elseif ($this->input->server('REQUEST_METHOD') === 'GET'){
				$parameters = $_GET;						
			}		
			
			$query_settings_sess 		= $this->application->get_session_userdata('current_search');	
			$query_parameters 			= $this->application->get_config('query', 'actions');	
			$search_settings 			= $this->usermeta_model->get_usermeta(0, array('meta_key'=> 'settings_search'));			
			$um_search_settings		 	= array_merge(
											$query_parameters, 
											$search_settings,
											$parameters
										);	
										
										
			$raw	 = $this->idol->QueryAction($um_search_settings);	
			$raw	 = array_get_value($raw, 'autn:hit');
			$results = clean_json_response($raw);
			header('Content-Type: application/json');
			echo json_encode($results, true);
			
		}		
	}
	
	
	
	
}