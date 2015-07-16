<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Document_lib
{
	/**
	 * Holds an array of post data used
	 *
	 * @var array
	 **/
	
	
	public $server 	= array();

	public function __construct()
	{
		$this->load->library('curl');	
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
	
	
	public function search_element($name=NULL, $opts=array())
	{	
		
		$opts =array();
		$response = array();	
		
		$response = file_get_contents('assets/dummy/dataset-fields.json');
							
		return json_decode($response, true);
		
	}
	
	
	
	
	public function get_element_name_from_tag_name($tagname=null)
	{			
		$name = '';
		if(!$tagname)
		return $name;
		
		$name = explode("/", $tagname);					
		return end($name);
	}
	
	
	public function elements($name=NULL, $opts=array(), $defaults=false)
	{							
		$default = $this->default_elements();
		$response = array();
		
		$server = array_merge($this->server , $this->usermeta_model->get_usermeta(0, array( 'meta_key' => 'server_status')));	
		
		
		$data =  
		$this->curl->simple_post( element('url', $server) . ':' . element('port', $server), $opts);
		
		
		if($data && $data !== false) {			
			$data = json_decode($data, true);
			$data = $this->document_lib->clean_json_response($data);
		
			if(element( 'autn:name', $data['autnresponse']['responsedata'])){
				$autnname = element( 'autn:name', $data['autnresponse']['responsedata']);
				
				if(is_array($autnname))
					$response = array_values(element( 'autn:name', $data['autnresponse']['responsedata']));
				else
					$response[] = $autnname;
			}
			
			
		}
		
		if($defaults)
			return array_merge($default, array_combine($response, $response));
		else
			return array_combine($response, $response);
	}
	
	public function default_elements()
	{							
		$default = $this->application->get_config('elements', 'search');		
		return $default;
	}
	
	
	
	
	public function clean_json_response($results=array())
	{		
		
		$new = array();		
		foreach($results as $k=>$a):
			if(is_array($a)):		
				foreach($a as $l=>$b):
					if(is_array($b)):
						foreach($b as $m=>$c):
							if(is_array($c)):
								foreach($c as $n=>$d):
									if(is_array($d)):
										foreach($d as $o=>$e):
											if(is_array($e)):
												foreach($e as $p=>$f):
													if(is_array($f)):
														foreach($f as $q=>$g):
															if(is_array($g)):
																foreach($g as $r=>$h):
																	if(is_array($h)):
																		
																	elseif(strcasecmp($r, '$')===0 ):
																		$new[$k][$l][$m][$n][$o][$p][$q] = $h;					
																	endif;											
																endforeach;
															elseif(strcasecmp($q, '$')===0 ):
																$new[$k][$l][$m][$n][$o][$p] = $g;					
															endif;											
														endforeach;
													elseif(strcasecmp($p, '$')===0 ):
														$new[$k][$l][$m][$n][$o] = $f;					
													endif;											
												endforeach;	
											elseif(strcasecmp($o, '$')===0 ):
												$new[$k][$l][$m][$n] = $e;					
											endif;											
										endforeach;	
									elseif(strcasecmp($n, '$')===0 ):
										$new[$k][$l][$m] = $d;					
									endif;
								
								endforeach;	
							elseif(strcasecmp($m, '$')===0 ):
								$new[$k][$l] = $c;					
							endif;
						
						endforeach;	
					elseif(strcasecmp($l, '$')===0 ):
						$new[$k] = $b;					
					endif;				
				endforeach;	
			endif;
			
		endforeach;
		
		return $new;
	}
	
	
	
	
	public function clean_terms_json_response($results=array())
	{		
		$new = array();		
		foreach($results as $k=>$a):
			if(is_array($a)):		
				foreach($a as $l=>$b):
					if(is_array($b)):
						foreach($b as $m=>$c):
							if(is_array($c)):
								foreach($c as $n=>$d):
									if(is_array($d)):
										foreach($d as $o=>$e):
											if(is_array($e)):
												foreach($e as $p=>$f):
													if(is_array($f)):
														foreach($f as $q=>$g):
															if(is_array($g)):
																foreach($g as $r=>$h):
																	if(is_array($h)):
																		
																	elseif(strcasecmp($r, '$')===0 ):
																		$new[$k][$l][$m][$n][$o][$p][$q]['value'] = $h;	
																	else:
																		$new[$k][$l][$m][$n][$o][$p][$q][$r] = $h;
																	endif;											
																endforeach;
															elseif(strcasecmp($q, '$')===0 ):
																$new[$k][$l][$m][$n][$o][$p]['value'] = $g;	
															else:
																$new[$k][$l][$m][$n][$o][$p][$q] = $g;
															endif;											
														endforeach;
													elseif(strcasecmp($p, '$')===0 ):
														$new[$k][$l][$m][$n][$o]['value'] = $f;	
													else:
														$new[$k][$l][$m][$n][$o][$p] = $f;
													endif;											
												endforeach;	
											elseif(strcasecmp($o, '$')===0 ):
												$new[$k][$l][$m][$n]['value'] = $e;	
											else:
												$new[$k][$l][$m][$n][$o] = $e;
											endif;											
										endforeach;	
									elseif(strcasecmp($n, '$')===0 ):
										$new[$k][$l][$m]['value'] = $d;	
									else:
										$new[$k][$l][$m][$n] = $d;
									endif;
								
								endforeach;	
							elseif(strcasecmp($m, '$')===0 ):
								$new[$k][$l]['value'] = $c;	
							else:
								$new[$k][$l][$m] = $c;
							endif;
						
						endforeach;	
					elseif(strcasecmp($l, '$')===0 ):
						$new[$k]['value'] = $b;	
					else:
						$new[$k][$l] = $b;	
					endif;				
				endforeach;	
			endif;
			
		endforeach;
		
		return $new;
	}
	
	
	
}








