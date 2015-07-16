<?php

class Terms extends CI_Controller {

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
		$this->load->model(array( 'terms_model'));
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
			
			$terms = $this->terms_model->call_term_get_all($parameters);
			
			header('Content-Type: application/json');
			echo json_encode($terms, true);
		}	
		
	}
	
	function get_all()
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
			
			$terms = $this->terms_model->call_term_get_all($parameters);
			
			header('Content-Type: application/json');
			echo json_encode($terms, true);
		}	
		
	}
	
	
	
	
	
	
	function get_best()
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
			
			$terms = $this->terms_model->call_term_get_best($parameters);
			
			header('Content-Type: application/json');
			echo json_encode($terms, true);
		}	
		
	}
	
	
	function get_expand()
	{		
		
		header('Content-Type: application/json');			
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
			
			
				$results = $this->terms_model->call_term_expand($parameters);
				
				$data['results'] = ($results==false) ? array() : $results;	
				$data['message'] = ($results==false) ? 
					$this->config->item('error_start_delimiter', 'search').lang('search_error_message').$this->config->item('error_end_delimiter', 'search')
					: $this->session->flashdata('message');	
				
				
				$results = array_get_value((array)$results, element('source', $parameters));
				echo json_encode($results, true);
			
			
		}	
		
	}
	
	function get_info()
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
			$terms = $this->terms_model->call_term_get_info($parameters);
			
			header('Content-Type: application/json');
			echo json_encode($terms, true);
		}	
		
	}
	
	
	
	
	
	
	
	
	
	
}