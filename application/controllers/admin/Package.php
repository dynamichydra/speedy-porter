<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('package_model');
    }

    public function index() {
      if($this->session->userdata('user_type')!= 'admin')
        // if(empty($this->session->userdata('name')))
      redirect('admin');
        $data = array();
        $data['row'] = $this->package_model->get_where_all('package',['status' => 'active']);
        $content = $this->load->view('admin/package/index', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'package list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'package list']], true);
        $renderdata = ['page_title' => 'Package Details', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function create($id = '') {
        $data = array();
        $pageData = ['title' => 'Create Package', 'nav' => ['dashboard' => 'Dashboard', 'package' => 'package list', 'blank' => 'Create package']];
        $data['customer'] = $this->package_model->get_where_all('customer', ['status' => 'active']);
        if (isset($id) && $id > 0) {
            $pageData["title"] = "Edit Package";
            $pageData["nav"]["blank"] = "Edit package";
            $data['row'] = $this->package_model->get_where_all('package', ["id" => $id]);
            $data['row'] = $data['row'][0];
        }
        $content = $this->load->view('admin/package/create', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Package ', 'js' => ['package'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function createsave() {
      if(is_numeric($this->input->post('package_weight')) && is_numeric($this->input->post('package_price'))){
        $id = $this->input->post("id");
        if (isset($id) && $id > 0) {
          $res = $this->package_model->get_where_all('package', ['name' => $this->input->post('package_name'), 'id<>' . $id => null]);
            if (count($res) > 0) {
                $response['message'] = "Package already exits";
                $response['success'] = false;
            } else {

                $res = $this->package_model->update('package', [
                    'name' => $this->input->post('package_name'),
                    'weight' => $this->input->post('package_weight'),
                    'note' => $this->input->post('note'),
                    'p_area' => $this->input->post('p_area'),
                    'cod' => $this->input->post('cod'),
                    'urban_dc' => $this->input->post('urban_dc'),
                    'urban_extra_chrg' => $this->input->post('urban_extra_chrg'),

                    'urban_dis_extra_chrg' => $this->input->post('urban_dis_extra_chrg'),
                    'sub_dis_extra_chrg' => $this->input->post('sub_dis_extra_chrg'),
                    'metro_dis_extra_chrg' => $this->input->post('metro_dis_extra_chrg'),

                    'urban_cod_chrg' => $this->input->post('urban_cod_chrg'),
                    'sub_urban_dc' => $this->input->post('sub_urban_dc'),
                    'sub_urban_extra_chrg' => $this->input->post('sub_urban_extra_chrg'),
                    'sub_urban_cod_chrg' => $this->input->post('sub_urban_cod_chrg'),
                    'metro_dc' => $this->input->post('metro_dc'),
                    'metro_extra_chrg' => $this->input->post('metro_extra_chrg'),
                    'metro_cod_chrg' => $this->input->post('metro_cod_chrg'),
                    'price' => $this->input->post('package_price')], ['id' => $id]);
                $response['message'] = "Package updated successfully";
                $response['success'] = true;
           }
        } else {
             $res = $this->package_model->get_where_all('package', ['name' => $this->input->post('package_name')]);
            if (count($res) > 0) {
                $response['message'] = "Package already exits";
                $response['success'] = false;
            } else {


                $res = $this->package_model->insert('package', ['id' => $this->input->post('id'),
                    'name' => $this->input->post('package_name'),
                    'weight' => $this->input->post('package_weight'),
                    'note' => $this->input->post('note'),
                    'p_area' => $this->input->post('p_area'),
                    'cod' => $this->input->post('cod'),
                    'urban_dc' => $this->input->post('urban_dc'),
                    'urban_extra_chrg' => $this->input->post('urban_extra_chrg'),

                    'urban_dis_extra_chrg' => $this->input->post('urban_dis_extra_chrg'),
                    'sub_dis_extra_chrg' => $this->input->post('sub_dis_extra_chrg'),
                    'metro_dis_extra_chrg' => $this->input->post('metro_dis_extra_chrg'),
                    
                    'urban_cod_chrg' => $this->input->post('urban_cod_chrg'),
                    'sub_urban_dc' => $this->input->post('sub_urban_dc'),
                    'sub_urban_extra_chrg' => $this->input->post('sub_urban_extra_chrg'),
                    'sub_urban_cod_chrg' => $this->input->post('sub_urban_cod_chrg'),
                    'metro_dc' => $this->input->post('metro_dc'),
                    'metro_extra_chrg' => $this->input->post('metro_extra_chrg'),
                    'metro_cod_chrg' => $this->input->post('metro_cod_chrg'),
                    'price' => $this->input->post('package_price')]);
                $response['message'] = "package created successfully";
                $response['success'] = true;
           }
        }
      }else{
        $response['message'] = "package weight and price should be numeric only";
        $response['success'] = false;
      }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function delete($id) {
        $this->package_model->delete_package($id);
        $response['message'] = "package deleted successfully";
        $response['success'] = true;
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

}
