<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Postmeta_model extends CI_Model

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
	
	
	
	
	public function get_postmeta($meta=array())
	{	
		
		$result = false;
		$tb = $this->tables['post_meta'];	
		if(empty($meta)){
			$this->notification->set_error('database_error_get');
			return $result;	
		}
		
		$result =
		$this->db->select("meta_value")
		  ->from($tb)
		  ->where($meta)
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
	
	
	public function save_postmeta($meta=array())
	{	
		$result = false;
		$tb = $this->tables['post_meta'];	
		if(empty($meta)){
			$this->notification->set_error('database_error_add');
			return $result;	
		}
		
		$data = elements(
				array('post_id','meta_key','meta_value'),
				$meta
				);			
		$this->db->insert($tb, $data);
		$id = $this->db->insert_id();
		
		if ($this->db->_error_message()) {
			$this->notification->set_error('database_error_add');
		} else {
			$this->notification->set_message('database_success_add');
			$result = $id;
		}
		
		return $result;	
	}
	
	
	public function update_postmeta($post_id=NULL, $meta_key=NULL, $meta=array())
	{	
		$result = false;
		$tb = $this->tables['post_meta'];	
		if(empty($meta) || !$post_id || !$meta_key){
			$this->notification->set_error('database_error_add');
			return $result;	
		}
		
		$where = array(
					'post_id'=> $post_id,
					'meta_key'=> $meta_key
				);
		$data = elements(
				array('meta_value'),
				$meta
				);	

		if($this->get_postmeta($where)){
			$this->db->where($where);
			$this->db->update($tb, $meta); 
		}else{
			$this->save_postmeta(array_merge($where, $data));
		}
		
		
		if ($this->db->_error_message()) {
			$this->notification->set_error('database_error_update');
		} else {
			$this->notification->set_message('database_success_update');
			$result = true;
		}
		
		
		return $result;	
	}
	
	
	
	public function delete_postmeta($meta=NULL)
	{	
		$result = false;
		$tb = $this->tables['post_meta'];
		//$this->db->cache_on();
		
		if(!$meta)
		return $result;
		
		
		$this->db->where($meta);
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
