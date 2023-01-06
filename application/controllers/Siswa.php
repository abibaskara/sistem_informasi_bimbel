<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_data_master', 'DataMaster');
    }

    public function index()
    {
        $this->template->load('template/layout', 'siswa/index');
    }

    public function riwayat_pembayaran_spp()
    {
        
    }
}