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
}