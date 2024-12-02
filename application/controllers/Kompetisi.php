<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kompetisi extends CI_Controller
{
    const ROLE_ADMIN = 1;
    const ROLE_PIC_KELAS = 2;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Kelas_m");
        $this->check_access();  // Panggil fungsi pengecekan akses
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
            self::ROLE_ADMIN => ['index', 'tambah', 'pilih_kls'],
            self::ROLE_PIC_KELAS => ['index', 'tambah', 'pilih_kls'],
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
        $this->load->view("layout/header_dash");
        $this->load->view("layout/sidebar_admin");
        $this->load->view("competition/index");
        $this->load->view("layout/footer_dash");
    }

    public function tambah()
    {
        
        $data = $this->prepare_user_data('Dashboard 5K2S'); 
        $this->check_access();  
        $this->load->view("layout/header_dash", $data);
        $this->load->view("layout/sidebar_admin", $data);
        $this->load->view("competition/tambah", $data);
        $this->load->view("layout/footer_dash");
    }

    public function pilih_kls()
    {
        $data = $this->prepare_user_data('Dashboard 5K2S'); 
        $this->check_access();  
        $data['kompetisi'] = $this->Kelas_m->Getalldata()->result();
        $this->load->view("layout/header_dash");
        $this->load->view("layout/sidebar_admin", $data);
        $this->load->view("competition/pilih_kls", $data);
        $this->load->view("layout/footer_dash");
    }

    public function myclass()
    {
        
        $this->check_access();  
        $data['title'] = 'Competition 5K2S';
        $this->load->view("layout/header_dash");
        $this->load->view("layout/sidebar_admin");
        $this->load->view("competition/index");
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
}
