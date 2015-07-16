<?php

class Statistics extends CI_Controller {

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */	

    public function __construct()
    {
        parent::__construct();
		
		$this->lang->load('statistics'); 		
		$this->load->library(array('dashboard_lib', 'statistics_lib', 'document_lib'));
		$this->load->model( array('statistics_model', 'usermeta_model', 'widgets_model', 'tags_model', 'servers_model'));
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'users'), $this->config->item('error_end_delimiter', 'users'));
    }
	
	function index($category=null)
	{				
		if (!$this->users->logged_in())
		{
			//redirect them to the login page
			r_direct_login();
		}
		else
		{					
			$parameters = array();	
			if ($this->input->server('REQUEST_METHOD') === 'POST'){
				$parameters = $_POST;			
			}			
			elseif ($this->input->server('REQUEST_METHOD') === 'GET'){
				$parameters = $_GET;						
			}		
			
			$data['title'] 		= 'Statistical Visualizations';
			$data['js'] 		= array('js/statistics.js');
			$data['main_content'] = 'statistics/index' ;		
			$data['tools'] 		= 'statistics/tools-index' ;	
			$data['category']	= $category;
			$data['parameters'] = $parameters ;				
			$this->load->view('statistics/template', $data);			
		}
	}
	
	
	
	function create($category=null)
	{
		$this->output->cache(0);	
		if (!$this->users->logged_in())
		{
			r_direct_login();
		}
		else 
		{		
			$keys 		= $this->statistics_lib->generate_statistics_key(strtolower($category));	
			$widget_key = join("_", array_values($keys));
			$config 	= $this->application->get_config(strtolower($category), 'statistics');
			$statistics = $this->statistics_model->save_statistics(
							array(
								'active' 		=> false,
								'category' 		=> strtolower($category),
								'key' 			=> $widget_key,
								'config'		=> $config
								)
							
						);
			
			
			$data['modal_title'] 	 	= $category . " Configuration";
			$data['modal_content'] 		= 'widgets/'. $category .'/configure';
			$data['widget_key']			= $widget_key;
			$data['parameters'] 		=  array_merge( 
												array(
													'widget_key'=>$widget_key
													), 
												$keys);
			echo $this->load->view('template/modal-configure-statistics', $data);				
		}		
	}
	
	
	
	
	
	function configure($widget_key=null)
	{
		
		if (!$this->users->logged_in())
		{
			r_direct_login();
		}
		else
		{
			$method = $this->input->server('REQUEST_METHOD');
			$delimiter  = $this->application->get_config('metakey_delimiter', 'template');
			if($widget_key){	
				$get_data = $_GET;
				$keys = $this->statistics_lib->extract_statistics_key($widget_key);
				$data['modal_title'] 	 	= element('title', $get_data) . " Configuration";				
				/**$data['parameters'] 		=  array_merge( array(
													'widget_key'=>$widget_key
													), $keys);**/
				$data['widget_key']			= $widget_key;
				$data['modal_content'] 		= 'widgets/'.element('type', $keys).'/configure';
				echo $this->load->view('template/modal-configure-statistics', $data); 
			}elseif($method == 'POST'){			
				header('Content-Type: application/json');				
				$post_data = $_POST;			
				$widget_key = element('widget_key', $post_data);				
				$statistics = $this->statistics_model->update_statistics($widget_key, $post_data);

				$message = $this->notification->errors() ? $this->notification->errors() : $this->notification->messages();			
				if($statistics)
				echo json_encode(array( 
					'response' => 'success', 
					'message' => $message
					), 
				true);				
				else
				echo json_encode(array( 
					'response' => 'danger', 
					'message' => $message),
				true);	
			}
		}		
	}
	
	function options($widget_key=null)
	{
		
		if (!$this->users->logged_in())
		{
			r_direct_login();
		}
		else
		{
			$method = $this->input->server('REQUEST_METHOD');			
			if($widget_key){
				$widget_key = urldecode($widget_key);
				$keys = $this->statistics_lib->extract_statistics_key($widget_key);
				$data['modal_title'] 	 	= element('type', $keys) . " Configuration";
				$data['modal_content'] 	= 'widgets/'.element('type', $keys).'/options';
				/**$data['parameters'] 		=  array_merge( array(
													'widget_key'=>$widget_key
													), $keys);**/
				$data['widget_key']			= $widget_key;
				echo $this->load->view('template/modal-widget-options', $data); 
			}elseif($method == 'POST'){			
				header('Content-Type: application/json');
				$post_data = $_POST;
				$key = element('widget_key', $post_data);
				unset($post_data['widget_key']);
				$statistics[$key] = $post_data;
				$meta = $this->usermeta_model->save_usermeta(NULL, $statistics);			
				echo json_encode($meta, true);				
			}
		}		
	}		
	
	function copy($widget_key=null)
	{
		
		if (!$this->users->logged_in())
		{
			r_direct_login();
		}
		else
		{			
			$config 	= $this->statistics_model->get_settings($widget_key);
			$keys 		= $this->statistics_lib->extract_statistics_key($widget_key);
			$category 	= element('type', $keys);
			$keys 		= $this->statistics_lib->generate_statistics_key($category);
			$widget_key = join("_", array_values($keys));			
			$statistics = $this->statistics_model->save_statistics(
							array(
								'active' 		=> false,
								'category' 		=> element('type', $keys),
								'key' 			=> $widget_key,
								'config'		=> $config
								)
						);
			$message = $this->notification->errors() ? $this->notification->errors() : $this->notification->messages();			
			if($statistics)
			echo json_encode(array( 
				'response' => 'success', 
				'message' => $message,
				'redirect'=> base_url('statistics')
				), 
			true);				
			else
			echo json_encode(array( 
				'response' => 'danger', 
				'message' => $message),
			true);
		}		
	}
	
	
	
	function delete($key=null)
	{
		
		if (!$this->users->logged_in())
		{
			r_direct_login();
		}elseif($key){
			$statistics =  $this->statistics_model->delete_statistics($key);								
			$message = $this->notification->errors() ? $this->notification->errors() : $this->notification->messages();			
			header('Content-Type: application/json');	
			if($statistics)
			echo json_encode(array( 
				'response' => 'success', 
				'message' => $message,
				'redirect'=> base_url('statistics')
				), 
			true);				
			else
			echo json_encode(array( 
				'response' => 'danger', 
				'message' => $message),
			true);	
			
			
		}
		else
		{
			r_direct('dashboard');		
		}		
	}
	
	
	function settings(){
		header('Content-Type: application/json');				
		if (!$this->users->logged_in())
		{
			r_direct_login();
		}
		else
		{
			$parameters = array();	
			if ($this->input->server('REQUEST_METHOD') === 'POST'){
				$parameters = $_POST;			
			}			
			elseif ($this->input->server('REQUEST_METHOD') === 'GET'){
				$parameters = $_GET;						
			}			
			
			$query_data = array_key_exists('data', $parameters)? element('data', $parameters) : $parameters;
			$settings  	= $this->statistics_model->get_settings(element('widget_key', $parameters));
			$visual = array_key_exists('visual', $settings)? element('visual', $settings) : array($query_data);
			$visual['dataSource'] = (array)$this->statistics_model->get_source($query_data);
			
			
			$settings	= array_merge(
								(array)$settings, 
								array(
									'visual'=>$visual
								)
						);
			echo json_encode($settings ,JSON_NUMERIC_CHECK);		
		}		
	}
	
	
	
	
	
	function timeline(){
		header('Content-Type: application/json');				
		if (!$this->users->logged_in())
		{
			r_direct_login();
		}
		else
		{
			$parameters = array();	
			if ($this->input->server('REQUEST_METHOD') === 'POST'){
				$parameters = $_POST;			
			}			
			elseif ($this->input->server('REQUEST_METHOD') === 'GET'){
				$parameters = $_GET;						
			}				
			
			$query_data 	= array_key_exists('data', $parameters)? element('data', $parameters) : $parameters;
			$settings  		= $this->statistics_model->get_settings(element('widget_key', $parameters));
			$visual 		= array_key_exists('visual', $settings)? element('visual', $settings) : array($query_data);			
			$timeline 		= $this->statistics_model->get_timeline($query_data);						
			$visual 		= array_merge($visual, $timeline);
			$settings		= array_merge(
									(array)$settings, 
									array(
										'visual'=>$visual
									)
							);
								
			
			echo json_encode($settings ,JSON_NUMERIC_CHECK);		
		}		
	}
	
	
	
	
	
}