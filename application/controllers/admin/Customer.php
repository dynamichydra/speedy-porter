<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('customer_model');
    }

    // public function index() {
    //   if($this->session->userdata('user_type') == '')
    //     // if(empty($this->session->userdata('name')))
    //   redirect('admin');
    //     $data = array();
    //     if($this->session->userdata('user_type') == 'branch'){
    //       $data['row'] = $this->customer_model->get_where_all('customer',['status' => 'active','created_by' => $this->session->userdata('id')]);
    //     }else{
    //     $data['row'] = $this->customer_model->get_where_all('customer',['status' => 'active']);
    //   }
    //     $content = $this->load->view('admin/customer/index', $data, true);
    //     $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Merchant list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Merchant list']], true);
    //     $renderdata = ['page_title' => 'Merchant List', 'content' => $content, 'content_head' => $content_head];
    //     render($renderdata);
    // }

    public function review() {
      if($this->session->userdata('user_type')== '')
      redirect('admin');
      $data = array();
      // $data['result'] = $this->report_model->getconsignmentInfoAll($arr);

      $data['row'] = $this->customer_model->get_where_all('profile_update',['approved' =>0]);

      // echo $data['src']['status'];
      // die;
      $content = $this->load->view('admin/customer/profile_review', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Merchant Profile Review', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Merchant Profile Review']], true);
      $renderdata = ['page_title' => 'Merchant Profile Review', 'js' => ['customer_index'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }
    //
    // public function approve($id){
    //   if($this->session->userdata('user_type')== '')
    //   redirect('admin');
    //     $dataedit = $this->customer_model->get_where_all('profile_update',["id"=>$id]);
    //     $dataprofile = $this->customer_model->get_where_all('customer',["id"=>$dataedit[0]['profile_id']]);
    //
    //     if(!empty($dataedit)){
    //       $res = $this->customer_model->update('customer', ['name' => $dataedit[0]['name'],
    //       'bank_account_name' => $dataedit[0]['bank_account_name'],
    //       'bank_routing' => $dataedit[0]['bank_routing'],
    //       'm_nid' => $dataedit[0]['m_nid'],
    //       'package' => $dataedit[0]['package'],
    //       'phone' => $dataedit[0]['phone'],
    //       'email' => $dataedit[0]['email'],
    //       'ref_code' => $dataedit[0]['ref_code'],
    //       'address' => $dataedit[0]['address'],
    //       'address_2' => $dataedit[0]['address_2'],
    //       'address_3' => $dataedit[0]['address_3'],
    //       'merchant_landmark' => $dataedit[0]['merchant_landmark'],
    //       'district' => $dataedit[0]['district'],
    //       'police_station' => $dataedit[0]['police_station'],
    //       'pincode' => $dataedit[0]['pincode'],
    //       'company' => $dataedit[0]['company'],
    //       'default_pymnt' => $dataedit[0]['default_pymnt'],
    //       'website' => $dataedit[0]['website'],
    //       'facebook' => $dataedit[0]['facebook'],
    //       'bank_name' => $dataedit[0]['bank_name'],
    //       'bank_branch' => $dataedit[0]['bank_branch'],
    //       'bank_account' => $dataedit[0]['bank_account'],
    //       'mobile_banking_type' => $dataedit[0]['mobile_banking_type'],
    //       'mobile_banking_no' => $dataedit[0]['mobile_banking_no'],
    //       'office' => $dataedit[0]['office'],
    //       'logo' => $dataedit[0]['logo']], ['id' => $dataedit[0]['profile_id']]);
    //     }
    //     $res = $this->customer_model->update('profile_update',['approved' => 1],['id' => $id]);
    //
    //     // print_r($row_details);die;
    //     redirect(base_url().'admin/customer/review');
    // }
    //
    public function seen($id){
      $this->customer_model->seen_update($id);
      redirect(base_url().'admin/customer/review');
    }

    public function index() {
      if($this->session->userdata('user_type')== '')
      redirect('admin');
      $row = $this->input->post();
      $arr = [];

      if(isset($row['customer_id']) && $row['customer_id']!=''){
        $arr['id'] = $row['customer_id'];
      }
      if(isset($row['office_id']) && $row['office_id']!=''){
        $arr['office'] = $row['office_id'];
      }
      if(isset($row['company']) && $row['company']!=''){
        $arr['company'] = $row['company'];
      }
        $arr['status'] = 'active';
      $data = array();
      // $data['result'] = $this->report_model->getconsignmentInfoAll($arr);
      if($this->session->userdata('user_type') == 'branch'){
        $arr['office'] = $_SESSION['branch'];
        // $arr['created_by'] = $this->session->userdata('id');
        $data['row'] = $this->customer_model->get_where_all('customer',$arr,"","",'id','DESC');
      }else{
      $data['row'] = $this->customer_model->get_where_all('customer',$arr,"","",'id','DESC');
    }
      $data['company'] = $this->customer_model->get_where_all('customer', ['status' => 'active']);
      $data['merchant'] = $this->customer_model->get_where_all('customer', ['status' => 'active']);
      $data['branch'] = $this->customer_model->get_where_all('branch', [' status' => 'active']);
      $data['src'] = $row;
      // echo $data['src']['status'];
      // die;
      $content = $this->load->view('admin/customer/index', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Customer list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Customer list']], true);
      $renderdata = ['page_title' => 'Customer List', 'js' => ['customer_index'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }

    public function create($id = '') {
        $data = array();
        $data['district'] = $this->customer_model->get_where_all('district', ['status' => 'active']);
        $data['branch'] = $this->customer_model->get_where_all('branch', [' status' => 'active']);
        $data['package'] = $this->customer_model->get_where_all('package', [' status' => 'active']);
        $pageData = ['title' => 'Create Customer', 'nav' => ['dashboard' => 'Dashboard', 'customer' => 'Customer list', 'blank' => 'Create Customer']];
        if (isset($id) && $id > 0) {
            $pageData["title"] = "Edit Customer";
            $pageData["nav"]["blank"] = "Edit Customer";
            $data['row'] = $this->customer_model->get_where_all('customer', ["id" => $id]);
            $data['row'] = $data['row'][0];
        }
        $content = $this->load->view('admin/customer/create', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => ' Customer ', 'js' => ['customer'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function profile($id = '') {
        $data = array();
        $data['district'] = $this->customer_model->get_where_all('district', ['status' => 'active']);
        $data['branch'] = $this->customer_model->get_where_all('branch', [' status' => 'active']);
        $data['package'] = $this->customer_model->get_where_all('package', [' status' => 'active']);
        $pageData = ['title' => 'Update Profile', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Update Profile']];
        if (isset($id) && $id > 0) {
            $pageData["title"] = "Update Profile";
            $pageData["nav"]["blank"] = "Update Profile";
            $data['row'] = $this->customer_model->get_where_all('customer', ["id" => $id]);
            $data['row'] = $data['row'][0];
        }
        $content = $this->load->view('admin/customer/profile', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Profile', 'js' => ['profile'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function createsave() {
        $id = $this->input->post("id");
        if($this->session->userdata('user_type') == "admin"){
          $c_user = 'admin';
        }else{
          $c_user = $this->session->userdata('id');
        }
        if (isset($id) && $id > 0) {

              if(!empty($this->input->post('logoValue'))){
                $logo=$this->input->post('logoValue');
              }else{
                $logo=$this->input->post('oldlogoValue');
              }
               if($this->input->post('password') != ""){
                 $res = $this->customer_model->update('customer', ['name' => $this->input->post('name'),
                 'bank_account_name' => $this->input->post('baccName'),
                 'bank_routing' => $this->input->post('brouting'),
                 'm_nid' => $this->input->post('m_nid'),
                 'phone' => $this->input->post('phno'),
                 'package' => $this->input->post('package'),
                 'email' => $this->input->post('email'),
                 'ref_code' => $this->input->post('ref_code'),
                 'address' => $this->input->post('address'),
                 'address_2' => $this->input->post('address_2'),
                 'address_3' => $this->input->post('address_3'),
                 'merchant_landmark' => $this->input->post('merchant_landmark'),
                 'district' => $this->input->post('district'),
                 'police_station' => $this->input->post('police_station'),
                 'pincode' => $this->input->post('pincode'),
                 'company' => $this->input->post('company'),
                 'website' => $this->input->post('web'),
                 'facebook' => $this->input->post('fbPage'),
                 'bank_name' => $this->input->post('bName'),
                 'bank_branch' => $this->input->post('bBranch'),
                 'bank_account' => $this->input->post('bAccno'),
                 'mobile_banking_type' => $this->input->post('mobile_banking_type'),
                 'mobile_banking_no' => $this->input->post('mobile_banking_no'),
                 'office' => $this->input->post('office'),
                 'password' => md5($this->input->post('password')),
                 'logo' => $logo], ['id' => $id]);
                 $response['message'] = "Merchant updated successfully";
                 $response['success'] = true;
               }else{
                $res = $this->customer_model->update('customer', ['name' => $this->input->post('name'),
                'bank_account_name' => $this->input->post('baccName'),
                'bank_routing' => $this->input->post('brouting'),

                'm_nid' => $this->input->post('m_nid'),
                'package' => $this->input->post('package'),
                'phone' => $this->input->post('phno'),
                'email' => $this->input->post('email'),
                'ref_code' => $this->input->post('ref_code'),
                'address' => $this->input->post('address'),
                'address_2' => $this->input->post('address_2'),
                'address_3' => $this->input->post('address_3'),
                'merchant_landmark' => $this->input->post('merchant_landmark'),
                'district' => $this->input->post('district'),
                'police_station' => $this->input->post('police_station'),
                'pincode' => $this->input->post('pincode'),
                'company' => $this->input->post('company'),
                'website' => $this->input->post('web'),
                'facebook' => $this->input->post('fbPage'),
                'bank_name' => $this->input->post('bName'),
                'bank_branch' => $this->input->post('bBranch'),
                'bank_account' => $this->input->post('bAccno'),
                'mobile_banking_type' => $this->input->post('mobile_banking_type'),
                'mobile_banking_no' => $this->input->post('mobile_banking_no'),
                'office' => $this->input->post('office'),
                'logo' => $logo], ['id' => $id]);
                $response['message'] = "Merchant updated successfully";
                $response['success'] = true;
              }
        } else {
            $res = $this->customer_model->get_where_all('customer', ['phone' => $this->input->post('phno')]);
            if (count($res) > 0) {
                $response['message'] = "Contact No  already exits";
                $response['success'] = false;
            } else {
              $registration_date = date("Y-m-d");

                $res = $this->customer_model->insert('customer', ['id' => $this->input->post('id'),
                'm_nid' => $this->input->post('m_nid'),
                'registered_on' => $registration_date,
                'package' => $this->input->post('package'),
                'name' => $this->input->post('name'),
                'phone' => $this->input->post('phno'),
                'email' => $this->input->post('email'),
                'ref_code' => $this->input->post('ref_code'),
                'address' => $this->input->post('address'),
                'address_2' => $this->input->post('address_2'),
                'address_3' => $this->input->post('address_3'),
                'merchant_landmark' => $this->input->post('merchant_landmark'),
                'district' => $this->input->post('district'),
                'police_station' => $this->input->post('police_station'),
                'pincode' => $this->input->post('pincode'),
                'company' => $this->input->post('company'),
                'website' => $this->input->post('web'),
                'facebook' => $this->input->post('fbPage'),
                'bank_name' => $this->input->post('bName'),
                'bank_branch' => $this->input->post('bBranch'),
                'bank_account' => $this->input->post('bAccno'),
                'mobile_banking_type' => $this->input->post('mobile_banking_type'),
                'mobile_banking_no' => $this->input->post('mobile_banking_no'),
                'office' => $this->input->post('office'),
                'logo' => $this->input->post('logoValue'),
                'created_by' => $c_user,
                // 'others' => $this->input->post('bOther'),
                'password' => md5($this->input->post('password'))]);

                $response['message'] = "Merchant created successfully";
                $response['success'] = true;
            }
        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function createsave_profile() {
        $id = $this->input->post("id");
        $dataedit = $this->input->post();

        if (isset($id) && $id > 0) {
             $res = $this->customer_model->get_where_all('customer', ['id' => $id]);
             $row_details = array();
             $update_date = date("Y-m-d");
             if($res[0]['name'] != $dataedit['name']){$row_details['name'] = $dataedit['name'];}

             if($res[0]['bank_account_name'] != $dataedit['baccName']){$row_details['bank_account_name'] = $dataedit['baccName'];}
             if($res[0]['bank_routing'] != $dataedit['brouting']){$row_details['bank_routing'] = $dataedit['brouting'];}
             if($res[0]['m_nid'] != $dataedit['m_nid']){$row_details['m_nid'] = $dataedit['m_nid'];}
             if($res[0]['phone'] != $dataedit['phno']){$row_details['phone'] = $dataedit['phno'];}
             if($res[0]['email'] != $dataedit['email']){$row_details['email'] = $dataedit['email'];}
             if($res[0]['ref_code'] != $dataedit['ref_code']){$row_details['ref_code'] = $dataedit['ref_code'];}
             if($res[0]['address'] != $dataedit['address']){$row_details['address'] = $dataedit['address'];}
             if($res[0]['merchant_landmark'] != $dataedit['merchant_landmark']){$row_details['merchant_landmark'] = $dataedit['merchant_landmark'];}
             if($res[0]['district'] != $dataedit['district']){$row_details['district'] = $dataedit['district'];}
             if($res[0]['police_station'] != $dataedit['police_station']){$row_details['police_station'] = $dataedit['police_station'];}
             if($res[0]['pincode'] != null && $res[0]['pincode'] != $dataedit['pincode']){$row_details['pincode'] = $dataedit['pincode'];}
             if($res[0]['company'] != $dataedit['company']){$row_details['company'] = $dataedit['company'];}
             if($res[0]['default_pymnt'] != $dataedit['default_pymnt']){$row_details['default_pymnt'] = $dataedit['default_pymnt'];}
             if($res[0]['website'] != $dataedit['web']){$row_details['website'] = $dataedit['web'];}
             // if($res[0]['facebook'] != $dataedit['fbPage']){$row_details['facebook'] = $dataedit['fbPage'];}
             if($res[0]['bank_name'] != $dataedit['bName']){$row_details['bank_name'] = $dataedit['bName'];}
             if($res[0]['bank_branch'] != $dataedit['bBranch']){$row_details['bank_branch'] = $dataedit['bBranch'];}
             if($res[0]['bank_account'] != $dataedit['bAccno']){$row_details['bank_account'] = $dataedit['bAccno'];}
             if($res[0]['mobile_banking_type'] != $dataedit['mobile_banking_type']){$row_details['mobile_banking_type'] = $dataedit['mobile_banking_type'];}
             if($res[0]['mobile_banking_no'] != $dataedit['mobile_banking_no']){$row_details['mobile_banking_no'] = $dataedit['mobile_banking_no'];}

             if(!empty($row_details)){
               $row_details['profile_id'] = $res[0]['id'];
               $row_details['update_date'] = $update_date;
               $row_details['company_name'] =$res[0]['company'];
               $row_details['approved'] =0;
               $insert_update = $this->customer_model->insert('profile_update',$row_details);
             }

             if($this->input->post('office') == ""){
               $pickofc = $res[0]['office'];
             }else{
               $pickofc = $this->input->post('office');
             }

              if(!empty($this->input->post('logoValue'))){
                $logo=$this->input->post('logoValue');
              }else{
                $logo=$this->input->post('oldlogoValue');
              }

                $res = $this->customer_model->update('customer', ['name' => $this->input->post('name'),
                'bank_account_name' => $this->input->post('baccName'),
                'bank_routing' => $this->input->post('brouting'),
                'm_nid' => $this->input->post('m_nid'),
                'package' => $this->input->post('package'),
                'phone' => $this->input->post('phno'),
                'email' => $this->input->post('email'),
                'ref_code' => $this->input->post('ref_code'),
                'address' => $this->input->post('address'),
                'address_2' => $this->input->post('address_2'),
                'address_3' => $this->input->post('address_3'),
                'merchant_landmark' => $this->input->post('merchant_landmark'),
                'district' => $this->input->post('district'),
                'police_station' => $this->input->post('police_station'),
                'pincode' => $this->input->post('pincode'),
                'company' => $this->input->post('company'),
                'default_pymnt' => $this->input->post('default_pymnt'),
                'website' => $this->input->post('web'),
                'facebook' => $this->input->post('fbPage'),
                'bank_name' => $this->input->post('bName'),
                'bank_branch' => $this->input->post('bBranch'),
                'bank_account' => $this->input->post('bAccno'),
                'mobile_banking_type' => $this->input->post('mobile_banking_type'),
                'mobile_banking_no' => $this->input->post('mobile_banking_no'),
                'office' => $pickofc,
                'logo' => $logo], ['id' => $id]);
                $response['message'] = "Profile updated successfully";
                $response['success'] = true;
                $_SESSION['package'] = $this->input->post('package');

            // }
        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function createsave_profile_update() {
        $id = $this->input->post("id");
        $prev_update = $this->customer_model->get_where_all('profile_update', ['profile_id' => $id]);
        if ($prev_update) {
             $res = $this->customer_model->get_where_all('customer', ['id' => $id]);
             if($this->input->post('office') == ""){
               $pickofc = $res[0]['office'];
             }else{
               $pickofc = $this->input->post('office');
             }

              if(!empty($this->input->post('logoValue'))){
                $logo=$this->input->post('logoValue');
              }else{
                $logo=$this->input->post('oldlogoValue');
              }

                $res = $this->customer_model->update('profile_update', ['name' => $this->input->post('name'),
                'bank_account_name' => $this->input->post('baccName'),
                'bank_routing' => $this->input->post('brouting'),
                'm_nid' => $this->input->post('m_nid'),
                'package' => $this->input->post('package'),
                'phone' => $this->input->post('phno'),
                'email' => $this->input->post('email'),
                'ref_code' => $this->input->post('ref_code'),
                'address' => $this->input->post('address'),
                'address_2' => $this->input->post('address_2'),
                'address_3' => $this->input->post('address_3'),
                'merchant_landmark' => $this->input->post('merchant_landmark'),
                'district' => $this->input->post('district'),
                'police_station' => $this->input->post('police_station'),
                'pincode' => $this->input->post('pincode'),
                'company' => $this->input->post('company'),
                'default_pymnt' => $this->input->post('default_pymnt'),
                'website' => $this->input->post('web'),
                'facebook' => $this->input->post('fbPage'),
                'bank_name' => $this->input->post('bName'),
                'bank_branch' => $this->input->post('bBranch'),
                'bank_account' => $this->input->post('bAccno'),
                'mobile_banking_type' => $this->input->post('mobile_banking_type'),
                'mobile_banking_no' => $this->input->post('mobile_banking_no'),
                'office' => $pickofc,
                'logo' => $logo], ['profile_id' => $id]);
                $response['message'] = "Profile updated successfully submitted for review";
                $response['success'] = true;
                $_SESSION['package'] = $this->input->post('package');

            // }
        }else{
          $res = $this->customer_model->get_where_all('customer', ['id' => $id]);
          if($this->input->post('office') == ""){
            $pickofc = $res[0]['office'];
          }else{
            $pickofc = $this->input->post('office');
          }

           if(!empty($this->input->post('logoValue'))){
             $logo=$this->input->post('logoValue');
           }else{
             $logo=$this->input->post('oldlogoValue');
           }

             $res = $this->customer_model->insert('profile_update', ['name' => $this->input->post('name'),
             'profile_id' => $id,
             'bank_account_name' => $this->input->post('baccName'),
             'bank_routing' => $this->input->post('brouting'),
             'm_nid' => $this->input->post('m_nid'),
             'package' => $this->input->post('package'),
             'phone' => $this->input->post('phno'),
             'email' => $this->input->post('email'),
             'ref_code' => $this->input->post('ref_code'),
             'address' => $this->input->post('address'),
             'address_2' => $this->input->post('address_2'),
             'address_3' => $this->input->post('address_3'),
             'merchant_landmark' => $this->input->post('merchant_landmark'),
             'district' => $this->input->post('district'),
             'police_station' => $this->input->post('police_station'),
             'pincode' => $this->input->post('pincode'),
             'company' => $this->input->post('company'),
             'default_pymnt' => $this->input->post('default_pymnt'),
             'website' => $this->input->post('web'),
             'facebook' => $this->input->post('fbPage'),
             'bank_name' => $this->input->post('bName'),
             'bank_branch' => $this->input->post('bBranch'),
             'bank_account' => $this->input->post('bAccno'),
             'mobile_banking_type' => $this->input->post('mobile_banking_type'),
             'mobile_banking_no' => $this->input->post('mobile_banking_no'),
             'office' => $pickofc,
             'logo' => $logo]);
             $response['message'] = "Profile updated successfully submitted for review";
             $response['success'] = true;
             $_SESSION['package'] = $this->input->post('package');
        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function delete($id) {
        $this->customer_model->delete_customer($id);
        $response['message'] = "Merchant deleted successfully";
        $response['success'] = true;
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    function logoUpload(){
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

}
