<?php

class Typeahead extends CI_Controller {

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */	

    public function __construct()
    {
        parent::__construct();
		
		$this->load->database();		
		$this->load->model('search_model');		
		$this->load->helper('url');
		$this->load->helper('language');
		
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'users'), $this->config->item('error_end_delimiter', 'users'));
		
    }
	
	
	function index()
	{
		header('Content-Type: application/json');
			
	
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}
		else //remove this elseif if you want to enable this for non-admins
		{
			
			
			if($this->query->method() == 'POST'){
				$parameters = (isset($_POST) && !empty($_POST))? $_POST : array();
				$results = $this->search_model->call_term_expand($parameters);
				
				$data['results'] = ($results==false) ? array() : $results;	
				$data['message'] = ($results==false) ? 
					$this->config->item('error_start_delimiter', 'search').lang('search_error_message').$this->config->item('error_end_delimiter', 'search')
					: $this->session->flashdata('message');	
				
				
				$results = array_get_value(element('source', parameters), $results);
				echo json_encode($results, true);
			
			}
			
			elseif($this->query->method() == 'GET'){
				$parameters = (isset($_GET) && !empty($_GET))? $_GET : array();
				$results = $this->search_model->call_term_expand($parameters);
				
				$data['results'] = ($results==false) ? array() : $results;	
				$data['message'] = ($results==false) ? 
					$this->config->item('error_start_delimiter', 'search').lang('search_error_message').$this->config->item('error_end_delimiter', 'search')
					: $this->session->flashdata('message');	
				
				$results = array_get_value(element('source', parameters), $results);
				echo json_encode($results, true);			
			}
			
			
		}
	}
	
	
	
	
	
	
	
	
	
	
	

  

}