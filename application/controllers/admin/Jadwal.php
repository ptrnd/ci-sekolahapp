<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('jadwal_model', 'jadwal');
		$this->load->model('mapel_model', 'mapel');
		$this->load->helper('url', 'form');
		$this->load->library('form_validation', 'session');
		if (empty($this->session->userdata('email'))) {
			redirect('login', 'refresh');
		}
	}

	public function index()
	{
		$data['title'] = 'Data Jadwal';
		$data['jadwal'] = $this->jadwal->getAll();
		if ($this->input->post('key')) {
			$data['jadwal'] = $this->jadwal->cariDataAll();
		}
		$this->load->view('template/header', $data);
		$this->load->view('admin/jadwal/index', $data);
		$this->load->view('template/footer');
	}

	public function tambah()
	{
		$data['title'] = 'Form Tambah Data Jadwal';
		$data['hari'] = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
		$data['mapel'] = $this->mapel->getMapel();
		$data['kelas'] = $this->jadwal->getKelas();

		$this->form_validation->set_rules('hari', 'Hari', 'required|callback_check_default');
		$this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required|callback_check_default');
		$this->form_validation->set_rules('kelas', 'Kelas', 'required|callback_check_default');
		$this->form_validation->set_message('check_default', '{field} need to select something other than the default');

		$this->form_validation->set_rules('jumlah_jam', 'Jumlah jam', 'required|numeric');
		$this->form_validation->set_rules('jam_ke', 'Jam Ke', 'required|numeric');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header', $data);
			$this->load->view('admin/jadwal/tambah', $data);
			$this->load->view('template/footer');
		} else {
			$this->jadwal->tambahJadwal();
			// untuk flashdata mempunyai 2 parameter (nama flashdata/alias, isi dari flastdata)
			$this->session->set_flashdata('flash-data', 'ditambahkan');
			// echo "data berhasil ditambah";
			redirect('admin/jadwal', 'refresh');
		}
	}

	public function edit($id)
	{
		$data['title'] = 'Form Edit Data Jadwal';
		$data['hari'] = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
		$data['jadwal'] = $this->jadwal->getJadwalByID($id);
		$data['mapel'] = $this->mapel->getMapel();
		$data['kelas'] = $this->jadwal->getKelas();

		$data['mapel1'] = $this->jadwal->getMapelfromJadwal($id);
		$data['kelas1'] = $this->jadwal->getKelasfromJadwal($id);

		$this->form_validation->set_rules('hari', 'Hari', 'required|callback_check_default');
		$this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required|callback_check_default');
		$this->form_validation->set_rules('kelas', 'Kelas', 'required|callback_check_default');
		$this->form_validation->set_message('check_default', '{field} need to select something other than the default');

		$this->form_validation->set_rules('jumlah_jam', 'Jumlah jam', 'required|numeric');
		$this->form_validation->set_rules('jam_ke', 'Jam Ke', 'required|numeric');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header', $data);
			$this->load->view('admin/jadwal/edit', $data);
			$this->load->view('template/footer');
		} else {
			$this->jadwal->editJadwal();
			// untuk flashdata mempunyai 2 parameter (nama flashdata/alias, isi dari flastdata)
			$this->session->set_flashdata('flash-data', 'diubah');
			// echo "data berhasil ditambah";
			redirect('admin/jadwal', 'refresh');
		}
	}

	public function hapus($id)
	{
		$this->jadwal->hapusJadwal($id);
		$this->session->set_flashdata('flash-data', 'dihapus');
		redirect('admin/jadwal', 'refresh');
	}

	function check_default($post_string)
	{
		return $post_string == '0' ? FALSE : TRUE;
	}
}

/* End of file Jadwal.php */