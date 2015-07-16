<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Servers_model extends CI_Model
{	
	/**
	 * Holds an array of tables used
	 *
	 * @var array
	 **/
	protected $tables = array();
	
	protected $current_user = NULL;
	

	public function __construct()
	{
		parent::__construct();
		$this->load->database();		
		$this->load->model('usermeta_model');		
		$this->load->library('database_lib');	
		$this->current_user = $this->users->user()->row();	
		$this->load->helper('cookie');
		$this->load->helper('date');		
		$this->tables  = $this->config->item('tables', 'template');
	}
	
	
	
	
	public function get_servers($meta=array())
	{	
		$result = array();
		$tb = $this->tables['servers'];			
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
	
	public function get_server($server_id=NULL)
	{	
		$result = array();
		$tb = $this->tables['servers'];	
		$where = array();		
		
		if(!$server_id)
		return $result;	
		
		$where = $this->database_lib->db_where($where, 'id', $server_id);	
		
		
		$result =
		$this->db->select()
		  ->from($tb)
		  ->where($where)
		  ->limit(1)
		  ->get();
		  
		return $result;				
	}
	
	public function save_server($meta=array())
	{	
		$result = false;
		$tb = $this->tables['servers'];	
		$user_id = $this->users->get_user_id();
		
		if(!$meta || !$user_id)
		return $result;	

		$meta['user_id'] = $user_id;		
		
		$this->db->insert($tb, $meta);
		$id = $this->db->insert_id();
		
		if ($this->db->_error_message()) {
			$this->notification->set_error('servers_error_add');
		} else {
			$this->notification->set_message('servers_success_add');
			$result = true;
		}
		
		return $result;
	}
	
	
	public function update_server($id=NULL, $meta=array())
	{	
		$result = false;
		$tb = $this->tables['servers'];	
		$where = array();
		
		if(!$id){
			$this->notification->set_error('servers_error_update');
			return $result;	
		}	
		
		$where = $this->database_lib->db_where($where, 'id', $id);
		$this->db->where($where);
		$this->db->update($tb, $meta); 	

		if ($this->db->_error_message()) {
			$this->notification->set_error('servers_error_update');
		} else {
			$this->notification->set_message('servers_success_update');
			$result = true;
		}
		
		return $result;
	}
	
	
	public function delete_server($id=NULL)
	{	
		$result = false;
		$tb = $this->tables['servers'];	
		$where = array();
		
		if(!$id){
			$this->notification->set_error('servers_error_delete');
			return $result;	
		}
			
		
		$where = $this->database_lib->db_where($where, 'id', $id);
		$this->db->where($where);
		$this->db->delete($tb); 
		
		if ($this->db->_error_message()) {
			$this->notification->set_error('servers_error_delete');
		} else if (!$this->db->affected_rows()) {
			$this->notification->set_error('servers_error_delete');
		} else {
			$this->notification->set_message('servers_success_delete');
			$result = true;
		}

		return $result;
	}
	
	
	
}
