<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ticket_model');
    }

    public function index(){
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
      $data['row'] = $this->ticket_model->get_all_tickets($arr);
      $data['status'] = $this->ticket_model->get_status();
      $data['merchant'] = $this->ticket_model->get_where_all('customer', ['status' => 'active']);
      $data['src'] = $row;
      $content = $this->load->view('merchant/ticket', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Tickets', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Tickets']], true);
      $renderdata = ['page_title' => 'Ticket', 'js' => ['raise_tickets'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }

    public function isread(){
    $ticketid = $this->input->post('tkt');
    $this->ticket_model->update('ticket', ['isread' => 1], ['id' => $ticketid]);
    echo "success";
    }

    public function allread(){
    $all = $this->input->post('tkt');
    $this->ticket_model->allread();
    echo "success";
    }

    public function updateStatus() {
            $response = array();
            if ($this->input->post('status')!= "") {
                $date = date("Y-m-d H:i:s");
                $status = $this->input->post('status');
                $id = $this->input->post('id');
                if($status == 'open'){
                $this->ticket_model->update('ticket', ['status' => $status,'comment' => $this->input->post('comment')], ['id' => $id]);
              }else if($status == 'close'){
                $this->ticket_model->update('ticket', ['status' => $status,'comment' => $this->input->post('comment'),'date_close' => $date], ['id' => $id]);
              }else if($status == 'declined'){
                $this->ticket_model->update('ticket', ['status' => $status,'comment' => $this->input->post('comment')], ['id' => $id]);
              }else{
                $this->ticket_model->update('ticket', ['status' => $status,'comment' => $this->input->post('comment')], ['id' => $id]);
              }
                $response['message'] = "Ticket Updated successfully";
                $response['success'] = true;
            }
            redirect('admin/tickets');
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response));
            exit();

    }

    public function chat($ticketID,$ticketno){
      if($this->session->userdata('user_type') == '')
      redirect('admin');
        $data = array();
        $data['chat'] = $this->ticket_model->get_where_all('ticket_chat', ['ticket_id' => $ticketID]);
        $data['ticket_id'] = $ticketID;
        $data['ticket_no'] = $ticketno;
        $content = $this->load->view('merchant/ticket_chat', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Ticket Chat', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Ticket Chat']], true);
        $renderdata = ['page_title' => 'Ticket Chat', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function send() {
      if($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'staff' || $this->session->userdata('user_type') == 'customer_care'){
        $sender = 'admin';
      }else{
        $sender = $this->session->userdata('name');
      }
        // date_default_timezone_set('Asia/Jakarta');
        $ticketid = $this->input->post('ticketid');
        $ticketno = $this->input->post('ticketno');
        $date = date('Y-m-d H:i:s');
        $message = array(
                    'sender' => $sender,
                    'ticket_id' => $ticketid,
                    'time' => $date,
                    'isread' => 0,
                    'text' => $this->input->post('message')
                 );

        $this->ticket_model->insert('ticket_chat', $message);
        redirect (base_url('admin/tickets/chat/'.$ticketid.'/'.$ticketno));
    }



}
