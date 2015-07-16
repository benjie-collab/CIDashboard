<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Notification extends CI_Model
{			
	protected $messages;
	
	protected $message_start_delimiter;
	
	protected $message_end_delimiter;
	
	protected $error_start_delimiter;
	
	protected $error_end_delimiter;
	
	protected $errors;	

	public function __construct()
	{
		parent::__construct();		
		
		$this->messages    = array();
		$this->errors      = array();		
		$this->message_start_delimiter = $this->config->item('info_start_delimiter', 'template');
		$this->message_end_delimiter   = $this->config->item('info_end_delimiter', 'template');
		$this->error_start_delimiter   = $this->config->item('error_start_delimiter', 'template');
		$this->error_end_delimiter     = $this->config->item('error_end_delimiter', 'template');
	}		
	
	
	public function set_message_delimiters($start_delimiter, $end_delimiter)
	{
		$this->message_start_delimiter = $start_delimiter;
		$this->message_end_delimiter   = $end_delimiter;

		return TRUE;
	}

	
	public function set_error_delimiters($start_delimiter, $end_delimiter)
	{
		$this->error_start_delimiter = $start_delimiter;
		$this->error_end_delimiter   = $end_delimiter;

		return TRUE;
	}
	
	
	
	public function set_message($message)
	{
		$this->messages[] = $message;

		return $message;
	}

	public function messages()
	{
		$_output = '';
		foreach ($this->messages as $message)
		{
			$messageLang = $this->lang->line($message) ? $this->lang->line($message) : '##' . $message . '##';
			$_output .= $this->message_start_delimiter . $messageLang . $this->message_end_delimiter;
		}

		return $_output;
	}
	
	public function messages_array($langify = TRUE)
	{
		if ($langify)
		{
			$_output = array();
			foreach ($this->messages as $message)
			{
				$messageLang = $this->lang->line($message) ? $this->lang->line($message) : '##' . $message . '##';
				$_output[] = $this->message_start_delimiter . $messageLang . $this->message_end_delimiter;
			}
			return $_output;
		}
		else
		{
			return $this->messages;
		}
	}
	
	public function set_error($error)
	{
		$this->errors[] = $error;

		return $error;
	}

	public function errors()
	{
		$_output = '';
		foreach ($this->errors as $error)
		{
			$errorLang = $this->lang->line($error) ? $this->lang->line($error) : '##' . $error . '##';
			$_output .= $this->error_start_delimiter . $errorLang . $this->error_end_delimiter;
		}

		return $_output;
	}
	
	public function errors_array($langify = TRUE)
	{
		if ($langify)
		{
			$_output = array();
			foreach ($this->errors as $error)
			{
				$errorLang = $this->lang->line($error) ? $this->lang->line($error) : '##' . $error . '##';
				$_output[] = $this->error_start_delimiter . $errorLang . $this->error_end_delimiter;
			}
			return $_output;
		}
		else
		{
			return $this->errors;
		}
	}
}
