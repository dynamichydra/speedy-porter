<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('report_model');
        // $this->load->model('customer_model');
        // $this->load->model('package_model');
        $this->load->model('consignment_model');
    }


    public function financial_report(){
      if($this->session->userdata('user_type')== '')
      redirect('admin');
      $row = $this->input->post();
      // print_r($row);
      // $this->data['src']=$row;
      $arr = [];
      $arr['customer_id'] = $_SESSION['id'];
      if(isset($row['from_date']) && $row['from_date']!='__-__-____'){
        $arr['from_date'] = $row['from_date'];
      }
      if(isset($row['to_date']) && $row['to_date']!='__-__-____'){
        $arr['to_date'] = $row['to_date'];
      }
      if(isset($row['pstatus']) && $row['pstatus']!=''){
        $arr['pstatus'] = $row['pstatus'];
      }
      // if($this->session->userdata('user_type')== 'customer'){
      //   $arr['created_by'] = $this->session->userdata('id');
      // }
      $data = array();
      $pageData = ['title' => 'Financial report', 'nav' => ['dashboard' => 'Dashboard','blank' => 'Financial report list']];
      $data['result'] = $this->report_model->getconsignmentInfo($arr);
      $data['status'] = $this->report_model->get_payment_status('consignment', ['status' => 'active']);
      $data['merchant'] = $this->consignment_model->get_where_all('customer', ['status' => 'active']);
      $data['src'] = $row;
      $content = $this->load->view('merchant/financial_report_merchant', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
      $renderdata = ['page_title' => 'Financial Report', 'js' => ['financial_merchant'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }

    public function payment_report1(){
      if($this->session->userdata('user_type')== '')
      redirect('admin');
      $row = $this->input->post();
      $arr = [];
      $arr['customer_id'] = $_SESSION['id'];
      // if($this->session->userdata('user_type')== 'customer'){
      //   $arr['created_by'] = $this->session->userdata('id');
      // }
      $data = array();
      $pageData = ['title' => 'Payment report', 'nav' => ['dashboard' => 'Dashboard','blank' => 'Payment report list']];
      $data['transaction'] = $this->consignment_model->get_where_all('trans_history');
      $data['src'] = $row;
      $content = $this->load->view('merchant/payment_report', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
      $renderdata = ['page_title' => 'Payment Report', 'js' => ['payment_report'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }

    public function payment_report(){
      if($this->session->userdata('user_type')== '')
      redirect('admin');
      $row = $this->input->post();
      $arr = [];
      $arr['customer_id'] = $_SESSION['id'];
      $data = array();
      $pageData = ['title' => 'Payment report', 'nav' => ['dashboard' => 'Dashboard','blank' => 'Payment report list']];
      $data['transaction'] = $this->consignment_model->get_where_all('trans_history',['merchant'=>$arr['customer_id']]);
      $data['src'] = $row;
      // echo "<pre>";
      // print_r($data['transaction']);
      // echo"</pre>";die;
      $content = $this->load->view('merchant/payment_report1', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
      $renderdata = ['page_title' => 'Payment Report', 'js' => ['payment_report'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }

    // public function read(){
    //   $transaction = $this->consignment_model->get_cahnge();
    //   foreach ($transaction as $k => $v) {
    //     $ar = $v['consignments'];
    //     $consignments = explode(',', $ar);
    //     $sumcashcollection = 0;
    //     $sumdeliverycharge = 0;
    //     $sumcodcharge = 0;
    //     $sumreturncharge = 0;
    //     $sumramntpaid = 0;
    //     $merchant = "";
    //     // print_r($consignments);die;
    //     foreach ($consignments as $key => $value) {
    //       $detail = $this->consignment_model->get_where_all('consignment',['consignment_id' => $value]);
    //       // print_r($detail);die;
    //       $sumcashcollection = $sumcashcollection+floatval($detail[0]['cash_collection']);
    //       $sumdeliverycharge = $sumdeliverycharge+floatval($detail[0]['total_price']);
    //       $sumcodcharge = $sumcodcharge+floatval($detail[0]['total_cod_charge']);
    //       $sumreturncharge = $sumreturncharge+floatval($detail[0]['deduction_amount']);
    //       $sumramntpaid = $sumramntpaid+floatval($detail[0]['amount_paid']);
    //       $merchant = $detail[0]['customer'];
    //     }
    //     echo  "id = ".$v['id']."  /invoice_no =".$v['invoice_no']."/ merchant = ".$merchant."/ Cash Collection= ".$sumcashcollection."/ Delivery Charge= ".$sumdeliverycharge."/ COD Charge= ".$sumcodcharge."/ Return Charge= ".$sumreturncharge."/ Collected Amount= ".$sumramntpaid."/ Amount Paid= ".$v['amount_paid']."<br>";
    //     $this->consignment_model->update('trans_history', ['merchant' => $merchant,
    //     'cash_collection' => $sumcashcollection,
    //     'del_charge' => $sumdeliverycharge,
    //     'cod_charge' => $sumcodcharge,
    //     'return_charge' => $sumreturncharge,
    //     'collected' => $sumramntpaid,
    //   'updates'=>1],['id'=>$v['id']]);
    //   }
    //   // echo "<pre>";
    //   // print_r($data['transaction']);
    //   // echo "</pre>";
    // }

    public function payment_history(){
      if($this->session->userdata('user_type')== '')
      redirect('admin');
      $row = $this->input->post('consignments');
      $consignments = explode(',', $row);
      $out = array();
      foreach ($consignments as $name => $value) {
          array_push($out, "'$value'");
      }
      $consout = implode(",",$out);
      $data = array();
      $pageData = ['title' => 'Payment History', 'nav' => ['dashboard' => 'Dashboard', 'report/payment_report' => 'Payment Report','blank' => 'Payment History list']];
      $data['tran_history'] = $this->consignment_model->get_history($consout);
      $content = $this->load->view('merchant/payment_history', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
      $renderdata = ['page_title' => 'Payment History', 'js' => ['payment_report'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }

    public function payout_collection(){
      if($this->session->userdata('user_type')== '')
      redirect('admin');
      $row = $this->input->post();
      // print_r($row);
      $this->data['src']=$row;
      $arr = [];

      $arr['customer_id'] = $_SESSION['id'];
      if(isset($row['from_date']) && $row['from_date']!='__-__-____'){
        $arr['from_date'] = $row['from_date'];
      }
      if(isset($row['to_date']) && $row['to_date']!='__-__-____'){
        $arr['to_date'] = $row['to_date'];
      }
      if(isset($row['pstatus']) && $row['pstatus']!=''){
        $arr['pstatus'] = $row['pstatus'];
      }
      $data = array();
      $pageData = ['title' => 'Payout Collection', 'nav' => ['dashboard' => 'Dashboard','blank' => 'Payout Collection list']];
      $data['result'] = $this->report_model->getconsignmentInfomerchantpayout($arr);
      $data['status'] = $this->report_model->get_payment_status('consignment', ['status' => 'active']);
      $data['merchant'] = $this->consignment_model->get_where_all('customer', ['status' => 'active']);
      $data['src'] = $row;
      $content = $this->load->view('merchant/payout_collection', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
      $renderdata = ['page_title' => 'Payout Collection', 'js' => ['merchant_payout'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }


}
