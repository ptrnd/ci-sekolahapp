<?php


defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Guru extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('guru_model', 'guru');
	}

	public function index_get()
	{
		$id = $this->get('id');
		if ($id === null) {
			$guru = $this->guru->getGuruApi();
		} else {
			$guru = $this->guru->getGuruApi($id);
		}

		if ($guru) {
			$this->response([
				'status' => true,
				'data' => $guru
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'id not found'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function index_delete()
	{
		$id = $this->delete('id');

		if ($id === null) {
			$this->response([
				'status' => false,
				'message' => 'provide an id!'
			], REST_Controller::HTTP_BAD_REQUEST);
		} else {
			if ($this->guru->deleteGuruApi($id) > 0) {
				$this->response([
					'status' => true,
					'id' => $id,
					'message' => 'deleted.'
				], REST_Controller::HTTP_OK);
			} else {
				$this->response([
					'status' => false,
					'message' => 'id not found.'
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
	}

	public function index_post()
	{
		$data = [
			'nama' => $this->post('nama'),
			'nip' => $this->post('nip'),
			'alamat' => $this->post('alamat'),
			'telp' => $this->post('telp'),
			'email' => $this->post('email')
		];

		if ($this->guru->createGuruApi($data) > 0) {
			$this->response([
				'status' => true,
				'message' => 'new guru has been created'
			], REST_Controller::HTTP_CREATED);
		} else {
			$this->response([
				'status' => false,
				'message' => 'failde to create new data!'
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function index_put()
	{
		$id = $this->put('id');
		$data = [
			'nama' => $this->post('nama'),
			'nip' => $this->post('nip'),
			'alamat' => $this->post('alamat'),
			'telp' => $this->post('telp'),
			'email' => $this->post('email')
		];

		if ($this->guru->updateGuruApi($data, $id) > 0) {
			$this->response([
				'status' => true,
				'message' => 'data guru has been updated'
			], REST_Controller::HTTP_CREATED);
		} else {
			$this->response([
				'status' => false,
				'message' => 'failed to update data!'
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}
}
/** End of file Guru.php **/