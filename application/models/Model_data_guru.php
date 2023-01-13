<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_data_guru extends CI_Model
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

    public function get_where($database, $where)
    {
        return $this->db->get_where($database, $where)->row();
    }

    public function get_where_many($database, $where)
    {
        return $this->db->get_where($database, $where)->result();
    }

    public function get_list_siswa($id_kelas)
    {
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
        return $this->db->select('*')->from('users')->join('detail_kelas', 'detail_kelas.id_kelas=users.kelas_id')->join('kelas', 'kelas.id_kelas=detail_kelas.id_kelas')
            ->join('matpel', 'matpel.id_matpel=detail_kelas.id_matpel')->where('users.role', 2)->where('kelas.id_kelas', $id_kelas)
            ->group_by('users.id_user')->get()->result();
    }

    public function matpel()
    {
        return $this->db->select('*')->from('users')->join('matpel', 'matpel.id_matpel=users.id_matpel')->where('users.id_matpel', $_SESSION['id_matpel'])
            ->get()->row();
    }

    public function get_list_prestasi($id, $kelas)
    {
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
        return $this->db->select('*')->from('users')->join('nilai', 'nilai.id_user=users.id_user')->join('kelas', 'kelas.id_kelas=users.kelas_id')
            ->join('matpel', 'matpel.id_matpel=nilai.id_matpel')->where('users.role', 2)->where('users.kelas_id', $kelas)->where('nilai.id_matpel', $id)
            ->group_by('users.id_user')->order_by('nilai.hasil', 'desc')->get()->result();
    }
    
}