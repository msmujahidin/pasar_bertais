<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guest extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array(
            'order_model' => 'order'
        ));
    }

    public function order($order_number =0){
        if ( $this->order->is_order_exist($order_number))
        {
            $data = $this->order->order_data($order_number);
            $items = $this->order->order_items($data->id);
 
            $params['title'] = 'Order #'. $data->order_number;
            $order['data'] = $data;
            $order['items'] = $items;
            $order['delivery_data'] = json_decode($data->delivery_data);

            get_header('Pesanan');
            get_template_part('guest', $order);
            get_footer();
        }
        else
        {
            show_404();
        }
    }
}