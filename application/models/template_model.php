<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Template_model extends CI_Model
{	
	protected $tables = array();
	
	protected $current_user = NULL;
	
	public $skins = NULL;
	
	public $layouts = NULL;
	
	public $logo = NULL;
	
	public $tagline = NULL;
	
	
	public function __construct()
	{
		$this->load->model('usermeta_model');		
		$this->load->model('pages_model');
		$this->load->config('template', TRUE);			
		$this->load->library(array('email', 'session'));
		
		$this->load->helper(array('cookie', 'language','url', 'date'));		
		
		$this->current_user = $this->users->user()->row();			
		$this->tables  = $this->config->item('tables', 'template');
		$this->skins = $this->config->item('skins', 'template');
		$this->layouts = $this->config->item('layouts', 'template');		
		$this->logo = $this->config->item('logo', 'template');
		$this->tagline = $this->config->item('tagline', 'template');	
			
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
	
	
	
	
	public function get_box_loading_state()
	{		
		return  $this->config->item('widget_loading_state', 'template');
		
	}
	
	/**
	public function get_menu($group=array())
	{		
		$menu = $this->config->item('menu', 'template');
		if(empty($group)){
			$group = $this->users->get_users_groups()->result();					
		}		
		$group = array_map(function($n){ return $n->name;}, $group);
		if(in_array("admin", $group)){		
			$menu = array_merge_recursive($menu['default'], $menu['admin']);
		}else{
			$menu = array_merge_recursive($menu['default'], $menu['member']);
		}		
		return $menu;
	}
	
	
	public function get_pages($user_id=NULL)
	{					
		$pages = $this->usermeta_model->get_usermeta($user_id, array('meta_key', 'menu' ));
		if(!empty($pages))
			return $this->pages_model->get_pages($user_id);
		else
			return $pages;
		
	}	
	
	
	public function get_breadcrumb()
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
	}	**/	
	
	
	
	
	
	
	
	
	
	
	
	/*
	public function get_logo()
	{	
		return  $this->logo;	
	}
	
	public function get_tagline()
	{	
		return  $this->tagline;	
	}
	
	
	
	
	*	Skins
	*
	
	
	public function get_skins()
	{	
		return  $this->skins;	
	}
	
	public function get_skin()
	{	
		$skin = $this->usermeta_model->get_usermeta(null,array( 'meta_key' => 'dashboard_skin'));
		return $skin? $skin : array_keys($this->skins)[0];
	}
	
	public function save_skin($user_id=null, $skin=null)
	{	
		$result = false;
		$tb = $this->tables['user_meta'];
		$meta_key = 'dashboard_skin';
		$where = array();
		
		if(!$skin || (!$user_id && $this->current_user))
		return $result;	
		$user_id = $user_id? $user_id: $this->current_user->id;
				
			
		$sql = "SELECT id FROM {$tb} WHERE user_id = ? AND dashboard_skin = ?";
		$query = $this->db->query($sql, array($user_id, $skin)); 

		if($query->num_rows() > 0):
			$data = array(
				'meta_value' => $skin
			);		
			$where = $this->database_lib->db_where($where, 'user_id', $user_id);
			$where = $this->database_lib->db_where($where, 'meta_key', $meta_key);
			$this->db->where($where);
			$this->db->update($tb, $data); 
		else:
			$data = array(
				'user_id'   => $user_id,
				'meta_key'   => $meta_key,
				'meta_value' => $skin
			);	
			$this->db->insert($tb, $data);
		endif;
		
		return $data;
		
	}
	*/
	
	
	/*
	*	Layouts
	*
	
	
	public function get_layouts()
	{	
		return  $this->layouts;	
	}
	
	public function get_layout()
	{	
		$layout = $this->usermeta_model->get_usermeta(null,array( 'meta_key' => 'application_layout'));
		return $layout? $layout : array_keys($this->layouts)[0];
	}	
	
	public function save_layout($user_id, $layout=null)
	{	
		$result = false;
		$tb = $this->tables['user_meta'];
		$meta_key = 'dashboard_layout';
		$where = array();
		
		if(!$layout || (!$user_id && $this->current_user))
		return $result;		
		$user_id = $user_id? $user_id: $this->current_user->id;
			
		$sql = "SELECT id FROM {$tb} WHERE user_id = ? AND dashboard_skin = ?";
		$query = $this->db->query($sql, array($user_id, $layout)); 

		if($query->num_rows() > 0):
			$data = array(
				'meta_value' => $layout
			);		
			$where = $this->database_lib->db_where($where, 'user_id', $user_id);
			$where = $this->database_lib->db_where($where, 'meta_key', $meta_key);			
			$this->db->where($where);
			$this->db->update($tb, $data); 
		else:
			$data = array(
				'user_id'   => $user_id,
				'meta_key'   => $meta_key,
				'meta_value' => $layout
			);	
			$this->db->insert($tb, $data);
		endif;
		
		return $data;
		
	}
	*/
	
	
	



}
