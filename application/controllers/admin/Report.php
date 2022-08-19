<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// require_once APPPATH."libraries/fpdf.php";

class Report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('report_model');
        $this->load->model('customer_model');
        $this->load->model('package_model');
        $this->load->model('consignment_model');
    }
    public function delivery_status() {
      if($this->session->userdata('user_type')== '')
        // if(empty($this->session->userdata('name')))
      redirect('admin');
      if($this->session->userdata('user_type')== 'admin' || $this->session->userdata('user_type')== 'branch' || $this->session->userdata('user_type')== 'staff'){
        $data = array();
        $pageData = ['title' => 'Delivery status list', 'nav' => ['dashboard' => 'Dashboard','blank' => 'Delivery status list']];
        $data['status'] = $this->report_model->get_status('consignment', ['status' => 'active']);
        $data['delivery_boy'] = $this->consignment_model->get_where_all('delivery_person', ['status' => 'active']);
        $content = $this->load->view('admin/report/delivery_status', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Delivery status ', 'js' => ['delivery_status'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
      } else if($this->session->userdata('user_type')== 'delivery'){
        $data = array();
        $pageData = ['title' => 'Delivery status list', 'nav' => ['dashboard' => 'Dashboard','blank' => 'Delivery status list']];
        $data['status'] = $this->report_model->get_status('consignment', ['status' => 'active']);
        $data['delivery_boy'] = $this->consignment_model->get_where_all('delivery_person', ['status' => 'active']);
        $content = $this->load->view('admin/report/delivery_status', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Delivery status ', 'js' => ['delivery_status_delivery'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
      }
    }

    public function consignment() {
      if($this->session->userdata('user_type')== '')
        // if(empty($this->session->userdata('name')))
      redirect('admin');
      // if($this->session->userdata('user_type')== 'admin'){
        $data = array();
        $pageData = ['title' => 'Consignment', 'nav' => ['dashboard' => 'Dashboard','blank' => 'Consignment']];
        $data['status'] = $this->report_model->get_status('consignment', ['status' => 'active']);
        $data['delivery_boy'] = $this->consignment_model->get_where_all('delivery_person', ['status' => 'active']);
        $data['merchant'] = $this->consignment_model->get_where_all('customer', ['status' => 'active']);
        $data['branch'] = $this->customer_model->get_where_all('branch', [' status' => 'active']);
        $content = $this->load->view('admin/report/merchant_orders', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        if($this->session->userdata('user_type')== 'admin' || $this->session->userdata('user_type')== 'branch' || $this->session->userdata('user_type')== 'staff'){
        $renderdata = ['page_title' => 'Consignment Report', 'js' => ['merchant_orders0'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
      }else{
        $renderdata = ['page_title' => 'Consignment Report', 'js' => ['merchant_orders'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
      }
      // }
    }


    public function delivery_status_user(){
      if($this->session->userdata('user_type')== '')
      redirect('admin');
      $data = array();
      $pageData = ['title' => 'Delivery status by user list', 'nav' => ['dashboard' => 'Dashboard','blank' => 'Delivery status by user list']];
      $data['status'] = $this->report_model->get_status('consignment', ['status' => 'active']);
      $data['merchant'] = $this->consignment_model->get_where_all('customer', ['status' => 'active']);
      $data['user'] = $this->report_model->get_userType('users');
      $content = $this->load->view('admin/report/delivery_status_branch', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
      $renderdata = ['page_title' => 'Delivery status  by user', 'js' => ['delivery_status_branch'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }

    public function branch_report(){
      if($this->session->userdata('user_type')== '')
      redirect('admin');
      $data = array();
      $pageData = ['title' => 'Branch report list', 'nav' => ['dashboard' => 'Dashboard','blank' => 'Branch report list']];
      $data['status'] = $this->report_model->get_status('consignment', ['status' => 'active']);
      $data['user'] = $this->report_model->get_userTypeDP();
      $data['branch'] = $this->customer_model->get_where_all('branch', [' status' => 'active']);
      $content = $this->load->view('admin/report/branch_report', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
      $renderdata = ['page_title' => 'Branch report', 'js' => ['branch_report'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }

    public function delivery_boy_report(){
      if($this->session->userdata('user_type')== '')
      redirect('admin');
      $data = array();
      $pageData = ['title' => 'Delivery boy delievries list', 'nav' => ['dashboard' => 'Dashboard','blank' => 'Delivery boy delievries list']];
      $data['status'] = $this->report_model->get_status('consignment', ['status' => 'active']);
      $data['branch'] = $this->customer_model->get_where_all('branch', [' status' => 'active']);
      $data['user'] = $this->report_model->get_userTypeDP();
      $content = $this->load->view('admin/report/delivery_boy_report', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
      $renderdata = ['page_title' => 'Delivery boy delievries report', 'js' => ['delivery_boy_report'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }

    public function delivery_report() {
      if($this->session->userdata('user_type')== '')
      redirect('admin');
      $row = $this->input->post();
      $arr = [];

      if(isset($row['office_id']) && $row['office_id']!=''){
        $arr['branch'] = $row['office_id'];
      }
      if(isset($row['from_date']) && $row['from_date']!='__-__-____'){
        $arr['from_date'] = $row['from_date'];
      }
      if(isset($row['to_date']) && $row['to_date']!='__-__-____'){
        $arr['to_date'] = $row['to_date'];
      }

      if(isset($_SESSION['branch']) && $_SESSION['branch'] != ''){
        $arr['sel_branch'] = $_SESSION['branch'];
      }
      // if(isset($row['status']) && $row['status']!=''){
      //   $arr['status'] = $row['status'];
      // }
      $data = array();
      $pageData = ['title' => 'Delivery report', 'nav' => ['dashboard' => 'Dashboard','blank' => 'Delivery report list']];
      $data['result'] = $this->report_model->getconsignmentInfoAll($arr);
      $data['status'] = $this->report_model->get_status('consignment', ['status' => 'active']);
      $data['branch'] = $this->customer_model->get_where_all('branch', [' status' => 'active']);
      $data['merchant'] = $this->consignment_model->get_where_all('customer', ['status' => 'active']);
      $data['src'] = $row;
      // echo $data['src']['status'];
      // die;
      $content = $this->load->view('admin/report/delivery_report', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
      $renderdata = ['page_title' => 'Delivery Report', 'js' => ['delivery_report'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }


    public function financial(){
      if($this->session->userdata('user_type')== '')
      redirect('admin');
      $row = $this->input->post();
      // print_r($row);
      $this->data['src']=$row;
      $arr = [];

      if(isset($row['customer_id']) && $row['customer_id']!=''){
        $arr['customer_id'] = $row['customer_id'];
      }
      if(isset($row['from_date']) && $row['from_date']!='__-__-____'){
        $arr['from_date'] = $row['from_date'];
      }
      if(isset($row['to_date']) && $row['to_date']!='__-__-____'){
        $arr['to_date'] = $row['to_date'];
      }
      if(isset($row['pstatus']) && $row['pstatus']!=''){
        $arr['pstatus'] = $row['pstatus'];
      }

      if($this->session->userdata('user_type')== 'customer'){
        $arr['created_by'] = $this->session->userdata('id');
      }

      $data = array();
      $pageData = ['title' => 'Financial report', 'nav' => ['dashboard' => 'Dashboard','blank' => 'Financial report list']];
      $data['result'] = $this->report_model->getconsignmentInfo($arr);
      $data['status'] = $this->report_model->get_payment_status('consignment', ['status' => 'active']);
      $data['merchant'] = $this->consignment_model->get_where_all('customer', ['status' => 'active']);
      $data['src'] = $row;
      $content = $this->load->view('admin/report/financial_report', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
      $renderdata = ['page_title' => 'Financial Report', 'js' => ['financial'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }

    public function merchant_payout(){
      if($this->session->userdata('user_type')== '')
      redirect('admin');
      $row = $this->input->post();
      // print_r($row);
      $this->data['src']=$row;
      $arr = [];

      if(isset($row['payout_by']) && $row['payout_by']!=''){
        $payout_by = $row['payout_by'];
      }else{
        $payout_by = "";
      }

      if(isset($row['customer_id']) && $row['customer_id']!=''){
        $arr['customer_id'] = $row['customer_id'];
      }
      if(isset($row['from_date']) && $row['from_date']!='__-__-____'){
        $arr['from_date'] = $row['from_date'];
      }
      if(isset($row['to_date']) && $row['to_date']!='__-__-____'){
        $arr['to_date'] = $row['to_date'];
      }
      if(isset($row['pstatus']) && $row['pstatus']!=''){
        $arr['pstatus'] = $row['pstatus'];
      }

      if($this->session->userdata('user_type') != 'admin'){
        $arr['sel_branch'] = $_SESSION['branch'];
      }
      if($payout_by == '' || $payout_by == 'paybyconsignment'){
      $data = array();
      $pageData = ['title' => 'Merchant Payout', 'nav' => ['dashboard' => 'Dashboard','blank' => 'Merchant Payout list']];
      // if($this->session->userdata('user_type')== 'branch'){
      //   $arr['created_by'] = $this->session->userdata('id');
      //   $data['result'] = $this->report_model->getconsignmentInfomerchantpayout_bybranch($arr);
      //   $data['merchant'] = $this->consignment_model->get_where_all('customer', ['status' => 'active','created_by' => $arr['created_by']]);
      // }else{
        $data['branch'] = $this->customer_model->get_where_all('branch', [' status' => 'active']);
      $data['result'] = $this->report_model->getconsignmentInfomerchantpayout($arr);
      // print_r($data['result'][0]);die;
      $data['merchant'] = $this->consignment_model->get_where_all('customer', ['status' => 'active']);
    // }
      $data['status'] = $this->report_model->get_payment_status('consignment', ['status' => 'active']);
      // $data['merchant'] = $this->consignment_model->get_where_all('customer', ['status' => 'active']);
      $data['src'] = $row;
      $content = $this->load->view('admin/report/merchant_payout', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
      $renderdata = ['page_title' => 'Merchant Payout', 'js' => ['merchant_payout'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }
    }


    public function changeStatus($consignmentId){
      // if($this->session->userdata('user_type')!= 'admin')
        // if(empty($this->session->userdata('name')))
      // redirect('admin');
        $data = array();
        $pageData = ['title' => 'Delivery status update', 'nav' => ['dashboard' => 'Dashboard','blank' => 'Delivery status update']];
        $data['branch'] = $this->customer_model->get_where_all('branch', [' status' => 'active']);
        $data['consignment'] = $this->customer_model->get_where_all('consignment', [' consignment_id' => $consignmentId]);
        $data['consignmentDetail'] = $this->customer_model->get_where_all('tracking', [' consignmentId' => $consignmentId]);
        $content = $this->load->view('admin/report/delivery_status_update', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Update Status ', 'js' => ['delivery_status_update'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function updateStatus($consignmentId){
      // if($this->session->userdata('user_type')!= 'delivery')
        // if(empty($this->session->userdata('name')))
      // redirect('admin');
        $data = array();
        $pageData = ['title' => 'Delivery status update', 'nav' => ['dashboard' => 'Dashboard','blank' => 'Delivery status update']];
        $data['branch'] = $this->customer_model->get_where_all('branch', [' status' => 'active']);
        $data['consignment'] = $this->customer_model->get_where_all('consignment', [' consignment_id' => $consignmentId]);
        $data['consignmentDetail'] = $this->customer_model->get_where_all('tracking', [' consignmentId' => $consignmentId]);
        $content = $this->load->view('admin/report/deliveryBoy_status_update', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Update Status ', 'js' => ['delivery_status_update'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function changeStatusUpdate(){
      // print_r($this->input->post('id'));die;
      $row = $this->input->post("src_data");
        $id = $this->input->post("id");

        if($this->input->post("secondary_status") == ""){
          $details = $this->input->post('detail');
        }else{
          $details = $this->input->post("secondary_status");
        }


        if($this->input->post("new_date") == "__-__-____"){
          $reschedule = "";
        }else{
          $reschedule = date('Y-m-d', strtotime($this->input->post("new_date")));
        }
        if($this->input->post("branch") == ""){
          $branch = "";
          if($this->input->post("status") == "delivered"){
          $this->package_model->update('branch_data', ['status' => $this->input->post('secondary_status')], ['consignment' => $id]);
        }
        }else{
          $branch = $this->input->post("branch");
          // echo $branch;
          // die;
          if($this->input->post("status") != "delivered" && $this->input->post("secondary_status") == "Deposited to"){
            $checkIfexist = $this->consignment_model->get_where_all('branch_data', ['consignment' => $id]);
            if(empty($checkIfexist)){
            $this->consignment_model->insert('branch_data', ['consignment' => $id,'branch' => $branch,'status' => $this->input->post('secondary_status')]);
          }else{
            $this->package_model->update('branch_data', ['branch' => $branch,'status' => $this->input->post('secondary_status')], ['consignment' => $id]);
          }
        }else{
          $this->package_model->update('branch_data', ['branch' => $branch,'status' => $this->input->post('secondary_status')], ['consignment' => $id]);
        }
        }
        if($this->input->post("status") == "delivered"){
        $delivery_date = date("Y-m-d H:i:s");
      }else{
        $delivery_date = "";
      }

        $result = $this->package_model->update('consignment', ['delivered_date' => $delivery_date,'delivery_status' => $this->input->post('status'),'new_deliverydate' => $reschedule], ['consignment_id' => $id]);
         $res = $this->package_model->insert('tracking', ['consignmentId' => $id,
                    'detail' => $this->input->post('detail'),
                    'consignment_status' => $this->input->post('status'),
                  'branch' => $branch]);

                  if ($this->input->post("status") == "delivered") {
                      $date = date("Y-m-d H:i:s");
                      $cus = $this->input->post('paymentStatus');
                      // $id = $this->input->post('conId');
                      $amount = $this->consignment_model->get_where_all('consignment', ['consignment_id' => $id]);
                      if($this->input->post('paymentStatus') == 'partial'){
                        $lesspaidamount = $amount[0]['amounttocollect'] - $this->input->post('partial_amount');
                        // echo $lesspaidamount;die;
                      $response = $this->package_model->update('consignment', ['payment_status' => $this->input->post('paymentStatus'),'less_paid_return' => $amount[0]['cash_collection'] - $this->input->post('partial_amount'),'amount_paid' => $this->input->post('partial_amount')], ['consignment_id' => $id]);
                      $this->consignment_model->insert('payment', ['consignment_id' => $id,'amount' => $this->input->post('partial_amount'),'date' => $date]);
                    }else if($this->input->post('paymentStatus') == 'paid'){
                      $response = $this->package_model->update('consignment', ['payment_status' => $this->input->post('paymentStatus'),'amount_paid' => $amount[0]['cash_collection']], ['consignment_id' => $id]);
                      $amount_check = $this->consignment_model->get_where_all('payment', ['consignment_id' => $id]);
                      if($amount_check){
                        $pendingAmount = $amount[0]['amounttocollect'] - $amount_check[0]['amount'];
                        $this->consignment_model->insert('payment', ['consignment_id' => $id,'amount' => $pendingAmount,'date' => $date]);
                      }else{
                      $this->consignment_model->insert('payment', ['consignment_id' => $id,'amount' => $amount[0]['amounttocollect'],'date' => $date]);
                    }
                    }
                    // else{
                    //   if($amount[0]['narration'] == 'DC is paid by Merchant'){
                    //     $response = $this->package_model->update('consignment', ['payment_status' => $this->input->post('paymentStatus'),'amount_paid' => '0','paytomerch' => 0 ], ['consignment_id' => $id]);
                    //   }else{
                    //   $response = $this->package_model->update('consignment', ['payment_status' => $this->input->post('paymentStatus'),'amount_paid' => '0','deduction_status' => 1 ,'deduction_amount'=> $amount[0]['total_price']], ['consignment_id' => $id]);
                    // }
                    // }
                  }

                  if($this->input->post("status") == "reschedule"){
                    $amount = $this->consignment_model->get_where_all('consignment', ['consignment_id' => $id]);
                    $this->package_model->update('consignment', ['status' => "not_assigned"], ['consignment_id' => $id]);
                    $this->package_model->delete('assign_delivery', ['consignment' => $amount[0]['id']]);
                  }

                  if($this->input->post("status") == "returned"){
                    $amount = $this->consignment_model->get_where_all('consignment', ['consignment_id' => $id]);
                    if($this->input->post('deduction') == "yes"){
                    $this->package_model->update('consignment', ['payment_status' => 'paid', 'deduction_status' => 1 ,'deduction_amount'=> $amount[0]['total_price']], ['consignment_id' => $id]);
                  }
                  }
                // $response['message'] = "Package updated successfully";
                // $response['success'] = true;
        // $this->output->set_content_type('application/json')
                // ->set_output(json_encode($response))->_display();
                redirect('admin/merchant_pay/cash_collection'.$row);
        exit();
    }

    public function changeStatusUpdated(){
      // print_r($this->input->post('id'));die;
      $row = $this->input->post("src_data");
        $id = $this->input->post("id");

        if($this->input->post("secondary_status") == ""){
          $details = $this->input->post('detail');
        }else{
          $details = $this->input->post("secondary_status");
        }


        if($this->input->post("new_date") == "__-__-____"){
          $reschedule = "";
        }else{
          $reschedule = date('Y-m-d', strtotime($this->input->post("new_date")));
        }
        if($this->input->post("status") == "delivered"){
        $delivery_date = date("Y-m-d H:i:s");
      }else{
        $delivery_date = "";
      }

        $result = $this->package_model->update('consignment', ['delivered_date' => $delivery_date,'delivery_status' => $this->input->post('status'),'new_deliverydate' => $reschedule], ['consignment_id' => $id]);
         $res = $this->package_model->insert('tracking', ['consignmentId' => $id,
                    'detail' => $this->input->post('detail'),
                    'consignment_status' => $this->input->post('status'),
                  'branch' => ""]);

                  if ($this->input->post("status") == "delivered") {
                      $date = date("Y-m-d H:i:s");
                      $cus = $this->input->post('paymentStatus');
                      // $id = $this->input->post('conId');
                      $amount = $this->consignment_model->get_where_all('consignment', ['consignment_id' => $id]);
                      if($this->input->post('paymentStatus') == 'partial'){
                        $lesspaidamount = $amount[0]['amounttocollect'] - $this->input->post('partial_amount');
                        // echo $lesspaidamount;die;
                      $response = $this->package_model->update('consignment', ['payment_status' => $this->input->post('paymentStatus'),'less_paid_return' => $amount[0]['cash_collection'] - $this->input->post('partial_amount'),'amount_paid' => $this->input->post('partial_amount'),'note' => $this->input->post('note')], ['consignment_id' => $id]);
                      $this->consignment_model->insert('payment', ['consignment_id' => $id,'amount' => $this->input->post('partial_amount'),'date' => $date]);
                    }else if($this->input->post('paymentStatus') == 'paid'){
                      $response = $this->package_model->update('consignment', ['payment_status' => $this->input->post('paymentStatus'),'amount_paid' => $amount[0]['cash_collection'],'note' => $this->input->post('note')], ['consignment_id' => $id]);
                      $amount_check = $this->consignment_model->get_where_all('payment', ['consignment_id' => $id]);
                      if($amount_check){
                        $pendingAmount = $amount[0]['amounttocollect'] - $amount_check[0]['amount'];
                        $this->consignment_model->insert('payment', ['consignment_id' => $id,'amount' => $pendingAmount,'date' => $date]);
                      }else{
                      $this->consignment_model->insert('payment', ['consignment_id' => $id,'amount' => $amount[0]['amounttocollect'],'date' => $date]);
                    }
                    }
                  }

                  if($this->input->post("status") == "reschedule"){
                    $amount = $this->consignment_model->get_where_all('consignment', ['consignment_id' => $id]);
                    $this->package_model->update('consignment', ['status' => "not_assigned"], ['consignment_id' => $id]);
                    $this->package_model->delete('assign_delivery', ['consignment' => $amount[0]['id']]);
                  }

                  if($this->input->post("status") == "returned"){
                    $amount = $this->consignment_model->get_where_all('consignment', ['consignment_id' => $id]);
                    $psarea = $this->consignment_model->get_where_all('police_station', ['id' => $amount[0]['del_police_station']]);
                    $servicearea = $psarea[0]['area'];
                    if($servicearea!= 'metro'){
                      $dedamount = (150 / 100) * intval($amount[0]['total_price']);
                      $chargeamount = $dedamount;
                      // $chargeamount = $dedamount + round($amount[0]['total_cod_charge']);
                      $returnextra = (50 / 100) * intval($amount[0]['total_price']);
                    }else{
                    $chargeamount = intval($amount[0]['total_price']);
                    // $chargeamount = intval($amount[0]['total_price']) + round($amount[0]['total_cod_charge']);
                    $returnextra = 0;
                  }
                  // echo $chargeamount;die;
                    if($this->input->post('deduction') == "yes"){
                    $this->package_model->update('consignment', ['payment_status' => 'paid', 'deduction_status' => 1 ,'deduction_amount'=> $chargeamount], ['consignment_id' => $id]);
                  }else{
                    $this->package_model->update('consignment', ['return_extra' => $returnextra, 'payment_status' => 'paid', 'deduction_status' => 0 ,'deduction_amount'=> 0,'amount_paid' => $this->input->post('return_amount')], ['consignment_id' => $id]);
                  }
                  }
                  $consdata = $this->consignment_model->get_where_all('consignment', ['consignment_id' => $id]);
                  // print_r($consdata[0]);die;
                  $response_result = array();
                $response_result['message'] = $consdata[0];
                $response_result['success'] = true;
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response_result))->_display();
        exit();
    }

    public function getorderlist() {
      ini_set('memory_limit', '512M');
      $row = $this->input->post();
      $arr = [];
      if(isset($row['office_id']) && $row['office_id']!=''){
        $arr['branch'] = $row['office_id'];
      }
      if(isset($row['from_date']) && $row['from_date']!='__-__-____'){
        $arr['from_date'] = $row['from_date'];
      }
      if(isset($row['to_date']) && $row['to_date']!='__-__-____'){
        $arr['to_date'] = $row['to_date'];
      }
      if(isset($row['customer_id']) && $row['customer_id']!=''){
        $arr['customer_id'] = $row['customer_id'];
      }

      if($this->session->userdata('user_type')!= 'admin'){
      if(isset($_SESSION['branch']) && $_SESSION['branch'] != ''){
        $arr['sel_branch'] = $_SESSION['branch'];
      }
    }
      // if(isset($row['con_status']) && $row['con_status']!=''){
      //   $arr['con_status'] = $row['con_status'];
      // }
      // print_r($arr);exit;
        $response = array();
                $response = $this->report_model->get_all_order_list($arr);


            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();
    }

    public function getdeliverylist() {
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
        $response = array();
                $response = $this->report_model->get_all_list($arr);


            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();
    }

    public function getdeliverylisted() {
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
        $arr['customer_id'] = $row['customer_id'];
      }
      $arr['deliveryBoyId'] = $_SESSION['id'];
        $response = array();
                $response = $this->report_model->get_all_listed($arr);


            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();
    }

    public function getdeliverylistByUser() {
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
      if(isset($row['merchant_id']) && $row['merchant_id']!=''){
        $arr['merchant_id'] = $row['merchant_id'];
      }
      if(isset($row['userName']) && $row['userName']!=''){
        $arr['userName'] = $row['userName'];
      }
        $response = array();
                $response = $this->report_model->get_all_listBybUser($arr);


            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();
    }

    public function getdeliveriesCount() {
      $row = $this->input->post();
      if($row['userName']!=''){
      $arr = [];
      if(isset($row['office_id']) && $row['office_id']!=''){
        $arr['branch'] = $row['office_id'];
      }
      if(isset($row['from_date']) && $row['from_date']!='__-__-____'){
        $arr['from_date'] = $row['from_date'];
      }
      if(isset($row['to_date']) && $row['to_date']!='__-__-____'){
        $arr['to_date'] = $row['to_date'];
      }
      // if(isset($row['userName']) && $row['userName']!=''){
      //   $arr['userName'] = $row['userName'];
      // }
        $response = array();
                $response = $this->report_model->get_all_listBydeliveries($arr);


            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();
          }else{
            $response['message'] = "please choose user to see report";
            $response['success'] = false;
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();
          }
    }

    public function getBranchCount() {
      $row = $this->input->post();
      // if($row['branch']!=''){
      $arr = [];
      if(isset($row['branch']) && $row['branch']!=''){
        $arr['branch'] = $row['branch'];
      }
      if(isset($row['from_date']) && $row['from_date']!='__-__-____'){
        $arr['from_date'] = $row['from_date'];
      }
      if(isset($row['to_date']) && $row['to_date']!='__-__-____'){
        $arr['to_date'] = $row['to_date'];
      }

      if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'admin'){
        $arr['sel_branch'] = $_SESSION['branch'];
      }
      // print_r($arr);die;

        $response = array();
                $response = $this->report_model->get_all_listByBranchCount($arr);


            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();
          // }else{
            $response['message'] = "please choose branch to see report";
            $response['success'] = false;
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();
          // }
    }


    public function updatePaymentstaus() {
            $response = array();
            if ($this->input->post('paymentStatus')!= "") {
                $date = date("Y-m-d H:i:s");
                $cus = $this->input->post('paymentStatus');
                $id = $this->input->post('conId');
                $amount = $this->consignment_model->get_where_all('consignment', ['consignment_id' => $id]);
                if($this->input->post('paymentStatus') == 'partial'){
                $response = $this->package_model->update('consignment', ['payment_status' => $this->input->post('paymentStatus'),'amount_paid' => $this->input->post('partial_amount')], ['consignment_id' => $id]);
                $this->consignment_model->insert('payment', ['consignment_id' => $id,'amount' => $this->input->post('partial_amount'),'date' => $date]);
              }else if($this->input->post('paymentStatus') == 'paid'){
                $response = $this->package_model->update('consignment', ['payment_status' => $this->input->post('paymentStatus'),'amount_paid' => $amount[0]['grand_total']], ['consignment_id' => $id]);
                $amount_check = $this->consignment_model->get_where_all('payment', ['consignment_id' => $id]);
                if($amount_check){
                  $pendingAmount = $amount[0]['grand_total'] - $amount_check[0]['amount'];
                  $this->consignment_model->insert('payment', ['consignment_id' => $id,'amount' => $pendingAmount,'date' => $date]);
                }else{
                $this->consignment_model->insert('payment', ['consignment_id' => $id,'amount' => $amount[0]['grand_total'],'date' => $date]);
              }
              }else{
                $response = $this->package_model->update('consignment', ['payment_status' => $this->input->post('paymentStatus'),'amount_paid' => '0'], ['consignment_id' => $id]);
              }
                $response['message'] = "Payment Status Updated successfully";
                $response['success'] = true;
            }
            redirect('admin/report/financial');
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response));
            exit();

    }

    public function updatePaymentstausmerchantpayout() {
            $response = array();
            if ($this->input->post('paymentStatus')!= "") {
                $date = date("Y-m-d H:i:s");
                $cus = $this->input->post('paymentStatus');
                $id = $this->input->post('conId');
                $amount = $this->consignment_model->get_where_all('consignment', ['consignment_id' => $id]);
                if($this->input->post('paymentStatus') == 'partial'){
                $response = $this->package_model->update('consignment', ['payment_status_merchant' => $this->input->post('paymentStatus'),'merchant_payout' => $this->input->post('partial_amount')], ['consignment_id' => $id]);
                $this->consignment_model->insert('merchant_payout', ['consignmentId' => $id,'amount_paid' => $this->input->post('partial_amount'),'date' => $date]);
              }else if($this->input->post('paymentStatus') == 'paid'){
                $response = $this->package_model->update('consignment', ['payment_status_merchant' => $this->input->post('paymentStatus'),'merchant_payout' => $amount[0]['total_price_product']], ['consignment_id' => $id]);
                $amount_check = $this->consignment_model->get_where_all('merchant_payout', ['consignmentId' => $id]);
                if($amount_check){
                  $pendingAmount = $amount[0]['total_price_product'] - $amount_check[0]['amount_paid'];
                  $this->consignment_model->insert('merchant_payout', ['consignmentId' => $id,'amount_paid' => $pendingAmount,'date' => $date]);
                }else{
                $this->consignment_model->insert('merchant_payout', ['consignmentId' => $id,'amount_paid' => $amount[0]['total_price_product'],'date' => $date]);
              }
              }else{
                $response = $this->package_model->update('consignment', ['payment_status_merchant' => $this->input->post('paymentStatus'),'merchant_payout' => '0'], ['consignment_id' => $id]);
              }
                $response['message'] = "Payment Status Updated successfully";
                $response['success'] = true;
            }
            redirect('admin/report/merchant_payout');
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response));
            exit();

    }

    public function partial() {
      if($this->session->userdata('user_type')== '')
      redirect('admin');
      if(isset($_SESSION['branch']) && $_SESSION['branch'] != ''){
        $sel_branch = $_SESSION['branch'];
      }
        $data = array();
        $pageData = ['title' => 'Partial report list', 'nav' => ['dashboard' => 'Dashboard','blank' => 'Partial report list']];
        $data['status'] = $this->report_model->get_status('consignment', ['status' => 'active']);
        if($this->session->userdata('user_type')== 'branch'){
          $data['merchant'] = $this->consignment_model->get_where_all('customer', ['status' => 'active','office'=>$sel_branch]);
        }else{
        $data['merchant'] = $this->consignment_model->get_where_all('customer', ['status' => 'active']);
      }
        $content = $this->load->view('admin/report/partial_report', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Partial report ', 'js' => ['partial_report'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function getConsignment() {

            $response = array();
            if ($this->input->post('customer') > 0) {
                $cus = $this->input->post('customer');
                $response = $this->consignment_model->get_where_all('consignment',['customer' => $cus,'status' => 'assigned']);

            }
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();

    }

    public function getshipcontact() {

            $response = array();
            // if ($this->input->post('customer') > 0) {
                // $cus = $this->input->post('customer');
                $response = $this->consignment_model->get_where_all('shiping',['status' => 'active']);

            // }
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();

    }

    public function getpartiallist() {
        $row = $this->input->post();
        $customerId = $row['customer_id'];
        $consignmentId = $row['consignment'];
        $s_contact = $row['s_contact'];
      if($customerId != "" && $consignmentId != ""){
                $response['consid'] = $consignmentId;
                $response['customer'] = $this->report_model->get_where_all('customer', [' id' => $customerId]);
                $response['tracking'] = $this->report_model->get_where_all('tracking', [' consignmentId' => $consignmentId]);
              }elseif($s_contact != ""){
                $consdetail = $this->report_model->get_where_all('consignment', ['recipient_address' => $s_contact]);
                if(!empty($consdetail)){
                $response['consid'] = $consdetail[0]['consignment_id'];
                $response['customer'] = $this->report_model->get_where_all('customer', [' id' => $consdetail[0]['customer']]);
                $response['tracking'] = $this->report_model->get_where_all('tracking', [' consignmentId' => $consdetail[0]['consignment_id']]);
              }else{
                $response['message'] = "No Consignment Found";
                $response['success'] = false;
              }
              }else{
                $response['message'] = "please choose Merchant and Consignment Id or Shipping Contact";
                $response['success'] = false;
              }
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();
    }

    function print_layout($consignment_id) {
        $data['title'] = 'Delivery';
        $data['consignment'] = $this->report_model->get_where_all('consignment', [' consignment_id' => $consignment_id]);
        $data['merchant'] = $this->report_model->get_where_all('customer', [' id' => $data['consignment'][0]['customer']]);
        $data['customer'] = $this->report_model->get_where_all('shiping', [' id' => $data['consignment'][0]['recipient_address']]);
        $data['district'] = $this->report_model->get_where_all('district', [' id' => $data['customer'][0]['district']]);
        $conid = $data['consignment'][0]['consignment_id'];
        $uname = $data['customer'][0]['recipient_name'];
        $uaddress = $data['customer'][0]['recipient_address'];
        $uaddress2 = $data['customer'][0]['recipient_address_2'];
        $uphone = $data['customer'][0]['recipient_number'];
        $data['qrcode'] = $this->Qrcode("Consignment id : $conid, Name : $uname, phone: $uphone, address : $uaddress.$uaddress2");
        $checkstatus = $this->report_model->get_where_all('tracking', [' consignmentId' => $conid,'detail' => "Ready for pickup"]);
        // if(empty($checkstatus)){
        // $this->report_model->insert('tracking', ['consignmentId' => $conid,
        //            'detail' => "Ready for pickup",
        //            'consignment_status' => "Pickup Scheduled"]);
        //          }
        $this->load->view('print_view', $data);
    }


    public function Qrcode($content){
      $this->load->library('ciqrcode');
      $params['data'] = $content;
      $params['level'] = 'H';
      $params['size'] = 2;
      $params['savename'] = FCPATH.'tes.png';
      $this->ciqrcode->generate($params);
    }

    public function getUsers() {
      // echo $this->input->post('user_type');
      // die;
            $response = array();
            if ($this->input->post('user_type') != "") {
                $userType = $this->input->post('user_type');
                $response = $this->report_model->get_where_all('users', ['user_type' => $userType ]);

            }
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();

    }

    public function getDeliveryPerson() {
      // echo $this->input->post('user_type');
      // die;
            $response = array();
            if ($this->input->post('user_type') != "") {
                $userType = $this->input->post('user_type');
                $response = $this->report_model->get_where_all('delivery_person', ['user_type' => $userType ]);

            }
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();

    }

    public function transporter_copy(){
      if($this->session->userdata('user_type')== '')
      redirect('admin');
      $row = $this->input->post();
      $arr = [];

      if(isset($row['transprtr']) && $row['transprtr']!=''){
        $arr['transprtr'] = $row['transprtr'];
      }
      if(isset($row['from_date']) && $row['from_date']!='__-__-____'){
        $arr['from_date'] = $row['from_date'];
      }
      if(isset($row['to_date']) && $row['to_date']!='__-__-____'){
        $arr['to_date'] = $row['to_date'];
      }
      if($this->session->userdata('user_type') == 'branch'){
        $arr['sel_branch'] = $_SESSION['branch'];
      }
      $data = array();
      $data['row'] = $this->report_model->get_transcopy($arr);
      $data['transporter'] = $this->report_model->get_where_all('delivery_person', ['status' => 'active']);
      $data['src'] = $row;
      $content = $this->load->view('admin/report/transporter_copy', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Transporter Copy', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Transporter Copy']], true);
      $renderdata = ['page_title' => 'Transporter Copy', 'js' => ['transporter_copy'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }

    function pdf(){
      $this->load->library('fpdf');
        // $this->load->library('html2pdf');
        $arr = [];

        if(isset($row['transprtr']) && $row['transprtr']!=''){
          $arr['transprtr'] = $row['transprtr'];
        }
        if(isset($row['from_date']) && $row['from_date']!='__-__-____'){
          $arr['from_date'] = $row['from_date'];
        }
        if(isset($row['to_date']) && $row['to_date']!='__-__-____'){
          $arr['to_date'] = $row['to_date'];
        }

        $row = $this->report_model->get_transcopy($arr);
        // print_r($row[0]);die;
        $pdf = new FPDF();
        $pdf->SetAutoPageBreak(true,16);
        $pdf->addPage('L');
        $pdf->SetFont('Arial','B',8);
        $html="<table id='datable_2_cust' class='table table-hover display  pb-30' >
            <thead>
                <tr>
                  <th style='text-align: center;'>Order Date</th>
                    <th style='text-align: center;'>Transporter</th>

                    <th style='text-align: center;''>Comsignment ID</th>
                    <th style='text-align: center;''>Merchant Details</th>
                    <th style='text-align: center;''>Shipping Details</th>
                    <th style='text-align: center;''>Note</th>
                    <th style='text-align: center;''>Assigned Date</th>
                    <th class='Sum_cash_collection' style='text-align: right;''>Cash Collection</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th style='text-align: right;font-size: 15px;'></th>
                </tr>
            </tfoot>
            <tbody>";
                foreach ($row as $k => $v) {
                  $dt = new DateTime($v->timestamp);
                  $date = $dt->format('d, M Y h:i a');
                    $html .= "<tr data-id='$v->id'>
                      <td style='text-align: center;'> $date </td>
                        <td style='text-align: center;'> $v->transporter </td>

                        <td style='text-align: center;'> $v->consignment_id </td>

                        <td style='text-align: left;'>Company :  $v->company <br>Merchant Name:  $v->name <br>Contact:  $v->phone <br>Product ID:  $v->product_id </td>
                        <td style='text-align: left;'>Receipient Name:  $v->recipient_name <br>Address : $v->recipient_address <br>Contact:  $v->recipient_number ?><br></td>
                        <td style='text-align: center;'> $v->instructions </td>
                        <td style='text-align: center;'> jkbkj</td>
                        <td style='text-align: right;'> $v->cash_collection </td>
                    </tr>";


                }


                $html .= "</tbody>
        </table>";
        echo $html;
        die;
        $pdf->WriteHTML($html);
        $pdf->Output();

      }

    public function transporter_copy_demo() {
      if($this->session->userdata('user_type')== '')
      redirect('admin');
        $data = array();
        $pageData = ['title' => 'Transporter Copy', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Transporter Copy']];
        $data['transporter'] = $this->report_model->get_where_all('delivery_person', ['status' => 'active']);
        $content = $this->load->view('admin/report/transporter_copy_js', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Consignment Report', 'js' => ['transporter_copy'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function delivery_charge(){
      if($this->session->userdata('user_type')== '')
      redirect('admin');
      $row = $this->input->post();
      $arr = [];

      if(isset($row['office_id']) && $row['office_id']!=''){
        $arr['branch'] = $row['office_id'];
      }
      if(isset($row['c_status']) && $row['c_status']!=''){
        $arr['c_status'] = $row['c_status'];
      }
      if(isset($row['from_date']) && $row['from_date']!='__-__-____'){
        $arr['from_date'] = $row['from_date'];
      }
      if(isset($row['to_date']) && $row['to_date']!='__-__-____'){
        $arr['to_date'] = $row['to_date'];
      }

      // if(isset($_SESSION['branch']) && $_SESSION['branch'] != ''){
      if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'admin'){
        $arr['sel_branch'] = $_SESSION['branch'];
      }
        // $arr['status'] = 'active';
      $data = array();
      // if($this->session->userdata('user_type') == 'branch'){
      //   $arr['created_by'] = $this->session->userdata('id');
      //   $data['row'] = $this->report_model->get_where_all('customer',$arr);
      // }else{
      $data['row'] = $this->report_model->get_delcharge($arr);
    // }
      $data['branch'] = $this->customer_model->get_where_all('branch', [' status' => 'active']);
      $data['conss'] = $this->report_model->get_merch_pay_status();
      $data['src'] = $row;
      // echo $data['src']['status'];
      // die;
      $content = $this->load->view('admin/report/delivery_charge', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Delivery Charge', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Delivery Charge']], true);
      $renderdata = ['page_title' => 'Delivery Charge', 'js' => ['delivery_charge'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }


    public function transporter_report_demo(){
      if($this->session->userdata('user_type')== '')
      redirect('admin');
      $row = $this->input->post();
      $arr = [];

      if(isset($row['transprtr']) && $row['transprtr']!=''){
        $arr['transprtr'] = $row['transprtr'];
      }
      if(isset($input['from_date']) && $input['from_date']!='__-__-____'){
        $arr['from_date'] = $input['from_date'];
      }
      if(isset($input['to_date']) && $input['to_date']!='__-__-____'){
        $arr['to_date'] = $input['to_date'];
      }

      if($this->session->userdata('user_type') == 'branch'){
        $sel_branch = $_SESSION['branch'];
      }
        // $arr['status'] = 'active';
      $data = array();
      if($this->session->userdata('user_type') == 'branch'){
        $data['row'] = $this->report_model->get_where_all('delivery_person', ['status' => 'active','office' => $sel_branch]);
      }else{
      $data['row'] = $this->report_model->get_where_all('delivery_person', ['status' => 'active','office!=' => ""]);
    }
      $data['branch'] = $this->report_model->get_where_all('branch', ['status' => 'active']);
      $data['src'] = $row;
      // echo $data['src']['status'];
      // die;
      $content = $this->load->view('admin/report/transporter_report', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Transporter Report', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Transporter Report']], true);
      $renderdata = ['page_title' => 'Transporter Report', 'js' => ['transporter_copy'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }

    public function transporter_report(){
      if($this->session->userdata('user_type')== '')
      redirect('admin');
      $row = $this->input->post();
      $arr = [];
      $from_date ="";
      $to_date = "";
      if(isset($row['transprtr']) && $row['transprtr']!=''){
        $arr['transprtr'] = $row['transprtr'];
      }
      if(isset($row['from_date']) && $row['from_date']!='__-__-____'){
        $arr['from_date'] = $row['from_date'];
        $from_date = $row['from_date'];
      }
      if(isset($row['to_date']) && $row['to_date']!='__-__-____'){
        $arr['to_date'] = $row['to_date'];
        $to_date = $row['to_date'];
      }

      if($this->session->userdata('user_type') == 'branch'){
        $sel_branch = $_SESSION['branch'];
      }

      // print_r($arr);die;
        // $arr['status'] = 'active';
      $data = array();
      if($this->session->userdata('user_type') == 'branch'){
        $data['row'] = $this->report_model->get_where_all('delivery_person', ['status' => 'active','office' => $sel_branch]);
        $data['branchname'] = $this->report_model->get_where_all('branch', ['id' => $data['row'][0]['office']]);
        $data['total_received'] = $this->report_model->get_totalreceive($data['row'][0]['id'],$from_date,$to_date);
        $data['total_delivered'] = $this->report_model->get_alldeliveries($data['row'][0]['id']);
        $data['total_rescheduled'] = $this->report_model->get_all_res($data['row'][0]['id']);
        $data['total_deducted_returned'] = $this->report_model->get_all_deducted_returns($data['row'][0]['id']);
        $data['total_nondeducted_returned'] = $this->report_model->get_all_nondeducted_returns($data['row'][0]['id']);
        $data['total_returned'] = $this->report_model->get_allreturns($data['row'][0]['id']);
      }else{
        $data['row'] = array();
        if(!empty($arr['transprtr'])){
          // echo $arr['transprtr'];die;
          $dp = $this->report_model->get_where_all('delivery_person', ['status' => 'active','id' => $arr['transprtr'],'office!=' => ""]);
        }else{
      $dp = $this->report_model->get_where_all('delivery_person', ['status' => 'active','office!=' => ""]);
    }
      foreach ($dp as $key => $value) {
        $arr['tp_id'] = $value['id'];
        $branchname= $this->report_model->get_where_all('branch', ['id' => $value['office']]);
        $topush['branch_name'] = $branchname[0]['name'];
        $topush['transporter_id'] = $value['transporter_id'];
        $topush['dp_name'] = $value['name'];
        $topush['totalreceive'] = $this->report_model->get_totalreceived($arr);

        $topush['totaldeliveries'] = $this->report_model->get_alldeliveried($arr);
        $topush['total_res'] = $this->report_model->get_all_rescheduled($arr);
        $topush['total_deductreturns'] = $this->report_model->get_all_deducted_returned($arr);
        $topush['total_nondeductreturns'] = $this->report_model->get_all_nondeducted_returned($arr);
        $topush['totalreturns'] = $this->report_model->get_allreturned($arr);
        array_push($data['row'] ,$topush);
      }
      // echo "<pre>";
      // print_r($data['row']);
      // echo "</pre>";
      // die;
    }
      $data['alltransporter'] = $this->report_model->get_where_all('delivery_person', ['status' => 'active']);
      $data['src'] = $row;
      // echo $data['src']['status'];
      // die;
      $content = $this->load->view('admin/report/tranporter_report_new', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Transporter Report', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Transporter Report']], true);
      $renderdata = ['page_title' => 'Transporter Report', 'js' => ['transporter_copy'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }

    public function cash_collection_report(){
      if($this->session->userdata('user_type')== '')
      redirect('admin');
      $row = $this->input->post();
      $arr = [];

      if(isset($row['transprtr']) && $row['transprtr']!=''){
        $arr['transprtr'] = $row['transprtr'];
      }
      if(isset($row['from_date']) && $row['from_date']!='__-__-____'){
        $arr['from_date'] = $row['from_date'];
      }
      if(isset($row['to_date']) && $row['to_date']!='__-__-____'){
        $arr['to_date'] = $row['to_date'];
      }
      if($this->session->userdata('user_type') == 'branch'){
        $arr['sel_branch'] = $_SESSION['branch'];
      }
      $data = array();
      $data['row'] = $this->report_model->get_cashreport($arr);
      $data['transporter'] = $this->report_model->get_where_all('delivery_person', ['status' => 'active']);
      $data['src'] = $row;
      $content = $this->load->view('admin/report/cash_report', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Cash Collection Report', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Cash Collection Report']], true);
      $renderdata = ['page_title' => 'Cash Collection Report', 'js' => ['transporter_copy'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }

    public function cancel_parcel(){
      if($this->session->userdata('user_type') == '')
      redirect('admin');
        $data = array();
        $input = $this->input->post();
        $arr = [];

        if(isset($input['office_id']) && $input['office_id']!=''){
          $arr['company'] = $input['office_id'];
        }
        if(isset($input['from_date']) && $input['from_date']!='__-__-____'){
          $arr['from_date'] = $input['from_date'];
        }
        if(isset($input['to_date']) && $input['to_date']!='__-__-____'){
          $arr['to_date'] = $input['to_date'];
        }
        if(isset($input['merch_id']) && $input['merch_id']!=''){
          $arr['merch_id'] = $input['merch_id'];
        }
        if($this->session->userdata('user_type') == 'branch'){
          $arr['company'] = $this->session->userdata('branch');
        }
        $data['src'] = $input;
        $data['row'] = $this->report_model->get_cancel($arr);
        $data['branch'] = $this->report_model->get_where_all('branch', ['status' => 'active']);
        $data['merchant'] = $this->report_model->get_where_all('customer', ['status' => 'active']);
        $content = $this->load->view('admin/report/cancel_parcel', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Cancel Parcel', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Cancel Parcel']], true);
        $renderdata = ['page_title' => 'Cancel Parcel', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function retrieve_cons($id){
      $res = $this->report_model->update('consignment', [
          'cons_status' => "pending",
          // 'receive_status' => "not_assigned",
          'delivery_status' => "pending"],
           ['id' => $id]);
           // if($res){
           //   $this->assign_deliveryperson_model->delete('assign_receive', ['consignment'=>$id]);
           // }
      redirect('admin/assign_deliveryperson/receive');
    }

    public function ticket_report(){
      if($this->session->userdata('user_type') == '')
      redirect('admin');
      $row = $this->input->post();
      $arr = [];

      if(isset($row['customer_id']) && $row['customer_id']!=''){
        $arr['customer_id'] = $row['customer_id'];
      }
      if(isset($row['from_date']) && $row['from_date']!='__-__-____'){
        $arr['from_date'] = $row['from_date'];
      }
      if(isset($row['to_date']) && $row['to_date']!='__-__-____'){
        $arr['to_date'] = $row['to_date'];
      }
      if(isset($row['status']) && $row['status']!=''){
        $arr['status'] = $row['status'];
      }
      $data = array();
      $data['row'] = $this->report_model->get_all_tickets_report($arr);
      $data['src'] = $row;
      $content = $this->load->view('admin/report/ticket_report', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Tickets Report', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Tickets Report']], true);
      $renderdata = ['page_title' => 'Ticket', 'js' => ['raise_tickets'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }


}
