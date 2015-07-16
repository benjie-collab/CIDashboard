<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Uploads_model extends CI_Model
{	
	/**
	 * Holds an array of tables used
	 *
	 * @var array
	 **/
	protected $tables = array();
	

	public function __construct()
	{
		parent::__construct();
		$this->load->database();			
		$this->load->library('database_lib');	
		$this->load->helper('cookie');
		$this->load->helper('date');		
		$this->tables  = $this->config->item('tables', 'template');
	}
	
	
	
	
	public function get_files($meta=array())
	{	
		$result = array();
		$tb = $this->tables['uploads'];			
		$this->db->cache_on();
		$where = array();	
		
		foreach($meta as $key=>$value){			
			$where = $this->database_lib->db_where($where, $key, $value);
		}	
		
		$result =
		$this->db->select()
		  ->from($tb)
		  ->where($where)
		  ->order_by('id', 'desc')
		  ->limit(10)
		  ->get()
		  ->result_array();	
		
		return $result;				
	}
	
	public function get_file($id=NULL)
	{	
		$result = array();
		$tb = $this->tables['uploads'];	
		$where = array();		
		
		if(!$id)
		return $result;	
		
		$where = $this->database_lib->db_where($where, 'id', $id);	
		
		
		$result =
		$this->db->select()
		  ->from($tb)
		  ->where($where)
		  ->limit(1)
		  ->get()
		  ->row();
		  
		return $result;				
	}
	
	public function save_file($files_data=array())
	{	
		$result = false;
		$tb = $this->tables['uploads'];	
		$user_id = $this->users->get_user_id();
		
		if(!$files_data || !$user_id)
		return $result;	

				
		if(isset($files_data[0]) && is_array($files_data[0])){
			foreach($files_data as $file){
				$file['user_id'] = $user_id;
				$this->db->insert($tb, $file);
				$id = $this->db->insert_id();			
				if ($this->db->_error_message()) {
					$this->notification->set_error('file_error_add');
				} else {
					$this->notification->set_message('file_success_add');
					$result = true;
				}	
			}
		}else{
			$files_data['user_id'] = $user_id;
			$this->db->insert($tb, $files_data);
			$id = $this->db->insert_id();			
			if ($this->db->_error_message()) {
				$this->notification->set_error('file_error_add');
			} else {
				$this->notification->set_message('file_success_add');
				$result = true;
			}	
		
		}
		
		return $result;
	}
	
	
	public function update_file($id=NULL, $meta=array())
	{	
		$result = false;
		$tb = $this->tables['uploads'];	
		$where = array();
		
		if(!$id){
			$this->notification->set_error('file_error_update');
			return $result;	
		}	
		
		$where = $this->database_lib->db_where($where, 'id', $id);
		$this->db->where($where);
		$this->db->update($tb, $meta); 	

		if ($this->db->_error_message()) {
			$this->notification->set_error('file_error_update');
		} else {
			$this->notification->set_message('file_success_update');
			$result = true;
		}
		
		return $result;
	}
	
	
	public function delete_file($id=NULL)
	{	
		$result = false;
		$tb = $this->tables['uploads'];	
		$where = array();
		
		if(!$id){
			$this->notification->set_error('file_error_delete');
			return $result;	
		}
			
		delete_files('./path/to/directory/');
		
		
		$file = $this->get_file($id);
		
		if($file){
					
				unlink($file->full_path);
				$where = $this->database_lib->db_where($where, 'id', $id);
				$this->db->where($where);
				$this->db->delete($tb); 
				
				if ($this->db->_error_message()) {
					$this->notification->set_error('file_error_delete');
				} else if (!$this->db->affected_rows()) {
					$this->notification->set_error('file_error_delete');
				} else {
					$this->notification->set_message('file_success_delete');
					$result = true;
				}
				
		}
		
		

		return $result;
	}
	
	
	
}
