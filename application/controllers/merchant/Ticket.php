<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ticket_model');
    }

    public function index(){
      if($this->session->userdata('user_type') == '')
      redirect('login');
      $data = array();
      $mID = $this->session->userdata('id');
      $data['row'] = $this->ticket_model->get_all_tickets_merchant($mID);
      $content = $this->load->view('merchant/ticket', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Tickets', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Tickets']], true);
      $renderdata = ['page_title' => 'Ticket', 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }

    public function raise_a_ticket($id,$consignno) {
        $data = array();
        $pageData = ['title' => 'Raise New Ticket', 'nav' => ['dashboard' => 'Dashboard', 'ticket' => 'Tickets', 'blank' => 'Raise New Ticket']];
        $cusId=$this->session->userdata('id');
        $data['consignment_id'] = $this->ticket_model->get_merchant_consignment($cusId);
        // if (isset($id) && $id > 0) {
        //     $pageData["title"] = "Edit Branch";
        //     $pageData["nav"]["blank"] = "Edit Branch";
        //     $data['row'] = $this->branch_model->get_where_all('branch', ["id" => $id]);
        //     $data['row'] = $data['row'][0];
        // }
        $data['consignno'] = $consignno;
        $data['consignid'] = $id;
        $content = $this->load->view('merchant/raise_ticket', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Raise New Ticket', 'js' => ['raise_ticket'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function createsave() {
        $id = $this->input->post("id");
        $if_exist_oldtkt = $this->ticket_model->get_where_all('ticket', ['consignment_no' => $this->input->post('consignment_no'),'status'=>'open']);
        if ($if_exist_oldtkt) {
              $ticketno = 'AB-T'.$this->random_strings(4);
              $date = date("Y-m-d H:i:s");
              $merchantId = $_SESSION['id'];

              if(!empty($this->input->post('fileValue'))){
                $file=$this->input->post('fileValue');
              }else{
                $file=$this->input->post('oldfileValue');
              }


                $res = $this->ticket_model->update('ticket', [
                  'ticket_no' => $ticketno,
                'consignment_no' => $this->input->post('consignment_no'),
                'subject' => $this->input->post('subject'),
                'description' => $this->input->post('description'),
                'merchant' => $merchantId,
                'date_open' => $date,
                'file' => $file], ['id' => $if_exist_oldtkt[0]['id']]);
                $response['message'] = "Tciket updated successfully";
                $response['success'] = true;

        } else {
            // $res = $this->ticket_model->get_where_all('customer', ['phone' => $this->input->post('phno')]);
              $ticketno = 'AB-T'.$this->random_strings(4);
              $date = date("Y-m-d H:i:s");
              $merchantId = $_SESSION['id'];

                $res = $this->ticket_model->insert('ticket', ['ticket_no' => $ticketno,
                'consignment_no' => $this->input->post('consignment_no'),
                'subject' => $this->input->post('subject'),
                'merchant' => $merchantId,
                'description' => $this->input->post('description'),
                'date_open' => $date,
                'file' => $this->input->post('fileValue')
                ]);

                $response['message'] = "Ticket raised successfully";
                $response['success'] = true;
        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    function fileUpload(){
    $countfiles = count($_FILES['files']['name']);
    $upload_location = "uploads/ticket/";
    $files_arr = array();
    for($index = 0;$index < $countfiles;$index++){
      $filename = $_FILES['files']['name'][$index];
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      $valid_ext = array('doc','pdf','gif', 'png', 'jpg','jpeg');
      if(in_array($ext, $valid_ext)){
        $fname = time().$filename;
        $path = $upload_location.$fname;
          if(move_uploaded_file($_FILES['files']['tmp_name'][$index],$path)){
            $files_arr[] = $fname;
         }
      }else{
        echo "file type not allowed";
      }
    }
    echo implode('###',$files_arr);
  }

  public function random_strings($length_of_string)
{
  $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

  return substr(str_shuffle($str_result),
                     0, $length_of_string);
}

}
