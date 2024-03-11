<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ICD_10 extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Models_penyakit');
		cek_login();
	}

	// loadView
	private function loadView($showModal = "index")
	{
		$data = [
			'title' 		=> 'ICD-10',
			'penyakit'		=> $this->Models_penyakit->getData()->result_array(),
			'showModal' 	=> $showModal
		];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('layout/navbar');
		$this->load->view('content/admin/penyakit/index', $data);
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
		$kelompok = htmlspecialchars($this->input->post('kelompok'));

		// Set validation rules
		$this->form_validation->set_rules('kode', 'Kode', 'required');
		$this->form_validation->set_rules('kelompok', 'Kelompok', 'required');

		// Run validation
		if ($this->form_validation->run() == FALSE) {
			// If validation fails, load the view again with validation errors
			$this->loadView('add');
		} else {
			// If validation passes, proceed to save data

			$data = [
				'kode' => $kode,
				'kelompok' => $kelompok,
			];

			// Save data
			$result = $this->Models_penyakit->addData($data);

			if ($result) {
				$this->session->set_flashdata('swetalert', '`Gagal!`,`Penyakit gagal ditambahkan`,`error`');
			} else {
				$this->session->set_flashdata('swetalert', '`Berhasil!`, `Penyakit berhasil ditambahkan`,`success`');
			}

			redirect('ICD_10');
		}
	}

	public function updateData()
	{
		// Deklarasi Data
		$kode = htmlspecialchars($this->input->post('kode'));
		$kelompok = htmlspecialchars($this->input->post('kelompok'));
		$kodepenyakit = htmlspecialchars($this->input->post('kodePenyakit'));

		// Set validation rules
		$this->form_validation->set_rules('kode', 'Kode', 'required');
		$this->form_validation->set_rules('kelompok', 'Kelompok', 'required');

		// Run validation
		if ($this->form_validation->run() == FALSE) {
			$this->loadView('edit');
			// print_r(validation_errors()); die;
		} else {
			// If validation passes, proceed to update data
			$data = [
				'kelompok' => $kelompok,
			];

			// Update data in the database
			$result = $this->Models_penyakit->updateData($kode, $data);

			if ($result) {
				$this->session->set_flashdata('swetalert', '`Berhasil!`, `Penyakit berhasil diperbarui`, `success`');
			} else {
				$this->session->set_flashdata('swetalert', '`Gagal!`, `Penyakit gagal diperbarui`, `error`');
			}

			redirect('ICD_10');
		}
	}

	public function deleteData($kode)
	{
		// delete data in the database
		$result = $this->Models_penyakit->deleteData($kode);

		if ($result) {
			$this->session->set_flashdata('swetalert', '`Gagal!`, `Penyakit gagal dihapus`, `error`');
		} else {
			$this->session->set_flashdata('swetalert', '`Berhasil!`, `Penyakit berhasil dihapus`, `success`');
		}

		redirect('ICD_10');
	}
}
