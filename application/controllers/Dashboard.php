<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    const ROLE_ADMIN = 1;
    const ROLE_PIC_KELAS = 2;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Kelas_m");
        $this->load->model("Aspek_m");
    }

    private function check_access()
    {
         // Cek apakah pengguna sudah login
         if (!$this->session->userdata('user_id')) {
            show_error('You must be logged in to access this page.', 403, 'Access Denied');
            exit;  // Menghentikan eksekusi jika tidak login
        }

        // Ambil role dari session
        $role = $this->session->userdata('role');
        $method = $this->router->fetch_method(); // Ambil nama metode yang diakses

        // Daftar metode yang diperbolehkan berdasarkan role
        $allowed_methods = [
            self::ROLE_ADMIN => ['index', 'tambah', 'pilih_kls','competition','myclass'],
            self::ROLE_PIC_KELAS => ['index', 'tambah', 'pilih_kls','competition','class'],
        ];

        // Periksa apakah metode yang diakses sesuai dengan role
        if (!in_array($method, $allowed_methods[$role])) {
            $this->session->set_flashdata('error', 'You do not have permission to access this page.');
            redirect('no_permission');
        }
    }

    public function index()
    {
        $data = $this->prepare_user_data('Dashboard 5K2S'); 
        $this->check_access();
        $data = $this->prepare_user_data('Dashboard 5K2S');
        $this->load->view("layout/header_dash", $data);
        $this->load->view("layout/sidebar_admin", $data);
        $this->load->view("dashboard/index", $data);
        $this->load->view("layout/footer_dash");
    }

    public function competition()
    {
        $this->check_access();
        $data['competisi'] = $this->Kelas_m->Getalldata()->result();
        $data['aspek'] = $this->Aspek_m->Getalldata()->result();
        // $data = $this->prepare_user_data('Competition 5K2S');
        $this->load->view("layout/header_dash", $data);
        $this->load->view("layout/sidebar_admin", $data);
        $this->load->view("competition/index",$data);
        $this->load->view("layout/footer_dash");
    }

    public function myclass()
    {
        $this->check_access();
        $data = $this->prepare_user_data('Class 5K2S');
        $this->load->view("layout/header_dash", $data);
        $this->load->view("layout/sidebar_admin", $data);
        $this->load->view("class/index", $data);
        $this->load->view("layout/footer_dash");
    }

    private function prepare_user_data($title)
    {
        return [
            'title' => $title,
            'username' => $this->session->userdata('username'),
            'role' => $this->session->userdata('role'),
        ];
    }

   public function logout()
    {
        // Hancurkan sesi
        $this->session->sess_destroy();

        // Set pesan sukses dan redirect ke login
        $this->session->set_flashdata('success', 'You have successfully logged out.');

        // Redirect ke halaman login
        redirect('login/index');
    }

    

}
