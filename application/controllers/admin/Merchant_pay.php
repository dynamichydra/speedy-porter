<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Merchant_pay extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Merchant_pay_model');
    }

    public function index() {
      if($this->session->userdata('user_type') == '')
        // if(empty($this->session->userdata('name')))
      redirect('admin');
        $data = array();
        $data['row'] = $this->Merchant_pay_model->get_all();
        $content = $this->load->view('admin/merchant_pay/index', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Transaction History', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Transaction History']], true);
        $renderdata = ['page_title' => 'Transaction History', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function all() {
      ini_set('memory_limit','1024M');
      if($this->session->userdata('user_type') == '')
        // if(empty($this->session->userdata('name')))
      redirect('admin');
      $input = $this->input->post();
      $arr = [];

      if(isset($input['company']) && $input['company']!=''){
        $arr['company'] = $input['company'];
      }
      if(isset($input['from_date']) && $input['from_date']!='__-__-____'){
        $arr['from_date'] = $input['from_date'];
      }
      if(isset($input['to_date']) && $input['to_date']!='__-__-____'){
        $arr['to_date'] = $input['to_date'];
      }
        $arr['status'] = 'active';
        $data = array();
        $data['src'] = $input;
        $data['row'] = $this->Merchant_pay_model->getall($arr);
        $data['merch'] = $this->Merchant_pay_model->get_where_all('customer', ['status'=>'active']);
        $content = $this->load->view('admin/merchant_pay/all', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Merchant Payment List', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Merchant Payment List']], true);
        $renderdata = ['page_title' => 'Merchant Payment List', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function create() {
        $data = array();
        $pageData = ['title' => 'Pay Merchant', 'nav' => ['dashboard' => 'Dashboard', 'index' => 'Transaction History', 'blank' => 'Pay Merchant']];
        // $data['consignment_id'] = $this->assign_deliveryperson_model->get_all_consignment_notAssigned();
        $data['merchant'] = $this->Merchant_pay_model->get_where_all('customer', ['status' => 'active']);
        $content = $this->load->view('admin/merchant_pay/create', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Pay Merchant', 'js' => ['assign_delivery_multiple'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }


    // public function createsave() {
    //     $merch = $this->input->post("merchant");
    //     $t_amount = $this->input->post("t_amount");
    //     $ar = $this->input->post('consignment_id');
    //     $consignments = implode(', ', $ar);
    //     $date = date("Y-m-d H:i:s");
    //     if(!empty($ar)){
    //       $this->Merchant_pay_model->insert('trans_history', ['amount_paid' => $t_amount,
    //           'merchant' => $merch
    //           ]);
    //             foreach ($ar as $key => $value) {
    //               $res = $this->Merchant_pay_model->get_price($value);
    //                   if($res){
    //               $this->Merchant_pay_model->insert('merchant_payout', ['amount_paid' => $res[0]['total_price_product'],
    //                   'consignmentId' => $res[0]['consignment_id'],'date' => $date
    //                   ]);
    //                   $this->Merchant_pay_model->update('consignment', [
    //                       'payment_status_merchant' => 'paid','merchant_payout'=> $res[0]['total_price_product']], ['id' => $value]);
    //                     }
    //               $response['message'] = "Paid succesfully";
    //               $response['success'] = true;
    //             }
    //           }else{
    //             $response['message'] = "Please choose consignments to pay";
    //             $response['success'] = false;
    //           }
    //
    //     $this->output->set_content_type('application/json')
    //             ->set_output(json_encode($response))->_display();
    //     exit();
    // }

    public function createsave() {
        $t_amount = $this->input->post("amounttopay");
        $ar = $this->input->post('all_merch');
        $consignments = explode(',', $ar);
        $date = date("Y-m-d H:i:s");
        $date_accounts = date("Y-m-d");

          $sumcashcollection = 0;
          $sumdeliverycharge = 0;
          $sumcodcharge = 0;
          $sumreturncharge = 0;
          $sumramntpaid = 0;
          $merchant = "";
          // print_r($consignments);die;
          foreach ($consignments as $key => $value) {
            $detail = $this->Merchant_pay_model->get_where_all('consignment',['consignment_id' => $value]);
            // print_r($detail);die;
            $sumcashcollection = $sumcashcollection+floatval($detail[0]['cash_collection']);
            $sumdeliverycharge = $sumdeliverycharge+floatval($detail[0]['total_price']);
            $sumcodcharge = $sumcodcharge+floatval($detail[0]['total_cod_charge']);
            $sumreturncharge = $sumreturncharge+floatval($detail[0]['deduction_amount']);
            $sumramntpaid = $sumramntpaid+floatval($detail[0]['amount_paid']);
            $merchant = $detail[0]['customer'];
          }

        if(!empty($merchant)){
          $invno = 'AB-INV-'.$this->random_strings(4);
          $merch_detail = $this->Merchant_pay_model->get_where_all('customer',['id' => $merchant]);
          $merch_office = $this->Merchant_pay_model->get_where_all('branch',['id' => $merch_detail[0]['office']]);

          $res = $this->Merchant_pay_model->insert('trans_history', ['invoice_no' => $invno,
          'merchant' => $merchant,
          'cash_collection' => $sumcashcollection,
          'del_charge' => $sumdeliverycharge,
          'cod_charge' => $sumcodcharge,
          'return_charge' => $sumreturncharge,
          'collected' => $sumramntpaid,
          'consignments' => $ar,
          'amount_paid' => $t_amount]);

          $res12 = $this->Merchant_pay_model->insert('expenses', ['exp_date' => $date_accounts,
          'voucher_no' => $invno,
          'name' => $merch_detail[0]['company'],
          'office' => $merch_office[0]['name'],
          'exp_type' => 'N/A',
          'narration' => 'Merchant Payment',
          'designation' => 'Merchant',
          'del_charge' => $sumdeliverycharge,
          'cash_in' => 0,
          'cash_out' => $t_amount,
          'exp_nature' => 'invoice',
          'entry_type' => 'auto']);

          if($res){
                foreach ($consignments as $key => $value) {
                      $this->Merchant_pay_model->update('consignment', [
                          'payment_status_merchant' => 'paid'], ['consignment_id' => $value]);
                        }
                      }else{
                        $response['message'] = "Operation failed pls try again";
                        $response['success'] = false;
                      }
                  redirect('admin/merchant_pay/all');
              }else{
                $response['message'] = "Something went wrong pls try again!";
                $response['success'] = false;
              }

        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function random_strings($length_of_string)
  {
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    return substr(str_shuffle($str_result),
                       0, $length_of_string);
  }

    public function createsave_branch() {
        $t_amount = $this->input->post("amounttopay");
        $ar = $this->input->post('all_merch');
        $trname = $this->input->post('tspoter');
        $consignments = explode(',', $ar);
        $date = date("Y-m-d H:i:s");
        $date_accounts = date("Y-m-d");
        if(!empty($consignments)){
          $invno = 'AB-TNS-'.$this->random_strings(4);
          $res = $this->Merchant_pay_model->insert('trans_history', ['invoice_no' => $invno,
          'consignments' => $ar,
          'amount_paid' => $t_amount]);

          $res12 = $this->Merchant_pay_model->insert('expenses', ['exp_date' => $date_accounts,
          'voucher_no' => $invno,
          'name' => $trname,
          'office' => $trname,
          'exp_type' => 'N/A',
          'narration' => 'Branch Collection',
          'designation' => 'Branch',
          'del_charge' => 0,
          'cash_in' => $t_amount,
          'cash_out' => 0,
          'exp_nature' => 'transaction',
          'entry_type' => 'auto']);

                foreach ($consignments as $key => $value) {
                      $this->Merchant_pay_model->update('consignment', [
                          'head_office_paid' => 'received'], ['consignment_id' => $value]);
                        }
                  redirect('admin/merchant_pay/cash_collection_branch');
              }else{
                $response['message'] = "Please choose consignments to pay";
                $response['success'] = false;
              }

        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function createsave_transporter() {
        $t_amount = $this->input->post("amounttopay");
        $ar = $this->input->post('all_merch');
        $trname = $this->input->post('tspoter');
        $consignments = explode(',', $ar);
        $date = date("Y-m-d H:i:s");
        $date_accounts = date("Y-m-d");
        if(!empty($consignments)){
          $invno = 'AB-TNS-'.$this->random_strings(4);
          $tr_office = $this->Merchant_pay_model->get_where_all('delivery_person', ['name'=>$trname]);
          $tr_office_name = $this->Merchant_pay_model->get_where_all('branch', ['id'=>$tr_office[0]['office']]);
          $res = $this->Merchant_pay_model->insert('trans_history_accounts', ['tran_no' => $invno,
          'consignments' => $ar,
          'amount_paid' => $t_amount]);

          $res12 = $this->Merchant_pay_model->insert('expenses', ['exp_date' => $date_accounts,
          'voucher_no' => $invno,
          'name' => $trname,
          'office' => $tr_office_name[0]['name'],
          'exp_type' => 'N/A',
          'narration' => 'Transporter Collection',
          'designation' => $tr_office[0]['transporter_type'],
          'del_charge' => 0,
          'cash_in' => $t_amount,
          'cash_out' => 0,
          'exp_nature' => 'transaction',
          'entry_type' => 'auto']);
          if($res){
                foreach ($consignments as $key => $value) {
                      $this->Merchant_pay_model->update('consignment', [
                          'collection_status' => 'received'], ['consignment_id' => $value]);
                        }
                      }else{
                        $response['message'] = "something went wrong! Try again";
                        $response['success'] = false;
                      }
                  redirect('admin/merchant_pay/cash_collection');
              }else{
                $response['message'] = "Please choose consignments to pay";
                $response['success'] = false;
              }

        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function getConsignment() {

            $response = array();
            if ($this->input->post('merchant') > 0) {
                  $merchant= $this->input->post('merchant');
                  $response = $this->Merchant_pay_model->get_where_all('consignment', ['status' => 'assigned','customer'=>$merchant,'payment_status_merchant'=>'due','total_price_product!='=>""]);
                }
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();

    }

    public function getconsprice() {

            $data = 0;
            if ($this->input->post('cons')!= "") {
                  $consId= $this->input->post('cons');
                  foreach ($consId as $key => $value) {
                  $check = $this->Merchant_pay_model->get_consignmentPrice($value);
                  if(!empty($check)){
                  $data = $data+$check[0]['total_price_product'];
                }
              }
                $response = $data;
                }
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();

    }

    public function cash_collection() {
      if($this->session->userdata('user_type')== '')
        // if(empty($this->session->userdata('name')))
      redirect('admin');
      if($this->session->userdata('user_type')== 'admin' || $this->session->userdata('user_type')== 'branch' || $this->session->userdata('user_type')== 'staff'){

        if($this->input->post() == "" ){
          $row = $datarow;
        }else{
          $row = $this->input->post();
        }
        $arr = [];
        if(isset($row['status']) && $row['status']!=''){
          $arr['status'] = $row['status'];
        }
        if(isset($row['from_date']) && $row['from_date']!='__-__-____'){
          $arr['from_date'] = $row['from_date'];
        }
        if(isset($row['to_date']) && $row['to_date']!='__-__-____'){
          $arr['to_date'] = $row['to_date'];
        }
        if(isset($row['customer_id']) && $row['customer_id']!=''){
          $arr['delivery_person_id'] = $row['customer_id'];
        }
        if(isset($row['user_type']) && $row['user_type']!=''){
          $arr['user_type'] = $row['user_type'];
        }
        if($this->session->userdata('user_type') != 'admin'){
        if(isset($_SESSION['branch']) && $_SESSION['branch'] != ''){
          $arr['sel_branch'] = $_SESSION['branch'];
        }
      }
        $data = array();
        $data['src'] = $row;
        $pageData = ['title' => 'Cash Collection List', 'nav' => ['dashboard' => 'Dashboard','blank' => 'Cash Collection List']];
        // $data['status'] = $this->Merchant_pay_model->get_status('consignment', ['status' => 'active']);
        $data['delivery_boy'] = $this->Merchant_pay_model->get_where_all('delivery_person', ['status' => 'active']);
        $data['rows'] = $this->Merchant_pay_model->get_all_list($arr);
        $content = $this->load->view('admin/merchant_pay/cash_collection', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Cash Collection List', 'js' => ['cash_collection'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
      }
    }

    public function cash_collection_demo($datarow = null) {
      if($this->session->userdata('user_type')== '')
        // if(empty($this->session->userdata('name')))
      redirect('admin');
      if($this->session->userdata('user_type')== 'admin' || $this->session->userdata('user_type')== 'branch' || $this->session->userdata('user_type')== 'staff'){

        if($this->input->post() == "" ){
          $row = $datarow;
        }else{
          $row = $this->input->post();
        }
        $arr = [];
        if(isset($row['status']) && $row['status']!=''){
          $arr['status'] = $row['status'];
        }
        if(isset($row['from_date']) && $row['from_date']!='__-__-____'){
          $arr['from_date'] = $row['from_date'];
        }
        if(isset($row['to_date']) && $row['to_date']!='__-__-____'){
          $arr['to_date'] = $row['to_date'];
        }
        if(isset($row['customer_id']) && $row['customer_id']!=''){
          $arr['delivery_person_id'] = $row['customer_id'];
        }
        if(isset($row['user_type']) && $row['user_type']!=''){
          $arr['user_type'] = $row['user_type'];
        }
        if($this->session->userdata('user_type') != 'admin'){
        if(isset($_SESSION['branch']) && $_SESSION['branch'] != ''){
          $arr['sel_branch'] = $_SESSION['branch'];
        }
      }
        $data = array();
        $data['src'] = $row;
        $pageData = ['title' => 'Cash Collection List', 'nav' => ['dashboard' => 'Dashboard','blank' => 'Cash Collection List']];
        $data['status'] = $this->Merchant_pay_model->get_status('consignment', ['status' => 'active']);
        $data['delivery_boy'] = $this->Merchant_pay_model->get_where_all('delivery_person', ['status' => 'active']);
        $data['rows'] = $this->Merchant_pay_model->get_all_list($arr);
        $content = $this->load->view('admin/merchant_pay/cash_collection0', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Cash Collection List', 'js' => ['cash_collection0'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
      }
    }

    public function cash_collection_branch() {
      if($this->session->userdata('user_type') == '')
        // if(empty($this->session->userdata('name')))
      redirect('admin');
      $input = $this->input->post();
      $arr = [];

      if(isset($input['office_id']) && $input['office_id']!=''){
        $arr['branch'] = $input['office_id'];
      }
      if(isset($input['from_date']) && $input['from_date']!='__-__-____'){
        $arr['from_date'] = $input['from_date'];
      }
      if(isset($input['to_date']) && $input['to_date']!='__-__-____'){
        $arr['to_date'] = $input['to_date'];
      }
        $arr['status'] = 'active';
        $data = array();
        $data['src'] = $input;
        $data['row'] = $this->Merchant_pay_model->getallforbranch($arr);
        $data['branch'] = $this->Merchant_pay_model->get_where_all('branch', ['status' => 'active', 'name!='=>'Head Office']);
        $data['merch'] = $this->Merchant_pay_model->get_where_all('customer', ['status'=>'active']);
        $content = $this->load->view('admin/merchant_pay/branch_cash', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Branch Collection List', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Branch Collection List']], true);
        $renderdata = ['page_title' => 'Branch Collection List', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function getcollectionlisted() {
      $row = $this->input->post();
      $arr = [];
      if(isset($row['status']) && $row['status']!=''){
        $arr['status'] = $row['status'];
      }
      if(isset($row['from_date']) && $row['from_date']!='__-__-____'){
        $arr['from_date'] = $row['from_date'];
      }
      if(isset($row['to_date']) && $row['to_date']!='__-__-____'){
        $arr['to_date'] = $row['to_date'];
      }
      if(isset($row['customer_id']) && $row['customer_id']!=''){
        $arr['delivery_person_id'] = $row['customer_id'];
      }
      if(isset($row['user_type']) && $row['user_type']!=''){
        $arr['user_type'] = $row['user_type'];
      }
      if($this->session->userdata('user_type') != 'admin'){
      if(isset($_SESSION['branch']) && $_SESSION['branch'] != ''){
        $arr['sel_branch'] = $_SESSION['branch'];
      }
    }
      // print_r($arr);die;
        $response = array();
                $response = $this->Merchant_pay_model->get_all_list($arr);


            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();
    }



}
