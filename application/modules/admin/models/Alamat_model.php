<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alamat_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }
    public function getAll()
    {
        $data = $this->db->get('alamat')->result();
        return $data;
    }
    public function add_ongkir(Array $data)
    {
        $this->db->insert('alamat', $data);

        return $this->db->insert_id();
    }
    public function ongkir_data($id)
    {
        return $this->db->where('id', $id)->get('alamat')->row();
    }

    public function edit_ongkir($id, $data)
    {
        return $this->db->where('id', $id)->update('alamat', $data);
    }

    public function delete_ongkir($id)
    {
        return $this->db->where('id', $id)->delete('alamat');
    }
}