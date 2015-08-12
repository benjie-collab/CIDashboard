<?php

class Settings extends CI_Controller {

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */		

    public function __construct()
    {
        parent::__construct();
		
		$this->lang->load('actions'); 		
		$this->load->library(array('dashboard_lib','document_lib'));		
		$this->load->model(array( 'search_model', 'usermeta_model', 'statistics_model', 'document_model', 'terms_model', 'tags_model', 'servers_model'));
		$this->form_validation->set_error_delimiters(
			$this->application->get_config('error_start_delimiter', 'users'), 
			$this->application->get_config('error_end_delimiter', 'users')
		);		
    }
	
	function index()
	{				
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}
		elseif ($this->users->is_admin()){
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST'){
				$parameters = $_POST;
				$settings = $this->usermeta_model->save_usermeta(0, array(element('meta_key', $parameters) => $parameters ));

				header('Content-Type: application/json');
				if ($settings)
				{			
					$this->session->set_flashdata('message', $this->notification->messages());					
					echo json_encode(array( 
						'response' => 'success', 
						'message' => $this->notification->messages()
						), 
					true);				
					
				}else{			
					$this->session->set_flashdata('message', $this->notification->errors());		
					echo json_encode(array( 
						'response' => 'danger', 
						'message' => $this->notification->errors() ), 
					true);					
				}
			}else{
				r_direct('settings/general');
			}						
		}else
		{			
			r_direct('settings/general');			
		}
	}
	
	
	//create a new user
	function logo()
	{
	
		if (!$this->users->logged_in())
		{		
			r_direct_login();
		}
		elseif ($this->users->is_admin()) //remove this elseif if you want to enable this for non-admins
		{	
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST'){
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				//$config['max_size']	= '100';
				//$config['max_width']  = '1024';
				//$config['max_height']  = '768';
				$this->load->library('upload', $config);
				$parameters = $_POST;
				
				header('Content-Type: application/json');
				if ( ! $this->upload->do_upload('file'))
				//if ( ! $this->upload->do_multi_upload('file'))
				{					
					$this->notification->set_error($this->upload->display_errors());
					$message = $this->notification->errors();
					
					echo json_encode(array( 
					'response' => 'danger', 
					'message' => $message
					), true);
				}
				else
				{
					//$file_data = $this->upload->get_multi_upload_data();
					$file_data = $this->upload->data();
					$logo = $config['upload_path'] . element('file_name', $file_data);
					
					if($this->usermeta_model->save_usermeta(0, array(element('meta_key', $parameters) => $logo )))
					{
						$this->session->set_flashdata('message', $this->notification->messages() );		
						echo json_encode(array( 
							'response' => 'success', 
							'message' => $this->notification->messages()
							), 
						true);	

					}
					else
					{
						//redirect them back to the admin page if admin, or to the base url if non admin
						$this->session->set_flashdata('message', $this->notification->errors() );
						echo json_encode(array( 
							'response' => 'danger', 
							'message' => $this->notification->errors()
							), 
						true);	

					}						
				}	
			}else{
				$data['title'] 		= "General Settings";
				$data['js'] 	 	= array('js/settings.js');	
				$data['settings'] = $this->application->general_setting();
				$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				$data['main_content'] = 'settings/pages/general';
				$this->load->view('settings/template', $data);  
			}
		}else
		{		
			r_direct('dashboard');
		}		
	}
	
	
	function favicon()
	{
	
		if (!$this->users->logged_in())
		{		
			r_direct_login();
		}
		elseif ($this->users->is_admin()) //remove this elseif if you want to enable this for non-admins
		{	
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST'){
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = '*';
				//$config['max_size']	= '100';
				//$config['max_width']  = '1024';
				//$config['max_height']  = '768';
				$this->load->library('upload', $config);
				$parameters = $_POST;
				
				header('Content-Type: application/json');
				if ( ! $this->upload->do_upload('file'))
				//if ( ! $this->upload->do_multi_upload('file'))
				{					
					$this->notification->set_error($this->upload->display_errors());
					$message = $this->notification->errors();
					
					echo json_encode(array( 
					'response' => 'danger', 
					'message' => $message
					), true);
				}
				else
				{
					//$file_data = $this->upload->get_multi_upload_data();
					$file_data = $this->upload->data();
					$logo = $config['upload_path'] . element('file_name', $file_data);
					
					if($this->usermeta_model->save_usermeta(0, array(element('meta_key', $parameters) => $logo )))
					{
						$this->session->set_flashdata('message', $this->notification->messages() );		
						echo json_encode(array( 
							'response' => 'success', 
							'message' => $this->notification->messages()
							), 
						true);	

					}
					else
					{
						//redirect them back to the admin page if admin, or to the base url if non admin
						$this->session->set_flashdata('message', $this->notification->errors() );
						echo json_encode(array( 
							'response' => 'danger', 
							'message' => $this->notification->errors()
							), 
						true);	

					}						
				}	
			}else{
				$data['title'] 		= "General Settings";
				$data['js'] 	 	= array('js/settings.js');	
				$data['settings'] = $this->application->general_setting();
				$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				$data['main_content'] = 'settings/pages/general';
				$this->load->view('settings/template', $data);  
			}
		}else
		{		
			r_direct('dashboard');
		}
		
	}
	
	function general()
	{				
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}
		elseif ($this->users->is_admin()) //remove this elseif if you want to enable this for non-admins
		{	
			$data['title'] 		= "General Settings";
			$data['js'] 	 	= array('js/settings.js');	
			$data['settings'] = $this->application->general_setting();
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$data['main_content'] = 'settings/pages/general';
			$this->load->view('settings/template', $data); 
		}else
		{		
			r_direct('dashboard');
		}	
	}
	
	function styles()
	{		
		$data['title'] 		= "Styles Settings";
		$data['js'] 	 	= array('js/settings.js');	
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}
		elseif ($this->users->is_admin()) //remove this elseif if you want to enable this for non-admins
		{								
			$data['settings'] = $this->application->styles_setting();
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$data['main_content'] = 'settings/pages/styles';
			$this->load->view('settings/template', $data);  
		}else
		{		
			r_direct('dashboard');
		}	
	}
	
	function search()
	{		
		$data['title'] 		= "Search Settings";
		$data['js'] 	 	= array('js/settings.js');	
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}
		elseif ($this->users->is_admin()) //remove this elseif if you want to enable this for non-admins
		{								
			$data['settings'] = $this->application->search_setting();
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$data['main_content'] = 'settings/pages/search';
			$this->load->view('settings/template', $data);  
		}else
		{		
			r_direct('dashboard');
		}
	
	}
	
	
	function others($page=null)
	{		
		$parameters = (isset($_POST) && !empty($_POST))? $_POST : array();		
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}
		elseif ($this->users->is_admin()) //remove this elseif if you want to enable this for non-admins
		{			
			if(!empty($parameters)){
				$meta = $this->usermeta_model->save_usermeta(
							0, 
							array(element('meta_key', $parameters) => $parameters )
						);		
				header('Content-Type: application/json');
				echo json_encode($meta, true);		
			}else{			
				$status = $this->status->get_status();	
				$data['server_status'] = $status;
				$data['page'] = $page;
				$this->load->view('settings/template', $data);  
			}
			
		}else
		{		
			r_direct('dashboard');
		}
	
	}
	
	
	function query($page=null)
	{		
		$parameters = (isset($_POST) && !empty($_POST))? $_POST : array();		
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}
		elseif ($this->users->is_admin()) //remove this elseif if you want to enable this for non-admins
		{			
		
			if(!empty($parameters)){
				$meta = $this->usermeta_model->save_usermeta(
							0, 
							array(element('meta_key', $parameters) => $parameters )
						);		
				header('Content-Type: application/json');
				echo json_encode($meta, true);		
			}else{			
				$status = $this->status->get_status();	
				$data['server_status'] = $status;
				$data['page'] = $page;
				$this->load->view('settings/template', $data);  
			}
			
		}else
		{		
			r_direct('dashboard');
		}
	
	}
	
	
	function tag($page=null)
	{		
		$parameters = (isset($_POST) && !empty($_POST))? $_POST : array();		
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}
		elseif ($this->users->is_admin()) //remove this elseif if you want to enable this for non-admins
		{			
		
			if(!empty($parameters)){
				$meta = $this->usermeta_model->save_usermeta(
							0, 
							array(element('meta_key', $parameters) => $parameters )
						);		
				header('Content-Type: application/json');
				echo json_encode($meta, true);		
			}else{			
				$status = $this->status->get_status();	
				$data['server_status'] = $status;
				$data['page'] = $page;
				$this->load->view('settings/template', $data);  
			}
			
		}else
		{		
			r_direct('dashboard');
		}
	
	}
	
	
	function term($page=null)
	{		
		$parameters = (isset($_POST) && !empty($_POST))? $_POST : array();		
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}
		elseif ($this->users->is_admin()) //remove this elseif if you want to enable this for non-admins
		{						
		
			if(!empty($parameters)){
				$meta = $this->usermeta_model->save_usermeta(
							0, 
							array(element('meta_key', $parameters) => $parameters )
						);		
				header('Content-Type: application/json');
				echo json_encode($meta, true);		
			}else{			
				$status = $this->status->get_status();	
				$data['server_status'] = $status;
				$data['page'] = $page;
				$this->load->view('settings/template', $data);  
			}
			
		}else
		{		
			r_direct('dashboard');
		}
	
	}
	
	
	
	
	function connect()
	{		
		$parameters = (isset($_POST) && !empty($_POST))? $_POST : array();		
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}
		elseif ($this->users->is_admin()) //remove this elseif if you want to enable this for non-admins
		{	
			$page =  $this->uri->segment(3);
			$response = $this->status->save_status($parameters);
			header('Content-Type: application/json');
			echo json_encode($response, true);			
		}else
		{		
			r_direct('dashboard');
		}	
	}
	
	
	
	function status()
	{		
		$parameters = (isset($_POST) && !empty($_POST))? $_POST : array();		
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}
		elseif ($this->users->is_admin()) //remove this elseif if you want to enable this for non-admins
		{	
			$status = $this->status->get_status();
			header('Content-Type: application/json');
			echo json_encode($status, JSON_NUMERIC_CHECK);			
		}else
		{		
			r_direct('dashboard');
		}	
	}
		
	
}