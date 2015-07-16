<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Tags_model extends CI_Model
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
	
	public function call_get_query_tag_values($post_opts=array())
	{		
		$response = array();		
		//$server = array_merge($this->server , $this->usermeta_model->get_usermeta(0, array( 'meta_key' => 'server_status')));
		$config = $this->application->get_config('getquerytagvalues', 'actions');	
		$settings = $this->usermeta_model->get_usermeta(0, array( 'meta_key' => 'getquerytagvalues_settings'));
		
		$search = array();
		if($this->session->userdata('search_settings'))
			$search = $this->session->userdata('search_settings');
		
		$post_data = 
				array_merge(					
					clean_parameters($config),
					clean_parameters(elements(array_keys($config), $settings)),
					clean_parameters(elements(array_keys($config), $post_opts))
					);	
		//$data =  
		//$this->curl->simple_post( element('url', $server) . ':' . element('port', $server), $post_data);
		$this->curl->create(element('server', $post_opts));
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', 1);
		$this->curl->option('followlocation', 1);
		$this->curl->option('connecttimeout', 1);
		$this->curl->post($post_data);	
		$data = $this->curl->execute();
		
		
		if($data && $data !== false) {			
			$data = json_decode($data, true);	
			$response = clean_terms_json_response($data);
		}	
		$this->curl->close();
		return $response;
	}
	
	
	public function call_get_tag_names($post_opts=array())
	{		
		$response = array();		
		//$server = array_merge($this->server , $this->usermeta_model->get_usermeta(0, array( 'meta_key' => 'server_status')));
		$config = $this->application->get_config('gettagnames', 'actions');	
		
		$search = array();
		if($this->session->userdata('search_settings'))
			$search = $this->session->userdata('search_settings');
		
		$post_data = 
				array_merge(					
					clean_parameters($config),
					clean_parameters(elements(array_keys($config), $post_opts))
					);
					
	
		//$data =  
		//$this->curl->simple_post( element('url', $server) . ':' . element('port', $server), $post_data);
		$this->curl->create(element('server', $post_opts));
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', 1);
		$this->curl->option('followlocation', 1);
		$this->curl->option('connecttimeout', 1);
		$this->curl->option('FRESH_CONNECT', false);
		$this->curl->post($post_data);
		$data = $this->curl->execute();
		
		if($data && $data !== false) {			
			$response = json_decode($data, true);		
			$response = clean_json_response($response);
		}		
		
		if( is_response_success($response)){
			$response = get_responsedata($response);	
		}
		$this->curl->close();
		return $response;
	}
	
	
	public function call_get_tag_values($post_opts=array())
	{		
		$response = array();		
		//$server = array_merge($this->server , $this->usermeta_model->get_usermeta(0, array( 'meta_key' => 'server_status')));
		$config = $this->application->get_config('gettagvalues', 'actions');	
		
		$search = array();
		if($this->session->userdata('search_settings'))
			$search = $this->session->userdata('search_settings');
		
		$post_data = 
				array_merge(					
					clean_parameters($config),
					clean_parameters(elements(array_keys($config), $post_opts))
					);
					
		
		//$data =  
		//$this->curl->simple_post( element('url', $server) . ':' . element('port', $server), $post_data);
		$this->curl->create(element('server', $post_opts));
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', 1);
		$this->curl->option('followlocation', 1);
		$this->curl->option('connecttimeout', 1);
		$this->curl->post($post_data);	
		$data = $this->curl->execute();
		
		if($data && $data !== false) {			
			$response = json_decode($data, true);		
			$response = clean_json_response($response);
		}		
		
		if( is_response_success($response)){
			$response = get_responsedata($response);	
		}
		$this->curl->close();
		return $response;
	}
	
	
	
	
	
}








