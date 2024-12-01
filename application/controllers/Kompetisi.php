<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kompetisi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Kelas_m");
        $this->load->model("Aspek_m");
    }

    public function index()
    {

        // $data['title'] = 'Kompetisi 5K2S';
        $this->load->view("layout/header_dash");
        $this->load->view("layout/sidebar_admin");
        $this->load->view("competition/index");
        $this->load->view("layout/footer_dash");
    }

    public function kerapihan_lab()
    {
        $id_kelas = $this->input->get('kelas');

        if (!$id_kelas) {
            show_error('Parameter kelas tidak ditemukan', 400);
        }

        if ($this->input->post()) {
            $kerapihan_lab_1 = $this->input->post('kerapihan_lab_1', true);
            $kerapihan_lab_2 = $this->input->post('kerapihan_lab_2', true);
            $kerapihan_lab_3 = $this->input->post('kerapihan_lab_3', true);

            if (isset($kerapihan_lab_1) && isset($kerapihan_lab_2) && isset($kerapihan_lab_3)) {
                $kerapihan_lab_string = $kerapihan_lab_1 . ',' . $kerapihan_lab_2 . ',' . $kerapihan_lab_3;

                $data_to_insert = array(
                    'kerapihan_lab' => $kerapihan_lab_string,
                    'id_kelas' => $id_kelas
                );

                $this->db->insert('tb_aspek', $data_to_insert);
                $id_aspek = $this->db->insert_id();
                $this->session->set_userdata('id_aspek', $id_aspek);
            }

            // Redirect ke halaman berikutnya
            redirect('competition/keamanan_lab?kelas=' . $id_kelas);
        } else {
            $data['title'] = 'Kompetisi 5K2S';
            $data['id_kelas'] = $id_kelas;
            $this->load->view("layout/header_dash");
            $this->load->view("layout/sidebar_admin");
            $this->load->view("competition/kerapihan_lab", $data);
            $this->load->view("layout/footer_dash");
        }
    }

    public function keamanan_lab()
    {
        $id_aspek = $this->session->userdata('id_aspek');

        if ($this->input->post()) {
            $keamanan_lab_1 = $this->input->post('kemanan_lab_1', true);
            $keamanan_lab_2 = $this->input->post('kemanan_lab_2', true);

            if (isset($keamanan_lab_1) && isset($keamanan_lab_2)) {
                $keamanan_lab_string = $keamanan_lab_1 . ',' . $keamanan_lab_2;

                // Siapkan data untuk disimpan
                $data_to_update = array(
                    'keamanan_lab' => $keamanan_lab_string
                );

                $this->Aspek_m->update_data($data_to_update, 'tb_aspek', $id_aspek);
            }

            redirect('competition/ketertiban_lab');
        } else {
            $data['title'] = 'Kompetisi 5K2S';
            $this->load->view("layout/header_dash");
            $this->load->view("layout/sidebar_admin");
            $this->load->view("competition/keamanan_lab");
            $this->load->view("layout/footer_dash");
        }
    }


    public function ketertiban_lab()
    {
        $id_aspek = $this->session->userdata('id_aspek');

        if ($this->input->post()) {
            $ketertiban_lab_1 = $this->input->post('ketertiban_lab_1', true);
            $ketertiban_lab_2 = $this->input->post('ketertiban_lab_2', true);
            $ketertiban_lab_3 = $this->input->post('ketertiban_lab_3', true);

            if (isset($ketertiban_lab_1) && isset($ketertiban_lab_2) && isset($ketertiban_lab_3)) {
                $ketertiban_lab_string = $ketertiban_lab_1  . ',' . $ketertiban_lab_2  . ',' . $ketertiban_lab_3;

                $data_to_update = array(
                    'ketertiban_lab' => $ketertiban_lab_string
                );

                $this->Aspek_m->update_data($data_to_update, 'tb_aspek', $id_aspek);
            }

            redirect('competition/kebersihan_lab');
        } else {
            $data['title'] = 'Kompetisi 5K2S';
            $this->load->view("layout/header_dash");
            $this->load->view("layout/sidebar_admin");
            $this->load->view("competition/ketertiban_lab");
            $this->load->view("layout/footer_dash");
        }
    }

    public function kebersihan_lab()
    {
        $id_aspek = $this->session->userdata('id_aspek');

        if ($this->input->post()) {
            $kebersihan_lab = $this->input->post('kebersihan_lab');

            if (isset($kebersihan_lab)) {
                $total_poin_kebersihan_lab = $kebersihan_lab;

                $data = array(
                    'kebersihan_lab' => $total_poin_kebersihan_lab
                );

                // Perbarui data pada tabel tb_aspek menggunakan id_aspek
                $this->Aspek_m->update_data($data, 'tb_aspek', $id_aspek);
            }

            redirect('competition');
        } else {
            $data['title'] = 'Kompetisi 5K2S';
            $this->load->view("layout/header_dash");
            $this->load->view("layout/sidebar_admin");
            $this->load->view("competition/kebersihan_lab");
            $this->load->view("layout/footer_dash");
        }
    }

    public function kerapihan_lab_edit($id_aspek)
    {
        $data['title'] = 'Edit Kerapihan Lab';
        $kerapihan_lab = $this->Aspek_m->get_kerapihan_lab_by_id($id_aspek);

        if ($kerapihan_lab) {
            $kerapihan_lab_value = $kerapihan_lab['kerapihan_lab'] ?? '0,0,0';
            $kerapihan_lab_array = explode(',', $kerapihan_lab_value);

            $data['kerapihan_lab_1'] = $kerapihan_lab_array[0] ?? 0; // Properti Lab
            $data['kerapihan_lab_2'] = $kerapihan_lab_array[1] ?? 0; // Atribut
            $data['kerapihan_lab_3'] = $kerapihan_lab_array[2] ?? 0; // Rambut dan Seragam
        } else {
            // Jika data tidak ditemukan, set semua nilai default ke 0
            $data['kerapihan_lab_1'] = 0;
            $data['kerapihan_lab_2'] = 0;
            $data['kerapihan_lab_3'] = 0;
        }

        $data['id_aspek'] = $id_aspek;

        $this->load->view("layout/header_dash");
        $this->load->view("layout/sidebar_admin");
        $this->load->view("competition/kerapihan_lab_edit", $data);
        $this->load->view("layout/footer_dash");
    }

    public function update_kerapihan_lab($id_aspek)
    {
        $kerapihan_lab_1 = $this->input->post('kerapihan_lab_1');
        $kerapihan_lab_2 = $this->input->post('kerapihan_lab_2');
        $kerapihan_lab_3 = $this->input->post('kerapihan_lab_3');

        $kerapihan_lab_string = $kerapihan_lab_1 . ',' . $kerapihan_lab_2 . ',' . $kerapihan_lab_3;
        // Update database berdasarkan ID dari URL
        $data = [
            'kerapihan_lab' => $kerapihan_lab_string,
            'updated_at' => date('Y-m-d')
        ];

        $this->db->where('id_aspek', $id_aspek);
        $this->db->update('tb_aspek', $data);

        // Redirect setelah berhasil update
        redirect('competition/keamanan_lab_edit/edit/' . $id_aspek);
    }

    public function keamanan_lab_edit($id_aspek)
    {
        $data['title'] = 'Edit keamanan Lab';
        $keamanan_lab = $this->Aspek_m->get_kerapihan_lab_by_id($id_aspek);

        if ($keamanan_lab) {
            $keamanan_lab_value = $keamanan_lab['keamanan_lab'] ?? '0,0';
            $keamanan_lab_array = explode(',', $keamanan_lab_value);

            $data['keamanan_lab_1'] = $keamanan_lab_array[0] ?? 0;
            $data['keamanan_lab_2'] = $keamanan_lab_array[1] ?? 0;
        } else {
            $data['keamanan_lab_1'] = 0;
            $data['keamanan_lab_2'] = 0;
        }

        $data['id_aspek'] = $id_aspek;

        $this->load->view("layout/header_dash");
        $this->load->view("layout/sidebar_admin");
        $this->load->view("competition/keamanan_lab_edit", $data);
        $this->load->view("layout/footer_dash");
    }

    public function update_keamanan_lab($id_aspek)
    {
        $keamanan_lab_1 = $this->input->post('keamanan_lab_1');
        $keamanan_lab_2 = $this->input->post('keamanan_lab_2');

        $keamanan_lab_string = $keamanan_lab_1 . ',' . $keamanan_lab_2;
        $data = [
            'keamanan_lab' => $keamanan_lab_string,
            'updated_at' => date('Y-m-d')
        ];

        $this->db->where('id_aspek', $id_aspek);
        $this->db->update('tb_aspek', $data);

        redirect('competition/ketertiban_lab_edit/edit/' . $id_aspek);
    }

    public function ketertiban_lab_edit($id_aspek)
    {
        $data['title'] = 'Edit keteriban Lab';
        $ketertiban_lab = $this->Aspek_m->get_kerapihan_lab_by_id($id_aspek);

        if ($ketertiban_lab) {
            $ketertiban_lab_value = $ketertiban_lab['ketertiban_lab'] ?? '0,0';
            $ketertiban_lab_array = explode(',', $ketertiban_lab_value);

            $data['ketertiban_lab_1'] = $ketertiban_lab_array[0] ?? 0;
            $data['ketertiban_lab_2'] = $ketertiban_lab_array[1] ?? 0;
            $data['ketertiban_lab_3'] = $ketertiban_lab_array[2] ?? 0;
        } else {
            $data['ketertiban_lab_1'] = 0;
            $data['ketertiban_lab_2'] = 0;
            $data['ketertiban_lab_3'] = 0;
        }

        $data['id_aspek'] = $id_aspek;

        $this->load->view("layout/header_dash");
        $this->load->view("layout/sidebar_admin");
        $this->load->view("competition/ketertiban_lab_edit", $data);
        $this->load->view("layout/footer_dash");
    }

    public function update_ketertiban_lab($id_aspek)
    {
        $ketertiban_lab_1 = $this->input->post('ketertiban_lab_1');
        $ketertiban_lab_2 = $this->input->post('ketertiban_lab_2');
        $ketertiban_lab_3 = $this->input->post('ketertiban_lab_3');

        $ketertiban_lab_string = $ketertiban_lab_1 . ',' . $ketertiban_lab_2 . ',' . $ketertiban_lab_3;
        $data = [
            'ketertiban_lab' => $ketertiban_lab_string,
            'updated_at' => date('Y-m-d')
        ];

        $this->db->where('id_aspek', $id_aspek);
        $this->db->update('tb_aspek', $data);

        redirect('competition/kebersihan_lab_edit/edit/' . $id_aspek);
    }

    public function kebersihan_lab_edit($id_aspek)
    {
        $data['title'] = 'Edit Kebersihan Lab';

        $aspek = $this->Aspek_m->get_kerapihan_lab_by_id($id_aspek);

        if ($aspek) {
            $data['kebersihan_lab'] = $aspek['kebersihan_lab'] ?? 0;
        } else {
            $data['kebersihan_lab'] = 0;
        }

        $data['id_aspek'] = $id_aspek;

        // Load view
        $this->load->view("layout/header_dash");
        $this->load->view("layout/sidebar_admin");
        $this->load->view("competition/kebersihan_lab_edit", $data);
        $this->load->view("layout/footer_dash");
    }


    public function update_kebersihan_lab($id_aspek)
    {
        $kebersihan_lab = (int)$this->input->post('kebersihan_lab');

        $data = [
            'kebersihan_lab' => $kebersihan_lab,
            'updated_at' => date('Y-m-d')
        ];

        $this->db->where('id_aspek', $id_aspek);
        $this->db->update('tb_aspek', $data);

        redirect('competition');
    }
}
