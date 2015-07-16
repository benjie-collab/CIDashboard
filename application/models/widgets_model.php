<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Widgets_model extends CI_Model
{	
	/**
	 * Holds an array of post data used
	 *
	 * @var array
	 **/	
	protected $current_user = NULL;	
	
	public $tables 	= array();

	public function __construct()
	{
		parent::__construct();	
		$this->load->database();			
		$this->load->model('usermeta_model');			
		$this->load->library('database_lib');
		$this->current_user 		= $this->users->user()->row();
		$this->tables  = $this->config->item('tables', 'template');
		
	}	
	
	/**
	public function generate_widget_options_key($widget_key=null)
	{
		return $this->users->get_user_id(). '_' . $widget_key . '_options';
	}
	
	
	public function get_widget_options($widget_key=null)
	{
		$tb_usermeta = $this->tables['user_meta'];	
		$where = array();	
		
		$where = $this->database_lib->db_where($where, 'meta_key', $this->generate_widget_options_key($widget_key) );
		$user_meta = $this->usermeta_model->get_usermeta(NULL, $where);			
			
		return $user_meta;
	}
	
	public function get_widget($user_id=NULL, $meta=array())
	{	
		$result = array();
		$user_meta =array();
		$tb_widgets = $this->tables['widgets'];	
		$tb_usermeta = $this->tables['user_meta'];
		
		$user_id = $user_id? $user_id : $this->users->get_user_id(); 	

		$where = array();
		if(element('meta_key', $meta)){
			$where = $this->database_lib->db_where($where, 'meta_key', element('meta_key', $meta));
			$user_meta = $this->usermeta_model->get_usermeta($user_id, $where);			
		}		
		
		if(empty($user_meta)){
			$where = array();
			//$where = $this->database_lib->db_where($where, 'user_id', $user_id);
			if(!empty($meta)){
				foreach($meta as $key=>$value){
					$where = $this->database_lib->db_where($where, $key, $value);
				}			
			}
			$widget =
			$this->db->select("widget_settings")
			  ->from($tb_widgets)
			  ->where($where)
			  ->limit(1)
			  ->get()
			  ->result_array();	
			  
			if(sizeOf($widget) > 0){				
				$widget_settings = unserialize(element('widget_settings', $widget[0])); 				
				$meta = array($user_id .'_'. element('widget_key', $meta) => $widget_settings);
				$this->usermeta_model->save_usermeta($user_id, $meta);	
				$result = $widget_settings;
			}
			
		}else{		
			$result = $user_meta;
		}		
		if($result)
		$result = json_decode($result, true);
		return $result;					
	}**/
	
	
	
	
}
