<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Model_user', 'user');
    }

    public function login()
    {
        redirect('login.aspx');
    }
    public function loginNew()
    {
        $this->load->view('auth/login');
    }


    public function register()
    {
        $this->load->view('auth/register');
    }

    public function signup()
    {
        $nik = $this->input->post('nik');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $confirmPassword = $this->input->post('confirmPassword');

        try {
            //code...
            if($password != $confirmPassword) {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Password Tidak Match!</div>');
                redirect('auth/register');
            } else {
                $this->db->insert('users', [
                    'nik' => $nik,
                    'username' => $username,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'is_active' => 1,
                    'role' => 1,
                ]);
                redirect('auth/loginNew');
            }
        } catch (\Throwable $th) {
            //throw $th;
                $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Server Error!</div>');
                redirect('auth/register');
        }
    }

    public function signin()
    {
        $nik = $this->input->post('nik');
        $password = $this->input->post('password');

        $users = $this->db->get_where('users', ['nik' => $nik])->row();

        if($users) {
            if(password_verify($password, $users->password))
            {
                $session = [
                    'id'        => $users->id_user,
                    'username'   => $users->username,
                    'nik'       => $users->nik,
                    'no_telp'   => $users->no_telp,
                    'id_matpel' => $users->id_matpel ? $users->id_matpel : null,
                    'kelas_id'  => $users->kelas_id ? $users->kelas_id : null,
                    'role'      => $users->role,
                    'foto'      => $users->foto,
                ];
                $this->session->set_userdata($session);

                if($users->role == 1) {
                    redirect('staff');
                }
            }
        }
    }
}
