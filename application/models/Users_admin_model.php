<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_admin_model extends CI_Model {

	function get_all_users()
	{
		$data = $this->db->get('users_admin');
		return $data;
	}

	function get_user($email)
	{
		$this->db->where('email', $email);
		$data = $this->db->get('users_admin');
		return $data;
	}

	function add_user($data)
	{
		if ($this->db->insert('users_admin', $data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function update_user($id, $data)
	{
		$this->db->where('id', $id);
		if($this->db->update('users_admin', $data))
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
		if($this->db->delete('users_admin'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function check_reg_user($email)
	{
		$this->db->where('email', $email);
		$data = $this->db->get('users_admin');
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

/* End of file Users_admin_model.php */
/* Location: ./application/controllers/Users_admin_model.php */