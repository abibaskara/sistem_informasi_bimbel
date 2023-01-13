<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_data_siswa', 'DataSiswa');
    }

    public function index()
    {
        $this->template->load('template/layout', 'siswa/index');
    }

    public function riwayat_pembayaran_spp()
    {
        $this->form_validation->set_rules('bulan', 'bulan', 'required');
        if ($this->form_validation->run() == false) {
            $data['data'] = $this->DataSiswa->get_riwayat_pembayaran_siswa();
            $data['bulan'] = [
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
            $this->template->load('template/layout', 'siswa/riwayat_pembayaran/index', $data);
        } else {
            $edit = $this->input->post('edit');
            if($edit) {
                try {
                    //code...
                    $this->db->trans_begin();
                    $bulan = $this->input->post('bulan');
                    $grandtotal = $this->input->post('grandtotal');
                    $jumlah = $this->input->post('jumlah');

                    $bukti_bayar = $_FILES['bukti_bayar'];
                    if ($bukti_bayar = '') {
                    } else {
                        $config['upload_path']  = './bukti_bayar';
                        $config['allowed_types'] = 'jpg|png|gif|jpeg';
                        // $config['max_size'] = '2048';

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('bukti_bayar')) {
                            echo $this->upload->display_errors();
                            die();
                        } else {
                            $bukti_bayar = $this->upload->data('file_name');
                        }
                    }
                    $sisa_bayar = $grandtotal - $jumlah;

                    if ($sisa_bayar == 0) {
                        $status = 'Lunas';
                    } else {
                        $status = 'Dicicil';
                    }
                    $data_pembayaran = [
                        'id_user' => $this->session->id,
                        'bulan' => $bulan,
                        'grandtotal' => $grandtotal,
                        'sisa_bayar' => $sisa_bayar,
                        'status' => $status
                    ];

                    $this->DataSiswa->update('pembayaran', $data_pembayaran, ['id_pembayaran' => $edit]);

                    $data_detail_pembayaran = [
                        'id_pembayaran' => $edit,
                        'jumlah'      => $jumlah,
                        'bukti_bayar' => $bukti_bayar,
                        'tgl_bayar'   => date('Y-m-d'),
                    ];

                    $this->DataSiswa->create('detail_pembayaran', $data_detail_pembayaran);
                    $this->db->trans_commit();
                    $this->session->set_flashdata('success', 'Pembayaran Anda Berhasil!');
                    redirect('siswa/riwayat_pembayaran_spp');
                } catch (\Throwable $th) {
                    //throw $th;
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('error', 'Gagal Pembayaran!');
                    redirect('siswa/riwayat_pembayaran_spp');
                }
            } else {
                try {
                    //code...
                    $this->db->trans_begin();
                    $bulan = $this->input->post('bulan');
                    $grandtotal = $this->input->post('grandtotal');
                    $jumlah = $this->input->post('jumlah');

                    $bukti_bayar = $_FILES['bukti_bayar'];
                    if ($bukti_bayar = '') {
                    } else {
                        $config['upload_path']  = './bukti_bayar';
                        $config['allowed_types'] = 'jpg|png|gif|jpeg';
                        // $config['max_size'] = '2048';

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('bukti_bayar')) {
                            echo $this->upload->display_errors();
                            die();
                        } else {
                            $bukti_bayar = $this->upload->data('file_name');
                        }
                    }
                    $sisa_bayar = $grandtotal - $jumlah;

                    if ($sisa_bayar == 0) {
                        $status = 'Lunas';
                    } else {
                        $status = 'Dicicil';
                    }
                    $data_pembayaran = [
                        'id_user' => $this->session->id,
                        'bulan' => $bulan,
                        'grandtotal' => $grandtotal,
                        'sisa_bayar' => $sisa_bayar,
                        'status' => $status
                    ];

                    $this->DataSiswa->create('pembayaran', $data_pembayaran);
                    $id = $this->db->insert_id();

                    $data_detail_pembayaran = [
                        'id_pembayaran' => $id,
                        'jumlah'      => $jumlah,
                        'bukti_bayar' => $bukti_bayar,
                        'tgl_bayar'   => date('Y-m-d'),
                    ];

                    $this->DataSiswa->create('detail_pembayaran', $data_detail_pembayaran);
                    $this->db->trans_commit();
                    $this->session->set_flashdata('success', 'Pembayaran Anda Berhasil!');
                    redirect('siswa/riwayat_pembayaran_spp');
                } catch (\Throwable $th) {
                    //throw $th;
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('error', 'Gagal Pembayaran!');
                    redirect('siswa/riwayat_pembayaran_spp');
                }
            }
            
        }
    }

    public function get_grandtotal()
    {
        $bulan = $this->input->get('bulan');
        $id_kelas = $this->input->get('id_kelas');
        $where = [
            'bulan' => $bulan,
            'id_kelas' => $id_kelas,
        ];
        $data = $this->DataSiswa->get_where('tarif_spp', $where);
        $grandtotal = (isset($data->harga) ? $data->harga : '0');

        echo json_encode([
            'status' => true,
            'grandtotal' => $grandtotal
        ]);
    }

    public function nota($id)
    {
        $where = [
            'id_pembayaran' => $id
        ];
        $data = [
            'pembayaran' => $this->DataSiswa->get_where_many('pembayaran', $where),
            'user' => $this->DataSiswa->user($this->session->id),
            'id' => $id
        ];
        $this->template->load('template/layout', 'siswa/nota', $data);
    }

    public function nilai()
    {
        $data['nilai'] = $this->DataSiswa->get_nilai($this->session->id);
        $this->template->load('template/layout', 'siswa/nilai/index', $data);
    }

    public function jenjang_sekolah_formal()
    {
        $this->form_validation->set_rules('nama_sekolah', 'nama_sekolah', 'required');
        if ($this->form_validation->run() == false) {
            $data['data'] = $this->DataSiswa->get_jenjang_sekolah();
            $this->template->load('template/layout', 'siswa/jenjang_sekolah/index', $data);
        } else {
            $edit = $this->input->post('edit');
            if($edit) {
                try {
                    //code...
                    $this->db->trans_begin();
                    $bulan = $this->input->post('bulan');
                    $grandtotal = $this->input->post('grandtotal');
                    $jumlah = $this->input->post('jumlah');

                    $bukti_bayar = $_FILES['bukti_bayar'];
                    if ($bukti_bayar = '') {
                    } else {
                        $config['upload_path']  = './bukti_bayar';
                        $config['allowed_types'] = 'jpg|png|gif|jpeg';
                        // $config['max_size'] = '2048';

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('bukti_bayar')) {
                            echo $this->upload->display_errors();
                            die();
                        } else {
                            $bukti_bayar = $this->upload->data('file_name');
                        }
                    }
                    $sisa_bayar = $grandtotal - $jumlah;

                    if ($sisa_bayar == 0) {
                        $status = 'Lunas';
                    } else {
                        $status = 'Dicicil';
                    }
                    $data_pembayaran = [
                        'id_user' => $this->session->id,
                        'bulan' => $bulan,
                        'grandtotal' => $grandtotal,
                        'sisa_bayar' => $sisa_bayar,
                        'status' => $status
                    ];

                    $this->DataSiswa->update('pembayaran', $data_pembayaran, ['id_pembayaran' => $edit]);

                    $data_detail_pembayaran = [
                        'id_pembayaran' => $edit,
                        'jumlah'      => $jumlah,
                        'bukti_bayar' => $bukti_bayar,
                        'tgl_bayar'   => date('Y-m-d'),
                    ];

                    $this->DataSiswa->create('detail_pembayaran', $data_detail_pembayaran);
                    $this->db->trans_commit();
                    $this->session->set_flashdata('success', 'Pembayaran Anda Berhasil!');
                    redirect('siswa/riwayat_pembayaran_spp');
                } catch (\Throwable $th) {
                    //throw $th;
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('error', 'Gagal Pembayaran!');
                    redirect('siswa/riwayat_pembayaran_spp');
                }
            } else {
                try {
                    //code...
                    $this->db->trans_begin();
                    $bulan = $this->input->post('bulan');
                    $grandtotal = $this->input->post('grandtotal');
                    $jumlah = $this->input->post('jumlah');

                    $bukti_bayar = $_FILES['bukti_bayar'];
                    if ($bukti_bayar = '') {
                    } else {
                        $config['upload_path']  = './bukti_bayar';
                        $config['allowed_types'] = 'jpg|png|gif|jpeg';
                        // $config['max_size'] = '2048';

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('bukti_bayar')) {
                            echo $this->upload->display_errors();
                            die();
                        } else {
                            $bukti_bayar = $this->upload->data('file_name');
                        }
                    }
                    $sisa_bayar = $grandtotal - $jumlah;

                    if ($sisa_bayar == 0) {
                        $status = 'Lunas';
                    } else {
                        $status = 'Dicicil';
                    }
                    $data_pembayaran = [
                        'id_user' => $this->session->id,
                        'bulan' => $bulan,
                        'grandtotal' => $grandtotal,
                        'sisa_bayar' => $sisa_bayar,
                        'status' => $status
                    ];

                    $this->DataSiswa->create('pembayaran', $data_pembayaran);
                    $id = $this->db->insert_id();

                    $data_detail_pembayaran = [
                        'id_pembayaran' => $id,
                        'jumlah'      => $jumlah,
                        'bukti_bayar' => $bukti_bayar,
                        'tgl_bayar'   => date('Y-m-d'),
                    ];

                    $this->DataSiswa->create('detail_pembayaran', $data_detail_pembayaran);
                    $this->db->trans_commit();
                    $this->session->set_flashdata('success', 'Pembayaran Anda Berhasil!');
                    redirect('siswa/riwayat_pembayaran_spp');
                } catch (\Throwable $th) {
                    //throw $th;
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('error', 'Gagal Pembayaran!');
                    redirect('siswa/riwayat_pembayaran_spp');
                }
            }
            
        }
    }
}