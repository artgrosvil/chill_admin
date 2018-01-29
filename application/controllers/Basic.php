<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Basic page
 *
 * @author artgrosvil <artgrosvil@gmail.com>
 * @version 1.0
 * @package iamchill_frontend
 */

class Basic extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('basic_model');
		
		if ($this->session->userdata('logged_in') != TRUE)
		{
			redirect('/login');
		}
	}

	/**
	* Loading the home page and receive statistics
	*
	* @var array $data Statistics api
	*/
	public function index()
	{
		$data['stat'] = $this->basic_model->get_stats();
		$this->load->view('basic/main', $data);
	}
}

/* End of file Basic.php */
/* Location: ./application/controllers/Basic.php */