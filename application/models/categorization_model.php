<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Categorization_model extends CI_Model
{		
	
	public $tables 	= array();
	

	public function __construct()
	{
		parent::__construct();	
		$this->load->database();	
		$this->load->library(array('database_lib'));		
		$this->current_user 		= $this->users->user()->row();		
		$this->tables  = $this->application->get_config('tables', 'template');		
	}		
	
	
	
	
	public function get_categorizations($user_id=NULL, $meta=array())
	{	
		$result = array();
		$tb = $this->tables['categorization'];			
		$this->db->cache_on();
		$where = array();	
		
		$user_id = $user_id? $user_id : $this->users->get_user_id(); 
		
		foreach($meta as $key=>$value){			
			$where = $this->database_lib->db_where($where, $key, $value);
		}				
		$where = $this->database_lib->db_where($where, 'user_id', $user_id);
		
		$result =
		$this->db->select("id, active, cat_settings")
		  ->from($tb)
		  ->where($where)
		  ->order_by('id', 'desc')
		  ->limit(10)
		  ->get()
		  ->result_array();	
		
		return $result;				
	}
	
	
	
	public function get_categorization($id=NULL)
	{
		$result = array();
		
		if(!$id)
		return $result;
		
		$user_id = $this->users->get_user_id(); 
		
		$tb = $this->tables['categorization'];			
		$this->db->cache_on();
		$where = array();	
				
		$where = $this->database_lib->db_where($where, 'id', $id);
		$where = $this->database_lib->db_where($where, 'user_id', $user_id);
		
		$result =
		$this->db->select()
		  ->from($tb)
		  ->where($where)
		  ->limit(1)
		  ->get()
		  ->result_array();			
		return array_shift($result);		
	}
	
	public function add_categorization($user_id=NULL, $meta=array())
	{	
		$result = array();
		$tb = $this->tables['categorization'];	

		$user_id = $user_id? $user_id : $this->users->get_user_id(); 
				
		$data = array(
		    'user_id'      => $user_id,
			'name'         => element('name', $meta),
			'description'  => empty(element('description', $meta))? '': element('description', $meta) ,
			'active'       => (bool)element('active', $meta),
		    'cat_settings' => serialize(element('nodes',$meta))
		);		
		
		$this->db->insert($tb, $data);
		$id = $this->db->insert_id();
		
		if ($this->db->_error_message()) {
			$this->notification->set_error('database_adding_error');
		} else {
			$this->notification->set_message('database_adding_success');
		}
		
		return $id;
	}
	
	
	public function update_categorization($meta=array())
	{	
		$result = array();
		$tb = $this->tables['categorization'];	
		$where = array();
		
		
		if(!$meta)
		return $result;	

		$data = array(
			'name'      	=> empty(element('name', $meta))? '': element('name', $meta) ,
			'description'   => empty(element('description', $meta))? '': element('description', $meta) ,
			'active'       => (bool)element('active', $meta),
		    'cat_settings' => serialize(element('nodes',$meta))
		);	
		
		$where = $this->database_lib->db_where($where, 'id', element('id', $meta));
		$this->db->where($where);
		$this->db->update($tb, $data); 
		
		if ($this->db->_error_message()) {
			$this->notification->set_error('database_udpating_error');
			return false;
		} else {
			$this->notification->set_message('database_udpating_success');
			return true;
		}
	}
	
	
	
	public function delete_categorization($id=NULL)
	{
		$result = false;
		$tb = $this->tables['categorization'];
		$where = array();
		
		if(!$id)
		return $result;

		
		$where = $this->database_lib->db_where($where, 'id', $id);
		$this->db->where($where);
		$this->db->delete($tb); 		
				
		if ($this->db->_error_message()) {
			$this->notification->set_error('database_deleting_error');
		} else if (!$this->db->affected_rows()) {
			$this->notification->set_error('database_deleting_error');
		} else {
			$this->notification->set_message('database_deleting_success');
			$result = true;
		}
		
		return $result;
	}
	
	
	
	
}
