<?php

class App extends CI_Controller {

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */		

    public function __construct()
    {
        parent::__construct();
		
		$this->load->library(array('document_lib', 'statistics_lib'));
		$this->load->model(array('usermeta_model', 'rules_model', 'tags_model', 'search_model', 'servers_model'));
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
			r_direct('dashboard');
		}
	}	
	
	
	
	function switch_mode()
	{
		if (!$this->users->logged_in())
		{			
			r_direct_login();
		}else
		{			
			$method = $this->input->server('REQUEST_METHOD');
			if($method = 'POST'){
				$post_data = $_POST;
				$mode = $this->application->set_mode(element('name', $post_data), element('mode', $post_data));	
				
				if ($this->agent && $this->agent->is_referral())
				{
					$r_direct =  $this->agent->referrer();
				}
				else{
					$r_direct =  'dashboard';
				}
			}else{			
			
			}			
			redirect($r_direct, 'location', 301);
		}
			
	}
	
	
	
	
	
	function delete_widget(){
	
		if (!$this->users->logged_in())
		{			
			r_direct_login();
		}else
		{			
			$method = $this->input->server('REQUEST_METHOD');
			if($method = 'POST'){
				$post_data = $_POST;
				if(element('widget_key', $post_data)){
				
					$widget = $this->usermeta_model->delete_usermeta(element('widget_key', $post_data));
					header('Content-Type: application/json');
					echo json_encode($widget, true);
				}				
			}	
				
		}
	
	}
	
	
	function widget_modal($widget=null, $meta_key=null)
	{
		if (!$this->users->logged_in())
		{
			r_direct_login();
		}
		else
		{
			$get_data = $_GET;
			$data['modal_title'] 	 	= urldecode(element('title', $get_data));
			$data['modal_content'] 		= 'widgets/'. $widget .'/view-modal';
			$data['meta_key']  			= $meta_key;		
			echo $this->load->view('template/modal-widget', $data); 				
		}
	}
	
	
	function widget_options($meta_key=null)
	{
		if (!$this->users->logged_in())
		{
			r_direct_login();
		}
		else
		{
			$delimiter 	= $this->application->get_config('metakey_delimiter', 'template');
			$keys				= array();
			$meta_key 			= urldecode($meta_key);
			$is_statistics		= false;
			$widget_key 		= extract_metakey($meta_key, $delimiter);	
			$exist 				= file_exists( FCPATH . '\\application\\views\\widgets\\' . $widget_key);	
			
			if($exist){
				$folder 		= $widget_key;
				$widget_key 	= $meta_key;				
			}else{		
				$keys 			= $this->statistics_lib->extract_statistics_key($widget_key);
				$folder 		= element('type', $keys);
				$is_statistics 	= true;
			}
			
			$method = $this->input->server('REQUEST_METHOD');			
			if($widget_key){
				$get_data = $_GET;					
				if($is_statistics){
					$data['modal_title'] 	 	= element('type', $keys) . " Options";
					$data['modal_content'] 		= 'widgets/'. $folder .'/options';
					$data['widget_key'] 		= $widget_key;
					$data['meta_key']  			= $meta_key;
				}else{
					$data['modal_title'] 	 	= 'Widget Options';
					$data['modal_content'] 		= 'widgets/'. $folder .'/options';
					$data['widget_key'] 		= $widget_key;
					$data['meta_key']  			= $meta_key;
				}
				echo $this->load->view('template/modal-widget-options', $data); 
			}elseif($method == 'POST'){			
				header('Content-Type: application/json');
				$post_data = $_POST;
				$key = element('meta_key', $post_data);
				unset($post_data['meta_key']);
				$widget[$key] = $post_data;
				$meta = $this->usermeta_model->save_usermeta(NULL, $widget);	


				if ($meta)
				{			
					$this->session->set_flashdata('message', $this->notification->messages());
					echo json_encode(array( 
						'response' => 'success', 
						'message' => $this->notification->messages()
						), 
					true);	
				}else{
					$message = (validation_errors() ? validation_errors() : ($this->notification->errors() ? $this->notification->errors() : $this->session->flashdata('message')));
					$this->session->set_flashdata('message', $message);
					echo json_encode(array( 
						'response' => 'danger', 
						'message' => $message ), 
					true);	
				}			
			}
			
				
		}
	}	
}