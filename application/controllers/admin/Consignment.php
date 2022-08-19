<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Consignment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('consignment_model');
        $this->load->model('package_model');
    }

    public function index() {
      // ini_set('memory_limit', '1024Ms');
      ini_set('memory_limit','1024M');
      if($this->session->userdata('user_type') == '')
        // if(empty($this->session->userdata('name')))
      redirect('admin');
      $row = $this->input->post();
      $arr = [];
      if(isset($row['office_id']) && $row['office_id']!=''){
        $arr['branch'] = $row['office_id'];
      }

      if(isset($row['merch_id']) && $row['merch_id']!=''){
        $arr['merch_id'] = $row['merch_id'];
      }

      if(isset($row['from_date']) && $row['from_date']!='__-__-____'){
        $arr['from_date'] = $row['from_date'];
      }
      if(isset($row['to_date']) && $row['to_date']!='__-__-____'){
        $arr['to_date'] = $row['to_date'];
      }
      if($this->session->userdata('user_type') == 'branch'){
        $arr['sel_branch'] = $this->session->userdata('branch');
      }

      if($this->session->userdata('user_type') == 'customer'){
        // $arr['by_merchant'] = 1;
        // $arr['created_by'] = $this->session->userdata('id');
        $arr['merch_id'] = $this->session->userdata('id');
      }
      // print_r($arr);die;
        $created_by = $this->session->userdata('id');
        $data = array();
        $data['src'] = $row;
        $data['row'] = $this->consignment_model->get_all_consignment_aadmin($arr);
        $data['branch'] = $this->consignment_model->get_where_all('branch', ['status' => 'active']);
        $data['merchant'] = $this->consignment_model->get_where_all('customer', ['status' => 'active']);
        if($this->session->userdata('user_type') == 'customer'){
          $content = $this->load->view('admin/consignment/index_merchant', $data, true);
        }else{
        $content = $this->load->view('admin/consignment/index', $data, true);
        }
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'consignment list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'consignment list']], true);
        $renderdata = ['page_title' => 'Consignment Details', 'js' => ['consignment_index'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function index_backup() {
      if($this->session->userdata('user_type') == '')
        // if(empty($this->session->userdata('name')))
      redirect('admin');
      if($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'staff'){
        $created_by = $this->session->userdata('id');
        $data = array();
        // $data['row'] = $this->consignment_model->get_all_consignment($created_by);
        $data['row'] = $this->consignment_model->get_all_consignment_aadmin();
        $data['branch'] = $this->consignment_model->get_where_all('branch', ['status' => 'active']);
        $content = $this->load->view('admin/consignment/index', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'consignment list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'consignment list']], true);
        $renderdata = ['page_title' => 'Consignment Details', 'js' => ['consignment_index'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
      }else if($this->session->userdata('user_type') == 'branch'){
        $branch = $this->session->userdata('branch');
        $data = array();
        $data['row'] = $this->consignment_model->get_all_consignment_forbranch($branch);
        $data['branch'] = $this->consignment_model->get_where_all('branch', ['status' => 'active']);
        $content = $this->load->view('admin/consignment/index', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'consignment list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'consignment list']], true);
        $renderdata = ['page_title' => 'Consignment Details', 'js' => ['consignment_index'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
      }else if($this->session->userdata('user_type') == 'delivery'){
        $Delid = $cusId=$this->session->userdata('id');
        $data = array();
        $data['row'] = $this->consignment_model->get_delivery_consignment($Delid);
        $data['branch'] = $this->consignment_model->get_where_all('branch', ['status' => 'active']);
        $content = $this->load->view('admin/consignment/index', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'consignment list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'consignment list']], true);
        $renderdata = ['page_title' => 'Consignment Details', 'js' => ['consignment_index'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
      }else if($this->session->userdata('user_type') == 'customer_care'){
        $Delid = $cusId=$this->session->userdata('id');
        $data['branch'] = $this->consignment_model->get_where_all('branch', ['status' => 'active']);
        $data = array();
        $data['row'] = $this->consignment_model->get_allconsignment();
        $content = $this->load->view('admin/consignment/index', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'consignment list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'consignment list']], true);
        $renderdata = ['page_title' => 'Consignment Details', 'js' => ['consignment_index'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
      }else{
        $cusId=$this->session->userdata('id');
        $data = array();
        $data['row'] = $this->consignment_model->get_merchant_consignment($cusId);
        $data['branch'] = $this->consignment_model->get_where_all('branch', ['status' => 'active']);
        $content = $this->load->view('admin/consignment/index', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'consignment list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'consignment list']], true);
        $renderdata = ['page_title' => 'Consignment Details', 'js' => ['consignment_index'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
      }
    }

    public function create_old($id = '') {
        $data = array();
        $pageData = ['title' => 'Create Consignment', 'nav' => ['dashboard' => 'Dashboard', 'consignment' => 'consignment list', 'blank' => 'Create Consignment']];
        $data['customer'] = $this->consignment_model->get_where_all('customer', ['status' => 'active']);
        $data['package'] = $this->consignment_model->get_where_all('package', ['status' => 'active']);
        $data['district'] = $this->consignment_model->get_where_all('district', ['status' => 'active']);
        $data['d_person'] = $this->consignment_model->get_where_all('delivery_person', ['status' => 'active']);
        $data['branch'] = $this->consignment_model->get_where_all('branch', ['status' => 'active']);
        // $maxno =  $this->consignment_model->get_max_no();
        // $data['autono'] = str_pad(((int)$maxno[0]['no']) + 1,12,'0',STR_PAD_LEFT);
        $data['autono'] = 'AB'.$this->random_strings(8);
        if (isset($id) && $id > 0) {
            $pageData["title"] = "Edit Consignment";
            $pageData["nav"]["blank"] = "Edit Consignment";
            $data['row'] = $this->consignment_model->get_where_all('consignment', ["id" => $id]);
            $data['row'] = $data['row'][0];
            $data['recipient_address'] = $this->consignment_model->get_where_all('shiping', ['id' => $data['row']['recipient_address']]);
            $data['packing'] = $this->consignment_model->get_where_all('packing', ['package_id' => $data['row']['package_name']]);
            $data['assign_delivery'] = $this->consignment_model->get_where_all('assign_delivery', ['consignment' => $id]);
            $data['branch'] = $this->consignment_model->get_where_all('branch', ['status' => 'active']);
          //  echo date( "m/d/Y", strtotime($data['row']['delivery_date']));die;
          // print_r($data['packing']);
          // die;
        }
        $content = $this->load->view('admin/consignment/create', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Consignment ', 'js' => ['consignment'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function create($id = '') {
        $data = array();
        $pageData = ['title' => 'Create Consignment', 'nav' => ['dashboard' => 'Dashboard', 'consignment' => 'consignment list', 'blank' => 'Create Consignment']];
        $data['customer'] = $this->consignment_model->get_where_all('customer', ['status' => 'active']);
        $data['package'] = $this->consignment_model->get_where_all('package', ['status' => 'active']);
        $data['district'] = $this->consignment_model->get_where_all('district', ['status' => 'active']);
        $data['d_person'] = $this->consignment_model->get_where_all('delivery_person', ['status' => 'active']);
        $data['branch'] = $this->consignment_model->get_where_all('branch', ['status' => 'active']);
        // $maxno =  $this->consignment_model->get_max_no();
        // $data['autono'] = str_pad(((int)$maxno[0]['no']) + 1,12,'0',STR_PAD_LEFT);
        $data['autono'] = 'SP'.$this->random_strings(8);
        if (isset($id) && $id > 0) {
            $pageData["title"] = "Edit Consignment";
            $pageData["nav"]["blank"] = "Edit Consignment";
            $data['row'] = $this->consignment_model->get_where_all('order_master', ["id" => $id]);
            $data['row'] = $data['row'][0];
            // $data['recipient_address'] = $this->consignment_model->get_where_all('shiping', ['id' => $data['row']['recipient_address']]);
            // $data['packing'] = $this->consignment_model->get_where_all('packing', ['package_id' => $data['row']['package_name']]);
            $data['assign_delivery'] = $this->consignment_model->get_where_all('assign_delivery', ['consignment' => $id]);
            $data['branch'] = $this->consignment_model->get_where_all('branch', ['status' => 'active']);
          //  echo date( "m/d/Y", strtotime($data['row']['delivery_date']));die;
          // print_r($data['packing']);
          // die;
        }
        $content = $this->load->view('admin/consignment/create0', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Consignment ', 'js' => ['consignment'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function districts(){

      $data = array();
      $data['dist'] = $this->consignment_model->get_where_all('district',['status'=>'active']);
      $response['distdata'] = $data['dist'];

      $this->output->set_content_type('application/json')
              ->set_output(json_encode($response))->_display();
      exit();
    }

    public function volumetric(){

      $data = array();
      $data['vol'] = $this->consignment_model->get_allheight();
      $response['distdata'] = $data['vol'];

      $this->output->set_content_type('application/json')
              ->set_output(json_encode($response))->_display();
      exit();
    }

    public function volumetric_width(){

      $height = $this->input->post('height');
      $data = array();
      $data['vol'] = $this->consignment_model->get_where_all('volumetric',['height'=>$height,'status'=>'active']);
      $response['widthdata'] = $data['vol'];

      $this->output->set_content_type('application/json')
              ->set_output(json_encode($response))->_display();
      exit();
    }

    public function stationlist(){
       $distid = $this->input->post('district');
      $data = array();
      $data['ps'] = $this->consignment_model->get_where_all('police_station',['district'=>$distid]);
      $response['pstdata'] = $data['ps'];

      $this->output->set_content_type('application/json')
              ->set_output(json_encode($response))->_display();
      exit();
    }

    function getpackagepricing() {
            $package = $this->consignment_model->get_where_all('package',['status' => 'active']);
            $response['pckg'] = $package;

            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();

    }


    public function create_delivery2($id = '') {
      $merchId=$this->session->userdata('id');
      $datamerch = $this->consignment_model->get_where_all('customer', ['id' => $merchId]);
      if($datamerch[0]['office'] == "" || $datamerch[0]['address'] == "" || $datamerch[0]['district'] == "" || $datamerch[0]['police_station'] == "" || $datamerch[0]['company'] == "" || $datamerch[0]['package'] == ""){
        $this->session->set_flashdata(['error'=> 'Please Fill all the Mandatory Details on your Profile first','type'=>'error']);
        redirect('merchant/profile/'.$merchId);
      }else{
        $data = array();
        $pageData = ['title' => 'Create Consignment', 'nav' => ['dashboard' => 'Dashboard', 'consignment' => 'consignment list', 'blank' => 'Create Consignment']];
        $data['customer'] = $this->consignment_model->get_where_all('customer', ['status' => 'active']);
        $data['package'] = $this->consignment_model->get_where_all('package', ['status' => 'active']);
        $data['autono'] = 'AB'.$this->random_strings(8);
        $data['district'] = $this->consignment_model->get_where_all('district', ['status' => 'active']);
        if (isset($id) && $id > 0) {
        $maxno =  $this->consignment_model->get_max_no();
        $data['autono'] = str_pad(((int)$maxno[0]['no']) + 1,12,'0',STR_PAD_LEFT);
        $data['row'] = $this->consignment_model->get_where_all('consignment', ["id" => $id]);
        $data['row'] = $data['row'][0];
        $data['shipingd'] = $this->consignment_model->get_where_all('shiping', ["id" => $data['row']['recipient_address']]);
        $content = $this->load->view('admin/consignment/creat_consignment_edit', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Consignment ', 'js' => ['consignment_demo_edit'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
      }else{
        $content = $this->load->view('admin/consignment/create_consignment', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Consignment ', 'js' => ['consignment_demo'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
      }

    }
  }

  public function create_delivery($id = '') {
    $merchId=$this->session->userdata('id');
    $datamerch = $this->consignment_model->get_where_all('customer', ['id' => $merchId]);
    if($datamerch[0]['office'] == "" || $datamerch[0]['address'] == "" || $datamerch[0]['district'] == "" || $datamerch[0]['police_station'] == "" || $datamerch[0]['company'] == "" || $datamerch[0]['package'] == ""){
      $this->session->set_flashdata(['error'=> 'Please Fill all the Mandatory Details on your Profile first','type'=>'error']);
      redirect('merchant/profile/'.$merchId);
    }else{
      $data = array();
      $pageData = ['title' => 'Create Consignment', 'nav' => ['dashboard' => 'Dashboard', 'consignment' => 'consignment list', 'blank' => 'Create Consignment']];
      $data['customer'] = $this->consignment_model->get_where_all('customer', ['status' => 'active']);
      $data['package'] = $this->consignment_model->get_where_all('package', ['status' => 'active']);
      $data['autono'] = 'AB'.$this->random_strings(8);
      $data['district'] = $this->consignment_model->get_where_all('district', ['status' => 'active']);
      if (isset($id) && $id > 0) {
      $maxno =  $this->consignment_model->get_max_no();
      $data['autono'] = str_pad(((int)$maxno[0]['no']) + 1,12,'0',STR_PAD_LEFT);
      $data['row'] = $this->consignment_model->get_where_all('consignment', ["id" => $id]);
      $data['row'] = $data['row'][0];
      $data['shipingd'] = $this->consignment_model->get_where_all('shiping', ["id" => $data['row']['recipient_address']]);
      $content = $this->load->view('admin/consignment/creat_consignment_edit', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
      $renderdata = ['page_title' => 'Consignment ', 'js' => ['consignment_demo_edit'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }else{
      $content = $this->load->view('admin/consignment/create_consignment2', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
      $renderdata = ['page_title' => 'Consignment ', 'js' => ['consignment_demo2'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }

  }
}

  public function create_deliveryedit($id = '') {
    // echo $id;die;
    $merchId=$this->session->userdata('id');
    $datamerch = $this->consignment_model->get_where_all('customer', ['id' => $merchId]);
    if($datamerch[0]['office'] == "" || $datamerch[0]['address'] == "" || $datamerch[0]['district'] == "" || $datamerch[0]['police_station'] == "" || $datamerch[0]['company'] == "" || $datamerch[0]['package'] == ""){
      $this->session->set_flashdata(['error'=> 'Please Fill all the Mandatory Details on your Profile first','type'=>'error']);
      redirect('merchant/profile/'.$merchId);
    }else{
      $data = array();
      $pageData = ['title' => 'Create Consignment', 'nav' => ['dashboard' => 'Dashboard', 'consignment' => 'consignment list', 'blank' => 'Create Consignment']];
      $data['customer'] = $this->consignment_model->get_where_all('customer', ['status' => 'active']);
      $data['package'] = $this->consignment_model->get_where_all('package', ['status' => 'active']);
      $data['autono'] = 'AB'.$this->random_strings(8);
      $data['district'] = $this->consignment_model->get_where_all('district', ['status' => 'active']);
      if (isset($id) && $id > 0) {
      $maxno =  $this->consignment_model->get_max_no();
      $data['autono'] = str_pad(((int)$maxno[0]['no']) + 1,12,'0',STR_PAD_LEFT);
      $data['row'] = $this->consignment_model->get_where_all('consignment', ["id" => $id]);
      $data['row'] = $data['row'][0];
      $data['shipingd'] = $this->consignment_model->get_where_all('shiping', ["id" => $data['row']['recipient_address']]);
      // print_r($data['shipingd']);die;
      $content = $this->load->view('admin/consignment/creat_consignment_edit0', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
      $renderdata = ['page_title' => 'Consignment ', 'js' => ['consignment_edit'], 'content' => $content, 'content_head' => $content_head];
    }else{
      $content = $this->load->view('admin/consignment/create_consignment', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
      $renderdata = ['page_title' => 'Consignment ', 'js' => ['consignment_demo'], 'content' => $content, 'content_head' => $content_head];
    }
      render($renderdata);
  }
}

  public function create_delivery_demo($id = '') {
    $merchId=$this->session->userdata('id');
    $datamerch = $this->consignment_model->get_where_all('customer', ['id' => $merchId]);
    if($datamerch[0]['office'] == "" || $datamerch[0]['address'] == "" || $datamerch[0]['district'] == "" || $datamerch[0]['police_station'] == "" || $datamerch[0]['company'] == "" || $datamerch[0]['package'] == ""){
      $this->session->set_flashdata(['error'=> 'Please Fill all the Mandatory Details on your Profile first','type'=>'error']);
      redirect('merchant/profile/'.$merchId);
    }else{
      $data = array();
      $pageData = ['title' => 'Create Consignment', 'nav' => ['dashboard' => 'Dashboard', 'consignment' => 'consignment list', 'blank' => 'Create Consignment']];
      $data['customer'] = $this->consignment_model->get_where_all('customer', ['status' => 'active']);
      $data['package'] = $this->consignment_model->get_where_all('package', ['status' => 'active']);
      $data['autono'] = 'AB'.$this->random_strings(8);
      $data['district'] = $this->consignment_model->get_where_all('district', ['status' => 'active']);
      if (isset($id) && $id > 0) {
      $maxno =  $this->consignment_model->get_max_no();
      $data['autono'] = str_pad(((int)$maxno[0]['no']) + 1,12,'0',STR_PAD_LEFT);
      $data['row'] = $this->consignment_model->get_where_all('consignment', ["id" => $id]);
      $data['row'] = $data['row'][0];
      $data['shipingd'] = $this->consignment_model->get_where_all('shiping', ["id" => $data['row']['recipient_address']]);
      $content = $this->load->view('admin/consignment/creat_consignment_edit0', $data, true);
    }else{
      $content = $this->load->view('admin/consignment/create_consignment2', $data, true);
    }
      $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
      $renderdata = ['page_title' => 'Consignment ', 'js' => ['consignment'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
  }
}

    public function random_strings($length_of_string)
{

    // String of all alphanumeric character
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    // Shufle the $str_result and returns substring
    // of specified length
    return substr(str_shuffle($str_result),
                       0, $length_of_string);
}

    public function createsave() {
      if($this->input->post('customer') != "" && $this->input->post('shiping') != "" && $this->input->post('recipient_address') != ""){
        $id = $this->input->post("id");
        $user = $this->session->userdata('id');
        $customer = $this->input->post('customer');
        $consignmentid = $this->input->post('consignment_id');
        $product_id = $this->input->post('product_id');
        $parcel_type = $this->input->post('parcel_type');
        $parcel_cat = $this->input->post('parcel_cat');
        $no_of_items = $this->input->post('no_of_items');
		    $no_of_items = ($no_of_items!='')?$no_of_items:1;
        $product_weight = $this->input->post('product_weight');
        // echo $product_weight;die;
		    // $product_weight = ($product_weight!='')?$product_weight:1;
        $package_name = $this->input->post('package_name');
        $payment_method = $this->input->post('payment_method');
        $product_price = $this->input->post('product_price');
		    $product_price = ($product_price!='')?$product_price:0;
        $package_price = $this->input->post('package_price');
		    $package_price = ($package_price!='')?$package_price:0;
        $promo_code = $this->input->post('promo_code');
        $delivery_date = $this->input->post('delivery_date');
        $delivery_time = $this->input->post('delivery_time');
        $total_price_product = $this->input->post('total_price_product');
		    $total_price_product = ($total_price_product!='')?$total_price_product:0;
        $total_price = $this->input->post('total_price');
		    $total_price = ($total_price!='')?$total_price:0;
        $total_weight = $this->input->post('total_weight');
		    $total_weight = ($total_weight!='')?$total_weight:0;
        $instructions = $this->input->post('instructions');
        $grand_total = $this->input->post('grand_total');
		    $grand_total = ($grand_total!='')?$grand_total:0;
        $extra_amount = $this->input->post('extra_amount');
        $cash_collect = $this->input->post('cash_collect');
        $total_cod_charge  = $this->input->post('total_cod_charge');

        // echo $total_weight ;die;
        $raddress = $this->input->post("shiping");
        $forDistrict = $this->consignment_model->get_where_all('customer', ['status' => 'active','id' => $raddress]);
        if($this->session->userdata('user_type') == "customer"){
          $by_merchant = 1;
        }else{
          $by_merchant = 0;
        }

        $data_id = $this->input->post("recipient_data_id");
        if (isset($data_id) && $data_id == "") {
          $resshipping = $this->consignment_model->insert('shiping', [
            'recipient_number' => $this->input->post('recipient_number'),
            'recipient_name' => $this->input->post('recipient_name'),
            'recipient_address' => $this->input->post('recipient_address_shipping'),
            'recipient_address_2' => $this->input->post('recipient_address_2'),

            'district' => $this->input->post('district'),
            'police_station' => $this->input->post('police_station'),
            's_lat' =>$this->input->post('gmap_lat'),
            's_lng'=>$this->input->post('gmap_lng'),
            's_city' =>$this->input->post('gmap_city')]);
            $deliveraddress = $resshipping;
        }else{
          $res = $this->consignment_model->update('shiping',
                ['recipient_number' => $this->input->post('recipient_number'),
                'recipient_name' => $this->input->post('recipient_name'),
                'recipient_address' => $this->input->post('recipient_address_shipping'),
                'recipient_address_2' => $this->input->post('recipient_address_2'),

                'district' => $this->input->post('district'),
                'police_station' => $this->input->post('police_station'),

                's_lat' =>$this->input->post('gmap_lat'),
                's_lng'=>$this->input->post('gmap_lng'),
                's_city' =>$this->input->post('gmap_city')], ['id' => $data_id]);
                $deliveraddress = $data_id;
        }

        if($this->input->post("recipient_address") == "0"){
          $deladdress = $deliveraddress;
        }else{
          $deladdress = $this->input->post("recipient_address");
        }
          $fordelps = $this->consignment_model->get_where_all('shiping', ['id' => $deladdress]);
          if(!empty($fordelps)){
          $del_policeStation = $fordelps[0]['police_station'];
        }else{
          $del_policeStation = "";
        }

        if($forDistrict){
        $district = $forDistrict[0]['district'];
        $policeStation = $forDistrict[0]['police_station'];
        $date = date("Y-m-d H:i:s");
        }else{
          $district = "";
          $policeStation = "";
        }

        if($_SESSION['user_type'] == 'admin'){
          $select_branch = $this->input->post('branch');
        }elseif($_SESSION['user_type'] == 'customer'){
          if($_SESSION['office'] != ""){
          $select_branch = $_SESSION['office'];
        }else{
          $getoffice = $this->consignment_model->get_where_all('customer', ['id' => $_SESSION['id']]);
          $select_branch = $getoffice[0]['office'];
        }
        }else{
          $select_branch = $_SESSION['branch'];
        }
        if (isset($id) && $id > 0) {
              $maxno =  $this->consignment_model->get_max_no();
              $no = (((int)$maxno[0]['no']) + 1);
              if($payment_method == 'merch_will_pay'){
                $narration = "DC will be paid by Merchant";
                if($total_price_product > $total_price){
                $total_price_product_cal = $total_price_product - $total_price;
              }else{
                $total_price_product_cal = $total_price_product;
              }
                // $total_price = $total_price;
                $grand_total = $total_price_product_cal + $total_price;
                $amounttocollect = $cash_collect;
                $paytomerch = floatval($cash_collect) - floatval($total_price)-floatval($total_cod_charge);
              }elseif ($payment_method == 'merch_paid') {
                $narration = "DC is paid by Merchant";
                // $total_price_product = $total_price_product;
                $total_price = $total_price;
                $grand_total = $grand_total;
                $amounttocollect = $cash_collect;
                $paytomerch = floatval($cash_collect) - floatval($total_price)-floatval($total_cod_charge);
              }else{
                // $total_price_product = $total_price_product;
                $total_price = $total_price;
                $grand_total = $grand_total;
                $narration = "COD";
                $amounttocollect = $cash_collect;
                $paytomerch = floatval($cash_collect) - floatval($total_price)-floatval($total_cod_charge);
              }

              if($paytomerch == 0){
                $payment_status_merchant = 'due';
              }else{
                $payment_status_merchant = 'due';
              }

                $res = $this->consignment_model->update('consignment', [
                    'autono' => $no,
                    'del_police_station' => $del_policeStation,
                    'customer' => $customer,
                    'branch' => $select_branch,

                    'extra_amount' => $extra_amount,
                    'cash_collection' => $cash_collect,
                    'total_cod_charge' => $total_cod_charge,

                    'pickup_address' => $raddress,
                    'product_id' => $product_id,
                    'parcel_type' => $parcel_type,
                    'payment_method' => $payment_method,
                    'amounttocollect'=> $amounttocollect,
                    'parcel_category'=> $parcel_cat,
                    'paytomerch' => $paytomerch,
                    'narration' => $narration,
                    'package_name' => $package_name,
                     'product_price' => $product_price,
                     'package_price' => $package_price,
                     'product_weight' => $product_weight,
                     'total_weight' => $total_weight,
                     'total_price_product' => $total_price_product,
                     'recipient_address' => $deladdress,
                     'district' => $district,
                     'police_station' => $policeStation,
                     'payment_status_merchant' =>$payment_status_merchant,
                     'grand_total' => $grand_total,
                     'delivery_date' => $this->input->post("delivery_date") != "" ? date('Y-m-d', strtotime($this->input->post("delivery_date"))) : NULL,
                     'delivery_time' => $delivery_time,
                    'no_of_items' => $no_of_items,
                    'instructions' => $instructions,
                    'last_edit'=> $user,
                    'total_price' => $total_price], ['id' => $id]);
                    if($this->input->post('selected_branch') != ""){
                      $res = $this->consignment_model->update('assign_delivery', [
                          'branch' => $select_branch,
                          'delivery_person' => $this->input->post('delivery_person')
                          ],['consignment' => $id]);
                    }
                $response['message'] = "Consignment updated successfully";
                $response['success'] = true;

        } else {

                if($payment_method == 'merch_will_pay'){
                  $narration = "DC will be paid by Merchant";
                  if($total_price_product > $total_price){
                  $total_price_product_cal = $total_price_product - $total_price;
                }else{
                  $total_price_product_cal = $total_price_product;
                }
                  $grand_total = $total_price_product_cal + $total_price;
                  // $amount_paid = "";
                  $amounttocollect = $cash_collect;
                  $paytomerch = floatval($cash_collect) - floatval($total_price)-round($total_cod_charge);
                }elseif ($payment_method == 'merch_paid') {
                  $narration = "DC is paid by Merchant";
                  // $total_price_product = $total_price_product;
                  $total_price = $total_price;
                  $grand_total = $grand_total;
                  $amounttocollect = $cash_collect;
                  $paytomerch = floatval($cash_collect) - floatval($total_price)-round($total_cod_charge);
                }else{
                  // $total_price_product = $total_price_product;
                  $total_price = $total_price;
                  $grand_total = $grand_total;
                  $narration = "COD";
                  $amounttocollect = $cash_collect;
                  $paytomerch = floatval($cash_collect) - floatval($total_price)-round($total_cod_charge);
                }

                if($paytomerch == 0){
                  $payment_status_merchant = 'due';
                }else{
                  $payment_status_merchant = 'due';
                }

                if($total_price > 0){
                $consid = $this->consignment_model->insert('consignment', ['id' => $this->input->post('id'),
                    'consignment_id' => $consignmentid,
                    'customer' => $customer,
                    'del_police_station' => $del_policeStation,
                    'amounttocollect'=> $amounttocollect,
                    'paytomerch' => $paytomerch,
                    'pickup_address' => $raddress,
                    'parcel_category'=> $parcel_cat,
                    'product_id' => $product_id,
                    'parcel_type' => $parcel_type,
                    'product_weight' => $product_weight,
                    'total_cod_charge' => $total_cod_charge,

                    'extra_amount' => $extra_amount,
                    'cash_collection' => $cash_collect,

                    'payment_method' => $payment_method,
                    'package_name' => $package_name,
                    'package_price' => $package_price,
                    'total_weight' => $total_weight,
                    'total_price_product' => $total_price_product,
                    'narration' => $narration,
                    'payment_status_merchant' =>$payment_status_merchant,
                    'recipient_address' => $deladdress,
                    'district' => $district,
                    'police_station' => $policeStation,
                    'del_police_station' => $del_policeStation,
                    'grand_total' => $grand_total,
                    'created_by' => $user,
                    'by_merchant' => $by_merchant,
                    'branch' => $select_branch,

                     'product_price' => $product_price,
                     'promo_code' => $promo_code,
                     'delivery_date' => $this->input->post("delivery_date") != "" ? date('Y-m-d', strtotime($this->input->post("delivery_date"))) : NULL,
                     'delivery_time' => $delivery_time,
                    'no_of_items' => $no_of_items,
                    'instructions' => $instructions,
                    'delivery_status' => 'pending',
                     'total_price' => $total_price]);
                       $this->package_model->insert('tracking', ['consignmentId' => $consignmentid,
                                  'detail' => "order placed"]);
                                  if($payment_method == "prepaid"){
                                    // $res = $this->consignment_model->insert('payment', [
                                    //     'consignment_id' => $consid,
                                    //     'amount' => $this->input->post('grand_total'),
                                    //     'date' => $date
                                    //     ]);
                                        $this->consignment_model->update('consignment', [
                                            'payment_status' => 'paid','amount_paid'=>$grand_total], ['id' => $consid]);
                                  }
                $response['message'] = "Consignment created successfully";
                $response['success'] = true;
              }else{
                $response['message'] = "Something went wrong! Pls try again";
                $response['success'] = false;
              }

        }
      }else{
        $response['message'] = "please fill all mandatory fields";
        $response['success'] = false;
      }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function delete($id) {
        $this->consignment_model->delete_consignment($id);
        $response['message'] = "Consignment deleted successfully";
        $response['success'] = true;
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function getshipingreceipient() {

            $response = array();
            if ($this->input->post('customer') > 0) {
                $cus = $this->input->post('customer');
                $response = $this->consignment_model->get_where_all('shiping',['status' => 'active']);

            }
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();

    }

    public function getshiping() {

            $response = array();
            if ($this->input->post('customer') > 0) {
                $cus = $this->input->post('customer');
                $response = $this->consignment_model->get_where_all('customer',['id' => $cus,'status' => 'active']);

            }
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();

    }

  public function getpackage(){
    $response = array();
    $packageid = $this->input->post('package_id');
    if ($packageid > 0) {
        $response = $this->consignment_model->get_where_all('package',['id' => $packageid,'status' => 'active']);
    }
    $this->output->set_content_type('application/json')
            ->set_output(json_encode($response))->_display();
    exit();
  }

  public function getps_area(){
    $response = array();
    $service_ps = $this->input->post('service_ps');
    if ($service_ps > 0) {
        $response = $this->consignment_model->get_where_all('police_station',['id' => $service_ps,'status' => 'active']);
    }
    $this->output->set_content_type('application/json')
            ->set_output(json_encode($response))->_display();
    exit();
  }

    public function getpromo() {

            $response = array();
            if ($this->input->post('customer') > 0) {
                $cus = $this->input->post('customer');
                $response = $this->consignment_model->get_where_all('discount',['merchant' => $cus,'status' => 'active']);

            }
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();

    }

    public function getdelivery() {

            $response = array();
            if ($this->input->post('ppackage') > 0) {
                $package = $this->input->post('ppackage');
                $response = $this->consignment_model->get_where_all('packing',['package_id' => $package,'status' => 'active']);

            }
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();

    }
    // public function getpackageprice() {
    //
    //         $response = array();
    //         if ($this->input->post('package_name') > 0) {
    //             $id = $this->input->post('package_name');
    //             $response = $this->consignment_model->get_where_all('package',['id' => $id,'status' => 'active']);
    //
    //         }
    //         $this->output->set_content_type('application/json')
    //                 ->set_output(json_encode($response))->_display();
    //         exit();
    //
    // }
    public function getpackageprice() {

            $response = array();
            if ($this->input->post('package_name') > 0) {
                $id = $this->input->post('package_name');
                $response = $this->consignment_model->get_where_all('packing',['id' => $id,'status' => 'active']);

            }
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();

    }

    public function getDiscounredprice() {

            $response = array();

                $code = $this->input->post('promo_code');
                $merchant = $this->input->post('customer');
                $result = $this->consignment_model->get_where_all('discount',['promo_code' => $code,'merchant' => $merchant,'status' => 'active']);
                if ($result) {
                  $response = $result[0];
                  $response['message'] = "Promo applied successfully";
                  $response['success'] = "true";
            }else{
              $response['message'] = "Promo code removed";
              $response['success'] = "false";

            }
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();

    }

    public function get_merchant(){
	    $postData = $this->input->post();
	    $data = $this->consignment_model->get_merchant_data($postData);
	    echo json_encode($data);
	}

  public function trackorder($cid = null){
    $data = array();
    if($cid != ""){
      $consignmentId = $cid;
    }else{
    $consignmentId = $this->input->post('awb');
  }
    $pageData = ['title' => 'Tracking Details', 'nav' => ['dashboard' => 'Dashboard','blank' => 'Tracking Details']];
      $data['consignment_id'] = $this->consignment_model->get_where_all('consignment', [' consignment_id' => $consignmentId]);
      if(!empty($data['consignment_id'])){
      $data['customer']= $this->consignment_model->get_where_all('shiping', [' id' => $data['consignment_id'][0]['recipient_address']]);
      $data['consignmentDetail']= $this->consignment_model->get_where_all('tracking', [' consignmentId' => $consignmentId]);
    }
      $content = $this->load->view('admin/consignment/trackorder', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
      $renderdata = ['page_title' => 'Tracking Details ', 'js' => ['delivery_status_update'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
  }

  public function correct_cons(){
    if($this->session->userdata('user_type') == '')
    redirect('admin');
    $data = array();
    // $data['row'] = $this->user_model->get_where_all('users');
    $content = $this->load->view('admin/consignment/correction', $data, true);
    $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Parcel Correction', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Parcel Correction']], true);
    $renderdata = ['page_title' => 'Parcel Correction', 'js' => ['cons_correction'], 'content' => $content, 'content_head' => $content_head];
    render($renderdata);
  }

  public function getconsdetail() {

            $response = array();
            if ($this->input->post('consno') != "") {
                $constoget = $this->input->post('consno');
                $consdetail= $this->consignment_model->get_where_all('consignment',["consignment_id"=>$constoget]);
                if($consdetail){
                  $response['cons'] = $consdetail;
                $response['merch_detail'] = $this->consignment_model->get_where_all('customer',["id"=>$consdetail[0]['customer']]);
                $response['ship_detail'] = $this->consignment_model->get_where_all('shiping',["id"=>$consdetail[0]['recipient_address']]);
              }else{
                $response = "invalid";
              }
            }
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();

    }

    public function save_correction(){
      $id = $this->input->post('id');
      if($id > 0){
        $total_price_product = $this->input->post('total_price_product');
        $total_price = $this->input->post('total_price');
        $total_cod_charge = $this->input->post('total_cod_charge');
        $cash_collection = $this->input->post('cash_collection_amount');
        $delivery_status = $this->input->post('delivery_status');
        $less_paid_return = $this->input->post('less_paid_return');
        $amount_paid = $this->input->post('amount_paid');
        $deduction_amount = $this->input->post('deduction_amount');
        $paytomerch = $this->input->post('paytomerch');
        $new_deliverydate = $this->input->post('new_deliverydate');
        $payment_status_merchant = $this->input->post('payment_status_merchant');
        $collection_status = $this->input->post('collection_status');
        $payment_status = $this->input->post('payment_status');
        $deduct_status = $this->input->post('deduct_status');
        $deductamnt = $this->input->post('deductamnt');

        $res = $this->consignment_model->update('consignment', [
            'total_price_product' => $total_price_product,
            'total_price' => $total_price,
            'total_cod_charge' => $total_cod_charge,

            'cash_collection' => $cash_collection,
            'delivery_status' => $delivery_status,
            'less_paid_return' => $less_paid_return,

            'amount_paid' => $amount_paid,
            'deduction_amount' => $deduction_amount,
            'paytomerch' => $paytomerch,
            'new_deliverydate' => $new_deliverydate,
            'payment_status_merchant'=> $payment_status_merchant,
            'collection_status'=> $collection_status,
            'payment_status'=> $payment_status,
            'deduction_status'=> $deduct_status,
            'deduction_amount'=> $deductamnt,
            ], ['id' => $id]);

        $response['message'] = "Consignment updated successfully";
        $response['success'] = true;
      }
    }

    function imgUpload(){
    $countfiles = count($_FILES['files']['name']);
    $upload_location = "uploads/merchants/";
    $files_arr = array();
    for($index = 0;$index < $countfiles;$index++){
      $filename = $_FILES['files']['name'][$index];
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      $valid_ext = array('gif', 'png', 'jpg','jpeg');
      if(in_array($ext, $valid_ext)){
        $fname = time().$filename;
        $path = $upload_location.$fname;
          if(move_uploaded_file($_FILES['files']['tmp_name'][$index],$path)){
            $files_arr[] = $fname;
         }
      }else{
        echo "only gif,png,jpg,jpeg files are allowed";
      }
    }
    echo implode('###',$files_arr);
  }

  public function submitorder(){
    $this->output->set_content_type('application/json');

      $consignment_id = $this->input->post('consignment_id');
      $orderType = $this->input->post('orderTYpe');
      $customer = $this->input->post('customer');
      $pick_address_auto = $this->input->post('pick_address_auto');
      $pick_address_landmark = $this->input->post('pick_address_landmark');
      $pick_number = $this->input->post('pick_number');
      $drop_address_auto = $this->input->post('drop_address_auto');
      $drop_address_landmark = $this->input->post('drop_address_landmark');
      $drop_number = $this->input->post('drop_number');
      $category = $this->input->post('parcel_cat');
      $parcel_wt = $this->input->post('product_weight');
      $distt = $this->input->post('distt');
      $police_station = $this->input->post('police_station');
      $distt2 = $this->input->post('distt2');
      $police_station2 = $this->input->post('police_station2');
      $height = $this->input->post('height');
      $width = $this->input->post('width');
      $imgValue = $this->input->post('imgValue');
      $payment_mode = $this->input->post('pmode');
      $payment_at = $this->input->post('p_pick_location');
      $delivery_charge = intval($this->input->post('total_price'));

        if($delivery_charge != ""){
        $consid = $this->consignment_model->insert('order_master', [
            'consignment_id' => $consignment_id,
            'order_type' => $orderType,
            'pick_address_auto' => $pick_address_auto,
            'pick_address_landmark' => $pick_address_landmark,
            'pick_number'=> $pick_number,
            'distt' => $distt,
            'police_station' => $police_station,
            'drop_address_auto'=> $drop_address_auto,
            'drop_address_landmark' => $drop_address_landmark,
            'drop_number' => $drop_number,
            'distt2' => $distt2,
            'police_station2' => $police_station2,

            'category' => $category,
            'parcel_wt' => $parcel_wt,

            'height' => $height,
            'width' => $width,
            'delivery_charge' => $delivery_charge,
            'payment_mode' => $payment_mode,
            'payment_at' => $payment_at,
            'parcel_img' => $imgValue]);
               $this->consignment_model->insert('tracking', ['consignmentId' => $consignment_id,
                          'detail' => "order placed"]);
        $response['message'] = "Consignment created successfully";
        $response['success'] = true;
      }else{
        $response['message'] = $delivery_charge;
        $response['success'] = false;
      }

        $this->output->set_output(json_encode($response));
  }

}
