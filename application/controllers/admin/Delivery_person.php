<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery_person extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('delivery_person_model');
    }

    public function index() {
      if($this->session->userdata('user_type') == '')
        // if(empty($this->session->userdata('name')))
      redirect('admin');
      if($this->session->userdata('user_type') == 'branch'){
        $creator = $this->session->userdata('id');
        // $data['row'] = $this->delivery_person_model->get_all_transporter_bycreator($creator);
        $data['row'] = $this->delivery_person_model->get_all_transporter();
      }else{
        $data = array();
        if($this->input->post('selected_branch') == ""){
          $addedby = "all";
        }else{
        $addedby = $this->input->post('selected_branch');
      }
        $data['fetch'] = $this->input->post();
        // $data['row'] = $this->delivery_person_model->get_where_all('delivery_person',['status' => 'active']);
        $data['branch'] = $this->delivery_person_model->get_where_all('branch', ["status" => 'active']);
        if($addedby == 'all'){
        $data['row'] = $this->delivery_person_model->get_all_transporter();
      }else{
        $data['row'] = $this->delivery_person_model->get_all_transporter_sort($addedby);
      }
    }
        $content = $this->load->view('admin/delivery_person/index', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Transporter list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Transporter list']], true);
        $renderdata = ['page_title' => 'Transporter', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function track(){
      $data = array();
      $data['row'] = $this->delivery_person_model->get_where_all('delivery_person',['status' => 'active']);
      $content = $this->load->view('admin/delivery_person/trackDeliveryBoy', $data, true);
      $content_head = $this->load->view('admin/layout/content_head', ['title' => 'track delivery Person', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'track delivery person']], true);
      $renderdata = ['page_title' => 'Track Deliver Person', 'js' => ['trackDeliveryBoy'], 'content' => $content, 'content_head' => $content_head];
      render($renderdata);
    }

    public function create($id = '') {
        $data = array();
        $pageData = ['title' => 'Create Transporter', 'nav' => ['dashboard' => 'Dashboard', 'delivery_person' => 'Transporter list', 'blank' => 'Create Transporter']];
        if (isset($id) && $id > 0) {
            $pageData["title"] = "Edit Transporter";
            $pageData["nav"]["blank"] = "Edit Transporter";
            $data['row'] = $this->delivery_person_model->get_where_all('delivery_person', ["id" => $id]);
            $data['branch'] = $this->delivery_person_model->get_where_all('branch', ["status" => 'active']);
            $data['row'] = $data['row'][0];
        }
        // $data['transporter_id'] = 'ABTP'.$this->random_strings(4);
        $data['branch'] = $this->delivery_person_model->get_where_all('branch', ["status" => 'active']);
        $content = $this->load->view('admin/delivery_person/create', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Add Transporter ', 'js' => ['delivery_person'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function random_strings($length_of_string)
   {
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($str_result),
                       0, $length_of_string);
   }

    public function createsave() {
      if($this->session->userdata('user_type') == 'admin'){
      $addedby = 'admin';
    }else{
      $addedby = $this->session->userdata('id');
    }
        $id = $this->input->post("id");
        if (isset($id) && $id > 0) {
            // $res = $this->delivery_person_model->get_where_all('delivery_person', ['email' => $this->input->post('email'), 'id<>' . $id => null]);
            // if (count($res) > 0) {
            //     $response['message'] = "Email address already exits";
            //     $response['success'] = false;
            // } else {
              if($this->input->post('password') != ""){
                $oldValues = $this->delivery_person_model->get_where_all('delivery_person', ['id' => $id]);
                if(!empty($this->input->post('docsValue'))){
                  $doc= $this->input->post('docsValue');
                }else{
                  $doc= $oldValues[0]['doc'];
                }

                if(!empty($this->input->post('picValue'))){
                  $pic= $this->input->post('picValue');
                }else{
                  $pic= $oldValues[0]['photo'];
                }
                 /* $imagename=time()."_". $_FILES['image']['name'];
                  $config['upload_path'] = './upload/';
                  $config['allowed_types'] = 'gif|jpg|png|jpeg';
                  $config['file_name']=$imagename;
                  $config['overwrite']= TRUE;
                  $this->load->library("upload", $config);



              if($this->upload->do_upload('image'))
                 {*/

                  $res = $this->delivery_person_model->update('delivery_person', ['name' => $this->input->post('name'),
                  'nid' => $this->input->post('nid'),
                  'transporter_id' => $this->input->post('transporter_id'),
                  'id_type' => $this->input->post('id_type'),
                  'office' => $this->input->post('office'),
                  'transporter_type' => $this->input->post('transporter_type'),
                  'photo' => $pic,
                  'doc' => $doc,
                  'phone' => $this->input->post('phno'),
                  'user_type' => $this->input->post('user_type'),

                  'month_salary' => $this->input->post('month_salary'),
                  'del_comission' => $this->input->post('del_comission'),
                  'pick_comission' => $this->input->post('pick_comission'),
                  'oil_bill' => $this->input->post('oil_bill'),

                  'email' => $this->input->post('email'),
                  'password' => md5($this->input->post('password')),
                  'address' => $this->input->post('address')],
                   ['id' => $id]);
                  $response['message'] = "Transporter updated successfully";
                  $response['success'] = true;
              }else{
              $oldValues = $this->delivery_person_model->get_where_all('delivery_person', ['id' => $id]);
              if(!empty($this->input->post('docsValue'))){
                $doc= $this->input->post('docsValue');
              }else{
                $doc= $oldValues[0]['doc'];
              }

              if(!empty($this->input->post('picValue'))){
                $pic= $this->input->post('picValue');
              }else{
                $pic= $oldValues[0]['photo'];
              }
               /* $imagename=time()."_". $_FILES['image']['name'];
                $config['upload_path'] = './upload/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['file_name']=$imagename;
                $config['overwrite']= TRUE;
                $this->load->library("upload", $config);



            if($this->upload->do_upload('image'))
               {*/

                $res = $this->delivery_person_model->update('delivery_person', ['name' => $this->input->post('name'),
                'nid' => $this->input->post('nid'),
                'transporter_id' => $this->input->post('transporter_id'),
                'id_type' => $this->input->post('id_type'),
                'office' => $this->input->post('office'),
                'transporter_type' => $this->input->post('transporter_type'),
                'photo' => $pic,
                'doc' => $doc,
                'phone' => $this->input->post('phno'),
                'user_type' => $this->input->post('user_type'),

                'month_salary' => $this->input->post('month_salary'),
                'del_comission' => $this->input->post('del_comission'),
                'pick_comission' => $this->input->post('pick_comission'),
                'oil_bill' => $this->input->post('oil_bill'),

                'email' => $this->input->post('email'),
                'address' => $this->input->post('address')],
                 ['id' => $id]);
                $response['message'] = "Transporter updated successfully";
                $response['success'] = true;
             /* }else{
                $response['message'] = "Upload only Image file";
                $response['success'] = true;
              }*/
            }
          // }
        } else {
            // $res = $this->delivery_person_model->get_where_all('delivery_person', ['email' => $this->input->post('email')]);
            // if (count($res) > 0) {
            //     $response['message'] = "Email address already exits";
            //     $response['success'] = false;
            // } else {
                /*$imagename = time()."_". $_FILES['image']['name'];
                $config['upload_path'] = './upload/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['file_name']=$imagename;
                $config['overwrite']= TRUE;
                $this->load->library("upload", $config);

            if($this->upload->do_upload('image'))
               {*/

                $res = $this->delivery_person_model->insert('delivery_person', ['id' => $this->input->post('id'),
                'nid' => $this->input->post('nid'),
                'transporter_id' => $this->input->post('transporter_id'),
                'id_type' => $this->input->post('id_type'),
                'office' => $this->input->post('office'),
                'transporter_type' => $this->input->post('transporter_type'),
                'doc' => $this->input->post('docsValue'),
                'photo' => $this->input->post('picValue'),
                'name' => $this->input->post('name'),

                'month_salary' => $this->input->post('month_salary'),
                'del_comission' => $this->input->post('del_comission'),
                'pick_comission' => $this->input->post('pick_comission'),
                'oil_bill' => $this->input->post('oil_bill'),

                'phone' => $this->input->post('phno'),
                'user_type' => $this->input->post('user_type'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'added_by' => $addedby
                // 'password' => md5($this->input->post('password'))
              ]);

                // $deliveryCredentials= $this->user_model->insert('users', ['name' => $this->input->post('name'), 'email' => $this->input->post('email'), 'password' => md5($this->input->post('password')), 'user_type' => $this->input->post('delivery')]);
                $response['message'] = "Transporter created successfully";
                $response['success'] = true;
              /*}
              else{
                 $response['message'] = "Upload only Image file";
                 $response['success'] = true;
              }*/
            // }
        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function delete($id) {
        $this->delivery_person_model->delete_delivery_person($id);
        $response['message'] = "Delivery person deleted successfully";
        $response['success'] = true;
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    function docsUpload(){
    $countfiles = count($_FILES['files']['name']);
    $upload_location = "uploads/delivery_person/";
    $files_arr = array();
    for($index = 0;$index < $countfiles;$index++){
      $filename = $_FILES['files']['name'][$index];
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      $valid_ext = array("pdf");
      if(in_array($ext, $valid_ext)){
        $fname = time().$filename;
        $path = $upload_location.$fname;
          if(move_uploaded_file($_FILES['files']['tmp_name'][$index],$path)){
            $files_arr[] = $fname;
         }
      }else{
        echo "only pdf files are allowed";
        // <script>alert('only pdf files are allowed');
                             // </script>
      }
    }
    echo implode('###',$files_arr);
  }


  function picUpload(){
  $countfiles = count($_FILES['files']['name']);
  $upload_location = "uploads/delivery_person/";
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

  function geoLocation(){
    // $row =$this->input->post();
    $lat = $this->input->post('Lat');
    $Long = $this->input->post('Long');
    $date = date("Y/m/d");
    $time = date("h:i:sa");
    $this->delivery_person_model->insert('geolocation', ['delBoynid' => $this->session->userdata('nid'),
    'date' => $date,
    'time' => $time,
    'latitude' => $lat,
    'longitude' => $Long]);
    // die;
  }

  function print_transporter($transporter_id) {
      $data['title'] = 'Transporter';
      $data['transporter'] = $this->delivery_person_model->get_where_all('delivery_person', [' id' => $transporter_id,'status' => "active"]);
      $this->load->view('admin/delivery_person/print_transporter', $data);
  }

}
