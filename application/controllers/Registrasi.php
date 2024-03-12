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
		$this->load->model('Models_diagnosa');
		cek_login();
	}

	public function index($active = 'regist')
	{
		$data = [
			'title' 		=> 'Registrasi',
			'diagnosa'		=> $this->Models_diagnosa->getData()->result(),
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

	public function addRekamedisPasien()
	{
		$this->form_validation->set_rules('nik', 'NIK', 'required|trim|numeric|min_length[16]', [
			'required' => 'NIK harus diisi!',
			'numeric' => 'Hanya boleh angka',
			'min_length' => 'NIK minimal 16 angka!',
		]);
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
			'required' => 'Nama harus diisi!',
		]);
		$this->form_validation->set_rules('umur', 'Umur', 'required|trim', [
			'required' => 'Umur harus diisi!',
		]);
		$this->form_validation->set_rules('jk', 'Jenis kelamin', 'required|trim', [
			'required' => 'Jenis kelamin harus diisi!',
		]);
		$this->form_validation->set_rules('nohp', 'No. Hp', 'required|trim|numeric|min_length[10]', [
			'required' => 'No. Hp harus diisi!',
			'numeric' => 'Hanya boleh angka',
			'min_length' => 'No. Hp minimal 10 angka!',
		]);
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
			'required' => 'Alamat harus diisi!',
		]);
		$this->form_validation->set_rules('poli', 'Tujuan Poli', 'required|trim', [
			'required' => 'Tujuan Poli harus diisi!',
		]);
		$this->form_validation->set_rules('keluhan', 'Keluhan', 'required|trim', [
			'required' => 'Keluhan harus diisi!',
		]);
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim', [
			'required' => 'Keterangan harus diisi!',
		]);
		$this->form_validation->set_rules('diagnosa', 'Diagnosa', 'required|trim', [
			'required' => 'Diagnosa harus diisi!',
		]);
		if ($this->form_validation->run() == false) {
			$this->index();
		} else {
			$data 	= [
				'noRegist' => $this->generateNoRegist(),
				'nik'		=> htmlspecialchars($this->input->post('nik', true)),
				'nama'		=> htmlspecialchars($this->input->post('nama'), true),
				'umur'		=> $this->klasifikasiUmur($this->input->post('umur', true)),
				'jk'		=> htmlspecialchars($this->input->post('jk'), true),
				'nohp'		=> htmlspecialchars($this->input->post('nohp'), true),
				'alamat'		=> htmlspecialchars($this->input->post('alamat'), true),
				'poli'		=> htmlspecialchars($this->input->post('poli'), true),
				'keluhan'		=> htmlspecialchars($this->input->post('keluhan'), true),
				'keterangan'		=> htmlspecialchars($this->input->post('keterangan'), true),
				'diagnosa'		=> htmlspecialchars($this->input->post('diagnosa'), true),
			];

			$result = $this->Models_rekamedis->addRekamedisPasien($data);

			if ($result) {
				$this->session->set_flashdata('swetalert', '`Good job!`, `Data Berhasil Di Simpan !`, `success`');
			} else {
				$this->session->set_flashdata('swetalert', '`Upsss!`, `Data Gagal Di Simpan !`, `error`');
			}
			redirect('Registrasi');
		}
	}

	private function generateNoRegist()
	{
		$prefix = 'REG';
		$random_number = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);

		$noRegist = $prefix . $random_number;

		while (!$this->Models_pasien->isNoRegistUnique($noRegist)) {
			$random_number = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
			$noRegist = $prefix . $random_number;
		}

		return $noRegist;
	}
}
