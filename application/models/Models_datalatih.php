<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Models_datalatih extends CI_Model
{
    public function getData()
    {
        return $this->db->get('data_latih');
    }
    public function insert_batch($data)
    {
        return $this->db->insert_batch('data_latih', $data);
    }
    public function truncateTable()
    {
        return $this->db->truncate('data_latih');
    }
}
