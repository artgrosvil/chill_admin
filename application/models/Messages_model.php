<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages_model extends CI_Model {

	function get_all_messages()
	{
		$data = $this->db->get('messages');
		return $data;
	}

	function get_message($id)
	{
		$this->db->where('id', $id);
		$data = $this->db->get('messages');
		return $data;
	}

	function delete_message($id)
	{
		$this->db->where('id', $id);
		if($this->db->delete('messages'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}

/* End of file Message_model.php */
/* Location: ./application/controllers/Message_model.php */