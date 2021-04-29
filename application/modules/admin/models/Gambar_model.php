<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gambar_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }
    public function getGambar()
    {
        $data = $this->db->get('gambar')->result();
        return $data;
    }
    public function gambar_data($id)
    {
        $data = $this->db->where('id',$id)->get('gambar')->row();
        return $data;
    }
    public function is_gambar_have_image($id)
    {
        $data = $this->gambar_data($id);
        $file = $data->foto;

        return file_exists('./assets/themes/vegefoods/images/'. $file) ? TRUE : FALSE;
    }

    public function updateFoto($id, $data){
        $data = $this->db->where('id',$id)->update('gambar', $data);
    }
}