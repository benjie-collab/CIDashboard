<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Database_lib
{
	/**
	 * account status ('not_activated', etc ...)
	 *
	 * @var string
	 **/
	 
	protected $current_user;
	 
	public function __construct()
	{		
		
		$this->current_user 		= $this->users->user()->row();
			
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
	
	
	public function db_where($where=array(),$key=NULL, $value=NULL)
	{		
		if(!$key || !$value)	
		return $where;
		
		$where[$key] = $value;
		return $where;			
	}
	
}
