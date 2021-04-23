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
 
        $orders['orders'] = $this->order->get_all_orders($config['per_page'], $page);
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

    public function export($order_id){
        $this->load->helper('download');
        if ( $this->order->is_order_exist($order_id)){
            $data = $this->order->order_data($order_id);
            $items = $this->order->order_items($order_id);
            $delivery_data = json_decode($data->delivery_data);
            print_r($delivery_data->customer);
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            
            $sheet->getColumnDimension('A')->setWidth(15);
            $sheet->getColumnDimension('B')->setWidth(18);
            $sheet->getColumnDimension('C')->setWidth(18);
            $sheet->getColumnDimension('D')->setWidth(12);
            $sheet->getColumnDimension('E')->setWidth(8);
            $sheet->getColumnDimension('F')->setWidth(15);

            // foreach (range('A','F') as $col) {
            //     $sheet->getColumnDimension($col)->setAutoSize(true);
            // }

            $sheet->getStyle('A1:A5')->getFont()->setBold(true);

            $sheet->setCellValue('A1', 'Nama Penerima');
            $sheet->setCellValue('A2', 'Nomor WA');
            $sheet->mergeCells('A3:A4');
            $sheet->setCellValue('A3', 'Alamat');
            $sheet->mergeCells('A5:A6');
            $sheet->setCellValue('A5', 'Note');

            $sheet->getStyle('A3:F6')->getAlignment()->setVertical('center');

            $customer = $delivery_data->customer;
            $sheet->setCellValue('B1', $customer->name);
            $sheet->setCellValue('B2', $customer->phone_number);
            $sheet->mergeCells('B3:F4');
            $sheet->setCellValue('B3', $customer->address);
            $sheet->mergeCells('B5:F6');
            $sheet->setCellValue('B5', $delivery_data->note);
            
            
            $i=$i0=9;
            $sheet->mergeCells('A'.$i.':'.'F'.$i);
            $sheet->getStyle('A'.$i)->getFont()->setBold(true);
            $sheet->getStyle('A'.$i)->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('A'.$i, 'Barang Pesanan');
            $i++;
            $sheet->setCellValue('A'.$i, 'No Lokasi');
            $sheet->setCellValue('B'.$i, 'No Urut');
            $sheet->setCellValue('C'.$i, 'Nama Produk');
            $sheet->setCellValue('D'.$i, 'Harga (RP)');
            $sheet->setCellValue('E'.$i, 'Jumlah');
            $sheet->setCellValue('F'.$i, 'Sub Total (RP)');

            // $sheet->getStyle('A'.$i.':F'.$i)->getAlignment()->setHorizontal('center');
            $i++;
            foreach($items as $item):
                $sub_total = $item->order_qty * $item->order_price;
                $sheet->setCellValue('A'.$i, $item->no_location);
                $sheet->setCellValue('b'.$i, $item->no_sequence);
                $sheet->setCellValue('C'.$i, $item->name);
                $sheet->setCellValue('D'.$i, format_rupiah($item->order_price));
                $sheet->setCellValue('E'.$i, $item->order_qty);
                $sheet->setCellValue('F'.$i, format_rupiah($sub_total));
                $i++;
            endforeach;
            $sheet->mergeCells('A'.$i.':E'.$i);
            $sheet->getStyle('A'.$i.':E'.$i)->getAlignment()->setHorizontal('center');

            $sheet->setCellValue('A'.$i, 'TOTAL (RP)');
            $sheet->setCellValue('F'.$i, format_rupiah($data->total_price));

            $sheet
            ->getStyle('A'.$i0.':F'.$i)
            ->getBorders()->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('A'.$i0.':F'.$i)->getAlignment()->setHorizontal('center');

            $file_name = 'report.xlsx';
            $writer = new Xlsx($spreadsheet);
            $writer->save($file_name);
            $path = file_get_contents(base_url($file_name)); // get file name
            force_download($file_name, $path); // start download`
        }
        redirect('admin/orders/view/'. $order_id.'#pesanan');
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