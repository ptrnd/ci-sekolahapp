<?php


defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Jadwal extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('jadwal_model', 'jadwal');
	}

	public function index_get()
	{
		$id = $this->get('id');
		if ($id === null) {
			$jadwal = $this->jadwal->getJadwalApi();
		} else {
			$jadwal = $this->jadwal->getJadwalApi($id);
		}

		if ($jadwal) {
			$this->response([
				'status' => true,
				'data' => $jadwal
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
			if ($this->jadwal->deleteJadwalApi($id) > 0) {
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
			'mapel_id' => $this->post('mapel_id'),
			'kelas_id' => $this->post('kelas_id'),
			'hari' => $this->post('hari'),
			'jam_ke' => $this->post('jam_ke'),
			'jumlah_jam' => $this->post('jumlah_jam')
		];

		if ($this->jadwal->createJadwalApi($data) > 0) {
			$this->response([
				'status' => true,
				'message' => 'new jadwal has been created'
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
			'mapel_id' => $this->post('mapel_id'),
			'kelas_id' => $this->post('kelas_id'),
			'hari' => $this->post('hari'),
			'jam_ke' => $this->post('jam_ke'),
			'jumlah_jam' => $this->post('jumlah_jam')
		];

		if ($this->jadwal->updateJadwalApi($data, $id) > 0) {
			$this->response([
				'status' => true,
				'message' => 'data jadwal has been updated'
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'failed to update data!'
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}
}
/** End of file Jadwal.php **/
