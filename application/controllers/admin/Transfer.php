<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Transfer_model');
        $this->load->model('assign_deliveryperson_model');
    }

    public function index() {
      if($this->session->userdata('user_type') == '')
      redirect('admin');
        $data = array();
        $data['branch'] = $this->Transfer_model->get_where_all('branch', ['status' => 'active']);
        $data['district'] = $this->Transfer_model->get_where_all('district', ['status' => 'active']);
        // $data['row'] = $this->Add_data_model->get_where_all('district', ['status' => 'active']);
        $content = $this->load->view('admin/transfer/index', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Transfer to Office', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Transfer to Office']], true);
        $renderdata = ['page_title' => 'Transfer to Office','js' => ['transfer'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

  public function createsave(){
    if($this->input->post('consignment_id') != "" && $this->input->post('selected_branch') != ""){
      $ar = $this->input->post('consignment_id');
      // print_r($ar);die;
      foreach ($ar as $key => $value) {
        $res = $this->Transfer_model->update('consignment', [
            'transfer_status' => 'request',
            'status' => 'hold',
            'transfer_to' => $this->input->post('selected_branch')],
             ['id' => $value]);

             $consid = $this->Transfer_model->get_where_all('consignment', ['id' => $value]);
             $branchname = $this->Transfer_model->get_where_all('branch', ['id' => $this->input->post('selected_branch')]);
             $this->assign_deliveryperson_model->insert('tracking', ['consignmentId' => $consid[0]['consignment_id'],
                        'detail' => "To branch $branchname[0]['name']",
                        'consignment_status' => "Transfered "]);
        }
      $response['message'] = "Parcel Transfer successfully";
      $response['success'] = true;
    }else{
      $response['message'] = "Please check all required fields";
      $response['success'] = false;
    }
    $this->output->set_content_type('application/json')
            ->set_output(json_encode($response))->_display();
    exit();
  }

public function getname(){
  $branchname = $this->Transfer_model->get_where_all('branch', ['id' => '15']);
  echo "To branch '".$branchname[0]['name']."'";
  // print_r($branchname);die;
}
  public function createsave_assign(){
    if($this->input->post('consignment_idd') != "" && $this->input->post('selec_branch') != ""){
      $stringar = $this->input->post('consignment_idd');
      $ar = explode(",",$stringar);
      // print_r($ar);die;
      foreach ($ar as $key => $value) {
        $consid = $this->Transfer_model->get_where_all('consignment', ['consignment_id' => $value]);
        $res = $this->Transfer_model->update('consignment', [
            'transfer_status' => 'request',
            'status' => 'hold',
            'transfer_to' => $this->input->post('selec_branch')],
             ['id' => $consid[0]['id']]);

             // $consid = $this->Transfer_model->get_where_all('consignment', ['id' => $value]);
             $branchname = $this->Transfer_model->get_where_all('branch', ['id' => $this->input->post('selec_branch')]);
             $this->assign_deliveryperson_model->insert('tracking', ['consignmentId' => $value,
                        'detail' => 'To branch "'.$branchname[0]['name'].'"',
                        'consignment_status' => "Transfered "]);
        }
      $response['message'] = "Parcel Transfer successfully";
      $response['success'] = true;
    }else{
      $response['message'] = "Please check all required fields";
      $response['success'] = false;
    }
    $this->output->set_content_type('application/json')
            ->set_output(json_encode($response))->_display();
    exit();
  }

  public function out(){
    if($this->session->userdata('user_type') == '')
    redirect('admin');
    if($this->session->userdata('user_type') == 'admin'){
      $tran_to = '11';
    }else{
      $tran_to = $_SESSION['branch'];
    }
      $data = array();
      // $data['branch'] = $this->Transfer_model->get_where_all('branch', ['status' => 'active']);
      // $data['district'] = $this->Transfer_model->get_where_all('district', ['status' => 'active']);
      // $data['row'] = $this->Transfer_model->get_where_all('consignment', ['transfer_status' => 'request','transfer_to!='=>$tran_to]);
      $data['row'] = $this->Transfer_model->get_all_consignment_out($tran_to);
      $content = $this->load->view('admin/transfer/out', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Transfer Out List', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Transfer Out List']], true);
      $renderdata = ['page_title' => 'Transfer Out List', 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
  }

  public function in(){
    if($this->session->userdata('user_type') == '')
    redirect('admin');
    if($this->session->userdata('user_type') == 'admin'){
      $tran_to = '11';
    }else{
      $tran_to = $_SESSION['branch'];
    }
    // echo $tran_to;die;
      $data = array();
      // $data['branch'] = $this->Transfer_model->get_where_all('branch', ['status' => 'active']);
      // $data['district'] = $this->Transfer_model->get_where_all('district', ['status' => 'active']);
      // $data['row'] = $this->Transfer_model->get_where_all('consignment', ['transfer_status' => 'request','transfer_to'=>$tran_to]);
      $data['row'] = $this->Transfer_model->get_all_consignment_in($tran_to);
      $content = $this->load->view('admin/transfer/in', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Transfer In List', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Transfer In List']], true);
      $renderdata = ['page_title' => 'Transfer In List', 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
  }

  public function getPstation() {

          $response = array();
          if ($this->input->post('dist') > 0) {
              $dist = $this->input->post('dist');
              $response = $this->Transfer_model->get_where_all('police_station',['district' => $dist,'status' => 'active']);

          }
          $this->output->set_content_type('application/json')
                  ->set_output(json_encode($response))->_display();
          exit();

  }

  public function getConsignment() {

          $response = array();
          if ($this->input->post('dist') > 0) {
            $statns = $this->input->post('station');
            $statns_tags = implode(', ', $this->input->post('station'));
              if ($this->input->post('station') > 0) {
                $dist = $this->input->post('dist');
                $station = $this->input->post('station');
                if($this->session->userdata('user_type') == 'branch'){
                  // foreach ($statns as $key => $value) {
                  // $resp = $this->assign_deliveryperson_model->get_allconsignment_notAssignedbybranch($dist,$value,$this->session->userdata('id'));
                  // array_push($response,$resp);
                  $response = $this->assign_deliveryperson_model->get_allconsignment_notAssigned_array_branch($dist,$statns_tags,$this->session->userdata('branch'));
                // }
                }else{
                $response = $this->assign_deliveryperson_model->get_allconsignment_notAssigned_array($dist,$statns_tags);
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
          // print_r($response);die;
          $this->output->set_content_type('application/json')
                  ->set_output(json_encode($response))->_display();
          exit();

  }


  public function reverse($id){
        $res = $this->Transfer_model->update('consignment', [
            'transfer_status' => '',
            'status' => 'not_assigned',
            'transfer_to' => ''],
             ['id' => $id]);

      $response['message'] = "Parcel reversed successfully";
      $response['success'] = true;

    // $this->output->set_content_type('application/json')
    //         ->set_output(json_encode($response))->_display();
    // exit();
    redirect('admin/transfer/out');
  }

  public function accept($id){
    $branch = $this->Transfer_model->get_where_all('consignment',['id' => $id]);
    $bname = $this->Transfer_model->get_where_all('branch',['id' => $branch[0]['branch']]);
    $transfered_from = $bname[0]['name'];
        $res = $this->Transfer_model->update('consignment', [
            'transfer_status' => '',
            'status' => 'not_assigned',
            'branch' => $branch[0]['transfer_to'],
            'transfer_from' => $transfered_from,
            'transfer_to' => ''],
             ['id' => $id]);

      $response['message'] = "Parcel accepted successfully";
      $response['success'] = true;

    redirect('admin/transfer/in');
  }

}
