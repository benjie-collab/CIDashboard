<?php

class Synonyms extends CI_Controller {

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */	

    public function __construct()
    {
        parent::__construct();
		
    }
	
	function index()
	{
		$this->output->cache(0);		
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}
		elseif ($this->users->is_admin()) //remove this elseif if you want to enable this for non-admins
		{						
			$data['parameters'] = $_POST;
			echo $this->load->view('synonyms/popover-form', $data); 			
		}else
		{		
			r_direct('search');
		}	
	}
	
	
	
	
}