<?php defined('BASEPATH') or exit('No direct script access allowed');

class Aspek_m extends CI_Model
{
    public function Getalldata()
    {
        return $this->db->get('tb_aspek');
    }

    public function GetDataByKelasId($id_kelas){
        $this->db->where('id_kelas', $id_kelas);
        $query = $this->db->get('tb_aspek');
        return $query->result();
    }

    public function tambah_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function update_data($data, $table, $id_aspek)
    {
        $this->db->where('id_aspek', $id_aspek);
        $this->db->update($table, $data);
    }

    public function get_kerapihan_lab_by_id($id_aspek)
    {
        $this->db->select('kerapihan_lab, keamanan_lab, ketertiban_lab, kebersihan_lab');
        $this->db->from('tb_aspek');
        $this->db->where('id_aspek', $id_aspek);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_data_by_month($month, $year)
    {
        $this->db->select('tb_aspek.*, tb_kelas.nama_kelas');
        $this->db->from('tb_aspek');
        $this->db->join('tb_kelas', 'tb_aspek.id_kelas = tb_kelas.id_kelas', 'left'); // Join ke tabel kelas
        $this->db->where('MONTH(tb_aspek.create_at)', $month);
        $this->db->where('YEAR(tb_aspek.create_at)', $year);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function parse_aspek_data($data)
    {
        $data['kerapihan_lab'] = array_map('intval', explode(',', $data['kerapihan_lab']));
        $data['keamanan_lab'] = array_map('intval', explode(',', $data['keamanan_lab']));
        $data['ketertiban_lab'] = array_map('intval', explode(',', $data['ketertiban_lab']));
        $data['kebersihan_lab'] = intval($data['kebersihan_lab']);

        $data['total_score'] = array_sum($data['kerapihan_lab']) +
            array_sum($data['keamanan_lab']) +
            array_sum($data['ketertiban_lab']) +
            $data['kebersihan_lab'];
        return $data;
    }
}
