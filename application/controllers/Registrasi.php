<?php
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
		} elseif ($active == 'penapisan') {
			$data['active'] = 'Penapisan';
		} elseif ($active == 'rekamedis') {
			$data['active'] = 'Rekamedis';
		}
		
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('layout/navbar');
		$this->load->view('content/admin/regist/index', $data);
		$this->load->view('layout/footer');
	}

	public function getDataPasien($noRegist = '') {
		if ($noRegist == '') {
			$dataSearch = $noRegist;
		} else {
			$dataSearch = htmlspecialchars($this->input->POST('noRegist'));			
		}
		// $data['Rekamedis'] = $this->Models_rekamedis->getData($dataSearch)->result_array(); // pake join
		$pasien = $this->Models_pasien->getData($dataSearch)->row();
		$data = [
			'title' => 'Rekamedis Pasien',
			'rekamedis' => $this->Models_rekamedis->getData($pasien->noRegist)->result_array(),
			'pasien' => $pasien,
		];
		// print_r($data); die;
		
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('layout/navbar');
		$this->load->view('content/admin/regist/pasien', $data);
		$this->load->view('layout/footer');
	}
	
	public function registHariIni($data) {
		$cekRekamediHariIni = $this->Models_rekamedis->cekRekamedisHariIni($data)->row();
		if ($cekRekamediHariIni) {
			$this->session->set_flashdata('swetalert', '`Upsss!`, `Rekamedis Hari ini sudah Ada`, `error`');
		} else {
			$dataRegist = [
				'noRegist' => $data,
				'tgl' => date('Y-m-d'),
				'status' => '1',
			];
			$respon = $this->Models_rekamedis->addDataRekamedis($dataRegist);
			if ($respon) {
				$this->session->set_flashdata('swetalert', '`Good Job!`, `Registrasi Berhasi`, `success`');
			} else {
				$this->session->set_flashdata('swetalert', '`Upsss!`, `Gagal Registrasi`, `error`');
			}			
		}
		redirect('registrasi/getDataPasien/' . $data);
	}

	public function loadViewUpdate($act, $id){
		if ($act == 'penapisan') {
			$data['act'] = 'penapisan';			
			$data['title'] = 'Update Data';
		} else {
			$data['act'] = 'rekamedis';
			$data['rekamedis'] = $this->Models_rekamedis->getData($pasien->noRegist)->result_array();
			$data['title'] = 'Update Data';
		}

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('layout/navbar');
		$this->load->view('content/admin/regist/formPasien', $data);
		$this->load->view('layout/footer');
	}

}
