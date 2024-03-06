<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Klasifikasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('DataInput');
        $this->load->library('C45');
        $this->load->model('Models_C45');
        $this->load->model('Models_rekamedis');
        cek_login();
    }

    public function index()
    {
        $data = [
            'title'         => 'Klasifikasi',
            'alamat'        => $this->Models_C45->getAlamat(),
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/navbar');
        $this->load->view('content/admin/klasifikasi/index', $data);
        $this->load->view('layout/footer');
    }

    private function initData()
    {
        $atributes = ['alamat', 'jk', 'umur', 'class'];
        $rows = $this->Models_C45->getData('data_latih', $atributes);

        // init data
        $data = new DataInput();
        $data->setAttributes($atributes);
        $data->setData($rows);

        $C45 = new C45();
        $c45 = $C45->constrc($data, 'class');
        $initialize = $c45->initialize();
        $buildTree = $initialize->buildTree();
        return $buildTree;
    }

    public function tree()
    {
        $buildTree = $this->initData();
        echo json_encode($buildTree, JSON_PRETTY_PRINT);
    }

    public function classify()
    {
        $alamat = $this->input->post('alamat', true);
        $jk = $this->input->post('jk', true);
        $umur = $this->input->post('umur', true);

        $data = $this->initData()->classify(["alamat" => "$alamat", "jk" => $jk, "umur" => "$umur"]);
        echo json_encode($data);
    }

    public function getDataRekamedisPasien()
    {
        $nik = $this->input->post('nik');
        $data = $this->Models_rekamedis->getData($nik)->row_array();
        echo json_encode($data);
    }
}
