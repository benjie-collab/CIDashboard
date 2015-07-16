<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Search_model extends CI_Model
{	
	/**
	 * Holds an array of post data used
	 *
	 * @var array
	 **/
	
	//protected $current_user = NULL;
	//public $paging_config 	= array();
	//public $response_time 	= NULL;
	
	//public $tables 	= array();
	
	//public $query_parameters = array();
	
	//public $sources = array();
	
	//public $templates = array();
	
	//public $facets = array();
	
	
	
	//public $widget_containers = array();
	
	//public $server 	= NULL;
	
	//public $settings 	= array();

	protected $search_parameters;
	
	
	public function __construct()
	{
		parent::__construct();	
		//$this->load->helper(array());	
		$this->load->library(array('pagination', 'document_lib' ));	
		$this->load->model(array('usermeta_model'));
		
		//$this->load->config('search', TRUE);	
		//$this->load->config('template', TRUE);	
		//$this->load->config('pagination', TRUE);				
		//$this->current_user = $this->users->user()->row();	
		//$this->widgets = $this->config->item('widgets', 'search');
		
		//$this->tables  			= $this->application->get_config('tables', 'template');
		//$this->server			= $this->application->get_config('server', 'status');			
		//$this->templates 		= $this->application->get_config('templates', 'search');		
		//$this->settings 		= $this->application->get_config('settings', 'search');
		//$this->query_parameters = $this->application->get_config('query', 'actions');	
		//$this->sources 			= $this->application->get_config('sources', 'search');
		//$this->facets 			= $this->application->get_config('facets', 'search');
		
		//$this->widget_containers = $this->config->item('default_widgets', 'search');
		
		$this->search_parameters = array();

	}	
	
	
	public function search_parameters($override=array())
	{
		$parameters = array();	
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			$parameters = $_POST;			
		}			
		elseif ($this->input->server('REQUEST_METHOD') === 'GET'){
			$parameters = $_GET;						
		}	
		
		$start = element('start', $override)? element('start', $override): null;
		
		//$start = 1;
		
		//Get previous Search Options from Session 
		$search_parameters_sess 	= $this->application->get_session_userdata('search_parameters');	
		$search_parameters_config 	= $this->application->get_config('query', 'actions');	
		$search_settings 			= $this->usermeta_model->get_usermeta(0, array('meta_key'=> 'settings_search'));			
		$um_search_settings		 	= array_merge(
										$search_parameters_config, 
										array('server'=>element('server', $search_settings)),
										$override
									);				
		if ($parameters):
			
			// Massage parameters 
			$parameters['databasematch'] = array_key_exists('databasematch', $parameters)? array_values($parameters['databasematch']) : element('databasematch', $search_parameters_sess) ;
			// New search reset to page 1 	
			$start = 1;
			$search_parameters = array_merge($um_search_settings, $search_parameters_sess, $parameters, array('start' => $start));			
			
		elseif($start):
			// This call is pagination load options from session			
			$search_parameters = array_merge($um_search_settings, $search_parameters_sess);				
			$start = intval($start)-1;
			$search_parameters = array_merge($search_parameters, array('start' => ($start*$search_parameters['maxresults'])+1));
		
		else:
			//Its not a post  Give all results				
			$search_parameters = $um_search_settings;
			
		endif;	
		
		$this->search_parameters = $search_parameters;
		
		return $this->search_parameters;
	}
	
	
	public function pagination($opts=array())
	{	
		$config = $this->application->get_config('pagination', 'pagination');		
		$config = 
		array_merge(				
			$config,			
			elements(array_keys($config), $opts),
			array(
				'use_page_numbers' 	=>  (bool)element('use_page_numbers', $opts)? 'true' : 'false',
				'page_query_string' =>  (bool)element('page_query_string', $opts)? 'true' : 'false',
				'display_pages' 	=>  (bool)element('display_pages', $opts)? 'true' : 'false'
			)
		);				
		$this->pagination->initialize($config);	
		return $this->pagination->create_links();		
	}
	
	
	public function search_info($opts=array())
	{		
		
		$page = ceil(intval(element('start', $opts)) / intval(element('per_page', $opts)));
		$page = $page==0 ? 1: $page;
		$start = $opts['start']==0 ? 1: $opts['start'];
		$end = ($page*intval($opts['per_page'])) + 1 > intval($opts['total_rows']) ? intval($opts['total_rows']) : ($page*intval($opts['per_page']));
		return 	number_format($start) .' - '. number_format($end) . ' of ' . number_format($opts['total_rows']) . ' Result(s)';
	}
	
	/**
	
	public function call_search($post_opts=array())
	{					
		//$settings	=  $this->search_model->get_options('settings_query_query');
		$config 	= $this->query_parameters;			
		$post_data = 
				array_merge(					
					clean_parameters($config),
					//clean_parameters(elements(array_keys($config), $settings)),
					clean_parameters(elements(array_keys($config), $post_opts)),
					array(
						'anylanguage' 	=>  (bool)element('anylanguage', $post_opts)? 'true' : 'false',
						'totalresults' =>  (bool)element('totalresults', $post_opts)? 'true' : 'false'
					)
				);
		
		$response = array();
		$start = microtime(true);		
		//$data =  
		//$this->curl->simple_post( element('url', $server) . ':' . element('port', $server), $post_data);	
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
			$response = json_decode($data, true);
			$this->set_message('call_search_success');
		}else{
			$this->set_error('call_search_error');
		}
			
		$this->curl->close();
	
		return $response;		
	}
	
	**/
	
	
	
	
	
	
	/** Search Options saved in user_meta
	public function get_options($meta_key=NULL){
		$options = $this->usermeta_model->get_usermeta(0,  array( 'meta_key' => $meta_key));			
		return $options;	
	} **/
	
	/**
	public function get_templates($type='index')
	{
		$templates = $this->application->get_templates('application/views/search/templates/' . $type . '/');
		return $templates;
	}
	
	public function get_template(){
		$options = $this->usermeta_model->get_usermeta(0,  array( 'meta_key' => 'search_options'));	
		$template = element('template', $options);		
		return $template? $template : 'default';	
	}	
	
	public function get_widget_options($key=NULL)
	{
		$result 	= array();	
		$config 	= $this->application->get_config('widget_option' , 'search');
		$config		= element($key, $config);
		
		if(!$config)
		$config = array();		
		
		return array_merge(  
					$config,
					$this->usermeta_model->get_usermeta(0, array( 'meta_key' => $key.'_options')));	
	}**/
	
	
	
	
	
	/**
	public function get_settings()
	{					
		return $this->settings;				
	}**/
	
	
	
	/**
	public function get_widgets($widget=array())
	{	
		$result = false;		
		if(empty($widget))
		return $result;		
		
		$key = key($widget);			
		$result = $this->config->item($widget[$key], $key);		
		return $result;				
	}**/	
	
	/**
	public function get_widget_settings($key=NULL)
	{
		$result = array();			
		return array_merge( $this->query_parameters, $this->usermeta_model->get_usermeta(0, array( 'meta_key' => $key.'_settings')));	;
	}**/
	
	/**
	public function call_term_expand($post_opts=array())
	{			
		$config = $this->application->get_config('termexpand', 'search');
		$server = array_merge(
						$this->server , 
						$this->usermeta_model->get_usermeta(0, array( 'meta_key' => 'server_settings'))
					);			
		$post_data = 
				array_merge(					
					clean_parameters($config),
					clean_parameters(elements(array_keys($config), $post_opts))					
					);
		$response = array();
		$start = microtime(true);		
		$data =  
		$this->curl->simple_post( element('url', $server) . ':' . element('port', $server), $post_data);		
		$this->response_time =  round(microtime(true) - $start, 3) . " seconds"; 		
		
		
		if($data !== false) {			
			$response = json_decode($data, true);
			$response = $this->document_lib->clean_json_response($response);				
		}
			
		
				
		return $response;		
	}**/
	
	
}








