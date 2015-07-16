<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



if ( ! function_exists('is_page'))
{
	function is_page() {	
		$ci =& get_instance();	
		$class = explode('_', $ci->router->fetch_class());		
		return strcasecmp('pages', reset($class))==0;
	}
}

if ( ! function_exists('is_search'))
{
	function is_search() {	
		$ci =& get_instance();	
		$class = explode('_', $ci->router->fetch_class());		
		return strcasecmp('search', reset($class))==0;	
	}
}

if ( ! function_exists('is_statistic'))
{
	function is_statistic() {	
		$ci =& get_instance();	
		$class = explode('_', $ci->router->fetch_class());		
		return strcasecmp('statistics', reset($class))==0;
	}
}

if ( ! function_exists('is_public'))
{
	function is_public() {			
		return ( is_page() || is_search() || is_statistic() );	
	}
}






if ( ! function_exists('is_json'))
{
	function is_json($string='') {	
		json_decode($string);
		return (json_last_error() == JSON_ERROR_NONE);
	}
}


if ( ! function_exists('r_direct_login'))
{
	function r_direct_login() {	
		$ci =& get_instance();	
		$url = current_url();
		$method = $ci->router->fetch_method();		
		$logout = strcasecmp($method, 'logout')==0;		
		if($logout)
		redirect('user/login', 'refresh');
		else
		redirect('user/login?r_direct='. urlencode($url), 'refresh');
	}
}


if ( ! function_exists('r_direct'))
{
	function r_direct($url=null, $method='refresh'){		
		$ci =& get_instance();	
		$ci->load->library('user_agent');
		
		$r_direct = null;
		if ($ci->agent->is_referral())
		{			
			parse_str(parse_url($ci->agent->referrer(), PHP_URL_QUERY), $queries);
			$r_direct = element('r_direct', $queries);
		}		
		$url = $url? $url: $ci->router->fetch_class();
		if($r_direct)
		redirect($r_direct, 'refresh');	
		else
		redirect(urldecode($url), $method);	
	}
}



if ( ! function_exists('unserialize_array_values'))
{
	function unserialize_array_values($array = array()) {
		$return = array();
		if(!$array)
		return $return;
		
				
		foreach($array as $arr){
			array_push($return, unserialize($arr));
		}	
		
		
		return $return;
		
	}
}


if ( ! function_exists('generate_timestamp'))
{
	function generate_timestamp() {
		return md5(microtime().rand());	
	}
}





if ( ! function_exists('array_multi'))
{
	function array_multi($a) {
		$rv = array_filter($a,'is_array');
		if(count($rv)>0) return true;
		return false;
	}
}


if ( ! function_exists('array_get_value'))
{
	function array_get_value($array = array(), $key=NULL) {
		$return = array();
		if(!$key || !$array)
		return $return;
		
		
		foreach($array as $k=>$a):
			if(strcmp($k, $key)==0):	
				$return = $a;
				break;  
			elseif(is_array($a)):
				foreach($a as $l=>$b):
					if(strcmp($l, $key)==0):	
						$return = $b;
						break;  
					elseif(is_array($b)):
						foreach($b as $m=>$c):
							if(strcmp($m, $key)==0):	
								$return = $c;
								break;  
							elseif(is_array($c)):
								foreach($c as $n=>$d):
									if(strcmp($n, $key)==0):	
										$return = $d;
										break;  
									elseif(is_array($d)):
									
									endif;
								endforeach;	
							endif;
						endforeach;					
					endif;
				endforeach;      
			endif;
		endforeach;
		
		return $return;
	}
}


if ( ! function_exists('array_create_series'))
{
	function array_create_series($array = array(), $key=NULL) {
		$return = array();
		if(!$array)
		return $return;
		
		return $array;
	}
}





if ( ! function_exists('array_flatten'))
{
	function array_flatten($array = array()) {
		$return = array();
		array_walk_recursive($array, function($a) use (&$return) { $return[] = $a; });
		return $return;
	}
}



if ( ! function_exists('is_response_success'))
{
    function is_response_success($response = array())
    {	
		if(!is_array($response) || !element('autnresponse', $response ))  
		return false;
		
		$autnresponse = element('autnresponse', $response );		
		
		if(!element('response', $autnresponse ) || !strcasecmp('success',element('response', $autnresponse ))===0)  
		return false;
		
		return true;		
    }
}


if ( ! function_exists('get_responsedata'))
{
    function get_responsedata($response = array())
    {	
		$responsedata = array();
		
		//if(is_response_success($response)){
			$autnresponse = element('autnresponse', $response );
			$responsedata = element('responsedata', $autnresponse );
		//}		
		return $responsedata;		
    }
}


if ( ! function_exists('get_autnhit_ids'))
{
    function get_autnhit_ids($response = array())
    {	
		$result = array();
		
		//if(is_response_success($response)){
			$autnresponse = element('autnresponse', $response );
			$responsedata = element('responsedata', $autnresponse );
			
			if(intval(element('autn:numhits', $responsedata )) > 1)
				$result = array_column( element('autn:hit', $responsedata), 'autn:id');
			elseif (intval(element('autn:numhits', $responsedata )) === 1)				
				$result[] = element('autn:id', element('autn:hit', $responsedata) );		
		//}		
		return $result;		
    }
}


if ( ! function_exists('get_vibes_value'))
{
    function get_vibes_value($response = array(), $vibe = NULL)
    {	
		$result = array();
		
		
		$responsedata = get_responsedata($response);	
		
		if(!$vibe || !empty($responsedata)){
		
			if(intval(element('autn:numhits', $responsedata )) > 1){			
			foreach(element('autn:hit', $responsedata) as $autnhit){
				$autnid 	= element('autn:id', $autnhit);
				$autncontent = element('autn:content', $autnhit);
				$document = element('DOCUMENT', $autncontent);
				$result[$autnid] = array_key_exists($vibe,$document)? is_array(element($vibe,$document))? element($vibe,$document) : array(element($vibe,$document)) : array();
			}			
			}				
			elseif (intval(element('autn:numhits', $responsedata )) === 1){			
				$autnhit = element('autn:hit', $responsedata);
				$autncontent = element('autn:content', $autnhit);
				$document = element('DOCUMENT', $autncontent);
				$result = array_key_exists($vibe,$document)? is_array(element($vibe,$document))? element($vibe,$document) : array(element($vibe,$document)) : array();
			}								
		}		
		return $result;		
    }
}


if ( ! function_exists('clean_json_response'))
{
	function clean_json_response($results=array())
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
}



if ( ! function_exists('clean_terms_json_response'))
{	
	function clean_terms_json_response($results=array())
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

if ( ! function_exists('string_limit'))
{
    function string_limit($string = '', $limiter = 0)
    {	
		return (strlen($string) > $limiter) && $limiter > 0 ? substr($string,0,$limiter).'...' : $string ;      
    }

}

if ( ! function_exists('clean_parameters'))
{
	function clean_parameters($parameters=array())
	{		
		$new = array();
		foreach($parameters as $key=>$param):
			
			if(strcasecmp('text', $key)===0):
				$new[$key] = !empty($param)? trim($param) : '*' ;
			elseif(strcasecmp('maxresults', $key)===0 && $param):
				if(array_key_exists('start', $parameters)){
					$start = element('start', $parameters);	
					$maxresults = element('maxresults', $parameters);						
					$new[$key] = ($start + $maxresults) -1 ;				
				}else{
					$new[$key] = $param;
				}
			elseif(strcasecmp('fieldname', $key)===0 && $param):				
				$field = explode("/", $param);				
				if(is_array($field))
					$new[$key] = trim(end($field));
				else
					$new[$key] = trim($field);					
			elseif(strcasecmp('daterange', $key)===0):			
				$date =  array();
				if($param)
				$date = explode("-", $param);
				$maxdate = array_pop($date);
				$new['maxdate'] = $maxdate? $maxdate : '';
				$mindate = array_pop($date);
				$new['mindate'] = $mindate? $mindate : '';				
			elseif(strcasecmp('fieldtext', $key)===0):
				$ft = array();
				$param = $param? $param : array();
				if(is_array($param)){
					foreach($param as $tn=>$tv){
						if(is_array($tv) && element(key($tv), $tv))
						$ft[] = 'MATCH{' . join(",", trim($tv) ) . '}:' . trim($tn);
						else
						$ft[] = 'MATCH{' . $tv . '}:' . trim($tn);
					}
					$new[$key] = empty($ft)? '' : join(' AND ', $ft);	
				}else{
					$new[$key] = $param;	
				}				
							
			elseif(is_array($param)):	
				if(!empty($param)):
				$new[$key] = implode(",", array_values($param));	
				endif;
			elseif ($param && !empty($param)):
				$new[$key] = trim($param);
			endif;
			
		endforeach;
		
		return $new;
	}
}



if (!function_exists('is_str_contain')) {
  function is_str_contain($string, $keyword)
  {
    if (empty($string) || empty($keyword)) return false;
    $keyword_first_char = $keyword[0];
    $keyword_length = strlen($keyword);
    $string_length = strlen($string);

    // case 1
    if ($string_length < $keyword_length) return false;

    // case 2
    if ($string_length == $keyword_length) {
      if ($string == $keyword) return true;
      else return false;
    }

    // case 3
    if ($keyword_length == 1) {
      for ($i = 0; $i < $string_length; $i++) {

        // Check if keyword's first char == string's first char
        if ($keyword_first_char == $string[$i]) {
          return true;
        }
      }
    }

    // case 4
    if ($keyword_length > 1) {
      for ($i = 0; $i < $string_length; $i++) {
        /*
        the remaining part of the string is equal or greater than the keyword
        */
        if (($string_length + 1 - $i) >= $keyword_length) {

          // Check if keyword's first char == string's first char
          if ($keyword_first_char == $string[$i]) {
            $match = 1;
            for ($j = 1; $j < $keyword_length; $j++) {
              if (($i + $j < $string_length) && $keyword[$j] == $string[$i + $j]) {
                $match++;
              }
              else {
                return false;
              }
            }

            if ($match == $keyword_length) {
              return true;
            }

            // end if first match found
          }

          // end if remaining part
        }
        else {
          return false;
        }

        // end for loop
      }

      // end case4
    }

    return false;
  }
}