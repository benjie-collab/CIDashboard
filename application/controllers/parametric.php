<?php

class Parametric extends CI_Controller {

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */		

    public function __construct()
    {
        parent::__construct(); 		
		
		$this->load->library(array('document_lib', 'parametric_lib'));		
		$this->load->model(array( 'search_model', 'usermeta_model', 'statistics_model', 'document_model', 'terms_model', 'tags_model'));
		$this->form_validation->set_error_delimiters(
			$this->application->get_config('error_start_delimiter', 'users'), 
			$this->application->get_config('error_end_delimiter', 'users')
		);		
    }
	
	function index()
	{
		
		if (!$this->users->logged_in())
		{			
			r_direct_login();
		}
		else
		{		
			$parameters = (isset($_POST) && !empty($_POST))? $_POST : array();
			
			$responsedata = $this->tags_model->call_get_tag_names(
							array(
								'fieldtype'=> 'parametric'
							));
			$res = $this->parametric_lib->build_fancytree_tagnames(
					$responsedata,
					NULL,
					array(
						'lazy' => true,
						'folder' => true
					));
			header('Content-Type: application/json');
			echo json_encode($res, true);
		}
	}
	
	
	function tag_values()
	{
		
		if (!$this->users->logged_in())
		{			
			r_direct_login();
		}
		else
		{		
			$parameters = (isset($_GET) && !empty($_GET))? $_GET : array();
			
			$responsedata 		= $this->tags_model->call_get_tag_values($parameters);
			
			$res = $this->parametric_lib->build_fancytree_tagvalues(
					$responsedata,
					NULL,
					array(
						'lazy' => false,
						'folder' => false
					));
			header('Content-Type: application/json');
			echo json_encode($res, true);
		}
	}
	
	
	
}