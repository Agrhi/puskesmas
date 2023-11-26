<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Models_pasien');
		cek_login();
	}

	// loadView
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

	// function untuk mengubah status Active
	public function stActive($act, $id)
	{
		if ($act == 'aktifkan') {
			$data = [
				'stActive' => 1,
				'stBayar' => 1,
				'pin' => $this->generateRandomString()
			];
		} else {
			$data = [
				'stActive' => 0,
				'stBayar' => 0,
				'pin' => ''
			];
		}

		$result = $this->Models_mhs->update($data, $id);
		if ($result) {
			$this->session->set_flashdata('swetalert', '`Good JoOb!`, `Data Berhasil di Aktifkan`, `success`');
		} else {
			$this->session->set_flashdata('swetalert', '`Upsss!`, `Sorry., Data gagal di Aktifkan`, `error`');
		}
		redirect('mhs');
	}

	// fungsi generate angka random untuk pin dan tidak boleh sama dengan yang sudah ada di tabel pendaftar.pin
	function generateRandomString($length = 10)
	{
		$pin = substr(str_shuffle(str_repeat($x = '0123456789', ceil($length / strlen($x)))), 1, $length);
		$cek = $this->db->get_where('pendaftar', ['pin' => $pin])->row_array();
		if ($cek) {
			$this->generateRandomString();
		} else {
			return $pin;
		}
	}

	// function untuk mengambil data bukti bayar
	public function getDataMhs()
	{
		$id_pendaftar = $this->input->post('id_pendaftar');
		$data = $this->Models_mhs->getData($id_pendaftar, $act = 'id')->row_array();
		echo json_encode($data);
	}

	//resetPassword
	public function resetPassword()
	{
		$id_pendaftar = htmlspecialchars($this->input->post('id_pendaftar'));
		$password = htmlspecialchars($this->input->post('password'));

		$data = [
			'password' => password_hash($password, PASSWORD_DEFAULT)
		];

		$result = $this->Models_mhs->update($data, $id_pendaftar);
		if ($result) {
			$this->session->set_flashdata('swetalert', '`Good JoOb!`, `Password Berhasil di Reset`, `success`');
		} else {
			$this->session->set_flashdata('swetalert', '`Upsss!`, `Sorry., Password gagal di Reset`, `error`');
		}
		redirect('mhs');
	}

	// updateStatusLulus
	public function updateStatusLulus($act, $id_pendaftar)
	{
		if ($act == 'luluskan') {
			$data = [
				'stLulus' => '1'
			];
		} else {
			$data = [
				'stLulus' => '0'
			];
		}

		$result = $this->Models_mhs->update($data, $id_pendaftar);
		if ($result) {
			$this->session->set_flashdata('swetalert', '`Good JoOb!`, `Status Lulus Berhasil di Update`, `success`');
		} else {
			$this->session->set_flashdata('swetalert', '`Upsss!`, `Sorry., Status Lulus gagal di Update`, `error`');
		}
		redirect('mhs');
	}

	// updateDataMhs
	public function updateDataMhs()
	{
		$id_pendaftar = htmlspecialchars($this->input->post('id_pendaftar'));
		$nama = htmlspecialchars($this->input->post('nama'));
		$email = htmlspecialchars($this->input->post('email'));
		$alamat = htmlspecialchars($this->input->post('alamat'));
		$jk = htmlspecialchars($this->input->post('jk'));
		$asal_sekolah = htmlspecialchars($this->input->post('asal_sekolah'));
		$jurusan = htmlspecialchars($this->input->post('jurusan'));
		$no_hp = htmlspecialchars($this->input->post('no_hp'));
		$pin = htmlspecialchars($this->input->post('pin'));
		$nama_ortu = htmlspecialchars($this->input->post('nama_ortu'));
		$pekerjaan_ortu = htmlspecialchars($this->input->post('pekerjaan_ortu'));
		$alamat_ortu = htmlspecialchars($this->input->post('alamat_ortu'));
		$no_hp_ortu = htmlspecialchars($this->input->post('no_hp_ortu'));

		// validasi
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
			'required' => 'Nama tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
			'required' => 'Email tidak boleh kosong!',
			'valid_email' => 'Email tidak valid!'
		]);
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
			'required' => 'Alamat tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim', [
			'required' => 'Jenis Kelamin tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('asal_sekolah', 'Asal Sekolah', 'required|trim', [
			'required' => 'Asal Sekolah tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim', [
			'required' => 'Jurusan tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|trim', [
			'required' => 'No HP tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('pin', 'Pin', 'required|trim|numeric', [
			'required' => 'Pin tidak boleh kosong!',
			'numeric' => 'Pin harus angka!'
		]);
		$this->form_validation->set_rules('nama_ortu', 'Nama Orang Tua', 'required|trim', [
			'required' => 'Nama Orang Tua tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('pekerjaan_ortu', 'Pekerjaan Orang Tua', 'required|trim', [
			'required' => 'Pekerjaan Orang Tua tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('alamat_ortu', 'Alamat Orang Tua', 'required|trim', [
			'required' => 'Alamat Orang Tua tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('no_hp_ortu', 'Nomor HP Orang Tua', 'required|trim|numeric', [
			'required' => 'No HP Orang Tua tidak boleh kosong!',
			'numeric' => 'No HP Orang Tua harus angka!'
		]);

		if ($this->form_validation->run() == false) {
			$this->loadView('edit');
		} else {
			$data = [
				'nama' => $nama,
				'email' => $email,
				'alamat' => $alamat,
				'jk' => $jk,
				'asalsekolah' => $asal_sekolah,
				'jurusan' => $jurusan,
				'nohp' => $no_hp,
				'pin' => $pin,
				'namaortu' => $nama_ortu,
				'pekerjaanortu' => $pekerjaan_ortu,
				'alamatortu' => $alamat_ortu,
				'nohportu' => $no_hp_ortu
			];

			$result = $this->Models_mhs->update($data, $id_pendaftar);
			if ($result) {
				$this->session->set_flashdata('swetalert', '`Good JoOb!`, `Data Berhasil di Update`, `success`');
			} else {
				$this->session->set_flashdata('swetalert', '`Upsss!`, `Sorry., Data gagal di Update`, `error`');
			}
			redirect('mhs');
		}
	}

	// updateStPengumuman
	public function updateStPengumuman()
	{
		$data = [
			'stPengumuman' => '1'
		];

		$result = $this->Models_mhs->update($data);
		if ($result) {
			$this->session->set_flashdata('swetalert', '`Good JoOb!`, `Status Pengumuman Berhasil di Update`, `success`');
		} else {
			$this->session->set_flashdata('swetalert', '`Upsss!`, `Sorry., Status Pengumuman gagal di Update`, `error`');
		}
		redirect('mhs');
	}
}
