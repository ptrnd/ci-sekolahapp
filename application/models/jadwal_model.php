<?php


defined('BASEPATH') or exit('No direct script access allowed');

class jadwal_model extends CI_Model
{
	public function getAll()
	{
		// SELECT 
		// 	j.id AS id_jadwal, 
		// 	j.jam_ke AS jam_ke, 
		// 	j.jumlah_jam AS jumlah_jam, 
		// 	m.nama_mapel AS nama_mapel, 
		// 	k.nama_kelas AS nama_kelas 
		// FROM jadwal AS j 
		// JOIN mapel AS m ON m.id = j.mapel_id 
		// JOIN kelas AS k ON k.id = j.kelas_id

		$this->db->select('
			j.id AS id_jadwal, 
			j.jam_ke AS jam_ke, 
			j.jumlah_jam AS jumlah_jam,
			j.hari AS hari, 
			m.nama_mapel AS nama_mapel, 
			k.nama_kelas AS nama_kelas');
		$this->db->from('jadwal AS j');
		$this->db->join('mapel AS m', 'm.id = j.mapel_id');
		$this->db->join('kelas AS k', 'k.id = j.kelas_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getJadwal()
	{
		$query = $this->db->get('jadwal');
		return $query->result_array();
	}

	public function getKelas()
	{
		$query = $this->db->get('kelas');
		return $query->result_array();
	}

	public function getJadwalByID($id)
	{
		return $this->db->get_where('jadwal', ['id' => $id])->row_array();
	}

	public function getMapelfromJadwal($id)
	{
		// mengambil detail mapel dengan cara
		// 	mengambil id mapel dari tabel jadwal

		// $query = $this->db->query(
		//     "SELECT * FROM mapel 
		//     WHERE id IN (
		//         SELECT mapel.id
		//         FROM jadwal
		//         INNER JOIN mapel ON mapel.id = jadwal.mapel_id
		//         WHERE jadwal.id=$id
		//     )"
		// );
		// return $query->row_array();

		$this->db->select('mapel.id');
		$this->db->from('jadwal');
		$this->db->join('mapel', 'mapel.id = jadwal.mapel_id', 'inner');
		$this->db->where('jadwal.id', $id);
		$sub_query = $this->db->get_compiled_select();

		$this->db->select('*');
		$this->db->from('mapel');
		$this->db->where("id IN ($sub_query)");
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getKelasfromJadwal($id)
	{
		// mengambil detail kelas dengan cara
		// 	mengambil id kelas dari tabel jadwal

		// $query = $this->db->query(
		//     "SELECT * FROM kelas 
		//     WHERE id IN (
		//         SELECT kelas.id
		//         FROM jadwal
		//         INNER JOIN kelas ON kelas.id = jadwal.kelas_id
		//         WHERE jadwal.id=$id
		//     )"
		// );
		// return $query->row_array();

		$this->db->select('kelas.id');
		$this->db->from('jadwal');
		$this->db->join('kelas', 'kelas.id = jadwal.kelas_id', 'inner');
		$this->db->where('jadwal.id', $id);
		$sub_query = $this->db->get_compiled_select();

		$this->db->select('*');
		$this->db->from('kelas');
		$this->db->where("id IN ($sub_query)");
		$query = $this->db->get();
		return $query->row_array();
	}

	public function cariDataAll()
	{
		// mencari semua data termasuk kelas dan mapelnya.
		// query biasa ditunjukkan seperti dibawah

		// $key=$this->input->post('key');
		// $query = $this->db->query(

		// 		SELECT 
		// 			jadwal.id AS id_jadwal,
		// 			jadwal.jam_ke AS jam_ke,
		// 			jadwal.jumlah_jam AS jumlah_jam,
		// 			kelas.id AS id_kelas,
		// 			kelas.nama_kelas AS nama_kelas,
		// 			kelas.jurusan AS jurusan,
		// 			mapel.id AS id_mapel,
		// 			mapel.nama_mapel AS nama_mapel
		// 		FROM jadwal
		// 		JOIN mapel ON mapel.id = jadwal.mapel_id
		// 		JOIN kelas ON kelas.id = jadwal.kelas_id
		//      WHERE jam_ke LIKE '".$key."'
		//      OR jumlah_jam LIKE '".$key."'
		//      OR nama_kelas LIKE '".$key."'
		//      OR nama_mapel LIKE '".$key."'"

		// );
		// return $query->result_array();

		$key = $this->input->post('key');
		$this->db->select('jadwal.id AS id_jadwal,
							jadwal.jam_ke AS jam_ke,
							jadwal.jumlah_jam AS jumlah_jam,
							jadwal.hari AS hari,
							kelas.id AS id_kelas,
							kelas.nama_kelas AS nama_kelas,
    						kelas.jurusan AS jurusan,
							mapel.id AS id_mapel,
							mapel.nama_mapel AS nama_mapel')
			->from('jadwal')
			->join('mapel', 'mapel.id = jadwal.mapel_id')
			->join('kelas', 'kelas.id = jadwal.kelas_id')
			->like('jam_ke', $key)
			->or_like('jumlah_jam', $key)
			->or_like('hari', $key)
			->or_like('nama_mapel', $key)
			->or_like('nama_kelas', $key);
		return $this->db->get()->result_array();
	}

	public function tambahJadwal()
	{
		$data = [
			"mapel_id" => $this->input->post('mapel', true),
			"kelas_id" => $this->input->post('kelas', true),
			"hari" => $this->input->post('hari', true),
			"jam_ke" => $this->input->post('jam_ke', true),
			"jumlah_jam" => $this->input->post('jumlah_jam', true)
		];
		//this->db->insert('Table', $object);
		$this->db->insert('jadwal', $data);
	}

	public function editJadwal()
	{
		$data = [
			"mapel_id" => $this->input->post('mapel', true),
			"kelas_id" => $this->input->post('kelas', true),
			"hari" => $this->input->post('hari', true),
			"jam_ke" => $this->input->post('jam_ke', true),
			"jumlah_jam" => $this->input->post('jumlah_jam', true)
		];
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('jadwal', $data);
	}
	public function hapusJadwal($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('jadwal');
	}
	// bagian API

	public function getJadwalAPI($id = null)
	{
		if ($id === null) {
			return $this->db->get('jadwal')->result_array();
		} else {
			return $this->db->get_where('jadwal', ['id' => $id])->result_array();
		}
	}
	public function deleteJadwalAPI($id)
	{
		$this->db->delete('jadwal', ['id' => $id]);
		return $this->db->affected_rows();
	}

	public function createJadwalAPI($data)
	{
		$this->db->insert('jadwal', $data);
		return $this->db->affected_rows();
	}

	public function updateJadwalAPI($data, $id)
	{
		$this->db->update('jadwal', $data, ['id' => $id]);
		return $this->db->affected_rows();
	}
}

/* End of file jadwal_model.php */