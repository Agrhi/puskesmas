<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diagnosa extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Models_diagnosa');
		$this->load->model('Models_penyakit');
		cek_login();
	}

	// loadView
	private function loadView($showModal = "index")
	{
		$data = [
			'title' 		=> 'Data Diagnosa',
			'diagnosa'		=> $this->Models_diagnosa->getData()->result_array(),
			'penyakit'		=> $this->Models_penyakit->getData()->result_array(),
			'showModal' 	=> $showModal
		];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('layout/navbar');
		$this->load->view('content/admin/diagnosa/index', $data);
		$this->load->view('layout/footer');
	}


	public function index()
	{
		$this->loadView();
	}

	public function addData()
	{
		// Deklarasi Data
		$kode = htmlspecialchars($this->input->post('kode'));
		$diagnosa = htmlspecialchars($this->input->post('diagnosa'));
		$kodepenyakit = htmlspecialchars($this->input->post('kodePenyakit'));

		// Set validation rules
		$this->form_validation->set_rules('kode', 'Kode', 'required');
		$this->form_validation->set_rules('diagnosa', 'Diagnosa', 'required');
		$this->form_validation->set_rules('kodePenyakit', 'Kode Penyakit', 'required');

		// Run validation
		if ($this->form_validation->run() == FALSE) {
			// If validation fails, load the view again with validation errors
			$this->loadView('add');
		} else {
			// If validation passes, proceed to save data

			$data = [
				'kode' => $kode,
				'diagnosa' => $diagnosa,
				'kodepenyakit' => $kodepenyakit,
			];

			// Save data
			$result = $this->Models_diagnosa->addData($data);

			if ($result) {
				$this->session->set_flashdata('swetalert', '`Gagal!`,`Diagnosa gagal ditambahkan`,`error`');
			} else {
				$this->session->set_flashdata('swetalert', '`Berhasil!`, `Diagnosa berhasil ditambahkan`,`success`');
			}

			redirect('diagnosa');
		}
	}

	public function updateData()
	{
		// Deklarasi Data
		$kode = htmlspecialchars($this->input->post('kode'));
		$diagnosa = htmlspecialchars($this->input->post('diagnosa'));
		$kodepenyakit = htmlspecialchars($this->input->post('kodePenyakit'));

		// Set validation rules
		$this->form_validation->set_rules('kode', 'Kode', 'required');
		$this->form_validation->set_rules('diagnosa', 'Diagnosa', 'required');
		$this->form_validation->set_rules('kodePenyakit', 'Kode Penyakit', 'required');

		// Run validation
		if ($this->form_validation->run() == FALSE) {
			$this->loadView('edit');
			// print_r(validation_errors()); die;
		} else {
			// If validation passes, proceed to update data
			$data = [
				'diagnosa' => $diagnosa,
				'kodepenyakit' => $kodepenyakit,
			];

			// Update data in the database
			$result = $this->Models_diagnosa->updateData($kode, $data);

			if ($result) {
				$this->session->set_flashdata('swetalert', '`Berhasil!`, `Diagnosa berhasil diperbarui`, `success`');
			} else {
				$this->session->set_flashdata('swetalert', '`Gagal!`, `Diagnosa gagal diperbarui`, `error`');
			}

			redirect('diagnosa');
		}
	}

	public function deleteData($kode) {
		// delete data in the database
		$result = $this->Models_diagnosa->deleteData($kode);

		if ($result) {
			$this->session->set_flashdata('swetalert', '`Gagal!`, `Diagnosa gagal dihapus`, `error`');
		} else {
			$this->session->set_flashdata('swetalert', '`Berhasil!`, `Diagnosa berhasil dihapus`, `success`');
		}

		redirect('diagnosa');
	}
}
