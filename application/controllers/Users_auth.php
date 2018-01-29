<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Authorization user
 *
 * @author artgrosvil <artgrosvil@gmail.com>
 * @version 1.0
 * @package iamchill_frontend
 */

class Users_auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');

		$this->load->model('users_auth_model');
	}

	/**
	* Login page
	*/
	public function login()
	{
		$this->load->view('users_auth/login');
	}

	/**
	* Authorization user
	*
	* @var string $login User login
	* @var string $password User password
	* @var array $data_user User data
	* @var string $hash_tmp User password hash
	* @return bool
	*/
	public function send_email()
	{
		if ($this->form_validation->run())
		{
			$email = $this->input->post('email');

			$data_user = $this->users_auth_model->get_user($email);
			if ($data_user->num_rows() > 0)
			{
				$code = substr(md5(uniqid(rand(), true)), 0, 10);
				$data = array(
					'code' => $code
					);
				$this->users_auth_model->add_code($email, $data);

				$config['protocol'] = 'smtp';
				$config['smtp_host'] = 'smtp.mandrillapp.com';
				$config['smtp_port'] = '587';
				$config['smtp_user'] = 'iamchillapp@gmail.com';
				$config['smtp_pass'] = 'kY2M2gTepD44GwEEk9Qi6w';
				$config['charset'] = 'utf-8';
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = 'html';

				$this->email->initialize($config);

				$this->email->from('support@iamchill.co', 'iamchill.co');
				$this->email->subject('#iamchill.co');
				$this->email->to($email);
				$this->email->message('Code: '.$code);

				$data = array(
					'email' => $email
					);

				if ($this->email->send())
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
						'error' => 103
						);

					print json_encode($response);
				}
			}
			else
			{
				$response = array(
					'success' => FALSE,
					'error' => 102
					);

				print json_encode($response);
			}
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

	public function send_code()
	{
		if ($this->form_validation->run())
		{
			$email = $this->input->post('email');
			$code = $this->input->post('code');

			$data_user = $this->users_auth_model->get_code($email, $code);
			if ($data_user->num_rows() > 0)
			{
				$data_user = $data_user->row();
				$auth_data = array(
					'id' => $data_user->id,
					'email' => $data_user->email,
					'logged_in' => TRUE
					);

				$this->session->set_userdata($auth_data);

				if ($this->session->has_userdata('logged_in'))
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
	* Reset user authorization
	*/
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/login');
	}
}

/* End of file Users_auth.php */
/* Location: ./application/controllers/Users_auth.php */