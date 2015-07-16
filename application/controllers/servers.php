<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Servers extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();			
		$this->load->library('Datatables');		
		$this->load->library('table');		
		
		$this->load->helper(array('url','language'));
		$this->load->model(array('servers_model'));	
		$this->lang->load('servers');
		$this->form_validation->set_error_delimiters(
			$this->config->item('error_start_delimiter', 'template'), 
			$this->config->item('error_end_delimiter', 'template'));		
		
	}

	//redirect if needed, otherwise display the user list
	function index()
	{
		$this->data['title'] = "Current Servers";
		$this->data['js'] 	 = array('js/servers.js');	
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}else
		{
			$this->data['message'] = $this->session->flashdata('message');	
			//$this->data['servers'] = $this->servers_model->get_servers();
			$this->data['main_content'] = 'servers/index';
			$this->load->view('servers/template', $this->data); 
		}
		
	}
	
	
	function datatable()
    {
        $this->datatables->select('id,server,username,password')
            ->unset_column('id')
			->add_column('actions', get_buttons('$1', 'servers',array('edit', 'delete', 'view')), 'id')
            ->from('servers');			
        echo $this->datatables->generate();
    }

	
	//create a new user
	function add()
	{
	
		if (!$this->users->logged_in())
		{		
			r_direct_login();
		}
		elseif ($this->users->is_admin())
		{
			$method = $this->input->server('REQUEST_METHOD');
			if($method == 'POST'){
				header('Content-Type: application/json');
				$this->form_validation->set_rules('server', $this->lang->line('create_server_validation_url_label'), 'required|prep_url|valid_url_format|url_exists');

				if ($this->form_validation->run() == true)
				{
					$server = array(
						'server' => $this->input->post('server'),
						'port'  => $this->input->post('port'),
						'username'  => $this->input->post('username'),
						'password'  => $this->input->post('password'),
					);
				}
				if ($this->form_validation->run() == true && $this->servers_model->save_server($server))
				{			
					$this->session->set_flashdata('message', $this->notification->messages());
					
					echo json_encode(array( 
						'response' => 'success', 
						'message' => $this->notification->messages(), 
						'redirect' => base_url('servers')
						), 
					true);				
					
				}else{
					$message =  (validation_errors() ? validation_errors() : ($this->notification->errors() ? $this->notification->errors() : $this->session->flashdata('message')));
					echo json_encode(array( 
						'response' => 'danger', 
						'message' => $message ), 
					true);					
				}
			}else{
				$this->data['server'] = array(
					'name'  => 'server',
					'id'    => 'server',
					'class' => 'form-control',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('server'),
				);
				$this->data['port'] = array(
					'name'  => 'port',
					'id'    => 'port',
					'class' => 'form-control',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('port'),
				);
				
				$this->data['username'] = array(
					'name'  => 'username',
					'id'    => 'username',
					'class' => 'form-control',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('username'),
				);
				
				$this->data['password'] = array(
					'name'  => 'password',
					'id'    => 'password',
					'class' => 'form-control',
					'type'  => 'password',
					'value' => $this->form_validation->set_value('password'),
				);
				$this->data['message'] = $this->notification->errors() ? $this->notification->errors() : $this->notification->messages();	
				$this->data['title'] = 'Add New Server';
				$this->data['main_content'] = 'servers/add';
				$this->load->view('servers/template', $this->data);			
			}
		}
		else 
		{
			r_direct('dashboard');
		}
		
	}

	function delete($id=null)
	{
	
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}		
		elseif ($this->users->is_admin() && $id)
		{			
			$server = $this->servers_model->delete_server($id);									
			$message = $this->notification->errors() ? $this->notification->errors() : $this->notification->messages();			
			header('Content-Type: application/json');	
			if($server)
			echo json_encode(array( 
				'response' => 'success', 
				'message' => $message
				), 
			true);				
			else
			echo json_encode(array( 
				'response' => 'danger', 
				'message' => $message),
			true);	
		}
		else
		{					
			r_direct('dashboard');
		}
	}
	
	//edit a user
	function edit($id=null)
	{
	
		if (!$this->users->logged_in())
		{		
			r_direct_login();
		}
		elseif ($this->users->is_admin() && $id)
		{
			$method = $this->input->server('REQUEST_METHOD');
			$server = (object)$this->servers_model->get_server($id)->row();
			$this->form_validation->set_rules('server', $this->lang->line('create_server_validation_url_label'), 'required|prep_url|valid_url_format|url_exists');
			if ($method=='POST')
			{
				header('Content-Type: application/json');
				if ($this->form_validation->run() === TRUE)
				{
					$data = array(
					'server' => $this->input->post('server'),
					'port'  => $this->input->post('port'),
					'username'  => $this->input->post('username'),
					'password'  => $this->input->post('password'),
					);
				}
				if ($this->form_validation->run() == true && $this->servers_model->update_server($id, $data))
				{			
					$this->session->set_flashdata('message', $this->notification->messages());
					echo json_encode(array( 
						'response' => 'success', 
						'message' => $this->notification->messages(), 
						'redirect' => base_url('servers')
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
			
			
			}else{

				//set the flash data error message if there is one
				$this->data['message'] = (validation_errors() ? validation_errors() : ($this->notification->errors() ? $this->notification->errors() : $this->session->flashdata('message')));
				//pass the user to the view
				$this->data['id'] = $server->id;

				$this->data['server'] = array(
					'name'  => 'server',
					'id'    => 'server',
					'class' => 'form-control',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('server', $server->server),
				);
				$this->data['port'] = array(
					'name'  => 'port',
					'id'    => 'port',
					'class' => 'form-control',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('port', $server->port),
				);
				
				$this->data['username'] = array(
					'name'  => 'username',
					'id'    => 'username',
					'class' => 'form-control',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('username', $server->username),
				);
				
				$this->data['password'] = array(
					'name'  => 'password',
					'id'    => 'password',
					'class' => 'form-control',
					'type'  => 'password',
					'value' =>  $this->form_validation->set_value('phone', $server->password),
				);

				$this->data['title'] = 'Edit Server';
				$this->data['js'] 	 = array('js/servers.js');				
				$this->data['main_content'] = 'servers/edit';
				$this->load->view('servers/template', $this->data);
			}
		}
		else 
		{
			r_direct('dashboard');
		}
		
		
		
		
	}
	
	
	function view($id=null)
	{
		if (!$this->users->logged_in() && $id)
		{
			r_direct();
		}
		else
		{						
			$this->data['title'] = "View Server";
			$this->data['js'] 	 = array('js/servers.js');
			
			$server = (object)$this->servers_model->get_server($id)->row();		
			$message='';
			if(!$server)
			$message = $this->notification->errors() ? $this->notification->errors() : $this->session->flashdata('message');
									
			$status = $this->status->get_status((array)$server);
			$indexer_status = $this->status->indexer_get_status((array)$server);
			if(!$indexer_status || !$status)
			{
				$message = $this->status->errors() ? $this->status->errors() : $this->session->flashdata('message');
			}
			$this->data['message'] = $message;			
			$this->data['server'] = $server;
			$this->data['status'] = $status;
			$this->data['indexer_status'] = $indexer_status;
			$this->data['main_content'] = 'servers/view';
			$this->load->view('servers/template', $this->data); 
		}
	}

	

}
