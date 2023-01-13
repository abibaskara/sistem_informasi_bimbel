<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_data_walikelas extends CI_Model
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

    public function get_matpel()
    {
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
        return $this->db->select('*')->from('users')->join('detail_kelas', 'detail_kelas.id_kelas=users.kelas_id', 'left')
            ->join('kelas', 'detail_kelas.id_kelas=kelas.id_kelas', 'left')->join('matpel', 'matpel.id_matpel=detail_kelas.id_matpel')
            ->where('kelas.id_kelas', $this->session->kelas_id)->group_by('detail_kelas.id_matpel')->get()
            ->result();
    }

    public function get_list_matpel()
    {
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
        return $this->db->select('*')->from('users')->join('detail_kelas', 'detail_kelas.id_kelas=users.kelas_id', 'left')
            ->join('matpel', 'matpel.id_matpel=detail_kelas.id_matpel')->where('users.kelas_id', $this->session->kelas_id)
            ->group_by('detail_kelas.id_matpel')->get()
            ->result();
    }

    
    public function get_list_siswa()
    {
        return $this->db->select('*')->from('users')->where('role', '2')->where('kelas_id', $this->session->kelas_id)
                ->join('kelas', 'kelas.id_kelas = users.kelas_id', 'left')->get()->result();
    }

    public function get_list_nilai($id)
    {
        return $this->db->select('*')->from('nilai')->join('users', 'users.id_user=nilai.id_user')->join('matpel', 'matpel.id_matpel=nilai.id_matpel')
            ->where('matpel.id_matpel', $id)->where('users.role', '2')->order_by('hasil', 'desc')
            ->get()->result();
    }

    public function print_nilai($id_matpel, $id_user)
    {
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
        return $this->db->select('*')->from('users')->join('nilai', 'nilai.id_user=users.id_user')->join('kelas', 'kelas.id_kelas=users.kelas_id')
            ->join('matpel', 'matpel.id_matpel=nilai.id_matpel')->where('users.role', '2')
            ->where('users.kelas_id', $this->session->kelas_id)->where('matpel.id_matpel', $id_matpel)->where('users.id_user', $id_user)
            ->order_by('nilai.hasil', 'asc')->get()->result();
    }
    
    public function user($id)
    {
        return $this->db->select('*')->from('users')->join('kelas', 'kelas.id_kelas=users.kelas_id', 'left')->where('id_user', $id)->where('role', 2)
            ->get()->row();
    }

    public function get_list_prestasi()
    {
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
        return $this->db->select('*')->from('users')->select('AVG(hasil) as jumlah')->join('nilai', 'nilai.id_user=users.id_user')
            ->join('kelas', 'kelas.id_kelas=users.kelas_id')->join('matpel', 'matpel.id_matpel=nilai.id_matpel')
            ->where('users.role', '2')->where('users.kelas_id', $this->session->kelas_id)
            ->group_by('users.id_user')->order_by('SUM(nilai.hasil)', 'DESC')->get()->result();
    }

    public function print_prestasi($id)
    {
        return $this->db->select('*')->from('nilai')->join('users', 'users.id_user=nilai.id_user')
            ->join('kelas', 'kelas.id_kelas=users.kelas_id')->join('matpel', 'matpel.id_matpel=nilai.id_matpel')
            ->where('users.role', '2')->where('users.id_user', $id)->get()->result();
    }
}