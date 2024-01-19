<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Models_pasien extends CI_Model
{
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

	function insert($data)
	{
		return $this->db->insert('pasien', $data);
	}

	function insert_batch($data)
	{
		return $this->db->insert_batch('pasien', $data);
	}

	function update($data)
	{
		$this->db->where('noRegist', $data['noRegist']);
		return $this->db->update('pasien', $data);
	}

	function export()
	{
		return $this->db->query("SELECT noRegist, nik, nama, alamat,
		CASE 
            WHEN jk = 0 THEN 'Perempuan'
            WHEN jk = 1 THEN 'Laki-laki'
            ELSE 'Status Tidak Dikenali'
        END AS jk,
		nohp FROM pasien")->result_array();
	}

	public function is_nik_unique($nik)
	{
		$this->db->where('nik', $nik);
		$query = $this->db->get('pasien');

		return $query->num_rows() === 0;
	}

	public function isNoRegistUnique($noRegist)
	{
		$this->db->where('noRegist', $noRegist);
		$query = $this->db->get('pasien');

		return $query->num_rows() === 0;
	}
}
