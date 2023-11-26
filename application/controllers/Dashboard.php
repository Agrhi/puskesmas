<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Models_pasien');
		$this->load->model('Models_rekamedis');
		// $this->load->model('Models_seleksi');
		$this->load->model('Models_user');
		cek_login();
	}

	public function index()
	{
		$data = [
			'title' 		=> 'Dashboard',
			'pasien'		=> $this->Models_pasien->getData()->num_rows(),
			'rekamedis'		=> '1',
			'klasifikasi'		=> '1',
			'user'			=> $this->Models_user->get()->num_rows(),
		];
		
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('layout/navbar');
		$this->load->view('content/admin/dashboard/index', $data);
		$this->load->view('layout/footer');
	}
}
