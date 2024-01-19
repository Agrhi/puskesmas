<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor1/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class Datalatih extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Models_datalatih');
		cek_login();
	}

	public function index()
	{
		$data = [
			'title' 		=> 'Data Latih',
			'dataLatih'		=> $this->Models_datalatih->getData()->result_array(),
		];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('layout/navbar');
		$this->load->view('content/admin/datalatih/index', $data);
		$this->load->view('layout/footer');
	}

	public function import()
	{
		$upload_file = $_FILES['upload-data-latih']['name'];
		$extension = pathinfo($upload_file, PATHINFO_EXTENSION);
		if ($extension == 'csv') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		}
		$spreadsheet = $reader->load($_FILES['upload-data-latih']['tmp_name']);
		$sheetdata = $spreadsheet->getActiveSheet()->toArray();
		$sheetcount = count($sheetdata);
		if ($sheetcount > 1) {
			$data = [];
			for ($i = 1; $i < $sheetcount; $i++) {
				$data_alamat = $sheetdata[$i][0];
				$data_jk = $sheetdata[$i][1];
				$data_umur = $sheetdata[$i][2];
				$data_class = $sheetdata[$i][3];
				$data[] = [
					'alamat' => $data_alamat,
					'jk' => $data_jk,
					'umur' => $data_umur,
					'class' => $data_class
				];
			}
			$result = $this->Models_datalatih->insert_batch($data);
			if ($result) {
				$this->session->set_flashdata('swetalert', '`Good JoOb!`, `Data Berhasil di import`, `success`');
			} else {
				$this->session->set_flashdata('swetalert', '`Upsss!`, `Sorry., Data gagal di import`, `error`');
			}
			redirect('Datalatih');
		}
	}

	public function deleteAll()
	{
		$result =
			$this->Models_datalatih->truncateTable();
		if ($result) {
			$this->session->set_flashdata('swetalert', '`Good JoOb!`, `Data Berhasil di hapus`, `success`');
		} else {
			$this->session->set_flashdata('swetalert', '`Upsss!`, `Sorry., Data gagal di hapus`, `error`');
		}
		redirect('Datalatih');
	}
}
