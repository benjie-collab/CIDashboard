<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Pages_model extends CI_Model
{	
	/**
	 * Holds an array of tables used
	 *
	 * @var array
	 **/
	public $tables = array();
	

	public function __construct()
	{
		parent::__construct();
		$this->load->database();		
		$this->load->model('usermeta_model');		
		$this->load->library('database_lib');			
		$this->tables  = $this->config->item('tables', 'template');	
	}
	
	
	public function get_pages_menu($user_id=NULL)
	{
		$result = false;
		$tb = $this->tables['user_meta'];	
		$where = array();
		
		$user_id = $user_id? $user_id : $this->users->get_user_id();
		
		if(!$user_id)
		return $result;			  
		  
		$menu = $this->usermeta_model->get_usermeta($user_id, array('meta_key' =>'custom_menu' ));
		if(!$menu){
			$where = $this->database_lib->db_where($where, 'user_id', $user_id);
			$where = $this->database_lib->db_where($where, 'meta_key', 'page');
			$this->db->cache_on();
			$result =
			$this->db->select("id, meta_value")
			  ->from($tb)
			  ->where($where)
			  ->get()
			  ->result_array();			  
			return $result;			
		}
		else
			return $menu;
	}	
	
	
	public function get_page($id=NULL)
	{	
		$result = false;
		$tb = $this->tables['user_meta'];	
		$where = array();		
		
		if(!$id){
			$this->notification->set_error('pages_error_get');
			return $result;	
		}
		
		$where = $this->database_lib->db_where($where, 'id', $id);	
		$result =
		$this->db->select("meta_value")
		  ->from($tb)
		  ->where($where)
		  ->limit(1)
		  ->get()
		  ->row();
		
		if ($this->db->_error_message()) {
			$this->notification->set_error('pages_error_get');
		} else {
			$this->notification->set_message('pages_success_get');
			if($result)
			$result = unserialize($result->meta_value);
		} 		
			
		return $result;				
	}
	
	public function add_page($meta=array())
	{	
		$result = false;
		$tb = $this->tables['user_meta'];			
		$user_id = $this->users->get_user_id();
		
		if(!$meta || !$user_id){
			$this->notification->set_error('pages_error_add');
			return $result;	
		}
				
		$data = array(
		    'user_id'   => $user_id,
		    'meta_key'   => 'page',
		    'meta_value' => serialize($meta)
		);				
		$this->db->insert($this->tables['user_meta'], $data);
		$id = $this->db->insert_id();
		
		if ($this->db->_error_message()) {
			$this->notification->set_error('pages_error_add');
		} else {
			$this->notification->set_message('pages_success_add');
			$result = $id;
		}
		
		return $result;
	}
	
	
	public function update_page($id=NULL, $meta=array())
	{	
		$result = false;
		$tb = $this->tables['user_meta'];	
		$where = array();
		
		if(!$meta || !$id){
			$this->notification->set_error('pages_error_update');
			return $result;	
		}	
		
		$data = array(
		    'meta_value' => serialize($meta)
		);	
		
		$where = $this->database_lib->db_where($where, 'id', $id);
		$this->db->where($where);
		$this->db->update($tb, $data); 
		
		if ($this->db->_error_message()) {
			$this->notification->set_error('pages_error_update');
		} else {
			$this->notification->set_message('pages_success_update');
			$result = true;
		}
		
		return $result;
	}
	
	
	
	public function delete_page($id=NULL)
	{
		$result = false;
		$tb = $this->tables['user_meta'];
		$where = array();
		
		if(!$id){
			$this->notification->set_error('pages_error_delete');
			return $result;	
		}
			
		
		$where = $this->database_lib->db_where($where, 'id', $id);
		$this->db->where($where);
		$this->db->delete($tb); 
		
		if ($this->db->_error_message()) {
			$this->notification->set_error('pages_error_delete');
		} else if (!$this->db->affected_rows()) {
			$this->notification->set_error('pages_error_delete');
		} else {
			$this->notification->set_message('pages_success_delete');
			$result = true;
		}

		return $result;
	}
	
	
	
	
	

	
}
