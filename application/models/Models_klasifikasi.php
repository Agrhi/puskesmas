<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Models_klasifikasi extends CI_Model
{
    public function getDataLatih($alamat, $jk, $umur, $all)
    {
        if ($all == 'false') {
            $this->db->where('alamat', $alamat);
            $this->db->where('jk', $jk);
            $this->db->where('umur', $umur);
            $this->db->order_by('jk', 'ASC');
        }

        $this->db->order_by('class', 'ASC');
        $result = $this->db->get('data_latih')->result_array();

        if (empty($result)) {
            echo "Data tidak ditemukan.";
        }

        return $result;
    }

    public function groupingClass($alamat, $jk, $umur, $all)
    {
        $this->db->select('class');
        if ($all == 'false') {
            $this->db->where('alamat', $alamat);
            $this->db->where('jk', $jk);
            $this->db->where('umur', $umur);
            $this->db->order_by('jk', 'ASC');
        }

        $this->db->group_by('class', 'ASC');
        $result = $this->db->get('data_latih')->result_array();

        if (empty($result)) {
            echo "Data tidak ditemukan.";
        }

        return $result;
    }

    public function atribut()
    {
        $columnNames = $this->db->list_fields('data_latih');

        $result = array_slice($columnNames, 1, -1);

        return $result;
    }

    public function subAtributAlamat($alamat)
    {
        $this->db->select('alamat');
        if ($alamat) {
            $this->db->where('alamat', $alamat);
        }
        $this->db->group_by('alamat');
        return $this->db->get('data_latih')->result_array();
    }

    public function subAtributJk($jk)
    {
        if ($jk !== null && $jk !== false && $jk !== '') {
            $query = $this->db->query("SELECT jk FROM `data_latih` WHERE `jk` = ?", array($jk));
            return $query->row_array();
        } else {
            $query = $this->db->query("SELECT jk FROM `data_latih` GROUP BY `jk`");
            return $query->result_array();
        }
    }

    public function subAtributUmur($umur)
    {
        $this->db->select('umur');
        if ($umur) {
            $this->db->where('umur', $umur);
        }
        $this->db->group_by('umur');
        return $this->db->get('data_latih')->result_array();
    }

    public function subAtributDinamis($key, $value)
    {
        $this->db->select($key);
        if ($value) {
            $this->db->where($key, $value);
        }
        $this->db->group_by($key);
        return $this->db->get('data_latih')->result_array();
    }

    // total atribut
    public function hitungJumlahAtribut($where, $value)
    {
        $this->db->where($where, $value);
        return $this->db->get('data_latih')->num_rows();
    }

    // total data all
    public function TotalDataAll()
    {
        return $this->db->get('data_latih')->num_rows();
    }

    public function TotalDataEntropy($alamat, $jk, $umur)
    {
        $condition = ($alamat && $jk && $umur) ? "WHERE alamat = ? AND jk = ? AND umur = ?" : '';

        // Total data
        $data = $this->db->query("SELECT COUNT(*) AS total_data FROM data_latih $condition", [$alamat, $jk, $umur])->row_array();

        // Determine class and count
        $class = $this->db->query("SELECT COUNT(*) AS total_class, class FROM data_latih $condition GROUP BY class", [$alamat, $jk, $umur])->result_array();

        $result = 0;

        // Calculate entropy
        foreach ($class as $value) {
            $result += (-$value['total_class'] / $data['total_data']) * log($value['total_class'] / $data['total_data'], 2);
        }

        return $result;
    }

    // rumus gain terpisah
    public function rumusGainTerpisah($totalAtribut, $totalDataAll, $enthropyAtribut)
    {
        return (($totalAtribut / $totalDataAll) * $enthropyAtribut);
    }

    // dinamis query
    public function hitungEntropy($key, $value)
    {
        // total data
        $data = $this->db->query("SELECT COUNT($key) AS total FROM data_latih WHERE $key = '$value'")->row_array();

        // menentukan jumlah data berdasarkan class
        $DataPerKelas = $this->db->query("SELECT COUNT($key) AS sum, class FROM data_latih WHERE $key = '$value' GROUP BY class")->result_array();

        $result = 0;
        // hitung entropy
        foreach ($DataPerKelas as $value) {
            $result += (-$value['sum'] / $data['total']) * log($value['sum'] / $data['total'], 2);
        }

        return $result;
    }

    public function tes($key, $value, $dataTidakTerpilih, $class)
    {
        $condition = '';
        foreach ($dataTidakTerpilih as $field => $val) {
            if ($field == 'jk') {
                $condition .= "COUNT(CASE WHEN jk = 0 THEN 1 END) AS jumlah_laki_laki,
                                COUNT(CASE WHEN jk = 1 THEN 1 END) AS jumlah_perempuan,";
            } elseif ($field == 'umur') {
                $condition .= "
                COUNT(CASE WHEN umur = 'Bayi dan Anak-anak' THEN 1 END) AS jumlah_bayi_dan_anak_anak,
                COUNT(CASE WHEN umur = 'Muda dan Dewasa' THEN 1 END) AS jumlah_muda_dan_dewasa,
                COUNT(CASE WHEN umur = 'Tua' THEN 1 END) AS jumlah_tua,
                ";
            } elseif ($field == 'alamat') {
                $resultClass = '';
                foreach ($class as $keyClass => $valueClass) {
                    $resultClass .= "COUNT(CASE WHEN " . $keyClass . " = '" . $valueClass . "' THEN 1 END) AS jumlah_cek" . $valueClass . ",";
                }

                $condition .= $resultClass;
            }
        }

        $query = "SELECT
        COUNT(*) AS jumlah_total,
        $condition
        GROUP_CONCAT(DISTINCT class) AS kategori_class
        FROM data_latih 
        WHERE $key = '" . $value . "'
        GROUP BY $key
        ";

        return $this->db->query($query)->row_array();
    }


    // Agrh

    // Mengambil atribut berdasarkan nama kolom di tabel datlatih
    public function getAtribut()
    {
        $columnNames = $this->db->list_fields('data_latih');
        $result = array_slice($columnNames, 1, -1);
        return $result;
    }

    // mengambil data subAtribut berdasarkan data atribut dan juga mengambil data Kelas
    public function getSubAtribut($colum){
        $this->db->select($colum);
        $this->db->group_by($colum);
        return $this->db->get('data_latih')->result_array();
    }

    // mengambil jumlah keseliuruhan data
    public function jmlTotal()
    {
        return $this->db->get('data_latih')->num_rows();
    }

    // count data berdasarkan key dan value
    public function countAtributlow($colum, $where){
        $this->db->where($colum, $where);
        return $this->db->get('data_latih')->num_rows();
    }
    
    // count data berdasarkan key dan value
    public function countAtribut($colum, $where, $columAtr = '', $whereAtr = ''){
        $this->db->where($colum, $where);
        if ($whereAtr != ''){
            $this->db->where($columAtr, $whereAtr);
        }
        return $this->db->get('data_latih')->num_rows();
    }


}
