<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();		
		$this->load->library(array('Datatables', 'table'));
		$this->load->helper(array('url','language'));
		$this->lang->load('users');
		$this->form_validation->set_error_delimiters(
			$this->config->item('error_start_delimiter', 'template'), 
			$this->config->item('error_end_delimiter', 'template'));			
		
	}

	//redirect if needed, otherwise display the user list
	function index()
	{
		if (!$this->users->logged_in())
		{		
			r_direct_login();
		}
		elseif ($this->users->is_admin()) //remove this elseif if you want to enable this for non-admins
		{
			$this->data['title'] = "Departments";
			$this->data['js'] 	 = array('js/departments.js');
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');	
			$this->data['main_content'] = 'departments/index';
			$this->load->view('departments/template', $this->data); 
		}
		else 
		{
			r_direct('dashboard');
		}
	}
	
	
	function datatable()
    {
        $this->datatables->select('id,name,description')
            ->unset_column('id')
			->add_column('actions', get_buttons('$1', 'departments'), 'id')
            ->from('groups');			
        echo $this->datatables->generate();
    }
	

	// create a new group
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
				$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');				
				if ($this->form_validation->run() == TRUE)
				{
					$new_group_id = $this->users->create_group($this->input->post('group_name'), $this->input->post('description'));				
					$message = (validation_errors() ? validation_errors() : ($this->notification->errors() ? $this->notification->errors() : $this->notification->messages()));	
					if($new_group_id)
					echo json_encode(array( 
						'response' => 'success', 
						'message' => $message, 
						'redirect' => base_url('departments')
						), 
					true);				
					else
					echo json_encode(array( 
						'response' => 'danger', 
						'message' => $message ), 
					true);	
				}
				else
				{
					$message = (validation_errors() ? validation_errors() : ($this->notification->errors() ? $this->notification->errors() : $this->notification->messages()));	
					echo json_encode( array( 'response' => 'danger', 'message' => $message ), true);
				}
			}else{
				$this->data['group_name'] = array(
					'name'  => 'group_name',
					'id'    => 'group_name',
					'class'    => 'form-control',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('group_name'),
				);
				$this->data['description'] = array(
					'name'  => 'description',
					'id'    => 'description',
					'class'    => 'form-control',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('description'),
				);
				$this->data['message'] = $this->notification->errors() ? $this->notification->errors() : $this->notification->messages();	
				$this->data['title'] = $this->lang->line('create_group_title');
				$this->data['main_content'] = 'departments/add';
				$this->load->view('departments/template', $this->data);			
			}
		}
		else 
		{
			r_direct('dashboard');
		}
		
	}

	//edit a group
	function edit($id=null)
	{
		if (!$this->users->logged_in())
		{		
			r_direct_login();
		}
		elseif ($this->users->is_admin() && $id)
		{
			$method = $this->input->server('REQUEST_METHOD');
			$group = $this->users->group($id)->row();
			$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');
			if ($method=='POST')
			{
				header('Content-Type: application/json');
				if ($this->form_validation->run() === TRUE)
				{
					$group_update = $this->users->update_group($id, $_POST['group_name'], $_POST['group_description']);
					$message = ($this->notification->errors() ? $this->notification->errors() : $this->notification->messages());	
					if($group_update)
					echo json_encode(array( 
						'response' => 'success', 
						'message' => $message, 
						'redirect' => base_url('departments')
						), 
					true);				
					else
					echo json_encode(array( 
						'response' => 'danger', 
						'message' => $message ), 
					true);	
				}else{
					$message = (validation_errors() ? validation_errors() : ($this->notification->errors() ? $this->notification->errors() : $this->session->flashdata('message')));
					echo json_encode(array( 
						'response' => 'danger', 
						'message' => $message ), 
					true);	
				}
			}else{

				//set the flash data error message if there is one
				$this->data['message'] = (validation_errors() ? validation_errors() : ($this->notification->errors() ? $this->notification->errors() : $this->session->flashdata('message')));
				//pass the user to the view
				$this->data['group'] = $group;

				$this->data['group_name'] = array(
					'name'  => 'group_name',
					'id'    => 'group_name',
					'class'    => 'form-control',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('group_name', $group->name),
				);
				$this->data['group_description'] = array(
					'name'  => 'group_description',
					'id'    => 'group_description',
					'class'    => 'form-control',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('group_description', $group->description),
				);

				$this->data['title'] = $this->lang->line('edit_group_title');			
				$this->data['main_content'] = 'departments/edit';
				$this->load->view('departments/template', $this->data);
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
			$group = $this->users->delete_group($id);									
			$message = ($this->notification->errors()? $this->notification->errors() : $this->notification->messages());				
			header('Content-Type: application/json');	
			if($group)
			echo json_encode(array( 
				'response' => 'success', 
				'message' => $message,
				'redirect' => base_url('departments'),
				), 
			true);				
			else
			echo json_encode(array( 
				'response' => 'danger', 
				'message' => $message,
				'redirect' => base_url('departments'),
				), 
			true);	
		}
		else
		{					
			r_direct('dashboard');
		}	
	}

}
