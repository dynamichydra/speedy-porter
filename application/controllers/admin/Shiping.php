<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shiping extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('shiping_model');
    }

    public function index($id) {
      if($this->session->userdata('user_type')== '')
        // if(empty($this->session->userdata('name')))
      redirect('admin');
        $data = array();
        $data['row'] = $this->shiping_model->get_where_all('shiping',['status' => 'active','customer' => $id]);
        $data['customer_id'] = $id;
        $content = $this->load->view('admin/shiping/index', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Shipping list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Shipping list']], true);
        $renderdata = ['page_title' => 'Shipping Details', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function database() {
      if($this->session->userdata('user_type')== '')
        // if(empty($this->session->userdata('name')))
      redirect('admin');
        $data = array();
        $data['row'] = $this->shiping_model->get_where_all('shiping',['status' => 'active']);
        // $data['customer_id'] = $id;
        $content = $this->load->view('admin/shiping/index', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Shipping list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Shipping list']], true);
        $renderdata = ['page_title' => 'Shipping Details', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function create($id = '') {
        //$customer_id = $this->input->post('customer_id');
        $data = array();
        $data['district'] = $this->shiping_model->get_where_all('district', ['status' => 'active']);
        $pageData = ['title' => 'Create Shiping', 'nav' => ['dashboard' => 'Dashboard', 'shiping/database'=> 'Shipping list', 'blank' => 'Create Shipping']];
        $data['customer_id'] = "";
        if (isset($id) && $id > 0) {
            $pageData["title"] = "Edit Shipping";
            $pageData["nav"]["blank"] = "Edit Shipping";
            $data['row'] = $this->shiping_model->get_where_all('shiping', ["id" => $id]);
            $data['row'] = $data['row'][0];
        }
        $content = $this->load->view('admin/shiping/create', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Shipping ', 'js' => ['shiping'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function createsave() {
        $id = $this->input->post("id");
        if (isset($id) && $id > 0) {
            $res = $this->shiping_model->update('shiping',
                  ['recipient_name' => $this->input->post('recipient_name'),
                  'recipient_address' => $this->input->post('recipient_address'),
                  'recipient_address_2' => $this->input->post('recipient_address_2'),
                  'recipient_city' => $this->input->post('recipient_city'),
                  'recipient_area' => $this->input->post('recipient_area'),
                  'recipient_postalcode' => $this->input->post('recipient_pincode'),
                  'recipient_landmark' => $this->input->post('recipient_landmark'),

                  'district' => $this->input->post('district'),
                  'police_station' => $this->input->post('police_station'),

                  's_lat' =>$this->input->post('gmap_lat'),
                  's_lng'=>$this->input->post('gmap_lng'),
                  's_city' =>$this->input->post('gmap_city')], ['id' => $id]);
                $response['message'] = "Shiping updated successfully";
                $response['success'] = true;

        } else {
          $res = $this->shiping_model->insert('shiping', ['id' => $this->input->post('id'),
            'recipient_number' => $this->input->post('recipient_number'),
            'recipient_name' => $this->input->post('recipient_name'),
            'recipient_address' => $this->input->post('recipient_address'),
            'recipient_address_2' => $this->input->post('recipient_address_2'),
            'recipient_city' => $this->input->post('recipient_city'),
            'recipient_area' => $this->input->post('recipient_area'),
            'recipient_postalcode' => $this->input->post('recipient_pincode'),
            'recipient_landmark' => $this->input->post('recipient_landmark'),

            'district' => $this->input->post('district'),
            'police_station' => $this->input->post('police_station'),

            'customer' => $this->input->post('customer_id'),
            's_lat' =>$this->input->post('gmap_lat'),
            's_lng'=>$this->input->post('gmap_lng'),
            's_city' =>$this->input->post('gmap_city')]);
                $response['message'] = "Shiping created successfully";
                $response['success'] = true;

        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function delete($id) {
        $this->shiping_model->delete_shiping($id);
        $response['message'] = "Shiping deleted successfully";
        $response['success'] = true;
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function default($cus_id,$id) {
      $checktype = $this->shiping_model->get_where_all('shiping',['status' => 'active','id' => $id]);
      if($checktype[0]['type'] == 'local'){
        $updatetype = "pickup";
      }else{
        $updatetype = "local";
      }
      $res = $this->shiping_model->update('shiping',
            ['type' => $updatetype
            ], ['id' => $id]);
      redirect('admin/shiping/index/'.$cus_id);
        // $response['message'] = "Shiping type changed successfully";
        // $response['success'] = true;
        // $this->output->set_content_type('application/json')
        //         ->set_output(json_encode($response))->_display();
        // exit();
    }

    public function createnewshipping() {
        $data_id = $this->input->post("recipient_data_id");
        if (isset($data_id) && $data_id == "") {
          $res = $this->shiping_model->insert('shiping', [
            'recipient_number' => $this->input->post('recipient_number'),
            'recipient_name' => $this->input->post('recipient_name'),
            'recipient_address' => $this->input->post('recipient_address_shipping'),
            'recipient_address_2' => $this->input->post('recipient_address_2'),

            'district' => $this->input->post('district'),
            'police_station' => $this->input->post('police_station'),
            's_lat' =>$this->input->post('gmap_lat'),
            's_lng'=>$this->input->post('gmap_lng'),
            's_city' =>$this->input->post('gmap_city')]);
                $response['message'] = "Shipping created successfully";
                $response['success'] = true;
                $response['address_id'] = $res;
                $response['name'] = $this->input->post('recipient_name');
                $response['number'] = $this->input->post('recipient_number');
                $response['address'] = $this->input->post('recipient_address_shipping');
                $response['res_ps'] = $this->input->post('police_station');

        }else{
          $response['message'] = "Shipping creation failed/ addreess already present please click okay to proceed";
          $response['success'] = false;
        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

}
