<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index() {
      if($this->session->userdata('user_type')!= 'admin')
        // if(empty($this->session->userdata('name')))
      redirect('admin');
        $data = array();
        $data['row'] = $this->user_model->get_where_all('users');
        $content = $this->load->view('admin/user/index', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'User list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'User list']], true);
        $renderdata = ['page_title' => 'Admin user list', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function create($id = '') {
        $data = array();
        $pageData = ['title' => 'Create New User', 'nav' => ['dashboard' => 'Dashboard', 'user' => 'User list', 'blank' => 'Create user']];
        $data['branch'] = $this->user_model->get_where_all('branch', ["status" => 'active']);
        if (isset($id) && $id > 0) {
            $pageData["title"] = "Edit user";
            $pageData["nav"]["blank"] = "Edit user";
            $data['row'] = $this->user_model->get_where_all('users', ["id" => $id]);
            $data['row'] = $data['row'][0];
        }
        $content = $this->load->view('admin/user/create', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Admin user', 'js' => ['user'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function createsave() {
        $id = $this->input->post("id");
        if (isset($id) && $id > 0) {
            $res = $this->user_model->get_where_all('users', ['email' => $this->input->post('email'),'id<>'.$id=>null]);
            if (count($res) > 0) {
                $response['message'] = "Email address already exits";
                $response['success'] = false;
            } else {
              if($this->input->post('password') != ""){
                $res = $this->user_model->update('users', ['name' => $this->input->post('name'), 'phone' => $this->input->post('phone'), 'email' => $this->input->post('email'), 'user_type' => $this->input->post('user_type'), 'branch' => $this->input->post('selected_branch'), 'password' => md5($this->input->post('password'))],['id'=>$id]);
                $response['message'] = "User updated successfully";
                $response['success'] = true;
              }else{
                $res = $this->user_model->update('users', ['name' => $this->input->post('name'), 'phone' => $this->input->post('phone'), 'email' => $this->input->post('email'), 'user_type' => $this->input->post('user_type'), 'branch' => $this->input->post('selected_branch')],['id'=>$id]);
                $response['message'] = "User updated successfully";
                $response['success'] = true;
              }
            }
        } else {
            $res = $this->user_model->get_where_all('users', ['email' => $this->input->post('email')]);
            if (count($res) > 0) {
                $response['message'] = "Email address already exits";
                $response['success'] = false;
            } else {
                $res = $this->user_model->insert('users', ['name' => $this->input->post('name'), 'phone' => $this->input->post('phone'), 'email' => $this->input->post('email'), 'password' => md5($this->input->post('password')), 'user_type' => $this->input->post('user_type'), 'branch' => $this->input->post('selected_branch')]);
                $response['message'] = "User creation successfully";
                $response['success'] = true;
            }
        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function delete($id){
        $this->user_model->delete('users', ['id' => $id]);
        $response['message'] = "User deleted successfully";
        $response['success'] = true;
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function change_pass() {
      if($this->session->userdata('id') == '')
      redirect('admin');
        $data = array();
        $data['user_id'] = $this->session->userdata('id');
        $content = $this->load->view('admin/user/change_password', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Change Password', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Change Password']], true);
        $renderdata = ['page_title' => 'Change Password', 'js' => ['change_password'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function updatepassword() {
        $id = $this->input->post("id");
        if($this->session->userdata('user_type') == 'customer'){

          $check=$this->user_model->get_where_all('customer', ['id' => $id]);
        	$user_pass=$check[0]['password'];
        	$input_pass=md5($this->input->post("password"));
          if($user_pass==$input_pass){
        		$insert = $this->user_model->update('customer', ['password' => md5($this->input->post('psw')),'pass_updated' => 1],['id'=>$id]);
        		if ($insert){
              $response['message'] = "Password Updated successfully,please login again";
              $response['success'] = true;
        		}else{
              $response['message'] = "Password Update failed";
              $response['success'] = false;
        		}
        	}else
        	{
            $response['message'] = "Current Password Mismatch,please try again";
            $response['success'] = false;
        	}
        }elseif ($this->session->userdata('user_type') == 'delivery' || $this->session->userdata('user_type') == 'receiver') {

          $check=$this->user_model->get_where_all('delivery_person', ['id' => $id]);
        	$user_pass=$check[0]['password'];
        	$input_pass=md5($this->input->post("password"));
          if($user_pass==$input_pass){
        		$insert = $this->user_model->update('delivery_person', ['password' => md5($this->input->post('psw'))],['id'=>$id]);
        		if ($insert){
              $response['message'] = "Password Updated successfully";
              $response['success'] = true;
        		}else{
              $response['message'] = "Password Update failed";
              $response['success'] = false;
        		}
        	}else
        	{
            $response['message'] = "Current Password Mismatch,please try again";
            $response['success'] = false;
        	}
        }else{

        $check=$this->user_model->get_where_all('users', ['id' => $id]);
      	$user_pass=$check[0]['password'];
      	$input_pass=md5($this->input->post("password"));
        if($user_pass==$input_pass){
      		$insert = $this->user_model->update('users', ['password' => md5($this->input->post('psw'))],['id'=>$id]);
      		if ($insert){
            $response['message'] = "Password Updated successfully";
            $response['success'] = true;
      		}else{
            $response['message'] = "Password Update failed";
            $response['success'] = false;
      		}
      	}else
      	{
          $response['message'] = "Current Password Mismatch,please try again";
          $response['success'] = false;
      	}
      }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

}
