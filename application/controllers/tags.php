<?php

class Tags extends CI_Controller {

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */		

    public function __construct()
    {
        parent::__construct();
		
		$this->lang->load('search'); 		
		$this->load->library(array('document_lib'));		
		$this->load->model(array( 'tags_model'));
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'users'), $this->config->item('error_end_delimiter', 'users'));		
    }
	
	function index()
	{		
	
		if (!$this->users->logged_in())
		{
			r_direct_login();
		
		}else
		{		
			$parameters = array();	
			if ($this->input->server('REQUEST_METHOD') === 'POST'){
				$parameters = $_POST;			
			}
			
			elseif ($this->input->server('REQUEST_METHOD') === 'GET'){
				$parameters = $_GET;						
			}
			
			$tags = $this->tags_model->call_get_query_tag_values($parameters);			
			header('Content-Type: application/json');
			echo json_encode($tags, true);
		}	
		
	}
	
	function get_query_tag_values()
	{		
	
		if (!$this->users->logged_in())
		{
			r_direct_login();
		
		}else
		{		
			$parameters = array();	
			if ($this->input->server('REQUEST_METHOD') === 'POST'){
				$parameters = $_POST;			
			}
			
			elseif ($this->input->server('REQUEST_METHOD') === 'GET'){
				$parameters = $_GET;						
			}
			
			$tags = $this->tags_model->call_get_query_tag_values($parameters);			
			header('Content-Type: application/json');
			echo json_encode($tags, true);
		}	
		
	}
	
	
	function get_tag_names()
	{		
		
	
		if (!$this->users->logged_in())
		{
			r_direct_login();
		
		}else
		{	
			$parameters = array();	
			if ($this->input->server('REQUEST_METHOD') === 'POST'){
				$parameters = $_POST;			
			}
			
			elseif ($this->input->server('REQUEST_METHOD') === 'GET'){
				$parameters = $_GET;						
			}
		
			$results = $this->tags_model->call_get_tag_names($parameters);				
			//$data['results'] = ($results==false) ? array() : $results;				
			$results = array_get_value((array)$results, element('source', $parameters));
			
			$options = $this->application->get_config('options', 'actions');
			$tagnames = array_key_exists('tagnames', $options) ? element('tagnames', $options): array();
			if(array_key_exists('text', $parameters))
			$results = array_filter(
							array_merge($results, $tagnames), 
							function ($var) use ($parameters)
							{ 
								return (stripos($var, element('text', $parameters)) !== false); 
							
							});	
							
			echo json_encode(array_values($results) , true);	
				
		}	
		
	}
	
	function get_tag_values()
	{			
		if (!$this->users->logged_in())
		{
			r_direct_login();
		
		}else
		{	
			$parameters = array();	
			if ($this->input->server('REQUEST_METHOD') === 'POST'){
				$parameters = $_POST;			
			}
			
			elseif ($this->input->server('REQUEST_METHOD') === 'GET'){
				$parameters = $_GET;						
			}
			
			$tags = $this->tags_model->call_get_tag_values($parameters);			
			header('Content-Type: application/json');
			echo json_encode($tags, true);
		}	
		
	}
	
	
	
	
}