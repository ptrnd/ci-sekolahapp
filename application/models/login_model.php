<?php

defined('BASEPATH') or exit('No direct script access allowed');

class login_model extends CI_Model
{

	function login($email)
	{
		$this->db->select('nama, email, password');
		$this->db->from('users');
		$this->db->where('email', $email);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function register()
	{
		$password = password_hash($this->input->post('pass', true), PASSWORD_DEFAULT);

		$data = [
			"nama" => $this->input->post('nama', true),
			"email" => $this->input->post('email', true),
			"password" => $password,
		];
		$this->db->insert('users', $data);
	}
}

/* End of file login_model.php */