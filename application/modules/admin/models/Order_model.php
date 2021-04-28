<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    public function count_all_orders()
    {
        return $this->db->get('orders')->num_rows();
    }

    public function get_all_orders($limit, $start)
    {
        $orders = $this->db->query("
            SELECT o.id, o.order_number, o.order_date, o.order_status, o.payment_method, o.total_price, o.total_items, c.name AS coupon, cu.name AS customer
            FROM orders o
            LEFT JOIN coupons c
                ON c.id = o.coupon_id
            JOIN customers cu
                ON cu.user_id = o.user_id
            ORDER BY o.order_date DESC
            LIMIT $start, $limit
        ");

        return $orders->result();
    }

    public function latest_orders()
    {
        $orders = $this->db->query("
            SELECT o.id, o.order_number, o.order_date, o.order_status, o.payment_method, o.total_price, o.total_items, c.name AS coupon, cu.name AS customer
            FROM orders o
            LEFT JOIN coupons c
                ON c.id = o.coupon_id
            JOIN customers cu
                ON cu.user_id = o.user_id
            ORDER BY o.order_date DESC
            LIMIT 5
        ");

    return $orders->result();
    }

    public function is_order_exist($id)
    {
        return ($this->db->where('id', $id)->get('orders')->num_rows() > 0) ? TRUE : FALSE;
    }

    public function order_data($id)
    {
        $data = $this->db->query("
            SELECT o.*, c.name, c.code, p.id as payment_id, p.payment_price, p.payment_date, p.picture_name, p.payment_status, p.confirmed_date, p.payment_data
            FROM orders o
            LEFT JOIN coupons c
                ON c.id = o.coupon_id
            LEFT JOIN payments p
                ON p.order_id = o.id
            WHERE o.id = '$id'
        ");
        
        return $data->row();
    }

    public function order_items($id)
    {

        $items = $this->db->query("
            SELECT oi.id, oi.product_id, oi.order_id, oi.order_qty, oi.order_price, 
            p.name, p.picture_name, p.penjual, p.no_hp, p.lokasi, k.name as category
            FROM order_item oi
            JOIN products p
	            ON p.id = oi.product_id
            JOIN product_category k
	            ON k.id = p.category_id
            WHERE order_id = '$id'");

        return $items->result();
    }
    public function get_total_price($id){
        // $query = $this->db->query("SELECT SUM(`order_price`*`order_qty`) as total_price FROM `order_item` WHERE `order_id`=$id");
        $this->db->select('SUM(order_price * order_qty) as total_price');
        $this->db->where('order_id',$id);
        $query = $this->db->get('order_item');
        return $query->row();
    }
    public function get_total_items($id){
        $this->db->select('count(id) as total_items');
        $this->db->where('order_id',$id);
        $query = $this->db->get('order_item');
        return $query->row();
    }
    public function update_total_price($id){
        $total_price = $this->get_total_price($id)->total_price;
        $total_items = $this->get_total_items($id)->total_items;
        $data = array(
            'total_price' => $total_price,
            'total_items' => $total_items,
        );
        $this->db->where('id', $id);
        $this->db->update('orders', $data); 
    }
    public function order_items_update($id, $product_id, $data){
        $this->db->where('order_id', $id);
        $this->db->where('product_id', $product_id);
        $this->db->update('order_item', $data); 
        $this->update_total_price($id);
    }
    public function order_items_insert($data){
        $this->db->insert('order_item', $data); 
    }
    public function order_items_delete($id){
        $this -> db -> where('id', $id);
        $this -> db -> delete('order_item');
    }

    public function set_status($status, $order)
    {
        return $this->db->where('id', $order)->update('orders', array('order_status' => $status));
    }

    public function product_ordered($id)
    {
        $orders = $this->db->query("
            SELECT oi.*, o.id as order_id, o.order_number, o.order_date, c.name, p.product_unit AS unit
            FROM order_item oi
            JOIN orders o
	            ON o.id = oi.order_id
            JOIN customers c
                ON c.user_id = o.user_id
            JOIN products p
	            ON p.id = oi.product_id
            WHERE oi.product_id = '1'");

        return $orders->result();
    }

    public function order_by($id)
    {
        return $this->db->where('user_id', $id)->order_by('order_date', 'DESC')->get('orders')->result();
    }

    public function order_overview()
    {
        $overview = $this->db->query("
            SELECT MONTH(order_date) month, COUNT(order_date) sale 
            FROM orders
            WHERE order_date >= NOW() - INTERVAL 1 YEAR
            GROUP BY MONTH(order_date)");

        return $overview->result();
    }

    public function income_overview()
    {
        $data = $this->db->query("
            SELECT  MONTH(order_date) AS month, SUM(total_price) AS income
            FROM orders
            GROUP BY MONTH(order_date)");

        return $data->result();
    }
}