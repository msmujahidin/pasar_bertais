<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        verify_session('admin');

        $this->load->model(array(
            'product_model' => 'product',
            'customer_model' => 'customer',
            'order_model' => 'order',
            'payment_model' => 'payment',
            'laporan_model' => 'laporan'
        ));
    }

    public function index()
    {
        $params['title'] = 'Admin '. get_store_name();

        $first_date = $this->input->post('first_date');
        $second_date = $this->input->post('second_date');
        $overview['first_date'] = $first_date;
        $overview['second_date'] = $second_date;

        // Ambil nilai last income
        $income = 0;
        if($first_date){
            $report_incomes = $this->laporan->get_income_between($first_date, $second_date);
            foreach($report_incomes as $report){              
                $income += $report->income;
            }
        }else{
            $report_income = $this->laporan->get_last_income();
            $income = $report_income->income;
        }
        $overview['income'] = $income;

        // // 
        $other_incomes = $this->laporan->get_other_income();
        $total_other_income = 0;
        foreach($other_incomes as $other){
            $total_other_income += $other->value;
        }
        $outcomes = $this->laporan->get_outcome();
        $total_outcome = 0;
        foreach($outcomes as $outcome){
            $total_outcome += $outcome->value;
        }
        

        $overview['other_incomes'] = $other_incomes;
        $overview['outcomes'] = $outcomes;

        // hitung total income, outcome, profit
        $total_income = $income + $total_other_income;
        $total_profit = $total_income - $total_outcome;
        $overview['total_income'] = $total_income;
        $overview['total_outcome'] = $total_outcome;
        $overview['total_profit'] = $total_profit;

        $this->load->view('header', $params);
        $this->load->view('laporan/laporan', $overview);
        $this->load->view('footer');
    }

    public function income_api()
    {
        $action = $this->input->get('action');
        $id = $this->input->get('id');

        switch ($action) {
            case 'add_income' :
                $name = $this->input->post('name');
                $value = $this->input->post('value');
                $data = array(
                    'name' => $name, 
                    'value' =>$value
                );
                $this->laporan->add_other_income($data);
                redirect('admin/laporan/');
            break;
            case 'update_income' :
                $id = $this->input->post('id');
                $name = $this->input->post('name');
                $value = $this->input->post('value');
                $data = array(
                    'name' => $name, 
                    'value' =>$value
                );
                $this->laporan->update_other_income($id,$data);
                redirect('admin/laporan/');
            break;
            case 'delete_income' :
                $this->laporan->delete_other_income($id);
                redirect('admin/laporan/');
            break;
        }
    } 
    public function outcome_api()
    {
        $action = $this->input->get('action');
        $id = $this->input->get('id');

        switch ($action) {
            case 'create' :
                $name = $this->input->post('name');
                $value = $this->input->post('value');
                $data = array(
                    'name' => $name, 
                    'value' =>$value
                );
                $this->laporan->add_outcome($data);
                redirect('admin/laporan/');
            break;
            case 'update' :
                $id = $this->input->post('id');
                $name = $this->input->post('name');
                $value = $this->input->post('value');
                $data = array(
                    'name' => $name, 
                    'value' =>$value
                );
                $this->laporan->update_outcome($id,$data);
                redirect('admin/laporan/');
            break;
            case 'delete' :
                $this->laporan->delete_outcome($id);
                redirect('admin/laporan/');
            break;
        }
    }
}