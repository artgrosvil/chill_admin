<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_app_model extends CI_Model {

	function get_all_users()
	{
		$this->db->where('approved', '1');
		$data = $this->db->get('users_app');
		return $data;
	}

	function get_notapproved_users()
	{
		$this->db->where('approved', '0');
		$data = $this->db->get('users_app');
		return $data;
	}

	function get_user($id)
	{
		$this->db->where('id', $id);
		$data = $this->db->get('users_app');
		return $data;
	}

	function add_user($data)
	{
		if ($this->db->insert('users_app', $data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function update_user($data, $id)
	{
		$this->db->where('id', $id);
		if($this->db->update('users_app', $data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_user($id)
	{
		$this->db->where('id', $id);
		if($this->db->delete('users_app'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function check_reg_user($login)
	{
		$this->db->or_where('login', $login);
		$data = $this->db->get('users_app');
		if ($data->num_rows() == 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}

/* End of file Users_app_model.php */
/* Location: ./application/controllers/Users_app_model.php */