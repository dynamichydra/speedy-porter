<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('general_model');
    }


    public function dash() {
      $arr = [];


    }


    public function index() {
      if($this->session->userdata('user_type') == '')
    	// if(empty($this->session->userdata('name')))
      redirect('login');;
      $input = $this->input->post();

        $data = array();
        $arr = [];
        if($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'branch'){

          if(isset($input['from_date']) && $input['from_date']!='__-__-____'){
            $arr['from_date'] = $input['from_date'];
          }
          if(isset($input['to_date']) && $input['to_date']!='__-__-____'){
            $arr['to_date'] = $input['to_date'];
          }
          if(isset($input['office_id']) && $input['office_id']!=''){
            $arr['branch'] = $input['office_id'];
          }

          if($this->session->userdata('user_type') == 'branch'){
            $byid = $this->session->userdata('id');
          }else{
            $byid = "";
          }
        $data['today_new_order'] = $this->general_model->get_all_order_today($arr);
        $data['total_cancelled'] = $this->general_model->get_all_cancelled($arr);
        $data['total_received'] = $this->general_model->get_all_received($arr);
        $data['new_order'] = $this->general_model->getorder_today($arr);
        $data['total_in_transit'] = $this->general_model->get_all_transit($arr);
        $data['total_delivery'] = $this->general_model->get_all_delivered($arr);
        $data['total_rescheduled'] = $this->general_model->get_all_rescheduled($arr);
        $data['total_returned'] = $this->general_model->get_all_returned($arr);

        $data['paidAmount'] = $this->general_model->get_all_amountpaid($arr);
        $data['cash_due'] = $this->general_model->get_all_cashdue($arr);
        $data['paidAmount_tomerchant'] = $this->general_model->get_all_amountpaid_to_merchant($arr);
        $data['dueAmount_tomerchant'] = $this->general_model->get_all_amountdue_to_merchant($arr);

        $data['cashin'] = $this->general_model->get_all_cashin($arr);
        $data['cashout'] = $this->general_model->get_all_cashout($arr);
        $data['balance'] = $data['cashin'][0]['cash_in'] - $data['cashout'][0]['cash_out'];

        $dcdue= $this->general_model->getall_dcdue($arr);
        $data['sumdcdue'] = 0;
        if(!empty($dcdue)){
        foreach ($dcdue as $k => $v) {
          if($v['delivery_status'] == 'returned'){
            $data['sumdcdue'] = $data['sumdcdue'] + floatval($v['deduction_amount']);
          }else{
            $data['sumdcdue'] = $data['sumdcdue'] + floatval($v['total_price']) + floatval($v['total_cod_charge']);
          }
        }
      }

      $data['sumdcpaid'] = 0;
      $dcpaid= $this->general_model->getall_dcpaid($arr);
      if(!empty($dcpaid)){
      foreach ($dcpaid as $k => $v) {
        if($v['delivery_status'] == 'returned'){
          $data['sumdcpaid'] = $data['sumdcpaid'] + floatval($v['deduction_amount']);
        }else{
          $data['sumdcpaid'] = $data['sumdcpaid'] + floatval($v['total_price']) + floatval($v['total_cod_charge']);
        }
      }
    }

    $data['mp_due'] = 0;
    $mpalldue= $this->general_model->mp_due($arr);
    if(!empty($mpalldue)){
    foreach ($mpalldue as $k => $v) {
      if($v['delivery_status'] == 'delivered'){
        $data['mp_due'] = $data['mp_due'] + ($v['paytomerch']-floatval($v['less_paid_return']));
      }elseif($v['delivery_status'] == "returned"){
        if($v['deduction_status'] == 1){
          $data['mp_due'] = $data['mp_due'] + ($v['amount_paid']-floatval($v['deduction_amount']));
        }elseif ($v['amount_paid'] == 0) {
          $data['mp_due'] = $data['mp_due'] + 0;
        }else{
          $data['mp_due'] = ($data['mp_due'] + floatval($v['amount_paid']))-(floatval($v['total_price'])+floatval($v['total_cod_charge'])+floatval($v['return_extra']));
        }
        }
    }
  }
        // print_r($data['paidAmount']);die;

        $data['today_all_payment'] = $this->general_model->get_all_payment_today();
        $data['total_payment'] = $this->general_model->get_all_payment();
        $grandTotal = $this->general_model->get_all_grandtotal();
        $data['total_due'] = $grandTotal[0]['grand_sum'] - $data['paidAmount'][0]['paidAmount'];
        // $data['total_due'] = $this->general_model->get_all_duePayment();
        $data['total_earned'] = $this->general_model->get_all_earning();
        $data['total_pending'] = $this->general_model->get_all_pending($byid);


      }else if($this->session->userdata('user_type') == 'customer'){
        // print_r($input);die;
        if(isset($input['from_date']) && $input['from_date']!='__-__-____'){
          $arr['from_date'] = $input['from_date'];
        }
        if(isset($input['to_date']) && $input['to_date']!='__-__-____'){
          $arr['to_date'] = $input['to_date'];
        }

        $customerId = $this->session->userdata('id');
        $arr['customerid'] = $customerId;

        $data['total_order'] = $this->general_model->get_allorder($arr);
        $data['today_new_order'] = $this->general_model->get_all_order_todayforcustomer($arr);
        $data['total_delivery'] = $this->general_model->get_all_deliveredforcustomer($arr);
        $data['total_cancelled'] = $this->general_model->get_all_cancelledforcustomer($arr);
        $data['total_received'] = $this->general_model->get_all_receivedforcustomer($arr);
        $data['total_intransit'] = $this->general_model->get_all_transitforcustomer($arr);
        $data['total_reschedule'] = $this->general_model->get_all_rescheduleforcustomer($arr);
        $data['total_returned'] = $this->general_model->get_all_returnforcustomer($arr);

        $data['total_sales'] = $this->general_model->get_totalsales($customerId);
        $data['total_paid'] = $this->general_model->get_totalpaid($customerId);
        $data['total_due'] = $this->general_model->get_totaldue($customerId);
        $data['total_dcpaid'] = $this->general_model->get_totaldcpaid($customerId);
        // print_r($data['total_dcpaid']);die;
    }else if($this->session->userdata('user_type') == 'delivery'){
        $dboyId = $this->session->userdata('id');
      $data['total_deliveries'] = $this->general_model->get_alldeliveries($dboyId);
      $data['total_deliveries_today'] = $this->general_model->get_alldeliveries_today($dboyId);
    }
        // print_r($data['today_new_order']);
        // die;
        $data['src'] = $input;
        $data['branch'] = $this->general_model->get_where_all('branch', ["status" => "active"]);
        $content = $this->load->view('admin/dashboard/index0', $data, true);
        $renderdata=['page_title'=>'Welcome to SPEEDY PORTER','content'=>$content];
        render($renderdata);
    }

public function getnum(){
  $numbers = $this->general_model->get_allnum();
  // echo '<pre>';
  // print_r($numbers);
  // echo '</pre>';die;
  $allnums = array_column($numbers, 'phone');
  $numstosend = implode(",",$allnums);
  echo $numstosend;die;
}

}
