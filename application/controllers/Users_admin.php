<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin users
 *
 * @author artgrosvil <artgrosvil@gmail.com>
 * @version 1.0
 * @package iamchill_frontend
 */

class Users_admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('users_admin_model');

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
	* Get all admin users
	*
	* @var array $data Data all users
	* @return bool
	*/
	public function index()
	{
		$data['data_users'] = $this->users_admin_model->get_all_users();
		$this->load->view('users/admin', $data);
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
		$email = $this->input->post('email');
		if($data = $this->users_admin_model->get_user($email))
		{
			print json_encode($data->row_array());
		}
		else
		{
			$response = array(
				'success' => FALSE,
				'error' => 101
				);

			print json_encode($response);
		}
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
			$email = $this->input->post('email');

			if ($this->users_admin_model->check_reg_user($email))
			{
				$data = array(
					'email' => $email,
					'date_reg' => $this->date
					);
				if ($this->users_admin_model->add_user($data))
				{
					$data = $this->users_admin_model->get_user($email);

					$response = array(
						'success' => TRUE,
						'data' => $data->row()
						);

					print json_encode($response);
				}
				else
				{
					$response = array(
						'success' => FALSE,
						'error' => 113
						);

					print json_encode($response);
				}
			}
			else
			{
				$response = array(
					'success' => FALSE,
					'error' => 112
					);

				print json_encode($response);
			}
		}
		else
		{
			$response = array(
				'success' => FALSE,
				'error' => 111
				);

			print json_encode($response);
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
			$email = $this->input->post('email');

			$data = array(
				'email' => $email,
				);

			if ($this->users_admin_model->update_user($id, $data))
			{
				$response = array(
					'success' => TRUE,
					'data' => $data 
					);

				print json_encode($response);
			}
			else
			{
				$response = array(
					'success' => FALSE,
					'error' => 122
					);

				print json_encode($response);
			}
		}
		else
		{
			$response = array(
				'success' => FALSE,
				'error' => 121
				);

			print json_encode($response);
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
		$email = $this->input->post('email');
		if ($this->users_admin_model->delete_user($email))
		{
			$data = array(
				'email' => $email
				);
			$response = array(
				'success' => TRUE,
				'data' => $data 
				);

			print json_encode($response);
		}
		else
		{
			$response = array(
				'success' => FALSE,
				'error' => 131
				);

			print json_encode($response);
		}
	}

}

/* End of file users_admin.php */
/* Location: ./application/controllers/users_admin.php */