<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('login_model', 'login');
		$this->load->library('form_validation', 'session');
	}

	public function index()
	{
		$data['title'] = 'Login';
		$this->load->view('template/header_login', $data);
		$this->load->view('login/index');
		$this->load->view('template/footer_login');
	}

	public function proses_login()
	{
		$email = htmlspecialchars($this->input->post('email'));
		// $passwordhash = password_hash($this->input->post('pass'), PASSWORD_DEFAULT);

		$ceklogin = $this->login->login($email);

		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('pass', 'Password', 'required');

		if ($this->form_validation->run() == TRUE) {
			foreach ((array) $ceklogin as $row) :
				if (
					$ceklogin
					&& password_verify($this->input->post('pass'), $row['password'])
				) {
					// // echo "ke if ceklogin";
					$this->session->set_userdata('nama', $row['nama']);
					$this->session->set_userdata('email', $row['email']);
					redirect('admin/guru/index');
				} else {
					$data['pesan'] = "email dan/atau password anda salah. :(";

					$data['title'] = 'Login';
					$this->load->view('template/header_login', $data);
					$this->load->view('login/index', $data);
					$this->load->view('template/footer_login');
					// redirect('login/index', 'refresh');
				}
			endforeach;
		} else {
			$data['pesan'] = "email dan/atau password belum diisi.";

			$data['title'] = 'Login';
			$this->load->view('template/header_login', $data);
			$this->load->view('login/index', $data);
			$this->load->view('template/footer_login');
			// redirect('login/index', 'refresh');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login', 'refresh');
	}

	public function Register()
	{
		$data['title'] = 'Register';
		$this->load->view('template/header_login', $data);
		$this->load->view('login/register');
		$this->load->view('template/footer_login');
	}

	public function proses_reg()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('pass', 'Password', 'required');
		$this->form_validation->set_rules('pass2', 'Confirm Password', 'required|matches[pass]');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Register';

			$this->load->view('template/header_login', $data);
			$this->load->view('login/register');
			$this->load->view('template/footer_login');
		} else {
			$this->login->register();
			redirect('login');
		}
	}
}

/* End of file Login.php */