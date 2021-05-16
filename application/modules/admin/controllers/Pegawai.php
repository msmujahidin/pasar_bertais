<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        verify_session('admin');

        $this->load->model(array(
            'pegawai_model' => 'pegawai',
        ));
        $this->load->library(['form_validation', 'encryption']);
        $this->load->model('auth/Register_model', 'register');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $params['title'] = 'Kelola Pegawai';

        $this->load->view('header', $params);
        $this->load->view('pegawai/pegawai');
        $this->load->view('footer');
    }

    public function view($id = 0)
    {
        if ( $this->pegawai->is_pegawai_exist($id))
        {
            $data = $this->pegawai->pegawai_data($id);

            $params['title'] = $data->name;

            $pegawai['pegawai'] = $data;
            $pegawai['flash'] = $this->session->flashdata('pegawai_flash');

            $this->load->view('header', $params);
            $this->load->view('pegawai/view', $pegawai);
            $this->load->view('footer');
        }
        else
        {
            show_404();
        }
    }

    public function edit($id = 0)
    {
        if ( $this->pegawai->is_pegawai_exist($id))
        {
            $data = $this->pegawai->pegawai_data($id);

            $params['title'] = $data->name;

            $pegawai['pegawai'] = $data;
            $pegawai['flash'] = $this->session->flashdata('pegawai_flash');

            $this->load->view('header', $params);
            $this->load->view('pegawai/update_form', $pegawai);
            $this->load->view('footer');
        }
        else
        {
            show_404();
        }
    }

    public function edit_pegawai($id = 0){
        if ( $this->pegawai->is_pegawai_exist($id)){
            $this->form_validation->set_error_delimiters('<div class="text-danger font-weight-bold"><small>', '</small></div>');

            $this->form_validation->set_rules('name', 'Nama lengkap', 'required');
            $this->form_validation->set_rules('phone_number', 'No. HP', 'required|min_length[9]|max_length[16]');
            $this->form_validation->set_rules('address', 'Alamat', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                $this->edit($id);
            }
            else
            {
                $name = $this->input->post('name');
                $phone_number = $this->input->post('phone_number');
                $address = $this->input->post('address');
                $profile_picture = 'default.png';

                $pegawai_data = array(
                    'name' => $name,
                    'phone_number' => $phone_number,
                    'profile_picture' => $profile_picture,
                    'address' => $address
                );

                $this->pegawai->update($id, $pegawai_data);

                $this->session->set_flashdata('store_flash', 'Update Data Pegawai berhasil!');

                redirect('admin/pegawai');
            }
        }
        else{
            show_404();

        }
    }
    public function create()
    {
        $params['title'] = 'Tambah Pegawai Baru';

        $data['flash'] = $this->session->flashdata('add_new_product_flash');

        $this->load->view('header', $params);
        $this->load->view('pegawai/create_form', $data);
        $this->load->view('footer');
    }

    public function api($action = '')
    {
        switch ($action)
        {
            case 'pegawai' :
                $pegawai = $this->pegawai->get_all_pegawai();

                $n = 0;
                foreach ($pegawai as $pgw)
                {
                    $pegawai[$n]->profile_picture = base_url('assets/uploads/users/'. $pgw->profile_picture);

                    $n++;
                }

                $pegawai['data'] = $pegawai;

                $response = $pegawai;
            break;
            case 'delete' :
                $id = $this->input->post('id');

                $this->pegawai->delete_pegawai($id);

                $response = array('code' => 204);
            break;
        }

        $response = json_encode($response);
        $this->output->set_content_type('application/json')
            ->set_output($response);
    }
    public function verify()
    {
        $this->form_validation->set_error_delimiters('<div class="text-danger font-weight-bold"><small>', '</small></div>');

        $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[16]|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
        $this->form_validation->set_rules('name', 'Nama lengkap', 'required');
        $this->form_validation->set_rules('phone_number', 'No. HP', 'required|min_length[9]|max_length[16]|is_unique[pegawai.phone_number]');
        $this->form_validation->set_rules('email', 'Email', 'required|min_length[10]|is_unique[users.email]');
        $this->form_validation->set_rules('address', 'Alamat', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->create();
        }
        else
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $name = $this->input->post('name');
            $phone_number = $this->input->post('phone_number');
            $email = $this->input->post('email');
            $address = $this->input->post('address');
            $profile_picture = 'default.png';

            $password = password_hash($password, PASSWORD_BCRYPT);

            $user_data = array(
                'name' => $name,
                'email' => $email,
                'username' => $username,
                'password' => $password,
                'profile_picture' => $profile_picture,
                'role_id' => 2,
                'register_date' => date('Y-m-d H:i:s')
            );
            
            $user = $this->register->register_user($user_data);

            $pegawai_data = array(
                'user_id' => $user,
                'name' => $name,
                'phone_number' => $phone_number,
                'profile_picture' => $profile_picture,
                'address' => $address
            );

            $this->register->register_pegawai($pegawai_data);

            $this->session->set_flashdata('store_flash', 'Pendaftaran akun berhasil!');

            redirect('admin/pegawai');
        }
    }
}