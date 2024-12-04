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
            self::ROLE_PIC_KELAS => ['index', 'tambah', 'pilih_kls','competition','myclass'],
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
        $this->load->view("layout/header_dash", $data);
        $this->load->view("layout/sidebar_admin", $data);
        $this->load->view("dashboard/index", $data);
        $this->load->view("layout/footer_dash");
    }

    public function competition()
    {
        
        $data = $this->prepare_user_data('Dashboard 5K2S'); 
        $this->check_access();
        $data['competisi'] = $this->Kelas_m->Getalldata()->result();
        $data['aspek'] = $this->Aspek_m->Getalldata()->result();
        $this->load->view("layout/header_dash", $data);
        $this->load->view("layout/sidebar_admin", $data);
        $this->load->view("competition/index",$data);
        $this->load->view("layout/footer_dash");
    }

    public function myclass()
    {
        // Memeriksa akses pengguna
        $this->check_access();
        $user_role = (int) $this->session->userdata('role');
        
        // Menyiapkan data untuk view
        $data = $this->prepare_user_data('Kelas 5K2S'); 
        
        if ($user_role == 2) {
            // Mengambil ID pengguna dari session
            $user_id = (int) $this->session->userdata('user_id');
            
            // Memuat model
            $this->load->model('Kelas_m');
            $this->load->model('Aspek_m');
            
            // Ambil data kelas berdasarkan user_id
            $kelas_data = $this->Kelas_m->GetDataByUserId($user_id);
            
            // Validasi apakah data kelas kosong
            if (empty($kelas_data)) {
                $kelas_data = [];
            }
            
            // Iterasi setiap kelas untuk mendapatkan aspek
            $kelas_with_aspek = [];
            foreach ($kelas_data as $kelas) {
                // Ambil aspek berdasarkan id kelas
                $aspek_data = $this->Aspek_m->GetDataByKelasId($kelas->id_kelas);
                
                // Validasi apakah data aspek kosong
                if (empty($aspek_data)) {
                    $aspek_data = [];
                }
                
                // Masukkan data kelas dan aspek ke dalam array
                $kelas_with_aspek[] = [
                    'kelas' => $kelas,
                    'aspek' => $aspek_data,
                ];
            }
            
            // Siapkan data untuk view
            $data['kelas_with_aspek'] = $kelas_with_aspek;
            
            // Memuat view dengan data
            $this->load->view("layout/header_dash", $data);
            $this->load->view("layout/sidebar_admin", $data);
            $this->load->view("class/index", $data); 
            $this->load->view("layout/footer_dash");
        }
        else
        {
            $this->load->model('Kelas_m'); 
            $kelas['kelas'] = $this->Kelas_m->GetalldataArray();
            
            // Memuat view dengan data
            $this->load->view("layout/header_dash", $data);
            $this->load->view("layout/sidebar_admin", $data);
            $this->load->view("class/index", $kelas);
            $this->load->view("layout/footer_dash");
        }
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
