<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Dashboard_model extends CI_Model
{	
	/**
	 * Holds an array of tables used
	 *
	 * @var array
	 **/
	public $tables = array();
	
	protected $current_user = NULL;
	

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		
		$this->load->model('usermeta_model');	
		
		$this->current_user = $this->users->user()->row();		
		
		$this->load->config('template', TRUE);		
		$this->lang->load('dashboard');
		
		$this->load->helper('cookie');
		$this->load->helper('date');
		
		
		$this->tables  = $this->config->item('tables', 'template');

		
	}
	
	
	
	
	

	
}
