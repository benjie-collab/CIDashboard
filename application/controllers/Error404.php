<?php

class Error404 extends CI_Controller {

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */		

    public function __construct()
    {
        parent::__construct();
    }
	
	public function index() 
    { 
        $this->output->set_status_header('404'); 
        $data['main_content'] = 'error/404'; // View name 
        $this->load->view('error/template',$data);//loading in my template 
    } 
}