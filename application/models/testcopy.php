<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class delivery_person extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('delivery_person_model');
    }

    public function index() {
        $data = array();
        $data['row'] = $this->delivery_person_model->get_where_all('delivery_person');
        $content = $this->load->view('admin/delivery_person/index', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', ['title' => 'delivery_person list', 'nav' => ['dashboard' => 'Dashboard', 'blank' => 'delivery_person list']], true);
        $renderdata = ['page_title' => 'Wellcome to Deliver Person Detils', 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function create($id = '') {
        $data = array();
        $pageData = ['title' => 'Create Delivery Person', 'nav' => ['dashboard' => 'Dashboard', 'delivery' => 'delivery_person list', 'blank' => 'Create delivery_person']];
        if (isset($id) && $id > 0) {
            $pageData["title"] = "Edit Delivery person";
            $pageData["nav"]["blank"] = "Edit delivery_person";
            $data['row'] = $this->delivery_person_model->get_where_all('delivery_person', ["id" => $id]);
            $data['row'] = $data['row'][0];
        }
        $content = $this->load->view('admin/delivery_person/create', $data, true);
        $content_head = $this->load->view('admin/layout/content_head', $pageData, true);
        $renderdata = ['page_title' => 'Wellcome to admin ', 'js' => ['delivery_person'], 'content' => $content, 'content_head' => $content_head];
        render($renderdata);
    }

    public function createsave() {
        $id = $this->input->post("id");
        if (isset($id) && $id > 0) {
            $res = $this->delivery_person_model->get_where_all('delivery_person', ['email' => $this->input->post('email'), 'id<>' . $id => null]);
            if (count($res) > 0) {
                $response['message'] = "Email address already exits";
                $response['success'] = false;
            } else {
                $imagename=time()."_". $_FILES['image']['name'];
                $config['upload_path'] = './upload/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['file_name']=$imagename;
                $config['overwrite']= TRUE;
                $this->load->library("upload", $config);

            if($this->upload->do_upload('image'))
               {

                $res = $this->delivery_person_model->update('delivery_person', ['name' => $this->input->post('name'), 'email' => $this->input->post('email')], ['id' => $id]);
                $response['message'] = "Delivery person updated successfully";
                $response['success'] = true;
              }else{
                $response['message'] = "Upload only Image file";
                $response['success'] = true;
              }
            }
        } else {
            $res = $this->delivery_person_model->get_where_all('delivery_person', ['email' => $this->input->post('email')]);
            if (count($res) > 0) {
                $response['message'] = "Email address already exits";
                $response['success'] = false;
            } else {
                $imagename = time()."_". $_FILES['image']['name'];
                $config['upload_path'] = './upload/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['file_name']=$imagename;
                $config['overwrite']= TRUE;
                $this->load->library("upload", $config);

                $data = array(
                'id' => $this->input->post('id'),
                'name' => $this->input->post('name'),
                'phone' => $this->input->post('phno'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'photo' => $imagename, 
                'password' => $this->input->post('password')
             );

            if($this->upload->do_upload('image'))
               {

                $this->delivery_person_model->add_record($data);
                
                /*$res = $this->delivery_person_model->insert('delivery_person', ['id' => $this->input->post('id'),'name' => $this->input->post('name'),'phone' => $this->input->post('phno'),'email' => $this->input->post('email'),'address' => $this->input->post('address'),'photo' => $imagename, 'password' => $this->input->post('password')]);*/
                $response['message'] = "delivery person created successfully";
                $response['success'] = true;
              }
              else{
                 $response['message'] = "Upload only Image file";
                 $response['success'] = true;
              }
            }
        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function delete($id) {
        $this->delivery_person_model->delete_delivery_person($id);
        $response['message'] = "Delivery person deleted successfully";
        $response['success'] = true;
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

}
