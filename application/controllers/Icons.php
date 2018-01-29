<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Icons extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('icons_model');
		$this->load->library('upload');
		$this->load->helper('file');

		date_default_timezone_set('Europe/Moscow');
		$type_data = "%Y-%m-%d";
		$time = time();
		$this->date = mdate($type_data, $time);
		if ($this->session->userdata('logged_in') != TRUE) {
			redirect('/login');
		}
	}

	public function index()
	{
		$data['icons'] = $this->icons_model->get_all_icons();
		$this->load->view('icons/main', $data);
	}

	public function get_icon()
	{
		$id = $this->input->post('id');
		if ($data = $this->icons_model->get_icon($id)) {
			print json_encode($data->row_array());
		} else {
			$response = array(
				'success' => FALSE,
				'error' => 101
			);

			print json_encode($response);
		}
	}

	public function add()
	{
		$name = $this->input->post('name');
		$description = $this->input->post('description');
		$pack = $this->input->post('pack');
		$bytes = $this->input->post('bytes');

		$data['name'] = $name;
		$data['pack'] = $pack;
		$data['description'] = $description;
		$data['bytes'] = $bytes;

		$size = array('42', '66', '80', '214', '272');

		$config['allowed_types'] = 'jpg|png';
		$config['upload_path'] = './icons/';
		$config['encrypt_name'] = TRUE;

		$this->upload->initialize($config);
		$this->upload->do_upload();
		$data_img = $this->upload->data();

		$cdn_url = 'http://cdn.iamchill.co/statics/icons/';

		foreach ($size as $item_size) {
			if ($item_size == '80') {
				$image_icon = new Imagick();
				$image_icon->newImage(80, 80, new ImagickPixel('black'));

				$image_tmp = new Imagick($data_img['full_path']);
				$image_tmp->resizeImage(41, 41, Imagick::FILTER_LANCZOS, 1);

				$image_icon->compositeImage($image_tmp, $image_tmp->getImageCompose(), 20, 20);
				$path_icon = './icons/' . $data_img['raw_name'] . '_' . strval($item_size) . '.png';

				$image_icon->writeImage($path_icon);
				$data['size' . $item_size] = $cdn_url . $data_img['raw_name'] . '_' . strval($item_size) . '.png';
			} elseif ($item_size == '272') {
				$image_icon = new Imagick();
				$image_icon->newImage(272, 272, new ImagickPixel('black'));

				$image_tmp = new Imagick($data_img['full_path']);
				$image_tmp->resizeImage(137, 137, Imagick::FILTER_LANCZOS, 1);

				$image_icon->compositeImage($image_tmp, $image_tmp->getImageCompose(), 62, 63);
				$path_icon = './icons/' . $data_img['raw_name'] . '_' . strval($item_size) . '.png';

				$image_icon->writeImage($path_icon);
				$data['size' . $item_size] = $cdn_url . $data_img['raw_name'] . '_' . strval($item_size) . '.png';
			} else {
				$image = new Imagick($data_img['full_path']);
				$image->resizeImage($item_size, $item_size, Imagick::FILTER_LANCZOS, 1);
				$path_icon = './icons/' . $data_img['raw_name'] . '_' . strval($item_size) . '.png';
				$image->writeImage($path_icon);
				$data['size' . $item_size] = $cdn_url . $data_img['raw_name'] . '_' . strval($item_size) . '.png';
			}
		}

		if ($this->icons_model->add($data)) {
			redirect('/icons/index');
			$response = array(
				'success' => TRUE,
				'data' => $data
			);

			print json_encode($response);
		}
	}

	public function delete()
	{
		$id = $this->input->post('id');
		if ($this->icons_model->delete_icon($id)) {
			$data = array(
				'id' => $id
			);
			$response = array(
				'success' => TRUE,
				'data' => $data
			);

			print json_encode($response);
		} else {
			$response = array(
				'success' => FALSE,
				'error' => 131
			);

			print json_encode($response);
		}
	}
}

/* End of file Icons.php */
/* Location: ./application/controllers/Icons.php */