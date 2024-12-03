<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_m extends CI_Model
{
    public function Getalldata(){
        return $this->db->get('tb_kelas');
    }

    public function GetalldataArray(){
        $query = $this->db->get('tb_kelas');
        return $query->result();
    }

    public function GetDataByUserId($user_id)
    {
        // Menggunakan query untuk mengambil data berdasarkan ID pengguna
        $this->db->where('id_user', $user_id);  // Asumsikan ada kolom 'user_id' di tabel 'tb_kelas'
        $query = $this->db->get('tb_kelas');
        return $query->result(); // Mengembalikan hasil sebagai array
    }

}