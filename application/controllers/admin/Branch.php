<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('branch_model');
    }

    public function index() {
      if($this->session->userdata('user_type') == '')
        // if(empty($this->session->userdata('name')))
      redirect('admin');
        $data = array();
        // $data['row'] = $this->branch_model->get_where_all('branch');
        $data['row'] = $this->branch_model->get_all_branch();
        // print_r($data['row']);
        // die;
        $content = $this->load->view('admin/branch/index', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Branch list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Branch list']], true);
        $renderdata = ['page_title' => 'Branch list', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function create($id = '') {
        $data = array();
        $pageData = ['title' => 'Create New Branch', 'nav' => ['dashboard' => 'Dashboard', 'branch' => 'Branch list', 'blank' => 'Create Branch']];
        $data['district'] = $this->branch_model->get_where_all('district', ['status' => 'active']);
        $data['p_station'] = $this->branch_model->get_where_all('police_station', ['status' => 'active']);
        if (isset($id) && $id > 0) {
            $pageData["title"] = "Edit Branch";
            $pageData["nav"]["blank"] = "Edit Branch";
            $data['row'] = $this->branch_model->get_where_all('branch', ["id" => $id]);
            $data['p_station'] = $this->branch_model->get_where_all('police_station', ['status' => 'active']);
            $data['row'] = $data['row'][0];
        }
        $content = $this->load->view('admin/branch/create', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Branch', 'js' => ['branch'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function createsave() {
        $id = $this->input->post("id");
        $txtPhone    = 	$this->input->post('phone');
        if (isset($id) && $id > 0) {

          if (is_numeric($txtPhone) && strlen($txtPhone)) {
                if ($this->branch_model->get_where_all('branch', ['phone' => $this->input->post('phone'),'id<>'.$id=>null])) {
                    $response['message'] = "Phone number already exist.";
                    $response['success'] = false;
                } else {
                  $res = $this->branch_model->get_where_all('branch', ['email' => $this->input->post('email'),'id<>'.$id=>null]);
                  if (count($res) > 0) {
                      $response['message'] = "Email address already exits";
                      $response['success'] = false;
                  } else {
                    $covering_station = implode(",",$this->input->post('cp_station'));
                      $res = $this->branch_model->update('branch', ['name' => $this->input->post('name'), 'district' => $this->input->post('district'),'police_station' => $this->input->post('police_station'),'email' => $this->input->post('email'),'phone' => $this->input->post('phone'), 'address' => $this->input->post('address'), 'cp_station' => $covering_station],['id'=>$id]);
                      $response['message'] = "Branch updated successfully";
                      $response['success'] = true;
                  }
                }
            } else {
                $response['message'] = "Incorrect phone number.";
                $response['success'] = false;
            }

        } else {

          if (is_numeric($txtPhone) && strlen($txtPhone)) {
                if ($this->branch_model->get_where_all('branch', ['phone' => $this->input->post('phone'),'id<>'.$id=>null])) {
                    $response['message'] = "Phone number already exist.";
                    $response['success'] = false;
                } else {
                  $res = $this->branch_model->get_where_all('branch', ['email' => $this->input->post('email')]);
                  if (count($res) > 0) {
                      $response['message'] = "Email address already exits";
                      $response['success'] = false;
                  } else {
                      $res = $this->branch_model->insert('branch', ['name' => $this->input->post('name'), 'district' => $this->input->post('district'),'police_station' => $this->input->post('police_station'), 'email' => $this->input->post('email'), 'phone' => $this->input->post('phone'), 'address' => $this->input->post('address')]);
                      $response['message'] = "Branch creation successfull";
                      $response['success'] = true;
                  }
                }
            } else {
                $response['message'] = "Incorrect phone number.";
                $response['success'] = false;
            }

        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function delete($id){
        $this->branch_model->delete('branch', ['id' => $id]);
        $response['message'] = "Branch deleted successfully";
        $response['success'] = true;
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function getPstation() {

            $response = array();
            if ($this->input->post('dist') > 0) {
                $dist = $this->input->post('dist');
                $response = $this->branch_model->get_where_all('police_station',['district' => $dist,'status' => 'active']);

            }
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($response))->_display();
            exit();

    }

    function print_detail($branch_id) {
        $data['title'] = 'Branch';
        $data['merchant'] = $this->branch_model->get_where_all('branch', [' id' => $branch_id,'status' => "active"]);
        $this->load->view('admin/branch/print_branch', $data);
    }

}
