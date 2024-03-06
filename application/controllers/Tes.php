<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('DataInput');
        $this->load->library('C45');
        $this->load->model('Models_C45');
        cek_login();
    }

    public function index()
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

        echo '<pre>';
        print_r($buildTree);

        // classified new data
        // print_r($buildTree->classify(["alamat" => "Mensung", "jk" => 0, "umur" => "Tua"]));
    }
}
