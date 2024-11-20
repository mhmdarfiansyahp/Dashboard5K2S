<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Machine_m extends CI_Model
{
    private $_table = "machine";

    public $id;
    public $id_eng;
    public $name;
    public $brand;
    public $type;
    public $lokasi;
    public $rangeCapacity;
    public $remark;

    public function rules()
    {
        return [

            ['field' => 'id_eng',
            'label' => 'ID Engineering',
            'rules' => 'required'],

            ['field' => 'name',
            'label' => 'Name',
            'rules' => 'required'],

            ['field' => 'brand',
            'label' => 'Brand',
            'rules' => 'required'],

            ['field' => 'type',
            'label' => 'Type',
            'rules' => 'required'],

            ['field' => 'lokasi',
            'label' => 'lokasi',
            'rules' => 'required'],

            ['field' => 'rangeCapacity',
            'label' => 'Range / Capacity',
            'rules' => 'required'],

            ['field' => 'remark',
            'label' => 'Remark',
            'rules' => 'required'],
        ];
    }

    public function getAll() {
        // Build the query using CI_DB_query_builder
        $query = $this->db->where('flag', 1)->get('machine'); // Apply where condition before getting data
    
        // Check if query was successful
        if ($query) {
            return $query->result(); // Return result set as an array of objects
        } else {
            return array(); // Return an empty array if no results or error
        }
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }
    public function getByIdEngineering($id)
    {
        return $this->db->get_where($this->_table, ["id_eng" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        // $this->id = uniqid();
        $this->id_eng = $post["id_eng"];
        $this->name = $post["name"];
        $this->brand = $post["brand"];
        $this->type = $post["type"];
        $this->lokasi = $post["lokasi"];
        $this->rangeCapacity = $post["rangeCapacity"];
        $this->remark = $post["remark"];
        $this->flag = $post["flag"];
        $this->session->set_flashdata('flash', 'Ditambahkan');
        return $this->db->insert($this->_table, $this);
    }
    public function save_upload($data)
    {
        $this->db->insert('machine', $data);

        // Check if the data has been successfully inserted
        return $this->db->affected_rows() > 0;
    }

    // Machine_m model
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('machine', $data); // 'machines' is your database table name
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('machine', $data);
    }
}