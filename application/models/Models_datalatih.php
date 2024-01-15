<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Models_datalatih extends CI_Model
{
    public function getData()
    {
        return $this->db->get('data_latih');
    }
}
