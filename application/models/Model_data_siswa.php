<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_data_siswa extends CI_Model
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

    //RIWAYAT PEMBAYARAN
    public function get_riwayat_pembayaran_siswa()
    {
        return $this->db->select('*')->from('pembayaran')->join('users', 'users.id_user = pembayaran.id_user', 'left')
                ->join('kelas', 'users.kelas_id= kelas.id_kelas', 'left')->get()->result();
    }

    //DATA USER
    public function user($id)
    {
        return $this->db->select('*')->from('users')->join('kelas', 'kelas.id_kelas=users.kelas_id', 'left')->where('id_user', $id)->where('role', 2)
            ->get()->row();
    }

    //DATA NILAI
    public function get_nilai($id)
    {
        return $this->db->select('*')->from('nilai')->join('users', 'nilai.id_user=users.id_user')->join('matpel', 'nilai.id_matpel=matpel.id_matpel')
        ->where('nilai.id_user', $id)->get()->result();
    }

}