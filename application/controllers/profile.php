<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();	
		$this->load->model(array('rules_model'));
		$this->load->library(array('dashboard_lib'));
		$this->load->helper(array('url','language'));
		$this->lang->load('users');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'users'), $this->config->item('error_end_delimiter', 'users'));		
		
	}

	//redirect if needed, otherwise display the user list
	function index()
	{
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}
		else //remove this elseif if you want to enable this for non-admins
		{
			//set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			
			$groups=$this->users->groups()->result_array();
			$currentGroups = $this->users->get_users_groups()->result();
			$data['groups'] = $groups;
			$data['currentGroups'] = $currentGroups;		
			$data['main_content'] = 'profile/index';
			$data['sidebar'] = 'profile/sidebar';
			$this->load->view('profile/template', $data); 
		}
	}
	
	function rules()
	{
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}
		else //remove this elseif if you want to enable this for non-admins
		{
			//set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');	
			$data['rules'] = $this->rules_model->get_rules();
			$data['main_content'] = 'profile/rules';
			$data['sidebar'] = 'profile/sidebar';
			$this->load->view('profile/template', $data); 
		}
	}
	
	
	function create_rule()
	{
		$this->output->cache(0);	
		if (!$this->users->logged_in())
		{
			r_direct_login();
		}
		elseif($this->uri->segment(3)) //remove this elseif if you want to enable this for non-admins
		{
			$category = $this->uri->segment(3);
			
			$data['modal_title'] 	 	= 'Add New '. $category . " Rule";
			$data['modal_content'] 	= 'widgets/' . $category . '/create';
			$data['parameters'] 		=  array(
												'komodel' => 'new Profile(["#smrt"])'
											);
			
			echo $this->load->view('template/modal', $data); 	
			
		}elseif($this->input->server('REQUEST_METHOD') === 'POST') 
		{
			$post_data = (isset($_POST) && !empty($_POST))? $_POST : array();			
			$rule = $this->rules_model->add_rule(NULL, $post_data);		
			header('Content-Type: application/json');
			echo json_encode($rule, true);	
		}else
		{		
			r_direct();
		}			
	}
	
	
	function delete_rule($id=null)
	{
		$this->output->cache(0);	
		if (!$this->users->logged_in())
		{
			r_direct_login();
		}
		elseif($id) //remove this elseif if you want to enable this for non-admins
		{			
			
			$rule = $this->rules_model->delete_rule($id);				
			r_direct();
		}else
		{		
			r_direct();
		}			
	}
	
	
	function edit_rule($key=null,$id=null)
	{
		$this->output->cache(0);	
		if (!$this->users->logged_in())
		{
			r_direct_login();
			
		}elseif($this->input->server('REQUEST_METHOD') === 'POST') 
		{
			$rule = $this->uri->segment(3);
			$post_data = (isset($_POST) && !empty($_POST))? $_POST : array();			
			$rule = $this->rules_model->update_rule($rule, $post_data);		
			header('Content-Type: application/json');
			echo json_encode($rule, true);	
			
		}elseif($this->uri->segment(3)) //remove this elseif if you want to enable this for non-admins
		{
		
			
			$data['modal_title'] 	 	= 'Edit Rule';
			$data['modal_content'] 	= 'widgets/' . $key . '/edit';
			$data['parameters'] 		=  array(
												'komodel' => 'new Profile(["#smrt"])',
												'id' => $id
											);
			
			echo $this->load->view('template/modal', $data); 
		}else
		{		
			r_direct();
		}			
	}
	
}
