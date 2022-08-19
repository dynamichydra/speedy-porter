
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->model('customer_model');
    }

    public function index() {
        if($this->session->userdata('user_type')!= 'customer')
      redirect('/');
        $customer=$this->customer_model->get_where_all('customer', ['id' => $this->session->userdata('id')]);
        $data=array('page_title'=>'Welcome | :: SPEEDY PORTER ::','banner_title'=>'Dashboard','layout_page'=>'dashboard','customer'=>$customer);
        $this->load->view('layout',$data);
    }

    public function report(){
      if($this->session->userdata('user_type')!= 'customer')
        // if(empty($this->session->userdata('name')))
      redirect('/');
        $consignment=$this->customer_model->get_where_all('consignment', ['customer' => $this->session->userdata('id')]);
        $data=array('page_title'=>'Report | :: SPEEDY PORTER ::','banner_title'=>'Report','layout_page'=>'delivery_report','consignment'=>$consignment);
        $this->load->view('layout',$data);
    }

    public function status($consignmentId){
      if($this->session->userdata('user_type')!= 'customer')
        // if(empty($this->session->userdata('name')))
      redirect('/');
        $consignment_id = $this->customer_model->get_where_all('consignment', [' consignment_id' => $consignmentId]);
        $consignment= $this->customer_model->get_where_all('tracking', [' consignmentId' => $consignmentId]);
        $data=array('page_title'=>'TRACKING STATUS | :: SPEEDY PORTER ::','banner_title'=>'TRACKING STATUS','layout_page'=>'delivery_report_detail','consignment'=>$consignment, 'consignment_id'=> $consignment_id);
        $this->load->view('layout',$data);
    }


}
