<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Document_model extends CI_Model
{	
	/**
	 * Holds an array of post data used
	 *
	 * @var array
	 **/	
	
	
	public $tables 	= array();
	
	public $server_url 	= null;
	
	public $server 	= NULL;
	
	public $parameters 	= array();
	

	public function __construct()
	{
		parent::__construct();	
		$this->load->library(array('curl', 'document_lib' ));	
		$this->load->model(array('usermeta_model', 'search_model'));		
		$this->load->helper(array('text'));		
		$this->tables  		= $this->application->get_config('tables', 'template');
		$this->server		= $this->application->get_config('server', 'status');	
		$this->parameters 	= $this->application->get_config('getcontent', 'actions');		
	}	
	
	
	public function call_get_content($post_opts=array())
	{		
		$response = array();		
		$server = array_merge($this->server , $this->usermeta_model->get_usermeta(0, array( 'meta_key' => 'server_status')));		
		$config =  $this->application->get_config('getcontent', 'actions');		
		$settings = $this->usermeta_model->get_usermeta(0, array( 'meta_key' => 'settings_query_getcontent'));
		$search = $this->application->get_session_userdata('current_search');	
		
		$post_data = 
				array_merge(					
					clean_parameters($config),
					clean_parameters(elements(array_keys($config), $post_opts)),
					clean_parameters(elements(array_keys($config), $settings)),
					clean_parameters(array('links' => strtolower(element('text', $search))))
					);					
		$response = array();	
		$data =  
		$this->curl->simple_post( element('url', $server) . ':' . element('port', $server), $post_data);
		
		if($data && $data !== false) {			
			$response = json_decode($data, true);		
			$response = $this->document_lib->clean_json_response($response);
		}		
		
		return $response;
	}
	
	
	
	
	
}








