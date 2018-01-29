<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Messages users
 *
 * @author artgrosvil <artgrosvil@gmail.com>
 * @version 1.0
 * @package iamchill_frontend
 */
class Messages extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('messages_model');

        date_default_timezone_set('Europe/Moscow');
        $type_data = "%Y-%m-%d";
        $time = time();
        $this->date = mdate($type_data, $time);
        if ($this->session->userdata('logged_in') != TRUE) {
            redirect('/login');
        }
    }

    /**
     * Get messages users
     *
     * @var array $data messages users
     */
    public function index()
    {
        $data['messages'] = $this->messages_model->get_all_messages();
        $this->load->view('messages/main', $data);
    }

    /**
     * Get message user
     *
     * @var int $id Id message
     * @var array $data Array data message
     * @var array $data messages users
     */
    public function get_message()
    {
        $id = $this->input->post('id');
        $data = $this->messages_model->get_message($id);
        print json_encode($data->row_array());
    }

    /**
     * Get messages users
     *
     * @var int $id Id message
     * @return bool
     */
    public function delete()
    {
        $id = $this->input->post('id');
        if ($this->messages_model->delete_message($id)) {
            return TRUE;
        }
    }
}

/* End of file Messages.php */
/* Location: ./application/controllers/Messages.php */