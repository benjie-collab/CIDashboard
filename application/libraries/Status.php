<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Status
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
	
	
	
	
	
	
	
	
	
	
	
	public function set_message($message)
	{
		$this->CI->messages[] = $message;

		return $message;
	}

	public function messages()
	{
		$_output = '';
		foreach ($this->CI->messages as $message)
		{
			$messageLang = $this->CI->lang->line($message) ? $this->CI->lang->line($message) : '##' . $message . '##';
			$_output .= $this->CI->message_start_delimiter . $messageLang . $this->CI->message_end_delimiter;
		}

		return $_output;
	}
	
	
	public function set_error($error)
	{
		$this->CI->errors[] = $error;

		return $error;
	}

	public function errors()
	{
		$_output = '';
		foreach ($this->CI->errors as $error)
		{
			$errorLang = $this->CI->lang->line($error) ? $this->CI->lang->line($error) : '##' . $error . '##';
			$_output .= $this->CI->error_start_delimiter . $errorLang . $this->CI->error_end_delimiter;
		}

		return $_output;
	}
	
	
	
	
	

	/**
	 * __get
	 *
	 * Enables the use of CI super-global without having to define an extra variable.
	 *
	 * I can't remember where I first saw this, so thank you if you are the original author. -Militis
	 *
	 * @access	public
	 * @param	$var
	 * @return	mixed
	 */
	public function save_status($post_opts=array())
	{		
		$status 	= $this->CI->application->get_config('getstatus', 'status');		
		$post_data 	= clean_parameters($post_opts);
		$server 	= $this->CI->application->get_config('server', 'status');		
		$server 	= array_merge(
						$server , 
						$this->CI->usermeta_model->get_usermeta(0, array( 'meta_key' => 'server_status'))
					);			
		$this->CI->curl->create(element('server', $post_data));
		$this->CI->curl->option('buffersize', 10);
		$this->CI->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->CI->curl->option('returntransfer', 1);
		$this->CI->curl->option('followlocation', 1);
		$this->CI->curl->option('HEADER', true);
		$this->CI->curl->option('connecttimeout', 1);
		$this->CI->curl->post($status);
		
		$data = $this->CI->curl->execute();					
		if((bool)$data)
		$meta = $this->CI->usermeta_model->save_usermeta(0, array( 'server_status' => elements(array_keys($server), $post_data)));	
		$this->CI->curl->close();		
		return (bool)$data;
	}
	
	
	public function get_status($post_opts=array())
	{				 
		
		$response 	= false;		
		$config 	= $this->CI->application->get_config('getstatus', 'actions');		
		
					
		$config 	= array_merge(
						clean_parameters($config), 
						clean_parameters(elements(array_keys($config), $post_opts))
					);
		$this->CI->curl->create(element('server', $post_opts));
		$this->CI->curl->option('buffersize', 10);
		$this->CI->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->CI->curl->option('returntransfer', 1);
		$this->CI->curl->option('followlocation', 1);
		//$this->CI->curl->option('HEADER', true);
		$this->CI->curl->option('connecttimeout', 1);
		$this->CI->curl->option('POST', true);
		$this->CI->curl->option('POSTFIELDS', $config);
		
		$data = $this->CI->curl->execute();
		
		if((bool)$data) {			
			$data = json_decode($data, true);
			$response = clean_json_response($data);
		}else{
			$this->set_error('An error encountered while accessing the server, please try again.');
		}
		$this->CI->curl->close();
		return $response;
	}
	
	public function indexer_get_status($post_opts=array())
	{				 
		
		$response 	= false;		
		$config 	= $this->CI->application->get_config('indexergetstatus', 'actions');					
		$config 	= array_merge(
						clean_parameters($config), 
						clean_parameters(elements(array_keys($config), $post_opts))
					);
		
		
		$this->CI->curl->create(element('server', $post_opts));
		$this->CI->curl->option('buffersize', 10);
		$this->CI->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->CI->curl->option('returntransfer', 1);
		$this->CI->curl->option('followlocation', 1);
		//$this->CI->curl->option('HEADER', true);
		$this->CI->curl->option('connecttimeout', 1);
		$this->CI->curl->option('POST', true);
		$this->CI->curl->option('POSTFIELDS', $config);
		
		$data = $this->CI->curl->execute();
		
		if((bool)$data) {			
			$data = json_decode($data, true);
			$response = clean_json_response($data);
		}else{
			$this->set_error('An error encountered while accessing the server, please try again.');
		}	
		$this->CI->curl->close();
		return $response;
	}
	
	
	public function get_pid($post_opts=array())
	{			
		$response 	= false;		
		$config 	= $this->CI->application->get_config('getpid', 'actions');					
		$config 	= array_merge(
						clean_parameters($config), 
						clean_parameters(elements(array_keys($config), $post_opts))
					);
		
		$this->CI->curl->create(element('server', $post_opts));
		$this->CI->curl->option('buffersize', 10);
		$this->CI->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->CI->curl->option('returntransfer', 1);
		$this->CI->curl->option('followlocation', 1);
		//$this->CI->curl->option('HEADER', true);
		$this->CI->curl->option('connecttimeout', 1);
		$this->CI->curl->option('POST', true);
		$this->CI->curl->option('POSTFIELDS', $config);
		
		$data = $this->CI->curl->execute();
		
		if((bool)$data) {			
			$data = json_decode($data, true);
			$response = clean_json_response($data);
		}else{
			$this->set_error('An error encountered while accessing the server, please try again.');
		}		
		$this->CI->curl->close();
		return $response;
	}
	
}