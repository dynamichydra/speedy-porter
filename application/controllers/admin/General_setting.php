<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class General_setting extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('general_setting_model');
    }

    public function index() {
      if($this->session->userdata('user_type') == '')
      redirect('admin');
        $usertype = $this->session->userdata('user_type');
        $userid = $this->session->userdata('id');
        $data = array();
        $data['theme'] = $this->general_setting_model->get_all_setting($usertype,$userid);
        $data['userid'] = $userid;
        $content = $this->load->view('admin/settings/general_settings', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'General Settings', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'General Settings']], true);
        $renderdata = ['page_title' => 'General Settings', 'js' => ['general_setting'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function updatetheme() {
      $id = $this->input->post('id');
      if($id > 0){
        if($this->session->userdata('user_type') == 'customer'){
        $insert = $this->general_setting_model->update('customer', ['theme' => $this->input->post('theme')],['id'=>$id]);
      }elseif ($this->session->userdata('user_type') == 'delivery' || $this->session->userdata('user_type') == 'receiver') {
        $insert = $this->general_setting_model->update('delivery_person', ['theme' => $this->input->post('theme')],['id'=>$id]);
      }else{
        $insert = $this->general_setting_model->update('users', ['theme' => $this->input->post('theme')],['id'=>$id]);
      }
        if ($insert){
          $response['message'] = "theme Updated successfully";
          $response['success'] = true;
        }else{
          $response['message'] = "theme Update failed";
          $response['success'] = false;
        }
      }
      $_SESSION['theme'] = $this->input->post('theme');
      $this->output->set_content_type('application/json')
              ->set_output(json_encode($response))->_display();
      exit();
    }

}
