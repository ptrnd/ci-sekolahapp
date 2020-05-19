<?php

defined('BASEPATH') or exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mapel extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mapel_model', 'mapel');
	}

	public function index_get()
	{
		$id = $this->get('id');
		if ($id === null) {
			$mapel = $this->mapel->getMapelApi();
		} else {
			$mapel = $this->mapel->getMapelApi($id);
		}

		if ($mapel) {
			$this->response([
				'status' => true,
				'data' => $mapel
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
			if ($this->mapel->deleteMapelApi($id) > 0) {
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
			'nama_mapel' => $this->post('nama_mapel'),
			'guru_id' => $this->post('guru_id')
		];

		if ($this->mapel->createMapelApi($data) > 0) {
			$this->response([
				'status' => true,
				'message' => 'new mapel has been created'
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
			'nama_mapel' => $this->post('nama_mapel'),
			'guru_id' => $this->post('guru_id')
		];

		if ($this->mapel->updateMapelApi($data, $id) > 0) {
			$this->response([
				'status' => true,
				'message' => 'data mapel has been updated'
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'failed to update data!'
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}
}
/** End of file Mapel.php **/
