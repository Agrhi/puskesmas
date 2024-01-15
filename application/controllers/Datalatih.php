<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
}
