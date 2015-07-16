<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Terms_model extends CI_Model
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
		$this->load->library(array('document_lib' ));	
		$this->load->model(array('usermeta_model'));	
		$this->load->helper(array('text'));		
		$this->tables  = $this->application->get_config('tables', 'template');
		$this->server  = $this->application->get_config('server', 'status');			
	}
	
	public function call_term_get_all($post_opts=array())
	{		
		$response = array();		
		$server = array_merge($this->server , $this->usermeta_model->get_usermeta(0, array( 'meta_key' => 'server_status')));
		$config = $this->application->get_config('termgetall', 'actions');	
		
		$search = array();
		if($this->session->userdata('search_settings'))
			$search = $this->session->userdata('search_settings');
		
		$post_data = 
				array_merge(					
					clean_parameters($config),
					clean_parameters(elements(array_keys($config), $post_opts))
					);
		$response = array();	
		
		//$data =  
		//$this->curl->simple_post( element('url', $server) . ':' . element('port', $server), $post_data);
		$this->curl->create(element('url', $server) . ':' . element('port', $server));
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', 1);
		$this->curl->option('followlocation', 1);
		$this->curl->option('connecttimeout', 1);
		$this->curl->post($post_data);	
		$data = $this->curl->execute();
		
		
		if($data && $data !== false) {			
			$response = json_decode($data, true);		
			$response = $this->document_lib->clean_terms_json_response($response);
		}		
		
		if( strcasecmp( element('value', $response['autnresponse']['response']), 'SUCCESS') === 0){
			$responsedata = element('responsedata', $response['autnresponse']);			
			$response = elements(array('autn:term'), $responsedata);
		}
		$this->curl->close();
		return $response;
	}
	
	
	public function call_term_get_best($post_opts=array())
	{		
		$response = array();		
		$server = array_merge($this->server , $this->usermeta_model->get_usermeta(0, array( 'meta_key' => 'server_status')));
		$config = $this->application->get_config('termgetbest', 'actions');	
		$search = array();
		if($this->session->userdata('search_settings'))
			$search = $this->session->userdata('search_settings');
		
		$post_data = 
				array_merge(					
					clean_parameters($config),
					clean_parameters(elements(array_keys($config), $post_opts))
					);
					
		$response = array();	
		
		//$data =  
		//$this->curl->simple_post( element('url', $server) . ':' . element('port', $server), $post_data);
		$this->curl->create(element('url', $server) . ':' . element('port', $server));
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', 1);
		$this->curl->option('followlocation', 1);
		$this->curl->option('connecttimeout', 1);
		$this->curl->post($post_data);		
		$data = $this->curl->execute();
		
		
		if($data && $data !== false) {			
			$response = json_decode($data, true);		
			$response = $this->document_lib->clean_terms_json_response($response);
		}		
		
		if( strcasecmp( element('value', $response['autnresponse']['response']), 'SUCCESS') === 0){
			$responsedata = element('responsedata', $response['autnresponse']);			
			$response = elements(array('autn:term'), $responsedata);
		}
		$this->curl->close();
		return $response;
	}
	
	
	
	public function call_term_expand($post_opts=array())
	{		
		$response = array();		
		$server = array_merge($this->server , $this->usermeta_model->get_usermeta(0, array( 'meta_key' => 'server_status')));
		$settings = $this->usermeta_model->get_usermeta(0, array( 'meta_key' => 'settings_term_termexpand'));
		$config = $this->application->get_config('termexpand', 'actions');	
		$search = array();
		if($this->session->userdata('search_settings'))
			$search = $this->session->userdata('search_settings');
		
		$post_data = 
				array_merge(					
					clean_parameters($config),
					clean_parameters(elements(array_keys($config), $settings)),
					clean_parameters(elements(array_keys($config), $post_opts))
					);
		$response = array();
		
		//$data =  
		//$this->curl->simple_post( element('url', $server) . ':' . element('port', $server), $post_data);
		$this->curl->create(element('url', $server) . ':' . element('port', $server));
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', 1);
		$this->curl->option('followlocation', 1);
		$this->curl->option('connecttimeout', 1);
		$this->curl->post($post_data);			
		$data = $this->curl->execute();
		
		
		if($data && $data !== false) {			
			$response = json_decode($data, true);		
			$response = $this->document_lib->clean_json_response($response);
		}		
		$this->curl->close();
		return $response;
	}
	
	
	public function call_term_get_info($post_opts=array())
	{		
		$response = array();		
		$server = array_merge($this->server , $this->usermeta_model->get_usermeta(0, array( 'meta_key' => 'server_status')));
		$config = $this->application->get_config('termgetinfo', 'actions');	
		$search = array();
		if($this->session->userdata('search_settings'))
			$search = $this->session->userdata('search_settings');
		
		$post_data = 
				array_merge(					
					clean_parameters($config),
					clean_parameters(elements(array_keys($config), $post_opts))
					);
		$response = array();	
		
		//$data =  
		//$this->curl->simple_post( element('url', $server) . ':' . element('port', $server), $post_data);
		$this->curl->create(element('url', $server) . ':' . element('port', $server));
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', 1);
		$this->curl->option('followlocation', 1);
		$this->curl->option('connecttimeout', 1);
		$this->curl->post($post_data);		
		$data = $this->curl->execute();
		
		
		if($data && $data !== false) {			
			$response = json_decode($data, true);		
			$response = $this->document_lib->clean_terms_json_response($response);
		}		
		
		if( strcasecmp( element('value', $response['autnresponse']['response']), 'SUCCESS') === 0){
			$responsedata = element('responsedata', $response['autnresponse']);			
			$response = elements(array('autn:term'), $responsedata);
		}
		$this->curl->close();
		return $response;
	}
}