<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Statistics_model extends CI_Model
{	
	/**
	 * Holds an array of post data used
	 *
	 * @var array
	 **/	
	
	public $tables 	= array();

	public function __construct()
	{
		parent::__construct();	
		$this->load->database();		
		$this->load->library(array('database_lib'));		
		$this->tables  = $this->application->get_config('tables', 'template');
		
	}	
	
	
	
	public function get_statistics($options=array())
	{	
		$result = array();
		$tb = $this->tables['widgets'];			
		$where = array();	
		
		$this->db->cache_on();
		foreach($options as $key=>$value){	
			$where = $this->database_lib->db_where($where, $key, $value);
		}			
		$result =
		$this->db->select("widget_key, category")
		  ->from($tb)
		  ->where($where)
		  ->order_by('id', 'desc')
		  ->limit(10)
		  ->get()
		  ->result_array();	
		  
		return $result;				
	}
	
	public function delete_statistics($key=NULL){	
	
		$result = false;
		$tb = $this->tables['widgets'];
		
		if(empty($key))
		return $result;
		
		$where = array();
		
		if(!$this->users->is_admin() && $this->users->logged_in())
		$where = $this->database_lib->db_where($where, 'user_id', $this->users->get_user_id());
		$where = $this->database_lib->db_where($where, 'widget_key', trim($key));
		
		$this->db->where($where);
		$this->db->delete($tb); 
		
		if ($this->db->_error_message()) {
			$this->notification->set_error('widgets_error_delete');
		} else if (!$this->db->affected_rows()) {
			$this->notification->set_error('widgets_error_delete');
		} else {
			$this->notification->set_message('widgets_success_delete');
			$result = true;
		}

		return $result;
	
	}
	
	
	
	
	public function save_statistics($options = array())
	{	
		$result = false;
		$tb = $this->tables['widgets'];	

		if(!$options)
		return $result;
		
		$user_id = element('user_id', $options)? element('user_id', $options) : $this->users->get_user_id();			
		$data = array(
		    'user_id'      		=> $user_id,
			'active'       		=> element('active', $options),
		    'category'     		=> element('category', $options),
			'widget_key'     	=> element('key', $options),
		    'widget_settings'	=> serialize(element('config', $options))
		);		
		
		$this->db->insert($tb, $data);
		$id = $this->db->insert_id();
		
		if ($this->db->_error_message()) {
			$this->notification->set_error('widgets_error_add');
		} else {
			$this->notification->set_message('widgets_success_add');
			$result = true;
		}
		
		return $result;		
		
	}
	
	
	public function update_statistics($widget_key=NULL, $settings=array())
	{	
		$result = false;
		$tb = $this->tables['widgets'];	
		$where = array();
		
		
		if(!$widget_key)
		return $result;	

		$data = array(
			'active'       		=> element('active', $settings)? true: false,
		    'widget_settings'	=> serialize($settings)
		);	
		
		$where = $this->database_lib->db_where($where, 'widget_key', $widget_key);
		$this->db->where($where);
		$this->db->update($tb, $data); 
		
		
		if ($this->db->_error_message()) {
			$this->notification->set_error('widgets_error_update');
		} else {
			$this->notification->set_message('widgets_success_update');
			$result = true;
		}
		
		return $result;		
		
	}
	
	
	
	public function get_source($parameters=array())
	{
		$results 	= array();		
		if(!$parameters)
		return $results;		
		$values 	= $this->tags_model->call_get_query_tag_values($parameters);		
		$results 	= array_get_value($values, element('source', $parameters));		
		return $results;	
	}
	
	
	public function get_timeline($parameters=array())
	{
		$results = array(); $dataSource = array();		
		if(!$parameters)
		return $results;

		if(strcasecmp(element('dateperiod', $parameters), 'month')==0){
		
			$i = 1;
			$year = element('year', $parameters);
			$month = strtotime("FIRST DAY OF JANUARY ". $year);
			while($i <= 12)
			{	
				$month_string = date('F', $month);
				$curr_month = date('d/m/Y', $month);				
				$month = strtotime('+1 month', $month);
				$next_month = date('d/m/Y', $month);
				
					$param = 
					array_merge(
						array(
						'action' => 'GetQueryTagValues',
						'maxresults' => 1000000,
						'fieldtext' => 'RANGE{' . $curr_month . ',' . $next_month . '}:ISSUE_REPORT_DATE_N_S_P',							
						),
						$parameters
					);				
				$data= $this->tags_model->call_get_query_tag_values($param);
				$data = array_get_value($data, element('source', $parameters));
				$data = array_key_exists('value', $data)? array($data): $data;
				
				
				$res = array();
				foreach($data as $dt){
					$res[$dt['value']] = $dt['@count'];
				}
				$argument[element('dateperiod', $parameters)] = $month_string;
				$dataSource[] = array_merge( $argument, $res);
				$i++;
			}
		
		}
		
		$results['dataSource']= $dataSource;
		$results['series'] = $this->statistics_lib->build_series($dataSource, element('dateperiod', $parameters));	
		
		return $results;	
	}
	
	
	
	
	public function get_statistic($key=NULL)
	{	
		$result = array();	
		$where = array();	
		$tb = $this->tables['widgets'];
		
		if(!$key)
		return $result;			
		
		$where = $this->database_lib->db_where($where, 'widget_key', $key);
		
		$result=
		$this->db->select("user_id, active, category, widget_settings")
		  ->from($tb)
		  ->where($where)
		  ->limit(1)
		  ->get()
		  ->result_array();					
		return $result ? $result[0]: $result;		
	}
	
	
	public function get_settings($key=NULL)
	{	
		$result = array();	
		$where = array();	
		$tb = $this->tables['widgets'];
		
		if(!$key)
		return $result;			
		
		$where = $this->database_lib->db_where($where, 'widget_key', $key);
		
		$result=
		$this->db->select("widget_settings")
		  ->from($tb)
		  ->where($where)
		  ->limit(1)
		  ->get()
		  ->result_array();			
		
		if(sizeOf($result) > 0)
			$result = unserialize(element('widget_settings', $result[0])); 
			
		return $result;		
	}	
	
	
	public function user_has_rights($widget=NULL)
	{	
		$result = false;	
		$user_id = element('user_id', $widget);
			
		if(!$widget)
		return false;		
		
		$admin_owned = $this->users->is_admin($user_id);
		
		if($this->users->is_admin())
		return true;
		
		if($admin_owned)
		return false;	
		
		return intval($this->users->get_user_id()) == intval($user_id);
	}
	
	
	public function user_is_owner($widget=NULL)
	{	
		$result = false;	
		$user_id = element('user_id', $widget);		
		
		return intval($this->users->get_user_id()) == intval($user_id);
	}
	
	
	
	
	
	
	
	
	
	
	
	/**
	public function get_categories()
	{	
		return $this->application->get_config('categories', 'statistics');	
	}	
	
	
	public function get_config($widget_key=NULL)
	{	
		$result = array();	
		$where = array();	
		$tb = $this->tables['widgets'];
		
		if(!$widget_key)
		return $result;			
		
		$where = $this->database_lib->db_where($where, 'widget_key', $widget_key);
		
		$result=
		$this->db->select("widget_settings")
		  ->from($tb)
		  ->where($where)
		  ->limit(1)
		  ->get()
		  ->result_array();			
		
		if(sizeOf($result) > 0)
			$result = unserialize(element('widget_settings', $result[0])); 
		else{	
			$result = $this->application->get_config($widget_key);
			$result = json_encode($result, JSON_NUMERIC_CHECK);
		}			
		return $result;		
	}	
	
	
	
	
	
	
	public function save_statistics($category, $statistics=array()){	
	
		$result = false;
		$tb = $this->tables['widgets'];
		$where = array();
		
		if(empty($statistics))
		return $result;
		
		$key = key($statistics);		
		
		$sql = "SELECT widget_settings FROM {$tb} WHERE user_id = ? AND widget_key = ?";
		$query = $this->db->query($sql, array($this->users->get_user_id(), $key)); 

		if($query->num_rows() > 0):
			$widget_settings = array_merge(
										json_decode(unserialize($query->row()->widget_settings), true), 
										array_shift($statistics)
										);
			$data = array(
				'user_id'   => $this->users->get_user_id(),
				'widget_key'   => $key,
				'widget_settings' => serialize(json_encode($widget_settings,JSON_NUMERIC_CHECK))
			);
			$where = $this->database_lib->db_where($where, 'user_id', $this->users->get_user_id());
			$where = $this->database_lib->db_where($where, 'widget_key', $key);
			$this->db->where($where);
			$this->db->update($tb, $data); 
		else:
			$data = array(
				'user_id'   => $this->users->get_user_id(),
				'category'   => $category,
				'widget_key'   => $key,
				'widget_settings' => serialize(array_shift($statistics))
			);
			$this->db->insert($tb, $data);
			$id = $this->db->insert_id();
		endif;
		
		return $data;
	
	}**/
	
	
}
