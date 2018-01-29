<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_auth_model extends CI_Model {

	function get_user($email)
	{
		$this->db->where('email', $email);
		$data = $this->db->get('users_admin');
		return $data;
	}

	function add_code($email, $data)
	{
		$this->db->where('email', $email);
		if ($this->db->update('users_admin', $data))
		{
			return TRUE; 
		}
		else
		{
			return FALSE;
		}
	}

	function get_code($email, $code)
	{
		$this->db->where('email', $email);
		$this->db->where('code', $code);
		$data = $this->db->get('users_admin');
		return $data;
	}
}

/* End of file Users_auth_model.php */
/* Location: ./application/controllers/Users_auth_model.php */