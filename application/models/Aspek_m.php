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
}
