<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Usermeta_model extends CI_Model
{	
	/**
	 * Holds an array of post data used
	 *
	 * @var array
	 **/	
	
	public $tables 	= array();

	public function __construct()
	{
		parent::__construct();	
		$this->db->cache_off();
		$this->load->database();		
		$this->load->config('template', TRUE);
		$this->load->config('search', TRUE);	
		$this->load->library(array('database_lib'));		
		$this->lang->load('search');					
		$this->tables  = $this->config->item('tables', 'template');		
	}
	
	
	
	
	public function get_usermeta($user_id=NULL, $meta=array())
	{	
		
		$result = false;
		$tb = $this->tables['user_meta'];	
		$where = array();
		
		$user_id = !is_null($user_id)? $user_id : $this->users->get_user_id();
		
		if(!$meta || is_null($user_id))
		return $result;	
		
		if($this->users->is_admin())
		$user_id = 0;
		
		$where = $this->database_lib->db_where($where, 'user_id', $user_id);		
		if(!empty($meta)){
			foreach($meta as $key=>$value){
				$where = $this->database_lib->db_where($where, $key, $value);
			}			
		}		
		
		
		$result =
		$this->db->select("meta_value")
		  ->from($tb)
		  ->where($where)
		  ->limit(1)
		  ->get()
		  ->row();
		
		if ($this->db->_error_message()) {
			$this->notification->set_error('database_getting_error');
		} else {
			$this->notification->set_message('database_getting_success');
			if($result)
			$result = unserialize($result->meta_value);
		} 		
			
		return $result;			
	}
	
	
	public function save_usermeta($user_id=NULL, $meta=array())
	{	
		$result = false;
		$tb = $this->tables['user_meta'];
		$where =array();
		//$this->db->cache_on();
		
		if(empty($meta) || (is_null($user_id) && !$this->users->logged_in()))
		return $result;	

		$user_id = !is_null($user_id)? $user_id : $this->users->get_user_id();	
		
		if($this->users->is_admin())
		$user_id = 0;
		
		
		$meta_key = key($meta);			
		if(!$meta_key)
		return $result;
		
		$data = array(
		    'user_id'   => $user_id,
		    'meta_key'   => $meta_key,
		    'meta_value' => serialize(array_shift($meta))
		);
		
		$sql = "SELECT id FROM {$tb} WHERE user_id = ? AND meta_key = ?";
		$query = $this->db->query($sql, array($user_id, $meta_key)); 

		if($query->num_rows() > 0):
			$where = $this->database_lib->db_where($where, 'user_id', $user_id);
			$where = $this->database_lib->db_where($where, 'meta_key', $meta_key);
			$this->db->where($where);
			$this->db->update($tb, $data); 
		else:
			$this->db->insert($this->tables['user_meta'], $data);
			$id = $this->db->insert_id();
		endif;
		
		if ($this->db->_error_message()) {
			$this->notification->set_error('database_adding_error');
		} else {
			$this->notification->set_message('database_adding_success');
			$result = true;
		}
		
		return $result;
	
	}
	
	
	
	public function delete_usermeta($meta_key=NULL)
	{	
		$result = false;
		$tb = $this->tables['user_meta'];
		//$this->db->cache_on();
		
		if(!$meta_key)
		return $result;
		
		$user_id = $this->users->is_admin() ? 0 : $this->users->get_user_id();	
		
		$where = array();
		$where = $this->database_lib->db_where($where, 'user_id', $user_id);
		$where = $this->database_lib->db_where($where, 'meta_key', $meta_key);
		
		$this->db->where($where);
		$this->db->delete($tb); 
		
		if ($this->db->_error_message()) {
			$this->notification->set_error('database_deleting_error');
		} else if (!$this->db->affected_rows()) {
			$this->notification->set_error('database_deleting_error');
		} else {
			$this->notification->set_error('database_adding_success');
			$result = true;
		}

		return $result;
	
	}
	
	
}
