<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Api_lib
{
	/**
	 * Holds an array of post data used
	 *
	 * @var array
	 **/
	
	private $CI;
	
	protected $messages;
	
	protected $message_start_delimiter;
	
	protected $message_end_delimiter;
	
	protected $error_start_delimiter;
	
	protected $error_end_delimiter;
	
	protected $errors;	
	 
	public function __construct()
	{
		
		$this->CI = & get_instance();
		$this->CI->load->model('usermeta_model','',TRUE);
		
		
		$this->CI->messages    = array();
		$this->CI->errors      = array();
		
		$this->CI->message_start_delimiter = $this->CI->config->item('info_start_delimiter', 'template');
		$this->CI->message_end_delimiter   = $this->CI->config->item('info_end_delimiter', 'template');
		$this->CI->error_start_delimiter   = $this->CI->config->item('error_start_delimiter', 'template');
		$this->CI->error_end_delimiter     = $this->CI->config->item('error_end_delimiter', 'template');
	}
	
	/**
	 * __call
	 *
	 * Acts as a simple way to call model methods without loads of stupid alias'
	 *
	 **/
	public function __call($method, $arguments)
	{	
		return true;
	}
	
	
	
	
	
	public function response_time(){
		return $this->CI->response_time;	
	}
	
	public function curl($server = NULL, $parameters=array())
	{				
		
		$response = false;
		$start = microtime(true);		
		 if($server){ 
			$this->CI->curl->create($server);
			$this->CI->curl->option('buffersize', 10);
			$this->CI->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
			$this->CI->curl->option('returntransfer', true);
			$this->CI->curl->option('followlocation', true);
			$this->CI->curl->option('connecttimeout', true);		
			$this->CI->curl->post($parameters);
			$data = $this->CI->curl->execute();	
			
			$this->CI->response_time =  round(microtime(true) - $start, 3) . " seconds"; 		
			if($data !== false) {
				if(strcasecmp(element('format', $parameters), 'json')==0)
				$response = json_decode($data, true);
				else
				$response = $data;			
				$this->CI->notification->set_message('idol_server_response_success');
			}else{
				$this->CI->notification->set_error('idol_server_response_error');
			}			
			$this->CI->curl->close(); 
		}else{ 
				$this->CI->notification->set_error('idol_server_response_noserverdefined');  
			}
		
		return $response;		
	}
	
}