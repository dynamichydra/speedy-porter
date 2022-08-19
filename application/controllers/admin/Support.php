<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('support_model');
    }

    public function index() {
      if($this->session->userdata('user_type') == '')
        // if(empty($this->session->userdata('name')))
      redirect('admin');
        $data = array();
        $data['row'] = $this->support_model->get_where_all('support');
        $content = $this->load->view('admin/support/index', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Support list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Support list']], true);
        $renderdata = ['page_title' => 'Support list', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function create($id = '') {
        $data = array();
        $pageData = ['title' => 'Create New Support', 'nav' => ['dashboard' => 'Dashboard', 'support' => 'Support list', 'blank' => 'Create Support']];
        if (isset($id) && $id > 0) {
            $pageData["title"] = "Edit Support";
            $pageData["nav"]["blank"] = "Edit Support";
            $data['row'] = $this->support_model->get_where_all('support', ["id" => $id]);
            $data['row'] = $data['row'][0];
        }
        $content = $this->load->view('admin/support/create', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Support', 'js' => ['support'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

  public function createsave(){
      $this->output->set_content_type('application jason');
      if($this->input->post('subject') != "" && $this->input->post('msg') != ""){
        $currentdate = date("Y-m-d");
        $hash = md5(rand(0, 1000));
                $support_data = array(
                    'date' => $currentdate,
                    'user' => $this->session->userdata('id'),
                    'user_type' => $this->session->userdata('user_type'),
                    'subject' => $this->input->post('subject'),
                    'link' => $this->input->post('link'),
                    'msg' => $this->input->post('msg'),
                    'file' => $this->input->post('docsValue'),
                   'hash' => $hash
                );
            $id=$this->support_model->insert('support',$support_data);
            $sub='SPEEDY PORTER | Support Mail';    //subject
           $msg= /*-----------email body starts-----------*/
             'Please click this link to see the support mail:

            ' . base_url() . 'admin/support/verify/' . $id . '/' . $hash;

            $to      = "support@sibyltech.co,debnath.rubel@gmail.com";
           // $to      = "niraj@sibyltech.co,niraj.singh88.ns@gmail.com";
           $subject = $this->input->post('subject');
           $message = $msg;
           $headers = 'From: hello@SPEEDYPORTER.com' . "\r\n" .
               'Reply-To: hello@SPEEDYPORTER.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();
           $success = mail($to, $subject, $message, $headers);
           if($success){
             $response['message'] = "Support mail has been sent successfully!!";
             $response['success'] = true;
           }
      }else{
        $response['message'] = "Please fill all the mandatory fields";
          $response['success'] = false;
      }
      $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

  public function verify($id=null,$hash=null)
  {
    $res=$this->support_model->get_where_all('support',['id'=>  $id, 'hash'=> $hash]);
    if($res){
      $userid=$this->support_model->get_where_all('users',['id'=>  $res[0]['user']]);
    $data = array();
    $data['row']= $res;
    $data['userid']= $userid;
    $content = $this->load->view('admin/support/assesment', $data, true);
    rendernonlogin($content,['js'=>'support']);
  }else{
    redirect('admin/home');
  }
  }

  public function assesmentupdate(){
    $this->output->set_content_type('application jason');
      if(!empty($this->input->post('assesment'))){
      $update_data = array(
          'assesment' => $this->input->post('assesment'),
         'status' => $this->input->post('status'),
      );
      $res=$this->support_model->update('support',$update_data,['id'=>  $this->input->post('id')]);

        $response['message'] = "Assesment has been submitted successfully";
        $response['success'] = true;
      }else{
        $response['message'] = "Assesment field cannot be empty!!";
        $response['success'] = false;
      }
    $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
  }

  function fileUpload(){
  $countfiles = count($_FILES['files']['name']);
  $upload_location = "uploads/support/";
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
