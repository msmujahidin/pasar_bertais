<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        verify_session('admin');

        $this->load->model(array(
            'customer_model' => 'customer',
            'order_model' => 'order',
            'payment_model' => 'payment',
        ));
        $this->load->library(['form_validation', 'encryption']);
        $this->load->model('auth/Register_model', 'register');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $params['title'] = 'Kelola Customers';

        $this->load->view('header', $params);
        $this->load->view('customers/customers');
        $this->load->view('footer');
    }

    public function view($id = 0)
    {
        if ( $this->customer->is_customer_exist($id))
        {
            $data = $this->customer->customer_data($id);

            $params['title'] = $data->name;

            $customer['customer'] = $data;
            $customer['flash'] = $this->session->flashdata('customer_flash');
            $customer['orders'] = $this->order->order_by($id);
            $customer['payments'] = $this->payment->payment_by($id);

            $this->load->view('header', $params);
            $this->load->view('customers/view', $customer);
            $this->load->view('footer');
        }
        else
        {
            show_404();
        }
    }

    public function edit($id = 0)
    {
        if ( $this->customer->is_customer_exist($id))
        {
            $data = $this->customer->customer_data($id);

            $params['title'] = $data->name;

            $customer['customer'] = $data;
            $customer['flash'] = $this->session->flashdata('customer_flash');
            $customer['orders'] = $this->order->order_by($id);
            $customer['payments'] = $this->payment->payment_by($id);

            // print_r($customer);
            $this->load->view('header', $params);
            $this->load->view('customers/update_form', $customer);
            $this->load->view('footer');
        }
        else
        {
            show_404();
        }
    }

    public function edit_customer($id = 0){
        if ( $this->customer->is_customer_exist($id)){
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
                $diskon = $this->input->post('diskon');
                $kode_refral = $this->input->post('kode_refral');
                $nilai_refral = $this->input->post('nilai_refral');
                $profile_picture = 'default.png';

                $customer_data = array(
                    'name' => $name,
                    'phone_number' => $phone_number,
                    'profile_picture' => $profile_picture,
                    'diskon' => $diskon,
                    'kode_refral' => $kode_refral,
                    'nilai_refral' => $nilai_refral,
                    'address' => $address
                );

                $this->customer->update($id, $customer_data);

                $this->session->set_flashdata('store_flash', 'Update Data Reseller berhasil!');

                redirect('admin/customers');
            }
        }
        else{
            show_404();

        }
    }
    public function create()
    {
        $params['title'] = 'Tambah Reseler Baru';

        $data['flash'] = $this->session->flashdata('add_new_product_flash');

        $this->load->view('header', $params);
        $this->load->view('customers/create_form', $data);
        $this->load->view('footer');
    }

    public function api($action = '')
    {
        switch ($action)
        {
            case 'customers' :
                $customers = $this->customer->get_all_customers();

                $n = 0;
                foreach ($customers as $customer)
                {
                    $customers[$n]->profile_picture = base_url('assets/uploads/users/'. $customer->profile_picture);

                    $n++;
                }

                $customers['data'] = $customers;

                $response = $customers;
            break;
            case 'delete' :
                $id = $this->input->post('id');

                $this->customer->delete_customer($id);

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
        $this->form_validation->set_rules('phone_number', 'No. HP', 'required|min_length[9]|max_length[16]|is_unique[customers.phone_number]');
        $this->form_validation->set_rules('email', 'Email', 'required|min_length[10]');
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

            $customer_data = array(
                'user_id' => $user,
                'name' => $name,
                'phone_number' => $phone_number,
                'profile_picture' => $profile_picture,
                'address' => $address
            );

            $this->register->register_customer($customer_data);

            $this->session->set_flashdata('store_flash', 'Pendaftaran akun berhasil!');

            redirect('admin/customers');
        }
    }
}