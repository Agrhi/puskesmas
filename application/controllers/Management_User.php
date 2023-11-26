<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Management_User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Models_user');
		cek_login();
		check_admin();
	}

	// Load Halaman Management User
	public function index()
	{
		$this->loadView();
	}

	// Load View
	private function loadView($showModal = "index")
	{
		$data = [
			'title' => 'Management User',
			'user' => $this->Models_user->get()->result_array(),
			'showModal' => $showModal
		];
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('layout/navbar');
		$this->load->view('content/admin/management_user/index', $data);
		$this->load->view('layout/footer');
	}

	// Konfirmasi Status User
	public function status($act, $id)
	{
		if ($act == 'aktif') {
			$status = 1;
		} else {
			$status = 0;
		}
		$result = $this->Models_user->status($id, $status);
		if ($result && $status == 1) {
			$this->session->set_flashdata('swetalert', '`Upsss!`, `Akun Gagal di Aktifkan`, `error`');
		} else if ($result && $status == 0) {
			$this->session->set_flashdata('swetalert', '`Upsss!`, `Akun Gagal di Non Aktifkan`, `error`');
		} else if (!$result && $status == 1) {
			$this->session->set_flashdata('swetalert', '`Good job!`, `Akun Berhasil di Aktifkan`, `success`');
		} else if (!$result && $status == 0) {
			$this->session->set_flashdata('swetalert', '`Good job!`, `Akun Berhasil di Non Aktifkan`, `success`');
		}
		redirect('Management_User');
	}
}
