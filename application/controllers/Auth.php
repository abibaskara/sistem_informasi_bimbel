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

        $users = $this->db->select('*')->from('users')->where('nik', $nik)->or_where('email', $nik)->join('pendaftaran', 'pendaftaran.id_user=users.id_user', 'left')->get()->row();

        if($users) {
            if(password_verify($password, $users->password))
            {
                $session = [
                    'id'        => $users->id_user,
                    'username'   => $users->username,
                    'nik'       => $users->nik,
                    'phone'   => $users->phone,
                    'id_matpel' => $users->id_matpel ? $users->id_matpel : null,
                    'kelas_id'  => $users->kelas_id ? $users->kelas_id : null,
                    'role'      => $users->role,
                    'pict'      => $users->pict,
                    'status' => $users->status,
                ];
                $this->session->set_userdata($session);

                if($users->role == 1) {
                    redirect('staff');
                } elseif($users->role == 2) {
                    redirect('siswa');
                } elseif($users->role == 3) {
                    redirect('guru');
                } elseif($users->role == 4) {
                    redirect('kepala_bimba');
                } elseif($users->role == 5) {
                    redirect('wali_kelas');
                }
            } else {
                $this->session->set_flashdata('error', 'Password Anda Salah');
                redirect('auth/loginNew');
            }
        } else {
            $this->session->set_flashdata('info', 'User Tidak Ditemukan');
            redirect('auth/loginNew');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('role');
        session_unset();
        session_destroy();
        redirect('auth/loginNew');
    }

    public function get_captcha()
    {
        $vals = array(
            'word'          => substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5),
            'img_path'      => './app-assets/images/captcha/',
            'img_url'       => site_url('app-assets/images/captcha'),
            'img_width'     => 200,
            'img_height'    => 50,
            'expiration'    => 7200,
            'word_length'   => 5,
            'font_size'     => 20,
            'img_id'        => 'Imageid',
            'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

            'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
            )
        );
        $captcha = create_captcha($vals);
        $this->session->set_userdata('captcha', $captcha['word']);
        echo json_encode([
            'captcha' => $captcha['image'],
            'status' => true,
        ]);
    }

    public function daftar_siswa()
    {
        // echo 'test';die;
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $jk = $this->input->post('jenis_kelamin');
        $tempat_lahir = $this->input->post('tempat_lahir');
        $alamat = $this->input->post('alamat');
        // $no_hp = $this->input->post('no_hp');
        $password = $this->input->post('password');
        $post_captcha = $this->input->post('captcha');
        $captcha    = $this->session->userdata('captcha');
        try {
            //code...
            if($post_captcha == $captcha) {
                $this->db->trans_begin();
                $data = [
                    'username' => $username,
                    'role' => 2,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'status' => 1
                ];
    
                $this->db->insert('users', $data);
                $id = $this->db->insert_id();
    
                $data_pendaftaran = [
                    'id_user' => $id,
                    'email' => $email,
                    'jenis_kelamin' => $jk
                ];
    
                $this->db->insert('pendaftaran', $data_pendaftaran);
    
                
                $this->db->trans_commit();
                $this->session->set_flashdata('success', 'Pendaftaran Berhasil, Silahkan Login dan Lengkapi Data Diri Anda');
                redirect('auth/loginNew');
            } else {
                $this->session->set_flashdata('error', 'Captcha Anda Salah');
                redirect('auth/register');
            }
        } catch (\Throwable $th) {
            //throw $th;
            $this->session->set_flashdata('erro', 'Pendaftaran Gagal');
            redirect('auth/loginNew');
        }

        
    }
}
