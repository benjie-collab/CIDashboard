<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Statistics_lib
{
	/**
	 * account status ('not_activated', etc ...)
	 *
	 * @var string
	 **/
	 
	 
	public function __construct()
	{
		$this->load->config('statistics', TRUE);		
		
		$this->load->library(array('email'));
		
		$this->lang->load('dashboard');
		
		$this->lang->load('statistics');
			
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
	
	
	public function generate_statistics_key($type)
	{
		$keys = array(
			'user_id' => $this->users->get_user_id(),
			'type' =>	strtolower($type),
			'timestamp' =>	generate_timestamp()
		);
		
		return $keys;
		
	}
	
	public function extract_statistics_key($key)
	{
		$array = explode("_", $key);
		$keys = array(
			'user_id',
			'type',
			'timestamp'		
		);
		return array_combine($keys, $array);
	}
	
	public function form_ajax_url($parameters=array())
	{		
		return base_url('statistics/get_config');
	}
	
	
	
	public function build_series($source=array(), $arg=null) {
		$series = array();
		$unique_arr = array();
		foreach ($source AS $src) {
			if (is_array($src))
				$unique_arr = array_merge($unique_arr, array_keys($src));
		}
		
		$unique_arr =  array_filter(array_values(array_unique($unique_arr)) , function($k) use($arg){
							return strcasecmp($k, $arg)!=0;
						});
		foreach ($unique_arr AS $srs) {
			$series[] =
						array(
							'valueField'=> $srs,
							'name'=>$srs
						);
		}

		return $series;
	}
	
	


}
