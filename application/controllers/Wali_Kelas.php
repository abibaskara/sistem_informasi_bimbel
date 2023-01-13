<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wali_Kelas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_data_walikelas', 'DataWaliKelas');
    }

    public function index()
    {
        $data['matpel'] = $this->DataWaliKelas->get_matpel();
        $this->template->load('template/layout', 'wali_kelas/index', $data);
    }

    public function kelas()
    {
        $data['matpel'] = $this->DataWaliKelas->get_matpel();
        $data['kelas'] = $this->DataWaliKelas->get('kelas');
        $this->template->load('template/layout', 'wali_kelas/kelas/index', $data);
    }

    public function matpel()
    {
        $data['matpel'] = $this->DataWaliKelas->get_matpel();
        $data['data_matpel'] = $this->DataWaliKelas->get_list_matpel();
        $data['kelas'] = $this->DataWaliKelas->get_where('kelas', ['id_kelas' => $this->session->kelas_id]);
        $this->template->load('template/layout', 'wali_kelas/matpel/index', $data);
    }

    //MENU USER
    public function user($id)
    {
        if($id == 'siswa')
        {
            $this->form_validation->set_rules('username', 'Username', 'required');
            if ($this->form_validation->run() == false) {
                $data['users'] = $this->DataWaliKelas->get_list_siswa();
                $data['kelas'] = $this->DataWaliKelas->get('kelas');
                $data['matpel'] = $this->DataWaliKelas->get_matpel();
                $this->template->load('template/layout', 'wali_kelas/users/siswa', $data);
            } else {
                if($_FILES['foto']){
                    $foto = $_FILES['foto'];
                    if ($foto['name'] == '') {
                        if($this->input->post('pict')) {
                            $foto = $this->input->post('pict');
                        } else {
                            $this->session->set_flashdata('error', 'Foto Kosong!');
                            redirect('wali_kelas/user/siswa');
                        }
                    } else {
                        $config['upload_path']  = './foto';
                        $config['allowed_types'] = 'jpg|png|gif|jpeg';
                        // $config['max_size'] = '2048';
    
                        $this->load->library('upload', $config);
    
                        if (!$this->upload->do_upload('foto')) {
                            $this->session->set_flashdata('error', 'Foto Kosong!');
                            redirect('wali_kelas/user/siswa');
                        } else {
                            $foto = $this->upload->data('file_name');
                        }
                    }
                }

                $id_user = $this->input->post('id_user');
                $destroy = $this->input->post('destroy');
                //EDIT
                if($id_user) {
                    if($this->input->post('password') != '') {
                        $data = [
                            'username' => $this->input->post('username'),
                            'nik' => $this->input->post('nik'),
                            'phone' => $this->input->post('no_telp'),
                            'kelas_id' => $this->input->post('id_kelas'),
                            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                            'pict' => $foto,
                            'role' => '2'
                        ];
                    } else {
                        $data = [
                            'username' => $this->input->post('username'),
                            'nik' => $this->input->post('nik'),
                            'phone' => $this->input->post('no_telp'),
                            'kelas_id' => $this->input->post('id_kelas'),
                            'pict' => $foto,
                            'role' => '2'
                        ];
                    }
                    $where = [
                        'id_user' => $id_user
                    ];
    
                    $this->DataWaliKelas->update('users', $data, $where);
                    $this->session->set_flashdata('success', 'Data User Guru Berhasil Diedit!');
                    redirect('wali_kelas/user/siswa');
                } elseif($destroy) {
                //HAPUS
                    $where = [
                        'id_user' => $destroy
                    ];
                    $this->DataWaliKelas->delete('users', $where);
                    $this->session->set_flashdata('success', 'Data Berhasil Dihapus');
                    redirect('wali_kelas/user/siswa');
                } else {
                //CREATE
                    if($this->input->post('password') != '') {
                        $data = [
                            'username' => $this->input->post('username'),
                            'nik' => $this->input->post('nik'),
                            'phone' => $this->input->post('no_telp'),
                            'kelas_id' => $this->input->post('id_kelas'),
                            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                            'pict' => $foto,
                            'role' => '2',
                        ];
                    } else {
                        $data = [
                            'username' => $this->input->post('username'),
                            'nik' => $this->input->post('nik'),
                            'phone' => $this->input->post('no_telp'),
                            'kelas_id' => $this->input->post('id_kelas'),
                            'pict' => $foto,
                            'role' => '2',
                        ];
                    }
                    $this->DataWaliKelas->create('users', $data);
                    $this->session->set_flashdata('success', 'Data User Guru Berhasil Ditambahkan!');
                    redirect('wali_kelas/user/siswa');
                }
            }
        }
    }

    public function nilai($id)
    {
        
        $this->form_validation->set_rules('id_matpel', 'id_matpel', 'required');
        if ($this->form_validation->run() == false) {
            $data['siswa'] = $this->DataWaliKelas->get_list_nilai($id);
            $data['matpel'] = $this->DataWaliKelas->get_matpel();
            $data['matpel_value'] = $this->DataWaliKelas->get_where('matpel', ['id_matpel' => $id]);
            $this->template->load('template/layout', 'wali_kelas/nilai/index', $data);
        } else {
            try {
                //code...
                $id_matpel = $this->input->post('id_matpel');
                $id_user = $this->input->post('id_user');
                $absensi = $this->input->post('absensi');
                $tugas = $this->input->post('tugas');
                $uts = $this->input->post('uts');
                $uas = $this->input->post('uas');
                $id_nilai = $this->input->post('edit');
        
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
                $this->DataWaliKelas->update('nilai', $data, ['id_nilai' => $id_nilai]);
                $this->session->set_flashdata('success', 'Edit Nilai Berhasil');
                redirect("wali_kelas/nilai/$id");
            } catch (\Throwable $th) {
                // throw $th;
                $this->session->set_flashdata('error', 'Gagal Edit Nilai');
                redirect("wali_kelas/nilai/$id");
            }
        }
    }

    public function print($id_matpel, $id_user)
    {
        $data = [
            'nilai' => $this->DataWaliKelas->print_nilai($id_matpel, $id_user),
            'user' => $this->DataWaliKelas->user($id_user),
            'matpel' => $this->DataWaliKelas->get_matpel(),
        ];
        $this->template->load('template/layout', 'wali_kelas/nilai/print_nilai', $data);
        // $this->load->view('wali/nilai/print_nilai', $data);
    }

    public function prestasi()
    {
        $data['siswa'] = $this->DataWaliKelas->get_list_prestasi();
        $data['matpel'] = $this->DataWaliKelas->get_matpel();
        $this->template->load('template/layout', 'wali_kelas/prestasi/index', $data);
    }

    public function print_prestasi($id_user)
    {
        $data = [
            'nilai' => $this->DataWaliKelas->print_prestasi($id_user),
            'user' => $this->DataWaliKelas->user($id_user),
            'matpel' => $this->DataWaliKelas->get_matpel(),
        ];
        $this->template->load('template/layout', 'wali_kelas/prestasi/print_prestasi', $data);
        // $this->load->view('wali/nilai/print_nilai', $data);
    }
}