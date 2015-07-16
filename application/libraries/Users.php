<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth
*
* Version: 2.5.2
*
* Author: Ben Edmunds
*		  ben.edmunds@gmail.com
*         @benedmunds
*
* Added Awesomeness: Phil Sturgeon
*
* Location: http://github.com/benedmunds/CodeIgniter-Ion-Auth
*
* Created:  10.01.2009
*
* Description:  Modified auth system based on redux_auth with extensive customization.  This is basically what Redux Auth 2 should be.
* Original Author name has been kept but that does not mean that the method has not been modified.
*
* Requirements: PHP5 or above
*
*/

class Users
{
	/**
	 * account status ('not_activated', etc ...)
	 *
	 * @var string
	 **/
	protected $status;

	/**
	 * extra where
	 *
	 * @var array
	 **/
	public $_extra_where = array();

	/**
	 * extra set
	 *
	 * @var array
	 **/
	public $_extra_set = array();

	/**
	 * caching of users and their groups
	 *
	 * @var array
	 **/
	public $_cache_user_in_group;

	/**
	 * __construct
	 *
	 * @return void
	 * @author Ben
	 **/
	public function __construct()
	{
		$this->load->config('users', TRUE);
		$this->load->library(array('email'));
		$this->lang->load('users');
		$this->load->helper(array('cookie', 'language','url'));

		$this->load->library('session');

		$this->load->model('users_model');

		$this->_cache_user_in_group =& $this->users_model->_cache_user_in_group;

		//auto-login the user if they are remembered
		if (!$this->logged_in() && get_cookie($this->config->item('identity_cookie_name', 'users')) && get_cookie($this->config->item('remember_cookie_name', 'users')))
		{
			$this->users_model->login_remembered_user();
		}

		$email_config = $this->config->item('email_config', 'users');

		if ($this->config->item('use_ci_email', 'users') && isset($email_config) && is_array($email_config))
		{
			$this->email->initialize($email_config);
		}

		$this->users_model->trigger_events('library_constructor');
	}

	/**
	 * __call
	 *
	 * Acts as a simple way to call model methods without loads of stupid alias'
	 *
	 **/
	public function __call($method, $arguments)
	{
		if (!method_exists( $this->users_model, $method) )
		{
			throw new Exception('Undefined method users::' . $method . '() called');
		}
		if($method == 'create_user')
		{
			return call_user_func_array(array($this, 'register'), $arguments);
		}
		if($method=='update_user')
		{
			return call_user_func_array(array($this, 'update'), $arguments);
		}
		return call_user_func_array( array($this->users_model, $method), $arguments);
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


	/**
	 * forgotten password feature
	 *
	 * @return mixed  boolian / array
	 * @author Mathew
	 **/
	public function forgotten_password($identity)    //changed $email to $identity
	{
		if ( $this->users_model->forgotten_password($identity) )   //changed
		{
			// Get user information
            $user = $this->where($this->config->item('identity', 'users'), $identity)->where('active', 1)->users()->row();  //changed to get_user_by_identity from email

			if ($user)
			{
				$data = array(
					'identity'		=> $user->{$this->config->item('identity', 'users')},
					'forgotten_password_code' => $user->forgotten_password_code
				);

				if(!$this->config->item('use_ci_email', 'users'))
				{
					$this->notification->set_message('forgot_password_successful');
					return $data;
				}
				else
				{
					$message = $this->load->view($this->config->item('email_templates', 'users').$this->config->item('email_forgot_password', 'users'), $data, true);
					$this->email->clear();
					$this->email->from($this->config->item('admin_email', 'users'), $this->config->item('site_title', 'users'));
					$this->email->to($user->email);
					$this->email->subject($this->config->item('site_title', 'users') . ' - ' . $this->lang->line('email_forgotten_password_subject'));
					$this->email->message($message);

					if ($this->email->send())
					{
						$this->notification->set_message('forgot_password_successful');
						return TRUE;
					}
					else
					{
						$this->notification->set_error('forgot_password_unsuccessful');
						return FALSE;
					}
				}
			}
			else
			{
				$this->notification->set_error('forgot_password_unsuccessful');
				return FALSE;
			}
		}
		else
		{
			$this->notification->set_error('forgot_password_unsuccessful');
			return FALSE;
		}
	}

	/**
	 * forgotten_password_complete
	 *
	 * @return void
	 * @author Mathew
	 **/
	public function forgotten_password_complete($code)
	{
		$this->users_model->trigger_events('pre_password_change');

		$identity = $this->config->item('identity', 'users');
		$profile  = $this->where('forgotten_password_code', $code)->users()->row(); //pass the code to profile

		if (!$profile)
		{
			$this->users_model->trigger_events(array('post_password_change', 'password_change_unsuccessful'));
			$this->notification->set_error('password_change_unsuccessful');
			return FALSE;
		}

		$new_password = $this->users_model->forgotten_password_complete($code, $profile->salt);

		if ($new_password)
		{
			$data = array(
				'identity'     => $profile->{$identity},
				'new_password' => $new_password
			);
			if(!$this->config->item('use_ci_email', 'users'))
			{
				$this->notification->set_message('password_change_successful');
				$this->users_model->trigger_events(array('post_password_change', 'password_change_successful'));
					return $data;
			}
			else
			{
				$message = $this->load->view($this->config->item('email_templates', 'users').$this->config->item('email_forgot_password_complete', 'users'), $data, true);

				$this->email->clear();
				$this->email->from($this->config->item('admin_email', 'users'), $this->config->item('site_title', 'users'));
				$this->email->to($profile->email);
				$this->email->subject($this->config->item('site_title', 'users') . ' - ' . $this->lang->line('email_new_password_subject'));
				$this->email->message($message);

				if ($this->email->send())
				{
					$this->notification->set_message('password_change_successful');
					$this->users_model->trigger_events(array('post_password_change', 'password_change_successful'));
					return TRUE;
				}
				else
				{
					$this->notification->set_error('password_change_unsuccessful');
					$this->users_model->trigger_events(array('post_password_change', 'password_change_unsuccessful'));
					return FALSE;
				}

			}
		}

		$this->users_model->trigger_events(array('post_password_change', 'password_change_unsuccessful'));
		return FALSE;
	}

	/**
	 * forgotten_password_check
	 *
	 * @return void
	 * @author Michael
	 **/
	public function forgotten_password_check($code)
	{
		$profile = $this->where('forgotten_password_code', $code)->users()->row(); //pass the code to profile

		if (!is_object($profile))
		{
			$this->notification->set_error('password_change_unsuccessful');
			return FALSE;
		}
		else
		{
			if ($this->config->item('forgot_password_expiration', 'users') > 0) {
				//Make sure it isn't expired
				$expiration = $this->config->item('forgot_password_expiration', 'users');
				if (time() - $profile->forgotten_password_time > $expiration) {
					//it has expired
					$this->clear_forgotten_password_code($code);
					$this->notification->set_error('password_change_unsuccessful');
					return FALSE;
				}
			}
			return $profile;
		}
	}

	/**
	 * register
	 *
	 * @return void
	 * @author Mathew
	 **/
	public function register($username, $password, $email, $additional_data = array(), $group_ids = array()) //need to test email activation
	{
		$this->users_model->trigger_events('pre_account_creation');

		$email_activation = $this->config->item('email_activation', 'users');

		if (!$email_activation)
		{
			$id = $this->users_model->register($username, $password, $email, $additional_data, $group_ids);
			if ($id !== FALSE)
			{
				$this->notification->set_message('account_creation_successful');
				$this->users_model->trigger_events(array('post_account_creation', 'post_account_creation_successful'));
				return $id;
			}
			else
			{
				$this->notification->set_error('account_creation_unsuccessful');
				$this->users_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
				return FALSE;
			}
		}
		else
		{
			$id = $this->users_model->register($username, $password, $email, $additional_data, $group_ids);

			if (!$id)
			{
				$this->notification->set_error('account_creation_unsuccessful');
				return FALSE;
			}

			$deactivate = $this->users_model->deactivate($id);

			if (!$deactivate)
			{
				$this->notification->set_error('deactivate_unsuccessful');
				$this->users_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
				return FALSE;
			}

			$activation_code = $this->users_model->activation_code;
			$identity        = $this->config->item('identity', 'users');
			$user            = $this->users_model->user($id)->row();

			$data = array(
				'identity'   => $user->{$identity},
				'id'         => $user->id,
				'email'      => $email,
				'activation' => $activation_code,
			);
			if(!$this->config->item('use_ci_email', 'users'))
			{
				$this->users_model->trigger_events(array('post_account_creation', 'post_account_creation_successful', 'activation_email_successful'));
				$this->notification->set_message('activation_email_successful');
					return $data;
			}
			else
			{
				$message = $this->load->view($this->config->item('email_templates', 'users').$this->config->item('email_activate', 'users'), $data, true);

				$this->email->clear();
				$this->email->from($this->config->item('admin_email', 'users'), $this->config->item('site_title', 'users'));
				$this->email->to($email);
				$this->email->subject($this->config->item('site_title', 'users') . ' - ' . $this->lang->line('email_activation_subject'));
				$this->email->message($message);

				if ($this->email->send() == TRUE)
				{
					$this->users_model->trigger_events(array('post_account_creation', 'post_account_creation_successful', 'activation_email_successful'));
					$this->notification->set_message('activation_email_successful');
					return $id;
				}
			
			}

			$this->users_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful', 'activation_email_unsuccessful'));
			$this->notification->set_error('activation_email_unsuccessful');
			return FALSE;
		}
	}

	/**
	 * logout
	 *
	 * @return void
	 * @author Mathew
	 **/
	public function logout()
	{
		$this->users_model->trigger_events('logout');

		$identity = $this->config->item('identity', 'users');
                $this->session->unset_userdata( array($identity => '', 'id' => '', 'user_id' => '') );

		//delete the remember me cookies if they exist
		if (get_cookie($this->config->item('identity_cookie_name', 'users')))
		{
			delete_cookie($this->config->item('identity_cookie_name', 'users'));
		}
		if (get_cookie($this->config->item('remember_cookie_name', 'users')))
		{
			delete_cookie($this->config->item('remember_cookie_name', 'users'));
		}

		//Destroy the session
		$this->session->sess_destroy();

		//Recreate the session
		if (substr(CI_VERSION, 0, 1) == '2')
		{
			$this->session->sess_create();
		}
		else
		{
			$this->session->sess_regenerate(TRUE);
		}

		$this->notification->set_message('logout_successful');
		return TRUE;
	}

	/**
	 * logged_in
	 *
	 * @return bool
	 * @author Mathew
	 **/
	public function logged_in()
	{
		$this->users_model->trigger_events('logged_in');

		return (bool) $this->session->userdata('identity');
	}

	/**
	 * logged_in
	 *
	 * @return integer
	 * @author jrmadsen67
	 **/
	public function get_user_id()
	{
		$user_id = $this->session->userdata('user_id');
		if (!empty($user_id))
		{
			return $user_id;
		}
		return null;
	}


	/**
	 * is_admin
	 *
	 * @return bool
	 * @author Ben Edmunds
	 **/
	public function is_admin($id=false)
	{
		$this->users_model->trigger_events('is_admin');

		$admin_group = $this->config->item('admin_group', 'users');

		return $this->in_group($admin_group, $id);
	}

	/**
	 * in_group
	 *
	 * @param mixed group(s) to check
	 * @param bool user id
	 * @param bool check if all groups is present, or any of the groups
	 *
	 * @return bool
	 * @author Phil Sturgeon
	 **/
	public function in_group($check_group, $id=false, $check_all = false)
	{
		$this->users_model->trigger_events('in_group');

		$id || $id = $this->session->userdata('user_id');

		if (!is_array($check_group))
		{
			$check_group = array($check_group);
		}

		if (isset($this->_cache_user_in_group[$id]))
		{
			$groups_array = $this->_cache_user_in_group[$id];
		}
		else
		{
			$users_groups = $this->users_model->get_users_groups($id)->result();
			$groups_array = array();
			foreach ($users_groups as $group)
			{
				$groups_array[$group->id] = $group->name;
			}
			$this->_cache_user_in_group[$id] = $groups_array;
		}
		foreach ($check_group as $key => $value)
		{
			$groups = (is_string($value)) ? $groups_array : array_keys($groups_array);

			/**
			 * if !all (default), in_array
			 * if all, !in_array
			 */
			if (in_array($value, $groups) xor $check_all)
			{
				/**
				 * if !all (default), true
				 * if all, false
				 */
				return !$check_all;
			}
		}

		/**
		 * if !all (default), false
		 * if all, true
		 */
		return $check_all;
	}

}
