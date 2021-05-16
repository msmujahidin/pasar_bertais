<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    public function count_all_pegawai()
    {
        return $this->db->get('pegawai')->num_rows();
    }

    public function latest_pegawai()
    {
        return $this->db->order_by('id', 'DESC')->get('pegawai')->result();
    }

    public function update($user_id, $data){
        $this->db->where('user_id', $user_id)->update('pegawai', $data);
    }

    public function get_all_pegawai()
    {
        $pegawai = $this->db->query("
            SELECT c.user_id as id, c.profile_picture, c.name, u.email, c.phone_number, c.address
            FROM pegawai c
            JOIN users u
                ON u.id = c.user_id
            ORDER BY u.register_date DESC
        ");
                
        return $pegawai->result();
    }

    public function delete_pegawai($id)
    {
        $this->db->query("SET FOREIGN_KEY_CHECKS=0;");
        $this->db->where('user_id', $id)->delete('pegawai');
        $this->db->where('id', $id)->delete('users');
    }

    public function is_pegawai_exist($id)
    {
        return ($this->db->where('user_id', $id)->get('pegawai')->num_rows() > 0) ? TRUE : FALSE;
    }

    public function pegawai_data($id)
    {
        $pegawai = $this->db->query("
            SELECT c.user_id as id, c.profile_picture, c.name, u.email, c.phone_number, c.address, u.register_date
            FROM pegawai c
            JOIN users u
                ON u.id = c.user_id
            WHERE c.user_id = '$id'
        ");
                
        return $pegawai->row();
    }
}