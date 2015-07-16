<?php

class Dashboard extends CI_Controller {

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */	

    public function __construct()
    {
        parent::__construct();
		
		$this->load->database();
		$this->lang->load('dashboard');  		
		$this->load->model(array('search_model','rules_model', 'usermeta_model', 'widgets_model')); 
		$this->load->library(array());		
		$this->load->helper(array('url','language'));		
		$this->form_validation->set_error_delimiters(
			$this->config->item('error_start_delimiter', 'template'), 
			$this->config->item('error_end_delimiter', 'template'));	
    }	
	
	function index()
	{
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();			
		}
		else //remove this elseif if you want to enable this for non-admins
		{
			$post_data = (isset($_POST) && !empty($_POST))? $_POST : array();			
			
			if($post_data){
				$usermeta= array();
				$usermeta[element('meta_key',$post_data)] = $post_data;
				$meta = $this->usermeta_model->save_usermeta(0, $usermeta);	
				header('Content-Type: application/json');
				echo json_encode($meta, true);			
			}else{					
				//set the flash data error message if there is one
				$data['title'] 	= 'Index Page';
				$data['js'] 	= array('js/dashboard.js');
				$data['message'] 	= (validation_errors()) ? validation_errors() : $this->session->flashdata('message');			
				$data['main_content'] = 'dashboard/index';
				$data['tools'] 	= 'dashboard/tools-index';
				
				$this->load->view('dashboard/template', $data); 
			}		
		}
	}	
	
}