<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Add_data extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Add_data_model');
    }

    public function district() {
      if($this->session->userdata('user_type') == '')
      redirect('admin');
        $data = array();
        $data['row'] = $this->Add_data_model->get_where_all('district', ['status' => 'active']);
        $content = $this->load->view('admin/data/index', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'District list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'District list']], true);
        $renderdata = ['page_title' => 'District list', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function police_station() {
      if($this->session->userdata('user_type') == '')
      redirect('admin');
        $data = array();
        $data['row'] = $this->Add_data_model->get_all_data();
        $content = $this->load->view('admin/data/police_station', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Zip code list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Zip code list']], true);
        $renderdata = ['page_title' => 'Zip code list', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function dimension() {
      if($this->session->userdata('user_type') == '')
      redirect('admin');
        $data = array();
        // $data['row'] = $this->Add_data_model->get_all_data();
        $data['row'] = $this->Add_data_model->get_where_all('volumetric', ['status' => 'active']);
        $content = $this->load->view('admin/data/dimension', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Dimension list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Dimension list']], true);
        $renderdata = ['page_title' => 'Dimension list', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function create_district($id = '') {
        $data = array();
        $pageData = ['title' => 'Create New District', 'nav' => ['dashboard' => 'Dashboard', 'add_data/district' => 'District list', 'blank' => 'Create District']];
        if (isset($id) && $id > 0) {
            $pageData["title"] = "Edit District";
            $pageData["nav"]["blank"] = "Edit District";
            $data['row'] = $this->Add_data_model->get_where_all('district', ["id" => $id]);
            $data['row'] = $data['row'][0];
        }
        $content = $this->load->view('admin/data/create_district', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Branch', 'js' => ['district'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function create_station($id = '') {
        $data = array();
        $pageData = ['title' => 'Create New Zip code', 'nav' => ['dashboard' => 'Dashboard', 'add_data/police_station' => 'Station list', 'blank' => 'Create Zip code']];
        $data['district'] = $this->Add_data_model->get_where_all('district', ["status" => 'active']);
        if (isset($id) && $id > 0) {
            $pageData["title"] = "Edit Zip code";
            $pageData["nav"]["blank"] = "Edit Zip code";
            $data['row'] = $this->Add_data_model->get_where_all('police_station', ["id" => $id]);
            $data['row'] = $data['row'][0];
        }
        $content = $this->load->view('admin/data/create_station', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Zip code', 'js' => ['station'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function create_dimension($id = '') {
        $data = array();
        $pageData = ['title' => 'Create New Dimension', 'nav' => ['dashboard' => 'Dashboard', 'add_data/dimension' => 'Dimension list', 'blank' => 'Create Dimension']];
        $data['district'] = $this->Add_data_model->get_where_all('district', ["status" => 'active']);
        if (isset($id) && $id > 0) {
            $pageData["title"] = "Edit Dimension";
            $pageData["nav"]["blank"] = "Edit Dimension";
            $data['row'] = $this->Add_data_model->get_where_all('volumetric', ["id" => $id]);
            $data['row'] = $data['row'][0];
        }
        $content = $this->load->view('admin/data/create_dimension', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Dimension', 'js' => ['dimension'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function createsave_district() {
        $id = $this->input->post("id");
        if (isset($id) && $id > 0) {

                      $res = $this->Add_data_model->update('district', ['district_name' => $this->input->post('district_name')],['id'=>$id]);
                      $response['message'] = "District updated successfully";
                      $response['success'] = true;

        } else {

                      $res = $this->Add_data_model->insert('district', ['district_name' => $this->input->post('district_name')]);
                      $response['message'] = "District creation successfull";
        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function createsave_station() {
      if($this->input->post('district') != ""){
        $id = $this->input->post("id");
        if (isset($id) && $id > 0) {

                      $res = $this->Add_data_model->update('police_station', ['district' => $this->input->post('district'),
                      'area' => $this->input->post('area'),
                      'station_name' => $this->input->post('station_name')],['id'=>$id]);
                      $response['message'] = "Station updated successfully";
                      $response['success'] = true;

        } else {

                      $res = $this->Add_data_model->insert('police_station', ['district' => $this->input->post('district'),
                      'area' => $this->input->post('area'),
                      'station_name' => $this->input->post('station_name')]);
                      $response['message'] = "Station creation successfull";
                      $response['success'] = true;
        }
      }else{
        $response['message'] = "please Choose districr first";
        $response['success'] = false;
      }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function createsave_dimension() {
      if($this->input->post('price') != ""){
        $id = $this->input->post("id");
        if (isset($id) && $id > 0) {

                      $res = $this->Add_data_model->update('volumetric', ['height' => $this->input->post('height'),
                      'width' => $this->input->post('width'),
                      'price' => $this->input->post('price')],['id'=>$id]);
                      $response['message'] = "Dimesion updated successfully";
                      $response['success'] = true;

        } else {

                      $res = $this->Add_data_model->insert('volumetric', ['height' => $this->input->post('height'),
                      'width' => $this->input->post('width'),
                      'price' => $this->input->post('price')]);
                      $response['message'] = "Dimesion creation successfull";
                      $response['success'] = true;
        }
      }else{
        $response['message'] = "please set price first";
        $response['success'] = false;
      }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function delete($id){
        $this->Add_data_model->delete('district', ['id' => $id]);
        $response['message'] = "District deleted successfully";
        $response['success'] = true;
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function delete_station($id){
        $this->Add_data_model->delete('police_station', ['id' => $id]);
        $response['message'] = "Station deleted successfully";
        $response['success'] = true;
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function delete_dimension($id){
        $this->Add_data_model->delete('volumetric', ['id' => $id]);
        $response['message'] = "Dimension deleted successfully";
        $response['success'] = true;
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }
}
