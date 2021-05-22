<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load library phpspreadsheet
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
// End load library phpspreadsheet

class Orders extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        verify_session('admin');

        $this->load->model(array(
            'product_model' => 'product',
            'order_model' => 'order'
        ));
    }

    public function index()
    {
        $params['title'] = 'Kelola Order';

        $config['base_url'] = site_url('admin/orders/index');
        $config['total_rows'] = $this->order->count_all_orders();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $choice = $config['total_rows'] / $config['per_page'];
        $config['num_links'] = floor($choice);
 
        $config['first_link']       = '«';
        $config['last_link']        = '»';
        $config['next_link']        = '›';
        $config['prev_link']        = '‹';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->load->library('pagination', $config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
 
        // $orders['orders'] = $this->order->get_all_orders($config['per_page'], $page);
        $orders['orders'] = $this->order->get_all_orders_new($config['per_page'], $page);

        // print_r($orders['orders'][0]->delivery_data);
        $orders['pagination'] = $this->pagination->create_links();

        $this->load->view('header', $params);
        $this->load->view('orders/orders', $orders);
        $this->load->view('footer');
    }

    public function view($id = 0)
    {
        if ( $this->order->is_order_exist($id))
        {

            $data = $this->order->order_data($id);
            $items = $this->order->order_items($id);
            $banks = json_decode(get_settings('payment_banks'));
            $banks = (Array) $banks;
 
            $params['title'] = 'Order #'. $data->order_number;

            $order['order_id'] = $id;
            $order['data'] = $data;
            $order['items'] = $items;
            $order['delivery_data'] = json_decode($data->delivery_data);
            $order['banks'] = $banks;
            $order['order_flash'] = $this->session->flashdata('order_flash');
            $order['payment_flash'] = $this->session->flashdata('payment_flash');

            // print_r($items);
            $this->load->view('header', $params);
            $this->load->view('orders/view', $order);
            $this->load->view('footer');
        }
        else
        {
            show_404();
        }
    }
    
    public function invoice($id = 0){
        if ( $this->order->is_order_exist($id))
        {

            $data = $this->order->order_data($id);
            $items = $this->order->order_items($id);
            $banks = json_decode(get_settings('payment_banks'));
            $banks = (Array) $banks;
 
            $params['title'] = 'Order #'. $data->order_number;

            $order['order_id'] = $id;
            $order['data'] = $data;
            $order['items'] = $items;
            $order['delivery_data'] = json_decode($data->delivery_data);
            $order['banks'] = $banks;
            $order['order_flash'] = $this->session->flashdata('order_flash');
            $order['payment_flash'] = $this->session->flashdata('payment_flash');

            // echo '<pre>';
            // var_dump($data);
            // echo '</pre>';
            $initial_height = 38;
            $heigth_item = 3;
            $heigth_list =  $heigth_item * sizeof($items);
            $height = $initial_height + $heigth_list;
            $order['height'] = $height."mm";

            $this->load->view('orders/invoice', $order);
        }
        else
        {
            show_404();
        }

    }
    public function create($id = 0){
        if ( $this->order->is_order_exist($id)){
            $data = $this->order->order_data($id);
            $params['title'] = 'Order #'. $data->order_number;

            $products['data'] = $data;
            $products['order_id'] = $id;
            
            $products['products'] = $this->product->get_all_products(16, 0);

            // print_r($products['products']);

            $this->load->view('header', $params);
            $this->load->view('orders/list_product', $products);
            $this->load->view('footer');

        }
        else
        {
            show_404();
        }
    }

    public function delete($id, $order_id){
        $this->order->order_items_delete($id);
        $this->order->update_total_price($order_id);
        redirect('admin/orders/view/'. $order_id.'#pesanan');
    }

    public function exportAll(){
        $this->load->helper('download');
        $order_list = $this->input->post('order');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // initial coll, row Table
        $initial_data = [
            'row' => 1,
            'col_first' => 'A',
            'col_last' => 'L',

        ];
        $row_first = $initial_data['row'];
        $col_first = $initial_data['col_first'];
        $col_last = $initial_data['col_last'];

        // setting col dimension
        for($letter=$col_first; $letter<=$col_last; $letter++){
            $sheet->getColumnDimension($letter)->setWidth(14);
        }
        $row = $row_first;

        // create Title Table
        $sheet->mergeCells($col_first.$row.':'.$col_last.$row);
        $sheet->getStyle($col_first.$row)->getFont()->setBold(true);
        $sheet->getStyle($col_first.$row)->getAlignment()->setHorizontal('center');
        $sheet->getStyle($col_first.$row)->getFont()->setBold(true);
        $sheet->setCellValue($col_first.$row++, 'Barang Pesanan');

        // create Header Tabel
        $labels = [
            'Order ID','Harga Real', 'Harga Beli/kg (Rp)', 'Jumlah', 'Item', 'Kategori', 'Pembeli', 'Penjual', 'No. Hp', 'Lokasi', 'Sub Total', 'Total'
        ];
        $letter = $col_first;
        foreach($labels as $label){
            $sheet->setCellValue($letter++.$row, $label);
        }
        // create list order by order id
        // update initial data
        $initial_data['row']++;
        foreach($order_list as $order_id):
            $data = $this->order->order_data($order_id);
            $items = $this->order->order_items($order_id);
            $initial_data['data'] = $data;
            $initial_data['items'] = $items;
            $this->create_list_order_item($sheet, $initial_data);
            $initial_data['row'] += sizeof($items);
        endforeach;

        // style allcell to borders and center
        $row = $initial_data['row'];
        $sheet
            ->getStyle($col_first.$row_first.':'.$col_last.$row)
            ->getBorders()->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle($col_first.$row_first.':'.$col_last.$row)->getAlignment()->setHorizontal('center');

        // Exporting Excel file
        $file_name = 'report.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$file_name.'"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

    }
    private function create_list_order_item($sheet, $initial_data){
        // initial data
        $data = $initial_data['data'];
        $items = $initial_data['items'];
        $col_first =  $initial_data['col_first'];
        $col_last =  $initial_data['col_last'];
        $row = $row_first = $initial_data['row'];

        foreach($items as $index => $item):
            ++$row;
            $total = $data->total_price;
            $sub_total = $item->order_qty * $item->order_price;
            $values = [
                '', '', format_rupiah($item->order_price), $item->order_qty, $item->name, $item->category, '', $item->penjual, $item->no_hp, $item->lokasi, format_rupiah($sub_total), ''
            ];
            if($index === 0){
                $values = [
                    $data->order_number, '', format_rupiah($item->order_price), $item->order_qty, $item->name, $item->category, '', $item->penjual, $item->no_hp, $item->lokasi, format_rupiah($sub_total), format_rupiah($total)
                ];
            }
            $letter = $col_first;
            foreach($values as $value){
                $sheet->setCellValue($letter++.$row, $value);
            }
        endforeach;
    }

    public function update_order_item($id){
        $product_id = $this->input->post('product_id');
        $order_qty = $this->input->post('order_qty');
        $data = array(
                'order_qty' => $order_qty,
        );

        $items = $this->order->order_items_update($id, $product_id, $data);
        
        redirect('admin/orders/view/'. $id.'#pesanan');
    }
    public function insert_order_item($id){
        $product_id = $this->input->post('product_id');
        $order_price = $this->input->post('order_price');
        $data = array(
            'order_id' => $id,
            'product_id' => $product_id,
            'order_qty' => 1,
            'order_price' => $order_price,
        );

        $this->order->order_items_insert($data);

        // print_r($data);
        $this->order->update_total_price($id);
        redirect('admin/orders/view/'. $id.'#pesanan');
        
    }

    public function status()
    {
        $status = $this->input->post('status');
        $order = $this->input->post('order');

        $this->order->set_status($status, $order);
        $this->session->set_flashdata('order_flash', 'Status berhasil diperbarui');

        redirect('admin/orders/view/'. $order);
    }
}