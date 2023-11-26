<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekamedis extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Models_rekamedis');
		cek_login();
	}

	public function index()
	{
		$data = [
			'title' 		=> 'Rekamedis',
			'rekamedis'		=> $this->Models_rekamedis->getData()->result_array(),
		];
		
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('layout/navbar');
		$this->load->view('content/admin/rekamedis/index', $data);
		$this->load->view('layout/footer');
	}
}
