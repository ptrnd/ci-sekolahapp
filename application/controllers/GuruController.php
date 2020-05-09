<?php


defined('BASEPATH') or exit('No direct script access allowed');

class GuruController extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('mahasiswa_model');
		$this->load->helper('url', 'form');
		$this->load->library('form_validation');
	}


	public function index()
	{
	}
}

/* End of file GuruController.php */
