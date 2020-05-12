<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
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
		$this->load->view('admin/guru/index', $data);
		$this->load->view('template/footer');
	}

	public function tambah()
	{
		$data['title'] = 'Data Guru';
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('nip', 'Nim', 'required|numeric');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('telp', 'No. HP', 'required|numeric');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header', $data);
			$this->load->view('admin/guru/tambah', $data);
			$this->load->view('template/footer');
		} else {
		}
	}
}

/* End of file Guru.php */
