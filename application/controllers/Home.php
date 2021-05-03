<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->library('cart');
        $this->load->model(array(
            'product_model' => 'product',
            'gambar_model' => 'gambar',
            'review_model' => 'review'
        ));
    }

    public function index() {
        $params['title'] = 'Selamat Datang di Pasar Bertais';
        $gambar = $this->gambar->getGambar();
        $params['foto1'] = $gambar[0]->foto;
        $params['foto2'] = $gambar[1]->foto;

        $product_category = $this->product->get_all_categories();
        $category = "";
        $products = [];
        $all_products = [];
        $limit = 2;
        $start = 0;
        $category_id = 0;
        $total_products = [];

        if(sizeof($product_category) > 0){
            $category = $product_category[0];
            $id = $product_category[0]->id;
            $total_product = $this->product->count_products_by_category($id);
            for($i= 0; $i< sizeof($product_category); $i++){
                $category_id = $product_category[$i]->id;
                $category_name = $product_category[$i]->name;
                $products = $this->product->get_products_by_category($category_id, $limit, $start);
                foreach( $products as $index => $product){
                    $products[$index]->jumlah_order = 0;
                }
                $all_products[$category_id] = $products;
                $total_products[$category_id] = $this->product->count_products_by_category($category_id);
            }
            $products = $all_products[$category->id];
        }
        $carts = $this->cart->contents();
        $data['carts'] = $carts;
        
        $data['product_category'] = $product_category;
        $data['total_products'] = $total_products;
        $data['category'] = $category;
        $data['products'] = $products;
        $data['limit'] = $limit;
        $data['start'] = $start;
        $data['all_products'] = $all_products;
        $data['best_deal'] = $this->product->best_deal_product();
        $data['reviews'] = $this->review->get_all_reviews();

        get_header($params);
        get_template_part('home', $data);
        get_footer();
    }

    public function api(){
        $data = json_decode(file_get_contents("php://input"), true);

        $limit = $data['limit'];
        $start = $data['start'];
        $category_id = $data['category_id'];
        
        $products = $this->product->get_products_by_category($category_id, $limit, $start);
        foreach( $products as $index => $product){
            $products[$index]->jumlah_order = 0;
        }
        $response = json_encode($products);
            $this->output->set_content_type('application/json')
                ->set_output($response);

    }
}