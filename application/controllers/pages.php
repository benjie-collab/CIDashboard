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
		$this->load->model(array('postmeta_model', 'pages_model','statistics_model', 'search_model', 'tags_model', 'servers_model', 'categorization_model'));	
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
				
			$page 		= $this->pages_model->get_page($id);		
			$post_meta 	=  (object)$this->postmeta_model->get_postmeta(array('post_id' => $id));		
			if($page && $post_meta){
				$page->post_meta			= $post_meta;
				$template 					= isset($post_meta->template)? $post_meta->template: 'default';
				$data['query_settings'] 	= $parameters;
				$data['title'] 				= $page->post_title;
				$data['js'] 				= array('js/pages.js');				
				$data['page'] 				= $page;
				$data['tools'] 				= array(
												'edit' => 'pages/tools-edit'
											);
				$data['main_content']		= 'pages/templates/' . $template;
				
				$this->session->set_userdata('current_page', $page);
				$this->session->set_userdata('widgets_tool', array());
				$this->session->set_userdata('widgets_js', array());
				$this->session->set_userdata('widgets_css', array());
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
			$this->form_validation->set_rules('post_title', 'post_title', 'required|min_length[5]');
			$this->form_validation->set_rules('server', 'server', 'required');
			
			if($method == 'POST'){
				$parameters = $_POST;
				header('Content-Type: application/json');
				
				if ($this->form_validation->run()){
					$id = $this->pages_model->add_page($parameters);
					if ($id){
						$styles_meta =array(										
										'post_id' => $id,
										'meta_key' => 'styles',
										'meta_value'=> serialize(element('styles_meta', $parameters))									
									);
						$p_id = $this->postmeta_model->save_postmeta($styles_meta);
						$users_meta =array(										
										'post_id' => $id,
										'meta_key' => 'users',
										'meta_value'=> serialize(element('users_meta', $parameters))									
									);
						$p_id = $this->postmeta_model->save_postmeta($users_meta);
						
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
	
	function edit_content($id = null)
	{
		$method = $this->input->server('REQUEST_METHOD');	
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}
		elseif($id && $method == 'POST'){	
			$parameters = $_POST;
			header('Content-Type: application/json');
			
			$parameters = array(
						'post_content' => serialize($parameters)
						);
						
			if ($this->pages_model->update_page($id, $parameters)){
					
				$message = $this->notification->messages()? $this->notification->messages(): $this->session->flashdata('message');	
				echo json_encode( 
					array( 
						'response' => 'success', 
						'message' => $message,
						'redirect' => base_url('pages/index/'.$id)
					), true);
			}
			else
			{
				$message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');	
				echo json_encode( array( 'response' => 'danger', 'message' => $message), true);		
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
	
	function edit($id = null)
	{
		
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}
		elseif($id){
			$method = $this->input->server('REQUEST_METHOD');
			$this->form_validation->set_rules('post_title', 'post_title', 'required|min_length[5]');
			$this->form_validation->set_rules('server', 'server', 'required');
			
			if($method == 'POST'){
				$parameters = $_POST;
				header('Content-Type: application/json');
				
				if ($this->form_validation->run() && $this->pages_model->update_page($id, $parameters)){
					$styles_meta =array(			
									'meta_value'=> serialize(element('styles_meta', $parameters))							
								);
					$p_id = $this->postmeta_model->update_postmeta($id, 'styles', $styles_meta);

					$users_meta =array(			
									'meta_value'=> serialize(element('users_meta', $parameters))							
								);
					$p_id = $this->postmeta_model->update_postmeta($id, 'users', $users_meta);	
					
					$message = $this->notification->messages()? $this->notification->messages(): $this->session->flashdata('message');
					echo json_encode( 
						array( 
							'response' => 'success', 
							'message' => $message
						), true);	
				}
				else
				{
					$message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');	
					echo json_encode( array( 'response' => 'danger', 'message' => $message), true);		
				}
				
			}else{		
				$page = $this->pages_model->get_page($id);		
				$styles_meta 				=  (object)$this->postmeta_model->get_postmeta(array('post_id' => $id, 'meta_key' => 'styles'));	
				$page->styles_meta			= $styles_meta;
				$users_meta 				=  (object)$this->postmeta_model->get_postmeta(array('post_id' => $id, 'meta_key' => 'users'));	
				$page->users_meta			= $users_meta;
				
				$this->data['modal_title'] 	 = 'Edit Page';
				$this->data['modal_content'] = 'pages/edit';
				$this->data['parameters'] 	 =  $_GET;
				$this->data['page'] 		 =  $page;
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
	
	
	
	function modal()
	{
		if (!$this->users->logged_in())
		{
			r_direct_login();
		}
		else
		{
			$get_data 		= $_GET;
			$path			= element('path', $get_data);
			if($path)
			{				
				$data['data']	= $get_data;		
				echo $this->load->view(urldecode($path), $data); 				
			}else{
				r_direct('dashboard');
			}			
		}
	}
	
	
	function search($start=null)
	{
		if (!$this->users->logged_in())
		{
			r_direct_login();
		}
		else
		{
			$parameters = array();	
			if ($this->input->server('REQUEST_METHOD') === 'POST'){
				$parameters = $_POST;			
			}			
			elseif ($this->input->server('REQUEST_METHOD') === 'GET'){
				$parameters = $_GET;						
			}


			$search_results	 = $this->idol->QueryAction($parameters);			
			$message = $this->notification->errors()? $this->notification->errors(): ($this->notification->messages()? $this->notification->messages() : $this->session->flashdata('message'));
			
			if(!empty($search_results)):					
				$results = clean_json_response($search_results);				
				$responsedata = get_responsedata($results);
				$data['responsedata'] = $responsedata;
				$data['template']		= element('template', $parameters);
				$data['search_parameters']= $parameters;
				$template = isset($parameters['template'])? $parameters['template']['name']: 'document-template-chat';	
				echo $this->load->view('template/'.$template, $data); 
			else:
				echo 'No results...';
			endif;
		}
	}
	
	

}