<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Icons_model extends CI_Model
{

	function get_all_icons()
	{
		$data = $this->db->get('icons');
		return $data;
	}

	function get_icon($id)
	{
		$this->db->where('id', $id);
		$data = $this->db->get('icons');
		return $data;
	}

	function add($data)
	{
		if ($this->db->insert('icons', $data)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function delete_icon($id)
	{
		$this->db->where('id', $id);
		if ($this->db->delete('icons')) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

/* End of file Icons_model.php */
/* Location: ./application/controllers/Icons_model.php */