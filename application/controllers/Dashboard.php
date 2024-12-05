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
        $data['userClasses'] = $userClasses;

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
    
    // Menyiapkan data pengguna
    $data = $this->prepare_user_data('Kelas 5K2S');

    $this->load->model('Kelas_m');
    $this->load->model('Aspek_m');

    $user_id = (int) $this->session->userdata('user_id');

    // Ambil data kelas yang dimiliki oleh pengguna
    $user_kelas_data = $this->Kelas_m->GetDataByUserId($user_id);

    // Ambil semua data kelas
    $all_kelas_data = $this->Kelas_m->getAllKelas();

    // Validasi apakah data kelas pengguna kosong
    if (empty($user_kelas_data)) {
        $user_kelas_data = [];
    }

    $grouped_data = [];

    // Proses semua data kelas untuk menghitung peringkat global
    foreach ($all_kelas_data as $kelas) {
        $this->db->where('id_kelas', $kelas->id_kelas);
        $aspek_data = $this->Aspek_m->getAlldata()->result_array();

        foreach ($aspek_data as $cpm) {
            $tanggal_update = strtotime($cpm['create_at']);
            $bulan = date('F', $tanggal_update);
            $tahun = date('Y', $tanggal_update);
            $key = $kelas->id_kelas . '-' . $bulan . '-' . $tahun;

            if (isset($grouped_data[$key])) {
                $grouped_data[$key]['kerapihan_lab'] += array_sum(explode(',', $cpm['kerapihan_lab']));
                $grouped_data[$key]['keamanan_lab'] += array_sum(explode(',', $cpm['keamanan_lab']));
                $grouped_data[$key]['ketertiban_lab'] += array_sum(explode(',', $cpm['ketertiban_lab']));
                $grouped_data[$key]['kebersihan_lab'] += $cpm['kebersihan_lab'];
                $grouped_data[$key]['total'] += array_sum(explode(',', $cpm['kerapihan_lab'])) +
                                                array_sum(explode(',', $cpm['keamanan_lab'])) +
                                                array_sum(explode(',', $cpm['ketertiban_lab'])) +
                                                $cpm['kebersihan_lab'];
            } else {
                $grouped_data[$key] = [
                    'id_kelas' => $kelas->id_kelas,
                    'kelas_nama' => $kelas->nama_kelas,
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                    'kerapihan_lab' => array_sum(explode(',', $cpm['kerapihan_lab'])),
                    'keamanan_lab' => array_sum(explode(',', $cpm['keamanan_lab'])),
                    'ketertiban_lab' => array_sum(explode(',', $cpm['ketertiban_lab'])),
                    'kebersihan_lab' => $cpm['kebersihan_lab'],
                    'total' => array_sum(explode(',', $cpm['kerapihan_lab'])) +
                              array_sum(explode(',', $cpm['keamanan_lab'])) +
                              array_sum(explode(',', $cpm['ketertiban_lab'])) +
                              $cpm['kebersihan_lab']
                ];
            }
        }
    }

    // Mengurutkan data berdasarkan total secara menurun
    usort($grouped_data, function ($a, $b) {
        return $b['total'] <=> $a['total'];
    });

    // Menambahkan peringkat global
    $rank = 1;
    foreach ($grouped_data as &$item) {
        $item['peringkat'] = $rank++;
    }

    // Filter data untuk hanya menampilkan kelas milik user
    $filtered_data = array_filter($grouped_data, function ($item) use ($user_kelas_data) {
        foreach ($user_kelas_data as $user_kelas) {
            if ($item['id_kelas'] == $user_kelas->id_kelas) {
                return true;
            }
        }
        return false;
    });

    // Konversi ke array numerik untuk view
    $data['kelas_with_aspek'] = array_values($filtered_data);

    $data['user_role'] = (int) $this->session->userdata('role');
    $data['kelas_data'] = $user_kelas_data;

    // Memuat view dengan data
    $this->load->view("layout/header_dash", $data);
    $this->load->view("layout/sidebar_admin", $data);
    $this->load->view("class/index", $data);
    $this->load->view("layout/footer_dash");
}

    

    private function prepare_user_data($title)
    {
        // Ambil user_id dari session
        $user_id = $this->session->userdata('user_id');
    
        // Cek apakah user_id ada di session
        if (!$user_id) {
            show_error('Anda harus login terlebih dahulu.', 403);
        }
    
        // Load model kelas untuk mengambil data kelas
        $this->load->model('Kelas_m');
    
        // Ambil data kelas berdasarkan user_id
        $kelas_data = $this->Kelas_m->GetDataByUserId($user_id);
    
        // Pastikan data kelas tidak kosong
        if (empty($kelas_data)) {
            $kelas_data = [];
        }
    
        return [
            'title' => $title,
            'username' => $this->session->userdata('username'),
            'role' => $this->session->userdata('role'),
            'kelas' => $kelas_data, // Tambahkan data kelas ke array
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
