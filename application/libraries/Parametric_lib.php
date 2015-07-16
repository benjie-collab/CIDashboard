<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Parametric_lib
{
	/**
	 * Holds an array of post data used
	 *
	 * @var array
	 **/
	
	
	public $server 	= array();

	public function __construct()
	{	
		$this->load->model(array('usermeta_model'));	
		$this->server	= $this->application->get_config('server', 'status');	
		
		
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
	
	
	public function build_fancytree_tagnames($responsedata=array(), $active=NULL, $opts=array())
	{	
	
		$query_settings = $this->application->get_session_userdata('current_search');	
		$fieldtext 		= $query_settings? element('fieldtext', $query_settings): array();
		$ft_tn			= $fieldtext? array_keys($fieldtext) : array();
		$ft_tv			= $fieldtext? array_flatten(array_values(array_values($fieldtext))) : array();
		
		$autnnumberfields = element('autn:number_of_fields', $responsedata);
		$autnnames 		= element('autn:name', $responsedata);

		if($autnnumberfields < 2)
			$autnnames = array($autnnames);
			
		$result=array();
		
		foreach($autnnames as $i=>$autnname){
			$title = $this->document_lib->get_element_name_from_tag_name($autnname);
			
			$tn_ft =false;
			if($fieldtext)
			$tn_ft = element($title, $fieldtext);
			if(strcasecmp($title,'AUTN_GROUP') !==0)
			$result[] = array(
							'title' 		=> $title,
							'key' 			=> $i,
							'folder' 		=> (bool)element('folder', $opts),		
							'lazy' 			=> (bool)element('lazy', $opts),	
							'expand' 		=> (bool)($tn_ft && in_array($title, $ft_tn)),
							'selected' 		=> (bool)($tn_ft && array_key_exists($title, $fieldtext ) && empty($tn_ft[0]))
						);
		
		}
							
		return $result;
		
	}
	
	public function build_fancytree_tagvalues($responsedata=array(), $active=NULL, $opts=array())
	{	
	
		$query_settings = $this->application->get_session_userdata('current_search');	
		$fieldtext 		= $query_settings? element('fieldtext', $query_settings): array();
		$ft_tn			= $fieldtext? array_keys($fieldtext) : array();
		$ft_tv			= $fieldtext? array_flatten(array_values(array_values($fieldtext))) : array();
		
		$ft_tv_			= $fieldtext? array_values(array_values($fieldtext)) : array();
		
		$autnfield 		= element('autn:field', $responsedata);
		$autnnumvalues 	= element('autn:number_of_values', $autnfield);
		$autnname 		= $this->document_lib->get_element_name_from_tag_name(element('autn:name', $autnfield));
		$autnvalue 		= element('autn:value', $autnfield);
		if(is_string($autnvalue))
			$autnvalue = array($autnvalue);
			
		$result=array();
		
		foreach($autnvalue as $i=>$title){
			//$title = $this->document_lib->get_element_name_from_tag_name($value);
			$tn_ft = element($autnname,$fieldtext);
			$result[] = array(
							'title' 		=> $title,
							'key' 			=> $i,
							'folder' 		=> (bool)element('folder', $opts),		
							'lazy' 			=> (bool)element('lazy', $opts),	
							'selected' 		=> (bool)(in_array($title,$ft_tv) || $tn_ft && empty($tn_ft[0]))
						);
		
		}
							
		return $result;
		
	}
	
	
	
	
}








