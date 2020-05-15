<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Mapel extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mapel_model', 'mapel');
		$this->load->model('guru_model', 'guru');
		$this->load->helper('url', 'form');
		$this->load->library('form_validation', 'session');
	}

	public function index()
	{
		$data['title'] = 'Data Mata Pelajaran';
		$data['mapel'] = $this->mapel->getAll();
		if ($this->input->post('key')) {
			$data['mapel'] = $this->mapel->cariDataAll();
		}
		$this->load->view('template/header', $data);
		$this->load->view('admin/mapel/index', $data);
		$this->load->view('template/footer');
	}

	public function tambah()
	{
		$data['title'] = 'Form Tambah Data Mata Pelajaran';
		$data['guru'] = $this->guru->getGuru();
		$this->form_validation->set_rules('nama_mapel', 'Nama Mapel', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header', $data);
			$this->load->view('admin/mapel/tambah', $data);
			$this->load->view('template/footer');
		} else {
			$this->mapel->tambahMapel();
			// untuk flashdata mempunyai 2 parameter (nama flashdata/alias, isi dari flastdata)
			$this->session->set_flashdata('flash-data', 'ditambahkan');
			// echo "data berhasil ditambah";
			redirect('admin/mapel', 'refresh');
		}
	}

	public function edit($id)
	{
		$data['title'] = 'Form Edit Data Mata Pelajaran';
		$data['mapel'] = $this->mapel->getMapelByID($id);

		$data['guru'] = $this->guru->getGuru();
		$data['guru1'] = $this->mapel->getGurufromMapel($id);

		$this->form_validation->set_rules('nama_mapel', 'Nama Mapel', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header', $data);
			$this->load->view('admin/mapel/edit', $data);
			$this->load->view('template/footer');
		} else {
			$this->mapel->editMapel();
			// untuk flashdata mempunyai 2 parameter (nama flashdata/alias, isi dari flastdata)
			$this->session->set_flashdata('flash-data', 'diubah');
			// echo "data berhasil ditambah";
			redirect('admin/mapel', 'refresh');
		}
	}

	public function hapus($id)
	{
		$this->mapel->hapusMapel($id);
		$this->session->set_flashdata('flash-data', 'dihapus');
		redirect('admin/mapel', 'refresh');
	}
}

/* End of file Mapel.php */