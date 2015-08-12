<?php 
class Api extends CI_Controller
{
     function __construct()
    {
        parent::__construct();	
		$this->load->library(
			array( 
				'api_lib')
			);		
		$this->load->model(
			array( 
				'categorization_model',
				'servers_model')
			);
    }
 
    function categorization($id=null)
    {
		header('Content-Type: application/json');
		$cat = $this->categorization_model->get_categorization($id);
	  
		$cat_settings = array_get_value((array)$cat, 'cat_settings');
		$cat_settings   = unserialize($cat_settings);	
		$cat_settings	= $cat_settings && is_json($cat_settings)? $cat_settings
						: json_encode(array('url' => base_url('data/category-builder-template.js')), JSON_UNESCAPED_SLASHES);
		echo $cat_settings;
    }
	
	
	function call($server_id=NULL)
    {
		header('Content-Type: application/json');
		$result = array();
		$server = (object)$this->servers_model->get_server($server_id)->row();
		
		if($server){
			$parameters = $_POST;		
			$res = $this->api_lib->curl($server->server, $parameters);
		}
		if($res)
			$result = $res;
		
		echo json_encode((array)$result, JSON_NUMERIC_CHECK);
    }
}