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
        // print_r($data['Enthropy']['EnthropyTotalDataAll']); die;

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

    // Agrh

    public function latihData()
    {
        $data['kelas'] = $this->kelas(); // Mengambil seluru kelas
        $data['atribut'] = $this->getAtribut(); // mengambil seluru Atribut
        $data['subAtribut'] = $this->getSubAtribut($data['atribut']); // mengambil seluru Subatribut
        $data['jmlTotal'] = $this->jmlTotal(); // mengambil jumlah seluru data
        $data['jmlPerSubAtr'] = $this->jmlPerSubAtr($data['subAtribut']); // mengambil jumlah seluru data per sub atribut
        $data['jmlPerKelas'] = $this->jmlPerKelas($data['kelas']); // mengambil jumlah seluru data per kelas
        $data['jmlKelasPerSubAtr'] = $this->jmlKelasPerSubAtr($data['kelas'], $data['subAtribut']); // mengambil jumlah seluru data kelas per sub atribut
        // $data['himpun'] = $this->himpun($data['jmlKelasPerSubAtr']);
        $data['entrophyTotal'] = $this->entrophyTotal($data['jmlTotal'], $data['jmlPerKelas']); // menghitung nilai entrophy Keseluruhan
        // $data['entrophy'] = $this->entrophy($data['jmlPerSubAtr'], $data['jmlKelasPerSubAtr']); // menghitung nilai entrophy per sub Atribut
        $data['gain'] = $this->gain();


        echo '<pre>';
        print_r($data);
    }

    // Mengambil data atribut
    private function getAtribut()
    {
        return $this->Models_klasifikasi->getAtribut();
    }

    // mengambil data SubAtribut berdasarkan data Atribut
    private function getSubAtribut($data)
    {
        $result = [];
        foreach ($data as $value) {
            // $result[$value] = $this->Models_klasifikasi->getSubAtribut($value);
            $subAtribut = $this->Models_klasifikasi->getSubAtribut($value);
            $result[$value] = array_column($subAtribut, $value);
        }
        return $result;
    }

    // mengambil data kelas
    private function kelas()
    {
        $kelas = $this->Models_klasifikasi->getSubAtribut('class');
        return $result['kelas'] = array_column($kelas, 'class');
    }

    // mengambil jumlah keseluruhan
    private function jmlTotal()
    {
        return $this->Models_klasifikasi->jmlTotal();
    }

    // mengambil jumlah data berdasarkan kelas
    private function jmlPerSubAtr($data)
    {
        $result = [];
        foreach ($data as $key => $values) {
            foreach ($values as $value) {
                $result[$key][$value] = $this->Models_klasifikasi->countAtribut($key, $value);
            }
        }
        return $result;
    }

    // mengambil jumlah data berdasarkan kelas
    private function jmlPerKelas($data)
    {
        $result = [];
        foreach ($data as $values) {
            $result[$values] = $this->Models_klasifikasi->countAtribut('class', $values);
        }
        return $result;
    }

    private function jmlKelasPerSubAtr($kelas, $subAtr)
    {
        $result = [];
        foreach ($kelas as $valuesAtr) {
            foreach ($subAtr as $key => $values) {
                foreach ($values as $value) {
                    $result[$valuesAtr][$key][$value] = $this->Models_klasifikasi->countAtribut($key, $value, 'class', $valuesAtr);
                }
            }
        }
        return $result;
    }

    private function himpun($data){
        $result = [];

        foreach($data as $value) {

        }
    }

    // mengambil jumlah keseluruhan
    private function entrophy($jmlTotal, $data)
    {
        // $result = 0;
        // foreach ($data as $valuesAtr) {
        //     foreach ($valuesAtr as $values) {
        //             foreach ($values as $value) {
        //             $hasil = $this->countEntrophy($jmlTotal, $value);
        //             $result += $hasil;
        //             }                
        //     }
        // }
        // return $result;
        $entrophyResult = [];

        foreach ($data as $tingkatanKelas => $dataKelas) {
            foreach ($dataKelas as $atribut => $nilaiAtribut) {
                // $jmlTotalAtribut = array_sum($nilaiAtribut);

                foreach ($nilaiAtribut as $key => $jumlah) {
                    // Hitung entropi untuk setiap nilai atribut menggunakan fungsi countEntrophy
                    // $entrophyResult[$tingkatanKelas][$atribut][$key] = $this->countEntrophy($jmlTotal, $jumlah);
                    $entrophyResult[$tingkatanKelas][$atribut][$key] = $this->countEntrophy($jmlTotal, $jumlah);

                }
            }
        }

        // noval


        return $entrophyResult;
    }

    private function entrophyTotal($jmlTotal, $data)
    {
        $result = 0;
        foreach ($data as $value) {
            $result += $this->countEntrophy($jmlTotal, $value);
        }
        return $result;
    }

    // mengambil jumlah keseluruhan
    private function gain()
    {
        return $this->Models_klasifikasi->jmlTotal();
    }

    // Rumus menghitung entrophy
    private function countEntrophy($jmlTotal, $jmlClassPerSubAtr)
    {
        $result = (-$jmlClassPerSubAtr / $jmlTotal) * log($jmlClassPerSubAtr / $jmlTotal, 2);
        return $result;
    }

    // Rumus menghitung gain
    private function countGain()
    {
    }
}
