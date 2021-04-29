<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gambar extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        verify_session('admin');

        $this->load->model(array(
            'product_model' => 'product',
            'gambar_model' => 'gambar',
        ));
        $this->load->library('form_validation');
    }

    public function index()
    {
            $gambar = $this->gambar->getGambar();

            $params['title'] = 'Kelola Pembayaran';

            $product['gambar'] = $gambar;
            $product['categories'] = $this->product->get_all_categories();

            $this->load->view('header', $params);
            $this->load->view('gambar/gambar', $product);
            $this->load->view('footer');
    }
    public function edit_gambar()
    { 
        $id = $this->input->post('id');
        $data = $this->gambar->gambar_data($id);
        $current_picture = $data->foto;

        if ( isset($_FILES['picture']) && @$_FILES['picture']['error'] == '0')
        {
            echo "berhasil";
            // sudah terupload belum masuk tabel db
            $config['upload_path'] = './assets/themes/vegefoods/images/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $new_name = "bg_".$id;
            $config['file_name'] = $new_name;
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);
            if ( $this->upload->do_upload('picture'))
            {
                $upload_data = $this->upload->data();
                $new_file_name = $upload_data['file_name'];
                $data = array(
                    'foto' => $new_file_name,
                );
                $this->gambar->updateFoto($id, $data);

                echo $new_file_name;
                if ( $this->gambar->is_gambar_have_image($id))
                {
                    $file = './assets/themes/vegefoods/images/'. $current_picture;

                    $file_name = $new_file_name;
                    unlink($file);
                }
                else
                {
                    $file_name = $new_file_name;
                }
                redirect('admin/gambar/');
            }
            else
            {
                show_error($this->upload->display_errors());
            }
        }
        else
        {
            echo "kagak";
            $file_name = ($this->gambar->is_gambar_have_image(1)) ? $current_picture : NULL;
        }
    }
}