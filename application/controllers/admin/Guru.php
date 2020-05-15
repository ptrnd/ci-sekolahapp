<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('guru_model', 'guru');
		$this->load->helper('url', 'form');
		$this->load->library('form_validation', 'session');
		if (empty($this->session->userdata('email'))) {
			redirect('login', 'refresh');
		}
	}

	public function index()
	{
		$data['title'] = 'Data Guru';
		$data['guru'] = $this->guru->getGuru();
		if ($this->input->post('key')) {
			$data['guru'] = $this->guru->cariGuru();
		}
		$this->load->view('template/header', $data);
		$this->load->view('admin/guru/index', $data);
		$this->load->view('template/footer');
	}

	public function tambah()
	{
		$data['title'] = 'Form Tambah Data Guru';
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
			$this->guru->tambahguru();
			// untuk flashdata mempunyai 2 parameter (nama flashdata/alias, isi dari flastdata)
			$this->session->set_flashdata('flash-data', 'ditambahkan');
			// echo "data berhasil ditambah";
			redirect('admin/guru', 'refresh');
		}
	}

	public function edit($id)
	{
		$data['title'] = 'Form Edit Data Guru';
		$data['guru'] = $this->guru->getGuruByID($id);
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('nip', 'Nim', 'required|numeric');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('telp', 'No. HP', 'required|numeric');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header', $data);
			$this->load->view('admin/guru/edit', $data);
			$this->load->view('template/footer');
		} else {
			$this->guru->editGuru();
			// untuk flashdata mempunyai 2 parameter (nama flashdata/alias, isi dari flastdata)
			$this->session->set_flashdata('flash-data', 'diubah');
			// echo "data berhasil ditambah";
			redirect('admin/guru', 'refresh');
		}
	}

	public function hapus($id)
	{
		$this->guru->hapusGuru($id);
		$this->session->set_flashdata('flash-data', 'dihapus');
		redirect('admin/guru', 'refresh');
	}
}

/* End of file Guru.php */