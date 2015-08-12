<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Idol extends CI_Model
{	
	protected $response_time =null;
	
	
	public function __construct()
	{
		parent::__construct();	
	}	
	
	
	public function response_time(){
		return $this->response_time;	
	}
	
	public function AgentAction($post_opts=array())
	{					
		$config 	= 	$this->application->get_config(element('action', $post_opts), 'actions');			
		$post_data  = 
						array_merge(					
							clean_parameters($config),
							clean_parameters(elements(array_keys($config), $post_opts))
						);
		
		$response = false;
		$start = microtime(true);		
		$server = element('server', $post_opts);
 if($server){ $this->curl->create($server);
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', true);
		$this->curl->option('followlocation', true);
		$this->curl->option('connecttimeout', true);		
		$this->curl->post($post_data);
		$data = $this->curl->execute();	
		
		$this->response_time =  round(microtime(true) - $start, 3) . " seconds"; 		
		if($data !== false) {
			if(strcasecmp(element('responseformat', $post_data), 'json')==0)
			$response = json_decode($data, true);
			else
			$response = $data;			
			$this->notification->set_message('idol_server_response_success');
		}else{
			$this->notification->set_error('idol_server_response_error');
		}			
		$this->curl->close(); }else{ $this->notification->set_error('idol_server_response_noserverdefined');  }
		
		return $response;		
	}
	
	
	public function BinaryCategoryAction($post_opts=array())
	{					
		$config 	= 	$this->application->get_config(element('action', $post_opts), 'actions');			
		$post_data  = 
						array_merge(					
							clean_parameters($config),
							clean_parameters(elements(array_keys($config), $post_opts))
						);
		
		$response = false;
		$start = microtime(true);		
		$server = element('server', $post_opts);
 if($server){ $this->curl->create($server);
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', true);
		$this->curl->option('followlocation', true);
		$this->curl->option('connecttimeout', true);		
		$this->curl->post($post_data);
		$data = $this->curl->execute();	
		
		$this->response_time =  round(microtime(true) - $start, 3) . " seconds"; 		
		if($data !== false) {
			if(strcasecmp(element('responseformat', $post_data), 'json')==0)
			$response = json_decode($data, true);
			else
			$response = $data;			
			$this->notification->set_message('idol_server_response_success');
		}else{
			$this->notification->set_error('idol_server_response_error');
		}			
		$this->curl->close(); }else{ $this->notification->set_error('idol_server_response_noserverdefined');  }
		
		return $response;		
	}
	
	public function CategoryAction($post_opts=array())
	{					
		$config 	= 	$this->application->get_config(element('action', $post_opts), 'actions');			
		$post_data  = 
						array_merge(					
							clean_parameters($config),
							clean_parameters(elements(array_keys($config), $post_opts))
						);
		
		$response = false;
		$start = microtime(true);		
		$server = element('server', $post_opts);
 if($server){ $this->curl->create($server);
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', true);
		$this->curl->option('followlocation', true);
		$this->curl->option('connecttimeout', true);		
		$this->curl->post($post_data);
		$data = $this->curl->execute();	
		
		$this->response_time =  round(microtime(true) - $start, 3) . " seconds"; 		
		if($data !== false) {
			if(strcasecmp(element('responseformat', $post_data), 'json')==0)
			$response = json_decode($data, true);
			else
			$response = $data;			
			$this->notification->set_message('idol_server_response_success');
		}else{
			$this->notification->set_error('idol_server_response_error');
		}			
		$this->curl->close(); }else{ $this->notification->set_error('idol_server_response_noserverdefined');  }
		
		return $response;		
	}
	
	public function ClusterAction($post_opts=array())
	{					
		$config 	= 	$this->application->get_config(element('action', $post_opts), 'actions');			
		$post_data  = 
						array_merge(					
							clean_parameters($config),
							clean_parameters(elements(array_keys($config), $post_opts))
						);
		
		$response = false;
		$start = microtime(true);		
		$server = element('server', $post_opts);
 if($server){ $this->curl->create($server);
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', true);
		$this->curl->option('followlocation', true);
		$this->curl->option('connecttimeout', true);		
		$this->curl->post($post_data);
		$data = $this->curl->execute();	
		
		$this->response_time =  round(microtime(true) - $start, 3) . " seconds"; 		
		if($data !== false) {
			if(strcasecmp(element('responseformat', $post_data), 'json')==0)
			$response = json_decode($data, true);
			else
			$response = $data;			
			$this->notification->set_message('idol_server_response_success');
		}else{
			$this->notification->set_error('idol_server_response_error');
		}			
		$this->curl->close(); }else{ $this->notification->set_error('idol_server_response_noserverdefined');  }
		
		return $response;		
	}
	
	
	public function CommunityAction($post_opts=array())
	{					
		$config 	= 	$this->application->get_config(element('action', $post_opts), 'actions');			
		$post_data  = 
						array_merge(					
							clean_parameters($config),
							clean_parameters(elements(array_keys($config), $post_opts))
						);
		
		$response = false;
		$start = microtime(true);		
		$server = element('server', $post_opts);
 if($server){ $this->curl->create($server);
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', true);
		$this->curl->option('followlocation', true);
		$this->curl->option('connecttimeout', true);		
		$this->curl->post($post_data);
		$data = $this->curl->execute();	
		
		$this->response_time =  round(microtime(true) - $start, 3) . " seconds"; 		
		if($data !== false) {
			if(strcasecmp(element('responseformat', $post_data), 'json')==0)
			$response = json_decode($data, true);
			else
			$response = $data;			
			$this->notification->set_message('idol_server_response_success');
		}else{
			$this->notification->set_error('idol_server_response_error');
		}			
		$this->curl->close(); }else{ $this->notification->set_error('idol_server_response_noserverdefined');  }
		
		return $response;		
	}
	
	public function CustomAction($post_opts=array())
	{					
		$config 	= 	$this->application->get_config(element('action', $post_opts), 'actions');			
		$post_data  = 
						array_merge(					
							clean_parameters($config),
							clean_parameters(elements(array_keys($config), $post_opts))
						);
		
		$response = false;
		$start = microtime(true);		
		$server = element('server', $post_opts);
 if($server){ $this->curl->create($server);
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', true);
		$this->curl->option('followlocation', true);
		$this->curl->option('connecttimeout', true);		
		$this->curl->post($post_data);
		$data = $this->curl->execute();	
		
		$this->response_time =  round(microtime(true) - $start, 3) . " seconds"; 		
		if($data !== false) {
			if(strcasecmp(element('responseformat', $post_data), 'json')==0)
			$response = json_decode($data, true);
			else
			$response = $data;			
			$this->notification->set_message('idol_server_response_success');
		}else{
			$this->notification->set_error('idol_server_response_error');
		}			
		$this->curl->close(); }else{ $this->notification->set_error('idol_server_response_noserverdefined');  }
		
		return $response;		
	}
	
	
	public function GeneralAction($post_opts=array())
	{					
		$config 	= 	$this->application->get_config(element('action', $post_opts), 'actions');			
		$post_data  = 
						array_merge(					
							clean_parameters($config),
							clean_parameters(elements(array_keys($config), $post_opts))
						);
		
		$response = false;
		$start = microtime(true);		
		$server = element('server', $post_opts);
 if($server){ $this->curl->create($server);
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', true);
		$this->curl->option('followlocation', true);
		$this->curl->option('connecttimeout', true);		
		$this->curl->post($post_data);
		$data = $this->curl->execute();	
		
		$this->response_time =  round(microtime(true) - $start, 3) . " seconds"; 		
		if($data !== false) {
			if(strcasecmp(element('responseformat', $post_data), 'json')==0)
			$response = json_decode($data, true);
			else
			$response = $data;			
			$this->notification->set_message('idol_server_response_success');
		}else{
			$this->notification->set_error('idol_server_response_error');
		}			
		$this->curl->close(); }else{ $this->notification->set_error('idol_server_response_noserverdefined');  }
		
		return $response;		
	}
	
	
	public function MaintenanceAction($post_opts=array())
	{					
		$config 	= 	$this->application->get_config(element('action', $post_opts), 'actions');			
		$post_data  = 
						array_merge(					
							clean_parameters($config),
							clean_parameters(elements(array_keys($config), $post_opts))
						);
		
		$response = false;
		$start = microtime(true);		
		$server = element('server', $post_opts);
 if($server){ $this->curl->create($server);
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', true);
		$this->curl->option('followlocation', true);
		$this->curl->option('connecttimeout', true);		
		$this->curl->post($post_data);
		$data = $this->curl->execute();	
		
		$this->response_time =  round(microtime(true) - $start, 3) . " seconds"; 		
		if($data !== false) {
			if(strcasecmp(element('responseformat', $post_data), 'json')==0)
			$response = json_decode($data, true);
			else
			$response = $data;			
			$this->notification->set_message('idol_server_response_success');
		}else{
			$this->notification->set_error('idol_server_response_error');
		}			
		$this->curl->close(); }else{ $this->notification->set_error('idol_server_response_noserverdefined');  }
		
		return $response;		
	}
	
	public function MiscellaneousAction($post_opts=array())
	{					
		$config 	= 	$this->application->get_config(element('action', $post_opts), 'actions');			
		$post_data  = 
						array_merge(					
							clean_parameters($config),
							clean_parameters(elements(array_keys($config), $post_opts))
						);
		
		$response = false;
		$start = microtime(true);		
		$server = element('server', $post_opts);
 if($server){ $this->curl->create($server);
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', true);
		$this->curl->option('followlocation', true);
		$this->curl->option('connecttimeout', true);		
		$this->curl->post($post_data);
		$data = $this->curl->execute();	
		
		$this->response_time =  round(microtime(true) - $start, 3) . " seconds"; 		
		if($data !== false) {
			if(strcasecmp(element('responseformat', $post_data), 'json')==0)
			$response = json_decode($data, true);
			else
			$response = $data;			
			$this->notification->set_message('idol_server_response_success');
		}else{
			$this->notification->set_error('idol_server_response_error');
		}			
		$this->curl->close(); }else{ $this->notification->set_error('idol_server_response_noserverdefined');  }
		
		return $response;		
	}
	
	public function ProfileAction($post_opts=array())
	{					
		$config 	= 	$this->application->get_config(element('action', $post_opts), 'actions');			
		$post_data  = 
						array_merge(					
							clean_parameters($config),
							clean_parameters(elements(array_keys($config), $post_opts))
						);
		
		$response = false;
		$start = microtime(true);		
		$server = element('server', $post_opts);
 if($server){ $this->curl->create($server);
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', true);
		$this->curl->option('followlocation', true);
		$this->curl->option('connecttimeout', true);		
		$this->curl->post($post_data);
		$data = $this->curl->execute();	
		
		$this->response_time =  round(microtime(true) - $start, 3) . " seconds"; 		
		if($data !== false) {
			if(strcasecmp(element('responseformat', $post_data), 'json')==0)
			$response = json_decode($data, true);
			else
			$response = $data;			
			$this->notification->set_message('idol_server_response_success');
		}else{
			$this->notification->set_error('idol_server_response_error');
		}			
		$this->curl->close(); }else{ $this->notification->set_error('idol_server_response_noserverdefined');  }
		
		return $response;		
	}
	
	
	public function QueryAction($post_opts=array())
	{					
		$config 	= 	$this->application->get_config(element('action', $post_opts), 'actions');			
		$post_data  = 
						array_merge(					
							clean_parameters($config),
							clean_parameters(elements(array_keys($config), $post_opts))
						);
		
		$response = false;
		$start = microtime(true);		
		$server = element('server', $post_opts);
 if($server){ $this->curl->create($server);
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', true);
		$this->curl->option('followlocation', true);
		$this->curl->option('connecttimeout', true);		
		$this->curl->post($post_data);
		$data = $this->curl->execute();	
		
		$this->response_time =  round(microtime(true) - $start, 3) . " seconds"; 		
		if($data !== false) {
			if(strcasecmp(element('responseformat', $post_data), 'json')==0)
			$response = json_decode($data, true);
			else
			$response = $data;			
			$this->notification->set_message('idol_server_response_success');
		}else{
			$this->notification->set_error('idol_server_response_error');
		}			
		$this->curl->close(); }else{ $this->notification->set_error('idol_server_response_noserverdefined');  }
		
		return $response;		
	}
	
	public function RoleAction($post_opts=array())
	{					
		$config 	= 	$this->application->get_config(element('action', $post_opts), 'actions');			
		$post_data  = 
						array_merge(					
							clean_parameters($config),
							clean_parameters(elements(array_keys($config), $post_opts))
						);
		
		$response = false;
		$start = microtime(true);		
		$server = element('server', $post_opts);
 if($server){ $this->curl->create($server);
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', true);
		$this->curl->option('followlocation', true);
		$this->curl->option('connecttimeout', true);		
		$this->curl->post($post_data);
		$data = $this->curl->execute();	
		
		$this->response_time =  round(microtime(true) - $start, 3) . " seconds"; 		
		if($data !== false) {
			if(strcasecmp(element('responseformat', $post_data), 'json')==0)
			$response = json_decode($data, true);
			else
			$response = $data;			
			$this->notification->set_message('idol_server_response_success');
		}else{
			$this->notification->set_error('idol_server_response_error');
		}			
		$this->curl->close(); }else{ $this->notification->set_error('idol_server_response_noserverdefined');  }
		
		return $response;		
	}
	
	
	public function StatusAction($post_opts=array())
	{					
		$config 	= 	$this->application->get_config(element('action', $post_opts), 'actions');			
		$post_data  = 
						array_merge(					
							clean_parameters($config),
							clean_parameters(elements(array_keys($config), $post_opts))
						);
		
		$response = false;
		$start = microtime(true);		
		$server = element('server', $post_opts);
 if($server){ $this->curl->create($server);
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', true);
		$this->curl->option('followlocation', true);
		$this->curl->option('connecttimeout', true);		
		$this->curl->post($post_data);
		$data = $this->curl->execute();	
		
		$this->response_time =  round(microtime(true) - $start, 3) . " seconds"; 		
		if($data !== false) {
			if(strcasecmp(element('responseformat', $post_data), 'json')==0)
			$response = json_decode($data, true);
			else
			$response = $data;			
			$this->notification->set_message('idol_server_response_success');
		}else{
			$this->notification->set_error('idol_server_response_error');
		}			
		$this->curl->close(); }else{ $this->notification->set_error('idol_server_response_noserverdefined');  }
		
		return $response;		
	}
	
	
	public function TagAction($post_opts=array())
	{					
		$config 	= 	$this->application->get_config(element('action', $post_opts), 'actions');			
		$post_data  = 
						array_merge(					
							clean_parameters($config),
							clean_parameters(elements(array_keys($config), $post_opts))
						);
		
		$response = false;
		$start = microtime(true);		
		$server = element('server', $post_opts);
 if($server){ $this->curl->create($server);
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', true);
		$this->curl->option('followlocation', true);
		$this->curl->option('connecttimeout', true);		
		$this->curl->post($post_data);
		$data = $this->curl->execute();	
		
		$this->response_time =  round(microtime(true) - $start, 3) . " seconds"; 		
		if($data !== false) {
			if(strcasecmp(element('responseformat', $post_data), 'json')==0)
			$response = json_decode($data, true);
			else
			$response = $data;			
			$this->notification->set_message('idol_server_response_success');
		}else{
			$this->notification->set_error('idol_server_response_error');
		}			
		$this->curl->close(); }else{ $this->notification->set_error('idol_server_response_noserverdefined');  }
		
		return $response;		
	}
	
	
	public function TaxonomyAction($post_opts=array())
	{					
		$config 	= 	$this->application->get_config(element('action', $post_opts), 'actions');			
		$post_data  = 
						array_merge(					
							clean_parameters($config),
							clean_parameters(elements(array_keys($config), $post_opts))
						);
		
		$response = false;
		$start = microtime(true);		
		$server = element('server', $post_opts);
 if($server){ $this->curl->create($server);
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', true);
		$this->curl->option('followlocation', true);
		$this->curl->option('connecttimeout', true);		
		$this->curl->post($post_data);
		$data = $this->curl->execute();	
		
		$this->response_time =  round(microtime(true) - $start, 3) . " seconds"; 		
		if($data !== false) {
			if(strcasecmp(element('responseformat', $post_data), 'json')==0)
			$response = json_decode($data, true);
			else
			$response = $data;			
			$this->notification->set_message('idol_server_response_success');
		}else{
			$this->notification->set_error('idol_server_response_error');
		}			
		$this->curl->close(); }else{ $this->notification->set_error('idol_server_response_noserverdefined');  }
		
		return $response;		
	}
	
	
	public function TermAction($post_opts=array())
	{					
		$config 	= 	$this->application->get_config(element('action', $post_opts), 'actions');			
		$post_data  = 
						array_merge(					
							clean_parameters($config),
							clean_parameters(elements(array_keys($config), $post_opts))
						);
		
		$response = false;
		$start = microtime(true);		
		$server = element('server', $post_opts);
 if($server){ $this->curl->create($server);
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', true);
		$this->curl->option('followlocation', true);
		$this->curl->option('connecttimeout', true);		
		$this->curl->post($post_data);
		$data = $this->curl->execute();	
		
		$this->response_time =  round(microtime(true) - $start, 3) . " seconds"; 		
		if($data !== false) {
			if(strcasecmp(element('responseformat', $post_data), 'json')==0)
			$response = json_decode($data, true);
			else
			$response = $data;			
			$this->notification->set_message('idol_server_response_success');
		}else{
			$this->notification->set_error('idol_server_response_error');
		}			
		$this->curl->close(); }else{ $this->notification->set_error('idol_server_response_noserverdefined');  }
		
		return $response;		
	}
	
	
	public function UserAction($post_opts=array())
	{					
		$config 	= 	$this->application->get_config(element('action', $post_opts), 'actions');			
		$post_data  = 
						array_merge(					
							clean_parameters($config),
							clean_parameters(elements(array_keys($config), $post_opts))
						);
		
		$response = false;
		$start = microtime(true);		
		$server = element('server', $post_opts);
 if($server){ $this->curl->create($server);
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', true);
		$this->curl->option('followlocation', true);
		$this->curl->option('connecttimeout', true);		
		$this->curl->post($post_data);
		$data = $this->curl->execute();	
		
		$this->response_time =  round(microtime(true) - $start, 3) . " seconds"; 		
		if($data !== false) {
			if(strcasecmp(element('responseformat', $post_data), 'json')==0)
			$response = json_decode($data, true);
			else
			$response = $data;			
			$this->notification->set_message('idol_server_response_success');
		}else{
			$this->notification->set_error('idol_server_response_error');
		}			
		$this->curl->close(); }else{ $this->notification->set_error('idol_server_response_noserverdefined');  }
		
		return $response;		
	}
	
	
	public function ViewAction($post_opts=array())
	{					
		$config 	= 	$this->application->get_config(element('action', $post_opts), 'actions');			
		$post_data  = 
						array_merge(					
							clean_parameters($config),
							clean_parameters(elements(array_keys($config), $post_opts))
						);
		
		$response = false;
		$start = microtime(true);		
		$server = element('server', $post_opts);
 if($server){ $this->curl->create($server);
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
		$this->curl->option('returntransfer', true);
		$this->curl->option('followlocation', true);
		$this->curl->option('connecttimeout', true);		
		$this->curl->post($post_data);
		$data = $this->curl->execute();	
		
		$this->response_time =  round(microtime(true) - $start, 3) . " seconds"; 		
		if($data !== false) {
			if(strcasecmp(element('responseformat', $post_data), 'json')==0)
			$response = json_decode($data, true);
			else
			$response = $data;			
			$this->notification->set_message('idol_server_response_success');
		}else{
			$this->notification->set_error('idol_server_response_error');
		}			
		$this->curl->close(); }else{ $this->notification->set_error('idol_server_response_noserverdefined');  }
		
		return $response;		
	}
	
}








