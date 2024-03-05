<?php

use phpDocumentor\Reflection\Types\This;

defined('BASEPATH') or exit('No direct script access allowed');

class Registrasi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Models_rekamedis');
		$this->load->model('Models_pasien');
		cek_login();
	}

	public function index($active = 'regist')
	{
		$data = [
			'title' 		=> 'Registrasi',
		];

		if ($active == 'regist') {
			$data['active'] = 'Registrasi';
		} elseif ($active == 'rekamedis') {
			$data['active'] = 'Rekamedis';
		}

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('layout/navbar');
		$this->load->view('content/admin/regist/index', $data);
		$this->load->view('layout/footer');
	}

	public function getDataPasien($noRegist = '')
	{
		if ($noRegist == '') {
			$dataSearch = $noRegist;
		} else {
			$dataSearch = htmlspecialchars($this->input->POST('noRegist'));
		}
		// $data['Rekamedis'] = $this->Models_rekamedis->getData($dataSearch)->result_array(); // pake join
		$pasien = $this->Models_pasien->getData($dataSearch)->row();
		$data = [
			'title' => 'Biodata Pasien',
			'rekamedis' => $this->Models_rekamedis->getData($pasien->noRegist)->result_array(),
			'pasien' => $pasien,
		];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('layout/navbar');
		$this->load->view('content/admin/regist/pasien', $data);
		$this->load->view('layout/footer');
	}

	public function getDataRekamedisPasien($noRegist = '')
	{
		if ($noRegist == '') {
			$dataSearch = $noRegist;
		} else {
			$dataSearch = htmlspecialchars($this->input->POST('noRegist'));
		}
		$pasien = $this->Models_pasien->getData($dataSearch)->row();
		$data = [
			'title' => 'Rekamedis Pasien',
			'rekamedis' => $this->Models_rekamedis->getData($pasien->noRegist)->result_array(),
			'pasien' => $pasien,
		];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('layout/navbar');
		$this->load->view('content/admin/regist/rekamedisPasien', $data);
		$this->load->view('layout/footer');
	}

	public function registHariIni()
	{
		$noreg = $this->input->post('noreg', true);
		$poli = $this->input->post('poli', true);

		$cekRekamediHariIni = $this->Models_rekamedis->cekRekamedisHariIni($noreg)->row();
		if ($cekRekamediHariIni) {
			$this->session->set_flashdata('swetalert', '`Upsss!`, `Rekamedis Hari ini sudah Ada`, `error`');
		} else {
			$dataRegist = [
				'noRegist' => $noreg,
				'tgl' => date('Y-m-d'),
				'status' => '1',
				'poli' => $poli,
			];
			$respon = $this->Models_rekamedis->addDataRekamedis($dataRegist);
			if ($respon) {
				$this->session->set_flashdata('swetalert', '`Good Job!`, `Registrasi Berhasi`, `success`');
			} else {
				$this->session->set_flashdata('swetalert', '`Upsss!`, `Gagal Registrasi`, `error`');
			}
		}
		redirect('registrasi/getDataPasien/' . $noreg);
	}

	public function updateRekamedis($id)
	{
		$data = [
			'title' => 'Update Rekamedis',
			'rekamedis' => $this->Models_rekamedis->getDataRekamedis($id),
			'penyakit' => $this->Models_rekamedis->getDataPenyakit(),
		];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('layout/navbar');
		$this->load->view('content/admin/regist/formRekamedis', $data);
		$this->load->view('layout/footer');
	}

	public function updateDataRekamedis()
	{
		$id = $this->input->post('idRekamedis', true);
		$umur = $this->klasifikasiUmur($this->input->post('umur', true));
		$data = [
			'umur' => $umur,
			'keluhan' => $this->input->post('keluhan', true),
			'diagnosa' => $this->input->post('diagnosa', true),
			'keterangan' => $this->input->post('keterangan', true),
			'status' => 2,
		];

		$respon = $this->Models_rekamedis->updateDataRekamedis($id, $data);
		if ($respon) {
			$this->session->set_flashdata('swetalert', '`Good Job!`, `Data Berhasil di Update`, `success`');
		} else {
			$this->session->set_flashdata('swetalert', '`Upsss!`, `Gagal Update`, `error`');
		}

		redirect('registrasi/getDataRekamedisPasien/' . $this->input->post('noRegist'));
	}

	function klasifikasiUmur($umur)
	{
		if ($umur < 15) {
			$result = 'Bayi dan Anak-anak';
		} elseif ($umur <= 50) {
			$result = 'Muda dan Dewasa';
		} elseif ($umur > 50) {
			$result = 'Muda dan Dewasa';
		}
		return $result;
	}

	public function detailRekamedis($id)
	{
		$data = [
			'title' => 'Detail Rekamedis',
			'data' => $this->Models_rekamedis->getData($id)->row_array()
		];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('layout/navbar');
		$this->load->view('content/admin/regist/detailRekamedis', $data);
		$this->load->view('layout/footer');
	}
}
