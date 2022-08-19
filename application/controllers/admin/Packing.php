<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Packing extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('packing_model');
    }

    // public function index() {
    //   if($this->session->userdata('user_type')!= 'admin')
    //     // if(empty($this->session->userdata('name')))
    //   redirect('admin');
    //     $data = array();
    //     $data['row'] = $this->packing_model->get_where_all('packing',['status' => 'active']);
    //     $content = $this->load->view('admin/packing/index', $data, true);
    //     $content_head = $this->load->view('admin/layout/content_head', ['title' => 'packing list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'packing list']], true);
    //     $renderdata = ['page_title' => 'Wellcome to Packing Detils', 'content' => $content, 'content_head' => $content_head];
    //     render($renderdata);
    // }

    public function index() {
      if($this->session->userdata('user_type')!= 'admin')
      if($this->session->userdata('user_type')!= 'customer_care')
        // if(empty($this->session->userdata('name')))
      redirect('admin');
        $data = array();
        // $data['row'] = $this->packing_model->get_where_all('packing',['status' => 'active']);
        $data['row'] = $this->packing_model->get_allPacking();
        $content = $this->load->view('admin/packing/index', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'packing list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'packing list']], true);
        $renderdata = ['page_title' => 'Packing Details', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function create($id = '') {
        $data = array();
        $pageData = ['title' => 'Create Packing', 'nav' => ['dashboard' => 'Dashboard', 'packing' => 'packing list', 'blank' => 'Create packing']];
        if (isset($id) && $id > 0) {
            $pageData["title"] = "Edit Packing";
            $pageData["nav"]["blank"] = "Edit Packing";
            $data['row'] = $this->packing_model->get_where_all('packing', ["id" => $id]);
            $data['row'] = $data['row'][0];
            $data['status'] = $this->packing_model->get_where_all('package', ['status' => 'active']);
        }
        $data['status'] = $this->packing_model->get_where_all('package', ['status' => 'active']);
        $content = $this->load->view('admin/packing/create', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Packing ', 'js' => ['packing'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    // public function create($id = '') {
    //     $data = array();
    //     $pageData = ['title' => 'Create Packing', 'nav' => ['dashboard' => 'Dashboard', 'packing' => 'packing list', 'blank' => 'Create packing']];
    //     if (isset($id) && $id > 0) {
    //         $pageData["title"] = "Edit Packing";
    //         $pageData["nav"]["blank"] = "Edit Packing";
    //         $data['row'] = $this->packing_model->get_where_all('packing', ["id" => $id]);
    //         $data['row'] = $data['row'][0];
    //     }
    //     $content = $this->load->view('admin/packing/create', $data, true);
    //     $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
    //     $renderdata = ['page_title' => 'Wellcome to admin ', 'js' => ['packing'], 'content' => $content, 'content_head' => $content_head];
    //     render($renderdata);
    // }

    // public function createsave() {
    //     $id = $this->input->post("id");
    //     if (isset($id) && $id > 0) {
    //       $res = $this->packing_model->get_where_all('packing', ['name' => $this->input->post('packing_name'), 'id<>' . $id => null]);
    //         if (count($res) > 0) {
    //             $response['message'] = "Packing already exits";
    //             $response['success'] = false;
    //         } else {
    //
    //             $res = $this->packing_model->update('packing', [
    //                 'name' => $this->input->post('packing_name'),
    //                 'weight' => $this->input->post('packing_weight'),
    //                 'height' => $this->input->post('package_height'),
    //                 'width' => $this->input->post('package_width'),
    //                 'length' => $this->input->post('package_length')], ['id' => $id]);
    //             $response['message'] = "Packing updated successfully";
    //             $response['success'] = true;
    //        }
    //     } else {
    //          $res = $this->packing_model->get_where_all('packing', ['name' => $this->input->post('packing_name')]);
    //         if (count($res) > 0) {
    //             $response['message'] = "packing already exits";
    //             $response['success'] = false;
    //         } else {
    //
    //
    //             $res = $this->packing_model->insert('packing', ['id' => $this->input->post('id'),
    //                 'name' => $this->input->post('packing_name'),
    //                 'weight' => $this->input->post('packing_weight'),
    //                 'height' => $this->input->post('package_height'),
    //                 'width' => $this->input->post('package_width'),
    //                 'length' => $this->input->post('package_length')]);
    //             $response['message'] = "packing created successfully";
    //             $response['success'] = true;
    //        }
    //     }
    //     $this->output->set_content_type('application/json')
    //             ->set_output(json_encode($response))->_display();
    //     exit();
    // }


    public function createsave() {
      if(is_numeric($this->input->post('price'))){
        $id = $this->input->post("id");
        if (isset($id) && $id > 0) {
                $res = $this->packing_model->update('packing', [
                    'package_id' => $this->input->post('package'),
                    'delivery_type' => $this->input->post('delivery_type'),
                    'price' => $this->input->post('price'),
                    'total_price' => $this->input->post('total_price')], ['id' => $id]);
                $response['message'] = "Packing updated successfully";
                $response['success'] = true;
        } else {
                $res = $this->packing_model->insert('packing', ['package_id' => $this->input->post('package'),
                    'delivery_type' => $this->input->post('delivery_type'),
                    'price' => $this->input->post('price'),
                    'total_price' => $this->input->post('total_price')]);
                $response['message'] = "packing created successfully";
                $response['success'] = true;
        }
      }else{
        $response['message'] = "packing price should be numeric";
        $response['success'] = false;
      }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }
    public function delete($id) {
        $this->packing_model->delete_packing($id);
        $response['message'] = "Packing deleted successfully";
        $response['success'] = true;
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function get_packPrice($phase_id){
		$this->output->set_content_type('application json');
		$result = $this->packing_model->get_where_all('package', ['id' => $phase_id]);
    $price= $result[0]['price'];
    if($result){
            $this->output->set_output(json_encode(['result' => 1, 'price'=>$price]));
            return false;
        }else{
            $this->output->set_output(json_encode(['result' => 2]));
            return false;
        }
	}

}
