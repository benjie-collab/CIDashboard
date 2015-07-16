<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



if ( ! function_exists('extract_metakey'))
{
	function extract_metakey($metakey = array(), $delimiter= NULL) {
		$meta = '';
		if(!$metakey || !$delimiter)
		return $meta;		
		
		$keys = explode($delimiter, $metakey);	
		$meta = is_array($keys)? reset($keys)		: $keys;
		return $meta;
	}
}