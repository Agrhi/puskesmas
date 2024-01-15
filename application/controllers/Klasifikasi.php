<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Klasifikasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models_klasifikasi');
        cek_login();
    }

    public function index()
    {
        $data = [
            'title'         => 'Klasifikasi',
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/navbar');
        $this->load->view('content/admin/klasifikasi/index');
        $this->load->view('layout/footer');
    }

    public function tabelCalculate()
    {
        $alamat = htmlspecialchars($this->input->post('alamat', true));
        $jk = htmlspecialchars($this->input->post('jk', true));
        $umur = htmlspecialchars($this->input->post('umur', true));
        $all = htmlspecialchars($this->input->post('all', true));

        $data = [
            'Class' => [],
            'Atribut' => [],
            'TotalData' => [],
            'Enthropy' => [],
            'Gain' => [],
            'decision_tree' => [],
            'tes' => [],
        ];

        $data['Class']['class'] = $this->Models_klasifikasi->groupingClass($alamat, $jk, $umur, $all);
        $data['Atribut']['atribut'] = $this->Models_klasifikasi->atribut();

        // total data all
        $data['TotalData']['TotalDataAll'] = $this->Models_klasifikasi->TotalDataAll();
        $data['Enthropy']['EnthropyTotalDataAll'] = $this->Models_klasifikasi->TotalDataEntropy($alamat, $jk, $umur);

        // Subatribut Alamat
        $datasub_atribut_alamat = $this->Models_klasifikasi->subAtributAlamat($alamat);

        $data['TotalData']['TotalDataAlamat'] = count($datasub_atribut_alamat);

        $data['Gain']['alamat'] = $data['Enthropy']['EnthropyTotalDataAll'];

        if (count($datasub_atribut_alamat) == 1) {
            $data['Enthropy']['EnthropyAlamat'][$datasub_atribut_alamat[0]['alamat']] = $this->Models_klasifikasi->hitungEntropy('alamat', $datasub_atribut_alamat[0]['alamat']);
        } else {
            foreach ($datasub_atribut_alamat as $value) {
                $data['TotalData']['TotalDataClassAlamat'][$value['alamat']] = $this->Models_klasifikasi->hitungJumlahAtribut('alamat', $value['alamat']);

                $data['Enthropy']['EnthropyAlamat'][$value['alamat']] = $this->Models_klasifikasi->hitungEntropy('alamat', $value['alamat']);

                $data['Gain']['alamat'] -= $this->Models_klasifikasi->rumusGainTerpisah($this->Models_klasifikasi->hitungJumlahAtribut('alamat', $value['alamat']), $data['TotalData']['TotalDataAll'], $this->Models_klasifikasi->hitungEntropy('alamat', $value['alamat']));
            }
        }


        // Subatribut Jenis Kelamin
        $datasub_atribut_jk = $this->Models_klasifikasi->subAtributJk($jk);

        $data['TotalData']['TotalDataJk'] = count($datasub_atribut_jk);

        $data['Gain']['jk'] = $data['Enthropy']['EnthropyTotalDataAll'];

        if (count($datasub_atribut_jk) == 1) {
            $data['Enthropy']['EnthropyJk'][$datasub_atribut_jk['jk']] = $this->Models_klasifikasi->hitungEntropy('jk', $datasub_atribut_jk['jk']);
        } else {
            foreach ($datasub_atribut_jk as $value) {
                $data['TotalData']['TotalDataClassJk'][$value['jk']] = $this->Models_klasifikasi->hitungJumlahAtribut('jk', $value['jk']);

                $data['Enthropy']['EnthropyJk'][$value['jk']] = $this->Models_klasifikasi->hitungEntropy('jk', $value['jk']);

                $data['Gain']['jk'] -= $this->Models_klasifikasi->rumusGainTerpisah($this->Models_klasifikasi->hitungJumlahAtribut('jk', $value['jk']), $data['TotalData']['TotalDataAll'], $this->Models_klasifikasi->hitungEntropy('jk', $value['jk']));
            }
        }


        // Subatribut Umur
        $datasub_atribut_umur = $this->Models_klasifikasi->subAtributUmur($umur);

        $data['TotalData']['TotalDataUmur'] = count($datasub_atribut_umur);

        $data['Gain']['umur'] = $data['Enthropy']['EnthropyTotalDataAll'];

        if (count($datasub_atribut_umur) == 1) {
            $data['Enthropy']['EnthropyUmur'][$datasub_atribut_umur[0]['umur']] = $this->Models_klasifikasi->hitungEntropy('umur', $datasub_atribut_umur[0]['umur']);
        } else {
            foreach ($datasub_atribut_umur as $value) {
                $data['TotalData']['TotalDataClassUmur'][$value['umur']] = $this->Models_klasifikasi->hitungJumlahAtribut('umur', $value['umur']);

                $data['Enthropy']['EnthropyUmur'][$value['umur']] = $this->Models_klasifikasi->hitungEntropy('umur', $value['umur']);

                $data['Gain']['umur'] -= $this->Models_klasifikasi->rumusGainTerpisah($this->Models_klasifikasi->hitungJumlahAtribut('umur', $value['umur']), $data['TotalData']['TotalDataAll'], $this->Models_klasifikasi->hitungEntropy('umur', $value['umur']));
            }
        }

        // node 1 or tabel 1
        // nilai tertinggi gain pada tabel 1
        $valueNilaiTertinggi = max($data['Gain']);
        $keyNilaiTertinggi = array_search($valueNilaiTertinggi, $data['Gain']);


        // memisahkan data terpilih dan tidak terpilih
        $dataTerpilih = array($keyNilaiTertinggi => $valueNilaiTertinggi);
        $dataTidakTerpilih =
            array_diff_key($data['Gain'], $dataTerpilih);

        $data['tes']['terpilih'] = $dataTerpilih;
        $data['tes']['tidakTerpilih'] = $dataTidakTerpilih;

        $data['decision_tree']['pohon'] = $dataTerpilih;

        // node 2 or tabel 2
        $keyTerpilih = ucfirst($keyNilaiTertinggi);
        $dataTes = $data['TotalData']["TotalDataClass$keyTerpilih"];

        foreach ($dataTes as $dt => $value) {
            $data['tes']['tabel2'][$dt] = $this->Models_klasifikasi->tes($keyNilaiTertinggi, $dt, $dataTidakTerpilih, $data['Class']['class']);
        }

        echo '<pre>';
        print_r($data);
        exit;
    }
}
