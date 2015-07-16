<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		
		$this->load->database();			
		$this->load->library(array('Datatables', 'table'));		
		$this->load->model(array('uploads_model'));		
			
		$this->form_validation->set_error_delimiters(
			$this->config->item('error_start_delimiter', 'template'), 
			$this->config->item('error_end_delimiter', 'template'));		
		
	}

	
	function index()
	{
		$this->data['title'] = "Media";
		$this->data['js'] 	 = array('js/medias.js');	
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}else
		{
			$this->data['message'] = $this->session->flashdata('message');
			$this->data['main_content'] = 'media/index';
			$this->load->view('media/template', $this->data); 
		}
		
	}
	
	function datatable()
    {
        $this->datatables->select('id,file_name,file_type,file_size')
            //->unset_column('id')
			->filter('is_image', true)
			->filter('user_id', $this->users->get_user_id())
			->add_column('actions', get_buttons('$1', 'media',array('edit', 'delete')), 'id')
            ->from('uploads');			
        echo $this->datatables->generate();
    }
	
	
	//create a new user
	function add()
	{
	
		if (!$this->users->logged_in())
		{		
			r_direct_login();
		}
		else
		{
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			//$config['max_size']	= '100';
			//$config['max_width']  = '1024';
			//$config['max_height']  = '768';
			$this->load->library('upload', $config);
			
			$method = $this->input->server('REQUEST_METHOD');			
			if($method == 'POST'){				
				
				header('Content-Type: application/json');
				//if ( ! $this->upload->do_multi_upload('files'))
				if ( ! $this->upload->do_multi_upload('file'))
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
					//$this->notification->set_message($file_data);	
					$file= $this->uploads_model->save_file($file_data);
					$message = $this->notification->messages();
					if($file){
						echo json_encode(array( 
						'response' => 'success', 
						'message' => $message,
						), true);
					
					}else{
						$message = $this->notification->errors();						
						echo json_encode(array( 
						'response' => 'danger', 
						'message' => $message
						), true);					
					}
				}
				
			}else{
				$this->data['message'] = $this->notification->errors() ? $this->notification->errors() : ($this->notification->messages()? $this->notification->messages() : $this->session->flashdata('message'));			
				$this->data['title'] = 'Add New Media';
				$this->data['main_content'] = 'media/add';
				$this->load->view('media/template', $this->data);			
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
			$file = $this->uploads_model->delete_file($id);									
			$message = $this->notification->errors() ? $this->notification->errors() : ($this->notification->messages()? $this->notification->messages() : $this->session->flashdata('message'));			
			header('Content-Type: application/json');	
			if($file)
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

	

}
