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

    public function kelas()
    {
        $data['data'] = $this->DataMaster->get('kelas');
        $this->template->load('template/layout', 'staff/kelas/index', $data);
    }
}
