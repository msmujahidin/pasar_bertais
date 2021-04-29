<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();

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

        $products['products'] = $this->product->get_all_products();
        $products['best_deal'] = $this->product->best_deal_product();
        $products['reviews'] = $this->review->get_all_reviews();

        get_header($params);
        get_template_part('home', $products);
        get_footer();
    }
}