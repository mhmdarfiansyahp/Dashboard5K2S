<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model
{
    private $_table = "user";

    public function check_user($email, $password) {
        $this->db->where('email', $email);
        $this->db->where('password', $password); 
        $query = $this->db->get('user'); 

        if ($query->num_rows() == 1) {
            return $query->row(); 
        } else {
            return false;
        }
    }
}