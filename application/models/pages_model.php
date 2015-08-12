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
		//$this->load->model('usermeta_model', 'postmeta_model');		
		$this->load->library('database_lib');			
		$this->tables  = $this->config->item('tables', 'template');	
	}
	
	
	public function get_pages($user_ids=array(), $meta=array())
	{
		$result = false;
		$tb = $this->tables['posts'];	
			  
		$this->db->cache_on();
		
		$this->db
			->select()
			->from($tb)
			->where('post_type', 'page');
		  
		if($user_ids)		
			$this->db->where_in('user_id', $user_ids);		  
		if($meta)	
			$this->db->where($meta);
			
		$result =
		$this->db
			->get()
			->result();
		 
		if ($this->db->_error_message()) {
			$this->notification->set_error('pages_error_get');
		} else {
			$this->notification->set_message('pages_success_get');			
		} 		
			
		return $result;		
	}
	
	
	
	public function get_page($id=NULL)
	{	
		$result = false;
		$tb = $this->tables['posts'];		
		
		if(!$id){
			$this->notification->set_error('pages_error_get');
			return $result;	
		}
		
		$result =
		$this->db->select()
		  ->from($tb)
		  ->where('id',$id)
		  ->limit(1)
		  ->get()
		  ->row();
		
		if ($this->db->_error_message()) {
			$this->notification->set_error('pages_error_get');
		} else {
			$this->notification->set_message('pages_success_get');
			$result->styles= $this->postmeta_model->get_postmeta(array('post_id'=> $result->id, 'meta_key'=>'styles'));
			$result->users= $this->postmeta_model->get_postmeta(array('post_id'=> $result->id, 'meta_key'=>'users'));
		} 		
			
		return $result;				
	}
	
	public function add_page($meta=array())
	{	
		$result = false;
		$tb = $this->tables['posts'];			
		$user_id = $this->users->get_user_id();	
		if(!$meta || !$user_id){
			$this->notification->set_error('pages_error_add');
			return $result;	
		}
		
		$post_meta = array_key_exists('post_meta', $meta) ? element('post_meta', $meta) : array();
		$post_content = array_key_exists('post_content', $meta) ? element('post_content', $meta) : array();
		
		$meta = elements(
				array(
					'user_id',
					'post_title',
					'server',
					'post_description',
					'post_date',
					'post_type',
					'post_content',
					'active'
				)
				, $meta);
		$data = array_merge(
					$meta,
					array(
						'user_id'   => $user_id,
						'post_type'   => 'page',
						'post_content' => serialize($post_content)
					)		
				);	
		$data =
		array_filter($data, function($var) {
			return !is_null($var) && !empty($var);
		});
		$this->db->insert($tb, $data);
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
		$tb = $this->tables['posts'];	
		$where = array();
		
		if(!$meta || !$id){
			$this->notification->set_error('pages_error_update');
			return $result;	
		}	
		$meta = elements(
				array(
					'user_id',
					'post_title',
					'server',
					'post_description',
					'post_date',
					'post_type',
					'post_content',
					'active'
				)
				, $meta);
		$active = (bool)element('active', $meta);		
		$meta =
		array_filter($meta, function($var) {
			return !is_null($var) && !empty($var);
		});
		$meta['active'] = $active;
		$this->db->where('id', $id);
		$this->db->update($tb, $meta); 
		
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
		$tb = $this->tables['posts'];
		
		if(!$id){
			$this->notification->set_error('pages_error_delete');
			return $result;	
		}
			
		
		$this->db->where('id', $id);
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
