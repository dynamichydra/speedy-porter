<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Assign_deliveryperson extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('assign_deliveryperson_model');
    }

    public function index() {
      if($this->session->userdata('user_type') == '')
        // if(empty($this->session->userdata('name')))
      redirect('admin');
        $data = array();
        if($this->session->userdata('user_type') == 'branch'){
          $data['row'] = $this->assign_deliveryperson_model->get_all_bybranch($this->session->userdata('id'));
        }else{
        $data['row'] = $this->assign_deliveryperson_model->get_all();
      }
        $content = $this->load->view('admin/assign_delivery/index', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Assign Delivery Person list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Assign Delivery Person list']], true);
        $renderdata = ['page_title' => 'Assign Delivery Person', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function multiple() {
      if($this->session->userdata('user_type') == '')
        // if(empty($this->session->userdata('name')))
      redirect('admin');
        $data = array();
        if($this->session->userdata('user_type') == 'branch'){
          $data['row'] = $this->assign_deliveryperson_model->get_all_bybranch($this->session->userdata('id'));
        }else{
        $data['row'] = $this->assign_deliveryperson_model->get_all();
      }
        // $data['row'] = $this->assign_deliveryperson_model->get_all();
        $content = $this->load->view('admin/assign_delivery/multiple', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Assign Delivery Person list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Assign Delivery Person list']], true);
        $renderdata = ['page_title' => 'Assign Delivery Person', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function create($id = '') {
        $data = array();
        $pageData = ['title' => 'Manually Assign Delivery person', 'nav' => ['dashboard' => 'Dashboard', 'assign_deliveryperson' => 'Assign_deliveryperson list', 'blank' => 'Assign Delivery person']];
        if($this->session->userdata('user_type') == 'branch'){
          $data['consignment_id'] = $this->assign_deliveryperson_model->get_all_consignment_notAssigned_tillNowbybranch($this->session->userdata('id'));
        }else
        $data['consignment_id'] = $this->assign_deliveryperson_model->get_all_consignment_notAssigned_tillNow();
        {

        }
        $data['d_person'] = $this->assign_deliveryperson_model->get_where_all('delivery_person', ['status' => 'active']);
        $data['branch'] = $this->assign_deliveryperson_model->get_where_all('branch', ['status' => 'active']);

        if (isset($id) && $id > 0) {
            $pageData["title"] = "Edit Assign Delivery person";
            $pageData["nav"]["blank"] = "Edit Assign Delivery person";
            $data['row'] = $this->assign_deliveryperson_model->get_where_all('assign_delivery', ["id" => $id]);
            $data['consignment_id'] = $this->assign_deliveryperson_model->get_all_consignment_Assigned_tillNow();
            $data['row'] = $data['row'][0];
        }
        $content = $this->load->view('admin/assign_delivery/create', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Delivery Person ', 'js' => ['assign_delivery'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function create_multiple($id = '') {
        $data = array();
        $pageData = ['title' => 'Multiple Assign Delivery person', 'nav' => ['dashboard' => 'Dashboard', 'assign_deliveryperson' => 'Assign_deliveryperson list', 'blank' => 'Assign Delivery person']];
        // $data['consignment_id'] = $this->assign_deliveryperson_model->get_all_consignment_notAssigned();
        $data['d_person'] = $this->assign_deliveryperson_model->get_where_all('delivery_person', ['status' => 'active']);
        $data['branch'] = $this->assign_deliveryperson_model->get_where_all('branch', ['status' => 'active']);
        $data['district'] = $this->assign_deliveryperson_model->get_where_all('district', ['status' => 'active']);

        if (isset($id) && $id > 0) {
            $pageData["title"] = "Edit Assign Delivery person";
            $pageData["nav"]["blank"] = "Edit Assign Delivery person";
            $data['row'] = $this->assign_deliveryperson_model->get_where_all('assign_delivery', ["id" => $id]);
            $data['row'] = $data['row'][0];
        }
        $content = $this->load->view('admin/assign_delivery/create_multiple', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Delivery Person ', 'js' => ['assign_delivery_multiple'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function createsave() {
      if($this->input->post('consignment_id') != "" && $this->input->post('delivery_person') != "" && $this->input->post('selected_branch') != "" ){
        $id = $this->input->post("id");
        if (isset($id) && $id > 0) {
            if($this->input->post('edit_receive') == "yes"){
              $res = $this->assign_deliveryperson_model->update('assign_receive', [
                  'consignment' => $this->input->post('consignment_id'),
                  'branch' => $this->input->post('selected_branch'),
                  'delivery_person' => $this->input->post('delivery_person')],
                   ['id' => $id]);
              $response['message'] = "Manually Assign Of Delivery Person updated successfully";
              $response['success'] = true;
            }else{
                $res = $this->assign_deliveryperson_model->update('assign_delivery', [
                    'consignment' => $this->input->post('consignment_id'),
                    'branch' => $this->input->post('selected_branch'),
                    'delivery_person' => $this->input->post('delivery_person')],
                     ['id' => $id]);
                $response['message'] = "Manually Assign Of Delivery Person updated successfully";
                $response['success'] = true;
              }

        } else {



                $res = $this->assign_deliveryperson_model->insert('assign_delivery', ['id' => $this->input->post('id'),
                    'consignment' => $this->input->post('consignment_id'),
                    'branch' => $this->input->post('selected_branch'),
                    'delivery_person' => $this->input->post('delivery_person')
                    ]);
                    if($res){
                    $this->assign_deliveryperson_model->update('consignment', [
                        'status' => 'assigned',], ['id' => $this->input->post('consignment_id')]);
                      }
                $response['message'] = "Delivery Person manually Assign successfully";
                $response['success'] = true;

        }
      }else{
        $response['message'] = "Please check all required fields";
        $response['success'] = false;
      }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }


    public function createsave_multiple() {
      // echo $this->input->post('consignment_id'); die;
        $id = $this->input->post("id");
        $consignments = $this->input->post('consignment_id');
        $ar = explode(",",$consignments);
        // print_r($ar);die;
        // $ar = $this->input->post('consignment_id');
        // $consignments = implode(',', $ar);
        if (isset($id) && $id > 0) {


                $res = $this->assign_deliveryperson_model->update('assign_delivery', [
                    'consignment' => $this->input->post('consignment_id'),
                    'branch' => $this->input->post('selected_branch'),
                    'delivery_person' => $this->input->post('delivery_person')],
                     ['id' => $id]);
                $response['message'] = "Manually Assign Of Delivery Person updated successfully";
                $response['success'] = true;

        } else {


                foreach ($ar as $key => $value) {
                  $consid = $this->assign_deliveryperson_model->get_where_all('consignment', ['consignment_id' => $value]);
                  $res = $this->assign_deliveryperson_model->insert('assign_receive', ['id' => $this->input->post('id'),
                      'consignment' => $consid[0]['id'],
                      'branch' => $this->input->post('selected_branch'),
                      'delivery_person' => $this->input->post('delivery_person')
                      ]);
                      if($res){
                      $this->assign_deliveryperson_model->update('consignment', [
                          'receive_status' => 'assigned',], ['id' => $consid[0]['id']]);

                          $this->assign_deliveryperson_model->insert('tracking', ['consignmentId' => $value,
                                     'detail' => "Assigned for pickup",
                                     'consignment_status' => "Pickup Scheduled"]);
                        }

                }
                  redirect('admin/assign_deliveryperson/assign_delivery');

        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function createsave_multiple_delivery_demo() {
      // echo $this->input->post('consignment_id'); die;
      $date = date("Y-m-d");
        $id = $this->input->post("id");
        $consignments = $this->input->post('consignment_id');
        $ar = explode(",",$consignments);
        // $ar = $this->input->post('consignment_id');
        // $consignments = implode(',', $ar);
        if (isset($id) && $id > 0) {


                $res = $this->assign_deliveryperson_model->update('assign_delivery', [
                    'consignment' => $this->input->post('consignment_id'),
                    'branch' => $this->input->post('selected_branch'),
                    'delivery_person' => $this->input->post('delivery_person')],
                     ['id' => $id]);
                $response['message'] = "Manually Assign Of Delivery Person updated successfully";
                $response['success'] = true;

        } else {


                foreach ($ar as $key => $value) {
                  $consid = $this->assign_deliveryperson_model->get_where_all('consignment', ['consignment_id' => $value]);
                  $checkassign = $this->assign_deliveryperson_model->get_where_all('assign_delivery', ['consignment' => $consid[0]['id']]);
                  // print_r($checkassign);die;
                  if(!empty($checkassign)){
                    $this->assign_deliveryperson_model->update('assign_delivery', ['consignment' => $consid[0]['id'],
                        'branch' => $this->input->post('selected_branch'),
                        'delivery_person' => $this->input->post('delivery_person')
                        ], ['consignment' => $consid[0]['id']]);
                  }else{
                  $res = $this->assign_deliveryperson_model->insert('assign_delivery', ['id' => $this->input->post('id'),
                      'consignment' => $consid[0]['id'],
                      'branch' => $this->input->post('selected_branch'),
                      'delivery_person' => $this->input->post('delivery_person')
                      ]);
                      if($res){
                      $this->assign_deliveryperson_model->update('consignment', [
                          'status' => 'assigned','delivery_status' => 'in-transit','assigned_date' => $date], ['id' => $consid[0]['id']]);
                          $this->assign_deliveryperson_model->insert('tracking', [
                              'consignmentId' => $value,'consignment_status' => 'in-transit','detail' => 'Out for delivery']);
                        }
                      }

                }
                redirect('admin/assign_deliveryperson/assign_delivery');


        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }


    public function createsave_multiple_delivery() {
      // echo $this->input->post('consignment_id'); die;
      $date = date("Y-m-d");
        $id = $this->input->post("id");
        $consignments = $this->input->post('consignment_id');
        $ar = explode(",",$consignments);
        // $ar = $this->input->post('consignment_id');
        // $consignments = implode(',', $ar);
        if (isset($id) && $id > 0) {


                $res = $this->assign_deliveryperson_model->update('assign_delivery', [
                    'consignment' => $this->input->post('consignment_id'),
                    'branch' => $this->input->post('selected_branch'),
                    'delivery_person' => $this->input->post('delivery_person')],
                     ['id' => $id]);
                $response['message'] = "Manually Assign Of Delivery Person updated successfully";
                $response['success'] = true;

        } else {


                foreach ($ar as $key => $value) {
                  $consid = $this->assign_deliveryperson_model->get_where_all('consignment', ['consignment_id' => $value]);
                  $checkassign = $this->assign_deliveryperson_model->get_where_all('assign_delivery', ['consignment' => $consid[0]['id']]);

                  ////adding cutomer bulk sms/////
                  $custdetail = $this->assign_deliveryperson_model->get_where_all('shiping', ['id' => $consid[0]['recipient_address']]);
                  $merchdetail = $this->assign_deliveryperson_model->get_where_all('customer', ['id' => $consid[0]['customer']]);
                  //////adding customer bulk sms/////
                  // print_r($checkassign);die;
                  if(!empty($checkassign)){
                    $this->assign_deliveryperson_model->update('assign_delivery', ['consignment' => $consid[0]['id'],
                        'branch' => $this->input->post('selected_branch'),
                        'delivery_person' => $this->input->post('delivery_person')
                        ], ['consignment' => $consid[0]['id']]);

                        // if($consid[0]['customer'] == '164'){
                        ///adding bulk sms//
                        $randnum = rand(1000,9999);
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                          CURLOPT_URL => 'https://api.smsinbd.com/sms-api/sendsms',
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => '',
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => 'POST',
                          CURLOPT_POSTFIELDS => array('api_token' => 'IZBcThg1B9REVWFClw8IfYpoq8nU0uDKxZghqNg6','senderid' => '8801847121242','contact_number' => $custdetail[0]['recipient_number'],'message' => 'Speedy Porter has forwarded your order '.$consid[0]["consignment_id"].' from '.$merchdetail[0]["company"].'. Parcel is out for delivery. Your Speedy Porter OTP is '.$randnum),
                        ));

                        $respo = curl_exec($curl);

                        curl_close($curl);
                        // echo $respo;
                        ////bulk sms end///
                      // }

                  }else{
                  $res = $this->assign_deliveryperson_model->insert('assign_delivery', ['id' => $this->input->post('id'),
                      'consignment' => $consid[0]['id'],
                      'branch' => $this->input->post('selected_branch'),
                      'delivery_person' => $this->input->post('delivery_person')
                      ]);
                      if($res){
                      $this->assign_deliveryperson_model->update('consignment', [
                          'status' => 'assigned','delivery_status' => 'in-transit','assigned_date' => $date], ['id' => $consid[0]['id']]);
                          $this->assign_deliveryperson_model->insert('tracking', [
                              'consignmentId' => $value,'consignment_status' => 'in-transit','detail' => 'Out for delivery']);

                              // if($consid[0]['customer'] == '164'){
                              ///adding bulk sms//
                              $randnum = rand(1000,9999);
                              $curl = curl_init();

                              curl_setopt_array($curl, array(
                                CURLOPT_URL => 'https://api.smsinbd.com/sms-api/sendsms',
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => array('api_token' => 'IZBcThg1B9REVWFClw8IfYpoq8nU0uDKxZghqNg6','senderid' => '8801847121242','contact_number' => $custdetail[0]['recipient_number'],'message' => 'Speedy Porter has forwarded your order '.$consid[0]["consignment_id"].' from '.$merchdetail[0]["company"].'. Parcel is out for delivery. Your Speedy Porter OTP is '.$randnum),
                              ));

                              $respo = curl_exec($curl);

                              curl_close($curl);
                              // echo $respo;
                              ////bulk sms end///
                            // }
                        }
                      }

                }
                redirect('admin/assign_deliveryperson/assign_delivery');
        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function delete($id) {
        $consignment_id = $this->assign_deliveryperson_model->get_where_all('assign_delivery', ['status' => 'active','id'=>$id]);
        $conId = $consignment_id[0]['consignment'];
        $check=$this->assign_deliveryperson_model->delete_assign_delivery($id);
        $this->assign_deliveryperson_model->update('consignment', [
            'status' => 'not_assigned',], ['id' => $conId]);
        $response['message'] = "Manually Assign Of Delivery Person deleted successfully";
        $response['success'] = true;
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function getConsignment() {

            $response = array();
            if ($this->input->post('dist') > 0) {
                if ($this->input->post('station') > 0) {
                  $dist = $this->input->post('dist');
                  $station = $this->input->post('station');
                  if($this->session->userdata('user_type') == 'branch'){
                    $response = $this->assign_deliveryperson_model->get_allconsignment_notAssignedbybranch($dist,$station,$this->session->userdata('id'));
                  }else{
                  $response = $this->assign_deliveryperson_model->get_allconsignment_notAssigned($dist,$station);
                }
                }else{
                  $dist = $this->input->post('dist');
                  if($this->session->userdata('user_type') == 'branch'){
                    $response = $this->assign_deliveryperson_model->get_all_consignment_notAssignedbybranch($dist,$this->session->userdata('id'));
                  }else{
                  $response = $this->assign_deliveryperson_model->get_all_consignment_notAssigned($dist);
                }
                }

            }
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();

    }

    public function receive(){
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
        $data['row'] = $this->assign_deliveryperson_model->get_receive($arr);
        $data['branch'] = $this->assign_deliveryperson_model->get_where_all('branch', ['status' => 'active']);
        $data['merchant'] = $this->assign_deliveryperson_model->get_where_all('customer', ['status' => 'active']);
        $content = $this->load->view('admin/assign_delivery/receive', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Receive Assignment List', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Receive Assignment List']], true);
        $renderdata = ['page_title' => 'Receive Assignment List', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function receive_cons_demo($id){
      $res = $this->assign_deliveryperson_model->update('consignment', [
          'cons_status' => "received"],
           ['id' => $id]);
           $consignmentid = $this->assign_deliveryperson_model->get_where_all('consignment', ['id' => $id]);
           $this->assign_deliveryperson_model->insert('tracking', ['consignmentId' => $consignmentid[0]['consignment_id'],
                      'detail' => "Parcel received",
                      'consignment_status' => "Pickup Done"]);
      redirect('admin/assign_deliveryperson/receive');
    }

    public function receive_cons($id){
      $res = $this->assign_deliveryperson_model->update('consignment', [
          'cons_status' => "received"],
           ['id' => $id]);
           $consignmentid = $this->assign_deliveryperson_model->get_where_all('consignment', ['id' => $id]);
           $this->assign_deliveryperson_model->insert('tracking', ['consignmentId' => $consignmentid[0]['consignment_id'],
                      'detail' => "Parcel received",
                      'consignment_status' => "Pickup Done"]);

                      //////adding bulk sms to customer//////
            $custdetail = $this->assign_deliveryperson_model->get_where_all('shiping', ['id' => $consignmentid[0]['recipient_address']]);
            $merchdetail = $this->assign_deliveryperson_model->get_where_all('customer', ['id' => $consignmentid[0]['customer']]);

            // if($consignmentid[0]['customer'] == '164'){
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://api.smsinbd.com/sms-api/sendsms',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => array('api_token' => 'IZBcThg1B9REVWFClw8IfYpoq8nU0uDKxZghqNg6','senderid' => '8801847121242','contact_number' => $custdetail[0]['recipient_number'],'message' => 'Speedy Porter has collected your product '.$consignmentid[0]["consignment_id"].' from '.$merchdetail[0]["company"].'. Track in Speedy Porter Website https://SPEEDYPORTER.com/tracking'),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
          // }
            // echo $response;
      redirect('admin/assign_deliveryperson/receive');
    }

    public function cancel_cons($id){
      $res = $this->assign_deliveryperson_model->update('consignment', [
          'cons_status' => "cancelled",
          // 'receive_status' => "not_assigned",
          'delivery_status' => "cancelled"],
           ['id' => $id]);
      redirect('admin/assign_deliveryperson/receive');
    }

    public function retrieve_cons($id){
      $res = $this->assign_deliveryperson_model->update('consignment', [
          'cons_status' => "pending",
          // 'receive_status' => "not_assigned",
          'delivery_status' => "pending"],
           ['id' => $id]);
           // if($res){
           //   $this->assign_deliveryperson_model->delete('assign_receive', ['consignment'=>$id]);
           // }
      redirect('admin/assign_deliveryperson/receive');
    }

    public function assign_transporter(){
      if($this->session->userdata('user_type') == '')
        // if(empty($this->session->userdata('name')))
      redirect('admin');
      $input = $this->input->post();
      $arr = [];

      if(isset($input['company']) && $input['company']!=''){
        $arr['company'] = $input['company'];
      }

      if($this->session->userdata('user_type') == 'branch'){
        $arr['branch'] = $this->session->userdata('branch');
      }
        $data = array();
        $data['src'] = $input;
        $data['row'] = $this->assign_deliveryperson_model->get_all_list($arr);
        $data['merch'] = $this->assign_deliveryperson_model->get_where_all('customer', ['status'=>'active']);
        $data['branch'] = $this->assign_deliveryperson_model->get_where_all('branch', ['status' => 'active']);
        $content = $this->load->view('admin/assign_delivery/assign_transporter', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Assign Transporter', 'nav' => ['dashboard' => 'Dashboard', 'assign_deliveryperson/receive' => 'Receive Assignment List', 'blank' => 'Assign Transporter']], true);
        $renderdata = ['page_title' => 'Assign Transporter', 'js' => ['assign_delivery_multiple'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function gettransporters() {

            $response = array();
            if ($this->input->post('ofc') > 0) {
                $office = $this->input->post('ofc');
                $response = $this->assign_deliveryperson_model->get_where_all('delivery_person',['office' => $office,'status' => 'active']);

            }
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();

    }

    public function edit($id = '') {
        $data = array();
        $data['d_person'] = $this->assign_deliveryperson_model->get_where_all('delivery_person', ['status' => 'active']);
        $data['branch'] = $this->assign_deliveryperson_model->get_where_all('branch', ['status' => 'active']);

        if (isset($id) && $id > 0) {
            // $pageData["title"] = "Edit Assign Delivery person";
            // $pageData["nav"]["blank"] = "Edit Assign Delivery person";
            $data['row'] = $this->assign_deliveryperson_model->get_where_all('assign_delivery', ["id" => $id]);
            $data['consignment_id'] = $this->assign_deliveryperson_model->get_all_consignment_Assigned_tillNow();
            $data['row'] = $data['row'][0];
        }
        $content = $this->load->view('admin/assign_delivery/create', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
          $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Edit Assign Transporter', 'nav' => ['dashboard' => 'Dashboard', 'assign_deliveryperson/delivery' => 'Delivery Assignment List', 'blank' => 'Edit Assign Transporter']], true);
        $renderdata = ['page_title' => 'Delivery Person ', 'js' => ['assign_delivery'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }


    public function edit_receive($id = '') {
        $data = array();
        $data['d_person'] = $this->assign_deliveryperson_model->get_where_all('delivery_person', ['status' => 'active']);
        $data['branch'] = $this->assign_deliveryperson_model->get_where_all('branch', ['status' => 'active']);

        if (isset($id) && $id > 0) {
            // $pageData["title"] = "Edit Assign Receiver";
            // $pageData["nav"]["blank"] = "Edit Assign Receiver";
            $data['row'] = $this->assign_deliveryperson_model->get_where_all('assign_receive', ["id" => $id]);
            $data['consignment_id'] = $this->assign_deliveryperson_model->get_all_consignment_Assigned_tillNow_receive();
            $data['row'] = $data['row'][0];
        }
        // print_r($data);die;
        $data['edit_receive'] = "yes";
        $content = $this->load->view('admin/assign_delivery/create', $data, true);
        // $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Edit Assign Receiver', 'nav' => ['dashboard' => 'Dashboard', 'assign_deliveryperson/receive' => 'Receive Assignment List', 'blank' => 'Edit Assign Receiver']], true);
        $renderdata = ['page_title' => 'Delivery Person ', 'js' => ['assign_delivery_to'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function delivery(){
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
          // $arr['status'] = 'active';
          if($this->session->userdata('user_type') == 'branch'){
            $arr['company'] = $this->session->userdata('branch');
          }
          $data['src'] = $input;
        $data['row'] = $this->assign_deliveryperson_model->get_deliver($arr);
        $data['branch'] = $this->assign_deliveryperson_model->get_where_all('branch', ['status' => 'active']);
        $data['merchant'] = $this->assign_deliveryperson_model->get_where_all('customer', ['status' => 'active']);
        $content = $this->load->view('admin/assign_delivery/delivery', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Delivery Assignment List', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Delivery Assignment List']], true);
        $renderdata = ['page_title' => 'Delivery Assignment List', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function assign_delivery_demo() {
      if($this->session->userdata('user_type') == '')
      redirect('admin');
        $data = array();
        $input = $this->input->post();
        if ($this->input->post('district') > 0) {
          $dist = $this->input->post('district');
          $statns = $this->input->post('police_station');
          $statns_tags = implode(', ', $this->input->post('police_station'));
          $data['row'] = $this->assign_deliveryperson_model->get_allconsignment_notAssigned_object($dist,$statns_tags);
          $data['show'] = $input;
          // print_r($data['row']);die;
        }else{
        $data['row'] = $this->assign_deliveryperson_model->get_allconsignment_notAssigned_objectall();
      }
        $data['branch'] = $this->assign_deliveryperson_model->get_where_all('branch', ['status' => 'active']);
        $data['district'] = $this->assign_deliveryperson_model->get_where_all('district', ['status' => 'active']);
        // $data['row'] = $this->Add_data_model->get_where_all('district', ['status' => 'active']);
        $content = $this->load->view('admin/assign_delivery/assign_delivery_transporter', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Assign Delivery', 'nav' => ['dashboard' => 'Dashboard', 'assign_deliveryperson/delivery' => 'Delivery Assignment List', 'blank' => 'Assign Delivery']], true);
        $renderdata = ['page_title' => 'Assign Delivery','js' => ['assign_delivery'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function assign_delivery() {
      if($this->session->userdata('user_type') == '')
      redirect('admin');
        $data = array();
        $input = $this->input->post();
        if ($this->input->post('district') > 0) {
          $dist = $this->input->post('district');
          $statns = $this->input->post('police_station');
          $statns_tags = implode(', ', $this->input->post('police_station'));
          $data['row'] = $this->assign_deliveryperson_model->get_allconsignment_notAssigned_object($dist,$statns_tags);
          $data['show'] = $input;
          // print_r($data['row']);die;
        }else{
        $data['row'] = $this->assign_deliveryperson_model->get_allconsignment_notAssigned_objectall();
      }
        $data['branch'] = $this->assign_deliveryperson_model->get_where_all('branch', ['status' => 'active']);
        $data['district'] = $this->assign_deliveryperson_model->get_where_all('district', ['status' => 'active']);
        // $data['row'] = $this->Add_data_model->get_where_all('district', ['status' => 'active']);
        $content = $this->load->view('admin/assign_delivery/assign_delivery_transporter0', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Assign Delivery', 'nav' => ['dashboard' => 'Dashboard', 'assign_deliveryperson/delivery' => 'Delivery Assignment List', 'blank' => 'Assign Delivery']], true);
        $renderdata = ['page_title' => 'Assign Delivery','js' => ['assign_delivery0'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }


}
