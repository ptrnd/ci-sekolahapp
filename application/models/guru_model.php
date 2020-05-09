<?php


defined('BASEPATH') or exit('No direct script access allowed');

class guru_model extends CI_Model
{

	public function getGuru()
	{
		$query = $this->db->get('guru');
		return $query->result_array();
	}

	public function getGuruByID($id)
	{
		return $this->db->get_where('guru', ['id' => $id])->row_array();
	}

	public function cariDataGuru()
	{
		$key = $this->input->post('key');
		$this->db->like('nama', $key);
		$this->db->or_like('nip', $key);
		$this->db->or_like('alamat', $key);
		$this->db->or_like('telp', $key);
		return $this->db->get('guru')->result_array();
	}

	public function tambahGuru()
	{
		$data = [
			"nama" => $this->input->post('nama', true),
			"nip" => $this->input->post('nip', true),
			"alamat" => $this->input->post('alamat', true),
			"telp" => $this->input->post('telp', true),
			"email" => $this->input->post('email', true)
		];
		//this->db->insert('Table', $object);
		$this->db->insert('guru', $data);
	}

	public function editGuru()
	{
		$data = [
			"nama" => $this->input->post('nama', true),
			"nip" => $this->input->post('nip', true),
			"alamat" => $this->input->post('alamat', true),
			"telp" => $this->input->post('email', true),
			"email" => $this->input->post('email', true)
		];
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('guru', $data);
	}

	// bagian API

	public function getGuruApi($id = null)
	{
		if ($id === null) {
			return $this->db->get('guru')->result_array();
		} else {
			return $this->db->get_where('guru', ['id' => $id])->result_array();
		}
	}
	public function deleteGuruApi($id)
	{
		$this->db->delete('guru', ['id' => $id]);
		return $this->db->affected_rows();
	}

	public function createGuruApi($data)
	{
		$this->db->insert('guru', $data);
		return $this->db->affected_rows();
	}

	public function updateGuruApi($data, $id)
	{
		$this->db->update('guru', $data, ['id' => $id]);
		return $this->db->affected_rows();
	}
}

/* End of file guru_model.php */
