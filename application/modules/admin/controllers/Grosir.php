<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grosir extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        verify_session('admin');

        $this->load->model(array(
            'grosir_model' => 'grosir',
            'product_model' => 'product'
        ));
        $this->load->library('form_validation');
    }


    public function edit($id = 0)
    {
        if ( $this->grosir->is_grosir_exist($id))
        {
            $data = $this->grosir->grosir_data($id);

            $params['title'] = 'Edit ';

            $grosir['flash'] = $this->session->flashdata('edit_grosir_flash');
            $grosir['grosir'] = $data;

            $this->load->view('header', $params);
            $this->load->view('grosirs/edit_grosir', $grosir);
            $this->load->view('footer');
        }
        else
        {
            show_404();
        }
    }
    
    public function add($product_id)
    {
        if ( $this->product->is_product_exist($product_id))
        {
            $params['title'] = 'Edit ';

            $grosir['flash'] = $this->session->flashdata('edit_grosir_flash');

            $grosir['product_id'] = $product_id;

            $this->load->view('header', $params);
            $this->load->view('grosirs/add_grosir', $grosir);
            $this->load->view('footer');
        }
        else
        {
            show_404();
        }
    }
    public function delete($id,$product_id)
    {
        if ( $this->grosir->is_grosir_exist($id))
        {
            if($this->grosir->delete_grosir($id)){
                redirect('admin/products/view/'. $product_id);
            }        
        }else{
            redirect('admin/products/view/'. $product_id);
        }
    }
    public function add_grosir()
    {
        // $this->form_validation->set_error_delimiters('<div class="form-error text-danger font-weight-bold">', '</div>');

        $this->form_validation->set_rules('jumlah_minimal', 'Jumlah Minimal', 'trim|required');
        $this->form_validation->set_rules('harga_satuan', 'Harga Satuan', 'trim|required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $product_id = $this->input->post('product_id');
            $this->add($product_id);
        }
        else
        {
            $product_id = $this->input->post('product_id');

            $jumlah_minimal = $this->input->post('jumlah_minimal');
            $harga_satuan = $this->input->post('harga_satuan');
            $harga_coret = $this->input->post('harga_coret');
    
            $grosir['product_id'] = $product_id;
            $grosir['jumlah_minimal'] = $jumlah_minimal;
            $grosir['harga_satuan'] = $harga_satuan;
            $grosir['harga_coret'] = $harga_coret;

            $this->grosir->add_grosir($grosir);
            $this->session->set_flashdata('edit_product_flash', 'Produk berhasil diperbarui!');

            redirect('admin/products/view/'. $product_id);
        }
    }
    public function edit_grosir()
    {
        // $this->form_validation->set_error_delimiters('<div class="form-error text-danger font-weight-bold">', '</div>');

        $this->form_validation->set_rules('jumlah_minimal', 'Jumlah Minimal', 'trim|required');
        $this->form_validation->set_rules('harga_satuan', 'Harga Satuan', 'trim|required');
        $this->form_validation->set_rules('harga_coret', 'Harga Coret', 'trim|required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $id = $this->input->post('id');
            $this->edit($id);
        }
        else
        {
            $product_id = $this->input->post('product_id');
            $id = $this->input->post('id');
            $data = $this->grosir->grosir_data($id);

            $jumlah_minimal = $this->input->post('jumlah_minimal');
            $harga_satuan = $this->input->post('harga_satuan');
            $harga_coret = $this->input->post('harga_coret');
    
            $grosir['jumlah_minimal'] = $jumlah_minimal;
            $grosir['harga_satuan'] = $harga_satuan;
            $grosir['harga_coret'] = $harga_coret;

            $this->grosir->edit_grosir($id, $grosir);
            $this->session->set_flashdata('edit_product_flash', 'Produk berhasil diperbarui!');

            redirect('admin/products/view/'. $product_id);
        }
    }

}