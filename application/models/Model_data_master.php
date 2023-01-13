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

    public function delete($database, $where)
    {
        return $this->db->delete($database, $where);
    }

    public function get_where_many()
    {
        return $this->db->get_where($database, $where)->result();
    }

    //USERS SISWA
    public function get_list_siswa()
    {
        return $this->db->select('*')->from('users')->where('role', '2')->join('kelas', 'kelas.id_kelas = users.kelas_id', 'left')
                ->get()->result();

    }

    //USERS GURU
    public function get_list_guru()
    {
        return $this->db->select('*')->from('users')->where('role', '3')->join('matpel', 'matpel.id_matpel = users.id_matpel', 'left')
                ->get()->result();

    }

    //USERS KEPALA BIMBA
    public function get_list_kepala_bimba()
    {
        return $this->db->select('*')->from('users')->where('role', '4')->get()->result();
    }

    //USERS WALI KELAS
    public function get_list_wali_kelas()
    {
        return $this->db->select('*')->from('users')->where('role', '5')->join('kelas', 'kelas.id_kelas = users.kelas_id', 'left')
                ->get()->result();

    }
}