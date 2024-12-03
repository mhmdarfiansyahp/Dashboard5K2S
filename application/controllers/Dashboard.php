<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Kelas_m");
        $this->load->model("Aspek_m");
    }

    public function index()
    {
        $data['title'] = 'Dashboard 5K2S';

        // Ambil bulan dan tahun saat ini
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Ambil data berdasarkan bulan dan tahun
        $rawData = $this->Aspek_m->get_data_by_month($currentMonth, $currentYear);

        // Proses data
        $data['chartData'] = [];
        foreach ($rawData as $row) {
            $processedData = $this->Aspek_m->parse_aspek_data($row);
            $data['chartData'][] = [
                'nama_kelas' => $row['nama_kelas'], // Nama kelas dari tabel
                'total_score' => $processedData['total_score']
            ];
        }

        // Kirim data ke view
        $this->load->view("layout/header_dash", $data);
        $this->load->view("layout/sidebar_admin", $data);
        $this->load->view("dashboard/index", $data);
        $this->load->view("layout/footer_dash", $data);
    }

    public function competition()
    {
        $data['competisi'] = $this->Kelas_m->Getalldata()->result();
        $data['aspek'] = $this->Aspek_m->Getalldata()->result();
        // $data['title'] = 'Competition 5K2S';
        $this->load->view("layout/header_dash");
        $this->load->view("layout/sidebar_admin");
        $this->load->view("competition/index", $data);
        $this->load->view("layout/footer_dash");
    }


    public function myclass()
    {
        $data['title'] = 'Competition 5K2S';
        $this->load->view("layout/header_dash");
        $this->load->view("layout/sidebar_admin");
        $this->load->view("class/index");
        $this->load->view("layout/footer_dash");
    }
}
