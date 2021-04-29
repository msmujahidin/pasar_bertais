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
}