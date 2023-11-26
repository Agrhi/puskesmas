<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Models_seleksi extends CI_Model
{
	// get all data in table seleksi
	function getData($id = null){
		if($id == null){
			$query = $this->db->get('seleksi');
		}else{
			$query = $this->db->get_where('seleksi', ['id_seleksi' => $id]);
		}
		return $query;
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
