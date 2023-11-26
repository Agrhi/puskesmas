<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Models_pasien extends CI_Model
{
	// get all data in table contact
	function getData($data = null)
	{
		$this->db->select('*');
		$this->db->from('pasien');
		if ($data != '') {
			$this->db->where('noRegist', $data);
			$this->db->or_where('nik', $data);
		}
		return $this->db->get();
	}

	// getDataWhereUser
	function getDataWhereUser($username)
	{
		$this->db->select('*');
		$this->db->from('pendaftar');
		$this->db->where('username', $username);
		return $this->db->get();
	}

	// register
	function register($data)
	{
		$this->db->set('id_pendaftar', 'UUID()', FALSE);
		$this->db->insert('pendaftar', $data);
	}

	// update
	function update($data, $id= null)
	{
		if ($id != null){
			$this->db->where('id_pendaftar', $id);
		}
		return $this->db->update('pendaftar', $data);
	}
}
