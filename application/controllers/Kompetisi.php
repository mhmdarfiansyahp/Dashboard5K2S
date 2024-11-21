<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kompetisi extends CI_Controller
{
    public function __construct()
	{
		parent:: __construct();
		$this->load->model("Kelas_m");
	}

    public function index()
    {
        $data['title'] = 'Kompetisi 5K2S';
        $this->load->view("layout/header_dash");
        $this->load->view("layout/sidebar_admin");
        $this->load->view("competition/index");
        $this->load->view("layout/footer_dash");
    }
    public function tambah()
    {
        $data['title'] = 'Kompetisi 5K2S';
        $this->load->view("layout/header_dash");
        $this->load->view("layout/sidebar_admin");
        $this->load->view("competition/tambah");
        $this->load->view("layout/footer_dash");
    }
    public function pilih_kls()
    {
        $data['kompetisi']=$this->Kelas_m->Getalldata()->result();
        $data['title'] = 'Kompetisi 5K2S';
        $this->load->view("layout/header_dash");
        $this->load->view("layout/sidebar_admin");
        $this->load->view("competition/pilih_kls", $data);
        $this->load->view("layout/footer_dash");
    }
    

    public function myclass()
    {
        $data['title'] = 'Competition 5K2S';
        $this->load->view("layout/header_dash");
        $this->load->view("layout/sidebar_admin");
        $this->load->view("competition/index");
        $this->load->view("layout/footer_dash");
    }
}
