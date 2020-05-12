<?php


defined('BASEPATH') or exit('No direct script access allowed');

class GuruController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('guru_model', 'guru');
		$this->load->helper('url', 'form');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'Data Guru';
		$data['guru'] = $this->guru->getGuru();
		$this->load->view('template/header', $data);
		$this->load->view('template/footer');
	}
}

/* End of file GuruController.php */