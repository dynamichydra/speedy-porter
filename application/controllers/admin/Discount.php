<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Discount extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('discount_model');
    }

    public function index() {
      if($this->session->userdata('user_type')!= 'admin')
        // if(empty($this->session->userdata('name')))
      redirect('admin');
        $data = array();
        $data['row'] = $this->discount_model->get_all_promo();
        $content = $this->load->view('admin/discount/index', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Promo list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Promo list']], true);
        $renderdata = ['page_title' => 'Promo list', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function create($id = '') {
        $data = array();
        $pageData = ['title' => 'Create New Promo', 'nav' => ['dashboard' => 'Dashboard', 'discount' => 'Promo list', 'blank' => 'Create Promo']];
        $data['merchant'] = $this->discount_model->get_where_all('customer',['status' => 'active']);
        if (isset($id) && $id > 0) {
            $pageData["title"] = "Edit Promo";
            $pageData["nav"]["blank"] = "Edit Promo";
            $data['row'] = $this->discount_model->get_where_all('discount', ["id" => $id]);
            $data['row'] = $data['row'][0];
        }
        $content = $this->load->view('admin/discount/create', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Promo', 'js' => ['discount'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function createsave() {
        $id = $this->input->post("id");
        // $damount = abs($this->input->post('discount_percent'));
        if($this->input->post('cod_apl') == 1){
           $urban_cod_chrg_dis = $this->input->post('urban_cod_chrg_dis');
           $sub_urban_cod_chrg_dis = $this->input->post('sub_urban_cod_chrg_dis');
           $metro_cod_chrg_dis = $this->input->post('metro_cod_chrg_dis');
        }else{
          $urban_cod_chrg_dis = 0;
          $sub_urban_cod_chrg_dis = 0;
          $metro_cod_chrg_dis = 0;
        }
        if($this->input->post('return_apl') == 1){
          $urban_return_chrg_dis = $this->input->post('urban_return_chrg_dis');
          $sub_urban_return_chrg_dis = $this->input->post('sub_urban_return_chrg_dis');
          $metro_return_chrg_dis = $this->input->post('metro_return_chrg_dis');
        }else{
          $urban_return_chrg_dis = 0;
          $sub_urban_return_chrg_dis = 0;
          $metro_return_chrg_dis = 0;
        }
        $damount = $this->input->post('discount_percent');
        if (isset($id) && $id > 0) {
                      $res = $this->discount_model->update('discount', ['merchant' => $this->input->post('merchant'),
                       'promo_code' => $this->input->post('promo_code'),
                       'cod_apl' => $this->input->post('cod_apl'),
                       'return_apl' => $this->input->post('return_apl'),
                       'urban_dc_dis' => $this->input->post('urban_dc_dis'),
                       'urban_extra_chrg_dis' => $this->input->post('urban_extra_chrg_dis'),
                       'urban_cod_chrg_dis' => $urban_cod_chrg_dis,
                       'urban_return_chrg_dis' => $urban_return_chrg_dis,
                       'sub_urban_dc_dis' => $this->input->post('sub_urban_dc_dis'),
                       'sub_urban_extra_chrg_dis' => $this->input->post('sub_urban_extra_chrg_dis'),
                       'sub_urban_cod_chrg_dis' => $sub_urban_cod_chrg_dis,
                       'sub_urban_return_chrg_dis' => $sub_urban_return_chrg_dis,
                       'metro_dc_dis' => $this->input->post('metro_dc_dis'),
                       'metro_extra_chrg_dis' => $this->input->post('metro_extra_chrg_dis'),
                       'metro_cod_chrg_dis' => $metro_cod_chrg_dis,
                       'metro_return_chrg_dis' => $metro_return_chrg_dis],['id'=>$id]);
                      $response['message'] = "Promo updated successfully";
                      $response['success'] = true;
        } else {
                      $res = $this->discount_model->insert('discount', ['merchant' => $this->input->post('merchant'),
                       'promo_code' => $this->input->post('promo_code'),
                       'cod_apl' => $this->input->post('cod_apl'),
                       'return_apl' => $this->input->post('return_apl'),
                       'urban_dc_dis' => $this->input->post('urban_dc_dis'),
                       'urban_extra_chrg_dis' => $this->input->post('urban_extra_chrg_dis'),
                       'urban_cod_chrg_dis' => $urban_cod_chrg_dis,
                       'urban_return_chrg_dis' => $urban_return_chrg_dis,
                       'sub_urban_dc_dis' => $this->input->post('sub_urban_dc_dis'),
                       'sub_urban_extra_chrg_dis' => $this->input->post('sub_urban_extra_chrg_dis'),
                       'sub_urban_cod_chrg_dis' => $sub_urban_cod_chrg_dis,
                       'sub_urban_return_chrg_dis' => $sub_urban_return_chrg_dis,
                       'metro_dc_dis' => $this->input->post('metro_dc_dis'),
                       'metro_extra_chrg_dis' => $this->input->post('metro_extra_chrg_dis'),
                       'metro_cod_chrg_dis' => $metro_cod_chrg_dis,
                       'metro_return_chrg_dis' => $metro_return_chrg_dis]);
                      $response['message'] = "Promo creation successfull";
                      $response['success'] = true;
        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function delete($id){
        $this->discount_model->delete('discount', ['id' => $id]);
        $response['message'] = "Promo deleted successfully";
        $response['success'] = true;
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

}
