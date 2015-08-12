<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Application
{
	/**
	 * Holds an array of post data used
	 *
	 * @var array
	 **/
	

	public function __construct()
	{
		$this->load->model(array('usermeta_model'));
		
		if(!$this->session->userdata('edit_mode') || !$this->users->is_admin())
			$this->session->set_userdata('edit_mode', 'false');
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
	public function __get($var)
	{
		return get_instance()->$var;
	}
	
	
	
	public function data()
	{		
		$data = array_merge_recursive(
			array(),
			$this->config->item('application', 'template'),
			array(
				'current_method' => $this->router->class . '/' . $this->router->fetch_method(),
				'current_class' => $this->router->class,
				'current_fetch_method' => $this->router->fetch_method()
			)
		);		
		return $data;
	}
	
	public function menu($group=array())
	{		
		$menu = $this->config->item('menu', 'template');
		if(empty($group)){
			$group = $this->users->get_users_groups()->result();					
		}		
		
		$group = array_map(function($n){ return $n->name;}, $group);
		
		$results = array_filter(
					$menu, 
					function($arrayValue) use($group) 
						{ 
							return in_array("admin", $group) || (!in_array("admin", $group) && !$arrayValue['admin']); 
						} 
					);
		
		
		/**
		if(in_array("admin", $group)){		
			$menu = array_merge_recursive($menu['default'], $menu['admin']);
		}else{
			$menu = array_merge_recursive($menu['default'], $menu['member']);
		}	**/
		
		return $results;
	}
	
	
	public function breadcrumb()
	{		
		$breadcrumb = '<ol class="breadcrumb">';
		$breadcrumb .= '<li>
						  <a href="' . base_url($this->router->class) . '">
							' . ucfirst($this->router->class) . '
						  </a> 
						</li>';
		$breadcrumb .= '<li>
						  <a href="#">
							' . ucfirst($this->router->fetch_method()) . '
						  </a> 
						</li>';
		$breadcrumb .= '</ol>';
			
		return $breadcrumb;
	}	
	
	
	public function skins()
	{		
		$pages = array();
		$fnames = array_filter(glob("assets/img/skins/*"), 'is_file');
		foreach($fnames as $file){
			$key = end(explode('/', $file));
			$key = pathinfo($file, PATHINFO_FILENAME);
			$pages[$key] = $file;
		}			
		return $pages;
	}
	
	
	
	
	
	public function set_mode($key=NULL, $mode=NULL)
	{				
		if(!$key)
		return false;
		
		$this->session->set_userdata($key, $mode);
		return true;
	}
	
	public function get_mode($key=NULL)
	{					
		if(!$key)
		return false;
		
		return filter_var($this->session->userdata($key), FILTER_VALIDATE_BOOLEAN); 
	}	
	
	
	public function get_widget($folder=NULL)
	{	
		$widget = array();	
		
		if(!$folder)
		return $widget;	
		$widget =  $this->get_file_data('application/views/widgets/' . $folder .  '/view.php');		
		return $widget;		
	}
	
	
	public function get_widgets($method=NULL)
	{	
		$widgets = array();		
		$filenames = glob('application/views/widgets/*' , GLOB_ONLYDIR);
		
		foreach($filenames as $widget){
			$key = end(explode('/', $widget));
			
			$data =  $this->get_file_data($widget . '/view.php');
			if(strcasecmp($method, element('@method',$data) ) == 0)
			$widgets[$key] = $data;
		}			
		return $widgets;		
	}
	
	
	public function get_methods($path=NULL, $method=NULL)
	{	
		$pages = array();		
		if(!$path)
		return $pages;	
		
		$fnames = array_filter(glob($path."*"), 'is_file');
		foreach($fnames as $file){
			$key = end(explode('/', $file));
			$key = pathinfo($file, PATHINFO_FILENAME);
			$data =  $this->get_file_data($file);
			
			if($method){
				if($method && strcasecmp($method, element('@method',$data) ) == 0)
				$pages[] = $data;
			}elseif(!empty($data))
			$pages[] = $data;
		}			
		return $pages;		
	}
	
	
	public function get_templates($path=NULL, $name=null)
	{	
		$templates = array();		
		if(!$path)
		return $templates;	
		
		$fnames = array_filter(glob($path."*"), 'is_file');
		foreach($fnames as $file){
			$key = end(explode('/', $file));
			$key = pathinfo($file, PATHINFO_FILENAME);
			$data =  $this->get_file_data($file);
			
			
			if(element('@title',$data) || ( $name && strcasecmp($name, element('@method',$data) ) == 0))
			$templates[$key] = element('@title',$data);
		}			
		return $templates;		
	}
	
	
	
	public function get_file_data($filename)
	{
		$params = array();
		$docComments = array();
		
		if(!file_exists ( $filename ))
		return $params;
		
		$docComments = array_filter(token_get_all(file_get_contents($filename)), function($entry)
		{
			return $entry[0] == T_COMMENT;
		});
		
		$fileDocComment = array_shift($docComments);

		$regexp = "/\@.*\:\s.*/";
		preg_match_all($regexp, $fileDocComment[1], $matches, PREG_PATTERN_ORDER);		
		
		for($i = 0; $i < sizeof($matches[0]); $i++)
		{		
			$data = explode(": ", $matches[0][$i]);
			$params[trim(strtolower($data[0]))] = trim($data[1]);
		}

		return $params;
	}
	
	/** Search Options saved in user_meta **/
	public function get_settings($meta_key=NULL){
		$user = $this->is_public()? 0 : NULL;
		$options = $this->usermeta_model->get_usermeta($user,  array( 'meta_key' => $meta_key));			
		return $options;	
	}
	
	
	
	public function get_config($key=NULL, $conf=NULL)
	{
		$result = array();		
		if(!$key || !$conf)
		return $result;		
		$this->load->config($conf, true);
		$result = $this->config->item($key, $conf);	
		return $result;
	}		
	
	
	public function get_databases($server=array()){
		$databases = array();
		$status  = $this->status->get_status($server);
		if(is_response_success($status))
			$databases = element('databases', get_responsedata($status));
		return $databases;	
	}	
	
	
	public function get_session_userdata($session_key=NULL){
		$settings= array();
		if(!$session_key)
		return  $settings;
		
		if($this->session->userdata($session_key))
			$settings = $this->session->userdata($session_key);				
		return $settings;	
	}
	
	
	
	public function styles_setting()
	{		
		$setting = $this->usermeta_model->get_usermeta(0,array( 'meta_key' => 'settings_styles'));
		return $setting;
	}
	
	public function general_setting()
	{		
		$setting = $this->usermeta_model->get_usermeta(0,array( 'meta_key' => 'settings_general'));
		$setting['logo'] = $this->usermeta_model->get_usermeta(0,array( 'meta_key' => 'logo'));
		$setting['favicon'] = $this->usermeta_model->get_usermeta(0,array( 'meta_key' => 'favicon'));		
		return $setting;
	}
	
	public function search_setting()
	{		
		$setting = $this->usermeta_model->get_usermeta(0,array( 'meta_key' => 'settings_search'));
		return $setting;
	}
	
	
	
	
	
	/**
	
	public function is_page(){
		$class = explode('_', $this->router->fetch_class());		
		return strcasecmp('pages', reset($class))==0;	
	}
	public function is_search(){
		$class = explode('_', $this->router->fetch_class());		
		return strcasecmp('search', reset($class))==0;	
	}
	public function is_statistic(){
		$class = explode('_', $this->router->fetch_class());		
		return strcasecmp('statistics', reset($class))==0;	
	}
	
	public function is_public(){			
		return ( $this->is_page() || $this->is_search() || $this->is_statistic() );	
	}**/
	
	
	
	
	
}








