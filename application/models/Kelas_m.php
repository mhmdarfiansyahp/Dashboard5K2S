<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_m extends CI_Model
{
    public function Getalldata(){
        return $this->db->get('tb_kelas');
    }
}