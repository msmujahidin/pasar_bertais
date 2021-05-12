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
        $data['title'] = 'Selamat Datang di Pasar Bertais';
        $gambar = $this->gambar->getGambar();
        $data['foto1'] = $gambar[0]->foto;
        $data['foto2'] = $gambar[1]->foto;

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
    public function search(){
        
        // $products = $this->product->search($match);
        // echo json_encode($products);
        // uji coba berhasil NANTI LANJUTKAN KEMBALI
        $data = json_decode(file_get_contents("php://input"), true);
        $match = $data['search'];
        $products = $this->product->search($match);
        foreach( $products as $index => $product){
            $products[$index]->jumlah_order = 0;
        }
        echo json_encode($products);
        
    }
    public function cart_api()
    {
        $post_data = json_decode(file_get_contents("php://input"), true);

        $action = $post_data['action'];
        switch ($action)
        {
            case 'add_item' :
                $id = $post_data['id'];
                $qty = $post_data['qty'];
                $sku = $post_data['sku'];
                $name = $post_data['name'];
                $price = $post_data['price'];
                $picture_name = $post_data['picture_name'];
                
                $item = array(
                    'id' => $id,
                    'qty' => $qty,
                    'price' => $price,
                    'picture_name' => $picture_name,
                    'name' => $name
                );
                $this->cart->insert($item);
                $total_item = count($this->cart->contents());

                $response = array('code' => 200, 'message' => 'Item dimasukkan dalam keranjang', 'total_item' => $total_item);
            break;
            case 'update_item' :
                $rowid = $post_data['rowid'];
                $qty = $post_data['qty'];
                $price = $post_data['price'];
                
                $item = array(
                    'rowid' => $rowid,
                    'qty' => $qty,
                    'price' => $price,
                );
                $this->cart->update($item);
                $response = array('code' => 200);
            break;
        }

        $response = json_encode($response);
        $this->output->set_content_type('application/json')
            ->set_output($response);
    }
}