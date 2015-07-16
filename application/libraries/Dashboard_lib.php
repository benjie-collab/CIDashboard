<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard_lib
{
	/**
	 * account status ('not_activated', etc ...)
	 *
	 * @var string
	 **/
	protected $status;

	/**
	 * extra where
	 *
	 * @var array
	 **/

	
	public function __construct()
	{
		$this->load->config('dashboard', TRUE);
		
		
		$this->load->library(array('email'));
		
		$this->lang->load('dashboard');
		
		$this->load->helper(array('cookie', 'language','url'));

		$this->load->library('session');
		
		
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
	
	
	/**
	public function get_menu($group=array())
	{		
		$menu = $this->config->item('menu', 'dashboard');
		if(empty($group)){
			$group = $this->ion_auth->get_users_groups()->result();					
		}
		$group = array_map(function($n){ return $n->name;}, $group);
		
		if(in_array("admin", $group)){		
			$menu = array_merge_recursive($menu['default'], $menu['admin']);
		}else{
			$menu = array_merge_recursive($menu['default'], $menu['member']);
		}		
		return $menu;
	}
	
	
	
	public function get_breadcrumb()
	{		
		$breadcrumb = '<ul class="breadcrumb p-10">';
		$breadcrumb .= '<li>
						  <a href="' . $this->router->class . '">
							' . ucfirst($this->router->class) . '
						  </a> 
						</li>';
		$breadcrumb .= '<li>
						  <a href="#">
							' . ucfirst($this->router->fetch_method()) . '
						  </a> 
						</li>';
		$breadcrumb .= '</ul>';
			
		return $breadcrumb;
	}
	
	public function get_box_loading_state(){	
	
		return $this->box_loading_state;
		
	}
	
	public function application_data()
	{		
		$data = array_merge_recursive(
			array(),
			$this->config->item('application', 'dashboard'),
			array(
				'current_method' => $this->router->class . '/' . $this->router->fetch_method(),
				'current_class' => $this->router->class,
				'current_fetch_method' => $this->router->fetch_method()
			)
		);
		
		return $data;
	}**/



}
