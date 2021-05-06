<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grosir_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }
    
    public function is_grosir_exist($id)
    {
        return ($this->db->where('id', $id)->get('harga_grosir')->num_rows() > 0) ? TRUE : FALSE;
    }

    public function get_harga_grosir($product_id)
    {
        $this->db->where('product_id',$product_id);
        $this->db->order_by('jumlah_minimal', 'DESC');
        $query = $this->db->get('harga_grosir');
        return $query->result();
    }
    public function grosir_data($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('harga_grosir');
        return $query->row();
    }
    public function edit_grosir($id, $grosir)
    {
        return $this->db->where('id', $id)->update('harga_grosir', $grosir);
    }
    public function add_grosir($grosir)
    {
        return $this->db->insert('harga_grosir', $grosir);
    }
    public function delete_grosir($id)
    {
        return $this->db->where('id', $id)->delete('harga_grosir');
    }
}

