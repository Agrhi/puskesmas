<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Models_C45 extends CI_Model
{
    function getData($tables, $atributes)
    {
        $this->db->select($atributes);
        return $this->db->get($tables)->result_array();
    }

    function getAlamat()
    {
        return $this->db->query("SELECT rekamedis.noRegist, pasien.alamat 
                            FROM rekamedis 
                            LEFT JOIN pasien ON pasien.noRegist = rekamedis.noRegist 
                            GROUP BY pasien.alamat
                            ")->result_array();
    }
}
