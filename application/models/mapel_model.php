<?php


defined('BASEPATH') or exit('No direct script access allowed');

class mapel_model extends CI_Model
{

	public function getAll()
	{
		$this->db->select('
			m.id AS id_mapel,
			m.nama_mapel AS nama_mapel,
			m.guru_id AS id_guru,
			g.nama AS nama_guru');
		$this->db->from('mapel AS m');
		$this->db->join('guru AS g', 'g.id = m.guru_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getMapel()
	{
		$query = $this->db->get('mapel');
		return $query->result_array();
	}

	public function getMapelByID($id)
	{
		return $this->db->get_where('mapel', ['id' => $id])->row_array();
	}

	public function getGurufromMapel($id)
	{
		// mengambil detail guru dengan cara
		// 	mengambil id guru dari tabel mata pelajaran

		// $query = $this->db->query(
		//     "SELECT * FROM guru 
		//     WHERE id IN (
		//         SELECT guru.id
		//         FROM mapel
		//         INNER JOIN guru ON guru.id = mapel.guru_id
		//         WHERE mapel.id=$id
		//     )"
		// );
		// return $query->row_array();

		$this->db->select('guru.id');
		$this->db->from('mapel');
		$this->db->join('guru', 'guru.id = mapel.guru_id', 'inner');
		$this->db->where('mapel.id', $id);
		$sub_query = $this->db->get_compiled_select();

		$this->db->select('*');
		$this->db->from('guru');
		$this->db->where("id IN ($sub_query)");
		$query = $this->db->get();
		return $query->row_array();
	}

	public function cariDataAll()
	{
		// mencari semua data termasuk gurunya.
		// query biasa ditunjukkan seperti dibawah

		// $key=$this->input->post('key');
		// $query = $this->db->query(
		//         SELECT mapel.id AS id,
		//                mapel.nama_mapel AS nama_mapel,
		//                mapel.guru_id AS id_guru,
		//                guru.nama AS nama_guru
		//         FROM mapel 
		// 		   JOIN guru ON guru.id = mapel.guru_id
		//         WHERE id LIKE '".$key."'
		//         OR nama_mapel LIKE '".$key."'  
		//         OR nama_guru LIKE '".$key."'"
		// );
		// return $query->result_array();

		$key = $this->input->post('key');
		$this->db->select('mapel.id AS id, 
                            mapel.nama_mapel AS nama_mapel,
                            mapel.guru_id AS guru_id,
                            guru.nama AS nama_guru')
			->from('mapel')
			->join('guru', 'guru.id = mapel.guru_id')
			->like('id', $key)
			->or_like('nama_mapel', $key)
			->or_like('nama_guru', $key);
		return $this->db->get()->result_array();
	}

	public function tambahMapel()
	{
		$data = [
			"nama_mapel" => $this->input->post('nama_mapel', true),
			"guru_id" => $this->input->post('guru', true),
		];
		$this->db->insert('mapel', $data);
	}

	public function editMapel()
	{
		$data = [
			"nama_mapel" => $this->input->post('nama_mapel', true),
			"guru_id" => $this->input->post('guru', true),
		];
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('mapel', $data);
	}

	public function hapusMapel($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('mapel');
	}

	// bagian API

	public function getMapelAPI($id = null)
	{
		if ($id === null) {
			return $this->db->get('mapel')->result_array();
		} else {
			return $this->db->get_where('mapel', ['id' => $id])->result_array();
		}
	}
	public function deleteMapelAPI($id)
	{
		$this->db->delete('mapel', ['id' => $id]);
		return $this->db->affected_rows();
	}

	public function createMapelAPI($data)
	{
		$this->db->insert('mapel', $data);
		return $this->db->affected_rows();
	}

	public function updateMapelAPI($data, $id)
	{
		$this->db->update('mapel', $data, ['id' => $id]);
		return $this->db->affected_rows();
	}
}

/* End of file mapel_model.php */