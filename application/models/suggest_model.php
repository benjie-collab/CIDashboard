<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Suggest_model extends CI_Model
{	
	/**
	 * Holds an array of post data used
	 *
	 * @var array
	 **/
	
	
	
	public $tables 	= array();
	public $server 	= NULL;
	

	public function __construct()
	{
		parent::__construct();	
		$this->load->library(array('curl', 'document_lib' ));	
		$this->load->model(array('usermeta_model'));	
		$this->load->helper(array('text'));		
		$this->server	= $this->application->get_config('server', 'status');			
	}
	
	public function call_suggest($post_opts=array())
	{		
		$config = $this->application->get_config('suggest', 'actions');
		$settings = $this->usermeta_model->get_usermeta(0, array( 'meta_key' => 'settings_query_suggest'));
		$search = $this->application->get_session_userdata('current_search');	
		$server = array_merge(
						$this->server , 
						$this->usermeta_model->get_usermeta(0, array( 'meta_key' => 'server_status'))
					);			
		$post_data = 
				array_merge(	
					/** include current search parameters **/
					clean_parameters(elements(array_keys($config), $search)),
					clean_parameters($config),
					clean_parameters(elements(array_keys($config), $settings)),
					clean_parameters(elements(array_keys($config), $post_opts))					
					);	
					
		
		$response = array();
		$start = microtime(true);		
		$data =  
		$this->curl->simple_post( element('url', $server) . ':' . element('port', $server), $post_data);		
		$this->response_time =  round(microtime(true) - $start, 3) . " seconds"; 		
		if($data !== false) {			
			$response = json_decode($data, true);
		}
		$response = $this->document_lib->clean_json_response($response);		
		return $response;		
		
		
		
		
	}
	
	
	
	
	
}








