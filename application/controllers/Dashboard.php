<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
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
        $data['title'] = 'Competition 5K2S';
        $this->load->view("layout/header_dash");
        $this->load->view("layout/sidebar_admin");
        $this->load->view("competition/index");
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
