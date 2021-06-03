<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }
    
    // tabel laporan_pemasukan
    public function add_income($data)
    {
        $this->db->insert('laporan_pemasukan', $data);
        return $this->db->insert_id();
    }
    public function update_income($id, $data)
    {
        return $this->db->where('id', $id)->update('laporan_pemasukan', $data);
    }
    public function get_income_by_date($date)
    {
        return $this->db->where('date', $date)->get('laporan_pemasukan')->row();
    }
    public function get_income_between($first_date, $second_date)
    {
        $this->db->where('date >=', $first_date);
        return $this->db->where('date <=', $second_date)
        ->get('laporan_pemasukan')->result();
    }
    public function get_last_income()
    {
        return $this->db->order_by('id',"desc")->limit(1)->get('laporan_pemasukan')->row();
    }

    // tabel pemasukan
    public function add_other_income($data)
    {
        $this->db->insert('pemasukan', $data);
        return $this->db->insert_id();
    }
    public function get_other_income()
    {
        return $this->db->get('pemasukan')->result();
    }

    // tabel pengeluaran
    public function add_outcome($data)
    {
        $this->db->insert('pengeluaran', $data);
        return $this->db->insert_id();
    }
    public function get_outcome()
    {
        return $this->db->get('pengeluaran')->result();
    }
}