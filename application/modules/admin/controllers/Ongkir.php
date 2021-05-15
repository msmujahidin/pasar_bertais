<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ongkir extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        verify_session('admin');

        $this->load->library('form_validation');
        $this->load->model('setting_model', 'setting');
        $this->load->model('alamat_model', 'ongkir');
    }

    public function index()
    {
        $params['title'] = 'Pengaturan Ongkir';

        $data['flash'] = $this->session->flashdata('settings_flash');
        $data['ongkir'] = $this->ongkir->getAll();

        $this->load->view('header', $params);
        $this->load->view('ongkir/ongkir', $data);
        $this->load->view('footer');
    }

    public function _get_ongkir_list()
    {
        $ongkirs = $this->ongkir->getAll();
        $n = 0;

        foreach ($ongkirs as $ongkir)
        {
            $ongkirs[$n]->ongkir = 'Rp '. format_rupiah($ongkir->ongkir);
            $ongkirs[$n]->gratis_bila = 'Rp '. format_rupiah($ongkir->gratis_bila);

            $n++;
        }

        return $ongkirs;
    }

    public function ongkir_api()
    {
        $action = $this->input->get('action');

        switch ($action) {
            case 'ongkir_list' :
                $ongkirs['data'] = $this->_get_ongkir_list();

                $response = $ongkirs;
            break;
            case 'view_data' :
                $id = $this->input->get('id');

                $data['data'] = $this->ongkir->ongkir_data($id);
                $response = $data;
            break;
            case 'add_ongkir' :
                $kecamatan = $this->input->post('kecamatan');
                $kabupaten_kota = $this->input->post('kabupaten_kota');
                $provinsi = $this->input->post('provinsi');
                $ongkir = $this->input->post('ongkir');
                $gratis_bila = $this->input->post('gratis_bila');

                $data_ongkir = array(
                    'kecamatan' => $kecamatan,
                    'kabupaten_kota' => $kabupaten_kota,
                    'provinsi' => $provinsi,
                    'ongkir' => $ongkir,
                    'gratis_bila' => $gratis_bila,
                );

                $this->ongkir->add_ongkir($data_ongkir);
                $ongkirs['data'] = $this->_get_ongkir_list();
            
                $response = $ongkirs;
            break;
            case 'delete_ongkir' :
                $id = $this->input->post('id');

                $this->ongkir->delete_ongkir($id);
                $response = array('code' => 204, 'message' => 'Data Kecamatan berhasil dihapus!');
            break;
            case 'edit_ongkir' :
                $id = $this->input->post('id');

                $kecamatan = $this->input->post('kecamatan');
                $kabupaten_kota = $this->input->post('kabupaten_kota');
                $provinsi = $this->input->post('provinsi');
                $ongkir = $this->input->post('ongkir');
                $gratis_bila = $this->input->post('gratis_bila');

                $data_ongkir = array(
                    'kecamatan' => $kecamatan,
                    'kabupaten_kota' => $kabupaten_kota,
                    'provinsi' => $provinsi,
                    'ongkir' => $ongkir,
                    'gratis_bila' => $gratis_bila,
                );

                $this->ongkir->edit_ongkir($id, $data_ongkir);
                $response = array('code' => 201, 'message' => 'Data Kecamatan berhasil diperbarui');
            break;
        }

        $response = json_encode($response);
        $this->output->set_content_type('application/json')
            ->set_output($response);
    }
}