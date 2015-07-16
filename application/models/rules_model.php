<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Rules_model extends CI_Model
{		
	
	public $tables 	= array();

	public function __construct()
	{
		parent::__construct();	
		$this->load->database();		
		$this->load->config('statistics', TRUE);	
		$this->load->config('pagination', TRUE);
		
		$this->load->library(array('database_lib'));
		
		$this->current_user 		= $this->users->user()->row();		
		$this->tables  = $this->application->get_config('tables', 'template');
		
	}	
	
	public function get_rules($user_id=NULL, $meta=array())
	{	
		$result = array();
		$tb = $this->tables['rules'];			
		$this->db->cache_on();
		$where = array();	
		
		$user_id = $user_id? $user_id : $this->users->get_user_id(); 
		
		foreach($meta as $key=>$value){			
			$where = $this->database_lib->db_where($where, $key, $value);
		}				
		$where = $this->database_lib->db_where($where, 'user_id', $user_id);
		
		$result =
		$this->db->select("id, active, category, rule_settings")
		  ->from($tb)
		  ->where($where)
		  ->order_by('id', 'desc')
		  ->limit(10)
		  ->get()
		  ->result_array();	
		
		return $result;				
	}
	
	
	
	public function get_rule($rule_id=NULL)
	{
		$result = array();
		
		if(!$rule_id)
		return $result;
		
		$tb = $this->tables['rules'];			
		$this->db->cache_on();
		$where = array();	
				
		$where = $this->database_lib->db_where($where, 'id', $rule_id);
		
		$result =
		$this->db->select("id, category, rule_settings")
		  ->from($tb)
		  ->where($where)
		  ->order_by('id', 'desc')
		  ->limit(1)
		  ->get()
		  ->result_array();	
		
		return array_shift($result);		
	}
	
	public function add_rule($user_id=NULL, $meta=array())
	{	
		$result = array();
		$tb = $this->tables['rules'];	

		$user_id = $user_id? $user_id : $this->users->get_user_id(); 
		
		$key = key($meta);		
		$data = array(
		    'user_id'      => $user_id,
			'active'       => element('active', $meta)? true: false,
		    'category'     => element('category', $meta),
		    'rule_settings'=> serialize($meta)
		);		
		
		$this->db->insert($tb, $data);
		$id = $this->db->insert_id();
		
		return $id;
	}
	
	
	public function update_rule($rule_id=NULL, $meta=array())
	{	
		$result = array();
		$tb = $this->tables['rules'];	
		$where = array();
		
		
		if(!$rule_id)
		return $result;	

		$data = array(
			'active'       => element('active', $meta)? true: false,
		    'category'     => element('category', $meta),
		    'rule_settings'=> serialize($meta)
		);	
		
		$where = $this->database_lib->db_where($where, 'id', $rule_id);
		$this->db->where($where);
		$this->db->update($tb, $data); 
		
		return $meta;
	}
	
	
	
	public function delete_rule($rule_id=NULL)
	{
		$result = false;
		$tb = $this->tables['rules'];
		
		if(!$rule_id)
		return $result;

		
		$where = $this->database_lib->db_where($where, 'id', $rule_id);
		$this->db->where($where);
		$this->db->delete($tb); 
		
		if ($this->db->_error_message()) {
			$result = 'Error! ['.$this->db->_error_message().']';
		} else if (!$this->db->affected_rows()) {
			$result = 'Error! ID ['.$id.'] not found';
		} else {
			$result = 'Success';
		}

		return $result;
	}
	
	
	
	
}
