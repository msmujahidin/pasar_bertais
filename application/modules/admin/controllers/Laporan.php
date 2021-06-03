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
        echo $income;

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

    public function add_other_income(){
    }
}