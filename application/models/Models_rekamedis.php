<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Models_rekamedis extends CI_Model
{
	// get all data in table seleksi
	function getData($id = '') {
		$this->db->select('*');
		$this->db->from('rekamedis');
        $this->db->join('pasien', 'rekamedis.noRegist = pasien.noRegist');
		if ($id !== ''){
			$this->db->where('pasien.noRegist', $id);
			$this->db->or_where('pasien.nik', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	// cekRekamedisHariIni
	function cekRekamedisHariIni($id) {
		$this->db->select('noRegist');
		$this->db->from('rekamedis');
		$this->db->where('noRegist', $id);
		$this->db->where('tgl', date('Y-m-d'));
		$query = $this->db->get();
		return $query;
	}

	// Registrasi (Add Rekamedis)
	function addDataRekamedis($data) {
		$this->db->set('idRekamedis', 'UUID()', FALSE);
		return $this->db->insert('rekamedis', $data);
	}

	// get data by active = 1
	function getDataActive(){
		$query = $this->db->get_where('seleksi', ['active' => 1]);
		return $query;
	}

	// update active
	function active($id, $data){
		$this->db->where('id_seleksi', $id);
		$this->db->update('seleksi', $data);
	}

	// insert data
	function addData($data){
		$this->db->set('id_seleksi', 'UUID()', FALSE);
		return $this->db->insert('seleksi', $data);
	}

	// update data
	function editData($id, $data){
		$this->db->where('id_seleksi', $id);
		return $this->db->update('seleksi', $data);
	}

	// delete data
	function deleteData($id){
		$this->db->where('id_seleksi', $id);
		return $this->db->delete('seleksi');
	}
}
