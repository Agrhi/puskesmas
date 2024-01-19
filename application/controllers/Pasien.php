<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor1/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class Pasien extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Models_pasien');
		cek_login();
	}

	private function loadView($showModal = "index")
	{
		$data = [
			'title' 		=> 'Data Pasien',
			'pasien'			=> $this->Models_pasien->getData()->result_array(),
			'showModal' 	=> $showModal
		];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('layout/navbar');
		$this->load->view('content/admin/pasien/index', $data);
		$this->load->view('layout/footer');
	}

	public function index()
	{
		$this->loadView();
	}

	public function add()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
			'required' => 'Nama harus diisi!',
		]);
		$this->form_validation->set_rules('nik', 'NIK', 'required|trim|numeric|min_length[16]|callback_check_unique_nik', [
			'required' => 'NIK harus diisi!',
			'numeric' => 'Hanya boleh angka',
			'min_length' => 'NIK minimal 16 angka!',
			'check_unique_nik' => 'NIK sudah terdaftar, harap gunakan NIK lain!',
		]);
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
			'required' => 'Alamat harus diisi!',
		]);
		$this->form_validation->set_rules('jk', 'Jenis kelamin', 'required|trim', [
			'required' => 'Jenis kelamin harus diisi!',
		]);
		$this->form_validation->set_rules('nohp', 'No. Hp', 'required|trim|numeric|min_length[10]', [
			'required' => 'No. Hp harus diisi!',
			'numeric' => 'Hanya boleh angka',
			'min_length' => 'No. Hp minimal 10 angka!',
		]);

		if ($this->form_validation->run() == false) {
			$this->loadView('add');
		} else {
			$data 	= [
				'noRegist'		=> $this->generateNoRegist(),
				'nik'		=> htmlspecialchars($this->input->post('nik', true)),
				'nama'		=> htmlspecialchars($this->input->post('nama'), true),
				'alamat'		=> htmlspecialchars($this->input->post('alamat'), true),
				'jk'		=> htmlspecialchars($this->input->post('jk'), true),
				'nohp'		=> htmlspecialchars($this->input->post('nohp'), true),
			];
			$result = $this->Models_pasien->insert($data);
			if ($result) {
				$this->session->set_flashdata('swetalert', '`Good job!`, `Data Berhasil Di Tambahkan !`, `success`');
			} else {
				$this->session->set_flashdata('swetalert', '`Upsss!`, `Data Gagal Di Tambahkan !`, `error`');
			}
			redirect('Pasien');
		}
	}

	public function update()
	{
		$this->form_validation->set_rules('noRegist', 'No. Regist', 'required|trim', [
			'required' => 'No. Regist harus diisi!',
		]);
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
			'required' => 'Nama harus diisi!',
		]);
		$this->form_validation->set_rules('nik', 'NIK', 'required|trim|numeric|min_length[16]', [
			'required' => 'NIK harus diisi!',
			'numeric' => 'Hanya boleh angka',
			'min_length' => 'NIK minimal 16 angka!',
		]);
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
			'required' => 'Alamat harus diisi!',
		]);
		$this->form_validation->set_rules('jk', 'Jenis kelamin', 'required|trim', [
			'required' => 'Jenis kelamin harus diisi!',
		]);
		$this->form_validation->set_rules('nohp', 'No. Hp', 'required|trim|numeric|min_length[10]', [
			'required' => 'No. Hp harus diisi!',
			'numeric' => 'Hanya boleh angka',
			'min_length' => 'No. Hp minimal 10 angka!',
		]);

		if ($this->form_validation->run() == false) {
			$this->loadView('edit');
		} else {
			$data 	= [
				'noRegist'		=> htmlspecialchars($this->input->post('noRegist', true)),
				'nik'		=> htmlspecialchars($this->input->post('nik', true)),
				'nama'		=> htmlspecialchars($this->input->post('nama'), true),
				'alamat'		=> htmlspecialchars($this->input->post('alamat'), true),
				'jk'		=> htmlspecialchars($this->input->post('jk'), true),
				'nohp'		=> htmlspecialchars($this->input->post('nohp'), true),
			];
			$result = $this->Models_pasien->update($data);
			if ($result) {
				$this->session->set_flashdata('swetalert', '`Good job!`, `Data Berhasil Di Perbarui !`, `success`');
			} else {
				$this->session->set_flashdata('swetalert', '`Upsss!`, `Data Gagal Di Perbarui !`, `error`');
			}
			redirect('Pasien');
		}
	}

	public function import()
	{
		$upload_file = $_FILES['upload-data-pasien']['name'];
		$extension = pathinfo($upload_file, PATHINFO_EXTENSION);
		if ($extension == 'csv') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		}
		$spreadsheet = $reader->load($_FILES['upload-data-pasien']['tmp_name']);
		$sheetdata = $spreadsheet->getActiveSheet()->toArray();
		$sheetcount = count($sheetdata);
		if ($sheetcount > 1) {
			$data = [];
			for ($i = 1; $i < $sheetcount; $i++) {
				$data_nik = $sheetdata[$i][0];
				$data_nama = $sheetdata[$i][1];
				$data_alamat = $sheetdata[$i][2];
				$data_jk = $sheetdata[$i][3];
				$data_nohp = $sheetdata[$i][4];
				$data[] = [
					'noRegist' => $this->generateNoRegist(),
					'nik' => $data_nik,
					'nama' => $data_nama,
					'alamat' => $data_alamat,
					'jk' => $data_jk,
					'nohp' => $data_nohp,
				];
			}
			$result = $this->Models_pasien->insert_batch($data);
			if ($result) {
				$this->session->set_flashdata('swetalert', '`Good JoOb!`, `Data Berhasil di import`, `success`');
			} else {
				$this->session->set_flashdata('swetalert', '`Upsss!`, `Sorry., Data gagal di import`, `error`');
			}
			redirect('Pasien');
		}
	}

	public function export()
	{
		$data = $this->Models_pasien->export();

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		foreach (range('A', 'F') as $columID) {
			$spreadsheet->getActiveSheet()->getColumnDimension($columID)->setAutoSize(true);
		}

		$totalRows = count($data) + 1;

		$headerTitle = 'Rekap Data Pasien';
		$headerCell = 'A1:J1';

		$sheet->setCellValue('A1', $headerTitle);
		$sheet->mergeCells($headerCell);
		$sheet->getStyle($headerCell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle($headerCell)->getFont()->setSize(16)->setBold(true);

		$sheet->setCellValue('A2', 'No. Regist');
		$sheet->setCellValue('B2', 'NIK');
		$sheet->setCellValue('C2', 'Nama');
		$sheet->setCellValue('D2', 'Alamat');
		$sheet->setCellValue('E2', 'Jenis Kelamin');
		$sheet->setCellValue('F2', 'No. Hp');

		$rowIndex = 3;
		foreach ($data as $row) {
			$sheet->setCellValue('A' . $rowIndex, $row['noRegist']);
			$sheet->setCellValue('B' . $rowIndex, $row['nik']);
			$sheet->setCellValue('C' . $rowIndex, $row['nama']);
			$sheet->setCellValue('D' . $rowIndex, $row['alamat']);
			$sheet->setCellValue('E' . $rowIndex, $row['jk']);
			$sheet->setCellValue('F' . $rowIndex, $row['nohp']);

			$rowIndex++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename = 'Rekap_data_pasien';

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}

	public function check_unique_nik($nik)
	{
		if ($this->Models_pasien->is_nik_unique($nik)) {
			return true;
		} else {
			return false;
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
