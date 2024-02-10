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
        set_time_limit(600);

        $pohon = 1;

        $namaPohon = 'pohon' . $pohon;
        $data['kelas'] = $this->kelas(); // Mengambil seluru kelas
        $data['atribut'] = $this->getAtribut(); // mengambil seluru Atribut
        $data['subAtribut'] = $this->getSubAtribut($data['atribut']); // mengambil seluru Subatribut
        $data['jmlTotal'] = $this->jmlTotal(); // mengambil jumlah seluru data
        $data['jmlPerKelas'] = $this->jmlPerKelas($data['kelas']); // mengambil jumlah seluru data per kelas
        $data['entrophyTotal'] = $this->entrophyTotal($data['jmlTotal'], $data['jmlPerKelas']); // menghitung nilai entrophy Keseluruhan

        $data['jmlPerSubAtr'] = $this->jmlPerSubAtr($data['subAtribut']); // mengambil jumlah seluru data per sub atribut

        // Dua ini perlu di revisi (mau gunakan cara terbaik mana menerutmu)
        // $data['jmlKelasPerSubAtr'] = $this->jmlKelasPerSubAtr($data['kelas'], $data['subAtribut']); // mengambil jumlah seluru data kelas per sub atribut
        // $data['jmlSubAtributPerKelas'] = $this->jmlSubAtributPerKelas($data['jmlKelasPerSubAtr']);
        // dua model di atas ini cara pertama, cara keduanya seperti di baris kedua di bawah hanya saja menggunakan struktur data seperti yang line 2
        $data['jmlSubAtributPerKelas'] = $this->jmlSubAtributPerKelas($data['kelas'], $data['subAtribut']);


        $data['entrophy'] = $this->entrophy('step1', $data['jmlPerSubAtr'], $data['jmlSubAtributPerKelas']); // menghitung nilai entrophy per sub Atribut
        $data['gain'] = $this->gain($data['jmlTotal'], $data['entrophyTotal'], $data['jmlPerSubAtr'], $data['entrophy']);

        $data['gainTertinggi'] = $this->gainTertinggi($data['gain']);
        $data[$namaPohon] = $this->gainTertinggi($data['gain']);
        $data['entrophygainTerting'] = $this->entrophygainTerting($data['gainTertinggi'], $data['entrophy']);
        // $data['dataWherestep2'] = $this->dataWherestep2($data['gainTertinggi'], $data['entrophygainTerting']);

        // $data['jmlPerSubAtrWhere'] = $this->jmlPerSubAtrWhere($data['subAtribut'], $data['gainTertinggi']); // dibuat sementara nantinya mungkin berguna saat pake looping
        $data['step2'] = $this->stepByStep($data['kelas'], $data['subAtribut'], $data['entrophyTotal'], $data['jmlTotal'], $data['entrophygainTerting'], $data['gainTertinggi']);

        echo '<pre>';
        print_r($data);

        // Percobaan Lain


        // Data yang Sering digunakan (Tidak Berubah)
        //     $data['kelas'] = $this->kelas(); // Mengambil seluru kelas
        //     $data['atribut'] = $this->getAtribut(); // mengambil seluru Atribut
        //     $data['subAtribut'] = $this->getSubAtribut($data['atribut']); // mengambil seluru Subatribut
        //     $data['jmlTotal'] = $this->jmlTotal(); // mengambil jumlah seluru data
        //     $data['jmlPerKelas'] = $this->jmlPerKelas($data['kelas']); // mengambil jumlah seluru data per kelas
        //     $data['entrophyTotal'] = $this->entrophyTotal($data['jmlTotal'], $data['jmlPerKelas']); // menghitung nilai entrophy Keseluruhan

        //     $stepByStep = $this->stepByStep($data['kelas'], $data['subAtribut'], $data['jmlTotal'], $data['jmlPerKelas'], $data['entrophyTotal']);

        //     $AllData = [
        //         'DataDefault' => [
        //             'Class' => $data['kelas'],
        //             'Atribut' => $data['atribut'],
        //             'SubAtribut' => $data['subAtribut'],
        //             'TotalData' => $data['jmlTotal'],
        //             'TotalPerKelas' => $data['jmlPerKelas'],
        //         ],
        //         'DataTerulang' => [$stepByStep]

        //     ];

        //     echo '<pre>';
        //     print_r($AllData);
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

    private function jmlPerSubAtrWhere($subAtr, $gainTerTinggi, $entrophygainTerting)
    {
        $result = [];
        foreach ($gainTerTinggi as $keyGain => $valueGain) {
            foreach ($subAtr as $keySubAtr => $values) {
                foreach ($values as $key => $value) {
                    // $result[$keySubAtr] = $value;
                    if ($keySubAtr !== $keyGain) {
                        // $result[$keySubAtr][$value] = $this->Models_klasifikasi->countAtribut($keySubAtr, $value); // kalau mau aktifkan hapus $entrophygainTerting
                        foreach ($entrophygainTerting as $entrophygainTertingKey => $entrophygainTertingValue) {
                            foreach ($entrophygainTertingValue as $entrophyKey => $entrophyValue) {
                                $result[$entrophyKey][$keySubAtr][$value] = $this->Models_klasifikasi->countAtribut($keySubAtr, $value, $keyGain, $entrophyKey);
                                // $result = $entrophyKey;
                            }
                        }
                    }
                }
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

    private function jmlSubAtributPerKelaslow($data)
    {
        $result = [];
        foreach ($data as $groupKey => $group) {
            foreach ($group as $subGroupKey => $subGroup) {
                foreach ($subGroup as $subSubGroupKey => $value) {
                    $result[$subGroupKey][$subSubGroupKey][$groupKey] = $value;
                }
            }
        }
        return $result;
    }

    private function jmlSubAtributPerKelas($kelas, $subAtr, $entrophygainTerting = '', $gainTertinggi = '')
    {
        $result = [];
        foreach ($kelas as $valuesAtr) {
            // foreach ($gainTertinggi as $keyGain => $valueGain) {
            foreach ($subAtr as $key => $values) {
                foreach ($values as $value) {
                    // $result[$keySubAtr] = $value;
                    if ($entrophygainTerting == '') {
                        $result[$key][$value][$valuesAtr] = $this->Models_klasifikasi->countAtribut($key, $value, 'class', $valuesAtr);
                    } else {
                        foreach ($entrophygainTerting as $keyGain => $valueGain) {
                            foreach ($valueGain as $keyEntTing => $valueEntTing) {
                                if ($key !== $keyGain) {
                                    // print_r($where); die;
                                    $result[$keyEntTing][$key][$value][$valuesAtr] = $this->Models_klasifikasi->countAtribut($keyGain, $keyEntTing, 'class', $valuesAtr, $key, $value);
                                }
                            }
                        }
                    }
                }
                // }
            }
        }
        // foreach ($kelas as $valuesAtr) {
        //     foreach ($subAtr as $key => $values) {
        //         foreach ($values as $value) {
        //             if ($entrophygainTerting == '') {
        //                 $result[$key][$value][$valuesAtr] = $this->Models_klasifikasi->countAtribut($key, $value, 'class', $valuesAtr);
        //             } else {
        //                 foreach ($entrophygainTerting as $keyGain => $valueGain) {
        //                     foreach ($valueGain as $keyEntTing => $valueEntTing) {
        //                         if ($key !== $keyGain) {
        //                             // print_r($where); die;
        //                             $result[$key][$value][$valuesAtr] = $this->Models_klasifikasi->countAtribut($keyGain, $keyEntTing, 'class', $valuesAtr, $key, $value);
        //                         }
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }
        return $result;
    }

    // mengambil jumlah keseluruhan
    private function entrophy($act, $jmlTotal, $data)
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

        // kedua
        $entrophyResult = [];

        if ($act === 'step1') {


            foreach ($jmlTotal as $jmlTotals) {
                foreach ($jmlTotals as $key => $value) {
                    foreach ($data as $tingkatanKelas => $dataKelas) {
                        foreach ($dataKelas as $atribut => $nilaiAtribut) {
                            // Set nilai awal untuk indeks 'hasil'
                            $entrophyResult[$tingkatanKelas][$atribut] = 0;

                            foreach ($nilaiAtribut as $keyhimpun => $jumlah) {
                                $hasil = $this->countEntrophy($value, $jumlah);
                                if (!is_nan($hasil)) {
                                    $entrophyResult[$tingkatanKelas][$atribut] += $hasil;
                                    // $entrophyResult[$tingkatanKelas][$atribut][$keyhimpun] = $hasil;
                                }
                            }
                        }
                    }
                }
            }
        } else {
            foreach ($jmlTotal as $jmlTotals) {
                foreach ($jmlTotals as $jmlTotalss) {
                    foreach ($jmlTotalss as $key => $value) {
                        foreach ($data as $tingkatanKelass => $dataKelass) {
                            foreach ($dataKelass as $tingkatanKelas => $dataKelas) {
                                foreach ($dataKelas as $atribut => $nilaiAtribut) {
                                    // Set nilai awal untuk indeks 'hasil'
                                    $entrophyResult[$tingkatanKelas][$atribut] = 0;

                                    foreach ($nilaiAtribut as $keyhimpun => $jumlah) {
                                        // $entrophyResult[$tingkatanKelas][$atribut] = $jumlah;
                                        $entrophyResult[$tingkatanKelas][$atribut][$keyhimpun] = $jumlah;
                                        // $hasil = $this->countEntrophy($value, $jumlah);
                                        // if (!is_nan($hasil)) {
                                        //     $entrophyResult[$tingkatanKelas][$atribut] += $hasil;
                                        //     // $entrophyResult[$tingkatanKelas][$atribut][$keyhimpun] = $hasil;
                                        // }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $entrophyResult;

        // $entrophyResult = [];

        // foreach ($jmlTotal as $jmlTotals) {
        //     foreach ($jmlTotals as $key => $value) {
        //         foreach ($data as $tingkatanKelas => $dataKelas) {
        //             foreach ($dataKelas as $atribut => $nilaiAtribut) {
        //                 // Set nilai awal untuk indeks 'hasil'
        //                 $entrophyResult[$tingkatanKelas][$atribut] = 0;

        //                 foreach ($nilaiAtribut as $keyhimpun => $jumlah) {
        //                     $hasil = $this->countEntrophy($value, $jumlah);

        //                     if (!is_nan($hasil)) {
        //                         // $entrophyResult[$tingkatanKelas][$atribut][$keyhimpun] = $hasil;
        //                         // Tambahkan hasil ke indeks 'hasil'
        //                         $entrophyResult[$tingkatanKelas][$atribut] += $hasil;
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }

        // return $entrophyResult;
    }

    private function entrophyTotal($jmlTotal, $data)
    {
        $result = 0;
        foreach ($data as $value) {
            $result += $this->countEntrophy($jmlTotal, $value);
        }
        return $result;
    }

    private function gain($jmlTotal, $entrophyTotal, $jmlPerSubAtr, $entrophyPerSubAtr)
    {
        // print_r($entrophyTotal); die;
        $result = [];

        foreach ($jmlPerSubAtr as $subAtrKey => $subAtrValue) {
            foreach ($subAtrValue as $key => $value) {


                foreach ($entrophyPerSubAtr as $perAtrValue) {
                    $hasilSubAtr = $entrophyTotal; // Deklarasikan Variable hasil
                    foreach ($perAtrValue as $keySub => $enPerSubAtr) {
                        $hasilSubAtr -= $this->countGain($value, $jmlTotal, $enPerSubAtr);
                    }
                    $result[$subAtrKey] = $hasilSubAtr;
                }
            }
        }

        return $result;
    }

    // Rumus menghitung entrophy
    private function countEntrophy($jmlTotal, $jmlClassPerSubAtr)
    {
        $result = (-$jmlClassPerSubAtr / $jmlTotal) * log($jmlClassPerSubAtr / $jmlTotal, 2);
        return $result;
    }

    // Rumus menghitung gain
    private function countGain($jmlPerSubAtr, $jmlTotal, $enthropyAtribut)
    {
        // echo $jmlPerSubAtr .' - '.$jmlTotal . ' - '.$enthropyAtribut; die;
        return (($jmlPerSubAtr / $jmlTotal) * $enthropyAtribut);
    }

    private function gainTertinggi($gain)
    {
        // Mengurutkan array secara descending berdasarkan nilai
        arsort($gain);

        // Mengambil kunci dan nilai dari elemen pertama (yang memiliki nilai tertinggi)
        $highestValueKey = key($gain);
        $highestValue = reset($gain);

        return [
            $highestValueKey => $highestValue,
        ];
    }

    private function entrophygainTerting($gainTerTinggi, $entrophygainTerting)
    {
        $result = [];
        foreach ($entrophygainTerting as $entKey => $value) {
            foreach ($gainTerTinggi as $gainKey => $values) {
                if ($entKey === $gainKey) {
                    $result[$entKey] = $value;
                }
            }
        }
        return $result;
    }

    private function dataWherestep2($gainTerTinggi, $entrophygainTerting)
    {
        $result = [];
        foreach ($gainTerTinggi as $gainKey => $gainValue) {
            foreach ($entrophygainTerting as $value) {
                foreach ($value as $key => $values) {
                    $result[$key] = $this->Models_klasifikasi->getDataWhereAtr($gainKey, $key);
                }
            }
        }
        return $result;
    }

    private function stepByStep($kelas, $subAtribut, $jmlTotal, $entrophyTotal, $entrophygainTerting, $gainTertinggi)
    {
        // Step2

        $step = [];

        foreach ($entrophygainTerting as $entrophygainTertingVal) {
            foreach ($entrophygainTertingVal as $entrophygainTertingKey => $entrophygainTertingValues) {
                // $data = $entrophygainTertingKey;
                $data['jmlPerSubAtr'] = $this->jmlPerSubAtrWhere($subAtribut, $gainTertinggi, $entrophygainTerting); // mengambil jumlah seluru data per sub atribut
                $data['jmlSubAtributPerKelas'] = $this->jmlSubAtributPerKelas($kelas, $subAtribut, $entrophygainTerting, $gainTertinggi);
                // $data['entrophy'] = $this->entrophy('step2', $data['jmlPerSubAtr'], $data['jmlSubAtributPerKelas']); // menghitung nilai entrophy per sub Atribut

                // $data['gain'] = $this->gain($jmlTotal, $entrophyTotal, $data['jmlPerSubAtr'], $data['entrophy']);
            }
        }

        // step2

        // step3

        return $data;
    }

    // private function stepByStep($kelas, $subAtribut, $jmlTotal, $jmlPerKelas, $entrophyTotal)
    // {
    //     $step = 1;

    //     $gainTerTinggi = '';

    //     // switch ($step) {
    //     //     case 1:
    //     //         if ($step == 1) {

    //     // Step1
    //     $data['jmlPerSubAtr'] = $this->jmlPerSubAtr($subAtribut); // mengambil jumlah seluru data per sub atribut
    //     $data['jmlSubAtributPerKelas'] = $this->jmlSubAtributPerKelas($kelas, $subAtribut);
    //     // } else {
    //     //     // Step1
    //     //     $data['jmlPerSubAtr'] = $this->jmlPerSubAtrWhere($subAtribut, $gainTerTinggi); // mengambil jumlah seluru data per sub atribut
    //     //     $data['jmlSubAtributPerKelas'] = $this->jmlSubAtributPerKelas($kelas, $subAtribut, $keyWhere, $valueWhere);
    //     // }

    //     // step2
    //     $data['entrophy'] = $this->entrophy($data['jmlPerSubAtr'], $data['jmlSubAtributPerKelas']); // menghitung nilai entrophy per sub Atribut

    //     // step3
    //     $data['gain'] = $this->gain($jmlTotal, $entrophyTotal, $data['jmlPerSubAtr'], $data['entrophy']);

    //     $data['gainTertinggi'] = $this->gainTertinggi($data['gain']);

    //     $data['entrophygainTerting'] = $this->entrophygainTerting($data['gainTertinggi'], $data['entrophy']);

    //     // step4
    //     //         break;
    //     //     default;
    //     // }

    //     // if ($gainTerTinggi > 0) {
    //     //     // kembali ke switch dan tampung nilai gain tertinggi setiap perulangannya
    //     // }
    //     return $data;
    // }

    // private function stepByStep($kelas, $subAtribut, $jmlTotal, $jmlPerKelas, $entrophyTotal)
    // {
    //     $step = 1;
    //     $gainTerTinggi = '';

    //     // Lakukan langkah-langkah secara bertahap
    //     switch ($step) {
    //         case 1:
    //             // Lakukan step 1
    //             $data['jmlPerSubAtr'] = $this->jmlPerSubAtr($subAtribut);
    //             $data['jmlSubAtributPerKelas'] = $this->jmlSubAtributPerKelas($kelas, $subAtribut);
    //             break;
    //         case 2:
    //             // Lakukan step 2
    //             $data['jmlPerSubAtr'] = $this->jmlPerSubAtrWhere($subAtribut, $gainTerTinggi);
    //             $data['jmlSubAtributPerKelas'] = $this->jmlSubAtributPerKelas($kelas, $subAtribut);
    //             break;
    //             // Tambahkan case untuk langkah-langkah lain jika diperlukan
    //             // ...
    //         default:
    //             break;
    //     }

    //     // Lakukan step yang bersifat umum setelah langkah-langkah khusus
    //     // step 3
    //     $data['entrophy'] = $this->entrophy($data['jmlPerSubAtr'], $data['jmlSubAtributPerKelas']);
    //     // step 4
    //     $data['gain'] = $this->gain($jmlTotal, $entrophyTotal, $data['jmlPerSubAtr'], $data['entrophy']);
    //     // step 5
    //     $gainTerTinggi = $this->gainTertinggi($data['gain']);

    //     // Lakukan pengecekan untuk kembali ke langkah sebelumnya jika diperlukan
    //     // if ($gainTerTinggi !== []) {
    //     //     // Kembalikan ke langkah sebelumnya dan perbarui nilai step
    //     //     $step--; // Kembali ke langkah sebelumnya
    //     //     return $this->stepByStep($kelas, $subAtribut, $jmlTotal, $jmlPerKelas, $entrophyTotal);
    //     // }

    //     return $data;
    // }
}
