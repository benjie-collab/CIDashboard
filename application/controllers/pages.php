<?php

class Pages extends CI_Controller {

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */	

    public function __construct()
    {
        parent::__construct();
		
		$this->load->database();
		$this->lang->load('pages');  		
		$this->load->library(array('statistics_lib'));	
		$this->load->model(array('pages_model', 'statistics_model', 'widgets_model', 'search_model', 'tags_model', 'servers_model'));	
		$this->load->helper(array('url','language'));		
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'users'), $this->config->item('error_end_delimiter', 'users'));
    }
	
	function index($id=null)
	{
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}
		elseif($id)
		{			
			$parameters =  array();
			if ($this->input->server('REQUEST_METHOD') === 'POST'){
				$parameters =  $_POST;
			}elseif ($this->input->server('REQUEST_METHOD') === 'GET'){
				$parameters =  $_GET;
			}
				
			$page = $this->pages_model->get_page($id);					
			if($page){	
				$page = array_merge($page, array('id'=>$id));			
				$template 					= element('template', $page) ? element('template', $page) : 'default';
				$data['query_settings'] 	= $parameters;
				$data['title'] 				= element('page_name', $page);
				$data['js'] 				= array('js/pages.js');				
				$data['page'] 				= $page;
				$data['tools'] 				= array(
												'edit' => 'pages/tools-edit'
											);
				$data['main_content']		= 'pages/templates/' . $template;
				
				$this->session->set_userdata('current_page', $page);
				$this->session->set_userdata('widgets_tool', array());
				$this->session->set_userdata('widgets_js', array());
				$this->session->set_userdata('current_search', $parameters);
				$this->load->view('pages/index', $data); 
			}else{
				r_direct('dashboard');
			}			
		}
		else
		{
			r_direct('dashboard');
		}
	}
	
	
	function add()
	{				
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}
		else
		{
			$method = $this->input->server('REQUEST_METHOD');
			$this->form_validation->set_rules('page_name', 'page_name', 'required|min_length[5]');
			$this->form_validation->set_rules('server', 'server', 'required');
			
			if($method == 'POST'){
				$parameters = $_POST;
				header('Content-Type: application/json');
				
				if ($this->form_validation->run()){
					$id = $this->pages_model->add_page($parameters);
					if ($id){
						
						$message = $this->notification->messages()? $this->notification->messages(): $this->session->flashdata('message');							
						header('Content-Type: application/json');
						echo json_encode( 
							array( 
								'response' => 'success', 
								'message' => $message,
								'redirect' => base_url('pages/index/'.$id)
							), true);
						
					}else{	
					
						$message = $this->notification->errors()? $this->notification->errors(): $this->session->flashdata('message');			
						echo json_encode( array( 'response' => 'danger', 'message' => $message), true);			
							
					}
				}
				else
				{
					$message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');	
					echo json_encode( array( 'response' => 'danger', 'message' => $message), true);		
				}
				
			}else{		
		
				$this->data['modal_title'] 	 = 'Add New Page';
				$this->data['modal_content'] = 'pages/add';
				$this->data['parameters'] 	 =  $_GET;
				echo $this->load->view('template/modal-pages', $this->data); 	
			}
		}
	}
	
	
	
	
	function delete($id=null)
	{
	
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}		
		elseif ($id)
		{							
			header('Content-Type: application/json');	
			if( $this->pages_model->delete_page($id)){
				$message = $this->notification->messages()? $this->notification->messages(): $this->session->flashdata('message');	
				echo json_encode(array( 
					'response' => 'success', 
					'message' => $message,
					'redirect' => base_url('dashboard')
					), 
				true);				
			}else{
				$message = $this->notification->errors()? $this->notification->errors(): $this->session->flashdata('message');	
				echo json_encode(array( 
					'response' => 'danger', 
					'message' => $message),
				true);
				}			
		}
		else
		{					
			r_direct('dashboard');
		}
	}
	
	
	
	function edit($id = null)
	{
		
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}
		elseif($id){
		
			/**
			$method = $this->input->server('REQUEST_METHOD');
			$this->form_validation->set_rules('page_name', 'page_name', 'required|min_length[5]');
			$this->form_validation->set_rules('server', 'server', 'required');
			
			if($method == 'POST'){
				$parameters = $_POST;
				header('Content-Type: application/json');
				if ($this->form_validation->run() == true && $this->pages_model->update_page($id, $parameters)  ){
					
					$message = $this->notification->messages()? $this->notification->messages(): $this->session->flashdata('message');		
					
					header('Content-Type: application/json');
					echo json_encode( 
						array( 
							'response' => 'success', 
							'message' => $message,
							'redirect' => base_url('pages/index/'.$id)
						), true);
					
				}else{	
				
					$message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');				
					
					header('Content-Type: application/json');
					echo json_encode( array( 'response' => 'danger', 'message' => $message), true);					
						
				}
				
			}else{		
				r_direct('dashboard');	
			}		**/
			
			
			
			$method = $this->input->server('REQUEST_METHOD');
			$this->form_validation->set_rules('page_name', 'page_name', 'required|min_length[5]');
			$this->form_validation->set_rules('server', 'server', 'required');
			
			if($method == 'POST'){
				$parameters = $_POST;
				header('Content-Type: application/json');
				
				if ($this->form_validation->run() && $this->pages_model->update_page($id, $parameters)){
					if ($id){
						
						$message = $this->notification->messages()? $this->notification->messages(): $this->session->flashdata('message');	
						echo json_encode( 
							array( 
								'response' => 'success', 
								'message' => $message,
								'redirect' => base_url('pages/index/'.$id)
							), true);
						
					}else{	
					
						$message = $this->notification->errors()? $this->notification->errors(): $this->session->flashdata('message');			
						echo json_encode( array( 'response' => 'danger', 'message' => $message), true);			
							
					}
				}
				else
				{
					$message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');	
					echo json_encode( array( 'response' => 'danger', 'message' => $message), true);		
				}
				
			}else{		
				$page = $this->pages_model->get_page($id);	
				$this->data['modal_title'] 	 = 'Edit Page';
				$this->data['modal_content'] = 'pages/edit';
				$this->data['parameters'] 	 =  $_GET;
				$this->data['page'] 		 =  array_merge($page, array('id'=> $id));
				echo $this->load->view('template/modal-pages', $this->data); 	
			}			
			
		}else{
			$this->notification->set_error('pages_error_notfound');
			$message = $this->notification->errors()? $this->notification->errors(): $this->session->flashdata('message');			
			echo json_encode(array( 
				'response' => 'danger', 
				'message' => $message),
			true);	
			r_direct('dashboard');
		}
		
	}
	
	

}