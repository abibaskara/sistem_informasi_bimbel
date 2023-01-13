<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_data_master', 'DataMaster');
    }

    public function index()
    {
        $this->template->load('template/layout', 'staff/index');
    }


    //MENU KELAS
    public function kelas()
    {
        $data['data'] = $this->DataMaster->get('kelas');
        $data['matpel'] = $this->DataMaster->get('matpel');
        $this->template->load('template/layout', 'staff/kelas/index', $data);
    }

    public function add_kelas()
    {
        $kelas = $this->input->post('nama_kelas');
        $id_matpel = $this->input->post('id_matpel');

        try {
            //code...
            $this->db->trans_begin();
            $data = [
                'kelas' => $kelas,
            ];
            $this->DataMaster->create('kelas', $data);
            $id = $this->db->insert_id();
            for($i = 0; $i < count($id_matpel); $i++)
            {
                $detail_kelas = [
                    'id_kelas'  => $id,
                    'id_matpel' => $id_matpel[$i]
                ];
                $this->DataMaster->create('detail_kelas', $detail_kelas);
            }
            $this->db->trans_commit();
            $this->session->set_flashdata('success', 'Data Berhasil Ditambahkan');
            redirect('staff/kelas');
        } catch (\Throwable $th) {
            // throw $th;
            $this->db->trans_rollback();
            $this->session->set_flashdata('error', $th);
            redirect('staff/kelas');
        }
    }

    public function edit_kelas($id)
    {
        $kelas = $this->input->post('nama_kelas');
        $id_matpel = $this->input->post('id_matpel');
        
        try {
            //code...
            $this->db->trans_begin();
            $data = [
                'kelas' => $kelas,
            ];
            $where = [
                'id_kelas' => $id
            ];
            $this->DataMaster->update('kelas', $data, $where);
            $this->DataMaster->delete('detail_kelas', $where);
            for($i = 0; $i < count($id_matpel); $i++)
            {
                $detail_kelas = [
                    'id_kelas'  => $id,
                    'id_matpel' => $id_matpel[$i]
                ];
                $this->DataMaster->create('detail_kelas', $detail_kelas);
            }
            $this->db->trans_commit();
            $this->session->set_flashdata('success', 'Data Berhasil Diedit');
            redirect('staff/kelas');
        } catch (\Throwable $th) {
            //throw $th;
            $this->db->trans_rollback();
            $this->session->set_flashdata('error', 'Gagal Edit Data');
            redirect('staff/kelas');
        }
    }

    public function delete_kelas($id)
    {
        $id = [
            'id_kelas' => $id
        ];
    
        try {
            //code...
            $this->db->trans_begin();
            $this->DataMaster->delete('kelas', $id);
            $this->DataMaster->delete('detail_kelas', $id);
            $this->db->trans_commit();
            $this->session->set_flashdata('success', 'Data Berhasil Dihapus');
            redirect('staff/kelas');
        } catch (\Throwable $th) {
            //throw $th;
            $this->db->trans_rollback();
            $this->session->set_flashdata('error', 'Gagal Hapus Data');
            redirect('staff/kelas');
        }   
    }

    //MENU MATPEL
    public function matpel()
    {
        $data['data'] = $this->DataMaster->get('matpel');
        $this->template->load('template/layout', 'staff/matpel/index', $data);
    }

    public function add_matpel()
    {
        $data = [
            'kode_matpel' => $this->input->post('kode_matpel'),
            'matpel' => $this->input->post('nama_matpel'),
        ];

        try {
            //code...
            $this->DataMaster->create('matpel', $data);
            $this->session->set_flashdata('success', 'Data Berhasil Ditambahkan');
            redirect('staff/matpel');
        } catch (\Throwable $th) {
            //throw $th;
            $this->session->set_flashdata('error', 'Gagal Simpan Data');
            redirect('staff/matpel');
        }
    }

    public function edit_matpel($id)
    {
        $data = [
            'kode_matpel' => $this->input->post('kode_matpel'),
            'matpel' => $this->input->post('nama_matpel'),
        ];
        $id = [
            'id_matpel' => $id
        ];
        try {
            //code...
            $this->DataMaster->update('matpel', $data, $id);
            $this->session->set_flashdata('success', 'Data Berhasil Diedit');
            redirect('staff/matpel');
        } catch (\Throwable $th) {
            //throw $th;
            $this->session->set_flashdata('error', 'Gagal Edit Data');
            redirect('staff/matpel');
        }
    }

    public function delete_matpel($id)
    {
        $id = [
            'id_matpel' => $id
        ];
    
        try {
            //code...
            $this->DataMaster->delete('matpel', $id);
            $this->session->set_flashdata('success', 'Data Berhasil Dihapus');
            redirect('staff/matpel');
        } catch (\Throwable $th) {
            //throw $th;
            $this->session->set_flashdata('error', 'Gagal Hapus Data');
            redirect('staff/matpel');
        }   
    }

    //MENU USER
    public function user($id)
    {
        if($id == 'siswa')
        {
            $this->form_validation->set_rules('username', 'Username', 'required');
            if ($this->form_validation->run() == false) {
                $data['users'] = $this->DataMaster->get_list_siswa();
                $data['kelas'] = $this->DataMaster->get('kelas');
                $this->template->load('template/layout', 'staff/users/siswa', $data);
            } else {
                if($_FILES['foto']){
                    $foto = $_FILES['foto'];
                    if ($foto['name'] == '') {
                        if($this->input->post('pict')) {
                            $foto = $this->input->post('pict');
                        } else {
                            $this->session->set_flashdata('error', 'Foto Kosong!');
                            redirect('staff/user/siswa');
                        }
                    } else {
                        $config['upload_path']  = './foto';
                        $config['allowed_types'] = 'jpg|png|gif|jpeg';
                        // $config['max_size'] = '2048';
    
                        $this->load->library('upload', $config);
    
                        if (!$this->upload->do_upload('foto')) {
                            $this->session->set_flashdata('error', 'Foto Kosong!');
                            redirect('staff/user/siswa');
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
    
                    $this->DataMaster->update('users', $data, $where);
                    $this->session->set_flashdata('success', 'Data User Guru Berhasil Diedit!');
                    redirect('staff/user/siswa');
                } elseif($destroy) {
                //HAPUS
                    $where = [
                        'id_user' => $destroy
                    ];
                    $this->DataMaster->delete('users', $where);
                    $this->session->set_flashdata('success', 'Data Berhasil Dihapus');
                    redirect('staff/user/siswa');
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
                    $this->DataMaster->create('users', $data);
                    $this->session->set_flashdata('success', 'Data User Guru Berhasil Ditambahkan!');
                    redirect('staff/user/siswa');
                }
            }
        } elseif($id == 'guru')
        {
            $this->form_validation->set_rules('username', 'Username', 'required');
            if ($this->form_validation->run() == false) {
                $data['users'] = $this->DataMaster->get_list_guru();
                $data['matpel'] = $this->DataMaster->get('matpel');
                $this->template->load('template/layout', 'staff/users/guru', $data);
            } else {
                if($_FILES['foto']){
                    $foto = $_FILES['foto'];
                    if ($foto['name'] == '') {
                        if($this->input->post('pict')) {
                            $foto = $this->input->post('pict');
                        } else {
                            $this->session->set_flashdata('error', 'Foto Kosong!');
                            redirect('staff/user/guru');
                        }
                    } else {
                        $config['upload_path']  = './foto';
                        $config['allowed_types'] = 'jpg|png|gif|jpeg';
                        // $config['max_size'] = '2048';
    
                        $this->load->library('upload', $config);
    
                        if (!$this->upload->do_upload('foto')) {
                            $this->session->set_flashdata('error', 'Foto Kosong!');
                            redirect('staff/user/guru');
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
                            'id_matpel' => $this->input->post('id_matpel'),
                            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                            'pict' => $foto,
                            'role' => '3'
                        ];
                    } else {
                        $data = [
                            'username' => $this->input->post('username'),
                            'nik' => $this->input->post('nik'),
                            'phone' => $this->input->post('no_telp'),
                            'id_matpel' => $this->input->post('id_matpel'),
                            'pict' => $foto,
                            'role' => '3'
                        ];
                    }
                    $where = [
                        'id_user' => $id_user
                    ];
    
                    $this->DataMaster->update('users', $data, $where);
                    $this->session->set_flashdata('success', 'Data User Guru Berhasil Diedit!');
                    redirect('staff/user/guru');
                } elseif($destroy) {
                //HAPUS
                    $where = [
                        'id_user' => $destroy
                    ];
                    $this->DataMaster->delete('users', $where);
                    $this->session->set_flashdata('success', 'Data Berhasil Dihapus');
                    redirect('staff/user/guru');
                } else {
                //CREATE
                    if($this->input->post('password') != '') {
                        $data = [
                            'username' => $this->input->post('username'),
                            'nik' => $this->input->post('nik'),
                            'phone' => $this->input->post('no_telp'),
                            'id_matpel' => $this->input->post('id_matpel'),
                            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                            'pict' => $foto,
                            'role' => '3',
                        ];
                    } else {
                        $data = [
                            'username' => $this->input->post('username'),
                            'nik' => $this->input->post('nik'),
                            'phone' => $this->input->post('no_telp'),
                            'id_matpel' => $this->input->post('id_matpel'),
                            'pict' => $foto,
                            'role' => '3',
                        ];
                    }
    
                    $this->DataMaster->create('users', $data);
                    $this->session->set_flashdata('success', 'Data User Guru Berhasil Ditambahkan!');
                    redirect('staff/user/guru');
                }
                
            }
        } elseif($id == 'kepala_bimba')
        {
            $this->form_validation->set_rules('username', 'Username', 'required');
            if ($this->form_validation->run() == false) {
                $data['users'] = $this->DataMaster->get_list_kepala_bimba();
                $this->template->load('template/layout', 'staff/users/kepala_bimba', $data);
            } else {
                if($_FILES['foto']){
                    $foto = $_FILES['foto'];
                    if ($foto['name'] == '') {
                        if($this->input->post('pict')) {
                            $foto = $this->input->post('pict');
                        } else {
                            $this->session->set_flashdata('error', 'Foto Kosong!');
                            redirect('staff/user/kepala_bimba');
                        }
                    } else {
                        $config['upload_path']  = './foto';
                        $config['allowed_types'] = 'jpg|png|gif|jpeg';
                        // $config['max_size'] = '2048';
    
                        $this->load->library('upload', $config);
    
                        if (!$this->upload->do_upload('foto')) {
                            $this->session->set_flashdata('error', 'Foto Kosong!');
                            redirect('staff/user/kepala_bimba');
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
                            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                            'pict' => $foto,
                            'role' => '4'
                        ];
                    } else {
                        $data = [
                            'username' => $this->input->post('username'),
                            'nik' => $this->input->post('nik'),
                            'phone' => $this->input->post('no_telp'),
                            'pict' => $foto,
                            'role' => '4'
                        ];
                    }
                    $where = [
                        'id_user' => $id_user
                    ];
    
                    $this->DataMaster->update('users', $data, $where);
                    $this->session->set_flashdata('success', 'Data User Guru Berhasil Diedit!');
                    redirect('staff/user/kepala_bimba');
                } elseif($destroy) {
                //HAPUS
                    $where = [
                        'id_user' => $destroy
                    ];
                    $this->DataMaster->delete('users', $where);
                    $this->session->set_flashdata('success', 'Data Berhasil Dihapus');
                    redirect('staff/user/kepala_bimba');
                } else {
                //CREATE
                    if($this->input->post('password') != '') {
                        $data = [
                            'username' => $this->input->post('username'),
                            'nik' => $this->input->post('nik'),
                            'phone' => $this->input->post('no_telp'),
                            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                            'pict' => $foto,
                            'role' => '4',
                        ];
                    } else {
                        $data = [
                            'username' => $this->input->post('username'),
                            'nik' => $this->input->post('nik'),
                            'phone' => $this->input->post('no_telp'),
                            'pict' => $foto,
                            'role' => '4',
                        ];
                    }
    
                    $this->DataMaster->create('users', $data);
                    $this->session->set_flashdata('success', 'Data User Guru Berhasil Ditambahkan!');
                    redirect('staff/user/kepala_bimba');
                }
                
            }

        } elseif($id == 'wali_kelas')
        {
            $this->form_validation->set_rules('username', 'Username', 'required');
            if ($this->form_validation->run() == false) {
                $data['users'] = $this->DataMaster->get_list_wali_kelas();
                $data['kelas'] = $this->DataMaster->get('kelas');
                $this->template->load('template/layout', 'staff/users/wali_kelas', $data);
            } else {
                if($_FILES['foto']){
                    $foto = $_FILES['foto'];
                    if ($foto['name'] == '') {
                        if($this->input->post('pict')) {
                            $foto = $this->input->post('pict');
                        } else {
                            $this->session->set_flashdata('error', 'Foto Kosong!');
                            redirect('staff/user/wali_kelas');
                        }
                    } else {
                        $config['upload_path']  = './foto';
                        $config['allowed_types'] = 'jpg|png|gif|jpeg';
                        // $config['max_size'] = '2048';
    
                        $this->load->library('upload', $config);
    
                        if (!$this->upload->do_upload('foto')) {
                            $this->session->set_flashdata('error', 'Foto Kosong!');
                            redirect('staff/user/wali_kelas');
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
                            'role' => '5'
                        ];
                    } else {
                        $data = [
                            'username' => $this->input->post('username'),
                            'nik' => $this->input->post('nik'),
                            'phone' => $this->input->post('no_telp'),
                            'kelas_id' => $this->input->post('id_kelas'),
                            'pict' => $foto,
                            'role' => '5'
                        ];
                    }
                    $where = [
                        'id_user' => $id_user
                    ];
    
                    $this->DataMaster->update('users', $data, $where);
                    $this->session->set_flashdata('success', 'Data User Guru Berhasil Diedit!');
                    redirect('staff/user/wali_kelas');
                } elseif($destroy) {
                //HAPUS
                    $where = [
                        'id_user' => $destroy
                    ];
                    $this->DataMaster->delete('users', $where);
                    $this->session->set_flashdata('success', 'Data Berhasil Dihapus');
                    redirect('staff/user/wali_kelas');
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
                            'role' => '5',
                        ];
                    } else {
                        $data = [
                            'username' => $this->input->post('username'),
                            'nik' => $this->input->post('nik'),
                            'phone' => $this->input->post('no_telp'),
                            'kelas_id' => $this->input->post('id_kelas'),
                            'pict' => $foto,
                            'role' => '5',
                        ];
                    }
                    $this->DataMaster->create('users', $data);
                    $this->session->set_flashdata('success', 'Data User Guru Berhasil Ditambahkan!');
                    redirect('staff/user/wali_kelas');
                }
            }
        }
    }

    //MENU TARIF SPP
    public function tarif_spp()
    {
        $this->form_validation->set_rules('bulan', 'bulan', 'required');
            if ($this->form_validation->run() == false) {
                $data['kelas'] = $this->DataMaster->get('kelas');

                $data['table'] = [
                    'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                ];
                $this->template->load('template/layout', 'staff/tarif_spp/index', $data);
            } else {
                $pilihan = $this->input->post('pilihan_tarif');
                $id_kelas = $this->input->post('id_kelas');
                $harga = $this->input->post('harga');
                $bulan = $this->input->post('bulan');
                $keterangan = $this->input->post('keterangan');
                $id_tarif = $this->input->post('id_tarif');
                $destroy = $this->input->post('destroy');
                
                // var_dump($id_tarif);die;
                //INSERT DATA TARIF
                if($pilihan)
                {
                    if($pilihan == "Tidak")
                    {
                        foreach ($id_kelas as $key => $value) {
    
                            $data = [
                                'bulan'      => $bulan,
                                'harga'      => $harga,
                                'id_kelas'   => $value,
                                'keterangan' => $keterangan,
                            ];
                            $this->DataMaster->create('tarif_spp', $data);
                        }
                        $this->session->set_flashdata('success', 'Berhasil Mengatur Tarif SPP');
                        redirect('staff/tarif_spp');
                    } else {
                        try {
                            $this->db->trans_begin();
                            $data_kelas = [];
                            $data_keterangan = [];
            
                            foreach ($id_kelas as $k => $v) {
                                $data_kelas[] = [
                                    'id_kelas' => $v
                                ];
                            }
            
                            foreach ($harga as $key => $value) {
                                $data_harga[] = [
                                    'bulan' => $bulan,
                                    'harga' => $value
                                ];
                            }
            
                            foreach ($keterangan as $k => $v) {
                                $data_harga[$k]['keterangan'] = $v;
                            }
            
                            foreach ($data_kelas as $k => $v) {
                                $data_harga[$k]['id_kelas'] = $v['id_kelas'];
                            }
            
                            $this->db->insert_batch('tarif_spp', $data_harga);
                            $this->db->trans_commit();
                            $this->session->set_flashdata('success', 'Berhasil Mengatur Tarif SPP');
                            redirect('staff/tarif_spp');
                        } catch (\Throwable $th) {
                            // throw $th;
                            $this->db->trans_rollback();
                            $this->session->set_flashdata('error', 'Gagal Mengatur Tarif SPP');
                            redirect('staff/tarif_spp');
                        }
                    }
                }

                //EDIT DATA TARIF
                if($id_tarif)
                {
                    try {
                        $this->db->trans_begin();
                        for($i=0; $i < count($id_tarif); $i++) {
                            $where = [
                                'id_tarif_spp' => $id_tarif[$i]
                            ];

                            $data = [
                                'bulan' => $bulan,
                                'id_kelas' => $id_kelas[$i],
                                'harga' => $harga[$i],
                                'keterangan' => $keterangan[$i],
                            ];
                            $this->DataMaster->update('tarif_spp', $data, $where);
                        }
        
                        $this->db->trans_commit();
                        $this->session->set_flashdata('success', 'Berhasil Update Tarif SPP');
                        redirect('staff/tarif_spp');
                    } catch (\Throwable $th) {
                        // throw $th;
                        $this->db->trans_rollback();
                        $this->session->set_flashdata('error', 'Gagal Update Tarif SPP');
                        redirect('staff/tarif_spp');
                    }
                }
                
                //DELETE DATA
                if($destroy) {
                    try {
                        //code...
                        $id = [
                            'bulan' => $destroy
                        ];
                        $this->DataMaster->delete('tarif_spp', $id);
                        $this->session->set_flashdata('success', 'Berhasil Delete Tarif SPP');
                        redirect('staff/tarif_spp');
                    } catch (\Throwable $th) {
                        //throw $th;
                        $this->session->set_flashdata('error', 'Gagal Delete Tarif SPP');
                        redirect('staff/tarif_spp');
                    }
                }
            }
    }
    
    //MENU RIWAYAT PEMBAYARAN SPP
    public function riwayat_pembayaran_spp()
    {
        $data['pembayaran'] = $this->DataMaster->get('pembayaran');
        $this->template->load('template/layout', 'staff/riwayat_pembayaran_spp/index', $data);
    }
}
