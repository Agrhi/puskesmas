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

	// add rekamedis pasien multi table
	public function addRekamedisPasien($data)
	{
		$this->db->trans_start(); // memulai transaksi

		// Insert data pasien
		$dataPasien = [
			'noRegist' => $data['noRegist'],
			'nik' => $data['nik'],
			'nama' => $data['nama'],
			'alamat' => $data['alamat'],
			'jk' => $data['jk'],
			'nohp' => $data['nohp'],
		];
		$this->db->insert('pasien', $dataPasien);

		// Insert data rekamedis
		$dataRekamedis = [
			'noRegist' => $data['noRegist'],
			'umur' => $data['umur'],
			'poli' => $data['poli'],
			'keluhan' => $data['keluhan'],
			'keterangan' => $data['keterangan'],
			'diagnosa' => $data['diagnosa'],
			'tgl' => date('Y-m-d'),
			'status' => 2,
		];
		$this->db->set('idRekamedis', 'UUID()', FALSE);
		$this->db->insert('rekamedis', $dataRekamedis);

		// Jika terjadi kesalahan, batalkan transaksi dan kembalikan pesan kesalahan
		if (
			$this->db->trans_status() === FALSE
		) {
			$this->db->trans_rollback();
			return $this->db->error();
		}

		// Jika tidak ada kesalahan, commit transaksi
		$this->db->trans_commit();
		return "Transaksi berhasil";
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
