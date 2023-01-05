<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_data_master extends CI_Model
{
    public function get($database)
    {
        return $this->db->get($database)->result();
    }

    public function create($database, $data)
    {
        return $this->db->insert($database, $data);
    }

    public function update($database, $data, $where)
    {
        return $this->db->update($database, $data, $where);
    }
}