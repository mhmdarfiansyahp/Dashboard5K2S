<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct() {
        parent::__construct();
        $this->load->model('User_m');
        $this->load->library('session');
    }


    public function index()
    {
        $this->load->view("login");
    }


    public function process_login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->User_m->check_user($email, $password);

        if ($user) {
            // Jika berhasil, set session atau lakukan tindakan lain sesuai kebutuhan aplikasi Anda
            $this->session->set_userdata('logged_in', true);
            $this->session->set_userdata('user_id', $user->id);

            // Redirect ke halaman dashboard atau halaman lainnya
            redirect('dashboard');
        } else {
            // Jika gagal, kembali ke halaman login dengan pesan error
            $this->session->set_flashdata('error', 'Email atau password salah');
            redirect('login');
        }
    }

    public function logout() {
        // Hapus semua data session
        $this->session->sess_destroy();
        redirect('login');
    }
}
