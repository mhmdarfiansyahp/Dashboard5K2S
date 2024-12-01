<?php

defined('BASEPATH') OR exit('No direct script access allowed');

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

        $this->load->view("layout/header_dash");
        $this->load->view("layout/sidebar_admin");
        $this->load->view("dashboard/index");
        $this->load->view("layout/footer_dash");
    }
    public function competition()
    {
        $data['competisi'] = $this->Kelas_m->Getalldata()->result();
        $data['aspek'] = $this->Aspek_m->Getalldata()->result();
        // $data['title'] = 'Competition 5K2S';
        $this->load->view("layout/header_dash");
        $this->load->view("layout/sidebar_admin");
        $this->load->view("competition/index",$data);
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
