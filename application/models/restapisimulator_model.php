<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Restapisimulator_model extends CI_Model
{	

	protected $messages;
	
	protected $message_start_delimiter;
	
	protected $message_end_delimiter;
	
	protected $error_start_delimiter;
	
	protected $error_end_delimiter;
	
	protected $errors;	

	public function __construct()
	{
		parent::__construct();	

		$this->messages    = array();
		$this->errors      = array();
		
		$this->message_start_delimiter = $this->config->item('info_start_delimiter', 'template');
		$this->message_end_delimiter   = $this->config->item('info_end_delimiter', 'template');
		$this->error_start_delimiter   = $this->config->item('error_start_delimiter', 'template');
		$this->error_end_delimiter     = $this->config->item('error_end_delimiter', 'template');
	}	
	
	
	public function set_message($message)
	{
		$this->messages[] = $message;

		return $message;
	}

	public function messages()
	{
		$_output = '';
		foreach ($this->messages as $message)
		{
			$messageLang = $this->lang->line($message) ? $this->lang->line($message) : '##' . $message . '##';
			$_output .= $this->message_start_delimiter . $messageLang . $this->message_end_delimiter;
		}

		return $_output;
	}
	
	
	public function set_error($error)
	{
		$this->errors[] = $error;

		return $error;
	}

	public function errors()
	{
		$_output = '';
		foreach ($this->errors as $error)
		{
			$errorLang = $this->lang->line($error) ? $this->lang->line($error) : '##' . $error . '##';
			$_output .= $this->error_start_delimiter . $errorLang . $this->error_end_delimiter;
		}

		return $_output;
	}
	
	
	
	
	
	
	public function run($post_opts=array())
	{					
		$config 	= $this->application->get_config(element('action', $post_opts), 'actions');			
		$post_data = 
				array_merge(					
					clean_parameters($config),
					clean_parameters(elements(array_keys($config), $post_opts))
				);
		
		$response = array();
		$start = microtime(true);		
		$this->curl->create(element('server', $post_opts));
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', true);
		$this->curl->option('followlocation', true);
		$this->curl->option('connecttimeout', true);		
		$this->curl->post($post_data);
		$data = $this->curl->execute();	
		
		$this->response_time =  round(microtime(true) - $start, 3) . " seconds"; 		
		if($data !== false) {
			if(strcasecmp(element('responseformat', $post_opts), 'json')==0)
			$response = json_decode($data, true);
			else
			$response = $data;			
			$this->set_message('call_search_success');
		}else{
			$this->set_error('call_search_error');
		}			
		$this->curl->close();
		
		return $response;		
	}
	
	
	
}








