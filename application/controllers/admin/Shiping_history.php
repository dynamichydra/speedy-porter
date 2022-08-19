<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shiping_history extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('shiping_history_model');
        $this->load->model('customer_model');
    }

    public function index($id) {
      if($this->session->userdata('user_type')== '')
        // if(empty($this->session->userdata('name')))
      redirect('admin');
        $data = array();
        $data['row'] = $this->shiping_history_model->get_all_consignment($id);
        $data['customer_id'] = $id;
        $content = $this->load->view('admin/shiping_history/index', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'Shiping History list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'Shiping History list']], true);
        $renderdata = ['page_title' => 'Shiping History', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function view($customer_id,$id = '') {
        //$customer_id = $this->input->post('customer_id');
        $data = array();
        $pageData = ['nav' => ['dashboard' => 'Dashboard', 'shiping_history/index/'.$customer_id => 'Shiping History list', 'blank' => 'View Shiping']];
        $data['customer_id'] = $customer_id;
        if (isset($id) && $id > 0) {
            $pageData["title"] = "View Shiping History";
            //$pageData["nav"]["blank"] = "View Shiping";
            $data['row'] = $this->shiping_history_model->view_all_consignment($id,$customer_id);
            $data['row'] = $data['row'][0];
        }
        $content = $this->load->view('admin/shiping_history/view', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Shiping History ', 'js' => ['shiping_history'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function details($tracking_id) {
        $data = array();
        $pageData = ['nav' => ['dashboard' => 'Dashboard', 'shiping_history/index/'.$this->session->userdata('id') => 'Shiping History list', 'blank' => 'View Shiping']];
        if (isset($tracking_id) && $tracking_id!= '') {
            $pageData["title"] = "View Shiping details";
            $data['consignment_id'] = $this->customer_model->get_where_all('consignment', [' consignment_id' => $tracking_id]);
            $data['consignment']= $this->customer_model->get_where_all('tracking', [' consignmentId' => $tracking_id]);
        }
        $content = $this->load->view('admin/shiping_history/details', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Tracking details', 'js' => ['shiping_history'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }


}
