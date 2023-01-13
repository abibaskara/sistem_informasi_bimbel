<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_data_guru', 'DataGuru');
    }

    public function index()
    {
        $data['kelas'] = $this->DataGuru->get('kelas');
        $this->template->load('template/layout', 'guru/index', $data);
    }

    public function penilaian($kelas)
    {
        $this->form_validation->set_rules('absensi', 'Absensi', 'required');
        if ($this->form_validation->run() == false) {

            $data = [
                'siswa' => $this->DataGuru->get_list_siswa($kelas),
                'matpel' => $this->DataGuru->matpel(),
                'kelas' => $this->DataGuru->get('kelas'),
                'id_kelas' => $kelas,
            ];

            $this->template->load('template/layout', 'guru/nilai/index', $data);
        } else {
            try {
                //code...
                $id_matpel = $this->input->post('id_matpel');
                $id_user = $this->input->post('id_user');
                $absensi = $this->input->post('absensi');
                $tugas = $this->input->post('tugas');
                $uts = $this->input->post('uts');
                $uas = $this->input->post('uas');

                $hasil = (($absensi / 25 * 100) * 15 / 100) + ($tugas * 20 / 100) + ($uts * 25 / 100) + ($uas * 40 / 100);

                $data = [
                    'id_matpel' => $id_matpel,
                    'id_user' => $id_user,
                    'absensi' => $absensi,
                    'tugas' => $tugas,
                    'uts' => $uts,
                    'uas' => $uas,
                    'hasil' => $hasil,
                ];
                $this->DataGuru->create('nilai', $data);
                $this->session->set_flashdata('success', 'Input Nilai Berhasil');
                redirect("guru/penilaian/$kelas");
            } catch (\Throwable $th) {
                //throw $th;
                $this->session->set_flashdata('error', 'Gagal Input Nilai');
                redirect("guru/penilaian/$kelas");
            }
        }
    }

    public function prestasi($kelas)
    {
        $data['kelas'] = $this->DataGuru->get('kelas');
        $data['siswa'] = $this->DataGuru->get_list_prestasi($this->session->id_matpel, $kelas);
        $data['kelas_value'] = $this->DataGuru->get_where('kelas', ['id_kelas' => $kelas]);

        $this->template->load('template/layout', 'guru/prestasi/index', $data);
    }
}