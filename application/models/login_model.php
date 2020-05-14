<?php

defined('BASEPATH') or exit('No direct script access allowed');

class login_model extends CI_Model
{

	function login($username)
	{
		$this->db->select('username, password');
		$this->db->from('user');
		$this->db->where('username', $username);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function register()
	{
		$password = password_hash($this->input->post('pass', true), PASSWORD_DEFAULT);

		$data = [
			"nama" => $this->input->post('nama', true),
			"username" => $this->input->post('user', true),
			"password" => $password,
		];
		$this->db->insert('user', $data);
	}
}

/* End of file login_model.php */
