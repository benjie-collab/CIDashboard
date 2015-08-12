<?php

class Tools extends CI_Controller {

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */	

    public function __construct()
    {
        parent::__construct();
		
		$this->load->database();			
		$this->load->library('Datatables');		
		$this->load->library('table');	
		$this->lang->load('template');
		$this->load->model(array( 'categorization_model', 'servers_model', 'restapisimulator_model'));
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
			r_direct('tools/categorybuilder');			
		}
	}
	
	
	function categorybuilder_datatable()
    {
        $this->datatables->select('id,name,description,active')
            //->unset_column('id')
			->filter('user_id', $this->users->get_user_id())
			->add_column('actions', get_buttons('$1', 'tools/categorybuilder', array('edit', 'delete', 'view')), 'id')
            ->from('categorization');
        echo $this->datatables->generate();
    }
	
	
	function categorybuilder($action=null, $id=null)
	{
		if (!$this->users->logged_in())
		{
			r_direct_login();
		}
		else
		{		
			$method = $this->input->server('REQUEST_METHOD');
			
			if     (strcasecmp($action, 'add')==0){
				if($method == 'POST'){
					$this->form_validation->set_rules('name', 'name', 'required|min_length[5]');
					
					if ($this->form_validation->run() == false){
						$message = (validation_errors() ? validation_errors() : ($this->notification->errors() ? $this->notification->errors() : $this->notification->messages()));				
						header('Content-Type: application/json');
						echo json_encode( array( 'response' => 'danger', 'message' => $message ), true);
						
					}else{	
						$parameters = $_POST;	
						$cat = $this->categorization_model->add_categorization(NULL, $parameters);						
										
						$message = ($this->notification->errors()? $this->notification->errors() : $this->notification->messages());
						
						
						header('Content-Type: application/json');	
						if($cat)
						echo json_encode(array( 
							'response' => 'success', 
							'message' => $message, 
							'redirect' => base_url('tools/categorybuilder')
							), 
						true);				
						else
						echo json_encode(array( 
							'response' => 'danger', 
							'message' => $message, 
							'redirect' => base_url('tools/categorybuilder') ), 
						true);		
					}
							
				}else{	
					//Display Add form					
					$data['title'] 	= 'Add Categorization';
					$data['js'] 	= array('js/categorybuilder.js');				
					$data['main_content']= 'tools/pages/categorybuilder-add';
					$this->load->view('tools/template', $data); 
				}
			
			}elseif(strcasecmp($action, 'edit')==0 && $id){
				
				if($method=='POST'){
					$parameters = $_POST;	
					$this->form_validation->set_rules('name', 'name', 'required|min_length[5]');
					
					if ($this->form_validation->run() == false){
						$message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');						
						header('Content-Type: application/json');
						echo json_encode( array( 'response' => 'danger', 'message' => $message ), true);				
					}else{	
						$cat = $this->categorization_model->update_categorization($parameters);												
						$message = ($this->notification->errors()? $this->notification->errors() : $this->notification->messages());						
						
						header('Content-Type: application/json');	
						if($cat)
						echo json_encode(array( 
							'response' => 'success', 
							'message' => $message
							), 
						true);				
						else
						echo json_encode(array( 
							'response' => 'danger', 
							'message' => $message
							), 
						true);				
					}
				}else{
				//Display edit form
				$categorization  = $this->categorization_model->get_categorization($id);
				if($categorization){		
					$data['title'] 	= 'Edit Categorization';
					$data['js'] 	= array('js/categorybuilder.js');				
					$data['main_content']= 'tools/pages/categorybuilder-edit';
					$data['categorization'] = $categorization;
					$this->load->view('tools/template', $data); 
				}else{
					r_direct();
				}	
				
				}
				
			}elseif(strcasecmp($action, 'view')==0 && $id){				
				
				//Display categorization
				$categorization  = $this->categorization_model->get_categorization($id);
				if($categorization){		
					$data['title'] 	= 'Categorization Preview';
					$data['js'] 	= array('js/categorybuilder.js');				
					$data['main_content']= 'tools/pages/categorybuilder-view';
					$data['categorization'] = $categorization;
					$this->load->view('tools/template', $data); 
				}else{
					r_direct();
				}	
				
				
				
			}elseif(strcasecmp($action, 'delete')==0 && $id){
				$cat = $this->categorization_model->delete_categorization($id);									
				$message = ($this->notification->errors()? $this->notification->errors() : $this->notification->messages());				
				header('Content-Type: application/json');	
				if($cat)
				echo json_encode(array( 
					'response' => 'success', 
					'message' => $message,
					'redirect' => base_url('tools/categorybuilder'),
					), 
				true);				
				else
				echo json_encode(array( 
					'response' => 'danger', 
					'message' => $message,
					'redirect' => base_url('tools/categorybuilder'),
					), 
				true);	
			}else{			
				$data['title'] 	= 'Category Builder';
				$data['js'] 	= array('js/categorybuilder.js');				
				$data['main_content']= 'tools/pages/categorybuilder';
				$this->load->view('tools/template', $data); 
			}
		
			
			
				
		}
	}	
	
	
	
	
	
	function categorization($id=null, $action=null)
	{	
		if (!$this->users->logged_in())
		{
			r_direct_login();
			
		}elseif($id) 
		{
			$method = $this->input->server('REQUEST_METHOD');
			
			if($method=='POST'){
				$parameters = $_POST;	
				$this->form_validation->set_rules('name', 'name', 'required|min_length[5]');
				
				if ($this->form_validation->run() == false){
					$message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');						
					header('Content-Type: application/json');
					echo json_encode( array( 'response' => 'danger', 'message' => $message ), true);				
				}else{	
					$cat = $this->categorization_model->update_categorization($parameters);						
									
					$message = ($this->notification->errors()? $this->notification->errors() : $this->notification->messages());
					
					header('Content-Type: application/json');	
					if($cat)
					echo json_encode(array( 
						'response' => 'success', 
						'message' => $message
						), 
					true);				
					else
					echo json_encode(array( 
						'response' => 'danger', 
						'message' => $message
						), 
					true);				
				}		
					
			}elseif(strcasecmp($action, 'delete')==0)
			{
				$cat = $this->categorization_model->delete_categorization($id);									
				$message = ($this->notification->errors()? $this->notification->errors() : $this->notification->messages());				
				header('Content-Type: application/json');	
				if($cat)
				echo json_encode(array( 
					'response' => 'success', 
					'message' => $message,
					'redirect' => base_url('tools/categorybuilder'),
					), 
				true);				
				else
				echo json_encode(array( 
					'response' => 'danger', 
					'message' => $message,
					'redirect' => base_url('tools/categorybuilder'),
					), 
				true);	
			
			}else{		
				$tool_page 		 = $this->application->get_methods('application/views/tools/pages/', 'categorybuilder');
				$categorization  = $this->categorization_model->get_categorization($id);
				if($tool_page && $categorization){		
					$tool_page 		= reset($tool_page);
					$data['title'] 	= element('@title', $tool_page);
					$data['js'] 	= array('js/' . element('@method', $tool_page) . '.js');				
					$data['main_content']= 'tools/pages/categorybuilder';
					$data['categorization'] = $categorization;
					$this->load->view('tools/template', $data); 
				}else{
					r_direct();
				}		
			}
			
		}else
		{		
			r_direct();
		}			
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	function delete_categorization($id=null)
	{
		$this->output->cache(0);	
		if (!$this->users->logged_in())
		{
			r_direct_login();
		}
		elseif($id) //remove this elseif if you want to enable this for non-admins
		{						
			$cat = $this->categorization_model->delete_categorization($id);
			r_direct();
		}else
		{		
			r_direct('dashboard');
		}			
	}
	
	
	function edit_categorization($id=null)
	{
		$this->output->cache(0);	
		if (!$this->users->logged_in())
		{
			r_direct_login();
			
		}elseif($id) 
		{
			$parameters = array();	
			if ($this->input->server('REQUEST_METHOD') === 'POST'){
				$parameters = $_POST;			
			}			
			elseif ($this->input->server('REQUEST_METHOD') === 'GET'){
				$parameters = $_GET;						
			}
			
			
			if(!$parameters){
				$tool_page 		 = $this->application->get_methods('application/views/tools/pages/', 'categorybuilder');
				$categorization  = $this->categorization_model->get_categorization($id);
				if($tool_page){		
					$tool_page 		= reset($tool_page);
					$data['title'] 	= element('@title', $tool_page);
					//$data['tool'] 	= 'categorybuilder';
					$data['js'] 	= array('js/' . element('@method', $tool_page) . '.js');				
					$data['main_content']= 'tools/pages/categorybuilder';
					$data['categorization'] = $categorization;
					$this->load->view('tools/template', $data); 
				}else{
					r_direct('dashboard');
				}			
			}else{		
				
				$this->form_validation->set_rules('name', 'name', 'required|min_length[5]');
				
				if ($this->form_validation->run() == false){
					$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');						
					header('Content-Type: application/json');
					echo json_encode( array( 'response' => 'danger', 'message' => $data['message'] ), true);				
				}else{	
				
					$cat = $this->categorization_model->update_categorization($parameters);					
					header('Content-Type: application/json');
					
					if($cat)
					echo json_encode(array( 
						'response' => 'success', 
						'message' => element('name', $parameters) . ' Saved...', 
						'redirect' => base_url('tools/edit_categorization/'. element('id', $parameters)) ), 
					true);				
				}		
			}
			
		}else
		{		
			r_direct('dashboard');
		}			
	}
	
	
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  

  
  
  
	function restapisimulator($action=null)
	{
		if (!$this->users->logged_in())
		{
			r_direct_login();
			
		}elseif($this->input->server('REQUEST_METHOD') === 'POST'){
			$parameters = $_POST;
			$response = $this->restapisimulator_model->run($parameters);
			header('Content-Type: application/json');
			echo json_encode( $response, true);			
		}else
		{
			$actions = $this->application->get_config('actions', 'actions');			
			if(!$action){
				$action = array_keys($actions)[0];
			}	
			
			if(!$action){
				r_direct('dashboard');	
			}else{				
				$action_ = $this->application->get_config($action, 'actions');		
				$data['title'] 		= 'Rest API Simulator';
				$data['js'] 		= array('js/restapisimulator.js');	
				//$data['tool'] 		= 'restapisimulator';
				$data['action'] 	= $action_;
				$data['actions'] 	= $actions;
				$data['main_content']= 'tools/pages/restapisimulator';
				$this->load->view('tools/template', $data); 	
			}
			
			
		
			
		}
	}	
	

}