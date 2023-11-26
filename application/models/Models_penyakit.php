<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Models_penyakit extends CI_Model
{
	// get all data in table contact
	function getData($data = null)
	{
		$this->db->select('*');
		$this->db->from('penyakit');
		if ($data != '') {
			$this->db->where('kode', $data);
		}
		return $this->db->get();
	}

	function addData($data) {
		$this->db->insert('penyakit', $data);
	}

	public function updateData($kode, $data) {
        // Pastikan untuk menyesuaikan nama tabel dan kolom sesuai dengan struktur database Anda
        $this->db->where('kode', $kode);
        $this->db->update('penyakit', $data);

        // Return true jika pembaruan berhasil, false jika gagal
        return ($this->db->affected_rows() > 0) ? true : false;
    }

	public function deleteData($kode) {
		$this->db->where('kode', $kode);
		$this->db->delete('penyakit');
	}
}
