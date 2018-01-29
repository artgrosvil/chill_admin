<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin users
 *
 * @author artgrosvil <artgrosvil@gmail.com>
 * @version 1.0
 * @package iamchill_frontend
 */

class Users_app extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('users_app_model');

		date_default_timezone_set('Europe/Moscow');
		$type_data = "%Y-%m-%d";
		$time = time();
		$this->date = mdate($type_data, $time);
		if ($this->session->userdata('logged_in') != TRUE)
		{
			redirect('/login');
		}
	}

	/**
	* Get all app users
	*
	* @var array $data Data all users
	* @return bool
	*/
	public function index()
	{
		$data['users'] = $this->users_app_model->get_all_users();
		$this->load->view('users/app', $data);
	}

	/**
	* Get data user
	*
	* @var int $id User id
	* @var array $data Data all users
	* @return bool
	*/
	public function get_user()
	{
		$id = $this->input->post('id');
		$data = $this->users_app_model->get_user($id);
		print json_encode($data->row_array());
	}

	/**
	* Get data user
	*
	* @var string $login User login
	* @var string $email User email
	* @var string $password User password
	* @var string $salt Salt password
	* @var string $key Key password
	* @var string $hash Hash password
	* @var array $data Data add user
	* @return bool
	*/
	public function add()
	{
		if ($this->form_validation->run())
		{
			$login = $this->input->post('login');
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			if ($this->users_app_model->check_reg_user($login, $email))
			{
				$salt = '$2y$11$'.substr(md5(uniqid(rand(), true)), 0, 22);
				$key = crypt($password, $salt);

				$salt = '$2y$11$'.substr(md5(uniqid(rand(), true)), 0, 22);
				$hash = crypt($password, $salt);

				$data = array(
					'login' => $login,
					'name' => $name,
					'email' => $email,
					'hash' => $hash,
					'key' => $key,
					'date_reg' => $this->date
					);
				if ($this->users_app_model->add_user($data))
				{
					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}

	/**
	* Edit user
	*
	* @var int $id User id
	* @var string $login User login
	* @var string $email User email
	* @var string $password User password
	* @var string $salt Salt password
	* @var string $key Key password
	* @var string $hash Hash password
	* @var array $data Data add user
	* @return bool
	*/
	public function edit()
	{
		if ($this->form_validation->run())
		{
			$id = $this->input->post('id');
			$login = $this->input->post('login');
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$salt = '$2y$11$'.substr(md5(uniqid(rand(), true)), 0, 22);
			$key = crypt($password, $salt);

			$salt = '$2y$11$'.substr(md5(uniqid(rand(), true)), 0, 22);
			$hash = crypt($password, $salt);

			$data = array(
				'login' => $login,
				'name' => $name,
				'email' => $email,
				'hash' => $hash,
				'key' => $key
				);
			if ($this->users_app_model->update_user($data, $id))
			{
				return TRUE;
			}
		}
		else
		{
			return FALSE;
		}
	}

	/**
	* Approved user
	*
	* @var int $id User id
	* @var array $data Data update
	* @return bool
	*/
	public function approved()
	{
		$id = $this->input->post('id');
		$data = array('approved' => '1');

		if ($this->users_app_model->update_user($data, $id))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	* Get data user
	*
	* @var int $id User id
	* @return bool
	*/
	public function delete()
	{
		$id = $this->input->post('id');
		if ($this->users_app_model->delete_user($id))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}

/* End of file users_app.php */
/* Location: ./application/controllers/users_app.php */