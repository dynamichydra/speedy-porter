<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Employee_model');
    }

    public function index() {
      if($this->session->userdata('user_type') == '')
        // if(empty($this->session->userdata('name')))
      redirect('admin');
      if($this->session->userdata('user_type') == 'branch'){
        $creator = $this->session->userdata('id');
        // $data['row'] = $this->delivery_person_model->get_all_transporter_bycreator($creator);
        $data['row'] = $this->Employee_model->get_all_transporter();
      }else{
        $data = array();
        if($this->input->post('selected_branch') == ""){
          $addedby = "all";
        }else{
        $addedby = $this->input->post('selected_branch');
      }
        $data['fetch'] = $this->input->post();
        // $data['row'] = $this->delivery_person_model->get_where_all('delivery_person',['status' => 'active']);
        $data['branch'] = $this->Employee_model->get_where_all('branch', ["status" => 'active']);
        if($addedby == 'all'){
        $data['row'] = $this->Employee_model->get_all_employee();
      }else{
        $data['row'] = $this->Employee_model->get_all_employee_sort($addedby);
      }
    }
        $content = $this->load->view('admin/delivery_person/employee', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Official list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Official list']], true);
        $renderdata = ['page_title' => 'Official List', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function create($id = '') {
        $data = array();
        $pageData = ['title' => 'Create Official', 'nav' => ['dashboard' => 'Dashboard', 'employee' => 'Official list', 'blank' => 'Create Official']];
        if (isset($id) && $id > 0) {
            $pageData["title"] = "Edit Official";
            $pageData["nav"]["blank"] = "Edit Official";
            $data['row'] = $this->Employee_model->get_where_all('employee', ["id" => $id]);
            $data['branch'] = $this->Employee_model->get_where_all('branch', ["status" => 'active']);
            $data['row'] = $data['row'][0];
        }
        // $data['transporter_id'] = 'ABTP'.$this->random_strings(4);
        $data['branch'] = $this->Employee_model->get_where_all('branch', ["status" => 'active']);
        $content = $this->load->view('admin/delivery_person/create_official', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Add Official ', 'js' => ['official_person'], 'content' => $content, 'content_head' => $content_head];
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
             if($this->input->post('password') != ""){
               $oldValues = $this->Employee_model->get_where_all('employee', ['id' => $id]);
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

                 $res = $this->Employee_model->update('employee', ['name' => $this->input->post('name'),
                 'nid' => $this->input->post('nid'),
                 'employee_id' => $this->input->post('employee_id'),
                 'id_type' => $this->input->post('id_type'),
                 'office' => $this->input->post('office'),
                 'designation' => $this->input->post('designation'),
                 'photo' => $pic,
                 'doc' => $doc,
                 'phone' => $this->input->post('phno'),
                 'department' => $this->input->post('department'),

                 'month_salary' => $this->input->post('month_salary'),

                 'email' => $this->input->post('email'),
                 'password' => md5($this->input->post('password')),
                 'address' => $this->input->post('address')],
                  ['id' => $id]);
                 $response['message'] = "Official updated successfully";
                 $response['success'] = true;
             }else{
             $oldValues = $this->Employee_model->get_where_all('employee', ['id' => $id]);
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

               $res = $this->Employee_model->update('employee', ['name' => $this->input->post('name'),
               'nid' => $this->input->post('nid'),
               'employee_id' => $this->input->post('employee_id'),
               'id_type' => $this->input->post('id_type'),
               'office' => $this->input->post('office'),
               'designation' => $this->input->post('designation'),
               'photo' => $pic,
               'doc' => $doc,
               'phone' => $this->input->post('phno'),
               'department' => $this->input->post('department'),

               'month_salary' => $this->input->post('month_salary'),

               'email' => $this->input->post('email'),
               'address' => $this->input->post('address')],
                ['id' => $id]);
               $response['message'] = "Official updated successfully";
               $response['success'] = true;
           }
       } else {

               $res = $this->Employee_model->insert('employee', ['id' => $this->input->post('id'),
               'nid' => $this->input->post('nid'),
               'employee_id' => $this->input->post('employee_id'),
               'id_type' => $this->input->post('id_type'),
               'office' => $this->input->post('office'),
               'designation' => $this->input->post('designation'),
               'doc' => $this->input->post('docsValue'),
               'photo' => $this->input->post('picValue'),
               'name' => $this->input->post('name'),

               'month_salary' => $this->input->post('month_salary'),
               'phone' => $this->input->post('phno'),
               'department' => $this->input->post('department'),
               'email' => $this->input->post('email'),
               'address' => $this->input->post('address'),
               'added_by' => $addedby
             ]);

               $response['message'] = "Official created successfully";
               $response['success'] = true;
       }
       $this->output->set_content_type('application/json')
               ->set_output(json_encode($response))->_display();
       exit();
   }

   public function delete($id) {
       $this->Employee_model->delete_official_person($id);
       $response['message'] = "Official deleted successfully";
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

}
