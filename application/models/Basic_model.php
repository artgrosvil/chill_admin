<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Basic_model extends CI_Model {

	function get_stats()
	{
		$count_users_app = $this->db->count_all_results('users_app');
		$count_messages = $this->db->count_all_results('messages');
		
		$data = array(
			'count_promo_email' => 1204,
			'count_users_app' => $count_users_app,
			'count_messages' => $count_messages
			);
		return $data;
	}
}

/* End of file Basic_model.php */
/* Location: ./application/controllers/Basic_model.php */