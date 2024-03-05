<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Models_rekamedis extends CI_Model
{
	// get all data in table seleksi
	function getData($id = '')
	{
		$this->db->select('*');
		$this->db->from('rekamedis');
		$this->db->join('pasien', 'rekamedis.noRegist = pasien.noRegist', 'LEFT');
		$this->db->join('penyakit', 'rekamedis.diagnosa = penyakit.kode', 'LEFT');
		if ($id !== '') {
			$this->db->where('pasien.noRegist', $id);
			$this->db->or_where('pasien.nik', $id);
			$this->db->or_where('rekamedis.idRekamedis', $id);
		}
		$this->db->order_by('rekamedis.tgl', 'DESC');
		$query = $this->db->get();
		return $query;
	}

	// get single data rekamedis
	function getDataRekamedis($id)
	{
		$this->db->select('*');
		$this->db->from('rekamedis');
		$this->db->where('idRekamedis', $id);
		return $this->db->get()->row_array();
	}

	// update data rekamedis
	function updateDataRekamedis($id, $data)
	{
		$this->db->where('idRekamedis', $id);
		return $this->db->update('rekamedis', $data);
	}

	// get all data penyakit
	function getDataPenyakit()
	{
		return $this->db->get('penyakit')->result_array();
	}

	// cekRekamedisHariIni
	function cekRekamedisHariIni($id)
	{
		$this->db->select('noRegist');
		$this->db->from('rekamedis');
		$this->db->where('noRegist', $id);
		$this->db->where('tgl', date('Y-m-d'));
		$query = $this->db->get();
		return $query;
	}

	// Registrasi (Add Rekamedis)
	function addDataRekamedis($data)
	{
		$this->db->set('idRekamedis', 'UUID()', FALSE);
		return $this->db->insert('rekamedis', $data);
	}

	// get data by active = 1
	function getDataActive()
	{
		$query = $this->db->get_where('seleksi', ['active' => 1]);
		return $query;
	}

	// update active
	function active($id, $data)
	{
		$this->db->where('id_seleksi', $id);
		$this->db->update('seleksi', $data);
	}

	// insert data
	function addData($data)
	{
		$this->db->set('id_seleksi', 'UUID()', FALSE);
		return $this->db->insert('seleksi', $data);
	}

	// update data
	function editData($id, $data)
	{
		$this->db->where('id_seleksi', $id);
		return $this->db->update('seleksi', $data);
	}

	// delete data
	function deleteData($id)
	{
		$this->db->where('id_seleksi', $id);
		return $this->db->delete('seleksi');
	}
}
