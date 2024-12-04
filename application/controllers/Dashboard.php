<?php

defined('BASEPATH') or exit('No direct script access allowed');

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
            self::ROLE_ADMIN => ['index', 'tambah', 'competition', 'myclass'],
            self::ROLE_PIC_KELAS => ['index', 'tambah', 'competition', 'myclass']
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

        $currentMonth = date('m');
        $currentYear = date('Y');
        $previousMonth = $currentMonth == 1 ? 12 : $currentMonth - 1;
        $previousYear = $currentMonth == 1 ? $currentYear - 1 : $currentYear;

        $userId = $this->session->userdata('user_id');  

        $data['chartData'] = $this->Aspek_m->get_total_score_per_class($currentMonth, $currentYear);
        $data['currentStanding'] = $this->Aspek_m->get_total_score_per_class($currentMonth, $currentYear);
        $data['lastStanding'] = $this->Aspek_m->get_total_score_per_class($previousMonth, $previousYear);

        $userClasses = $this->Aspek_m->get_user_classes($userId);  

        $data['currentRank'] = [];
        $data['lastRank'] = [];

        foreach ($data['currentStanding'] as $key => $class) {
            if (in_array($class['nama_kelas'], $userClasses)) {
                $data['currentRank'][$class['nama_kelas']] = $key + 1; 
            }
        }

        foreach ($data['lastStanding'] as $key => $class) {
            if (in_array($class['nama_kelas'], $userClasses)) {
                $data['lastRank'][$class['nama_kelas']] = $key + 1; 
            }
        }

        $this->load->view("layout/header_dash", $data);
        $this->load->view("layout/sidebar_admin", $data);
        $this->load->view("dashboard/index", $data);
        $this->load->view("layout/footer_dash", $data);
    }

    public function competition()
    {
        $data = $this->prepare_user_data('Dashboard 5K2S');
        $this->check_access();

        // Ambil user_id dari session
        $user_id = $this->session->userdata('user_id');

        // Cek apakah user_id ada di session
        if (!$user_id) {
            show_error('Anda harus login terlebih dahulu.', 403);
        }

        // Ambil data kompetisi, ini tetap mengambil semua data kelas
        $data['competisi'] = $this->Kelas_m->GetAvailableClassesForUser($user_id); // Mengambil kelas yang belum dipilih oleh user
        $data['competisi2'] = $this->Kelas_m->Getalldata()->result();

        // Ambil data aspek yang sesuai dengan id_user
        $data['aspek'] = $this->Aspek_m->GetDataByUserId($user_id);  // Ambil data aspek berdasarkan user_id

        // Load view
        $this->load->view("layout/header_dash", $data);
        $this->load->view("layout/sidebar_admin", $data);
        $this->load->view("competition/index", $data);
        $this->load->view("layout/footer_dash");
    }


    public function myclass()
    {
        // Memeriksa akses pengguna
        $this->check_access();
        // $user_role = (int) $this->session->userdata('role');

        $data = $this->prepare_user_data('Kelas 5K2S');

        $this->load->model('Kelas_m');
        $this->load->model('Aspek_m');

        $user_id = (int) $this->session->userdata('user_id');

        // Ambil data kelas berdasarkan user_id (untuk semua role)
        $kelas_data = $this->Kelas_m->GetDataByUserId($user_id);

        // Validasi apakah data kelas kosong
        if (empty($kelas_data)) {
            $kelas_data = [];
        }

        $kelas_with_aspek = [];
        foreach ($kelas_data as $kelas) {
            $this->db->where('id_kelas', $kelas->id_kelas);
            $aspek_data = $this->Aspek_m->getAlldata()->result_array();

            usort($aspek_data, function ($a, $b) {
                return strtotime($a['updated_at']) - strtotime($b['updated_at']);
            });

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
